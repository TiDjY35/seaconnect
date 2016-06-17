<?php

// récupération des variables
include('configDB.php');
// traitement d'une erreur éventuelle (via config-modif.php)
// ajouter autant de traitements que de variables requises
switch($_GET['msg']) {
	case 7: $errmsg = "Problème d'écriture du fichier configDB.php"; break;
	case 8: $errmsg = "Fichier configDB.php modifié !"; break;
}
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
<head>
<title>Gestion config</title>
<meta name="author" content="Pierre Pesty">
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<link href="webdev_form.css" type="text/css" rel="stylesheet">
</head>
<body>
<form method="post" action="changeconfigDB.php">
<p>
<label for="host">Hote MySQL</label>
<input id="host" name="DBHOST" value="<?= DBHOST?>"></p>
<p>
<label for="dbname">Nom de la base</label>
<input id="dbname" name="DBNAME" value="<?= DBNAME?>"></p>
<p>
<label for="dbuser">Nom utilisateur base</label>
<input id="dbuser" name="DBUSER" value="<?= DBUSER?>"></p>
<p>
<label for="dbpass">Mot de passe base</label>
<input type="password" id="dbpass" name="DBPASSWD" value="<?= DBPASSWD?>"></p>
<p>
<label>&nbsp;</label>
<input id="submit" type="submit" value="Submit"></p>
</form>
</body>
</html>