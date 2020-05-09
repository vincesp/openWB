<?php

header("Content-Type: application/json");

// Collect what you need in the $data variable.

$lines = file('/var/www/html/openWB/openwb.conf');
$config = array();
foreach ($lines as $line) {
	$splitLine = array_map(trim, explode('=', $line));
	// push key/value pair to new array
	$config[$splitLine[0]] = $splitLine[1];
}

// openwb.conf contains passwords, so we have to filter the values we send out
$names = array(
    "lastmanagement",
    "lastmanagements2",
    "speichermodul", //speicherstat
    "lademstat", //lademlp1stat
    "lademstats1", //lademlp2stat
    "lademstats2", //lademlp3stat
    "evuglaettungakt",
    "nachtladen", //nachtladenstate
    "nachtladens1", //nachtladenstates1
    "nlakt_nurpv",
    "nlakt_sofort",
    "nlakt_minpv",
    "nlakt_standby",
    "hausverbrauchstat",
    "speicherpvui",
    "zielladenaktivlp1",
    "heutegeladen"
);

foreach ($names as $name) {
    $data[$name] = $config[$name];
}

// TODO: is this really static data?
$data[lademodus] = $data[sofortlm] = file_get_contents('/var/www/html/openWB/ramdisk/lademodus');

$json = json_encode($data);
if ($json === false) {
    echo json_last_error_msg();
    http_response_code(500);
} else {
    echo $json;
} 

?>