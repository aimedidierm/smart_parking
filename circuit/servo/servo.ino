#include <LiquidCrystal_I2C.h>
#include <Servo.h>

Servo myservo1;
Servo myservo2;
int lcdColumns = 16;
int lcdRows = 2;
const int enter = 3;
const int outer = 2;
LiquidCrystal_I2C lcd(0x27, lcdColumns, lcdRows);


int pos = 0;

int enterState = 0;
int outerState = 0;
void setup() {
  myservo1.attach(6);
  myservo2.attach(9);
  pinMode(enter, OUTPUT);
  pinMode(outer, OUTPUT);
  // initialize LCD
  lcd.init();
  // turn on LCD backlight
  lcd.backlight();
  // print message
  lcd.setCursor(2, 0);
  lcd.print("Smart car");
  lcd.setCursor(5, 1);
  lcd.print("parking");
  delay(3000);
  lcd.clear();
  Serial.begin(9600);
  myservo1.write(0);
  myservo2.write(0);
}

void loop() {
  enterState = digitalRead(enter);
  outerState = digitalRead(outer);
  
  if (enterState == HIGH) {
    intake();
  }
  if (outerState == HIGH) {
    outertake();
  }
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
}
void outertake(){
  lcd.clear();
  lcd.setCursor(0, 1);
  lcd.print("Thank you");
  lcd.setCursor(0, 0);
  lcd.print("Balance:");
  for (pos = 0; pos <= 90; pos += 1) {
    myservo2.write(pos);
    delay(15);
  }
  delay(5000);
  for (pos = 90; pos >= 0; pos -= 1) {
    myservo2.write(pos);
    delay(15);
  }
}
