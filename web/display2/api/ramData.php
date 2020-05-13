<?php
require 'common.php';

$ramdiskLocation = "/var/www/html/openWB/ramdisk";

$keysRaw = [];

$keysTrim = [
    "verbraucher1_name",
    "verbraucher2_name",
    "verbraucher3_name",
];

$keysNumber = [
    "speichervorhanden",
    //"lademodus",
    "soc1vorhanden",
    "verbraucher1vorhanden",
    "verbraucher2vorhanden",
    "verbraucher3vorhanden",
    "wattbezug",
    "pvwatt",
    "speicherleistung",
    "speichersoc",
    "hausverbrauch",
    "llaktuell",
    "llaktuells1",
    "soc",
    "soc1",
    //"lp1enabled",
    //"lp2enabled",
];

foreach ($keysRaw as $key) {
    $data[$key] = file_get_contents("$ramdiskLocation/$key");
};
foreach ($keysTrim as $key) {
    $data[$key] = trim(file_get_contents("$ramdiskLocation/$key"));
};
foreach ($keysNumber as $key) {
    $data[$key] = floatval(file_get_contents("$ramdiskLocation/$key"));
};

sendAsJsonResponse($data);
?>
