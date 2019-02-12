-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Waktu pembuatan: 12 Feb 2019 pada 14.57
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
DROP PROCEDURE IF EXISTS `chartRute`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `chartRute` ()  BEGIN
   		SELECT rutes.rute_awal, rutes.rute_akhir,COUNT(pemesanans.id_rute) AS rute, DATE_FORMAT(pemesanans.created_at,  "%d %M %Y") as created_at
    FROM pemesanans
    JOIN rutes ON pemesanans.id_rute = rutes.id_rute
    WHERE pemesanans.deleted_at IS NULL AND pemesanans.status = "done"
    GROUP BY DATE(pemesanans.created_at)
    ORDER BY pemesanans.id_pemesanan ASC
    LIMIT 7;
    END$$

DROP PROCEDURE IF EXISTS `chartTrans`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `chartTrans` ()  BEGIN
SELECT transportasis.nama_transportasi, COUNT(transportasis.id_transportasi) AS jumlah
FROM pemesanans
JOIN rutes ON pemesanans.id_rute = rutes.id_rute
JOIN transportasis ON rutes.id_transportasi = transportasis.id_transportasi
WHERE pemesanans.deleted_at IS NULL AND pemesanans.status != "cancel"
GROUP BY transportasis.id_transportasi
LIMIT 7;
END$$

DROP PROCEDURE IF EXISTS `checkRute`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `checkRute` (IN `ruteAwal` VARCHAR(255), IN `ruteAkhir` VARCHAR(255), IN `namaTransportasi` VARCHAR(255), IN `kelasRute` VARCHAR(255), IN `jamBerangkat` TIME)  BEGIN
    SELECT rutes.id_rute, rutes.tujuan, rutes.rute_awal, rutes.rute_akhir, rutes.harga, rutes.jam_berangkat, rutes.jam_tiba, type_rute.nama_type, transportasis.nama_transportasi, type_transportasi.nama_type As type_transportasi
    FROM rutes
    JOIN type_rute ON rutes.id_type_rute = type_rute.id_type_rute
    JOIN transportasis ON rutes.id_transportasi = transportasis.id_transportasi
    JOIN type_transportasi ON transportasis.id_type_transportasi = type_transportasi.id_type_transportasi
    WHERE rutes.deleted_at IS NULL AND
    rutes.rute_awal = ruteAwal AND
    rutes.rute_akhir = ruteAkhir AND
    transportasis.nama_transportasi = namaTransportasi AND
    type_rute.nama_type = kelasRute AND
    rutes.jam_berangkat = jamBerangkat;
END$$

DROP PROCEDURE IF EXISTS `getDetailsRute`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `getDetailsRute` (IN `ruteAwal` VARCHAR(255), IN `ruteAkhir` VARCHAR(255))  BEGIN
	SELECT rutes.id_rute, rutes.tujuan, rutes.rute_awal, rutes.rute_akhir, rutes.harga, rutes.jam_berangkat, rutes.jam_tiba, type_rute.nama_type, transportasis.nama_transportasi, type_transportasi.nama_type As type_transportasi, transportasis.jumlah_kursi As jumlah_kursi
FROM rutes
JOIN type_rute ON rutes.id_type_rute = type_rute.id_type_rute
JOIN transportasis ON rutes.id_transportasi = transportasis.id_transportasi
JOIN type_transportasi ON transportasis.id_type_transportasi = type_transportasi.id_type_transportasi
WHERE rutes.deleted_at IS NULL AND (rutes.rute_awal LIKE CONCAT('%', ruteAwal , '%') AND rutes.rute_akhir LIKE CONCAT('%', ruteAkhir , '%'));

END$$

DROP PROCEDURE IF EXISTS `getDetailsRuteById`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `getDetailsRuteById` (IN `idRute` INT(11))  BEGIN
	SELECT rutes.id_rute, rutes.tujuan, rutes.rute_awal, rutes.rute_akhir, rutes.harga, rutes.jam_berangkat, rutes.jam_tiba, type_rute.nama_type, transportasis.nama_transportasi, type_transportasi.nama_type As type_transportasi, transportasis.jumlah_kursi As jumlah_kursi
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
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `admins`
--

