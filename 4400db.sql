-- phpMyAdmin SQL Dump
-- version 4.1.14
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Dec 07, 2014 at 06:21 PM
-- Server version: 5.6.17
-- PHP Version: 5.5.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `4400db`
--

-- --------------------------------------------------------

--
-- Table structure for table `apartment`
--

CREATE TABLE IF NOT EXISTS `apartment` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `aptno` int(11) NOT NULL,
  `available` date NOT NULL,
  `sqft` int(11) NOT NULL,
  `lease` int(11) NOT NULL,
  `category` varchar(25) NOT NULL,
  `rent` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=42 ;

--
-- Dumping data for table `apartment`
--

INSERT INTO `apartment` (`id`, `aptno`, `available`, `sqft`, `lease`, `category`, `rent`) VALUES
(4, 101, '2014-09-01', 900, 12, '1bdr-1bth', 1000),
(5, 102, '2014-03-01', 900, 12, '1bdr-1bth', 1200),
(6, 103, '2014-10-01', 900, 6, '1bdr-1bth', 1000),
(7, 104, '2015-08-01', 1200, 3, '1bdr-1bth', 1500),
(8, 105, '2015-09-01', 1200, 6, '1bdr-1bth', 1500),
(9, 106, '2015-08-01', 900, 3, '1bdr-1bth', 1000),
(10, 107, '2014-08-01', 900, 3, '1bdr-1bth', 1000),
(13, 109, '2015-06-01', 900, 6, '1bdr-1bth', 1200),
(14, 201, '2016-03-01', 1200, 3, '2bdr-1bth', 1500),
(15, 202, '2014-02-01', 1100, 12, '2bdr-1bth', 1700),
(16, 203, '2014-06-01', 1100, 6, '2bdr-1bth', 1600),
(17, 204, '2014-04-01', 1200, 12, '2bdr-1bth', 1500),
(18, 205, '2014-02-01', 1100, 12, '2bdr-1bth', 1600),
(19, 206, '2015-05-01', 1300, 3, '2bdr-1bth', 1700),
(20, 207, '2016-07-01', 1100, 6, '2bdr-1bth', 1800),
(21, 208, '2014-08-01', 1200, 12, '2bdr-1bth', 1500),
(22, 209, '2014-06-01', 1100, 12, '2bdr-1bth', 1700),
(23, 301, '2014-11-01', 1500, 3, '2bdr-2bth', 2100),
(24, 302, '2014-06-01', 1600, 12, '2bdr-2bth', 2000),
(25, 303, '2015-08-01', 1500, 6, '2bdr-2bth', 1900),
(26, 304, '2014-04-01', 1400, 12, '2bdr-2bth', 2000),
(27, 305, '2016-03-01', 1300, 3, '2bdr-2bth', 2100),
(28, 306, '2015-03-01', 1200, 6, '2bdr-2bth', 2300),
(29, 307, '2014-10-01', 1500, 3, '2bdr-2bth', 2100),
(30, 308, '2016-03-01', 1400, 3, '2bdr-2bth', 2000),
(31, 309, '2015-03-01', 1500, 6, '2bdr-2bth', 2000),
(32, 401, '2014-09-01', 900, 3, '1bdr-1bth', 1000),
(33, 402, '2014-09-01', 900, 3, '1bdr-1bth', 1000),
(34, 403, '2014-11-01', 1100, 6, '2bdr-1bth', 1200),
(35, 404, '2014-10-01', 900, 6, '2bdr-1bth', 1100),
(36, 405, '2014-09-01', 900, 12, '2bdr-2bth', 1200),
(37, 406, '2014-10-01', 1000, 6, '1bdr-1bth', 1200),
(38, 407, '2014-11-01', 1200, 6, '1bdr-1bth', 1200),
(39, 408, '2014-11-01', 900, 3, '1bdr-1bth', 1300),
(40, 409, '2014-10-01', 1200, 12, '1bdr-1bth', 1200),
(41, 501, '2014-08-01', 900, 3, '1bdr-1bth', 1000);

-- --------------------------------------------------------

--
-- Table structure for table `issue`
--

