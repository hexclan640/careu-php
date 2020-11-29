-- phpMyAdmin SQL Dump
-- version 4.9.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Nov 05, 2020 at 04:57 PM
-- Server version: 10.4.10-MariaDB
-- PHP Version: 7.3.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `careu`
--

-- --------------------------------------------------------

--
-- Table structure for table `119calloperator`
--

DROP TABLE IF EXISTS `119calloperator`;
CREATE TABLE IF NOT EXISTS `119calloperator` (
  `userId` int(10) NOT NULL AUTO_INCREMENT,
  `userName` varchar(50) NOT NULL,
  `password` varchar(50) NOT NULL,
  `firstName` varchar(20) NOT NULL,
  `lastName` varchar(20) NOT NULL,
  `gender` varchar(10) NOT NULL,
  PRIMARY KEY (`userId`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `119policerequest`
--

DROP TABLE IF EXISTS `119policerequest`;
CREATE TABLE IF NOT EXISTS `119policerequest` (
  `requestId` int(11) NOT NULL,
  `date` date NOT NULL,
  `time` time NOT NULL,
  `complainCategory` varchar(100) NOT NULL,
  PRIMARY KEY (`requestId`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `119requestoperator`
--

DROP TABLE IF EXISTS `119requestoperator`;
CREATE TABLE IF NOT EXISTS `119requestoperator` (
  `requestId` int(11) NOT NULL,
  `userId` int(11) NOT NULL,
  PRIMARY KEY (`requestId`,`userId`),
  KEY `userId` (`userId`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `1990ambulancerequest`
--

DROP TABLE IF EXISTS `1990ambulancerequest`;
CREATE TABLE IF NOT EXISTS `1990ambulancerequest` (
  `requestId` int(10) NOT NULL,
  `date` date NOT NULL,
  `time` time NOT NULL,
  `numberOfPatients` int(11) NOT NULL,
  `patientCondition` varchar(50) NOT NULL,
  PRIMARY KEY (`requestId`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `1990calloperator`
--

DROP TABLE IF EXISTS `1990calloperator`;
CREATE TABLE IF NOT EXISTS `1990calloperator` (
  `userId` int(10) NOT NULL AUTO_INCREMENT,
  `userName` varchar(20) NOT NULL,
  `password` varchar(20) NOT NULL,
  `firstName` varchar(20) NOT NULL,
  `lastName` varchar(20) NOT NULL,
  `gender` varchar(10) NOT NULL,
  PRIMARY KEY (`userId`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `1990requestoperator`
--

DROP TABLE IF EXISTS `1990requestoperator`;
CREATE TABLE IF NOT EXISTS `1990requestoperator` (
  `requestId` int(11) NOT NULL,
  `userId` int(11) NOT NULL,
  PRIMARY KEY (`requestId`,`userId`),
  KEY `userId` (`userId`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

DROP TABLE IF EXISTS `admin`;
CREATE TABLE IF NOT EXISTS `admin` (
  `userId` int(10) NOT NULL AUTO_INCREMENT,
  `userName` varchar(50) NOT NULL,
  `password` varchar(50) NOT NULL,
  `firstName` varchar(50) NOT NULL,
  `lastName` varchar(50) NOT NULL,
  `gender` varchar(10) NOT NULL,
  PRIMARY KEY (`userId`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `feedback`
--

DROP TABLE IF EXISTS `feedback`;
CREATE TABLE IF NOT EXISTS `feedback` (
  `feedbackId` int(10) NOT NULL AUTO_INCREMENT,
  `feedbackTime` datetime(6) NOT NULL,
  `comment` varchar(255) NOT NULL,
  PRIMARY KEY (`feedbackId`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `give`
--

DROP TABLE IF EXISTS `give`;
CREATE TABLE IF NOT EXISTS `give` (
  `requestId` int(11) NOT NULL,
  `feedbackId` int(11) NOT NULL,
  `userId` int(11) NOT NULL,
  PRIMARY KEY (`requestId`,`feedbackId`,`userId`),
  KEY `feedback` (`feedbackId`),
  KEY `user` (`userId`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `idphoto`
--

DROP TABLE IF EXISTS `idphoto`;
CREATE TABLE IF NOT EXISTS `idphoto` (
  `userId` int(11) NOT NULL,
  `idPhoto` varchar(50) NOT NULL,
  PRIMARY KEY (`userId`,`idPhoto`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `idphoto`
--

INSERT INTO `idphoto` (`userId`, `idPhoto`) VALUES
(3, ' 1'),
(3, ' 2');

-- --------------------------------------------------------

--
-- Table structure for table `manage`
--

DROP TABLE IF EXISTS `manage`;
CREATE TABLE IF NOT EXISTS `manage` (
  `adminId` int(11) NOT NULL,
  `userId` int(11) NOT NULL,
  `operation` varchar(50) NOT NULL,
  PRIMARY KEY (`adminId`,`userId`),
  KEY `userId` (`userId`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `photo`
--

DROP TABLE IF EXISTS `photo`;
CREATE TABLE IF NOT EXISTS `photo` (
  `evidenceId` int(10) NOT NULL AUTO_INCREMENT,
  `time` time NOT NULL,
  `date` date NOT NULL,
  `category` varchar(50) NOT NULL,
  `requestId` int(10) NOT NULL,
  PRIMARY KEY (`evidenceId`),
  KEY `photo_ibfk_1` (`requestId`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `relative`
--

DROP TABLE IF EXISTS `relative`;
CREATE TABLE IF NOT EXISTS `relative` (
  `relativeId` int(10) NOT NULL AUTO_INCREMENT,
  `userId` int(10) NOT NULL,
  `name` varchar(50) NOT NULL,
  `phoneNumber` varchar(10) NOT NULL,
  PRIMARY KEY (`relativeId`),
  KEY `relative` (`userId`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `reply`
--

DROP TABLE IF EXISTS `reply`;
CREATE TABLE IF NOT EXISTS `reply` (
  `replyId` int(10) NOT NULL AUTO_INCREMENT,
  `date` date NOT NULL,
  `time` time NOT NULL,
  `message` varchar(100) NOT NULL,
  `userId` int(10) NOT NULL,
  PRIMARY KEY (`replyId`),
  KEY `reply_ibfk_1` (`userId`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `request`
--

DROP TABLE IF EXISTS `request`;
CREATE TABLE IF NOT EXISTS `request` (
  `requestId` int(11) NOT NULL AUTO_INCREMENT,
  `time` time NOT NULL,
  `date` date NOT NULL,
  `userId` int(10) NOT NULL,
  PRIMARY KEY (`requestId`),
  KEY `serviceRequest` (`userId`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `send`
--

DROP TABLE IF EXISTS `send`;
CREATE TABLE IF NOT EXISTS `send` (
  `replyId` int(11) NOT NULL,
  `userId` int(11) NOT NULL,
  PRIMARY KEY (`replyId`,`userId`),
  KEY `userId` (`userId`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `servicerequester`
--

DROP TABLE IF EXISTS `servicerequester`;
CREATE TABLE IF NOT EXISTS `servicerequester` (
  `userId` int(10) NOT NULL AUTO_INCREMENT,
  `userName` varchar(20) NOT NULL,
  `password` varchar(20) NOT NULL,
  `firstName` varchar(20) NOT NULL,
  `lastName` varchar(20) NOT NULL,
  `nicNumber` varchar(20) NOT NULL,
  `gender` varchar(10) NOT NULL,
  `email` varchar(30) NOT NULL,
  `address` varchar(255) NOT NULL,
  `dateOfBirth` varchar(20) NOT NULL,
  `phoneNumber` varchar(10) NOT NULL,
  `status` varchar(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`userId`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `servicerequester`
--

INSERT INTO `servicerequester` (`userId`, `userName`, `password`, `firstName`, `lastName`, `nicNumber`, `gender`, `email`, `address`, `dateOfBirth`, `phoneNumber`, `status`) VALUES
(1, '', '', 'wefwef', 'wefwef', '', 'aaa', '', '', 'bbb', 'sss', ''),
(2, 'manjitha', '1234', 'Limal', 'manjitha', '983091563v', 'aaa', 'lmanjitha@gmail.com', '', 'bbb', 'sss', ''),
(3, 'asd', '123', 'sdad', 'adasad', '983052896v', 'aaa', 'assd@gmail.com', 'sgdth', 'bbb', 'sss', ''),
(4, 'abc', '123', 'weq', 'qwee', '', 'aaa', 'qwee', '', 'bbb', 'sss', ''),
(5, 'qwe', '12345678', 'dfsdf', 'dfgdf', '983091573v', 'Male', 'dffgfd@gmail.co', 'adef', '2012-12-31', '0770795263', '0');

--
-- Constraints for dumped tables
--

--
-- Constraints for table `119policerequest`
--
ALTER TABLE `119policerequest`
  ADD CONSTRAINT `119policerequest_ibfk_1` FOREIGN KEY (`requestId`) REFERENCES `request` (`requestId`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `119requestoperator`
--
ALTER TABLE `119requestoperator`
  ADD CONSTRAINT `119requestoperator_ibfk_1` FOREIGN KEY (`requestId`) REFERENCES `119policerequest` (`requestId`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `119requestoperator_ibfk_2` FOREIGN KEY (`userId`) REFERENCES `119calloperator` (`userId`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `1990ambulancerequest`
--
ALTER TABLE `1990ambulancerequest`
  ADD CONSTRAINT `1990ambulancerequest_ibfk_1` FOREIGN KEY (`requestId`) REFERENCES `request` (`requestId`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `1990requestoperator`
--
ALTER TABLE `1990requestoperator`
  ADD CONSTRAINT `1990requestoperator_ibfk_1` FOREIGN KEY (`requestId`) REFERENCES `1990ambulancerequest` (`requestId`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `1990requestoperator_ibfk_2` FOREIGN KEY (`userId`) REFERENCES `1990calloperator` (`userId`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `give`
--
ALTER TABLE `give`
  ADD CONSTRAINT `feedback` FOREIGN KEY (`feedbackId`) REFERENCES `feedback` (`feedbackId`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `request` FOREIGN KEY (`requestId`) REFERENCES `request` (`requestId`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `user` FOREIGN KEY (`userId`) REFERENCES `servicerequester` (`userId`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `idphoto`
--
ALTER TABLE `idphoto`
  ADD CONSTRAINT `idphoto_ibfk_1` FOREIGN KEY (`userId`) REFERENCES `servicerequester` (`userId`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `manage`
--
ALTER TABLE `manage`
  ADD CONSTRAINT `manage_ibfk_1` FOREIGN KEY (`adminId`) REFERENCES `admin` (`userId`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `manage_ibfk_2` FOREIGN KEY (`userId`) REFERENCES `119calloperator` (`userId`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `manage_ibfk_3` FOREIGN KEY (`userId`) REFERENCES `1990calloperator` (`userId`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `photo`
--
ALTER TABLE `photo`
  ADD CONSTRAINT `photo_ibfk_1` FOREIGN KEY (`requestId`) REFERENCES `request` (`requestId`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `relative`
--
ALTER TABLE `relative`
  ADD CONSTRAINT `relative` FOREIGN KEY (`userId`) REFERENCES `servicerequester` (`userId`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `reply`
--
ALTER TABLE `reply`
  ADD CONSTRAINT `reply_ibfk_1` FOREIGN KEY (`userId`) REFERENCES `servicerequester` (`userId`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `request`
--
ALTER TABLE `request`
  ADD CONSTRAINT `serviceRequest` FOREIGN KEY (`userId`) REFERENCES `servicerequester` (`userId`);

--
-- Constraints for table `send`
--
ALTER TABLE `send`
  ADD CONSTRAINT `send_ibfk_1` FOREIGN KEY (`replyId`) REFERENCES `reply` (`replyId`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `send_ibfk_2` FOREIGN KEY (`userId`) REFERENCES `119calloperator` (`userId`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `send_ibfk_3` FOREIGN KEY (`userId`) REFERENCES `1990calloperator` (`userId`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
