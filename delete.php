<?php
    require_once('diary.php');

    $diary = new Diary();
    $result = $diary->delete($_GET['id']);
?>
<p><a href="/index.php">戻る</a></p>