CREATE TABLE IF NOT EXISTS `issue` (
  `issue` varchar(30) NOT NULL,
  PRIMARY KEY (`issue`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `issue`
--

INSERT INTO `issue` (`issue`) VALUES
('Door'),
('Garbage'),
('Roaches'),
('Technical');

-- --------------------------------------------------------

--
-- Table structure for table `maintenance`
--

CREATE TABLE IF NOT EXISTS `maintenance` (
  `issue` varchar(30) NOT NULL,
  `dateofrequest` date NOT NULL,
  `aptno` int(11) NOT NULL,
  `dateresolved` date NOT NULL,
  `tookdays` int(11) NOT NULL,
  PRIMARY KEY (`issue`,`dateofrequest`,`aptno`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `maintenance`
--

INSERT INTO `maintenance` (`issue`, `dateofrequest`, `aptno`, `dateresolved`, `tookdays`) VALUES
('Door', '2014-08-03', 103, '2014-12-03', 1),
('Door', '2014-09-03', 103, '2014-12-03', 91),
('Door', '2014-12-03', 101, '0000-00-00', 0),
('Garbage', '2014-08-03', 103, '2014-12-03', 122),
('Garbage', '2014-12-03', 101, '0000-00-00', 0),
('Roaches', '2014-08-03', 103, '2014-12-03', 122),
('Roaches', '2014-12-03', 101, '2014-12-03', 1),
('Technical', '2014-09-03', 103, '2014-12-03', 91),
('Technical', '2014-12-03', 101, '2014-12-03', 1);

-- --------------------------------------------------------

--
-- Table structure for table `payment`
--

CREATE TABLE IF NOT EXISTS `payment` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(25) NOT NULL,
  `nameoncard` varchar(25) NOT NULL,
  `cardno` int(11) NOT NULL,
  `expdate` varchar(25) NOT NULL,
  `cvv` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=14 ;

--
-- Dumping data for table `payment`
--

INSERT INTO `payment` (`id`, `username`, `nameoncard`, `cardno`, `expdate`, `cvv`) VALUES
(5, 'user2', 'name2', 1, '2014-12', 111),
(6, 'user8', 'name8', 1, '2014-12', 111),
(8, 'user6', 'name6', 1, '2014-12', 111),
(9, 'user8', 'name8', 2, '2014-12', 112),
(10, 'user7', 'name7', 1, '2014-12', 111),
(12, 'user40', 'name40', 2, '2014-12', 222),
(13, 'user50', 'dsa', 1, '2014-12', 111);

-- --------------------------------------------------------

--
-- Table structure for table `paysrent`
--

CREATE TABLE IF NOT EXISTS `paysrent` (
  `cardno` int(11) NOT NULL,
  `payfor` date NOT NULL,
  `aptno` int(11) NOT NULL,
  `dateofpayment` date NOT NULL,
  `amount` int(11) NOT NULL,
  PRIMARY KEY (`cardno`,`payfor`,`aptno`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `paysrent`
--

INSERT INTO `paysrent` (`cardno`, `payfor`, `aptno`, `dateofpayment`, `amount`) VALUES
(1, '2014-09-01', 101, '2014-09-10', 1350),
(1, '2014-11-01', 101, '2014-11-10', 1350),
(1, '2014-12-01', 101, '2014-09-03', 1000);

-- --------------------------------------------------------

--
-- Table structure for table `prospective`
--

CREATE TABLE IF NOT EXISTS `prospective` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(25) NOT NULL,
  `uname` varchar(25) NOT NULL,
  `bdate` date NOT NULL,
  `gender` varchar(25) NOT NULL,
  `monthlyincome` int(11) NOT NULL,
  `category` varchar(25) NOT NULL,
  `pdate` date NOT NULL,
  `lease` int(11) NOT NULL,
  `prev` varchar(100) NOT NULL,
  `acceptance` varchar(25) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `id` (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=34 ;

--
-- Dumping data for table `prospective`
--

INSERT INTO `prospective` (`id`, `username`, `uname`, `bdate`, `gender`, `monthlyincome`, `category`, `pdate`, `lease`, `prev`, `acceptance`) VALUES
(18, 'user1', 'name1', '2014-12-04', 'male', 1200, '1bdr-1bth', '2015-02-28', 3, 'Seattle', 'Reject'),
(19, 'user2', 'name2', '2009-06-16', 'male', 5000, '1bdr-1bth', '2015-04-01', 6, 'Seattle', 'Accept'),
(20, 'user3', 'name3', '2014-12-02', 'male', 5000, '1bdr-1bth', '2015-10-01', 3, 'Seattle', 'Accept'),
(21, 'user4', 'name4', '2014-12-19', 'male', 9000, '2bdr-1bth', '2014-09-24', 12, 'San Diego', 'Accept'),
(22, 'user5', 'name5', '2014-12-19', 'female', 1200, '2bdr-2bth', '2015-03-20', 6, 'San Diego', 'Reject'),
(23, 'user6', 'name6', '2015-03-19', 'female', 10000, '2bdr-2bth', '2015-03-01', 3, 'San Diego', 'Accept'),
(24, 'user7', 'name7', '2014-12-19', 'male', 12000, '2bdr-2bth', '2015-02-28', 3, 'Atlanta', 'Accept'),
(25, 'user8', 'name8', '2014-12-19', 'male', 10000, '1bdr-1bth', '2014-02-01', 12, 'Georgia', 'Accept'),
(26, 'user9', 'name9', '2014-12-03', 'female', 1200, '2bdr-2bth', '2015-06-19', 6, 'Atlanta', 'Reject'),
(27, 'user100', 'name100', '2014-12-01', 'male', 4000, '1bdr-1bth', '2014-12-10', 3, '8th', 'Reject'),
(28, 'user10', 'name10', '2014-12-10', 'male', 8000, '2bdr-1bth', '2014-12-04', 3, 'atlanta', 'Reject'),
(29, 'user11', 'name11', '2014-12-10', 'female', 8000, '2bdr-2bth', '2015-01-09', 3, 'Seattle', 'Reject'),
(30, 'user30', 'name30', '2014-12-03', 'female', 9000, '2bdr-1bth', '2014-12-12', 3, 'atlanta', 'Reject'),
(31, 'user40', 'name30', '2014-12-11', 'female', 9000, '1bdr-1bth', '2014-09-04', 3, '800 w', 'Accept'),
(32, 'user50', 'name50', '2014-12-12', 'male', 10000, '1bdr-1bth', '2014-11-07', 3, '800 w', 'Accept'),
(33, 'jaemin', 'jaemin', '2014-12-17', 'male', 1000000, '2bdr-2bth', '2014-12-24', 3, '600', 'Reject');

-- --------------------------------------------------------

--
-- Table structure for table `reminder`
--

CREATE TABLE IF NOT EXISTS `reminder` (
  `aptno` int(11) NOT NULL,
  `reminderdate` date NOT NULL,
  `message` varchar(50) NOT NULL,
  `status` tinyint(1) NOT NULL,
  PRIMARY KEY (`aptno`,`reminderdate`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `reminder`
--

INSERT INTO `reminder` (`aptno`, `reminderdate`, `message`, `status`) VALUES
(101, '2014-11-04', 'Your payment is past due. Please pay immediately.', 1),
(301, '2014-12-03', ' Your payment is past due. Please pay immediately.', 1),
(307, '2014-12-03', ' Your payment is past due. Please pay immediately.', 0);

-- --------------------------------------------------------

--
-- Table structure for table `resident`
--

CREATE TABLE IF NOT EXISTS `resident` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(25) NOT NULL,
  `aptno` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=23 ;

--
-- Dumping data for table `resident`
--

INSERT INTO `resident` (`id`, `username`, `aptno`) VALUES
(14, 'user2', 103),
(16, 'user3', 107),
(17, 'user6', 307),
(18, 'user7', 301),
(19, 'user8', 101),
(20, 'user4', 208),
(21, 'user40', 401),
(22, 'user50', 402);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(25) NOT NULL,
  `password` varchar(25) NOT NULL,
  `review` tinyint(1) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=41 ;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `password`, `review`) VALUES
(19, 'admin', '123123', 1),
(25, 'user1', '123123', 0),
(26, 'user2', '123123', 1),
(27, 'user3', '123123', 1),
(28, 'user4', '123123', 1),
(29, 'user5', '123123', 0),
(30, 'user6', '123123', 1),
(31, 'user7', '123123', 1),
(32, 'user8', '123123', 1),
(33, 'user9', '123123', 0),
(34, 'user100', '123123', 0),
(35, 'user10', '123123', 0),
(36, 'user11', '123123', 0),
(37, 'user30', '123123', 0),
(38, 'user40', '123123', 1),
(39, 'user50', '123123', 1),
(40, 'jaemin', '123123', 0);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
