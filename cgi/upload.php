<!DOCTYPE html>

<html>
    <h1>ファイルアップロード</h1>
    <div>
        ファイルがアップロードされていません。<br>
        共有したいファイルをアップロードしてください。<br>
        <br>
        データの保存期間は約7日間です。
    </div>
    <form action="uploaded.php" method="post" enctype="multipart/form-data">
        <input type="file" name="upfile">
        <input type="hidden" name="id" value="<?php echo $_GET['id']; ?>">
        <input type="submit" value="アップロード">
    </form>
</html>