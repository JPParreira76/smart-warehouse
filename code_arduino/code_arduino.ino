#include <WiFi101.h>
#include <ArduinoHttpClient.h>
#include <DHT.h>
#include <NTPClient.h>
#include <WiFiUdp.h>  // Pré-instalada com o Arduino IDE
#include <TimeLib.h>


const int ldrPin = A1;  // S=A1 Middle=VCC -=GND 

WiFiUDP clienteUDP; 
char NTP_SERVER[] = "0.pool.ntp.org"; //Servidor de NTP do IPLeiria: ntp.ipleiria.pt //Fora do IPLeiria servidor: 0.pool.ntp.org
NTPClient timeClient(clienteUDP, NTP_SERVER, 3600);

char SSID[] = "labs_lrsc";
char PASS_WIFI[] = "robot1cA!ESTG";
char URL[] = "10.79.12.2";
int PORTO = 80;

WiFiClient clienteWifi;
HttpClient clienteHTTP = HttpClient(clienteWifi, URL, PORTO);

// Funções
void post2API(String nome, int valor, String hora) {

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

// Setup
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

  pinMode(LED_BUILTIN, OUTPUT); // LED Ar Condicionado Builtin

  pinMode(0, OUTPUT); // LED Portao GND PIN 0

}

// Loop
void loop() {

  char datahora[20];
  update_time(datahora);
  Serial.print("Data Atual: ");
  Serial.println(datahora);

  // Temperatura e Ar Condicionado
  clienteHTTP.get("/smart-warehouse/api/api.php?nome=temperatura");
  int valor_temperatura;

  if (clienteHTTP.responseStatusCode() == 200) {
    valor_temperatura = clienteHTTP.responseBody().toInt();
    Serial.print("Recebido valor da temperatura: ");
    Serial.println(valor_temperatura);
  } else {
    Serial.println("Erro na leitura da temperatura.");
  }

  clienteHTTP.get("/smart-warehouse/api/api.php?nome=ac");
  int valor_ac;

  if (clienteHTTP.responseStatusCode() == 200) {
    valor_ac = clienteHTTP.responseBody().toInt();
    Serial.print("Recebido valor do ar condicionado: ");
    Serial.println(valor_ac);
  } else {
    Serial.println("Erro na leitura do ar condicionado.");
  }

  if ((valor_temperatura > 15 || valor_temperatura < 5) && valor_ac != 2 && valor_ac != 3) {
    digitalWrite(LED_BUILTIN, HIGH);
    valor_ac = 1;
    post2API("ac", valor_ac, datahora);
  }

  if (valor_ac == 2) {
    digitalWrite(LED_BUILTIN, LOW);
  }

  if (valor_ac == 3) {
    digitalWrite(LED_BUILTIN, HIGH);
  }

  // Portão
  clienteHTTP.get("/smart-warehouse/api/api.php?nome=portao");
  int valor_portao;

  if (clienteHTTP.responseStatusCode() == 200) {
    valor_portao = clienteHTTP.responseBody().toInt();
    Serial.print("Recebido valor do portao: ");
    Serial.println(valor_portao);
  } else {
    Serial.println("Erro na leitura do portao.");
  }

  if (valor_portao == 0) {
    digitalWrite(0, LOW);
  }

  if (valor_portao == 1) {
    digitalWrite(0, HIGH);
  }

  // LDR
  int luminosidade = analogRead(ldrPin);
  int luz = 0;
  char luzNatural[20];

  if (luminosidade >= 512) {
    luz = 0;
    strcpy(luzNatural, "Fraca");
  }

  if (luminosidade < 512) {
    luz = 1;
    strcpy(luzNatural, "Boa");
  }

  Serial.print("Luminosidade: ");
  Serial.println(luminosidade);

  Serial.print("Luz: ");
  Serial.println(luzNatural);

  post2API("luz", luz, datahora);

  // Tempo entre loops
  delay(500);
}

