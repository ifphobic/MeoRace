-- phpMyAdmin SQL Dump
-- version 4.1.7
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Aug 17, 2014 at 05:15 PM
-- Server version: 5.5.39-log
-- PHP Version: 5.5.15-pl0-gentoo

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
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=10 ;

--
-- Dumping data for table `Checkpoint`
--

INSERT INTO `Checkpoint` (`checkpointId`, `name`, `manned`, `raceFk`) VALUES
(1, 'c1', 1, 4),
(2, 'c2', 1, 4),
(3, 'c3', 1, 4),
(4, 'c4', 1, 4),
(5, 'c5', 1, 4),
(6, 'c613', 0, 4),
(7, 'c7', 0, 4),
(8, 'c8', 0, 4),
(9, 'c9', 0, 4);

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
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=39 ;

--
-- Dumping data for table `Delivery`
--

INSERT INTO `Delivery` (`deliveryId`, `taskFk`, `parcelFk`, `pickupFk`, `dropoffFk`) VALUES
(29, 7, 3, 1, 2),
(30, 9, 4, 2, 3),
(31, 10, 5, 3, 4),
(32, 12, 7, 5, 6),
(33, 13, 8, 6, 7),
(34, 14, 9, 7, 8),
(35, 16, 11, 9, 1),
(36, 7, 4, 2, 3),
(38, 17, 4, 2, 3);

-- --------------------------------------------------------

--
-- Table structure for table `DeliveryCondition`
--

