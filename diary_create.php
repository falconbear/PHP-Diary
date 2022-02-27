<?php
    require_once('dbconnect.php');

    // バリデーション
    $diary = $_POST;
    if(empty($diary['title'])){
        exit('タイトルを入力してください');
    }
    if(mb_strlen($diary['title']) > 50){
        exit('タイトルは50文字以下にしてください');
    }
    if(empty($diary['review'])){
        exit('評価を入力してください');
    }
    if(empty($diary['content'])){
        exit('本文を入力してください');
    }
    
    $sql = 'INSERT INTO
                diary(title, review, content)
            VALUES
            (:title, :review, :content)';

    $dbh = dbConnect();

    // トランザクション
    $dbh->beginTransaction();

    try{
        $stmt = $dbh->prepare($sql);
        $stmt->bindValue(':title', $diary['title'], PDO::PARAM_STR);
        $stmt->bindValue(':review', $diary['review'], PDO::PARAM_INT);
        $stmt->bindValue(':content', $diary['content'], PDO::PARAM_STR);
        $stmt->execute();
        $dbh->commit();

        echo 'ブログを投稿しました!';
    }catch(PDOException $e){
        $dbh->rollback();
        exit($e);
    }
?>