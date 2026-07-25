-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 24, 2026 at 10:14 AM
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
-- Database: `warung_nusantara`
--

-- --------------------------------------------------------

--
-- Table structure for table `makanan`
--

CREATE TABLE `makanan` (
  `id` int(11) UNSIGNED NOT NULL,
  `user_id` int(11) UNSIGNED DEFAULT NULL COMMENT 'pemilik/penjual produk',
  `nama_makanan` varchar(100) NOT NULL,
  `kategori` varchar(50) NOT NULL,
  `harga` int(11) NOT NULL,
  `stok` int(11) NOT NULL DEFAULT 0,
  `deskripsi` text DEFAULT NULL,
  `gambar` varchar(255) DEFAULT NULL,
  `status` varchar(20) NOT NULL DEFAULT 'Tersedia',
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `makanan`
--

INSERT INTO `makanan` (`id`, `user_id`, `nama_makanan`, `kategori`, `harga`, `stok`, `deskripsi`, `gambar`, `status`, `created_at`, `updated_at`) VALUES
(1, 2, 'Mie Ayam', 'Makanan Berat', 15000, 25, 'Mie ayam dengan topping ayam suwir, pangsit, dan sayuran segar.', 'mie-ayam.jpg', 'Tersedia', '2026-07-22 09:09:43', '2026-07-23 10:58:49'),
(3, 2, 'Soto Ayam', 'Makanan Berat', 16000, 18, 'Soto ayam kuah bening dengan suwiran ayam, telur, dan taburan bawang goreng.', 'soto-ayam.jpg', 'Tersedia', '2026-07-22 09:09:43', '2026-07-23 11:02:08'),
(4, 2, 'Sate Ayam', 'Makanan Berat', 20000, 15, 'Sate ayam bakar dengan bumbu kacang khas, disajikan dengan lontong.', 'sate-ayam.jpg', 'Tersedia', '2026-07-22 09:09:43', '2026-07-23 11:02:28'),
(5, 2, 'Nasi Goreng', 'Makanan Berat', 15000, 22, 'Nasi goreng spesial dengan telur, ayam suwir, dan acar segar.', 'nasi-goreng.jpg', 'Tersedia', '2026-07-22 09:09:43', '2026-07-23 11:06:24'),
(6, 2, 'Es Teh Manis', 'Minuman', 5000, 40, 'Es teh manis segar cocok menemani makan siang.', 'es-teh.jpg', 'Tersedia', '2026-07-22 09:09:43', '2026-07-23 11:05:50'),
(7, 1, 'seblak', 'makanan berat', 20000, 30, 'Perpaduan kuah segar dan frozen food gurih', 'seblak.webp', 'Tersedia', '2026-07-22 10:26:42', '2026-07-23 11:01:42'),
(8, 1, 'lemon tea', 'minuman', 8000, 45, 'Kombinasi klasik seduhan teh premium dan perasan buah lemon segar', 'lemon-tea.jpg', 'Tersedia', '2026-07-22 10:27:57', '2026-07-23 11:05:09'),
(9, 1, 'Sea Salt Caramel Macchiato', 'minuman', 15000, 45, 'Kombinasi harmonis dari manisnya saus karamel dan gurih asin sea salt yang dipadukan dengan creamy susu serta espressso', 'sea-salt-caramel-macchiato.webp', 'Tersedia', '2026-07-22 10:30:23', '2026-07-23 11:00:57'),
(10, 1, 'Americano', 'minuman', 13000, 45, 'Kombinasi double shot espresso berkualitas tinggi dan air panas yang pas', 'americano.webp', 'Tersedia', '2026-07-22 10:32:22', '2026-07-23 11:00:40'),
(11, 1, 'Cafe Latte', 'minuman', 18000, 36, 'Kombinasi sempurna satu shot espresso paket dan dominasi creamy steamed milk dengan lapisan busa tipis diatasnya', 'caffe-latte.webp', 'Tersedia', '2026-07-22 10:33:00', '2026-07-23 11:00:25'),
(12, 1, 'Cafe Mocha', 'minuman', 20000, 28, 'Kombinasi harmonis espresso, coklat premium, dan creamy', 'cafe-mocha.webp', 'Tersedia', '2026-07-22 10:33:38', '2026-07-23 10:59:59'),
(13, 1, 'Ayam Geprek', 'makanan berat', 13000, 23, 'Ayam geprek renyah berbalur sambal pedas, segar dan gurih', 'ayam-geprek.jpg', 'Tersedia', '2026-07-22 10:34:33', '2026-07-23 10:59:44');

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `version` varchar(255) NOT NULL,
  `class` varchar(255) NOT NULL,
  `group` varchar(255) NOT NULL,
  `namespace` varchar(255) NOT NULL,
  `time` int(11) NOT NULL,
  `batch` int(11) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `version`, `class`, `group`, `namespace`, `time`, `batch`) VALUES
