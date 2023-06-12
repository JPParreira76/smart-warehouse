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
url_luz = "https://10.79.12.30/smart-warehouse/api/api.php?luz=valor"
url_iluminacao = "https://10.79.12.30/smart-warehouse/api/api.php?iluminacao=valor"
webcam_url = "https://rooftop.tryfail.net:50000/image.jpeg"
upload_url = "https://10.79.12.30/smart-warehouse/api/upload.php?"


def capture_and_upload_image(url_webcam, url_upload):
    try:
        cap = cv2.VideoCapture(url_webcam)
        ret, frame = cap.read()
        cap.release()

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
    except cv2.error as e:
        print("Error capturing image from webcam:", str(e))
    except Exception as e:
        print("Error capturing and uploading image:", str(e))


def read_temperature(sensor, pin):

    _, temperature = Adafruit_DHT.read_retry(sensor, pin)
    
    if temperature is not None and not math.isnan(temperature):
        return temperature
    else:
        print('Failed to read temperature from the sensor!')
        return None


def read_humidity(sensor, pin):

    humidity,_ = Adafruit_DHT.read_retry(sensor, pin)
    
    if humidity is not None and not math.isnan(humidity):
        return humidity
    else:
        print('Failed to read humidity from the sensor!')
        return None


def post2API(nome, valor):   
    url = "https://10.79.12.30/smart-warehouse/api/api.php?"
    headers = {"Content-Type": "application/x-www-form-urlencoded"}
    agora = datetime.datetime.now().strftime("%Y-%m-%d %H:%M:%S")
    #payload = {"nome": nome, "valor": str(valor), "hora": agora}
    #response = requests.post(url, headers=headers, data=payload)

    payload = {"nome": nome, "valor": str(valor), "hora": agora}
    body = urlencode(payload)
    response = requests.post(url, headers=headers, data=body)

    if response.ok:
        responseStatusCode = response.status_code
        responseBody = response.text
        print("Status Code:", responseStatusCode, "Resposta:", responseBody)
    else:
        print("Request failed")


def get_valor_luz(url):
    try:
        response = requests.get(url)

        if response.status_code == 200:
            value = float(response.text)
            print("Valor luz recebido:", value)
            return value
        else:
            print("Erro ao ler valor da luz.")
            return None

    except requests.exceptions.RequestException as e:
        print("Erro de conexao:", e)
        return None

    except ValueError:
        print("Valor invalido recebido.")
        return None
    

def get_iluminacao(url):
    try:
        response = requests.get(url)

        if response.status_code == 200:
            value = float(response.text)
            print("Valor iluminacao recebido:", value)
            return value
        else:
            print("Erro ao ler valor da iluminacao.")
            return None

    except requests.exceptions.RequestException as e:
        print("Erro de conexao:", e)
        return None

    except ValueError:
        print("Valor invalido recebido.")
        return None


#loop que vai estar a correr
try:
    while True:
        #Sensores Posts, Gets e logica
        temperature = read_temperature(sensor, pin)
        if temperature is not None:
            post2API("temperatura", temperature)
        
        #humidity = read_humidity(sensor, pin)
        if humidity is not None:
            post2API("humidade", humidity)
        
        valor_luz = get_valor_luz(url_luz)
        valor_iluminacao = get_iluminacao(url_iluminacao)

        if valor_luz is not None:
            if valor_iluminacao is not None and valor_iluminacao == 0 or valor_iluminacao == 1:
                if valor_luz == 0: #nao ha luz
                    #liga led
                    valor_iluminacao = 1    #iluminacao passa a estar ligada
                    GPIO.output(led_pin, GPIO.HIGH)
                    print("LED aceso!")
                    post2API("iluminacao", valor_iluminacao)
                    #Webcam - liga camara
                    capture_and_upload_image(webcam_url, upload_url)

                if valor_luz == 1:# ha luz
                    #desliga led
                    valor_iluminacao = 0    #iluminacao passa a estar desligada
                    GPIO.output(led_pin, GPIO.LOW)
                    post2API("iluminacao", valor_iluminacao)
                    print("LED apagado!")

            else:   #significa que esta em modo manual
                if valor_iluminacao == 2:#utilizador quer desligar a iluminacao
                    #desliga led
                    GPIO.output(led_pin, GPIO.LOW)
                    print("LED apagado!")
                    #nao precisa de POST

                if valor_iluminacao == 3:#utilizador quer acender a iluminacao
                    #liga led
                    GPIO.output(led_pin, GPIO.HIGH)
                    print("LED aceso!")
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

