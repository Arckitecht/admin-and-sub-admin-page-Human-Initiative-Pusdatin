-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 08, 2023 at 03:37 PM
-- Server version: 10.4.24-MariaDB
-- PHP Version: 8.1.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `pusdatin`
--

-- --------------------------------------------------------

--
-- Table structure for table `akses`
--

CREATE TABLE `akses` (
  `AksesID` int(255) NOT NULL,
  `Akses` varchar(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `akses`
--

INSERT INTO `akses` (`AksesID`, `Akses`) VALUES
(1, 'Admin'),
(2, 'Sub-Admin'),
(3, 'Member');

-- --------------------------------------------------------

--
-- Table structure for table `book`
--

CREATE TABLE `book` (
  `ID` int(255) NOT NULL,
  `BookID` varchar(255) NOT NULL,
  `BookID_Num` int(255) NOT NULL,
  `Gambar` varchar(255) NOT NULL,
  `PDF` varchar(255) NOT NULL,
  `JenisDok` varchar(60) NOT NULL,
  `JenisAkses` varchar(60) NOT NULL,
  `KategoriDok` varchar(255) NOT NULL,
  `Unit1` varchar(45) NOT NULL,
  `Unit2` varchar(45) DEFAULT NULL,
  `Unit3` varchar(45) DEFAULT NULL,
  `Unit4` varchar(45) DEFAULT NULL,
  `Judul` varchar(255) NOT NULL,
  `TahunTerbit` int(10) NOT NULL,
  `Pengarang` varchar(60) NOT NULL,
  `Penerbit` varchar(60) NOT NULL,
  `JmlDownload` int(255) NOT NULL,
  `Tglinput` date NOT NULL,
  `Tgledit` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `book`
--

INSERT INTO `book` (`ID`, `BookID`, `BookID_Num`, `Gambar`, `PDF`, `JenisDok`, `JenisAkses`, `KategoriDok`, `Unit1`, `Unit2`, `Unit3`, `Unit4`, `Judul`, `TahunTerbit`, `Pengarang`, `Penerbit`, `JmlDownload`, `Tglinput`, `Tgledit`) VALUES
(1, 'B-1', 1, 'power.png', 'The 48 Laws of Power.pdf', 'E-Book', 'Free Access', '- Sejarah<br />\r\n- Keuangan<br />\r\n- Seni<br />\r\n', 'People Experience', 'Disaster Risk Management', NULL, NULL, 'The 48 Laws of Power', 2000, 'BOT', 'BOT', 0, '2023-02-05', '2023-03-06'),
(2, 'B-2', 2, 'power.png', 'The 48 Laws of Power.pdf', 'E-Reference', 'Premium Access', '- Sejarah<br />\r\n', 'Internal Audit', 'Disaster Risk Management', '', '', 'The 48 Laws of Power', 2000, 'BOT', 'BOT', 0, '2023-03-02', '2023-03-06'),
(8, 'B-3', 3, 'power.png', 'The 48 Laws of Power.pdf', 'E-Book', 'Premium Access', '- Sains<br />\r\n', 'Customer Relationship Management', 'General Services', 'General Affair', '', 'The 48 Laws of Power', 2000, 'BOT', 'BOT', 0, '2023-03-02', '2023-03-07'),
(9, 'B-4', 4, 'power.png', 'The 48 Laws of Power.pdf', 'E-Book', 'Priced', '- Keuangan<br />\r\n- Seni<br />\r\n', 'Empowerment', 'Child Protection', NULL, NULL, 'The 48 Laws of Power', 2000, 'BOT', 'BOT', 0, '2023-03-02', '2023-03-07'),
(11, 'B-5', 5, 'power.png', 'The 48 Laws of Power.pdf', 'Human Initiative Product', 'Free Access', '- Politik<br />\r\n- Bisnis<br />\r\n', 'Empowerment', 'People Experience', 'Internal Audit', '', 'The 48 Laws of Power', 2000, 'BOT', 'BOT', 0, '2023-03-03', '2023-03-06'),
(12, 'B-6', 6, 'power.png', 'The 48 Laws of Power.pdf', 'E-Reference', 'Free Access', '- Keuangan<br />\r\n- Seni<br />\r\n', 'Empowerment', NULL, NULL, '', 'The 48 Laws of Power', 2000, 'BOT', 'BOT', 0, '2023-03-03', '2023-03-06'),
(13, 'B-7', 7, 'power.png', 'The 48 Laws of Power.pdf', 'E-Book', 'Free Access', '- Filosofi<br />\r\n- Sosial<br />\r\n- Sains<br />\r\n', 'Empowerment', 'Grant', NULL, NULL, 'The 48 Laws of Power', 2000, 'BOT', 'BOT', 0, '2023-03-03', '2023-03-06'),
(14, 'B-8', 8, 'power.png', 'The 48 Laws of Power.pdf', 'E-Book', 'Free Access', '- Politik<br />\r\n', 'Empowerment', 'Grant', 'Internal Audit', NULL, 'The 48 Laws of Power', 2000, 'BOT', 'BOT', 0, '2023-03-03', '2023-03-06'),
(16, 'B-9', 9, 'piece.jpg', 'Piece of Mind.pdf', 'E-Book', 'Priced', '- Politik<br />\r\n- Bisnis<br />\r\n', 'Lean Financing', 'Internal Audit', '', '', 'Piece of Mind', 1996, 'Sandy MacGregor', 'BOT', 0, '2023-03-03', '2023-03-06'),
(22, 'B-10', 10, 'rdpd.jpg', 'Rich Dad Poor Dad.pdf', 'E-Book', 'Premium Access', '- Bisnis<br />\r\n- Keuangan<br />\r\n', 'Empowerment', '', '', '', 'Rich Dad Poor Dad', 1997, 'Robert Kiyosaki', 'BOT', 0, '2023-03-06', NULL),
(23, 'B-11', 11, 'rdpd.jpg', 'Rich Dad Poor Dad.pdf', 'E-Book', 'Free Access', '- Sejarah<br />\r\n- Bisnis<br />\r\n- Keuangan<br />\r\n', 'Child Protection', 'Customer Relationship Management', '', '', 'Rich Dad Poor Dad', 1997, 'Robert Kiyosaki', 'BOT', 0, '2023-03-06', NULL),
(24, 'B-12', 12, 'piece.jpg', 'Piece of Mind.pdf', 'E-Book', 'Priced', '- Filosofi<br />\r\n- Sosial<br />\r\n- Keuangan<br />\r\n- Seni<br />\r\n', 'Retail Partnership', 'General Affair', '', '', 'Piece of Mind', 1996, 'Sandy MacGregor', 'BOT', 0, '2023-03-06', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `jenis_akses`
--

CREATE TABLE `jenis_akses` (
  `ID` int(60) NOT NULL,
  `JenisAkses` varchar(60) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `jenis_akses`
--

INSERT INTO `jenis_akses` (`ID`, `JenisAkses`) VALUES
(1, 'Free Access'),
(2, 'Premium Access'),
(6, 'Priced');

-- --------------------------------------------------------

--
-- Table structure for table `jenis_dok`
--

CREATE TABLE `jenis_dok` (
  `ID` int(60) NOT NULL,
  `JenisDok` varchar(60) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `jenis_dok`
--

INSERT INTO `jenis_dok` (`ID`, `JenisDok`) VALUES
(7, 'E-Book'),
(8, 'E-Reference'),
(16, 'Human Initiative Product');

-- --------------------------------------------------------

--
-- Table structure for table `kategori_dok`
--

CREATE TABLE `kategori_dok` (
  `ID` int(255) NOT NULL,
  `KategoriDok` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `kategori_dok`
--

INSERT INTO `kategori_dok` (`ID`, `KategoriDok`) VALUES
(21, 'Politik'),
(22, 'Sejarah'),
(23, 'Teknologi'),
(24, 'Filosofi'),
(25, 'Sosial'),
(26, 'Hukum'),
(27, 'Bisnis'),
(28, 'Keuangan'),
(33, 'Sains'),
(34, 'Budaya'),
(35, 'Tari'),
(36, 'Seni'),
(43, 'Novel'),
(44, 'Musik'),
(45, 'Manga'),
(46, 'Komik'),
(47, 'Kartun'),
(48, 'Komedi'),
(49, 'Anthropologi'),
(50, 'Psikologi'),
(51, 'Olahraga'),
(52, 'Misteri'),
(53, 'Fiksi'),
(54, 'Quotes');

-- --------------------------------------------------------

--
-- Table structure for table `member`
--

CREATE TABLE `member` (
  `MemberID` int(255) NOT NULL,
  `NamaMember` varchar(60) NOT NULL,
  `Telp` varchar(20) NOT NULL,
  `Username` varchar(255) NOT NULL,
  `EmailMember` varchar(255) NOT NULL,
  `PasswordMember` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `member`
--

INSERT INTO `member` (`MemberID`, `NamaMember`, `Telp`, `Username`, `EmailMember`, `PasswordMember`) VALUES
(1, 'Doni Salmonin', '087822562458', 'donodono', 'donidonsalmon@gmail.com', 'donidono'),
(3, 'Squidward', '087822562211', 'squidsquid', 'squidward@gmail.com', 'squidsquid'),
(4, 'Squidwardasd', '087828475672', 'squidsquidasd', 'squidwardasd@gmail.com', 'squidsquidd'),
(5, 'Plankton Plank', '087891230956', 'planktonmerry', 'planktonn@gmail.com', 'planktonplankton');

-- --------------------------------------------------------

--
-- Table structure for table `unit`
--

CREATE TABLE `unit` (
  `UnitID` int(255) NOT NULL,
  `Unit` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `unit`
--

INSERT INTO `unit` (`UnitID`, `Unit`) VALUES
(1, 'Internal Audit'),
(2, 'Risk Management & Legal Services'),
(3, 'General Services'),
(4, 'General Affair'),
(5, 'Lean Financing'),
(6, 'People Experience'),
(7, 'Volunteer Management'),
(8, 'Human Initative Institute'),
(9, 'Retail Partnership'),
(10, 'Program Management'),
(11, 'Institutional Partnership'),
(12, 'Customer Relationship Management'),
(13, 'Donor Engagement'),
(14, 'Disaster Risk Management'),
(15, 'Empowerment'),
(16, 'Child Protection'),
(17, 'Konstruksi'),
(18, 'Grant'),
(19, 'Qurban'),
(20, 'Ramadhan'),
(21, 'Donasi Tidak Terikat'),
(22, 'Specialist'),
(23, 'Communication'),
(24, 'Brand Communication'),
(25, 'Brand Activation'),
(26, 'Public Relation'),
(27, 'Creative & Production'),
(28, 'Network & Strategic Alliance'),
(29, 'Network Development'),
(30, 'Humanitarian Diplomacy & Advocacy'),
(31, 'Legal & Overseas Relation Strategic'),
(32, 'Akselerasi Sistem HI Worlwide dan Jangkauan Program Global'),
(33, 'Organizational Development'),
(34, 'Quality Management System & Policy Compliance'),
(35, 'Research & Development'),
(36, 'HIPSTER'),
(37, 'Social Enterprise'),
(38, 'Knowledge Management System'),
(39, 'IT Development'),
(40, 'IT Support'),
(41, 'Terbangunnya Sistem Customer 360 View berbasis Big Data'),
(42, 'Kantor Cabang Bengkulu'),
(43, 'Kantor Cabang Daerah Istimewa Yogyakarta'),
(44, 'Kantor Cabang Jawa Barat'),
(45, 'Kantor Cabang Daerah Jawa Tengah'),
(46, 'Kantor Cabang Jawa Timur'),
(47, 'Kantor Cabang Kalimantan Timur'),
(48, 'Kantor Cabang Maluku'),
(49, 'Kantor Cabang Nanggroe Aceh Darussalam, Penghimpunan Dana, dan Pengelolaan Program Children Protection'),
(50, 'Kantor Cabang Riau'),
(51, 'Kantor Cabang Sulawesi Selatan'),
(52, 'Kantor Cabang Sumatera Barat'),
(53, 'Kantor Cabang Sumatera Barat - Bukittinggi'),
(54, 'Kantor Cabang Sumatera Utara'),
(55, 'People Culture');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `ID` int(255) NOT NULL,
  `Nama` varchar(60) NOT NULL,
  `Akses` varchar(45) NOT NULL,
  `Unit1` varchar(45) NOT NULL,
  `Unit2` varchar(45) DEFAULT NULL,
  `Unit3` varchar(45) DEFAULT NULL,
  `Unit4` varchar(45) DEFAULT NULL,
  `Telp` varchar(20) NOT NULL,
  `TmptLahir` varchar(100) NOT NULL,
  `TglLahir` date NOT NULL,
  `Bio` varchar(255) DEFAULT NULL,
  `username` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `passwordu` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`ID`, `Nama`, `Akses`, `Unit1`, `Unit2`, `Unit3`, `Unit4`, `Telp`, `TmptLahir`, `TglLahir`, `Bio`, `username`, `email`, `passwordu`) VALUES
(1, 'Sunu Prasetya', 'Admin', 'Knowledge Management System', 'People Culture', NULL, NULL, '085781645632', 'Jakarta Pusat', '2000-10-23', 'Haihaihoiheihai', 'sunuprasetya', 'sunu.prasetya@human-initiative.org', 'humaninitiative'),
(8, 'Alfrethanov Christian Wijaya', 'Admin', 'Knowledge Management System', 'IT Development', 'Empowerment', 'Internal Audit', '087912394569', 'Kota Bekasi', '2001-11-23', 'There has been a constant war, a war with fear. Those who have the courage to conquer it are made free and those who are conquered by it are made to suffer until the death takes them.', 'alfrethanovcwjy', 'alfrethanovwijaya@gmail.com', 'hellohuman'),
(9, 'Nawfal Fudhayl Warsito', 'Admin', 'Internal Audit', 'Konstruksi', '', '', '0879812339042', 'Kota Lampung', '2001-05-12', NULL, 'nawfalfudhayl', 'nawfalfudhayl@gmail.com', 'nawfalhi'),
(16, 'Adhe Setya Aryotejo', 'Sub-Admin', 'Retail Partnership', 'General Affair', '', '', '087981233921', 'Jakarta Timur', '1985-05-12', '', 'adhe_tejo', 'adhearyotejo@gmail.com', 'adheadhe'),
(21, 'Spongebob Squarepants', 'Sub-Admin', 'Child Protection', 'Donor Engagement', 'Public Relation', '', '087981232630', 'Jakarta Timur', '1985-05-12', NULL, 'spongbob', 'spongbob123@gmail.com', 'spongboba'),
(22, 'Patrick', 'Sub-Admin', 'Child Protection', '', '', '', '087981232957', 'Kota Bekasi', '2001-11-23', NULL, 'patrickstar', 'patrickstar@gmail.com', 'patrikpatrik');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `akses`
--
ALTER TABLE `akses`
  ADD PRIMARY KEY (`AksesID`),
  ADD UNIQUE KEY `AksesID` (`AksesID`);

--
-- Indexes for table `book`
--
ALTER TABLE `book`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `jenis_akses`
--
ALTER TABLE `jenis_akses`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `jenis_dok`
--
ALTER TABLE `jenis_dok`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `kategori_dok`
--
ALTER TABLE `kategori_dok`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `member`
--
ALTER TABLE `member`
  ADD PRIMARY KEY (`MemberID`);

--
-- Indexes for table `unit`
--
ALTER TABLE `unit`
  ADD PRIMARY KEY (`UnitID`),
  ADD UNIQUE KEY `UnitID` (`UnitID`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`ID`),
  ADD UNIQUE KEY `ID` (`ID`),
  ADD UNIQUE KEY `username` (`username`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `akses`
--
ALTER TABLE `akses`
  MODIFY `AksesID` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `book`
--
ALTER TABLE `book`
  MODIFY `ID` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT for table `jenis_akses`
--
ALTER TABLE `jenis_akses`
  MODIFY `ID` int(60) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `jenis_dok`
--
ALTER TABLE `jenis_dok`
  MODIFY `ID` int(60) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `kategori_dok`
--
ALTER TABLE `kategori_dok`
  MODIFY `ID` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=55;

--
-- AUTO_INCREMENT for table `member`
--
ALTER TABLE `member`
  MODIFY `MemberID` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `unit`
--
ALTER TABLE `unit`
  MODIFY `UnitID` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=56;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `ID` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
