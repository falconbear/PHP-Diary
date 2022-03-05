<?php
    require_once('diary.php');
    require_once('calender.php');

    $calender = new Calender();
    $diary = new Diary();

    date_default_timezone_set('Asia/Tokyo');

    $ym = $calender->setYm();

    list('calenderTitle' => $calender_title, 'prevMonth' => $prev, 'nextMonth' => $next, 'dayCount' => $day_count, '1stYoubi' => $youbi) = $calender->getMonthData($ym);

    // 今日の日付 フォーマット　例）2021-06-3
    $today = date('Y-m-j');
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
                <li><a href="/list.php">日記一覧</a></li>
                <li><a href="/verticalCal.php">縦型カレンダー</a></li>
                <!-- <li><a href="#vision">習慣登録</a></li>
                <li><a href="#contact">習慣ログ</a></li> -->
            </ul>
        </nav>
    </header>
    <div class="container">
    <h3 class="mb-5"><a href="?ym=<?php echo $prev; ?>">&lt;</a> <?php echo $calender_title; ?> <a href="?ym=<?php echo $next; ?>">&gt;</a></h3>
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
            <tr>
                <?php for ($i = 0; $i < $youbi; $i++): ?>
                    <td></td>
                <?php endfor ?>
                <?php for ($day = 1; $day <= $day_count; $day++, $youbi++): ?>
                    <?php
                        $date = $ym . '-' . $day;
                        $id = strtotime($date);
                    ?>
                    <td <?php if($date === $today) echo 'class="today"' ?>>
                            <?php echo $day ?><br><br>
                        <?php $result = $diary->getById($id) ?>
                        <div class="linkbutton">
                            <?php if(!$result): ?>
                                <form action="/input.php" method="POST">
                                    <input type="hidden" name="id" value="<?php echo $id ?>" >
                                    <input type="submit" value="新規作成" class="button">
                                </form>
                            <?php else: ?>
                                <a href="/detail.php?id=<?php echo strtotime($ym.'-'.$day); ?>">日記を見る</a>
                            <?php endif ?>
                        </div>
                    </td>
                    <?php if($youbi % 7 == 6): ?>
                        </tr><tr>
                    <?php endif ?>
                <?php endfor ?>
                <?php for($j = 0; $j < (6 - ($youbi - 1) % 7); $j++): ?>
                    <td></td>
                <?php endfor ?>
            </tr>
        </table>
    </div>
</body>
</html>