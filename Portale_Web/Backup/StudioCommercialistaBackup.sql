-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Creato il: Giu 22, 2020 alle 16:32
-- Versione del server: 10.4.11-MariaDB
-- Versione PHP: 7.4.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `studio_commercialista_db`
--

-- --------------------------------------------------------

--
-- Struttura stand-in per le viste `allclient`
-- (Vedi sotto per la vista effettiva)
--
CREATE TABLE `allclient` (
`Matricola` int(11)
,`Data_registrazione` timestamp
,`CodFiscale` varchar(16)
,`Cognome` varchar(15)
,`Nome` varchar(30)
,`NumeroTelefonico` varchar(10)
,`MatricolaPrivato` int(11)
,`PartitaIVA` varchar(11)
,`NomeAzienda` varchar(30)
,`MatricolaAzienda` int(11)
,`PEC` varchar(30)
,`Identificativo` int(11)
,`Nominativo` varchar(30)
,`DescrizioneServizio` varchar(80)
,`Località` varchar(10)
,`MatricolaEnte` int(11)
);

-- --------------------------------------------------------

--
-- Struttura della tabella `attività`
--

CREATE TABLE `attività` (
  `ID` int(11) NOT NULL,
  `Tipo` varchar(30) NOT NULL,
  `File` varchar(200) DEFAULT NULL,
  `Matricola` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Struttura della tabella `aziende`
--

CREATE TABLE `aziende` (
  `PartitaIVA` varchar(11) NOT NULL,
  `NomeAzienda` varchar(30) DEFAULT NULL,
  `MatricolaAzienda` int(11) NOT NULL,
  `PEC` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Struttura della tabella `clienti`
--

CREATE TABLE `clienti` (
  `Matricola` int(11) NOT NULL,
  `Data_registrazione` timestamp NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Struttura della tabella `entipubblici`
--

CREATE TABLE `entipubblici` (
  `Identificativo` int(11) NOT NULL,
  `Nominativo` varchar(30) NOT NULL,
  `DescrizioneServizio` varchar(80) DEFAULT NULL,
  `Località` varchar(10) DEFAULT NULL,
  `MatricolaEnte` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Struttura della tabella `privati`
--

CREATE TABLE `privati` (
  `CodFiscale` varchar(16) NOT NULL,
  `Cognome` varchar(15) NOT NULL,
  `Nome` varchar(30) NOT NULL,
  `NumeroTelefonico` varchar(10) DEFAULT NULL,
  `MatricolaPrivato` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Struttura per vista `allclient`
--
DROP TABLE IF EXISTS `allclient`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `allclient`  AS  select `c`.`Matricola` AS `Matricola`,`c`.`Data_registrazione` AS `Data_registrazione`,`p`.`CodFiscale` AS `CodFiscale`,`p`.`Cognome` AS `Cognome`,`p`.`Nome` AS `Nome`,`p`.`NumeroTelefonico` AS `NumeroTelefonico`,`p`.`MatricolaPrivato` AS `MatricolaPrivato`,`a`.`PartitaIVA` AS `PartitaIVA`,`a`.`NomeAzienda` AS `NomeAzienda`,`a`.`MatricolaAzienda` AS `MatricolaAzienda`,`a`.`PEC` AS `PEC`,`e`.`Identificativo` AS `Identificativo`,`e`.`Nominativo` AS `Nominativo`,`e`.`DescrizioneServizio` AS `DescrizioneServizio`,`e`.`Località` AS `Località`,`e`.`MatricolaEnte` AS `MatricolaEnte` from (((`clienti` `c` left join `privati` `p` on(`c`.`Matricola` = `p`.`MatricolaPrivato`)) left join `aziende` `a` on(`c`.`Matricola` = `a`.`MatricolaAzienda`)) left join `entipubblici` `e` on(`c`.`Matricola` = `e`.`MatricolaEnte`)) ;

--
-- Indici per le tabelle scaricate
--

--
-- Indici per le tabelle `attività`
--
ALTER TABLE `attività`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `attività` (`Matricola`);

--
-- Indici per le tabelle `aziende`
--
ALTER TABLE `aziende`
  ADD PRIMARY KEY (`MatricolaAzienda`),
  ADD UNIQUE KEY `PartitaIVA` (`PartitaIVA`);

--
-- Indici per le tabelle `clienti`
--
ALTER TABLE `clienti`
  ADD PRIMARY KEY (`Matricola`);

--
-- Indici per le tabelle `entipubblici`
--
ALTER TABLE `entipubblici`
  ADD PRIMARY KEY (`MatricolaEnte`),
  ADD UNIQUE KEY `Identificativo` (`Identificativo`);

--
-- Indici per le tabelle `privati`
--
ALTER TABLE `privati`
  ADD PRIMARY KEY (`MatricolaPrivato`),
  ADD UNIQUE KEY `CodFiscale` (`CodFiscale`);

--
-- AUTO_INCREMENT per le tabelle scaricate
--

--
-- AUTO_INCREMENT per la tabella `attività`
--
ALTER TABLE `attività`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=0;

--
-- AUTO_INCREMENT per la tabella `clienti`
--
ALTER TABLE `clienti`
  MODIFY `Matricola` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=0;

--
-- Limiti per le tabelle scaricate
--

--
-- Limiti per la tabella `attività`
--
ALTER TABLE `attività`
  ADD CONSTRAINT `attività` FOREIGN KEY (`Matricola`) REFERENCES `clienti` (`Matricola`) ON DELETE SET NULL ON UPDATE CASCADE;

--
-- Limiti per la tabella `aziende`
--
ALTER TABLE `aziende`
  ADD CONSTRAINT `aziende_ibfk_1` FOREIGN KEY (`MatricolaAzienda`) REFERENCES `clienti` (`Matricola`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Limiti per la tabella `entipubblici`
--
ALTER TABLE `entipubblici`
  ADD CONSTRAINT `entipubblici` FOREIGN KEY (`MatricolaEnte`) REFERENCES `clienti` (`Matricola`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Limiti per la tabella `privati`
--
ALTER TABLE `privati`
  ADD CONSTRAINT `privati` FOREIGN KEY (`MatricolaPrivato`) REFERENCES `clienti` (`Matricola`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
