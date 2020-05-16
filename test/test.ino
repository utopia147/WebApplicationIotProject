int LEDD2 = D0; // ขา D0

void setup() {
  pinMode(LEDD2, OUTPUT); // กำหนดการทำงานของขา D0 ให้เป็น Output


  digitalWrite(LEDD2, LOW);

}
void loop()
{
  digitalWrite(LEDD2, HIGH); // สั่งให้ ขา D0 ปล่อยลอจิก 1 ไฟ LED ติด
  delay(50); // หน่วงเวลา 50mS
  
  digitalWrite(LEDD2, LOW);  // สั่งให้ ขา D0 ปล่อยลอจิก 0 ไฟ LED ดับ
  delay(50);
}
