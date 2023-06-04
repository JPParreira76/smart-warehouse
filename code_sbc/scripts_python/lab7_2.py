import random

print ("--- Prima CTRL + C para terminar ---")
print ("Jogo da Adivinha: tenta adivinhar um numero entre 0 e 9")
url= "http://iot.dei.estg.ipleiria.pt/ti/g136/api/api.php?temperatura=valor"
numero = random.randint(0, 9) #gera um numero aleatorio entre 0 e 9

while True:
    if response.status_code == 200:
        temperatura=int(response.content)
        print("Temperatura = ", temperatura)
        if temperatura > 20:
            print("Vou ligar o LED do RPI")
        else:
           print("Vou desligar o LED do RPI")
    else:
        print("Request falhou")
        print("HTTP response code:", response.status_code)

    time.sleep(5)