<?php
    require_once('diary.php');

    $diary = new Diary();
    $result = $diary->getById($_GET['id']);
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
    <h3>タイトル：<?php echo $diary->escape($result['title']) ?></h3>
    <p>投稿日時：<?php echo $diary->escape($result['date']) ?></p>
    <p>評価：<?php echo $diary->starReview($result['review']) ?></p>
    <hr>
    <p>本文：<?php echo $diary->escape($result['content']) ?></p>
</body>
</html>