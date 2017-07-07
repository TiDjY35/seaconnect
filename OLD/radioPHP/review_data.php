<?php
// Start MySQL Connection
include('config/configDB.php');

mysql_connect(DBHOST, DBUSER, DBPASSWD);
mysql_select_db(DBNAME);
?>

<html>
    <head>
        <title>Arduino Temperature Log</title>
        <style type="text/css">
            .table_titles, .table_cells_odd, .table_cells_even {
                padding-right: 20px;
                padding-left: 20px;
                color: #000;
            }
            .table_titles {
                color: #FFF;
                background-color: #666;
            }
            .table_cells_odd {
                background-color: #CCC;
            }
            .table_cells_even {
                background-color: #FAFAFA;
            }
            table {
                border: 2px solid #333;
            }
            body { font-family: "Trebuchet MS", Arial; }
        </style>
    </head>

    <body>
        <h1>Arduino Temperature Log last 24 hours</h1>
        <table border="0" cellspacing="0" cellpadding="4">
            <tr>
                <td class="table_titles">ID</td>
                <td class="table_titles">Date et Heure</td>
                <td class="table_titles">ID Arduino</td>
                <td class="table_titles">Temperature</td>
            </tr>
            <?php

            function calcul_pourcentage($nombre) {
                $resultat = ($nombre);
                return $resultat; // Arrondi la valeur
            }

            // Retrieve all records and display them
            $result = mysql_query("SELECT * FROM radio.watertemperature WHERE date > DATE_SUB(NOW(), INTERVAL 24 HOUR)");

            // Used for row color toggle
            $oddrow = true;

            // process every record
            while ($row = mysql_fetch_array($result)) {
                if ($oddrow) {
                    $css_class = ' class="table_cells_odd"';
                } else {
                    $css_class = ' class="table_cells_even"';
                }

                $oddrow = !$oddrow;

                $nombre_client = $row["temperature"];

                echo '<tr>';
                echo '   <td' . $css_class . '>' . $row["id"] . '</td>';
                echo '   <td' . $css_class . '>' . $row["date"] . '</td>';
                echo '   <td' . $css_class . '>' . $row["idkeyarduino"] . '</td>';
                echo '   <td' . $css_class . '>' . calcul_pourcentage($nombre_client) . '</td>';
                echo '</tr>';
            }
            ?>
        </table>
    </body>
</html>