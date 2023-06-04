import RPi.GPIO as GPIO
import time

GPIO.cleanup()
channel = 2

GPIO.setmode(GPIO.BCM)
GPIO.setup(channel, GPIO.OUT)

while True:
    GPIO.output(channel, 1)
    time.sleep(1)
    GPIO.output(channel, 0)
    time.sleep(1)


