-- phpMyAdmin SQL Dump
-- version 4.2.13
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Feb 09, 2015 at 07:04 PM
-- Server version: 5.6.20
-- PHP Version: 5.5.15

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `secondhanded10`
--

-- --------------------------------------------------------

--
-- Table structure for table `comments`
--

CREATE TABLE IF NOT EXISTS `comments` (
`id` int(10) NOT NULL,
  `author_id` int(10) NOT NULL,
  `item_id` int(10) NOT NULL,
  `target_id` int(10) DEFAULT NULL,
  `parent_id` int(10) DEFAULT NULL,
  `body` text NOT NULL,
  `created` datetime NOT NULL,
  `modified` datetime NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `comments`
--

INSERT INTO `comments` (`id`, `author_id`, `item_id`, `target_id`, `parent_id`, `body`, `created`, `modified`) VALUES
(1, 5, 53, NULL, NULL, 'this book sucks\r\n', '2015-02-06 01:09:59', '2015-02-06 01:09:59'),
(2, 4, 53, NULL, NULL, 'why is it blue?', '2015-02-06 01:14:59', '2015-02-06 01:14:59'),
(3, 5, 53, 2, 2, 'this is another comment', '2015-02-06 01:35:03', '2015-02-06 01:35:03'),
(10, 5, 53, 1, 1, 'you suck', '2015-02-09 08:51:51', '2015-02-09 08:51:51');

-- --------------------------------------------------------

--
-- Table structure for table `items`
--

CREATE TABLE IF NOT EXISTS `items` (
`id` int(10) NOT NULL,
  `owner_id` int(10) NOT NULL,
  `title` varchar(50) NOT NULL,
  `description` varchar(600) NOT NULL,
  `price` int(10) NOT NULL,
  `condition` varchar(50) NOT NULL,
  `semester` int(3) NOT NULL,
  `author` varchar(50) NOT NULL,
  `course` varchar(50) NOT NULL,
  `img_url` varchar(255) NOT NULL,
  `created` datetime NOT NULL,
  `modified` datetime NOT NULL,
  `field` varchar(50) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=56 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `items`
--

INSERT INTO `items` (`id`, `owner_id`, `title`, `description`, `price`, `condition`, `semester`, `author`, `course`, `img_url`, `created`, `modified`, `field`) VALUES
(52, 4, 'Learning Python 3rd Edition', 'we used this book a lot', 70, '1', 3, 'Mark Lutz', 'Python Essentials', 'files/learning_python_3rd_edition.png', '2015-02-03 03:54:33', '2015-02-03 03:54:33', '0'),
(53, 4, 'Murach''s Javascript and DOM', 'good book', 50, '0', 1, 'John Fisher', 'Web Programming', 'files/murach''s_js.jpg', '2015-02-03 03:57:10', '2015-02-03 03:57:10', '0'),
(54, 4, 'Programming in Objective C', 'i live close to the school', 100, '2', 5, 'Stephen G. Kochan', 'Mobile Development', 'files/programming_in_objective_c.jpg', '2015-02-03 04:17:32', '2015-02-03 04:17:32', '0'),
(55, 4, 'Pro Java Programming', '', 70, '1', 3, 'Brett Spell', 'Java Programming', 'files/java_programming_.jpg', '2015-02-03 04:20:35', '2015-02-03 04:20:35', '0');

-- --------------------------------------------------------

--
-- Table structure for table `items_users`
--

CREATE TABLE IF NOT EXISTS `items_users` (
`id` int(10) NOT NULL,
  `user_id` int(10) NOT NULL,
  `created` datetime NOT NULL,
  `modified` datetime NOT NULL,
  `item_id` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE IF NOT EXISTS `users` (
`id` int(10) NOT NULL,
  `name` varchar(50) NOT NULL,
  `email` varchar(40) NOT NULL,
  `img` varchar(255) DEFAULT NULL,
  `program_id` int(11) NOT NULL,
  `semester` int(10) NOT NULL,
  `created` datetime NOT NULL,
  `modified` datetime NOT NULL,
  `role` varchar(10) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `img`, `program_id`, `semester`, `created`, `modified`, `role`, `password`) VALUES
(4, 'DirtySanchez', 'a@a.com', 'profile_img/23161b8473d6a6da450c80d335f576cb.jpg', 0, 1, '2015-01-31 21:25:09', '2015-02-09 18:33:06', '', '$2a$10$p.E8BvJwNdtzQU5QjbtGIehzF7w4u0UHvQtCiWM9wZrEvDeo3tolO'),
(5, 'john', '22@ds.ds', NULL, 0, 0, '2015-01-31 23:09:54', '2015-01-31 23:09:54', '', '$2a$10$cOoOtQf9XgPc.vxTm/kHkud6sO.TSSuxF9SRlMRFA69fpclkqpnA2');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `comments`
--
ALTER TABLE `comments`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `items`
--
ALTER TABLE `items`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `items_users`
--
ALTER TABLE `items_users`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
 ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `comments`
--
ALTER TABLE `comments`
MODIFY `id` int(10) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=11;
--
-- AUTO_INCREMENT for table `items`
--
ALTER TABLE `items`
MODIFY `id` int(10) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=56;
--
-- AUTO_INCREMENT for table `items_users`
--
ALTER TABLE `items_users`
MODIFY `id` int(10) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
MODIFY `id` int(10) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=6;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
