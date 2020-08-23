-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Creato il: Ago 20, 2020 alle 23:05
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
('[{\"occupato\":false,\"fila\":8,\"numero\":13}] {\"film\":\"Madagascar\",\"sala\":\"sala_rossa\",\"giorno\":\"2020-08-31\",\"orario\":\"00:00:00\",\"tipo\":\"2\",\"idproiezione\":\"1\"}', '4', 1),
('[{\"occupato\":false,\"fila\":8,\"numero\":9},{\"occupato\":false,\"fila\":9,\"numero\":9}] {\"film\":\"Madagascar\",\"sala\":\"sala_rossa\",\"giorno\":\"2020-08-31\",\"orario\":\"00:00:00\",\"tipo\":\"2\",\"idproiezione\":\"1\"}', '4', 2),
('[{\"occupato\":false,\"fila\":1,\"numero\":3}] {\"film\":\"Madagascar\",\"sala\":\"sala_rossa\",\"giorno\":\"2020-08-31\",\"orario\":\"00:00:00\",\"tipo\":\"2\",\"idproiezione\":\"1\"}', '4', 3),
('[{\"occupato\":false,\"fila\":5,\"numero\":8},{\"occupato\":false,\"fila\":6,\"numero\":8}] {\"film\":\"titanic\",\"sala\":\"sala_rossa\",\"giorno\":\"2020-09-26\",\"orario\":\"20:00:00\",\"tipo\":\"3\",\"idproiezione\":\"3\",\"imgspettacolo\":\"assets/3d.jpg\"}', '4', 4),
('[{\"occupato\":false,\"fila\":3,\"numero\":5}] {\"film\":\"Madagascar\",\"sala\":\"sala_rossa\",\"giorno\":\"2020-08-31\",\"orario\":\"00:00:00\",\"tipo\":\"2\",\"idproiezione\":\"1\",\"imgspettacolo\":\"assets/2d.png\"}', '12', 5),
('[{\"occupato\":false,\"fila\":9,\"numero\":14}] {\"film\":\"titanic\",\"sala\":\"sala_rossa\",\"giorno\":\"2020-09-26\",\"orario\":\"20:00:00\",\"tipo\":\"3\",\"idproiezione\":\"3\",\"imgspettacolo\":\"assets/3d.jpg\"}', '12', 6),
('[{\"occupato\":false,\"fila\":1,\"numero\":1}] {\"film\":\"titanic\",\"sala\":\"sala_rossa\",\"giorno\":\"2020-09-26\",\"orario\":\"20:00:00\",\"tipo\":\"3\",\"idproiezione\":\"3\",\"imgspettacolo\":\"assets/3d.jpg\"}', '4', 7),
('[{\"occupato\":false,\"fila\":8,\"numero\":2}] {\"film\":\"Madagascar\",\"sala\":\"sala_rossa\",\"giorno\":\"2020-08-31\",\"orario\":\"00:00:00\",\"tipo\":\"2\",\"idproiezione\":\"1\",\"imgspettacolo\":\"assets/2d.png\"}', '4', 8);

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
  `trama` text NOT NULL,
  `imagepath` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dump dei dati per la tabella `film`
--

INSERT INTO `film` (`titolo`, `regista`, `anno`, `durata`, `a_generi`, `a_cast`, `casaproduzione`, `trama`, `imagepath`) VALUES
('Flashdance', 'Adrian Line', 1983, 135, 'romantico,ballo', 'Jennifer Beals,Micheal Nouri', 'PolyGram Pictures', 'La stupenda diciottenne Alex lavora come saldatrice in una grande officina di Pittsburgh, in Pennsylvania, e arrotonda il salario ballando la sera in un locale notturno. Il suo sogno Ã¨ diventare danzatrice professionista', 'assets/flashdance.jpg'),
('le pagine della nostra vita', 'Nicholas Spaks', 2006, 120, 'Romantico, Drammatico', 'Ryan Gosgling', 'Universal', 'In una casa di riposo un uomo racconta ad una donna la storia di un grande amore tra due giovani nella North Carolina degli anni quaranta.', 'assets/thenotebook.jpg'),
('Madagascar', 'Mario Rossi', 2008, 120, 'Commedia, Animazione', 'I pinguini ', 'DreamWorks', 'Una zebra in uno zoo, stanca della vita in cattività, decide di scappare, sfruttando un\'ingegnosa idea di un gruppo di pinguini. Quando i suoi amici si accorgono della sua scomparsa, decidono di andarlo a cercare per riportarlo indietro.', 'assets/Madagascar.jpg'),
('titanic', 'qualcuno', 1998, 200, 'drammatico, romantico', 'leonardo di caprio', 'dreamworks', 'Il transatlantico Titanic, considerato un gioiello tecnologico ed il più lussuoso piroscafo da crociera mai realizzato, salpa dall\'Inghilterra il dieci aprile del 1912 con oltre 1500 passeggeri a bordo per il suo viaggio inaugurale. I viaggiatori sono collocati in tre classi, riflesso delle differenze sociali.', 'assets/titanic.jpg'),
('Wolf of Wall Street', 'Martin Scorsese', 2013, 180, 'commedia,biografico', 'Leonardo Di caprio,Margot Robbie', 'Appian Way Productions', 'New York, anni 80. Eccessi e corruzione segnano la curva discendente della brillante carriera di Jordan Belfort, un ambizioso broker in grado di guadagnare migliaia di dollari al minuto e di spenderne altrettanti in droga e futilitÃ .', 'assets/thewolfof.jpg');

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
('8', 13, 1, '1'),
('9', 9, 1, '1'),
('8', 9, 1, '1'),
('1', 3, 1, '1'),
('6', 8, 1, '3'),
('5', 8, 1, '3'),
('3', 5, 1, '1'),
('9', 14, 1, '3'),
('1', 1, 1, '3'),
('8', 2, 1, '1');

