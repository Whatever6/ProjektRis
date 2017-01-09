-- phpMyAdmin SQL Dump
-- version 4.6.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 09, 2017 at 10:02 AM
-- Server version: 5.7.14
-- PHP Version: 5.6.25

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `ris`
--

-- --------------------------------------------------------

--
-- Table structure for table `artikel`
--

CREATE TABLE `artikel` (
  `ID_Artikel` int(11) NOT NULL,
  `ime_artikla` varchar(45) COLLATE utf8_slovenian_ci DEFAULT NULL,
  `namen_uporabe` varchar(45) COLLATE utf8_slovenian_ci DEFAULT NULL,
  `status` smallint(6) DEFAULT NULL,
  `Uporabnik_idUporabnik` int(11) DEFAULT NULL COMMENT 'tuji ključ',
  `slika` varchar(60) COLLATE utf8_slovenian_ci DEFAULT NULL,
  `kraj` varchar(20) COLLATE utf8_slovenian_ci NOT NULL,
  `datum_vrnitve` datetime NOT NULL,
  `opis` varchar(500) COLLATE utf8_slovenian_ci DEFAULT NULL,
  `tel_st` varchar(20) COLLATE utf8_slovenian_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_slovenian_ci;

--
-- Dumping data for table `artikel`
--

INSERT INTO `artikel` (`ID_Artikel`, `ime_artikla`, `namen_uporabe`, `status`, `Uporabnik_idUporabnik`, `slika`, `kraj`, `datum_vrnitve`, `opis`, `tel_st`) VALUES
(4, 'avto', 'Sport', 1, NULL, NULL, 'Ljubljana', '2015-11-11 00:00:00', 'lol', '123 123 123'),
(17, 'pulover', 'Oblacila', 1, NULL, NULL, 'Maribor', '2020-04-04 00:00:00', 'aaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaa', '111 111 111'),
(18, 'Kolo', 'Sport', 1, NULL, NULL, 'Maribor', '2017-01-06 00:00:00', 'lepo rdece gorsko kolo. ', '031 123 321'),
(19, 'Miska', 'Racunalnistvo', 0, NULL, NULL, 'Ljubljana', '2017-01-10 00:00:00', 'Gaming miska logitech, stara 2 tedna. Le 1x uporabljena.', '111 222 333'),
(20, 'torba', 'Sport', 1, NULL, NULL, 'Celje', '2017-01-20 00:00:00', 'Torba za planinarjenje.', '132 231 123');

-- --------------------------------------------------------

--
-- Table structure for table `uporabnik`
--

CREATE TABLE `uporabnik` (
  `id_uporabnik` int(11) NOT NULL,
  `ime` varchar(20) COLLATE utf8_slovenian_ci NOT NULL,
  `priimek` varchar(40) COLLATE utf8_slovenian_ci NOT NULL,
  `email` varchar(80) CHARACTER SET utf32 COLLATE utf32_slovenian_ci NOT NULL,
  `pass` char(40) COLLATE utf8_slovenian_ci NOT NULL,
  `user_level` tinyint(1) UNSIGNED NOT NULL DEFAULT '0',
  `active` char(32) COLLATE utf8_slovenian_ci DEFAULT NULL,
  `registration_date` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_slovenian_ci;

--
-- Dumping data for table `uporabnik`
--

INSERT INTO `uporabnik` (`id_uporabnik`, `ime`, `priimek`, `email`, `pass`, `user_level`, `active`, `registration_date`) VALUES
(9, 'Marko', 'Holbl', 'marko.holbl@um.si', '9efe9a5a1da5f41a4eb7599f2715dc24abf5bbc8', 0, NULL, '2016-11-09 10:07:15'),
(10, 'admin', 'admin', 'admin@lpt.um.si', 'd033e22ae348aeb5660fc2140aec35850c4da997', 1, NULL, '2016-11-09 10:08:00'),
(12, 'Jaka', 'Polutnik', 'marko.holbl@gmail.com', '2ec22095503fe843326e7c19dd2ab98716b63e4d', 0, NULL, '2016-11-09 10:33:10');

--
-- Indexes for dumped tables
--
--
-- Indexes for table `uporabnik`
--
ALTER TABLE `uporabnik`
  ADD PRIMARY KEY (`id_uporabnik`),
  ADD UNIQUE KEY `email` (`email`),
  ADD KEY `login` (`email`,`pass`);

--
-- AUTO_INCREMENT for dumped tables
--

ALTER TABLE `uporabnik`
  MODIFY `id_uporabnik` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
--

--
-- Indexes for table `artikel`
--
ALTER TABLE `artikel`
  ADD PRIMARY KEY (`ID_Artikel`),
  ADD KEY `Uporabnik_idUporabnik` (`Uporabnik_idUporabnik`);


-- AUTO_INCREMENT for table `artikel`
--
ALTER TABLE `artikel`
  MODIFY `ID_Artikel` int(11)NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;
--
-- Constraints for dumped tables
--

--
-- Constraints for table `artikel`
--
ALTER TABLE `artikel`
  ADD CONSTRAINT `artikel_ibfk_1` FOREIGN KEY (`Uporabnik_idUporabnik`) REFERENCES `uporabnik` (`id_uporabnik`) ON DELETE SET NULL ON UPDATE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

