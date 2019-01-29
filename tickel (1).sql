-- phpMyAdmin SQL Dump
-- version 4.7.9
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Waktu pembuatan: 29 Jan 2019 pada 05.26
-- Versi server: 5.7.21
-- Versi PHP: 7.1.16

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `tickel`
--

DELIMITER $$
--
-- Prosedur
--
DROP PROCEDURE IF EXISTS `getDetailsRute`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `getDetailsRute` (IN `ruteAwal` VARCHAR(255), IN `ruteAkhir` VARCHAR(255))  BEGIN
	SELECT rutes.id_rute, rutes.tujuan, rutes.rute_awal, rutes.rute_akhir, rutes.harga, rutes.jam_berangkat, rutes.jam_tiba, type_rute.nama_type, transportasis.nama_transportasi, type_transportasi.nama_type As type_transportasi
FROM rutes
JOIN type_rute ON rutes.id_type_rute = type_rute.id_type_rute
JOIN transportasis ON rutes.id_transportasi = transportasis.id_transportasi
JOIN type_transportasi ON transportasis.id_type_transportasi = type_transportasi.id_type_transportasi
WHERE rutes.deleted_at IS NULL AND (rutes.rute_awal LIKE CONCAT('%', ruteAwal , '%') AND rutes.rute_akhir LIKE CONCAT('%', ruteAkhir , '%'));

END$$

DROP PROCEDURE IF EXISTS `getDetailsRuteById`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `getDetailsRuteById` (IN `idRute` INT(11))  BEGIN
	SELECT rutes.id_rute, rutes.tujuan, rutes.rute_awal, rutes.rute_akhir, rutes.harga, rutes.jam_berangkat, rutes.jam_tiba, type_rute.nama_type, transportasis.nama_transportasi, type_transportasi.nama_type As type_transportasi
FROM rutes
JOIN type_rute ON rutes.id_type_rute = type_rute.id_type_rute
JOIN transportasis ON rutes.id_transportasi = transportasis.id_transportasi
JOIN type_transportasi ON transportasis.id_type_transportasi = type_transportasi.id_type_transportasi
WHERE rutes.deleted_at IS NULL AND (rutes.id_rute = idRute);
END$$

DELIMITER ;

-- --------------------------------------------------------

--
-- Struktur dari tabel `admins`
--

DROP TABLE IF EXISTS `admins`;
CREATE TABLE IF NOT EXISTS `admins` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) DEFAULT NULL,
  `remember_token` varchar(255) DEFAULT NULL,
  `name` varchar(255) DEFAULT NULL,
  `image` varchar(255) DEFAULT NULL,
  `id_level` int(11) UNSIGNED NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `admins`
--

INSERT INTO `admins` (`id`, `username`, `email`, `password`, `remember_token`, `name`, `image`, `id_level`, `created_at`, `updated_at`) VALUES
(1, 'admin', 'admin@admin.com', '$2y$10$pLSxCFmhYqz4id5B9v6/HOKFFHu4LfsmTr5ytC9HR..GKPF70OxBu', 'yKZgaIDympckbNp6P56jwogx2jyy543Yt8aZwk305lPRkP8NHagx8YALhOTb', 'Admin Tickel', '1548164287.png', 1, '2019-01-13 15:04:23', '2019-01-26 14:15:10');

-- --------------------------------------------------------

--
-- Struktur dari tabel `kursis`
--

