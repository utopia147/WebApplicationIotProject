-- phpMyAdmin SQL Dump
-- version 4.6.6
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Jun 24, 2019 at 11:17 AM
-- Server version: 5.7.17-log
-- PHP Version: 5.6.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `smartroom`
--

-- --------------------------------------------------------

--
-- Table structure for table `control`
--

CREATE TABLE `control` (
  `controlid` int(3) NOT NULL,
  `deviceid` int(2) NOT NULL,
  `statusdevice` varchar(5) NOT NULL DEFAULT 'Off',
  `datecontrol` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `control`
--

INSERT INTO `control` (`controlid`, `deviceid`, `statusdevice`, `datecontrol`) VALUES
(1, 1, 'OFF', '2019-06-08 06:43:09'),
(2, 1, 'OFF', '2019-06-08 06:43:23'),
(3, 1, 'ON', '2019-06-08 07:04:53'),
(4, 1, 'OFF', '2019-06-08 07:06:06'),
(5, 1, 'ON', '2019-06-08 07:15:31'),
(6, 1, 'OFF', '2019-06-08 07:15:33'),
(7, 1, 'OFF', '2019-06-08 07:16:35'),
(8, 1, 'ON', '2019-06-08 07:16:40'),
(9, 2, 'ON', '2019-06-08 07:17:45'),
(10, 1, 'OFF', '2019-06-08 07:17:57'),
(11, 2, 'OFF', '2019-06-08 07:18:09'),
(12, 1, 'ON', '2019-06-10 06:59:59'),
(13, 2, 'ON', '2019-06-10 07:00:31'),
(14, 3, 'ON', '2019-06-10 07:00:34'),
(15, 1, 'OFF', '2019-06-13 07:56:16'),
(16, 2, 'OFF', '2019-06-13 07:56:23'),
(17, 3, 'OFF', '2019-06-13 07:56:25'),
(18, 3, 'OFF', '2019-06-13 07:56:28'),
(19, 4, 'OFF', '2019-06-13 07:56:32'),
(20, 5, 'OFF', '2019-06-13 07:56:45'),
(22, 1, 'ON', '2019-06-13 08:40:42'),
(23, 1, 'OFF', '2019-06-13 08:40:51'),
(24, 1, 'ON', '2019-06-13 08:42:55'),
(25, 2, 'ON', '2019-06-13 08:42:56'),
(26, 3, 'ON', '2019-06-13 08:42:57'),
(27, 4, 'ON', '2019-06-13 08:43:02'),
(28, 5, 'ON', '2019-06-13 08:43:06'),
(30, 1, 'OFF', '2019-06-13 08:47:52'),
(31, 3, 'OFF', '2019-06-13 08:47:56'),
(32, 1, 'ON', '2019-06-13 09:01:19'),
(33, 2, 'ON', '2019-06-13 09:01:20'),
(34, 3, 'ON', '2019-06-13 09:01:23'),
(35, 4, 'ON', '2019-06-13 09:01:25'),
(36, 5, 'ON', '2019-06-13 09:01:27'),
(38, 1, 'OFF', '2019-06-13 09:04:20'),
(39, 1, 'OFF', '2019-06-13 09:04:22'),
(40, 2, 'ON', '2019-06-14 05:21:41'),
(41, 1, 'OFF', '2019-06-14 05:24:17'),
(42, 2, 'OFF', '2019-06-14 05:24:18'),
(43, 3, 'ON', '2019-06-14 05:24:19'),
(44, 3, 'ON', '2019-06-14 05:24:20'),
(45, 3, 'OFF', '2019-06-14 05:24:21'),
(47, 1, 'ON', '2019-06-14 05:24:30'),
(48, 2, 'ON', '2019-06-14 05:24:31'),
(49, 3, 'ON', '2019-06-14 05:24:37'),
(50, 5, 'ON', '2019-06-14 05:24:44'),
(51, 5, 'OFF', '2019-06-14 05:24:49'),
(53, 1, 'OFF', '2019-06-14 05:27:11'),
(54, 1, 'ON', '2019-06-14 06:01:56'),
(55, 2, 'OFF', '2019-06-14 06:01:58'),
(56, 3, 'OFF', '2019-06-14 06:02:01'),
(57, 1, 'OFF', '2019-06-14 06:02:16'),
(58, 2, 'ON', '2019-06-14 06:02:20'),
(59, 1, 'ON', '2019-06-14 06:04:47'),
(60, 1, 'OFF', '2019-06-14 18:19:53'),
(62, 5, 'ON', '2019-06-15 08:33:31'),
(63, 1, 'ON', '2019-06-15 08:33:34'),
(65, 1, 'OFF', '2019-06-22 02:36:55'),
(66, 1, 'ON', '2019-06-22 09:59:28'),
(67, 12, 'ON', '2019-06-22 10:11:56'),
(68, 12, 'OFF', '2019-06-22 10:12:07'),
(70, 13, 'ON', '2019-06-22 10:33:44'),
(71, 13, 'OFF', '2019-06-22 10:34:05'),
(72, 17, 'ON', '2019-06-22 10:36:20'),
(73, 15, 'ON', '2019-06-22 10:36:32'),
(74, 13, 'ON', '2019-06-22 10:36:53'),
(75, 16, 'ON', '2019-06-22 10:36:58'),
(76, 13, 'OFF', '2019-06-22 10:40:57'),
(77, 16, 'OFF', '2019-06-22 10:41:04'),
(78, 15, 'OFF', '2019-06-22 10:41:10'),
(79, 17, 'OFF', '2019-06-22 10:41:15');

-- --------------------------------------------------------

--
-- Table structure for table `device`
--

CREATE TABLE `device` (
  `deviceid` int(2) NOT NULL,
  `roomid` int(2) NOT NULL,
  `devicename` varchar(50) NOT NULL,
  `devicepos` varchar(50) NOT NULL,
  `status` varchar(5) NOT NULL DEFAULT 'OFF',
  `devicestatus` varchar(1) NOT NULL DEFAULT 'Y'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `device`
--

INSERT INTO `device` (`deviceid`, `roomid`, `devicename`, `devicepos`, `status`, `devicestatus`) VALUES
(1, 1, 'หลอดไฟ', 'ห้องครัว', 'ON', 'Y'),
(2, 1, 'พัดลม', 'ห้องนั่งเล่น', 'ON', 'Y'),
(3, 1, 'หลอดไฟ', 'ห้องน้ำ', 'OFF', 'Y'),
(4, 1, 'หลอดไฟ', 'ห้องโถง', 'OFF', 'Y'),
(5, 1, 'หลอดไฟ', 'ห้องเก็บของ', 'ON', 'Y'),
(10, 1, 'ตู้เย็น', 'ห้องครัว', 'OFF', 'Y'),
(12, 6, 'หลอดไฟ', 'ห้องน้ำ', 'OFF', 'Y'),
(13, 3, 'แอร์', 'ห้องนอน', 'OFF', 'N'),
(15, 3, 'ตู้เย็น', 'ห้องนั่งเล่น', 'OFF', 'Y'),
(16, 3, 'พัดลม', 'ระเบียง', 'OFF', 'Y'),
(17, 3, 'หม้อหุงข้าว', 'ครัว', 'OFF', 'Y');

-- --------------------------------------------------------

--
-- Table structure for table `room`
--

CREATE TABLE `room` (
  `roomid` int(2) NOT NULL,
  `roomNo` varchar(50) NOT NULL,
  `floor` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `room`
--

INSERT INTO `room` (`roomid`, `roomNo`, `floor`) VALUES
(1, '1/01', '1'),
(2, '2/002', '2'),
(3, '3/001', '3'),
(4, '4/001', '4'),
(6, '1/02', '1'),
(7, '5A', '5');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `userid` int(2) NOT NULL,
  `roomid` int(2) DEFAULT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(50) NOT NULL,
  `fname` varchar(50) NOT NULL,
  `lname` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `picture` varchar(100) NOT NULL,
  `date` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `status` varchar(1) NOT NULL DEFAULT 'Y'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`userid`, `roomid`, `username`, `password`, `fname`, `lname`, `email`, `picture`, `date`, `status`) VALUES
(1, NULL, 'admin', 'admin', 'admin', '', 'utopia@hotmail.com', 'avatar.jpg', '2019-06-10 11:17:14', 'R'),
(2, 1, 'user1', '123', 'user1', 'user1', 'wwww@hotmail.com', 'avatar.jpg', '2019-06-10 11:26:14', 'A'),
(3, 2, 'user1', '1234', 'aaaa', 'aaa', 'aaaa@hotmail.com', 'images.jpg', '2019-06-15 16:04:12', 'A'),
(11, 6, 'guest', 'guest', 'aaaa', 'aaaa', 'aaaa@hotmail.com', 'images.jpg', '2019-06-22 10:10:38', 'A'),
(12, 6, 'ww', 'ww', 'ww', 'ww', 'ww@hotmail.com', '', '2019-06-22 10:13:30', 'U'),
(13, 3, 'toey', 'toey', 'kuru', 'kuru', 'toey@hotmail.com', '', '2019-06-22 10:27:40', 'A'),
(14, 3, 'jackkii', 'jackkii', 'eiei', 'eiei', 'jack@hotmail.com', '', '2019-06-22 10:30:22', 'U');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `control`
--
ALTER TABLE `control`
  ADD PRIMARY KEY (`controlid`),
  ADD KEY `fk_control_device` (`deviceid`);

--
-- Indexes for table `device`
--
ALTER TABLE `device`
  ADD PRIMARY KEY (`deviceid`),
  ADD KEY `fk_roomid_device` (`roomid`);

--
-- Indexes for table `room`
--
ALTER TABLE `room`
  ADD PRIMARY KEY (`roomid`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`userid`),
  ADD KEY `fk_roomid_users` (`roomid`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `control`
--
ALTER TABLE `control`
  MODIFY `controlid` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=80;
--
-- AUTO_INCREMENT for table `device`
--
ALTER TABLE `device`
  MODIFY `deviceid` int(2) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;
--
-- AUTO_INCREMENT for table `room`
--
ALTER TABLE `room`
  MODIFY `roomid` int(2) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `userid` int(2) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;
--
-- Constraints for dumped tables
--

--
-- Constraints for table `control`
--
ALTER TABLE `control`
  ADD CONSTRAINT `fk_control_device` FOREIGN KEY (`deviceid`) REFERENCES `device` (`deviceid`) ON DELETE NO ACTION ON UPDATE CASCADE;

--
-- Constraints for table `device`
--
ALTER TABLE `device`
  ADD CONSTRAINT `fk_roomid_device` FOREIGN KEY (`roomid`) REFERENCES `room` (`roomid`) ON DELETE NO ACTION ON UPDATE CASCADE;

--
-- Constraints for table `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `fk_roomid_users` FOREIGN KEY (`roomid`) REFERENCES `room` (`roomid`) ON DELETE NO ACTION ON UPDATE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
