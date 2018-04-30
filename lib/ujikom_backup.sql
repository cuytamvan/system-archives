-- phpMyAdmin SQL Dump
-- version 4.7.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Feb 21, 2018 at 07:07 AM
-- Server version: 10.1.26-MariaDB
-- PHP Version: 7.1.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `ujikom_backup`
--

-- --------------------------------------------------------

--
-- Table structure for table `desposition`
--

CREATE TABLE `desposition` (
  `id` varchar(10) NOT NULL,
  `time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `description` text NOT NULL,
  `notification` enum('p','b','r') NOT NULL,
  `id_mail` varchar(10) NOT NULL,
  `username` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `desposition`
--

INSERT INTO `desposition` (`id`, `time`, `description`, `notification`, `id_mail`, `username`) VALUES
('dsp8185929', '2018-02-18 23:19:04', '&lt;p&gt;lorem ipsum dolor sit &lt;u&gt;&lt;em&gt;amet&lt;/em&gt;&lt;/u&gt;&lt;/p&gt;\r\n', 'p', 'srt0914787', 'manager');

-- --------------------------------------------------------

--
-- Table structure for table `detail_disposition`
--

CREATE TABLE `detail_disposition` (
  `id` int(11) NOT NULL,
  `id_disposisi` varchar(10) NOT NULL,
  `reply_at` varchar(50) NOT NULL,
  `status` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `detail_disposition`
--

INSERT INTO `detail_disposition` (`id`, `id_disposisi`, `reply_at`, `status`) VALUES
(1, 'dsp8185929', 'fherdyl10', 0),
(2, 'dsp8185929', 'hasyim', 0),
(3, 'dsp8185929', 'indraH', 0),
(4, 'dsp8185929', 'pegawai', 1);

-- --------------------------------------------------------

--
-- Table structure for table `file_upload`
--

CREATE TABLE `file_upload` (
  `id` int(11) NOT NULL,
  `id_mail` varchar(10) NOT NULL,
  `nama_file` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `file_upload`
--

INSERT INTO `file_upload` (`id`, `id_mail`, `nama_file`) VALUES
(18, 'srt6996714', 'file-8492580509.jpg'),
(19, 'srt6996714', 'file-9524801912.jpg'),
(20, 'srt6996714', 'file-2765276035.jpg'),
(21, 'srt6996714', 'file-5191343305.jpg'),
(22, 'srt0890636', 'file-7773127242.pdf'),
(23, 'srt0890636', 'file-3901706610.pdf'),
(24, 'srt0914787', 'file-3493293024.pdf'),
(25, 'srt0914787', 'file-3073481267.doc'),
(26, 'srt0914787', 'file-2838728892.pdf'),
(27, 'srt0914787', 'file-9464506004.pdf'),
(28, 'srt0914787', 'file-7186809739.pdf'),
(29, 'srt2160522', 'file-6954703915.pdf'),
(30, 'srt2160522', 'file-0049083381.doc'),
(31, 'srt2160522', 'file-5904893536.pdf'),
(32, 'srt2160522', 'file-2226033286.pdf'),
(33, 'srt2160522', 'file-4256660642.pdf'),
(34, 'srt2160522', 'file-2291695697.doc');

-- --------------------------------------------------------

--
-- Table structure for table `mail`
--

CREATE TABLE `mail` (
  `id` varchar(10) NOT NULL,
  `time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `mail_code` varchar(50) NOT NULL,
  `mail_date` date NOT NULL,
  `mail_from` varchar(50) NOT NULL,
  `mail_to` varchar(50) NOT NULL,
  `mail_subject` varchar(50) NOT NULL,
  `description` text NOT NULL,
  `id_type` int(11) NOT NULL,
  `jenis` enum('masuk','keluar') NOT NULL,
  `status` int(1) NOT NULL,
  `username` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `mail`
--

INSERT INTO `mail` (`id`, `time`, `mail_code`, `mail_date`, `mail_from`, `mail_to`, `mail_subject`, `description`, `id_type`, `jenis`, `status`, `username`) VALUES
('srt0890636', '2018-02-18 01:53:19', '002/kepoin/II/2018', '2018-02-18', 'Pt.Kepoin', 'Pt. Bergaya', 'Meeting untuk membicarakan kerjasama', 'Lorem ipsum dolor sit amet', 1, 'keluar', 1, 'seketaris'),
('srt0914787', '2018-02-18 23:18:00', '003/kepoin/II/2018', '2018-02-19', 'Pt. Pete', 'Pt.Kepoin', 'Meeting', 'Lorem ipsum dolor sit amet', 1, 'masuk', 1, 'seketaris'),
('srt2160522', '2018-02-19 03:38:57', '004/kepoin/II/2018', '2018-02-19', 'Pt. Pete', 'Pt.Kepoin', 'Meeting', 'Lorem ipsum dolor sit amet', 1, 'masuk', 1, 'seketaris'),
('srt6996714', '2018-02-18 01:51:36', '001/kepoin/II/2018', '2018-02-18', 'Pt. Nutri', 'Pt.Kepoin', 'Meeting', 'Lorem ipsum dolor sit amet', 1, 'masuk', 1, 'seketaris');

-- --------------------------------------------------------

--
-- Table structure for table `mail_type`
--

CREATE TABLE `mail_type` (
  `id` int(11) NOT NULL,
  `type` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `mail_type`
--

INSERT INTO `mail_type` (`id`, `type`) VALUES
(1, 'Resmi'),
(2, 'Tugas'),
(3, 'Niaga');

-- --------------------------------------------------------

--
-- Stand-in structure for view `qw_detail_disposisi`
-- (See below for the actual view)
--
CREATE TABLE `qw_detail_disposisi` (
`id` int(11)
,`id_disposisi` varchar(10)
,`time` timestamp
,`notification` enum('p','b','r')
,`reply_at` varchar(50)
,`fullname` varchar(50)
,`status` int(1)
);

-- --------------------------------------------------------

--
-- Stand-in structure for view `qw_disposisi`
-- (See below for the actual view)
--
CREATE TABLE `qw_disposisi` (
`id` varchar(10)
,`time` timestamp
,`description` text
,`notification` enum('p','b','r')
,`id_mail` varchar(10)
,`username` varchar(50)
,`fullname` varchar(50)
);

-- --------------------------------------------------------

--
-- Stand-in structure for view `qw_mail`
-- (See below for the actual view)
--
CREATE TABLE `qw_mail` (
`id` varchar(10)
,`time` timestamp
,`mail_code` varchar(50)
,`mail_date` date
,`mail_from` varchar(50)
,`mail_to` varchar(50)
,`mail_subject` varchar(50)
,`description` text
,`id_type` int(11)
,`jenis` enum('masuk','keluar')
,`status` int(1)
,`username` varchar(50)
,`fullname` varchar(50)
,`type` varchar(50)
);

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `username` varchar(50) NOT NULL,
  `password` varchar(60) NOT NULL,
  `fullname` varchar(50) NOT NULL,
  `level` enum('admin','manager','seketaris','pegawai') NOT NULL,
  `jk` enum('l','p') NOT NULL,
  `no_hp` varchar(15) NOT NULL,
  `email` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`username`, `password`, `fullname`, `level`, `jk`, `no_hp`, `email`) VALUES
('adminTamvan', 'admin', 'admin', 'admin', 'l', '08159521317', 'rizkiwahyudi540@gmail.com'),
('fherdyl10', 'gandengpro2000', 'Fherdy Lianza', 'pegawai', 'l', '08888888', 'fherdyl10@gmail.com'),
('hasyim', 'abc123', 'Muhamad Alfa Hasyim', 'pegawai', 'l', '08888888', 'hasyim@gmail.com'),
('indraH', 'abc123', 'Muhamad Indra H', 'pegawai', 'l', '08888888', 'hasantion@gmail.com'),
('manager', 'manager', 'Muhammad rizki wahyudi', 'manager', 'l', '081510897785', 'rizkiwahyudi540@gmail.com'),
('pegawai', 'pegawai', 'Rendi Ihfanudin', 'pegawai', 'l', '08888888', 'rendi.ihfa@gmail.com'),
('pegawai2', 'abc123', 'Firman Handy', 'pegawai', 'p', '085716343701', 'firman@gmail.com'),
('seketaris', 'seketaris', 'Nabila Nur', 'seketaris', 'l', '085716343701', 'nabilanur117@gmail.com');

-- --------------------------------------------------------

--
-- Structure for view `qw_detail_disposisi`
--
DROP TABLE IF EXISTS `qw_detail_disposisi`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `qw_detail_disposisi`  AS  select `detail_disposition`.`id` AS `id`,`detail_disposition`.`id_disposisi` AS `id_disposisi`,`desposition`.`time` AS `time`,`desposition`.`notification` AS `notification`,`detail_disposition`.`reply_at` AS `reply_at`,`user`.`fullname` AS `fullname`,`detail_disposition`.`status` AS `status` from ((`detail_disposition` join `user` on((`user`.`username` = `detail_disposition`.`reply_at`))) join `desposition` on((`desposition`.`id` = `detail_disposition`.`id_disposisi`))) ;

-- --------------------------------------------------------

--
-- Structure for view `qw_disposisi`
--
DROP TABLE IF EXISTS `qw_disposisi`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `qw_disposisi`  AS  select `desposition`.`id` AS `id`,`desposition`.`time` AS `time`,`desposition`.`description` AS `description`,`desposition`.`notification` AS `notification`,`desposition`.`id_mail` AS `id_mail`,`desposition`.`username` AS `username`,`user`.`fullname` AS `fullname` from (`desposition` join `user` on((`user`.`username` = `desposition`.`username`))) ;

-- --------------------------------------------------------

--
-- Structure for view `qw_mail`
--
DROP TABLE IF EXISTS `qw_mail`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `qw_mail`  AS  select `mail`.`id` AS `id`,`mail`.`time` AS `time`,`mail`.`mail_code` AS `mail_code`,`mail`.`mail_date` AS `mail_date`,`mail`.`mail_from` AS `mail_from`,`mail`.`mail_to` AS `mail_to`,`mail`.`mail_subject` AS `mail_subject`,`mail`.`description` AS `description`,`mail`.`id_type` AS `id_type`,`mail`.`jenis` AS `jenis`,`mail`.`status` AS `status`,`mail`.`username` AS `username`,`user`.`fullname` AS `fullname`,`mail_type`.`type` AS `type` from ((`mail` join `mail_type` on((`mail_type`.`id` = `mail`.`id_type`))) join `user` on((`user`.`username` = `mail`.`username`))) ;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `desposition`
--
ALTER TABLE `desposition`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_mail` (`id_mail`,`username`),
  ADD KEY `username` (`username`);

--
-- Indexes for table `detail_disposition`
--
ALTER TABLE `detail_disposition`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_disposisi` (`id_disposisi`,`reply_at`),
  ADD KEY `id_disposisi_2` (`id_disposisi`,`reply_at`),
  ADD KEY `reply_at` (`reply_at`);

--
-- Indexes for table `file_upload`
--
ALTER TABLE `file_upload`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_mail` (`id_mail`);

--
-- Indexes for table `mail`
--
ALTER TABLE `mail`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_type` (`id_type`,`username`),
  ADD KEY `username` (`username`);

--
-- Indexes for table `mail_type`
--
ALTER TABLE `mail_type`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`username`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `detail_disposition`
--
ALTER TABLE `detail_disposition`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `file_upload`
--
ALTER TABLE `file_upload`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=35;

--
-- AUTO_INCREMENT for table `mail_type`
--
ALTER TABLE `mail_type`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `desposition`
--
ALTER TABLE `desposition`
  ADD CONSTRAINT `desposition_ibfk_1` FOREIGN KEY (`id_mail`) REFERENCES `mail` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `desposition_ibfk_2` FOREIGN KEY (`username`) REFERENCES `user` (`username`) ON DELETE CASCADE;

--
-- Constraints for table `detail_disposition`
--
ALTER TABLE `detail_disposition`
  ADD CONSTRAINT `detail_disposition_ibfk_1` FOREIGN KEY (`id_disposisi`) REFERENCES `desposition` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `detail_disposition_ibfk_2` FOREIGN KEY (`reply_at`) REFERENCES `user` (`username`) ON DELETE CASCADE;

--
-- Constraints for table `file_upload`
--
ALTER TABLE `file_upload`
  ADD CONSTRAINT `file_upload_ibfk_1` FOREIGN KEY (`id_mail`) REFERENCES `mail` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `mail`
--
ALTER TABLE `mail`
  ADD CONSTRAINT `mail_ibfk_1` FOREIGN KEY (`username`) REFERENCES `user` (`username`) ON DELETE CASCADE,
  ADD CONSTRAINT `mail_ibfk_2` FOREIGN KEY (`id_type`) REFERENCES `mail_type` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
