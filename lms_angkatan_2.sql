-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 11 Jun 2025 pada 10.17
-- Versi server: 10.4.32-MariaDB
-- Versi PHP: 8.2.12

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
-- Struktur dari tabel `instructors`
--

CREATE TABLE `instructors` (
  `id` int(11) NOT NULL,
  `id_role` int(11) NOT NULL,
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
-- Dumping data untuk tabel `instructors`
--

INSERT INTO `instructors` (`id`, `id_role`, `name`, `gender`, `education`, `phone`, `email`, `password`, `address`, `created_at`, `update_at`) VALUES
(3, 4, 'rehan', 1, 'SMK 100', '85772169466', 'berak@gmail.com', '40bd001563085fc35165329ea1ff5c5ecbdbbeef', 'jln.surabaya Nasgor manchester united', '2025-06-05 07:43:09', '2025-06-11 02:29:30'),
(4, 4, 'naswa', 0, 'Nusa Mandiri', '85772169466', 'naswa@gmail.com', '8cb2237d0679ca88db6464eac60da96345513964', 'jln.surabaya Nasgor manchester united', '2025-06-05 08:05:12', '2025-06-11 01:57:42');

-- --------------------------------------------------------

--
-- Struktur dari tabel `instructors_majors`
--

CREATE TABLE `instructors_majors` (
  `id` int(11) NOT NULL,
  `id_major` int(11) NOT NULL,
  `id_instructor` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `update_at` timestamp NULL DEFAULT NULL ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `instructors_majors`
--

INSERT INTO `instructors_majors` (`id`, `id_major`, `id_instructor`, `created_at`, `update_at`) VALUES
(3, 4, 1, '2025-06-05 02:17:28', NULL),
(5, 2, 1, '2025-06-05 02:17:53', '2025-06-05 02:41:35'),
(7, 5, 2, '2025-06-05 03:38:07', NULL),
(9, 3, 4, '2025-06-05 07:44:50', NULL),
(10, 8, 4, '2025-06-05 07:44:52', '2025-06-10 07:43:02'),
(11, 5, 4, '2025-06-10 07:43:08', NULL);

-- --------------------------------------------------------

--
-- Struktur dari tabel `majors`
--

CREATE TABLE `majors` (
  `id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `update_at` timestamp NULL DEFAULT NULL ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `majors`
--

INSERT INTO `majors` (`id`, `name`, `created_at`, `update_at`) VALUES
(3, 'web programming', '2025-06-04 06:35:51', NULL),
(5, 'Gamers', '2025-06-05 03:37:58', NULL),
(8, 'matematika', '2025-06-10 03:20:06', NULL);

-- --------------------------------------------------------

--
-- Struktur dari tabel `menus`
--

CREATE TABLE `menus` (
  `id` int(11) NOT NULL,
  `parent_id` int(11) DEFAULT NULL,
  `name` varchar(50) NOT NULL,
  `icon` varchar(50) NOT NULL,
  `url` varchar(50) DEFAULT NULL,
  `urutan` int(5) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `update_at` timestamp NULL DEFAULT NULL ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `menus`
--

INSERT INTO `menus` (`id`, `parent_id`, `name`, `icon`, `url`, `urutan`, `created_at`, `update_at`) VALUES
(1, 0, 'Dashboard', 'bi bi-grid', 'home.php', 1, '2025-06-11 04:21:59', '2025-06-11 05:28:23'),
(2, 0, 'master data', 'bi bi-menu-button-wide', '', 2, '2025-06-11 04:29:56', '2025-06-11 05:28:24'),
(5, 2, 'Instructors', 'bi bi-circle', 'instructor', 1, '2025-06-11 05:29:59', '2025-06-11 06:48:43'),
(6, 2, 'major', 'bi bi-circle', 'major', 2, '2025-06-11 05:29:59', '2025-06-11 06:37:28'),
(7, 2, 'Menu', 'bi bi-circle', 'menu', 3, '2025-06-11 06:31:03', NULL),
(8, 2, 'Users', 'bi bi-circle', 'user', 4, '2025-06-11 06:38:50', '2025-06-11 08:10:01'),
(9, 2, 'Roles', 'bi bi-circle', 'role', 5, '2025-06-11 06:56:42', '2025-06-11 08:08:31');

-- --------------------------------------------------------

--
-- Struktur dari tabel `module_details`
--

CREATE TABLE `module_details` (
  `id` int(11) NOT NULL,
  `id_modul` int(11) NOT NULL,
  `file` varchar(100) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `update_at` timestamp NULL DEFAULT NULL ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `module_details`
--

INSERT INTO `module_details` (`id`, `id_modul`, `file`, `created_at`, `update_at`) VALUES
(10, 26, '6847b715dd191-assets.zip', '2025-06-10 04:39:49', NULL),
(11, 27, '6847d7a861460-tugas LEFT & RIGHT JOIN DB_UMAR.txt', '2025-06-10 06:58:48', NULL),
(12, 28, '6847d874b05c3-Validitas dan reliabilitas suatu instrumen penelitian.pdf', '2025-06-10 07:02:12', NULL);

-- --------------------------------------------------------

--
-- Struktur dari tabel `moduls`
--

CREATE TABLE `moduls` (
  `id` int(11) NOT NULL,
  `id_major` int(11) NOT NULL,
  `id_instructor` int(11) NOT NULL,
  `name` varchar(122) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `update_at` timestamp NULL DEFAULT NULL ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `moduls`
--

INSERT INTO `moduls` (`id`, `id_major`, `id_instructor`, `name`, `created_at`, `update_at`) VALUES
(2, 3, 4, 'pdf', '2025-06-10 06:58:48', '2025-06-10 07:56:31'),
(3, 3, 4, 'dokumen', '2025-06-10 07:02:12', '2025-06-10 07:56:39');

-- --------------------------------------------------------

--
-- Struktur dari tabel `roles`
--

CREATE TABLE `roles` (
  `id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `update_at` timestamp NULL DEFAULT NULL ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `roles`
--

INSERT INTO `roles` (`id`, `name`, `created_at`, `update_at`) VALUES
(2, 'admininstrator', '2025-06-04 02:31:47', '2025-06-11 01:21:37'),
(3, 'admin', '2025-06-11 01:20:57', '2025-06-11 01:21:44'),
(4, 'instructor', '2025-06-11 01:21:08', NULL),
(5, 'PIC', '2025-06-11 01:21:16', NULL),
(6, 'student', '2025-06-11 01:22:03', NULL);

-- --------------------------------------------------------

--
-- Struktur dari tabel `students`
--

CREATE TABLE `students` (
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
-- Dumping data untuk tabel `students`
--

INSERT INTO `students` (`id`, `name`, `gender`, `education`, `phone`, `email`, `password`, `address`, `created_at`, `update_at`) VALUES
(5, 'si william', 0, 'Nusa Mandiri', '85772169466', 'will@gmail.com', '8cb2237d0679ca88db6464eac60da96345513964', 'jln.surabaya Nasgor manchester united', '2025-06-05 08:05:12', '2025-06-11 02:39:26');

-- --------------------------------------------------------

--
-- Struktur dari tabel `users`
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
-- Dumping data untuk tabel `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `password`, `created_at`, `update_at`, `deleted_at`) VALUES
(1, 'umar', 'admin@gmail.com', '12345', '2025-06-03 02:50:21', '2025-06-11 08:02:35', 0),
(7, 'anjirlah', 'kakkkak@gmail.com', '20202020', '2025-06-03 08:07:04', '2025-06-11 08:02:41', 0);

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `instructors`
--
ALTER TABLE `instructors`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `instructors_majors`
--
ALTER TABLE `instructors_majors`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `majors`
--
ALTER TABLE `majors`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `menus`
--
ALTER TABLE `menus`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `module_details`
--
ALTER TABLE `module_details`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `moduls`
--
ALTER TABLE `moduls`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `students`
--
ALTER TABLE `students`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `instructors`
--
ALTER TABLE `instructors`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT untuk tabel `instructors_majors`
--
ALTER TABLE `instructors_majors`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT untuk tabel `majors`
--
ALTER TABLE `majors`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT untuk tabel `menus`
--
ALTER TABLE `menus`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT untuk tabel `module_details`
--
ALTER TABLE `module_details`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT untuk tabel `moduls`
--
ALTER TABLE `moduls`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

--
-- AUTO_INCREMENT untuk tabel `roles`
--
ALTER TABLE `roles`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT untuk tabel `students`
--
ALTER TABLE `students`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT untuk tabel `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
