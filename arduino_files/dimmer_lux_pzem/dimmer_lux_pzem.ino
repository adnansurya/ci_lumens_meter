/**************
 *    
 * 
 *  ---------------------- OUTPUT & INPUT Pin table ---------------------
 *  +---------------+-------------------------+-------------------------+
 *  |   Board       | INPUT Pin               | OUTPUT Pin              |
 *  |               | Zero-Cross              |                         |
 *  +---------------+-------------------------+-------------------------+
 *  | Lenardo       | D7 (NOT CHANGABLE)      | D0-D6, D8-D13           |
 *  +---------------+-------------------------+-------------------------+
 *  | Mega          | D2 (NOT CHANGABLE)      | D0-D1, D3-D70           |
 *  +---------------+-------------------------+-------------------------+
 *  | Uno           | D2 (NOT CHANGABLE)      | D0-D1, D3-D20           |
 *  +---------------+-------------------------+-------------------------+
 *  | ESP8266       | D1(IO5),    D2(IO4),    | D0(IO16),   D1(IO5),    |
 *  |               | D5(IO14),   D6(IO12),   | D2(IO4),    D5(IO14),   |
 *  |               | D7(IO13),   D8(IO15),   | D6(IO12),   D7(IO13),   |
 *  |               |                         | D8(IO15)                |
 *  +---------------+-------------------------+-------------------------+
 *  | ESP32         | 4(GPI36),   6(GPI34),   | 8(GPO32),   9(GP033),   |
 *  |               | 5(GPI39),   7(GPI35),   | 10(GPIO25), 11(GPIO26), |
 *  |               | 8(GPO32),   9(GP033),   | 12(GPIO27), 13(GPIO14), |
 *  |               | 10(GPI025), 11(GPIO26), | 14(GPIO12), 16(GPIO13), |
 *  |               | 12(GPIO27), 13(GPIO14), | 23(GPIO15), 24(GPIO2),  |
 *  |               | 14(GPIO12), 16(GPIO13), | 25(GPIO0),  26(GPIO4),  |
 *  |               | 21(GPIO7),  23(GPIO15), | 27(GPIO16), 28(GPIO17), |
 *  |               | 24(GPIO2),  25(GPIO0),  | 29(GPIO5),  30(GPIO18), |
 *  |               | 26(GPIO4),  27(GPIO16), | 31(GPIO19), 33(GPIO21), |
 *  |               | 28(GPIO17), 29(GPIO5),  | 34(GPIO3),  35(GPIO1),  |
 *  |               | 30(GPIO18), 31(GPIO19), | 36(GPIO22), 37(GPIO23), |
 *  |               | 33(GPIO21), 35(GPIO1),  |                         |
 *  |               | 36(GPIO22), 37(GPIO23), |                         |
 *  +---------------+-------------------------+-------------------------+
 *  | Arduino M0    | D7 (NOT CHANGABLE)      | D0-D6, D8-D13           |
 *  | Arduino Zero  |                         |                         |
 *  +---------------+-------------------------+-------------------------+
 *  | Arduino Due   | D0-D53                  | D0-D53                  |
 *  +---------------+-------------------------+-------------------------+
 *  | STM32         | PA0-PA15,PB0-PB15       | PA0-PA15,PB0-PB15       |
 *  | Black Pill    | PC13-PC15               | PC13-PC15               |
 *  | BluePill      |                         |                         |
 *  | Etc...        |                         |                         |
 *  +---------------+-------------------------+-------------------------+
 */

#include <RBDdimmer.h>  //
#include <PZEM004Tv30.h>
#include <HTTPClient.h>
// #include <WiFiClientSecure.h>
#include <WiFi.h>
#include <BH1750.h>
#include <Wire.h>


#if !defined(PZEM_RX_PIN) && !defined(PZEM_TX_PIN)
#define PZEM_RX_PIN 16
#define PZEM_TX_PIN 17
#endif

#if !defined(PZEM_SERIAL)
#define PZEM_SERIAL Serial2
#endif

#if defined(ESP32)
PZEM004Tv30 pzem(PZEM_SERIAL, PZEM_RX_PIN, PZEM_TX_PIN);
#elif defined(ESP8266)
#else
PZEM004Tv30 pzem(PZEM_SERIAL);
#endif

//#define USE_SERIAL  SerialUSB //Serial for boards whith USB serial port
#define USE_SERIAL Serial
#define outputPin 2
#define zerocross 4  // for boards with CHANGEBLE input pins
#define mati -1


dimmerLamp dimmer(outputPin, zerocross);  //initialase port for dimmer for ESP8266, ESP32, Arduino due boards
// dimmerLamp dimmer(outputPin); //initialase port for dimmer for MEGA, Leonardo, UNO, Arduino M0, Arduino Zero
WiFiClient client;
BH1750 lightMeter;
int outVal = 0;
float Lux = 0;
float Power = 0;

const char* ssid = "kontras";
const char* password = "12345678";

