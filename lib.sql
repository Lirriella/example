-- phpMyAdmin SQL Dump
-- version 3.2.3
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Sep 18, 2014 at 02:57 PM
-- Server version: 5.1.40
-- PHP Version: 5.3.3

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `lib`
--

-- --------------------------------------------------------

--
-- Table structure for table `books`
--

CREATE TABLE IF NOT EXISTS `books` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(200) NOT NULL COMMENT 'название',
  `year` int(11) DEFAULT NULL COMMENT 'год выпуска',
  `author` varchar(200) NOT NULL COMMENT 'имя автора',
  `description` text COMMENT 'дополнительное описание',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=cp1251 COMMENT='книги' AUTO_INCREMENT=7 ;

--
-- Dumping data for table `books`
--

INSERT INTO `books` (`id`, `title`, `year`, `author`, `description`) VALUES
(6, 'РєРЅРёРіР°2', 0, 'Р°РІС‚РѕСЂ2', 'РѕРїРёСЃР°РЅРёРµ1'),
(5, 'РєРЅРёРіР°1', 2000, 'Р°РІС‚РѕСЂ1', 'РѕРїРёСЃР°РЅРёРµ1');
