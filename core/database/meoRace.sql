-- phpMyAdmin SQL Dump
-- version 4.2.3
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Aug 30, 2014 at 09:28 AM
-- Server version: 5.5.28
-- PHP Version: 5.3.28

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `usr_web224_6`
--

-- --------------------------------------------------------

--
-- Table structure for table `Checkpoint`
--

CREATE TABLE IF NOT EXISTS `Checkpoint` (
`checkpointId` int(11) NOT NULL,
  `name` varchar(80) NOT NULL,
  `manned` tinyint(1) NOT NULL,
  `raceFk` int(11) NOT NULL
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=6 ;

--
-- Dumping data for table `Checkpoint`
--

INSERT INTO `Checkpoint` (`checkpointId`, `name`, `manned`, `raceFk`) VALUES
(1, 'Aamon', 1, 1),
(2, 'Rotschi', 1, 1),
(3, 'Jeremy', 1, 1),
(4, 'Voxo', 1, 1),
(5, 'Moik', 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `Delivery`
--

CREATE TABLE IF NOT EXISTS `Delivery` (
`deliveryId` int(11) NOT NULL,
  `taskFk` int(11) NOT NULL,
  `parcelFk` int(11) DEFAULT NULL,
  `pickupFk` int(11) NOT NULL,
  `dropoffFk` int(11) NOT NULL
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=51 ;

--
-- Dumping data for table `Delivery`
--

INSERT INTO `Delivery` (`deliveryId`, `taskFk`, `parcelFk`, `pickupFk`, `dropoffFk`) VALUES
(1, 1, 1, 1, 5),
(2, 1, 1, 1, 4),
(3, 1, 1, 1, 3),
(4, 1, 1, 1, 2),
(5, 2, 2, 3, 2),
(6, 2, 2, 3, 1),
(7, 2, 2, 3, 5),
(8, 2, 2, 3, 4),
(9, 3, 3, 5, 4),
(10, 3, 3, 5, 3),
(11, 3, 3, 5, 2),
(12, 3, 3, 5, 1),
(13, 4, 4, 2, 1),
(14, 4, 4, 2, 5),
(15, 4, 4, 2, 4),
(16, 4, 4, 2, 3),
(17, 5, 5, 4, 3),
(18, 5, 5, 4, 2),
(19, 5, 5, 4, 1),
(20, 5, 5, 4, 5),
(21, 6, 1, 2, 1),
(22, 6, 1, 3, 1),
(23, 6, 1, 4, 1),
(24, 6, 1, 5, 1),
(25, 7, 2, 4, 3),
(26, 7, 2, 5, 3),
(27, 7, 2, 1, 3),
(28, 7, 2, 2, 3),
(29, 8, 3, 1, 5),
(30, 8, 3, 2, 5),
(31, 8, 3, 3, 5),
(32, 8, 3, 4, 5),
(33, 9, 4, 3, 2),
(34, 9, 4, 4, 2),
(35, 9, 4, 5, 2),
(36, 9, 4, 1, 2),
(37, 10, 5, 5, 4),
(38, 10, 5, 1, 4),
(39, 10, 5, 2, 4),
(40, 10, 5, 3, 4),
(41, 11, 6, 1, 1),
(42, 12, 8, 3, 3),
(43, 13, 9, 5, 5),
(44, 14, 10, 2, 2),
(45, 15, 11, 4, 4),
(46, 16, 12, 3, 3),
(47, 17, 13, 5, 5),
(48, 18, 9, 2, 2),
(49, 19, 15, 4, 4),
(50, 20, 7, 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `DeliveryCondition`
--

CREATE TABLE IF NOT EXISTS `DeliveryCondition` (
`deliveryConditionId` int(11) NOT NULL,
  `deliveryFk` int(11) NOT NULL,
  `previousDeliveryFk` int(11) NOT NULL
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=31 ;

--
-- Dumping data for table `DeliveryCondition`
--

INSERT INTO `DeliveryCondition` (`deliveryConditionId`, `deliveryFk`, `previousDeliveryFk`) VALUES
(1, 2, 1),
(2, 3, 2),
(3, 4, 3),
(4, 6, 5),
(5, 7, 6),
(6, 8, 7),
(7, 10, 9),
(8, 11, 10),
(9, 12, 11),
(10, 14, 13),
(11, 15, 14),
(12, 16, 15),
(13, 18, 17),
(14, 19, 18),
(15, 20, 19),
(16, 22, 21),
(17, 23, 22),
(18, 24, 23),
(19, 26, 25),
(20, 27, 26),
(21, 28, 27),
(22, 30, 29),
(23, 31, 30),
(24, 32, 31),
(25, 34, 33),
(26, 35, 34),
(27, 36, 35),
(28, 38, 37),
(29, 39, 38),
(30, 40, 39);

-- --------------------------------------------------------

--
-- Table structure for table `Parcel`
--

CREATE TABLE IF NOT EXISTS `Parcel` (
`parcelId` int(11) NOT NULL,
  `name` varchar(80) NOT NULL,
  `description` varchar(256) NOT NULL,
  `raceFk` int(11) NOT NULL,
  `image` varchar(80) DEFAULT NULL
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=16 ;

--
-- Dumping data for table `Parcel`
--

INSERT INTO `Parcel` (`parcelId`, `name`, `description`, `raceFk`, `image`) VALUES
(1, 'A', '', 1, NULL),
(2, 'J', '', 1, NULL),
(3, 'M', '', 1, NULL),
(4, 'R', '', 1, NULL),
(5, 'V', '', 1, NULL),
(6, 'Egg', '', 1, NULL),
(7, '?', '', 1, NULL),
(8, 'Lock J', '', 1, NULL),
(9, 'Foot M', '', 1, NULL),
(10, 'Lock R', '', 1, NULL),
(11, 'Flat', '', 1, NULL),
(12, 'Cargo', '', 1, NULL),
(13, 'Beer', '', 1, NULL),
(14, 'Foot', '', 1, NULL),
(15, 'Dress', '', 1, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `Race`
--

CREATE TABLE IF NOT EXISTS `Race` (
`raceId` int(11) NOT NULL,
  `name` varchar(256) NOT NULL,
  `status` enum('prepare','running','finished') NOT NULL
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `Race`
--

INSERT INTO `Race` (`raceId`, `name`, `status`) VALUES
(1, 'BMC 14', 'prepare');

-- --------------------------------------------------------

--
-- Table structure for table `Racer`
--

CREATE TABLE IF NOT EXISTS `Racer` (
`racerId` int(11) NOT NULL,
  `racerNumber` int(11) NOT NULL,
  `name` varchar(256) NOT NULL,
  `city` varchar(80) NOT NULL,
  `country` varchar(80) NOT NULL,
  `email` varchar(80) NOT NULL,
  `raceFk` int(11) NOT NULL,
  `status` enum('registered','active') NOT NULL,
  `image` varchar(80) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `RacerDelivery`
--

CREATE TABLE IF NOT EXISTS `RacerDelivery` (
`racerDeliveryId` int(11) NOT NULL,
  `racerTaskFk` int(11) NOT NULL,
  `deliveryFk` int(11) NOT NULL,
  `pickupTime` datetime DEFAULT NULL,
  `dropoffTime` datetime DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `RacerTask`
--

CREATE TABLE IF NOT EXISTS `RacerTask` (
`racerTaskId` int(11) NOT NULL,
  `racerFk` int(11) NOT NULL,
  `taskFk` int(11) NOT NULL,
  `price` int(11) NOT NULL,
  `startTime` datetime DEFAULT NULL,
  `endTime` datetime DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `Session`
--

CREATE TABLE IF NOT EXISTS `Session` (
  `sessionId` varchar(42) NOT NULL,
  `userFk` int(11) NOT NULL,
  `loginTime` datetime NOT NULL,
  `lastActive` datetime NOT NULL
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
('824gmNHYT2VXv4rB1w259X6pDy244ItyA1uaUuswpa', 7, '2014-08-01 21:26:42', '2014-08-01 21:26:42'),
('FXQcSSIRrfpdrRFlgfru1cR9nLr8y81vsyZb100jHx', 11, '2014-08-01 22:49:00', '2014-08-01 22:49:00'),
('UOrZO63XYraJZ3EwUzJpJ5TF0qjCQAdMWmd3wRupqM', 14, '2014-08-01 23:46:30', '2014-08-01 23:46:30'),
('ZGFhVqfm8cLTmghzw1vuH5iFigU3JiS5TGjzEf1Qg9', 13, '2014-08-01 23:55:23', '2014-08-01 23:55:23'),
('0wKMw0meGEW1ya0jQpgATkSm8ZkHsuY3xXOStVpXhi', 13, '2014-08-02 01:17:55', '2014-08-02 01:17:55'),
('PDwfHNkoHIuTi933VvsXMblZ6AlLKO8EW7k9P3Rzqg', 12, '2014-08-02 10:26:19', '2014-08-02 10:26:19'),
('WQrhufrisriZt7OBaV7r9TnaAR8kuMozhmY0KlO7N7', 7, '2014-08-02 14:06:01', '2014-08-02 14:06:01'),
('yoZWW98qxmESCHSf0i6JMePP69SVkAHpg7Gv4TEMcL', 11, '2014-08-02 14:08:24', '2014-08-02 14:08:24'),
('XAfhQ1zx9pc8khamPg6fPbYgXvAH3C3SgrTrV4CP2Z', 11, '2014-08-02 14:26:34', '2014-08-02 14:26:34'),
('ltEPoIexEs1jADxU2fh12E2E4i1WgSXHCZExy8iJbf', 11, '2014-08-02 16:11:26', '2014-08-02 16:11:26'),
('Q6Uf5cvUgUEeMPEr3YKNN0dDwSNEApIhIepUnr6h5l', 12, '2014-08-02 21:42:58', '2014-08-02 21:42:58'),
('dKkfkny0vWi0ntrnhJc2XG8IIgp01wL0FXBCTBhY7j', 12, '2014-08-02 22:56:25', '2014-08-02 22:56:25'),
('DVmBsK0b5lIK6I89r2vAp7RZm04RpYiPwDW3Nh5mdK', 12, '2014-08-02 23:56:29', '2014-08-02 23:56:29'),
('Gr7ZMYM2laH0WvY4XTs5Mk4kY9wwBNTMafXEII4XZq', 12, '2014-08-03 09:06:37', '2014-08-03 09:06:37'),
('UKLlshHtRxG7K1TAXp3z6s9mz97d9CMI44JEOIVvNJ', 12, '2014-08-03 15:18:00', '2014-08-03 15:18:00'),
('orhkxCZogOusZBibhQPbeY6LaFsGtyXrrOo1ZxNqMR', 12, '2014-08-03 16:17:47', '2014-08-03 16:17:47'),
('xrYZ3sq7FmA88WvsniYLcutMc4SMHu5j9PJ1FIBt2h', 13, '2014-08-03 17:24:42', '2014-08-03 17:24:42'),
('zwJ9gFu8SEhKuEBcvSmwbWvf8f1h8dQZh10ABODjfy', 7, '2014-08-03 22:35:12', '2014-08-03 22:35:12'),
('Q7WpHRQokzgeA1IWbVG6MFPyEJSsk0LJyvcgQtdbSC', 7, '2014-08-03 23:58:42', '2014-08-03 23:58:42'),
('AM51ocHt3qdgtPs1vzDSb0XKW9Bnb4ZxCDoDCsonYO', 7, '2014-08-04 07:19:43', '2014-08-04 07:19:43'),
('i8Lwx7BXW9v6Kh0DkXI34TYHCtGzCDIyZGwlcDHQZ3', 7, '2014-08-04 08:37:45', '2014-08-04 08:37:45'),
('9K7I0AxCAsxi9OfNk9h6dtAa3yG6Do7PHQBQGHS8xu', 7, '2014-08-04 07:55:53', '2014-08-04 07:55:53'),
('PeqLKYh6gwjtb3dFZjHeclS4QD6G2YhUwMXavyFaqB', 13, '2014-08-04 23:00:14', '2014-08-04 23:00:14'),
('YaqiKahiZw2LK21Y57BTAA1XaSjHe4kmwEawNmSye6', 11, '2014-08-04 21:28:13', '2014-08-04 21:28:13'),
('eVYwK4XV49uIM53ONUHswGlJISiu0ZrinQVxQrrOYv', 7, '2014-08-04 23:52:16', '2014-08-04 23:52:16'),
('Zm68PMq9EiiX2jymMBe4m5bhPLMO5BUgEqmIzCaWRw', 13, '2014-08-05 21:49:09', '2014-08-05 21:49:09'),
('VxhYpjb95RAuN5Lmvvn8Opo0xIHXU77EJNkTVALXmU', 13, '2014-08-05 22:48:53', '2014-08-05 22:48:53'),
('vFqzJ6SsPZkyheTpag3aWBxq0PbN4vNpt0D3VP8laI', 13, '2014-08-06 08:13:33', '2014-08-06 08:13:33'),
('bNhvFniG8WM3C607tdHYcVGJ2eUvV92yTD4W68Xrb8', 12, '2014-08-06 10:33:45', '2014-08-06 10:33:45'),
('NiGEdq9IDaMFyWKIVhMXaEr2M7BXj0sQBkaCyqCgWs', 12, '2014-08-06 18:49:09', '2014-08-06 18:49:09'),
('MvRReBm8oLxP5Z8VYcGOLkrmMD2q1l3w2MyKk3gsUa', 7, '2014-08-06 21:34:00', '2014-08-06 21:34:00'),
('ZqbF9Zyk0FYoMM1i3fr6Fz41iTPX8O9ThtmBhLn5pR', 12, '2014-08-06 21:50:14', '2014-08-06 21:50:14'),
('Mxt3c2BmAkY1mQGswFq3Nfc0MmekrafKJ7zPZ8yXtt', 13, '2014-08-06 22:41:55', '2014-08-06 22:41:55'),
('gswzQGjrbKg5mN901resUP15vIWTAeJnn3Qlc7SQ5G', 12, '2014-08-07 12:10:06', '2014-08-07 12:10:06'),
('yzML9UgnmRPOddT3Rw7JnZlKHLJGuKXOdX2UFQjuyW', 7, '2014-08-07 18:01:02', '2014-08-07 18:01:02'),
('2orUj4qTxJsK3pnSiidMJloVz39j7wvHe66Xcp2Ldr', 7, '2014-08-07 18:01:10', '2014-08-07 18:01:10'),
('kSYKXXAJqatFUvy9zBRkBzTlud33uywjkvIqGHzLDB', 7, '2014-08-07 18:17:55', '2014-08-07 18:17:55'),
('3EicHvwsu7QZ1rFBH5vCkbmfGPDZAynoPoMUguHI2b', 7, '2014-08-07 20:10:57', '2014-08-07 20:10:57'),
('BrbMbGMs9VkaTv0eyViPdnm8TeZrnm5JCko6WtaEqa', 7, '2014-08-07 19:15:22', '2014-08-07 19:15:22'),
('HNDPnYFCCpOmxvmmSufikrv0Ll7X0SklGwRnt5dsFk', 7, '2014-08-07 20:00:08', '2014-08-07 20:00:08'),
('X80Wj84ItpZBLjYtchMjqWsoFbLXroQZDEAnuY9Hb8', 7, '2014-08-07 20:48:17', '2014-08-07 20:48:17'),
('BRHxirkhfkYRO1Yi6a97DGlMsygeHHytwhDRw7pBA5', 7, '2014-08-07 22:03:07', '2014-08-07 22:03:07'),
('AI998z95Fgl9ns28atWKIsJPeXIaLkEBfhdhw6xvQe', 7, '2014-08-07 22:06:39', '2014-08-07 22:06:39'),
('sorkyjhvh9iaXKVoADa348trX9OBKqjhOV2VVchFly', 7, '2014-08-08 12:57:51', '2014-08-08 12:57:51'),
('h0i1Tzt10BlZgofiz8nJPAvs8YdgL6giVfPNpQPt2i', 7, '2014-08-08 12:59:56', '2014-08-08 12:59:56'),
('n3gx22BXKM44CIrcH8LmIo6BDWAlkMRWQbRYba18l8', 7, '2014-08-08 16:04:46', '2014-08-08 16:04:46'),
('6vyZlOFUZphvjoVJLRfYrGhUJlWiA0B63nbAQHO8ou', 13, '2014-08-08 18:43:17', '2014-08-08 18:43:17'),
('JWEjrZ0CL0PwJNdm6AriV4wDeUX899u4eTlhofUkFd', 7, '2014-08-08 21:10:08', '2014-08-08 21:10:08'),
('uTL3vLgAWreWCAcgpxiIcBSdqclfJGaG6hRiKvUIpI', 14, '2014-08-08 20:08:50', '2014-08-08 20:08:50'),
('zN051tS0kyiZCS50X9txKrq7WPBFqDDZGKpqtsrbKT', 7, '2014-08-08 21:19:44', '2014-08-08 21:19:44'),
('vJMp4QKHZNTd4R9Erd2XNsaV7WoVvoQ5PovvNXO7NW', 7, '2014-08-08 22:20:05', '2014-08-08 22:20:05'),
('h7bkkgJsiBRfE15U1etZSZuy2m6QkkmGv1MNh5i16y', 7, '2014-08-08 22:24:00', '2014-08-08 22:24:00'),
('mt4hEu37DTlXWAfiDZcvgfOEyAOhCQxnFQExeCBCnD', 14, '2014-08-09 01:49:52', '2014-08-09 01:49:52'),
('cWIFRYHhhbdMuTw1d1fHi7M1RQKJKfhaHpJkEq7Fpi', 11, '2014-08-09 05:12:51', '2014-08-09 05:12:51'),
('kVC5VlaYvQebGNnIXmUD6bk2xHR4dxYy1XrFToFj8C', 11, '2014-08-09 05:34:48', '2014-08-09 05:34:48'),
('PtBqglNcMtpBCzWgDR2BjgwbGf6be3GJ9Rk4a1Zw9z', 11, '2014-08-09 05:41:04', '2014-08-09 05:41:04'),
('GPB4tFM2AC6dyEeAUX2b0AblsvJ4stTdd6Bkzg9Z2E', 11, '2014-08-09 14:29:42', '2014-08-09 14:29:42'),
('GbpylnxF2rtSjbhQmeXuQsyLjR4nQA7hgkgRZuEOZY', 11, '2014-08-10 00:08:52', '2014-08-10 00:08:52'),
('qEYnZujfQkdQNqFZzCjeKXb8cwzSTLf1E2LdMQF2li', 11, '2014-08-09 22:58:42', '2014-08-09 22:58:42'),
('DywTL37Ok4bzsdnroEp3wdDlEYvLxRgwhKdWX5IH2Q', 11, '2014-08-09 21:50:00', '2014-08-09 21:50:00'),
('FFXH7ZhpiypAFutFWzT5vET00waMCfUlfOWoOeaQaN', 7, '2014-08-09 21:52:13', '2014-08-09 21:52:13'),
('L5sHch1jncyhfY3HoORRxqJOM1cy52kMHpVuKGaAb9', 13, '2014-08-10 00:33:38', '2014-08-10 00:33:38'),
('pHRELc8ZcVBdM20lQx10NdgI2NCJU8Lji8XfiVFNIf', 7, '2014-08-10 14:55:38', '2014-08-10 14:55:38'),
('sODYQnPrZmNlIC8fUksMnxWzVwKpKseRWu27v4mVpV', 14, '2014-08-10 17:40:02', '2014-08-10 17:40:02'),
('3k0asOZ1FJWrH55QzVOSfm3aOzfUiv7iGOz3WqCFdC', 11, '2014-08-11 08:37:05', '2014-08-11 08:37:05'),
('CxuHCqYgkZCbiSqtaCNwH5nDMxuk2z8OmIv8jDlGTA', 11, '2014-08-11 21:27:11', '2014-08-11 21:27:11'),
('KfZXlxVqiszBy2K6q6je0YGQPw5kekj60bQx84ggOA', 11, '2014-08-11 21:52:41', '2014-08-11 21:52:41'),
('D9GxMth1AahN2rD9jMp57TUHcN69QgwzO1Gdu9OLo3', 14, '2014-08-12 01:13:54', '2014-08-12 01:13:54'),
('B12DkDZjnIuE7iRshVbtGfsTfBaMqkxiIoCeagiqcc', 7, '2014-08-12 08:10:31', '2014-08-12 08:10:31'),
('NnukNQVVLKVYF15lsch6qehlm6xmRc2vgaug0IRU1n', 14, '2014-08-13 10:25:28', '2014-08-13 10:25:28'),
('7LBKMpKmtdUSZWVewDAfwGn6ABdgLrsbxvS1tzojGd', 16, '2014-08-13 22:58:46', '2014-08-13 22:58:46'),
('9J6cXhsIs8RoTCNPpHz3bNHXP4AwnnLPnIqcqI9pe5', 14, '2014-08-13 20:18:17', '2014-08-13 20:18:17'),
('nZy9Z5lW8156K3GIQCoM4TCpUb6SEvU655Dh6Lk8VQ', 13, '2014-08-13 20:27:29', '2014-08-13 20:27:29'),
('i6xnE5K7oZh3GB0Uz7Xw7Vf10F1OhmPXCn3QuCD0b1', 17, '2014-08-13 20:46:37', '2014-08-13 20:46:37'),
('5xsWcsrW7aZQqLQ5PgWghaffUQTsU2oJxzfAwhLM1E', 16, '2014-08-14 07:44:46', '2014-08-14 07:44:46'),
('ZljAhWSOhRksoLAPsaMVWVzb7QJxcsfew2bTuinnaU', 17, '2014-08-13 20:24:02', '2014-08-13 20:24:02'),
('Mq5lEVXWHJNFnnaNmiqcBTcne56ScifEWwgEQ8R6ML', 7, '2014-08-13 21:23:25', '2014-08-13 21:23:25'),
('5T3F9C16Bbhf5HBPqCu73yllcPlg6n7pzvirV8IfXR', 16, '2014-08-14 12:34:16', '2014-08-14 12:34:16'),
('Ku0c7mfWAGCP4teizVCCF63cYzXXQcW36TSJPgSEzU', 13, '2014-08-15 20:32:32', '2014-08-15 20:32:32'),
('mg3yahgKOxqcotjSoU70TS40ulmMuxBxLtic8ejYvS', 16, '2014-08-15 21:22:53', '2014-08-15 21:22:53'),
('V22h5QFdYOTE47jejxqWfn8U6o1oSOHmo9BcLrn7vj', 16, '2014-08-15 22:23:25', '2014-08-15 22:23:25'),
('N6pC5Ptey8Sn3Vbj7DIRKjXL5xV6KdccP9MRRtpZiF', 16, '2014-08-15 23:26:00', '2014-08-15 23:26:00'),
('SpFILPLgeGNL2a4z16yOsF5pRohqfDgHcbSfAGnJET', 16, '2014-08-16 21:58:03', '2014-08-16 21:58:03'),
('JG9dGPbTYRQNdYEQujRviNGBcXi0MCk1ycYkxFn9qb', 7, '2014-08-17 00:18:25', '2014-08-17 00:18:25'),
('J9BZr15x6Md8j5AyE6HfQ9m7pdhWoN9JeCViNRjS1H', 16, '2014-08-17 23:32:11', '2014-08-17 23:32:11'),
('qe2IR1cKbMFs00HxIVUdhb8KIaPbJyGOfY9NAtocqm', 7, '2014-08-18 20:27:27', '2014-08-18 20:27:27'),
('3XYfEQFHh8nVqcLe49O9AhGUDwwnYmoWLaTETBGVF3', 16, '2014-08-19 09:01:38', '2014-08-19 09:01:38'),
('E3i05ZWL8IkTRPnPTin4Dr8X58XXkOT1CYMSaIgYR7', 12, '2014-08-19 09:07:49', '2014-08-19 09:07:49'),
('WcFEcp1l0gOv0JR5WdDBZ8KGiVMaQli3RBPObqdGNW', 15, '2014-08-19 10:22:04', '2014-08-19 10:22:04'),
('6W2AVYpIbSIaLUB8SPkB3oCyxObJTsuZEVv9NTjdX9', 7, '2014-08-20 00:42:56', '2014-08-20 00:42:56'),
('c2pl3UBKAnsqY4OW22sRKuXxF7B0rbkgl7wVLLCJTQ', 11, '2014-08-22 00:18:58', '2014-08-22 00:18:58'),
('GHQPJTUOHLaSRHesQy9wfayijvW3fYRGQKpioKjnza', 11, '2014-08-22 01:07:05', '2014-08-22 01:07:05'),
('t6hfhl93o11PgJJGhrzQRIcFViWcEOSegqu0x0FKBV', 11, '2014-08-22 22:30:46', '2014-08-22 22:30:46'),
('VJwzTluQiwpL93lLlrnYbNr2D9qgmVhuSWbAOrC79D', 11, '2014-08-22 22:31:47', '2014-08-22 22:31:47'),
('ILeeZfmVsXPdmpHa4Sro7rB9LCa7Rz2VOEJkBsvYC5', 11, '2014-08-22 23:57:45', '2014-08-22 23:57:45'),
('Skbi18HfHtgDWUJVuzjMRCuJZXfRNO1Uzb4VTm8YtB', 11, '2014-08-23 22:21:46', '2014-08-23 22:21:46'),
('5JiXCRVZhskG9CoRps0JYmcjAjus0Oy3l8qM7Hhv5q', 27, '2014-08-24 00:42:05', '2014-08-24 00:42:05'),
('lL1zQEWBGXc525RCdOV6bAVtbj0pDlqdeQT5hsnwTO', 24, '2014-08-24 01:02:26', '2014-08-24 01:02:26'),
('qHMbiMg2hmaISY93ZZHfJXGMCq98djbjQgOovtif0A', 22, '2014-08-24 00:26:29', '2014-08-24 00:26:29'),
('OCi7QbDdIc9myYr3fZy7k7dxR5ButUFPiOgCv7Qt4v', 28, '2014-08-24 01:23:07', '2014-08-24 01:23:07'),
('J9wW9qRJCxC4wQvU6Mty4FnXfJPClbmVmZbldGOGl4', 26, '2014-08-24 00:57:09', '2014-08-24 00:57:09'),
('5Z91NHboZlVpMTc41WvXEGnkdJI5Kwxcu14iNefDp3', 28, '2014-08-24 02:04:30', '2014-08-24 02:04:30'),
('GTGJKMb8SPQzfvEnZ8QqnwIvxI0zhcRoogSemA18dY', 26, '2014-08-24 20:46:06', '2014-08-24 20:46:06'),
('D8emS5BhaOlJ7tcMYuLWrnAJ2egNuCvkWhVvz4klxX', 29, '2014-08-24 13:47:28', '2014-08-24 13:47:28'),
('I3z74FLaabckaRF6INJixDi9f7fiPbsACBDBd33z9k', 26, '2014-08-25 07:53:46', '2014-08-25 07:53:46'),
('TsNPxPyKAzBfG4Z6GZEnvveKVwXofM4ZiF0lICLh5T', 26, '2014-08-24 22:40:18', '2014-08-24 22:40:18'),
('lrFk0KM0HSMhaPLqHpwqb8H4ZsJjByqiwtcs9DhLW7', 22, '2014-08-25 22:09:53', '2014-08-25 22:09:53'),
('n137lzEdN7w6kPFJgjMIEUXXJjMzDGbOJr2GtSgzX0', 22, '2014-08-25 20:55:16', '2014-08-25 20:55:16'),
('G22BnCbcsIhyMPn5vKbsRIc6wr0UTcFxcJMk67qi1C', 16, '2014-08-25 21:13:08', '2014-08-25 21:13:08'),
('uOGTgb8Szp3kbH1h4mmo6lWrzbN6Q951v3ttEVvzXe', 22, '2014-08-25 22:21:02', '2014-08-25 22:21:02'),
('wiAMSBAlxv9wEkuFpO1l22WB6MiVaoP37eiMkEk5CA', 22, '2014-08-25 23:12:35', '2014-08-25 23:12:35'),
('Z9dYLzLVGoLTN7rNMJpa9ZGIMTrLfYGvehAdU72Rby', 28, '2014-08-26 01:35:01', '2014-08-26 01:35:01'),
('A6C9US6Dx9m0UQpmqXwY2rEAvYtvG5Y0DZiRfvwvux', 7, '2014-08-25 23:34:08', '2014-08-25 23:34:08'),
('zk88mRN2zTWBfF0lFCgD5loPtQnoOoQAeSrHls3vRB', 22, '2014-08-26 16:10:09', '2014-08-26 16:10:09'),
('wDuk1DpwN29zgbBN2xAEjVWBszyU4sLyEQtWFysqF2', 24, '2014-08-26 21:03:10', '2014-08-26 21:03:10'),
('v6K7ZtX2ufGCQ9554xnSSDQBIk0ctLNIZaPcEsEq2i', 22, '2014-08-27 20:15:16', '2014-08-27 20:15:16'),
('Gvtqj4t5a9nhxCf5Iq8jN20jsm9qAHDXnzexJij5hs', 26, '2014-08-26 22:33:35', '2014-08-26 22:33:35'),
('UnMoBG6yYWAqDhXgNTZZzpD6dRiAgyE36z961rDgnp', 24, '2014-08-27 20:17:25', '2014-08-27 20:17:25'),
('YY1fxTisc12y0hBWVT40rOe2LWuF4rhBJ4OvxXPEY8', 22, '2014-08-28 00:19:05', '2014-08-28 00:19:05'),
('6eKkCC8wgKGn7FKKpsmlWd2rw41rjyxJfvarJpZwvh', 28, '2014-08-27 23:10:19', '2014-08-27 23:10:19'),
('xgWqVbtcNDICPrep5hNxQMadNpezUIZrSsOFGJjhxy', 22, '2014-08-28 01:52:28', '2014-08-28 01:52:28'),
('oQbE4tVEadi72pLQW5gDvt2Zf4XQgXJqTfv8c55UXb', 28, '2014-08-28 10:29:01', '2014-08-28 10:29:01'),
('gRDF7Bypi05zpPtKJmUe3s3bq6hNIASkdHKJ23vrWD', 22, '2014-08-28 15:43:36', '2014-08-28 15:43:36'),
('QvcJ4k1rHQjkODqRmPqrBSgGalAmwmLA9yuvHNEXQf', 22, '2014-08-28 17:35:11', '2014-08-28 17:35:11'),
('jWvySDrlqCBPkKTq22mBKVnHzZcL2IBffRhw5g1BdD', 28, '2014-08-28 20:44:36', '2014-08-28 20:44:36'),
('HZRV84PzycHELb9AdvoNcJFRSX5TA18ANgbnuyAWTf', 22, '2014-08-28 20:55:22', '2014-08-28 20:55:22'),
('qAdZUohpPfnwxltzQP9SI70BGwnFfGJbWwnrFP1NMN', 28, '2014-08-28 22:07:51', '2014-08-28 22:07:51'),
('vC40wNUsDGkICj836bvgqcEo2aTiJNYh8W3ANG3RRm', 28, '2014-08-28 23:10:50', '2014-08-28 23:10:50'),
('xhZlyWTY18oGsjSAzx3seF3n9FUOu0bds42al6pJC5', 30, '2014-08-29 09:10:58', '2014-08-29 09:10:58'),
('QGhR5VmtEjaKZmY0qmGqwft8ki5KqFRtv22qNRE2rk', 22, '2014-08-29 00:50:41', '2014-08-29 00:50:41'),
('GB6SK3lgoAqNfTzs1rqZLkmDfVk69ltLMbaLZe7z6K', 26, '2014-08-29 12:15:05', '2014-08-29 12:15:05'),
('U89tWsClLeY3gB7gKecdXREzVZzouvI6SVeGU8Zghu', 26, '2014-08-29 11:27:12', '2014-08-29 11:27:12'),
('ebFDkt3U96TXIJPV3JpzO1hARbcDxjPaBSA7Ha5thP', 32, '2014-08-29 19:23:22', '2014-08-29 19:23:22'),
('kl45jWpZq1TAkjjpjePTc3OaabkfvGz0ivtGKNBeNx', 32, '2014-08-30 08:11:29', '2014-08-30 08:11:29');

-- --------------------------------------------------------

--
-- Table structure for table `StockExchangeDispatch`
--

CREATE TABLE IF NOT EXISTS `StockExchangeDispatch` (
  `taskFk` int(11) NOT NULL,
  `raceFk` int(11) NOT NULL,
  `price` double NOT NULL,
  `counter` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `StockExchangeDispatch`
--

INSERT INTO `StockExchangeDispatch` (`taskFk`, `raceFk`, `price`, `counter`) VALUES
(1, 1, 100, 0),
(2, 1, 100, 0),
(3, 1, 100, 0),
(4, 1, 100, 0),
(5, 1, 100, 0),
(6, 1, 100, 0),
(7, 1, 100, 0),
(8, 1, 100, 0),
(9, 1, 100, 0),
(10, 1, 100, 0),
(11, 1, 100, 0),
(12, 1, 100, 0),
(13, 1, 100, 0),
(14, 1, 100, 0),
(15, 1, 100, 0),
(16, 1, 100, 0),
(17, 1, 100, 0),
(18, 1, 100, 0),
(19, 1, 100, 0),
(20, 1, 100, 0);

-- --------------------------------------------------------

--
-- Table structure for table `Task`
--

CREATE TABLE IF NOT EXISTS `Task` (
`taskId` int(11) NOT NULL,
  `name` varchar(80) NOT NULL,
  `maxDuration` int(11) NOT NULL COMMENT '[seconds]',
  `price` int(11) NOT NULL,
  `description` varchar(256) NOT NULL,
  `raceFk` int(11) NOT NULL
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=21 ;

--
-- Dumping data for table `Task`
--

INSERT INTO `Task` (`taskId`, `name`, `maxDuration`, `price`, `description`, `raceFk`) VALUES
(1, 'A1', 1800, 100, 'Aamon slow', 1),
(2, 'J1', 1800, 100, 'Jeromy slow', 1),
(3, 'M1', 1800, 100, 'Moik slow', 1),
(4, 'R1', 1800, 100, 'Rotschi slow', 1),
(5, 'V1', 1800, 100, 'Voxo slow', 1),
(6, 'A2', 600, 100, 'Aamon fast', 1),
(7, 'J2', 600, 100, 'Jeremy fast', 1),
(8, 'M2', 600, 100, 'Moik fast', 1),
(9, 'R2', 600, 100, 'Rotschi fast', 1),
(10, 'V2', 600, 100, 'Voxo fast', 1),
(11, 'A3', 1200, 100, 'Ammon: Egg', 1),
(12, 'J3', 1200, 100, 'Jeremy: Lock', 1),
(13, 'M3', 1200, 100, 'Moik: Foot', 1),
(14, 'R3', 1200, 100, 'Rotschi: Lock', 1),
(15, 'V3', 1200, 100, 'Voxo: Flat', 1),
(16, 'J4', 1200, 100, 'Jeremy: Cargo', 1),
(17, 'M4', 1200, 100, 'Moik: Beer run', 1),
(18, 'R4', 1200, 100, 'Rotschi: Foot', 1),
(19, 'V4', 1200, 100, 'Voxo: Dress', 1),
(20, 'A4', 1200, 100, 'Aamon: ???', 1);

-- --------------------------------------------------------

--
-- Table structure for table `User`
--

CREATE TABLE IF NOT EXISTS `User` (
`userId` int(11) NOT NULL,
  `user` varchar(80) NOT NULL,
  `password` varchar(80) NOT NULL,
  `role` varchar(80) NOT NULL,
  `raceFk` int(11) DEFAULT NULL,
  `checkpointFk` int(11) DEFAULT NULL
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=39 ;

--
-- Dumping data for table `User`
--

INSERT INTO `User` (`userId`, `user`, `password`, `role`, `raceFk`, `checkpointFk`) VALUES
(33, 'aamon', '17d30b9a2e6f98d38269afa72c4b1b8b0a2dd9447beda595a0ef903238eeeee3', 'checkpoint', 1, 1),
(31, 'admin', '50311c24b8a7feb31735979f06fc93ae32b8732c240c0e85909e3bc91121a280', 'admin', NULL, 0),
(32, 'master', '50311c24b8a7feb31735979f06fc93ae32b8732c240c0e85909e3bc91121a280', 'race master', 1, 0),
(34, 'rotschi', '532d79cc5e85d9ecd66260c63b967c2085136c8fb07b392565a62684c353108d', 'checkpoint', 1, 2),
(35, 'voxo', '7c9b3e0182d17e9536091cf9f8323418fef7684a4c137feef9825e16a2b19da1', 'checkpoint', 1, 4),
(36, 'moik', '6edf2e2cbc79085a365fb996800a766bf756d528d48b57ce4609e6b8a33bc1fd', 'checkpoint', 1, 5),
(37, 'dispatch', '3f584eba5ee0bc275eee6cde5d8f7bae24744c19ee1c638c0ea16571cb34f492', 'dispatcher', 1, 0),
(38, 'regi', '374224fbb80782ef115a8d70d85f9ff5d5022d2c003a7821fd1d51e288d55770', 'registration', 1, 0);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `Checkpoint`
--
ALTER TABLE `Checkpoint`
 ADD PRIMARY KEY (`checkpointId`);

--
-- Indexes for table `Delivery`
--
ALTER TABLE `Delivery`
 ADD PRIMARY KEY (`deliveryId`);

--
-- Indexes for table `DeliveryCondition`
--
ALTER TABLE `DeliveryCondition`
 ADD PRIMARY KEY (`deliveryConditionId`);

--
-- Indexes for table `Parcel`
--
ALTER TABLE `Parcel`
 ADD PRIMARY KEY (`parcelId`);

--
-- Indexes for table `Race`
--
ALTER TABLE `Race`
 ADD PRIMARY KEY (`raceId`);

--
-- Indexes for table `Racer`
--
ALTER TABLE `Racer`
 ADD PRIMARY KEY (`racerId`), ADD UNIQUE KEY `racerNumber` (`raceFk`,`racerNumber`);

--
-- Indexes for table `RacerDelivery`
--
ALTER TABLE `RacerDelivery`
 ADD PRIMARY KEY (`racerDeliveryId`);

--
-- Indexes for table `RacerTask`
--
ALTER TABLE `RacerTask`
 ADD PRIMARY KEY (`racerTaskId`);

--
-- Indexes for table `Session`
--
ALTER TABLE `Session`
 ADD PRIMARY KEY (`sessionId`);

--
-- Indexes for table `StockExchangeDispatch`
--
ALTER TABLE `StockExchangeDispatch`
 ADD PRIMARY KEY (`taskFk`);

--
-- Indexes for table `Task`
--
ALTER TABLE `Task`
 ADD PRIMARY KEY (`taskId`);

--
-- Indexes for table `User`
--
ALTER TABLE `User`
 ADD PRIMARY KEY (`userId`), ADD UNIQUE KEY `user` (`user`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `Checkpoint`
--
ALTER TABLE `Checkpoint`
MODIFY `checkpointId` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `Delivery`
--
ALTER TABLE `Delivery`
MODIFY `deliveryId` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=51;
--
-- AUTO_INCREMENT for table `DeliveryCondition`
--
ALTER TABLE `DeliveryCondition`
MODIFY `deliveryConditionId` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=31;
--
-- AUTO_INCREMENT for table `Parcel`
--
ALTER TABLE `Parcel`
MODIFY `parcelId` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=16;
--
-- AUTO_INCREMENT for table `Race`
--
ALTER TABLE `Race`
MODIFY `raceId` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `Racer`
--
ALTER TABLE `Racer`
MODIFY `racerId` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `RacerDelivery`
--
ALTER TABLE `RacerDelivery`
MODIFY `racerDeliveryId` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `RacerTask`
--
ALTER TABLE `RacerTask`
MODIFY `racerTaskId` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `Task`
--
ALTER TABLE `Task`
MODIFY `taskId` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=21;
--
-- AUTO_INCREMENT for table `User`
--
ALTER TABLE `User`
MODIFY `userId` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=39;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
