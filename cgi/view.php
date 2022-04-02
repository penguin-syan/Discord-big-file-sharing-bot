<?php
require_once '../db_connect.php';

$sqlResult = getData($_GET['id']);

print_r($sqlResult[0]);

echo "<br>view";
