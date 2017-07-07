<?php

if($msg) {
	// $msg > 0 donc on revient à l'édition
	header("Location: formconfig.php?msg=$msg");
	exit;
}
// ouverture en écriture du fichier inc.config.php
if(!$fichier = @fopen('configDB.php', 'w')) {
	// si erreur on revient vers l'édition
	header("Location: formconfig.php?msg=7");
	exit;
}
// en-tête du fichier
fwrite($fichier, "<?php\n// Paramètres générés par ".$_SERVER['PHP_SELF']."\n");
// écriture de variables fixes
// écriture des variables du formulaire
foreach($_POST as $key=>$val) {
	// passer certaines entrées de formulaire (préfixées par 'f_')
	if(strstr($key,"f_")) continue;
	// traitement des constantes (en majuscule)
	elseif(strstr($key,"DB")) fwrite($fichier, "define(\"$key\", \"$val\");\n");
	// traitement des variables numériques ou booléennes en valeur
	elseif(is_numeric($val) || preg_match("/true|false/",$val)) fwrite($fichier, "\$$key = $val;\n");
	// sinon entre guillemets
	elseif(!empty($val)) fwrite($fichier, "\$$key = \"".preg_replace("/[\n|\r|\r\n]+/", " ", trim($val))."\";\n");
}
// tag PHP
fwrite($fichier, "?>\n");
// fermeture du fichier
fclose($fichier);
// retour à l'édition
header("Location: formconfig.php?msg=8");
?>
