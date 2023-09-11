#include <WiFi.h>
#include <HTTPClient.h>
#include "ACS712.h"

const char WIFI_SSID[] = "SKYTEC.INC";
const char WIFI_PASSWORD[] = "valueof123";

int relayPins[] = {18, 19, 21, 22};
int IRsensorPins[] = {26, 25, 33, 32};
int voltagePin = 13;
int currentPin = 12;
float Vcc = 3.3;
String active_coil = "none";

float transmitted_power = 0;

String HOST_NAME = "http://192.168.43.178";
String PATH_NAME   = "/projects/wpets/getSensorData";

bool state_func (int pin) {
  float temp = analogRead (pin);
  temp = (temp/4096)*3.3;
  if (temp > 2) {
    return HIGH;
  } else {
    return LOW;
  }
}

float voltage_sense (int voltagePin, float Vcc) {
    return (analogRead (voltagePin)*Vcc/4096);
}

void setup() {
  Serial.begin(9600);

  for (int i = 0; i<5; i++) {
      pinMode(relayPins[i], OUTPUT);
      digitalWrite(relayPins[i], LOW);
  }

  ACS.autoMidPoint();
  WiFi.begin(WIFI_SSID, WIFI_PASSWORD);
  Serial.println("Connecting");
  while(WiFi.status() != WL_CONNECTED) {
    delay(500);
    Serial.print(".");
  }

  Serial.println("");
  Serial.print("Connected to WiFi network with IP Address: ");
  Serial.println(WiFi.localIP());
}

void loop() {
  HTTPClient http;
  switching_func (); // function for coil switching based on the active sensor
  int current = ACS.mA_AC();

  String queryString = "?transmitted_power=" + (voltage_sense ()*current);
  queryString += "&coil_active=" + active_coil;
  queryString += "&get_data=1"; // used for authentication at the servers end

  http.begin(HOST_NAME + PATH_NAME + queryString);   //Indicate the destination webpage 
  http.addHeader("Content-Type", "application/x-www-form-urlencoded"); 
  int httpCode = http.GET();

  // httpCode will be negative on error
  if(httpCode > 0) {
    // file found at server
    if(httpCode == HTTP_CODE_OK) {
      String payload = http.getString();
      Serial.println(payload);
    } else {
      // HTTP header has been send and Server response header has been handled
      Serial.printf("[HTTP] GET... code: %d\n", httpCode);
    }
  } else {
    Serial.printf("[HTTP] GET... failed, error: %s\n", http.errorToString(httpCode).c_str());
  }

  http.end();
}


void switching_func () {
  if (state_func (IRsensorPins[0]) == HIGH) {
    digitalWrite(relayPins[0], HIGH);
    active_coil = "a";
  } else if (state_func (IRsensorPins[1]) == HIGH) {
    digitalWrite(relayPins[1], HIGH);
    active_coil = "b";
  } else if (state_func (IRsensorPins[2]) == HIGH) {
    digitalWrite (relayPins[2], HIGH);
    active_coil = "c";
  } else if (state_func (IRsensorPins[3]) == HIGH) {
    digitalWrite(relayPins[3], HIGH);
    active_coil = "d";
  } else if (state_func (IRsensorPins[4]) == HIGH) {
    digitalWrite (relayPins[4], HIGH);
    active_coil = "e";
  } else {
    for (int i = 0; i<5; i++) {
       digitalWrite(relayPins[i], LOW);  
    }
    active_coil = "none";
  }
}

// The C++ code used to send data from the receiver side to the monitoring system is given below.

#include <WiFi.h>
#include <HTTPClient.h>
#include "ACS712.h"

const char WIFI_SSID[] = "SKYTEC.INC";
const char WIFI_PASSWORD[] = "valueof123";

int voltagePin = 13;
int currentPin = 12;
float receieved_power = 0;

String HOST_NAME = "http://192.168.43.178";
String PATH_NAME   = "/projects/wpets/getSensorData";


float voltage_sense (int voltagePin, float Vcc) {
    return (analogRead (voltagePin)*Vcc/4096);
}

void setup() {
  Serial.begin(9600);

  for (int i = 0; i<5; i++) {
      pinMode(relayPins[i], OUTPUT);
      digitalWrite(relayPins[i], LOW);
  }

  ACS.autoMidPoint();
  WiFi.begin(WIFI_SSID, WIFI_PASSWORD);
  Serial.println("Connecting");
  while(WiFi.status() != WL_CONNECTED) {
    delay(500);
    Serial.print(".");
  }

  Serial.println("");
  Serial.print("Connected to WiFi network with IP Address: ");
  Serial.println(WiFi.localIP());
}

void loop() {
  HTTPClient http;
  switching_func (); // function for coil switching based on the active sensor
  int current = ACS.mA_AC();

  String queryString = "?received_power=" + (voltage_sense ()*current);

  http.begin(HOST_NAME + PATH_NAME + queryString);   //Indicate the destination webpage 
  http.addHeader("Content-Type", "application/x-www-form-urlencoded"); 
  int httpCode = http.GET();

  // httpCode will be negative on error
  if(httpCode > 0) {
    // file found at server
    if(httpCode == HTTP_CODE_OK) {
      String payload = http.getString();
      Serial.println(payload);
    } else {
      // HTTP header has been send and Server response header has been handled
      Serial.printf("[HTTP] GET... code: %d\n", httpCode);
    }
  } else {
    Serial.printf("[HTTP] GET... failed, error: %s\n", http.errorToString(httpCode).c_str());
  }

  http.end();
}