CREATE TABLE IF NOT EXISTS `DeliveryCondition` (
  `deliveryConditionId` int(11) NOT NULL AUTO_INCREMENT,
  `deliveryFk` int(11) NOT NULL,
  `previousDeliveryFk` int(11) NOT NULL,
  PRIMARY KEY (`deliveryConditionId`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=58 ;

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
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=12 ;

--
-- Dumping data for table `Parcel`
--

INSERT INTO `Parcel` (`parcelId`, `name`, `description`, `raceFk`) VALUES
(3, 'p1', 'for Race 1cc', 4),
(4, 'p2', 'for Race 1', 4),
(5, 'p3', 'for Race 1', 4),
(6, 'p4', '', 4),
(7, 'p5', '', 4),
(8, 'p6', '', 4),
(9, 'p7', 'p', 4),
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
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=6 ;

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
  `image` varchar(80) DEFAULT NULL,
  PRIMARY KEY (`racerId`),
  UNIQUE KEY `racerNumber` (`raceFk`,`racerNumber`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=7 ;

--
-- Dumping data for table `Racer`
--

INSERT INTO `Racer` (`racerId`, `racerNumber`, `name`, `city`, `country`, `email`, `raceFk`, `status`, `image`) VALUES
(1, 1, 'Racer 1', 'City', 'Country', 'Mail', 4, 'active', 'racer/1-0.jpg'),
(2, 0, 'name6', 'city', 'country', 'mail', 4, 'active', 'racer/2-7.jpg'),
(3, 2, 'asdfasdf', '', '', '', 4, 'registered', 'racer/3-0.jpg'),
(4, 3, 'image insert', '', '', '', 4, 'registered', 'racer/4-3.jpg'),
(5, 4, 'Fanti', '', '', '', 4, 'registered', 'racer/5-0.jpg'),
(6, 5, 'new one', '', '', '', 4, 'registered', NULL);

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
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=33 ;

--
-- Dumping data for table `RacerDelivery`
--

INSERT INTO `RacerDelivery` (`racerDeliveryId`, `racerTaskFk`, `deliveryFk`, `pickupTime`, `dropoffTime`) VALUES
(1, 1, 37, '2014-08-01 23:45:46', '2014-08-01 23:46:06'),
(2, 1, 38, '2014-08-01 23:46:27', '2014-08-01 23:46:44'),
(3, 2, 30, NULL, NULL),
(4, 3, 30, NULL, NULL),
(5, 4, 30, NULL, NULL),
(6, 5, 29, NULL, NULL),
(7, 5, 36, NULL, NULL),
(9, 6, 31, '2014-08-09 23:53:46', NULL),
(10, 7, 30, '2014-08-09 23:53:02', NULL),
(11, 8, 30, '2014-08-09 23:53:29', NULL),
(12, 9, 30, '2014-08-09 23:53:28', '2014-08-09 23:53:41'),
(13, 10, 29, NULL, NULL),
(14, 10, 36, NULL, NULL),
(16, 11, 29, '2014-08-09 23:55:41', NULL),
(17, 11, 36, NULL, NULL),
(19, 12, 29, '2014-08-09 23:55:40', NULL),
(20, 12, 36, NULL, NULL),
(22, 13, 29, '2014-08-09 23:55:39', NULL),
(23, 13, 36, NULL, NULL),
(25, 14, 37, '2014-08-09 23:55:37', NULL),
(26, 14, 38, NULL, NULL),
(28, 15, 29, '2014-08-09 23:55:36', NULL),
(29, 15, 36, NULL, NULL),
(31, 16, 30, NULL, NULL),
(32, 17, 30, NULL, NULL);

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
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=18 ;

--
-- Dumping data for table `RacerTask`
--

INSERT INTO `RacerTask` (`racerTaskId`, `racerFk`, `taskFk`, `price`, `startTime`, `endTime`) VALUES
(1, 2, 17, 68, '2014-08-01 22:50:33', '2014-08-01 23:46:44'),
(2, 2, 9, 71, '2014-08-09 19:18:54', NULL),
(3, 2, 9, 48, '2014-08-09 19:18:58', NULL),
(4, 1, 9, 33, '2014-08-09 19:19:00', NULL),
(5, 1, 7, 78, '2014-08-09 19:19:04', NULL),
(6, 2, 10, 81, '2014-08-09 19:19:08', NULL),
(7, 5, 9, 23, '2014-08-09 21:43:23', NULL),
(8, 2, 9, 16, '2014-08-09 23:10:11', NULL),
(9, 2, 9, 11, '2014-08-09 23:10:14', '2014-08-09 23:53:41'),
(10, 1, 7, 58, '2014-08-09 23:12:26', NULL),
(11, 5, 7, 40, '2014-08-09 23:13:37', NULL),
(12, 5, 7, 27, '2014-08-09 23:15:02', NULL),
(13, 5, 7, 19, '2014-08-09 23:20:55', NULL),
(14, 5, 17, 62, '2014-08-09 23:21:07', NULL),
(15, 5, 7, 13, '2014-08-09 23:55:21', NULL),
(16, 5, 9, 8, '2014-08-09 23:55:27', NULL),
(17, 2, 9, 6, '2014-08-09 23:57:14', NULL);

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
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `Session`
--

INSERT INTO `Session` (`sessionId`, `userFk`, `loginTime`, `lastActive`) VALUES
('0jy8ovIcDhpR0bjTnbmrMwLnorMzFk2Bj9h3W5jnXV', 7, '2014-06-19 01:03:56', '2014-06-19 01:03:56'),
('0pGAsSsVG9I5irJvGCO3ECkaVX2MWqSAkhYr0U29I9', 7, '2014-06-17 21:10:49', '2014-06-17 21:10:49'),
('0VwaKGO1iWAZ1U98k7cVAuq6NoaOoYwlGrnMvdamYI', 0, '2014-06-08 12:05:14', '2014-06-08 12:05:14'),
('15y3477st6rFv7riFEvORZxJvMk3dlGLQi7Y9nEFBy', 7, '2014-06-16 18:22:38', '2014-06-16 18:22:38'),
('1Gs4UHpNMMGTCyPVT8qiVBSFWvKBvb6RnqIe08zhxD', 11, '2014-07-22 17:28:14', '2014-07-22 17:28:14'),
('3bdhOEVLZ7I1GaiMffWY49OZaQXahw18wFDRbKLyF2', 11, '2014-08-01 17:01:05', '2014-08-01 17:01:05'),
('3eR1GDv2IczJfRADMDT7hk6FiCWPrApRfGx3Y3CnOt', 7, '2014-07-22 17:14:33', '2014-07-22 17:14:33'),
('3WfRO3qqHW2N0C8HNnvo9f1kVyYbNdu2UEQGEEXCHk', 7, '2014-06-18 23:35:39', '2014-06-18 23:35:39'),
('4kHSfE6d2Ea1o5ohOPY2bGk5QIiPJ5oVqqIwNiwKtc', 11, '2014-07-30 18:19:18', '2014-07-30 18:19:18'),
('4oWNibUYCokLVUt2uqBAokpAxwD2p11Las7B6duMOw', 7, '2014-07-22 17:14:03', '2014-07-22 17:14:03'),
('68rdV7bzb1aM7iyYTTfrPlD9UJSEdDKHpDFQw6uHXb', 11, '2014-08-01 21:23:46', '2014-08-01 21:23:46'),
('6WS7ssq04O4XOFQLtVGhGQ4KBq917U3xe73cOwVOVr', 7, '2014-08-05 19:15:18', '2014-08-05 19:15:18'),
('824gmNHYT2VXv4rB1w259X6pDy244ItyA1uaUuswpa', 7, '2014-08-01 21:26:42', '2014-08-01 21:26:42'),
('8Nqys8MS8z3C2bb2bOFzlHNo9r9gnfkAWV89PiBczz', 0, '2014-06-01 16:19:57', '2014-06-01 16:19:57'),
('8zo0O3vCsaEk8qsayDfLbGXc7ZLsa9bLVgifhnFZHc', 7, '2014-06-08 13:31:53', '2014-06-08 13:31:53'),
('945ciwqkVppjhhcGw0murEXh3f8CoNyGxfL6rhhJws', 0, '2014-06-01 18:12:53', '2014-06-01 18:12:53'),
('aFThxv0Sp33bpMltN6LGKENYvmAXPotIw2FsmHDU8M', 7, '2014-08-09 23:57:59', '2014-08-09 23:57:59'),
('Bd7GVoptUpTbpHs9t97WDEnc1xRglAnZkZEkYfgMKQ', 7, '2014-06-11 19:24:35', '2014-06-11 19:24:35'),
('bOckWwwSy0wYxAIO5zxayF8IFDNfG5To0qcGHpZZDA', 11, '2014-08-01 19:02:11', '2014-08-01 19:02:11'),
('BZXTmkbCuhJBmaHdx3aXykmDePeZK3FplbWIRjsTT9', 7, '2014-06-18 20:32:33', '2014-06-18 20:32:33'),
('cd9vgqoyuuDCbcYMrgWzHMNIVc3mT88NPhRomPyzm0', 7, '2014-06-01 18:16:40', '2014-06-01 18:16:40'),
('ceGdf4cpF9ZeyJ5M5VKV0FaffN42VEkf84eKakuC7H', 11, '2014-08-09 18:48:38', '2014-08-09 18:48:38'),
('ckLMaP0umu4xGR7ksLGwkNp3hfC7BkjzHZcMzUSCYe', 11, '2014-07-22 18:56:34', '2014-07-22 18:56:34'),
('CmBeTQKVPCm69o0lzKivRCZidwN1TlPQKdJyCUdT24', 11, '2014-08-01 18:01:43', '2014-08-01 18:01:43'),
('EE8G7CpOLvwCILXVPxYCV2MSWysoa9zBSaxocC2hE8', 11, '2014-08-01 20:10:36', '2014-08-01 20:10:36'),
('EFxTys7Z8r0ZKZQ8U1mYhVJpE3F5eA6oZp0hpT19ue', 7, '2014-06-01 19:49:48', '2014-06-01 19:49:48'),
('eHotAkSVLstdXHe2msV3cPV8yayiHGhxIZQRzen0zZ', 11, '2014-07-28 19:36:23', '2014-07-28 19:36:23'),
('eqUfXe7vv9hsabJknvNmYZYQk7KlWPpfWrfXzHTYzf', 7, '2014-08-05 18:31:51', '2014-08-05 18:31:51'),
('FXQcSSIRrfpdrRFlgfru1cR9nLr8y81vsyZb100jHx', 11, '2014-08-01 22:49:00', '2014-08-01 22:49:00'),
('gBAW38xjKdnsvHgfeQjM5BMt2dRGbjIc8OSXP0lcSG', 7, '2014-06-14 19:20:30', '2014-06-14 19:20:30'),
('GhJ792EHja7Y9Vfi4YJrQjByv41ZLrdBaTIJJFcNC6', 7, '2014-06-17 22:47:05', '2014-06-17 22:47:05'),
('gozFrgyJmaIq67Vz7bJMCxQf0sIDYuTSvkat5Adb3M', 11, '2014-08-09 20:39:19', '2014-08-09 20:39:19'),
('hPXCBJuxSaIVbi7NY9dgCNPiXGUxxCC81nkAQKgm0n', 11, '2014-07-28 18:32:05', '2014-07-28 18:32:05'),
('I7HfVPzQZgHfToh5izr1yczwT66m1c1I7sqJfInkJC', 7, '2014-06-17 21:13:32', '2014-06-17 21:13:32'),
('ieX66MS4A1fcnN11q9sgmud5rzzjgVTlNUXoSYpWSK', 0, '2014-06-01 16:58:22', '2014-06-01 16:58:22'),
('ixjzGOutfCMBorufFPG1jjgVtGy6NSCkyGU2C56gwQ', 0, '2014-06-01 20:00:06', '2014-06-01 20:00:06'),
('jJ4ZAHjHh14wL5oUkbGy5wDaxnMtCltzVvegRhcI37', 11, '2014-07-23 20:09:07', '2014-07-23 20:09:07'),
('jubr7lb3rxdMLFYhdBwfZUpLbNUS0csbMZTRl2jnJJ', 0, '2014-06-01 17:27:24', '2014-06-01 17:27:24'),
('l298wlfUehLMUX75nrBPfEXA16n7i9D8JOjiaWmtNT', 11, '2014-08-01 15:22:54', '2014-08-01 15:22:54'),
('l31OQInVNWI6QbuWsBoZglC7LX9WhsGgm0VpXtsbqg', 7, '2014-08-07 18:43:50', '2014-08-07 18:43:50'),
('mMITXZEi3MN2Oc5hfmK0WAlaSM6ldvcEmNt6Vtmw4W', 7, '2014-06-08 16:36:31', '2014-06-08 16:36:31'),
('mwR3DU44xzlyqXsdqZfmW7eHusZF3V0nqNLp8vTBa5', 11, '2014-07-28 17:24:23', '2014-07-28 17:24:23'),
('MYDuuUKWoCNM4odKkD9ytZWMGWMY5IipE459NjCQWE', 7, '2014-06-01 20:00:15', '2014-06-01 20:00:15'),
('NQDmycF48E9xg0tLIx9VIJ3GMGvYCEweRsUFYSC6Qg', 7, '2014-08-07 18:11:01', '2014-08-07 18:11:01'),
('OfUsEe9sWBhNK1DMOX5a56sCHeRVrhk5QIOyRLRLyW', 7, '2014-06-14 18:18:53', '2014-06-14 18:18:53'),
('os9GF0RecGOm1Zpf6EcyIKDPFX90Z4U7TTA8NfG4R8', 7, '2014-07-29 17:04:14', '2014-07-29 17:04:14'),
('PBU6hDnwitBSbsG8932r7ExZWyN6B0Jes0vQPz2Phh', 7, '2014-06-14 19:20:59', '2014-06-14 19:20:59'),
('pDSn96pcTvhIA2WH0MNN7f2ryKd4BZAsOngTYhU4Sr', 7, '2014-06-18 22:17:29', '2014-06-18 22:17:29'),
('pJFOZKvhCY3WpV1C3eiuVBrW6PvJA2wMSnsGGzOG66', 7, '2014-06-01 20:02:37', '2014-06-01 20:02:37'),
('PNmuqGSfrm9EwpZbSRaFTy7zNwbThUP4vXqckQcwS1', 7, '2014-08-07 16:44:26', '2014-08-07 16:44:26'),
('PobUcrZIIGyt0wMk6A0nJPZFLKhcRpU3nuo0bPYYDE', 7, '2014-08-05 18:09:28', '2014-08-05 18:09:28'),
('PtvqLsrBGPBZYBaw0X33EdlupPR0r26Pa0vUuYHDmM', 7, '2014-06-01 17:29:11', '2014-06-01 17:29:11'),
('pTy5FkjMkUbZX9HQdFP1jabF685ZzZ6InCv2BN0kcz', 7, '2014-06-10 18:08:18', '2014-06-10 18:08:18'),
('qA4M9n4dcc3YpGixm9MWWTTTTE8YSzc6SLx9zl0Brd', 7, '2014-06-01 17:03:28', '2014-06-01 17:03:28'),
('Qb3HalsMvSfYl4d6Mubl0tyYzxjXyGy3QttvAjaN0C', 11, '2014-07-30 20:34:22', '2014-07-30 20:34:22'),
('QFNlhH9vsL0vA8wJRrDKWeJWKJJnxFoEwtI0cX0B40', 7, '2014-06-19 00:03:07', '2014-06-19 00:03:07'),
('RWwcGe4ymqOv8DyRb7kpqdrs3rDy5CU2rAEUNN6fkd', 0, '2014-06-08 12:10:38', '2014-06-08 12:10:38'),
('sixBqaxzLwKUbC2PFORrFrvc0uL80b5d1QPTau4kDI', 7, '2014-06-17 21:15:37', '2014-06-17 21:15:37'),
('sz0WMmrjWaITkalU8N4mIBmP0mjupbExwJcrKa0Eyr', 7, '2014-06-16 18:41:05', '2014-06-16 18:41:05'),
('T4XxhD7zZA7hkapvvtm84KoMEEhrUD32XrQ3gswhpv', 7, '2014-06-08 15:04:07', '2014-06-08 15:04:07'),
('T8BENUc3V6GuXS67rjOGFmyR9DiGxRGj9B5oKPSFn0', 7, '2014-08-05 19:38:45', '2014-08-05 19:38:45'),
('tNnN62gmn1R5Jf9lBGNcQzKmjgWS9J7Lyl7a5SzaRB', 0, '2014-07-22 17:23:52', '2014-07-22 17:23:52'),
('UhCREk7VPP7u1ofYqiSeXwaxjFzVZvVREPtV8qvvJy', 0, '2014-06-01 20:01:26', '2014-06-01 20:01:26'),
('uIfmYYrfDVdGO74dcPrGaTpjmddMdsCmkpAjZQ20H5', 7, '2014-08-07 15:54:30', '2014-08-07 15:54:30'),
('uKfwzGcQSgU85gpIrwovs8pLH73shf573AGsbT5Dso', 0, '2014-06-08 11:57:23', '2014-06-08 11:57:23'),
('VtU2M6n2QmOyJWripcRaYxAz3ruINtvHTxsAEzqGF9', 7, '2014-08-06 20:25:00', '2014-08-06 20:25:00'),
('we5a3TWOfucdQi9vZ8n2u0a0dttRxNeNufaAFsK4TV', 7, '2014-08-07 17:04:39', '2014-08-07 17:04:39'),
('WlhN53frC6JVRRkh7n8SajJIwj7NSD6EUnAJ2abGF7', 7, '2014-06-08 17:38:29', '2014-06-08 17:38:29'),
('XCbEjVU3utV45ozcSIPvYQxKQUuTYDSsRM0ZyNDZ9I', 0, '2014-06-08 12:18:07', '2014-06-08 12:18:07'),
('xsAbS1t8HGXXdQvnEKBkyTj2vwgNMi4ZXsLIDVKPV5', 7, '2014-06-18 23:19:54', '2014-06-18 23:19:54'),
('xvkSBjcZSThPHMp5mVDZtTLlg3YKI88rrSMdIbBzRF', 7, '2014-07-30 22:50:14', '2014-07-30 22:50:14'),
('yOx28UkxS5Z4xdNc58baieh0rSqJCxA25GqUKqCsZB', 11, '2014-07-29 19:04:27', '2014-07-29 19:04:27'),
('Z1JfGa3xmIrLaZP7Jjz50RSEPJI0GQ6XTQYOsfxLHh', 7, '2014-06-01 20:18:50', '2014-06-01 20:18:50'),
('ZicNej3OCXzHKJQn79tGHmHN2E6bEKkTeRYCQj9b4n', 7, '2014-06-11 18:24:15', '2014-06-11 18:24:15'),
('zJgKUjbPjM9KVJEx3idmhg2hqNZDTiR32jrpoH5mi3', 7, '2014-06-18 21:34:16', '2014-06-18 21:34:16'),
('zjx1U9QfKkN3YYlnWIdSEUgRwUnwLZOM4bc0OpfIIC', 7, '2014-06-16 18:25:20', '2014-06-16 18:25:20'),
('ZPFAIQK5cOSXdILUiOhkbKbJM15l7qIgLsnQB9rZbl', 0, '2014-06-16 18:54:09', '2014-06-16 18:54:09'),
('ZTktsOkqnHiw7krU3D0zPsj2V32g7TegZ0DwHjeH03', 8, '2014-06-01 18:13:59', '2014-06-01 18:13:59');

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
(9, 4, 5.6078936982119, 8),
(7, 4, 13.427492701554, 6),
(10, 4, 94.846560434206, 1),
(11, 4, 137.09433839445, 0),
(12, 4, 137.09433839445, 0),
(13, 4, 137.09433839445, 0),
(14, 4, 137.09433839445, 0),
(15, 4, 137.09433839445, 0),
(16, 4, 137.09433839445, 0),
(17, 4, 63.552022799232, 2);

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
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=19 ;

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
(16, 'M9', 0, 100, '', 4),
(17, 'Ma 123', 3600, 100, '', 4),
(18, 'm ssss', 12, 14, 'des', 4);

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
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=21 ;

--
-- Dumping data for table `User`
--

INSERT INTO `User` (`userId`, `user`, `password`, `role`, `raceFk`, `checkpointFk`) VALUES
(0, 'admin', '8c6976e5b5410415bde908bd4dee15dfb167a9c873fc4bb8a81f6f2ab448a918', 'admin', -1, NULL),
(7, 'master', 'fc613b4dfd6736a7bd268c8a0e74ed0d1c04a959f59dd74ef2874983fd443fc9', 'race master', 4, 0),
(8, 'registration', '29c9c30e0604515ced98b3d14fd88751a8f8e4b9bc69d483a67a257c14ab79fb', 'registration', 4, NULL),
(10, 'master2', 'ee33bacb9843d3b4bac37e425b203d8aad4e08c6773d21a10533d66cd6bb7c02', 'race master', 5, NULL),
(11, 'dispatcher', 'ff7fce673d2f52b071129e34ff8ea570b7159527d019c81ec7756f4f8c821535', 'dispatcher', 4, 1),
(12, 'c1', '36a9e7f1c95b82ffb99743e0c5c4ce95d83c9a430aac59f84ef3cbfab6145068', 'checkpoint', 4, 1),
(13, 'c2', '36a9e7f1c95b82ffb99743e0c5c4ce95d83c9a430aac59f84ef3cbfab6145068', 'checkpoint', 4, 2),
(14, 'c3', '36a9e7f1c95b82ffb99743e0c5c4ce95d83c9a430aac59f84ef3cbfab6145068', 'checkpoint', 4, 3),
(15, 'c4', '36a9e7f1c95b82ffb99743e0c5c4ce95d83c9a430aac59f84ef3cbfab6145068', 'checkpoint', 4, 4),
(16, 'c5', 'e3b0c44298fc1c149afbf4c8996fb92427ae41e4649b934ca495991b7852b855', 'checkpoint', 4, 5),
(17, 'c6', '36a9e7f1c95b82ffb99743e0c5c4ce95d83c9a430aac59f84ef3cbfab6145068', 'checkpoint', 4, 6),
(18, 'c7', '36a9e7f1c95b82ffb99743e0c5c4ce95d83c9a430aac59f84ef3cbfab6145068', 'checkpoint', 4, 7),
(19, 'c8', '36a9e7f1c95b82ffb99743e0c5c4ce95d83c9a430aac59f84ef3cbfab6145068', 'checkpoint', 4, 8),
(20, 'c9', '36a9e7f1c95b82ffb99743e0c5c4ce95d83c9a430aac59f84ef3cbfab6145068', 'checkpoint', 4, 9);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
