-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- 主機： 127.0.0.1
-- 產生時間： 2021-07-07 11:12:59
-- 伺服器版本： 10.4.19-MariaDB
-- PHP 版本： 8.0.7

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- 資料庫: `mfee17_4_db`
--

-- --------------------------------------------------------

--
-- 資料表結構 `user_order_detail`
--

CREATE TABLE `user_order_detail` (
  `id` int(11) UNSIGNED NOT NULL,
  `order_id` int(11) UNSIGNED NOT NULL,
  `product_id` int(6) UNSIGNED NOT NULL,
  `qty` int(3) UNSIGNED NOT NULL,
  `valid` tinyint(2) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- 傾印資料表的資料 `user_order_detail`
--

INSERT INTO `user_order_detail` (`id`, `order_id`, `product_id`, `qty`, `valid`) VALUES
(1, 1, 43, 2, 1),
(2, 1, 80, 1, 1),
(3, 1, 84, 1, 1),
(4, 2, 129, 1, 1),
(5, 2, 174, 3, 1),
(6, 3, 15, 2, 1),
(7, 4, 98, 1, 1),
(8, 4, 72, 2, 1),
(9, 5, 46, 2, 1),
(10, 6, 126, 3, 1),
(11, 7, 102, 2, 1),
(12, 7, 44, 1, 1),
(13, 8, 62, 3, 1),
(14, 9, 173, 2, 1),
(15, 9, 102, 4, 1),
(16, 10, 163, 2, 1),
(17, 10, 134, 1, 1),
(18, 11, 65, 2, 1),
(19, 11, 177, 1, 1),
(20, 12, 4, 1, 1),
(21, 13, 83, 2, 1),
(22, 13, 110, 1, 1),
(23, 14, 80, 2, 1),
(24, 15, 77, 1, 1),
(25, 15, 28, 2, 1);

--
-- 已傾印資料表的索引
--

--
-- 資料表索引 `user_order_detail`
--
ALTER TABLE `user_order_detail`
  ADD PRIMARY KEY (`id`);

--
-- 在傾印的資料表使用自動遞增(AUTO_INCREMENT)
--

--
-- 使用資料表自動遞增(AUTO_INCREMENT) `user_order_detail`
--
ALTER TABLE `user_order_detail`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
