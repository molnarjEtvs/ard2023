#include <ESP8266WiFi.h>
#include <ESP8266HTTPClient.h>
#include <ESP8266WebServer.h>


#define ssid "Cisco3"
#define password "Eotvos2023"

int buzzer = D1;
int led = D2;
int allapot = 0;

ESP8266WebServer webserver(80);

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


  pinMode(led,OUTPUT);
  pinMode(buzzer,OUTPUT);


  webserver.on("/hello",hello);
  webserver.on("/riasztas", HTTP_POST, [](){
    int allapot = webserver.arg("allapot").toInt();
  });
  webserver.begin();

}

void loop() {
  webserver.handleClient();
  riasztasKapcsolas(allapot);
  delay(1000);
}

void hello(){
  webserver.send(200,"text/html","<h1>HELLO</h1>");
}

void riasztasKapcsolas(int allapot){
  if(allapot == 1){
    digitalWrite(led,HIGH);
    digitalWrite(buzzer,HIGH);
    delay(500);
    digitalWrite(buzzer,LOW);
    digitalWrite(led,LOW);
    delay(500);
    webserver.send(200,"application/json","{'msg':'bekapcsolva'}");
  }else{
    digitalWrite(buzzer,LOW);
    digitalWrite(led,LOW);
    webserver.send(200,"application/json","{'msg':'lekapcsol'}");
  }
  
}






