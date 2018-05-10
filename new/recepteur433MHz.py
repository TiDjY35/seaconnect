#!/usr/bin/env python
# -*- coding: latin-1 -*-

'''
Réception d'un message par le Raspberry Pi,
reçu à 433 MHz par un récepteur
relié à la pin GPIO 11
Nécessite la présence du fichier vw.py dans le 
même répertoire.
http://www.raspberrypi.org/forums/viewtopic.php?t=84596&p=598087

'''
import time
import pigpio

import vw

RX=11

BPS=2000

pi = pigpio.pi() 

rx = vw.rx(pi, RX, BPS) 

start = time.time()

print("En attente de la reception des donnees")

while (time.time()-start) < 100:

   while rx.ready():
      print("".join(chr (c) for c in rx.get()))

rx.cancel()

pi.stop()
