-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le : mar. 23 fév. 2021 à 11:58
-- Version du serveur :  5.7.31
-- Version de PHP : 7.3.21

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `my_academic_follow_up`
--

-- --------------------------------------------------------

--
-- Structure de la table `manager`
--

DROP TABLE IF EXISTS `manager`;
CREATE TABLE IF NOT EXISTS `manager` (
  `email` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL,
  `school` varchar(15) NOT NULL,
  PRIMARY KEY (`email`),
  KEY `manager_school` (`school`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `manager`
--

INSERT INTO `manager` (`email`, `password`, `school`) VALUES
('manager@gmail.com', 'aCt5QU5UTTRMdnFDVXVrL2wxU1B2Zz09', 'EFREI Paris');

-- --------------------------------------------------------

--
-- Structure de la table `mark`
--

DROP TABLE IF EXISTS `mark`;
CREATE TABLE IF NOT EXISTS `mark` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `type` char(2) NOT NULL,
  `coefficient` float NOT NULL,
  `id_subject` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `mark_subject` (`id_subject`),
  KEY `mark_mark_type` (`type`)
) ENGINE=InnoDB AUTO_INCREMENT=21 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `mark`
--

INSERT INTO `mark` (`id`, `type`, `coefficient`, `id_subject`) VALUES
(1, 'DE', 0.5, 1),
(2, 'PJ', 0.1, 1),
(3, 'TD', 0.1, 1),
(4, 'TP', 0.3, 1),
(5, 'DE', 0.5, 2),
(6, 'PJ', 0.1, 2),
(7, 'TD', 0.1, 2),
(8, 'TP', 0.3, 2),
(9, 'DE', 0.5, 3),
(10, 'PJ', 0.1, 3),
(11, 'TD', 0.1, 3),
(12, 'TP', 0.1, 3),
(18, 'DE', 0, 18),
(19, 'TP', 0, 18),
(20, 'DE', 0, 18);

-- --------------------------------------------------------

--
-- Structure de la table `mark_type`
--

DROP TABLE IF EXISTS `mark_type`;
CREATE TABLE IF NOT EXISTS `mark_type` (
  `name` char(2) NOT NULL,
  PRIMARY KEY (`name`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `mark_type`
--

INSERT INTO `mark_type` (`name`) VALUES
('DE'),
('PJ'),
('TD'),
('TP');

-- --------------------------------------------------------

--
-- Structure de la table `promotion`
--

DROP TABLE IF EXISTS `promotion`;
CREATE TABLE IF NOT EXISTS `promotion` (
  `year` char(4) NOT NULL,
  PRIMARY KEY (`year`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `promotion`
--

INSERT INTO `promotion` (`year`) VALUES
('2021'),
('2022'),
('2023'),
('2024'),
('2025');

-- --------------------------------------------------------

--
-- Structure de la table `school`
--

DROP TABLE IF EXISTS `school`;
CREATE TABLE IF NOT EXISTS `school` (
  `name` varchar(100) NOT NULL,
  `nb_semester` int(11) NOT NULL,
  PRIMARY KEY (`name`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `school`
--

INSERT INTO `school` (`name`, `nb_semester`) VALUES
('ECE Paris', 10),
('EFREI Paris', 10),
('EPITA', 10);

-- --------------------------------------------------------

--
-- Structure de la table `semester`
--

DROP TABLE IF EXISTS `semester`;
CREATE TABLE IF NOT EXISTS `semester` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `num` char(2) NOT NULL,
  `school` varchar(100) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `semesters_school` (`school`)
) ENGINE=InnoDB AUTO_INCREMENT=63 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `semester`
--

INSERT INTO `semester` (`id`, `num`, `school`) VALUES
(22, '4', 'EFREI Paris'),
(23, '5', 'EFREI Paris'),
(24, '6', 'EFREI Paris'),
(25, '7', 'EFREI Paris'),
(26, '8', 'EFREI Paris'),
(27, '9', 'EFREI Paris'),
(28, '10', 'EFREI Paris'),
(29, '1', 'ECE Paris'),
(30, '2', 'ECE Paris'),
(31, '3', 'ECE Paris'),
(32, '4', 'ECE Paris'),
(33, '5', 'ECE Paris'),
(34, '6', 'ECE Paris'),
(35, '7', 'ECE Paris'),
(36, '8', 'ECE Paris'),
(37, '9', 'ECE Paris'),
(38, '10', 'ECE Paris'),
(39, '1', 'EPITA'),
(40, '2', 'EPITA'),
(41, '3', 'EPITA'),
(42, '4', 'EPITA'),
(43, '5', 'EPITA'),
(44, '7', 'EPITA'),
(45, '8', 'EPITA'),
(46, '9', 'EPITA'),
(47, '10', 'EPITA'),
(54, '6', 'EPITA'),
(60, '2', 'EFREI Paris'),
(61, '3', 'EFREI Paris'),
(62, '1', 'EFREI Paris');

-- --------------------------------------------------------

--
-- Structure de la table `student`
--

DROP TABLE IF EXISTS `student`;
CREATE TABLE IF NOT EXISTS `student` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL,
  `firstname` varchar(100) NOT NULL,
  `school` varchar(100) NOT NULL,
  `promotion` char(4) NOT NULL,
  `td_group` char(10) NOT NULL,
  `email` varchar(100) NOT NULL,
  `confidentiality` varchar(8) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `student_school` (`school`),
  KEY `student_promotion` (`promotion`),
  KEY `student_email` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `student`
--

INSERT INTO `student` (`id`, `name`, `firstname`, `school`, `promotion`, `td_group`, `email`, `confidentiality`) VALUES
(3, 'Tellier', 'Jacques', 'EFREI Paris', '2023', 'L', 'jacques.tellier@efrei.net', 'Publique'),
(5, 'Souadji', 'Merouane', 'EFREI Paris', '2023', 'K', 'merouane.souadji@efrei.net', 'Publique'),
(9, 'Tellier', 'Jacques', 'EFREI Paris', '2023', 'L', 'jacques.tellier@hotmail.com', 'Publique');

-- --------------------------------------------------------

--
-- Structure de la table `student_marks`
--

DROP TABLE IF EXISTS `student_marks`;
CREATE TABLE IF NOT EXISTS `student_marks` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `mark` float NOT NULL,
  `id_student` int(11) NOT NULL,
  `id_mark` int(11) NOT NULL,
  `id_subject` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `student_marks_id_student` (`id_student`),
  KEY `student_marks_id_subject` (`id_subject`),
  KEY `student_marks_id_mark` (`id_mark`)
) ENGINE=InnoDB AUTO_INCREMENT=58 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `student_marks`
--

INSERT INTO `student_marks` (`id`, `mark`, `id_student`, `id_mark`, `id_subject`) VALUES
(53, 2, 9, 1, 1),
(54, 4, 9, 2, 1),
(55, 5, 9, 3, 1),
(57, 13.7, 9, 4, 1);

-- --------------------------------------------------------

--
-- Structure de la table `student_semester`
--

DROP TABLE IF EXISTS `student_semester`;
CREATE TABLE IF NOT EXISTS `student_semester` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `average` float NOT NULL,
  `id_semester` int(11) NOT NULL,
  `id_student` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `student_semester_semesters` (`id_semester`),
  KEY `student_semester_id_student` (`id_student`)
) ENGINE=InnoDB AUTO_INCREMENT=17 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `student_semester`
--

INSERT INTO `student_semester` (`id`, `average`, `id_semester`, `id_student`) VALUES
(16, 6.01, 24, 9);

-- --------------------------------------------------------

--
-- Structure de la table `student_subject`
--

DROP TABLE IF EXISTS `student_subject`;
CREATE TABLE IF NOT EXISTS `student_subject` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `average` float NOT NULL,
  `id_student` int(11) NOT NULL,
  `id_subject` int(11) NOT NULL,
  `id_ue` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `student_subject_id_subject` (`id_subject`),
  KEY `student_subject_id_student` (`id_student`),
  KEY `student_subject_id_ue` (`id_ue`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `student_subject`
--

INSERT INTO `student_subject` (`id`, `average`, `id_student`, `id_subject`, `id_ue`) VALUES
(4, 6.01, 9, 1, 1);

-- --------------------------------------------------------

--
-- Structure de la table `student_ue`
--

DROP TABLE IF EXISTS `student_ue`;
CREATE TABLE IF NOT EXISTS `student_ue` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_ue` int(11) NOT NULL,
  `average` float NOT NULL,
  `id_student` int(11) NOT NULL,
  `id_semester` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `subject_ue_id_ue` (`id_ue`),
  KEY `subject_ue_id_student` (`id_student`),
  KEY `subject_ue_id_semester` (`id_semester`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `student_ue`
--

INSERT INTO `student_ue` (`id`, `id_ue`, `average`, `id_student`, `id_semester`) VALUES
(6, 1, 6.01, 9, 24);

-- --------------------------------------------------------

--
-- Structure de la table `subject`
--

DROP TABLE IF EXISTS `subject`;
CREATE TABLE IF NOT EXISTS `subject` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL,
  `coefficient` float NOT NULL,
  `id_ue` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `subject_id_ue` (`id_ue`)
) ENGINE=InnoDB AUTO_INCREMENT=21 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `subject`
--

INSERT INTO `subject` (`id`, `name`, `coefficient`, `id_ue`) VALUES
(1, 'Introduction-apprentissage-Machine', 2, 1),
(2, 'Introduction-au-système-Linux', 2, 1),
(3, 'Analyse-financière', 1, 2),
(4, 'Dissertation-et-écriture-créative', 2, 2),
(5, 'Droit-des-sociétés-et-des-contrats', 1, 2),
(6, 'English-6-Business-Communication', 2, 2),
(7, 'Séminaire d\'orientation', 3, 3),
(8, 'Database', 3, 4),
(9, 'Object-oriented-Analysis-&-Design-with-UML', 1, 4),
(10, 'Computer-Architecture', 3, 5),
(11, 'Networks-and-Protocols', 3, 5),
(12, 'Operating-Systems', 3, 5),
(18, 'matière-1', 0.5, 14),
(20, 'matière-2', 0.5, 14);

-- --------------------------------------------------------

--
-- Structure de la table `td_group`
--

DROP TABLE IF EXISTS `td_group`;
CREATE TABLE IF NOT EXISTS `td_group` (
  `name` char(10) NOT NULL,
  `school` varchar(100) NOT NULL,
  PRIMARY KEY (`name`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `td_group`
--

INSERT INTO `td_group` (`name`, `school`) VALUES
('H', 'EFREI PARIS'),
('I', 'EFREI PARIS'),
('J', 'EFREI PARIS'),
('K', 'EFREI PARIS'),
('L', 'EFREI PARIS'),
('M', 'EFREI PARIS'),
('N', 'EFREI PARIS');

-- --------------------------------------------------------

--
-- Structure de la table `ue`
--

DROP TABLE IF EXISTS `ue`;
CREATE TABLE IF NOT EXISTS `ue` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(50) NOT NULL,
  `school` varchar(100) NOT NULL,
  `id_semester` int(11) NOT NULL,
  `coefficient` float NOT NULL,
  `level` char(2) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `ue_school` (`school`),
  KEY `ue_id_semester` (`id_semester`)
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `ue`
--

INSERT INTO `ue` (`id`, `name`, `school`, `id_semester`, `coefficient`, `level`) VALUES
(1, 'Electifs-Informatique', 'EFREI Paris', 24, 4, 'L3'),
(2, 'Formation-générale', 'EFREI Paris', 24, 5, 'L3'),
(3, 'Formation-professionnelle', 'EFREI Paris', 24, 3, 'L3'),
(4, 'Informatique-Applications', 'EFREI Paris', 24, 6, 'L3'),
(5, 'Informatique-Fondamentaux', 'EFREI Paris', 24, 9, 'L3'),
(14, 'test', 'EFREI Paris', 25, 0.5, NULL),
(15, 'test-2', 'EFREI Paris', 25, 0.25, NULL);

-- --------------------------------------------------------

--
-- Structure de la table `user`
--

DROP TABLE IF EXISTS `user`;
CREATE TABLE IF NOT EXISTS `user` (
  `email` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL,
  PRIMARY KEY (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `user`
--

INSERT INTO `user` (`email`, `password`) VALUES
('jacques.tellier@efrei.net', 'aCt5QU5UTTRMdnFDVXVrL2wxU1B2Zz09'),
('jacques.tellier@hotmail.com', 'aCt5QU5UTTRMdnFDVXVrL2wxU1B2Zz09'),
('manager@gmail.com', 'aCt5QU5UTTRMdnFDVXVrL2wxU1B2Zz09'),
('merouane.souadji@efrei.net', 'OEpqRUhlWDIwajlWZjhBZW16MTB0Zz09');

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `manager`
--
ALTER TABLE `manager`
  ADD CONSTRAINT `manager_email` FOREIGN KEY (`email`) REFERENCES `user` (`email`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `manager_school` FOREIGN KEY (`school`) REFERENCES `school` (`name`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Contraintes pour la table `mark`
--
ALTER TABLE `mark`
  ADD CONSTRAINT `mark_mark_type` FOREIGN KEY (`type`) REFERENCES `mark_type` (`name`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `mark_subject` FOREIGN KEY (`id_subject`) REFERENCES `subject` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Contraintes pour la table `semester`
--
ALTER TABLE `semester`
  ADD CONSTRAINT `semesters_school` FOREIGN KEY (`school`) REFERENCES `school` (`name`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Contraintes pour la table `student`
--
ALTER TABLE `student`
  ADD CONSTRAINT `student_email` FOREIGN KEY (`email`) REFERENCES `user` (`email`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `student_promotion` FOREIGN KEY (`promotion`) REFERENCES `promotion` (`year`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `student_school` FOREIGN KEY (`school`) REFERENCES `school` (`name`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Contraintes pour la table `student_marks`
--
ALTER TABLE `student_marks`
  ADD CONSTRAINT `student_marks_id_mark` FOREIGN KEY (`id_mark`) REFERENCES `mark` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `student_marks_id_student` FOREIGN KEY (`id_student`) REFERENCES `student` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `student_marks_id_subject` FOREIGN KEY (`id_subject`) REFERENCES `subject` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Contraintes pour la table `student_semester`
--
ALTER TABLE `student_semester`
  ADD CONSTRAINT `student_semester_id_student` FOREIGN KEY (`id_student`) REFERENCES `student` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `student_semester_semesters` FOREIGN KEY (`id_semester`) REFERENCES `semester` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Contraintes pour la table `student_subject`
--
ALTER TABLE `student_subject`
  ADD CONSTRAINT `student_subject_id_student` FOREIGN KEY (`id_student`) REFERENCES `student` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `student_subject_id_subject` FOREIGN KEY (`id_subject`) REFERENCES `subject` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `student_subject_id_ue` FOREIGN KEY (`id_ue`) REFERENCES `ue` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Contraintes pour la table `student_ue`
--
ALTER TABLE `student_ue`
  ADD CONSTRAINT `subject_ue_id_semester` FOREIGN KEY (`id_semester`) REFERENCES `semester` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `subject_ue_id_student` FOREIGN KEY (`id_student`) REFERENCES `student` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `subject_ue_id_ue` FOREIGN KEY (`id_ue`) REFERENCES `ue` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Contraintes pour la table `subject`
--
ALTER TABLE `subject`
  ADD CONSTRAINT `subject_id_ue` FOREIGN KEY (`id_ue`) REFERENCES `ue` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Contraintes pour la table `ue`
--
ALTER TABLE `ue`
  ADD CONSTRAINT `ue_id_semester` FOREIGN KEY (`id_semester`) REFERENCES `semester` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `ue_school` FOREIGN KEY (`school`) REFERENCES `school` (`name`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
