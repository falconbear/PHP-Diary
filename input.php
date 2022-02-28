<?php
    $id = $_POST["id"];
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>日記記入</title>
</head>
<body>
<form action="diary_create.php" method="post">
    <input type="hidden" name="id" value="<?php echo $id ?>" >
    <dl>
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
    <input type="submit" value="記録">
    </form>
    <p><a href="/makeCalender.php">戻る</a></p>
</body>
</html>