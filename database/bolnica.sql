-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 28, 2026 at 12:08 AM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

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
CREATE DEFINER=`root`@`localhost` PROCEDURE `Izvestaj` (IN `HospitalizacijaIDP` BIGINT)   BEGIN
    SELECT
        h.IDPrijema,                            -- 0
        h.OsnovniUzrokHospitalizacije,          -- 1
        h.PrateceDijagnoze,                     -- 2
        h.BrojSatiVentilatornePodrske,          -- 3
        h.DatumOtpusta,                         -- 4
        h.BrojDanaHospitalizacije,              -- 5
        h.OdeljenjeSaKojegJeOtpustIzvrsen,     -- 6
        od_otpust.Naziv,                        -- 7
        h.VrstaOtpusta,                         -- 8
        vo.Naziv,                               -- 9
        h.Obdukovan,                            -- 10
        h.OsnovniUzrokSmrti,                    -- 11
        pac.BrojIstorijebolesti,                -- 12
        pac.JMBG,                               -- 13
        pac.DatumRodjenja,                      -- 14
        pac.Drzavljanstvo,                      -- 15
        pac.Pol,                                -- 16
        pac.Adresa,                             -- 17
        pac.OsnovOsiguranja,                    -- 18
        oo.Naziv,                               -- 19
        pac.LBO,                                -- 20
        pr.OdeljenjeNaprijemu,                  -- 21
        od_prijem.Naziv,                        -- 22
        pac.Ime,                                -- 23
        pac.Prezime,                            -- 24
        pr.UputnaDijagnoza,                     -- 25
        pr.TezinaNaPrijemu,                     -- 26
        pr.DatumPrijema,                        -- 27
        pr.Povreda,                             -- 28
        pr.SpoljniUzrokPovrede                  -- 29
    FROM hospitalizacija h
    JOIN prijem pr ON pr.ID = h.IDPrijema
    JOIN pacijent pac ON pac.BrojIstorijebolesti = pr.BrojIstorijeBolesti
    LEFT JOIN odeljenje od_otpust ON od_otpust.Oznaka = h.OdeljenjeSaKojegJeOtpustIzvrsen
    LEFT JOIN vrsta_otpusta vo ON vo.Sifra = h.VrstaOtpusta
    LEFT JOIN osnov_osiguranja oo ON oo.ID = pac.OsnovOsiguranja
    LEFT JOIN odeljenje od_prijem ON od_prijem.Oznaka = pr.OdeljenjeNaprijemu
    WHERE h.ID = HospitalizacijaIDP;
END$$

DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `aktivnosthospitalizacije`
--

