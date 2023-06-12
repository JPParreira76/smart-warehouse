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

def get_valor(url):
    try:
        response = requests.get(url)

        if response.status_code == 200:
            value = float(response.text)
            print("Valor recebido:", value)
            return value
        else:
            print("Erro ao ler valor.")
            return None

    except requests.exceptions.RequestException as e:
        print("Erro de conexao:", e)
        return None

    except ValueError:
        print("Valor invalido recebido.")
        return None

try:
    while True:
        #Sensores Posts, Gets e logica

        #capture_and_upload_image(url_webcam, url_upload)
        cap = cv2.VideoCapture(url_webcam)
        ret, frame = cap.read()

        if ret:
            cv2.imwrite('captura.jpg', frame)
            files = {'images': open('captura.jpg', 'rb')}
            response = requests.post(url_upload, files=files)

            if response.status_code == 200:
                print("Image uploaded successfully")
            else:
                raise RuntimeError("Failed to upload image: " + response.text)
        else:
            raise ValueError("Failed to capture image from webcam")
     
        cap.release()

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

