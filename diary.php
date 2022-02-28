<?php
    require_once('dbconnect.php');

    Class Diary extends Dbc{

        protected $table_name = 'Diary';
        
        // 星評価の実装
        public function starReview($number){
            if($number === '1'){
                return '⭐️';
            } elseif($number === '2'){
                return '⭐️⭐️';
            } elseif($number === '3'){
                return '⭐️⭐️⭐️';
            } else{
                return 'その他';
            }
        }

        public function diaryCreate($diaries){
            $sql = "INSERT INTO
                        $this->table_name(id, title, review, content)
                    VALUES
                        (:id, :title, :review, :content)";
    
            $dbh = $this->dbConnect();
    
            // トランザクション
            $dbh->beginTransaction();
    
            try{
                $stmt = $dbh->prepare($sql);
                $stmt->bindValue(':id', $diaries['id'], PDO::PARAM_INT);
                $stmt->bindValue(':title', $diaries['title'], PDO::PARAM_STR);
                $stmt->bindValue(':review', $diaries['review'], PDO::PARAM_INT);
                $stmt->bindValue(':content', $diaries['content'], PDO::PARAM_STR);
                $stmt->execute();
                $dbh->commit();
    
                echo '日記を投稿しました!';
            }catch(PDOException $e){
                $dbh->rollback();
                exit($e);
            }
        }

        // 日記のバリデーション
        public function validate($diaries){
            if(empty($diaries['id'])){
                exit('idを入力してください');
            }
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
        }

        public function diaryUpdate($diaries){
            $sql = "UPDATE $this->table_name SET
                        title = :title, review = :review, content = :content
                    WHERE
                        id = :id";
    
            $dbh = $this->dbConnect();
    
            // トランザクション
            $dbh->beginTransaction();
    
            try{
                $stmt = $dbh->prepare($sql);
                $stmt->bindValue(':title', $diaries['title'], PDO::PARAM_STR);
                $stmt->bindValue(':review', $diaries['review'], PDO::PARAM_INT);
                $stmt->bindValue(':content', $diaries['content'], PDO::PARAM_STR);
                $stmt->bindValue(':id', $diaries['id'], PDO::PARAM_INT);
                $stmt->execute();
                $dbh->commit();
    
                echo '日記を更新しました!';
            }catch(PDOException $e){
                $dbh->rollback();
                exit($e);
            }
        }

        // エスケープ処理
        public function escape($v){ 
            return htmlspecialchars($v, ENT_QUOTES, 'UTF-8'); 
        }
        /* brタグの有効化 */
        public function brToTag($v){
            /* エスケープされた<br>を戻す */
            return str_replace('&lt;br&gt;','<br>',$v);
        }
    }
?>