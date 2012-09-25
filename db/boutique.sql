-- phpMyAdmin SQL Dump
-- version 3.4.5deb1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Dec 12, 2011 at 06:06 PM
-- Server version: 5.1.58
-- PHP Version: 5.3.6-13ubuntu3.2

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `boutique`
--

-- --------------------------------------------------------

--
-- Table structure for table `shop_auteurs`
--

CREATE TABLE IF NOT EXISTS `shop_auteurs` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `nom` varchar(64) NOT NULL,
  `prenom` varchar(64) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=10 ;

--
-- Dumping data for table `shop_auteurs`
--

INSERT INTO `shop_auteurs` (`id`, `nom`, `prenom`) VALUES
(1, 'Bernier', 'Robert'),
(2, 'Farthing', 'Stephen'),
(3, 'Collectif', ''),
(4, 'Hervé', 'Corinne'),
(5, 'Shwartz', 'Thibaud'),
(6, 'Microsoft Office', ''),
(7, 'Aumard', 'Céline'),
(8, 'Abou', 'Olivier'),
(9, 'Lesage', 'Jérôme');

-- --------------------------------------------------------

--
-- Table structure for table `shop_categorie`
--

CREATE TABLE IF NOT EXISTS `shop_categorie` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `libelle` varchar(64) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `shop_categorie`
--

INSERT INTO `shop_categorie` (`id`, `libelle`) VALUES
(1, 'Art'),
(2, 'Informatique');

-- --------------------------------------------------------

--
-- Table structure for table `shop_client`
--

