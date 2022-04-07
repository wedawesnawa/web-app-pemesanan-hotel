-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 07, 2022 at 09:24 AM
-- Server version: 10.4.21-MariaDB
-- PHP Version: 8.0.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_hotel`
--

-- --------------------------------------------------------

--
-- Table structure for table `tb_fasilitas_hotel`
--

CREATE TABLE `tb_fasilitas_hotel` (
  `id_fasilitas_hotel` varchar(11) NOT NULL,
  `nama_fasilitas` varchar(50) NOT NULL,
  `foto` varchar(150) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tb_fasilitas_hotel`
--

INSERT INTO `tb_fasilitas_hotel` (`id_fasilitas_hotel`, `nama_fasilitas`, `foto`) VALUES
('FH001', 'WiFi gratis di semua kamar', '1648518363624.png'),
('FH002', 'Kolam renang luar ruangan', '164854555064.png'),
('FH003', 'Restoran', '1648545716885.png'),
('FH004', 'Resepsionis 24 jam', '1648545816196.png');

-- --------------------------------------------------------

--
-- Table structure for table `tb_fasilitas_kamar`
--

CREATE TABLE `tb_fasilitas_kamar` (
  `id_fasilitas_kamar` varchar(11) NOT NULL,
  `id_kategori` varchar(11) NOT NULL,
  `nama_fasilitas` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tb_fasilitas_kamar`
--

INSERT INTO `tb_fasilitas_kamar` (`id_fasilitas_kamar`, `id_kategori`, `nama_fasilitas`) VALUES
('LF001', 'KT001', 'WiFi gratis'),
('LF002', 'KT001', '1 kasur queen size'),
('LF003', 'KT001', 'Ukuran kamar: 36 m²/388 ft²'),
('LF004', 'KT001', 'Pancuran'),
('LF005', 'KT001', 'Kamar mandi bersama'),
('LF006', 'KT002', 'WiFi gratis'),
('LF008', 'KT002', 'Ukuran kamar: 36 m²/388 ft²'),
('LF009', 'KT002', 'Bebas asap rokok'),
('LF010', 'KT002', 'Pancuran & bak mandi'),
('LF011', 'KT002', '1 kasur single atau 1 kasur double');

-- --------------------------------------------------------

--
-- Table structure for table `tb_foto_hotel`
--

CREATE TABLE `tb_foto_hotel` (
  `id_foto_hotel` varchar(11) NOT NULL,
  `foto` varchar(150) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tb_foto_hotel`
--

INSERT INTO `tb_foto_hotel` (`id_foto_hotel`, `foto`) VALUES
('FH001', '164852180510.jpg'),
('FH002', '164856860945.jpg'),
('FH003', '1648570254790.jpg'),
('FH004', '1648569273265.jpg'),
('FH005', '1648570297341.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `tb_foto_kamar`
--

CREATE TABLE `tb_foto_kamar` (
  `id_foto_kamar` varchar(11) NOT NULL,
  `foto` varchar(50) NOT NULL,
  `id_kategori` varchar(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tb_foto_kamar`
--

INSERT INTO `tb_foto_kamar` (`id_foto_kamar`, `foto`, `id_kategori`) VALUES
('LP001', '1648570786438.jpg', 'KT001'),
('LP002', '1648570794635.jpg', 'KT001'),
('LP003', '1648570799497.jpg', 'KT001'),
('LP004', '1648570807136.jpg', 'KT001'),
('LP005', '1648570965488.jpg', 'KT001'),
('LP006', '1648632717112.jpg', 'KT002'),
('LP007', '1648745049514.jpg', 'KT002'),
('LP008', '1648745065886.jpg', 'KT002'),
('LP009', '1648745071911.jpg', 'KT002'),
('LP010', '1649205625569.png', 'KT002');

-- --------------------------------------------------------

--
-- Table structure for table `tb_hotel`
--

CREATE TABLE `tb_hotel` (
  `id_hotel` varchar(11) NOT NULL,
  `keterangan` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tb_hotel`
--

INSERT INTO `tb_hotel` (`id_hotel`, `keterangan`) VALUES
('HT001', 'Da Hotel terletak di Tegallalang, Bali. Hotel mewah ini memiliki fasilitas kolam renang outdoor dengan pemandangan hutan dan pusat kebugaran. WiFi gratis dapat diakses di seluruh area properti.'),
('HT002', 'lorem');

-- --------------------------------------------------------

--
-- Table structure for table `tb_kamar`
--

CREATE TABLE `tb_kamar` (
  `id` int(11) NOT NULL,
  `no_kamar` varchar(11) NOT NULL,
  `id_kategori` varchar(11) NOT NULL,
  `id_pelanggan` varchar(11) NOT NULL,
  `status` enum('active','non-active') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tb_kamar`
--

INSERT INTO `tb_kamar` (`id`, `no_kamar`, `id_kategori`, `id_pelanggan`, `status`) VALUES
(1, '1', 'KT001', 'PL006', 'active'),
(2, '2', 'KT001', 'PL006', 'active'),
(3, '3', 'KT001', 'PL006', 'active'),
(4, '4', 'KT001', 'PL006', 'active'),
(5, '5', 'KT001', 'PL007', 'active'),
(8, '6', 'KT001', 'PL007', 'active'),
(9, '7', 'KT001', 'PL005', 'active'),
(10, '8', 'KT001', '', 'non-active'),
(11, '9', 'KT001', '', 'non-active'),
(12, '10', 'KT001', 'PL005', 'active'),
(13, '11', 'KT002', '', 'non-active'),
(14, '12', 'KT002', '', 'non-active'),
(15, '13', 'KT002', '', 'non-active'),
(16, '14', 'KT002', '', 'non-active'),
(17, '15', 'KT002', '', 'non-active'),
(18, '16', 'KT002', '', 'non-active'),
(19, '17', 'KT002', '', 'non-active'),
(20, '18', 'KT002', '', 'non-active'),
(21, '19', 'KT002', '', 'non-active'),
(22, '20', 'KT002', '', 'non-active');

-- --------------------------------------------------------

--
-- Table structure for table `tb_kategori`
--

CREATE TABLE `tb_kategori` (
  `id_kategori` varchar(11) NOT NULL,
  `nama_kategori` varchar(30) NOT NULL,
  `foto_kategori` varchar(50) NOT NULL,
  `harga` int(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tb_kategori`
--

INSERT INTO `tb_kategori` (`id_kategori`, `nama_kategori`, `foto_kategori`, `harga`) VALUES
('KT001', 'Superior', '1648564505376.jpg', 150000),
('KT002', 'Deluxe', '1648564518951.jpg', 300000);

-- --------------------------------------------------------

--
-- Table structure for table `tb_lokasi`
--

CREATE TABLE `tb_lokasi` (
  `id_lokasi` varchar(11) NOT NULL,
  `list` varchar(50) NOT NULL,
  `jarak` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tb_lokasi`
--

INSERT INTO `tb_lokasi` (`id_lokasi`, `list`, `jarak`) VALUES
('HL001', 'Tegallalang Rice Terrace', '5 km'),
('HL002', 'Monkey Forest', '5 km'),
('HL003', 'Campuhan Ridge Walk', '8,8 km'),
('HL004', 'Museum Seni Agung Rai', '6 km'),
('HL005', 'Candi Gunung Kawi', '7 km'),
('HL006', 'Goa Gajah', '11 km'),
('HL007', 'Pantai Lebih', '12 km'),
('HL008', 'Wisata Desa Petulu', '4 km');

-- --------------------------------------------------------

--
-- Table structure for table `tb_order_kamar`
--

CREATE TABLE `tb_order_kamar` (
  `id_order_kamar` int(11) NOT NULL,
  `id_reservasi` varchar(11) NOT NULL,
  `id` int(11) NOT NULL,
  `id_pelanggan` varchar(11) NOT NULL,
  `status` enum('pesan','proses','selesai') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tb_order_kamar`
--

INSERT INTO `tb_order_kamar` (`id_order_kamar`, `id_reservasi`, `id`, `id_pelanggan`, `status`) VALUES
(1, 'RS001', 2, 'PL001', 'selesai'),
(2, 'RS002', 1, 'PL002', 'selesai'),
(3, 'RS002', 3, 'PL002', 'selesai'),
(4, 'RS002', 4, 'PL002', 'selesai'),
(5, 'RS003', 5, 'PL003', 'selesai'),
(6, 'RS003', 8, 'PL003', 'selesai'),
(7, 'RS004', 10, 'PL004', 'selesai'),
(8, 'RS004', 11, 'PL004', 'selesai'),
(9, 'RS005', 9, 'PL005', 'proses'),
(10, 'RS005', 12, 'PL005', 'proses'),
(11, 'RS006', 1, 'PL006', 'proses'),
(12, 'RS006', 2, 'PL006', 'proses'),
(13, 'RS006', 3, 'PL006', 'proses'),
(14, 'RS006', 4, 'PL006', 'proses'),
(15, 'RS007', 5, 'PL007', 'proses'),
(16, 'RS007', 8, 'PL007', 'proses');

-- --------------------------------------------------------

--
-- Table structure for table `tb_pelanggan`
--

CREATE TABLE `tb_pelanggan` (
  `id_pelanggan` varchar(11) NOT NULL,
  `nama_lengkap` varchar(50) NOT NULL,
  `nama_panggilan` varchar(30) NOT NULL,
  `nama_tamu` varchar(50) NOT NULL,
  `no_tlp` varchar(13) NOT NULL,
  `email` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tb_pelanggan`
--

INSERT INTO `tb_pelanggan` (`id_pelanggan`, `nama_lengkap`, `nama_panggilan`, `nama_tamu`, `no_tlp`, `email`) VALUES
('PL001', 'man weda', 'man', 'man weda', '087509370460', '087509370460@gmail.com'),
('PL002', 'kmg weda', 'kmg', 'kmg weda', '087899509350', '087899509350@gmail.com'),
('PL003', 'nyoman weda', 'nyoman ', 'nyoman weda', '087899509340', '087899509340@gmail.com'),
('PL004', 'weda wesnawa', 'weda', 'weda wesnawa', '087899509320', 'wedawesnawa@gmail.com'),
('PL005', 'da weda', 'da', 'da weda', '087899509360', 'daweda@gmail.com'),
('PL006', 'komang weda', 'kom', 'komang weda', '087899370201', 'komweda@gmail.com'),
('PL007', 'pnww weda', 'wdg', 'pnww weda', '087889360460', '087889360460@gmail.com');

-- --------------------------------------------------------

--
-- Table structure for table `tb_reservasi`
--

CREATE TABLE `tb_reservasi` (
  `id_reservasi` varchar(11) NOT NULL,
  `id_pelanggan` varchar(11) NOT NULL,
  `cek_in` date NOT NULL,
  `cek_out` date NOT NULL,
  `id_kategori` varchar(11) NOT NULL,
  `tgl_reservasi` date NOT NULL,
  `status` enum('proses','selesai') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tb_reservasi`
--

INSERT INTO `tb_reservasi` (`id_reservasi`, `id_pelanggan`, `cek_in`, `cek_out`, `id_kategori`, `tgl_reservasi`, `status`) VALUES
('RS001', 'PL001', '2022-04-05', '2022-04-06', 'KT001', '2022-04-05', 'selesai'),
('RS002', 'PL002', '2022-04-06', '2022-04-07', 'KT001', '2022-04-06', 'selesai'),
('RS003', 'PL003', '2022-04-06', '2022-04-07', 'KT001', '2022-04-06', 'selesai'),
('RS004', 'PL004', '2022-04-06', '2022-04-07', 'KT001', '2022-04-06', 'selesai'),
('RS005', 'PL005', '2022-04-07', '2022-04-08', 'KT001', '2022-04-06', 'proses'),
('RS006', 'PL006', '2022-04-07', '2022-04-08', 'KT001', '2022-04-07', 'proses'),
('RS007', 'PL007', '2022-04-07', '2022-04-08', 'KT001', '2022-04-07', 'proses');

-- --------------------------------------------------------

--
-- Table structure for table `tb_user`
--

CREATE TABLE `tb_user` (
  `id_user` varchar(11) NOT NULL,
  `username` varchar(30) NOT NULL,
  `password` varchar(30) NOT NULL,
  `nama_user` varchar(30) NOT NULL,
  `email` varchar(30) NOT NULL,
  `level` enum('admin','resepsionis') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tb_user`
--

INSERT INTO `tb_user` (`id_user`, `username`, `password`, `nama_user`, `email`, `level`) VALUES
('US001', 'adminwe', 'd2VkYQ==', 'admin', 'adminwe@gmail.com', 'admin'),
('US002', 'resepsionis', 'd2VkYQ==', 'weda resepsionis', 'resepsionis@gmail.com', 'resepsionis'),
('US003', 'wedarep', 'd2VkYQ==', 'wedaresep', 'wedarep@gmail.com', 'resepsionis');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tb_fasilitas_hotel`
--
ALTER TABLE `tb_fasilitas_hotel`
  ADD PRIMARY KEY (`id_fasilitas_hotel`);

--
-- Indexes for table `tb_fasilitas_kamar`
--
ALTER TABLE `tb_fasilitas_kamar`
  ADD PRIMARY KEY (`id_fasilitas_kamar`);

--
-- Indexes for table `tb_foto_hotel`
--
ALTER TABLE `tb_foto_hotel`
  ADD PRIMARY KEY (`id_foto_hotel`);

--
-- Indexes for table `tb_foto_kamar`
--
ALTER TABLE `tb_foto_kamar`
  ADD PRIMARY KEY (`id_foto_kamar`);

--
-- Indexes for table `tb_hotel`
--
ALTER TABLE `tb_hotel`
  ADD PRIMARY KEY (`id_hotel`);

--
-- Indexes for table `tb_kamar`
--
ALTER TABLE `tb_kamar`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tb_kategori`
--
ALTER TABLE `tb_kategori`
  ADD PRIMARY KEY (`id_kategori`);

--
-- Indexes for table `tb_lokasi`
--
ALTER TABLE `tb_lokasi`
  ADD PRIMARY KEY (`id_lokasi`);

--
-- Indexes for table `tb_order_kamar`
--
ALTER TABLE `tb_order_kamar`
  ADD PRIMARY KEY (`id_order_kamar`),
  ADD KEY `id_reservasi` (`id_reservasi`),
  ADD KEY `id` (`id`);

--
-- Indexes for table `tb_pelanggan`
--
ALTER TABLE `tb_pelanggan`
  ADD PRIMARY KEY (`id_pelanggan`);

--
-- Indexes for table `tb_reservasi`
--
ALTER TABLE `tb_reservasi`
  ADD PRIMARY KEY (`id_reservasi`);

--
-- Indexes for table `tb_user`
--
ALTER TABLE `tb_user`
  ADD PRIMARY KEY (`id_user`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tb_kamar`
--
ALTER TABLE `tb_kamar`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT for table `tb_order_kamar`
--
ALTER TABLE `tb_order_kamar`
  MODIFY `id_order_kamar` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
