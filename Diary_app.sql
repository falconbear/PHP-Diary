-- phpMyAdmin SQL Dump
-- version 5.1.0
-- https://www.phpmyadmin.net/
--
-- ホスト: localhost:8889
-- 生成日時: 2022 年 3 月 05 日 14:02
-- サーバのバージョン： 5.7.34
-- PHP のバージョン: 7.4.21

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- データベース: `Diary_app`
--

-- --------------------------------------------------------

--
-- テーブルの構造 `Diary`
--

CREATE TABLE `Diary` (
  `id` bigint(20) NOT NULL,
  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `title` varchar(191) NOT NULL,
  `review` int(3) NOT NULL,
  `content` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- テーブルのデータのダンプ `Diary`
--

INSERT INTO `Diary` (`id`, `date`, `title`, `review`, `content`) VALUES
(1645887600, '2022-02-28 04:54:40', '焼肉食った', 3, '焼肉うまかった。\r\nでも、油が多くて胃もたれが...。\r\nやったー！！\r\n改行できた！！！'),
(1645974000, '2022-02-28 10:50:33', 'とりあえずアプリはできた！！', 2, 'アプリはそこそこクオリティが高いものができた。フロントはやっつけだが、そこそこデザインとしてアリなのでは？\r\n今後は、習慣ログと習慣登録を追加\r\nあと、記録や削除した後に飛ばされるページを飛ばす。\r\n'),
(1646146800, '2022-03-05 04:21:40', '競プロ一週間チャレンジ', 2, 'Python Paizaを一週間でAランクまであげる！！\r\n今日はCランクまでのロードマップを開始\r\n金曜までに完了させる！\r\nがんばろ！');

--
-- ダンプしたテーブルのインデックス
--

--
-- テーブルのインデックス `Diary`
--
ALTER TABLE `Diary`
  ADD PRIMARY KEY (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
