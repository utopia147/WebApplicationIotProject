#include <TridentTD_LineNotify.h>
#include <ESP8266WiFi.h>
#include <ESP8266HTTPClient.h>

#include <ArduinoJson.h>
#include <NTPClient.h>
#include <WiFiUdp.h>

//########################ตั้งค่า wifi และ webhost #######################
const char* ssid     = "Rawliet";
const char* password = "34073408";
const char* host = "192.168.0.103"; //replace it with your webhost url google cloud server 34.92.225.62 local 192.168.0.103
String path;

//#################################################
int timezone = 7 * 3600;                    //ตั้งค่า TimeZone ตามเวลาประเทศไทย
int dst = 0;     //กำหนดค่า Date Swing Time
WiFiUDP ntpUDP;
NTPClient timeClient(ntpUDP, "pool.ntp.org", timezone);     //ดึงเวลาจาก Server

//############ตัวแปรขาของบอร์ด################
int readyState = D0; // ขา D0 ไฟ led

int ch[] = {5, 4, 0, 2, 14, 12, 13, 10}; // ขา gpio
int taskcontrol = 100;
int tasktimecontrol =1000;
int tasklinenottify =1000;
int taskNodeAlive = 500;
unsigned long previousMilliscontrol = 0;
unsigned long previousMillistimecontrol = 0;
unsigned long previousMillislinenottify = 0;
unsigned long previousMillisline = 0;
unsigned long previousMillisNodeAlive = 0;
//##########################################

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
Serial.println(LINE.getVersion());

}
void loop() {

 
Serial.print("connecting to ");
Serial.println(host);
//############### object เชื่อมต่อเซิฟเวอร์ ########
WiFiClient client;
HTTPClient http;
Serial.print("[HTTP] begin...\n");
//###########################################
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


path = "/projectcontrol/api/control/read_all1.php?userid=16";
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
      String payload = http.getString();//รับค่าที่ respone มา
      
      Controltask(payload);
      Timetask(payload);
      Linenotify(payload);
    }//httpcode
  }//http.codeok
  else {
    Serial.printf("[HTTP] GET... failed, error: %s\n", http.errorToString(httpCode).c_str());
  }
  http.end();
}else {
  Serial.printf("[HTTP} Unable to connect\n");
}
//#######################Ndemcu updated status##############################
unsigned long currentMillisNode = millis();
 if(currentMillisNode - previousMillisNodeAlive >= taskNodeAlive){
    previousMillisNodeAlive = currentMillisNode;
      NodeMcuAlive ();
    }
    
