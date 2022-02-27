<?php
    require_once('diary.php');
    ini_set('display_errors', "on");

    $diary = new Diary('Diary');
    // 取得したデータの表示
    $diaryData = $diary->getAll();
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
    <h2>日記一覧</h2>
    <p><a href="/input.html">新規作成</a></p>
    <table>
        <tr>
            <th>日付</th>
            <th>タイトル</th>
            <th>評価</th>
        </tr>
        <?php foreach($diaryData as $column): ?>
        <tr>
            <td><?php echo $column["date"] ?></td>
            <td><?php echo $column["title"] ?></td>
            <td><?php echo $diary->starReview($column["review"]) ?></td>
            <td><a href="/detail.php?id=<?php echo $column["id"] ?>">詳細</a></td>
            <td><a href="/update.php?id=<?php echo $column["id"] ?>">編集</a></td>
        </tr>
        <?php endforeach; ?>
    </table>
</body>
</html>