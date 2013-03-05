-- phpMyAdmin SQL Dump
-- version 3.4.11.1deb1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Mar 05, 2013 at 11:25 AM
-- Server version: 5.5.29
-- PHP Version: 5.4.6-1ubuntu1.1

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `report`
--
CREATE DATABASE `report` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci;
USE `report`;

-- --------------------------------------------------------

--
-- Table structure for table `authassignment`
--

CREATE TABLE IF NOT EXISTS `authassignment` (
  `itemname` varchar(64) NOT NULL,
  `userid` varchar(64) NOT NULL,
  `bizrule` text,
  `data` text,
  PRIMARY KEY (`itemname`,`userid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `authassignment`
--

INSERT INTO `authassignment` (`itemname`, `userid`, `bizrule`, `data`) VALUES
('Admin', '1', NULL, 'N;');

-- --------------------------------------------------------

--
-- Table structure for table `authitem`
--

CREATE TABLE IF NOT EXISTS `authitem` (
  `name` varchar(64) NOT NULL,
  `type` int(11) NOT NULL,
  `description` text,
  `bizrule` text,
  `data` text,
  PRIMARY KEY (`name`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `authitem`
--

INSERT INTO `authitem` (`name`, `type`, `description`, `bizrule`, `data`) VALUES
('Admin', 2, NULL, NULL, 'N;');

-- --------------------------------------------------------

--
-- Table structure for table `authitemchild`
--

CREATE TABLE IF NOT EXISTS `authitemchild` (
  `parent` varchar(64) NOT NULL,
  `child` varchar(64) NOT NULL,
  PRIMARY KEY (`parent`,`child`),
  KEY `child` (`child`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `bentuk`
--

CREATE TABLE IF NOT EXISTS `bentuk` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) DEFAULT NULL,
  `created` datetime DEFAULT NULL,
  `updated` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `bentuk`
--

INSERT INTO `bentuk` (`id`, `name`, `created`, `updated`) VALUES
(1, 'Tabel', '2013-01-14 13:20:38', '2013-03-04 12:36:37'),
(2, 'Grafik', '2013-01-14 13:20:44', '2013-03-04 12:36:54'),
(3, 'Bentuk 3', '2013-01-14 13:20:54', '2013-01-14 13:20:54');

-- --------------------------------------------------------

--
-- Table structure for table `data_source`
--

CREATE TABLE IF NOT EXISTS `data_source` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `host` varchar(255) DEFAULT NULL,
  `port` int(4) DEFAULT NULL,
  `dbname` varchar(45) DEFAULT NULL,
  `username` varchar(45) DEFAULT NULL,
  `password` varchar(45) DEFAULT NULL,
  `created` datetime DEFAULT NULL,
  `updated` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=6 ;

--
-- Dumping data for table `data_source`
--

INSERT INTO `data_source` (`id`, `host`, `port`, `dbname`, `username`, `password`, `created`, `updated`) VALUES
(1, 'localhost', 3336, 'report', 'root', 'root123', '2013-01-14 13:19:51', '2013-01-14 15:00:11'),
(4, 'localhost', 3336, 'hrd', 'root', 'root123', '2013-01-14 15:01:54', '2013-01-14 15:02:21'),
(5, 'localhost', 3336, 'silelang', 'root', 'root123', '2013-01-21 12:29:30', '2013-01-21 12:29:30');

-- --------------------------------------------------------

--
-- Table structure for table `ex_fruit`
--

CREATE TABLE IF NOT EXISTS `ex_fruit` (
  `name` varchar(255) NOT NULL,
  `stock` int(11) NOT NULL,
  `order` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `ex_fruit`
--

INSERT INTO `ex_fruit` (`name`, `stock`, `order`) VALUES
('Apel', 30, 25),
('Jeruk', 25, 30),
('Melon', 60, 12),
('Semangka', 80, 67),
('Mangga', 70, 32),
('Jambu', 90, 80);

-- --------------------------------------------------------

--
-- Table structure for table `kpi`
--

CREATE TABLE IF NOT EXISTS `kpi` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) DEFAULT NULL,
  `query` text,
  `advice` text COMMENT '	',
  `target` int(11) NOT NULL,
  `created` datetime DEFAULT NULL,
  `updated` datetime DEFAULT NULL,
  `user_id` int(11) NOT NULL,
  `data_source_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_kpi_user1` (`user_id`),
  KEY `fk_kpi_data_source1` (`data_source_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `kpi`
--

INSERT INTO `kpi` (`id`, `name`, `query`, `advice`, `target`, `created`, `updated`, `user_id`, `data_source_id`) VALUES
(1, 'kpi 1', 'SELECT COUNT(ex_fruit.`order`) AS jumlah\r\nFROM \r\n	ex_fruit\r\n', 'kpi 1 advice', 0, '2013-01-14 13:26:16', '2013-03-04 15:31:34', 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `report`
--

CREATE TABLE IF NOT EXISTS `report` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) DEFAULT NULL,
  `description` text,
  `query` text,
  `created` datetime DEFAULT NULL,
  `updated` datetime DEFAULT NULL,
  `bentuk_id` int(11) NOT NULL,
  `data_source_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_report_bentuk1` (`bentuk_id`),
  KEY `fk_report_data_source1` (`data_source_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

--
-- Dumping data for table `report`
--

INSERT INTO `report` (`id`, `name`, `description`, `query`, `created`, `updated`, `bentuk_id`, `data_source_id`) VALUES
(3, 'Testing Report', 'testing report', 'SELECT \r\n	bentuk.`name` AS bentuk_name,\r\n	data_source.`host` AS data_source_host,\r\n	data_source.`port` AS data_source_port,\r\n	data_source.`dbname` AS data_source_dbname,\r\n	data_source.`username` AS data_source_username,\r\n	data_source.`password` AS data_source_password,\r\n	report.`name` AS report_name\r\nFROM \r\n	bentuk,\r\n	data_source,\r\n	report\r\n', '2013-02-12 12:06:23', '2013-02-12 12:06:38', 1, 1),
(4, 'Testing gan', 'rwerwerwere', 'SELECT \r\n	ex_fruit.`name` AS ex_fruit_name,\r\n	ex_fruit.`stock` AS ex_fruit_stock,\r\n	ex_fruit.`order` AS ex_fruit_order\r\nFROM \r\n	ex_fruit\r\n', '2013-02-14 14:52:32', '2013-03-04 13:39:29', 2, 1);

-- --------------------------------------------------------

--
-- Table structure for table `rights`
--

CREATE TABLE IF NOT EXISTS `rights` (
  `itemname` varchar(64) NOT NULL,
  `type` int(11) NOT NULL,
  `weight` int(11) DEFAULT NULL,
  PRIMARY KEY (`itemname`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE IF NOT EXISTS `user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(20) NOT NULL,
  `password` varchar(128) NOT NULL,
  `email` varchar(128) NOT NULL,
  `activkey` varchar(128) NOT NULL DEFAULT '',
  `lastvisit` datetime NOT NULL,
  `superuser` int(1) NOT NULL DEFAULT '0',
  `status` int(1) NOT NULL DEFAULT '0',
  `created` datetime DEFAULT NULL,
  `updated` datetime DEFAULT NULL,
  `report_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `username` (`username`),
  UNIQUE KEY `email` (`email`),
  KEY `status` (`status`),
  KEY `superuser` (`superuser`),
  KEY `fk_user_report1` (`report_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `username`, `password`, `email`, `activkey`, `lastvisit`, `superuser`, `status`, `created`, `updated`, `report_id`) VALUES
(1, 'admin', 'd033e22ae348aeb5660fc2140aec35850c4da997', 'admin@hrd.com', 'ff6be47d3b1e454053c340bd2eacec90', '0000-00-00 00:00:00', 1, 1, '2012-11-30 13:45:00', '2012-11-30 14:04:59', NULL);

--
-- Constraints for dumped tables
--

--
-- Constraints for table `authassignment`
--
ALTER TABLE `authassignment`
  ADD CONSTRAINT `authassignment_ibfk_1` FOREIGN KEY (`itemname`) REFERENCES `authitem` (`name`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `kpi`
--
ALTER TABLE `kpi`
  ADD CONSTRAINT `fk_kpi_data_source1` FOREIGN KEY (`data_source_id`) REFERENCES `data_source` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_kpi_user1` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `report`
--
ALTER TABLE `report`
  ADD CONSTRAINT `fk_report_bentuk1` FOREIGN KEY (`bentuk_id`) REFERENCES `bentuk` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_report_data_source1` FOREIGN KEY (`data_source_id`) REFERENCES `data_source` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `user`
--
ALTER TABLE `user`
  ADD CONSTRAINT `fk_user_report1` FOREIGN KEY (`report_id`) REFERENCES `report` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
