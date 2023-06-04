import requests
import time

url="http://iot.dei.estg.ipleiria.pt/api/api.php?sensor=btc"

while True:

    # Make a GET request to a URL
    response = requests.get(url)

    # Check the status code of the response
    if response.status_code == 200:
        print(time.strftime("%x, %X"), end=" ")
        print("- Valor da Bitcoin", end=" ")
        print(response.text, end=" ")
        print("Euros.")
    else:
        print("Request failed")

    # % seconds delay
    time.sleep(5)