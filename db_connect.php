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
function mysqlCommand($sqlCommand){
    extract($GLOBALS);

    $db = new PDO($db_info, $db_id, $db_pass);
    $sql = $db->prepare($sqlCommand);
    $sql->execute();

    return $sql;
}

/**
 * DB上のデータ有無を確認する
 *
 * idを引数として渡すことで、
 * データベース上にデータが登録されているか確認する。
 *
 * @param $id 検索するデータのID
 * @return int データの状態ID
 */
function checkData($id){
    $command = "select count(*) as cnt from fileinfo where id = '".$id."';";
    $sqlResult = mysqlCommand($command);

    if (isset($sqlResult)) {
        foreach ($sqlResult as $value) {
            if ($value['cnt'] == 0) {
                return 2; //not found.
            } else {
                return 0; //find file.
            }
        }
    } else {
        return 9; //error.
    }
}


function addData($id, $filetype, $filename){
    $command = "insert into fileinfo values('".$id."', '".date("Y-m-d", strtotime("+7 day"))."', ".$filetype.", '".$filename."', 0);";
    $sqlResult = mysqlCommand($command);
}


function getData($id){
    $command = "select * from fileinfo where id = '".$id."';";
    $sqlResult = mysqlCommand($command);

    return $sqlResult;
}

function removeData(){
    extract($GLOBALS);

    $command = "select * from fileinfo where removedate < (select curdate())";
    $sqlResult = mysqlCommand($command);

    foreach ($sqlResult as $value) {
        $command2 = "update fileinfo set del = 1 where id ='".$value['id']."'";
        $sqlResult2 = mysqlCommand($command2);
        exec("rm ".$filepass.$value['filename']);
    }
}