DROP TABLE IF EXISTS `kursis`;
CREATE TABLE IF NOT EXISTS `kursis` (
  `id_kursi` int(11) NOT NULL AUTO_INCREMENT,
  `id_transportasi` int(11) UNSIGNED DEFAULT NULL,
  `kode` varchar(255) NOT NULL,
  `status` varchar(255) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id_kursi`),
  KEY `id_rute` (`id_transportasi`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `kursis`
--

INSERT INTO `kursis` (`id_kursi`, `id_transportasi`, `kode`, `status`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 3, 'ELBR1', NULL, '2019-01-24 04:58:09', '2019-01-24 04:58:09', NULL),
(2, 3, 'ELBR2', NULL, '2019-01-24 04:58:09', '2019-01-24 04:58:09', NULL),
(3, 3, 'ELBR3', NULL, '2019-01-24 04:58:09', '2019-01-24 04:58:09', NULL),
(4, 3, 'ELBR4', NULL, '2019-01-24 04:58:09', '2019-01-24 04:58:09', NULL),
(5, 3, 'ELBR5', NULL, '2019-01-24 04:58:09', '2019-01-24 04:58:09', NULL),
(6, 3, 'ELBR6', NULL, '2019-01-24 04:58:09', '2019-01-24 04:58:09', NULL),
(7, 3, 'ELBR7', NULL, '2019-01-24 04:58:09', '2019-01-24 04:58:09', NULL),
(8, 3, 'ELBR8', NULL, '2019-01-24 04:58:09', '2019-01-24 04:58:09', NULL),
(9, 3, 'ELBR9', NULL, '2019-01-24 04:58:09', '2019-01-24 04:58:09', NULL),
(10, 3, 'ELBR10', NULL, '2019-01-24 13:13:41', '2019-01-24 13:13:47', NULL);

-- --------------------------------------------------------

--
-- Struktur dari tabel `levels`
--

DROP TABLE IF EXISTS `levels`;
CREATE TABLE IF NOT EXISTS `levels` (
  `id_level` int(11) UNSIGNED NOT NULL AUTO_INCREMENT,
  `nama_level` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id_level`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `levels`
--

INSERT INTO `levels` (`id_level`, `nama_level`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'Admin', '2019-01-13 14:08:53', '2019-01-16 00:02:12', NULL),
(4, 'Petugas', '2019-01-16 00:04:53', '2019-01-16 00:04:53', NULL);

-- --------------------------------------------------------

--
-- Struktur dari tabel `migrations`
--

DROP TABLE IF EXISTS `migrations`;
CREATE TABLE IF NOT EXISTS `migrations` (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_resets_table', 1);

-- --------------------------------------------------------

--
-- Struktur dari tabel `password_resets`
--

DROP TABLE IF EXISTS `password_resets`;
CREATE TABLE IF NOT EXISTS `password_resets` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  KEY `password_resets_email_index` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `pemesanans`
--

DROP TABLE IF EXISTS `pemesanans`;
CREATE TABLE IF NOT EXISTS `pemesanans` (
  `id_pemesanan` int(11) NOT NULL AUTO_INCREMENT,
  `kode_pemesanan` varchar(30) NOT NULL,
  `tanggal_pemesanan` datetime NOT NULL,
  `tempat_pemesanan` varchar(255) NOT NULL,
  `status` varchar(255) NOT NULL,
  `id_pelanggan` int(10) UNSIGNED NOT NULL,
  `kode_kursi` varchar(10) NOT NULL,
  `id_rute` int(10) UNSIGNED NOT NULL,
  `tujuan` varchar(255) NOT NULL,
  `tanggal_berangkat` date NOT NULL,
  `jam_cekin` time NOT NULL,
  `jam_berangkat` time NOT NULL,
  `total_bayar` float NOT NULL,
  `id_petugas` int(10) UNSIGNED DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id_pemesanan`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `pemesanans`
--

INSERT INTO `pemesanans` (`id_pemesanan`, `kode_pemesanan`, `tanggal_pemesanan`, `tempat_pemesanan`, `status`, `id_pelanggan`, `kode_kursi`, `id_rute`, `tujuan`, `tanggal_berangkat`, `jam_cekin`, `jam_berangkat`, `total_bayar`, `id_petugas`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, '5c4c65cccbb26', '2019-01-26 00:00:00', 'Rumah', 'pending', 1, 'KA333-10', 2, 'Yogyakarta', '2019-04-21', '06:30:00', '07:30:00', 75, NULL, '2019-01-26 06:51:09', '2019-01-26 06:51:09', NULL),
(2, '5c4c65fa683dd', '2019-01-26 00:00:00', 'Rumah', 'pending', 2, 'KA333-9', 2, 'Yogyakarta', '2019-04-21', '06:30:00', '07:30:00', 75, NULL, '2019-01-26 06:51:54', '2019-01-26 06:51:54', NULL);

-- --------------------------------------------------------

--
-- Struktur dari tabel `penumpangs`
--

DROP TABLE IF EXISTS `penumpangs`;
CREATE TABLE IF NOT EXISTS `penumpangs` (
  `id_penumpang` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `nama_penumpang` varchar(255) NOT NULL,
  `no_identitas` varchar(255) DEFAULT NULL,
  `alamat_penumpang` varchar(255) DEFAULT NULL,
  `tanggal_lahir` date DEFAULT NULL,
  `jenis_kelamin` set('L','P') DEFAULT NULL,
  `telefone` varchar(20) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `remember_token` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id_penumpang`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `penumpangs`
--

INSERT INTO `penumpangs` (`id_penumpang`, `username`, `email`, `password`, `nama_penumpang`, `no_identitas`, `alamat_penumpang`, `tanggal_lahir`, `jenis_kelamin`, `telefone`, `created_at`, `updated_at`, `deleted_at`, `remember_token`) VALUES
(1, 'akbarsaputra', 'akbarsaputrait@outlook.com', '$2y$10$1cuc.jUG3KM5Uct920dglu1hGtzcLtQkfRZl.oDe2fB3bLBhkmHyG', 'Akbar', NULL, NULL, NULL, NULL, NULL, '2019-01-21 22:34:46', '2019-01-29 02:07:24', NULL, 'hFALTpUjeVt75zfLyJrPtDK9YzbPB8zJQyi8ECQg86J7pa07VJsZdWMLuIBm'),
(2, 'fariz', 'alfarizie@gmail.com', '$2y$10$UR2mT6yKiH4nZuxYXqcLz.FsdL/IZAtG84OI3gJha0u.Gm.BLxqr6', 'fariz al', NULL, NULL, NULL, NULL, NULL, '2019-01-23 19:50:42', '2019-01-23 19:50:42', NULL, NULL),
(3, 'akbarsaputrait', 'akbar@gmail.com', '$2y$10$k0frzh3D.tShZnWFVBm3iuSI57cQjwZXshYXBw0hxa1klXx2Okqvy', 'Yudha', NULL, NULL, NULL, NULL, NULL, '2019-01-28 20:29:03', '2019-01-29 03:30:21', NULL, 'HmrK6803F3jlIDP45qPI5To0FLfzAAlN5icR80Vpvjr5z1Nyyg9IctYLNMMT');

-- --------------------------------------------------------

--
-- Struktur dari tabel `petugass`
--

DROP TABLE IF EXISTS `petugass`;
CREATE TABLE IF NOT EXISTS `petugass` (
  `id_petugas` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `nama_petugas` varchar(255) NOT NULL,
  `jenis_kelamin` set('L','P') NOT NULL,
  `alamat_petugas` varchar(255) DEFAULT NULL,
  `tanggal_lahir` date DEFAULT NULL,
  `telefone` varchar(20) DEFAULT NULL,
  `id_level` int(11) UNSIGNED NOT NULL,
  `image` varchar(255) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `remember_token` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id_petugas`),
  KEY `level` (`id_level`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `petugass`
--

INSERT INTO `petugass` (`id_petugas`, `username`, `email`, `password`, `nama_petugas`, `jenis_kelamin`, `alamat_petugas`, `tanggal_lahir`, `telefone`, `id_level`, `image`, `created_at`, `updated_at`, `deleted_at`, `remember_token`) VALUES
(1, 'petugas', 'petugas@tickle.com', '$2y$10$ZxPklD0iTeSi7y8dZnhjd.kCzw.CEJLZ/P2W3ZnYb2QS8HBjGt72u', 'Petugas A', 'L', NULL, NULL, NULL, 4, NULL, '2019-01-13 14:11:46', '2019-01-16 07:15:26', NULL, NULL),
(2, 'yudha', 'yudha@tickel.com', '$2y$10$4RbpaDeqvQACue9ZssoFf.O0SEier6Q5OGFXwvxy3r3CbhqJlikau', 'Yudha Anung', 'L', 'Malang, Jawa Timur', '2000-12-26', '081930065484', 4, '1548209105.png', '2019-01-16 06:02:16', '2019-01-23 02:05:58', NULL, 'GefblY6xtnN8efsepEFv2AuV8nQNh2whPlK2MFVssXZn54NN4K7HDcnxgzuE');

-- --------------------------------------------------------

--
-- Struktur dari tabel `rutes`
--

DROP TABLE IF EXISTS `rutes`;
CREATE TABLE IF NOT EXISTS `rutes` (
  `id_rute` int(11) UNSIGNED NOT NULL AUTO_INCREMENT,
  `tujuan` varchar(255) NOT NULL,
  `rute_awal` varchar(255) NOT NULL,
  `rute_akhir` varchar(255) NOT NULL,
  `harga` varchar(255) NOT NULL,
  `jam_berangkat` time DEFAULT NULL,
  `jam_tiba` time DEFAULT NULL,
  `id_transportasi` int(11) UNSIGNED NOT NULL,
  `id_type_rute` int(11) UNSIGNED DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id_rute`),
  KEY `id_transportasi` (`id_transportasi`),
  KEY `id_type_rute` (`id_type_rute`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `rutes`
--

INSERT INTO `rutes` (`id_rute`, `tujuan`, `rute_awal`, `rute_akhir`, `harga`, `jam_berangkat`, `jam_tiba`, `id_transportasi`, `id_type_rute`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'Jakarta', 'Surabaya', 'Jakarta', '300.000', '07:15:00', '13:00:00', 2, 2, '2019-01-17 02:38:01', '2019-01-24 04:24:10', NULL),
(2, 'Yogyakarta', 'Pasuruan', 'Yogyakarta', '75.000', '07:30:00', '16:00:00', 3, 1, '2019-01-17 02:38:01', '2019-01-24 04:24:05', NULL),
(3, 'Yogyakarta', 'Pasuruan', 'Yogyakarta', '140.000', '07:45:00', '12:00:00', 3, 2, '2019-01-22 23:56:30', '2019-01-24 04:24:30', NULL);

-- --------------------------------------------------------

--
-- Struktur dari tabel `transportasis`
--

DROP TABLE IF EXISTS `transportasis`;
CREATE TABLE IF NOT EXISTS `transportasis` (
  `id_transportasi` int(11) UNSIGNED NOT NULL AUTO_INCREMENT,
  `kode` varchar(255) NOT NULL,
  `jumlah_kursi` int(11) NOT NULL,
  `nama_transportasi` varchar(255) NOT NULL,
  `keterangan` varchar(255) DEFAULT NULL,
  `id_type_transportasi` int(11) UNSIGNED NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id_transportasi`),
  KEY `id_type_transportasi` (`id_type_transportasi`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `transportasis`
--

INSERT INTO `transportasis` (`id_transportasi`, `kode`, `jumlah_kursi`, `nama_transportasi`, `keterangan`, `id_type_transportasi`, `created_at`, `updated_at`, `deleted_at`) VALUES
(2, 'GI333', 10, 'Garuda Indonesia', NULL, 1, '2019-01-16 08:04:01', '2019-01-24 04:36:48', NULL),
(3, 'KA333', 8, 'Logawa', NULL, 3, '2019-01-16 19:26:43', '2019-01-26 06:51:54', NULL);

-- --------------------------------------------------------

--
-- Struktur dari tabel `type_rute`
--

DROP TABLE IF EXISTS `type_rute`;
CREATE TABLE IF NOT EXISTS `type_rute` (
  `id_type_rute` int(11) UNSIGNED NOT NULL AUTO_INCREMENT,
  `nama_type` varchar(255) NOT NULL,
  `keterangan` text,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id_type_rute`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `type_rute`
--

INSERT INTO `type_rute` (`id_type_rute`, `nama_type`, `keterangan`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'Ekonomi', NULL, '2019-01-17 02:36:56', '2019-01-16 19:56:32', NULL),
(2, 'Eksekutif', NULL, '2019-01-16 19:56:41', '2019-01-16 19:56:41', NULL);

-- --------------------------------------------------------

--
-- Struktur dari tabel `type_transportasi`
--

DROP TABLE IF EXISTS `type_transportasi`;
CREATE TABLE IF NOT EXISTS `type_transportasi` (
  `id_type_transportasi` int(11) UNSIGNED NOT NULL AUTO_INCREMENT,
  `nama_type` varchar(255) NOT NULL,
  `keterangan` varchar(255) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id_type_transportasi`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `type_transportasi`
--

INSERT INTO `type_transportasi` (`id_type_transportasi`, `nama_type`, `keterangan`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'Pesawat', NULL, '2019-01-16 13:40:29', '2019-01-16 06:41:53', NULL),
(3, 'Kereta Api', NULL, '2019-01-16 06:51:12', '2019-01-16 06:51:33', NULL);

-- --------------------------------------------------------

--
-- Struktur dari tabel `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `username` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `is_penumpang` tinyint(1) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `remember_token` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_email_unique` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `users`
--

INSERT INTO `users` (`id`, `username`, `email`, `password`, `is_penumpang`, `created_at`, `updated_at`, `remember_token`) VALUES
(1, 'admin', 'admin@admin.com', '$2y$10$ZxPklD0iTeSi7y8dZnhjd.kCzw.CEJLZ/P2W3ZnYb2QS8HBjGt72u', NULL, '2019-01-10 00:04:00', '2019-01-10 00:04:00', 'PwpipeBK461IPThAT9igZWhgk0pGEc0o5GcnX8DvEXDueAqBcHKHNHeM90U8');

--
-- Ketidakleluasaan untuk tabel pelimpahan (Dumped Tables)
--

--
-- Ketidakleluasaan untuk tabel `kursis`
--
ALTER TABLE `kursis`
  ADD CONSTRAINT `kode_kursi` FOREIGN KEY (`id_transportasi`) REFERENCES `rutes` (`id_rute`);

--
-- Ketidakleluasaan untuk tabel `petugass`
--
ALTER TABLE `petugass`
  ADD CONSTRAINT `level` FOREIGN KEY (`id_level`) REFERENCES `levels` (`id_level`);

--
-- Ketidakleluasaan untuk tabel `rutes`
--
ALTER TABLE `rutes`
  ADD CONSTRAINT `transportasi` FOREIGN KEY (`id_transportasi`) REFERENCES `transportasis` (`id_transportasi`),
  ADD CONSTRAINT `type` FOREIGN KEY (`id_type_rute`) REFERENCES `type_rute` (`id_type_rute`);

--
-- Ketidakleluasaan untuk tabel `transportasis`
--
ALTER TABLE `transportasis`
  ADD CONSTRAINT `type_transportasi` FOREIGN KEY (`id_type_transportasi`) REFERENCES `type_transportasi` (`id_type_transportasi`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
