<html>
    <head>
        <title>Modification informations Aquarium</title>
        <link rel="stylesheet" href="../css/style.css" type="text/css" media="screen"/>
    </head>
    <body>
        <?php
        include('../config/configDB.php');

        mysql_connect(DBHOST, DBUSER, DBPASSWD);
        mysql_select_db(DBNAME);

        //récupération de la variable d'URL,
        //qui va nous permettre de savoir quel enregistrement modifier
        $id = $_GET["idkeyarduino"];

        //requête SQL:
        $sql = "SELECT *
            FROM arduino
	    WHERE id = " . $id;

        //exécution de la requête:
        $requete = mysql_query($sql);

        //affichage des données:
        if ($result = mysql_fetch_object($requete)) {
            ?>
        <form name="insertion" action="changealerte.php" method="POST">
                <input type="hidden" name="id" value="<?php echo($id); ?>">
                <table border="0" align="center" cellspacing="2" cellpadding="2">
                    <tr align="center">
                        <td>Id Arduino</td>
                        <td><input type="text" name="idkeyarduino" value="<?php echo($result->idkeyarduino); ?>"></td>
                    </tr>
                    <tr align="center">
                        <td>Name Aquarium</td>
                        <td><input type="text" name="nameaquarium" value="<?php echo($result->nameaquarium); ?>"></td>
                    </tr>
                    <tr align="center">
                        <td>Date de mise en route</td>
                        <td><input type="date" name="datelaunch" value="<?php echo($result->datelaunch); ?>"></td>
                    </tr>
                    <tr align="center">
                        <td>Temperature Min</td>
                        <td><input type="text" name="tempmin" value="<?php echo($result->tempmin); ?>"></td>
                    </tr>
                    <tr align="center">
                        <td>Temperature Max</td>
                        <td><input type="text" name="tempmax" value="<?php echo($result->tempmax); ?>"></td>
                    </tr>
                    <tr align="center">
                        <td>Population</td>
                        <td><input type="text" name="species" value="<?php echo($result->species); ?>"></td>
                    </tr>
                    <tr align="center">
                        <td colspan="2"><input type="submit" value="modifier"></td>
                    </tr>
                </table>
            </form>
            <?php
        }//fin if 
        ?>
        <a href=../index.php>Retour Dashboard</a>
    </body>
</html>