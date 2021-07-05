-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- 主機： 127.0.0.1
-- 產生時間： 2021-07-05 14:33:13
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
  `order_id` int(10) UNSIGNED NOT NULL,
  `product_id` int(6) UNSIGNED NOT NULL,
  `user_id` int(6) UNSIGNED NOT NULL,
  `invoice_no` int(50) UNSIGNED NOT NULL,
  `qty` int(5) UNSIGNED NOT NULL,
  `order_date` datetime NOT NULL,
  `order_status` int(3) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- 傾印資料表的資料 `user_order`
--

INSERT INTO `user_order` (`order_id`, `product_id`, `user_id`, `invoice_no`, `qty`, `order_date`, `order_status`) VALUES
(1, 3, 2, 2105020001, 6, '2021-05-02 23:15:20', 0),
(2, 5, 3, 2105050002, 4, '2021-05-05 05:16:37', 0),
(3, 7, 5, 2105080003, 8, '2021-05-08 05:16:37', 0),
(4, 9, 11, 2105090003, 6, '2021-05-09 05:18:26', 0),
(5, 13, 5, 2105110003, 4, '2021-05-11 05:18:26', 0),
(6, 17, 5, 2105170003, 2, '2021-05-17 23:16:37', 0),
(7, 15, 12, 2105210006, 5, '2021-05-21 10:17:15', 0),
(8, 18, 6, 2105210001, 7, '2021-05-21 15:17:15', 0),
(9, 11, 15, 2105210002, 0, '2021-05-21 12:19:53', 0),
(10, 13, 7, 2105230001, 0, '2021-05-23 00:17:15', 0);

--
-- 已傾印資料表的索引
--

--
-- 資料表索引 `user_order`
--
ALTER TABLE `user_order`
  ADD PRIMARY KEY (`order_id`);

--
-- 在傾印的資料表使用自動遞增(AUTO_INCREMENT)
--

--
-- 使用資料表自動遞增(AUTO_INCREMENT) `user_order`
--
ALTER TABLE `user_order`
  MODIFY `order_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
