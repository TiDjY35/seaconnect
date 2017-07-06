<?php
/**
 * Ce script  récupère les informations envoyé par radio au raspberry pi et les enregistre en base de données
 * Il log en base de donné les informations receuillies par le kit
 * 
 * @author Manuel Esteban aka Yaug ( http://manuel-esteban.com )
 * @date 22/02/2013
 * @licence : CC by sa (http://creativecommons.org/licenses/by-sa/3.0/fr/)
 * @
 */

include('config/configDB.php');
mysql_connect(DBHOST, DBUSER, DBPASSWD);
mysql_select_db(DBNAME);
// On reçt les informations suivantes : php /var/www/kit/node.php 1000 10 1 1912
list($file, $kitId, $typeData, $boolean, $data) = $_SERVER['argv'];
switch ($typeData) {
    case '10': // Réception d'une temperature
        $data2 = $data / 100;
        $query = "INSERT INTO `watertemperature` SET `idkeyarduino` = '$kitId', `temperature` = '$data2'";
        mysql_query($query);
        break;
    case '11': // Réception d'un niveau d'eau
        $query = "INSERT INTO `waterlevel` SET `idkeyarduino` = '$kitId', `level` = '$data'";
        mysql_query($query);
        break;
    default:
        break;
}
?>
