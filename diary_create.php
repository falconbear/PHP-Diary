<?php
    require_once('diary.php');
    ini_set('display_errors', "on");

    $diary = new Diary();

    $diaries = $_POST;
    
    $diary->validate($diaries);
    $diary->diaryCreate($diaries);
    
?>