-- phpMyAdmin SQL Dump
-- version 4.9.5
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Apr 08, 2021 at 11:39 AM
-- Server version: 5.7.24
-- PHP Version: 7.4.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `mini_bbs`
--

-- --------------------------------------------------------

--
-- Table structure for table `members`
--

CREATE TABLE `members` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(100) NOT NULL,
  `picture` varchar(255) NOT NULL,
  `created` datetime NOT NULL,
  `modified` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `members`
--

INSERT INTO `members` (`id`, `name`, `email`, `password`, `picture`, `created`, `modified`) VALUES
(1, 'aaa', 'test@test.com', '70c881d4a26984ddce795f6f71817c9cf4480e79', '20210408100827b0125295_21152085.jpg', '2021-04-08 19:08:30', '2021-04-08 10:08:30'),
(2, 'aaa', 'test@test.com', '70c881d4a26984ddce795f6f71817c9cf4480e79', '20210408102443', '2021-04-08 19:24:45', '2021-04-08 10:24:45'),
(3, 'aaa', 'test@test.com', '70c881d4a26984ddce795f6f71817c9cf4480e79', '20210408102550', '2021-04-08 19:25:51', '2021-04-08 10:25:51'),
(4, 'aaa', 'test@test.com', '70c881d4a26984ddce795f6f71817c9cf4480e79', '20210408111405b0125295_21152085.jpg', '2021-04-08 20:14:07', '2021-04-08 11:14:07'),
(5, 'aaa', 'test@test.com', '70c881d4a26984ddce795f6f71817c9cf4480e79', '20210408112058', '2021-04-08 20:20:59', '2021-04-08 11:20:59'),
(6, 'aaa', 'test@test.com', '70c881d4a26984ddce795f6f71817c9cf4480e79', '20210408112339', '2021-04-08 20:23:41', '2021-04-08 11:23:41'),
(7, 'aaa', 'test@test.com', '70c881d4a26984ddce795f6f71817c9cf4480e79', '20210408112606', '2021-04-08 20:26:09', '2021-04-08 11:26:09');

-- --------------------------------------------------------

--
-- Table structure for table `posts`
--

CREATE TABLE `posts` (
  `id` int(11) NOT NULL,
  `message` text NOT NULL,
  `member_id` int(11) NOT NULL,
  `reply_message_id` int(11) NOT NULL,
  `created` datetime NOT NULL,
  `modified` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `members`
--
ALTER TABLE `members`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `posts`
--
ALTER TABLE `posts`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `members`
--
ALTER TABLE `members`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `posts`
--
ALTER TABLE `posts`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
