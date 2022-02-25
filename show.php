<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <?php
        /* 保存ファイル名 */
        define('SAVE_NAME','memo.txt');

        $id = '';
        $date = '';
        $title = '';
        $review = '';
        $text = '';
        $k1 = '';
        $k2 = '';
        $k3 = '';
        $p1 = '';
        $p2 = '';
        $p3 = '';
        $t1 = '';
        $t2 = '';
        $t3 = '';
        $lines = file_get_contents(SAVE_NAME);
        $line = '';

        // エスケープ関数  エスケープ処理とは、文字列の中で特殊な働きをする記号を単なる文字として認識させるための処理
        function escape($v){ 
            return htmlspecialchars($v, ENT_QUOTES, 'UTF-8'); 
        }
        function echoEscape($v){ 
            echo escape($v);
        }
        /* brタグの有効化 */
        function brToTag($v){
            /* エスケープされた<br>を戻す */
            return str_replace('&lt;br&gt;','<br>',$v);
        }

        /* 出力用の変数 */
        $DATA = array();

        /* 出力用に代入 */
        foreach(explode("\n",$lines) as $line){

            /* データ仕様に合わない場合、次へ */
            if( strpos($line,"\t") === false ) continue;

            /* 区切り文字でデータを分離 */
            list($id,$date,$title,$review,$text,$k1,$k2,$k3,$p1,$p2,$p3,$t1,$t2,$t3,) = explode("\t",$line);

            $DATA[] = array(
                'id'=>$id,
                'date'=>$date,
                'title'=>$title,
                'review'=>$review,
                'text'=>$text,
                'k1'=>$k1,
                'k2'=>$k2,
                'k3'=>$k3,
                'p1'=>$p1,
                'p2'=>$p2,
                'p3'=>$p3,
                't1'=>$t1,
                't2'=>$t2,
                't3'=>$t3
            );
        }

    ?>

    <?php if(count($DATA)): ?>
    <form action="scheduler.php" method="post">
        <table>
            <?php foreach($DATA as $d): ?>
            <div>
                <p>最終更新：</p><?php echoEscape($d['date']); ?><br>
                <?php echoEscape($d['title']); ?><br>
                <?php echoEscape($d['review']); ?><br>
                <?php echo brToTag( escape($d['text']) ); ?><br>
                <ul>
                    <p>KEEP</p><br>
                    <li><?php echoEscape($d['k1']); ?><br></li>
                    <li><?php echoEscape($d['k2']); ?><br></li>
                    <li><?php echoEscape($d['k3']); ?><br></li>
                </ul>
                <ul>
                    <p>PROBLEM</p><br>
                    <li><?php echoEscape($d['p1']); ?><br></li>
                    <li><?php echoEscape($d['p2']); ?><br></li>
                    <li><?php echoEscape($d['p3']); ?><br></li>
                </ul>
                <ul>
                    <p>TRY</p><br>
                    <li><?php echoEscape($d['t1']); ?><br></li>
                    <li><?php echoEscape($d['t2']); ?><br></li>
                    <li><?php echoEscape($d['t3']); ?><br></li>
                </ul>
                <label><input type="checkbox" name="id[]" value="<?php echoEscape($d['id']); ?>">削除</label>
            </div>
            <?php endforeach; ?>
        </table>
        <input type="submit" value="メモを削除">
    </form>
    <?php endif; ?>
</body>
</html>


<!-- 参考文献
https://code-notes.com/lesson/4 -->