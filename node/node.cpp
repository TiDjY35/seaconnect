/*
Ce script C++ permet de décoder un signal radio envoyé au Raspberry Pi par un node arduino, puis utilise un script php pour traiter la donnée envoyée
Vous pouvez compiler cette source via la commande :
	g++ node.cpp -o node -lwiringPi
	
N'oubliez pas d'installer auparavant la librairie wiring pi ainsi que l'essentiel des paquets pour compiler
Et pensez à donner les droits maximum au fichier exécutable créé :
sudo chmod 0777 node
Vous pouvez lancer le programme via la commande :
./node /var/www/node/node.php  7
Cet appelle fournit à l'exécutable 2 paramètres : l'adresse du fichier PHP à appeler au sein du script, et le numéro du PIN GPIO / WiringPi utilisé 
par le raspberry pi pour recevoir les données 
@author : Manuel Esteban AKA Yaug (http://manuel-esteban.com)
@contributors : Valentin CARRUESCO (idleman@idleman.fr)
@webPage : http://manuel-esteban.com
@references & Libraries: https://projects.drogon.net/raspberry-pi/wiringpi/, http://playground.arduino.cc/Code/HomeEasy
@licence : CC by sa (http://creativecommons.org/licenses/by-sa/3.0/fr/)
HomePi de Manuel Esteban AKA Yaug est mis à disposition selon les termes de la 
licence Creative Commons Attribution - Partage dans les Mêmes Conditions 3.0 France.
Les autorisations au-delà du champ de cette licence peuvent être obtenues à idleman@idleman.fr.
*/


#include <wiringPi.h>
#include <iostream>
#include <stdio.h>
#include <sys/time.h>
#include <time.h>
#include <stdlib.h>
#include <sched.h>
#include <sstream>

using namespace std;

//initialisation du pin de reception
int pin;
 
//Fonction de log
void log(string a){
  //Décommenter pour avoir les logs
  cout << a << endl;
}

//Fonction de conversion long vers string
string longToString(long mylong){
  string mystring;
  stringstream mystream;
  mystream << mylong;
  log(mystream.str());
  return mystream.str();
}

//Fonction de passage du programme en temps réel (car la reception se joue a la micro seconde près)
void scheduler_realtime() {
  struct sched_param p;
  p.__sched_priority = sched_get_priority_max(SCHED_RR);
  if( sched_setscheduler( 0, SCHED_RR, &p ) == -1 ) {
    perror("Failed to switch to realtime scheduler.");
  }
}

//Fonction de remise du programme en temps standard
void scheduler_standard() {
	struct sched_param p;
	p.__sched_priority = 0;
	if( sched_setscheduler( 0, SCHED_OTHER, &p ) == -1 ) {
	perror("Failed to switch to normal scheduler.");
	}
}

//Recuperation du temp (en micro secondes) d'une pulsation
int pulseIn(int pin, int level, int timeout)
{
   struct timeval tn, t0, t1;
   long micros;
   gettimeofday(&t0, NULL);
   micros = 0;
   while (digitalRead(pin) != level)
   {
      gettimeofday(&tn, NULL);
      if (tn.tv_sec > t0.tv_sec) micros = 1000000L; else micros = 0;
      micros += (tn.tv_usec - t0.tv_usec);
      if (micros > timeout) return 0;
   }
   gettimeofday(&t1, NULL);
   while (digitalRead(pin) == level)
   {
      gettimeofday(&tn, NULL);
      if (tn.tv_sec > t0.tv_sec) micros = 1000000L; else micros = 0;
      micros = micros + (tn.tv_usec - t0.tv_usec);
      if (micros > timeout) return 0;
   }
   if (tn.tv_sec > t1.tv_sec) micros = 1000000L; else micros = 0;
   micros = micros + (tn.tv_usec - t1.tv_usec);
   return micros;
}

