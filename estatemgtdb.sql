-- phpMyAdmin SQL Dump
-- version 2.11.6
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Jun 30, 2015 at 10:25 PM
-- Server version: 5.0.51
-- PHP Version: 5.2.6


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `estatemgtdb`
--

-- --------------------------------------------------------

--
-- Table structure for table `building`
--
-- Creation: May 05, 2015 at 06:08 AM
--

CREATE TABLE `building` (
  `Id` int(5) unsigned NOT NULL auto_increment,
  `property_id` varchar(5) NOT NULL,
  `no_of_floors` varchar(5) NOT NULL,
  `building_description` varchar(50) NOT NULL,
  `property_group` varchar(50) NOT NULL,
  `property_type` varchar(50) NOT NULL,
  `assessment_value` varchar(18) NOT NULL,
  `primary key` set('Id') NOT NULL,
  PRIMARY KEY  (`Id`)
) TYPE=InnoDB  AUTO_INCREMENT=8 ;

--
-- Dumping data for table `building`
--

INSERT INTO `building` (`Id`, `property_id`, `no_of_floors`, `building_description`, `property_group`, `property_type`, `assessment_value`, `primary key`) VALUES
(1, '001', '3', 'detached burgalow', 'burgalow', 'Private', 'Good', ''),
(2, '002', '2', 'Terraced Bungalow', 'burgalow', 'Public', 'Good condition', ''),
(3, '003', '1', 'semi-detached bugalow', 'burgalow', 'Commercial', 'Requires maintenan', ''),
(4, '004', '2', 'detached duplex', 'Duplex', 'Private', 'Not Hospitable', ''),
(5, '005', '1', 'Terraced Bungalow', 'burgalow', 'Commercial', 'Good condition', ''),
(6, '6', '2', 'burgalow', 'semi-burgalow', 'commercial', 'good', ''),
(7, '6', '2', 'burgalow', 'semi-burgalow', 'commercial', 'good', '');

-- --------------------------------------------------------

--
-- Table structure for table `building_charge`
--
-- Creation: May 05, 2015 at 06:14 AM
--

CREATE TABLE `building_charge` (
  `id` int(5) unsigned NOT NULL auto_increment,
  `property_id` varchar(5) NOT NULL,
  `cost` int(18) NOT NULL,
  `primary key` set('id') NOT NULL,
  PRIMARY KEY  (`id`)
) TYPE=InnoDB  AUTO_INCREMENT=18 ;

--
-- Dumping data for table `building_charge`
--

INSERT INTO `building_charge` (`id`, `property_id`, `cost`, `primary key`) VALUES
(1, '001', 500, ''),
(2, '002', 1, ''),
(3, '003', 3, ''),
(4, '004', 4, ''),
(5, '005', 4, ''),
(6, '006', 6, ''),
(7, '007', 6, ''),
(8, '008', 450, ''),
(10, '010', 250, ''),
(11, '3', 3000, ''),
(12, '004', 40000, ''),
(13, '4', 4, ''),
(14, '5', 6, ''),
(15, '6', 0, ''),
(16, '5', 6, ''),
(17, '8', 5, '');

-- --------------------------------------------------------

--
-- Table structure for table `building_charge_rate`
--
-- Creation: May 05, 2015 at 06:12 AM
--

CREATE TABLE `building_charge_rate` (
  `id` int(5) unsigned NOT NULL auto_increment,
  `location` varchar(5) NOT NULL,
  `property_group` varchar(50) NOT NULL,
  `property_type` varchar(50) NOT NULL,
  `primary key` set('id') NOT NULL,
  PRIMARY KEY  (`id`)
) TYPE=InnoDB  AUTO_INCREMENT=6 ;

--
-- Dumping data for table `building_charge_rate`
--

INSERT INTO `building_charge_rate` (`id`, `location`, `property_group`, `property_type`, `primary key`) VALUES
(1, 'Port ', 'Duplex', 'Private', ''),
(2, 'Lagos', 'bugalow', 'commercial', ''),
(3, 'Onits', 'Duplex', 'Private', ''),
(4, 'Awka,', 'burgalow', 'Commercial', ''),
(5, 'Abuja', 'Duplex', 'Private', '');

-- --------------------------------------------------------

--
-- Table structure for table `customer`
--
-- Creation: Jun 14, 2015 at 10:24 PM
--

CREATE TABLE `customer` (
  `id` int(10) unsigned NOT NULL auto_increment,
  `Sname` varchar(20) NOT NULL,
  `Fname` varchar(20) NOT NULL,
  `Mname` varchar(20) NOT NULL,
  `Gender` varchar(10) NOT NULL,
  `Mstatus` varchar(10) NOT NULL,
  `DOB` date NOT NULL,
  `Phone` varchar(20) NOT NULL,
  `Email` varchar(20) NOT NULL,
  `Address` varchar(50) NOT NULL,
  PRIMARY KEY  (`id`)
) TYPE=InnoDB  AUTO_INCREMENT=6 ;

--
-- Dumping data for table `customer`
--

INSERT INTO `customer` (`id`, `Sname`, `Fname`, `Mname`, `Gender`, `Mstatus`, `DOB`, `Phone`, `Email`, `Address`) VALUES
(1, 'oriaku', 'jerry', 'chidera', 'male', 'single', '1985-05-07', '08037903837', 'jerry@gmail.com', 'nnewi'),
(2, 'Nweke', 'Obinna', 'Alex', 'Male', 'Single', '1988-06-23', '08034596784', 'obinna.nweke@yahoo.c', 'No3 Nibo awka'),
(3, 'Onyiwu', 'Uche', 'Henry', 'Male', 'Married', '1980-01-30', '08066578764', 'uche.onyiwu@gmail.co', 'Maryland, Enugu State'),
(4, 'Abana', '-', 'Moses', 'Male', 'Married', '1979-03-27', '08035005178', 'mabana@ecobank.com', 'abagana awka, Anambra state'),
(5, 'Okeke', 'Clara', 'Ifemelumma', 'Female', 'Single', '1991-05-22', '08134575867', 'clarepet@gmail.com', 'Morroco house nnaemeka, awka');

