import bluepy.btle as bluepy
import RPi.GPIO as GPIO
import time

channel = 2

GPIO.setmode(GPIO.BCM)
GPIO.setup(channel, GPIO.OUT)

class Procura(bluepy.DefaultDelegate):
    def handleDiscovery(self, dev, isNewDev, isNewData):
        if dev.rssi > -50 and dev.addr == "2f:89:53:1f:dd:dd":
            print("Descobri um novo device:", dev.addr, " RSSI:", dev.rssi)
            GPIO.output(channel, 1)
            time.sleep(1)
            GPIO.output(channel, 0)


scanner = bluepy.Scanner().withDelegate(Procura())

devices = scanner.scan(10, passive=True)