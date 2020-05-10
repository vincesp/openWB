<?php

function sendAsJsonResponse($data) {
    $json = json_encode($data);

    if ($json === false) {
        header("Content-Type: text/plain");
        echo json_last_error_msg();
        http_response_code(500);
        return;
    }

    header("Content-Type: application/json");
    echo $json;
}

?>
