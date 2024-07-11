-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 11, 2024 at 08:57 AM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `library_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `bookings`
--

CREATE TABLE `bookings` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `book_id` int(11) NOT NULL,
  `status` enum('pending','approved','rejected','canceled') DEFAULT 'pending',
  `booking_date` date NOT NULL,
  `return_date` date DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `bookings`
--

INSERT INTO `bookings` (`id`, `user_id`, `book_id`, `status`, `booking_date`, `return_date`, `created_at`) VALUES
(1, 2, 1, 'approved', '2024-06-02', NULL, '2024-05-30 08:00:02');

-- --------------------------------------------------------

--
-- Table structure for table `books`
--

CREATE TABLE `books` (
  `id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `author` varchar(255) NOT NULL,
  `isbn` varchar(20) NOT NULL,
  `available` tinyint(1) DEFAULT 1,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `books`
--

INSERT INTO `books` (`id`, `title`, `author`, `isbn`, `available`, `created_at`) VALUES
(1, 'Are you ready to lead?', 'Alan Prince', ' ISBN-10 3-88053-108', 3, '2024-05-30 07:59:13'),
(2, 'C# for Dummies', 'S Wong', ' ISBN-10 3-80653-118', 2, '2024-05-31 15:32:47'),
(3, 'Learn Computer Science', 'E Mgazi', ' ISBN-10 3-88053-100', 2, '2024-06-04 12:06:36'),
(4, 'Beginner\'s Guide To Learn Ethical Hacking', 'JS Naidoo', ' ISBN-10 3-88053-103', 5, '2024-06-04 12:06:36');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL,
  `role` enum('admin','user') DEFAULT 'user',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `password`, `role`, `created_at`) VALUES
(2, 'Simesihle ', 'user@test.com', '$2y$10$Ro48aKuNGfObOiBvpC03vOakZyR2jwgUuT5dWw9UOjqWeH.DCRu/m', 'user', '2024-05-30 07:52:05'),
(3, 'S Ntshangase', 'codesteps23@gmail.com', '$2y$10$9X9f2VGm3tpyuWs6yc6qy.8th8YhOLDQdcKt6gEMQIRD9HVtwZ2vS', 'admin', '2024-05-31 12:01:04'),
(4, 'admin', 'admin@admin.com', '$2y$10$4AyAixlsVmSOBqR3CBlVQ.kB/D9mMgprdnrnsMD5oEwWIakTilauO', 'admin', '2024-05-31 12:09:31'),
(6, 'Simesihle ', 'smesihlentshangase@gmail.com', '$2y$10$ZOjqKUQX8FgpqTgBHtPLb.TuUojFTHXH3k9jtZi4Bs2L.2/0P6H5u', 'user', '2024-06-01 08:01:17'),
(7, '22123521', '22123521@dut4life.ac.za', '$2y$10$v1zVGkxHX9/nZ7XAvye8buIkv.7ssbUdPZ9rSVyRmP.PkmkCN53FO', 'user', '2024-06-04 12:08:48');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `bookings`
--
ALTER TABLE `bookings`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `book_id` (`book_id`);

--
-- Indexes for table `books`
--
ALTER TABLE `books`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `isbn` (`isbn`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `bookings`
--
ALTER TABLE `bookings`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `books`
--
ALTER TABLE `books`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `bookings`
--
ALTER TABLE `bookings`
  ADD CONSTRAINT `bookings_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `bookings_ibfk_2` FOREIGN KEY (`book_id`) REFERENCES `books` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
