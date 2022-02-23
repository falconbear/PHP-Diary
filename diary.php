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
        /* エスケープ関数 */
        function h($v){ return htmlspecialchars($v, ENT_QUOTES, 'UTF-8'); }
        function eh($v){ echo h($v); }
        /* brタグの有効化 */
        function br2tag($v){

            /* エスケープされた<br>を戻す */
            return str_replace('&lt;br&gt;','<br>',$v);
        }

        /* 保存ファイル名 */
        define('SAVE_NAME','memo.txt');

        /* ユニークなID */
        $id = uniqid();
        /* 日時 */
        $date = date('Y/m/d H:i');
        /* テキスト */
        $text = '';

        /* 保存データが無い時、作成 */
        if (!file_exists(SAVE_NAME)) touch(SAVE_NAME);
        /* 保存済データを読込 */
        $lines = file_get_contents(SAVE_NAME);

        /* $_POST の中にPOST入力が入る */
        if (!empty($_POST['text'])) {

            $text = $_POST['text'];

            /* 改行コードの統一 */
            $text = str_replace("\r\n","\n",$text);
            $text = str_replace("\r","\n",$text);
            /* 改行コードを改行タグに */
            $text = str_replace("\n","<br>",$text);
            /* 区切り文字を除去 */
            $text = str_replace("\t","",$text);

            /* 新規に登録するデータ */
            $line = $id."\t".$date."\t".$text."\n";

            /* 新規データの後ろに保存済データを追加、更新 */
            $lines = $line.$lines;
            file_put_contents(SAVE_NAME, $lines);

        /* $_POST['id'] に削除対象のIDが入る */
        } elseif(isset($_POST['id']) && is_array($_POST['id'])) {

            $new = '';
            foreach(explode("\n",$lines) as $line){

                /* データ仕様に合わない場合、次へ */
                if( strpos($line,"\t")===false ) continue;

                /* 区切り文字でデータを分離 */
                list($id,$date,$text) = explode("\t",$line);

                /* IDが指定されていた時、除外 */
                if(in_array($id,$_POST['id'])) continue;

                /* 新規保存データを作成 */
                $new .= $line."\n";
            }
            file_put_contents(SAVE_NAME, $new);
            /* 新規保存データで読み込んだ変数を更新 */
            $lines = $new;
        }

        /* 出力用の変数 */
        $DATA = array();

        /* 出力用に代入 */
        foreach(explode("\n",$lines) as $line){

            /* データ仕様に合わない場合、次へ */
            if( strpos($line,"\t")===false ) continue;

            /* 区切り文字でデータを分離 */
            list($id,$date,$text) = explode("\t",$line);

            $DATA[] = array(
                'id'=>$id,
                'date'=>$date,
                'text'=>$text
            );
        }

    ?>

    <?php if(count($DATA)): ?>
    <form method="post">
        <table>
            <?php foreach($DATA as $d): ?>
            <tr>
                <td><?php eh($d['date']); ?></td>
                <td><?php echo br2tag( h($d['text']) ); ?></td>
                <td><label><input type="checkbox" name="id[]" value="<?php eh($d['id']); ?>">削除</label></td>
            </tr>
            <?php endforeach; ?>
        </table>
        <input type="submit" value="メモを削除">
    </form>
    <?php endif; ?>

    <form method="post">
    <dl>
        <dt><span>タイトル</span></dt>
        <dd><input type="text" name="name" class="name"></dd>
        <dt>今日の気分</dt>
        <dd>
            <select name="review" size="1">
                <option hidden>下記より選んでください</option>
                <option value="bad">⭐︎</option>
                <option value="soso">⭐︎⭐︎</option>
                <option value="good">⭐︎⭐︎⭐︎</option>
            </select>
        </dd>
        <dt>本文</dt>
        <dd><textarea name="text" cols="40" rows="10" class="textarea"></textarea></dd>
    </dl>
    <a href="scheduler.php"><input type="submit" value="記録"></a>
    </form>
</body>
</html>


<!-- 参考文献
https://code-notes.com/lesson/4 -->