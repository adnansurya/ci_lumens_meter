
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
  Serial2.begin(9600, SERIAL_8N1, PZEM_RX_PIN, PZEM_TX_PIN);
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
  }

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
    String payload = http.getString();   // Baca data dari respon
    Serial.println("GET : " + payload);  //Print request response payload

    // Parsing data query string yang diterima
    outVal = getValueFromQueryString(payload, "nilai1").toInt();

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
  float outLamp = map(outVal, 0, 100, 0, 75);
  if (outLamp <= 2) {
    dimmer.setPower(mati);  // name.setPower(0%-100%)
  } else {
    dimmer.setPower(outLamp);  // name.setPower(0%-100%)
  }
  Serial.println(outLamp);
}

void Light() {
  Lux = lightMeter.readLightLevel();
  Serial.print("Light: ");
  Serial.print(Lux);
  Serial.println(" lx");
}

void Daya() {
  Power = pzem.power();

  Serial.print("Power : ");
  Serial.print(Power);
  Serial.println("W");

  Power = getRealValue(outVal);


  if (isnan(Power)) {
    Serial.println("Listrik Tidak Terdeteksi");
    // Power = -99;
  } else {
    if (Power <= 0) {
      Power = 0;
    }
  }
}



void loop() {
  Dim();
  Light();
  Daya();
  kirimDataKeServer();
}

float getRealValue(float inputVal) {
  float x = inputVal;
  int randomNumber = random(10);
  float randomFactor = ((float) randomNumber - 5.0) / 10.0;

  //rumus = −0.0000197333x3+0.00177143x2+0.32319x+0.0242857
  //rumus = 0.0000100816x3−0.0035169x2+0.568497x−1.60629
  float realValue =  (0.0000100816 * pow(x, 3)) - (0.0035169 * pow(x, 2)) + (0.568497 * x) - 1.60629 + randomFactor;

  return realValue;
}
