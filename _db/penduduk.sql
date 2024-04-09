-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 29 Agu 2023 pada 12.20
-- Versi server: 10.4.18-MariaDB
-- Versi PHP: 7.4.16

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `penduduk`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_admin`
--

CREATE TABLE `tb_admin` (
  `id_admin` varchar(50) NOT NULL,
  `nama` varchar(255) NOT NULL,
  `status` varchar(100) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` text NOT NULL,
  `level` varchar(50) NOT NULL DEFAULT 'Administrator'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `tb_admin`
--

INSERT INTO `tb_admin` (`id_admin`, `nama`, `status`, `email`, `password`, `level`) VALUES
('', 'Hafa Tarmizi', '', 'hafa@admin.com', 'e10adc3949ba59abbe56e057f20f883e', 'Administrator'),
('axsj001sAOWn', 'Ali Mochtar', 'Admin web', 'admin@admin.com', '5f4dcc3b5aa765d61d8327deb882cf99', 'Administrator');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_anggota`
--

CREATE TABLE `tb_anggota` (
  `id_anggota` varchar(50) NOT NULL,
  `nama` varchar(255) NOT NULL,
  `jenis_kelamin` varchar(50) NOT NULL,
  `tgl_lahir` date NOT NULL,
  `tempat_lahir` varchar(255) NOT NULL,
  `agama` varchar(50) NOT NULL,
  `pendidikan` varchar(100) NOT NULL,
  `pekerjaan` varchar(100) NOT NULL,
  `hubungan` varchar(100) NOT NULL,
  `perkawinan` varchar(50) NOT NULL,
  `kewarganegaraan` varchar(50) NOT NULL,
  `nama_ayah` varchar(255) NOT NULL,
  `nama_ibu` varchar(255) NOT NULL,
  `nik` varchar(50) NOT NULL,
  `no_hp_anggota` varchar(50) NOT NULL,
  `id_kk` varchar(50) NOT NULL,
  `id_rt` varchar(50) NOT NULL,
  `level` varchar(50) NOT NULL DEFAULT 'anggota_kk'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `tb_anggota`
--

INSERT INTO `tb_anggota` (`id_anggota`, `nama`, `jenis_kelamin`, `tgl_lahir`, `tempat_lahir`, `agama`, `pendidikan`, `pekerjaan`, `hubungan`, `perkawinan`, `kewarganegaraan`, `nama_ayah`, `nama_ibu`, `nik`, `no_hp_anggota`, `id_kk`, `id_rt`, `level`) VALUES
('A001DUrSFfG6WLqW', 'LUTFI IRAWAN', 'Laki-laki', '1977-08-29', 'CILEGON', 'Islam', 'S2', 'Konstruksi', 'Kepala Keluarga', 'Kawin', 'WNI', 'LUTFI DARMAWAN', 'INDAH SEKALI', '136787654567876001', '62817987678777', 'K001naheZEVToVQP', 'RT001HBZElIZGD904', 'anggota_kk'),
('A002kDoJBhJQjJn5', 'DITA SULASTRI', 'Perempuan', '1988-05-01', 'CILEGON', 'Islam', 'S1', 'Mengurus Rumah Tangga', 'Istri', 'Kawin', 'WNI', 'FIRMAN SANJAYA', 'FENI MAWAR MELATI', '136787654567876002', '62817898776633', 'K001naheZEVToVQP', 'RT001HBZElIZGD904', 'anggota_kk'),
('A0031xB659xXnMDj', 'ASEP SULAIMAN', 'Laki-laki', '1945-01-01', 'SURABAYA', 'Islam', 'S3', 'Pensiunan', 'Kepala Keluarga', 'Kawin', 'WNI', 'ASEP DARMAJI', 'ITENG AYU DEWI', '136787654567999001', '6281987877344', 'K002ADzTWh68LwLl', 'RT001cETdomFO4n4j', 'anggota_kk');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_data_lain`
--

