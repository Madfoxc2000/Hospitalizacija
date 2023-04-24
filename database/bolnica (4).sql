-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 31, 2022 at 08:41 PM
-- Server version: 10.4.25-MariaDB
-- PHP Version: 8.1.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `bolnica`
--

DELIMITER $$
--
-- Procedures
--
CREATE DEFINER=`root`@`localhost` PROCEDURE `DodajHospitalizaciju` (IN `BrojIstorijebolestiP` VARCHAR(30), IN `NazivZdravstveneUstanoveP` VARCHAR(30), IN `OdeljenjeNaPrijemuP` INT(11), IN `DatumPrijemaP` DATE, IN `UputnaDijagnozaP` VARCHAR(8), IN `PovredaP` TINYINT(1), IN `SpoljniUzrokPovredeP` INT(11), IN `OsnovniUzrokHospitalizacijeP` VARCHAR(8), IN `PrateceDijagnozeP` VARCHAR(30), IN `SifraProcedurePoNomenklaturiP` VARCHAR(30), IN `TezinaNaPrijemuP` INT(11), IN `BrojSatiVentilatornePodrskeP` INT(11), IN `DatumOtpustaP` DATE, IN `BrojDanaHospitalizacijeP` INT(11), IN `OdeljenjeSaKojegJeOtpustIzvrsenP` INT(11), IN `VrstaOtpustaP` INT(11), IN `ObdukovanP` TINYINT(1), IN `OsnovniUzrokSmrtiP` VARCHAR(8), IN `MaloletanP` TINYINT(1))   BEGIN
INSERT INTO `hospitalizacija` (`BrojIstorijeBolesti`, `NazivZdravstveneUstanove`, `OdeljenjeNaPrijemu`, `DatumPrijema`, `UputnaDijagnoza`, `Povreda`, `SpoljniUzrokPovrede`,`OsnovniUzrokHospitalizacije`, `PrateceDijagnoze`, `SifraProcedurePoNomenklaturi`, `TezinaNaPrijemu`, `BrojSatiVentilatornePodrske`, `DatumOtpusta`, `BrojDanaHospitalizacije`, `OdeljenjeSaKojegJeOtpustIzvrsen`, `VrstaOtpusta`, `Obdukovan`, `OsnovniUzrokSmrti`, `Maloletan`) VALUES (BrojIstorijeBolestiP, NazivZdravstveneUstanoveP, OdeljenjeNaPrijemuP, DatumPrijemaP, UputnaDijagnozaP, PovredaP, SpoljniUzrokPovredeP, OsnovniUzrokHospitalizacijeP, PrateceDijagnozeP, SifraProcedurePoNomenklaturiP, TezinaNaPrijemuP, BrojSatiVentilatornePodrskeP, DatumOtpustaP, BrojDanaHospitalizacijeP, OdeljenjeSaKojegJeOtpustIzvrsenP, VrstaOtpustaP, ObdukovanP, OsnovniUzrokSmrtiP, MaloletanP);
END$$

DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `hospitalizacija`
--

