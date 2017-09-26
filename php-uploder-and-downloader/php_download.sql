-- phpMyAdmin SQL Dump
-- version 4.5.2
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Sep 26, 2017 at 02:53 PM
-- Server version: 10.1.13-MariaDB
-- PHP Version: 7.0.8

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `php_download`
--

-- --------------------------------------------------------

--
-- Table structure for table `download`
--

CREATE TABLE `download` (
  `id` int(10) NOT NULL,
  `uniqueid` varchar(255) NOT NULL,
  `filename` varchar(255) NOT NULL,
  `timestamp` varchar(255) NOT NULL,
  `downloads` varchar(255) NOT NULL DEFAULT '0',
  `user_email` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `download`
--

INSERT INTO `download` (`id`, `uniqueid`, `filename`, `timestamp`, `downloads`, `user_email`) VALUES
(190, '04cf01e86a69e4c252f16d9203b24cbe59ca1dbc22e71', 'techinfini1.jpg', '1506418108', '1', ''),
(191, 'b7bb9ee5d0f1aa418364d10051497c0c59ca1f04cb322', 'techinfini4.jpg', '1506418436', '1', ''),
(192, '30b60ac4fd1d50eed52229f64de1dc0759ca22ee1098c', 'hiii.txt', '1506419438', '1', ''),
(193, 'fd3a1686593177be32485e239feb2dd259ca237c05570', 'techinfini2.jpg', '1506419580', '1', ''),
(194, '4af41dbf2a5358a8a04d611ae5ef472f59ca23ac8e1f7', 'partner_wp.png', '1506419628', '0', ''),
(195, '34dabdd609b3de2b398d50dfd3f807ba59ca23bcb208a', 'techinfini4.jpg', '1506419644', '0', ''),
(196, '41ca5195850a1b0d036ab06a2e6cd12d59ca23f142f38', 'partner_wp.png', '1506419697', '0', ''),
(197, '72642499379594a7f6f73e3a88bdb90059ca23fce9910', 'SampleVideo_1280x720_1mb.mp4', '1506419708', '0', ''),
(198, 'b6b3cb3fe4e56d0020fd4a980416a71159ca2438ed76f', 'hh.zip', '1506419768', '1', ''),
(199, '6456cb15738035fafd15e3ea87eaa48e59ca244daa5e3', 'hh.zip', '1506419789', '0', '8518158'),
(200, '3534b0b943fb221a6b37d0c83e1b8bb759ca246bbdb20', 'hh.zip', '1506419819', '0', 'omkomko@jijij.ji'),
(201, 'e0dfcd825e444920ff2e50b2cd6af99c59ca2510606c2', 'rtner_wp.png', '1506419984', '0', ''),
(202, '504685b374663a494909d3b4257b749259ca252085bed', 'rtner_wp.png', '1506420000', '0', 'kaleshubham16@gmail.com'),
(203, '85b38339042a3a20df912a5b8bf4636a59ca367f5fe28', 'hh.zip', '1506424447', '0', '');

-- --------------------------------------------------------

--
-- Table structure for table `insert_data`
--

CREATE TABLE `insert_data` (
  `file_id` int(10) NOT NULL,
  `file_name` varchar(255) NOT NULL,
  `file_size` int(50) NOT NULL,
  `file_type` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `insert_data`
--

INSERT INTO `insert_data` (`file_id`, `file_name`, `file_size`, `file_type`) VALUES
(151, 'sapmplevideo.mp4', 1055736, 'video/mp4'),
(152, 'carbon.js', 6952, 'application/javascript'),
(155, 'hh.zip', 51458, 'application/zip'),
(156, 'theme-unit-test-data.xml', 400505, 'text/xml'),
(157, '17-07-17.zip', 3329, 'application/zip'),
(158, 'TestYou_795.jpg', 230967, 'image/jpeg'),
(159, 'SampleAudio_0.7mb.mp3', 725240, 'audio/mp3'),
(160, 'file-uploading-with-php-and-mysql.rar', 276020, 'application/x-rar'),
(161, 'Phptpoint.pdf', 202086, 'application/pdf');

-- --------------------------------------------------------

--
-- Table structure for table `login_table`
--

CREATE TABLE `login_table` (
  `login_id` int(10) NOT NULL,
  `username` varchar(20) NOT NULL,
  `password` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `login_table`
--

INSERT INTO `login_table` (`login_id`, `username`, `password`) VALUES
(1, 'admin', '0192023a7bbd73250516f069df18b500');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `download`
--
ALTER TABLE `download`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `insert_data`
--
ALTER TABLE `insert_data`
  ADD PRIMARY KEY (`file_id`);

--
-- Indexes for table `login_table`
--
ALTER TABLE `login_table`
  ADD PRIMARY KEY (`login_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `download`
--
ALTER TABLE `download`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=204;
--
-- AUTO_INCREMENT for table `insert_data`
--
ALTER TABLE `insert_data`
  MODIFY `file_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=162;
--
-- AUTO_INCREMENT for table `login_table`
--
ALTER TABLE `login_table`
  MODIFY `login_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
