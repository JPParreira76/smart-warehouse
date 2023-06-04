#include <WiFi101.h>
#include <ArduinoHttpClient.h>
#include <DHT.h>
#include <NTPClient.h>
#include <WiFiUdp.h>  //Pré-instalada com o Arduino IDE
#include <TimeLib.h>

#define DHTPIN 0       // Pin Digital onde está ligado o sensor
#define DHTTYPE DHT11  // Tipo de sensor DHT

DHT dht(DHTPIN, DHTTYPE);  // Instanciar e declarar a class DHT

WiFiUDP clienteUDP; //Servidor de NTP do IPLeiria: ntp.ipleiria.pt //Fora do IPLeiria servidor: 0.pool.ntp.org

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
  // put your setup code here, to run once:
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

  float temperatura = dht.readTemperature();
  float humidade = dht.readHumidity();

  Serial.print("Temperatura: ");
  Serial.println(temperatura);

  Serial.print("Humidade: ");
  Serial.println(humidade);

  char datahora[20];
  update_time(datahora);
  Serial.print("Data Atual: ");
  Serial.println(datahora);

  post2API("temperatura", temperatura, datahora);
  post2API("humidade", humidade, datahora);

  delay(5000);

  //@ return 0 if successful,else error
  //int post(const char* aURLPath, const char* aContentType, const char* aBody);
  //int post(const String& aURLPath, const String& aContentType, const String& aBody);
  //int post(const char* aURLPath, const char* aContentType, int aContentLength, const byte aBody[]);
}