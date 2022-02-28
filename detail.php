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
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="./style.css">
    <title>Calender</title>
</head>
<body>
    <header>
        <nav class="navbar">
            <h1 class="headTitle">カレンダイアリー</h1>
            <ul class="link">
                <li><a href="/index.php">日記一覧</a></li>
                <li><a href="/makeCalender.php">カレンダー</a></li>
                <li><a href="#vision">習慣登録</a></li>
                <li><a href="#contact">習慣ログ</a></li>
            </ul>
        </nav>
    </header>
    <div class="detail">
        <h2>日記詳細</h2>
        <h3>タイトル：<?php echo $diary->escape($result['title']) ?></h3>
        <p>日時：<?php echo $diary->escape(date('Y-m-j', $result['id'])) ?></p>
        <p>最終更新：<?php echo $diary->escape($result['date']) ?></p>
        <p>評価：<?php echo $diary->starReview($result['review']) ?></p>
        <hr>
        <p><?php echo nl2br($diary->escape($result['content'])) ?></p>
        <a href="/update.php?id=<?php echo $result["id"] ?>">編集</a>
        <a href="/delete.php?id=<?php echo $result["id"] ?>">削除</a>
    </div>
</body>
</html>