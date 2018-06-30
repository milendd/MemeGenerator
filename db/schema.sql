-- phpMyAdmin SQL Dump
-- version 4.7.7
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 30, 2018 at 08:17 PM
-- Server version: 10.1.30-MariaDB
-- PHP Version: 7.2.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `meme_system`
--
CREATE DATABASE IF NOT EXISTS `meme_system` DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci;
USE `meme_system`;

-- --------------------------------------------------------

--
-- Table structure for table `comments`
--

DROP TABLE IF EXISTS `comments`;
CREATE TABLE IF NOT EXISTS `comments` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `comment` varchar(1000) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `meme_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_comments_memes_idx` (`meme_id`),
  KEY `fk_comments_users_idx` (`user_id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `comments`
--

INSERT INTO `comments` (`id`, `comment`, `created_at`, `meme_id`, `user_id`) VALUES
(1, 'Looks good', '2018-06-30 12:04:12', 4, 3),
(2, 'The next is comming too.', '2018-06-30 12:04:38', 4, 1);

-- --------------------------------------------------------

--
-- Table structure for table `memes`
--

DROP TABLE IF EXISTS `memes`;
CREATE TABLE IF NOT EXISTS `memes` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `file_name` varchar(200) NOT NULL,
  `title` varchar(500) NOT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `user_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_memes_users_idx` (`user_id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `memes`
--

INSERT INTO `memes` (`id`, `file_name`, `title`, `created_at`, `user_id`) VALUES
(1, '2byhpu7f.jpg', 'First meme :)', '2018-06-26 18:33:21', 1),
(2, '1f764fb0.jpg', 'Just engineering', '2018-06-27 19:03:25', 3),
(3, 'd93ksQ9f.jpg', 'Every time you are trying to get the bus', '2018-06-27 19:05:03', 3),
(4, 'gv0q2Bq9.png', 'When you have been coding for too long', '2018-06-27 19:06:56', 1);

-- --------------------------------------------------------

--
-- Table structure for table `templates`
--

DROP TABLE IF EXISTS `templates`;
CREATE TABLE IF NOT EXISTS `templates` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(200) NOT NULL,
  `file_name` varchar(200) NOT NULL,
  `positions` varchar(1000) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `templates`
--

INSERT INTO `templates` (`id`, `name`, `file_name`, `positions`) VALUES
(1, 'Distracted Boyfriend', '1.png', '{\"data\":[{\"text\":\"top text\",\"x\":400,\"y\":300},{\"text\":\"bottom text\",\"x\":300,\"y\":300},{\"text\":\"more text\",\"x\":400,\"y\":400}]}'),
(2, 'Two Buttons', '2.png', NULL),
(3, 'Expanding Brain', '3.png', NULL),
(4, 'Mocking Spongebob', '4.png', NULL),
(5, 'Batman Slapping Robin', '5.png', NULL),
(6, 'Roll Safe Think About It', '6.png', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(200) NOT NULL,
  `pass_hash` varchar(200) NOT NULL,
  `email` varchar(200) NOT NULL,
  `is_admin` bit(1) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `id` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `pass_hash`, `email`, `is_admin`) VALUES
(1, 'milen_d', '$2y$10$dPGVMfTYS278qbwHqWpcy.D2eJnNQzsyqZHdykKqN5Oc1JXKw4ZGC', 'milen_d@test.bg', b'1'),
(3, 'hristo', '$2y$10$EMhf05V6pKU7uUDLXecehOLkh9WAuyoS20mYXV4ekopoFiSnYog.a', 'hristo@test.bg', b'0');

--
-- Structure for view `v_memes`
--

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `v_memes`  AS  select `m`.`id` AS `meme_id`,`m`.`file_name` AS `file_name`,`m`.`title` AS `title`,`m`.`created_at` AS `created_at`,`u`.`id` AS `user_id`,`u`.`username` AS `username` from (`memes` `m` join `users` `u` on((`m`.`user_id` = `u`.`id`))) order by `m`.`id` desc ;

--
-- Structure for view `v_comments`
--

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `v_comments`  AS  select `c`.`id` AS `id`,`c`.`comment` AS `comment`,`c`.`created_at` AS `created_at`,`c`.`meme_id` AS `meme_id`,`c`.`user_id` AS `user_id`,`u`.`username` AS `username` from (`comments` `c` join `users` `u` on((`c`.`user_id` = `u`.`id`))) ;

COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
