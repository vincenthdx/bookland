-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1
-- Généré le : ven. 23 avr. 2021 à 23:39
-- Version du serveur :  10.4.17-MariaDB
-- Version de PHP : 8.0.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `network`
--

-- --------------------------------------------------------

--
-- Structure de la table `amis`
--

CREATE TABLE `amis` (
  `id` int(11) NOT NULL,
  `id_demandeurAmis` varchar(255) NOT NULL,
  `id_receveurAmis` varchar(255) NOT NULL,
  `statut` int(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `amis`
--

INSERT INTO `amis` (`id`, `id_demandeurAmis`, `id_receveurAmis`, `statut`) VALUES
(134, 'vincent', 'test3', 0),
(135, 'vincent', 'test3', 0);

-- --------------------------------------------------------

--
-- Structure de la table `commentaires`
--

CREATE TABLE `commentaires` (
  `id` int(11) NOT NULL,
  `pseudo` varchar(255) NOT NULL,
  `commentaire` text NOT NULL,
  `id_publication` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `commentaires`
--

INSERT INTO `commentaires` (`id`, `pseudo`, `commentaire`, `id_publication`) VALUES
(1, 'vincent', 'test', 9),
(2, 'vincent', 'test', 16),
(3, 'vincent', 'test', 17),
(4, 'vincent', 'salut', 16),
(5, 'vincent', 'salut', 18);

-- --------------------------------------------------------

--
-- Structure de la table `dislikes`
--

CREATE TABLE `dislikes` (
  `id` int(11) DEFAULT NULL,
  `id_publication` int(11) NOT NULL,
  `id_utilisateur` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `dislikes`
--

INSERT INTO `dislikes` (`id`, `id_publication`, `id_utilisateur`) VALUES
(NULL, 15, 59),
(NULL, 16, 65),
(NULL, 18, 66);

-- --------------------------------------------------------

--
-- Structure de la table `likes`
--

CREATE TABLE `likes` (
  `id` int(11) NOT NULL,
  `id_publication` int(11) NOT NULL,
  `id_utilisateur` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `likes`
--

INSERT INTO `likes` (`id`, `id_publication`, `id_utilisateur`) VALUES
(1, 12, 54),
(2, 10, 55),
(6, 12, 55),
(9, 16, 60),
(10, 17, 62),
(11, 17, 61);

-- --------------------------------------------------------

--
-- Structure de la table `membres`
--

CREATE TABLE `membres` (
  `id` int(11) NOT NULL,
  `pseudo` varchar(255) NOT NULL,
  `mail` varchar(255) NOT NULL,
  `mdp` text NOT NULL,
  `photo` varchar(255) NOT NULL,
  `telephone` int(255) NOT NULL,
  `nom` text NOT NULL,
  `prenom` text NOT NULL,
  `codepostal` int(11) NOT NULL,
  `pays` text NOT NULL,
  `naissance` date NOT NULL,
  `bio` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `membres`
--

INSERT INTO `membres` (`id`, `pseudo`, `mail`, `mdp`, `photo`, `telephone`, `nom`, `prenom`, `codepostal`, `pays`, `naissance`, `bio`) VALUES
(7, 'vincentt', 'vincent@outlook.fr', '1234Ab', '', 0, '', '', 0, '', '0000-00-00', ''),
(66, 'vincent', 'vincent.hadoux@outlook.fr', '12345Ab', '66.jpg', 0, 'hadoux', 'vincent', 60300, 'france', '2001-08-13', 'salut');

-- --------------------------------------------------------

--
-- Structure de la table `messagerie`
--

CREATE TABLE `messagerie` (
  `id` int(11) NOT NULL,
  `destinataire` int(11) NOT NULL,
  `expediteur` int(11) NOT NULL,
  `message` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `messagerie`
--

INSERT INTO `messagerie` (`id`, `destinataire`, `expediteur`, `message`) VALUES
(1, 7, 50, 'test'),
(2, 7, 7, 'test1'),
(3, 62, 61, 'salut'),
(4, 65, 61, 'salut'),
(5, 61, 66, 'salut'),
(6, 61, 66, 'salut'),
(7, 61, 66, 'salut');

-- --------------------------------------------------------

--
-- Structure de la table `publications`
--

CREATE TABLE `publications` (
  `id` int(11) NOT NULL,
  `titre` varchar(255) NOT NULL,
  `contenus` text NOT NULL,
  `date_publication` date NOT NULL,
  `image` varchar(255) NOT NULL,
  `id_auteur` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `publications`
--

INSERT INTO `publications` (`id`, `titre`, `contenus`, `date_publication`, `image`, `id_auteur`) VALUES
(9, 'test', 'test\r\n', '2021-04-18', '', 0),
(11, 'test3', 'test3', '2021-04-20', '', 0),
(12, 'test4', 'test4', '2021-04-20', '', 0),
(14, 'test6', 'test', '2021-04-21', '', 0),
(16, 'test7', 'test7', '2021-04-22', '', 60),
(18, 'test8', 'test8', '2021-04-23', '', 65),
(19, 'test9', 'test9', '2021-04-23', '', 66);

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `amis`
--
ALTER TABLE `amis`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `commentaires`
--
ALTER TABLE `commentaires`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `likes`
--
ALTER TABLE `likes`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `membres`
--
ALTER TABLE `membres`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `messagerie`
--
ALTER TABLE `messagerie`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `publications`
--
ALTER TABLE `publications`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `amis`
--
ALTER TABLE `amis`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=136;

--
-- AUTO_INCREMENT pour la table `commentaires`
--
ALTER TABLE `commentaires`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT pour la table `likes`
--
ALTER TABLE `likes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT pour la table `membres`
--
ALTER TABLE `membres`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=67;

--
-- AUTO_INCREMENT pour la table `messagerie`
--
ALTER TABLE `messagerie`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT pour la table `publications`
--
ALTER TABLE `publications`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
