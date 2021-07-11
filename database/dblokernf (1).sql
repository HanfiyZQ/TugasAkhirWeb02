-- phpMyAdmin SQL Dump
-- version 5.1.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 11, 2021 at 04:05 PM
-- Server version: 10.4.18-MariaDB
-- PHP Version: 7.4.16

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `dblokernf`
--

-- --------------------------------------------------------

--
-- Table structure for table `bidang_usaha`
--

CREATE TABLE `bidang_usaha` (
  `id` int(11) NOT NULL,
  `nama` varchar(45) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `bidang_usaha`
--

INSERT INTO `bidang_usaha` (`id`, `nama`) VALUES
(1, 'Teknologi Informasi dan Komunikasi'),
(2, 'Perbankan'),
(3, 'Pendidikan'),
(4, 'Transporasi'),
(5, 'Industri Nasional');

-- --------------------------------------------------------

--
-- Table structure for table `keahlian`
--

CREATE TABLE `keahlian` (
  `id` int(11) NOT NULL,
  `nama` varchar(45) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `keahlian`
--

INSERT INTO `keahlian` (`id`, `nama`) VALUES
(1, 'Programmer'),
(2, 'Infrastruktur & Jaringan'),
(3, 'Accounting'),
(4, 'Bahasa Inggris'),
(5, 'Database'),
(6, 'Web Design');

-- --------------------------------------------------------

--
-- Table structure for table `lowongan`
--

CREATE TABLE `lowongan` (
  `id` int(11) NOT NULL,
  `deskripsi_pekerjaan` text DEFAULT NULL,
  `tanggal_akhir` date DEFAULT NULL,
  `mitra_id` int(11) NOT NULL,
  `email` varchar(45) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `lowongan`
--

INSERT INTO `lowongan` (`id`, `deskripsi_pekerjaan`, `tanggal_akhir`, `mitra_id`, `email`) VALUES
(1, 'Dibutuhkan tenaga programmer/analyst', '2021-07-01', 2, 'hrd@bukalapak.go.id');

-- --------------------------------------------------------

--
-- Table structure for table `lowongan_keahlian`
--

CREATE TABLE `lowongan_keahlian` (
  `id` int(11) NOT NULL,
  `keahlian_id` int(11) NOT NULL,
  `lowongan_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `lowongan_keahlian`
--

INSERT INTO `lowongan_keahlian` (`id`, `keahlian_id`, `lowongan_id`) VALUES
(1, 1, 1),
(2, 5, 1);

-- --------------------------------------------------------

--
-- Table structure for table `mitra`
--

CREATE TABLE `mitra` (
  `id` int(11) NOT NULL,
  `nama` varchar(100) DEFAULT NULL,
  `alamat` varchar(45) DEFAULT NULL,
  `kontak` varchar(30) DEFAULT NULL,
  `telpon` varchar(20) DEFAULT NULL,
  `email` varchar(30) DEFAULT NULL,
  `web` varchar(45) DEFAULT NULL,
  `bidang_usaha_id` int(11) NOT NULL,
  `sektor_usaha_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `mitra`
--

INSERT INTO `mitra` (`id`, `nama`, `alamat`, `kontak`, `telpon`, `email`, `web`, `bidang_usaha_id`, `sektor_usaha_id`) VALUES
(1, 'PT Rekayasa Industri', 'Jl Makam Pahlawan xbata No 182', 'Aries Prywash', '0812-8882329', 'hrd@rekin.go.id', 'www.rekin.go.id', 1, 1),
(2, 'PT Bukalapak', 'Jl Kemang No. 12', 'Zaki F', '0859-42029', 'hrd@bukalapak.com', 'bukalapak.com', 1, 4);

-- --------------------------------------------------------

--
-- Table structure for table `peminat_lowongan`
--

CREATE TABLE `peminat_lowongan` (
  `id` int(11) NOT NULL,
  `nim` varchar(10) DEFAULT NULL,
  `nama` varchar(45) DEFAULT NULL,
  `alasan` text DEFAULT NULL,
  `prodi_id` int(11) NOT NULL,
  `lowongan_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `peminat_lowongan`
--

INSERT INTO `peminat_lowongan` (`id`, `nim`, `nama`, `alasan`, `prodi_id`, `lowongan_id`) VALUES
(1, '0110220253', 'Hanfiy Zamaksyary Qurthuby', 'ingin cepat mendapat pekerjaan', 3, 1);

-- --------------------------------------------------------

--
-- Table structure for table `prodi`
--

CREATE TABLE `prodi` (
  `id` int(11) NOT NULL,
  `kode` varchar(2) DEFAULT NULL,
  `nama` varchar(45) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `prodi`
--

INSERT INTO `prodi` (`id`, `kode`, `nama`) VALUES
(1, 'SI', 'Sistem Informasi'),
(2, 'TI', 'Teknik Informatika'),
(3, 'BD', 'Bisnis Digital');

-- --------------------------------------------------------

--
-- Table structure for table `sektor_usaha`
--

CREATE TABLE `sektor_usaha` (
  `id` int(11) NOT NULL,
  `nama` varchar(45) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `sektor_usaha`
--

INSERT INTO `sektor_usaha` (`id`, `nama`) VALUES
(1, 'Pemerintahan'),
(2, 'BUMN'),
(3, 'Swasta'),
(4, 'Startup');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `name` varchar(128) NOT NULL,
  `email` varchar(128) NOT NULL,
  `image` varchar(128) NOT NULL,
  `password` varchar(256) NOT NULL,
  `role_id` int(11) NOT NULL,
  `is_active` int(1) NOT NULL,
  `date_created` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `name`, `email`, `image`, `password`, `role_id`, `is_active`, `date_created`) VALUES
(14, 'Hanfiy', 'zamaksyaryhanfiy@gmail.com', 'otter_1f9a6.png', '$2y$10$qy/jLVDwyKOErUod.s99keVbq9a0iFaJVk5K/mJr79taeDph2Pt8y', 1, 1, 1625858503),
(15, 'Mong Oose', 'oosemong27@gmail.com', 'default.jpg', '$2y$10$0DdvSsOm1hlD13MAWq..rOWENAt9AaUDwx6LD4292s0JB9nnrvHle', 2, 1, 1625863551),
(17, 'admin', 'admin@gmail.com', 'default.jpg', '$2y$10$mHjjOV6Ye0ne2YTeYsFT3e6DJi6hwB7ReI51mHdGFEoMa0yUU3BFy', 1, 1, 1626012086);

-- --------------------------------------------------------

--
-- Table structure for table `user_access_menu`
--

CREATE TABLE `user_access_menu` (
  `id` int(11) NOT NULL,
  `role_id` int(11) NOT NULL,
  `menu_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `user_access_menu`
--

INSERT INTO `user_access_menu` (`id`, `role_id`, `menu_id`) VALUES
(1, 1, 1),
(2, 1, 2),
(3, 2, 2),
(6, 1, 3);

-- --------------------------------------------------------

--
-- Table structure for table `user_menu`
--

CREATE TABLE `user_menu` (
  `id` int(11) NOT NULL,
  `menu` varchar(128) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `user_menu`
--

INSERT INTO `user_menu` (`id`, `menu`) VALUES
(1, 'Admin'),
(2, 'User'),
(3, 'Menu');

-- --------------------------------------------------------

--
-- Table structure for table `user_role`
--

CREATE TABLE `user_role` (
  `id` int(11) NOT NULL,
  `role` varchar(128) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `user_role`
--

INSERT INTO `user_role` (`id`, `role`) VALUES
(1, 'administrator'),
(2, 'member');

-- --------------------------------------------------------

--
-- Table structure for table `user_sub_menu`
--

CREATE TABLE `user_sub_menu` (
  `id` int(11) NOT NULL,
  `menu_id` int(11) NOT NULL,
  `title` varchar(128) NOT NULL,
  `url` varchar(128) NOT NULL,
  `icon` varchar(128) NOT NULL,
  `is_active` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `user_sub_menu`
--

INSERT INTO `user_sub_menu` (`id`, `menu_id`, `title`, `url`, `icon`, `is_active`) VALUES
(1, 1, 'Dashboard', 'admin', 'fas fa-fw fa-tachometer-alt', 1),
(4, 3, 'Menu Management', 'menu', 'fas fa-fw fa-folder', 1),
(5, 3, 'SubMenu Management', 'menu/submenu', 'fas fa-fw fa-folder-open', 1),
(8, 1, 'role', 'admin/role', 'fas fa-fw fa-user-tie', 1),
(14, 1, 'Mitra Kerja', 'admin/mitrakerja', 'fas fa-fw fa-globe', 1),
(15, 1, 'Lowongan', 'admin/lowongan', 'fas fa-fw fa-briefcase', 1),
(17, 1, 'Lowongan Keahlian', 'admin/lowongankeahlian', 'fas fa-fw fa-user-graduate', 1),
(21, 2, 'My Profile', 'user/', 'fas fa-fw fa-user', 1),
(22, 2, 'Edit Profile', 'user/edit', 'fas fa-fw fa-user-edit', 1),
(23, 2, 'Peminat Lowongan', 'user/peminatlowongan', 'fas fa-fw fa-briefcase', 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `bidang_usaha`
--
ALTER TABLE `bidang_usaha`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `keahlian`
--
ALTER TABLE `keahlian`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `lowongan`
--
ALTER TABLE `lowongan`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_lowongan_mitra1_idx` (`mitra_id`);

--
-- Indexes for table `lowongan_keahlian`
--
ALTER TABLE `lowongan_keahlian`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_lowongan_keahlian_keahlian1_idx` (`keahlian_id`),
  ADD KEY `fk_lowongan_keahlian_lowongan1_idx` (`lowongan_id`);

--
-- Indexes for table `mitra`
--
ALTER TABLE `mitra`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_mitra_bidang_usaha_idx` (`bidang_usaha_id`),
  ADD KEY `fk_mitra_sektor_usaha1_idx` (`sektor_usaha_id`);

--
-- Indexes for table `peminat_lowongan`
--
ALTER TABLE `peminat_lowongan`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_peminat_lowongan_prodi1_idx` (`prodi_id`),
  ADD KEY `fk_peminat_lowongan_lowongan1_idx` (`lowongan_id`);

--
-- Indexes for table `prodi`
--
ALTER TABLE `prodi`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sektor_usaha`
--
ALTER TABLE `sektor_usaha`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user_access_menu`
--
ALTER TABLE `user_access_menu`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user_menu`
--
ALTER TABLE `user_menu`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user_role`
--
ALTER TABLE `user_role`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user_sub_menu`
--
ALTER TABLE `user_sub_menu`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `bidang_usaha`
--
ALTER TABLE `bidang_usaha`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `keahlian`
--
ALTER TABLE `keahlian`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `lowongan`
--
ALTER TABLE `lowongan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `lowongan_keahlian`
--
ALTER TABLE `lowongan_keahlian`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `mitra`
--
ALTER TABLE `mitra`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT for table `peminat_lowongan`
--
ALTER TABLE `peminat_lowongan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `prodi`
--
ALTER TABLE `prodi`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `sektor_usaha`
--
ALTER TABLE `sektor_usaha`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `user_access_menu`
--
ALTER TABLE `user_access_menu`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `user_menu`
--
ALTER TABLE `user_menu`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `user_role`
--
ALTER TABLE `user_role`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `user_sub_menu`
--
ALTER TABLE `user_sub_menu`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `lowongan`
--
ALTER TABLE `lowongan`
  ADD CONSTRAINT `fk_lowongan_mitra1` FOREIGN KEY (`mitra_id`) REFERENCES `mitra` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION;

--
-- Constraints for table `lowongan_keahlian`
--
ALTER TABLE `lowongan_keahlian`
  ADD CONSTRAINT `fk_lowongan_keahlian_keahlian1` FOREIGN KEY (`keahlian_id`) REFERENCES `keahlian` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_lowongan_keahlian_lowongan1` FOREIGN KEY (`lowongan_id`) REFERENCES `lowongan` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `mitra`
--
ALTER TABLE `mitra`
  ADD CONSTRAINT `fk_mitra_bidang_usaha` FOREIGN KEY (`bidang_usaha_id`) REFERENCES `bidang_usaha` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_mitra_sektor_usaha1` FOREIGN KEY (`sektor_usaha_id`) REFERENCES `sektor_usaha` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `peminat_lowongan`
--
ALTER TABLE `peminat_lowongan`
  ADD CONSTRAINT `fk_peminat_lowongan_lowongan1` FOREIGN KEY (`lowongan_id`) REFERENCES `lowongan` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_peminat_lowongan_prodi1` FOREIGN KEY (`prodi_id`) REFERENCES `prodi` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
