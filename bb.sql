-- phpMyAdmin SQL Dump
-- version 4.8.2
-- https://www.phpmyadmin.net/
--

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `bb`
--

-- --------------------------------------------------------

--
-- Table structure for table `guests`
--

CREATE TABLE `guests` (
  `id` int(10) UNSIGNED NOT NULL,
  `room_id` int(10) UNSIGNED DEFAULT NULL,
  `title` varchar(55) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `name` mediumtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `surname` mediumtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `cell` varchar(30) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(199) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `eta` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `breakfast` tinyint(1) NOT NULL DEFAULT '1',
  `supper` tinyint(1) NOT NULL DEFAULT '1',
  `requests` longtext COLLATE utf8mb4_unicode_ci,
  `cleaned` tinyint(1) DEFAULT '0',
  `vacant` tinyint(1) DEFAULT '0',
  `check_in` datetime NOT NULL,
  `check_out` datetime NOT NULL,
  `accompanying` int(11) NOT NULL DEFAULT '0',
  `cost_per_night` decimal(8,2) NOT NULL DEFAULT '300.00',
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;



--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(7, '2014_10_12_000000_create_users_table', 1),
(8, '2014_10_12_100000_create_password_resets_table', 1),
(9, '2018_09_21_214048_create_rooms_table', 1),
(10, '2018_09_21_215659_create_guest_table', 1);

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `reservations`
--

CREATE TABLE `reservations` (
  `id` int(10) UNSIGNED NOT NULL,
  `room_id` int(6) UNSIGNED NOT NULL,
  `check_in` date NOT NULL,
  `check_out` date NOT NULL,
  `guest_name` varchar(255) NOT NULL,
  `cell` varchar(100) NOT NULL,
  `accompanying` int(10) UNSIGNED DEFAULT NULL,
  `second_room_id` int(6) UNSIGNED DEFAULT NULL,
  `third_room_id` int(6) UNSIGNED DEFAULT NULL,
  `fourth_room_id` int(6) UNSIGNED DEFAULT NULL,
  `cost_quoted` decimal(10,0) DEFAULT NULL,
  `extra_details` text,
  `email` varchar(100) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `deleted-at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `reservations`
--

INSERT INTO `reservations` (`id`, `room_id`, `check_in`, `check_out`, `guest_name`, `cell`, `accompanying`, `second_room_id`, `third_room_id`, `fourth_room_id`, `cost_quoted`, `extra_details`, `email`, `created_at`, `updated_at`, `deleted-at`) VALUES
(1, 14, '2018-10-31', '2018-11-14', 'Donald Duck', '082 83 24 968', 0, NULL, NULL, NULL, '365', 'Offered guest a discount', 'sweepsdave@gmail.com', '2018-10-05 02:11:14', '2018-10-05 20:54:16', NULL),
(2, 17, '2018-11-07', '2018-11-28', 'Mickey Mouse', '085 25 96 987', 3, 19, 20, 21, '1500', 'Staying in off season so lower price. \r\nchange room cost before checking in the guest.', NULL, '2018-10-05 20:57:42', '2018-10-05 20:57:42', NULL),
(3, 1, '2018-10-01', '2018-10-31', 'Dave', '082 83 24 968', 0, NULL, NULL, NULL, '6500', 'Extra Coffee please.', NULL, '2018-10-07 18:48:44', '2018-10-07 18:48:44', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `rooms`
--

CREATE TABLE `rooms` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` mediumtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `beds` int(11) NOT NULL,
  `cost_per_night` decimal(8,2) NOT NULL,
  `vacant` tinyint(1) NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `cleaned` tinyint(1) DEFAULT '0',
  `guest_id` int(6) DEFAULT NULL,
  `deleted_at` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `rooms`
--

INSERT INTO `rooms` (`id`, `name`, `beds`, `cost_per_night`, `vacant`, `created_at`, `updated_at`, `cleaned`, `guest_id`, `deleted_at`) VALUES
(1, 'Room 1', 3, '325.55', 1, NULL, '2018-12-17 13:20:49', 1, 106, NULL),
(2, 'Room 2', 5, '210.65', 1, NULL, '2018-12-03 20:59:11', 1, 94, NULL),
(4, 'Room 4', 1, '200.00', 1, NULL, '2018-11-16 20:47:39', 0, 87, NULL),
(5, 'Room 5', 1, '200.00', 1, NULL, '2018-11-04 09:35:12', 0, 63, NULL),
(6, 'Room 6', 2, '325.00', 1, NULL, '2018-12-08 09:27:20', 1, 108, NULL),
(7, 'Room 22', 3, '525.40', 1, NULL, '2018-12-06 20:25:59', 0, 105, NULL),
(8, 'Room 21', 1, '100.00', 1, NULL, '2018-12-03 20:44:52', 0, 100, NULL),
(9, 'Room 7', 3, '210.00', 1, NULL, '2018-12-17 15:57:31', 0, 89, NULL),
(10, 'Room 8', 5, '352.15', 1, NULL, '2018-11-13 19:55:11', 0, 77, NULL),
(11, 'Room 9', 1, '100.00', 1, NULL, '2018-11-27 20:24:30', 0, 95, NULL),
(12, 'Room 10', 2, '200.30', 1, NULL, '2018-12-10 20:13:30', 0, 109, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'test', 's@d', NULL, '$2y$12$WxuEFPLor0QkvbU3Z3Uzvem/RNouszhBYESKHbP7cE45lKfmL5y9W', '', '2018-09-21 20:03:37', '2018-09-21 20:03:37');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `guests`
--
ALTER TABLE `guests`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`);

--
-- Indexes for table `reservations`
--
ALTER TABLE `reservations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `rooms`
--
ALTER TABLE `rooms`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `guests`
--
ALTER TABLE `guests`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=111;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `reservations`
--
ALTER TABLE `reservations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `rooms`
--
ALTER TABLE `rooms`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

DELIMITER $$
--
-- Events
--
CREATE DEFINER=`root`@`localhost` EVENT `cleaning` ON SCHEDULE EVERY 1 DAY STARTS '2014-01-18 12:00:00' ON COMPLETION NOT PRESERVE ENABLE DO UPDATE rooms 
SET cleaned = 1 
WHERE id IN (SELECT room_id from guests WHERE vacant > 0)$$

DELIMITER ;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