Serial.println("DONE !");
Serial.println("closing connection");
//delay(5000);
}
//#############ฟังก์ชั่นเวลาปัจจุบันที่ดึงมาจาก ntp server#############
String NowTime() {
timeClient.update();
String Nowtime = timeClient.getFormattedTime();
String newNowTime = Nowtime.substring(0, 5);
return newNowTime;
}
//########task 1 #############
void Controltask(String payload) {
unsigned long currentMillis = millis();
if (currentMillis - previousMilliscontrol >= taskcontrol ){
  previousMilliscontrol = currentMillis;
  DynamicJsonDocument  doc(4048); // ประกาศ object json
      DeserializationError error = deserializeJson(doc, payload);
      if (error)
      {
        Serial.println("deserializeJson() failed with code Control");
        return;
      }
       int count = 0;
      for (int i = 0; i <= 7; i++) {
        String msgchannelid = doc[i]["channelid"];
        int channelid = msgchannelid.toInt();
        String msgchStatus = doc[i]["status"];
        int chStatus = msgchStatus.toInt();
        String stateOn = doc[i]["stateOn"];
        //Serial.println(stateOn);
        String timesetOn = doc[i]["timesetOn"];
        //Serial.println(timesetOn);
        String stateOff = doc[i]["stateOff"];
        //Serial.println(stateOff);
        String timesetOff = doc[i]["timesetOff"];
        //Serial.println(timesetOff);
         count++;

        //###########เช็คค่าที่เมื่อ channelid = count##############
        if (channelid == count) {
         /* Serial.print("CH");
          Serial.print(channelid);
          Serial.print(" is working State = ");
          Serial.println(chStatus);*/
          digitalWrite(ch[i], chStatus);
          //delay(50);
        }
      }
}
}
void Timetask(String respone) {

unsigned long currentMillis = millis();
if (currentMillis - previousMillistimecontrol >= tasktimecontrol ){
  previousMillistimecontrol = currentMillis;
      DynamicJsonDocument doc(4048); // ประกาศ object json
      DeserializationError error = deserializeJson(doc, respone);
      if (error)
      {
        Serial.println("deserializeJson() failed with code TIME");
        return;
      }
   int count = 0;// เช็คเงื่อนไข channel
      int ifcheck = 0; //เช็คเงื่อนไขตั้งเวลา
       WiFiClient client;
       HTTPClient http;
      for (int i = 0; i <= 7; i++) {
        String msgchannelid = doc[i]["channelid"];
        int channelid = msgchannelid.toInt();
        String msgchStatus = doc[i]["status"];
        int chStatus = msgchStatus.toInt();
        String stateOn = doc[i]["stateOn"];
        //Serial.println(stateOn);
        String timesetOn = doc[i]["timesetOn"];
        //Serial.println(timesetOn);
        String stateOff = doc[i]["stateOff"];
        //Serial.println(stateOff);
        String timesetOff = doc[i]["timesetOff"];
        //Serial.println(timesetOff);
        //Serial.print("timetask = ");
        //Serial.println(tasktimecontrol);
        count++;
         //#########################
         //#######เช็คค่าเวลาการตั้งเวลา สั่ง OFF ############
        if (stateOff == "1") {
          if (timesetOff == NowTime()) {
            ifcheck++;
           /* Serial.print("CH");
            Serial.print(channelid);
            Serial.print(" is working State = OFF Time = ");
            Serial.println(timesetOff);*/
            digitalWrite(ch[i], 0);

            String sendPath = "/projectcontrol/api/control/send_data.php";
            String sendUrl = host + sendPath;
            StaticJsonDocument<256> jsondoc;
            jsondoc["channelid"] = channelid;
            jsondoc["status"] = "0";
            jsondoc["alive"] = "0";
            char postdata[100];
            serializeJson(jsondoc, postdata);
            //Serial.println(postdata);

            http.begin(client, "http://" + sendUrl);
            http.addHeader("Content-Type", "application/json");
            int httpCode1 = http.POST(postdata);
            String payload1 = http.getString(); //Get the response payload
            //Serial.printf("[HTTP] POST... code: %d\n", httpCode1); //Print HTTP return code
             //Serial.println(payload1); //Print request response payload
            http.end(); //Close connection

          }

        }
      //###################################
       //#######เช็คค่าเวลาการตั้งเวลา สั่ง ON ############
        if (stateOn == "1") {
          if (timesetOn == NowTime()) {
            ifcheck++;
           /* Serial.print("CH");
            Serial.print(channelid);
            Serial.print(" is working State = ON Time = ");
            Serial.println(timesetOn);*/
            digitalWrite(ch[i], 1);
            String sendPath = "/projectcontrol/api/control/send_data.php";
            String sendUrl = host + sendPath;
            StaticJsonDocument<256> jsondoc2;
            jsondoc2["channelid"] = channelid;
            jsondoc2["status"] = "1";
            jsondoc2["alive"] = "0";
            
            char postdata2[100];
            serializeJson(jsondoc2, postdata2);
            //Serial.println(postdata2);

            http.begin(client, "http://" + sendUrl);
            http.addHeader("Content-Type", "application/json");
            int httpCode2 = http.POST(postdata2);
            String payload1 = http.getString(); //Get the response payload
            Serial.printf("[HTTP] POST... code: %d\n", httpCode2); //Print HTTP return code
            // Serial.println(payload1); //Print request response payload
            http.end(); //Close connection
          }
        }
        //#################################
        //##########เมื่อเงื่อนไขการตั้งเวลาเป็นจริงให้loop ทำงานจนถึง loop สุดท้ายแล้วสั่ง delay 1 นาที######
        if (ifcheck != 0) {
          if (i == 7) {
            tasktimecontrol = 60000;
          }
        }
        else{
           tasktimecontrol = 500;
          }
        //###############################################################
      }//for
}
}
void Linenotify (String respone){
  
     unsigned long currentMillis = millis();
if (currentMillis - previousMillislinenottify >= tasklinenottify ){
  previousMillislinenottify = currentMillis;
      DynamicJsonDocument doc(4048); // ประกาศ object json
      DeserializationError error = deserializeJson(doc, respone);
      if (error)
      {
        Serial.println("deserializeJson() failed with code LINE");
        return;
      }
      int count = 0;// เช็คเงื่อนไข channel
      int ifcheck = 0; //เช็คเงื่อนไขตั้งเวลา
      String msgchstatus;
       String msgstateon;
       String msgstateoff;
       for (int i = 0; i <= 7; i++) {
        String msgchannelid = doc[i]["channelid"];
        int channelid = msgchannelid.toInt();
        String msgchStatus = doc[i]["status"];
        int chStatus = msgchStatus.toInt();
        String stateOn = doc[i]["stateOn"];
        //Serial.println(stateOn);
        String timesetOn = doc[i]["timesetOn"];
        //Serial.println(timesetOn);
        String stateOff = doc[i]["stateOff"];
        //Serial.println(stateOff);
        String timesetOff = doc[i]["timesetOff"];
        //Serial.println(timesetOff);
        String msgnotifystate = doc[i]["notifystate"];
        int notifystate = msgnotifystate.toInt();
        String notifytimestamp = doc[i]["notifytimestamp"];
        String linetoken = doc[i]["linetoken"];
         String msgnotifytime = doc[i]["notifytime"];
        int notifytime = msgnotifytime.toInt();
        //Serial.println(notifytime);
         //Serial.println(currentMillis);
         //Serial.println(previousMillislinenottify);
         count++;
         if(notifystate == 1){
    unsigned long currentMillisLine = millis();
            if(currentMillisLine - previousMillisline  >= notifytime){
             
    
              /*Serial.print("i = ");
        Serial.println(i);
              Serial.println(notifytime);
         Serial.println(currentMillisLine);
         Serial.println(previousMillisline);*/
              ifcheck++;
              if(chStatus == 1){
                   msgchstatus = "ON";
                }
                else if (chStatus == 0){
                   msgchstatus = "OFF";
                  }
                  if(stateOn == "1"){
                   msgstateon = "ตั้งค่าเวลาสถานะแชแนล ON: \r\n เปิดใช้งาน";
                }
                else if (stateOn == "0"){
                  msgstateon = "ตั้งค่าเวลาสถานะแชแนล ON: \r\nปิดใช้งาน";
                  }
                  if(stateOff == "1"){  
                  msgstateoff = "ตั้งค่าเวลาสถานะแชแนล OFF: \r\nเปิดใช้งาน";
                }
                else if (stateOff == "0"){
                  msgstateoff = "ตั้งค่าเวลาสถานะแชแนล OFF: \r\nปิดใช้งาน";
                  }
             LINE.setToken(linetoken);
              if(ifcheck!=0){
                if(i == 0){
                  String firstname = doc[i]["fname"];
                  String lastname = doc[i]["lname"];
                  String saywelcome = "HEY :D ว่าไงคุณ "+firstname;
                         saywelcome+=" "+lastname;
                         saywelcome+="\r\n ขอแจ้งรายงานสถานะทั้งหมดดังนี้";
                         LINE.notify(saywelcome);
                  }
                   
              String sendLine = " Channel ที่ "+msgchannelid;
                     sendLine+="\r\n สถานะปัจบันของแชแนล : "+msgchstatus;
                     sendLine+="\r\n"+msgstateon;
                     sendLine+="\r\n เวลาการทำงาน : "+timesetOn;
                     sendLine+="\r\n "+msgstateoff;
                     sendLine+="\r\n เวลาการทำงาน : "+timesetOff;
              LINE.notify(sendLine);
              if(i==7){
                String webpath ="/projectcontrol/login.php";
                String website ="ควบคุมอุปกรณ์คลิ๊กที่ \r\nhttp://";
                       website+=host;
                       website+=webpath;
                      
                LINE.notify(website);
                int seconds = (int) (notifytime / 1000) % 60 ;
                int minutes = (int) ((notifytime / (1000*60)) % 60);
                int hours   = (int) ((notifytime / (1000*60*60)) % 24);
                char buf[21];
                sprintf(buf,"%02dh%02dm%02ds",hours ,minutes,seconds);
                String nextnotify = "จบการรายงานจะเริ่มทำการแจ้งรายงานให้ทราบ ในอีก ";
                       nextnotify +=buf;
                       nextnotify +=" ข้างหน้า";


                        LINE.notify(nextnotify);
                  previousMillisline = currentMillisLine;
                }
              }
            }
           }
       }//for
  }
 
}
void NodeMcuAlive (){
   
            WiFiClient client;
            HTTPClient http;
            String sendStatusPath = "/projectcontrol/api/control/send_data.php";
            String sendStatusUrl = host + sendStatusPath;
            StaticJsonDocument<256> jsondoc;
            jsondoc["NodeSayHi"] = "NodeMCU Connected";
            char postdata[100];
            serializeJson(jsondoc, postdata);
            //Serial.println(postdata);

            http.begin(client, "http://" + sendStatusUrl);
            http.addHeader("Content-Type", "application/json");
            int httpCodeStatus = http.POST(postdata);
            String payloadStatus = http.getString(); //Get the response payload
            Serial.printf("[HTTP] POST... code: %d\n", httpCodeStatus); //Print HTTP return code
             //Serial.println(payloadStatus); //Print request response payload
            http.end(); //Close connection
      
  }
