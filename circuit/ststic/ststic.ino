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
const int enter = 3;
const int outer = 2;
#define red A1
#define buzzer A2
int pos = 0;
int praces = 0;
int enterState = 0;
int outerState = 0;
int k=0;
LiquidCrystal_I2C lcd(0x27,20,4);  // set the LCD address to 0x27 for a 16 chars and 2 line display
int enters=0;
String card;
void setup() 
{
  myservo1.attach(6);
  myservo2.attach(9);
  pinMode(enter, OUTPUT);
  pinMode(outer, OUTPUT);
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
  lcd.print("car parking");
  delay(5000);
  lcd.clear();
  lcd.print("Tap your card");
  myservo1.write(0);
  myservo2.write(0);
  int d1=0;
  delay(5000);
}

void loop() 
{
  stageone();
}
void stageone(){
  lcd.clear();
  lcd.print("Tap your card");
  while(k==0){
    if(Serial.available() > 0) {
      //kwakira data zivuye kuri node mcu na server
    String data = Serial.readStringUntil('\n');
    Serial.println(data);
    DynamicJsonBuffer jsonBuffer;
    JsonObject& root = jsonBuffer.parseObject(data);
    int d1 = root["c"];
    if (d1 == 1) {
      intake();
    } else  if (d1 == 2) {
      outertake();
    } else if (d1 == 3) {
      nospace();
    } else if (d1 == 4) {
      lowbalance();
    }
    }
        }
  stageone();
  }
void(* resetFunc) (void) = 0;
  
void readcard(){
  // Look for new cards
  int i=0,j=0,m=0,x=0,s=0,money=0;
  lcd.clear();
  lcd.setCursor(0,0);
  lcd.print("Tap your card");
  delay(500);
  if ( ! mfrc522.PICC_IsNewCardPresent()) 
  {
    readcard();
  }
  if ( ! mfrc522.PICC_ReadCardSerial()) 
  {
    readcard();
  }
  String content= "";
  byte letter;
  for (byte i = 0; i < mfrc522.uid.size; i++) 
  {
     content.concat(String(mfrc522.uid.uidByte[i] < 0x10 ? " 0" : " "));
     content.concat(String(mfrc522.uid.uidByte[i], HEX));
  }
  content.toUpperCase();
  card=content.substring(1);
  //d1=random(1,3);
}
void nospace(){
  lcd.clear();
  lcd.setCursor(0,0);
  lcd.print("No space");
  lcd.setCursor(0,1);
  lcd.print("available");
  digitalWrite(red,HIGH);
  tone(buzzer, 1000, 1000);
  delay(3000);
  digitalWrite(red,LOW);
  lcd.clear();
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
  lcd.clear();
  stageone();
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
  lcd.clear();
  stageone();
}
void full(){
  lcd.clear();
  lcd.setCursor(0,0);
  lcd.print("No prace");
  lcd.setCursor(0,1);
  lcd.print("available");
  delay(2000);
  digitalWrite(red,HIGH);
  tone(buzzer, 1000, 1000);
  delay(3000);
  digitalWrite(red,LOW);
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
