<?php
    // $id = $_POST["id"];
    $id = $_GET["id"];
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link rel="stylesheet" href="./style.css">
    <title>入力</title>
</head>
<body>
    <header>
        <nav class="navbar">
            <h1 class="headTitle">カレンダイアリー</h1>
            <ul class="link">
                <li><a href="/list.php">日記一覧</a></li>
                <li><a href="/index.php">カレンダー</a></li>
                <!-- <li><a href="#vision">習慣登録</a></li>
                <li><a href="#contact">習慣ログ</a></li> -->
            </ul>
        </nav>
    </header>
<form action="diary_create.php" method="post">
    <input type="hidden" name="id" value="<?php echo $id ?>" >
    <dl class="input">
        <dt>タイトル</dt>
        <dd><input type="text" name="title" class="title"></dd>
        <dt>今日の気分</dt>
        <dd>
            <select name="review" size="1">
                <option hidden>下記より選んでください</option>
                <option value="1">⭐︎</option>
                <option value="2">⭐︎⭐︎</option>
                <option value="3">⭐︎⭐︎⭐︎</option>
            </select>
        </dd>
        <dt>今日の出来事</dt>
        <dd><textarea name="content" cols="40" rows="10" class="textarea"></textarea></dd>
    </dl>
    <br>
    <br>
    <input type="submit" value="記録" class="button" id="input">
    </form>
</body>
</html>