//Programme principal
int main (int argc, char** argv)
{
	//On passe en temps réel
	scheduler_realtime();
	
	string command;
	string path = "php ";
	//on récupere l'argument 1, qui est le chemin vers le fichier php
	path.append(argv[1]);
	log("Demarrage du programme");
	//on récupere l'argument 2, qui est le numéro de Pin GPIO auquel est connecté le recepteur radio
	pin = atoi(argv[2]);
	//Si on ne trouve pas la librairie wiringPI, on arrête l'execution
    if(wiringPiSetup() == -1)
    {
        log("Librairie Wiring PI introuvable, veuillez lier cette librairie...");
        return -1;
    }else{
    	log("Librairie WiringPI detectee");
    }
    pinMode(pin, INPUT);
	log("Pin GPIO configure en entree");
    log("Attente d'un signal du transmetteur ...");
	
	//On boucle pour ecouter les signaux
	for(;;)
    {
    	int i = 0;
		unsigned long t = 0;
	    //avant dernier byte reçu
		int prevBit = 0;
	    //dernier byte reçu
		int bit = 0;
		
		//mise a zero de l'idenfiant télécommande
	    unsigned long sender = 0;
            unsigned long type = 0;
            unsigned long raspberry = 0;
		//mise a zero du groupe
	    bool group=false;
		//mise a zero de l'etat on/off
	    bool on =false;
		//mise a zero de l'idenfiant de la rangée de bouton
	    unsigned long recipient = 0;
	
	    // Onecupere le signe
	    unsigned long signe = 0;
            //On recupere les data
            unsigned long data = 0;
		
		command = path+" ";
		t = pulseIn(pin, LOW, 1000000);
   	
		//Verrou 1
		while((t < 2400 || t > 2600)){
			t = pulseIn(pin, LOW,1000000);
		}
		log("Verrou 1 detecte");
		// données
		while(i < 66)
		{
			t = pulseIn(pin, LOW, 1000000);

			//Définition du bit (0 ou 1)
	        	if(t > 180 && t < 480)
			{
				bit = 0;
			}
			
	        	else if(t > 1280 && t < 1580)
			{
				bit = 1;
			}
			else
			{
				cout << t << " break";
				i = 0;
				break;
			}
			
			
			if(i % 2 == 1)
			{
				if((prevBit ^ bit) == 0)
				{
					// doit être 01 ou 10,,pas 00 ou 11 sinon ou coupe la detection, c'est un parasite
					i = 0;
					break;
				}

				if(i < 28)
                                {
                                        // les 14 bits suivant  sont l'identifiants du kit
                                        sender <<= 1;
                                        sender |= prevBit;
                                }

                                else if(i < 36)
				{
					// les 4 bits suivants servena determiner le type
					type <<= 1;
                                        type |= prevBit;
								}
				else if(i < 38)
				{
					// le 27em bit est le bit qui indique si il s'agit d'une teerature positive ou negative
					signe <<= 1;
                                        signe |= prevBit;
				}
			
				else
				{
					// les 14 derniers bits (28-32) sont les donnees transmises
cout << bit;
					data <<= 1;
					data |= prevBit;
				}
			}
//			cout << bit;
			prevBit = bit;
			++i;
	}
	
	//Si les données ont bien été détéctées
    if(i>0 ){
	cout << "data received";
		log("------------------------------");
		log("Donnees");
		cout << "sender " << sender << endl;
		cout << "type " << type << endl;
		cout << "signe " << signe << endl;
 		cout << "data " << data << endl;
		//on construit la commande qui vas envoyer les parametres au PHP
		command.append(longToString(sender)+" ");
                command.append(longToString(type)+" ");
                command.append(longToString(signe)+" ");
                command.append(longToString(data));
   		log("Execution de la commande PHP");
		//Et hop, on envoie tout ça au PHP
		cout << command.c_str() << endl;
		system(command.c_str());
	}else{
		log("Aucune donnee...");
	}
	
    	delay(3000);
    }
	
	scheduler_standard();
}
