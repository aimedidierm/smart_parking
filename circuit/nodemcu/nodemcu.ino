#include <ESP8266HTTPClient.h>
#include <ESP8266WiFi.h>
#include <ESP8266WebServer.h>
#include <ArduinoJson.h>
#include <SoftwareSerial.h>
SoftwareSerial s(3,1);
const char* ssid = "Virus";
const char* password = "mbega123455";
//String serverName = "http://137.184.232.255/smart_parking/data.php";
//String serverName = "http://didier.requestcatcher.com/";
String serverName = "http://192.168.43.76/smart_parking/data.php";
void setup() {
  s.begin(9600);
  WiFi.begin(ssid, password);
  while (WiFi.status() != WL_CONNECTED) {
    delay(500);
  }
}

void loop() {
  if (s.available() > 0) {
  WiFiClient client;
  HTTPClient http;
  String httpRequestData = s.readStringUntil('\n');
  //String httpRequestData = "?card=2456314562";
  String url = serverName + httpRequestData;
  http.begin(client, url);
  http.addHeader("Content-Type", "application/x-www-form-urlencoded");

  int httpCode = http.GET();
  delay(3000);
  String payload = http.getString();  // get data from webhost continously
  s.println(payload);
  http.end();
   }
}
