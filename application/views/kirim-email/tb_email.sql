-- phpMyAdmin SQL Dump
-- version 5.1.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 04 Bulan Mei 2022 pada 05.36
-- Versi server: 10.4.19-MariaDB
-- Versi PHP: 7.3.28

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `apk-internet`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_email`
--

CREATE TABLE `tb_email` (
  `id_email` varchar(50) NOT NULL,
  `nama_pengirim` varchar(255) NOT NULL,
  `subject` varchar(255) NOT NULL,
  `isi_pesan` text NOT NULL,
  `tanda_tangan` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `tb_email`
--

INSERT INTO `tb_email` (`id_email`, `nama_pengirim`, `subject`, `isi_pesan`, `tanda_tangan`) VALUES
('E001', 'ALIMOCHTAR

WIFI', 'Selamat hari raya idul fitri 1443 H.', '<p>Jika ada kata terselip dusta, ada sikap membekas lara, dan langkah menggores luka, semoga masih ada maaf yang tersisa. Mohon maaf lahir dan batin.</p>\r\n\r\n<p>Jika jemari tak sempat berjabat. Jika raga tak bisa bersua. Bila ada kata membekas luka. Semoga pintu maaf masih terbuka. Selamat Idul Fitri 1443 H. Mohon maaf lahir dan batin.</p>\r\n\r\n<p>Ketika jarak menghalangi untuk bersalaman, ketika tubuh tak mampu untuk merengkuh. Maka, hanya kata-kata yang bisa dikirimkan untuk mewakili permintaan maaf. Selamat Hari Raya Idul Fitri 1443 H. Mohon maaf lahir batin.</p>\r\n', 'wifi@alimochtar.my.id');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `tb_email`
--
ALTER TABLE `tb_email`
  ADD PRIMARY KEY (`id_email`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
