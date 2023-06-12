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
GPIO.setmode(GPIO.BCM)
GPIO.setup(led_pin, GPIO.OUT)
url_luz = "https://10.79.12.30/smart-warehouse/api/api.php?luz=valor"
url_iluminacao = "https://10.79.12.30/smart-warehouse/api/api.php?iluminacao=valor"
url_webcam = "https://rooftop.tryfail.net:50000/image.jpeg"
url_upload = "https://10.79.12.30/smart-warehouse/api/upload.php?"
url_api = "https://10.79.12.30/smart-warehouse/api/api.php?"


try:
    while True:
        #Sensores Posts, Gets e logica
        humidade, temperatura = Adafruit_DHT.read_retry(sensor, pin)

        if temperatura is not None: #and not math.isnan(temperatura):
            
            print(f'Temperatura: {temperatura}°C') 
        
        if humidade is not None: #and not math.isnan(temperatura):
            
            print(f'Humidade: {humidade}%')
            

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

