<?php
include('../config/configDB.php');

mysql_connect(DBHOST, DBUSER, DBPASSWD);
mysql_select_db(DBNAME);

//récupération des valeurs des champs:
$idkeyarduino = $_POST["idkeyarduino"];
$nameaquarium = $_POST["nameaquarium"];
$datelaunch = $_POST["datelaunch"];
$tempmin = $_POST["tempmin"];
$tempmax = $_POST["tempmax"];
$species = $_POST["species"];
$id = $_POST["id"];

//création de la requête SQL:
$sql = "UPDATE arduino
            SET idkeyarduino = '$idkeyarduino',
                nameaquarium = '$nameaquarium',
                datelaunch = '$datelaunch',
                tempmin         = '$tempmin', 
	        tempmax     = '$tempmax',
                species = '$species'    
                
           WHERE id = '$id' ";

//exécution de la requête SQL:
$requete = mysql_query($sql) or die(mysql_error());


//affichage des résultats, pour savoir si la modification a marchée:
if ($requete) {
    echo("La modification à été correctement effectuée");
} else {
    echo("La modification à échouée");
}
?>

<meta http-equiv="Refresh" content="3; url=../index.php">