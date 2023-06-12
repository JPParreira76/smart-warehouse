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
            
        
        valor_luz = get_valor(url_luz)
        valor_iluminacao = get_valor(url_iluminacao)

        if valor_luz is not None:
            if valor_iluminacao is not None and valor_iluminacao == 0 or valor_iluminacao == 1:
                if valor_luz == 0: #nao ha luz
                    #liga led
                    valor_iluminacao = 1    #iluminacao passa a estar ligada
                    GPIO.output(led_pin, GPIO.HIGH)
                    print("LED aceso!")


                    #Post da iluminacao
                    agora = datetime.datetime.now().strftime("%Y-%m-%d %H:%M:%S")
                    payload = {"nome": "iluminacao", "valor": str(valor_iluminacao), "hora": agora}
                    response = requests.post(url_api, data = payload)
                    if response.ok:
                        responseStatusCode = response.status_code
                        responseBody = response.text
                        print("Status Code:", responseStatusCode, "Resposta:", responseBody)
                    else:
                        print("Request failed")
                    #Webcam - liga camara
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

                if valor_luz == 1:# ha luz
                    #desliga led
                    valor_iluminacao = 0    #iluminacao passa a estar desligada
                    GPIO.output(led_pin, GPIO.LOW)


                    #Post da iluminacao
                    agora = datetime.datetime.now().strftime("%Y-%m-%d %H:%M:%S")
                    payload = {"nome": "iluminacao", "valor": str(valor_iluminacao), "hora": agora}
                    response = requests.post(url_api, data=payload)
                    if response.ok:
                        responseStatusCode = response.status_code
                        responseBody = response.text
                        print("Status Code:", responseStatusCode, "Resposta:", responseBody)
                    else:
                        print("Request failed")
                    
                    print("LED apagado!")

            else:   #significa que esta em modo manual
                if valor_iluminacao == 2:#utilizador quer desligar a iluminacao
                    #desliga led
                    GPIO.output(led_pin, GPIO.LOW)
                    print("LED apagado!")

                if valor_iluminacao == 3:#utilizador quer acender a iluminacao
                    #liga led
                    GPIO.output(led_pin, GPIO.HIGH)
                    print("LED aceso!")
                    
                    #Webcam - liga camara
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

