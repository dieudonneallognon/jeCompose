-- --------------------------------------------------------
-- Hôte :                        localhost
-- Version du serveur:           5.7.24 - MySQL Community Server (GPL)
-- SE du serveur:                Win64
-- HeidiSQL Version:             10.2.0.5599
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;


-- Listage de la structure de la base pour jecompose
CREATE DATABASE IF NOT EXISTS `jecompose` /*!40100 DEFAULT CHARACTER SET latin1 */;
USE `jecompose`;

-- Listage de la structure de la table jecompose. corriger
CREATE TABLE IF NOT EXISTS `corriger` (
  `vraie_rep` char(2) COLLATE utf8_bin DEFAULT NULL,
  `id_mat` varchar(50) COLLATE utf8_bin NOT NULL,
  `id_question` int(2) NOT NULL,
  PRIMARY KEY (`id_mat`,`id_question`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- Listage des données de la table jecompose.corriger : ~30 rows (environ)
DELETE FROM `corriger`;
/*!40000 ALTER TABLE `corriger` DISABLE KEYS */;
INSERT INTO `corriger` (`vraie_rep`, `id_mat`, `id_question`) VALUES
	('b', 'edu001', 1),
	('c', 'edu001', 2),
	('c', 'edu001', 3),
	('c', 'edu001', 4),
	('b', 'edu001', 5),
	('b', 'edu001', 6),
	('b', 'edu001', 7),
	('a', 'edu001', 8),
	('c', 'edu001', 9),
	('c', 'edu001', 10),
	('b', 'edu002', 1),
	('a', 'edu002', 2),
	('a', 'edu002', 3),
	('c', 'edu002', 4),
	('b', 'edu002', 5),
	('c', 'edu002', 6),
	('b', 'edu002', 7),
	('c', 'edu002', 8),
	('b', 'edu002', 9),
	('c', 'edu002', 10),
	('b', 'edu004', 1),
	('c', 'edu004', 2),
	('c', 'edu004', 3),
	('c', 'edu004', 4),
	('c', 'edu004', 5),
	('c', 'edu004', 6),
	('c', 'edu004', 7),
	('a', 'edu004', 8),
	('c', 'edu004', 9),
	('b', 'edu004', 10);
/*!40000 ALTER TABLE `corriger` ENABLE KEYS */;

-- Listage de la structure de la table jecompose. enregistrer
CREATE TABLE IF NOT EXISTS `enregistrer` (
  `note` int(11) DEFAULT NULL,
  `matricule` int(10) unsigned NOT NULL,
  `id_mat` varchar(50) COLLATE utf8_bin NOT NULL DEFAULT '',
  PRIMARY KEY (`matricule`,`id_mat`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- Listage des données de la table jecompose.enregistrer : ~0 rows (environ)
DELETE FROM `enregistrer`;
/*!40000 ALTER TABLE `enregistrer` DISABLE KEYS */;
INSERT INTO `enregistrer` (`note`, `matricule`, `id_mat`) VALUES
	(2, 22014180, 'edu001');
/*!40000 ALTER TABLE `enregistrer` ENABLE KEYS */;

-- Listage de la structure de la table jecompose. etudiant
CREATE TABLE IF NOT EXISTS `etudiant` (
  `matricule` int(10) unsigned zerofill NOT NULL,
  `nom` varchar(50) COLLATE utf8_bin NOT NULL DEFAULT '',
  `prenom` varchar(50) COLLATE utf8_bin NOT NULL DEFAULT '',
  `mot_de_passe` varchar(50) COLLATE utf8_bin NOT NULL DEFAULT '',
  PRIMARY KEY (`matricule`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- Listage des données de la table jecompose.etudiant : ~5 rows (environ)
DELETE FROM `etudiant`;
/*!40000 ALTER TABLE `etudiant` DISABLE KEYS */;
INSERT INTO `etudiant` (`matricule`, `nom`, `prenom`, `mot_de_passe`) VALUES
	(0011111111, 'ALLOGNON', 'Dieudonné', '123456789'),
	(0018954118, 'DJESSOU', 'Registe', '123456789'),
	(0022014180, 'ALLOGNON', 'Dieudonné', 'Rn231099'),
	(0189541188, 'ALLOGNO', 'Abdelatif', '123456789'),
	(2201418055, 'ALLOGNON', 'Dieudonné', '123456789');
/*!40000 ALTER TABLE `etudiant` ENABLE KEYS */;

-- Listage de la structure de la table jecompose. matieres
CREATE TABLE IF NOT EXISTS `matieres` (
  `id_mat` varchar(50) COLLATE utf8_bin NOT NULL DEFAULT '',
  `date_compo` date NOT NULL,
  `heure_debut` time NOT NULL,
  `nom_mat` varchar(50) COLLATE utf8_bin DEFAULT '',
  `heure_fin` time NOT NULL,
  PRIMARY KEY (`id_mat`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- Listage des données de la table jecompose.matieres : ~1 rows (environ)
DELETE FROM `matieres`;
/*!40000 ALTER TABLE `matieres` DISABLE KEYS */;
INSERT INTO `matieres` (`id_mat`, `date_compo`, `heure_debut`, `nom_mat`, `heure_fin`) VALUES
	('edu001', '2021-03-08', '06:53:19', 'MOOP2', '07:00:00');
/*!40000 ALTER TABLE `matieres` ENABLE KEYS */;

-- Listage de la structure de la table jecompose. repondre
CREATE TABLE IF NOT EXISTS `repondre` (
  `matricule` int(10) unsigned NOT NULL,
  `id_mat` varchar(50) COLLATE utf8_bin NOT NULL DEFAULT '',
  `id_question` int(10) unsigned NOT NULL,
  `rep_etu` varchar(50) COLLATE utf8_bin DEFAULT '',
  PRIMARY KEY (`matricule`,`id_mat`,`id_question`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- Listage des données de la table jecompose.repondre : ~10 rows (environ)
DELETE FROM `repondre`;
/*!40000 ALTER TABLE `repondre` DISABLE KEYS */;
INSERT INTO `repondre` (`matricule`, `id_mat`, `id_question`, `rep_etu`) VALUES
	(22014180, 'edu001', 1, 'a'),
	(22014180, 'edu001', 2, 'a'),
	(22014180, 'edu001', 3, NULL),
	(22014180, 'edu001', 4, 'a'),
	(22014180, 'edu001', 5, NULL),
	(22014180, 'edu001', 6, 'a'),
	(22014180, 'edu001', 7, 'a'),
	(22014180, 'edu001', 8, 'a'),
	(22014180, 'edu001', 9, 'a'),
	(22014180, 'edu001', 10, 'a');
/*!40000 ALTER TABLE `repondre` ENABLE KEYS */;

/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IF(@OLD_FOREIGN_KEY_CHECKS IS NULL, 1, @OLD_FOREIGN_KEY_CHECKS) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
