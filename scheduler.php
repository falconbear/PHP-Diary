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
        <nav class="navBer">
            <ul>
                <li><a href="#home">Home</a></li>
                <li><a href="#aboutMe">About Me</a></li>
                <li><a href="#vision">Vision</a></li>
                <li><a href="#contact">Contact</a></li>
            </ul>
        </nav>
    </header>
    <h1 text_aline="center">カレンダー</h1>
    <?php
    // タイムゾーンを設定
    date_default_timezone_set('Asia/Tokyo');

    // 前月・次月リンクが押された場合は、GETパラメーターから年月を取得
    if (isset($_GET['ym'])) {
        $ym = $_GET['ym'];
    } else {
        // 今月の年月を表示
        $ym = date('Y-m');
    }

    // タイムスタンプを作成し、フォーマットをチェックする
    $timestamp = strtotime($ym . '-01');
    if ($timestamp === false) {
        $ym = date('Y-m');
        $timestamp = strtotime($ym . '-01');
    }

    // 今日の日付 フォーマット　例）2021-06-3
    $today = date('Y-m-j');

    // カレンダーのタイトルを作成　例）2021年6月
    $html_title = date('Y年n月', $timestamp);

    // 前月・次月の年月を取得
    // 方法１：mktimeを使う mktime(hour,minute,second,month,day,year)
    $prev = date('Y-m', mktime(0, 0, 0, date('m', $timestamp)-1, 1, date('Y', $timestamp)));
    $next = date('Y-m', mktime(0, 0, 0, date('m', $timestamp)+1, 1, date('Y', $timestamp)));

    // 方法２：strtotimeを使う
    // $prev = date('Y-m', strtotime('-1 month', $timestamp));
    // $next = date('Y-m', strtotime('+1 month', $timestamp));

    // 該当月の日数を取得
    $day_count = date('t', $timestamp);

    // １日が何曜日か　0:日 1:月 2:火 ... 6:土
    // 方法１：mktimeを使う
    $youbi = date('w', mktime(0, 0, 0, date('m', $timestamp), 1, date('Y', $timestamp)));
    // 方法２
    // $youbi = date('w', $timestamp);


    // カレンダー作成の準備
    $weeks = [];
    $week = '';

    // 第１週目：空のセルを追加
    // 例）１日が火曜日だった場合、日・月曜日の２つ分の空セルを追加する
    $week .= str_repeat('<td></td>', $youbi);

    for ( $day = 1; $day <= $day_count; $day++, $youbi++) {

        // 例）2021-06-3
        $date = $ym . '-' . $day;
        
        // 例）<td>3</td>
        if ($today == $date) {
            // 今日の日付の場合は、class="today"をつける
            $week .= '<td class="today">' . $day;
        } else {
            $week .= '<td>' . $day;
        }
        $week .= '<br><button class="toDiary"><a href="input.html">日記をつける</a></button><br><button class="show"><a href="show.php">日記を見る</a></button><button class="edit"><a href="show.php">編集</a></button></td>';

        // 週終わり、または、月終わりの場合
        if ($youbi % 7 == 6 || $day == $day_count) {

            if ($day == $day_count) {
                // 月の最終日の場合、空セルを追加
                // 例）最終日が水曜日の場合、木・金・土曜日の空セルを追加
                $week .= str_repeat('<td></td>', 6 - $youbi % 7);
            }

            // weeks配列にtrと$weekを追加する
            $weeks[] = '<tr>' . $week . '</tr>';

            // weekをリセット
            $week = '';
        }
    }

    /* 保存ファイル名 */
    define('SAVE_NAME','memo.txt');

    /* ユニークなID */
    $id = uniqid();
    /* 日時 */
    $date = date('Y/m/d H:i');

    $title = '';

    $review = '';
    /* テキスト */
    $text = '';

    // KPT用の配列
    $keep = array();
    $problem = array();
    $try = array();

    /* 保存データが無い時、作成 */
    if (!file_exists(SAVE_NAME)) touch(SAVE_NAME);
    /* 保存済データを読込 */
    $lines = '';

    /* $_POST の中にPOST入力が入る */
    if (!empty($_POST['title']) && !empty($_POST['review']) && !empty($_POST['text'])) {

        $title = $_POST['title'];
        $review = $_POST['review'];
        $text = $_POST['text'];

        /* 改行コードの統一 */
        $text = str_replace("\r\n","\n",$text);
        $text = str_replace("\r","\n",$text);
        /* 改行コードを改行タグに */
        $text = str_replace("\n","<br>",$text);
        /* 区切り文字を除去 */
        $text = str_replace("\t","",$text);
        $title = str_replace("\t","",$title);

        /* 新規に登録するデータ */
        $line = $id."\t".$date."\t".$title."\t".$review."\t".$text."\n";

        /* 新規データの後ろに保存済データを追加、更新 */
        $lines = $line.$lines;
        file_put_contents(SAVE_NAME, $lines);

    /* $_POST['id'] に削除対象のIDが入る */
    } elseif(isset($_POST['id']) && is_array($_POST['id'])) {

        $new = '';

        foreach(explode("\n",$lines) as $line){

            /* データ仕様に合わない場合、次へ */
            if( strpos($line,"\t")===false ) continue;

            // 区切り文字でデータを分離 explodeは第一引数を境に文字列を分割して配列化する
            list($id,$date,$title,$review,$text) = explode("\t",$line);

            /* IDが指定されていた時、除外 */
            if(in_array($id,$_POST['id'])) continue;

            /* 新規保存データを作成 */
            $new .= $line."\n";
        }
        
        //ファイルに書き込み
        file_put_contents(SAVE_NAME, $new);
    }
    ?>
    <div class="container">
    <h3 class="mb-5"><a href="?ym=<?php echo $prev; ?>">&lt;</a> <?php echo $html_title; ?> <a href="?ym=<?php echo $next; ?>">&gt;</a></h3>
        <table class="table table-bordered">
            <tr>
                <th>日</th>
                <th>月</th>
                <th>火</th>
                <th>水</th>
                <th>木</th>
                <th>金</th>
                <th>土</th>
            </tr>
            <?php
                foreach ($weeks as $week) {
                    echo $week;
                }
            ?>
        </table>
    </div>
</body>
</html>