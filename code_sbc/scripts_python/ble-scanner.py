import bluepy.btle as bluepy

class Procura(bluepy.DefaultDelegate):
    def handleDiscovery(self, dev, isNewDev, isNewData):
        print("Descobri um novo device:", dev.addr)

scanner = bluepy.Scanner().withDelegate(Procura())

devices = scanner.scan(10, passive=True)