<?php
    require_once('diary.php');

    $diary = new Diary();
    $result = $diary->getById($_GET['id']);
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
    <h2>日記詳細</h2>
    <h3>タイトル：<?php echo $diary->escape($result['title']) ?></h3>
    <p>日時：<?php echo $diary->escape(date('Y-m-j', $result['id'])) ?></p>
    <p>最終更新：<?php echo $diary->escape($result['date']) ?></p>
    <p>評価：<?php echo $diary->starReview($result['review']) ?></p>
    <hr>
    <p><?php echo nl2br($diary->escape($result['content'])) ?></p>
    <a href="/update.php?id=<?php echo $result["id"] ?>">編集</a>
    <a href="/delete.php?id=<?php echo $result["id"] ?>">削除</a>
    <p><a href="/makeCalender.php">戻る</a></p>
</body>
</html>