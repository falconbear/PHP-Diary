<?php
    require_once('diary.php');
    require_once('calendar.php');

    $calendar = new Calendar();
    $diary = new Diary();

    date_default_timezone_set('Asia/Tokyo');

    $ym = $calendar->setYm();

    list('calendarTitle' => $calendar_title, 'prevMonth' => $prev, 'nextMonth' => $next, 'dayCount' => $day_count, '1stYoubi' => $youbi) = $calendar->getMonthData($ym);

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
    <title>Calendar</title>
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
    <div class="container">
    <h3 class="mb-5"><a href="?ym=<?php echo $prev; ?>">&lt;</a> <?php echo $calendar_title; ?> <a href="?ym=<?php echo $next; ?>">&gt;</a></h3>
        <table class="table table-bordered">
            <div class="varCal">
                <tr>
                    <?php for ($day = 1; $day <= $day_count; $day++, $youbi++): ?>
                        <?php
                            $date = $ym . '-' . $day;
                            $id = strtotime($date);
                        ?>
                        <td id="caldom" <?php if($date === $today) echo 'class="today"' ?>>
                            <div
                                <?php if($youbi % 7 === 0): ?>
                                    <?php echo 'class="sunday"' ?>
                                <?php elseif($youbi % 7 === 6): ?>
                                    <?php echo 'class="saturday"' ?>
                                <?php else: ?>
                                    <?php echo 'class="weekday"' ?>
                                <?php endif ?>
                            >
                                <?php echo $day." "?>
                                <div class="youbi"><?php echo $calendar->Youbi($youbi)?></div>
                            </div>
                        </td>
                        <td>
                            <?php $result = $diary->getById($id) ?>
                            <ul class="nikkidom">
                                <?php if(!$result): ?>
                                    <li class="no-nikki">
                                        <a href="/input.php?id=<?php echo $id ?>">新規作成</a>
                                    </li>
                                <?php else: ?>
                                    <li class="nikki-title"><?php echo $diary->escape($result['title']) ?></li>
                                    <li class="nikki-review"><?php echo $diary->starReview($result["review"]) ?></li>
                                    <li><a href="/detail.php?id=<?php echo $id ?>">詳細</a></li>
                                <?php endif ?>
                            </ul>
                        </td>
                        </tr><tr>
                    <?php endfor ?>
                </tr>
            </div>
        </table>
    </div>
</body>
</html>