<?php
include('../config/configDB.php');

mysql_connect(DBHOST, DBUSER, DBPASSWD);
mysql_select_db(DBNAME);

//récupération de la variable d'URL,
//qui va nous permettre de savoir quel enregistrement supprimer:
$id = $_GET["idkeyarduino"];

//requête SQL:
$sql = "DELETE 
            FROM arduino
	    WHERE id = " . $id;
//  echo $sql ;	    
//exécution de la requête:
$requete = mysql_query($sql);

//affichage des résultats, pour savoir si la suppression a marchée:
if ($requete) {
    echo("Aquarium supprimé");
} else {
    echo("La suppression a échouée");
}
?>
<meta http-equiv="Refresh" content="1; url=../index.php">