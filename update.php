<?php
    require_once('diary.php');

    $diary = new Diary('Diary');
    $result = $diary->getById($_GET['id']);
    if(!$result){
        exit('データがありません');
    }

    $id = $result['id'];
    $title = $result['title'];
    $review = (int)$result['review'];
    $content = $result['content'];
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>日記更新</title>
</head>
<body>
<form action="diary_update.php" method="post">
    <input type="hidden" name="id" value="<?php echo $id ?>" >
    <dl>
        <dt>タイトル</dt>
        <dd><input type="text" name="title" class="title" value="<?php echo $title ?>"></dd>
        <dt>今日の気分</dt>
        <dd>
            <select name="review" size="1">
                <option hidden>下記より選んでください</option>
                <option value="1" <?php if($review === 1) echo "selected" ?> >⭐︎</option>
                <option value="2" <?php if($review === 2) echo "selected" ?> >⭐︎⭐︎</option>
                <option value="3" <?php if($review === 3) echo "selected" ?> >⭐︎⭐︎⭐︎</option>
            </select>
        </dd>
        <dt>今日の出来事</dt>
        <dd><textarea name="content" cols="40" rows="10" class="textarea"><?php echo $content ?></textarea></dd>
    </dl>
    <input type="submit" value="記録">
    </form>
    <p><a href="/makeCalender.php">戻る</a></p>
</body>
</html>