
#include <RBDdimmer.h>  //
#include <PZEM004Tv30.h>
#include <HTTPClient.h>
// #include <WiFiClientSecure.h>
#include <WiFi.h>
#include <BH1750.h>
#include <Wire.h>


#define RXD2 16 
#define TXD2 17

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
// const char* ssid = "MIKRO";
// const char* password = "1DEAlist";

void setup() {
  Serial.begin(9600);
  Serial2.begin(9600, SERIAL_8N1, RXD2, TXD2);
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
     Serial.println("GET : " + payload);  //Print request response payload
    

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
  postData = "lightValue=";
  postData += Lux;
  postData += "&powerValue=";
  postData += Power;

  link = "http://controllinglamp.site/kirim.php";
  // client.setInsecure();
  http.begin(client, link);
  http.addHeader("Content-Type", "application/x-www-form-urlencoded");

  int httpCode = http.POST(postData);  //Send the request
  String payload = http.getString();   //Get the response payload

  //Serial.println(httpCode);
  Serial.println("KIRIM : " + payload);  //Print request response payload
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
  Serial.println(outVal);
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
    // Power = -99;
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
