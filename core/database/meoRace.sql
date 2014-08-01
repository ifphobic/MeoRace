-- phpMyAdmin SQL Dump
-- version 4.1.7
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Aug 01, 2014 at 08:19 PM
-- Server version: 5.1.70-log
-- PHP Version: 5.5.12-pl0-gentoo

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `meoRace`
--

-- --------------------------------------------------------

--
-- Table structure for table `Checkpoint`
--

CREATE TABLE IF NOT EXISTS `Checkpoint` (
  `checkpointId` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(80) NOT NULL,
  `manned` tinyint(1) NOT NULL,
  `raceFk` int(11) NOT NULL,
  PRIMARY KEY (`checkpointId`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=10 ;

--
-- Dumping data for table `Checkpoint`
--

INSERT INTO `Checkpoint` (`checkpointId`, `name`, `manned`, `raceFk`) VALUES
(1, 'c1', 1, 4),
(2, 'c2', 1, 4),
(3, 'c3', 1, 4),
(9, 'c9', 0, 4),
(4, 'c4', 0, 4),
(5, 'c5', 1, 4),
(6, 'c6', 0, 4),
(7, 'c7', 0, 4),
(8, 'c8', 0, 4);

-- --------------------------------------------------------

--
-- Table structure for table `Delivery`
--

CREATE TABLE IF NOT EXISTS `Delivery` (
  `deliveryId` int(11) NOT NULL AUTO_INCREMENT,
  `taskFk` int(11) NOT NULL,
  `parcelFk` int(11) DEFAULT NULL,
  `pickupFk` int(11) NOT NULL,
  `dropoffFk` int(11) NOT NULL,
  PRIMARY KEY (`deliveryId`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=37 ;

--
-- Dumping data for table `Delivery`
--

INSERT INTO `Delivery` (`deliveryId`, `taskFk`, `parcelFk`, `pickupFk`, `dropoffFk`) VALUES
(32, 12, 7, 5, 6),
(30, 9, 4, 2, 3),
(31, 10, 5, 3, 4),
(29, 7, 3, 1, 2),
(33, 13, 8, 6, 7),
(34, 14, 9, 7, 8),
(35, 16, 11, 9, 1),
(36, 7, 4, 2, 3);

-- --------------------------------------------------------

--
-- Table structure for table `DeliveryCondition`
--

CREATE TABLE IF NOT EXISTS `DeliveryCondition` (
  `deliveryConditionId` int(11) NOT NULL AUTO_INCREMENT,
  `deliveryFk` int(11) NOT NULL,
  `previousDeliveryFk` int(11) NOT NULL,
  PRIMARY KEY (`deliveryConditionId`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=58 ;

--
-- Dumping data for table `DeliveryCondition`
--

INSERT INTO `DeliveryCondition` (`deliveryConditionId`, `deliveryFk`, `previousDeliveryFk`) VALUES
(57, 36, 29);

-- --------------------------------------------------------

--
-- Table structure for table `Parcel`
--

CREATE TABLE IF NOT EXISTS `Parcel` (
  `parcelId` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(80) NOT NULL,
  `description` varchar(256) NOT NULL,
  `raceFk` int(11) NOT NULL,
  PRIMARY KEY (`parcelId`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=12 ;

--
-- Dumping data for table `Parcel`
--

INSERT INTO `Parcel` (`parcelId`, `name`, `description`, `raceFk`) VALUES
(3, 'p1', 'for Race 1cc', 4),
(4, 'p2', 'for Race 1', 4),
(9, 'p7', 'p', 4),
(5, 'p3', 'for Race 1', 4),
(6, 'p4', '', 4),
(7, 'p5', '', 4),
(8, 'p6', '', 4),
(10, 'p8', '', 4),
(11, 'p9', '', 4);

-- --------------------------------------------------------

--
-- Table structure for table `Race`
--

CREATE TABLE IF NOT EXISTS `Race` (
  `raceId` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(256) NOT NULL,
  `status` enum('prepare','running','closed') NOT NULL,
  PRIMARY KEY (`raceId`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=6 ;

--
-- Dumping data for table `Race`
--

INSERT INTO `Race` (`raceId`, `name`, `status`) VALUES
(4, 'Race 2', 'prepare'),
(5, 'Race2', 'prepare');

-- --------------------------------------------------------

--
-- Table structure for table `Racer`
--

CREATE TABLE IF NOT EXISTS `Racer` (
  `racerId` int(11) NOT NULL AUTO_INCREMENT,
  `racerNumber` int(11) NOT NULL,
  `name` varchar(256) NOT NULL,
  `city` varchar(80) NOT NULL,
  `country` varchar(80) NOT NULL,
  `email` varchar(80) NOT NULL,
  `raceFk` int(11) NOT NULL,
  `status` enum('registered','active') NOT NULL,
  PRIMARY KEY (`racerId`),
  UNIQUE KEY `racerNumber` (`raceFk`,`racerNumber`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `Racer`
--

INSERT INTO `Racer` (`racerId`, `racerNumber`, `name`, `city`, `country`, `email`, `raceFk`, `status`) VALUES
(1, 1, 'Racer 1', 'City', 'Country', 'Mail', 4, 'active'),
(2, 0, 'name', 'city', 'country', 'mail', 4, 'active'),
(3, 2, 'asdfasdf', '', '', '', 4, 'registered');

-- --------------------------------------------------------

--
-- Table structure for table `RacerDelivery`
--

CREATE TABLE IF NOT EXISTS `RacerDelivery` (
  `racerDeliveryId` int(11) NOT NULL AUTO_INCREMENT,
  `racerTaskFk` int(11) NOT NULL,
  `deliveryFk` int(11) NOT NULL,
  `pickupTime` datetime DEFAULT NULL,
  `dropoffTime` datetime DEFAULT NULL,
  PRIMARY KEY (`racerDeliveryId`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=87 ;

--
-- Dumping data for table `RacerDelivery`
--

INSERT INTO `RacerDelivery` (`racerDeliveryId`, `racerTaskFk`, `deliveryFk`, `pickupTime`, `dropoffTime`) VALUES
(1, 3, 29, '0000-00-00 00:00:00', NULL),
(2, 3, 36, NULL, NULL),
(3, 4, 29, '0000-00-00 00:00:00', NULL),
(4, 4, 36, NULL, NULL),
(5, 5, 35, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(6, 6, 32, NULL, NULL),
(7, 7, 32, NULL, NULL),
(8, 8, 32, NULL, NULL),
(9, 9, 32, NULL, NULL),
(10, 10, 35, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(11, 11, 35, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(12, 12, 35, '2014-08-01 21:57:55', '2014-08-01 21:57:55'),
(13, 13, 35, '2014-08-01 22:00:26', '2014-08-01 22:00:26'),
(14, 15, 34, NULL, NULL),
(15, 17, 30, NULL, NULL),
(16, 18, 30, NULL, NULL),
(17, 19, 33, NULL, NULL),
(18, 20, 35, '2014-08-01 22:00:31', '2014-08-01 22:00:31'),
(19, 22, 35, '2014-08-01 22:01:53', '2014-08-01 22:01:53'),
(20, 23, 35, '2014-08-01 22:02:04', '2014-08-01 22:02:04'),
(21, 24, 35, '2014-08-01 21:43:44', '2014-08-01 21:43:44'),
(22, 25, 35, '2014-08-01 21:46:03', '2014-08-01 21:46:03'),
(23, 26, 35, '2014-08-01 21:56:10', '2014-08-01 21:56:10'),
(24, 27, 35, '2014-08-01 22:02:27', '2014-08-01 22:02:27'),
(25, 28, 35, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(26, 29, 35, '2014-08-01 22:07:51', '2014-08-01 22:07:51'),
(27, 30, 35, '2014-08-01 22:02:35', '2014-08-01 22:02:35'),
(28, 31, 35, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(29, 32, 35, '2014-08-01 22:03:07', '2014-08-01 22:03:07'),
(30, 33, 35, '2014-08-01 22:08:00', '2014-08-01 22:08:00'),
(31, 34, 35, '2014-08-01 22:08:11', '2014-08-01 22:08:11'),
(32, 35, 35, '2014-08-01 21:57:00', '2014-08-01 21:57:00'),
(33, 36, 35, '2014-08-01 22:03:27', '2014-08-01 22:03:27'),
(34, 37, 35, '2014-08-01 21:46:06', '2014-08-01 21:46:06'),
(35, 38, 33, NULL, NULL),
(36, 39, 33, NULL, NULL),
(37, 40, 33, NULL, NULL),
(38, 41, 33, NULL, NULL),
(39, 42, 33, NULL, NULL),
(40, 43, 33, NULL, NULL),
(41, 44, 34, NULL, NULL),
(42, 45, 34, NULL, NULL),
(43, 46, 34, NULL, NULL),
(44, 47, 31, NULL, NULL),
(45, 48, 31, NULL, NULL),
(46, 49, 31, NULL, NULL),
(47, 50, 31, NULL, NULL),
(48, 51, 31, NULL, NULL),
(49, 52, 31, NULL, NULL),
(50, 55, 29, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(51, 55, 36, NULL, NULL),
(52, 56, 29, '0000-00-00 00:00:00', NULL),
(53, 56, 36, NULL, NULL),
(54, 57, 29, NULL, NULL),
(55, 57, 36, NULL, NULL),
(56, 58, 31, NULL, NULL),
(57, 59, 31, NULL, NULL),
(58, 60, 31, NULL, NULL),
(59, 64, 32, NULL, NULL),
(60, 65, 32, NULL, NULL),
(61, 66, 30, NULL, NULL),
(62, 67, 30, NULL, NULL),
(63, 68, 30, NULL, NULL),
(64, 69, 33, NULL, NULL),
(65, 70, 33, NULL, NULL),
(66, 71, 33, NULL, NULL),
(67, 72, 33, NULL, NULL),
(68, 73, 33, NULL, NULL),
(69, 74, 34, NULL, NULL),
(70, 75, 34, NULL, NULL),
(71, 76, 34, NULL, NULL),
(72, 80, 35, '2014-08-01 22:05:04', '2014-08-01 22:05:04'),
(73, 81, 35, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(74, 82, 35, '2014-08-01 22:06:23', '2014-08-01 22:06:23'),
(75, 83, 35, '2014-08-01 22:06:55', '2014-08-01 22:06:55'),
(76, 86, 29, '0000-00-00 00:00:00', NULL),
(77, 86, 36, NULL, NULL),
(78, 87, 35, NULL, NULL),
(79, 88, 35, NULL, NULL),
(80, 89, 35, NULL, NULL),
(81, 90, 35, NULL, NULL),
(82, 91, 35, NULL, NULL),
(83, 92, 35, NULL, NULL),
(84, 93, 35, NULL, NULL),
(85, 94, 35, NULL, NULL),
(86, 95, 35, '2014-08-01 22:18:48', '2014-08-01 22:18:48');

-- --------------------------------------------------------

--
-- Table structure for table `RacerTask`
--

CREATE TABLE IF NOT EXISTS `RacerTask` (
  `racerTaskId` int(11) NOT NULL AUTO_INCREMENT,
  `racerFk` int(11) NOT NULL,
  `taskFk` int(11) NOT NULL,
  `price` int(11) NOT NULL,
  `startTime` datetime DEFAULT NULL,
  `endTime` datetime DEFAULT NULL,
  PRIMARY KEY (`racerTaskId`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=96 ;

--
-- Dumping data for table `RacerTask`
--

INSERT INTO `RacerTask` (`racerTaskId`, `racerFk`, `taskFk`, `price`, `startTime`, `endTime`) VALUES
(4, 2, 7, 34, NULL, NULL),
(3, 1, 7, 50, NULL, NULL),
(5, 2, 16, 55, NULL, NULL),
(6, 2, 12, 85, NULL, NULL),
(7, 2, 12, 59, NULL, NULL),
(8, 1, 12, 40, NULL, NULL),
(9, 3, 12, 27, NULL, NULL),
(10, 2, 16, 43, NULL, NULL),
(11, 2, 16, 29, NULL, NULL),
(12, 2, 16, 19, NULL, NULL),
(13, 2, 16, 13, NULL, NULL),
(14, 3, 15, 103, NULL, NULL),
(15, 1, 14, 107, NULL, NULL),
(16, 1, 11, 76, NULL, NULL),
(17, 3, 9, 116, NULL, NULL),
(18, 3, 9, 82, NULL, NULL),
(19, 3, 13, 127, NULL, NULL),
(20, 2, 16, 13, NULL, NULL),
(21, 2, 15, 96, NULL, NULL),
(22, 2, 16, 9, NULL, NULL),
(23, 2, 16, 6, NULL, NULL),
(24, 1, 16, 4, NULL, NULL),
(25, 1, 16, 3, NULL, NULL),
(26, 1, 16, 2, NULL, NULL),
(27, 2, 16, 1, NULL, NULL),
(28, 2, 16, 1, NULL, NULL),
(29, 3, 16, 1, NULL, '2014-08-01 22:07:51'),
(30, 2, 16, 0, NULL, NULL),
(31, 2, 16, 0, NULL, NULL),
(32, 2, 16, 0, NULL, NULL),
(33, 3, 16, 0, NULL, '2014-08-01 22:08:00'),
(34, 3, 16, 0, NULL, '2014-08-01 22:08:11'),
(35, 1, 16, 0, NULL, NULL),
(36, 2, 16, 0, NULL, NULL),
(37, 1, 16, 0, NULL, NULL),
(38, 3, 13, 97, NULL, NULL),
(39, 3, 13, 68, NULL, NULL),
(40, 3, 13, 48, NULL, NULL),
(41, 3, 13, 34, NULL, NULL),
(42, 3, 13, 24, NULL, NULL),
(43, 3, 13, 17, NULL, NULL),
(44, 3, 14, 113, NULL, NULL),
(45, 3, 14, 80, NULL, NULL),
(46, 3, 14, 57, NULL, NULL),
(47, 3, 10, 166, NULL, NULL),
(48, 3, 10, 118, NULL, NULL),
(49, 3, 10, 84, NULL, NULL),
(50, 3, 10, 59, NULL, NULL),
(51, 3, 10, 42, NULL, NULL),
(52, 3, 10, 29, NULL, NULL),
(53, 1, 15, 114, NULL, NULL),
(54, 1, 15, 81, NULL, NULL),
(55, 2, 7, 104, NULL, NULL),
(56, 1, 7, 73, NULL, NULL),
(57, 3, 7, 52, NULL, NULL),
(58, 3, 10, 36, NULL, NULL),
(59, 3, 10, 25, NULL, NULL),
(60, 3, 10, 18, NULL, NULL),
(61, 3, 11, 141, NULL, NULL),
(62, 3, 11, 100, NULL, NULL),
(63, 1, 11, 71, NULL, NULL),
(64, 3, 12, 113, NULL, NULL),
(65, 1, 12, 80, NULL, NULL),
(66, 3, 9, 162, NULL, NULL),
(67, 3, 9, 115, NULL, NULL),
(68, 3, 9, 82, NULL, NULL),
(69, 3, 13, 87, NULL, NULL),
(70, 3, 13, 61, NULL, NULL),
(71, 3, 13, 42, NULL, NULL),
(72, 3, 13, 30, NULL, NULL),
(73, 3, 13, 21, NULL, NULL),
(74, 3, 14, 131, NULL, NULL),
(75, 3, 14, 93, NULL, NULL),
(76, 3, 14, 66, NULL, NULL),
(77, 3, 11, 97, NULL, NULL),
(78, 1, 15, 139, NULL, NULL),
(79, 1, 15, 99, NULL, NULL),
(80, 2, 16, 7, NULL, NULL),
(81, 2, 16, 4, NULL, NULL),
(82, 2, 16, 3, NULL, NULL),
(83, 2, 16, 2, NULL, NULL),
(84, 2, 15, 71, NULL, NULL),
(85, 1, 15, 50, NULL, NULL),
(86, 1, 7, 117, NULL, NULL),
(87, 1, 16, 2, NULL, NULL),
(88, 1, 16, 1, NULL, NULL),
(89, 1, 16, 1, NULL, NULL),
(90, 1, 16, 1, NULL, NULL),
(91, 1, 16, 0, NULL, NULL),
(92, 1, 16, 0, NULL, NULL),
(93, 1, 16, 0, NULL, NULL),
(94, 1, 16, 0, NULL, NULL),
(95, 1, 16, 0, '2014-08-01 22:18:03', '2014-08-01 22:18:48');

-- --------------------------------------------------------

--
-- Table structure for table `Session`
--

CREATE TABLE IF NOT EXISTS `Session` (
  `sessionId` varchar(42) NOT NULL,
  `userFk` int(11) NOT NULL,
  `loginTime` datetime NOT NULL,
  `lastActive` datetime NOT NULL,
  PRIMARY KEY (`sessionId`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `Session`
--

INSERT INTO `Session` (`sessionId`, `userFk`, `loginTime`, `lastActive`) VALUES
('8Nqys8MS8z3C2bb2bOFzlHNo9r9gnfkAWV89PiBczz', 0, '2014-06-01 16:19:57', '2014-06-01 16:19:57'),
('ieX66MS4A1fcnN11q9sgmud5rzzjgVTlNUXoSYpWSK', 0, '2014-06-01 16:58:22', '2014-06-01 16:58:22'),
('qA4M9n4dcc3YpGixm9MWWTTTTE8YSzc6SLx9zl0Brd', 7, '2014-06-01 17:03:28', '2014-06-01 17:03:28'),
('jubr7lb3rxdMLFYhdBwfZUpLbNUS0csbMZTRl2jnJJ', 0, '2014-06-01 17:27:24', '2014-06-01 17:27:24'),
('PtvqLsrBGPBZYBaw0X33EdlupPR0r26Pa0vUuYHDmM', 7, '2014-06-01 17:29:11', '2014-06-01 17:29:11'),
('945ciwqkVppjhhcGw0murEXh3f8CoNyGxfL6rhhJws', 0, '2014-06-01 18:12:53', '2014-06-01 18:12:53'),
('ZTktsOkqnHiw7krU3D0zPsj2V32g7TegZ0DwHjeH03', 8, '2014-06-01 18:13:59', '2014-06-01 18:13:59'),
('cd9vgqoyuuDCbcYMrgWzHMNIVc3mT88NPhRomPyzm0', 7, '2014-06-01 18:16:40', '2014-06-01 18:16:40'),
('EFxTys7Z8r0ZKZQ8U1mYhVJpE3F5eA6oZp0hpT19ue', 7, '2014-06-01 19:49:48', '2014-06-01 19:49:48'),
('ixjzGOutfCMBorufFPG1jjgVtGy6NSCkyGU2C56gwQ', 0, '2014-06-01 20:00:06', '2014-06-01 20:00:06'),
('MYDuuUKWoCNM4odKkD9ytZWMGWMY5IipE459NjCQWE', 7, '2014-06-01 20:00:15', '2014-06-01 20:00:15'),
('UhCREk7VPP7u1ofYqiSeXwaxjFzVZvVREPtV8qvvJy', 0, '2014-06-01 20:01:26', '2014-06-01 20:01:26'),
('pJFOZKvhCY3WpV1C3eiuVBrW6PvJA2wMSnsGGzOG66', 7, '2014-06-01 20:02:37', '2014-06-01 20:02:37'),
('Z1JfGa3xmIrLaZP7Jjz50RSEPJI0GQ6XTQYOsfxLHh', 7, '2014-06-01 20:18:50', '2014-06-01 20:18:50'),
('uKfwzGcQSgU85gpIrwovs8pLH73shf573AGsbT5Dso', 0, '2014-06-08 11:57:23', '2014-06-08 11:57:23'),
('0VwaKGO1iWAZ1U98k7cVAuq6NoaOoYwlGrnMvdamYI', 0, '2014-06-08 12:05:14', '2014-06-08 12:05:14'),
('RWwcGe4ymqOv8DyRb7kpqdrs3rDy5CU2rAEUNN6fkd', 0, '2014-06-08 12:10:38', '2014-06-08 12:10:38'),
('XCbEjVU3utV45ozcSIPvYQxKQUuTYDSsRM0ZyNDZ9I', 0, '2014-06-08 12:18:07', '2014-06-08 12:18:07'),
('8zo0O3vCsaEk8qsayDfLbGXc7ZLsa9bLVgifhnFZHc', 7, '2014-06-08 13:31:53', '2014-06-08 13:31:53'),
('T4XxhD7zZA7hkapvvtm84KoMEEhrUD32XrQ3gswhpv', 7, '2014-06-08 15:04:07', '2014-06-08 15:04:07'),
('mMITXZEi3MN2Oc5hfmK0WAlaSM6ldvcEmNt6Vtmw4W', 7, '2014-06-08 16:36:31', '2014-06-08 16:36:31'),
('WlhN53frC6JVRRkh7n8SajJIwj7NSD6EUnAJ2abGF7', 7, '2014-06-08 17:38:29', '2014-06-08 17:38:29'),
('pTy5FkjMkUbZX9HQdFP1jabF685ZzZ6InCv2BN0kcz', 7, '2014-06-10 18:08:18', '2014-06-10 18:08:18'),
('ZicNej3OCXzHKJQn79tGHmHN2E6bEKkTeRYCQj9b4n', 7, '2014-06-11 18:24:15', '2014-06-11 18:24:15'),
('Bd7GVoptUpTbpHs9t97WDEnc1xRglAnZkZEkYfgMKQ', 7, '2014-06-11 19:24:35', '2014-06-11 19:24:35'),
('OfUsEe9sWBhNK1DMOX5a56sCHeRVrhk5QIOyRLRLyW', 7, '2014-06-14 18:18:53', '2014-06-14 18:18:53'),
('gBAW38xjKdnsvHgfeQjM5BMt2dRGbjIc8OSXP0lcSG', 7, '2014-06-14 19:20:30', '2014-06-14 19:20:30'),
('PBU6hDnwitBSbsG8932r7ExZWyN6B0Jes0vQPz2Phh', 7, '2014-06-14 19:20:59', '2014-06-14 19:20:59'),
('15y3477st6rFv7riFEvORZxJvMk3dlGLQi7Y9nEFBy', 7, '2014-06-16 18:22:38', '2014-06-16 18:22:38'),
('zjx1U9QfKkN3YYlnWIdSEUgRwUnwLZOM4bc0OpfIIC', 7, '2014-06-16 18:25:20', '2014-06-16 18:25:20'),
('sz0WMmrjWaITkalU8N4mIBmP0mjupbExwJcrKa0Eyr', 7, '2014-06-16 18:41:05', '2014-06-16 18:41:05'),
('ZPFAIQK5cOSXdILUiOhkbKbJM15l7qIgLsnQB9rZbl', 0, '2014-06-16 18:54:09', '2014-06-16 18:54:09'),
('0pGAsSsVG9I5irJvGCO3ECkaVX2MWqSAkhYr0U29I9', 7, '2014-06-17 21:10:49', '2014-06-17 21:10:49'),
('I7HfVPzQZgHfToh5izr1yczwT66m1c1I7sqJfInkJC', 7, '2014-06-17 21:13:32', '2014-06-17 21:13:32'),
('sixBqaxzLwKUbC2PFORrFrvc0uL80b5d1QPTau4kDI', 7, '2014-06-17 21:15:37', '2014-06-17 21:15:37'),
('GhJ792EHja7Y9Vfi4YJrQjByv41ZLrdBaTIJJFcNC6', 7, '2014-06-17 22:47:05', '2014-06-17 22:47:05'),
('BZXTmkbCuhJBmaHdx3aXykmDePeZK3FplbWIRjsTT9', 7, '2014-06-18 20:32:33', '2014-06-18 20:32:33'),
('zJgKUjbPjM9KVJEx3idmhg2hqNZDTiR32jrpoH5mi3', 7, '2014-06-18 21:34:16', '2014-06-18 21:34:16'),
('pDSn96pcTvhIA2WH0MNN7f2ryKd4BZAsOngTYhU4Sr', 7, '2014-06-18 22:17:29', '2014-06-18 22:17:29'),
('xsAbS1t8HGXXdQvnEKBkyTj2vwgNMi4ZXsLIDVKPV5', 7, '2014-06-18 23:19:54', '2014-06-18 23:19:54'),
('3WfRO3qqHW2N0C8HNnvo9f1kVyYbNdu2UEQGEEXCHk', 7, '2014-06-18 23:35:39', '2014-06-18 23:35:39'),
('QFNlhH9vsL0vA8wJRrDKWeJWKJJnxFoEwtI0cX0B40', 7, '2014-06-19 00:03:07', '2014-06-19 00:03:07'),
('0jy8ovIcDhpR0bjTnbmrMwLnorMzFk2Bj9h3W5jnXV', 7, '2014-06-19 01:03:56', '2014-06-19 01:03:56'),
('4oWNibUYCokLVUt2uqBAokpAxwD2p11Las7B6duMOw', 7, '2014-07-22 17:14:03', '2014-07-22 17:14:03'),
('3eR1GDv2IczJfRADMDT7hk6FiCWPrApRfGx3Y3CnOt', 7, '2014-07-22 17:14:33', '2014-07-22 17:14:33'),
('tNnN62gmn1R5Jf9lBGNcQzKmjgWS9J7Lyl7a5SzaRB', 0, '2014-07-22 17:23:52', '2014-07-22 17:23:52'),
('1Gs4UHpNMMGTCyPVT8qiVBSFWvKBvb6RnqIe08zhxD', 11, '2014-07-22 17:28:14', '2014-07-22 17:28:14'),
('ckLMaP0umu4xGR7ksLGwkNp3hfC7BkjzHZcMzUSCYe', 11, '2014-07-22 18:56:34', '2014-07-22 18:56:34'),
('jJ4ZAHjHh14wL5oUkbGy5wDaxnMtCltzVvegRhcI37', 11, '2014-07-23 20:09:07', '2014-07-23 20:09:07'),
('mwR3DU44xzlyqXsdqZfmW7eHusZF3V0nqNLp8vTBa5', 11, '2014-07-28 17:24:23', '2014-07-28 17:24:23'),
('hPXCBJuxSaIVbi7NY9dgCNPiXGUxxCC81nkAQKgm0n', 11, '2014-07-28 18:32:05', '2014-07-28 18:32:05'),
('eHotAkSVLstdXHe2msV3cPV8yayiHGhxIZQRzen0zZ', 11, '2014-07-28 19:36:23', '2014-07-28 19:36:23'),
('os9GF0RecGOm1Zpf6EcyIKDPFX90Z4U7TTA8NfG4R8', 7, '2014-07-29 17:04:14', '2014-07-29 17:04:14'),
('yOx28UkxS5Z4xdNc58baieh0rSqJCxA25GqUKqCsZB', 11, '2014-07-29 19:04:27', '2014-07-29 19:04:27'),
('4kHSfE6d2Ea1o5ohOPY2bGk5QIiPJ5oVqqIwNiwKtc', 11, '2014-07-30 18:19:18', '2014-07-30 18:19:18'),
('Qb3HalsMvSfYl4d6Mubl0tyYzxjXyGy3QttvAjaN0C', 11, '2014-07-30 20:34:22', '2014-07-30 20:34:22'),
('xvkSBjcZSThPHMp5mVDZtTLlg3YKI88rrSMdIbBzRF', 7, '2014-07-30 22:50:14', '2014-07-30 22:50:14'),
('l298wlfUehLMUX75nrBPfEXA16n7i9D8JOjiaWmtNT', 11, '2014-08-01 15:22:54', '2014-08-01 15:22:54'),
('3bdhOEVLZ7I1GaiMffWY49OZaQXahw18wFDRbKLyF2', 11, '2014-08-01 17:01:05', '2014-08-01 17:01:05'),
('CmBeTQKVPCm69o0lzKivRCZidwN1TlPQKdJyCUdT24', 11, '2014-08-01 18:01:43', '2014-08-01 18:01:43'),
('bOckWwwSy0wYxAIO5zxayF8IFDNfG5To0qcGHpZZDA', 11, '2014-08-01 19:02:11', '2014-08-01 19:02:11'),
('EE8G7CpOLvwCILXVPxYCV2MSWysoa9zBSaxocC2hE8', 11, '2014-08-01 20:10:36', '2014-08-01 20:10:36'),
('68rdV7bzb1aM7iyYTTfrPlD9UJSEdDKHpDFQw6uHXb', 11, '2014-08-01 21:23:46', '2014-08-01 21:23:46'),
('824gmNHYT2VXv4rB1w259X6pDy244ItyA1uaUuswpa', 7, '2014-08-01 21:26:42', '2014-08-01 21:26:42');

-- --------------------------------------------------------

--
-- Table structure for table `StockExchangeDispatch`
--

CREATE TABLE IF NOT EXISTS `StockExchangeDispatch` (
  `taskFk` int(11) NOT NULL,
  `raceFk` int(11) NOT NULL,
  `price` double NOT NULL,
  `counter` int(11) NOT NULL,
  PRIMARY KEY (`taskFk`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `StockExchangeDispatch`
--

INSERT INTO `StockExchangeDispatch` (`taskFk`, `raceFk`, `price`, `counter`) VALUES
(16, 4, 0.071030044625801, 38),
(15, 4, 56.967597850715, 10),
(14, 4, 100.74694492117, 9),
(13, 4, 57.761389447829, 14),
(12, 4, 168.8458263262, 8),
(11, 4, 128.32569076438, 8),
(10, 4, 115.75973988753, 11),
(7, 4, 117.53796165669, 9),
(9, 4, 153.98381910095, 7);

-- --------------------------------------------------------

--
-- Table structure for table `Task`
--

CREATE TABLE IF NOT EXISTS `Task` (
  `taskId` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(80) NOT NULL,
  `maxDuration` int(11) NOT NULL COMMENT '[seconds]',
  `price` int(11) NOT NULL,
  `description` varchar(256) NOT NULL,
  `raceFk` int(11) NOT NULL,
  PRIMARY KEY (`taskId`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=17 ;

--
-- Dumping data for table `Task`
--

INSERT INTO `Task` (`taskId`, `name`, `maxDuration`, `price`, `description`, `raceFk`) VALUES
(9, 'M2', 3600, 100, '', 4),
(7, 'M1', 60, 100, 'description', 4),
(10, 'M3', 3600, 100, '', 4),
(11, 'M4', 3600, 100, '', 4),
(12, 'M5', 0, 100, '', 4),
(13, 'M6', 0, 100, '', 4),
(14, 'M7', 0, 100, '', 4),
(15, 'M8', 0, 100, '', 4),
(16, 'M9', 0, 100, '', 4);

-- --------------------------------------------------------

--
-- Table structure for table `User`
--

CREATE TABLE IF NOT EXISTS `User` (
  `userId` int(11) NOT NULL AUTO_INCREMENT,
  `user` varchar(80) NOT NULL,
  `password` varchar(80) NOT NULL,
  `role` varchar(80) NOT NULL,
  `raceFk` int(11) NOT NULL,
  `checkpointFk` int(11) DEFAULT NULL,
  PRIMARY KEY (`userId`),
  UNIQUE KEY `user` (`user`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=12 ;

--
-- Dumping data for table `User`
--

INSERT INTO `User` (`userId`, `user`, `password`, `role`, `raceFk`, `checkpointFk`) VALUES
(0, 'admin', '8c6976e5b5410415bde908bd4dee15dfb167a9c873fc4bb8a81f6f2ab448a918', 'admin', -1, NULL),
(7, 'master', 'fc613b4dfd6736a7bd268c8a0e74ed0d1c04a959f59dd74ef2874983fd443fc9', 'race master', 4, NULL),
(8, 'registration', '29c9c30e0604515ced98b3d14fd88751a8f8e4b9bc69d483a67a257c14ab79fb', 'registration', 4, NULL),
(10, 'master2', 'ee33bacb9843d3b4bac37e425b203d8aad4e08c6773d21a10533d66cd6bb7c02', 'race master', 5, NULL),
(11, 'dispatcher', 'ff7fce673d2f52b071129e34ff8ea570b7159527d019c81ec7756f4f8c821535', 'dispatcher', 4, 1);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
