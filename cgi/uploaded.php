<?php
require_once '../db_connect.php';

const FILEPASS = "";

echo $_FILES['upfile']['error'];
if (is_uploaded_file($_FILES["upfile"]["tmp_name"])) {
    $filetype = 0;
    switch (mime_content_type($_FILES['upfile']['tmp_name'])) {
        case "image/png":
        case "image/jpeg":
        case "image/gif":
            $filetype = 1; //img
            break;
        case "video/quicktime":
        case "video/mp4":
            $filetype = 2; //mov
            break;
        case "application/pdf":
            $filetype = 3; //doc
            break;
        default:
            echo "このファイル形式はアップロードが許可されていません。<br>";
            echo "ERROR TYPE: ".mime_content_type($_FILES['upfile']['tmp_name']);
            return;
   }

    $upload_file = date("Ymd-His").$_FILES['upfile']['name'];
    addData($_POST['id'], $filetype, $upload_file);

    if (move_uploaded_file($_FILES["upfile"]["tmp_name"], FILEPASS.$upload_file)) {
        chmod(FILEPASS.$upload_file, 0644);
        echo "ファイルをアップロードしました。";
    } else {
        echo "ファイルをアップロードできません。";
        return;
    }
} else {
    echo "ファイルが選択されていません。";
    return;
}
