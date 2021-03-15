-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le :  jeu. 11 mars 2021 à 19:17
-- Version du serveur :  5.7.26
-- Version de PHP :  7.2.18

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données :  `citrouille`
--

-- --------------------------------------------------------

--
-- Structure de la table `image`
--

DROP TABLE IF EXISTS `image`;
CREATE TABLE IF NOT EXISTS `image` (
  `image_id` int(11) NOT NULL AUTO_INCREMENT,
  `image_nom` varchar(40) NOT NULL,
  `image_url` varchar(2083) NOT NULL,
  PRIMARY KEY (`image_id`)
) ENGINE=MyISAM AUTO_INCREMENT=11 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `image`
--

INSERT INTO `image` (`image_id`, `image_nom`, `image_url`) VALUES
(1, 'Biche', 'Citrouille\\Images\\liste_Animaux\\biche.jpg'),
(2, 'Chameau', 'Citrouille\\Images\\liste_Animaux\\chameau.jpg'),
(3, 'Chat', 'Citrouille\\Images\\liste_Animaux\\chat.jpg'),
(4, 'Cheval', 'Citrouille\\Images\\liste_Animaux\\cheval.jpg'),
(5, 'Chèvre', 'Citrouille\\Images\\liste_Animaux\\chevre.jpg'),
(6, 'Chien', 'Citrouille\\Images\\liste_Animaux\\chien.jpg'),
(7, 'Coq', 'Citrouille\\Images\\liste_Animaux\\coq.jpg'),
(8, 'Poisson', 'Citrouille\\Images\\liste_Animaux\\poisson.jpg'),
(9, 'Souris', 'Citrouille\\Images\\liste_Animaux\\souris.jpg'),
(10, 'Taureau', 'Citrouille\\Images\\liste_Animaux\\taureau.jpg');

-- --------------------------------------------------------

--
-- Structure de la table `liste`
--

DROP TABLE IF EXISTS `liste`;
CREATE TABLE IF NOT EXISTS `liste` (
  `liste_id` int(11) NOT NULL AUTO_INCREMENT,
  `liste_nom` varchar(40) NOT NULL,
  `liste_creation_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`liste_id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `liste`
--

INSERT INTO `liste` (`liste_id`, `liste_nom`, `liste_creation_date`) VALUES
(1, 'Animaux', '2021-03-11 19:12:40');

-- --------------------------------------------------------

--
-- Structure de la table `mot`
--

DROP TABLE IF EXISTS `mot`;
CREATE TABLE IF NOT EXISTS `mot` (
  `mot_id` int(11) NOT NULL AUTO_INCREMENT,
  `liste_id` int(11) NOT NULL,
  `image_id` int(11) NOT NULL,
  `mot_nom` varchar(40) NOT NULL,
  PRIMARY KEY (`mot_id`),
  KEY `fk_image_id` (`image_id`),
  KEY `fk_type_liste_id` (`liste_id`)
) ENGINE=MyISAM AUTO_INCREMENT=11 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `mot`
--

INSERT INTO `mot` (`mot_id`, `liste_id`, `image_id`, `mot_nom`) VALUES
(1, 1, 1, 'Biche'),
(2, 1, 2, 'Chameau'),
(3, 1, 3, 'Chat'),
(4, 1, 4, 'Cheval'),
(5, 1, 5, 'Chèvre'),
(6, 1, 6, 'Chien'),
(7, 1, 7, 'Coq'),
(8, 1, 8, 'Poisson'),
(9, 1, 9, 'Souris'),
(10, 1, 10, 'Taureau');

-- --------------------------------------------------------

--
-- Structure de la table `note`
--

DROP TABLE IF EXISTS `note`;
CREATE TABLE IF NOT EXISTS `note` (
  `note_id` int(11) NOT NULL AUTO_INCREMENT,
  `liste_id` int(11) NOT NULL,
  `utilisateur_id` int(11) NOT NULL,
  `note` int(11) NOT NULL,
  `note_appreciation` varchar(40) NOT NULL,
  PRIMARY KEY (`note_id`),
  KEY `fk_type_liste_id` (`liste_id`),
  KEY `fk_type_utilisateur_id` (`utilisateur_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `role`
--

DROP TABLE IF EXISTS `role`;
CREATE TABLE IF NOT EXISTS `role` (
  `role_id` int(11) NOT NULL AUTO_INCREMENT,
  `role_nom` varchar(40) NOT NULL,
  PRIMARY KEY (`role_id`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `role`
--

INSERT INTO `role` (`role_id`, `role_nom`) VALUES
(1, 'Elève'),
(2, 'Enseignant');

-- --------------------------------------------------------

--
-- Structure de la table `utilisateur`
--

DROP TABLE IF EXISTS `utilisateur`;
CREATE TABLE IF NOT EXISTS `utilisateur` (
  `utilisateur_id` int(11) NOT NULL AUTO_INCREMENT,
  `role_id` int(11) NOT NULL,
  `utilisateur_nom` varchar(40) NOT NULL,
  `utilisateur_prenom` varchar(40) NOT NULL,
  `utilisateur_email` varchar(40) NOT NULL,
  `utilisateur_login` varchar(40) NOT NULL,
  `utilisateur_password` varchar(40) NOT NULL,
  `utilisateur_creation_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`utilisateur_id`),
  KEY `fk_role_id` (`role_id`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `utilisateur`
--

INSERT INTO `utilisateur` (`utilisateur_id`, `role_id`, `utilisateur_nom`, `utilisateur_prenom`, `utilisateur_email`, `utilisateur_login`, `utilisateur_password`, `utilisateur_creation_date`) VALUES
(1, 2, 'ZOLA', 'Voldi', 'voldi.zola@edu.itescia.fr', 'vzola', 'zvoldi', '2021-03-11 17:47:19'),
(2, 1, 'MY', 'Vincent', 'vincent.my@edu.itescia.fr', 'vmy', 'mvincent', '2021-03-11 17:47:19'),
(3, 1, 'SHEICK', 'Idriss', 'idriss.sheick@edu.itescia.fr', 'isheick', 'sidriss', '2021-03-11 17:48:50');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
