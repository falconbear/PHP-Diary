<?php

$dsn = '';
$user = '';
$pass = '';

try{
    $dbh = new PDO($dsn, $user, $pass, [
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
    ]);
    echo '接続成功';
    $dbh = null;
}catch(PDOException $e){
    echo '接続失敗'. $e->getMessage();
    exit();
}


var_dump($dbh);

?>