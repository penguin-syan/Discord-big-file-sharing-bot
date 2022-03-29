<?php
const FILEPASS = "";

echo $_FILES['upfile']['error'];
if (is_uploaded_file($_FILES["upfile"]["tmp_name"])) {
    $filetype;
    switch (mime_content_type($_FILES['upfile']['tmp_name'])) {
        case "image/png":
        case "image/jpeg":
        case "image/gif":
            $filetype = "image";
            break;
        case "video/quicktime":
            break;
        default:
            echo "このファイル形式はアップロードが許可されていません。";
            echo mime_content_type($_FILES['upfile']['tmp_name']);
            return;
   }

    $upload_file = date("Ymd-His").$_FILES['upfile']['name'];
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
