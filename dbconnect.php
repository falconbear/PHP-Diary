<?php

$dsn = 'mysql:host=localhost;dbname=Diary_app;charset=utf8';
$user = 'diary_user';
$pass = 'hayabusakuma64';

try{
    $dbh = new PDO($dsn, $user, $pass, [
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
    ]);

    // echo '接続成功';

    // SQL文の準備
    $sql = 'SELECT * from Diary';

    // SQLの実行
    $stmt = $dbh->query($sql);

    // SQLの結果を受け取る
    $result = $stmt->fetchall(PDO::FETCH_ASSOC);

    $dbh = null;

}catch(PDOException $e){
    echo '接続失敗'. $e->getMessage();
    exit();
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
        </tr>
        <?php foreach($result as $column): ?>
        <tr>
            <td><?php echo $column["id"] ?></td>
            <td><?php echo $column["date"] ?></td>
            <td><?php echo $column["title"] ?></td>
        </tr>
        <?php endforeach; ?>
    </table>
</body>
</html>