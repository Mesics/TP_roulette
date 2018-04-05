-- phpMyAdmin SQL Dump
-- version 4.4.15.10
-- https://www.phpmyadmin.net
--
-- Client :  localhost
-- Généré le :  Sam 31 Mars 2018 à 14:01
-- Version du serveur :  5.5.56-MariaDB
-- Version de PHP :  5.4.16

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données :  `p1408199`
--

-- --------------------------------------------------------

--
-- Structure de la table `Game`
--

CREATE TABLE IF NOT EXISTS `Game` (
  `player` int(11) NOT NULL,
  `date` datetime NOT NULL,
  `bet` int(11) NOT NULL,
  `profit` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Contenu de la table `Game`
--

INSERT INTO `Game` (`player`, `date`, `bet`, `profit`) VALUES
(1, '2018-02-28 22:55:23', 345, -345),
(1, '2018-02-28 22:55:33', 47, -47),
(1, '2018-02-28 22:55:36', 4, 0),
(2, '2018-03-28 16:34:28', 20, 200),
(2, '2018-03-28 16:39:40', 45, 200),
(2, '2018-03-28 16:40:21', 50, 200),
(2, '2018-03-28 16:50:20', 50, 200),
(2, '2018-03-28 16:52:57', 50, 200),
(2, '2018-03-28 16:53:33', 50, 200),
(2, '2018-03-28 16:54:18', 50, -50),
(2, '2018-03-28 16:54:23', 50, -50),
(2, '2018-03-28 16:54:26', 50, -50),
(2, '2018-03-28 16:54:30', 50, -50),
(2, '2018-03-29 15:37:26', 20, -20),
(2, '2018-03-29 15:37:30', 60, 120),
(2, '2018-03-29 16:06:04', 30, -30),
(2, '2018-03-31 13:08:56', 20, -20),
(2, '2018-03-31 13:09:07', 20, -20),
(2, '2018-03-31 13:10:16', 20, -20),
(2, '2018-03-31 13:10:25', 10, -10),
(2, '2018-03-31 13:31:43', 10, -10),
(2, '2018-03-31 13:37:18', 20, -20),
(2, '2018-03-31 13:41:10', 15, 30),
(2, '2018-03-31 13:43:36', 12, 24),
(3, '2018-02-28 17:19:16', 47, 94),
(3, '2018-02-28 17:20:18', 21, 42),
(3, '2018-02-28 17:20:22', 12, 24),
(3, '2018-02-28 17:20:26', 65, 130),
(3, '2018-02-28 17:20:29', 89, -89);

-- --------------------------------------------------------

--
-- Structure de la table `Player`
--

CREATE TABLE IF NOT EXISTS `Player` (
  `id` int(11) NOT NULL,
  `name` varchar(20) NOT NULL,
  `password` varchar(20) NOT NULL,
  `money` int(11) NOT NULL DEFAULT '500'
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=latin1;

--
-- Contenu de la table `Player`
--

INSERT INTO `Player` (`id`, `name`, `password`, `money`) VALUES
(1, 'Coralie', '1234', 0),
(2, 'Didi', '4321', 284),
(3, 'Lolo', '0000', 917),
(4, 'pppp', 'pppp', 500),
(6, 'geantVert', 'asperge', 500),
(8, 'Chaires', 'azerty', 500),
(9, 'cc', 'azer', 500),
(10, 'ccc', '&é"''', 500),
(11, 'diego', 'diego', 500);

--
-- Index pour les tables exportées
--

--
-- Index pour la table `Game`
--
ALTER TABLE `Game`
  ADD PRIMARY KEY (`player`,`date`);

--
-- Index pour la table `Player`
--
ALTER TABLE `Player`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT pour les tables exportées
--

--
-- AUTO_INCREMENT pour la table `Player`
--
ALTER TABLE `Player`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=12;
--
-- Contraintes pour les tables exportées
--

--
-- Contraintes pour la table `Game`
--
ALTER TABLE `Game`
  ADD CONSTRAINT `fk_id` FOREIGN KEY (`player`) REFERENCES `Player` (`id`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
