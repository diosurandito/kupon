-- phpMyAdmin SQL Dump
-- version 4.9.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 17 Mar 2021 pada 08.27
-- Versi server: 10.4.11-MariaDB
-- Versi PHP: 7.3.13

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `kupon_db`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `admins`
--

CREATE TABLE `admins` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `nik` varchar(12) COLLATE utf8mb4_unicode_ci NOT NULL,
  `kode_akses` varchar(9) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'sdp_adm_1',
  `nickname` varchar(15) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `admins`
--

INSERT INTO `admins` (`id`, `nik`, `kode_akses`, `nickname`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, '201901150857', 'sdp_adm_1', 'Nina', '2020-10-19 17:00:00', NULL, NULL),
(2, '201709250688', 'sdp_adm_1', 'Niko', '2020-10-24 17:00:00', NULL, NULL),
(3, '201911250887', 'sdp_adm_1', 'Dio', '2020-10-24 17:00:00', NULL, NULL);

-- --------------------------------------------------------

--
-- Struktur dari tabel `customers`
--

CREATE TABLE `customers` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `nama` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `no_telp` varchar(25) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `customers`
--

INSERT INTO `customers` (`id`, `nama`, `no_telp`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'Wawan', '087756569000', NULL, NULL, NULL),
(2, 'Iwan', '087756569001', NULL, NULL, NULL),
(3, 'Bayu', '087711114444', '2021-03-11 12:33:08', '2021-03-11 12:33:08', NULL),
(5, 'Dio', '087737781051', '2021-03-11 12:50:16', '2021-03-11 12:50:16', NULL),
(6, 'Reva Angga', '087754541829', '2021-03-17 02:34:24', '2021-03-17 02:34:24', NULL),
(7, 'Amelia Anatalia', '089744442020', '2021-03-17 05:47:18', '2021-03-17 05:47:18', NULL);

-- --------------------------------------------------------

--
-- Struktur dari tabel `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_resets_table', 1),
(3, '2021_02_23_100230_create_vouchers_table', 1),
(4, '2021_02_23_100343_create_transactions_table', 1),
(5, '2021_02_23_100521_create_customers_table', 1),
(6, '2021_02_23_100610_create_transaction_details_table', 1);

-- --------------------------------------------------------

--
-- Struktur dari tabel `transactions`
--

CREATE TABLE `transactions` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `id_user` int(20) UNSIGNED NOT NULL,
  `tgl_transaksi` date DEFAULT NULL,
  `ttl_transaksi` bigint(20) NOT NULL,
  `keterangan` varchar(200) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `transactions`
--

INSERT INTO `transactions` (`id`, `id_user`, `tgl_transaksi`, `ttl_transaksi`, `keterangan`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 1, '2021-03-10', 1600000, 'Toyota Avanza - CPF1 Black 80 Full', NULL, NULL, NULL),
(2, 2, '2021-03-10', 2300000, 'Toyota Fortuner - LLumar Black 60 Samping', NULL, NULL, NULL),
(4, 3, '2021-03-11', 3000000, 'Toyota Avanza - LLumar Black 80 Full', '2021-03-11 12:33:08', '2021-03-11 12:33:08', NULL),
(6, 5, '2021-03-11', 2000000, 'Toyota Fortuner - LLumar Black 60 Samping', '2021-03-11 12:50:16', '2021-03-11 12:50:16', NULL),
(7, 6, '2021-03-17', 5000000, 'Honda B-RV - LLumar SB 50 Full', '2021-03-17 02:34:24', '2021-03-17 02:34:24', NULL),
(8, 7, '2021-03-17', 2400000, 'Wuling Almaz - LLumar SB 50 full', '2021-03-17 05:47:18', '2021-03-17 05:47:18', NULL);

-- --------------------------------------------------------

--
-- Struktur dari tabel `transaction_details`
--

CREATE TABLE `transaction_details` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `id_transaksi` int(10) UNSIGNED NOT NULL,
  `kode_voucher` varchar(15) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `transaction_details`
--

INSERT INTO `transaction_details` (`id`, `id_transaksi`, `kode_voucher`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 1, 'JKI/V/LMR-00001', NULL, NULL, NULL),
(2, 1, 'JKI/V/LMR-00002', NULL, NULL, NULL),
(3, 2, 'JKI/V/LMR-00003', NULL, NULL, NULL),
(4, 2, 'JKI/V/LMR-00004', NULL, NULL, NULL),
(5, 2, 'JKI/V/LMR-00005', NULL, NULL, NULL),
(6, 4, 'JKI/V/LMR-00006', '2021-03-11 12:33:08', '2021-03-11 12:33:08', NULL),
(7, 4, 'JKI/V/LMR-00007', '2021-03-11 12:33:08', '2021-03-11 12:33:08', NULL),
(9, 6, 'JKI/V/LMR-00008', '2021-03-11 12:50:16', '2021-03-11 12:50:16', NULL),
(10, 6, 'JKI/V/LMR-00009', '2021-03-11 12:50:16', '2021-03-11 12:50:16', NULL),
(11, 7, 'JKI/V/LMR-00010', '2021-03-17 02:34:24', '2021-03-17 02:34:24', NULL),
(12, 8, 'JKI/V/LMR-00011', '2021-03-17 05:47:18', '2021-03-17 05:47:18', NULL),
(13, 8, 'JKI/V/LMR-00012', '2021-03-17 05:47:18', '2021-03-17 05:47:18', NULL);

-- --------------------------------------------------------

--
-- Struktur dari tabel `vouchers`
--

CREATE TABLE `vouchers` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `kode_voucher` varchar(15) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nilai` bigint(20) NOT NULL,
  `vc_flag` int(2) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `vouchers`
