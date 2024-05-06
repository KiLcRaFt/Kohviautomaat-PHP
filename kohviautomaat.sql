-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: d123184.mysql.zonevs.eu
-- Loomise aeg: Mai 06, 2024 kell 09:11 EL
-- Serveri versioon: 10.4.32-MariaDB-log
-- PHP versioon: 8.2.16

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Andmebaas: `d123184_andmebaas`
--

-- --------------------------------------------------------

--
-- Tabeli struktuur tabelile `kohviautomaat`
--

CREATE TABLE `kohviautomaat` (
  `id` int(11) NOT NULL,
  `joohinimi` char(30) DEFAULT NULL,
  `topsepakis` int(11) DEFAULT NULL,
  `topsejuua` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Andmete tõmmistamine tabelile `kohviautomaat`
--

INSERT INTO `kohviautomaat` (`id`, `joohinimi`, `topsepakis`, `topsejuua`) VALUES
(1, 'Kohv', 0, 159),
(2, 'Tee', 0, 75),
(3, 'Kakao', 0, 100);

--
-- Indeksid tõmmistatud tabelitele
--

--
-- Indeksid tabelile `kohviautomaat`
--
ALTER TABLE `kohviautomaat`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT tõmmistatud tabelitele
--

--
-- AUTO_INCREMENT tabelile `kohviautomaat`
--
ALTER TABLE `kohviautomaat`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
