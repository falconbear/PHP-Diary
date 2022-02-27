<?php
    Class Calender{
        // タイムゾーンを設定


        public function setYm(){
            // 前月・次月リンクが押された場合は、GETパラメーターから年月を取得
            if (isset($_GET['ym'])) {
                $ym = $_GET['ym'];
            } else {
                // 今月の年月を表示
                $ym = date('Y-m');
            }
            return $ym;
        }

        public function getMonthData($ym){
            // タイムスタンプを作成し、フォーマットをチェックする
            $timestamp = strtotime($ym . '-01');
            // カレンダーのタイトルを作成　例）2021年6月
            $calender_title = date('Y年n月', $timestamp);

            // タイムスタンプが空の時は現在のタイムスタンプを設定
            if ($timestamp === false) {
                $ym = date('Y-m');
                $timestamp = strtotime($ym . '-01');
            }

            // 前月・次月の年月を取得
            $prev = date('Y-m', mktime(0, 0, 0, date('m', $timestamp)-1, 1, date('Y', $timestamp)));
            $next = date('Y-m', mktime(0, 0, 0, date('m', $timestamp)+1, 1, date('Y', $timestamp)));

            // 該当月の日数を取得
            $day_count = date('t', $timestamp);

            // １日が何曜日か　0:日 1:月 2:火 ... 6:土
            // 方法１：mktimeを使う
            $youbi = date('w', mktime(0, 0, 0, date('m', $timestamp), 1, date('Y', $timestamp)));

            $month_data = [
                'calenderTitle' => $calender_title,
                'prevMonth' => $prev,
                'nextMonth' => $next,
                'dayCount' => $day_count,
                '1stYoubi' => $youbi
            ];
            return $month_data;
        }
    }
?>