INSERT INTO `admins` (`id`, `username`, `email`, `password`, `remember_token`, `name`, `image`, `id_level`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'admin', 'admin@admin.com', '$2y$10$pLSxCFmhYqz4id5B9v6/HOKFFHu4LfsmTr5ytC9HR..GKPF70OxBu', 'dbgRASrI7spuNb3Kh5R7oll7yFbRlo2IEG17U4S4BoJtPQGN0xqj2eJSXywC', 'Admin Tickel', '1549508651.png', 1, '2019-01-13 15:04:23', '2019-02-12 08:23:48', NULL);

-- --------------------------------------------------------

--
-- Struktur dari tabel `bukti_pembayaran`
--

DROP TABLE IF EXISTS `bukti_pembayaran`;
CREATE TABLE IF NOT EXISTS `bukti_pembayaran` (
  `id_bukti` int(11) NOT NULL AUTO_INCREMENT,
  `id_penumpang` int(11) DEFAULT NULL,
  `id_pemesanan` int(11) NOT NULL,
  `file` varchar(255) DEFAULT NULL,
  `id_petugas` int(11) DEFAULT NULL,
  `id_admin` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id_bukti`),
  KEY `id_penumpang` (`id_penumpang`),
  KEY `id_pemesanan` (`id_pemesanan`),
  KEY `id_petugas` (`id_petugas`) USING BTREE,
  KEY `id_admin` (`id_admin`)
) ENGINE=InnoDB AUTO_INCREMENT=24 DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `bukti_pembayaran`
--

INSERT INTO `bukti_pembayaran` (`id_bukti`, `id_penumpang`, `id_pemesanan`, `file`, `id_petugas`, `id_admin`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 1, 6, '1549436666.png', 4, NULL, '2019-02-05 21:13:15', '2019-02-09 15:57:24', NULL),
(2, 2, 7, NULL, NULL, NULL, '2019-02-06 20:36:25', '2019-02-06 20:36:25', NULL),
(3, 1, 8, '1549850358.jpeg', 5, NULL, '2019-02-06 21:13:11', '2019-02-10 19:58:38', NULL),
(4, 1, 9, NULL, NULL, NULL, '2019-02-06 21:13:57', '2019-02-06 21:13:57', NULL),
(5, 3, 10, '1549894486.png', NULL, NULL, '2019-02-11 06:52:14', '2019-02-11 07:14:46', NULL),
(6, 3, 11, NULL, NULL, NULL, '2019-02-11 08:04:34', '2019-02-11 08:04:34', NULL),
(7, 3, 12, NULL, NULL, NULL, '2019-02-11 08:14:23', '2019-02-11 08:14:23', NULL),
(8, 3, 13, NULL, NULL, NULL, '2019-02-11 08:15:56', '2019-02-11 08:15:56', NULL),
(9, 3, 14, NULL, NULL, NULL, '2019-02-11 08:17:02', '2019-02-11 08:17:02', NULL),
(10, 3, 15, NULL, NULL, NULL, '2019-02-11 08:19:04', '2019-02-11 08:19:04', NULL),
(11, 3, 16, NULL, NULL, NULL, '2019-02-11 08:20:08', '2019-02-11 08:20:08', NULL),
(12, 3, 17, NULL, NULL, NULL, '2019-02-11 08:22:03', '2019-02-11 08:22:03', NULL),
(13, 3, 18, NULL, NULL, NULL, '2019-02-11 08:22:29', '2019-02-11 08:22:29', NULL),
(14, 3, 19, NULL, NULL, NULL, '2019-02-11 08:24:11', '2019-02-11 08:24:11', NULL),
(15, 3, 20, NULL, NULL, NULL, '2019-02-11 08:25:21', '2019-02-11 08:25:21', NULL),
(16, 1, 21, '1549904747.jpg', NULL, 1, '2019-02-11 10:02:35', '2019-02-11 10:06:27', NULL),
(17, 4, 22, '1549934183.jpg', NULL, 1, '2019-02-11 18:15:25', '2019-02-11 18:17:16', NULL),
(18, 5, 23, '1549934560.jpg', 4, NULL, '2019-02-11 18:22:24', '2019-02-11 18:23:27', NULL),
(19, 8, 24, '1549954879.jpg', 4, NULL, '2019-02-11 23:57:22', '2019-02-12 00:04:57', NULL),
(20, 8, 25, NULL, NULL, NULL, '2019-02-12 07:20:29', '2019-02-12 07:20:29', NULL),
(21, 8, 26, NULL, NULL, NULL, '2019-02-12 07:31:27', '2019-02-12 07:31:27', NULL),
(22, 8, 27, '1549983132.jpg', NULL, 1, '2019-02-12 07:42:50', '2019-02-12 07:55:06', NULL),
(23, 5, 28, NULL, NULL, NULL, '2019-02-12 07:56:14', '2019-02-12 07:56:14', NULL);

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
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `levels`
--

INSERT INTO `levels` (`id_level`, `nama_level`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'Admin', '2019-01-13 14:08:53', '2019-01-16 00:02:12', NULL),
(4, 'Petugas', '2019-01-16 00:04:53', '2019-01-16 00:04:53', NULL),
(5, '11', '2019-02-11 20:34:26', '2019-02-11 20:34:31', '2019-02-11 20:34:31');

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
  `tempat_pemesanan` varchar(255) DEFAULT NULL,
  `status` varchar(255) NOT NULL,
  `id_pelanggan` int(11) NOT NULL,
  `kode_kursi` varchar(10) NOT NULL,
  `id_rute` int(10) UNSIGNED NOT NULL,
  `tujuan` varchar(255) DEFAULT NULL,
  `tanggal_berangkat` date NOT NULL,
  `jam_cekin` time DEFAULT NULL,
  `jam_berangkat` time NOT NULL,
  `total_bayar` varchar(255) NOT NULL,
  `id_petugas` int(11) DEFAULT NULL,
  `id_admin` int(11) DEFAULT NULL,
  `keterangan` text,
  `snap_token` varchar(255) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id_pemesanan`),
  KEY `id_pelanggan` (`id_pelanggan`),
  KEY `id_rute` (`id_rute`),
  KEY `pemesanan_petugas` (`id_petugas`),
  KEY `id_admin` (`id_admin`)
) ENGINE=InnoDB AUTO_INCREMENT=29 DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `pemesanans`
--

