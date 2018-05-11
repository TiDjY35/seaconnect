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
from pymongo import MongoClient
client = MongoClient('192.168.199.64:27017')
db = client.jeedom

from datetime import datetime

RX=11

BPS=2000

pi = pigpio.pi() 

rx = vw.rx(pi, RX, BPS) 

start = time.time()

print("En attente de la reception des donnees")

while (time.time()-start) < 10000:

    while rx.ready():
        print("".join(chr (c) for c in rx.get())) 
        db.watertemperature.insert_one(
            {
                "idkeyarduino":1000,"temperature":20,"date":datetime.now() 
            }
        )
        print '\nInserted data successfully\n'

rx.cancel()

pi.stop()
