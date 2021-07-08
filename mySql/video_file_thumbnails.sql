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
(24, 8, 'uploads/videos/thumbnails/8-60e7215e7449e.jpg', 0);

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
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
