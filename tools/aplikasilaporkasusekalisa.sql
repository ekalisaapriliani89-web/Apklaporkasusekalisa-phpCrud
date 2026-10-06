-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Oct 05, 2026 at 03:16 AM
-- Server version: 8.0.30
-- PHP Version: 8.1.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `aplikasilaporkasusekalisa`
--

-- --------------------------------------------------------

--
-- Table structure for table `kasus`
--

CREATE TABLE `kasus` (
  `idkasus` int NOT NULL,
  `idkategori` int NOT NULL,
  `namakasus` varchar(20) NOT NULL,
  `tingkatbahaya` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `kasus`
--

INSERT INTO `kasus` (`idkasus`, `idkategori`, `namakasus`, `tingkatbahaya`) VALUES
(1, 2, 'merokok', '10%'),
(2, 1, 'cabut', '40%'),
(3, 3, 'perundungan', '80%');

-- --------------------------------------------------------

--
-- Table structure for table `kategori`
--

CREATE TABLE `kategori` (
  `idkategori` int NOT NULL,
  `namakategori` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `kategori`
--

INSERT INTO `kategori` (`idkategori`, `namakategori`) VALUES
(1, 'sedang'),
(2, 'ringan'),
(3, 'berat');

-- --------------------------------------------------------

--
-- Table structure for table `penanganan`
--

CREATE TABLE `penanganan` (
  `idpenanganan` int NOT NULL,
  `idpengajuan` int NOT NULL,
  `iduser` int NOT NULL,
  `idsanksi` int NOT NULL,
  `nohp` char(14) NOT NULL,
  `foto` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `penanganan`
--

INSERT INTO `penanganan` (`idpenanganan`, `idpengajuan`, `iduser`, `idsanksi`, `nohp`, `foto`) VALUES
(1, 1, 1, 1, '082234567891', 'noo.png'),
(2, 2, 2, 2, '082243776543', 'nowq.png'),
(3, 3, 3, 3, '082243772002', 'nowe.png');

-- --------------------------------------------------------

--
-- Table structure for table `pengajuan`
--

CREATE TABLE `pengajuan` (
  `idpengajuan` int NOT NULL,
  `idkasus` int NOT NULL,
  `iduser` int NOT NULL,
  `idsiswa` int NOT NULL,
  `kronologi` text,
  `tempatkejadian` varchar(100) NOT NULL,
  `tanggalkejadian` date NOT NULL,
  `foto` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `pengajuan`
--

INSERT INTO `pengajuan` (`idpengajuan`, `idkasus`, `iduser`, `idsiswa`, `kronologi`, `tempatkejadian`, `tanggalkejadian`, `foto`) VALUES
(1, 2, 1, 3, 'saya melihat kawan saya merokok di kamar mandi', 'kamar mandi', '2026-09-29', 'nop.png'),
(2, 1, 2, 2, 'saya melihat dia manjat pagar', 'samping kelas rpl2', '2026-03-22', 'noe.png'),
(3, 3, 3, 1, '-', 'samping tangga kelas dkv2', '2026-10-19', 'nol.png');

-- --------------------------------------------------------

--
-- Table structure for table `percobaan`
--

CREATE TABLE `percobaan` (
  `idpercobaan` int NOT NULL,
  `namakategori` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `sanksi`
--

CREATE TABLE `sanksi` (
  `idsanksi` int NOT NULL,
  `namasanksi` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `sanksi`
--

INSERT INTO `sanksi` (`idsanksi`, `namasanksi`) VALUES
(1, 'poin80 & dikeluarkan dari sekolah'),
(2, 'poin40 & mendapatkan skor'),
(3, 'poin10 & mendapatkan hukuman tertentu');

-- --------------------------------------------------------

--
-- Table structure for table `siswa`
--

CREATE TABLE `siswa` (
  `idsiswa` int NOT NULL,
  `namasiswa` varchar(30) NOT NULL,
  `kelas` varchar(50) NOT NULL,
  `jeniskelamin` varchar(30) NOT NULL,
  `nohp` varchar(14) NOT NULL,
  `foto` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `siswa`
--

INSERT INTO `siswa` (`idsiswa`, `namasiswa`, `kelas`, `jeniskelamin`, `nohp`, `foto`) VALUES
(1, 'ekalisa', 'XI', 'perempuan', '082243556789', 'lisa.png'),
(2, 'eka lisa', 'XI2', 'perempuan', '082253556789', 'nop.png'),
(3, 'mariescha', 'XI1', 'perempuan', '082233556789', 'memer.png');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `iduser` int NOT NULL,
  `namauser` varchar(30) NOT NULL,
  `unsername` varchar(50) DEFAULT NULL,
  `password` varchar(30) DEFAULT NULL,
  `nohp` char(14) DEFAULT NULL,
  `fot` varchar(30) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`iduser`, `namauser`, `unsername`, `password`, `nohp`, `fot`) VALUES
(1, 'ekalisa', 'lisa', '123', '082243225421', 'lisa.png'),
(2, 'zulaika', 'zuzul', '234', '082243772234', 'zul.png'),
(3, 'nopi', 'nonop', '345', '082234778911', 'nop.png'),
(4, ' arya dwi erlangga', ' arya', ' 12012017', ' 081234567890', ' arya.png');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `kasus`
--
ALTER TABLE `kasus`
  ADD PRIMARY KEY (`idkasus`),
  ADD KEY `id_transaksi` (`idkategori`);

--
-- Indexes for table `kategori`
--
ALTER TABLE `kategori`
  ADD PRIMARY KEY (`idkategori`);

--
-- Indexes for table `penanganan`
--
ALTER TABLE `penanganan`
  ADD PRIMARY KEY (`idpenanganan`),
  ADD KEY `idpengajuan` (`idpengajuan`),
  ADD KEY `idsanksi` (`idsanksi`);

--
-- Indexes for table `pengajuan`
--
ALTER TABLE `pengajuan`
  ADD PRIMARY KEY (`idpengajuan`),
  ADD KEY `idkasus` (`idkasus`),
  ADD KEY `iduser` (`iduser`),
  ADD KEY `idsiswa` (`idsiswa`);

--
-- Indexes for table `percobaan`
--
ALTER TABLE `percobaan`
  ADD PRIMARY KEY (`idpercobaan`);

--
-- Indexes for table `sanksi`
--
ALTER TABLE `sanksi`
  ADD PRIMARY KEY (`idsanksi`);

--
-- Indexes for table `siswa`
--
ALTER TABLE `siswa`
  ADD PRIMARY KEY (`idsiswa`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`iduser`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `kasus`
--
ALTER TABLE `kasus`
  MODIFY `idkasus` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `kategori`
--
ALTER TABLE `kategori`
  MODIFY `idkategori` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `penanganan`
--
ALTER TABLE `penanganan`
  MODIFY `idpenanganan` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `pengajuan`
--
ALTER TABLE `pengajuan`
  MODIFY `idpengajuan` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `percobaan`
--
ALTER TABLE `percobaan`
  MODIFY `idpercobaan` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `sanksi`
--
ALTER TABLE `sanksi`
  MODIFY `idsanksi` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `siswa`
--
ALTER TABLE `siswa`
  MODIFY `idsiswa` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `iduser` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `kasus`
--
ALTER TABLE `kasus`
  ADD CONSTRAINT `id_transaksi` FOREIGN KEY (`idkategori`) REFERENCES `kategori` (`idkategori`);

--
-- Constraints for table `penanganan`
--
ALTER TABLE `penanganan`
  ADD CONSTRAINT `idpengajuan` FOREIGN KEY (`idpengajuan`) REFERENCES `pengajuan` (`idpengajuan`),
  ADD CONSTRAINT `idsanksi` FOREIGN KEY (`idsanksi`) REFERENCES `sanksi` (`idsanksi`);

--
-- Constraints for table `pengajuan`
--
ALTER TABLE `pengajuan`
  ADD CONSTRAINT `idkasus` FOREIGN KEY (`idkasus`) REFERENCES `kasus` (`idkasus`),
  ADD CONSTRAINT `idsiswa` FOREIGN KEY (`idsiswa`) REFERENCES `siswa` (`idsiswa`),
  ADD CONSTRAINT `iduser` FOREIGN KEY (`iduser`) REFERENCES `user` (`iduser`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