-- --------------------------------------------------------

--
-- Struttura della tabella `profilo`
--

CREATE TABLE `profilo` (
  `idutente` int(11) NOT NULL,
  `nome` text NOT NULL,
  `cognome` text NOT NULL,
  `indirizzo` text NOT NULL,
  `datadinascita` text NOT NULL,
  `citta` text NOT NULL,
  `telefono` text NOT NULL,
  `a_listasconti` text NOT NULL,
  `imagepath` text NOT NULL,
  `configurato` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dump dei dati per la tabella `profilo`
--

INSERT INTO `profilo` (`idutente`, `nome`, `cognome`, `indirizzo`, `datadinascita`, `citta`, `telefono`, `a_listasconti`, `imagepath`, `configurato`) VALUES
(4, 'Teresa', 'Bove', 'Via Bologna 3', '26-08-1995', 'Luco dei Marsi', '3278385503', '', 'assets/me.jpg', 1),
(12, 'Adriano', 'Curti', 'Via Ugo Foscolo 13', '20-10-1996', 'Celano (AQ)', '3289654123', '', '', 1),
(13, 'Mario', 'Rossi', 'Via Roma, 1', '01-01-1990', 'Milano', '021010101010', '', '', 1);

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
  `idproiezione` int(30) NOT NULL,
  `imgspettacolo` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dump dei dati per la tabella `proiezione`
--

INSERT INTO `proiezione` (`film`, `sala`, `giorno`, `orario`, `tipo`, `idproiezione`, `imgspettacolo`) VALUES
('Madagascar', 'sala_rossa', '2020-08-31', '00:00:00', '2', 1, 'assets/2d.png'),
('titanic', 'sala_rossa', '2020-09-26', '20:00:00', '3', 3, 'assets/3d.jpg');

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
('26081995', 'teresa.4us@gmail.com', 4),
('20101996', 'adrianoc@gmail.com', 12),
('provaprova', 'prova@gmail.com', 13);

-- --------------------------------------------------------

--
-- Struttura della tabella `sala`
--

CREATE TABLE `sala` (
  `numeroposti` int(3) NOT NULL,
  `nomeschema` char(20) NOT NULL,
  `nomesala` char(20) NOT NULL,
  `numerofile` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dump dei dati per la tabella `sala`
--

INSERT INTO `sala` (`numeroposti`, `nomeschema`, `nomesala`, `numerofile`) VALUES
(200, 'schema_sala_blu', 'sala_blu', 10),
(100, 'schema_sala_gialla', 'sala_gialla', 10),
(150, 'schema_sala_rossa', 'Sala_rossa', 10);

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

--
-- Indici per le tabelle scaricate
--

--
-- Indici per le tabelle `biglietto`
--
ALTER TABLE `biglietto`
  ADD PRIMARY KEY (`idbiglietto`);

--
-- Indici per le tabelle `film`
--
ALTER TABLE `film`
  ADD PRIMARY KEY (`titolo`);

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
-- Indici per le tabelle `sala`
--
ALTER TABLE `sala`
  ADD PRIMARY KEY (`nomesala`);

--
-- AUTO_INCREMENT per le tabelle scaricate
--

--
-- AUTO_INCREMENT per la tabella `biglietto`
--
ALTER TABLE `biglietto`
  MODIFY `idbiglietto` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT per la tabella `profilo`
--
ALTER TABLE `profilo`
  MODIFY `idutente` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT per la tabella `proiezione`
--
ALTER TABLE `proiezione`
  MODIFY `idproiezione` int(30) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT per la tabella `registrazione`
--
ALTER TABLE `registrazione`
  MODIFY `idutente` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
