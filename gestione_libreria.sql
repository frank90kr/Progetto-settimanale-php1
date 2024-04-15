-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Creato il: Apr 15, 2024 alle 17:00
-- Versione del server: 10.4.32-MariaDB
-- Versione PHP: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `gestione_libreria`
--

-- --------------------------------------------------------

--
-- Struttura della tabella `libri`
--

CREATE TABLE `libri` (
  `id` int(11) NOT NULL,
  `titolo` varchar(30) NOT NULL,
  `autore` varchar(30) NOT NULL,
  `anno_pubblicazione` int(11) NOT NULL,
  `genere` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dump dei dati per la tabella `libri`
--

INSERT INTO `libri` (`id`, `titolo`, `autore`, `anno_pubblicazione`, `genere`) VALUES
(2, 'Harry Potter', 'j.k. rowling', 2003, 'fantasy'),
(3, 'Il Signore Degli Anelli', 'j.r.r. tolkien', 2007, 'romanzo'),
(4, 'Il Ritratto Di Dorian Grey', 'oscar wilde', 1891, 'romanzo'),
(5, 'Fabbricante Di Lacrime', 'erin doom', 2021, 'romanzo'),
(6, 'Fairy Tale', 'stephen king', 2022, 'romanzo'),
(13, 'Cuore Nascosto', 'ferzan ozpetek', 2024, 'romanzo'),
(15, 'Holly', 'stephen king', 2023, 'thriller'),
(16, 'La Setta', 'camilla lackberg', 2024, 'Giallo'),
(17, 'Il Piccolo Principe', 'antoine de saint-exupery', 1943, 'Favola'),
(18, 'Il Nome Della Rosa', 'umberto eco', 1980, 'romanzo'),
(19, 'Diario Di Anna Frank', 'anna frank', 1947, 'diaristico'),
(20, 'La Guerra Dei Mondi', 'h.g.wells', 1897, 'romanzo');

--
-- Indici per le tabelle scaricate
--

--
-- Indici per le tabelle `libri`
--
ALTER TABLE `libri`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT per le tabelle scaricate
--

--
-- AUTO_INCREMENT per la tabella `libri`
--
ALTER TABLE `libri`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
