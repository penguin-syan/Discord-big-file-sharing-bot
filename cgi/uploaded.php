<?php
define("FILEPASS", "");

if (is_uploaded_file($_FILES["upfile"]["tmp_name"])) {
   $upload_file = date("Ymd-His").$_FILES['upfile']['name'];
   if (move_uploaded_file ($_FILES["upfile"]["tmp_name"], $FILEPASS.$upload_file)) {
      chmod($FILEPASS.$upload_file, 0644);
      echo "ファイルをアップロードしました。";
  } else {
      echo "ファイルをアップロードできません。";
      return;
  }
} else {
   echo "ファイルが選択されていません。";
   return;
}