-- phpMyAdmin SQL Dump
-- version 4.7.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 01, 2019 at 04:08 AM
-- Server version: 5.7.17
-- PHP Version: 5.6.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `forumdb`
--

-- --------------------------------------------------------

--
-- Table structure for table `authetication`
--

CREATE TABLE `authetication` (
  `id` int(11) NOT NULL,
  `username` varchar(25) NOT NULL,
  `email` varchar(150) NOT NULL,
  `password` varchar(60) NOT NULL,
  `firstName` varchar(50) DEFAULT NULL,
  `lastName` varchar(50) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `authetication`
--

INSERT INTO `authetication` (`id`, `username`, `email`, `password`, `firstName`, `lastName`) VALUES
(1, 'StrategistN8', 'lyons@mail.nmc.edu', 'pandy', 'Jim', 'Lyons'),
(2, 'RockCrunchersTeam', 'RockCrunchers@This.com', 'rct', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `auth_users`
--

CREATE TABLE `auth_users` (
  `id` int(11) NOT NULL,
  `authorizedId` int(11) NOT NULL,
  `f_name` varchar(50) DEFAULT NULL,
  `l_name` varchar(50) DEFAULT NULL,
  `email` varchar(150) DEFAULT NULL,
  `username` varchar(25) DEFAULT NULL,
  `password` varchar(41) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `moderators`
--

CREATE TABLE `moderators` (
  `id` int(11) NOT NULL,
  `email` varchar(150) NOT NULL,
  `username` varchar(25) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `posts`
--

CREATE TABLE `posts` (
  `post_id` int(11) NOT NULL,
  `topic_id` int(11) NOT NULL,
  `content` text,
  `date_posted` datetime DEFAULT NULL,
  `owner` varchar(150) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `posts`
--

INSERT INTO `posts` (`post_id`, `topic_id`, `content`, `date_posted`, `owner`) VALUES
(8, 9, 'Post feedback for Game 3 here.', '2019-04-24 14:11:56', 'RockCrunchers@This.com'),
(9, 9, 'Patch Notes:  \r\n- Added worker robot obstacles.\r\n- Added \"Phase Orb\" powerup object which removes obstacles on contact.', '2019-04-24 14:14:02', 'RockCrunchers@This.com'),
(7, 8, 'Post feedback for Game 2 here.', '2019-04-24 14:11:33', 'RockCrunchers@This.com'),
(6, 7, 'Post feedback for game one here.  ', '2019-04-24 14:11:05', 'RockCrunchers@This.com'),
(10, 8, 'Need to change out either the blue rocks or gray rocks, as they look too much alike. Otherwise nice job!', '2019-04-24 14:34:55', 'me@m3mail.com'),
(11, 10, 'Testing the database (delete after test)', '2019-04-24 14:36:05', 'me@m3mail.com'),
(12, 11, 'Test', '2019-04-30 17:16:48', 'me@m3mail.com'),
(13, 11, 'Testing Delete Functions', '2019-04-30 18:17:22', 'me@m3mail.com');

-- --------------------------------------------------------

--
-- Table structure for table `topics`
--

CREATE TABLE `topics` (
  `topic_id` int(11) NOT NULL,
  `title` varchar(100) DEFAULT NULL,
  `date_posted` datetime DEFAULT NULL,
  `owner` varchar(150) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `topics`
--

INSERT INTO `topics` (`topic_id`, `title`, `date_posted`, `owner`) VALUES
(9, 'Game 3: Deep Core', '2019-04-24 14:11:56', 'RockCrunchers@This.com'),
(8, 'Game 2: Processing', '2019-04-24 14:11:33', 'RockCrunchers@This.com'),
(7, 'Game 1: Robot Bay', '2019-04-24 14:11:05', 'RockCrunchers@This.com'),
(10, 'Testing', '2019-04-24 14:36:05', 'me@m3mail.com'),
(11, 'Edit Testing 2', '2019-04-30 17:16:48', 'me@m3mail.com');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `authetication`
--
ALTER TABLE `authetication`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `auth_users`
--
ALTER TABLE `auth_users`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `moderators`
--
ALTER TABLE `moderators`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`),
  ADD KEY `fk_name` (`username`);

--
-- Indexes for table `posts`
--
ALTER TABLE `posts`
  ADD PRIMARY KEY (`post_id`),
  ADD KEY `topic_id` (`topic_id`);

--
-- Indexes for table `topics`
--
ALTER TABLE `topics`
  ADD PRIMARY KEY (`topic_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `authetication`
--
ALTER TABLE `authetication`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `moderators`
--
ALTER TABLE `moderators`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `posts`
--
ALTER TABLE `posts`
  MODIFY `post_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;
--
-- AUTO_INCREMENT for table `topics`
--
ALTER TABLE `topics`
  MODIFY `topic_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
