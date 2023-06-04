import requests
import time

url="http://iot.dei.estg.ipleiria.pt/ti/g136/api/api.php?nome=temperatura"

while True:
    # Make a GET request to a URL
    response = requests.get(url)

    # Check the status code of the response
    if response.status_code == 200:
        temperatura = int(response.content)
        print("Temperatura:", end=" ")
        print(temperatura, end=" ")
        print(time.strftime("%x, %X"), end=" ")
        if temperatura > 20:
            print("Vou ligar o LED do RPI")
        else:
           print("Vou desligar o LED do RPI")
    else:
        print("Request failed")
        print("HTTP response code:", response.status_code)

    # % seconds delay
    time.sleep(5)