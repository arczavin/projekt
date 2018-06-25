/*
Navicat MySQL Data Transfer
Source Host     : localhost:3306
Source Database : inz
Target Host     : localhost:3306
Target Database : inz
Date: 2015-06-28 13:48:18
*/
ALTER TABLE harmonogram
ADD 
SET FOREIGN_KEY_CHECKS=0;
-- ----------------------------
-- Table structure for harmonogram
-- ----------------------------
DROP TABLE IF EXISTS `harmonogram`;
CREATE TABLE `harmonogram` (
  `id_zajec` int(11) NOT NULL AUTO_INCREMENT,
  `godz_start` time NOT NULL,
  `godz_stop` time NOT NULL,
  `id_sala` int(11) NOT NULL,
  `id_prowadzacy` int(11) NOT NUL
  `id_tanca` int(11) NOT NULL,
  PRIMARY KEY (`id_zajec`),
  KEY `fk1` (`id_sala`),
  KEY `fk2` (`id_prowadzacy`),
  KEY `fk3` (`id_tanca`),
  CONSTRAINT `fk1` FOREIGN KEY (`id_sala`) REFERENCES `sala` (`id_sala`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `fk2` FOREIGN KEY (`id_prowadzacy`) REFERENCES `prowadzacy` (`id_prowadzacy`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `fk3` FOREIGN KEY (`id_tanca`) REFERENCES `typ_tanca` (`id_tanca`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `fkadd` FOREIGN KEY (`id_zajec`) REFERENCES `zajecia` (`id_zajec`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of harmonogram
-- ----------------------------

-- ----------------------------
-- Table structure for historia
-- ----------------------------
DROP TABLE IF EXISTS `historia`;
CREATE TABLE `historia` (
  `id_historia` int(11) NOT NULL AUTO_INCREMENT,
  `id_uzytkownika` int(11) NOT NULL,
  `id_zdarzenia` int(11) NOT NULL,
  PRIMARY KEY (`id_historia`),
  KEY `fk4` (`id_uzytkownika`),
  KEY `fk5` (`id_zdarzenia`),
  CONSTRAINT `fk4` FOREIGN KEY (`id_uzytkownika`) REFERENCES `uzytkownicy` (`id_uzytkownika`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `fk5` FOREIGN KEY (`id_zdarzenia`) REFERENCES `zdarzenia` (`id_zdarzenia`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of historia
-- ----------------------------

-- ----------------------------
-- Table structure for lokalizacja
-- ----------------------------
DROP TABLE IF EXISTS `lokalizacja`;
CREATE TABLE `lokalizacja` (
  `id_lokalizacja` int(11) NOT NULL AUTO_INCREMENT,
  `miasto` varchar(20) NOT NULL,
  `ulica` varchar(20) NOT NULL,
  `nr_budynku` int(5) NOT NULL,
  PRIMARY KEY (`id_lokalizacja`),
  CONSTRAINT `fk_lok` FOREIGN KEY (`id_lokalizacja`) REFERENCES `sala` (`id_lokalizacja`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of lokalizacja
-- ----------------------------

-- ----------------------------
-- Table structure for prowadzacy
-- ----------------------------
DROP TABLE IF EXISTS `prowadzacy`;
CREATE TABLE `prowadzacy` (
  `id_prowadzacy` int(11) NOT NULL AUTO_INCREMENT,
  `imie` varchar(20) NOT NULL,
  `nazwisko` varchar(20) NOT NULL,
  `ulica` varchar(20) NOT NULL,
  `nr_budynku` int(5) NOT NULL,
  `miasto` varchar(20) NOT NULL,
  `data_urodzenia` date NOT NULL,
  `id_typ` int(11) NOT NULL,
  PRIMARY KEY (`id_prowadzacy`),
  KEY `fk8` (`id_typ`),
  CONSTRAINT `fk8` FOREIGN KEY (`id_typ`) REFERENCES `uzytkownik_typ` (`id_typ`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of prowadzacy
-- ----------------------------

-- ----------------------------
-- Table structure for Prowadzacy_uprawnienia
-- ----------------------------
DROP TABLE IF EXISTS `Prowadzacy_uprawnienia`;
CREATE TABLE `Prowadzacy_uprawnienia` (
  `id_prowadzacy` int(11) NOT NULL,
  `id_typ` int(11) NOT NULL,
  KEY `fkp` (`id_prowadzacy`),
  KEY `fkp2` (`id_typ`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- ----------------------------
-- Records of Prowadzacy_uprawnienia
-- ----------------------------

-- ----------------------------
-- Table structure for sala
-- ----------------------------
DROP TABLE IF EXISTS `sala`;
CREATE TABLE `sala` (
  `id_sala` int(11) NOT NULL AUTO_INCREMENT,
  `nr_sali` int(11) NOT NULL,
  `nazwa` varchar(20) NOT NULL,
  `id_lokalizacja` int(11) NOT NULL,
  PRIMARY KEY (`id_sala`),
  KEY `fk9` (`id_lokalizacja`),
  CONSTRAINT `fk9` FOREIGN KEY (`id_lokalizacja`) REFERENCES `lokalizacja` (`id_lokalizacja`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 ROW_FORMAT=COMPACT;

-- ----------------------------
-- Records of sala
-- ----------------------------

-- ----------------------------
-- Table structure for sesja
-- ----------------------------
DROP TABLE IF EXISTS `sesja`;
CREATE TABLE `sesja` (
  `id_sesja` int(11) NOT NULL AUTO_INCREMENT,
  `id_uzytkownika` int(11) NOT NULL,
  `start` datetime NOT NULL,
  `hash` varchar(40) NOT NULL,
  `adres_ip` varchar(20) NOT NULL,
  `przegladarka` varchar(10) NOT NULL,
  PRIMARY KEY (`id_sesja`),
  KEY `fk10` (`id_uzytkownika`),
  CONSTRAINT `fk10` FOREIGN KEY (`id_uzytkownika`) REFERENCES `uzytkownicy` (`id_typ`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of sesja
-- ----------------------------

-- ----------------------------
-- Table structure for typ_tanca
-- ----------------------------
DROP TABLE IF EXISTS `typ_tanca`;
CREATE TABLE `typ_tanca` (
  `id_tanca` int(11) NOT NULL AUTO_INCREMENT,
  `nazwa` varchar(20) NOT NULL,
  PRIMARY KEY (`id_tanca`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of typ_tanca
-- ----------------------------

-- ----------------------------
-- Table structure for uzytkownicy
-- ----------------------------
DROP TABLE IF EXISTS `uzytkownicy`;
CREATE TABLE `uzytkownicy` (
  `id_uzytkownika` int(11) NOT NULL AUTO_INCREMENT,
  `imie` varchar(20) NOT NULL,
  `nazwisko` varchar(20) NOT NULL,
  `login` text NOT NULL,
  `haslo` text NOT NULL,
  `id_typ` int(11) NOT NULL,
  PRIMARY KEY (`id_uzytkownika`),
  KEY `fk6` (`id_typ`),
  CONSTRAINT `fk6` FOREIGN KEY (`id_typ`) REFERENCES `uzytkownik_typ` (`id_typ`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 ROW_FORMAT=COMPACT;

-- ----------------------------
-- Records of uzytkownicy
-- ----------------------------

-- ----------------------------
-- Table structure for uzytkownik_typ
-- ----------------------------
DROP TABLE IF EXISTS `uzytkownik_typ`;
CREATE TABLE `uzytkownik_typ` (
  `id_typ` int(11) NOT NULL AUTO_INCREMENT,
  `nazwa` varchar(20) NOT NULL,
  PRIMARY KEY (`id_typ`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of uzytkownik_typ
-- ----------------------------

-- ----------------------------
-- Table structure for zajecia
-- ----------------------------
DROP TABLE IF EXISTS `zajecia`;
CREATE TABLE `zajecia` (
  `id_zajec` int(11) NOT NULL AUTO_INCREMENT,
  `id_uzytkownika` int(11) NOT NULL,
  PRIMARY KEY (`id_zajec`),
  KEY `fk12` (`id_uzytkownika`),
  CONSTRAINT `fk12` FOREIGN KEY (`id_uzytkownika`) REFERENCES `uzytkownicy` (`id_uzytkownika`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of zajecia
-- ----------------------------

-- ----------------------------
-- Table structure for zdarzenia
-- ----------------------------
DROP TABLE IF EXISTS `zdarzenia`;
CREATE TABLE `zdarzenia` (
  `id_zdarzenia` int(11) NOT NULL AUTO_INCREMENT,
  `akcja` enum('','anulowanie_zajec','dodanie_zajec','modyfikacja konta','wypisane_z_zajec','wpisanie_na_zajecia') NOT NULL,
  PRIMARY KEY (`id_zdarzenia`),
  KEY `id_zdarzenia` (`id_zdarzenia`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of zdarzenia
-- ----------------------------
