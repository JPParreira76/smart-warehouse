#include <WiFi101.h>
#include <ArduinoHttpClient.h>
#include <DHT.h>
#include <NTPClient.h>
#include <WiFiUdp.h>  //Pré-instalada com o Arduino IDE
#include <TimeLib.h>

#define DHTPIN 0       // Pin Digital onde está ligado o sensor
#define DHTTYPE DHT11  // Tipo de sensor DHT 

DHT dht(DHTPIN, DHTTYPE);  // Instanciar e declarar a class DHT

WiFiUDP clienteUDP; 
//Servidor de NTP do IPLeiria: ntp.ipleiria.pt //Fora do IPLeiria servidor: 0.pool.ntp.org
char NTP_SERVER[] = "0.pool.ntp.org";
NTPClient timeClient(clienteUDP, NTP_SERVER, 3600);

char SSID[] = "labs";
char PASS_WIFI[] = "robot1cA!ESTG";
char URL[] = "192.168.88.244";
int PORTO = 80;

WiFiClient clienteWifi;
HttpClient clienteHTTP = HttpClient(clienteWifi, URL, PORTO);

void post2API(String nome, float valor, String hora) {

  String URLPath = "/smart-warehouse/api/api.php";
  String contentType = "application/x-www-form-urlencoded";
  String enviaNome = nome;
  String enviaValor = String(valor);
  String enviaHora = hora;
  String body = "nome=" + enviaNome + "&valor=" + enviaValor + "&hora=" + enviaHora;

  clienteHTTP.post(URLPath, contentType, body);

  while (clienteHTTP.connected()) {
    if (clienteHTTP.available()) {
      int responseStatusCode = clienteHTTP.responseStatusCode();
      String responseBody = clienteHTTP.responseBody();
      Serial.println("Status Code: " + String(responseStatusCode) + " Resposta: " + responseBody);
    }
  }
}

void update_time(char *datahora) {
  timeClient.update();
  unsigned long epochTime = timeClient.getEpochTime();
  sprintf(datahora, "%02d-%02d-%02d %02d:%02d:%02d", year(epochTime), month(epochTime), day(epochTime), hour(epochTime), minute(epochTime), second(epochTime));
}

void setup() {

  Serial.begin(115200);
  while (!Serial)
    ;

  WiFi.begin(SSID, PASS_WIFI);

  while (WiFi.status() != WL_CONNECTED) {
    Serial.println(".");
    delay(500);
  }

  Serial.print("IP Adress: ");
  Serial.println((IPAddress)WiFi.localIP());
  Serial.print("Subnet Mask: ");
  Serial.println((IPAddress)WiFi.subnetMask());
  Serial.print("Default Gateway: ");
  Serial.println((IPAddress)WiFi.gatewayIP());
  Serial.print("Received Signal Strength Indicator: ");
  Serial.println(WiFi.RSSI());

  pinMode(LED_BUILTIN, OUTPUT);

  dht.begin();
}

void loop() {
  //GETS
  clienteHTTP.get("192.168.88.244/smart-warehouse/api/api.php?temperatura=valor");
  float valor_temperatura;

  if (clienteHTTP.responseStatusCode() == 200) {
    valor_temperatura = clienteHTTP.responseBody().toFloat();
    Serial.print("Recebido valor da temperatura");
    Serial.println(valor_temperatura);
  } else {
    Serial.println("Erro na leitura da temperatura.");
  }

  clienteHTTP.get("192.168.88.244/smart-warehouse/api/api.php?ac=valor");
  int valor_ac;

  if (clienteHTTP.responseStatusCode() == 200) {
    valor_ac = clienteHTTP.responseBody().toInt();
    Serial.print("Recebido valor do ar condicionado");
  } else {
    Serial.println("Erro na leitura do ar condicionado.");
  }

  if (valor_ac == 2) {
    digitalWrite(LED_BUILTIN, LOW);
  }

  if (valor_ac == 3) {
    digitalWrite(LED_BUILTIN, HIGH);
  }

  if ((valor_temperatura > 20 || valor_temperatura < 10) && valor_ac != 2 && valor_ac != 3) {
    digitalWrite(LED_BUILTIN, HIGH);
    valor_ac = 1;
    valor_ac = valor_ac.toFloat();
    post2API("ac", valor_ac, datahora); // Resolver int -> float
  }

  clienteHTTP.get("192.168.88.244/smart-warehouse/api/api.php?portao=valor");
  int valor_portao;

  if (clienteHTTP.responseStatusCode() == 200) {
    valor_portao = clienteHTTP.responseBody().toInt();
    Serial.print("Recebido valor do portao");
  } else {
    Serial.println("Erro na leitura do portao.");
  }

  if (valor_portao == 0) {
    // Desliga LED portao
  }

  if (valor_portao == 1) {
    // Liga LED portao
  }

  //POSTS
  float luminosidade = dht.readLuminosidade(); // Ler sensor de Luminosidade
  int luz = 0;
  char luzNatural[20];

  if (luminosidade <= 50) {
    luz = 0;
    strcpy(luzNatural, "Fraca");
  }

  if (luminosidade > 50) {
    luz = 1;
    strcpy(luzNatural, "Boa");
  }

  Serial.print("Luminosidade: ");
  Serial.println(luminosidade);

  Serial.print("Luz: ");
  Serial.println(luzNatural);

  char datahora[20];
  update_time(datahora);
  Serial.print("Data Atual: ");
  Serial.println(datahora);

  post2API("luz", luz, datahora);

  delay(5000);
}