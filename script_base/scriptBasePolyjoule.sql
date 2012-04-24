-- phpMyAdmin SQL Dump
-- version 3.3.9.2
-- http://www.phpmyadmin.net
--
-- Serveur: localhost
-- Généré le : Mer 25 Avril 2012 à 00:05
-- Version du serveur: 5.5.9
-- Version de PHP: 5.3.6

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Base de données: `test`
--

-- --------------------------------------------------------

--
-- Structure de la table `AFFICHE`
--

CREATE TABLE `AFFICHE` (
  `id_photo` int(11) NOT NULL,
  `id_article` int(11) NOT NULL,
  PRIMARY KEY (`id_photo`,`id_article`),
  KEY `FK_AFFICHE_id_article` (`id_article`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Contenu de la table `AFFICHE`
--


-- --------------------------------------------------------

--
-- Structure de la table `ALBUM`
--

CREATE TABLE `ALBUM` (
  `id_album` int(11) NOT NULL AUTO_INCREMENT,
  `nom_album` varchar(30) DEFAULT NULL,
  `date_album` datetime NOT NULL,
  `descFR_album` text,
  `descEN_album` text,
  PRIMARY KEY (`id_album`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=6 ;

--
-- Contenu de la table `ALBUM`
--


-- --------------------------------------------------------

--
-- Structure de la table `APPARTIENT`
--

CREATE TABLE `APPARTIENT` (
  `id_participant` int(11) NOT NULL,
  `id_formation` int(11) NOT NULL,
  PRIMARY KEY (`id_participant`,`id_formation`),
  KEY `FK_APPARTIENT_id_formation` (`id_formation`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Contenu de la table `APPARTIENT`
--


-- --------------------------------------------------------

--
-- Structure de la table `ARTICLE`
--

CREATE TABLE `ARTICLE` (
  `id_article` int(11) NOT NULL AUTO_INCREMENT,
  `id_rubrique` int(11) DEFAULT NULL,
  `auteur_article` varchar(50) DEFAULT NULL,
  `titreFR_article` text,
  `titreEN_article` text,
  `contenuFR_article` text,
  `contenuEN_article` text,
  `autorisation_com` tinyint(1) DEFAULT NULL,
  `statut_article` tinyint(1) DEFAULT NULL,
  `date_article` datetime NOT NULL,
  `url_photo_principale` varchar(100) NOT NULL,
  `visible_home` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id_article`),
  KEY `FK_ARTICLE_id_rubrique` (`id_rubrique`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=41 ;

--
-- Contenu de la table `ARTICLE`
--


-- --------------------------------------------------------

--
-- Structure de la table `COMMENTAIRE`
--

CREATE TABLE `COMMENTAIRE` (
  `id_commentaire` int(11) NOT NULL AUTO_INCREMENT,
  `id_article` int(11) NOT NULL,
  `date_commentaire` datetime DEFAULT NULL,
  `posteur_commentaire` varchar(30) DEFAULT NULL,
  `mail_commentaire` varchar(50) DEFAULT NULL,
  `message_commentaire` text,
  PRIMARY KEY (`id_commentaire`),
  KEY `FK_COMMENTAIRE_id_article` (`id_article`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=6 ;

--
-- Contenu de la table `COMMENTAIRE`
--


-- --------------------------------------------------------

--
-- Structure de la table `COMPOSE`
--

CREATE TABLE `COMPOSE` (
  `id_participant` int(11) NOT NULL,
  `id_equipe` int(11) NOT NULL,
  PRIMARY KEY (`id_participant`,`id_equipe`),
  KEY `FK_COMPOSE_id_equipe` (`id_equipe`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Contenu de la table `COMPOSE`
--


-- --------------------------------------------------------

--
-- Structure de la table `COURSE`
--

CREATE TABLE `COURSE` (
  `id_course` int(11) NOT NULL AUTO_INCREMENT,
  `id_equipe` int(11) NOT NULL,
  `date_course` datetime NOT NULL,
  `lieu_course` varchar(30) DEFAULT NULL,
  `img_course` varchar(100) DEFAULT NULL,
  `descFR_course` text,
  `descEN_course` text,
  PRIMARY KEY (`id_course`),
  KEY `FK_COURSE_id_equipe` (`id_equipe`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

--
-- Contenu de la table `COURSE`
--


-- --------------------------------------------------------

--
-- Structure de la table `ECOLE`
--

CREATE TABLE `ECOLE` (
  `id_ecole` int(11) NOT NULL AUTO_INCREMENT,
  `nom_ecole` varchar(30) DEFAULT NULL,
  `adresse_ecole` varchar(100) DEFAULT NULL,
  `photo_ecole` varchar(100) DEFAULT NULL,
  `descFR_ecole` text,
  `descEN_ecole` text,
  PRIMARY KEY (`id_ecole`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=4 ;

--
-- Contenu de la table `ECOLE`
--


-- --------------------------------------------------------

--
-- Structure de la table `EQUIPE`
--

CREATE TABLE `EQUIPE` (
  `id_equipe` int(11) NOT NULL AUTO_INCREMENT,
  `annee_equipe` int(4) DEFAULT NULL,
  PRIMARY KEY (`id_equipe`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=4 ;

--
-- Contenu de la table `EQUIPE`
--


-- --------------------------------------------------------

--
-- Structure de la table `FORMATION`
--

CREATE TABLE `FORMATION` (
  `id_formation` int(11) NOT NULL AUTO_INCREMENT,
  `id_ecole` int(11) NOT NULL,
  `titreFR_formation` varchar(100) DEFAULT NULL,
  `titreEN_formation` varchar(100) DEFAULT NULL,
  `lien_formation` varchar(100) DEFAULT NULL,
  `descFR_formation` text,
  `descEN_formation` text,
  PRIMARY KEY (`id_formation`),
  KEY `FK_FORMATION_id_ecole` (`id_ecole`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=4 ;

--
-- Contenu de la table `FORMATION`
--


-- --------------------------------------------------------

--
-- Structure de la table `LIVRE_OR`
--

CREATE TABLE `LIVRE_OR` (
  `id_post` int(11) NOT NULL AUTO_INCREMENT,
  `posteur_post` varchar(30) DEFAULT NULL,
  `mail_post` varchar(100) DEFAULT NULL,
  `date_post` datetime NOT NULL,
  `message_post` text,
  `accept_post` int(1) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`id_post`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=13 ;

--
-- Contenu de la table `LIVRE_OR`
--


-- --------------------------------------------------------

--
-- Structure de la table `MEMBRE`
--

CREATE TABLE `MEMBRE` (
  `id_membre` int(11) NOT NULL AUTO_INCREMENT,
  `pseudo_membre` varchar(30) NOT NULL DEFAULT '',
  `mdp_membre` varchar(150) DEFAULT NULL,
  `mail_membre` varchar(100) DEFAULT NULL,
  `statut_membre` varchar(30) DEFAULT NULL,
  `photo_membre` varchar(150) DEFAULT NULL,
  `date_inscription` datetime DEFAULT NULL,
  PRIMARY KEY (`id_membre`,`pseudo_membre`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=17 ;

--
-- Contenu de la table `MEMBRE`
--


-- --------------------------------------------------------

--
-- Structure de la table `OBTIENT`
--

CREATE TABLE `OBTIENT` (
  `id_equipe` int(11) NOT NULL,
  `id_course` int(11) NOT NULL,
  `id_resultat` int(11) NOT NULL,
  PRIMARY KEY (`id_equipe`,`id_course`,`id_resultat`),
  KEY `FK_OBTIENT_id_course` (`id_course`),
  KEY `FK_OBTIENT_id_resultat` (`id_resultat`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Contenu de la table `OBTIENT`
--


-- --------------------------------------------------------

--
-- Structure de la table `PARTENAIRE`
--

CREATE TABLE `PARTENAIRE` (
  `id_partenaire` int(11) NOT NULL AUTO_INCREMENT,
  `id_article` int(11) NOT NULL,
  `nom_partenaire` varchar(100) DEFAULT NULL,
  `logo_partenaire` varchar(100) DEFAULT NULL,
  `site_partenaire` varchar(100) DEFAULT NULL,
  `descFR_partenaire` text,
  `descEN_partenaire` text,
  PRIMARY KEY (`id_partenaire`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=9 ;

--
-- Contenu de la table `PARTENAIRE`
--


-- --------------------------------------------------------

--
-- Structure de la table `PARTICIPANT`
--

CREATE TABLE `PARTICIPANT` (
  `id_participant` int(11) NOT NULL AUTO_INCREMENT,
  `id_equipe` int(11) NOT NULL,
  `nom_participant` varchar(30) DEFAULT NULL,
  `prenom_participant` varchar(30) DEFAULT NULL,
  `photo_participant` varchar(100) DEFAULT NULL,
  `mail_participant` varchar(100) DEFAULT NULL,
  `role_participant` varchar(100) DEFAULT NULL,
  `bioFR_participant` text,
  `bioEN_participant` text,
  `isProf` tinyint(1) NOT NULL,
  PRIMARY KEY (`id_participant`),
  KEY `FK_PARTICIPANT_id_equipe` (`id_equipe`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=7 ;

--
-- Contenu de la table `PARTICIPANT`
--


-- --------------------------------------------------------

--
-- Structure de la table `PHOTO`
--

CREATE TABLE `PHOTO` (
  `id_photo` int(11) NOT NULL AUTO_INCREMENT,
  `id_album` int(11) DEFAULT NULL,
  `titreFR_photo` varchar(50) DEFAULT NULL,
  `titreEN_photo` varchar(50) DEFAULT NULL,
  `lien_photo` varchar(100) DEFAULT NULL,
  `date_photo` datetime NOT NULL,
  `descFR_photo` text,
  `descEN_photo` text,
  PRIMARY KEY (`id_photo`),
  KEY `FK_PHOTO_id_album` (`id_album`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=18 ;

--
-- Contenu de la table `PHOTO`
--


-- --------------------------------------------------------

--
-- Structure de la table `RESULTAT`
--

CREATE TABLE `RESULTAT` (
  `id_resultat` int(11) NOT NULL AUTO_INCREMENT,
  `position_resultat` int(11) DEFAULT NULL,
  `record_resultat` text,
  PRIMARY KEY (`id_resultat`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

--
-- Contenu de la table `RESULTAT`
--


-- --------------------------------------------------------

--
-- Structure de la table `RUBRIQUE`
--

CREATE TABLE `RUBRIQUE` (
  `id_rubrique` int(11) NOT NULL AUTO_INCREMENT,
  `id_mere` int(11) DEFAULT NULL,
  `id_template` int(11) DEFAULT '1',
  `titreFR_rubrique` varchar(100) DEFAULT NULL,
  `titreEN_rubrique` varchar(100) DEFAULT NULL,
  `descFR_rubrique` text,
  `descEN_rubrique` text,
  PRIMARY KEY (`id_rubrique`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=16 ;

--
-- Contenu de la table `RUBRIQUE`
--

INSERT INTO `RUBRIQUE` VALUES(1, NULL, 1, 'Notre association', 'Our association', NULL, NULL);
INSERT INTO `RUBRIQUE` VALUES(2, NULL, 1, 'Shell Eco 2012', 'Shell Eco 2012', NULL, NULL);
INSERT INTO `RUBRIQUE` VALUES(6, NULL, 1, 'Partenaires', 'Partners', NULL, NULL);
INSERT INTO `RUBRIQUE` VALUES(7, NULL, 1, 'Actualites H2', 'News H2', NULL, NULL);
INSERT INTO `RUBRIQUE` VALUES(8, NULL, 1, 'Urban Concept', 'Urban Concept', NULL, NULL);
INSERT INTO `RUBRIQUE` VALUES(9, NULL, 1, 'Actu Polyjoule', 'News Polyjoule', NULL, NULL);
INSERT INTO `RUBRIQUE` VALUES(10, 1, 4, 'Livre d''or', 'Guest book', NULL, NULL);
INSERT INTO `RUBRIQUE` VALUES(11, NULL, 2, 'Album photo', 'Photograph album', NULL, NULL);
INSERT INTO `RUBRIQUE` VALUES(12, 1, 5, 'Personnages Clés', 'Key Persons', NULL, NULL);
INSERT INTO `RUBRIQUE` VALUES(14, 1, 3, 'Historique', 'Historique', 'Découvrez ici les anciennes équipes', 'Discover the old school');

-- --------------------------------------------------------

--
-- Structure de la table `SPONSORISE`
--

CREATE TABLE `SPONSORISE` (
  `id_equipe` int(11) NOT NULL,
  `id_partenaire` int(11) NOT NULL,
  PRIMARY KEY (`id_equipe`,`id_partenaire`),
  KEY `FK_SPONSORISE_id_partenaire` (`id_partenaire`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Contenu de la table `SPONSORISE`
--


-- --------------------------------------------------------

--
-- Structure de la table `TEMPLATE`
--

CREATE TABLE `TEMPLATE` (
  `id` int(11) NOT NULL,
  `description` varchar(100) NOT NULL,
  `template` varchar(100) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Contenu de la table `TEMPLATE`
--

INSERT INTO `TEMPLATE` VALUES(1, 'Liste des articles', 'rubrique');
INSERT INTO `TEMPLATE` VALUES(2, 'Liste des albums photo', 'albums');
INSERT INTO `TEMPLATE` VALUES(3, 'Liste des equipes', 'historique');
INSERT INTO `TEMPLATE` VALUES(4, 'Livre d''or', 'livreor');
INSERT INTO `TEMPLATE` VALUES(5, 'Liste des personnes', 'personnages');

--
-- Contraintes pour les tables exportées
--

--
-- Contraintes pour la table `AFFICHE`
--
ALTER TABLE `AFFICHE`
  ADD CONSTRAINT `FK_AFFICHE_id_article` FOREIGN KEY (`id_article`) REFERENCES `ARTICLE` (`id_article`),
  ADD CONSTRAINT `FK_AFFICHE_id_photo` FOREIGN KEY (`id_photo`) REFERENCES `PHOTO` (`id_photo`);

--
-- Contraintes pour la table `APPARTIENT`
--
ALTER TABLE `APPARTIENT`
  ADD CONSTRAINT `FK_APPARTIENT_id_formation` FOREIGN KEY (`id_formation`) REFERENCES `FORMATION` (`id_formation`),
  ADD CONSTRAINT `FK_APPARTIENT_id_participant` FOREIGN KEY (`id_participant`) REFERENCES `PARTICIPANT` (`id_participant`);

--
-- Contraintes pour la table `ARTICLE`
--
ALTER TABLE `ARTICLE`
  ADD CONSTRAINT `FK_ARTICLE_id_rubrique` FOREIGN KEY (`id_rubrique`) REFERENCES `RUBRIQUE` (`id_rubrique`) ON DELETE SET NULL;

--
-- Contraintes pour la table `COMMENTAIRE`
--
ALTER TABLE `COMMENTAIRE`
  ADD CONSTRAINT `FK_COMMENTAIRE_id_article` FOREIGN KEY (`id_article`) REFERENCES `ARTICLE` (`id_article`);

--
-- Contraintes pour la table `COMPOSE`
--
ALTER TABLE `COMPOSE`
  ADD CONSTRAINT `FK_COMPOSE_id_equipe` FOREIGN KEY (`id_equipe`) REFERENCES `EQUIPE` (`id_equipe`),
  ADD CONSTRAINT `FK_COMPOSE_id_participant` FOREIGN KEY (`id_participant`) REFERENCES `PARTICIPANT` (`id_participant`);

--
-- Contraintes pour la table `COURSE`
--
ALTER TABLE `COURSE`
  ADD CONSTRAINT `FK_COURSE_id_equipe` FOREIGN KEY (`id_equipe`) REFERENCES `EQUIPE` (`id_equipe`);

--
-- Contraintes pour la table `FORMATION`
--
ALTER TABLE `FORMATION`
  ADD CONSTRAINT `FK_FORMATION_id_ecole` FOREIGN KEY (`id_ecole`) REFERENCES `ECOLE` (`id_ecole`);

--
-- Contraintes pour la table `OBTIENT`
--
ALTER TABLE `OBTIENT`
  ADD CONSTRAINT `FK_OBTIENT_id_resultat` FOREIGN KEY (`id_resultat`) REFERENCES `RESULTAT` (`id_resultat`),
  ADD CONSTRAINT `FK_OBTIENT_id_course` FOREIGN KEY (`id_course`) REFERENCES `COURSE` (`id_course`),
  ADD CONSTRAINT `FK_OBTIENT_id_equipe` FOREIGN KEY (`id_equipe`) REFERENCES `EQUIPE` (`id_equipe`);

--
-- Contraintes pour la table `PARTICIPANT`
--
ALTER TABLE `PARTICIPANT`
  ADD CONSTRAINT `FK_PARTICIPANT_id_equipe` FOREIGN KEY (`id_equipe`) REFERENCES `EQUIPE` (`id_equipe`) ON DELETE CASCADE;

--
-- Contraintes pour la table `PHOTO`
--
ALTER TABLE `PHOTO`
  ADD CONSTRAINT `FK_PHOTO_id_album` FOREIGN KEY (`id_album`) REFERENCES `ALBUM` (`id_album`) ON DELETE SET NULL;

--
-- Contraintes pour la table `SPONSORISE`
--
ALTER TABLE `SPONSORISE`
  ADD CONSTRAINT `FK_SPONSORISE_id_partenaire` FOREIGN KEY (`id_partenaire`) REFERENCES `PARTENAIRE` (`id_partenaire`),
  ADD CONSTRAINT `FK_SPONSORISE_id_equipe` FOREIGN KEY (`id_equipe`) REFERENCES `EQUIPE` (`id_equipe`);
