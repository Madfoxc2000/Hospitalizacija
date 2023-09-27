-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Sep 27, 2023 at 02:02 AM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.2.4

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
CREATE DATABASE IF NOT EXISTS `bolnica` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
USE `bolnica`;

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
(52, 42, '39015-01', '2023-09-13', 'Процедура обављена рутински'),
(54, 42, '39015-01', '2023-09-12', ''),
(55, 42, '40009-04', '2023-09-13', ''),
(57, 42, '40003-01', '2023-09-20', ''),
(58, 44, '39015-02', '2023-09-13', '');

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
(43, 42, 'I00 I99', 'L00 L99', 10, '2023-09-17', 7, '1-2', 3, '', NULL),
(45, 43, 'I00 I99', NULL, NULL, '2023-09-14', 1, '1-3', 1, NULL, NULL),
(46, 44, 'S00 T98', 'L00 L99', NULL, '2023-09-22', 8, '2-1', 6, NULL, 'S00 T98'),
(47, 45, 'S00 T98', NULL, NULL, '2023-09-28', 27, '2-1', 6, NULL, 'S00 T98');

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
(42, 'AA112', '1-2', 'I00 I99', 0, '2023-09-10', 'Не', NULL, 1),
(43, 'AA119', '1-3', 'I00 I99', 0, '2023-09-13', 'Не', NULL, 1),
(44, 'AA118', '2-1', 'V01 Y98', 0, '2023-09-14', 'Да', 'W00 W19', 1),
(45, 'AA111', '1-3', 'G00 G99', 0, '2023-09-01', 'Да', 'V98 V99', 1),
(49, 'AA111', '1-1', 'A00 B99', 0, '2023-09-05', 'Не', NULL, NULL);

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
  `ULOGA` varchar(30) NOT NULL,
  `SPECIJALIZACIJA` varchar(10) DEFAULT NULL,
  `Telefon` varchar(30) NOT NULL,
  `EMAIL` varchar(60) NOT NULL,
  `KORISNICKOIME` varchar(30) NOT NULL,
  `SIFRA` varchar(30) NOT NULL,
  `URLSLike` varchar(250) DEFAULT NULL,
  `statusucesca` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `zaposleni`
--

INSERT INTO `zaposleni` (`IDZaposlenog`, `PREZIME`, `IME`, `ULOGA`, `SPECIJALIZACIJA`, `Telefon`, `EMAIL`, `KORISNICKOIME`, `SIFRA`, `URLSLike`, `statusucesca`) VALUES
(1, 'Арбановски', 'Страхиња', 'Доктор', '91121', '0623456321', 'strahinja@gmail.com', 'страхиња', '123', NULL, 'Администратор'),
(2, 'Марковић', 'Марко', 'Доктор', '91121', '0634456321', 'marko@gmail.com', 'марко', '123', NULL, 'Корисник');

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
  MODIFY `ID` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=62;

--
-- AUTO_INCREMENT for table `hospitalizacija`
--
ALTER TABLE `hospitalizacija`
  MODIFY `ID` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=51;

--
-- AUTO_INCREMENT for table `prijem`
--
ALTER TABLE `prijem`
  MODIFY `ID` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=50;

--
-- AUTO_INCREMENT for table `zaposleni`
--
ALTER TABLE `zaposleni`
  MODIFY `IDZaposlenog` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

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
--
-- Database: `phpmyadmin`
--
CREATE DATABASE IF NOT EXISTS `phpmyadmin` DEFAULT CHARACTER SET utf8 COLLATE utf8_bin;
USE `phpmyadmin`;

-- --------------------------------------------------------

--
-- Table structure for table `pma__bookmark`
--

