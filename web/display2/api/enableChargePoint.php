<?php
require('common.php');

$body = json_decode(file_get_contents('php://input'));

function sendAsError($msg) {
  sendAsJsonResponse(['error' => $msg]);
  http_response_code(400);
}

if (!isset($body->chargePoint)) {
  sendAsError("Parameter 'chargePoint' missing");
  return;
}
if (strlen($body->chargePoint) > 255) {
  sendAsError("Wrong parameter value for 'chargePoint'");
  return;
}

if (!isset($body->enabled)) {
  sendAsError("Parameter 'enabled' missing");
  return;
}
if (!is_bool($body->enabled)) {
  sendAsError("Wrong parameter value for 'enabled'");
  return;
}

file_put_contents("/var/www/html/openWB/ramdisk/{$body->chargePoint}enabled", $body->enabled ? 1 : 0);
sendAsJsonResponse(['result' => "ok"]);
?>
