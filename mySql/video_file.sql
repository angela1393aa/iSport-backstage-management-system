-- phpMyAdmin SQL Dump
-- version 5.1.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Jul 08, 2021 at 07:18 PM
-- Server version: 10.4.19-MariaDB
-- PHP Version: 8.0.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `mfee17_4_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `video_file`
--

CREATE TABLE `video_file` (
  `id` int(6) UNSIGNED NOT NULL,
  `title` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `filePath` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` varchar(200) COLLATE utf8mb4_unicode_ci NOT NULL,
  `category` int(6) UNSIGNED NOT NULL,
  `duration` varchar(10) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '0',
  `upload_date` datetime NOT NULL DEFAULT current_timestamp(),
  `views` int(6) UNSIGNED NOT NULL DEFAULT 0,
  `likes` int(6) UNSIGNED NOT NULL DEFAULT 0,
  `favorite` int(6) UNSIGNED NOT NULL DEFAULT 0,
  `valid` tinyint(1) UNSIGNED NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `video_file`
--

INSERT INTO `video_file` (`id`, `title`, `filePath`, `description`, `category`, `duration`, `upload_date`, `views`, `likes`, `favorite`, `valid`) VALUES
(1, '一首歌時間瘦身 - 4 分鐘 TABATA', 'uploads/videos/60e7109b7f92e.mp4', 'Tabata 4 Minute Workout Special for Beginner & Ladies\r\n1. Squat\r\n2. Kneeling Push up\r\n3. Dynamic Lunges\r\n4. High Knee\r\n5. Spider Crawl\r\n6. Leg Lifts\r\n7. Plank Jack\r\n8. Knee Crunches', 3, '04:19', '2021-07-08 22:50:03', 0, 0, 0, 0),
(2, '4 分鐘初學者 TABATA', 'uploads/videos/60e713099a985.mp4', '運動 20 秒\r\n休息 10 秒\r\n總共 8 回', 3, '04:06', '2021-07-08 23:00:25', 0, 0, 0, 0),
(3, '居家4分鐘爆汗燃脂 TABATA每天4組急速瘦身 - TABATA Home Workout', 'uploads/videos/60e715767fb05.mp4', '大家疫情在家辛苦囉\r\n嗑冰棒吃餅乾之餘\r\n每天也可以花幾分鐘運動唷', 3, '04:02', '2021-07-08 23:10:46', 0, 0, 0, 0),
(4, '初階tabata訓練 四分鐘 一首歌的時間爆汗', 'uploads/videos/60e7184636558.mp4', '四分鐘TABATA，短時間內高效率運動，\r\n跟著我們一起爆汗燃脂！', 3, '03:58', '2021-07-08 23:22:46', 0, 0, 0, 0),
(5, '6分鐘 超嗨拳擊有氧甩油塑身操', 'uploads/videos/60e71aa1186d6.mp4', '你是不是在休假期間天天享受美食下午茶，因而吃太多、動太少，不知不覺就整個人胖了一圈，正苦惱著如何雕塑全身吶？！\r\n快跟著adidas #adigirls美力訓練營教練Shelly一起打拳甩油燃燒脂肪吧！ ', 1, '06:11', '2021-07-08 23:32:49', 0, 0, 0, 0),
(6, '5分鐘燃脂 - 徒手有氧運動', 'uploads/videos/60e71dd7e7163.mp4', '簡短而有效率的有氧運動！\r\n大家一起來燃燒脂肪吧！', 1, '05:12', '2021-07-08 23:46:31', 0, 0, 0, 0),
(7, '居家防疫 | 10分鐘高強度居家運動 - 燃燒脂肪 有氧+無氧', 'uploads/videos/60e71fb866373.mp4', '這個HIIT超燃脂影片會鍛鍊到全身上下\r\n裡面的動作包含了有氧運動以及自重重量訓練\r\n每天跟著跳一次可以燃燒脂肪、提升新陳代謝\r\n建議大家在家裡運動還是穿著運動鞋\r\n這樣在跑跑跳跳時比較安全 腳的負擔也比較小', 1, '10:20', '2021-07-08 23:54:32', 0, 0, 0, 0),
(8, '10 分鐘腹肌訓練【中級版】10 Min Abs workout', 'uploads/videos/60e720bf814b8.mp4', '分享给大家 - 【10分鐘的集中核心訓練】\r\n即使嚴禁在家，每天被美食誘惑圍繞著，依然不阻礙我們想要腹肌的心！\r\n一起鞏固核心力量，完成這 15 個訓練動作吧～\r\n祝大家健身愉快！', 4, '10:42', '2021-07-08 23:58:55', 0, 0, 0, 0);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `video_file`
--
ALTER TABLE `video_file`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `video_file`
--
ALTER TABLE `video_file`
  MODIFY `id` int(6) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
