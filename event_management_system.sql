-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 29, 2025 at 08:24 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `event_management_system`
--

-- --------------------------------------------------------

--
-- Table structure for table `attendees`
--

CREATE TABLE `attendees` (
  `id` int(11) NOT NULL,
  `event_id` int(11) DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL,
  `registered_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `seats` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `attendees`
--

INSERT INTO `attendees` (`id`, `event_id`, `user_id`, `registered_at`, `seats`) VALUES
(1, 17, 1, '2025-01-25 17:39:36', NULL),
(2, 17, 1, '2025-01-25 17:52:45', NULL),
(3, 2, 1, '2025-01-26 19:07:25', NULL),
(4, 2, 1, '2025-01-26 19:08:49', NULL),
(5, 2, 1, '2025-01-26 19:08:51', NULL),
(6, 2, 1, '2025-01-26 19:08:52', NULL),
(7, 16, 1, '2025-01-26 19:09:23', NULL),
(8, 16, 1, '2025-01-26 19:10:00', NULL),
(9, 2, 1, '2025-01-26 19:10:06', NULL),
(10, 2, 1, '2025-01-26 19:10:55', NULL),
(11, 2, 1, '2025-01-26 19:12:35', NULL),
(12, 2, 1, '2025-01-26 20:04:15', NULL),
(13, 2, 1, '2025-01-26 20:04:20', NULL),
(15, 2, 2, '2025-01-28 17:44:58', NULL),
(16, 17, 2, '2025-01-29 19:11:24', 20),
(17, 17, 2, '2025-01-29 19:13:09', 56);

-- --------------------------------------------------------

--
-- Table structure for table `events`
--

CREATE TABLE `events` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `description` text NOT NULL,
  `date` date NOT NULL,
  `max_capacity` int(11) NOT NULL,
  `created_by` int(11) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `events`
--

INSERT INTO `events` (`id`, `name`, `description`, `date`, `max_capacity`, `created_by`, `created_at`) VALUES
(2, 'Mithundfdfbv', 'dfdfb', '2025-01-25', 22, NULL, '2025-01-24 09:26:33'),
(13, 'gddfg', 'dgdg', '2025-01-09', 0, NULL, '2025-01-25 10:46:54'),
(14, 'Dhumchika', 'fhgfg', '2025-01-16', 0, NULL, '2025-01-25 10:50:35'),
(16, 'etfre mk', 'mk', '2025-01-24', 2, NULL, '2025-01-25 17:14:49'),
(17, 'Mithn', 'dsvdsv', '2025-01-11', 34, NULL, '2025-01-25 17:18:31'),
(18, 'drgfdfbgfbfgb', 'jhvjhv', '2025-01-22', 22, NULL, '2025-01-26 20:04:46');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `is_admin` tinyint(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `email`, `password`, `created_at`, `is_admin`) VALUES
(1, 'mithun', 'mithun@gmail.com', '$2y$10$SpSpo8O9P7nS9Xz1XmU77OBrSV8dWeZpcPE6r6onKedFk.8Y4OqA6', '2025-01-24 07:56:30', 1),
(2, 'sifit', 'sifit@gmail.com', '$2y$10$QtncLTsbC5e1DIrq7Kp.dugkOhNjvFwAOToWWEgbO2ZQHGVN6zqj.', '2025-01-25 10:11:06', 0);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `attendees`
--
ALTER TABLE `attendees`
  ADD PRIMARY KEY (`id`),
  ADD KEY `event_id` (`event_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `events`
--
ALTER TABLE `events`
  ADD PRIMARY KEY (`id`),
  ADD KEY `created_by` (`created_by`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `attendees`
--
ALTER TABLE `attendees`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `events`
--
ALTER TABLE `events`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `attendees`
--
ALTER TABLE `attendees`
  ADD CONSTRAINT `attendees_ibfk_1` FOREIGN KEY (`event_id`) REFERENCES `events` (`id`),
  ADD CONSTRAINT `attendees_ibfk_2` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Constraints for table `events`
--
ALTER TABLE `events`
  ADD CONSTRAINT `events_ibfk_1` FOREIGN KEY (`created_by`) REFERENCES `users` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
