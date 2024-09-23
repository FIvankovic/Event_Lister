-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 09, 2021 at 12:57 AM
-- Server version: 10.4.21-MariaDB
-- PHP Version: 7.3.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `project01`
--
CREATE DATABASE IF NOT EXISTS `project01` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
USE `project01`;

-- --------------------------------------------------------

--
-- Table structure for table `attendee`
--

DROP TABLE IF EXISTS `attendee`;
CREATE TABLE IF NOT EXISTS `attendee` (
  `idattendee` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL,
  `role` int(11) DEFAULT NULL,
  PRIMARY KEY (`idattendee`),
  KEY `role_idx` (`role`)
) ENGINE=MyISAM AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `attendee`
--

INSERT INTO `attendee` (`idattendee`, `name`, `password`, `role`) VALUES
(1, 'admin', '$2y$10$6VKAaxsikwIJGHopcVqCwe.RbHWCymyNJqjHNPmW6erQJFSoeRj4m', 1),
(3, 'user', '$2y$10$j8Bg6T5ZFD4lOcVHVXziZeFluoUgMUdX2KVeCxf6R7ttlNiUway8K', 3),
(2, 'JoeManager', '$2y$10$oGTqT36lfMrVYDTQdJAuNO53sasf9BQhlio.lmKGwDSgWc9JCIxmC', 2),
(5, 'RileyManager', '$2y$10$DFmIv.AX/CUb/23wruXanOwl3XY1ChMlQ8qLXOPkkL.4wVhPGYV5.', 2);

-- --------------------------------------------------------

--
-- Table structure for table `attendee_event`
--

DROP TABLE IF EXISTS `attendee_event`;
CREATE TABLE IF NOT EXISTS `attendee_event` (
  `event` int(11) NOT NULL,
  `attendee` int(11) NOT NULL,
  `paid` tinyint(4) NOT NULL DEFAULT 0,
  PRIMARY KEY (`event`,`attendee`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `attendee_event`
--

INSERT INTO `attendee_event` (`event`, `attendee`, `paid`) VALUES
(1, 5, 0),
(2, 5, 0),
(1, 3, 0);

-- --------------------------------------------------------

--
-- Table structure for table `attendee_session`
--

DROP TABLE IF EXISTS `attendee_session`;
CREATE TABLE IF NOT EXISTS `attendee_session` (
  `session` int(11) NOT NULL,
  `attendee` int(11) NOT NULL,
  PRIMARY KEY (`session`,`attendee`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `event`
--

DROP TABLE IF EXISTS `event`;
CREATE TABLE IF NOT EXISTS `event` (
  `idevent` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(50) NOT NULL,
  `datestart` datetime NOT NULL,
  `dateend` datetime NOT NULL,
  `numberallowed` int(11) NOT NULL,
  `venue` int(11) NOT NULL,
  PRIMARY KEY (`idevent`),
  UNIQUE KEY `name_UNIQUE` (`name`),
  KEY `venue_fk_idx` (`venue`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `event`
--

INSERT INTO `event` (`idevent`, `name`, `datestart`, `dateend`, `numberallowed`, `venue`) VALUES
(1, 'Team Building', '2021-10-20 20:00:00', '2021-10-20 23:00:00', 100, 1),
(2, 'Marathon', '2021-10-28 17:00:00', '2021-10-28 20:00:00', 300, 2);

-- --------------------------------------------------------

--
-- Table structure for table `manager_event`
--

DROP TABLE IF EXISTS `manager_event`;
CREATE TABLE IF NOT EXISTS `manager_event` (
  `event` int(11) NOT NULL,
  `manager` int(11) NOT NULL,
  PRIMARY KEY (`event`,`manager`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `manager_event`
--

INSERT INTO `manager_event` (`event`, `manager`) VALUES
(1, 5),
(2, 2),
(2, 5);

-- --------------------------------------------------------

--
-- Table structure for table `role`
--

DROP TABLE IF EXISTS `role`;
CREATE TABLE IF NOT EXISTS `role` (
  `idrole` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(45) NOT NULL,
  PRIMARY KEY (`idrole`),
  UNIQUE KEY `name_UNIQUE` (`name`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `role`
--

INSERT INTO `role` (`idrole`, `name`) VALUES
(1, 'admin'),
(2, 'event manager'),
(3, 'attendee');

-- --------------------------------------------------------

--
-- Table structure for table `session`
--

DROP TABLE IF EXISTS `session`;
CREATE TABLE IF NOT EXISTS `session` (
  `idsession` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(50) NOT NULL,
  `numberallowed` int(11) NOT NULL,
  `event` int(11) NOT NULL,
  `startdate` datetime NOT NULL,
  `enddate` datetime NOT NULL,
  PRIMARY KEY (`idsession`)
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `session`
--

INSERT INTO `session` (`idsession`, `name`, `numberallowed`, `event`, `startdate`, `enddate`) VALUES
(1, 'Classical Music Concert', 100, 1, '2021-10-20 20:00:00', '2021-10-20 22:00:00'),
(2, 'Jazz Music Concert', 100, 1, '2021-10-20 22:00:00', '2021-10-20 23:00:00'),
(3, 'Warm Up', 300, 2, '2021-10-28 17:00:00', '2021-10-28 18:00:00'),
(4, 'Race ', 300, 2, '2021-10-28 18:00:00', '2021-10-28 20:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `venue`
--

DROP TABLE IF EXISTS `venue`;
CREATE TABLE IF NOT EXISTS `venue` (
  `idvenue` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(50) NOT NULL,
  `capacity` int(11) DEFAULT NULL,
  PRIMARY KEY (`idvenue`),
  UNIQUE KEY `name_UNIQUE` (`name`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `venue`
--

INSERT INTO `venue` (`idvenue`, `name`, `capacity`) VALUES
(1, 'Gin Garden', 100),
(2, 'Jarun', 5000);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
