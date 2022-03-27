<?php
require_once '../vendor/autoload.php';

use Discord\Interaction;
use Discord\InteractionResponseType;

//$CLIENT_PUBLIC_KEY = getenv('CLIENT_PUBLIC_KEY');
$CLIENT_PUBLIC_KEY = "b217aaa27cdd602ecebf5fb8d690dc9df199b8a8d54d125754465ebdc9b14a9a";

$signature = $_SERVER['HTTP_X_SIGNATURE_ED25519'];
$timestamp = $_SERVER['HTTP_X_SIGNATURE_TIMESTAMP'];
$postData = file_get_contents('php://input');

$filename = './files/dump.tmp';
$fileinside = unpack('C*', $postData);
$fp = fopen($filename, 'w');
fwrite($fp, print_r($fileinside));
fclose($fp);

if (Interaction::verifyKey($postData, $signature, $timestamp, $CLIENT_PUBLIC_KEY)) {
    echo json_encode(array(
    'type' => InteractionResponseType::PONG
  ));
} else {
    http_response_code(401);
    echo "Not verified";
}