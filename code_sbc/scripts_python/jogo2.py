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
    # captura excecao CTRL + C
        print("\n O jogo foi interrompido pelo jogador.")
        break # sai do ciclo while

    except Exception as e:
        # captura todos os erros
        print('Erro inesperado:', e)
        print("Tenta outra vez")
  


    