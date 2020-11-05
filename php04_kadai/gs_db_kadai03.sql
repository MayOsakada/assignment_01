-- phpMyAdmin SQL Dump
-- version 4.9.5
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Nov 05, 2020 at 02:30 PM
-- Server version: 5.7.24
-- PHP Version: 7.3.7

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `gs_db_kadai03`
--

-- --------------------------------------------------------

--
-- Table structure for table `calendar_202010`
--

CREATE TABLE `calendar_202010` (
  `date` text NOT NULL,
  `yotei1` varchar(65) DEFAULT NULL,
  `yotei2` varchar(65) DEFAULT NULL,
  `yotei3` varchar(65) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `calendar_202010`
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

-- --------------------------------------------------------

--
-- Table structure for table `gs_user_table`
--

CREATE TABLE `gs_user_table` (
  `id` int(12) NOT NULL,
  `name` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  `lid` varchar(128) COLLATE utf8_unicode_ci NOT NULL,
  `lpw` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  `kanri_flg` int(1) NOT NULL,
  `life_flg` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `gs_user_table`
--

INSERT INTO `gs_user_table` (`id`, `name`, `lid`, `lpw`, `kanri_flg`, `life_flg`) VALUES
(1, 'テスト１管理者', 'test1', 'test1', 1, 0),
(2, 'テスト2一般', 'test2', 'test2', 0, 0),
(3, 'テスト３', 'test3', 'test3', 0, 0);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `calendar_202010`
--
ALTER TABLE `calendar_202010`
  ADD PRIMARY KEY (`date`(65));

--
-- Indexes for table `gs_user_table`
--
ALTER TABLE `gs_user_table`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `gs_user_table`
--
ALTER TABLE `gs_user_table`
  MODIFY `id` int(12) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
