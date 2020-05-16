#include <ESP8266WiFi.h>
#include <ArduinoJson.h>
#include <time.h>

//########################ตั้งค่า wifi และ webhost #######################
const char* ssid     = "Rawliet";
const char* password = "34073408";
const char* host = "192.168.1.34"; //replace it with your webhost url
String path;

//#################################################
int timezone = 7 * 3600;                    //ตั้งค่า TimeZone ตามเวลาประเทศไทย
int dst = 0;     //กำหนดค่า Date Swing Time
//############ตัวแปรขาของบอร์ด################
int readyState = D0; // ขา D0 ไฟ led

int ch[] = {5,4,0,2,14,12,13,15}; // ขา D1

//##########################################
void setup() {
  Serial.begin(9600);
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
          
  delay(50);
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
      //Serial.print("result = ");
      //Serial.println(result);
      // Parse JSON
      int size = result.length() + 1;
      //Serial.print("Size = ");
      //Serial.println(size);
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
      int count = 0;
      for(int i = 0; i<=7; i++){
        
      count++;
      //int channelid = int(doc[i]["channelid"]);
      String msgchannelid = doc[i]["channelid"];
      int channelid = msgchannelid.toInt();
      String msgchStatus = doc[i]["status"];
      int chStatus = msgchStatus.toInt();
      //Serial.print("Loop = ");
      //Serial.println(count);
      //Serial.println(channelid);
      //Serial.println(chStatus);
      //if (channelid == count) {
      if (channelid == count) {
          Serial.print("CH");
          Serial.print(count);
          Serial.print(" is working State = ");
          Serial.println(chStatus);
        digitalWrite(ch[i], chStatus);
       //value1=1,value1=0;
        delay(50);
    }
  }
  }
  }
  
  Serial.println();
  Serial.println("closing connection");
  client.stop();
  delay(100);
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
