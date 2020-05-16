
#include <ESP8266WiFi.h>
#include <ESP8266WiFiMulti.h>
#include <WiFiClient.h>
#include <ESP8266HTTPClient.h>

#include <ArduinoJson.h>
#include <NTPClient.h>
#include <WiFiUdp.h>

//########################ตั้งค่า wifi และ webhost #######################
const char* ssid     = "BSRU_ALS";
const char* password = "wifi@bsru";
const char* host = "192.168.158.32"; //replace it with your webhost url
WiFiUDP ntpUDP;
String path;

//#################################################
int timezone = 7 * 3600;                    //ตั้งค่า TimeZone ตามเวลาประเทศไทย
int dst = 0;     //กำหนดค่า Date Swing Time
//############ตัวแปรขาของบอร์ด################
int readyState = D0; // ขา D0 ไฟ led

int ch[] = {5, 4, 0, 2, 14, 12, 13, 15}; // ขา gpio

//##########################################
NTPClient timeClient(ntpUDP, "pool.ntp.org", timezone);     //ดึงเวลาจาก Server
void setup() {

  Serial.begin(115200);
  delay(100);
  pinMode(readyState, OUTPUT);
  pinMode(ch[0], OUTPUT);
  pinMode(ch[1], OUTPUT);
  pinMode(ch[2], OUTPUT);
  pinMode(ch[3], OUTPUT);
  pinMode(ch[4], OUTPUT);
  pinMode(ch[5], OUTPUT);
  pinMode(ch[6], OUTPUT);
  pinMode(ch[7], OUTPUT);

  digitalWrite(ch[0], HIGH);
  digitalWrite(ch[1], HIGH);
  digitalWrite(ch[2], HIGH);
  digitalWrite(ch[3], HIGH);
  digitalWrite(ch[4], HIGH);
  digitalWrite(ch[5], HIGH);
  digitalWrite(ch[6], HIGH);
  digitalWrite(ch[7], HIGH);

  for (uint8_t t = 4; t > 0; t--) {
    Serial.printf("[SETUP] WAIT %d...\n", t);
    Serial.flush();
    delay(1000);
  }
  Serial.print("Connecting to ");
  Serial.println(ssid);

  WiFi.begin(ssid, password);
  while (WiFi.status() != WL_CONNECTED) {
    delay(500);
    Serial.print(".");
  }
  timeClient.begin();
  Serial.println("");
  Serial.println("WiFi connected");
  Serial.println("IP address: ");
  Serial.println(WiFi.localIP());
  Serial.print("Netmask: ");
  Serial.println(WiFi.subnetMask());
  Serial.print("Gateway: ");
  Serial.println(WiFi.gatewayIP());
  //digitalWrite(D1, 1);
  delay(500);
  //digitalWrite(D1, 0);
  delay(500);

}
void loop() {

  //###################### เชื่อมต่อเซิฟเวอร์ #####################
  Serial.print("connecting to ");
  Serial.println(host);

  WiFiClient client;

  HTTPClient http;
  Serial.print("[HTTP] begin...\n");

  const int httpPort = 80;
  if (!client.connect(host, httpPort)) {
    Serial.println("connection failed");
    return;
  }
  digitalWrite(readyState, HIGH);
  Serial.println("STATUS=READY");
  //###########################################
  Serial.print("Time = ");
  Serial.print(NowTime());
  Serial.println("");
  // #################reqeust##################


  path = "/projectcontrol/api/control/read_all1.php";
  String url = host + path;
  //Serial.println(url);

  if (http.begin(client, "http://" + url)) { // HTTP
    Serial.print("[HTTP] GET...\n");
    http.addHeader("Content-Type", "application/json"); //Specify content-type header
    int httpCode = http.GET();

    if (httpCode > 0) {
      // HTTP header has been send and Server response header has been handled
      Serial.printf("[HTTP] GET... code: %d\n", httpCode);
      // file found at server
      if (httpCode == HTTP_CODE_OK || httpCode == HTTP_CODE_MOVED_PERMANENTLY) {
        String payload = http.getString();
        DynamicJsonDocument doc(2048);
        DeserializationError error = deserializeJson(doc, payload);
        if (error)
        {
          Serial.println("deserializeJson() failed with code");
          return;
        }
        int count = 0;
        for (int n = 0; n <= 7; n++) {
          count++;
          Serial.print("n = ");
          Serial.println(n);
          String msgchannelid = doc[n]["channelid"];
          int channelid = msgchannelid.toInt();
          String msgchStatus = doc[n]["status"];
          int chStatus = msgchStatus.toInt();
          if (channelid == count) {
            Serial.print("CH");
            Serial.print(count);
            Serial.print(" is working State = ");
            Serial.println(chStatus);
            digitalWrite(ch[n], chStatus);
            //value1=1,value1=0;
            delay(50);
          }

        }
        int ifcheck = 0;
        for (int i = 0; i <= 7; i++) {
          String msgchannelid = doc[i]["channelid"];
          int channelid = msgchannelid.toInt();
          String stateOn = doc[i]["stateOn"];
          //Serial.println(stateOn);
          String timesetOn = doc[i]["timesetOn"];
          //Serial.println(timesetOn);
          String stateOff = doc[i]["stateOff"];
          //Serial.println(stateOff);
          String timesetOff = doc[i]["timesetOff"];
          //Serial.println(timesetOff);
          Serial.print("i = ");
          Serial.println(i);


          if (stateOff == "1") {
            if (timesetOff == NowTime()) {

              ifcheck++;
              Serial.print("CH");
              Serial.print(channelid);
              Serial.print(" is working State = OFF Time = ");
              Serial.println(timesetOff);
              digitalWrite(ch[i], 0);

              String sendPath = "/projectcontrol/api/control/send_data.php";
              String sendUrl = host + sendPath;
              StaticJsonDocument<256> jsondoc;
              jsondoc["channelid"] = channelid;
              jsondoc["status"] = "0";
              jsondoc["statuslog"] = "OFF";
              char postdata[100];
              serializeJson(jsondoc, postdata);
              Serial.println(postdata);

              http.begin(client, "http://" + sendUrl);
              http.addHeader("Content-Type", "application/json");
              int httpCode1 = http.POST(postdata);
              String payload1 = http.getString(); //Get the response payload
              Serial.printf("[HTTP] POST... code: %d\n", httpCode1); //Print HTTP return code
               Serial.println(payload1); //Print request response payload
              http.end(); //Close connection

            }

          }


          if (stateOn == "1") {
            if (timesetOn == NowTime()) {
              ifcheck++;
              Serial.print("CH");
              Serial.print(channelid);
              Serial.print(" is working State = ON Time = ");
              Serial.println(timesetOn);
              digitalWrite(ch[i], 1);
              String sendPath = "/projectcontrol/api/control/send_data.php";
              String sendUrl = host + sendPath;
              StaticJsonDocument<256> jsondoc2;
              jsondoc2["channelid"] = channelid;
              jsondoc2["status"] = "1";
              jsondoc2["statuslog"] = "ON";
              char postdata2[100];
              serializeJson(jsondoc2, postdata2);
              Serial.println(postdata2);

              http.begin(client, "http://" + sendUrl);
              http.addHeader("Content-Type", "application/json");
              int httpCode2 = http.POST(postdata2);
              String payload1 = http.getString(); //Get the response payload
              Serial.printf("[HTTP] POST... code: %d\n", httpCode2); //Print HTTP return code
               Serial.println(payload1); //Print request response payload
              http.end(); //Close connection
            }
          }
          if (ifcheck != 0) {
            if (i == 7) {
              delay(60000);
            }
          }
        }
      }
    }
    else {
      Serial.printf("[HTTP] GET... failed, error: %s\n", http.errorToString(httpCode).c_str());
    }
    http.end();
  } else {
    Serial.printf("[HTTP} Unable to connect\n");
  }
  //#####################################################

  Serial.println();
  Serial.println("closing connection");
  //delay(5000);
}
//#############Time#############
String NowTime() {
  timeClient.update();
  String Nowtime = timeClient.getFormattedTime();
  String newNowTime = Nowtime.substring(0, 5);
  return newNowTime;
}
