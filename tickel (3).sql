-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Waktu pembuatan: 06 Feb 2019 pada 07.08
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
(1, 'admin', 'admin@admin.com', '$2y$10$pLSxCFmhYqz4id5B9v6/HOKFFHu4LfsmTr5ytC9HR..GKPF70OxBu', 'itiiQhWO0RLfykTJoXIpyvr1YjjBVtyxPNz8VmTGgVS5M9J7aOeQWu2tb8kV', 'Admin Tickel', '1548164287.png', 1, '2019-01-13 15:04:23', '2019-02-06 06:04:13');

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
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id_bukti`),
  KEY `id_penumpang` (`id_penumpang`),
  KEY `id_pemesanan` (`id_pemesanan`),
  KEY `id_petugas` (`id_petugas`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `bukti_pembayaran`
--

INSERT INTO `bukti_pembayaran` (`id_bukti`, `id_penumpang`, `id_pemesanan`, `file`, `id_petugas`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 1, 6, '1549436666.png', NULL, '2019-02-05 21:13:15', '2019-02-06 00:04:26', NULL);

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
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id_pemesanan`),
  KEY `id_pelanggan` (`id_pelanggan`),
  KEY `id_rute` (`id_rute`),
  KEY `pemesanan_petugas` (`id_petugas`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `pemesanans`
--

INSERT INTO `pemesanans` (`id_pemesanan`, `kode_pemesanan`, `tanggal_pemesanan`, `tempat_pemesanan`, `status`, `id_pelanggan`, `kode_kursi`, `id_rute`, `tujuan`, `tanggal_berangkat`, `jam_cekin`, `jam_berangkat`, `total_bayar`, `id_petugas`, `created_at`, `updated_at`, `deleted_at`) VALUES
(6, '5c5a5edb5e12a', '2019-02-06 00:00:00', 'Pasuruan', 'Proccess', 1, 'KA333-5', 2, 'Yogyakarta', '2019-04-21', '00:00:00', '07:30:00', '75.000', NULL, '2019-02-05 21:13:15', '2019-02-06 00:04:26', NULL);

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
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `remember_token` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id_penumpang`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `penumpangs`
--

INSERT INTO `penumpangs` (`id_penumpang`, `username`, `email`, `password`, `nama_penumpang`, `no_identitas`, `alamat_penumpang`, `tanggal_lahir`, `jenis_kelamin`, `telefone`, `image`, `created_at`, `updated_at`, `deleted_at`, `remember_token`) VALUES
(1, 'akbarsaputrait', 'akbar@gmail.com', '$2y$10$1KJKocG1wVrZDKLrp2VVNe/tKZW79PVPxBWqzcw8mV3xYxe0pzUGu', 'Akbar Anung Yudha Saputra', '0003135234', 'Malang, Jawa Timur', '2000-12-26', 'L', '081931006841', '1548940509.jpg', '2019-01-31 06:14:32', '2019-02-06 07:07:08', NULL, 'fGJ69BjBU1lbDLgxmLzmvov4Ke5fvqg5rv2owq5rJYcu0ip5WIS7vfH9wh9b');

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
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `petugass`
--

INSERT INTO `petugass` (`id_petugas`, `username`, `email`, `password`, `nama_petugas`, `jenis_kelamin`, `alamat_petugas`, `tanggal_lahir`, `telefone`, `id_level`, `image`, `created_at`, `updated_at`, `deleted_at`, `remember_token`) VALUES
(4, 'saputra', 'saputra@gmail.com', '$2y$10$1eScfMndVMUPFbLGLh69yeSlPEjOAnktXC.kaJW70jlFo6LNYtMWO', 'Yudha Saputra', 'L', 'Malang, Jawa Timur', '2019-04-21', '08196462844', 4, '1549432655.png', '2019-02-05 22:57:35', '2019-02-06 06:32:02', NULL, 'XkUfQr3NCXlDIgulTttbhuL34hr0K1ND5jpMenPycvlvF5sLMCmgyLC8PLmw');

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
(3, 'KA333', 4, 'Logawa', NULL, 3, '2019-01-16 19:26:43', '2019-02-05 21:13:15', NULL);

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
-- Ketidakleluasaan untuk tabel `bukti_pembayaran`
--
ALTER TABLE `bukti_pembayaran`
  ADD CONSTRAINT `bukti_pemesanan` FOREIGN KEY (`id_pemesanan`) REFERENCES `pemesanans` (`id_pemesanan`),
  ADD CONSTRAINT `bukti_penumpang` FOREIGN KEY (`id_penumpang`) REFERENCES `penumpangs` (`id_penumpang`);

--
-- Ketidakleluasaan untuk tabel `kursis`
--
ALTER TABLE `kursis`
  ADD CONSTRAINT `kode_kursi` FOREIGN KEY (`id_transportasi`) REFERENCES `rutes` (`id_rute`);

--
-- Ketidakleluasaan untuk tabel `pemesanans`
--
ALTER TABLE `pemesanans`
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
-- Ketidakleluasaan untuk tabel `transportasis`
--
ALTER TABLE `transportasis`
  ADD CONSTRAINT `type_transportasi` FOREIGN KEY (`id_type_transportasi`) REFERENCES `type_transportasi` (`id_type_transportasi`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
