-- phpMyAdmin SQL Dump
-- version 3.2.4
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Apr 08, 2010 at 12:56 PM
-- Server version: 5.1.41
-- PHP Version: 5.3.1

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";



DROP DATABASE IF EXISTS romance;
CREATE DATABASE IF NOT EXISTS romance;
GRANT ALL PRIVILEGES ON romance.* to 'wowteam'@'localhost' identified by 'wow';
USE romance;


CREATE TABLE IF NOT EXISTS `users` (
  `userName` varchar(50) NOT NULL,
  `password` varchar(50) NOT NULL,
  PRIMARY KEY (`userName`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 ;


CREATE TABLE IF NOT EXISTS `characters` (
  `charName` varchar(20) NOT NULL,
  `charRealm` varchar(20) NOT NULL,
  `lvl` int(3) NOT NULL,
  `race` int(2) NOT NULL,
  `sex` char(1) Not Null,
  `charClass` int(2) Not Null,
  `Faction` int(1) Not Null,
  `guild` varchar(30),
  `primarySpec` varchar(20),
  `secondarySpec` varchar(20),
  `pvpAch` int(3) NOT NULL,
  `dungeonAch` int(3) NOT NULL,
  `reputationAch` int(3) NOT NULL,
  `worldAch` int(3) NOT NULL,
  `explorationAch` int(3) NOT NULL,
  `questAch` int(3) NOT NULL,
  `professionAch` int(3) NOT NULL,
  `HK` int(15) Not Null,
  PRIMARY KEY (`charName`, `charRealm`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 ;

CREATE TABLE IF NOT EXISTS `friends` (
  `userOne` varchar(50) NOT NULL,
  `userTwo` varchar(50) NOT NULL,
  PRIMARY KEY (`userOne`, `userTwo`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 ;

CREATE TABLE IF NOT EXISTS `userCharacters` (
	`userId` varchar(50) Not Null,
	`userChar` varchar(20) Not Null,
	`userRealm` varchar(20) Not Null,
	PRIMARY KEY (`userId`, `userChar`, `userRealm`)
)	ENGINE=InnoDB  DEFAULT CHARSET=latin1 ;

CREATE TABLE IF NOT EXISTS `realms` (
	`realmName` varchar(20) Not Null,
	`region` varchar(2) Not Null,
	`battlegroup` varchar(30) Not Null,
	PRIMARY KEY (`realmName`)
)	ENGINE=InnoDB  DEFAULT CHARSET=latin1 ;
	

CREATE TABLE IF NOT EXISTS `messages` (
	`msgId` int(11) Not Null AUTO_INCREMENT,
	`fromUser` varchar(50) Not Null,
	`toUser` varchar(50) Not Null,
	`msgText` BLOB Not Null,
	`msgSubject` varchar(120),
	`msgReadStatus` int(1) Not Null,
	PRIMARY KEY (`msgId`)
)	ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;
