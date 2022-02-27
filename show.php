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
        $content = '';
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
            list($id,$date,$title,$review,$content) = explode("\t",$line);

            $DATA[] = array(
                'id'=>$id,
                'date'=>$date,
                'title'=>$title,
                'review'=>$review,
                'content'=>$content,
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
                <?php echo brToTag( escape($d['content']) ); ?><br>
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