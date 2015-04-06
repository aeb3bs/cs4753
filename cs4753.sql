-- phpMyAdmin SQL Dump
-- version 4.0.4
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Apr 04, 2015 at 09:34 PM
-- Server version: 5.5.32
-- PHP Version: 5.4.16

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `cs4753`
--
CREATE DATABASE IF NOT EXISTS `cs4753` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci;
USE `cs4753`;

-- --------------------------------------------------------

--
-- Table structure for table `needs`
--

CREATE TABLE IF NOT EXISTS `needs` (
  `user_id` int(11) NOT NULL,
  `task_id` int(11) NOT NULL,
  KEY `user_id` (`user_id`),
  KEY `task_id` (`task_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `needs`
--

INSERT INTO `needs` (`user_id`, `task_id`) VALUES
(1, 11),
(1, 8),
(7, 9),
(7, 10);

-- --------------------------------------------------------

--
-- Table structure for table `tasks`
--

CREATE TABLE IF NOT EXISTS `tasks` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `description` text NOT NULL,
  `lat` int(11) DEFAULT NULL,
  `lon` int(11) DEFAULT NULL,
  `address` varchar(100) NOT NULL,
  `pay` double NOT NULL,
  `date` datetime NOT NULL,
  `title` varchar(100) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=13 ;

--
-- Dumping data for table `tasks`
--

INSERT INTO `tasks` (`id`, `description`, `lat`, `lon`, `address`, `pay`, `date`, `title`) VALUES
(8, 'I need somebody to clean my apartment.', NULL, NULL, '1815 Jefferson Park Avenue Apartment #15 Charlottesville VA', 50.75, '2015-05-20 17:00:00', 'Clean Apartment'),
(9, 'Need somebody to build me a website This needs to be done by June 10th, 2015. This website needs to be able to allow users to post tasks, and allow users to respond to these tasks. Feel free to contact me by email or by cell at 5712947610.', NULL, NULL, 'n/a', 500, '2015-06-10 15:00:00', 'Need Programmer'),
(10, 'I need groceries. Heres the list milk eggs pizza hot pockets peanut butter bread', NULL, NULL, '10802 Windcloud Court Oakton VA 22124', 20, '2015-04-20 13:00:00', 'Groceries'),
(11, 'I need a ride to Northern Virginia. Willing to chip in $10 for gas.', NULL, NULL, 'Observatory Hill', 10, '2015-05-04 17:00:00', 'Need a ride to NOVA.');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `id` int(8) NOT NULL AUTO_INCREMENT,
  `username` varchar(50) NOT NULL,
  `password` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `first_name` varchar(50) NOT NULL,
  `last_name` varchar(50) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=8 ;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `password`, `email`, `first_name`, `last_name`) VALUES
(1, 'aeb3bs', '*2470C0C06DEE42FD1618BB99005ADCA2EC9D1E19', 'aeb3bs@gmail.com', 'Albert', 'Borges'),
(7, 'connor', '*2470C0C06DEE42FD1618BB99005ADCA2EC9D1E19', 'connor@gmail.com', 'Connor', 'Anderson');

-- --------------------------------------------------------

--
-- Table structure for table `works`
--

CREATE TABLE IF NOT EXISTS `works` (
  `user_id` int(11) NOT NULL,
  `task_id` int(11) NOT NULL,
  KEY `user_id` (`user_id`),
  KEY `task_id` (`task_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `needs`
--
ALTER TABLE `needs`
  ADD CONSTRAINT `needs_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `needs_ibfk_2` FOREIGN KEY (`task_id`) REFERENCES `tasks` (`id`);

--
-- Constraints for table `works`
--
ALTER TABLE `works`
  ADD CONSTRAINT `works_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `works_ibfk_2` FOREIGN KEY (`task_id`) REFERENCES `tasks` (`id`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
