<?php

    require_once('env.php');
    Class Dbc{
        protected $table_name;
        
        // データベース接続
        public function dbConnect(){

            $host   = DB_HOST;
            $dbname = DB_NAME;
            $user   = DB_USER;
            $pass   = DB_PASS;
            $dsn    = "mysql:host=$host;dbname=$dbname;charset=utf8";

            try{
                $dbh = new PDO($dsn, $user, $pass, [
                    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                ]);
            }catch(PDOException $e){
                echo '接続失敗'. $e->getMessage();
                exit();
            };

            return $dbh;
        }

        // 全データ取得
        public function getAll(){
            $dbh = $this->dbConnect();

            // SQL文の準備
            $sql = "SELECT * from $this->table_name";

            // SQLの実行
            $stmt = $dbh->query($sql);

            // SQLの結果を受け取る
            $result = $stmt->fetchall(PDO::FETCH_ASSOC);

            return $result;
            $dbh = null;
        }


        // 引数：$id
        // 返り値：$result
        //指定データの取得
        public function getById($id){
            if(empty($id)){
                exit('IDが不正です');
            }
        
            $dbh = $this->dbConnect();
        
            // SQL準備
            $stmt = $dbh->prepare("SELECT * from $this->table_name Where id = :id");
            $stmt->bindValue(':id', (int)$id, PDO::PARAM_INT);
        
            // SQL実行
            $stmt->execute();
        
            // 結果を取得
            $result = $stmt->fetch(PDO::FETCH_ASSOC);
        
            if(!$result){
                exit('データがありません');
            }

            return $result;
        }
    }
?>