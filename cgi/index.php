<?php
require_once 'upload.php';

if (is_uploaded_file($_FILES["upfile"]["tmp_name"])) {
    $upload_file = date("Ymd-His").$_FILES['upfile']['name'];
    if (move_uploaded_file($_FILES["upfile"]["tmp_name"], "../files/".$upload_file)) {
        chmod("../files/".$upload_file, 0644);
        echo "メニューを追加しました．";
    } else {
        echo "ファイルをアップロードできません。";
        return;
    }
} else {
    echo "ファイルが選択されていません。";
    return;
}
