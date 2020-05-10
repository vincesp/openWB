<?php
include 'common.php';

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

sendAsJsonResponse($data);

?>
