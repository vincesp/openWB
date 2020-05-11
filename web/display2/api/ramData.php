<?php
require 'common.php';

$ramdiskLocation = "/var/www/html/openWB/ramdisk";

$keysRaw = array(
);

$keysTrim = array(
    "verbraucher1_name",
    "verbraucher2_name",
    "verbraucher3_name",
);

$keysNumber = array(
    "speichervorhanden",
    "lademodus",
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
);

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
