<?php
require_once '../vendor/autoload.php';

use Discord\Interaction;
use Discord\InteractionResponseType;

//$CLIENT_PUBLIC_KEY = getenv('CLIENT_PUBLIC_KEY');
$CLIENT_PUBLIC_KEY = "b217aaa27cdd602ecebf5fb8d690dc9df199b8a8d54d125754465ebdc9b14a9a";

$signature = $_SERVER['HTTP_X_SIGNATURE_ED25519'];
$timestamp = $_SERVER['HTTP_X_SIGNATURE_TIMESTAMP'];
$postData = file_get_contents('php://input');
$data = json_decode($postData, true);

if (Interaction::verifyKey($postData, $signature, $timestamp, $CLIENT_PUBLIC_KEY)) {
    switch ($data['data']['name']) {
    case 'ulfile':
        header("Content-Type: application/json");
        $returnArray = json_encode((array(
            'type' => InteractionResponseType::CHANNEL_MESSAGE_WITH_SOURCE,
            'data' => array(
                'content' => "https://bfs-bot.penguin-syan.tokyo/cgi/?id=".$data['id']
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