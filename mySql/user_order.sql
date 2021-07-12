-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- 主機： 127.0.0.1
-- 產生時間： 2021-07-12 16:40:29
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
-- 資料表結構 `user_order`
--

CREATE TABLE `user_order` (
  `id` int(10) UNSIGNED NOT NULL,
  `user_id` int(6) UNSIGNED NOT NULL,
  `invoice_no` int(50) UNSIGNED NOT NULL,
  `order_date` datetime NOT NULL,
  `paytype` enum('ATM匯款','線上刷卡','貨到付款','') COLLATE utf8mb4_unicode_ci NOT NULL,
  `order_status` int(2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- 傾印資料表的資料 `user_order`
--

INSERT INTO `user_order` (`id`, `user_id`, `invoice_no`, `order_date`, `paytype`, `order_status`) VALUES
(1, 16, 2105020001, '2021-05-02 23:15:20', 'ATM匯款', 1),
(2, 3, 2105050002, '2021-05-05 05:16:37', '線上刷卡', 1),
(3, 12, 2105080003, '2021-05-08 05:16:37', '線上刷卡', 1),
(4, 11, 2105090003, '2021-05-09 05:18:26', 'ATM匯款', 1),
(5, 5, 2105110003, '2021-05-11 05:18:26', 'ATM匯款', 1),
(6, 17, 2105170003, '2021-05-17 23:16:37', '貨到付款', 1),
(7, 12, 2105210006, '2021-05-21 10:17:15', 'ATM匯款', 1),
(8, 6, 2105210001, '2021-05-21 15:17:15', '線上刷卡', 1),
(9, 18, 2105210002, '2021-05-21 12:19:53', 'ATM匯款', 1),
(10, 7, 2105230001, '2021-05-23 00:17:15', 'ATM匯款', 3),
(11, 13, 2106020001, '2021-06-02 11:14:10', '貨到付款', 1),
(12, 9, 2106140001, '2021-06-14 12:25:32', '貨到付款', 1),
(13, 4, 2106140002, '2021-06-14 12:22:18', 'ATM匯款', 1),
(14, 19, 2106210001, '2021-06-21 09:25:30', '貨到付款', 3),
(15, 1, 2106210002, '2021-06-21 05:12:31', 'ATM匯款', 1),
(16, 20, 2106240001, '2021-06-24 05:04:22', '線上刷卡', 1),
(17, 18, 2106240002, '2021-06-24 08:42:22', '線上刷卡', 2),
(18, 6, 2106270001, '2021-06-27 03:16:11', 'ATM匯款', 2),
(19, 14, 2106270002, '2021-06-27 06:39:11', '貨到付款', 1),
(20, 2, 2106270003, '2021-06-27 13:25:22', '貨到付款', 2),
(21, 4, 2107020001, '2021-07-02 05:30:22', '線上刷卡', 2),
(22, 17, 2107020002, '2021-07-02 08:46:22', '貨到付款', 2),
(23, 10, 2107020003, '2021-07-02 20:32:53', '貨到付款', 1),
(24, 5, 2107050001, '2021-07-05 09:15:22', '線上刷卡', 2),
(25, 12, 2107070002, '2021-07-07 07:35:15', '線上刷卡', 2);

--
-- 已傾印資料表的索引
--

--
-- 資料表索引 `user_order`
--
ALTER TABLE `user_order`
  ADD PRIMARY KEY (`id`);

--
-- 在傾印的資料表使用自動遞增(AUTO_INCREMENT)
--

--
-- 使用資料表自動遞增(AUTO_INCREMENT) `user_order`
--
ALTER TABLE `user_order`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