CREATE TABLE `aktivnosthospitalizacije` (
  `ID` bigint(20) NOT NULL,
  `PrijemID` bigint(20) NOT NULL,
  `TipAktivnostiID` varchar(8) NOT NULL,
  `Datum` date NOT NULL,
  `Opis` varchar(200) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `aktivnosthospitalizacije`
--

INSERT INTO `aktivnosthospitalizacije` (`ID`, `PrijemID`, `TipAktivnostiID`, `Datum`, `Opis`) VALUES
(58, 44, '39015-02', '2023-09-13', ''),
(62, 49, '39006-00', '2026-05-11', ' zxc'),
(63, 50, '39015-00', '2026-05-03', 'zxcxzc'),
(64, 49, '32132-00', '2026-05-07', 'fsfssfd'),
(65, 49, '39015-01', '2026-05-11', 'Something'),
(66, 49, '39006-00', '2026-05-13', 'asddsa'),
(67, 51, '39009-00', '2026-05-15', '  dvc'),
(68, 51, '39003-00', '2026-05-12', 'cxzc'),
(69, 52, '39009-00', '2026-05-12', 'mmmm'),
(70, 53, '39003-00', '2026-05-12', 'Neki opis');

-- --------------------------------------------------------

--
-- Table structure for table `hospitalizacija`
--

CREATE TABLE `hospitalizacija` (
  `ID` bigint(20) NOT NULL,
  `IDPrijema` bigint(20) NOT NULL,
  `OsnovniUzrokHospitalizacije` varchar(8) NOT NULL,
  `PrateceDijagnoze` varchar(30) DEFAULT NULL,
  `BrojSatiVentilatornePodrske` int(11) DEFAULT NULL,
  `DatumOtpusta` date NOT NULL,
  `BrojDanaHospitalizacije` int(11) NOT NULL,
  `OdeljenjeSaKojegJeOtpustIzvrsen` varchar(10) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `VrstaOtpusta` int(2) NOT NULL,
  `Obdukovan` varchar(3) DEFAULT NULL,
  `OsnovniUzrokSmrti` varchar(8) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `hospitalizacija`
--

INSERT INTO `hospitalizacija` (`ID`, `IDPrijema`, `OsnovniUzrokHospitalizacije`, `PrateceDijagnoze`, `BrojSatiVentilatornePodrske`, `DatumOtpusta`, `BrojDanaHospitalizacije`, `OdeljenjeSaKojegJeOtpustIzvrsen`, `VrstaOtpusta`, `Obdukovan`, `OsnovniUzrokSmrti`) VALUES
(45, 43, 'I00 I99', '', 12, '2023-09-14', 1, '1-3', 1, '', 'A00 B99'),
(46, 44, 'S00 T98', 'L00 L99', 12, '2023-09-22', 8, '2-1', 6, 'Не', 'S00 T98'),
(47, 45, 'S00 T98', NULL, NULL, '2023-09-28', 27, '2-1', 6, NULL, 'S00 T98'),
(51, 49, 'C00 D48', 'ZX', 10, '2026-05-22', 987, '1-1', 2, NULL, NULL),
(52, 51, 'C00 D48', 'L00 L99', 12, '2026-05-14', 5, '1-1', 1, NULL, NULL),
(53, 52, 'E00 E90', 'L00 L99', 12, '2026-05-12', 5, '1-2', 6, 'Да', NULL),
(54, 50, 'C00 D48', 'L00 L99', 10, '2026-05-08', 12, '1-1', 1, NULL, NULL),
(55, 53, 'C00 D48', 'L00 L99', 1, '2026-05-20', 8, '1-2', 1, NULL, NULL);

-- --------------------------------------------------------

--
-- Stand-in structure for view `hospitalizacijapogled`
-- (See below for the actual view)
--
CREATE TABLE `hospitalizacijapogled` (
`BrojIstorijebolesti` varchar(30)
,`DatumPrijema` date
,`DatumOtpusta` date
,`OsnovniUzrokHospitalizacije` varchar(8)
);

-- --------------------------------------------------------

--
-- Stand-in structure for view `hospitalizacijaradnipogled`
-- (See below for the actual view)
--
CREATE TABLE `hospitalizacijaradnipogled` (
`BrojIstorijebolesti` varchar(30)
,`DatumPrijema` date
,`DatumOtpusta` date
,`OsnovniUzrokHospitalizacije` varchar(8)
,`ID` bigint(20)
);

-- --------------------------------------------------------

--
-- Table structure for table `mkb`
--

CREATE TABLE `mkb` (
  `Sifra` varchar(8) NOT NULL,
  `Naziv` varchar(80) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `mkb`
--

INSERT INTO `mkb` (`Sifra`, `Naziv`) VALUES
('A00 B99', 'Заразне и паразитарне болести'),
('C00 D48', 'Тумори'),
('D50 D89', 'Болести крви и крвотворних органа као и поремећаји имунитета'),
('E00 E90', 'Болести жлезда са унутрашњим лучењем, исхране и метаболизма'),
('F00 F99', 'Duševni poremećaji i poremećaji ponašanja'),
('G00 G99', 'Болести нервног система'),
('H00 H59', 'Болести ока и припојака ока'),
('H60 H95', 'Болести ува и мастоидног наставка'),
('I00 I99', 'Болести система крвотока'),
('J00 J99', 'Болести система за дисање'),
('K00 K93', 'Болести система за варење'),
('L00 L99', 'Болести коже и поткожног ткива'),
('M00 M94', 'Болести мишићно-коштаног система и везивног ткива'),
('N00 N99', 'Болести мокраћно – полног система'),
('O00 O99', 'Трудноћа, рађање и бабиње'),
('P00 P96', 'Болести перинаталног периода'),
('Q00 Q99', 'Урођене малформације, деформације и хромозомске ненормалности'),
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
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `odeljenje`
--

INSERT INTO `odeljenje` (`Oznaka`, `Naziv`, `UkupanBrojPacijenata`) VALUES
('1-1', 'Служба интерне медицине', 28),
('1-2', 'Служба за плућне болести са продуженим лечењем и негом', 13),
('1-3', 'Служба педијатрије', 0),
('1-4', 'Служба за неурологију и психијатрију', 0),
('2-1', 'Служба опште хирургије', 0),
('2-2', 'Служба за гинекологију и акушерство', 0);

-- --------------------------------------------------------

--
-- Table structure for table `osnov_osiguranja`
--

CREATE TABLE `osnov_osiguranja` (
  `ID` tinyint(4) NOT NULL,
  `Naziv` varchar(80) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

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
  `BrojIstorijebolesti` varchar(30) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `JMBG` varchar(13) NOT NULL,
  `ImeJednogRoditelja` varchar(30) NOT NULL,
  `LBO` bigint(20) NOT NULL,
  `OsnovOsiguranja` tinyint(4) NOT NULL,
  `ClanJePorodice` varchar(30) NOT NULL,
  `Ime` varchar(30) NOT NULL,
  `Prezime` varchar(30) NOT NULL,
  `Telefon` varchar(30) NOT NULL,
  `DatumRodjenja` date NOT NULL,
  `Drzavljanstvo` varchar(30) DEFAULT NULL,
  `Pol` varchar(8) DEFAULT NULL,
  `Adresa` varchar(100) DEFAULT NULL,
  `Maloletan` varchar(3) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `pacijent`
--

INSERT INTO `pacijent` (`BrojIstorijebolesti`, `JMBG`, `ImeJednogRoditelja`, `LBO`, `OsnovOsiguranja`, `ClanJePorodice`, `Ime`, `Prezime`, `Telefon`, `DatumRodjenja`, `Drzavljanstvo`, `Pol`, `Adresa`, `Maloletan`) VALUES
('AA111', '1111111111111', 'Југослав', 11111111111, 4, 'Стеве', 'Страхиња', 'Савић', '+381632123111', '2003-01-14', 'Српско', '', 'Гуднулићева 12 Зрењанин', 'Не'),
('AA112', '1111111111112', 'Страхиња', 11111111112, 3, 'Страхиње', 'Марко', 'Марковић', '+381632123122', '1983-12-12', 'Српско', 'Мушко', 'Лазе Костића 12 Зрењанин', 'Не'),
('AA113', '1111111111113', 'Стева', 11111111113, 7, 'Стеве', 'Синиша', 'Марковић', '+381623123122', '1993-12-12', 'Српско', 'Мушко', 'Доситеја Обрадовића Зрењанин', 'Не'),
('AA114', '1111111111114', 'Славиша', 11111111114, 1, 'Славише', 'Милица', 'Станковић', '+381621113122', '2001-12-15', 'Српско', 'Женско', 'Доситеја Обрадовића Зрењанин', 'Не'),
('AA115', '1111111111115', 'Марко', 11111111115, 1, 'Марка', 'Славица', 'Кузманов', '+381621112222', '2012-12-21', 'Српско', 'Женско', 'Доситеја Обрадовића 12 Зрењанин', 'Да'),
('AA116', '1111111111116', 'Здравко', 11111111116, 8, 'Здравка', 'Станко', 'Берић', '+381601112233', '1975-03-12', 'Српско', 'Мушко', 'Горичка 12 Зрењанин', 'Не'),
('AA117', '1111111111117', 'Синиша', 11111111117, 6, 'Синише', 'Никола', 'Бановић', '+381601114433', '1986-03-12', 'Српско', 'Мушко', 'Бранка Ћопића 12 Зрењанин', 'Не'),
('AA118', '1111111111118', 'Бранко', 11111111118, 11, 'Бранка', 'Немања', 'Бранковић', '+3816577114433', '2005-03-12', 'Српско', 'Мушко', 'Бранка Ћопића 12 Зрењанин', 'Да'),
('AA119', '1111111111119', 'Вељко', 11111111118, 11, 'Бранка', 'Снежана', 'Вуковић', '+3816577114433', '2005-03-12', 'Српско', 'Женско', 'Виноградарска 14 Инђија', 'Да'),
('AA120', '1111111111120', 'Вељко', 11111111119, 9, 'Вељка', 'Кристина', 'Максић', '+3816577111112', '1950-03-12', 'Српско', '', 'Сремска 17 Инђија', 'Не'),
('AA121', '1111111111121', 'Синиша', 11111111121, 12, 'Вељка', 'Бошко', 'Вукић', '+381657711555', '1998-03-12', 'Српско', 'Друго', 'Сремска 32 Инђија', 'Не'),
('AA123', '1111111111123', 'Синиша', 11111111123, 1, 'Синише', 'Бранко', 'Бркић', '+381657788812', '1997-03-12', 'Српско', 'Друго', 'Сремска 32 Инђија', 'Не'),
('AA124', '1111111111124', 'Бранислав', 11111111124, 7, 'Бранислава', 'Бранка', 'Чавић', '+381657333812', '1995-03-12', 'Српско', 'Женско', 'Бранка Ћопића 42 Инђија', 'Не'),
('AA125', '1111111111125', 'Милош', 11111111125, 2, 'Милоша', 'Љубица', 'Грубанов', '+381657321811', '1993-03-16', 'Српско', 'Zensko', 'Бранка Ћопића 21 Инђија', 'Не'),
('AA127', '1111111111127', 'Борислав', 11111111127, 1, 'Борислава', 'Милош', 'Ћирић', '+381657325557сс', '1986-03-16', 'Српско', '', 'Каменова 21 Инђија', 'Не'),
('Jessie.Kulas82', '5131231231234', 'Verto coasds depasd', 37313123123, 9, 'Cupressus volu', 'Asda', 'Asda', '+3817769201465', '2027-03-08', 'Delectatio', 'Мушко', '56065 Lesch Circle', 'Да'),
('Novi korisnik', '1111111111111', 'Slavko', 11111111111, 12, 'Slavko', 'Simbadm', 'Asdasd', '+38111231232123', '2026-05-14', '', 'Друго', 'Celenska 23', 'Да'),
('Stephen23', '1234567891234', 'Slavko', 11111111111, 11, 'Slavka', 'Asda', 'Asda', '+3817769201465', '2026-05-19', 'Srpsko', 'Друго', '56065 Lesch Circle', 'Да'),
('X1238', '1212121212121', 'Slavko', 12112121221, 11, 'Slavko', 'Simbadm', 'Asdasd', '+38111231232123', '2026-05-20', 'Srpsko', 'Мушко', 'Celenska 23', 'Да'),
('XX123', '1111111111111', 'Тест', 11111111111, 1, 'Тест', 'ТестИзмењен', 'Тест', '+381111111111', '2000-01-01', 'Тест', 'Drugo', 'Тест ', 'Не');

-- --------------------------------------------------------

--
-- Table structure for table `prijem`
--

CREATE TABLE `prijem` (
  `ID` bigint(20) NOT NULL,
  `BrojIstorijeBolesti` varchar(30) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `OdeljenjeNaprijemu` varchar(8) NOT NULL,
  `UputnaDijagnoza` varchar(8) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `TezinaNaPrijemu` bigint(20) DEFAULT NULL,
  `DatumPrijema` date NOT NULL,
  `Povreda` varchar(5) NOT NULL,
  `SpoljniUzrokPovrede` varchar(8) DEFAULT NULL,
  `Arhiviran` int(2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `prijem`
--

INSERT INTO `prijem` (`ID`, `BrojIstorijeBolesti`, `OdeljenjeNaprijemu`, `UputnaDijagnoza`, `TezinaNaPrijemu`, `DatumPrijema`, `Povreda`, `SpoljniUzrokPovrede`, `Arhiviran`) VALUES
(43, 'AA119', '1-3', 'I00 I99', 0, '2023-09-13', 'Не', NULL, 1),
(44, 'AA118', '2-1', 'V01 Y98', 0, '2023-09-14', 'Да', 'W00 W19', 1),
(45, 'AA111', '1-3', 'G00 G99', 0, '2023-09-01', 'Да', 'V98 V99', 1),
(49, 'AA111', '1-1', 'A00 B99', 0, '2023-09-05', 'Не', NULL, 1),
(50, 'Jessie.Kulas82', '1-1', 'C00 D48', 86, '2026-05-20', 'Да', 'V70 V79', 1),
(51, 'AA111', '1-2', 'D50 D89', 86, '2026-05-19', 'Да', NULL, 1),
(52, 'X1238', '1-3', 'E00 E90', 100, '2026-05-07', 'Да', 'V80 V89', 1),
(53, 'AA111', '1-2', 'E00 E90', 0, '2026-05-12', 'Да', NULL, 1),
(54, 'AA111', '1-2', 'D50 D89', 100, '2026-05-15', 'Не', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `spoljasnji_uzrok_povrede`
--

CREATE TABLE `spoljasnji_uzrok_povrede` (
  `Sifra` varchar(8) NOT NULL,
  `Naziv` varchar(80) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `spoljasnji_uzrok_povrede`
--

INSERT INTO `spoljasnji_uzrok_povrede` (`Sifra`, `Naziv`) VALUES
('V30 V39', 'Повреде возача возила или путника са три точка у саобраћајним несрећама'),
('V40 V49', 'Повреде возача аутомобила или путника у саобраћајним несрећама'),
('V50 V59', 'Повреде возача камиона или доставног возила или путника у саобраћајним несрећама'),
('V60 V69', 'Повреде возача тешког транспортног возила или путника у саобраћајним несрећама'),
('V70 V79', 'Повреде возача аутобуса или путника у саобраћајним несрећама'),
('V80 V89', 'Друге несреће путних возила'),
('V90 V94', 'Несреће у транспорту на води'),
('V95 V97', 'Несреће ваздушног И свемирског транспорта'),
('V98 V99', 'Несреће возила које се не могу сврстати на другом месту\r\n'),
('W00 W19', 'Падови'),
('W20 W49', 'Излагање неживим механичким силама'),
('W50 W64', 'Излагање живим механичким силама'),
('W65 W74', 'Задесно дављење И потапање'),
('W75 W84', 'Друга задесна угрожавања дисања'),
('W85 W99', 'Излагање електричној струји, радијацији И средини са екстремним вредностима темп'),
('X00 X09', 'Излагање диму, ватри И пламену'),
('X10 X19', 'Контакт са топлотом И врелим материјама'),
('X20 X29', 'Контакт са отровним животињама И биљкама\r\n'),
('X30 X39', 'Излагање природним силама'),
('X40 X49', 'Задесно тровање И излагање токсичним супстанцама'),
('X50 X57', 'Прекомерни напор, путовање и оскудица'),
('X58 X59', 'Задесно излагање другим непецифичним факторима'),
('X60 X84', 'Намерно самоповређивање'),
('X85 Y09', 'Насиље'),
('Y10 Y34', 'Догађаји неодређене намере'),
('Y40 Y84', 'Компликације хирушке И медицинске неге'),
('Y85 Y89', 'Последице спољашњих узрока морбидитета И морталитета'),
('Y90 Y98', 'Додатни фатори који се односе на узроке морбидитета И морталитета, класификовани');

-- --------------------------------------------------------

--
-- Table structure for table `tipaktivnosti`
--

CREATE TABLE `tipaktivnosti` (
  `Sifra` varchar(8) NOT NULL,
  `Naziv` varchar(80) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tipaktivnosti`
--

INSERT INTO `tipaktivnosti` (`Sifra`, `Naziv`) VALUES
('32132-00', 'Склеротерапија хемороида\r\nИнјектирање хемороида'),
('39003-00', 'Субокципитална пункција (пункција цистерне магне)\r\n'),
('39006-00', 'Вентрикуларна пункција\r\nВентрикуларна пункција кроз претходно имплантирани катет'),
('39009-00', 'Евакуација субдуралног хематома\r\nДренажа постављена кроз фонтанелу'),
('39015-00', 'Спољашња дренажа ликвора'),
('39015-01', 'Инсерција вентрикуларног резервоара\r\nИнсерција резервоара:'),
('39015-02', 'Уметање апарата за праћење интракранијалног притиска и мониторинг\r\n'),
('39703-03', 'Аспирација цисте у мозгу'),
('40003-00', 'Инсерција вентрикуло-атријалног шанта'),
('40003-01', 'Инсерција вентрикуло-плеуралног шанта'),
('40003-02', 'Инсерција вентрикуло-перитонеалног шанта\r\nВентрикулоперитонеостомија'),
('40003-03', 'Инсерција вентрикуларног шанта у остале екстракранијалне области'),
('40003-04', 'Инсерција цистерналног шанта\r\nИнсерција шанта:'),
('40009-03', 'Уклањање вентрикуларног шанта'),
('40009-04', 'Уклањање цистерналног шанта'),
('40803-00', 'Стереотаксична локализација интракранијалне лезије'),
('40903-00', 'Неуроендоскопија\r\nИнтравентрикуларна неуроендоскопија'),
('90000-00', 'Остале кранијалне пункције\r\n'),
('90001-00', 'Уклањање спољашњег вентрикуларног дрена'),
('90001-01', 'Уклањање вентрикуларног резервоара'),
('90001-02', 'Уклањање апарата за праћење интракранијалног притиска [ИЦП]'),
('90002-00', 'Иригација шанта за цереброспиналну течност');

-- --------------------------------------------------------

--
-- Table structure for table `uzrok_povrede`
--

CREATE TABLE `uzrok_povrede` (
  `Sifra` varchar(8) NOT NULL,
  `Naziv` varchar(80) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `uzrok_povrede`
--

INSERT INTO `uzrok_povrede` (`Sifra`, `Naziv`) VALUES
('S00 S09', 'Повреде главе'),
('S10 S19', 'Повреде врата'),
('S20 S29', 'Повреде грудног коша'),
('S30 S39', 'Повреде абдомена, слабине И карлице'),
('S40 S49', 'Повреде рамена И надлактице'),
('S50 S59', 'Повреде лакта И подлактице'),
('S60 S69', 'Повреде ручја И шаке'),
('S70 S79', 'Повреде кука И бутине'),
('S80 S89', 'Повреде колена И потколенице'),
('S90 S99', 'Повреде скочног зглоба И стопала'),
('T00 T07', 'Вишеструке повреде тела'),
('T08 T14', 'Повреде незначеног предела трупа, удова или других делова тела'),
('T15 T19', 'Dejstvo stranog tela prodrlog kroz prirodni otvor'),
('T20 T32', 'Опекотине И разједи'),
('T33 T35', 'Промрзлине'),
('T36 T50', 'Тровање лековима, медикаментима И биолошким супстанцама'),
('T51 T65', 'Toksični efekti supstancija, prvenstveno nemedicinskih po poreklu'),
('T66 T78', 'Други И неозначени ефекти спољних узрока'),
('T79 T79', 'Извесне ране компликације трауме'),
('T80 T88', 'Компликације хирушке И медицинске неге, некласификоване на другом месту\r\n'),
('T90 T98', 'Последице повреда, тровања И других ефеката спољних узрока');

-- --------------------------------------------------------

--
-- Table structure for table `vrsta_otpusta`
--

CREATE TABLE `vrsta_otpusta` (
  `Sifra` int(2) NOT NULL,
  `Naziv` varchar(80) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `vrsta_otpusta`
--

INSERT INTO `vrsta_otpusta` (`Sifra`, `Naziv`) VALUES
(1, 'Отпуст кући/друго место пребивалишта'),
(2, 'Отпуст/премештај у другу здравствену установу за краткотрајну хоспитализацију'),
(3, 'Отпуст/премештај у другу здравствену установу'),
(4, 'Статистички отпуст'),
(5, 'Отпуштен на сопствени захтев'),
(6, 'Умро');

-- --------------------------------------------------------

--
-- Table structure for table `zaposleni`
--

CREATE TABLE `zaposleni` (
  `IDZaposlenog` int(11) NOT NULL,
  `PREZIME` varchar(50) NOT NULL,
  `IME` varchar(40) NOT NULL,
  `SPECIJALIZACIJA` varchar(10) DEFAULT NULL,
  `Telefon` varchar(30) NOT NULL,
  `EMAIL` varchar(60) NOT NULL,
  `KORISNICKOIME` varchar(30) NOT NULL,
  `SIFRA` varchar(65) NOT NULL,
  `URLSLike` varchar(250) DEFAULT NULL,
  `statusucesca` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `zaposleni`
--

INSERT INTO `zaposleni` (`IDZaposlenog`, `PREZIME`, `IME`, `SPECIJALIZACIJA`, `Telefon`, `EMAIL`, `KORISNICKOIME`, `SIFRA`, `URLSLike`, `statusucesca`) VALUES
(1, 'Арбановски', 'Страхиња', '91121', '0623456321', 'strahinja@gmail.com', 'страхиња', '$2y$10$l1ztJONU/1EFzN5Ecc.MYOoiaVqS2GZ0XVlJxesn5sB6yrSTTxw2e', NULL, 'Администратор'),
(2, 'Марковић', 'Марко', '91121', '0634456321', 'marko@gmail.com', 'марко', '$2y$10$l1ztJONU/1EFzN5Ecc.MYOoiaVqS2GZ0XVlJxesn5sB6yrSTTxw2e', NULL, 'Лекар'),
(3, 'Arbanovski', 'Strahinja', '', '0658584755', 'strahinja.a.98@gmail.com', 'Strahinja', '$2y$10$XgBmf7tBWcftSEuDeJWz5u2beOYn0JOo1fiTAQl0ggJGiJ5ZY6VwC', NULL, 'Лекар'),
(4, 'Markovic', 'Stefan', '', '0658584755', 'strahinja.a.98@gmail.com', 'Stefan', '$2y$10$DgTCAaCjRVJAmWU4W0EZiO.3vVcNL5a3t01zFnQ1AfsZrOmav7HRO', NULL, 'Администратор'),
(5, 'Markovic', 'Milica', '', '0651213213', 'milica@gmail.com', 'Milica', '$2y$10$dWyEHTPIELr8408YaeTZOusV2/c6UqVl8SVWjwrE6W/qu4ndonIga', NULL, 'Медицинска сестра'),
(6, 'Administrator', 'Novi', 'ghhh', '0658584755', 'admin@gmail.com', 'admin', '$2y$10$bq1N5OZbgacXKaf8QR4DsOoGqBN7wW95xYz3Vl3NQr51x3a9Jsryi', NULL, 'Администратор'),
(7, 'Doktor', 'Doktro', 'Oftamolog', '+381123123212', 'Doktor@gmail.com', 'Doktor', '$2y$10$R/884nI1nnH0ozafP.n4fe2v736DAQFtVtYQeuJAdUvIX8gXJJkf6', NULL, 'Лекар');

-- --------------------------------------------------------

--
-- Structure for view `hospitalizacijapogled`
--
DROP TABLE IF EXISTS `hospitalizacijapogled`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `hospitalizacijapogled`  AS SELECT `pacijent`.`BrojIstorijebolesti` AS `BrojIstorijebolesti`, `prijem`.`DatumPrijema` AS `DatumPrijema`, `hospitalizacija`.`DatumOtpusta` AS `DatumOtpusta`, `hospitalizacija`.`OsnovniUzrokHospitalizacije` AS `OsnovniUzrokHospitalizacije` FROM ((`pacijent` left join `prijem` on(`prijem`.`BrojIstorijeBolesti` = `pacijent`.`BrojIstorijebolesti`)) left join `hospitalizacija` on(`hospitalizacija`.`IDPrijema` = `prijem`.`ID`)) WHERE `prijem`.`Arhiviran` = 1 AND `hospitalizacija`.`ID` is not null ;

-- --------------------------------------------------------

--
-- Structure for view `hospitalizacijaradnipogled`
--
DROP TABLE IF EXISTS `hospitalizacijaradnipogled`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `hospitalizacijaradnipogled`  AS SELECT `pacijent`.`BrojIstorijebolesti` AS `BrojIstorijebolesti`, `prijem`.`DatumPrijema` AS `DatumPrijema`, `hospitalizacija`.`DatumOtpusta` AS `DatumOtpusta`, `hospitalizacija`.`OsnovniUzrokHospitalizacije` AS `OsnovniUzrokHospitalizacije`, `hospitalizacija`.`ID` AS `ID` FROM ((`pacijent` left join `prijem` on(`prijem`.`BrojIstorijeBolesti` = `pacijent`.`BrojIstorijebolesti`)) left join `hospitalizacija` on(`hospitalizacija`.`IDPrijema` = `prijem`.`ID`)) WHERE `prijem`.`Arhiviran` = 1 AND `hospitalizacija`.`ID` is not null ;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `aktivnosthospitalizacije`
--
ALTER TABLE `aktivnosthospitalizacije`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `AktivnostiIDIndex` (`PrijemID`,`TipAktivnostiID`),
  ADD KEY `TipAktivnostiID` (`TipAktivnostiID`);

--
-- Indexes for table `hospitalizacija`
--
ALTER TABLE `hospitalizacija`
  ADD PRIMARY KEY (`ID`),
  ADD UNIQUE KEY `IDPrijemaIndex` (`IDPrijema`) USING BTREE,
  ADD KEY `OsnovniUzrokHospitalizacije` (`OsnovniUzrokHospitalizacije`),
  ADD KEY `OdeljenjeOtpust` (`OdeljenjeSaKojegJeOtpustIzvrsen`),
  ADD KEY `VrstaOtpustaIndex` (`VrstaOtpusta`),
  ADD KEY `OsnovniUzrokSmrtiIndex` (`OsnovniUzrokSmrti`);

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
-- Indexes for table `prijem`
--
ALTER TABLE `prijem`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `OdeljenjePrijemIndex` (`OdeljenjeNaprijemu`),
  ADD KEY `UputnaDijagnozaIndex` (`UputnaDijagnoza`),
  ADD KEY `BrojIstorijeIndex` (`BrojIstorijeBolesti`),
  ADD KEY `SpoljniUzrokPovredeIndex` (`SpoljniUzrokPovrede`);

--
-- Indexes for table `spoljasnji_uzrok_povrede`
--
ALTER TABLE `spoljasnji_uzrok_povrede`
  ADD PRIMARY KEY (`Sifra`);

--
-- Indexes for table `tipaktivnosti`
--
ALTER TABLE `tipaktivnosti`
  ADD PRIMARY KEY (`Sifra`);

--
-- Indexes for table `uzrok_povrede`
--
ALTER TABLE `uzrok_povrede`
  ADD PRIMARY KEY (`Sifra`);

--
-- Indexes for table `vrsta_otpusta`
--
ALTER TABLE `vrsta_otpusta`
  ADD PRIMARY KEY (`Sifra`);

--
-- Indexes for table `zaposleni`
--
ALTER TABLE `zaposleni`
  ADD PRIMARY KEY (`IDZaposlenog`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `aktivnosthospitalizacije`
--
ALTER TABLE `aktivnosthospitalizacije`
  MODIFY `ID` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=71;

--
-- AUTO_INCREMENT for table `hospitalizacija`
--
ALTER TABLE `hospitalizacija`
  MODIFY `ID` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=56;

--
-- AUTO_INCREMENT for table `prijem`
--
ALTER TABLE `prijem`
  MODIFY `ID` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=55;

--
-- AUTO_INCREMENT for table `zaposleni`
--
ALTER TABLE `zaposleni`
  MODIFY `IDZaposlenog` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `aktivnosthospitalizacije`
--
ALTER TABLE `aktivnosthospitalizacije`
  ADD CONSTRAINT `aktivnosthospitalizacije_ibfk_1` FOREIGN KEY (`TipAktivnostiID`) REFERENCES `tipaktivnosti` (`Sifra`) ON UPDATE CASCADE,
  ADD CONSTRAINT `aktivnosthospitalizacije_ibfk_2` FOREIGN KEY (`PrijemID`) REFERENCES `prijem` (`ID`) ON DELETE NO ACTION ON UPDATE CASCADE;

--
-- Constraints for table `hospitalizacija`
--
ALTER TABLE `hospitalizacija`
  ADD CONSTRAINT `fk_uzrok_hospitalizacije` FOREIGN KEY (`OsnovniUzrokHospitalizacije`) REFERENCES `mkb` (`Sifra`) ON UPDATE CASCADE,
  ADD CONSTRAINT `hospitalizacija_ibfk_2` FOREIGN KEY (`OdeljenjeSaKojegJeOtpustIzvrsen`) REFERENCES `odeljenje` (`Oznaka`) ON UPDATE CASCADE,
  ADD CONSTRAINT `hospitalizacija_ibfk_4` FOREIGN KEY (`VrstaOtpusta`) REFERENCES `vrsta_otpusta` (`Sifra`) ON UPDATE CASCADE,
  ADD CONSTRAINT `hospitalizacija_ibfk_5` FOREIGN KEY (`OsnovniUzrokSmrti`) REFERENCES `mkb` (`Sifra`) ON UPDATE CASCADE,
  ADD CONSTRAINT `hospitalizacija_ibfk_6` FOREIGN KEY (`IDPrijema`) REFERENCES `prijem` (`ID`) ON UPDATE CASCADE;

--
-- Constraints for table `pacijent`
--
ALTER TABLE `pacijent`
  ADD CONSTRAINT `fk_osnov` FOREIGN KEY (`OsnovOsiguranja`) REFERENCES `osnov_osiguranja` (`ID`);

--
-- Constraints for table `prijem`
--
ALTER TABLE `prijem`
  ADD CONSTRAINT `prijem_ibfk_2` FOREIGN KEY (`BrojIstorijeBolesti`) REFERENCES `pacijent` (`BrojIstorijebolesti`) ON UPDATE CASCADE,
  ADD CONSTRAINT `prijem_ibfk_3` FOREIGN KEY (`OdeljenjeNaprijemu`) REFERENCES `odeljenje` (`Oznaka`) ON UPDATE CASCADE,
  ADD CONSTRAINT `prijem_ibfk_4` FOREIGN KEY (`UputnaDijagnoza`) REFERENCES `mkb` (`Sifra`) ON UPDATE CASCADE,
  ADD CONSTRAINT `prijem_ibfk_5` FOREIGN KEY (`SpoljniUzrokPovrede`) REFERENCES `spoljasnji_uzrok_povrede` (`Sifra`) ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