INSERT INTO `pemesanans` (`id_pemesanan`, `kode_pemesanan`, `tanggal_pemesanan`, `tempat_pemesanan`, `status`, `id_pelanggan`, `kode_kursi`, `id_rute`, `tujuan`, `tanggal_berangkat`, `jam_cekin`, `jam_berangkat`, `total_bayar`, `id_petugas`, `id_admin`, `keterangan`, `snap_token`, `created_at`, `updated_at`, `deleted_at`) VALUES
(6, '5c5a5edb5e12a', '2019-02-06 00:00:00', 'Pasuruan', 'done', 1, 'KA333-5', 2, 'Yogyakarta', '2019-04-21', '00:00:00', '07:30:00', '75.000', 4, NULL, 'Tiket telah diverifikasi. Terima kasih telah menggunakan Tickel!', NULL, '2019-02-05 21:13:15', '2019-02-08 22:20:34', NULL),
(7, '5c5ba7b90f2d5', '2019-02-07 00:00:00', 'Pasuruan', 'cancel', 2, 'KA333-4', 2, 'Yogyakarta', '2019-04-21', '00:00:00', '07:30:00', '75.000', NULL, NULL, NULL, NULL, '2019-02-06 20:36:25', '2019-02-10 20:02:53', '2019-02-10 20:02:53'),
(8, '5c5bb057b6eb1', '2019-02-07 00:00:00', 'Pasuruan', 'done', 1, 'KA333-4', 2, 'Yogyakarta', '2019-02-20', '00:00:00', '07:30:00', '75.000', 5, NULL, 'Terima kasih telah menggunakan Tickel. Enjoy your trip!', NULL, '2019-02-06 21:13:11', '2019-02-10 19:58:32', NULL),
(9, '5c5bb08535bf1', '2019-02-07 00:00:00', 'Pasuruan', 'cancel', 1, 'KA333-3', 2, 'Yogyakarta', '2019-02-20', '00:00:00', '07:30:00', '75.000', NULL, NULL, NULL, NULL, '2019-02-06 21:13:57', '2019-02-09 08:29:37', '2019-02-09 08:29:37'),
(10, '5c617e0e379f2', '2019-02-11 00:00:00', 'Gambir', 'done', 3, 'ABAP-50', 4, 'Surabaya', '2019-02-13', '00:00:00', '09:30:00', '150.000', NULL, 1, 'Terima kasih telah menggunakan Tickel :)', NULL, '2019-02-11 06:52:14', '2019-02-11 07:30:49', NULL),
(11, '5c618f02391b6', '2019-02-11 00:00:00', 'Gambir', 'pending', 3, 'ABAP-49', 4, 'Surabaya', '2019-02-12', '00:00:00', '09:30:00', '150.000', NULL, NULL, NULL, NULL, '2019-02-11 08:04:34', '2019-02-11 08:10:47', '2019-02-11 08:10:47'),
(12, '5c61914f9f1ba', '2019-02-11 00:00:00', 'Gambir', 'pending', 3, 'ABAP-49', 4, 'Surabaya', '2019-02-15', '00:00:00', '09:30:00', '150.000', NULL, NULL, NULL, NULL, '2019-02-11 08:14:23', '2019-02-11 08:27:13', '2019-02-11 08:27:13'),
(13, '5c6191ac70d64', '2019-02-11 00:00:00', 'Gambir', 'pending', 3, 'ABAP-48', 4, 'Surabaya', '2019-02-15', '00:00:00', '09:30:00', '150.000', NULL, NULL, NULL, NULL, '2019-02-11 08:15:56', '2019-02-11 08:27:19', '2019-02-11 08:27:19'),
(14, '5c6191edea449', '2019-02-11 00:00:00', 'Gambir', 'pending', 3, 'ABAP-47', 4, 'Surabaya', '2019-02-15', '00:00:00', '09:30:00', '150.000', NULL, NULL, NULL, NULL, '2019-02-11 08:17:02', '2019-02-11 08:27:27', '2019-02-11 08:27:27'),
(15, '5c619268186d0', '2019-02-11 00:00:00', 'Gambir', 'pending', 3, 'ABAP-46', 4, 'Surabaya', '2019-02-15', '00:00:00', '09:30:00', '150.000', NULL, NULL, NULL, NULL, '2019-02-11 08:19:04', '2019-02-11 08:27:33', '2019-02-11 08:27:33'),
(16, '5c6192a7ecf0a', '2019-02-11 00:00:00', 'Gambir', 'pending', 3, 'ABAP-45', 4, 'Surabaya', '2019-02-15', '00:00:00', '09:30:00', '150.000', NULL, NULL, NULL, NULL, '2019-02-11 08:20:08', '2019-02-11 08:27:42', '2019-02-11 08:27:42'),
(17, '5c61931b8aba3', '2019-02-11 00:00:00', 'Gambir', 'pending', 3, 'ABAP-44', 4, 'Surabaya', '2019-02-15', '00:00:00', '09:30:00', '150.000', NULL, NULL, NULL, NULL, '2019-02-11 08:22:03', '2019-02-11 08:27:47', '2019-02-11 08:27:47'),
(18, '5c6193355eecd', '2019-02-11 00:00:00', 'Gambir', 'pending', 3, 'ABAP-43', 4, 'Surabaya', '2019-02-15', '00:00:00', '09:30:00', '150.000', NULL, NULL, NULL, NULL, '2019-02-11 08:22:29', '2019-02-11 08:26:47', '2019-02-11 08:26:47'),
(19, '5c61939b98230', '2019-02-11 00:00:00', 'Gambir', 'pending', 3, 'ABAP-42', 4, 'Surabaya', '1970-01-01', '00:00:00', '09:30:00', '150.000', NULL, NULL, NULL, NULL, '2019-02-11 08:24:11', '2019-02-11 08:27:53', '2019-02-11 08:27:53'),
(20, '5c6193e12e863', '2019-02-11 00:00:00', 'Gambir', 'cancel', 3, 'ABAP-49', 4, 'Surabaya', '2007-09-09', '00:00:00', '09:30:00', '150.000', NULL, NULL, NULL, NULL, '2019-02-11 08:25:21', '2019-02-11 08:52:50', NULL),
(21, '5c61aaab287ab', '2019-02-11 00:00:00', 'Gambir', 'done', 1, 'ABAP-49', 4, 'Surabaya', '2019-02-14', '00:00:00', '09:30:00', '150.000', NULL, 1, 'Terima kasih telah menggunakan Tickel! :)', NULL, '2019-02-11 10:02:35', '2019-02-11 10:06:24', NULL),
(22, '5c621e2d69327', '2019-02-12 00:00:00', 'Malang', 'done', 4, 'GN-50', 5, 'Gambir', '2019-02-15', '00:00:00', '13:30:00', '200.000', NULL, 1, 'Terima kasih telah menggunakan Tickel :)', NULL, '2019-02-11 18:15:25', '2019-02-11 18:17:06', NULL),
(23, '5c621fd07584f', '2019-02-12 00:00:00', 'Bandung', 'done', 5, 'AP-50', 7, 'Gambir', '2019-02-15', '00:00:00', '17:00:00', '100.000', 4, NULL, 'Terima kasih telah menggunakan Tickel :)', NULL, '2019-02-11 18:22:24', '2019-02-11 18:23:23', NULL),
(24, '5c626e5204d30', '2019-02-12 00:00:00', 'Bandung', 'done', 8, 'AP-49', 7, 'Gambir', '2019-02-14', '00:00:00', '17:00:00', '100.000', 4, NULL, 'Terima kasih telah menggunakan Tickel! Enjoy your trip :D', NULL, '2019-02-11 23:57:22', '2019-02-12 00:03:57', NULL),
(25, '5c62d62cecd19', '2019-02-12 00:00:00', 'Malang', 'cancel', 8, 'GN-49', 5, 'Gambir', '2019-02-15', '00:00:00', '13:30:00', '200.000', NULL, NULL, NULL, NULL, '2019-02-12 07:20:29', '2019-02-12 07:30:57', NULL),
(26, '5c62d8bf87bb7', '2019-02-12 00:00:00', 'Malang', 'cancel', 8, 'GN-49', 5, 'Gambir', '2019-02-14', '00:00:00', '13:30:00', '200.000', NULL, NULL, NULL, NULL, '2019-02-12 07:31:27', '2019-02-12 07:33:24', NULL),
(27, '5c62db6a16930', '2019-02-12 00:00:00', 'Gambir', 'done', 8, 'AM-50', 6, 'Semarang', '2019-02-15', '00:00:00', '16:15:00', '150.000', NULL, 1, 'Terima kasih telah menggunakan Tickel!', NULL, '2019-02-12 07:42:50', '2019-02-12 07:55:02', NULL),
(28, '5c62de8ea0086', '2019-02-12 00:00:00', 'Gambir', 'cancel', 5, 'ABAP-47', 4, 'Surabaya', '2019-02-15', '00:00:00', '09:30:00', '150.000', NULL, NULL, NULL, NULL, '2019-02-12 07:56:14', '2019-02-12 07:56:49', NULL);

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
  `image` varchar(255) DEFAULT NULL,
  `token` varchar(255) DEFAULT NULL,
  `verified_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `remember_token` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id_penumpang`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `penumpangs`