CREATE TABLE `hospitalizacija` (
  `ID` bigint(11) NOT NULL,
  `BrojIstorijebolesti` varchar(30) NOT NULL,
  `NazivZdravstveneUstanove` varchar(30) NOT NULL,
  `OdeljenjeNaPrijemu` varchar(10) NOT NULL,
  `DatumPrijema` date NOT NULL,
  `UputnaDijagnoza` varchar(8) NOT NULL,
  `Povreda` tinyint(1) NOT NULL,
  `SpoljniUzrokPovrede` int(11) DEFAULT NULL,
  `OsnovniUzrokHospitalizacije` varchar(8) NOT NULL,
  `PrateceDijagnoze` varchar(30) DEFAULT NULL,
  `SifraProcedurePoNomenklaturi` varchar(30) NOT NULL,
  `TezinaNaPrijemu` int(11) DEFAULT NULL,
  `BrojSatiVentilatornePodrske` int(11) DEFAULT NULL,
  `DatumOtpusta` date NOT NULL,
  `BrojDanaHospitalizacije` int(11) NOT NULL,
  `OdeljenjeSaKojegJeOtpustIzvrsen` varchar(10) NOT NULL,
  `VrstaOtpusta` int(11) NOT NULL,
  `Obdukovan` tinyint(1) NOT NULL,
  `OsnovniUzrokSmrti` varchar(8) DEFAULT NULL,
  `Maloletan` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `hospitalizacija`
--

INSERT INTO `hospitalizacija` (`ID`, `BrojIstorijebolesti`, `NazivZdravstveneUstanove`, `OdeljenjeNaPrijemu`, `DatumPrijema`, `UputnaDijagnoza`, `Povreda`, `SpoljniUzrokPovrede`, `OsnovniUzrokHospitalizacije`, `PrateceDijagnoze`, `SifraProcedurePoNomenklaturi`, `TezinaNaPrijemu`, `BrojSatiVentilatornePodrske`, `DatumOtpusta`, `BrojDanaHospitalizacije`, `OdeljenjeSaKojegJeOtpustIzvrsen`, `VrstaOtpusta`, `Obdukovan`, `OsnovniUzrokSmrti`, `Maloletan`) VALUES
(27, 'Ф3320', 'Клинички Центар Војводине', '1-1', '2012-10-10', ' I00 I99', 2, 0, ' N00 N99', '', 'СФ320', 0, 0, '2012-11-10', 1, '1-1', 1, 0, '', 1),
(28, 'С3202', 'Клинички Центар Војводине', '1-1', '2012-10-10', ' I00 I99', 0, 1, 'L00 L99', '', 'СФ320', 0, 0, '2022-11-10', 30, '1-1', 1, 0, '', 1),
(29, 'ГЈ432', 'Клинички Центар Војводине', '1-1', '2012-10-10', ' I00 I99', 0, 1, 'L00 L99', '', 'СФ320', 0, 0, '2022-11-10', 30, '1-1', 1, 0, '', 0),
(35, 'С3202', 'Клинички Центар Војводине', '1', '2012-10-10', ' Q00 Q99', 1, 0, 'A00 B99', '', 'А320', 0, 0, '2012-11-10', 30, '1', 1, 0, '', 1);

-- --------------------------------------------------------

--
-- Table structure for table `mkb`
--

CREATE TABLE `mkb` (
  `Sifra` varchar(8) NOT NULL,
  `Naziv` varchar(80) CHARACTER SET utf8mb4 NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `mkb`
--

INSERT INTO `mkb` (`Sifra`, `Naziv`) VALUES
(' I00 I99', 'Болести система крвотока'),
(' K00 K93', 'Болести система за варење'),
(' N00 N99', 'Болести мокраћно – полног система'),
(' Q00 Q99', 'Урођене малформације, деформације и хромозомске ненормалности'),
('A00 B99', 'Заразне и паразитарне болести'),
('C00 D48', 'Тумори'),
('D50 D89', 'Болести крви и крвотворних органа као и поремећаји имунитета'),
('E00 E90', 'Болести жлезда са унутрашњим лучењем, исхране и метаболизма'),
('F00 F99', 'Duševni poremećaji i poremećaji ponašanja'),
('G00 G99', 'Болести нервног система'),
('H00 H59', 'Болести ока и припојака ока'),
('H60 H95', 'Болести ува и мастоидног наставка'),
('J00 J99', 'Болести система за дисање'),
('L00 L99', 'Болести коже и поткожног ткива'),
('M00 M94', 'Болести мишићно-коштаног система и везивног ткива'),
('O00 O99', 'Трудноћа, рађање и бабиње'),
('P00 P96', 'Болести перинаталног периода'),
('R00 R99', 'Симптоми, знаци и патолошки клинички и лабораторијски налази, некласификовани на'),
('S00 T98', 'Повреде, тровања и остале последице спољашњих узрока'),
('V01 Y98', 'Спољашњи узроци оболевања и умирања'),
('Z00 Z99', 'Фактори који утичу на стање здравља и контакт са здравственом службом');

-- --------------------------------------------------------

--
-- Table structure for table `odeljenje`
--

CREATE TABLE `odeljenje` (
  `Oznaka` varchar(10) NOT NULL,
  `Naziv` varchar(80) NOT NULL,
  `UkupanBrojPacijenata` bigint(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `odeljenje`
--

INSERT INTO `odeljenje` (`Oznaka`, `Naziv`, `UkupanBrojPacijenata`) VALUES
('1-1', 'Служба интерне медицине', 19),
('1-2', 'Служба за плућне болести са продуженим лечењем и негом', 10);

-- --------------------------------------------------------

--
-- Table structure for table `osnov_osiguranja`
--

CREATE TABLE `osnov_osiguranja` (
  `ID` tinyint(4) NOT NULL,
  `Naziv` varchar(80) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `osnov_osiguranja`
--

INSERT INTO `osnov_osiguranja` (`ID`, `Naziv`) VALUES
(1, 'радни однос'),
(2, 'основ изједначен са радним односом '),
(3, 'запослење у иностранству '),
(4, 'обављање привремених и повремених послова '),
(5, 'обављање послова по основу уговора'),
(6, 'остваривање новчане накнаде према прописима о раду и запошљавању'),
(7, 'обављање самосталне делатности'),
(8, 'обављање пољопривредне делатности'),
(9, 'коришћење пензије'),
(10, 'обављање послова по основу посебних уговора о размени стручњака'),
(11, 'школовање или стручно усавршавање'),
(12, 'осигурање у смислу закона којим се уређује здравствено осигурање'),
(13, 'осигурање-за лица којима је утврђен статус избеглог лица'),
(14, 'повреда на раду или професионална болест');

-- --------------------------------------------------------

--
-- Table structure for table `pacijent`
--

CREATE TABLE `pacijent` (
  `BrojIstorijebolesti` varchar(30) CHARACTER SET utf8 NOT NULL,
  `JMBG` varchar(13) NOT NULL,
  `ImeJednogRoditelja` varchar(30) NOT NULL,
  `LBO` bigint(20) NOT NULL,
  `OsnovOsiguranja` tinyint(4) NOT NULL,
  `ClanJePorodice` varchar(30) NOT NULL,
  `Ime` varchar(30) NOT NULL,
  `Prezime` varchar(30) NOT NULL,
  `Telefon` varchar(30) NOT NULL,
  `DatumRodjenja` date NOT NULL,
  `Odeljenje` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `pacijent`
--

INSERT INTO `pacijent` (`BrojIstorijebolesti`, `JMBG`, `ImeJednogRoditelja`, `LBO`, `OsnovOsiguranja`, `ClanJePorodice`, `Ime`, `Prezime`, `Telefon`, `DatumRodjenja`, `Odeljenje`) VALUES
('ГЈ432', '333456789123', 'Бранко', 12345612666, 3, 'Бранко Петровић', 'Синиша', 'Петровић', '0623456333', '1998-12-16', '1-1'),
('С3202', '123456789123', 'Славко', 12345612345, 2, 'Славко Марковић', 'Милош', 'Марковић', '0623456321', '2006-12-16', '1-1'),
('Ф3320', '123456789121', 'Стева', 12345612341, 1, 'Стева Савић', 'Марко', 'Савић', '0634456321', '2006-12-09', '1-1');

-- --------------------------------------------------------

--
-- Stand-in structure for view `pacijentpogled`
-- (See below for the actual view)
--
CREATE TABLE `pacijentpogled` (
`BrojIstorijebolesti` varchar(30)
,`OsnovniUzrokHospitalizacije` varchar(8)
,`BrojDanaHospitalizacije` int(11)
,`Ime` varchar(30)
,`Prezime` varchar(30)
);

-- --------------------------------------------------------

--
-- Table structure for table `zaposleni`
--

CREATE TABLE `zaposleni` (
  `IDZaposlenog` int(11) NOT NULL,
  `PREZIME` varchar(50) NOT NULL,
  `IME` varchar(40) NOT NULL,
  `ULOGA` varchar(30) NOT NULL,
  `SPECIJALIZACIJA` varchar(10) DEFAULT NULL,
  `Telefon` varchar(30) NOT NULL,
  `EMAIL` varchar(60) NOT NULL,
  `KORISNICKOIME` varchar(30) NOT NULL,
  `SIFRA` varchar(30) NOT NULL,
  `URLSLike` varchar(250) DEFAULT NULL,
  `statusucesca` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `zaposleni`
--

INSERT INTO `zaposleni` (`IDZaposlenog`, `PREZIME`, `IME`, `ULOGA`, `SPECIJALIZACIJA`, `Telefon`, `EMAIL`, `KORISNICKOIME`, `SIFRA`, `URLSLike`, `statusucesca`) VALUES
(1, 'Арбановски', 'Страхиња', 'Доктор', '91121', '0623456321', 'strahinja@gmail.com', 'страхиња', '123', NULL, 'Администратор'),
(2, 'Марковић', 'Марко', 'Доктор', '91121', '0634456321', 'marko@gmail.com', 'марко', '123', NULL, 'Корисник');

-- --------------------------------------------------------

--
-- Structure for view `pacijentpogled`
--
DROP TABLE IF EXISTS `pacijentpogled`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `pacijentpogled`  AS SELECT `hospitalizacija`.`BrojIstorijebolesti` AS `BrojIstorijebolesti`, `hospitalizacija`.`OsnovniUzrokHospitalizacije` AS `OsnovniUzrokHospitalizacije`, `hospitalizacija`.`BrojDanaHospitalizacije` AS `BrojDanaHospitalizacije`, `pacijent`.`Ime` AS `Ime`, `pacijent`.`Prezime` AS `Prezime` FROM (`hospitalizacija` join `pacijent` on(`hospitalizacija`.`BrojIstorijebolesti` = `pacijent`.`BrojIstorijebolesti`))  ;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `hospitalizacija`
--
ALTER TABLE `hospitalizacija`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `BrojIstorijebolesti` (`BrojIstorijebolesti`),
  ADD KEY `UputnaDijagnoza` (`UputnaDijagnoza`),
  ADD KEY `OsnovniUzrokHospitalizacije` (`OsnovniUzrokHospitalizacije`),
  ADD KEY `OsnovniUzrokSmrti` (`OsnovniUzrokSmrti`);

--
-- Indexes for table `mkb`
--
ALTER TABLE `mkb`
  ADD PRIMARY KEY (`Sifra`);

--
-- Indexes for table `odeljenje`
--
ALTER TABLE `odeljenje`
  ADD PRIMARY KEY (`Oznaka`);

--
-- Indexes for table `osnov_osiguranja`
--
ALTER TABLE `osnov_osiguranja`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `pacijent`
--
ALTER TABLE `pacijent`
  ADD PRIMARY KEY (`BrojIstorijebolesti`),
  ADD KEY `Osnov osiguranja` (`OsnovOsiguranja`);

--
-- Indexes for table `zaposleni`
--
ALTER TABLE `zaposleni`
  ADD PRIMARY KEY (`IDZaposlenog`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `hospitalizacija`
--
ALTER TABLE `hospitalizacija`
  MODIFY `ID` bigint(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=36;

--
-- AUTO_INCREMENT for table `zaposleni`
--
ALTER TABLE `zaposleni`
  MODIFY `IDZaposlenog` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `hospitalizacija`
--
ALTER TABLE `hospitalizacija`
  ADD CONSTRAINT `fk_dijagnoza` FOREIGN KEY (`UputnaDijagnoza`) REFERENCES `mkb` (`Sifra`) ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_istorija` FOREIGN KEY (`BrojIstorijebolesti`) REFERENCES `pacijent` (`BrojIstorijebolesti`) ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_uzrok_hospitalizacije` FOREIGN KEY (`OsnovniUzrokHospitalizacije`) REFERENCES `mkb` (`Sifra`) ON UPDATE CASCADE;

--
-- Constraints for table `pacijent`
--
ALTER TABLE `pacijent`
  ADD CONSTRAINT `fk_osnov` FOREIGN KEY (`OsnovOsiguranja`) REFERENCES `osnov_osiguranja` (`ID`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
