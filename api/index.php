<?php
require_once '../vendor/autoload.php';

use Discord\Interaction;
use Discord\InteractionResponseType;

//$CLIENT_PUBLIC_KEY = getenv('CLIENT_PUBLIC_KEY');
$CLIENT_PUBLIC_KEY = "b217aaa27cdd602ecebf5fb8d690dc9df199b8a8d54d125754465ebdc9b14a9a";

$signature = $_SERVER['HTTP_X_SIGNATURE_ED25519'];
$timestamp = $_SERVER['HTTP_X_SIGNATURE_TIMESTAMP'];

$filename = './files/dump.tmp';
$data = json_decode($postData, true);
$fp = fopen($filename, 'w');
foreach ($data as $key => $value) {
    fwrite($fp, $key.":".$value.",".PHP_EOL);
}
fwrite($fp, $data['data']['name'].PHP_EOL);
fclose($fp);

if (Interaction::verifyKey($postData, $signature, $timestamp, $CLIENT_PUBLIC_KEY)) {
    switch ($data['data']['name']) {
    case 'ulfile':
        header("Content-Type: application/json");
        $returnArray = json_encode((array(
            'type' => InteractionResponseType::CHANNEL_MESSAGE_WITH_SOURCE,
            'data' => array(
                'content' => "bbb"
            )
        )), JSON_UNESCAPED_UNICODE);
        echo $returnArray;
        break;
    default:
        echo json_encode(array(
        'type' => InteractionResponseType::PONG
        ));
  }
} else {
    http_response_code(401);
    echo "Not verified";
}
