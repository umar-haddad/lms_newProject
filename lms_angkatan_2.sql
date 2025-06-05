-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 05, 2025 at 10:12 AM
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
-- Database: `lms_angkatan_2`
--

-- --------------------------------------------------------

--
-- Table structure for table `instructors`
--

CREATE TABLE `instructors` (
  `id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `gender` tinyint(1) NOT NULL,
  `education` varchar(30) NOT NULL,
  `phone` varchar(15) NOT NULL,
  `email` varchar(50) NOT NULL,
  `password` varchar(100) NOT NULL,
  `address` text NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `update_at` timestamp NULL DEFAULT NULL ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `instructors`
--

INSERT INTO `instructors` (`id`, `name`, `gender`, `education`, `phone`, `email`, `password`, `address`, `created_at`, `update_at`) VALUES
(1, 'Pak agra', 1, 'SMK 100', '085772169466', 'agra12@gmail.com', '', 'jln.Cipinang Besar Selatan, KAMP.Besar, Cipinang Besar Selatan', '2025-06-04 02:36:21', '2025-06-04 02:55:45'),
(2, 'bang will', 1, 'Nusa Mandiri', '083342334521', 'william123@gmail.com', '', 'jln.surabaya Nasgor manchester united', '2025-06-04 07:04:20', NULL),
(4, 'rehan', 1, 'SMK 100', '85772169466', 'berak@gmail.com', '12345', 'jln.surabaya Nasgor manchester united', '2025-06-05 07:43:09', NULL),
(5, 'Superadmin', 0, 'Nusa Mandiri', '85772169466', 'admin123@gmail.com', '12345', 'jln.surabaya Nasgor manchester united', '2025-06-05 08:05:12', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `instructors_majors`
--

CREATE TABLE `instructors_majors` (
  `id` int(11) NOT NULL,
  `id_major` int(11) NOT NULL,
  `id_instructor` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `update_at` timestamp NULL DEFAULT NULL ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `instructors_majors`
--

INSERT INTO `instructors_majors` (`id`, `id_major`, `id_instructor`, `created_at`, `update_at`) VALUES
(3, 4, 1, '2025-06-05 02:17:28', NULL),
(5, 2, 1, '2025-06-05 02:17:53', '2025-06-05 02:41:35'),
(7, 5, 2, '2025-06-05 03:38:07', NULL),
(8, 4, 4, '2025-06-05 07:44:46', NULL),
(9, 3, 4, '2025-06-05 07:44:50', NULL),
(10, 5, 4, '2025-06-05 07:44:52', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `majors`
--

CREATE TABLE `majors` (
  `id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `update_at` timestamp NULL DEFAULT NULL ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `majors`
--

INSERT INTO `majors` (`id`, `name`, `created_at`, `update_at`) VALUES
(2, 'Matematika', '2025-06-04 02:35:21', NULL),
(3, 'web programming', '2025-06-04 06:35:51', NULL),
(4, 'Design Graphic', '2025-06-04 07:06:19', NULL),
(5, 'Gamers', '2025-06-05 03:37:58', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `module_details`
--

CREATE TABLE `module_details` (
  `id` int(11) NOT NULL,
  `id_modul` int(11) NOT NULL,
  `file` varchar(100) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `update_at` timestamp NULL DEFAULT NULL ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `moduls`
--

CREATE TABLE `moduls` (
  `id` int(11) NOT NULL,
  `id_major` int(11) NOT NULL,
  `id_instructor` int(11) NOT NULL,
  `name` int(122) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `update_at` timestamp NULL DEFAULT NULL ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `roles`
--

CREATE TABLE `roles` (
  `id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `update_at` timestamp NULL DEFAULT NULL ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `roles`
--

INSERT INTO `roles` (`id`, `name`, `created_at`, `update_at`) VALUES
(2, 'admin', '2025-06-04 02:31:47', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `update_at` timestamp NULL DEFAULT NULL ON UPDATE current_timestamp(),
  `deleted_at` tinyint(4) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `password`, `created_at`, `update_at`, `deleted_at`) VALUES
(1, 'umar', 'admin@gmail.com', '12345', '2025-06-03 02:50:21', '2025-06-03 06:45:18', 1),
(7, 'anjirlah', 'kakkkak@gmail.com', '20202020', '2025-06-03 08:07:04', '2025-06-04 01:29:42', 1),
(8, 'ajay', 'kkkak12@gmail.com', '8cb2237d0679ca88db6464eac60da96345513964', '2025-06-04 01:42:35', '2025-06-04 01:43:01', 0);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `instructors`
--
ALTER TABLE `instructors`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `instructors_majors`
--
ALTER TABLE `instructors_majors`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `majors`
--
ALTER TABLE `majors`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `module_details`
--
ALTER TABLE `module_details`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `moduls`
--
ALTER TABLE `moduls`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `roles`
--
ALTER TABLE `roles`
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
-- AUTO_INCREMENT for table `instructors`
--
ALTER TABLE `instructors`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `instructors_majors`
--
ALTER TABLE `instructors_majors`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `majors`
--
ALTER TABLE `majors`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `module_details`
--
ALTER TABLE `module_details`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `moduls`
--
ALTER TABLE `moduls`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `roles`
--
ALTER TABLE `roles`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
