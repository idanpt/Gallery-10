-- phpMyAdmin SQL Dump
-- version 3.5.1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Feb 24, 2014 at 09:36 PM
-- Server version: 5.5.24-log
-- PHP Version: 5.3.13

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `phpimage`
--

-- --------------------------------------------------------

--
-- Table structure for table `image`
--

CREATE TABLE IF NOT EXISTS `image` (
  `mid` int(11) NOT NULL AUTO_INCREMENT,
  `cid` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `path` varchar(50) NOT NULL,
  `caption` varchar(100) NOT NULL,
  `Photographer` varchar(60) NOT NULL,
  `time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`mid`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=85 ;

--
-- Dumping data for table `image`
--

INSERT INTO `image` (`mid`, `cid`, `name`, `path`, `caption`, `Photographer`, `time`) VALUES
(62, 0, '371_59173939096_9776_n.jpg', 'uploads/371_59173939096_9776_n.jpg', 'army', 'Idan', '2014-02-05 19:31:50'),
(63, 0, '2013-09-18 14.48.09.jpg', 'uploads/2013-09-18 14.48.09.jpg', '', 'Inna', '2014-02-05 19:32:04'),
(64, 0, '2013-09-20 21.40.21.jpg', 'uploads/2013-09-20 21.40.21.jpg', '', 'Inna', '2014-02-05 19:32:20'),
(65, 0, '2013-09-22 11.55.59.jpeg', 'uploads/2013-09-22 11.55.59.jpeg', '', 'Idan', '2014-02-05 19:32:43'),
(66, 0, '2013-09-22 11.56.04.jpeg', 'uploads/2013-09-22 11.56.04.jpeg', '', 'Yossi', '2014-02-05 19:32:55'),
(67, 0, '2013-10-17 18.29.54.jpg', 'uploads/2013-10-17 18.29.54.jpg', '', 'Inna', '2014-02-05 19:33:10'),
(68, 0, '2013-10-26 17.47.28.jpg', 'uploads/2013-10-26 17.47.28.jpg', '', 'Idan', '2014-02-05 19:33:22'),
(69, 0, '6732_123332812245_3982029_n.jpg', 'uploads/6732_123332812245_3982029_n.jpg', '', 'Yossi', '2014-02-05 19:33:34'),
(70, 0, '68245_439431236117682_405161108_n (1).jpg', 'uploads/68245_439431236117682_405161108_n (1).jpg', '', 'Yossi', '2014-02-05 19:33:48'),
(71, 0, '71800_444536958004_3178611_n.jpg', 'uploads/71800_444536958004_3178611_n.jpg', '', 'Inna', '2014-02-05 19:34:10'),
(72, 0, '222570_324084591032183_1026935266_n.jpg', 'uploads/222570_324084591032183_1026935266_n.jpg', '', 'Yossi', '2014-02-05 19:34:24'),
(73, 0, '265843_235111033183751_5516168_o.jpg', 'uploads/265843_235111033183751_5516168_o.jpg', '', 'Yossi', '2014-02-05 19:34:34'),
(74, 0, '1601083_699326946778709_684520871_n.jpg', 'uploads/1601083_699326946778709_684520871_n.jpg', '', 'Yossi', '2014-02-05 19:34:46'),
(75, 0, '20130404_004428.jpg', 'uploads/20130404_004428.jpg', '', 'Idan', '2014-02-05 19:34:58'),
(76, 0, '20130130_170448.jpg', 'uploads/20130130_170448.jpg', '', 'Idan', '2014-02-05 19:35:09'),
(77, 0, '20130824_202834.jpg', 'uploads/20130824_202834.jpg', '', 'Yossi', '2014-02-05 19:35:22'),
(78, 0, '20130824_183501.jpg', 'uploads/20130824_183501.jpg', '', 'Yossi', '2014-02-05 19:35:33'),
(79, 0, '20130823_183944(0).jpg', 'uploads/20130823_183944(0).jpg', '', 'Yossi', '2014-02-05 19:36:29'),
(80, 0, 'artworks-000064263116-8httgv-t200x200.jpg', 'uploads/artworks-000064263116-8httgv-t200x200.jpg', '', 'Idan', '2014-02-05 19:36:50'),
(81, 0, 'Boston City Flow.jpg', 'uploads/Boston City Flow.jpg', '', 'Inna', '2014-02-05 19:37:05'),
(82, 0, 'Desert.jpg', 'uploads/Desert.jpg', '', 'Idan', '2014-02-05 19:37:22'),
(83, 0, '20131117_113118.jpg', 'uploads/20131117_113118.jpg', '', 'Idan', '0000-00-00 00:00:00'),
(84, 0, '20131117_113128.jpg', 'uploads/20131117_113128.jpg', '', 'Yossi', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(25) NOT NULL,
  `username` varchar(20) NOT NULL,
  `password` varchar(100) NOT NULL,
  `date` date NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=9 ;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `username`, `password`, `date`) VALUES
(7, 'idan ptichi', 'idanpt', 'b9423eda12d2b1060ffddc29300c20c8', '2014-02-04'),
(8, 'yossi', 'yos', 'e10adc3949ba59abbe56e057f20f883e', '2014-02-19');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
