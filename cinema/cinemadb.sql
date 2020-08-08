-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Creato il: Ago 08, 2020 alle 12:23
-- Versione del server: 10.4.11-MariaDB
-- Versione PHP: 7.2.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `cinemadb`
--

-- --------------------------------------------------------

--
-- Struttura della tabella `biglietto`
--

CREATE TABLE `biglietto` (
  `riepilogo` text NOT NULL,
  `idutente` varchar(100) NOT NULL,
  `idbiglietto` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dump dei dati per la tabella `biglietto`
--

INSERT INTO `biglietto` (`riepilogo`, `idutente`, `idbiglietto`) VALUES
('[{\"occupato\":false,\"fila\":8,\"numero\":13}] {\"film\":\"Madagascar\",\"sala\":\"sala_rossa\",\"giorno\":\"2020-08-31\",\"orario\":\"00:00:00\",\"tipo\":\"2\",\"idproiezione\":\"1\"}', '4', 1);

-- --------------------------------------------------------

--
-- Struttura della tabella `credenziale`
--

CREATE TABLE `credenziale` (
  `circuitocarta` text NOT NULL,
  `numerocarta` int(18) NOT NULL,
  `scadenza` date NOT NULL,
  `idutente` char(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dump dei dati per la tabella `credenziale`
--

INSERT INTO `credenziale` (`circuitocarta`, `numerocarta`, `scadenza`, `idutente`) VALUES
('mastercard', 2147483647, '0000-00-00', '');

-- --------------------------------------------------------

--
-- Struttura della tabella `filiale`
--

CREATE TABLE `filiale` (
  `idfiliale` char(10) NOT NULL,
  `idregistrazione` text NOT NULL,
  `email` text NOT NULL,
  `partitaiva` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Struttura della tabella `film`
--

CREATE TABLE `film` (
  `titolo` char(70) NOT NULL,
  `regista` text NOT NULL,
  `anno` int(4) NOT NULL,
  `durata` int(3) NOT NULL,
  `a_generi` text NOT NULL,
  `a_cast` text NOT NULL,
  `casaproduzione` text NOT NULL,
  `trama` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dump dei dati per la tabella `film`
--

INSERT INTO `film` (`titolo`, `regista`, `anno`, `durata`, `a_generi`, `a_cast`, `casaproduzione`, `trama`) VALUES
('le pagine della nostra vita', 'Nicholas Spaks', 2006, 120, 'Romantico, Drammatico', 'Ryan Gosgling', 'Universal', 'In una casa di riposo un uomo racconta ad una donna la storia di un grande amore tra due giovani nella North Carolina degli anni quaranta.'),
('Madagascar', 'Mario Rossi', 2008, 120, 'Commedia, Animazione', 'I pinguini ', 'DreamWorks', 'Una zebra in uno zoo, stanca della vita in cattività, decide di scappare, sfruttando un\'ingegnosa idea di un gruppo di pinguini. Quando i suoi amici si accorgono della sua scomparsa, decidono di andarlo a cercare per riportarlo indietro.'),
('titanic', 'qualcuno', 1998, 200, 'drammatico, romantico', 'leonardo di caprio', 'dreamworks', 'Il transatlantico Titanic, considerato un gioiello tecnologico ed il più lussuoso piroscafo da crociera mai realizzato, salpa dall\'Inghilterra il dieci aprile del 1912 con oltre 1500 passeggeri a bordo per il suo viaggio inaugurale. I viaggiatori sono collocati in tre classi, riflesso delle differenze sociali.'),
('Flashdance', 'Adrian Line', 1983, 135, 'romantico,ballo', 'Jennifer Beals,Micheal Nouri', 'PolyGram Pictures', 'La stupenda diciottenne Alex lavora come saldatrice in una grande officina di Pittsburgh, in Pennsylvania, e arrotonda il salario ballando la sera in un locale notturno. Il suo sogno Ã¨ diventare danzatrice professionista'),
('Wolf of Wall Street', 'Martin Scorsese', 2013, 180, 'commedia,biografico', 'Leonardo Di caprio,Margot Robbie', 'Appian Way Productions', 'New York, anni 80. Eccessi e corruzione segnano la curva discendente della brillante carriera di Jordan Belfort, un ambizioso broker in grado di guadagnare migliaia di dollari al minuto e di spenderne altrettanti in droga e futilitÃ .');

-- --------------------------------------------------------

--
-- Struttura della tabella `mappa`
--

CREATE TABLE `mappa` (
  `nomeschema` char(11) NOT NULL,
  `modello` blob NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Struttura della tabella `pagamento`
--

CREATE TABLE `pagamento` (
  `persona` char(20) NOT NULL,
  `totale` float NOT NULL,
  `idpagamento` char(6) NOT NULL,
  `listaitem` text NOT NULL,
  `pagato` tinyint(1) NOT NULL,
  `idutente` int(11) NOT NULL,
  `idfiliale` char(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dump dei dati per la tabella `pagamento`
--

INSERT INTO `pagamento` (`persona`, `totale`, `idpagamento`, `listaitem`, `pagato`, `idutente`, `idfiliale`) VALUES
('Mario Rossi', 25, '3', 'item1,item2,item3', 1, 2, '4');

-- --------------------------------------------------------

--
-- Struttura della tabella `posto`
--

CREATE TABLE `posto` (
  `fila` char(2) NOT NULL,
  `numero` int(2) NOT NULL,
  `occupato` tinyint(1) NOT NULL,
  `proiezione` char(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dump dei dati per la tabella `posto`
--

INSERT INTO `posto` (`fila`, `numero`, `occupato`, `proiezione`) VALUES
('8', 13, 1, '1');

-- --------------------------------------------------------

--
-- Struttura della tabella `profilo`
--

CREATE TABLE `profilo` (
  `idutente` int(11) NOT NULL,
  `nome` text NOT NULL,
  `cognome` text NOT NULL,
  `indirizzo` text NOT NULL,
  `datadinascita` date NOT NULL,
  `citta` text NOT NULL,
  `telefono` text NOT NULL,
  `a_listasconti` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dump dei dati per la tabella `profilo`
--

INSERT INTO `profilo` (`idutente`, `nome`, `cognome`, `indirizzo`, `datadinascita`, `citta`, `telefono`, `a_listasconti`) VALUES
(4, 'Teresa', 'Bove', 'Via Bologna 3', '1995-08-26', 'Luco dei Marsi', '3278385503', '');

-- --------------------------------------------------------

--
-- Struttura della tabella `proiezione`
--

CREATE TABLE `proiezione` (
  `film` char(70) NOT NULL,
  `sala` char(15) NOT NULL,
  `giorno` date NOT NULL,
  `orario` time NOT NULL,
  `tipo` char(1) NOT NULL,
  `idproiezione` int(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dump dei dati per la tabella `proiezione`
--

INSERT INTO `proiezione` (`film`, `sala`, `giorno`, `orario`, `tipo`, `idproiezione`) VALUES
('Madagascar', 'sala_rossa', '2020-08-31', '00:00:00', '2', 1);

-- --------------------------------------------------------

--
-- Struttura della tabella `registrazione`
--

CREATE TABLE `registrazione` (
  `password` varchar(15) NOT NULL,
  `email` char(30) NOT NULL,
  `idutente` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dump dei dati per la tabella `registrazione`
--

INSERT INTO `registrazione` (`password`, `email`, `idutente`) VALUES
('26081995', 'teresa.4us@gmail.com', 4);

-- --------------------------------------------------------

--
-- Struttura della tabella `sala`
--

CREATE TABLE `sala` (
  `numeroposti` int(3) NOT NULL,
  `nomeschema` char(15) NOT NULL,
  `nomesala` char(10) NOT NULL,
  `numerofile` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dump dei dati per la tabella `sala`
--

INSERT INTO `sala` (`numeroposti`, `nomeschema`, `nomesala`, `numerofile`) VALUES
(150, 'schema_sala_ros', 'Sala_rossa', 10),
(150, 'schema_sala_ros', 'Sala_rossa', 10);

-- --------------------------------------------------------

--
-- Struttura della tabella `sconto`
--

CREATE TABLE `sconto` (
  `idsconto` int(11) NOT NULL,
  `descrizione` text NOT NULL,
  `baseapplicazione` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dump dei dati per la tabella `sconto`
--

INSERT INTO `sconto` (`idsconto`, `descrizione`, `baseapplicazione`) VALUES
(1, 'Sconto applicato a tutti i bambini con etÃ  max di 14 anni', 5);

-- --------------------------------------------------------

--
-- Struttura della tabella `struttura`
--

CREATE TABLE `struttura` (
  `idfiliale` char(10) NOT NULL,
  `indirizzo` char(100) NOT NULL,
  `nome` char(20) NOT NULL,
  `telefono` int(12) NOT NULL,
  `email` char(30) NOT NULL,
  `orariapertura` text NOT NULL,
  `idregistrazione` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dump dei dati per la tabella `struttura`
--

INSERT INTO `struttura` (`idfiliale`, `indirizzo`, `nome`, `telefono`, `email`, `orariapertura`, `idregistrazione`) VALUES
('', 'nucleo industriale avezzano', 'astra', 863529354, 'astraaz@gmail.com', '', 0);

-- --------------------------------------------------------

--
-- Struttura della tabella `tabella_file`
--

CREATE TABLE `tabella_file` (
  `id` int(10) NOT NULL,
  `nome` varchar(255) DEFAULT NULL,
  `tipo` varchar(128) DEFAULT NULL,
  `dati` blob DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Indici per le tabelle scaricate
--

--
-- Indici per le tabelle `biglietto`
--
ALTER TABLE `biglietto`
  ADD PRIMARY KEY (`idbiglietto`);

--
-- Indici per le tabelle `profilo`
--
ALTER TABLE `profilo`
  ADD PRIMARY KEY (`idutente`);

--
-- Indici per le tabelle `proiezione`
--
ALTER TABLE `proiezione`
  ADD PRIMARY KEY (`idproiezione`);

--
-- Indici per le tabelle `registrazione`
--
ALTER TABLE `registrazione`
  ADD PRIMARY KEY (`idutente`);

--
-- Indici per le tabelle `tabella_file`
--
ALTER TABLE `tabella_file`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT per le tabelle scaricate
--

--
-- AUTO_INCREMENT per la tabella `biglietto`
--
ALTER TABLE `biglietto`
  MODIFY `idbiglietto` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT per la tabella `profilo`
--
ALTER TABLE `profilo`
  MODIFY `idutente` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT per la tabella `proiezione`
--
ALTER TABLE `proiezione`
  MODIFY `idproiezione` int(30) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT per la tabella `registrazione`
--
ALTER TABLE `registrazione`
  MODIFY `idutente` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT per la tabella `tabella_file`
--
ALTER TABLE `tabella_file`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
