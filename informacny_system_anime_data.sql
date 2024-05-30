-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Hostiteľ: 127.0.0.1
-- Čas generovania: Št 30.Máj 2024, 18:10
-- Verzia serveru: 10.4.25-MariaDB
-- Verzia PHP: 8.1.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Databáza: `informacny_system_anime`
--

-- --------------------------------------------------------

--
-- Štruktúra tabuľky pre tabuľku `dodavatelia`
--

CREATE TABLE `dodavatelia` (
  `ID` int(11) NOT NULL,
  `meno` varchar(15) NOT NULL,
  `priezvisko` varchar(30) NOT NULL,
  `email` varchar(100) NOT NULL,
  `heslo` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Sťahujem dáta pre tabuľku `dodavatelia`
--

INSERT INTO `dodavatelia` (`ID`, `meno`, `priezvisko`, `email`, `heslo`) VALUES
(1, 'Marek', 'Stefan', 'stefanko@mail.com', 'marek123'),
(8, 'Štefan', 'Zápotočný', 'mail@mail.com', '12345');

-- --------------------------------------------------------

--
-- Štruktúra tabuľky pre tabuľku `kategorie`
--

CREATE TABLE `kategorie` (
  `ID` int(11) NOT NULL,
  `nazov` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Sťahujem dáta pre tabuľku `kategorie`
--

INSERT INTO `kategorie` (`ID`, `nazov`) VALUES
(1, 'Príslušenstvo'),
(2, 'Manga'),
(3, 'Oblečenie');

-- --------------------------------------------------------

--
-- Štruktúra tabuľky pre tabuľku `objednavky`
--

CREATE TABLE `objednavky` (
  `ID` int(11) NOT NULL,
  `dodavatelID` int(11) DEFAULT NULL,
  `produktID` int(11) DEFAULT NULL,
  `stav` varchar(15) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Sťahujem dáta pre tabuľku `objednavky`
--

INSERT INTO `objednavky` (`ID`, `dodavatelID`, `produktID`, `stav`) VALUES
(6, 8, 8, 'doručené'),
(14, 8, 16, 'doručené'),
(24, 8, 26, 'doručuje sa');

-- --------------------------------------------------------

--
-- Štruktúra tabuľky pre tabuľku `produkty`
--

CREATE TABLE `produkty` (
  `ID` int(11) NOT NULL,
  `kategoriaID` int(11) DEFAULT NULL,
  `nazov` varchar(20) DEFAULT NULL,
  `popis` text DEFAULT NULL,
  `cena` decimal(4,2) DEFAULT NULL,
  `obrazky` text DEFAULT NULL,
  `pocet_kusov` int(5) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Sťahujem dáta pre tabuľku `produkty`
--

INSERT INTO `produkty` (`ID`, `kategoriaID`, `nazov`, `popis`, `cena`, `obrazky`, `pocet_kusov`) VALUES
(8, 2, 'One Piece Vol. 2', 'As a child, Monkey D. Luffy dreamed of becoming King of the Pirates. But his life changed when he accidentally gained the power to stretch like rubber...at the cost of never being able to swim again! Years, later, Luffy sets off in search of the \"One Piece,\" said to be the greatest treasure in the world... As a kid, Monkey D. Luffy vowed to become King of the Pirates and find the legendary treasure called the \"One Piece.\" The enchanted Gum-Gum Fruit has given Luffy the power to stretch like rubber - and his new crewmate, the infamous pirate hunter Roronoa Zolo, strikes fear into the hearts of other buccaneers! But what chance does one rubber guy stand against Nami, a thief so tough she specializes in robbing pirates...or Captain Buggy, a fiendish pirate lord whose weird, clownish appearance conceals even weirder powers?', '25.00', 'img/one_piece_vol_2.png', 51),
(16, 2, 'One Piece Vol. 1', 'fsagas', '12.00', 'img/one_piece_vol_1.png', 214),
(26, 2, 'Vagabond Vol. 1', 'Epická samurajská manga sága Vagabond v luxusnom vydaní s bonusovým obsahom! Spoznajte cestu Miyamota Musashiho od divokého mladíka k osvietenému samurajovi.', '19.99', 'img/vagabond_vol1.png', 35);

--
-- Kľúče pre exportované tabuľky
--

--
-- Indexy pre tabuľku `dodavatelia`
--
ALTER TABLE `dodavatelia`
  ADD PRIMARY KEY (`ID`);

--
-- Indexy pre tabuľku `kategorie`
--
ALTER TABLE `kategorie`
  ADD PRIMARY KEY (`ID`);

--
-- Indexy pre tabuľku `objednavky`
--
ALTER TABLE `objednavky`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `dodavatelID` (`dodavatelID`),
  ADD KEY `produktID` (`produktID`);

--
-- Indexy pre tabuľku `produkty`
--
ALTER TABLE `produkty`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `kategoriaID` (`kategoriaID`);

--
-- AUTO_INCREMENT pre exportované tabuľky
--

--
-- AUTO_INCREMENT pre tabuľku `dodavatelia`
--
ALTER TABLE `dodavatelia`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT pre tabuľku `kategorie`
--
ALTER TABLE `kategorie`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT pre tabuľku `objednavky`
--
ALTER TABLE `objednavky`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT pre tabuľku `produkty`
--
ALTER TABLE `produkty`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- Obmedzenie pre exportované tabuľky
--

--
-- Obmedzenie pre tabuľku `objednavky`
--
ALTER TABLE `objednavky`
  ADD CONSTRAINT `objednavky_ibfk_1` FOREIGN KEY (`dodavatelID`) REFERENCES `dodavatelia` (`ID`);

--
-- Obmedzenie pre tabuľku `produkty`
--
ALTER TABLE `produkty`
  ADD CONSTRAINT `produkty_ibfk_1` FOREIGN KEY (`kategoriaID`) REFERENCES `kategorie` (`ID`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
