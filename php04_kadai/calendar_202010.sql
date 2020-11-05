-- phpMyAdmin SQL Dump
-- version 4.9.5
-- https://www.phpmyadmin.net/
--
-- ホスト: localhost:3306
-- 生成日時: 2020 年 10 朁E30 日 13:04
-- サーバのバージョン： 5.7.24
-- PHP のバージョン: 7.3.7

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- データベース: `gs_db_kadai03`
--

-- --------------------------------------------------------

--
-- テーブルの構造 `calendar_202010`
--

CREATE TABLE `calendar_202010` (
  `date` text NOT NULL,
  `yotei1` varchar(65) DEFAULT NULL,
  `yotei2` varchar(65) DEFAULT NULL,
  `yotei3` varchar(65) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- テーブルのデータのダンプ `calendar_202010`
--

INSERT INTO `calendar_202010` (`date`, `yotei1`, `yotei2`, `yotei3`) VALUES
('1', 'あそぶ！', NULL, NULL),
('10', NULL, NULL, NULL),
('11', NULL, NULL, NULL),
('12', NULL, NULL, NULL),
('13', NULL, NULL, NULL),
('14', NULL, NULL, NULL),
('15', NULL, NULL, NULL),
('16', NULL, NULL, NULL),
('17', NULL, NULL, NULL),
('18', NULL, NULL, NULL),
('19', NULL, NULL, NULL),
('2', NULL, NULL, NULL),
('20', NULL, NULL, NULL),
('21', NULL, NULL, NULL),
('22', NULL, NULL, NULL),
('23', NULL, NULL, NULL),
('24', 'GS　授業', '', ''),
('25', NULL, NULL, NULL),
('26', NULL, NULL, NULL),
('27', NULL, NULL, NULL),
('28', NULL, NULL, NULL),
('29', NULL, NULL, NULL),
('3', NULL, NULL, NULL),
('30', '出社', '飲み会', ''),
('31', NULL, NULL, NULL),
('4', NULL, NULL, NULL),
('5', NULL, NULL, NULL),
('6', NULL, NULL, NULL),
('7', NULL, NULL, NULL),
('8', NULL, NULL, NULL),
('9', NULL, NULL, NULL);

--
-- ダンプしたテーブルのインデックス
--

--
-- テーブルのインデックス `calendar_202010`
--
ALTER TABLE `calendar_202010`
  ADD PRIMARY KEY (`date`(65));
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
