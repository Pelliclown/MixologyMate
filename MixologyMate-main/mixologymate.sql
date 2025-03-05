-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Creato il: Feb 10, 2025 alle 18:17
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
-- Database: `mixologymate`
--

-- --------------------------------------------------------

--
-- Struttura della tabella `drink`
--

CREATE TABLE `drink` (
  `idDrink` int(5) NOT NULL,
  `nome` varchar(20) NOT NULL,
  `tempoPreparazione` varchar(30) NOT NULL,
  `ingredienti` varchar(50) NOT NULL,
  `descrizione` varchar(250) NOT NULL,
  `idCreatore` int(5) DEFAULT NULL,
  `idImmagine` int(5) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Struttura della tabella `immaginidrink`
--

CREATE TABLE `immaginidrink` (
  `idImmagine` int(5) NOT NULL,
  `nome` varchar(255) NOT NULL,
  `tipo` varchar(100) NOT NULL,
  `immagine` longblob NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Struttura della tabella `immaginiprofilo`
--

CREATE TABLE `immaginiprofilo` (
  `idImmagine` int(5) NOT NULL,
  `nomeImmagine` varchar(255) NOT NULL,
  `tipologiaImmagine` varchar(100) NOT NULL,
  `immagine` longblob NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Struttura della tabella `recensioni`
--

CREATE TABLE `recensioni` (
  `idRecensione` int(5) NOT NULL,
  `descrizione` varchar(250) NOT NULL,
  `numeroStelle` int(4) NOT NULL,
  `idDrink` int(5) DEFAULT NULL,
  `idCreatore` int(5) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Struttura della tabella `utenti`
--

CREATE TABLE `utenti` (
  `idUtente` int(5) NOT NULL,
  `nickname` varchar(30) NOT NULL,
  `password` varchar(30) NOT NULL,
  `numeroDrinkCaricati` int(3) DEFAULT NULL,
  `numeroPreferiti` int(3) DEFAULT NULL,
  `idImmagine` int(3) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Indici per le tabelle scaricate
--

--
-- Indici per le tabelle `drink`
--
ALTER TABLE `drink`
  ADD PRIMARY KEY (`idDrink`),
  ADD KEY `idCreatore` (`idCreatore`),
  ADD KEY `idImmagine` (`idImmagine`);

--
-- Indici per le tabelle `immaginidrink`
--
ALTER TABLE `immaginidrink`
  ADD PRIMARY KEY (`idImmagine`);

--
-- Indici per le tabelle `immaginiprofilo`
--
ALTER TABLE `immaginiprofilo`
  ADD PRIMARY KEY (`idImmagine`);

--
-- Indici per le tabelle `recensioni`
--
ALTER TABLE `recensioni`
  ADD PRIMARY KEY (`idRecensione`),
  ADD KEY `idDrink` (`idDrink`);

--
-- Indici per le tabelle `utenti`
--
ALTER TABLE `utenti`
  ADD PRIMARY KEY (`idUtente`),
  ADD KEY `idImmagine` (`idImmagine`);

--
-- AUTO_INCREMENT per le tabelle scaricate
--

--
-- AUTO_INCREMENT per la tabella `drink`
--
ALTER TABLE `drink`
  MODIFY `idDrink` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=85;

--
-- AUTO_INCREMENT per la tabella `immaginidrink`
--
ALTER TABLE `immaginidrink`
  MODIFY `idImmagine` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=51;

--
-- AUTO_INCREMENT per la tabella `immaginiprofilo`
--
ALTER TABLE `immaginiprofilo`
  MODIFY `idImmagine` int(5) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT per la tabella `recensioni`
--
ALTER TABLE `recensioni`
  MODIFY `idRecensione` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT per la tabella `utenti`
--
ALTER TABLE `utenti`
  MODIFY `idUtente` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- Limiti per le tabelle scaricate
--

--
-- Limiti per la tabella `drink`
--
ALTER TABLE `drink`
  ADD CONSTRAINT `drink_ibfk_1` FOREIGN KEY (`idCreatore`) REFERENCES `utenti` (`idUtente`),
  ADD CONSTRAINT `drink_ibfk_2` FOREIGN KEY (`idImmagine`) REFERENCES `immaginidrink` (`idImmagine`);

--
-- Limiti per la tabella `recensioni`
--
ALTER TABLE `recensioni`
  ADD CONSTRAINT `recensioni_ibfk_1` FOREIGN KEY (`idDrink`) REFERENCES `drink` (`idDrink`),
  ADD CONSTRAINT `recensioni_ibfk_2` FOREIGN KEY (`idCreatore`) REFERENCES `utenti` (`idUtente`);

--
-- Limiti per la tabella `utenti`
--
ALTER TABLE `utenti`
  ADD CONSTRAINT `utenti_ibfk_1` FOREIGN KEY (`idImmagine`) REFERENCES `immaginiprofilo` (`idImmagine`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
