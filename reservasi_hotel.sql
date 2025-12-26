-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 18, 2025 at 12:18 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.0.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `reservasi_hotel`
--

-- --------------------------------------------------------

--
-- Table structure for table `cache`
--

CREATE TABLE `cache` (
  `key` varchar(255) NOT NULL,
  `value` mediumtext NOT NULL,
  `expiration` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `cache_locks`
--

CREATE TABLE `cache_locks` (
  `key` varchar(255) NOT NULL,
  `owner` varchar(255) NOT NULL,
  `expiration` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` varchar(255) NOT NULL,
  `connection` text NOT NULL,
  `queue` text NOT NULL,
  `payload` longtext NOT NULL,
  `exception` longtext NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `jobs`
--

CREATE TABLE `jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `queue` varchar(255) NOT NULL,
  `payload` longtext NOT NULL,
  `attempts` tinyint(3) UNSIGNED NOT NULL,
  `reserved_at` int(10) UNSIGNED DEFAULT NULL,
  `available_at` int(10) UNSIGNED NOT NULL,
  `created_at` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `job_batches`
--

CREATE TABLE `job_batches` (
  `id` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `total_jobs` int(11) NOT NULL,
  `pending_jobs` int(11) NOT NULL,
  `failed_jobs` int(11) NOT NULL,
  `failed_job_ids` longtext NOT NULL,
  `options` mediumtext DEFAULT NULL,
  `cancelled_at` int(11) DEFAULT NULL,
  `created_at` int(11) NOT NULL,
  `finished_at` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `kamars`
--

CREATE TABLE `kamars` (
  `id_kamar` bigint(20) UNSIGNED NOT NULL,
  `id_hotel` bigint(20) UNSIGNED DEFAULT NULL,
  `tipe_kamar` varchar(255) NOT NULL,
  `harga` bigint(20) UNSIGNED NOT NULL,
  `foto_utama` varchar(255) DEFAULT NULL,
  `deskripsi` text DEFAULT NULL,
  `fasilitas` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`fasilitas`)),
  `kapasitas` int(10) UNSIGNED NOT NULL DEFAULT 2 COMMENT 'Jumlah maksimal tamu per kamar',
  `status` enum('available','booked','maintenance','unavailable') NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `kamars`
--

INSERT INTO `kamars` (`id_kamar`, `id_hotel`, `tipe_kamar`, `harga`, `foto_utama`, `deskripsi`, `fasilitas`, `kapasitas`, `status`, `created_at`, `updated_at`) VALUES
(1, NULL, 'Family Room', 10000000, '1765496595_family.avif', 'Tipe Kamar Ini Adalah Untuk Keluar', '[]', 2, 'available', '2025-12-11 16:43:15', '2025-12-17 23:18:28'),
(2, NULL, 'Connecting Room', 8000000, '1765496815_connecting room.jpg', 'Tipe kamar yang saling terhubung', '\"[\\\"WiFi\\\",\\\"AC\\\",\\\"TV\\\",\\\"Sarapan\\\",\\\"Kamar Mandi Dalam\\\",\\\"Air Panas\\\",\\\"Lemari\\\",\\\"Meja Kerja\\\"]\"', 2, 'available', '2025-12-11 16:46:55', '2025-12-11 16:46:55'),
(3, NULL, 'Standard Room', 6000000, '1765497001_Standard-Room-2.jpg', 'Tipe yang sangat sederhana dan standar dari biasanya', '[]', 2, 'available', '2025-12-11 16:50:01', '2025-12-12 04:05:32'),
(4, NULL, 'Family Room', 7500000, '1766056325_family room 2.jpg', NULL, '[\"WiFi\",\"AC\",\"TV\",\"Sarapan\",\"Kamar Mandi Dalam\",\"Air Panas\",\"Lemari\",\"Meja Kerja\"]', 5, 'available', '2025-12-18 04:12:05', '2025-12-18 04:12:05');

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '0001_01_01_000000_create_users_table', 1),
(2, '0001_01_01_000001_create_cache_table', 1),
(3, '0001_01_01_000002_create_jobs_table', 1),
(4, '2025_11_25_061752_create_kamars_table', 1),
(5, '2025_11_25_061753_create_reservasis_table', 1),
(6, '2025_11_25_061800_create_pembayarans_table', 1),
(7, '2025_12_10_220901_create_payments_table', 1),
(8, '2025_12_10_222212_rename_nama_to_name_in_users_table', 1),
(9, '2025_12_11_101903_add_foto_utama_to_kamars_table', 1),
(10, '2025_12_11_124534_add_deskripsi_fasilitas_to_kamars_table', 1),
(11, '2025_12_11_153428_add_kapasitas_to_kamars_table', 1),
(12, '2025_12_11_155101_alter_harga_column_in_kamars_table', 1),
(13, '2025_12_11_161540_create_notifikasis_table', 1);

-- --------------------------------------------------------

--
-- Table structure for table `notifikasis`
--

CREATE TABLE `notifikasis` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `id_user` bigint(20) UNSIGNED NOT NULL,
  `judul` varchar(255) NOT NULL,
  `pesan` text NOT NULL,
  `is_read` tinyint(1) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `password_reset_tokens`
--

CREATE TABLE `password_reset_tokens` (
  `email` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `payments`
--

CREATE TABLE `payments` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `reservasi_id` bigint(20) UNSIGNED NOT NULL,
  `bukti_pembayaran` varchar(255) DEFAULT NULL,
  `status` enum('pending','confirmed','rejected') NOT NULL DEFAULT 'pending',
  `admin_id` bigint(20) UNSIGNED DEFAULT NULL,
  `tanggal_upload` timestamp NULL DEFAULT NULL,
  `tanggal_verifikasi` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `pembayarans`
--

CREATE TABLE `pembayarans` (
  `id_pembayaran` bigint(20) UNSIGNED NOT NULL,
  `id_reservasi` bigint(20) UNSIGNED NOT NULL,
  `metode_bayar` varchar(255) NOT NULL,
  `jumlah` int(11) NOT NULL,
  `status` enum('pending','success','failed') NOT NULL DEFAULT 'pending',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `reservasis`
--

CREATE TABLE `reservasis` (
  `id_reservasi` bigint(20) UNSIGNED NOT NULL,
  `id_user` bigint(20) UNSIGNED NOT NULL,
  `id_kamar` bigint(20) UNSIGNED NOT NULL,
  `tgl_checkin` date NOT NULL,
  `tgl_checkout` date NOT NULL,
  `status_pembayaran` enum('pending','verified','rejected') NOT NULL DEFAULT 'pending',
  `status_reservasi` enum('pending','confirmed','cancelled') NOT NULL DEFAULT 'pending',
  `jumlah_tamu` int(11) NOT NULL DEFAULT 1,
  `total_harga` bigint(20) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `reservasis`
--

INSERT INTO `reservasis` (`id_reservasi`, `id_user`, `id_kamar`, `tgl_checkin`, `tgl_checkout`, `status_pembayaran`, `status_reservasi`, `jumlah_tamu`, `total_harga`, `created_at`, `updated_at`) VALUES
(1, 4, 2, '2025-12-16', '2025-12-20', 'pending', 'pending', 2, 32000000, '2025-12-16 05:10:00', '2025-12-16 05:10:00'),
(2, 4, 3, '2025-12-17', '2025-12-20', 'pending', 'pending', 2, 18000000, '2025-12-16 10:58:11', '2025-12-16 10:58:11'),
(3, 9, 3, '2025-12-22', '2025-12-23', 'pending', 'confirmed', 1, 6000000, '2025-12-17 23:17:34', '2025-12-17 23:26:44');

-- --------------------------------------------------------

--
-- Table structure for table `sessions`
--

CREATE TABLE `sessions` (
  `id` varchar(255) NOT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `ip_address` varchar(45) DEFAULT NULL,
  `user_agent` text DEFAULT NULL,
  `payload` longtext NOT NULL,
  `last_activity` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `sessions`
--

INSERT INTO `sessions` (`id`, `user_id`, `ip_address`, `user_agent`, `payload`, `last_activity`) VALUES
('7Yi23eJjd5oMA6D8LtBH5Su5waSawxZdOkLj7lOn', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/143.0.0.0 Safari/537.36', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiazJqb3ltdFFlYUNQdTBUS2I0VkxCcVExTFpKY0VubFdNa1V0ejA2WSI7czo2OiJfZmxhc2giO2E6Mjp7czozOiJuZXciO2E6MDp7fXM6Mzoib2xkIjthOjA6e319czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6MjE6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMCI7czo1OiJyb3V0ZSI7Tjt9fQ==', 1766056597);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id_user` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `role` enum('admin','tamu') NOT NULL DEFAULT 'tamu',
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id_user`, `name`, `email`, `password`, `role`, `remember_token`, `created_at`, `updated_at`) VALUES
(3, 'Super Admin', 'admin@example.com', '$2y$12$lBuyPF1M11qE8gQ79TW2v.UXgIro1Lxu683PyQoUNFE00Eyt9x3Gi', 'admin', NULL, '2025-12-11 16:24:04', '2025-12-11 16:24:04'),
(4, 'tamu', 'tamu@gmail.com', '$2y$12$uaGKbcL9wVKimvOA30qyl.W/0ZTKZjsf5yarp30dq1fLXu1v2zDv.', 'tamu', NULL, '2025-12-11 16:44:37', '2025-12-11 16:44:37'),
(5, 'Admin Bujang', 'admin@gmail.com', '$2y$12$h7ClocUQeQ6M6EyALxJwk.6tSsHNd8NfwAqKTCn5l35ndZplGLzOi', 'admin', NULL, '2025-12-11 16:45:53', '2025-12-11 16:45:53'),
(6, 'pal', 'nopal@gmail.com', '$2y$12$tYwPXXoGJJEQYCEe/xbrCOIa46eCYrIQ0xiW8V7rDDJe2HOzHjn7i', 'admin', NULL, '2025-12-11 17:31:08', '2025-12-11 17:31:08'),
(7, 'pal', 'pal@gmail.com', '$2y$12$J.T3IbEMJQpfE/Hi3UsGXuUMHD7IJvSHwDBpu87jJYjZ32XBB8tUK', 'tamu', NULL, '2025-12-11 17:31:27', '2025-12-11 17:31:27'),
(8, 'pal123', 'pal@yahoo.com', '$2y$12$ete4eHWBjSeaeMwFt/msW.DdcZNZmk52aL9/occz5iTtx/LagctWK', 'tamu', NULL, '2025-12-11 17:31:56', '2025-12-11 17:31:56'),
(9, 'ucok', 'ucok@gmail.com', '$2y$12$3X.yMGuvaKW2Tj.Ill6FPempj0RhyjYO6/S7IPya6J2GJe3klrAGO', 'tamu', NULL, '2025-12-17 23:01:32', '2025-12-17 23:01:32');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `cache`
--
ALTER TABLE `cache`
  ADD PRIMARY KEY (`key`);

--
-- Indexes for table `cache_locks`
--
ALTER TABLE `cache_locks`
  ADD PRIMARY KEY (`key`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indexes for table `jobs`
--
ALTER TABLE `jobs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `jobs_queue_index` (`queue`);

--
-- Indexes for table `job_batches`
--
ALTER TABLE `job_batches`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `kamars`
--
ALTER TABLE `kamars`
  ADD PRIMARY KEY (`id_kamar`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `notifikasis`
--
ALTER TABLE `notifikasis`
  ADD PRIMARY KEY (`id`),
  ADD KEY `notifikasis_id_user_foreign` (`id_user`);

--
-- Indexes for table `password_reset_tokens`
--
ALTER TABLE `password_reset_tokens`
  ADD PRIMARY KEY (`email`);

--
-- Indexes for table `payments`
--
ALTER TABLE `payments`
  ADD PRIMARY KEY (`id`),
  ADD KEY `payments_reservasi_id_foreign` (`reservasi_id`);

--
-- Indexes for table `pembayarans`
--
ALTER TABLE `pembayarans`
  ADD PRIMARY KEY (`id_pembayaran`),
  ADD KEY `pembayarans_id_reservasi_foreign` (`id_reservasi`);

--
-- Indexes for table `reservasis`
--
ALTER TABLE `reservasis`
  ADD PRIMARY KEY (`id_reservasi`),
  ADD KEY `reservasis_id_user_foreign` (`id_user`),
  ADD KEY `reservasis_id_kamar_foreign` (`id_kamar`);

--
-- Indexes for table `sessions`
--
ALTER TABLE `sessions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sessions_user_id_index` (`user_id`),
  ADD KEY `sessions_last_activity_index` (`last_activity`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id_user`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `jobs`
--
ALTER TABLE `jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `kamars`
--
ALTER TABLE `kamars`
  MODIFY `id_kamar` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `notifikasis`
--
ALTER TABLE `notifikasis`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `payments`
--
ALTER TABLE `payments`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `pembayarans`
--
ALTER TABLE `pembayarans`
  MODIFY `id_pembayaran` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `reservasis`
--
ALTER TABLE `reservasis`
  MODIFY `id_reservasi` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id_user` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `notifikasis`
--
ALTER TABLE `notifikasis`
  ADD CONSTRAINT `notifikasis_id_user_foreign` FOREIGN KEY (`id_user`) REFERENCES `users` (`id_user`) ON DELETE CASCADE;

--
-- Constraints for table `payments`
--
ALTER TABLE `payments`
  ADD CONSTRAINT `payments_reservasi_id_foreign` FOREIGN KEY (`reservasi_id`) REFERENCES `reservasis` (`id_reservasi`) ON DELETE CASCADE;

--
-- Constraints for table `pembayarans`
--
ALTER TABLE `pembayarans`
  ADD CONSTRAINT `pembayarans_id_reservasi_foreign` FOREIGN KEY (`id_reservasi`) REFERENCES `reservasis` (`id_reservasi`) ON DELETE CASCADE;

--
-- Constraints for table `reservasis`
--
ALTER TABLE `reservasis`
  ADD CONSTRAINT `reservasis_id_kamar_foreign` FOREIGN KEY (`id_kamar`) REFERENCES `kamars` (`id_kamar`) ON DELETE CASCADE,
  ADD CONSTRAINT `reservasis_id_user_foreign` FOREIGN KEY (`id_user`) REFERENCES `users` (`id_user`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
