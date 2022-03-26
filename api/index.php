<?php
require_once '../vendor/autoload.php';
require_once '../vendor/discord/interactions/discord/InteractionResponseType.php';
//require_once 'vendor/discord/interactions/Interaction.php';

use Discord\Interaction;
use Discord\InteractionResponseType;

$CLIENT_PUBLIC_KEY = getenv('CLIENT_PUBLIC_KEY');

$signature = $_SERVER['HTTP_X_SIGNATURE_ED25519'];
$timestamp = $_SERVER['HTTP_X_SIGNATURE_TIMESTAMP'];
$postData = file_get_contents('php://input');

if (Interaction::verifyKey($postData, $signature, $timestamp, $CLIENT_PUBLIC_KEY)) {
  echo json_encode(array(
    'type' => InteractionResponseType::PONG
  ));
} else {
  http_response_code(401);
  echo "Not verified";
}