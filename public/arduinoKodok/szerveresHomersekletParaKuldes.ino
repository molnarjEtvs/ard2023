#include "DHT.h"
#include <ESP8266WiFi.h>
#include <ESP8266HTTPClient.h>

#define DHTPIN 5
#define DHTTYPE DHT11
#define ssid "Cisco3"
#define password "Eotvos2023"

DHT dht(DHTPIN,DHTTYPE);
IPAddress subnet(255,255,0,0);
IPAddress gateway(192,168,1,95);
IPAddress local_IP(192,168,12,20); //20 helyére amit mondtam
IPAddress dns1(8,8,8,8);
IPAddress dns2(192,168,100,150);
HTTPClient httpClient;
WiFiClient client;

void setup() {
  // put your setup code here, to run once:
  Serial.begin(115200);
  dht.begin();

  if(WiFi.config(local_IP,gateway,subnet,dns1,dns2)){
    Serial.println("Statikus IP konfigurálva");
  }else{
    Serial.println("Statikus IP SIKERTELEN!!!");
  }

  WiFi.begin(ssid,password);
  Serial.print("Csatlakozás....");
  while(WiFi.status() != WL_CONNECTED){
    Serial.print(".");
    delay(500);
  }

  Serial.println("");
  Serial.println("Wifi kapcsolodas Sikeres!");
  Serial.println(WiFi.localIP());

}

void loop() {
  delay(10000);

   float h= dht.readHumidity();
  float tC= dht.readTemperature();
  float tF= dht.readTemperature(true);

  if (isnan(h) || isnan(tC) || isnan(tF)){
    Serial.println("Sikertelen olvasás, ellenőrizd a kábeleket");
  }else{
    Serial.print("Páratartalom: ");
    Serial.print(h);
    Serial.print("%");
    Serial.print("  ||  ");
    Serial.print("Hőmérséklet: ");
    Serial.print(tC);
    Serial.print("C  ");
    Serial.print(tF);
    Serial.println("F");  
    homersekletKuldes(tC, h);
    }
}

void homersekletKuldes(float hofok, float para){
  const char *URL = "http://192.168.21.158/ard2023/public/api/homerseklet/beszuras";
  String data = "homerseklet="+String(hofok)+"&paratartalom="+String(para);
  httpClient.begin(client,URL);
  httpClient.addHeader("Content-Type","application/x-www-form-urlencoded");
  httpClient.POST(data);
  String content = httpClient.getString();
  httpClient.end();
  Serial.print("RESPONSE: ");
  Serial.println(content);

}







