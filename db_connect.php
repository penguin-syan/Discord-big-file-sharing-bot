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
    $command = "select count(*) as cnt from fileinfo where id = '".$id."';";
    $sqlResult = mysqlCommand($command);

    if (isset($sqlResult)) {
        foreach ($sqlResult as $value) {
            if($value['cnt'] == 0){
                return 2;
            }else{
                return 0;
            }
        }
        return 0;
    } else {
        return 9;
    }
}


function addData(){
    
}


function getData($id){
    $command = "select * from fileinfo where id = '".$id."';";
    $sqlResult = mysqlCommand($command);

    
}