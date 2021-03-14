-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 14, 2021 at 12:08 PM
-- Server version: 10.4.17-MariaDB
-- PHP Version: 8.0.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `movie_posters`
--

-- --------------------------------------------------------

--
-- Table structure for table `artist`
--

CREATE TABLE `artist` (
  `artist_id` int(11) NOT NULL,
  `artist_name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `artist`
--

INSERT INTO `artist` (`artist_id`, `artist_name`) VALUES
(1, 'Kilian Eng'),
(2, 'Tom Mac'),
(3, 'Dan Mumford'),
(4, 'Kevin Tong'),
(5, 'Murray Lewis'),
(6, 'Raid71'),
(7, 'DKNG'),
(8, 'Christopher Shy'),
(9, 'Jake WIlliams'),
(10, 'BluMoo'),
(11, 'Danny Schlitz'),
(12, 'Arno Kiss'),
(13, 'Dustin Knotek'),
(14, 'Sam Gilbey'),
(15, 'Anthony Petrie'),
(16, 'Stephan Schmitz'),
(17, 'George Bletsis'),
(18, 'George Townley'),
(19, 'Shan Jiang'),
(20, 'Tom Whalen'),
(21, 'Fro Design'),
(22, 'Paul Mann'),
(23, 'Laurent Durieux'),
(24, 'Simon Hawes'),
(25, 'Jamie Stark'),
(26, 'Bryan Snuffer'),
(27, 'Amaury Filho'),
(28, 'Haddon McKinney'),
(29, 'Oregon Pizza'),
(30, 'Martin Gee'),
(31, 'James Hobson'),
(32, 'Shian Ng');

-- --------------------------------------------------------

--
-- Table structure for table `genres`
--

CREATE TABLE `genres` (
  `genre_id` int(10) NOT NULL,
  `genre_name` varchar(254) NOT NULL,
  `genre_tagline` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `genres`
--

INSERT INTO `genres` (`genre_id`, `genre_name`, `genre_tagline`) VALUES
(1, 'Action', 'Lights, Camera...'),
(2, 'Classics', 'Blasts from the past'),
(3, 'Crime', 'They say it never pays...'),
(4, 'Family', 'There’s no time like family time'),
(5, 'Horror', 'Add some fright with your furniture!'),
(6, 'Science Fiction', 'A picture is worth a thousand new worlds'),
(7, 'Drama', 'Stories to inspire…'),
(8, 'Fantasy', 'Escape to a new world');

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `order_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `order_status_id` tinyint(11) NOT NULL,
  `date_created` datetime NOT NULL DEFAULT current_timestamp(),
  `last_updated` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`order_id`, `user_id`, `order_status_id`, `date_created`, `last_updated`) VALUES
(1, 2, 3, '2021-03-08 14:18:43', '2021-03-12 23:14:39'),
(2, 3, 2, '2021-03-10 12:21:43', '2021-03-13 23:14:39'),
(3, 2, 1, '2021-03-12 10:42:26', '2021-03-13 23:15:21'),
(4, 4, 1, '2021-03-13 21:08:46', '2021-03-13 23:14:39');

-- --------------------------------------------------------

--
-- Table structure for table `order_details`
--

