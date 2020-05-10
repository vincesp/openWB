<?php
include 'common.php';

$lines = file("/var/www/html/openWB/openwb.conf");
foreach ($lines as $line) {
	$splitLine = array_map(trim, explode('=', $line));
	// push key/value pair to new array
	$config[$splitLine[0]] = $splitLine[1];
}

// openwb.conf contains passwords, so we have to filter the values we send out
$names = array(
    // values.php -----------------------
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
    "heutegeladen",
    "displaytagesgraph",
    "minimalstromstaerke",
    "maximalstromstaerke",

    // gaugevalues.php ------------------
    "displayaktiv", //displayevumax
    "displaypvmax",
    "displayspeichermax",
    "displayhausanzeigen",
    "displayhausmax",
    "displaylp1max",
    "displaylp2max",
    "displaypinaktiv",
    "displaypincode",

    // gauge.html in-line ---------------
    "grapham",
    "graphinteractiveam",
    "verbraucher1_name",
    "verbraucher2_name",
    "verbraucher3_name"
);

foreach ($names as $name) {
    $data[$name] = $config[$name];
}

// TODO: REMOVE!!
// $data[XXdebug] = $config;

sendAsJsonResponse($data);

?>
