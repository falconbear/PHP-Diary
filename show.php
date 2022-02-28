<?php
    require_once('diary.php');
    ini_set('display_errors', "on");

    $diary = new Diary();
    // 取得したデータの表示
    $diaryData = $diary->getAll();
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
            <td><?php echo $diary->escape($column['date']) ?></td>
            <td><?php echo $diary->escape($column['title']) ?></td>
            <td><?php echo $diary->starReview($column["review"]) ?></td>
            <td><a href="/detail.php?id=<?php echo $column["id"] ?>">詳細</a></td>
            <td><a href="/update.php?id=<?php echo $column["id"] ?>">編集</a></td>
        </tr>
        <?php endforeach; ?>
    </table>
</body>
</html>


<!-- 参考文献
https://code-notes.com/lesson/4 -->