--

INSERT INTO `penumpangs` (`id_penumpang`, `username`, `email`, `password`, `nama_penumpang`, `no_identitas`, `alamat_penumpang`, `tanggal_lahir`, `jenis_kelamin`, `telefone`, `image`, `token`, `verified_at`, `created_at`, `updated_at`, `deleted_at`, `remember_token`) VALUES
(1, 'akbarsaputrait', 'akbar@gmail.com', '$2y$10$1KJKocG1wVrZDKLrp2VVNe/tKZW79PVPxBWqzcw8mV3xYxe0pzUGu', 'Akbar Anung Yudha Saputra', '0003135234', NULL, '2000-12-26', 'L', '081931006841', '1549932761.JPG', '4d9bbb04bd4309881df439cae602c5245b4bb4d1', '2019-02-11 21:54:49', '2019-01-31 06:14:32', '2019-02-12 06:56:19', NULL, 'ErerETZAK2Jf5KMipn4CxXMJJz4sPlbm58QN8bukN6ZK9Uc1eXlpKVkdZoh1'),
(2, 'akbarsaputra', 'yudha@gmail.com', '$2y$10$NPHnkFzADkwSzHw8yebi3.8FusozjQ3bXLpbaERQ1aEVL.BpwzN.6', 'Yudha Saputra Ey', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2019-02-06 20:35:22', '2019-02-07 03:57:47', NULL, 'Xf5kl97dJKqyPH0fm723cveBEeJeHqe08TqFJUrFDQozsCKWlLKwJuD22ETb'),
(3, 'farizalfaridli', 'farizal@gmail.com', '$2y$10$C/Xm.xo5gEHDvutu3pP0oOGBin5Q/ldIa8OWZexI2woXv7rlEIrUq', 'Fariz Al Faridli', '000265495648641', 'Lamongan, Jawa Timur', '2000-06-01', NULL, '123412312', '1549932729.JPG', 'b05d53e317ad539cf3e45f963588534cbd83b77b', '2019-02-11 21:58:03', '2019-02-10 20:44:18', '2019-02-11 21:58:03', NULL, 'I25XjLp0tnOMQ0vL7zBrND23HvtowoQP0GUbQxno1g1PX60ZagUPL9sDf2LL'),
(4, 'farisetiawan', 'farissetiawan@gmail.com', '$2y$10$/rABVcqCCIsfVW59kEy4VOgdeYxj8IUAyVwkywXVfHFuIefkWsVPK', 'M Faris Setiawan', '0002990828', 'Wonorejo, Pasuruan, Jawa Timur', '2000-11-29', NULL, '085252892919', '1549932106.JPG', '2003430ade3c90bfa2b018c64fc6eea2a08d6a0c', '2019-02-11 21:58:50', '2019-02-11 17:39:24', '2019-02-11 21:58:50', NULL, 'Si0qB9ofJFpHBV6Uf8fNti9ip8PCk0AWS1AesVijE6MlgFT6CIreDR4SdMra'),
(5, 'dzulfikri', 'dzul@gmail.com', '$2y$10$7fBL9tN4nBq.Rh5qVNO3Ruods9bvy8SPWqCSRxPdzlX.YO35.tE5S', 'Dzulfikri Safril', '0123456789', 'Lamongan, Jawa Timur', '2000-06-29', NULL, '08528525855', '1549934520.JPG', 'e8621f7d62ab46a363eeda435a2dfad9dbfd3628', '2019-02-11 21:59:30', '2019-02-11 18:19:33', '2019-02-12 14:57:08', NULL, 'jJV4hnO3MbkIqe1GrdG7FN2SMuEKuVZaMtDt1rcAKXqqdc9iRE5KL3TX71Vg'),
(8, 'abdulazis', 'abdul@gmail.com', '$2y$10$jwhvwSASoWl6kN86tqh1s.9yOc6/QG9cUu1.MN6vBLCdi5HmRGfO2', 'Abdul Azis', '9876543210', 'Purwodadi, Pasuruan, Jawa Timur', '2000-06-07', NULL, '0282528082', NULL, '2ee444ae231a2d5162d9abe37b3d671290509055', '2019-02-11 21:52:39', '2019-02-11 21:41:18', '2019-02-12 14:55:28', NULL, 'RXF6sG2Q6GuZi5i9iZmKb840AWEDkwOnNHMjDvg4eI9jWoHUsruWtAQ4J2Z4');

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
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `petugass`
--

INSERT INTO `petugass` (`id_petugas`, `username`, `email`, `password`, `nama_petugas`, `jenis_kelamin`, `alamat_petugas`, `tanggal_lahir`, `telefone`, `id_level`, `image`, `created_at`, `updated_at`, `deleted_at`, `remember_token`) VALUES
(4, 'saputra', 'saputra@gmail.com', '$2y$10$MjwDMOkYHIISSpY5Ah4HluYS2Qivl4p8FpHBfjVvvKNXUeE3OYlym', 'Yudha Saputra', 'L', 'Malang, Jawa Timur', '2019-04-21', '08196462844', 4, '1549958795.png', '2019-02-05 22:57:35', '2019-02-12 08:39:32', NULL, 'rV0RIeS4p7AiJleieMvFP4ZyXgxEZmfOyignpRRruadNX9kZTLg53mABS9Bd'),
(5, 'farizal', 'farizal@gmail.com', '$2y$10$xbyrPVM1vhuODHRhFwOoDe/T9RmQ2Y08orK9PsPPlrMqwBR5D9lcy', 'Fariz Al Faridli', 'L', 'Lamongan, Jawa Timur', '2001-07-01', '0852852582', 4, '1549850281.png', '2019-02-10 18:55:10', '2019-02-11 03:01:31', NULL, 'Hqccd9lzK9YCIESi4LNVBOq7SizBa7vYmFiu2kZzZ5QeddNiTpYzk2Vl4Pqm'),
(6, 'anomdharma', 'anom@gmail.com', '$2y$10$o1dgC.5YY3Q2r3yh3bDACO35dMKxAreUOnbMi98E8JjCMIyNpp27q', 'Anom Dharma', 'L', 'Sukorejo, Pasuruan, Jawa Timur', '1999-06-10', '0221287918', 4, '1549936255.JPG', '2019-02-11 18:50:55', '2019-02-11 22:13:46', NULL, NULL);

-- --------------------------------------------------------

--
-- Struktur dari tabel `rekenings`
--

DROP TABLE IF EXISTS `rekenings`;
CREATE TABLE IF NOT EXISTS `rekenings` (
  `id_rekening` int(11) NOT NULL AUTO_INCREMENT,
  `nama_bank` varchar(255) NOT NULL,
  `no_rekening` varchar(255) NOT NULL,
  `atas_nama` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id_rekening`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `rekenings`
--

INSERT INTO `rekenings` (`id_rekening`, `nama_bank`, `no_rekening`, `atas_nama`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'BNI', '0123456789', 'Akbar Anung Yudha Saputra', '2019-02-10 19:41:23', '2019-02-10 19:46:30', NULL),
(2, 'BCA', '9876543210', 'Akbar Anung Yudha Saputra', '2019-02-10 19:47:46', '2019-02-11 02:51:37', NULL);

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
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `rutes`
--

INSERT INTO `rutes` (`id_rute`, `tujuan`, `rute_awal`, `rute_akhir`, `harga`, `jam_berangkat`, `jam_tiba`, `id_transportasi`, `id_type_rute`, `created_at`, `updated_at`, `deleted_at`) VALUES
(2, 'Yogyakarta', 'Pasuruan', 'Yogyakarta', '75.000', '07:30:00', '16:00:00', 3, 1, '2019-01-17 02:38:01', '2019-01-24 04:24:05', NULL),
(3, 'Yogyakarta', 'Pasuruan', 'Yogyakarta', '140.000', '07:45:00', '12:00:00', 3, 2, '2019-01-22 23:56:30', '2019-02-07 01:45:01', NULL),
(4, 'Surabaya', 'Gambir', 'Surayaba Pasarturi', '150.000', '09:30:00', '18:30:00', 4, 2, '2019-02-10 20:09:55', '2019-02-10 20:24:39', NULL),
(5, 'Gambir', 'Malang', 'Gambir', '200.000', '13:30:00', '04:27:00', 7, 2, '2019-02-11 18:11:30', '2019-02-11 18:11:30', NULL),
(6, 'Semarang', 'Gambir', 'Semarang Tawang', '150.000', '16:15:00', '22:15:00', 5, 2, '2019-02-11 18:12:29', '2019-02-11 18:12:29', NULL),
(7, 'Gambir', 'Bandung', 'Gambir', '100.000', '17:00:00', '20:15:00', 6, 1, '2019-02-11 18:13:27', '2019-02-11 18:13:27', NULL);

-- --------------------------------------------------------

--
-- Struktur dari tabel `testimoni`
--

DROP TABLE IF EXISTS `testimoni`;
CREATE TABLE IF NOT EXISTS `testimoni` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_user` int(11) NOT NULL,
  `content` text NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `id_user` (`id_user`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `testimoni`
--

INSERT INTO `testimoni` (`id`, `id_user`, `content`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 3, 'Prosesnya cepat dan mudah. Terima kasih Tickel.', '2019-02-10 21:03:07', '2019-02-11 04:12:49', NULL),
(2, 1, 'Perjalanan yang menakjubkan! Terima kasih Tickel.', '2019-02-10 21:20:36', '2019-02-10 21:20:36', NULL),
(3, 4, 'Sungguh mudah dan cepat proses pemesanan tiket nya! Terima kasih Tickel!', '2019-02-11 18:18:20', '2019-02-11 18:18:20', NULL),
(4, 5, 'Terima kasih Tickel!', '2019-02-11 18:45:19', '2019-02-11 18:45:19', NULL),
(5, 8, 'Tickel with my beautiful Trip! :D', '2019-02-12 00:05:44', '2019-02-12 00:05:44', NULL);

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
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `transportasis`
--

INSERT INTO `transportasis` (`id_transportasi`, `kode`, `jumlah_kursi`, `nama_transportasi`, `keterangan`, `id_type_transportasi`, `created_at`, `updated_at`, `deleted_at`) VALUES
(2, 'GI333', 10, 'Garuda Indonesia', NULL, 1, '2019-01-16 08:04:01', '2019-02-11 18:06:15', '2019-02-11 18:06:15'),
(3, 'KA333', 3, 'Logawa', NULL, 3, '2019-01-16 19:26:43', '2019-02-06 21:39:59', NULL),
(4, 'ABAP', 47, 'Argo Bromo Anggrek Pagi', NULL, 3, '2019-02-10 20:07:09', '2019-02-12 07:56:49', NULL),
(5, 'AM', 49, 'Argo Muria', NULL, 3, '2019-02-11 18:09:14', '2019-02-12 07:42:50', NULL),
(6, 'AP', 48, 'Argo Parahyangan', NULL, 3, '2019-02-11 18:09:52', '2019-02-11 23:57:22', NULL),
(7, 'GN', 49, 'Gajayana', NULL, 3, '2019-02-11 18:10:25', '2019-02-12 07:33:24', NULL);

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
(2, 'Eksekutif', NULL, '2019-01-16 19:56:41', '2019-02-07 01:51:06', NULL);

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
-- Ketidakleluasaan untuk tabel `bukti_pembayaran`
--
ALTER TABLE `bukti_pembayaran`
  ADD CONSTRAINT `bukti_admin` FOREIGN KEY (`id_admin`) REFERENCES `admins` (`id`),
  ADD CONSTRAINT `bukti_pemesanan` FOREIGN KEY (`id_pemesanan`) REFERENCES `pemesanans` (`id_pemesanan`),
  ADD CONSTRAINT `bukti_penumpang` FOREIGN KEY (`id_penumpang`) REFERENCES `penumpangs` (`id_penumpang`),
  ADD CONSTRAINT `bukti_petugas` FOREIGN KEY (`id_petugas`) REFERENCES `petugass` (`id_petugas`);

--
-- Ketidakleluasaan untuk tabel `kursis`
--
ALTER TABLE `kursis`
  ADD CONSTRAINT `kode_kursi` FOREIGN KEY (`id_transportasi`) REFERENCES `rutes` (`id_rute`);

--
-- Ketidakleluasaan untuk tabel `pemesanans`
--
ALTER TABLE `pemesanans`
  ADD CONSTRAINT `pemesanan_admin` FOREIGN KEY (`id_admin`) REFERENCES `admins` (`id`),
  ADD CONSTRAINT `pemesanan_petugas` FOREIGN KEY (`id_petugas`) REFERENCES `petugass` (`id_petugas`) ON DELETE NO ACTION,
  ADD CONSTRAINT `pemesanan_rute` FOREIGN KEY (`id_rute`) REFERENCES `rutes` (`id_rute`) ON DELETE CASCADE,
  ADD CONSTRAINT `pemesanan_user` FOREIGN KEY (`id_pelanggan`) REFERENCES `penumpangs` (`id_penumpang`) ON DELETE CASCADE;

--
-- Ketidakleluasaan untuk tabel `petugass`
--
ALTER TABLE `petugass`
  ADD CONSTRAINT `level` FOREIGN KEY (`id_level`) REFERENCES `levels` (`id_level`) ON DELETE CASCADE;

--
-- Ketidakleluasaan untuk tabel `rutes`
--
ALTER TABLE `rutes`
  ADD CONSTRAINT `transportasi` FOREIGN KEY (`id_transportasi`) REFERENCES `transportasis` (`id_transportasi`),
  ADD CONSTRAINT `type` FOREIGN KEY (`id_type_rute`) REFERENCES `type_rute` (`id_type_rute`);

--
-- Ketidakleluasaan untuk tabel `testimoni`
--
ALTER TABLE `testimoni`
  ADD CONSTRAINT `testimoni_user` FOREIGN KEY (`id_user`) REFERENCES `penumpangs` (`id_penumpang`);

--
-- Ketidakleluasaan untuk tabel `transportasis`
--
ALTER TABLE `transportasis`
  ADD CONSTRAINT `type_transportasi` FOREIGN KEY (`id_type_transportasi`) REFERENCES `type_transportasi` (`id_type_transportasi`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
