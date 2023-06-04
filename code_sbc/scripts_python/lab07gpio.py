import requests
import time
import RPi.GPIO as GPIO


channel = 2

GPIO.setmode(GPIO.BCM)
GPIO.setup(channel, GPIO.OUT)



try:
    while True:
        # Make a GET request to a URL
        url="http://iot.dei.estg.ipleiria.pt/ti/g136/api/api.php?nome=temperatura"
        response = requests.get(url)
        print(response.text)

        # Check the status code of the response
        if response.status_code == 200:
            temperatura = int(response.content)
            print("Temperatura:", end=" ")
            print(temperatura, end=" ")
            print(time.strftime("%x, %X"), end=" ")
            if temperatura > 20:
                GPIO.output(channel, 1)
            else:
                GPIO.output(channel, 0)
        else:
            print("Request failed")
            print("HTTP response code:", response.status_code)

        # % seconds delay
        time.sleep(5)


except KeyboardInterrupt:
    # captura excecao CTRL + C
        print("\n O jogo foi interrompido pelo jogador.")
        

except Exception as e:
    # captura todos os erros
    print('Erro inesperado:', e)
    print("Tenta outra vez")

finally:
    GPIO.cleanup()
    print('Terminou o programa')