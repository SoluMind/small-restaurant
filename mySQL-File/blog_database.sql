-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost:8889
-- Generation Time: Sep 11, 2024 at 10:28 AM
-- Server version: 5.7.39
-- PHP Version: 7.4.33

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `blog_database`
--

-- --------------------------------------------------------

--
-- Table structure for table `customer_orders`
--

CREATE TABLE `customer_orders` (
  `id` int(11) NOT NULL,
  `uName` varchar(255) DEFAULT NULL,
  `uEmail` varchar(255) DEFAULT NULL,
  `password` longtext
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `customer_orders`
--

INSERT INTO `customer_orders` (`id`, `uName`, `uEmail`, `password`) VALUES
(1, 'hani', 'hani@hani.com', '$2y$10$4e.rzaLh/7Kvav7VNRQWe.hGY3DbxY56iQuvmhzSuPWY4N1UOgefK'),
(2, 'luwam', 'luwam@luwam.com', '$2y$10$oG.ZFkHxGUaZ796hoTDpzuig4I8dxCMjl9DbewYo9/ZSL.LP5Snja'),
(3, 'Solomon', 'solomon@solomon.com', '$2y$10$Yps9PUlSqd6kyIKEWhDza.5GLEGoXIrnqrAtixzdC.8yEy7HFQH/q');

-- --------------------------------------------------------

--
-- Table structure for table `postUser`
--

CREATE TABLE `postUser` (
  `postUid` int(11) NOT NULL,
  `title` tinytext,
  `imageurl` tinytext,
  `comment` tinytext
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `postUser`
--

INSERT INTO `postUser` (`postUid`, `title`, `imageurl`, `comment`) VALUES
(6, 'rise & meat', 'https://media-cdn.tripadvisor.com/media/photo-s/05/d4/83/3f/fast-food-restaurant.jpg', 'really nice recipe'),
(7, 'Fish & salad', 'https://food.fnr.sndimg.com/content/dam/images/food/fullset/2018/1/23/0/FN_healthy-fast-food-red-robin-avocado-cobb-salad_s4x3.jpg.rend.hgtvcom.616.462.suffix/1516723515457.jpeg', 'easy to make '),
(9, 'chicken salad', 'https://images.pexels.com/photos/958545/pexels-photo-958545.jpeg?cs=srgb&dl=pexels-chanwalrus-958545.jpg&fm=jpg', 'Let\'s try '),
(10, 'Steak', 'https://images.pexels.com/photos/10749578/pexels-photo-10749578.jpeg?auto=compress&cs=tinysrgb&w=1260&h=750&dpr=2', 'Wow looking nice');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(50) DEFAULT NULL,
  `userEmail` varchar(100) DEFAULT NULL,
  `Userpwd` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `userEmail`, `Userpwd`) VALUES
(1, 'Fesshaye', 'fesshaye@fesshaye.com', '$2y$10$6bYgl47j3SbCu7/Y865hnu2qcoQPnamP22mRsfauP71mO.NonugNC'),
(2, 'Solomon', 'solomon@solomon.com', '$2y$10$PoO8vP76Zss5pNokDom83umo2QSPbcjYU/i.eXGDsDi7.HmpUiKBy'),
(3, 'Hermon', 'hermon@hermon.com', '$2y$10$iRjiLHT7DkMT8yZRBmh64uLgr94hyYfDKKANUQrlL8NnHZ2dWumRq'),
(4, 'david', 'david@david.com', '$2y$10$UuMvsUEV0d4J6Xf7iyF59.JQkKPjVJeRF8JN/XIFmXzaTR84E4iFC'),
(5, 'simon', 'simon@simon.com', '$2y$10$z6tjoDxI32PlVxb5HQSN/OTqTjAMOdRuUuoKyb8MMElN24KWV855m'),
(6, 'Mera', 'mera@mera.com', '$2y$10$C/d1RYBk/1OcGSOvwVTFsODUlsfIcqkpHTq/pgH64Q0mZYlF3Jiv6'),
(7, 'meron', 'meron@meron.com', '$2y$10$2fgqYJZPOlcCkNCzdzELA.xnO9IF.N3eLw7bu5t7hQorpwlTpLNLi'),
(8, 'luwam', 'luwam@luwam.com', '$2y$10$1t8OdEAjDUP/dC4.T5IHxuzLQW9hLHT9O35T6bdZdUiS6bq4TN4Fm');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `customer_orders`
--
ALTER TABLE `customer_orders`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `postUser`
--
ALTER TABLE `postUser`
  ADD PRIMARY KEY (`postUid`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `customer_orders`
--
ALTER TABLE `customer_orders`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `postUser`
--
ALTER TABLE `postUser`
  MODIFY `postUid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