--

INSERT INTO `vouchers` (`id`, `kode_voucher`, `nilai`, `vc_flag`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'JKI/V/LMR-00001', 200000, 1, '2021-02-15 20:00:00', NULL, NULL),
(2, 'JKI/V/LMR-00002', 100000, 1, '2021-02-25 07:58:04', NULL, NULL),
(3, 'JKI/V/LMR-00003', 100000, 1, '2021-02-25 07:58:04', NULL, NULL),
(4, 'JKI/V/LMR-00004', 250000, 1, '2021-02-25 07:58:04', NULL, NULL),
(5, 'JKI/V/LMR-00005', 200000, 1, '2021-02-25 07:58:04', NULL, NULL),
(6, 'JKI/V/LMR-00006', 150000, 1, '2021-02-25 07:58:04', NULL, NULL),
(7, 'JKI/V/LMR-00007', 250000, 1, '2021-02-25 07:58:04', NULL, NULL),
(8, 'JKI/V/LMR-00008', 150000, 1, '2021-02-25 07:58:04', '2021-03-11 12:50:16', NULL),
(9, 'JKI/V/LMR-00009', 350000, 1, '2021-02-25 07:58:04', '2021-03-11 12:50:16', NULL),
(10, 'JKI/V/LMR-00010', 100000, 1, '2021-02-25 07:58:04', '2021-03-17 02:34:24', NULL),
(11, 'JKI/V/LMR-00011', 350000, 1, '2021-02-25 07:58:04', '2021-03-17 05:47:18', NULL),
(12, 'JKI/V/LMR-00012', 100000, 1, '2021-02-25 07:58:04', '2021-03-17 05:47:18', NULL),
(13, 'JKI/V/LMR-00013', 250000, 0, '2021-02-25 07:58:04', NULL, NULL),
(14, 'JKI/V/LMR-00014', 350000, 0, '2021-02-25 07:58:04', NULL, NULL),
(15, 'JKI/V/LMR-00015', 100000, 0, '2021-02-25 07:58:04', NULL, NULL),
(16, 'JKI/V/LMR-00016', 100000, 0, '2021-02-25 07:58:04', NULL, NULL),
(17, 'JKI/V/LMR-00017', 150000, 0, '2021-02-25 07:58:04', NULL, NULL),
(18, 'JKI/V/LMR-00018', 100000, 0, '2021-02-25 07:58:04', NULL, NULL),
(19, 'JKI/V/LMR-00019', 350000, 0, '2021-02-25 07:58:04', NULL, NULL),
(20, 'JKI/V/LMR-00020', 150000, 0, '2021-02-25 07:58:04', NULL, NULL),
(21, 'JKI/V/LMR-00021', 200000, 0, '2021-02-25 07:58:04', NULL, NULL),
(22, 'JKI/V/LMR-00022', 200000, 0, '2021-02-25 07:58:04', NULL, NULL),
(23, 'JKI/V/LMR-00023', 150000, 0, '2021-02-25 07:58:05', NULL, NULL),
(24, 'JKI/V/LMR-00024', 350000, 0, '2021-02-25 07:58:05', NULL, NULL),
(25, 'JKI/V/LMR-00025', 100000, 0, '2021-02-25 07:58:05', NULL, NULL),
(26, 'JKI/V/LMR-00026', 200000, 0, '2021-02-25 07:58:05', NULL, NULL),
(27, 'JKI/V/LMR-00027', 250000, 0, '2021-02-25 07:58:05', NULL, NULL),
(28, 'JKI/V/LMR-00028', 200000, 0, '2021-02-25 07:58:05', NULL, NULL),
(29, 'JKI/V/LMR-00029', 350000, 0, '2021-02-25 07:58:05', NULL, NULL),
(30, 'JKI/V/LMR-00030', 200000, 0, '2021-02-25 07:58:05', NULL, NULL),
(31, 'JKI/V/LMR-00031', 200000, 0, '2021-02-25 07:58:05', NULL, NULL),
(32, 'JKI/V/LMR-00032', 100000, 0, '2021-02-25 07:58:05', NULL, NULL),
(33, 'JKI/V/LMR-00033', 150000, 0, '2021-02-25 07:58:05', NULL, NULL),
(34, 'JKI/V/LMR-00034', 250000, 0, '2021-02-25 07:58:05', NULL, NULL),
(35, 'JKI/V/LMR-00035', 150000, 0, '2021-02-25 07:58:05', NULL, NULL),
(36, 'JKI/V/LMR-00036', 150000, 0, '2021-02-25 07:58:05', NULL, NULL),
(37, 'JKI/V/LMR-00037', 200000, 0, '2021-02-25 07:58:05', NULL, NULL),
(38, 'JKI/V/LMR-00038', 350000, 0, '2021-02-25 07:58:05', NULL, NULL),
(39, 'JKI/V/LMR-00039', 150000, 0, '2021-02-25 07:58:05', NULL, NULL),
(40, 'JKI/V/LMR-00040', 200000, 0, '2021-02-25 07:58:05', NULL, NULL),
(41, 'JKI/V/LMR-00041', 350000, 0, '2021-02-25 07:58:05', NULL, NULL),
(42, 'JKI/V/LMR-00042', 350000, 0, '2021-02-25 07:58:05', NULL, NULL),
(43, 'JKI/V/LMR-00043', 250000, 0, '2021-02-25 07:58:05', NULL, NULL),
(44, 'JKI/V/LMR-00044', 200000, 0, '2021-02-25 07:58:05', NULL, NULL),
(45, 'JKI/V/LMR-00045', 350000, 0, '2021-02-25 07:58:05', NULL, NULL),
(46, 'JKI/V/LMR-00046', 100000, 0, '2021-02-25 07:58:05', NULL, NULL),
(47, 'JKI/V/LMR-00047', 350000, 0, '2021-02-25 07:58:05', NULL, NULL),
(48, 'JKI/V/LMR-00048', 150000, 0, '2021-02-25 07:58:05', NULL, NULL),
(49, 'JKI/V/LMR-00049', 350000, 0, '2021-02-25 07:58:05', NULL, NULL),
(50, 'JKI/V/LMR-00050', 350000, 0, '2021-02-25 07:58:05', NULL, NULL),
(51, 'JKI/V/LMR-00051', 250000, 0, '2021-03-08 07:49:25', '2021-03-09 01:51:18', NULL),
(82, 'JKI/V/LMR-00052', 150000, 0, '2021-03-10 07:10:46', '2021-03-10 07:10:46', NULL),
(83, 'JKI/V/LMR-00053', 200000, 0, '2021-03-10 07:10:46', '2021-03-10 07:10:46', NULL),
(84, 'JKI/V/LMR-00054', 300000, 0, '2021-03-10 07:10:46', '2021-03-10 07:10:46', NULL),
(85, 'JKI/V/LMR-00055', 250000, 0, '2021-03-10 07:10:46', '2021-03-10 07:10:46', NULL),
(86, 'JKI/V/LMR-00056', 150000, 0, '2021-03-10 07:14:54', '2021-03-10 07:14:54', NULL),
(87, 'JKI/V/LMR-00057', 200000, 0, '2021-03-10 07:14:54', '2021-03-10 07:14:54', NULL),
(88, 'JKI/V/LMR-00058', 300000, 0, '2021-03-10 07:14:54', '2021-03-10 07:14:54', NULL),
(89, 'JKI/V/LMR-00059', 250000, 0, '2021-03-10 07:14:54', '2021-03-10 07:14:54', NULL);

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `admins`
--
ALTER TABLE `admins`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `customers`
--
ALTER TABLE `customers`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `transactions`
--
ALTER TABLE `transactions`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `transaction_details`
--
ALTER TABLE `transaction_details`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `transaction_details_kode_voucher_unique` (`kode_voucher`);

--
-- Indeks untuk tabel `vouchers`
--
ALTER TABLE `vouchers`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `vouchers_kode_voucher_unique` (`kode_voucher`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `admins`
--
ALTER TABLE `admins`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT untuk tabel `customers`
--
ALTER TABLE `customers`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT untuk tabel `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT untuk tabel `transactions`
--
ALTER TABLE `transactions`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT untuk tabel `transaction_details`
--
ALTER TABLE `transaction_details`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT untuk tabel `vouchers`
--
ALTER TABLE `vouchers`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=90;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
