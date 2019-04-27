-- phpMyAdmin SQL Dump
-- version 4.7.9
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 16, 2018 at 09:06 AM
-- Server version: 10.1.31-MariaDB
-- PHP Version: 7.2.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `new_ukt`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `id_admin` int(11) NOT NULL,
  `nama_admin` varchar(255) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id_admin`, `nama_admin`, `username`, `password`) VALUES
(1, 'Mia', 'admin', '21232f297a57a5a743894a0e4a801fc3');

-- --------------------------------------------------------

--
-- Table structure for table `cek_verifikasi`
--

CREATE TABLE `cek_verifikasi` (
  `id` int(11) NOT NULL,
  `id_mahasiswa` int(11) NOT NULL,
  `kode_kriteria` varchar(255) NOT NULL,
  `status` enum('Ya','Tidak') NOT NULL DEFAULT 'Tidak'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `cek_verifikasi`
--

INSERT INTO `cek_verifikasi` (`id`, `id_mahasiswa`, `kode_kriteria`, `status`) VALUES
(1, 14, 'K01', 'Ya');

-- --------------------------------------------------------

--
-- Table structure for table `kelompok_ukt`
--

CREATE TABLE `kelompok_ukt` (
  `id_mahasiswa` int(5) NOT NULL,
  `nama_mahasiswa` varchar(50) NOT NULL,
  `kelompok` int(2) NOT NULL,
  `nilai_total` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `kelompok_ukt`
--

INSERT INTO `kelompok_ukt` (`id_mahasiswa`, `nama_mahasiswa`, `kelompok`, `nilai_total`) VALUES
(14, '', 3, 'NAN');

-- --------------------------------------------------------

--
-- Table structure for table `kriteria`
--

CREATE TABLE `kriteria` (
  `id_kriteria` int(11) NOT NULL,
  `nama_kriteria` varchar(255) NOT NULL,
  `kode_kriteria` varchar(255) NOT NULL,
  `ranking_kriteria` int(11) NOT NULL,
  `kategori` enum('benefit','cost') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `kriteria`
--

INSERT INTO `kriteria` (`id_kriteria`, `nama_kriteria`, `kode_kriteria`, `ranking_kriteria`, `kategori`) VALUES
(3, 'Pekerjaan Ibu', 'K04', 4, 'cost'),
(4, 'Penghasilan Ayah', 'K01', 1, 'cost'),
(6, 'Penghasilan Ibu', 'K02', 2, 'cost'),
(7, 'Status Kepemilikan Rumah', 'K09', 9, 'cost'),
(10, 'Pajak Kendaraan Roda 2', 'K07', 7, 'cost'),
(11, 'Pajak Kendaraan Roda 4', 'K08', 8, 'cost'),
(12, 'Daya Listrik/Token', 'K06', 6, 'cost'),
(27, 'Pekerjaan Ayah', 'K03', 3, 'cost'),
(31, 'Jumlah Tanggungan Orangtua', 'K05', 5, 'benefit'),
(32, 'PBB', 'K10', 10, 'cost');

-- --------------------------------------------------------

--
-- Table structure for table `lampiran_mahasiswa`
--

CREATE TABLE `lampiran_mahasiswa` (
  `id` int(11) NOT NULL,
  `id_mahasiswa` int(5) NOT NULL,
  `nama_mahasiswa` varchar(100) NOT NULL,
  `kode_kriteria` varchar(3) NOT NULL,
  `interval_parameter` text NOT NULL,
  `nama_file` varchar(1000) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `lampiran_mahasiswa`
--

INSERT INTO `lampiran_mahasiswa` (`id`, `id_mahasiswa`, `nama_mahasiswa`, `kode_kriteria`, `interval_parameter`, `nama_file`) VALUES
(11, 14, 'Irfan Yudha', 'K01', '4', '2370409.jpg'),
(12, 14, 'Irfan Yudha', 'K02', '4', 'an.jpg'),
(13, 14, 'Irfan Yudha', 'K03', '5', ''),
(14, 14, 'Irfan Yudha', 'K04', '5', ''),
(15, 14, 'Irfan Yudha', 'K05', '5', ''),
(16, 14, 'Irfan Yudha', 'K06', '5', ''),
(17, 14, 'Irfan Yudha', 'K07', '5', ''),
(18, 14, 'Irfan Yudha', 'K08', '5', ''),
(19, 14, 'Irfan Yudha', 'K09', '5', ''),
(20, 14, 'Irfan Yudha', 'K10', '5', '');

-- --------------------------------------------------------

--
-- Table structure for table `mahasiswa`
--

CREATE TABLE `mahasiswa` (
  `id_mahasiswa` int(11) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `nama_mahasiswa` varchar(255) NOT NULL,
  `no_peserta` varchar(255) NOT NULL,
  `email` varchar(100) NOT NULL,
  `verifikasi` enum('Ya','Tidak') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `mahasiswa`
--

INSERT INTO `mahasiswa` (`id_mahasiswa`, `username`, `password`, `nama_mahasiswa`, `no_peserta`, `email`, `verifikasi`) VALUES
(14, 'yudha', '2b9633304de305ed5c03fe19b7a06afe', 'Irfan Yudha', 'K12111029', 'yudaisme91@gmail.com', 'Tidak');

-- --------------------------------------------------------

--
-- Table structure for table `notifikasi`
--

CREATE TABLE `notifikasi` (
  `id_mahasiswa` int(5) NOT NULL,
  `pesan` text NOT NULL,
  `status` enum('Belum','Sudah') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `parameter`
--

CREATE TABLE `parameter` (
  `id_parameter` int(11) NOT NULL,
  `kode_kriteria` varchar(10) NOT NULL,
  `interval_parameter` varchar(1000) NOT NULL,
  `skor` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `parameter`
--

INSERT INTO `parameter` (`id_parameter`, `kode_kriteria`, `interval_parameter`, `skor`) VALUES
(1, 'K03', 'Pejabat Tinggi Negara', 5),
(3, 'K03', 'Pensiunan PNS Gol III', 3),
(4, 'K03', 'Tamtama', 2),
(5, 'K03', 'Anak Yatim', 1),
(6, 'K03', 'Perawat', 4),
(7, 'K04', 'Pejabat Tinggi Negara', 5),
(8, 'K04', 'Perawat', 4),
(9, 'K04', 'PNS Gol II', 3),
(10, 'K04', 'Tamtama', 2),
(11, 'K04', 'Anak yatim', 1),
(12, 'K01', '>= Rp. 4.000.000,00', 5),
(13, 'K01', 'Rp. 2.000.001,00 s.d Rp. 3.999.999,00', 4),
(14, 'K01', 'Rp. 1.000.001,00 s.d Rp. 2.000.000,00', 3),
(15, 'K01', 'Rp. 500.001 s.d Rp. 1.000.000,00', 2),
(16, 'K01', '0 - Rp.500.000,00', 1),
(17, 'K02', '>= Rp. 4.000.000,00', 5),
(18, 'K02', 'Rp. 2.000.001 s.d Rp. 3.999.999,00', 4),
(19, 'K02', 'Rp. 1.000.001,00 s.d Rp. 2.000.000,00', 3),
(20, 'K02', 'Rp. 500.001,00 s.d Rp. 1.000.000', 2),
(21, 'K02', '0 - Rp. 500.000,00', 1),
(22, 'K09', 'Milik sendiri / Milik Orangtua / milik Wali', 4),
(23, 'K09', 'Rumah Dinas', 3),
(24, 'K09', 'Kontrak atau Sewa', 2),
(25, 'K09', 'Menumpang', 1),
(26, 'K10', 'Lebih dari Rp. 300.000,00', 5),
(27, 'K10', 'Rp. 100.001,00 s.d Rp. 300.000,00', 4),
(28, 'K10', 'Rp. 50.001,00 s.d Rp. 100.000,00', 3),
(29, 'K10', 'Rp. 1,00 s.d Rp. 50.000,00 ', 2),
(30, 'K10', 'Tidak Ada', 1),
(36, 'K07', '>= Rp. 600.000,00', 5),
(37, 'K07', 'Rp. 400.001,00 s.d Rp. 600.000,00', 4),
(38, 'K07', 'Rp. 200.001,00 s.d Rp. 400.000,00', 3),
(39, 'K07', 'Rp. 100.001,00 s.d Rp. 200.000,00', 2),
(40, 'K07', '<= Rp. 100.000 atau tidak memiliki kendaraan roda 2', 1),
(41, 'K08', 'Lebih dari Rp. 3.000.000,00', 5),
(42, 'K08', 'Rp. 2.000.001,00 s.d Rp. 3.000.000,00', 4),
(43, 'K08', 'Rp. 1.000.001,00 s.d Rp. 2.000.000,00', 3),
(44, 'K08', 'Rp. 250.001,00 s.d Rp. 1.000.000,00', 2),
(45, 'K08', 'Kurang dari sama dengan Rp. 250.000,00 atau tidak memiliki kendaraan roda 4', 1),
(46, 'K06', '2200 / >= Rp. 500.000,00', 5),
(47, 'K06', '1300 / Rp. 300.001,00 s.d Rp. 500.000,00', 4),
(48, 'K06', '900 / Rp. 150.001,00 s.d Rp. 300.000,00', 3),
(49, 'K06', '450 / Rp. 50.001,00 Rp. 150.000,00', 2),
(50, 'K06', 'Tidak Ada Listrik / <= Rp. 50.000,00', 1),
(51, 'K11', '<= 3 Orang', 5),
(53, 'K11', '6 - 8 Orang', 3),
(54, 'K11', '9 - 10 Orang', 2),
(61, 'K11', 'Lebih dari 10 Orang', 1),
(62, 'K11', '4-5 Orang', 4),
(63, 'K03', 'Rektor', 5),
(64, 'K03', 'Anggota Legislatif', 5),
(65, 'K03', 'Guru Besar', 5),
(66, 'K03', 'Dekan', 5),
(67, 'K03', ' Pensiunan PNS Gol I', 1),
(68, 'K03', 'PNS Gol III', 5),
(69, 'K03', 'Pengusaha Kecil', 5),
(70, 'K03', 'Perwira Tinggi', 5),
(71, 'K03', 'Kepala Daerah', 5),
(72, 'K03', 'Kepala Dinas', 5),
(73, 'K03', 'Pengacara', 5),
(74, 'K03', 'Komisaris', 5),
(75, 'K03', 'PNS Gol IV', 5),
(76, 'K03', 'Karyawan BANK', 5),
(77, 'K03', 'Karyawan BUMN/BUMD', 5),
(78, 'K03', 'Lurah/Kepala Desa', 5),
(79, 'K03', 'Bidan', 5),
(80, 'K03', 'Kapala Bagian', 5),
(82, 'K03', 'Masinis', 4),
(83, 'K03', 'Kepala Urusan', 4),
(84, 'K03', 'Kepala Seksi', 4),
(85, 'K03', 'Bintara', 4),
(86, 'K03', 'Pensiunan PNS Gol IV', 3),
(87, 'K03', 'Anak Buah Kapal', 3),
(88, 'K03', 'PNS Golongan II', 3),
(89, 'K03', 'PNS Gol I', 2),
(90, 'K03', 'Pensiunan PNS Gol II', 2),
(92, 'K03', 'Petani', 2),
(93, 'K03', 'Satpam', 2),
(94, 'K03', 'Supir Kendaraan Umum', 2),
(95, 'K03', 'Tukang', 2),
(96, 'K03', 'Nelayan', 2),
(97, 'K03', 'Ibu Rumah Tangga', 1),
(98, 'K03', 'Kuli Bangunan', 1),
(99, 'K03', 'Tukang Parkir', 1),
(100, 'K03', 'Buruh Tani', 1),
(101, 'K03', 'Tukang Becak', 1),
(102, 'K03', 'Pedagang Kaki Lima', 1),
(103, 'K03', 'Pembantu Rumah Tangga', 1),
(104, 'K03', 'Buruh/pelayan', 1),
(105, 'K03', 'Cleaning Sevice', 1),
(106, 'K03', 'Pemulung', 1),
(107, 'K04', 'Rektor', 5),
(108, 'K04', 'Anggota Legislatif', 5),
(109, 'K04', 'Guru Besar', 5),
(110, 'K04', 'Perwira Tinggi', 5),
(111, 'K04', 'Profesional', 5),
(112, 'K04', 'Pejabat Eselon I', 5),
(113, 'K04', 'Kepala Daerah', 5),
(114, 'K04', 'Penguasa Besar dan Menengah', 5),
(115, 'K04', 'Direksi Perusahaan', 5),
(116, 'K04', 'Manajer', 5),
(117, 'K04', 'Dokter Spesialis', 5),
(118, 'K04', 'Pengacara', 5),
(119, 'K04', 'Komisaris', 5),
(120, 'K04', 'Pejabat Eselon II', 5),
(121, 'K04', 'Dekan', 5),
(122, 'K04', 'Kepala Biro', 5),
(123, 'K04', 'Kepala Badan', 5),
(124, 'K04', 'Asisten Manajer', 5),
(125, 'K04', 'Kepala Dinas', 5),
(126, 'K04', 'Perwira Menengah', 5),
(127, 'K04', 'Pengusaha Kecil', 5),
(128, 'K04', 'Pilot', 5),
(129, 'K04', 'Nakhoda Kapal', 5),
(130, 'K04', 'Pejabat Eselon III', 5),
(131, 'K04', 'Supervisor', 5),
(132, 'K04', 'Kepala Bagian', 5),
(133, 'K04', 'PNS Gol IV', 5),
(134, 'K04', 'Camat', 5),
(135, 'K04', 'Perwira Pertama', 5),
(136, 'K04', 'Pengusaha Mikro', 5),
(137, 'K04', 'Karyawan BUMN/BUMD', 5),
(138, 'K04', 'Karyawan BANK', 5),
(139, 'K03', 'Karyawan Swasta', 5),
(140, 'K04', 'Karyawan Swasta', 5),
(141, 'K04', 'Masinis', 4),
(142, 'K04', 'Kepala Urusan', 4),
(143, 'K04', 'Kepala Seksi', 4),
(144, 'K04', 'Bintara', 4),
(145, 'K04', 'pensiunan PNS Gol III', 3),
(146, 'K04', 'Pensiunan PNS Gol IV', 3),
(147, 'K04', 'Anak Buah Kapal', 3),
(148, 'K04', 'PNS Gol I', 2),
(149, 'K04', 'Pensiunan PNS Gol II', 2),
(150, 'K04', 'Pengemudi/Supir', 2),
(151, 'K04', 'Petani', 2),
(152, 'K04', 'Satpam', 2),
(153, 'K04', 'Supir Kendaraan Umum', 2),
(154, 'K04', 'Tukang', 2),
(155, 'K04', 'Nelayan', 2),
(156, 'K04', 'Ibu Rumah Tangga', 1),
(157, 'K04', 'Kuli Bangunan', 1),
(158, 'K04', 'Tukang Parkir', 1),
(159, 'K04', 'Buruh Tani', 1),
(160, 'K04', 'Tukang Becak', 1),
(161, 'K04', 'pensiunan PNS Gol I', 1),
(162, 'K04', 'Pedagang Kaki Lima', 1),
(163, 'K04', 'Pembantu Rumah Tangga', 1),
(164, 'K04', 'Buruh/Pelayan', 1),
(165, 'K04', 'Cleaning Service', 1),
(166, 'K04', 'Pemulung', 1),
(167, 'K03', 'Profesional', 5),
(168, 'K03', 'Pejabat Eselon I', 5),
(169, 'K03', 'Pengusaha Besar dan Menengah', 5),
(170, 'K03', 'Direksi Perusahaan', 5),
(171, 'K03', 'Manajer', 5),
(172, 'K03', 'Dokter Spesialis', 5),
(173, 'K03', 'Pejabat Eselon II', 5),
(174, 'K03', 'Kepala Biro', 5),
(175, 'K03', 'Kepala Badan', 5),
(176, 'K03', 'Asisten Manajer', 5),
(177, 'K03', 'Perwira Menengah', 5),
(178, 'K03', 'Pilot', 5),
(179, 'K03', 'Nahkoda Kapal', 5),
(180, 'K03', 'Pejabat Eselon III', 5),
(181, 'K03', 'Supervisor', 5),
(182, 'K03', 'Camat', 5),
(183, 'K03', 'Perwira Pertama', 5),
(184, 'K03', 'Pengusaha Mikro', 5),
(185, 'K03', 'Pejabat Eselon IV', 5),
(186, 'K03', 'Bintara Tinggi', 5),
(187, 'K03', 'Kepala Subbagian', 5),
(188, 'K03', 'Anak Piatu', 1),
(189, 'K03', 'Tidak Bekerja', 1),
(190, 'K03', 'Pensiunan BUMN/BUMD', 3),
(191, 'K04', 'Pejabat Eselon IV', 5),
(192, 'K04', 'Bintara Tinggi', 5),
(193, 'K04', 'Kepala Subbagian', 5),
(194, 'K04', 'PNS Golongan III', 5),
(195, 'K04', 'Lurah/Kepala Desa', 5),
(196, 'K04', 'Bidan', 5),
(197, 'K04', 'Anak Piatu', 1),
(198, 'K04', 'Tidak Bekerja', 1),
(199, 'K04', 'Pensiunan BUMN/BUMD', 3),
(200, 'K05', '<=3 Orang', 5),
(201, 'K05', '4 - 5 Orang', 4),
(202, 'K05', '6-8 Orang', 3),
(203, 'K05', '9 - 10 Orang', 2),
(204, 'K05', '>10 Orang', 1),
(205, 'K03', 'Pengemudi', 2);

-- --------------------------------------------------------

--
-- Table structure for table `uji_ukt`
--

CREATE TABLE `uji_ukt` (
  `id` int(11) NOT NULL,
  `id_mahasiswa` int(11) NOT NULL,
  `kelompok` int(11) NOT NULL,
  `nama_mahasiswa` varchar(50) NOT NULL,
  `nilai_total` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `verifikator`
--

CREATE TABLE `verifikator` (
  `id_verifikator` int(3) NOT NULL,
  `nama` varchar(255) NOT NULL,
  `nip` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `verifikator`
--

INSERT INTO `verifikator` (`id_verifikator`, `nama`, `nip`) VALUES
(4, 'verifikator', '2b9633304de305ed5c03fe19b7a06afe');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id_admin`);

