#include <ESP8266WiFi.h>
#include <ArduinoJson.h>
#include <time.h>

//########################ตั้งค่า wifi และ webhost #######################
const char* ssid     = "HUAWEIiot";
const char* password = "024822822";
const char* host = "192.168.43.225"; //replace it with your webhost url
String path;
int count = 0;
//#################################################
int timezone = 7 * 3600;                    //ตั้งค่า TimeZone ตามเวลาประเทศไทย
int dst = 0;     //กำหนดค่า Date Swing Time
//############ตัวแปรขาของบอร์ด################
int readyState = D0; // ขา D0 ไฟ led

int ch1 = D1; // ขา D1
int ch2 = D2; // ขา D2
int ch3 = D3; // ขา D3
int ch4 = D4; // ขา D4
int ch5 = D5; // ขา D4
int ch6 = D6; // ขา D4
int ch7 = D7; // ขา D4
int ch8 = D8; // ขา D4
//##########################################
void setup() {
  Serial.begin(9600);
  delay(100);
  pinMode(readyState, OUTPUT);
  pinMode(ch1, OUTPUT);
  pinMode(ch2, OUTPUT);
  pinMode(ch3, OUTPUT);
  pinMode(ch4, OUTPUT);
  pinMode(ch5, OUTPUT);
  pinMode(ch6, OUTPUT);
  pinMode(ch7, OUTPUT);
  pinMode(ch8, OUTPUT);

  digitalWrite(ch1, HIGH);
  digitalWrite(ch2, HIGH);
  digitalWrite(ch3, HIGH);
  digitalWrite(ch4, HIGH);
  digitalWrite(ch5, HIGH);
  digitalWrite(ch6, HIGH);
  digitalWrite(ch7, HIGH);
  digitalWrite(ch8, HIGH);

  Serial.println();
  Serial.println();
  Serial.print("Connecting to ");
  Serial.println(ssid);

  WiFi.begin(ssid, password);
  while (WiFi.status() != WL_CONNECTED) {
    delay(500);
    Serial.print(".");
  }

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

  configTime(timezone, dst, "pool.ntp.org", "time.nist.gov");     //ดึงเวลาจาก Server
  Serial.println("\nWaiting for time");
  while (!time(nullptr)) {
    Serial.print(".");
    delay(1000);
  }


}
void loop() {
  //###################### เชื่อมต่อเซิฟเวอร์ #####################
  Serial.print("connecting to ");
  Serial.println(host);

  WiFiClient client;
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
  // Serial.println(p_tm->tm_hour->tm_min->tm_sec);
  // delay(1000);
  // #################reqeust##################

  
    path = "/projectcontrol/api/control/read_all1.php";

    //Serial.println("Here1");
  

  client.print(String("GET ") + path + " HTTP/1.1\r\n" +
               "Host: " + host + "\r\n" +
               "Connection: close\r\n\r\n");
  delay(500);
  //#####################################################

  String section = "header";
  while (client.available()) {
    String line = client.readStringUntil('\r');
    //Serial.print(line);
    // we’ll parse the HTML body here
    if (section == "header") { // headers..

      if (line == "\n") { // skips the empty space at the beginning
        section = "json";
      }
    }
    else if (section == "json") { // print the good stuff
      section = "ignore";
      String result = line.substring(1);
      //Serial.println(result);
      // Parse JSON
      int size = result.length() + 1;
      Serial.println(size);
      char json[size];

      result.toCharArray(json, size);
      DynamicJsonDocument doc(1024);
      DeserializationError error = deserializeJson(doc, json);
      //JsonObject& json_parsed = jsonBuffer.parseObject(json);
      if (error)
      {
        Serial.println("deserializeJson() failed with code");
        return;
      }
      for(int i = 0; i<=7; i++){

      //int channelid = int(doc[i]["channelid"]);
      String channelid = doc[i]["channelid"];
      String chStatus = doc[i]["status"];
      
      Serial.println(channelid);
      Serial.println(chStatus);
      //if (channelid == 1) {
      if (channelid == "1") {
        delay(1000);
       // digitalWrite(ch1, int(value1));
       //value1=1,value1=0;
        
        if (chStatus == "ON") {
          digitalWrite(ch1, 1);
          Serial.println("ch1 is On..!");
        }
        else if (chStatus == "OFF") {
          digitalWrite(ch1, 0);
          Serial.println("ch1 is Off..!");
          // Serial.println("D1 is Off..!");
        }
        
      }
      else if (channelid == "2") {
        delay(1000);
        if (chStatus == "ON") {

          digitalWrite(ch2, 1);
          Serial.println("ch2 is On..!");
        }
        else if (chStatus == "OFF") {
          digitalWrite(ch2, 0);
          Serial.println("ch2 is Off..!");
        }
      }
      else if (channelid == "3") {
        delay(1000);
        if (chStatus == "ON") {

         digitalWrite(ch3, 1);
          Serial.println("ch3 is On..!");
        }
        else if (chStatus == "OFF") {
          digitalWrite(ch3, 0);
          Serial.println("ch3 is Off..!");
        }
      }
      else if (channelid == "4") {
        delay(1000);
        if (chStatus == "ON") {

          digitalWrite(ch4, 1);
          Serial.println("ch4 is On..!");
        }
        else if (chStatus == "OFF") {
          digitalWrite(ch4, 0);
          Serial.println("ch4 is Off..!");
        }
      }
      else if (channelid == "5") {
        delay(1000);
        if (chStatus == "ON") {

          digitalWrite(ch5, 1);
          Serial.println("ch5 is On..!");
        }
        else if (chStatus == "OFF") {
          digitalWrite(ch5, 0);
          Serial.println("ch5 is Off..!");
        }
      }
      else if (channelid == "6") {
        delay(1000);
        if (chStatus == "ON") {

          digitalWrite(ch6, 1);
          Serial.println("ch6 is On..!");
        }
        else if (chStatus == "OFF") {
          digitalWrite(ch6, 0);
          Serial.println("ch6 is Off..!");
        }
      }
      else if (channelid == "7") {
        delay(1000);
        if (chStatus == "ON") {

          digitalWrite(ch7, 1);
          Serial.println("ch7 is On..!");
        }
        else if (chStatus == "OFF") {
          digitalWrite(ch7, 0);
          Serial.println("ch7 is Off..!");
        }
      }
      else if (channelid == "8") {
        delay(1000);
        if (chStatus == "ON") {
          digitalWrite(ch8, 1);
          Serial.println("ch8 is On..!");
        }
        else if (chStatus == "OFF") {
          digitalWrite(ch8, 0);
          Serial.println("ch8 is Off..!");
        }
      }
    }
  }
  }
  Serial.println();
  Serial.println("closing connection");
  delay(1000);
}
//#############Time#############
String NowTime() {
  time_t now = time(nullptr);
  struct tm* p_tm = localtime(&now);
  String timeNow = "";
  timeNow += String(p_tm->tm_hour);
  timeNow += ":";
  timeNow += String(p_tm->tm_min);
  return timeNow;
}
