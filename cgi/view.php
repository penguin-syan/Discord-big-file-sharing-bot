<?php
require_once '../db_connect.php';

$sqlResult = getData($_GET['id']);

print_r($sqlResult);

echo "<br>view";
