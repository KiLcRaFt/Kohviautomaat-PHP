-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: d123184.mysql.zonevs.eu
-- Loomise aeg: Mai 06, 2024 kell 09:17 EL
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
-- Tabeli struktuur tabelile `kasutaja`
--

CREATE TABLE `kasutaja` (
  `id` int(11) NOT NULL,
  `kasutaja` varchar(30) DEFAULT NULL,
  `parool` varchar(100) DEFAULT NULL,
  `onAdmin` int(11) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Andmete tõmmistamine tabelile `kasutaja`
--

INSERT INTO `kasutaja` (`id`, `kasutaja`, `parool`, `onAdmin`) VALUES
(1, 'admin', 'su6FF4/MgjUAk', 1),
(2, 'opilane', 'suql11CWUmRTs', 0),
(25, 'qwertyu', 'suXP0bXF9C/x6', 0),
(26, 'irina', 'suTmCeCzlrP52', 0),
(27, 'martinloh', 'suTAqpTOLJclo', 0),
(28, 'martin', 'sujypORmzmQJg', 0),
(29, 'test', 'sueJsCt/y04co', 0),
(30, 'asd', 'supw0suH3wXL2', 0),
(31, 'EdaK', 'suGN.XmvpLJzE', 0),
(34, 'oplane', 'suo.URZXhD44.', 0),
(35, 'qwerty', 'suXP0bXF9C/x6', 0),
(36, 'opilane5', 'suhb3Qlq/qMLw', 0),
(38, 'test2', 'sudBR9QN3U5Tw', 0),
(39, 'user', 'su6/tfktDv4UM', 0),
(40, 'Baceman', 'su.7ZLQEdBF/2', 0),
(41, 'admin1', 'su6FF4/MgjUAk', 0);

--
-- Indeksid tõmmistatud tabelitele
--

--
-- Indeksid tabelile `kasutaja`
--
ALTER TABLE `kasutaja`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `kasutaja` (`kasutaja`);

--
-- AUTO_INCREMENT tõmmistatud tabelitele
--

--
-- AUTO_INCREMENT tabelile `kasutaja`
--
ALTER TABLE `kasutaja`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=42;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
