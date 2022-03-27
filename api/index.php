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
        file_put_contents("./tmp", "ulfile()");

        http_response_code(200);
        // $returnArray = json_encode((array(
        //     'type' => InteractionResponseType::CHANNEL_MESSAGE_WITH_SOURCE,
        //     'data' => array(
        //         'content' => "aaaaa"
        //     )
        // )));

        $returnArray = json_encode(array(
            "http" => array(
                "method" => "POST",
                "content" => array(
                    "type" => InteractionResponseType::CHANNEL_MESSAGE_WITH_SOURCE,
                    "data" => array(
                        "content" => "aaa"
                    )
                )
            )
        ));

        echo $returnArray;

        file_put_contents("./tmp", $returnArray);

        file_put_contents('php://output', $returnArray);
        file_put_contents($_POST['BODY'], $returnArray);

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
