-- phpMyAdmin SQL Dump
-- version 4.2.11
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Jul 14, 2016 at 12:13 PM
-- Server version: 5.6.21
-- PHP Version: 5.6.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `mailpig`
--

-- --------------------------------------------------------

--
-- Table structure for table `events`
--

CREATE TABLE IF NOT EXISTS `events` (
`id` int(11) unsigned NOT NULL,
  `title` varchar(60) NOT NULL,
  `type` varchar(50) NOT NULL,
  `date_from` varchar(30) NOT NULL,
  `date_to` varchar(30) NOT NULL,
  `detail_id` int(11) NOT NULL,
  `email_id` int(11) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `events`
--

INSERT INTO `events` (`id`, `title`, `type`, `date_from`, `date_to`, `detail_id`, `email_id`) VALUES
(7, 'Test', '', '07/20/2016 9:35 am', '12/03/2012 12:00 PM', 0, 0),
(8, 'Test', '', '07/22/2016 12:00 am', '07/29/2016 12:00 am', 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `formulars`
--

CREATE TABLE IF NOT EXISTS `formulars` (
`id` int(10) unsigned NOT NULL,
  `title` varchar(80) NOT NULL,
  `user_id` int(11) NOT NULL,
  `event_id` int(11) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `formulars`
--

INSERT INTO `formulars` (`id`, `title`, `user_id`, `event_id`) VALUES
(1, 'Test-Formular', 1, 2);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE IF NOT EXISTS `users` (
`id` int(11) unsigned NOT NULL,
  `username` varchar(50) NOT NULL,
  `email` varchar(80) NOT NULL,
  `password` varchar(80) NOT NULL,
  `usergroup` int(11) NOT NULL,
  `data` text NOT NULL,
  `created_at` int(11) NOT NULL,
  `hash` varchar(50) NOT NULL,
  `is_active` int(11) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `email`, `password`, `usergroup`, `data`, `created_at`, `hash`, `is_active`) VALUES
(1, 'florian', 'florian-bader@gmx.at', '7696f77acb71b55d282f8e673ed3bd06b8b7b720:1695', 1, '{"vname":"Florian","nname":"Bader","country":"0"}', 1468395961, '5785f1b96a81e', 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `events`
--
ALTER TABLE `events`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `formulars`
--
ALTER TABLE `formulars`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
 ADD PRIMARY KEY (`id`), ADD UNIQUE KEY `username` (`username`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `events`
--
ALTER TABLE `events`
MODIFY `id` int(11) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=9;
--
-- AUTO_INCREMENT for table `formulars`
--
ALTER TABLE `formulars`
MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
MODIFY `id` int(11) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
