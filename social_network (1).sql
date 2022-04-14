-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1
-- Généré le : jeu. 14 avr. 2022 à 19:23
-- Version du serveur : 10.4.22-MariaDB
-- Version de PHP : 8.1.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `social_network`
--

-- --------------------------------------------------------

--
-- Structure de la table `categorie`
--

CREATE TABLE `categorie` (
  `id_cat` int(11) NOT NULL,
  `name_cat` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `categorie`
--

INSERT INTO `categorie` (`id_cat`, `name_cat`) VALUES
(1, 'Loisir'),
(2, 'Restaurant'),
(3, 'Sport'),
(4, 'Fete');

-- --------------------------------------------------------

--
-- Structure de la table `commentaire`
--

CREATE TABLE `commentaire` (
  `id_com` int(11) NOT NULL,
  `id_membre` int(11) NOT NULL,
  `id_post` int(11) NOT NULL,
  `date_com` datetime NOT NULL DEFAULT current_timestamp(),
  `content` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `commentaire`
--

INSERT INTO `commentaire` (`id_com`, `id_membre`, `id_post`, `date_com`, `content`) VALUES
(31, 3, 27, '2022-04-07 00:00:00', 'trop cool\r\n'),
(32, 4, 27, '2022-04-12 00:00:00', 'easy'),
(33, 1, 24, '2022-04-14 16:11:46', 'super idée'),
(34, 1, 24, '2022-04-14 18:41:29', 'hello');

-- --------------------------------------------------------

--
-- Structure de la table `follow`
--

CREATE TABLE `follow` (
  `id_follow` int(11) NOT NULL,
  `id_suiveur` int(11) NOT NULL,
  `id_suivi` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `follow`
--

INSERT INTO `follow` (`id_follow`, `id_suiveur`, `id_suivi`) VALUES
(9, 2, 1),
(10, 3, 2),
(11, 2, 3),
(12, 1, 3),
(13, 1, 2),
(14, 4, 2);

-- --------------------------------------------------------

--
-- Structure de la table `membre`
--

CREATE TABLE `membre` (
  `id_membre` int(11) NOT NULL,
  `pseudo` varchar(20) NOT NULL,
  `email` varchar(44) NOT NULL,
  `mdp` text NOT NULL,
  `photo_profil` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `membre`
--

INSERT INTO `membre` (`id_membre`, `pseudo`, `email`, `mdp`, `photo_profil`) VALUES
(1, 'Toto', 'mendrika.jolivet@gmail.com', '$2y$10$1.lObN8XMHiRC85Hgf7RfueSbx2ZL7AON/EsCBSMkkfp2lVMafjRu', './upload/photo-profil1.jpg'),
(2, 'MAX', 'mendrika.jolivet@yahoo.com', '$2y$10$aP0H34psfJbYFDEt4m8csur3AM45cF5lXUAiVR5B07NiV3.urwsEW', './upload/photo-profil2.png'),
(3, 'Lolo', 'lolo@labest.fr', '$2y$10$cxRxL5Bsz0FRyPG8gs/NcuHRrCvAaH2Nhwb2znOMTLlVrAHNMX.U.', ''),
(4, 'thomas', 'thomas.clavel1@gmail.com', '$2y$10$gIXu3w2VECCdQLMnNkN/WOOXFhdzcf/DNIVuJt/Lmcfev8sWHiaTa', './upload/photo-profil4.png');

-- --------------------------------------------------------

--
-- Structure de la table `messagerie`
--

CREATE TABLE `messagerie` (
  `id_message` int(255) UNSIGNED NOT NULL,
  `id_from` int(255) NOT NULL,
  `id_to` int(255) NOT NULL,
  `message` text NOT NULL,
  `date_message` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `messagerie`
--

INSERT INTO `messagerie` (`id_message`, `id_from`, `id_to`, `message`, `date_message`) VALUES
(2, 2, 1, 'hey gros tu es la ?', '2022-04-04 16:41:06'),
(4, 1, 2, 'oui bien sur je suis la ', '2022-04-04 16:41:51'),
(5, 1, 2, 'ok cool.', '2022-04-04 16:43:59'),
(22, 0, 0, '', '2022-04-04 17:24:11'),
(23, 0, 0, '', '2022-04-04 17:25:25'),
(24, 1, 2, 'hello', '2022-04-04 17:26:08'),
(25, 1, 2, 'tfk ?', '2022-04-04 17:27:57'),
(26, 1, 2, 'rien ', '2022-04-04 18:02:33'),
(27, 2, 1, 'pas net mec', '2022-04-04 18:03:57'),
(28, 3, 1, 'coucou bg, ça dis quoi ce soir', '2022-04-04 18:11:27'),
(29, 3, 1, 'j\'aime bien', '2022-04-04 18:13:20'),
(30, 2, 1, 'bg$', '2022-04-06 14:05:47'),
(31, 1, 3, 'COUCOU', '2022-04-06 16:21:46'),
(32, 4, 2, 'coucou', '2022-04-12 16:11:21'),
(33, 4, 2, '1', '2022-04-13 18:38:16'),
(34, 4, 2, '2', '2022-04-13 18:38:19'),
(35, 4, 2, '3', '2022-04-13 18:38:22'),
(36, 4, 1, 'Coucou moi c\'est toi', '2022-04-13 18:59:17'),
(37, 2, 2, 'toto', '2022-04-13 20:08:38'),
(38, 2, 4, 'coucou', '2022-04-14 14:15:23'),
(39, 1, 2, 'coucou', '2022-04-14 14:23:33');

-- --------------------------------------------------------

--
-- Structure de la table `post`
--

CREATE TABLE `post` (
  `id_post` int(11) NOT NULL,
  `id_membre` int(11) NOT NULL,
  `titre` varchar(20) NOT NULL,
  `date_post` date NOT NULL,
  `content_post` text NOT NULL,
  `heure_post` time NOT NULL,
  `id_cat` int(11) NOT NULL,
  `adresse` varchar(38) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `post`
--

INSERT INTO `post` (`id_post`, `id_membre`, `titre`, `date_post`, `content_post`, `heure_post`, `id_cat`, `adresse`) VALUES
(24, 2, 'Création de site Eco', '2022-04-22', 'Lorem, ipsum dolor sit amet consectetur adipisicing elit. Architecto expedita dolorum quidem repellat recusandae, eos doloribus hic, dolore adipisci odit commodi magni, sunt deleniti iste ab at praesentium consequuntur modi!', '14:39:00', 1, '72 rue des stylos, 75001, Paris'),
(25, 2, 'kfc', '2022-04-21', 'Lorem, ipsum dolor sit amet consectetur adipisicing elit. Architecto expedita dolorum quidem repellat recusandae, eos doloribus hic', '14:40:00', 2, '44 rue du hibou, 75010, Paris'),
(26, 2, 'yooooooooo', '2022-04-30', 'Lorem, ipsum dolor sit amet consectetur adipisicing elit. ', '16:50:00', 1, ''),
(27, 2, 'Bac S ', '2022-04-15', 'Lorem, ipsum dolor sit amet consectetur adipisicing elit. Architecto expedita dolorum quidem', '14:53:00', 1, ''),
(28, 1, 'escalade ', '2022-04-20', 'Lorem, ipsum dolor sit amet consectetur adipisicing elit. Architecto expedita dolorum quidem repellat recusandae, eos doloribus hic, dolore adipisci odit commodi magni, sunt deleniti iste ab at praesentium consequuntur modi!', '18:38:00', 3, '');

-- --------------------------------------------------------

--
-- Structure de la table `reaction`
--

CREATE TABLE `reaction` (
  `id_reaction` int(11) NOT NULL,
  `id_membre` int(11) NOT NULL,
  `id_post` int(11) NOT NULL,
  `aimer` tinyint(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `reaction`
--

INSERT INTO `reaction` (`id_reaction`, `id_membre`, `id_post`, `aimer`) VALUES
(22, 3, 27, 1),
(49, 4, 25, 1),
(50, 4, 27, 1),
(52, 1, 24, 1),
(54, 1, 25, 1);

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `categorie`
--
ALTER TABLE `categorie`
  ADD PRIMARY KEY (`id_cat`);

--
-- Index pour la table `commentaire`
--
ALTER TABLE `commentaire`
  ADD PRIMARY KEY (`id_com`),
  ADD KEY `id_membre` (`id_membre`),
  ADD KEY `id_post` (`id_post`);

--
-- Index pour la table `follow`
--
ALTER TABLE `follow`
  ADD PRIMARY KEY (`id_follow`),
  ADD KEY `id_suiveur` (`id_suiveur`),
  ADD KEY `id_suivi` (`id_suivi`);

--
-- Index pour la table `membre`
--
ALTER TABLE `membre`
  ADD PRIMARY KEY (`id_membre`);

--
-- Index pour la table `messagerie`
--
ALTER TABLE `messagerie`
  ADD PRIMARY KEY (`id_message`);

--
-- Index pour la table `post`
--
ALTER TABLE `post`
  ADD PRIMARY KEY (`id_post`),
  ADD KEY `id_membre` (`id_membre`);

--
-- Index pour la table `reaction`
--
ALTER TABLE `reaction`
  ADD PRIMARY KEY (`id_reaction`),
  ADD KEY `id_membre` (`id_membre`),
  ADD KEY `id_post` (`id_post`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `categorie`
--
ALTER TABLE `categorie`
  MODIFY `id_cat` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT pour la table `commentaire`
--
ALTER TABLE `commentaire`
  MODIFY `id_com` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=35;

--
-- AUTO_INCREMENT pour la table `follow`
--
ALTER TABLE `follow`
  MODIFY `id_follow` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT pour la table `membre`
--
ALTER TABLE `membre`
  MODIFY `id_membre` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT pour la table `messagerie`
--
ALTER TABLE `messagerie`
  MODIFY `id_message` int(255) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=40;

--
-- AUTO_INCREMENT pour la table `post`
--
ALTER TABLE `post`
  MODIFY `id_post` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

--
-- AUTO_INCREMENT pour la table `reaction`
--
ALTER TABLE `reaction`
  MODIFY `id_reaction` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=55;

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `commentaire`
--
ALTER TABLE `commentaire`
  ADD CONSTRAINT `commentaire_ibfk_1` FOREIGN KEY (`id_membre`) REFERENCES `membre` (`id_membre`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `commentaire_ibfk_2` FOREIGN KEY (`id_post`) REFERENCES `post` (`id_post`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Contraintes pour la table `follow`
--
ALTER TABLE `follow`
  ADD CONSTRAINT `follow_ibfk_1` FOREIGN KEY (`id_suiveur`) REFERENCES `membre` (`id_membre`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `follow_ibfk_2` FOREIGN KEY (`id_suivi`) REFERENCES `membre` (`id_membre`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Contraintes pour la table `reaction`
--
ALTER TABLE `reaction`
  ADD CONSTRAINT `reaction_ibfk_1` FOREIGN KEY (`id_membre`) REFERENCES `membre` (`id_membre`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `reaction_ibfk_2` FOREIGN KEY (`id_post`) REFERENCES `post` (`id_post`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
