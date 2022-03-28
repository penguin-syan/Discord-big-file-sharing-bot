<?php
require_once '../db_connect.php';

//switch(checkData($_GET['id'])){
switch(9){
    case 0: //アップロード済み
        require_once 'view.php';
        break;
    case 1: //削除済み
        echo "このデータは保存期間を超過したため削除されました。";
        break;
    default:
        require_once 'upload.php';
}
