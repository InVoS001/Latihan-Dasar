-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 31 Mar 2022 pada 08.08
-- Versi server: 10.4.16-MariaDB
-- Versi PHP: 7.4.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `finance`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `kelompok_transaksi`
--

CREATE TABLE `kelompok_transaksi` (
  `id_kelompok_transaksi` smallint(6) NOT NULL,
  `nm_kelompok_transaksi` varchar(100) NOT NULL,
  `deleted_at` datetime DEFAULT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data untuk tabel `kelompok_transaksi`
--

INSERT INTO `kelompok_transaksi` (`id_kelompok_transaksi`, `nm_kelompok_transaksi`, `deleted_at`, `created_at`, `updated_at`) VALUES
(1, 'Keperluan Makan siang', NULL, '2021-10-22 13:57:49', '2021-11-19 03:55:25'),
(2, 'Rekreasi', NULL, '2021-10-22 13:57:49', '2021-10-22 13:57:49'),
(3, 'Kuliah dsb', '2021-11-05 07:38:56', '2021-11-05 02:15:07', '2021-11-05 07:38:56'),
(4, 'keperluan', '2021-12-08 09:07:11', '2021-11-19 03:56:45', '2021-12-08 09:07:11'),
(5, 'snack', NULL, '2021-12-08 14:01:47', '2021-12-08 14:01:47'),
(6, 'makan pokok', NULL, '2021-12-08 14:01:54', '2021-12-08 14:01:54');

-- --------------------------------------------------------

--
-- Struktur dari tabel `modul`
--

CREATE TABLE `modul` (
  `id_modul` int(11) NOT NULL,
  `nm_modul` varchar(255) DEFAULT NULL,
  `judul_modul` varchar(255) NOT NULL,
  `icon_modul` varchar(255) NOT NULL,
  `deleted_at` datetime DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data untuk tabel `modul`
--

INSERT INTO `modul` (`id_modul`, `nm_modul`, `judul_modul`, `icon_modul`, `deleted_at`, `created_at`, `updated_at`) VALUES
(1, 'kelompok_transaksi', 'Kelompok Transaksi', 'folder', NULL, '2021-11-19 13:32:29', '2021-11-19 13:32:29'),
(2, 'transaksi', 'Transaksi', 'shopping-cart', NULL, '2021-11-19 13:32:29', '2021-11-19 13:32:29');

-- --------------------------------------------------------

--
-- Struktur dari tabel `modul_role`
--

CREATE TABLE `modul_role` (
  `id_modul` int(11) NOT NULL,
  `id_role` int(11) NOT NULL,
  `is_create` tinyint(4) DEFAULT NULL,
  `is_read` tinyint(4) DEFAULT NULL,
  `is_update` tinyint(4) DEFAULT NULL,
  `is_delete` tinyint(4) DEFAULT NULL,
  `is_save` tinyint(4) DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data untuk tabel `modul_role`
--

INSERT INTO `modul_role` (`id_modul`, `id_role`, `is_create`, `is_read`, `is_update`, `is_delete`, `is_save`, `deleted_at`, `created_at`, `updated_at`) VALUES
(1, 1, 1, 1, 1, 1, 1, NULL, '2021-11-19 13:33:41', '2021-11-19 13:33:41'),
(1, 2, 0, 1, 0, 0, 0, NULL, '2021-11-19 13:35:10', '2021-11-19 13:35:10'),
(2, 1, 1, 1, 1, 1, 1, NULL, '2021-11-19 13:35:37', '2021-11-19 13:35:37');

-- --------------------------------------------------------

--
-- Struktur dari tabel `role`
--

CREATE TABLE `role` (
  `id_role` int(11) NOT NULL,
  `nm_role` varchar(255) DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data untuk tabel `role`
--

INSERT INTO `role` (`id_role`, `nm_role`, `deleted_at`, `created_at`, `updated_at`) VALUES
(1, 'Administrator', NULL, '2021-11-19 09:57:54', '2021-11-19 09:57:54'),
(2, 'Operator', NULL, '2021-11-19 09:57:54', '2021-11-19 09:57:54');

-- --------------------------------------------------------

--
-- Struktur dari tabel `transaksi`
--

CREATE TABLE `transaksi` (
  `id_transaksi` int(11) NOT NULL,
  `uraian` varchar(255) NOT NULL,
  `nominal` bigint(20) NOT NULL,
  `is_masuk` tinyint(4) NOT NULL,
  `deleted_at` date NOT NULL,
  `created_at` date NOT NULL,
  `updated_at` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `transaksi`
--

INSERT INTO `transaksi` (`id_transaksi`, `uraian`, `nominal`, `is_masuk`, `deleted_at`, `created_at`, `updated_at`) VALUES
(1, 'uang saku bulan november 2021', 500000, 1, '0000-00-00', '2021-12-08', '2021-12-08'),
(2, 'sarapan', 300000, 0, '0000-00-00', '2021-12-08', '2021-12-08'),
(3, 'snack', 300000, 0, '0000-00-00', '2021-12-09', '2021-12-09');

-- --------------------------------------------------------

--
-- Struktur dari tabel `transaksi_kelompok`
--

CREATE TABLE `transaksi_kelompok` (
  `id_transaksi` int(11) NOT NULL,
  `id_kelompok_transaksi` int(11) NOT NULL,
  `deleted_at` datetime NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `transaksi_kelompok`
--

INSERT INTO `transaksi_kelompok` (`id_transaksi`, `id_kelompok_transaksi`, `deleted_at`, `created_at`, `updated_at`) VALUES
(1, 1, '0000-00-00 00:00:00', '2021-12-08 13:59:34', '2021-12-08 13:59:34'),
(2, 2, '0000-00-00 00:00:00', '2021-12-08 14:01:08', '2021-12-08 14:01:08'),
(3, 5, '0000-00-00 00:00:00', '2021-12-09 06:14:47', '2021-12-09 06:14:47'),
(3, 6, '0000-00-00 00:00:00', '2021-12-09 06:14:47', '2021-12-09 06:14:47');

-- --------------------------------------------------------

--
-- Struktur dari tabel `user`
--

CREATE TABLE `user` (
  `id_user` int(11) NOT NULL,
  `nm_user` varchar(255) DEFAULT NULL,
  `user_username` varchar(255) DEFAULT NULL,
  `user_password` varchar(255) DEFAULT NULL,
  `id_role` int(11) DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data untuk tabel `user`
--

INSERT INTO `user` (`id_user`, `nm_user`, `user_username`, `user_password`, `id_role`, `deleted_at`, `created_at`, `updated_at`) VALUES
(1, 'Andi', 'andi', '8cb2237d0679ca88db6464eac60da96345513964', 1, NULL, '2021-11-19 10:41:43', '2021-11-19 10:41:43'),
(2, 'Budi', 'budi', '8cb2237d0679ca88db6464eac60da96345513964', 2, NULL, '2021-11-19 10:41:43', '2021-11-19 10:41:43');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `kelompok_transaksi`
--
ALTER TABLE `kelompok_transaksi`
  ADD PRIMARY KEY (`id_kelompok_transaksi`);

--
-- Indeks untuk tabel `modul`
--
ALTER TABLE `modul`
  ADD PRIMARY KEY (`id_modul`);

--
-- Indeks untuk tabel `modul_role`
--
ALTER TABLE `modul_role`
  ADD PRIMARY KEY (`id_modul`,`id_role`);

--
-- Indeks untuk tabel `role`
--
ALTER TABLE `role`
  ADD PRIMARY KEY (`id_role`);

--
-- Indeks untuk tabel `transaksi`
--
ALTER TABLE `transaksi`
  ADD PRIMARY KEY (`id_transaksi`);

--
-- Indeks untuk tabel `transaksi_kelompok`
--
ALTER TABLE `transaksi_kelompok`
  ADD PRIMARY KEY (`id_transaksi`,`id_kelompok_transaksi`);

--
-- Indeks untuk tabel `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id_user`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `kelompok_transaksi`
--
ALTER TABLE `kelompok_transaksi`
  MODIFY `id_kelompok_transaksi` smallint(6) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT untuk tabel `modul`
--
ALTER TABLE `modul`
  MODIFY `id_modul` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT untuk tabel `role`
--
ALTER TABLE `role`
  MODIFY `id_role` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT untuk tabel `transaksi`
--
ALTER TABLE `transaksi`
  MODIFY `id_transaksi` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT untuk tabel `user`
--
ALTER TABLE `user`
  MODIFY `id_user` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