CREATE TABLE IF NOT EXISTS `shop_client` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `mail` varchar(64) NOT NULL,
  `nom` varchar(64) NOT NULL,
  `prenom` varchar(64) NOT NULL,
  `telephone` varchar(10) NOT NULL,
  `mdp` varchar(32) NOT NULL,
  `ad_ligne1` varchar(64) NOT NULL,
  `ad_ligne2` varchar(64) NOT NULL,
  `ad_cp` varchar(5) NOT NULL,
  `ad_ville` varchar(64) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `mail` (`mail`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=7 ;

--
-- Dumping data for table `shop_client`
--

INSERT INTO `shop_client` (`id`, `mail`, `nom`, `prenom`, `telephone`, `mdp`, `ad_ligne1`, `ad_ligne2`, `ad_cp`, `ad_ville`) VALUES
(1, 'lavclai@gmail.com', 'Lavoie', 'Claire', '4505551234', 'passe01', '123 Lavoie', '', 'J1T4T', 'Granby'),
(2, 'carada@gmail.com', 'Carrier', 'Adam', '4505551235', 'passe02', '456 Court', '', 'J2T4T', 'Granby'),
(3, 'lamcla@gmail.com', 'Lamarche', 'Claire', '4505551236', 'passe03', '444 Centre', '', 'J3T4T', 'Granby'),
(4, 'aucluc@gmail.com', 'Auclair', 'Lucie', '4505557777', 'passe04', '666 Main', '', 'J4T4T', 'Granby'),
(5, 'bermar@gmail.com', 'Bernier', 'Marie', '4505558888', 'passe05', '555 La Rue', '', 'J5T4T', 'Granby'),
(6, 'trecha@gmail.com', 'Tremblay', 'Charles', '450-555-45', '544f7a1bcb58fb083285f68d362b5fdc', '888 Main', '', 'J2G 5', 'Granby');

-- --------------------------------------------------------

--
-- Table structure for table `shop_commande`
--

CREATE TABLE IF NOT EXISTS `shop_commande` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `client` varchar(64) NOT NULL,
  `date` date NOT NULL,
  `total_ht` float NOT NULL,
  `total_ttc` float NOT NULL,
  `expedition` char(1) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `client` (`client`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `shop_commande`
--

INSERT INTO `shop_commande` (`id`, `client`, `date`, `total_ht`, `total_ttc`, `expedition`) VALUES
(1, '6', '2011-12-07', 189.75, 218.22, 'S');

-- --------------------------------------------------------

--
-- Table structure for table `shop_ligne_commande`
--

CREATE TABLE IF NOT EXISTS `shop_ligne_commande` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `commande` int(10) unsigned NOT NULL,
  `article` int(10) unsigned NOT NULL,
  `prix_ht` float NOT NULL,
  `prix_ttc` float NOT NULL,
  `quantite` int(11) NOT NULL,
  `total_ht` float NOT NULL,
  `total_ttc` float NOT NULL,
  PRIMARY KEY (`id`),
  KEY `article` (`article`),
  KEY `commande` (`commande`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `shop_ligne_commande`
--

INSERT INTO `shop_ligne_commande` (`id`, `commande`, `article`, `prix_ht`, `prix_ttc`, `quantite`, `total_ht`, `total_ttc`) VALUES
(1, 1, 3, 49.95, 57.45, 2, 99.9, 114.9),
(2, 1, 5, 29.95, 34.44, 3, 89.85, 103.32);

-- --------------------------------------------------------

--
-- Table structure for table `shop_livres`
--

CREATE TABLE IF NOT EXISTS `shop_livres` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `isbn` varchar(10) NOT NULL,
  `categorie` int(11) unsigned NOT NULL,
  `sous_categorie` int(11) unsigned NOT NULL,
  `titre` text NOT NULL,
  `prix_ht` float NOT NULL,
  `prix_ttc` float NOT NULL,
  `parution` date NOT NULL,
  `resume` text NOT NULL,
  `auteur` int(11) unsigned NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `isbn` (`isbn`),
  KEY `rubannu1` (`categorie`),
  KEY `rubannu2` (`sous_categorie`),
  KEY `auteur` (`auteur`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=13 ;

--
-- Dumping data for table `shop_livres`
--

INSERT INTO `shop_livres` (`id`, `isbn`, `categorie`, `sous_categorie`, `titre`, `prix_ht`, `prix_ttc`, `parution`, `resume`, `auteur`) VALUES
(1, '2895683575', 1, 1, 'Les 1001 tableaux qu''il faut avoir vus dans sa vie', 34.95, 40.19, '2008-02-05', 'De 1500 av. J.-C. à nos jours, des somptueuses fresques de l''Égypte ancienne jusqu''aux tableaux les plus contemporains, cet ouvrage présente les oeuvres qui ont marqué l''histoire de la peinture. De consultation aisée et comportant des centaines d''illustrations, le livre embrasse toutes les cultures et tous les styles de peinture et sera une référence pour les amateurs d''art. Il propose une recension mondiale des oeuvres picturales, classées par ordre chronologique. Pour chacune des oeuvres présentées, le lecteur trouvera de l''information sur l''histoire du tableau et le contexte dans lequel il fut créé, sur son auteur et sur le courant pictural dans lequel il se situe. L''ouvrage propose aussi deux index qui permettent une recherche par titre d''oeuvre ou par nom d''artiste.', 2),
(2, '2761915663', 1, 1, 'Peinture au Québec depuis les années 1960', 39.95, 45.94, '2002-11-08', 'Dans cet ouvrage, Robert Bernier présente un panorama de la peinture québécoise depuis la Révolution tranquille jusqu''à aujourd''hui. Il interprète les grands courants - surréalisme, pop art, expressionnisme, réalisme et autres - qui, sans être forcément des mouvements organisés, ont particulièrement marqué l''expression picturale des quarante dernières années. Tenant compte à la fois des réalités artistiques et sociologiques, l''auteur nous propose une réflexion sur les diverses manières d''aborder les oeuvres et sur les techniques utilisées par les artistes, tout en nous suggérant des pistes de lecture.', 1),
(3, '2761930253', 1, 1, 'Marc-Aurèle Fortin', 49.95, 57.45, '2011-02-09', 'Bien connu pour ses célèbres paysages mettant en vedette de grands arbres verts, Marc-Aurèle Fortin (1888-1970) est l''un des artistes les plus populaires et appréciés de l''histoire de l''art québécois. Son oeuvre témoigne d''une puissance d''expression exceptionnellement féconde, depuis les premières peintures réalisées à Chicago en 1909 ou les vues de Montréal et de la région métropolitaine dans les années 1920 et 1930, jusqu''aux paysages de Charlevoix, de la Gaspésie et du Saguenay durant les années 1940. Ce livre, illustré de plus de 150 peintures, aquarelles, eaux-fortes et pastels, rend compte de la modernité de cet excellent dessinateur et coloriste, et témoigne des diverses étapes d''une démarche artistique remarquable, placée sous le signe de l''exploration et de la liberté.', 3),
(4, '2746068230', 2, 2, 'Publisher 2010', 29.95, 34.44, '2011-11-08', 'Ce livre sur Microsoft® Publisher 2010 a été conçu pour vous permettre de retrouver rapidement toutes les fonctions de ce logiciel de PAO : après une présentation de l’environnement qui inclut désormais le ruban et l’onglet Fichier, vous découvrirez comment créer votre première composition en vous aidant des nombreux modèles mis à votre disposition par Publisher et comment y insérer les principaux éléments de mise en page (repères et règles, pages maîtres, cadres de texte, jeux de polices et jeux de couleurs, blocs de construction...). Vous apprendrez ensuite à saisir et à modifier le texte de la composition puis à le mettre en forme. Vous enrichirez votre composition en y insérant dessins, images, tableaux et tout objet graphique ; vous serez alors fin prêt pour imprimer cette composition. À la fin de ce livre, vous verrez comment réaliser un mailing (création et envoi de lettre-type par courrier ou par mail) à l’aide de Publisher et découvrirez quelques fonctions spécifiques telles que l’exportation des compositions, la personnalisation du ruban et de la barre d’outils Accès rapide.', 4),
(5, '2822400480', 2, 2, 'Office 2010', 29.95, 34.44, '2011-11-14', 'Le guide complet Microsoft Office 2010 : la meilleure façon de faire le tour du sujet ! Destinée aussi bien aux débutants qu''aux utilisateurs initiés, la collection guide complet repose sur une méthode essentiellement pratique. Découvrez la suite bureautique Microsoft Office 2010 : Word, Excel, PowerPoint, One Note et Outlook. L''utilisateur découvre les bases des différents logiciels, puis les fonctions avancées de chacun d''entre eux. L''ouvrage se termine par un chapitre dédié au travail collectif sur Office 2010.', 5),
(6, '2746065529', 2, 2, 'Word 2010:préparation à l''examen microsoft office specialist (77-881)', 34.95, 40.19, '2011-08-09', 'Ouvrage qui présente toutes les fonctionnalités de base de la dernière version du logiciel de traitement de texte et permet de se préparer à l''examen grâce aux nombreux exercices, auxquels sont associés des fichiers téléchargeables.', 6),
(7, '2822400268', 2, 3, 'Google:profitez de tous les services gratuits de google', 19.95, 22.94, '2011-11-14', 'Profitez de tous les services gratuits de Google Finis les manuels d’utilisation obscurs et incompréhensibles ! Avec ce Mode d’emploi complet, vous disposez enfin d’un guide clair, pratique et en couleurs pour exploiter toutes les fonctionnalités de Google™ ! Google est le moteur de recherche n°1. Mais cet outil propose bien plus de choses ! En effet, Google offre de nombreuses applications gratuites qui permettent aux internautes de se simplifier la vie ! Ainsi pour travailler et échanger en ligne, Google propose des outils tels que Gmail, Google Agenda, Sites ou Groups.', 7),
(8, '2822400282', 2, 3, 'Twitter', 19.95, 22.94, '2011-11-14', 'Guide complet pour une utilisation efficace', 8),
(9, '2822400046', 2, 3, 'Facebook:les secrets', 17.95, 20.64, '2011-10-04', 'Facebook:les secrets', 8),
(10, '2822400367', 2, 4, 'Photoshop cs5.5', 29.95, 34.44, '2011-11-14', 'Photoshop cs5.5', 9),
(11, '2300032370', 2, 4, '50 ateliers pour photoshop cs5', 29.95, 34.44, '2010-11-30', '50 ateliers pour photoshop cs5', 9),
(12, '2300021534', 2, 4, 'Photoshop cs4', 24.95, 28.69, '2009-08-09', 'Photoshop cs4', 9);

-- --------------------------------------------------------

--
-- Table structure for table `shop_panier`
--

CREATE TABLE IF NOT EXISTS `shop_panier` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `client` varchar(64) NOT NULL,
  `article` int(10) unsigned NOT NULL,
  `quantite` int(10) unsigned NOT NULL,
  PRIMARY KEY (`id`),
  KEY `client` (`client`,`article`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=7 ;

-- --------------------------------------------------------

--
-- Table structure for table `shop_propositions`
--

CREATE TABLE IF NOT EXISTS `shop_propositions` (
  `article1` int(10) unsigned NOT NULL,
  `article2` int(10) unsigned NOT NULL,
  `quantite` int(10) unsigned NOT NULL,
  KEY `article1` (`article1`,`article2`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `shop_sous_categorie`
--

CREATE TABLE IF NOT EXISTS `shop_sous_categorie` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `libelle` varchar(64) NOT NULL,
  `parent` int(11) unsigned NOT NULL,
  PRIMARY KEY (`id`),
  KEY `parent` (`parent`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=5 ;

--
-- Dumping data for table `shop_sous_categorie`
--

INSERT INTO `shop_sous_categorie` (`id`, `libelle`, `parent`) VALUES
(1, 'Peinture', 1),
(2, 'Bureautique', 2),
(3, 'Internet', 2),
(4, 'Graphisme', 2);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
