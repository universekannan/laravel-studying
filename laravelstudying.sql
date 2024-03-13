-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 13, 2024 at 11:56 AM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `laravelstudying`
--

-- --------------------------------------------------------

--
-- Table structure for table `payment`
--

CREATE TABLE `payment` (
  `id` int(10) UNSIGNED NOT NULL,
  `from_id` varchar(150) CHARACTER SET latin1 COLLATE latin1_general_ci DEFAULT NULL,
  `to_id` varchar(10) DEFAULT NULL,
  `amount` varchar(45) CHARACTER SET latin1 COLLATE latin1_general_ci DEFAULT NULL,
  `customer_id` int(11) DEFAULT NULL,
  `service_id` int(11) DEFAULT NULL,
  `pay_id` int(11) DEFAULT NULL,
  `service_status` varchar(20) DEFAULT NULL,
  `ad_info` varchar(100) DEFAULT NULL,
  `ad_info2` varchar(100) DEFAULT NULL,
  `time` varchar(100) DEFAULT NULL,
  `paydate` varchar(50) DEFAULT NULL,
  `log_id` int(11) DEFAULT NULL,
  `k_status` int(11) DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `payment`
--

INSERT INTO `payment` (`id`, `from_id`, `to_id`, `amount`, `customer_id`, `service_id`, `pay_id`, `service_status`, `ad_info`, `ad_info2`, `time`, `paydate`, `log_id`, `k_status`) VALUES
(1, '1', '1', '1000000', NULL, NULL, NULL, 'IN Payment', 'Fund Transfer', NULL, '16:52:37', '2023-07-11', 1, 1),
(2, '1', '2', '1500', NULL, NULL, 2, 'IN Payment', 'Fund Transfer', NULL, '16:53:02', '2023-07-11', 1, 1),
(3, '2', '1', '1500', NULL, NULL, 2, 'Out Payment', 'Fund Transfer', NULL, '16:53:02', '2023-07-11', 1, 1),
(4, '1', '3', '1500', NULL, NULL, 4, 'IN Payment', 'Fund Transfer', NULL, '16:54:03', '2023-07-11', 1, 1),
(5, '3', '1', '1500', NULL, NULL, 4, 'Out Payment', 'Fund Transfer', NULL, '16:54:03', '2023-07-11', 1, 1),
(6, '1', '3', '300', NULL, NULL, NULL, 'Out Payment', 'Activation', NULL, '16:54:24', '2023-07-11', 3, 1),
(7, '3', '1', '300', NULL, NULL, NULL, 'In Payment', 'Commission', NULL, '16:54:24', '2023-07-11', 3, 1),
(8, '1', '2', '300', NULL, NULL, NULL, 'Out Payment', 'Activation', NULL, '16:57:20', '2023-07-11', 2, 1),
(9, '2', '1', '300', NULL, NULL, NULL, 'In Payment', 'Commission', NULL, '16:57:20', '2023-07-11', 2, 1),
(10, '2', '4', '300', NULL, NULL, 10, 'IN Payment', 'Fund Transfer', NULL, '17:05:59', '2023-07-11', 2, 1),
(11, '4', '2', '300', NULL, NULL, 10, 'Out Payment', 'Fund Transfer', NULL, '17:05:59', '2023-07-11', 2, 1),
(12, '2', '4', '300', NULL, NULL, NULL, 'Out Payment', 'Activation', NULL, '17:06:35', '2023-07-11', 2, 1),
(13, '4', '2', '150', NULL, NULL, NULL, 'In Payment', 'Commission', NULL, '17:06:35', '2023-07-11', 2, 1),
(14, '2', '1', '150', NULL, NULL, NULL, 'In Payment', 'Commission', NULL, '17:06:35', '2023-07-11', 2, 1);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `full_name` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `status` varchar(11) DEFAULT NULL,
  `phone` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `full_name`, `email`, `password`, `status`, `phone`) VALUES
(1, 'Administrator', 'administrator@gmail.com', '$2y$10$gMKkB0s2IF/iUDcIhThk9esA0QKrU/g3/yQqv4lOtqN/trTrhjOwq', '2', '9047736314');

-- --------------------------------------------------------

--
-- Table structure for table `user_type`
--

CREATE TABLE `user_type` (
  `id` int(11) NOT NULL,
  `usertype_name` varchar(20) DEFAULT NULL,
  `status` int(11) DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `user_type`
--

INSERT INTO `user_type` (`id`, `usertype_name`, `status`) VALUES
(1, 'Admin', 1),
(2, 'Member', 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `payment`
--
ALTER TABLE `payment`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user_type`
--
ALTER TABLE `user_type`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `payment`
--
ALTER TABLE `payment`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `user_type`
--
ALTER TABLE `user_type`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
