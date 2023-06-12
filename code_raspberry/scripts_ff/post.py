import requests
import time
import RPi.GPIO as GPIO
import datetime
import Adafruit_DHT
import cv2
import math
from urllib.parse import urlencode

sensor = Adafruit_DHT.DHT11  # Or Adafruit_DHT.DHT22, depending on the sensor
pin = 7  # GPIO pin number connected to the sensor
led_pin = 11  # Pino GPIO conectado ao LED
GPIO.setmode(GPIO.BOARD)
GPIO.setup(led_pin, GPIO.OUT)
url_luz = "http://10.79.12.249/smart-warehouse/api/api.php?nome=luz"
url_iluminacao = "http://10.79.12.249/smart-warehouse/api/api.php?nome=iluminacao"
url_webcam = "https://rooftop.tryfail.net:50000/image.jpeg"
url_upload = "http://10.79.12.249/smart-warehouse/api/upload.php"
url_api = "http://10.79.12.249/smart-warehouse/api/api.php"


try:
    while True:
        #Sensores Posts, Gets e logica
        humidade, temperatura = Adafruit_DHT.read_retry(sensor, pin)

        if temperatura is not None: #and not math.isnan(temperatura):
            #Post para api
            print(f'Temperatura: {temperatura}°C')
            agora = datetime.datetime.now().strftime("%Y-%m-%d %H:%M:%S")
            payload = {"nome": "temperatura", "valor": str(temperatura), "hora": agora}
            response = requests.post(url_api, data=payload)
            if response.ok:
                responseStatusCode = response.status_code
                responseBody = response.text
                print("Status Code:", responseStatusCode, "Resposta:", responseBody)
            else:
                print("Request failed")
        
        if humidade is not None: #and not math.isnan(temperatura):
            #Post para api
            print(f'Humidade: {humidade}%')
            agora = datetime.datetime.now().strftime("%Y-%m-%d %H:%M:%S")
            payload = {"nome": "humidade", "valor": str(humidade), "hora": agora}
            response = requests.post(url_api, data=payload)
            if response.ok:
                responseStatusCode = response.status_code
                responseBody = response.text
                print("Status Code:", responseStatusCode, "Resposta:", responseBody)
            else:
                print("Request failed")


        time.sleep(10) 

except requests.exceptions.RequestException as req_ex:
    print("Request error:", req_ex)

except ValueError as value_ex:
    print("Value error:", value_ex)

except Exception as ex:
    print("Unexpected error:", ex)
    print("Please try again.") 

except KeyboardInterrupt:
    # Handle keyboard interrupt (Ctrl+C)
    print("\nProgram interrupted by user.")

finally:
    # Cleanup GPIO pins
    GPIO.cleanup()
    print("Program terminated.")

