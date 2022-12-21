#include <ArduinoJson.h>
#include <SPI.h>
#include <MFRC522.h>
#include <Wire.h> 
#include <LiquidCrystal_I2C.h>
#include <Servo.h>
#define SS_PIN 10
#define RST_PIN 9

Servo myservo1;
Servo myservo2;
MFRC522 mfrc522(SS_PIN, RST_PIN);   // Create MFRC522 instance.
#define red A1
#define buzzer A2
int pos = 0;
int praces = 0;
int k=0;
LiquidCrystal_I2C lcd(0x27,20,4);  // set the LCD address to 0x27 for a 16 chars and 2 line display
int enters=0,balance=0;
boolean getID();
int res=0;
String tagID = "",data="";
void setup() 
{
  myservo1.attach(6);
  myservo2.attach(9);
  lcd.init();
  lcd.init();
  SPI.begin();  
  Serial.begin(9600);
  mfrc522.PCD_Init();
  lcd.backlight();
  lcd.clear();
  lcd.setCursor(0, 0);
  lcd.print("System starting");
  lcd.clear();
  lcd.setCursor(0,0);
  lcd.print("Smart car");
  lcd.setCursor(0,1);
  lcd.print("parking");
  myservo1.write(0);
  myservo2.write(0);
  delay(5000);
}

void loop() 
{
  stageone();
}

void stageone(){
  lcd.clear();
  lcd.setCursor(0,0);
  lcd.print("Tap your card");
  if (getID()){
  Serial.println((String)"card="+tagID);
  int my=0;
  Serial.println(data);
  while(my==0){
  if (Serial.available() > 0) {
    data = Serial.readStringUntil('\n');
    Serial.println(data);
    DynamicJsonBuffer jsonBuffer;
    JsonObject& root = jsonBuffer.parseObject(data);
    if(root["c"]){
    res=root["c"];
    if (res == 1){
        intake();
        } else if(res == 2){
            balance = root["balance"];
            lcd.clear();
            lcd.setCursor(0, 0);
            lcd.print("Balance:");
            lcd.print(balance);
            outertake();
          } else if(res == 3){
            nospace();
          } else if(res== 10){
          lowbalance();
          }
        }
    }
  }
  }
  delay(300);
}
    
boolean getID(){
  if(!mfrc522.PICC_IsNewCardPresent()){
    return false;
    }
  if(!mfrc522.PICC_ReadCardSerial()){
    return false;
    }
    tagID = "";
    for (uint8_t i = 0; i < 4; i++){
      tagID.concat(String(mfrc522.uid.uidByte[i], HEX));
      }
      tagID.toUpperCase();
      mfrc522.PICC_HaltA();
      return true;
}
void intake(){
  lcd.clear();
  lcd.setCursor(2, 0);
  lcd.print("Welcome");
  for (pos = 0; pos <= 90; pos += 1) {
    myservo1.write(pos);
    delay(15);
  }
  delay(5000);
  for (pos = 90; pos >= 0; pos -= 1) {
    myservo1.write(pos);
    delay(15);
  }
  stageone();
}
void outertake(){
  lcd.setCursor(0, 1);
  lcd.print("Thank you");
  for (pos = 0; pos <= 90; pos += 1) {
    myservo2.write(pos);
    delay(15);
  }
  delay(5000);
  for (pos = 90; pos >= 0; pos -= 1) {
    myservo2.write(pos);
    delay(15);
  }
  stageone();
}
void nospace(){
  lcd.clear();
  lcd.setCursor(0,0);
  lcd.print("No parking");
  lcd.setCursor(0,1);
  lcd.print("place available");
  digitalWrite(red,HIGH);
  tone(buzzer, 1000, 1000);
  delay(3000);
  digitalWrite(red,LOW);
  stageone();
}
void lowbalance(){
  lcd.clear();
  lcd.setCursor(0,0);
  lcd.print("Insufficient");
  lcd.setCursor(0,1);
  lcd.print("funds");
  digitalWrite(red,HIGH);
  tone(buzzer, 1000, 1000);
  delay(3000);
  digitalWrite(red,LOW);
  stageone();
}