CREATE TABLE `order_details` (
  `order_detail_id` int(11) NOT NULL,
  `order_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `quantity` tinyint(4) NOT NULL,
  `product_price` decimal(10,2) NOT NULL,
  `total_cost` decimal(10,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `order_details`
--

INSERT INTO `order_details` (`order_detail_id`, `order_id`, `product_id`, `quantity`, `product_price`, `total_cost`) VALUES
(1, 1, 30, 1, '60.00', '60.00'),
(2, 1, 7, 1, '85.00', '85.00'),
(3, 2, 7, 1, '85.00', '85.00'),
(4, 3, 14, 1, '75.00', '75.00'),
(5, 4, 11, 2, '110.00', '220.00'),
(6, 4, 21, 1, '30.00', '30.00'),
(7, 4, 15, 1, '60.00', '60.00');

-- --------------------------------------------------------

--
-- Table structure for table `order_status`
--

CREATE TABLE `order_status` (
  `status_id` int(11) NOT NULL,
  `status_code` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `order_status`
--

INSERT INTO `order_status` (`status_id`, `status_code`) VALUES
(1, 'Pending'),
(2, 'Out for Delivery'),
(3, 'Delivered');

-- --------------------------------------------------------

--
-- Table structure for table `product`
--

CREATE TABLE `product` (
  `product_id` int(11) NOT NULL,
  `product_name` varchar(255) NOT NULL,
  `product_price` decimal(10,2) NOT NULL,
  `product_sale` decimal(10,2) DEFAULT NULL,
  `product_quantity` int(11) NOT NULL,
  `product_total` int(11) NOT NULL,
  `artist_id` int(10) NOT NULL,
  `date_added` datetime NOT NULL DEFAULT current_timestamp(),
  `featured` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `product`
--

INSERT INTO `product` (`product_id`, `product_name`, `product_price`, `product_sale`, `product_quantity`, `product_total`, `artist_id`, `date_added`, `featured`) VALUES
(1, '2001: A Space Odyssey', '70.00', NULL, 31, 80, 1, '2021-03-02 10:37:07', 1),
(2, 'Alien', '50.00', NULL, 134, 250, 1, '2021-03-02 10:44:16', 0),
(3, 'Back to the Future', '35.00', NULL, 21, 250, 2, '2021-03-02 10:44:16', 0),
(4, 'The Wizard of Oz', '60.00', NULL, 26, 250, 4, '2021-03-02 10:44:16', 0),
(5, 'The Shining', '90.00', NULL, 70, 150, 21, '2021-03-02 10:44:16', 0),
(6, 'Guardians of the Galaxy', '75.00', NULL, 112, 250, 20, '2021-03-02 10:44:16', 1),
(7, 'Drive', '85.00', NULL, 8, 50, 22, '2021-03-02 10:44:16', 0),
(8, 'Jurassic Park', '80.00', NULL, 79, 250, 13, '2021-03-02 10:44:16', 0),
(9, 'Forbidden Planet', '80.00', NULL, 139, 250, 23, '2021-03-02 10:44:16', 0),
(10, 'RoboCop', '40.00', NULL, 29, 250, 15, '2021-03-02 10:44:16', 0),
(11, 'Silent Running', '110.00', NULL, 181, 200, 6, '2021-03-03 10:41:16', 1),
(12, 'Coherence', '50.00', '25.00', 12, 50, 9, '2021-03-02 10:44:16', 0),
(13, 'The Thing', '65.00', NULL, 10, 250, 8, '2021-03-02 10:44:16', 0),
(14, 'Blade Runner', '75.00', NULL, 20, 80, 6, '2021-03-02 10:44:16', 0),
(15, 'Metropolis', '60.00', NULL, 68, 100, 24, '2021-03-02 10:44:16', 0),
(16, 'Psycho', '60.00', NULL, 40, 60, 10, '2021-03-02 10:44:16', 0),
(17, 'Vertigo', '75.00', NULL, 24, 60, 16, '2021-03-02 10:44:16', 0),
(18, 'Jaws', '75.00', NULL, 200, 250, 17, '2021-03-02 10:44:16', 0),
(19, 'Dr. Strangelove', '20.00', NULL, 101, 250, 25, '2021-03-02 10:44:16', 0),
(20, 'The Terminator', '35.00', NULL, 203, 250, 26, '2021-03-02 10:44:16', 0),
(21, 'E.T.', '30.00', NULL, 234, 250, 14, '2021-03-02 10:44:16', 0),
(22, 'Rear Window', '80.00', '70.00', 158, 250, 4, '2021-03-02 10:44:16', 0),
(23, 'The Iron Giant', '60.00', NULL, 92, 250, 7, '2021-03-02 10:44:16', 0),
(24, 'Howl\'s Moving Castle', '70.00', NULL, 118, 250, 18, '2021-03-02 10:44:16', 0),
(25, 'Annihilation', '120.00', NULL, 156, 250, 1, '2021-03-03 09:44:16', 1),
(26, 'The Lord of the Rings: The Fellowship of the Ring', '100.00', NULL, 195, 250, 27, '2021-03-02 10:44:16', 1),
(27, 'The Lord of the Rings: The Two Towers', '90.00', NULL, 110, 250, 3, '2021-03-02 10:44:16', 0),
(28, 'The Lord of the Rings: The Return of the King', '90.00', NULL, 210, 250, 11, '2021-03-02 10:44:16', 0),
(29, 'Wall-E', '30.00', NULL, 19, 50, 5, '2021-03-02 10:44:16', 0),
(30, 'Inception', '60.00', NULL, 0, 250, 1, '2021-03-02 10:44:16', 0),
(31, 'Interstellar', '130.00', NULL, 60, 120, 1, '2021-03-02 10:44:16', 1),
(32, 'The Rocketeer', '80.00', NULL, 240, 250, 28, '2021-03-03 10:44:16', 0),
(33, 'Spirited Away', '45.00', NULL, 8, 60, 12, '2021-03-02 10:44:16', 0),
(34, 'The Birds', '60.00', NULL, 226, 250, 29, '2021-03-02 10:44:16', 0),
(35, 'Godzilla', '50.00', NULL, 21, 80, 19, '2021-03-02 10:44:16', 0),
(36, 'Parasite', '65.00', NULL, 40, 100, 30, '2021-03-02 10:44:16', 0),
(37, 'Blade Runner 2049', '50.00', NULL, 198, 250, 31, '2021-03-02 10:44:16', 0),
(38, 'Mad Max: Fury Road', '70.00', NULL, 196, 250, 32, '2021-03-02 10:44:16', 0),
(39, 'Akira', '80.00', NULL, 0, 100, 3, '2021-03-02 10:44:16', 0),
(42, 'Starship Troopers', '65.00', NULL, 45, 50, 1, '2021-03-02 10:44:16', 0);

-- --------------------------------------------------------

--
-- Table structure for table `product_genres`
--

CREATE TABLE `product_genres` (
  `product_genre_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `genre_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `product_genres`
--

INSERT INTO `product_genres` (`product_genre_id`, `product_id`, `genre_id`) VALUES
(1, 1, 6),
(2, 1, 2),
(3, 2, 5),
(4, 3, 4),
(5, 4, 4),
(6, 5, 5),
(7, 6, 6),
(8, 6, 1),
(9, 6, 4),
(10, 7, 3),
(11, 8, 4),
(12, 8, 1),
(13, 9, 6),
(14, 10, 6),
(15, 10, 1),
(16, 11, 6),
(17, 12, 6),
(18, 13, 5),
(19, 13, 6),
(20, 14, 6),
(21, 15, 2),
(22, 15, 6),
(23, 16, 5),
(24, 16, 2),
(25, 17, 2),
(26, 18, 4),
(27, 19, 2),
(28, 20, 6),
(29, 21, 4),
(30, 22, 2),
(31, 23, 4),
(32, 24, 4),
(33, 25, 6),
(34, 25, 5),
(35, 26, 8),
(36, 27, 8),
(37, 28, 8),
(38, 29, 4),
(39, 30, 3),
(40, 31, 6),
(41, 32, 4),
(42, 33, 4),
(43, 34, 2),
(44, 35, 1),
(45, 36, 7),
(46, 37, 6),
(47, 38, 1),
(48, 39, 1),
(49, 42, 6);

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `user_id` int(11) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(100) NOT NULL,
  `user_type` varchar(5) DEFAULT NULL,
  `first_name` varchar(255) NOT NULL,
  `last_name` varchar(255) NOT NULL,
  `created` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`user_id`, `email`, `password`, `user_type`, `first_name`, `last_name`, `created`) VALUES
(1, 'admin@nokposters.com', 'adminpass', 'admin', '', '', '2021-02-25 10:29:51'),
(2, 'testuser@example.com', 'test123', NULL, 'Daniel', 'Parker', '2021-02-28 15:23:56'),
(3, 'testuser2@example.com', 'password', NULL, 'Emily', 'Fields', '2021-03-01 16:32:56'),
(4, 'dandan@example.com', '$2y$10$j4Ky.1IM3jn1qKeGCK4rq.E5bVUoxDRoq8dVrcT845VjYzytwcNW.', NULL, 'Don', 'Carino', '2021-03-09 16:22:58');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `artist`
--
ALTER TABLE `artist`
  ADD PRIMARY KEY (`artist_id`);

--
-- Indexes for table `genres`
--
ALTER TABLE `genres`
  ADD PRIMARY KEY (`genre_id`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`order_id`),
  ADD KEY `order_status_id` (`order_status_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `order_details`
--
ALTER TABLE `order_details`
  ADD PRIMARY KEY (`order_detail_id`),
  ADD KEY `order_id` (`order_id`,`product_id`);

--
-- Indexes for table `order_status`
--
ALTER TABLE `order_status`
  ADD PRIMARY KEY (`status_id`);

--
-- Indexes for table `product`
--
ALTER TABLE `product`
  ADD PRIMARY KEY (`product_id`),
  ADD KEY `artist_id` (`artist_id`);

--
-- Indexes for table `product_genres`
--
ALTER TABLE `product_genres`
  ADD PRIMARY KEY (`product_genre_id`),
  ADD KEY `genre_id` (`genre_id`),
  ADD KEY `product_id` (`product_id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `artist`
--
ALTER TABLE `artist`
  MODIFY `artist_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;

--
-- AUTO_INCREMENT for table `genres`
--
ALTER TABLE `genres`
  MODIFY `genre_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `order_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `order_details`
--
ALTER TABLE `order_details`
  MODIFY `order_detail_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `order_status`
--
ALTER TABLE `order_status`
  MODIFY `status_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `product`
--
ALTER TABLE `product`
  MODIFY `product_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=43;

--
-- AUTO_INCREMENT for table `product_genres`
--
ALTER TABLE `product_genres`
  MODIFY `product_genre_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=50;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `product_genres`
--
ALTER TABLE `product_genres`
  ADD CONSTRAINT `product_genres_ibfk_1` FOREIGN KEY (`genre_id`) REFERENCES `genres` (`genre_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `product_genres_ibfk_2` FOREIGN KEY (`product_id`) REFERENCES `product` (`product_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