--
-- Indexes for table `cek_verifikasi`
--
ALTER TABLE `cek_verifikasi`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `kriteria`
--
ALTER TABLE `kriteria`
  ADD PRIMARY KEY (`id_kriteria`);

--
-- Indexes for table `lampiran_mahasiswa`
--
ALTER TABLE `lampiran_mahasiswa`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `mahasiswa`
--
ALTER TABLE `mahasiswa`
  ADD PRIMARY KEY (`id_mahasiswa`);

--
-- Indexes for table `parameter`
--
ALTER TABLE `parameter`
  ADD PRIMARY KEY (`id_parameter`);

--
-- Indexes for table `uji_ukt`
--
ALTER TABLE `uji_ukt`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `verifikator`
--
ALTER TABLE `verifikator`
  ADD PRIMARY KEY (`id_verifikator`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `id_admin` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `cek_verifikasi`
--
ALTER TABLE `cek_verifikasi`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `kriteria`
--
ALTER TABLE `kriteria`
  MODIFY `id_kriteria` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;

--
-- AUTO_INCREMENT for table `lampiran_mahasiswa`
--
ALTER TABLE `lampiran_mahasiswa`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `mahasiswa`
--
ALTER TABLE `mahasiswa`
  MODIFY `id_mahasiswa` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `parameter`
--
ALTER TABLE `parameter`
  MODIFY `id_parameter` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=206;

--
-- AUTO_INCREMENT for table `uji_ukt`
--
ALTER TABLE `uji_ukt`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `verifikator`
--
ALTER TABLE `verifikator`
  MODIFY `id_verifikator` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