(1, '2026-07-21-000001', 'App\\Database\\Migrations\\CreateMakananTable', 'default', 'App', 1784880350, 1),
(2, '2026-07-21-000002', 'App\\Database\\Migrations\\CreateUsersTable', 'default', 'App', 1784880350, 1),
(3, '2026-07-21-000003', 'App\\Database\\Migrations\\AddUserIdToMakanan', 'default', 'App', 1784880350, 1),
(4, '2026-07-21-000004', 'App\\Database\\Migrations\\CreatePesananTable', 'default', 'App', 1784880350, 1);

-- --------------------------------------------------------

--
-- Table structure for table `pesanan`
--

CREATE TABLE `pesanan` (
  `id` int(11) UNSIGNED NOT NULL,
  `user_id` int(11) UNSIGNED NOT NULL COMMENT 'pembeli yang memesan',
  `makanan_id` int(11) UNSIGNED NOT NULL,
  `penjual_id` int(11) UNSIGNED DEFAULT NULL COMMENT 'pemilik makanan saat dipesan (snapshot)',
  `jumlah` int(11) NOT NULL DEFAULT 1,
  `total_harga` int(11) NOT NULL DEFAULT 0,
  `catatan` text DEFAULT NULL,
  `status` varchar(20) NOT NULL DEFAULT 'Menunggu' COMMENT 'Menunggu | Diproses | Selesai | Dibatalkan',
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) UNSIGNED NOT NULL,
  `nama` varchar(100) NOT NULL,
  `username` varchar(50) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL,
  `role` varchar(20) NOT NULL DEFAULT 'pembeli' COMMENT 'admin | penjual | pembeli',
  `no_hp` varchar(20) DEFAULT NULL,
  `alamat` text DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `nama`, `username`, `email`, `password`, `role`, `no_hp`, `alamat`, `created_at`, `updated_at`) VALUES
(1, 'Admin Warung', 'admin', 'admin@warungnusantara.test', '$2y$10$EZ7Nnfwl316R5KTzN5cE0O6u2G33l6X9t6fJnCKcniZcfJLKbxGwS', 'admin', NULL, NULL, '2026-07-24 08:05:50', '2026-07-24 08:05:50'),
(2, 'Budi Penjual', 'penjual1', 'penjual1@warungnusantara.test', '$2y$10$RVe26XuBiMj1qsgClduyu.WwXe8Py/OcAkfFsw9J3R7f2BLfjVbnu', 'penjual', NULL, NULL, '2026-07-24 08:05:50', '2026-07-24 08:05:50'),
(3, 'Sari Pembeli', 'pembeli1', 'pembeli1@warungnusantara.test', '$2y$10$9ZLjCwafaVgu6iFfEuQ.GuyxOAcv3u.c8/j5yjbYzd6yxwdh0xYoG', 'pembeli', NULL, NULL, '2026-07-24 08:05:50', '2026-07-24 08:05:50');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `makanan`
--
ALTER TABLE `makanan`
  ADD PRIMARY KEY (`id`),
  ADD KEY `makanan_user_id` (`user_id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `pesanan`
--
ALTER TABLE `pesanan`
  ADD PRIMARY KEY (`id`),
  ADD KEY `pesanan_user_id` (`user_id`),
  ADD KEY `pesanan_makanan_id` (`makanan_id`),
  ADD KEY `pesanan_penjual_id` (`penjual_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_username` (`username`),
  ADD UNIQUE KEY `users_email` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `makanan`
--
ALTER TABLE `makanan`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `pesanan`
--
ALTER TABLE `pesanan`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `makanan`
--
ALTER TABLE `makanan`
  ADD CONSTRAINT `makanan_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE SET NULL ON UPDATE CASCADE;

--
-- Constraints for table `pesanan`
--
ALTER TABLE `pesanan`
  ADD CONSTRAINT `pesanan_makanan_id_foreign` FOREIGN KEY (`makanan_id`) REFERENCES `makanan` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `pesanan_penjual_id_foreign` FOREIGN KEY (`penjual_id`) REFERENCES `users` (`id`) ON DELETE SET NULL ON UPDATE CASCADE,
  ADD CONSTRAINT `pesanan_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