CREATE TABLE `pma__bookmark` (
  `id` int(10) UNSIGNED NOT NULL,
  `dbase` varchar(255) NOT NULL DEFAULT '',
  `user` varchar(255) NOT NULL DEFAULT '',
  `label` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT '',
  `query` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='Bookmarks';

-- --------------------------------------------------------

--
-- Table structure for table `pma__central_columns`
--

CREATE TABLE `pma__central_columns` (
  `db_name` varchar(64) NOT NULL,
  `col_name` varchar(64) NOT NULL,
  `col_type` varchar(64) NOT NULL,
  `col_length` text DEFAULT NULL,
  `col_collation` varchar(64) NOT NULL,
  `col_isNull` tinyint(1) NOT NULL,
  `col_extra` varchar(255) DEFAULT '',
  `col_default` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='Central list of columns';

-- --------------------------------------------------------

--
-- Table structure for table `pma__column_info`
--

CREATE TABLE `pma__column_info` (
  `id` int(5) UNSIGNED NOT NULL,
  `db_name` varchar(64) NOT NULL DEFAULT '',
  `table_name` varchar(64) NOT NULL DEFAULT '',
  `column_name` varchar(64) NOT NULL DEFAULT '',
  `comment` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT '',
  `mimetype` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT '',
  `transformation` varchar(255) NOT NULL DEFAULT '',
  `transformation_options` varchar(255) NOT NULL DEFAULT '',
  `input_transformation` varchar(255) NOT NULL DEFAULT '',
  `input_transformation_options` varchar(255) NOT NULL DEFAULT ''
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='Column information for phpMyAdmin';

-- --------------------------------------------------------

--
-- Table structure for table `pma__designer_settings`
--

CREATE TABLE `pma__designer_settings` (
  `username` varchar(64) NOT NULL,
  `settings_data` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='Settings related to Designer';

--
-- Dumping data for table `pma__designer_settings`
--

INSERT INTO `pma__designer_settings` (`username`, `settings_data`) VALUES
('root', '{\"relation_lines\":\"true\",\"angular_direct\":\"direct\",\"snap_to_grid\":\"off\"}');

-- --------------------------------------------------------

--
-- Table structure for table `pma__export_templates`
--

CREATE TABLE `pma__export_templates` (
  `id` int(5) UNSIGNED NOT NULL,
  `username` varchar(64) NOT NULL,
  `export_type` varchar(10) NOT NULL,
  `template_name` varchar(64) NOT NULL,
  `template_data` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='Saved export templates';

-- --------------------------------------------------------

--
-- Table structure for table `pma__favorite`
--

CREATE TABLE `pma__favorite` (
  `username` varchar(64) NOT NULL,
  `tables` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='Favorite tables';

-- --------------------------------------------------------

--
-- Table structure for table `pma__history`
--

CREATE TABLE `pma__history` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `username` varchar(64) NOT NULL DEFAULT '',
  `db` varchar(64) NOT NULL DEFAULT '',
  `table` varchar(64) NOT NULL DEFAULT '',
  `timevalue` timestamp NOT NULL DEFAULT current_timestamp(),
  `sqlquery` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='SQL history for phpMyAdmin';

-- --------------------------------------------------------

--
-- Table structure for table `pma__navigationhiding`
--

CREATE TABLE `pma__navigationhiding` (
  `username` varchar(64) NOT NULL,
  `item_name` varchar(64) NOT NULL,
  `item_type` varchar(64) NOT NULL,
  `db_name` varchar(64) NOT NULL,
  `table_name` varchar(64) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='Hidden items of navigation tree';

-- --------------------------------------------------------

--
-- Table structure for table `pma__pdf_pages`
--

CREATE TABLE `pma__pdf_pages` (
  `db_name` varchar(64) NOT NULL DEFAULT '',
  `page_nr` int(10) UNSIGNED NOT NULL,
  `page_descr` varchar(50) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT ''
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='PDF relation pages for phpMyAdmin';

-- --------------------------------------------------------

--
-- Table structure for table `pma__recent`
--

CREATE TABLE `pma__recent` (
  `username` varchar(64) NOT NULL,
  `tables` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='Recently accessed tables';

--
-- Dumping data for table `pma__recent`
--

INSERT INTO `pma__recent` (`username`, `tables`) VALUES
('root', '[{\"db\":\"shop\",\"table\":\"products\"},{\"db\":\"shop\",\"table\":\"users\"},{\"db\":\"shop\",\"table\":\"order_items\"},{\"db\":\"shop\",\"table\":\"orders\"},{\"db\":\"shop\",\"table\":\"cart\"},{\"db\":\"bolnica\",\"table\":\"aktivnosthospitalizacije\"},{\"db\":\"bolnica\",\"table\":\"pacijent\"},{\"db\":\"bolnica\",\"table\":\"uzrok_povrede\"},{\"db\":\"bolnica\",\"table\":\"prijem\"},{\"db\":\"bolnica\",\"table\":\"hospitalizacija\"}]');

-- --------------------------------------------------------

--
-- Table structure for table `pma__relation`
--

CREATE TABLE `pma__relation` (
  `master_db` varchar(64) NOT NULL DEFAULT '',
  `master_table` varchar(64) NOT NULL DEFAULT '',
  `master_field` varchar(64) NOT NULL DEFAULT '',
  `foreign_db` varchar(64) NOT NULL DEFAULT '',
  `foreign_table` varchar(64) NOT NULL DEFAULT '',
  `foreign_field` varchar(64) NOT NULL DEFAULT ''
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='Relation table';

-- --------------------------------------------------------

--
-- Table structure for table `pma__savedsearches`
--

CREATE TABLE `pma__savedsearches` (
  `id` int(5) UNSIGNED NOT NULL,
  `username` varchar(64) NOT NULL DEFAULT '',
  `db_name` varchar(64) NOT NULL DEFAULT '',
  `search_name` varchar(64) NOT NULL DEFAULT '',
  `search_data` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='Saved searches';

-- --------------------------------------------------------

--
-- Table structure for table `pma__table_coords`
--

CREATE TABLE `pma__table_coords` (
  `db_name` varchar(64) NOT NULL DEFAULT '',
  `table_name` varchar(64) NOT NULL DEFAULT '',
  `pdf_page_number` int(11) NOT NULL DEFAULT 0,
  `x` float UNSIGNED NOT NULL DEFAULT 0,
  `y` float UNSIGNED NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='Table coordinates for phpMyAdmin PDF output';

-- --------------------------------------------------------

--
-- Table structure for table `pma__table_info`
--

CREATE TABLE `pma__table_info` (
  `db_name` varchar(64) NOT NULL DEFAULT '',
  `table_name` varchar(64) NOT NULL DEFAULT '',
  `display_field` varchar(64) NOT NULL DEFAULT ''
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='Table information for phpMyAdmin';

-- --------------------------------------------------------

--
-- Table structure for table `pma__table_uiprefs`
--

CREATE TABLE `pma__table_uiprefs` (
  `username` varchar(64) NOT NULL,
  `db_name` varchar(64) NOT NULL,
  `table_name` varchar(64) NOT NULL,
  `prefs` text NOT NULL,
  `last_update` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='Tables'' UI preferences';

--
-- Dumping data for table `pma__table_uiprefs`
--

INSERT INTO `pma__table_uiprefs` (`username`, `db_name`, `table_name`, `prefs`, `last_update`) VALUES
('root', 'bolnica', 'hospitalizacija', '[]', '2023-09-04 20:02:47'),
('root', 'bolnica', 'pacijent', '{\"sorted_col\":\"`OsnovOsiguranja` DESC\"}', '2023-09-04 22:31:23'),
('root', 'bolnica', 'prijem', '{\"sorted_col\":\"`prijem`.`TezinaNaPrijemu` ASC\"}', '2023-09-12 11:20:28'),
('root', 'shop', 'orders', '[]', '2023-09-20 20:41:00');

-- --------------------------------------------------------

--
-- Table structure for table `pma__tracking`
--

CREATE TABLE `pma__tracking` (
  `db_name` varchar(64) NOT NULL,
  `table_name` varchar(64) NOT NULL,
  `version` int(10) UNSIGNED NOT NULL,
  `date_created` datetime NOT NULL,
  `date_updated` datetime NOT NULL,
  `schema_snapshot` text NOT NULL,
  `schema_sql` text DEFAULT NULL,
  `data_sql` longtext DEFAULT NULL,
  `tracking` set('UPDATE','REPLACE','INSERT','DELETE','TRUNCATE','CREATE DATABASE','ALTER DATABASE','DROP DATABASE','CREATE TABLE','ALTER TABLE','RENAME TABLE','DROP TABLE','CREATE INDEX','DROP INDEX','CREATE VIEW','ALTER VIEW','DROP VIEW') DEFAULT NULL,
  `tracking_active` int(1) UNSIGNED NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='Database changes tracking for phpMyAdmin';

-- --------------------------------------------------------

--
-- Table structure for table `pma__userconfig`
--

CREATE TABLE `pma__userconfig` (
  `username` varchar(64) NOT NULL,
  `timevalue` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `config_data` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='User preferences storage for phpMyAdmin';

--
-- Dumping data for table `pma__userconfig`
--

INSERT INTO `pma__userconfig` (`username`, `timevalue`, `config_data`) VALUES
('root', '2023-09-27 00:01:02', '{\"Console\\/Mode\":\"show\",\"NavigationWidth\":276,\"Console\\/Height\":0}');

-- --------------------------------------------------------

--
-- Table structure for table `pma__usergroups`
--

CREATE TABLE `pma__usergroups` (
  `usergroup` varchar(64) NOT NULL,
  `tab` varchar(64) NOT NULL,
  `allowed` enum('Y','N') NOT NULL DEFAULT 'N'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='User groups with configured menu items';

-- --------------------------------------------------------

--
-- Table structure for table `pma__users`
--

CREATE TABLE `pma__users` (
  `username` varchar(64) NOT NULL,
  `usergroup` varchar(64) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='Users and their assignments to user groups';

--
-- Indexes for dumped tables
--

--
-- Indexes for table `pma__bookmark`
--
ALTER TABLE `pma__bookmark`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `pma__central_columns`
--
ALTER TABLE `pma__central_columns`
  ADD PRIMARY KEY (`db_name`,`col_name`);

--
-- Indexes for table `pma__column_info`
--
ALTER TABLE `pma__column_info`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `db_name` (`db_name`,`table_name`,`column_name`);

--
-- Indexes for table `pma__designer_settings`
--
ALTER TABLE `pma__designer_settings`
  ADD PRIMARY KEY (`username`);

--
-- Indexes for table `pma__export_templates`
--
ALTER TABLE `pma__export_templates`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `u_user_type_template` (`username`,`export_type`,`template_name`);

--
-- Indexes for table `pma__favorite`
--
ALTER TABLE `pma__favorite`
  ADD PRIMARY KEY (`username`);

--
-- Indexes for table `pma__history`
--
ALTER TABLE `pma__history`
  ADD PRIMARY KEY (`id`),
  ADD KEY `username` (`username`,`db`,`table`,`timevalue`);

--
-- Indexes for table `pma__navigationhiding`
--
ALTER TABLE `pma__navigationhiding`
  ADD PRIMARY KEY (`username`,`item_name`,`item_type`,`db_name`,`table_name`);

--
-- Indexes for table `pma__pdf_pages`
--
ALTER TABLE `pma__pdf_pages`
  ADD PRIMARY KEY (`page_nr`),
  ADD KEY `db_name` (`db_name`);

--
-- Indexes for table `pma__recent`
--
ALTER TABLE `pma__recent`
  ADD PRIMARY KEY (`username`);

--
-- Indexes for table `pma__relation`
--
ALTER TABLE `pma__relation`
  ADD PRIMARY KEY (`master_db`,`master_table`,`master_field`),
  ADD KEY `foreign_field` (`foreign_db`,`foreign_table`);

--
-- Indexes for table `pma__savedsearches`
--
ALTER TABLE `pma__savedsearches`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `u_savedsearches_username_dbname` (`username`,`db_name`,`search_name`);

--
-- Indexes for table `pma__table_coords`
--
ALTER TABLE `pma__table_coords`
  ADD PRIMARY KEY (`db_name`,`table_name`,`pdf_page_number`);

--
-- Indexes for table `pma__table_info`
--
ALTER TABLE `pma__table_info`
  ADD PRIMARY KEY (`db_name`,`table_name`);

--
-- Indexes for table `pma__table_uiprefs`
--
ALTER TABLE `pma__table_uiprefs`
  ADD PRIMARY KEY (`username`,`db_name`,`table_name`);

--
-- Indexes for table `pma__tracking`
--
ALTER TABLE `pma__tracking`
  ADD PRIMARY KEY (`db_name`,`table_name`,`version`);

--
-- Indexes for table `pma__userconfig`
--
ALTER TABLE `pma__userconfig`
  ADD PRIMARY KEY (`username`);

--
-- Indexes for table `pma__usergroups`
--
ALTER TABLE `pma__usergroups`
  ADD PRIMARY KEY (`usergroup`,`tab`,`allowed`);

--
-- Indexes for table `pma__users`
--
ALTER TABLE `pma__users`
  ADD PRIMARY KEY (`username`,`usergroup`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `pma__bookmark`
--
ALTER TABLE `pma__bookmark`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `pma__column_info`
--
ALTER TABLE `pma__column_info`
  MODIFY `id` int(5) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `pma__export_templates`
--
ALTER TABLE `pma__export_templates`
  MODIFY `id` int(5) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `pma__history`
--
ALTER TABLE `pma__history`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `pma__pdf_pages`
--
ALTER TABLE `pma__pdf_pages`
  MODIFY `page_nr` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `pma__savedsearches`
--
ALTER TABLE `pma__savedsearches`
  MODIFY `id` int(5) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- Database: `shop`
--
CREATE DATABASE IF NOT EXISTS `shop` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
USE `shop`;

-- --------------------------------------------------------

--
-- Table structure for table `cart`
--

CREATE TABLE `cart` (
  `cart_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `quantity` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `cart`
--

INSERT INTO `cart` (`cart_id`, `user_id`, `product_id`, `quantity`) VALUES
(4, 4, 9, ''),
(5, 5, 20, '1');

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `order_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `delivery_address` varchar(255) NOT NULL,
  `created_at` date NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`order_id`, `user_id`, `delivery_address`, `created_at`) VALUES
(8, 4, 'Serbia, NOVI KARLOVCI, 22322, ČELENSKA', '2023-09-21');

-- --------------------------------------------------------

--
-- Table structure for table `order_items`
--

CREATE TABLE `order_items` (
  `order_items_id` int(11) NOT NULL,
  `order_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `quantity` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `order_items`
--

INSERT INTO `order_items` (`order_items_id`, `order_id`, `product_id`, `quantity`) VALUES
(13, 8, 6, '1'),
(14, 8, 6, '1'),
(15, 8, 7, '3');

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `product_id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `price` varchar(255) NOT NULL,
  `size` varchar(255) NOT NULL,
  `image` varchar(255) NOT NULL,
  `created_at` date NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`product_id`, `name`, `price`, `size`, `image`, `created_at`) VALUES
(19, 'Majica 1', '40', 'L', 'shirt.png', '2023-09-21'),
(20, 'Majica 2', '44', 'M', 'majca1.png', '2023-09-21');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `user_id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `username` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `is_admin` int(11) NOT NULL DEFAULT 0,
  `password` varchar(255) NOT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `name`, `username`, `email`, `is_admin`, `password`, `created_at`) VALUES
(4, 'Strahinja Arbanovski', 'Username', 'strahinja.a.98@gmail.com', 0, '$2y$10$l3cc0DKBqIE5TBZV67fzaODMizx5DTdIa1Gk8KvI5jJp4yEtXzgYC', '2023-09-20 00:36:27'),
(5, 'Admin', 'admin', 'admin@gmail.com', 1, '$2y$10$7bfr7ghHcosY5DF6L4HRyeH9fCrwFl1r0QkVoLkrAluLVBE.P.uR.', '2023-09-21 07:48:43');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `cart`
--
ALTER TABLE `cart`
  ADD PRIMARY KEY (`cart_id`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`order_id`);

--
-- Indexes for table `order_items`
--
ALTER TABLE `order_items`
  ADD PRIMARY KEY (`order_items_id`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`product_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `cart`
--
ALTER TABLE `cart`
  MODIFY `cart_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `order_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `order_items`
--
ALTER TABLE `order_items`
  MODIFY `order_items_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `product_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- Database: `test`
--
CREATE DATABASE IF NOT EXISTS `test` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci;
USE `test`;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
