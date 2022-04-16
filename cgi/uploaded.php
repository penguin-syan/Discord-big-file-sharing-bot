<?php
require_once '../db_connect.php';

if (is_uploaded_file($_FILES["upfile"]["tmp_name"])) {
    $filetype = 0;
    switch (mime_content_type($_FILES['upfile']['tmp_name'])) {
        case "image/png":
            $filetype = 1;
            break;
        case "image/jpeg":
            $filetype = 2;
            break;
        case "image/gif":
            $filetype = 3;
            break;
        case "video/quicktime":
            $filetype = 4;
            break;
        case "video/mp4":
            $filetype = 5;
            break;
        case "application/pdf":
            $filetype = 6;
            break;
        default:
            echo "このファイル形式はアップロードが許可されていません。<br>";
            echo "ERROR TYPE: ".mime_content_type($_FILES['upfile']['tmp_name']);
            return;
   }

    $upload_file = date("Ymd-His").$_FILES['upfile']['name'];
    addData($_POST['id'], $filetype, $upload_file);

    if (move_uploaded_file($_FILES["upfile"]["tmp_name"], $filepass.$upload_file)) {
        if(chmod($filepass.$upload_file, 0644)){
            echo "<meta http-equiv='refresh' content='5; url=https://bfs-bot.penguin-syan.tokyo/cgi/?id=".$_POST['id']."'>";
            echo "ファイルをアップロードしました。<br>5秒後に自動的に画面が切り替わります。";
        }else{
            echo "ファイルをアップロードしました。<br>5秒後に自動的に画面が切り替わります。<br>";
            echo "ERROR: ".__LINE__;
        }
    } else {
        echo "ファイルをアップロードできません。";
        return;
    }
} else {
    echo "ファイルが選択されていません。";
    return;
}
