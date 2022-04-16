<?php
require_once '../db_connect.php';

$sqlResult = getData($_GET['id']);
$sqlResult = $sqlResult->fetch(PDO::FETCH_BOTH);

if ($sqlResult['del'] == 0) {
    switch ($sqlResult['filetype']) {
        case 1:
            header('Content-Type: image/png');
            break;
        case 2:
            header('Content-Type: image/jpeg');
            break;
        case 3:
            header('Content-Type: image/gif');
            break;
        case 4:
            header('Content-Type: video/quicktime');
            break;
        case 5:
            header('Content-Type: video/mp4');
            break;
        case 6:
            header('Content-Type: application/pdf');
            break;
        default:
            echo "ERROR: ".__LINE__;
    }
    readfile($filepass.$sqlResult['filename']);
} else {
    echo "このデータは保存期間を超過したため削除されました";
}
?>