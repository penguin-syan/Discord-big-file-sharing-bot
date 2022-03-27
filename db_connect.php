<?php
header('Content-Type: text/html; charset=UTF-8');

/**
 * SQL文実行用の関数
 * 
 * 引数として渡したコマンドを実行し、その結果を帰り値とする。
 * 
 * @param string $sqlCommand DB上で実行するコマンド
 * @return string 実行結果
 */
function mysqlCommand(string $sqlCommand){
    extract($GLOBALS);

    $db = new PDO($db_info, $db_id, $db_pass);
    $sql = $db->prepare($sqlCommand);
    $sql -> execute();

    return $sql;
}

/**
 * 
 */
function checkData(){
    
}