void setup() {
  USE_SERIAL.begin(9600);
  Wire.begin();
  lightMeter.begin();
  Serial.println(F("BH1750 Test begin"));
  WiFi.mode(WIFI_OFF);  //Prevents reconnection issue (taking too long to connect)
  delay(1000);
  WiFi.mode(WIFI_STA);
  // WiFi.hostname("IoTHidroponik");
  WiFi.begin(ssid, password);
  //WiFi.config(ip, gateway, subnet);

  while (WiFi.status() != WL_CONNECTED) {
    delay(1000);
    Serial.print(".");
    // lcd.setCursor(16, 1);
    // lcd.write(byte(0));
    // delay(200);
    // lcd.setCursor(16, 1);
    // lcd.write(byte(1));
    // delay(200);
    // lcd.setCursor(16, 1);
    // lcd.write(byte(2));
    // delay(200);
    // lcd.setCursor(16, 1);
    // lcd.write(byte(1));
    // delay(200);
    // lcd.setCursor(16, 1);
    // lcd.write(byte(0));
    // lcd.setCursor(18, 0);
    // lcd.write(byte(3));
  }
  // lcd.clear();
  // lcd.home();
  // lcd.print(" Sistem Hidroponik ");
  // lcd.setCursor(0, 1);
  // lcd.print("Connected To WiFi");
  // lcd.setCursor(18, 1);
  // lcd.write(byte(3));
  // lcd.setCursor(0, 2);
  // lcd.print("IP:");
  // lcd.setCursor(3, 2);
  // lcd.print(WiFi.localIP());
  // delay(2000);
  // lcd.clear();
  Serial.print("Connected");
  dimmer.begin(NORMAL_MODE, ON);  //dimmer initialisation: name.begin(MODE, STATE)
}

void control() {
  HTTPClient http;

  // Alamat URL skrip PHP pada server web Anda
  String serverUrl = "http://controllinglamp.site/tes.php";  // Ganti dengan URL yang sesuai
  // client.setInsecure();
  // Kirim permintaan GET ke skrip PHP
  int httpCode = http.begin(client, serverUrl);
  httpCode = http.GET();

  // Jika permintaan berhasil, lanjutkan untuk membaca data yang diterima
  if (httpCode == HTTP_CODE_OK) {
    String payload = http.getString();  // Baca data dari respon

    // Parsing data query string yang diterima
    outVal = getValueFromQueryString(payload, "nilai1").toInt();

    // Lakukan sesuatu dengan nilai-nilai yang diterima, misalnya menyimpannya di EEPROM
    // writeDataToEEPROM(nilai1);
    // writeDataToEEPROM(nilai2);
    // writeDataToEEPROM(nilai3);
    // writeDataToEEPROM(nilai4);

    // Debugging: Tampilkan nilai-nilai yang diterima di Serial Monitor
    // Serial.print("Received values: ");
    // Serial.print(nilai1);
    // Serial.print(", ");
    // Serial.print(nilai2);
    // Serial.print(", ");
    // Serial.print(nilai3);
    // Serial.print(", ");
    // Serial.println(nilai4);
  } else {
    Serial.println("HTTP request failed");
  }

  http.end();  // Selesai menggunakan objek HTTPClient

  // Tunggu sebelum mengambil data dari server kembali
  delay(1000);
}

void kirimDataKeServer() {
  HTTPClient http;  //Declare object of class HTTPClient
  String postData;
  String link;
  //Post Data
  postData = "phValue=";
  postData += Lux;
  postData += "&tdsValue=";
  postData += Power;

  link = "http://controllinglamp.site/kirim.php";
  // client.setInsecure();
  http.begin(client, link);
  http.addHeader("Content-Type", "application/x-www-form-urlencoded");

  int httpCode = http.POST(postData);  //Send the request
  String payload = http.getString();   //Get the response payload

  //Serial.println(httpCode);
  Serial.println(payload);  //Print request response payload
  if (httpCode == 200) {
    Serial.println("send succes");
  } else {
    Serial.println("send failed");
  }

  http.end();
}

String getValueFromQueryString(String data, String key) {
  String keyEquals = key + "=";
  int position = data.indexOf(keyEquals);
  if (position != -1) {
    int start = position + keyEquals.length();
    int end = data.indexOf("&", start);
    if (end == -1) {
      end = data.length();
    }
    return data.substring(start, end);
  }
  return "";
}

void Dim() {
  control();
  if (outVal <= 2) {
    dimmer.setPower(mati);  // name.setPower(0%-100%)
  } else {
    dimmer.setPower(outVal);  // name.setPower(0%-100%)
  }
  USE_SERIAL.println(outVal);
}

void Light() {
  Lux = lightMeter.readLightLevel();
  Serial.print("Light: ");
  Serial.print(Lux);
  Serial.println(" lx");
}

void Daya() {
  Power = pzem.power();
  if (isnan(Power)) {
    Serial.println("Listrik Tidak Terdeteksi");
  } else {
    if (Power <= 1.30) {
      Power = 0;
    }
    Serial.print("Power : ");
    Serial.print(Power);
    Serial.println("W");
  }
}



void loop() {
  Dim();
  Light();
  Daya();
  kirimDataKeServer();
}