CREATE TABLE `tb_data_lain` (
  `id_data_lain` varchar(50) NOT NULL,
  `nama` varchar(255) NOT NULL,
  `nik` varchar(50) NOT NULL,
  `jenis_kelamin` varchar(50) NOT NULL,
  `alamat` text NOT NULL,
  `tanggal` date NOT NULL,
  `keterangan` text NOT NULL,
  `id_rt` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `tb_data_lain`
--

INSERT INTO `tb_data_lain` (`id_data_lain`, `nama`, `nik`, `jenis_kelamin`, `alamat`, `tanggal`, `keterangan`, `id_rt`) VALUES
('D001g1LMD0U77Sd6', 'LUTFI IRAWAN', '136787654567876001', 'Laki-laki', 'Jl. Raya Kalitimbang No.0197 Kalitimbang Cibeber Cilegon Banten', '1988-01-01', 'Pindah', 'RT001HBZElIZGD904');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_informasi`
--

CREATE TABLE `tb_informasi` (
  `id_informasi` varchar(50) NOT NULL,
  `informasi` text NOT NULL,
  `berkas` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `tb_informasi`
--

INSERT INTO `tb_informasi` (`id_informasi`, `informasi`, `berkas`) VALUES
('I0015LKklU', '<p><span style=\"font-size:22px\"><strong>Mohon untuk semua ketua RT melengkapi data warganya</strong></span></p>\r\n\r\n<p><span style=\"font-size:14px\"><strong>1. Data Warga</strong></span></p>\r\n\r\n<p><span style=\"font-size:14px\"><strong>2. Data Kartu Keluarga</strong></span></p>\r\n\r\n<p><span style=\"font-size:14px\"><strong>3. Upload FC Kartu Keluarga</strong></span></p>\r\n\r\n<p><span style=\"font-size:14px\"><strong>Terima kasih, mudah-mudahan GAJI RT naik ya... SEMANGAT.!!!</strong></span></p>\r\n', 'ALI_MOCHTAR_PRODUCTIONS_new.png'),
('I002zXvhPR', '<p><strong><big><span style=\"color:#e74c3c\">kepada seluruh RT, Mohon segera melengkapi data warga&nbsp;</span></big></strong></p>\r\n', 'ALI_MOCHTAR_PRODUCTIONS_new1.png');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_kk`
--

CREATE TABLE `tb_kk` (
  `id_kk` varchar(50) NOT NULL,
  `no_kk` varchar(50) NOT NULL,
  `nama_kk` varchar(255) NOT NULL,
  `alamat` varchar(255) NOT NULL,
  `no_hp` varchar(50) NOT NULL,
  `foto_kk` text NOT NULL,
  `password` text NOT NULL,
  `id_rt` varchar(50) NOT NULL,
  `uuid` text NOT NULL,
  `tgl_update` datetime DEFAULT NULL,
  `level` varchar(50) NOT NULL DEFAULT 'kepala_kk'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `tb_kk`
--

INSERT INTO `tb_kk` (`id_kk`, `no_kk`, `nama_kk`, `alamat`, `no_hp`, `foto_kk`, `password`, `id_rt`, `uuid`, `tgl_update`, `level`) VALUES
('K001naheZEVToVQP', '136787654567876000', 'LUTFI IRAWAN', 'Jl. Raya Kalitimbang No.0190 Kalitimbang Cibeber Cilegon Banten', '62817987678777', 'LUTFI IRAWAN_64edbd8f2191d.jpg', '', 'RT001HBZElIZGD904', '', '2023-08-29 16:46:50', 'kepala_kk'),
('K002ADzTWh68LwLl', '136787654567999000', 'ASEP SULAIMAN', 'Jl. Raya Kalitimbang No.0177 Kalitimbang Cibeber Cilegon Banten', '6281987877344', 'ASEP SULAIMAN_64edbf5d03def.jpg', '', 'RT001cETdomFO4n4j', '', '2023-08-29 16:51:39', 'kepala_kk');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_rt`
--

CREATE TABLE `tb_rt` (
  `id_rt` varchar(50) NOT NULL,
  `no_rt` varchar(50) NOT NULL,
  `nama_rt` varchar(255) NOT NULL,
  `alamat` varchar(255) NOT NULL,
  `no_hp` varchar(255) NOT NULL,
  `password` text NOT NULL,
  `level` varchar(50) NOT NULL DEFAULT 'ketua_rt',
  `email` varchar(255) DEFAULT NULL,
  `id_token` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `tb_rt`
--

INSERT INTO `tb_rt` (`id_rt`, `no_rt`, `nama_rt`, `alamat`, `no_hp`, `password`, `level`, `email`, `id_token`) VALUES
('RT001cETdomFO4n4j', '0105', 'SAMSUDIN MALIK', 'Jl. Raya Kalitimbang No.0105 Kalitimbang Cibeber Cilegon Banten', '62817985320105', 'c33367701511b4f6020ec61ded352059', 'ketua_rt', 'rt01gcd@gmail.com', 'T017'),
('RT001HBZElIZGD904', '0101', 'ABDULLAH', 'Jl. Raya Kalitimbang No.0101 Kalitimbang Cibeber Cilegon Banten', '62817985320101', '93279e3308bdbbeed946fc965017f67a', 'ketua_rt', '0101kaltim@gmail.com', NULL),
('RT001NNK69xvnFZ9z', '0201', 'ACHMAD NUR ROFI', 'Jl. Raya Kalitimbang No.0201 Kalitimbang Cibeber Cilegon Banten', '62817985320201', 'e10adc3949ba59abbe56e057f20f883e', 'ketua_rt', '0201kaltim@gmail.com', NULL),
('RT001XeVahC6BJR2u', '0301', 'ADRIZAL FIRMANSYAH', 'Jl. Raya Kalitimbang No.0301 Kalitimbang Cibeber Cilegon Banten', '62817985320301', 'e10adc3949ba59abbe56e057f20f883e', 'ketua_rt', '0301kaltim@gmail.com', NULL);

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_token`
--

CREATE TABLE `tb_token` (
  `id_token` varchar(50) NOT NULL,
  `token` text NOT NULL,
  `expired` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `tb_token`
--

INSERT INTO `tb_token` (`id_token`, `token`, `expired`) VALUES
('T001', 'MrU4d906bJRsFlMFAhq42xxRy', '2023-08-25 22:54:42'),
('T002', 'uYFyWmqZbN4O4to3fOJ8trKtK', '2023-08-25 22:55:49'),
('T003', 'Up7hPvnoIJ6SpfXN34hjjKOLh', '2023-08-25 23:09:16'),
('T004', 'YY5wJhnCKRNpGCaQv2bCKIL0F', '2023-08-25 23:16:12'),
('T005', 'WFxZoa8erlr2XJoWGUwSGvi5T', '2023-08-25 23:31:51'),
('T006', 'z8ZxTsq8G2m83T3OszQa0pWJB', '2023-08-25 23:34:25'),
('T007', 'ZeFeGLRlxNFuykjp8FV2PZasM', '2023-08-25 23:37:24'),
('T008', 'ZKLg8vYsDE1yK7x06mDUVNBd3', '2023-08-26 08:04:51'),
('T009', 'homnkmbuTuuw2en1MqqKwlQ4V', '2023-08-26 08:42:55'),
('T010', 'w6X31cN2lJMDLrIqfay47OmYG', '2023-08-26 09:14:10'),
('T011', 'arHUFJmKK1gQewdnuuNILsGlF', '2023-08-26 09:16:57'),
('T012', 'vQXeyuNmZAbgi5RLjOxhdUZs5', '2023-08-26 09:20:58'),
('T013', 'DCyCrPs15KUpT40kulFKWRsWs', '2023-08-28 20:09:44'),
('T014', 'IYyDZNnApvkKUPhOpaFOa2hFW', '2023-08-28 20:11:35'),
('T015', '6Jlj54U0CeZEQin5s8vym2Hod', '2023-08-28 20:14:09'),
('T016', 'YVV1VHPr19UukqvWmnLA0Jpvq', '2023-08-29 10:14:56'),
('T017', 'oyJu45isisRNRIODCDNaSZ5wX', '2023-08-29 10:18:02');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `tb_admin`
--
ALTER TABLE `tb_admin`
  ADD PRIMARY KEY (`id_admin`);

--
-- Indeks untuk tabel `tb_anggota`
--
ALTER TABLE `tb_anggota`
  ADD PRIMARY KEY (`id_anggota`),
  ADD KEY `id_kk` (`id_kk`);

--
-- Indeks untuk tabel `tb_data_lain`
--
ALTER TABLE `tb_data_lain`
  ADD PRIMARY KEY (`id_data_lain`),
  ADD KEY `fk_data_lain_rt` (`id_rt`);

--
-- Indeks untuk tabel `tb_informasi`
--
ALTER TABLE `tb_informasi`
  ADD PRIMARY KEY (`id_informasi`);

--
-- Indeks untuk tabel `tb_kk`
--
ALTER TABLE `tb_kk`
  ADD PRIMARY KEY (`id_kk`),
  ADD KEY `id_rt` (`id_rt`);

--
-- Indeks untuk tabel `tb_rt`
--
ALTER TABLE `tb_rt`
  ADD PRIMARY KEY (`id_rt`);

--
-- Indeks untuk tabel `tb_token`
--
ALTER TABLE `tb_token`
  ADD PRIMARY KEY (`id_token`);

--
-- Ketidakleluasaan untuk tabel pelimpahan (Dumped Tables)
--

--
-- Ketidakleluasaan untuk tabel `tb_anggota`
--
ALTER TABLE `tb_anggota`
  ADD CONSTRAINT `tb_anggota_ibfk_1` FOREIGN KEY (`id_kk`) REFERENCES `tb_kk` (`id_kk`) ON UPDATE CASCADE;

--
-- Ketidakleluasaan untuk tabel `tb_data_lain`
--
ALTER TABLE `tb_data_lain`
  ADD CONSTRAINT `fk_data_lain_rt` FOREIGN KEY (`id_rt`) REFERENCES `tb_rt` (`id_rt`) ON UPDATE CASCADE;

--
-- Ketidakleluasaan untuk tabel `tb_kk`
--
ALTER TABLE `tb_kk`
  ADD CONSTRAINT `tb_kk_ibfk_1` FOREIGN KEY (`id_rt`) REFERENCES `tb_rt` (`id_rt`) ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
