<?php
header('Content-Type: text/html; charset=UTF-8');
require_once "INPUT PASS OF db_info.php";

/**
 * SQL文実行用の関数
 *
 * 引数として渡したコマンドを実行し、その結果を帰り値とする。
 *
 * @param $sqlCommand DB上で実行するコマンド
 * @return 実行結果
 */
function mysqlCommand($sqlCommand)
{
    extract($GLOBALS);

    $db = new PDO($db_info, $db_id, $db_pass);
    $sql = $db->prepare($sqlCommand);
    $sql->execute();

    return $sql;
}

/**
 * データの有無を確認する
 */
function checkData($id)
{
    $command = "select count(del) as cnt from fileinfo where id = '".$id."';";
    echo $command;
    //$sqlResult = mysqlCommand($command);
    //$sqlResult = mysqlCommand("select * from fileinfo;");

    return 9;
    if (isset($sqlResult)) {
        // echo print_r($sqlResult);
        // foreach ($sqlResult as $value) {
        //     return $value['cnt'];
        // }
        return 0;
    } else {
        return 9;
    }
}
