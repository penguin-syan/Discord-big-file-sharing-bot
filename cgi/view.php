<?php
require_once '../db_connect.php';

$sqlResult = getData($_GET['id']);
$sqlResult = $sqlResult->fetch(PDO::FETCH_BOTH);

print_r($sqlResult);

echo "<br>view";
