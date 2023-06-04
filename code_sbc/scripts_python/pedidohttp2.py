import requests
import time

url= "http://iot.dei.estg.ipleiria.pt/api/api.php?sensor=btc"

while True:

    response = requests.get(url)

    if response.status_code == 200:
        print("Preço BitCoin:")
        print(time.strftime("%d-%m-%Y %H:%M:%S"), end=" ")
        print(response.text)
    else:
        print("request falhada")
        print(requests.HTTPError)

    time.sleep(5)

