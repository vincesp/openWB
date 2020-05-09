<?php

header("Content-Type: application/json");

// Collect what you need in the $data variable.

$data = array();
$data[hello] = "world";

$json = json_encode($data);
if ($json === false) {
    echo json_last_error_msg();
    http_response_code(500);
} else {
    echo $json;
} 

?>