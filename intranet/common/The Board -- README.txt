If you're reading this, it's probably Rush time again.  Here's what you need to know to use The Board:

Here is the SQL to create the database needed to run the system (it contains sample data in each table so you won't get lost once it's set up)  You need to create a database called pma_pledges and then copy/paste the following SQL to create the tables:

-- phpMyAdmin SQL Dump
-- version 2.11.5
-- http://www.phpmyadmin.net
--
-- Generation Time: Jan 22, 2009 at 02:43 PM
-- Server version: 5.0.45
-- PHP Version: 5.2.3

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";

--
-- Database: `pma_pledges`
--

-- --------------------------------------------------------

--
-- Table structure for table `active_brothers`
--

CREATE TABLE IF NOT EXISTS `active_brothers` (
  `id` int(11) NOT NULL auto_increment,
  `name` text NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=23 ;

--
-- Dumping data for table `active_brothers`
--

INSERT INTO `active_brothers` (`id`, `name`) VALUES
(1, 'Ford Ramsey'),
(2, 'Ben Charlton'),
(3, 'Brady McReynolds'),
(4, 'Brian VanderJeugdt'),
(5, 'Casey Smith'),
(6, 'Colin Richardson'),
(7, 'Daniel Hammond'),
(8, 'Dave Piercey'),
(9, 'Doug Crandell'),
(10, 'Duncan Lewis'),
(11, 'Geoff Mackey'),
(12, 'James Burdin'),
(13, 'Jason Bost'),
(14, 'Matt Wait'),
(15, 'Justin Wier'),
(16, 'Matt Martell'),
(17, 'Myron Massey'),
(18, 'Omar Jacobs'),
(19, 'Spencer Braswell'),
(20, 'Tommy Bastable'),
(21, 'Warren Weisler'),
(22, 'William Hobbs');

-- --------------------------------------------------------

--
-- Table structure for table `admins`
--

CREATE TABLE IF NOT EXISTS `admins` (
  `username` varchar(25) NOT NULL,
  `password` varchar(50) NOT NULL,
  PRIMARY KEY  (`username`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `gen_comments`
--

CREATE TABLE IF NOT EXISTS `gen_comments` (
  `id` int(11) NOT NULL auto_increment,
  `name` text NOT NULL,
  `comment` text NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=15 ;

--
-- Dumping data for table `gen_comments`
--


-- --------------------------------------------------------

--
-- Table structure for table `notebook_score`
--

CREATE TABLE IF NOT EXISTS `notebook_score` (
  `pledge_id` int(11) NOT NULL,
  `brother_id` int(11) NOT NULL,
  `score` int(11) NOT NULL,
  PRIMARY KEY  (`pledge_id`,`brother_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `notebook_score`
--

INSERT INTO `notebook_score` (`pledge_id`, `brother_id`, `score`) VALUES
(18, 1, 0),
(18, 2, 0),
(18, 3, 0),
(18, 4, 0),
(18, 5, 0),
(18, 6, 0),
(18, 7, 0),
(18, 8, 0),
(18, 9, 0),
(18, 10, 0),
(18, 11, 0),
(18, 12, 0),
(18, 13, 0),
(18, 14, 0),
(18, 15, 0),
(18, 16, 0),
(18, 17, 0),
(18, 18, 0),
(18, 19, 0),
(18, 20, 0),
(18, 21, 0),
(18, 22, 0);

-- --------------------------------------------------------

--
-- Table structure for table `pledges`
--

CREATE TABLE IF NOT EXISTS `pledges` (
  `id` int(11) NOT NULL auto_increment,
  `name` text NOT NULL,
  `profile` mediumtext NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=19 ;

--
-- Dumping data for table `pledges`
--

INSERT INTO `pledges` (`id`, `name`, `profile`) VALUES
(18, 'Aaron Robinson', '<ul><br />\r\n<li>Kenan Scholar</li><br />\r\n<li>Tuba player (marching band, wind ensemble, tuba quartet)</li><br />\r\n<li>Knows almost all of us</li><br />\r\n<li>We need to pay him NOT to do PMA</li><br />\r\n</ul>');

-- --------------------------------------------------------


Once you have the database set up, you'll need to modify the 'db_conn.php' file in /intranet/common/ to reflect your database 
server and login info.  Once this is done, the system should be 
up and running.
 
You can add Admins to the system via this link: http://www.unc.edu/sinfonia/intranet/common/add-admin.php

You can delete PM's from the system using this link:
http://www.unc.edu/sinfonia/intranet/common/delete-pm.php


Fraternally,
Geoff Mackey - 2G8