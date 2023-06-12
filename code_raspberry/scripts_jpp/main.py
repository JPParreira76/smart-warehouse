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
url_luz = "http://10.79.12.249/smart-warehouse/api/api.php?nome=luz"
url_iluminacao = "http://10.79.12.249/smart-warehouse/api/api.php?nome=iluminacao"
webcam_url = "https://rooftop.tryfail.net:50000/image.jpeg"
upload_url = "http://10.79.12.249/smart-warehouse/api/upload.php"
value_iluminacao = 0
value_luz = 0

def post2API(nome, valor):   
    url = "http://10.79.12.249/smart-warehouse/api/api.php?"
    headers = {"Content-Type": "application/x-www-form-urlencoded"}
    agora = datetime.datetime.now().strftime("%Y-%m-%d %H:%M:%S")
    payload = {"nome": nome, "valor": str(valor), "hora": agora}
    body = urlencode(payload)
    response = requests.post(url, headers=headers, data=body)

    if response.ok:
        responseStatusCode = response.status_code
        responseBody = response.text
        print("Status Code:", responseStatusCode, "Resposta:", responseBody)
    else:
        print("Request failed")

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

        # Sensores & POST
        humidity, temperature = Adafruit_DHT.read_retry(sensor, sensor_pin)
        if humidity is not None and temperature is not None:
            temperature = int(temperature)
            humidity = int(humidity)
            print(f'Temperature: {temperature}°C')
            print(f'Humidity: {humidity}%')
            post2API("temperatura", temperature)
            post2API("humidade", humidity)
        else:
            print('Failed to retrieve data from the sensor.')

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

        # Logica
        if value_luz is not None:
            if value_iluminacao is not None and value_iluminacao == 0 or value_iluminacao == 1:
                if value_luz == 0: #nao ha luz
                    #liga led & POST iluminacao
                    value_iluminacao = 1    #iluminacao passa a estar ligada
                    GPIO.output(led_pin, GPIO.HIGH)
                    print("LED iluminacao aceso!")
                    post2API("iluminacao", value_iluminacao)
                    #Webcam - liga camara
                    capture_and_upload_image(webcam_url, upload_url)

                if value_luz == 1:# ha luz
                    #desliga led
                    value_iluminacao = 0    #iluminacao passa a estar desligada
                    GPIO.output(led_pin, GPIO.LOW)
                    print("LED iluminacao apagado!")
                    post2API("iluminacao", value_iluminacao)

            else:   #significa que esta em modo manual
                if value_iluminacao == 2:  #utilizador quer desligar a iluminacao
                    #desliga led
                    GPIO.output(led_pin, GPIO.LOW)
                    print("LED iluminacao apagado!")
                    #nao precisa de POST

                if value_iluminacao == 3:  #utilizador quer acender a iluminacao
                    #liga led
                    GPIO.output(led_pin, GPIO.HIGH)
                    print("LED iluminacao aceso!")
                    #Webcam - liga camara
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