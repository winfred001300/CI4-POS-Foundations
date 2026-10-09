-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 09, 2026 at 07:13 PM
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
-- Database: `pos_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `customers`
--

CREATE TABLE `customers` (
  `id` int(11) NOT NULL,
  `full_name` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `phone` varchar(20) DEFAULT NULL,
  `created_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `customers`
--

INSERT INTO `customers` (`id`, `full_name`, `email`, `phone`, `created_at`) VALUES
(1, 'Juan Dela Cruz', 'juan@example.com', '09171234567', '2026-10-02 22:02:04'),
(2, 'Maria Santos', 'maria@example.com', '09181234567', '2026-10-02 22:02:04'),
(3, 'Pedro Reyes', 'pedro@example.com', '09191234567', '2026-10-02 22:02:04'),
(4, 'Ana Garcia', 'ana@example.com', '09201234567', '2026-10-02 22:02:04'),
(5, 'Mark Ramos', 'mark@example.com', '09211234567', '2026-10-02 22:02:04'),
(6, 'Jackson Teller', 'jtteller@gmail.com', NULL, '0000-00-00 00:00:00'),
(7, 'Michael Klebitz', 'tlad@gmail.com', NULL, '0000-00-00 00:00:00'),
(8, 'Customer Test October', 'customertest2026@example.com', NULL, '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `full_name` varchar(100) NOT NULL,
  `created_at` datetime NOT NULL,
  `avatar` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `full_name`, `created_at`, `avatar`) VALUES
(1, 'juan123', 'Juan Dela Cruz', '2026-10-02 22:02:48', '1791565120_401fc219b40624c49861.jpg'),
(2, 'maria123', 'Maria Santos', '2026-10-02 22:02:48', NULL),
(3, 'pedro123', 'Pedro Reyes', '2026-10-02 22:02:48', NULL),
(4, 'ana123', 'Ana Garcia', '2026-10-02 22:02:48', NULL),
(5, 'mark123', 'Mark Ramos', '2026-10-02 22:02:48', NULL),
(6, 'cmsoa', 'clay morrow', '0000-00-00 00:00:00', NULL),
(7, 'tigsoa', 'tig trager', '0000-00-00 00:00:00', NULL),
(8, 'unserpd', 'unser john wayne', '0000-00-00 00:00:00', NULL),
(9, 'poststudent2026', 'POS Student Test', '0000-00-00 00:00:00', NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `customers`
--
ALTER TABLE `customers`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `customers`
--
ALTER TABLE `customers`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