-- --------------------------------------------------------

--
-- Table structure for table `land_charge_rate`
--
-- Creation: May 05, 2015 at 06:11 AM
--

CREATE TABLE `land_charge_rate` (
  `id` int(5) NOT NULL auto_increment,
  `location` varchar(5) NOT NULL,
  `cost_per_metre` int(5) NOT NULL,
  `rate` int(5) NOT NULL,
  PRIMARY KEY  (`id`)
) TYPE=InnoDB  AUTO_INCREMENT=4 ;

--
-- Dumping data for table `land_charge_rate`
--

INSERT INTO `land_charge_rate` (`id`, `location`, `cost_per_metre`, `rate`) VALUES
(1, 'Aba', 30, 700),
(2, 'Awka,', 50, 1),
(3, 'owerr', 60, 1);

-- --------------------------------------------------------

--
-- Table structure for table `location`
--
-- Creation: May 04, 2015 at 12:20 AM
--

CREATE TABLE `location` (
  `Id` int(52) unsigned NOT NULL auto_increment,
  `Name` varchar(50) NOT NULL,
  `LGA` varchar(50) NOT NULL,
  `State` varchar(50) NOT NULL,
  `primary key` set('Id') NOT NULL,
  PRIMARY KEY  (`Id`)
) TYPE=InnoDB  AUTO_INCREMENT=10 ;

--
-- Dumping data for table `location`
--

INSERT INTO `location` (`Id`, `Name`, `LGA`, `State`, `primary key`) VALUES
(1, 'Obinna Nweke', 'Awka south', 'Anambra', ''),
(2, 'Moses Asogwa', 'Udi ', 'Enugu State', ''),
(3, 'obinna', 'awka', 'anambra', ''),
(4, 'ada', 'awka south', 'anambra', ''),
(5, 'david', 'udi', 'enugu', ''),
(6, 'james', 'udi', 'enugu', ''),
(7, 'obinna', 'udi', 'enugu', ''),
(8, 'jerry', 'awka south', 'anambra', ''),
(9, 'okey', 'udi', 'enugu', '');

-- --------------------------------------------------------

--
-- Table structure for table `properties`
--
-- Creation: May 05, 2015 at 05:54 AM
--

CREATE TABLE `properties` (
  `Id` int(11) unsigned NOT NULL auto_increment,
  `Land_size` text NOT NULL,
  `No_of_building` text NOT NULL,
  `location` text NOT NULL,
  `owner` text NOT NULL,
  `primary key` set('Id') NOT NULL,
  PRIMARY KEY  (`Id`)
) TYPE=InnoDB  AUTO_INCREMENT=5 ;

--
-- Dumping data for table `properties`
--

INSERT INTO `properties` (`Id`, `Land_size`, `No_of_building`, `location`, `owner`, `primary key`) VALUES
(1, '60 yards', '3', 'Awka', 'Obinna Nweke', ''),
(2, '60 yards', '2', 'Awka', 'James Akitola', ''),
(3, '30', '3', 'awka', 'jerry oriaku', ''),
(4, '50 hectares', '4', 'awka', 'ben', '');

-- --------------------------------------------------------

--
-- Table structure for table `register`
--
-- Creation: Jun 06, 2015 at 02:23 PM
--

CREATE TABLE `register` (
  `id` int(10) unsigned NOT NULL auto_increment,
  `username` varchar(20) NOT NULL,
  `password` varchar(20) NOT NULL,
  `email` varchar(20) NOT NULL,
  `primary key` set('id') default NULL,
  PRIMARY KEY  (`id`),
  KEY `primary key` (`primary key`)
) TYPE=InnoDB  AUTO_INCREMENT=3 ;

--
-- Dumping data for table `register`
--

INSERT INTO `register` (`id`, `username`, `password`, `email`, `primary key`) VALUES
(1, 'jamike', 'ecobank7', 'jamiefule@ecobank.co', ''),
(2, 'peace', 'okoani', 'peace.okoani@gmail.c', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--
-- Creation: Jun 06, 2015 at 12:10 PM
--

CREATE TABLE `users` (
  `id` int(20) NOT NULL auto_increment,
  `primary key` set('id') NOT NULL,
  `username` varchar(20) NOT NULL,
  `password` varchar(20) NOT NULL,
  `Access` varchar(20) NOT NULL default '"visitor"',
  PRIMARY KEY  (`id`),
  KEY `primary key` (`primary key`)
) TYPE=InnoDB  AUTO_INCREMENT=14 ;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `primary key`, `username`, `password`, `Access`) VALUES
(1, '', 'obinna', 'nweke11', '"visitor"'),
(2, '', 'uche', 'henry2015', '"visitor"'),
(3, '', 'moses', 'abana7', '"visitor"'),
(4, '', 'clara', 'okeke7', '"visitor"'),
(5, '', 'David', 'JOan2014', '"admin"'),
(6, '', 'Micheal', 'catherine2015', '"admin"'),
(7, '', 'Eze', 'chidiebere', '"visitor"'),
(8, '', 'David', 'Joan', '"visitor"'),
(9, '', 'Ada', 'adiole', '"visitor"'),
(10, '', 'Damian', 'updiron', '"visitor"'),
(11, '', 'clara', 'okeke', '"visitor"'),
(12, '', 'moses', 'abana', '"visitor"'),
(13, '', 'precious', 'itodo', '"visitor"');
