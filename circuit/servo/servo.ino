#include <ESP8266WiFi.h>
#include <Servo.h>
#include <LiquidCrystal_I2C.h>
#include <Wire.h>


LiquidCrystal_I2C lcd(0x27, 16, 2);         //i2c display address 27 and 16x2 lcd display
Servo myservo;                          //servo as gate
Servo myservos;

int carEnter = D0;
int carExited = D4;
void setup() {
  // put your setup code here, to run once:

}

void loop() {
  // put your main code here, to run repeatedly:

}
void outgate(){}
void opengate(){}
