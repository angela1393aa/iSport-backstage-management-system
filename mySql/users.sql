-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- 主機： 127.0.0.1
-- 產生時間： 2021-07-09 09:06:10
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
-- 資料表結構 `users`
--

CREATE TABLE `users` (
  `id` int(6) UNSIGNED NOT NULL,
  `account` varchar(20) COLLATE utf8_unicode_ci DEFAULT NULL,
  `password` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(30) COLLATE utf8_unicode_ci DEFAULT NULL,
  `user_name` varchar(30) COLLATE utf8_unicode_ci DEFAULT NULL,
  `create_time` datetime DEFAULT NULL,
  `phone` int(30) DEFAULT NULL,
  `address` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `valid` int(5) NOT NULL,
  `birthday` datetime NOT NULL,
  `intro` varchar(1000) COLLATE utf8_unicode_ci NOT NULL,
  `article_count` int(6) UNSIGNED DEFAULT NULL,
  `video_count` int(6) UNSIGNED DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- 傾印資料表的資料 `users`
--

INSERT INTO `users` (`id`, `account`, `password`, `email`, `user_name`, `create_time`, `phone`, `address`, `valid`, `birthday`, `intro`, `article_count`, `video_count`) VALUES
(1, 'Aaliyah', '$2y$10$CHDlKEpV1djr5dI0FPLBfegW4W2DFDBwGoNMLVYJW3rZaTL6F3t8q', 'Aaliyah@test01.test01', '艾莉雅', '2021-07-07 17:19:56', 922222222, '台北市中山路一段一號一樓', 1, '2021-07-07 00:00:00', '沒有要介紹的', NULL, 0),
(2, 'Alice', '$2y$10$0FAYbqu8p5DrvrbJRjJYoer.XmKxYi61gpTADGQlQVm.LFyUsSLNu', 'Alice@test.com', '愛麗絲', '2021-07-07 17:21:32', 922222555, '台北市南港路一段一號一樓', 1, '2010-01-01 00:00:00', '沒有要介紹的', NULL, 0),
(3, 'Brook', '$2y$10$Fz9Rmv5oiZe7aE5nzYqPfeiWnBvyVkc/jHVvKnPYt6ZaXe6xu3axG', 'Brook@test.com', '布魯克', '2021-07-07 17:23:15', 988777444, '桃園市中正路一段一號一樓', 1, '2021-06-27 00:00:00', '大家好', NULL, 0),
(4, 'Clara', '$2y$10$OgDoi9rIXU0vXYHk5EkonupnuGsvoeQQ0/bCt2VxYrm5ZhF0Zx/P2', 'Clara@test.com', '克萊拉', '2021-07-07 17:24:50', 977884442, '台中市台灣大道87號', 1, '2001-02-03 00:00:00', '大家好', NULL, 0),
(5, 'Debby', '$2y$10$inz1mBjYZxf3WWqSQWw9Ou.IX9L52/ln3oJjGFx1iINAkGw8FAPvC', 'Debby@test.com', '黛碧	', '2021-07-07 17:26:03', 988777888, '台北市基隆路一段一號一樓', 1, '1997-01-07 00:00:00', '沒有要介紹的', NULL, 0),
(6, 'Eden', '$2y$10$rAHLFUcPxLZ2VEXY3.08duNE9tMStJ2ygBvg6/3OrzeBXvttVSHgS', 'Eden@test.com', '伊甸	', '2021-07-07 17:28:03', 944555661, '新北市永和路一段一號', 1, '1998-05-04 00:00:00', '大家好我是伊甸', NULL, 0),
(7, 'Emma', '$2y$10$EHWqOpuvBIQrP.V0CZwQdOaGrrq.Ni.FZuUG36KG4Hl.57D6Qhk0y', 'Emma@test.com', '艾瑪', '2021-07-07 17:29:34', 965555664, '台北市南港路一段一號一樓', 1, '1980-01-05 00:00:00', '很難搞', NULL, 0),
(8, 'Evelyn', '$2y$10$/Cjr5XJjszyU4R12U.TFQewQPr/GHpSum5u2XabWnU2VaxLOz8XMa', 'Evelyn@test.com', '伊芙琳	', '2021-07-07 17:30:50', 922555441, '新北市福和路二段二號二樓', 1, '2000-01-01 00:00:00', '千', NULL, 0),
(9, 'Freda', '$2y$10$bIZmXOF5EoSwHzXAnDFZHe2YALmZuuPgm0QTEWOcLcXIFlZ.C4cW2', 'Freda@test.com', '弗莉達', '2021-07-07 17:32:47', 977888415, '新竹市中正路二段二號二樓', 1, '1945-07-10 00:00:00', '', NULL, 0),
(10, 'Grace', '$2y$10$kkoPoL6tvc4s43f9fp/09eTSQQNdHgOX97iyF3EfD1EUM.nkHhJJC', 'Grace@test.com', '葛瑞絲', '2021-07-07 17:34:30', 955444621, '高雄市七賢一路45號', 1, '1995-12-12 00:00:00', '', NULL, 0),
(11, 'Page', '$2y$10$j.Ybgf.gAIaxjRDKW0HwjuUCgcfMu0Ia4gqiA0vkn4gco3OLAf7Za', 'Page@test.com', '蓓姬', '2021-07-07 17:37:01', 988777441, '新北市連城路一號一樓', 1, '1991-02-02 00:00:00', '你好', NULL, 0),
(12, 'Zona', '$2y$10$u41YUfN1N/1I5yfbWOGBEeEZEgAKrv4vCF/RmirmkOHvoKRsk5qpO', 'Zona@test.com', '若娜', '2021-07-07 17:39:38', 955442134, '雲林縣中正路一段一號', 1, '1995-06-06 00:00:00', '', NULL, 0),
(13, 'Gavin', '$2y$10$0b.JoxNq/F3yPVHMEtqwB.ruaS6BEBvCD2rQTaa6bezOBkdtgULUW', 'Gavin@test.com', '加文', '2021-07-07 17:41:38', 922111445, '桃園市文化路一段一號一樓', 1, '1988-08-08 00:00:00', '1263', NULL, 0),
(14, 'Patrick', '$2y$10$tFeWL1gywUNP82QCvUivXeZbLiyhLvm0Jshcj8UJ4vQKw7hRQh0ky', 'Patrick@test.com', '派翠克', '2021-07-07 17:44:07', 988774214, '彰化縣軍功路一段一號', 1, '1955-03-03 00:00:00', '', NULL, 0),
(15, 'Rudolph', '$2y$10$BRm8JS5qG9EKDZy3Ycnm1eN8hQntpd7BRKQzxlOYP1N1i2SJSmiby', 'Rudolph@test.com', '魯道夫', '2021-07-07 17:45:42', 988777421, '台北市青田街87號7樓', 1, '2001-01-10 00:00:00', '', NULL, 0),
(16, 'Tony', '$2y$10$unmcWnNJMaMMEWGHNwEc5e.57N.5Iw01etmUXC.lq0k29L1p8PCy2', 'Tony@test.com', '東尼', '2021-07-07 17:47:08', 988745124, '台北市和平東路一段一號一樓', 1, '1960-01-26 00:00:00', '', NULL, 0),
(17, 'Wayne', '$2y$10$u89qCjbOY.RhUuajEAUX0ezDNdj4xYVhdbeymEgxkXoACF1uTOY6e', 'Wayne@test.com', '韋恩', '2021-07-07 17:48:31', 957575757, '台北市信義路一段一號一樓', 1, '1968-05-10 00:00:00', '', NULL, 0),
(18, 'Sammy', '$2y$10$wb/aJpRcrZhbY4OiZ1tv2emgupCiZJPD88827IIHp6X9ddSe0ipvm', 'Sammy@test.com', '薩米', '2021-07-07 17:50:53', 922575412, '台中市市府路一段一號一樓', 1, '2005-07-08 00:00:00', '薩米', NULL, 0),
(19, 'Sinclair', '$2y$10$BQejHZoarrrSG5ymAaJXjOQ7TRAyJlCxpA7/UQDWMNLYzTD5swSqm', 'Sinclair@tses.com', '辛克萊', '2021-07-07 17:52:02', 924578424, '南投縣仁愛路一段一號', 1, '1989-09-09 00:00:00', '', NULL, 0),
(20, 'Steve', '$2y$10$.qDNwH3kLRi4KgFjYlMrdegjHj3YpPdlkWvJQQ0hT/hEjugHtwOAe', 'Steve@test.com', '史蒂夫', '2021-07-07 17:52:49', 988774124, '台北市松江路一段一號一樓', 1, '1987-08-07 00:00:00', '', NULL, 0);

--
-- 已傾印資料表的索引
--

--
-- 資料表索引 `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- 在傾印的資料表使用自動遞增(AUTO_INCREMENT)
--

--
-- 使用資料表自動遞增(AUTO_INCREMENT) `users`
--
ALTER TABLE `users`
  MODIFY `id` int(6) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
