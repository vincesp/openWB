<?php
header("Content-Type: application/json");

$data = array();

$data[hello] = "world";

$json = json_encode($data);
if (!$json) {
    echo json_last_error_msg();
    http_response_code(500);
    return;
}
echo $json;
?>
