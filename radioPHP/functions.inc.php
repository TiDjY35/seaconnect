<?php
include('config/configDB.php');

mysql_connect(DBHOST, DBUSER, DBPASSWD);
mysql_select_db(DBNAME);

function table_dashboard() {

    $liste = mysql_query("SELECT * FROM arduino");

    while ($rowliste = mysql_fetch_array($liste)) {
        ?>
        <tr>
            <td style="vertical-align: top;">
                <?php echo "<a href=alerte/formchangealerte.php?idkeyarduino=" . $rowliste["id"] . ">" . $rowliste["nameaquarium"] . "</a>\n"; ?> 
            </td>
            <td style="vertical-align: top;"><?php echo $rowliste["species"]; ?></td>    
            <?php
            $idkeyarduino = $rowliste["idkeyarduino"];
            $result = mysql_query("SELECT date,temperature FROM radio.watertemperature
                            WHERE idkeyarduino = $idkeyarduino
                           ORDER BY id DESC LIMIT 1;");
            
            $num_rows = mysql_num_rows($result);
            if ($num_rows === 0)
            {
                echo '   <td> not information </td>';
                echo '   <td> not information </td>';
                echo '   <td>  not information </td>';
                echo '   <td>  not information </td>';
                echo '   <td>  not information </td>';
                echo '   <td>  not information </td>';
                echo "<td><a href=\"#\" onClick=\"confirme('" . $rowliste["id"] . "')\" ><img src=img/del.png width=20 height=20></a></td>\n";
            }
            else 
            {
            while ($row = mysql_fetch_array($result)) {
                echo '   <td> ' . $row["date"] . '</td>';
                echo '   <td> ' . $row["temperature"] . '</td>';
                echo '   <td>  null </td>';
                echo '   <td>  null </td>';
                echo '   <td>  null </td>';
                echo '   <td>  null </td>';
                echo "<td><a href=\"#\" onClick=\"confirme('" . $rowliste["id"] . "')\" ><img src=img/del.png width=20 height=20></a></td>\n";
            }
            }
        }
    }
    