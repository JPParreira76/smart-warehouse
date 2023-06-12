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
GPIO.setmode(GPIO.BOARD)
GPIO.setup(led_pin, GPIO.OUT)
url_luz = "http://10.79.12.249/smart-warehouse/api/api.php?nome=luz"
url_iluminacao = "http://10.79.12.249/smart-warehouse/api/api.php?nome=iluminacao"
webcam_url = "https://rooftop.tryfail.net:50000/image.jpeg"
upload_url = "http://10.79.12.249/smart-warehouse/api/upload.php"

def capture_and_upload_image(url_webcam, url_upload):
    try:
        cap = cv2.VideoCapture(url_webcam)
        ret, frame = cap.read()
        cap.release()

        if ret:
            cv2.imwrite('captura.jpg', frame)
            files = {'imagem': open('captura.jpg', 'rb')}
            response = requests.post(url_upload, files=files)

            if response.status_code == 200:
                print("Image uploaded successfully")
            else:
                raise RuntimeError("Failed to upload image: " + response.text)
        else:
            raise ValueError("Failed to capture image from webcam")
    except cv2.error as e:
        print("Error capturing image from webcam:", str(e))
    except Exception as e:
        print("Error capturing and uploading image:", str(e))

try:
    while True:
        # Upload
        capture_and_upload_image(webcam_url, upload_url)

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