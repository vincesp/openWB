<?php
header("Content-Type: application/json");

$data = array();

$lines = file("/var/www/html/openWB/openwb.conf");
$config = array();
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

// TODO: is this really static data?
$ramdiskLocation = "/var/www/html/openWB/ramdisk";

function loadRamdiskAndTrim($fileName) {
    global $ramdiskLocation;
    return trim(preg_replace('/\s+/', '', file_get_contents("$ramdiskLocation/$fileName")));
}

$data[lademodus] = $data[sofortlm] = file_get_contents("$ramdiskLocation/lademodus");
$data[speichervorhanden] = file_get_contents("$ramdiskLocation/speichervorhanden");
$data[soc1vorhanden] = loadRamdiskAndTrim("soc1vorhanden");
$data[verbraucher1vorhanden] = loadRamdiskAndTrim("verbraucher1vorhanden");
$data[verbraucher2vorhanden] = loadRamdiskAndTrim("verbraucher2vorhanden");
$data[verbraucher3vorhanden] = loadRamdiskAndTrim("verbraucher3vorhanden");

// TODO: REMOVE!!
// $data[XXdebug] = $config;

$json = json_encode($data);
if (!$json) {
    echo json_last_error_msg();
    http_response_code(500);
    return;
}
echo $json;
?>
