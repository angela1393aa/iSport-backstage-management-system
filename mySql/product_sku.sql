-- phpMyAdmin SQL Dump
-- version 5.1.0
-- https://www.phpmyadmin.net/
--
-- 主機： 127.0.0.1
-- 產生時間： 2021-07-04 20:15:41
-- 伺服器版本： 10.4.18-MariaDB
-- PHP 版本： 8.0.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- 資料庫： `mfee17_4_db`
--

-- --------------------------------------------------------

--
-- 資料表結構 `product_sku`
--

CREATE TABLE `product_sku` (
  `id` int(6) UNSIGNED NOT NULL,
  `product_id` int(5) UNSIGNED NOT NULL,
  `sku_code` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `sku_group` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `price` int(6) UNSIGNED NOT NULL,
  `stock` int(5) UNSIGNED NOT NULL,
  `Sales` int(6) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- 傾印資料表的資料 `product_sku`
--

INSERT INTO `product_sku` (`id`, `product_id`, `sku_code`, `sku_group`, `price`, `stock`, `Sales`) VALUES
(1, 1, '10011011', '1,4', 476, 10, 42),
(2, 1, '10011012', '1,5', 476, 42, 56),
(3, 1, '10011013', '1,6', 476, 23, 75),
(4, 1, '10011014', '1,7', 476, 11, 76),
(5, 1, '10011015', '1,8', 476, 2, 75),
(6, 1, '10011021', '2,4', 476, 45, 78),
(7, 1, '10011022', '2,5', 476, 36, 45),
(8, 1, '10011023', '2,6', 476, 25, 98),
(9, 1, '10011024', '2,7', 476, 22, 57),
(10, 1, '10011025', '2,8', 476, 10, 96),
(11, 1, '10011031', '3,4', 476, 35, 44),
(12, 1, '10011032', '3,5', 476, 45, 87),
(13, 1, '10011033', '3,6', 476, 20, 46),
(14, 1, '10011034', '3,7', 476, 23, 47),
(15, 1, '10011035', '3,8', 476, 57, 64),
(16, 2, '10022101', '9', 857, 24, 45),
(17, 2, '10022102', '10', 857, 32, 67),
(18, 2, '10022103', '11', 857, 15, 57),
(19, 3, '10033101', '12', 870, 15, 45),
(20, 3, '10033102', '13', 870, 13, 78),
(21, 3, '10033103', '14', 870, 15, 75),
(22, 3, '10033104', '15', 870, 65, 79),
(23, 3, '10033105', '16', 870, 42, 120);

--
-- 已傾印資料表的索引
--

--
-- 資料表索引 `product_sku`
--
ALTER TABLE `product_sku`
  ADD PRIMARY KEY (`id`);

--
-- 在傾印的資料表使用自動遞增(AUTO_INCREMENT)
--

--
-- 使用資料表自動遞增(AUTO_INCREMENT) `product_sku`
--
ALTER TABLE `product_sku`
  MODIFY `id` int(6) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
