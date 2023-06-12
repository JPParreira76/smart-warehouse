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
webcam_url = "https://rooftop.tryfail.net:50000/image.jpeg"
upload_url = "http://10.79.12.249/smart-warehouse/api/upload.php"

try:
    while True:
        # GETS
        try:
            response = requests.get(url_luz)

            if response.status_code == 200:
                value_luz = int(response.text)
                print("Valor luz recebido:", value_luz)
            else:
                print("Erro ao ler valor da luz.")

        except requests.exceptions.RequestException as e:
            print("Erro de conexao:", e)

        except ValueError:
            print("Valor invalido recebido.")

        try:
            response = requests.get(url_iluminacao)

            if response.status_code == 200:
                value_iluminacao = int(response.text)
                print("Valor iluminacao recebido:", value_iluminacao)
            else:
                print("Erro ao ler valor da iluminacao.")

        except requests.exceptions.RequestException as e:
            print("Erro de conexao:", e)

        except ValueError:
            print("Valor invalido recebido.")

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
