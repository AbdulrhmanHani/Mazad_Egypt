-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Mar 02, 2022 at 03:46 PM
-- Server version: 10.4.22-MariaDB
-- PHP Version: 8.1.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `mazad_egypt`
--

-- --------------------------------------------------------

--
-- Table structure for table `admins`
--

CREATE TABLE `admins` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `is_super` enum('yes','no') COLLATE utf8_unicode_ci NOT NULL DEFAULT 'no',
  `password` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `admins`
--

INSERT INTO `admins` (`id`, `name`, `email`, `is_super`, `password`, `created_at`) VALUES
(1, 'admin', 'admin@mazadegypt.com', 'yes', '$2y$10$yqsC.rZQ9gdwH7fpq4W8/eaOJTDyi9Lo2HVKXz9I7v3n18XWNfwXi', '2022-02-12 10:03:43'),
(12, 'moamen', 'moamen@mazadegypt.com', 'no', '$2y$10$ZikTwPmQRpwY5gY4YJGgNeZ4QFW3Nopu1e6vgfPuZ3Uex1UNjB59u', '2022-02-19 10:12:54'),
(13, 'admin2', 'admin2@mazadegypt.com', 'no', '$2y$10$orZ4htGC4Rj9PVmZMxvEdenzd5EPutKM6KhBNAYYNK3wjBVBydUvC', '2022-02-25 14:06:58');

-- --------------------------------------------------------

--
-- Table structure for table `auction`
--

CREATE TABLE `auction` (
  `id` int(10) UNSIGNED NOT NULL,
  `price` int(11) NOT NULL,
  `user_id` int(10) UNSIGNED DEFAULT NULL,
  `product_id` int(10) UNSIGNED DEFAULT NULL,
  `added_at` datetime NOT NULL DEFAULT current_timestamp(),
  `finish_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `auction`
--

INSERT INTO `auction` (`id`, `price`, `user_id`, `product_id`, `added_at`, `finish_at`) VALUES
(103, 1000, 2, 24, '2022-03-01 09:28:24', NULL),
(104, 1001, 2, 24, '2022-03-01 09:28:34', NULL),
(105, 2000, 2, 24, '2022-03-01 09:28:46', '2022-03-01 15:31:00'),
(106, 1000, 2, 25, '2022-03-01 09:42:40', NULL),
(107, 1001, 3, 25, '2022-03-01 09:42:48', NULL),
(108, 80000, 2, 25, '2022-03-01 09:42:55', NULL),
(109, 80002, 3, 25, '2022-03-01 09:43:06', '2022-03-01 15:43:00'),
(110, 1000, 3, 26, '2022-03-01 10:00:08', NULL),
(111, 2000, 3, 26, '2022-03-01 10:01:27', NULL),
(112, 2005, 3, 26, '2022-03-01 10:01:42', '2022-03-01 16:01:00'),
(113, 2001, 3, 27, '2022-03-02 08:10:11', NULL),
(114, 3000, 3, 27, '2022-03-02 08:10:38', '2022-03-02 14:11:00'),
(115, 5000, 3, 27, '2022-03-02 08:12:04', NULL),
(116, 20001, 3, 28, '2022-03-02 08:31:48', NULL),
(117, 200002, 3, 28, '2022-03-02 08:32:00', NULL),
(118, 200003, 3, 28, '2022-03-02 08:32:04', '2022-03-02 14:32:00'),
(119, 1001, 3, 29, '2022-03-02 09:22:35', '2022-03-02 15:22:00'),
(120, 20001, 3, 30, '2022-03-02 09:24:11', NULL),
(121, 20002, 3, 30, '2022-03-02 09:24:18', '2022-03-02 15:24:00'),
(122, 151, 3, 31, '2022-03-02 09:43:29', NULL),
(123, 152, 3, 31, '2022-03-02 09:43:57', '2022-03-02 15:44:00');

-- --------------------------------------------------------

--
-- Table structure for table `cats`
--

CREATE TABLE `cats` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `arabic_name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `img` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `cats`
--

INSERT INTO `cats` (`id`, `name`, `arabic_name`, `img`, `created_at`) VALUES
(1, 'paintArt', 'لوحات نادرة', 'paint_art.jpg', '2022-02-17 09:31:22'),
(2, 'antiques', 'أنتيكات نادرة', 'antiques.jpg', '2022-02-17 09:31:22'),
(3, 'otherPieces', 'قطع أخري نادرة', 'otherPieces.jpg', '2022-02-17 09:31:22');

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `id` int(10) UNSIGNED NOT NULL,
  `creator_name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `creator_email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `creator_phone` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `creator_address` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `winner_name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `winner_email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `winner_phone` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `winner_address` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `product` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `last_price` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`id`, `creator_name`, `creator_email`, `creator_phone`, `creator_address`, `winner_name`, `winner_email`, `winner_phone`, `winner_address`, `product`, `last_price`, `created_at`) VALUES
