<?php
include('../config/configDB.php');

mysql_connect(DBHOST, DBUSER, DBPASSWD);
mysql_select_db(DBNAME);

//récupération des valeurs des champs:
//Id de l'arduino:
$idkeyarduino = $_POST["idkeyarduino"];
//Nom de l'aquarium:
$nameaquarium = $_POST["nameaquarium"];
// Température minimal
$datelaunch = $_POST["datelaunch"];
// Température minimal
$tempmin = $_POST["tempmin"];
// Température maximal
$tempmax = $_POST["tempmax"];
// Population du bac
$species = $_POST["species"];

if ((!empty($_POST['idkeyarduino'])) && (!empty($_POST['nameaquarium'])) &&
        (!empty($_POST['datelaunch'])) && (!empty($_POST['tempmin'])) &&
        (!empty($_POST['tempmax'])) && (!empty($_POST['species']))) {

//création de la requête SQL:
    $sql = "INSERT  INTO arduino (idkeyarduino, nameaquarium, datelaunch, tempmin, tempmax, species)
            VALUES ( '$idkeyarduino', '$nameaquarium', '$datelaunch', '$tempmin', '$tempmax', '$species') ";

//exécution de la requête SQL:
    $requete = mysql_query($sql) or die(mysql_error());

//affichage des résultats, pour savoir si l'insertion a marchée:

    if ($requete) {
        echo("Aquarium correctement ajouté");
    } else {
        echo("Une erreur à l'ajout s'est produite");
    }
} else {
    echo "Tous les champs ne sont pas remplis correctement";
}
?>

<meta http-equiv="Refresh" content="2; url=../index.php">