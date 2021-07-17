-- phpMyAdmin SQL Dump
-- version 5.1.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Jul 17, 2021 at 05:15 PM
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
-- Table structure for table `video_file_thumbnails`
--

CREATE TABLE `video_file_thumbnails` (
  `id` int(10) UNSIGNED NOT NULL,
  `videoId` int(11) NOT NULL,
  `filePath` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `selected` int(3) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `video_file_thumbnails`
--

INSERT INTO `video_file_thumbnails` (`id`, `videoId`, `filePath`, `selected`) VALUES
(1, 1, 'uploads/videos/thumbnails/1-60e71187bcc7a.jpg', 1),
(2, 1, 'uploads/videos/thumbnails/1-60e7118dc3891.jpg', 0),
(3, 1, 'uploads/videos/thumbnails/1-60e71199adc8b.jpg', 0),
(4, 2, 'uploads/videos/thumbnails/2-60e713aa797e6.jpg', 1),
(5, 2, 'uploads/videos/thumbnails/2-60e713af5ebd7.jpg', 0),
(6, 2, 'uploads/videos/thumbnails/2-60e713b8e518a.jpg', 0),
(7, 3, 'uploads/videos/thumbnails/3-60e715f5a8515.jpg', 1),
(8, 3, 'uploads/videos/thumbnails/3-60e715f97815e.jpg', 0),
(9, 3, 'uploads/videos/thumbnails/3-60e71601964c6.jpg', 0),
(10, 4, 'uploads/videos/thumbnails/4-60e7190810cdb.jpg', 1),
(11, 4, 'uploads/videos/thumbnails/4-60e7190e281ab.jpg', 0),
(12, 4, 'uploads/videos/thumbnails/4-60e719182d3ba.jpg', 0),
(13, 5, 'uploads/videos/thumbnails/5-60e71c156d0bc.jpg', 1),
(14, 5, 'uploads/videos/thumbnails/5-60e71c1d65924.jpg', 0),
(15, 5, 'uploads/videos/thumbnails/5-60e71c2c35d1d.jpg', 0),
(16, 6, 'uploads/videos/thumbnails/6-60e71eb53ad98.jpg', 1),
(17, 6, 'uploads/videos/thumbnails/6-60e71ebc9c6f9.jpg', 0),
(18, 6, 'uploads/videos/thumbnails/6-60e71ec97fba5.jpg', 0),
(19, 7, 'uploads/videos/thumbnails/7-60e72016a4832.jpg', 1),
(20, 7, 'uploads/videos/thumbnails/7-60e7201a53733.jpg', 0),
(21, 7, 'uploads/videos/thumbnails/7-60e7202133bcd.jpg', 0),
(22, 8, 'uploads/videos/thumbnails/8-60e72150bf287.jpg', 1),
(23, 8, 'uploads/videos/thumbnails/8-60e7215681c57.jpg', 0),
(24, 8, 'uploads/videos/thumbnails/8-60e7215e7449e.jpg', 0),
(25, 9, 'uploads/videos/thumbnails/9-60ecfd08c78e8.jpg', 1),
(26, 9, 'uploads/videos/thumbnails/9-60ecfd272bf68.jpg', 0),
(27, 9, 'uploads/videos/thumbnails/9-60ecfd4716b93.jpg', 0),
(28, 10, 'uploads/videos/thumbnails/10-60ed01b1eb033.jpg', 1),
(29, 10, 'uploads/videos/thumbnails/10-60ed01b6b83fa.jpg', 0),
(30, 10, 'uploads/videos/thumbnails/10-60ed01c1199c5.jpg', 0),
(31, 11, 'uploads/videos/thumbnails/11-60ed050391b24.jpg', 1),
(32, 11, 'uploads/videos/thumbnails/11-60ed05095a456.jpg', 0),
(33, 11, 'uploads/videos/thumbnails/11-60ed0517cf1ea.jpg', 0),
(34, 12, 'uploads/videos/thumbnails/12-60ed0896e91f3.jpg', 1),
(35, 12, 'uploads/videos/thumbnails/12-60ed089b11906.jpg', 0),
(36, 12, 'uploads/videos/thumbnails/12-60ed08a4ae1e0.jpg', 0),
(37, 13, 'uploads/videos/thumbnails/13-60ed0a4b97a88.jpg', 1),
(38, 13, 'uploads/videos/thumbnails/13-60ed0a50a1b26.jpg', 0),
(39, 13, 'uploads/videos/thumbnails/13-60ed0a59cefb3.jpg', 0),
(40, 14, 'uploads/videos/thumbnails/14-60ed0de92f7f7.jpg', 1),
(41, 14, 'uploads/videos/thumbnails/14-60ed0deeed030.jpg', 0),
(42, 14, 'uploads/videos/thumbnails/14-60ed0df925074.jpg', 0),
(43, 15, 'uploads/videos/thumbnails/15-60ed182f1935c.jpg', 1),
(44, 15, 'uploads/videos/thumbnails/15-60ed183de3b60.jpg', 0),
(45, 15, 'uploads/videos/thumbnails/15-60ed185b484af.jpg', 0),
(52, 16, 'uploads/videos/thumbnails/16-60f2628df3c4e.jpg', 1),
(53, 16, 'uploads/videos/thumbnails/16-60f2629444378.jpg', 0),
(54, 16, 'uploads/videos/thumbnails/16-60f262a030eef.jpg', 0),
(55, 17, 'uploads/videos/thumbnails/17-60f26337ec7e9.jpg', 1),
(56, 17, 'uploads/videos/thumbnails/17-60f2633b95275.jpg', 0),
(57, 17, 'uploads/videos/thumbnails/17-60f26341e596b.jpg', 0),
(58, 18, 'uploads/videos/thumbnails/18-60f26459cee8e.jpg', 1),
(59, 18, 'uploads/videos/thumbnails/18-60f2645ab6c0d.jpg', 0),
(60, 18, 'uploads/videos/thumbnails/18-60f2645c42161.jpg', 0),
(61, 19, 'uploads/videos/thumbnails/19-60f2651ee7818.jpg', 1),
(62, 19, 'uploads/videos/thumbnails/19-60f265214af86.jpg', 0),
(63, 19, 'uploads/videos/thumbnails/19-60f26524a90a9.jpg', 0),
(64, 20, 'uploads/videos/thumbnails/20-60f27228bd6d7.jpg', 1),
(65, 20, 'uploads/videos/thumbnails/20-60f2722dc1a49.jpg', 0),
(66, 20, 'uploads/videos/thumbnails/20-60f272351bc22.jpg', 0),
(67, 21, 'uploads/videos/thumbnails/21-60f27487754a5.jpg', 1),
(68, 21, 'uploads/videos/thumbnails/21-60f27489b1219.jpg', 0),
(69, 21, 'uploads/videos/thumbnails/21-60f2748d31298.jpg', 0),
(70, 22, 'uploads/videos/thumbnails/22-60f2760245166.jpg', 1),
(71, 22, 'uploads/videos/thumbnails/22-60f2760d65133.jpg', 0),
(72, 22, 'uploads/videos/thumbnails/22-60f2762340384.jpg', 0),
(73, 23, 'uploads/videos/thumbnails/23-60f299560eeba.jpg', 1),
(74, 23, 'uploads/videos/thumbnails/23-60f299587fa98.jpg', 0),
(75, 23, 'uploads/videos/thumbnails/23-60f2995d683b0.jpg', 0);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `video_file_thumbnails`
--
ALTER TABLE `video_file_thumbnails`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `video_file_thumbnails`
--
ALTER TABLE `video_file_thumbnails`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=79;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