(4, 'Abdulrhman Hani', 'a@a.com', '01236569854', 'Alexandria, Egypt', 'ibrahim marzouq', 'i@i.com', '01154587962', 'giza, egypt', 'Sadam hussain Car', '20002', '2022-03-02 09:24:39'),
(5, 'Abdulrhman Hani', 'a@a.com', '01236569854', 'Alexandria, Egypt', 'ibrahim marzouq', 'i@i.com', '01154587962', 'giza, egypt', 'HHaammbbuurrggeerr', '152', '2022-03-02 09:44:38');

-- --------------------------------------------------------

--
-- Table structure for table `order_details`
--

CREATE TABLE `order_details` (
  `id` int(10) UNSIGNED NOT NULL,
  `order_id` int(10) UNSIGNED DEFAULT NULL,
  `product_id` int(10) UNSIGNED DEFAULT NULL,
  `qty` int(11) NOT NULL DEFAULT 1,
  `created_at` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `desc` text COLLATE utf8_unicode_ci NOT NULL,
  `price` decimal(10,2) NOT NULL,
  `pieces_no` smallint(6) NOT NULL,
  `img` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `active` enum('yes','pending','no') COLLATE utf8_unicode_ci NOT NULL DEFAULT 'pending',
  `product_owner` int(10) UNSIGNED DEFAULT NULL,
  `cat_id` int(10) UNSIGNED DEFAULT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `address` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `phone` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `password` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `visa_card` varchar(255) COLLATE utf8_unicode_ci NOT NULL DEFAULT '0',
  `profile_pic` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `address`, `phone`, `password`, `visa_card`, `profile_pic`, `created_at`) VALUES
(2, 'Abdulrhman Hani', 'a@a.com', 'Alexandria, Egypt', '01236569854', '$2y$10$pt0RVnFQoSQFrezDQPK9bOzzm4JANRJ9T50lCj.tMGXoorf9EsdBS', '1234567890123456', NULL, '2022-03-01 09:24:46'),
(3, 'ibrahim marzouq', 'i@i.com', 'giza, egypt', '01154587962', '$2y$10$o4M/0nlCEXz7dO3C.x4rBOfCob6f4n1lSokaUOrIdu19TxYUHMiXS', '0123456789123456', NULL, '2022-03-01 09:40:14');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admins`
--
ALTER TABLE `admins`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `auction`
--
ALTER TABLE `auction`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `product_id` (`product_id`);

--
-- Indexes for table `cats`
--
ALTER TABLE `cats`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `order_details`
--
ALTER TABLE `order_details`
  ADD PRIMARY KEY (`id`),
  ADD KEY `order_id` (`order_id`),
  ADD KEY `product_id` (`product_id`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`),
  ADD KEY `cat_id` (`cat_id`),
  ADD KEY `product_owner` (`product_owner`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admins`
--
ALTER TABLE `admins`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `auction`
--
ALTER TABLE `auction`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=124;

--
-- AUTO_INCREMENT for table `cats`
--
ALTER TABLE `cats`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `order_details`
--
ALTER TABLE `order_details`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
