<?php
    
    include('../config/db.php'); 

    $myquery = "SELECT `date`, `temperature`    
                FROM radio.watertemperature 
                WHERE date > DATE_SUB(NOW(), INTERVAL 24 HOUR)";
    
    $query = mysql_query($myquery);
    
    if ( ! $query ) {
        echo mysql_error();
        die;
    }
    
    $data = array();
    
    for ($x = 0; $x < mysql_num_rows($query); $x++) {
        $data[] = mysql_fetch_assoc($query);
    }
    
    echo json_encode($data);     
?>