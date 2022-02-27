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

    // 取得したデータの表示
    $diaryData = getAllDiary();

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
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>一覧表示</title>
</head>
<body>
    <table>
        <tr>
            <th>No</th>
            <th>日付</th>
            <th>タイトル</th>
            <th>評価</th>
        </tr>
        <?php foreach($diaryData as $column): ?>
        <tr>
            <td><?php echo $column["id"] ?></td>
            <td><?php echo $column["date"] ?></td>
            <td><?php echo $column["title"] ?></td>
            <td><?php echo starReview($column["review"]) ?></td>
            <td><a href="/detail.php?id=<?php echo $column["id"] ?>">詳細</a></td>
        </tr>
        <?php endforeach; ?>
    </table>
</body>
</html>