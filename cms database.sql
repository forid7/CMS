-- phpMyAdmin SQL Dump
-- version 5.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 31, 2020 at 05:19 PM
-- Server version: 10.4.11-MariaDB
-- PHP Version: 7.4.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `cms`
--

-- --------------------------------------------------------

--
-- Table structure for table `admins`
--

CREATE TABLE `admins` (
  `id` int(10) NOT NULL,
  `datetime` varchar(50) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(60) NOT NULL,
  `aname` varchar(30) NOT NULL,
  `aheadline` varchar(30) NOT NULL,
  `abio` varchar(500) NOT NULL,
  `aimage` varchar(60) NOT NULL DEFAULT 'avatar.png',
  `addedby` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `admins`
--

INSERT INTO `admins` (`id`, `datetime`, `username`, `password`, `aname`, `aheadline`, `abio`, `aimage`, `addedby`) VALUES
(1, 'May-13-2020 21:38:23', 'kamrul', '123456', 'Jack Noel', 'Freelancer, Content Writer', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Morbi congue iaculis risus, a rutrum nulla suscipit posuere. Praesent metus turpis, lacinia in erat tristique, vehicula vulputate urna. Sed eget vehicula justo. Nulla sed nulla vitae massa tristique semper quis eu magna. Maecenas semper aliquam purus, quis ultricies orci pulvinar et. Mauris luctus malesuada nisl a mattis.', 'veloceroptor.jpg', 'Forid'),
(3, 'May-19-2020 16:50:22', 'abdul', '1234', 'ali', '', '', '', 'rahman'),
(4, 'May-29-2020 17:03:24', 'moris', '4567', 'green', 'kemon', 'achen', 'avatar.png', 'rahman');

-- --------------------------------------------------------

--
-- Table structure for table `category`
--

CREATE TABLE `category` (
  `id` int(10) NOT NULL,
  `title` varchar(50) NOT NULL,
  `author` varchar(50) NOT NULL,
  `datetime` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `category`
--

INSERT INTO `category` (`id`, `title`, `author`, `datetime`) VALUES
(1, 'Technology', 'Forid', 'May-13-2020 17:58:28'),
(2, 'Article', 'Forid', 'May-13-2020 17:58:53'),
(3, 'News', 'Forid', 'May-13-2020 17:59:10'),
(5, 'Information', 'rahman', 'May-15-2020 17:21:00'),
(6, 'music', 'kamrul', 'May-19-2020 16:18:19');

-- --------------------------------------------------------

--
-- Table structure for table `comments`
--

CREATE TABLE `comments` (
  `id` int(10) NOT NULL,
  `datetime` varchar(50) NOT NULL,
  `name` varchar(50) NOT NULL,
  `email` varchar(60) NOT NULL,
  `comment` varchar(500) NOT NULL,
  `approvedby` varchar(50) NOT NULL,
  `status` varchar(5) NOT NULL,
  `post_id` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `comments`
--

INSERT INTO `comments` (`id`, `datetime`, `name`, `email`, `comment`, `approvedby`, `status`, `post_id`) VALUES
(1, 'May-13-2020 21:11:01', 'abul', 'kalam@gmail.com', 'lekhata onek chomotkar', 'rahman', 'ON', 1),
(3, 'May-17-2020 21:33:24', 'monsta', 'monsta@gmail.com', 'excursion is like some kind of traveling', 'rahman', 'ON', 3),
(5, 'May-18-2020 22:01:30', 'aziz', 'aziz@gmail.com', 'traveling is good for health', 'rahman', 'OFF', 1),
(7, 'May-22-2020 19:48:53', 'golam', 'golam@gmail.com', 'EDM is the advanced genre of music', 'Pending', 'OFF', 2);

-- --------------------------------------------------------

--
-- Table structure for table `posts`
--

CREATE TABLE `posts` (
  `id` int(10) NOT NULL,
  `datetime` varchar(50) NOT NULL,
  `title` varchar(300) NOT NULL,
  `category` varchar(50) NOT NULL,
  `author` varchar(50) NOT NULL,
  `image` varchar(50) NOT NULL,
  `post` varchar(1000) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `posts`
--

INSERT INTO `posts` (`id`, `datetime`, `title`, `category`, `author`, `image`, `post`) VALUES
(1, 'May-13-2020 18:14:16', 'travel', 'Article', 'Forid', 'quiz.png', 'i was travel to see my grandparents'),
(2, 'May-13-2020 20:40:06', 'music', 'News', 'Forid', '11071784_877522228956006_1767115380581929534_o.jpg', 'kichu music shunte besh valo shona jai'),
(3, 'May-15-2020 17:12:53', 'travelling island', 'Article', 'kamrul', '12010511_815926018520845_7874398291351162698_o.jpg', 'Excursion is another possible means of traveling ...'),
(4, 'May-23-2020 17:58:06', 'Godzilla', 'News', 'kamrul', 'Godzilla.jpg', 'Godzilla is a giant reptile animal.....help to survive human race....'),
(5, 'May-23-2020 18:00:26', 'fight', 'News', 'kamrul', 'muto.jpg', 'Muto is one of the enemy of godzilla. Godzilla has to fight and survive . '),
(6, 'May-23-2020 19:36:36', 'T-Rex', 'Article', 'kamrul', 't-rex.png', 'T-Rex is the most ferocious animal in jurassic age. '),
(7, 'May-23-2020 19:50:12', 'Veloceroptor', 'Information', 'kamrul', 'veloceroptor.jpg', 'velociraptor is one of the fastest dinosaurs in the world.'),
(8, 'May-23-2020 19:54:12', 'Brachiosauraus', 'Technology', 'kamrul', 'brachiosaurus.jpg', '                  Brachiosaurus is that kind of dinosaur which eats plants and trees.                 '),
(10, 'May-23-2020 19:58:59', 'Indominus-Rex', 'Technology', 'kamrul', 'indominus-rex.jpg', '                  Indominus-Rex is hybrid dinosaur that creates in laboratory , is the biggest dinosaur in the history .                 '),
(12, 'May-23-2020 20:02:05', 'Comodo Dragon', 'News', 'kamrul', 'comodo_dragon.jpg', 'Comodo Dragon is the best known existing reptile in the planet which lives only in land. '),
(13, 'May-24-2020 20:48:01', 'SaberTooth', 'Technology', 'kamrul', 'saberTooth.jpg', 'SaberTooth is the largest tiger ever known , lived in the time of ice age.');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admins`
--
ALTER TABLE `admins`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `comments`
--
ALTER TABLE `comments`
  ADD PRIMARY KEY (`id`),
  ADD KEY `post_id` (`post_id`);

--
-- Indexes for table `posts`
--
ALTER TABLE `posts`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admins`
--
ALTER TABLE `admins`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `category`
--
ALTER TABLE `category`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `comments`
--
ALTER TABLE `comments`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `posts`
--
ALTER TABLE `posts`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `comments`
--
ALTER TABLE `comments`
  ADD CONSTRAINT `Foreign_Relation` FOREIGN KEY (`post_id`) REFERENCES `posts` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
