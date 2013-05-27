-- phpMyAdmin SQL Dump
-- version 3.2.0.1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Sep 02, 2010 at 09:28 AM
-- Server version: 5.1.36
-- PHP Version: 5.3.0

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `db_tee-shop`
--

-- --------------------------------------------------------

--
-- Table structure for table `product`
--

CREATE TABLE IF NOT EXISTS `product` (
  `ID` int(5) NOT NULL AUTO_INCREMENT,
  `name` varchar(128) NOT NULL,
  `category` varchar(32) NOT NULL,
  `info` text NOT NULL,
  `img` varchar(256) NOT NULL,
  `price` double NOT NULL,
  `stock` int(5) NOT NULL,
  `hit` int(5) NOT NULL,
  `status` int(2) NOT NULL DEFAULT '1',
  PRIMARY KEY (`ID`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=7 ;

--
-- Dumping data for table `product`
--

INSERT INTO `product` (`ID`, `name`, `category`, `info`, `img`, `price`, `stock`, `hit`, `status`) VALUES
(1, 'Clearly Ambiguous', 't-shirt', 'Clearly ambiguous. The shapes say it all. ', 't-5.jpg', 24, 9, 19, 1),
(2, 'Yes or No', 't-shirt', 'Double t-shirt for couples', 't-4.jpg', 36, 20, 18, 1),
(3, '2 plus 3 equals five', 't-shirt', 'Combed cotton 3', 't-3.jpg', 24, 0, 12, 1),
(4, 'se7en', 't-shirt', 'seven sin', 't-2.jpg', 28, 18, 2, 1),
(5, 'ampersand &', 'hood', 'ampersand & me', 'h-1.jpg', 50, 13, 3, 1),
(6, 'A hood', 'hoodie', 'A hood for me', 'h-2.jpg', 54, 12, 3, 1);

-- --------------------------------------------------------

--
-- Table structure for table `purchase_item`
--

CREATE TABLE IF NOT EXISTS `purchase_item` (
  `ID` int(20) NOT NULL AUTO_INCREMENT,
  `cart_ID` int(20) NOT NULL,
  `product_ID` int(20) NOT NULL,
  `qty` int(5) NOT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `purchase_order`
--

CREATE TABLE IF NOT EXISTS `purchase_order` (
  `ID` int(20) NOT NULL AUTO_INCREMENT,
  `cart_id` varchar(32) NOT NULL,
  `payment_option` varchar(32) NOT NULL,
  `name` varchar(128) NOT NULL,
  `phone` varchar(32) NOT NULL,
  `email` varchar(128) NOT NULL,
  `address` varchar(256) NOT NULL,
  `total` double NOT NULL,
  `entry_date` datetime NOT NULL,
  `status` int(2) NOT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE IF NOT EXISTS `user` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(32) NOT NULL,
  `pass` varchar(64) NOT NULL,
  `email` varchar(128) NOT NULL,
  `usergroup` varchar(32) NOT NULL,
  `status` int(2) NOT NULL,
  PRIMARY KEY (`ID`),
  UNIQUE KEY `name` (`name`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`ID`, `name`, `pass`, `email`, `usergroup`, `status`) VALUES
(1, 'admin', '8cb2237d0679ca88db6464eac60da96345513964', 'admin@admin.com', 'admin', 1),
(2, 'mdennisa', '8cb2237d0679ca88db6464eac60da96345513964', 'mdennisa@gmail.com', 'customer', 1);
