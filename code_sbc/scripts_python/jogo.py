import random

print ("--- Prima CTRL + C para terminar ---")
print ("Jogo da Adivinha: tenta adivinhar um numero entre 0 e 9")

numero = random.randint(0, 9) #gera um numero aleatorio entre 0 e 9

while True:
    try:
        guess = int(input("Introduz um numero: ")) #guarda o input numa variavel
        if (guess == numero):
            print ("Parabens! O numero correto:", guess)
            break; #sai do ciclo
        else:
            print ("Errado, mas tenta outra vez")
    except KeyboardInterrupt:
        # Captura excecao CTRL+C
        print("\n O jogo foi interrupido pelo jogador.")
        break # sai do ciclo
    except Exception as e:
        # Captura erros
        print("Erro inesperado:", e)
        print("Tenta outra vez")

