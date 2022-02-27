<?php
    $id = $_GET['id'];

    function dbConnect(){
        $dsn = 'mysql:host=localhost;dbname=Diary_app;charset=utf8';
        $user = 'diary_user';
        $pass = 'hayabusakuma64';

        try{
            $dbh = new PDO($dsn, $user, $pass, [
                PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                PDO::ATTR_EMULATE_PREPARES => false,
            ]);
        }catch(PDOException $e){
            echo '接続失敗'. $e->getMessage();
            exit();
        };

        return $dbh;
    }

    $dbh = dbConnect();

    // SQL準備
    $stmt = $dbh->prepare('SELECT * from Diary Where id = :id');
    $stmt->bindValue(':id', (int)$id, PDO::PARAM_INT);

    // SQL実行
    $stmt->execute();

    // 結果を取得
    $result = $stmt->fetch(PDO::FETCH_ASSOC);

    var_dump($result);
?>