-- phpMyAdmin SQL Dump
-- version 4.1.7
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Jul 29, 2014 at 05:24 PM
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
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=9 ;

--
-- Dumping data for table `Checkpoint`
--

INSERT INTO `Checkpoint` (`checkpointId`, `name`, `manned`, `raceFk`) VALUES
(1, 'Checkpoint1.1', 0, 4),
(2, 'Checkpoint2', 1, 4),
(3, 'Checkpoint3', 1, 4),
(4, 'Checkpoint 4', 0, 4),
(5, 'Checkpoint 5', 1, 4),
(6, 'asgfasdf', 0, 4),
(7, 'asdfasd', 0, 4),
(8, 'asdfasdf', 0, 4);

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
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=28 ;

-- --------------------------------------------------------

--
-- Table structure for table `DeliveryCondition`
--

CREATE TABLE IF NOT EXISTS `DeliveryCondition` (
  `deliveryConditionId` int(11) NOT NULL AUTO_INCREMENT,
  `deliveryFk` int(11) NOT NULL,
  `previousDeliveryFk` int(11) NOT NULL,
  PRIMARY KEY (`deliveryConditionId`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=57 ;

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
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=8 ;

--
-- Dumping data for table `Parcel`
--

INSERT INTO `Parcel` (`parcelId`, `name`, `description`, `raceFk`) VALUES
(3, 'Parcel 2', 'for Race 1cc', 4),
(4, 'Parcel1', 'for Race 1', 4),
(5, 'Parcel 3', 'for Race 1', 4),
(6, 'asdfasdf', '', 4),
(7, 'asdf', '', 4);

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
('yOx28UkxS5Z4xdNc58baieh0rSqJCxA25GqUKqCsZB', 11, '2014-07-29 19:04:27', '2014-07-29 19:04:27');

-- --------------------------------------------------------

--
-- Table structure for table `StockExchangeDispatch`
--

CREATE TABLE IF NOT EXISTS `StockExchangeDispatch` (
  `taskFk` int(11) NOT NULL,
  `raceFk` int(11) NOT NULL,
  `price` double NOT NULL,
  `lastUpdate` datetime NOT NULL,
  `counter` int(11) NOT NULL,
  PRIMARY KEY (`taskFk`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `StockExchangeDispatch`
--

INSERT INTO `StockExchangeDispatch` (`taskFk`, `raceFk`, `price`, `lastUpdate`, `counter`) VALUES
(9, 4, 36.851780732057, '2014-07-29 19:22:13', 3),
(7, 4, 70.035475553865, '2014-07-29 19:22:13', 2),
(10, 4, 36.587074849706, '2014-07-29 19:22:13', 3),
(11, 4, 71.396016707086, '2014-07-29 19:22:13', 2),
(12, 4, 137.02593043147, '2014-07-29 19:22:13', 1),
(13, 4, 137.02593043147, '2014-07-29 19:22:13', 1),
(14, 4, 137.02593043147, '2014-07-29 19:22:13', 1),
(15, 4, 137.02593043146, '2014-07-29 19:22:13', 1),
(16, 4, 137.02593043147, '2014-07-29 19:22:13', 1);

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
  PRIMARY KEY (`userId`),
  UNIQUE KEY `user` (`user`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=12 ;

--
-- Dumping data for table `User`
--

INSERT INTO `User` (`userId`, `user`, `password`, `role`, `raceFk`) VALUES
(0, 'admin', '8c6976e5b5410415bde908bd4dee15dfb167a9c873fc4bb8a81f6f2ab448a918', 'admin', -1),
(7, 'master', 'fc613b4dfd6736a7bd268c8a0e74ed0d1c04a959f59dd74ef2874983fd443fc9', 'race master', 4),
(8, 'registration', '29c9c30e0604515ced98b3d14fd88751a8f8e4b9bc69d483a67a257c14ab79fb', 'registration', 4),
(10, 'master2', 'ee33bacb9843d3b4bac37e425b203d8aad4e08c6773d21a10533d66cd6bb7c02', 'race master', 5),
(11, 'dispatcher', 'ff7fce673d2f52b071129e34ff8ea570b7159527d019c81ec7756f4f8c821535', 'dispatcher', 4);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
