<?php
    require_once('dbconnect.php');

    $dbc = new Dbc;

    // バリデーション
    $diaries = $_POST;
    if(empty($diaries['title'])){
        exit('タイトルを入力してください');
    }
    if(mb_strlen($diaries['title']) > 50){
        exit('タイトルは50文字以下にしてください');
    }
    if(empty($diaries['review'])){
        exit('評価を入力してください');
    }
    if(empty($diaries['content'])){
        exit('本文を入力してください');
    }
    
    $dbc->diaryCreate($diaries);
    
?>