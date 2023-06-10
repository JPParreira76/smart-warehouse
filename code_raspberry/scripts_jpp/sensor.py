import requests
import time
import RPi.GPIO as GPIO
import datetime
import Adafruit_DHT
import cv2
import math
from urllib.parse import urlencode

sensor = Adafruit_DHT.DHT11  # Or Adafruit_DHT.DHT22, depending on the sensor
sensor_pin = 7  # GPIO pin number connected to the sensor
led_pin = 11  # Pino GPIO conectado ao LED
GPIO.setmode(GPIO.BCM)
GPIO.setup(led_pin, GPIO.OUT)
url_luz = "http://10.79.12.30/smart-warehouse/api/api.php?nome=luz"
url_iluminacao = "http://10.79.12.30/smart-warehouse/api/api.php?nome=iluminacao"
webcam_url = "https://rooftop.tryfail.net:50000/image.jpeg"
upload_url = "http://10.79.12.30/smart-warehouse/api/upload.php"

try:
    while True:
        # Sensores
        humidity, temperature = Adafruit_DHT.read_retry(sensor, sensor_pin)
        if humidity is not None and temperature is not None:
            temperature = int(temperature)
            humidity = int(humidity)
            print(f'Temperature: {temperature}°C')
            print(f'Humidity: {humidity}%')
        else:
            print('Failed to retrieve data from the sensor.')

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

