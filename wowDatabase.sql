-- phpMyAdmin SQL Dump
-- version 3.2.4
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Apr 08, 2010 at 12:56 PM
-- Server version: 5.1.41
-- PHP Version: 5.3.1

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `romance`
--

DROP DATABASE IF EXISTS romance;
CREATE DATABASE IF NOT EXISTS romance;
GRANT ALL PRIVELEGES ON romance.* to 'romanceteam'@'localhost' identified by 'romance';
USE romance;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `userName` varchar(50) NOT NULL,
  `password` varchar(50) NOT NULL,
  PRIMARY KEY (`userName`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 ;

-- --------------------------------------------------------

--
-- Table structure for table `characters`
--

CREATE TABLE IF NOT EXISTS `characters` (
  `charName` varchar(20) NOT NULL,
  `charRealm` varchar(20) NOT NULL,
  `lvl` int(3) NOT NULL,
  `race` int(2) NOT NULL,
  `sex` char(1) Not Null,
  `charClass` int(2) Not Null,
  `Faction` int(1) Not Null,
  `HK` int(15) Not Null,
  PRIMARY KEY (`charName`, `charRealm`),
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 ;

-- --------------------------------------------------------

CREATE TABLE IF NOT EXISTS `userCharacters` (
	`userId` varchar(50) Not Null,
	`userChar` varchar(20) Not Null,
	`userRealm` varchar(20) Not Null,
	PRIMARY KEY (`userId`, `userChar`, `userRealm`),
)	ENGINE=InnoDB  DEFAULT CHARSET=latin1 ;


ALTER TABLE `userCharacters`
  ADD CONSTRAINT `userCharacters_ibfk_1` FOREIGN KEY (`userId`) REFERENCES `users` (`userName`);
  
ALTER TABLE `userCharacters`
  ADD CONSTRAINT `userCharacters_ibfk_1` FOREIGN KEY (`userChar`) REFERENCES `characters` (`charName`);
  
ALTER TABLE `userCharacters`
  ADD CONSTRAINT `userCharacters_ibfk_1` FOREIGN KEY (`userRealm`) REFERENCES `characters` (`charRealm`);



/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
