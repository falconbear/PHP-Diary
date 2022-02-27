<?php
    // データベース接続
    function dbConnect(){
        $dsn = 'mysql:host=localhost;dbname=Diary_app;charset=utf8';
        $user = 'diary_user';
        $pass = 'hayabusakuma64';

        try{
            $dbh = new PDO($dsn, $user, $pass, [
                PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
            ]);
        }catch(PDOException $e){
            echo '接続失敗'. $e->getMessage();
            exit();
        };

        return $dbh;
    }

    // データ取得
    function getAllDiary(){
        $dbh = dbConnect();

        // SQL文の準備
        $sql = 'SELECT * from Diary';

        // SQLの実行
        $stmt = $dbh->query($sql);

        // SQLの結果を受け取る
        $result = $stmt->fetchall(PDO::FETCH_ASSOC);

        return $result;
        $dbh = null;
    }

    // 星評価の実装
    function starReview($number){
        if($number === '1'){
            return '⭐️';
        } elseif($number === '2'){
            return '⭐️⭐️';
        } elseif($number === '3'){
            return '⭐️⭐️⭐️';
        } else{
            return 'その他';
        }
    }


    // 引数：$id
    // 返り値：$result
    function getDiary($id){
        if(empty($id)){
            exit('IDが不正です');
        }
    
        $dbh = dbConnect();
    
        // SQL準備
        $stmt = $dbh->prepare('SELECT * from Diary Where id = :id');
        $stmt->bindValue(':id', (int)$id, PDO::PARAM_INT);
    
        // SQL実行
        $stmt->execute();
    
        // 結果を取得
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
    
        if(!$result){
            exit('データがありません');
        }

        return $result;
    }
?>