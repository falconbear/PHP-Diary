<?php
    $id = $_GET['id'];

    if(empty($id)){
        exit('IDが不正です');
    }

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

    if(!$result){
        exit('データがありません');
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>詳細</title>
</head>
<body>
    <h2>ブログ詳細</h2>
    <h3>タイトル：<?php echo $result['title'] ?></h3>
    <p>投稿日時：<?php echo $result['date'] ?></p>
    <p>評価：<?php echo $result['review'] ?></p>
    <hr>
    <p>本文：<?php echo $result['text'] ?></p>
</body>
</html>