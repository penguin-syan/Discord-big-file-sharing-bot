<?php
require_once '../db_connect.php';

$sqlResult = getData($_GET['id']);
$sqlResult = $sqlResult->fetch(PDO::FETCH_BOTH);

if ($sqlResult['del'] == 0) {
    switch ($sqlResult['filetyle']) {
        case 1:
            echo "img";
            echo "<img src='".$filepass.readfile($sqlResult['filename']).".>";
            break;
        case 2:
            echo "mov";
            break;
        case 3:
            echo "pdf";
            break;
        default:
            echo "ERROR: ".__LINE__;
    }
} else {
    echo "このデータは保存期間を超過したため削除されました";
}

echo "<br>view";
?>