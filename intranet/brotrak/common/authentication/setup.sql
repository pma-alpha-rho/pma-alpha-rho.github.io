-- phpMyAdmin SQL Dump
-- version 2.7.0-pl2
-- http://www.phpmyadmin.net
-- 
-- Host: localhost
-- Generation Time: Feb 23, 2010 at 01:30 PM
-- Server version: 5.0.18
-- PHP Version: 5.1.2
-- 
-- Database: `brotrak`
-- 

-- --------------------------------------------------------

-- 
-- Table structure for table `events`
-- 

CREATE TABLE `events` (
  `event_id` int(11) NOT NULL auto_increment,
  `event_name` text NOT NULL,
  `date` date NOT NULL,
  `start_time` time NOT NULL,
  `end_time` time NOT NULL,
  `desc` text NOT NULL,
  PRIMARY KEY  (`event_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=29 ;

-- 
-- Dumping data for table `events`
-- 


-- --------------------------------------------------------

-- 
-- Table structure for table `opportunities`
-- 

CREATE TABLE `opportunities` (
  `opp_id` int(11) NOT NULL auto_increment,
  `event_id` int(11) NOT NULL,
  `title` text NOT NULL,
  `start_time` time NOT NULL,
  `end_time` time NOT NULL,
  `value` int(11) NOT NULL,
  `desc` text NOT NULL,
  `slots` int(11) NOT NULL,
  PRIMARY KEY  (`opp_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=12 ;

-- 
-- Dumping data for table `opportunities`
-- 


-- --------------------------------------------------------

-- 
-- Table structure for table `registration`
-- 

CREATE TABLE `registration` (
  `user_id` int(11) NOT NULL,
  `opp_id` int(11) NOT NULL,
  `approved` tinyint(1) NOT NULL default '0',
  PRIMARY KEY  (`user_id`,`opp_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- 
-- Dumping data for table `registration`
-- 


-- --------------------------------------------------------

-- 
-- Table structure for table `settings`
-- 

CREATE TABLE `settings` (
  `points_on` tinyint(4) NOT NULL,
  `system_name` text NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- 
-- Dumping data for table `settings`
-- 

INSERT INTO `settings` VALUES (1, 'BroTrak');

-- --------------------------------------------------------

-- 
-- Table structure for table `users`
-- 

CREATE TABLE `users` (
  `user_id` int(11) NOT NULL auto_increment,
  `name` text NOT NULL,
  `password` text NOT NULL,
  `admin` tinyint(1) NOT NULL,
  PRIMARY KEY  (`user_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=7 ;

-- 
-- Dumping data for table `users`
-- 

