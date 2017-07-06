<?php
   // connect to mongodb
   $m = new MongoClient();
   echo "Connection to database successfully\n";
	
   // select a database
   $db = $m->jeedom;
   echo "Database jeedom selected\n";
	
list($file, $kitId, $typeData, $boolean, $data) = $_SERVER['argv'];
switch ($typeData) {
    case '10': // Réception d'une temperature
        $data2 = $data / 100;
	$collection = $db->watertemperature;
   	echo "Collection watertemperature selected successfully\n";
   	$document = array(
		"idkeyarduino" => "$kitId",
		"temperature" => "$data2",
		"date" => new MongoDate()
	);
	$collection->insert($document);
        echo "Document inserted successfully\n";
        break;
    case '11': // Réception d'un niveau d'eau
	$collection = $db->waterlevel;
        echo "Collection waterlevel selected successfully\n";
        $document = array(
                "idkeyarduino" => "$kitId",
                "level" => "$data",
                "date" => new MongoDate()
        );
	$collection->insert($document);
	echo "Document inserted successfully\n";
        break;
    default:
        break;
}
?>
