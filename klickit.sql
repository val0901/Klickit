-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Client :  127.0.0.1
-- Généré le :  Jeu 15 Décembre 2016 à 10:41
-- Version du serveur :  10.1.16-MariaDB
-- Version de PHP :  7.0.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données :  `klickit`
--
CREATE DATABASE IF NOT EXISTS `klickit` DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci;
USE `klickit`;

-- --------------------------------------------------------

--
-- Structure de la table `event`
--

CREATE TABLE `event` (
  `id` int(11) NOT NULL,
  `picture` text NOT NULL,
  `title` varchar(255) NOT NULL,
  `content` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Contenu de la table `event`
--

INSERT INTO `event` (`id`, `picture`, `title`, `content`) VALUES
(1, 'events_585179993834e.jpg', 'Evènement 1 : Exposition', 'Non non'),
(2, '', 'Evènement 2 : Concours', 'Description de l''évènement:\r\n\r\nBla bla bla...'),
(3, '', 'Evènement 3 : Concours', 'Description de l''évènement:\r\n\r\nBla bla bla...');

-- --------------------------------------------------------

--
-- Structure de la table `filter`
--

CREATE TABLE `filter` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `guestbook`
--

CREATE TABLE `guestbook` (
  `id` int(255) NOT NULL,
  `username` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `subject` varchar(255) NOT NULL,
  `content` text NOT NULL,
  `id_member` int(11) NOT NULL,
  `date_creation` datetime NOT NULL,
  `published` enum('oui','non') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Contenu de la table `guestbook`
--

INSERT INTO `guestbook` (`id`, `username`, `email`, `subject`, `content`, `id_member`, `date_creation`, `published`) VALUES
(1, 'Admin', 'JeanJean@gmail.com', 'Trop cool ', 'C''est génial ! Je recommande !', 1, '2016-12-13 16:24:41', 'non'),
(2, 'shooberinadeladogga', 'sexy@shoobie.bork', 'such amazing', 'C''est génial ! Super qualité des produits !\n', 2, '2016-12-09 21:57:43', 'oui');

-- --------------------------------------------------------

--
-- Structure de la table `item`
--

CREATE TABLE `item` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `description` varchar(255) NOT NULL,
  `quantity` int(11) NOT NULL,
  `price` int(11) NOT NULL,
  `newPrice` int(11) NOT NULL,
  `picture1` text NOT NULL,
  `picture2` text NOT NULL,
  `statut` enum('promotion','nouveauté','par defaut') NOT NULL,
  `category` enum('PlaymobilClassique','PlaymobilCustom','PiecesDetachees','Divers') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Contenu de la table `item`
--

INSERT INTO `item` (`id`, `name`, `description`, `quantity`, `price`, `newPrice`, `picture1`, `picture2`, `statut`, `category`) VALUES
(1, 'Princesse', '', 10, 80, 10, 'art_58515ac7099d5.jpg', 'art_585157c92d686.jpg', 'nouveauté', 'PlaymobilCustom'),
(2, 'Playmobil2', '', 45, 70, 0, '', '', 'par defaut', 'PlaymobilClassique'),
(3, 'Zigoto', '', 43, 453, 45, '', '', 'par defaut', 'PlaymobilCustom'),
(4, 'Bras', '', 78, 68, 0, '', '', 'promotion', 'PiecesDetachees'),
(5, 'Carton', '', 87, 34, 0, '', '', 'nouveauté', 'Divers');

-- --------------------------------------------------------

--
-- Structure de la table `message`
--

CREATE TABLE `message` (
  `id` int(11) NOT NULL,
  `username` varchar(255) NOT NULL,
  `subject` varchar(255) NOT NULL,
  `content` text NOT NULL,
  `email` varchar(255) NOT NULL,
  `statut` enum('Lu','Non lu') NOT NULL,
  `idMember` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Contenu de la table `message`
--

INSERT INTO `message` (`id`, `username`, `subject`, `content`, `email`, `statut`, `idMember`) VALUES
(1, 'shooberinadeladogga', 'C''est trop bien', 'Trop cool. Bla bla bla.\r\n\r\nTrop génial. bla bla bla', 'dank@doggo.com', 'Lu', 2),
(3, 'Admin', 'C''est trop bien', 'Trop cool. Bla bla bla.\r\nSwaggy !!!!!!!', 'JeanJean@gmail.com', 'Lu', 1),
(4, 'Admin', 'C''est trop bien', 'Ceci est un autre message', 'JeanJean@gmail.com', 'Lu', 1);

-- --------------------------------------------------------

--
-- Structure de la table `orders`
--

CREATE TABLE `orders` (
  `id` int(11) NOT NULL,
  `idMember` int(11) NOT NULL,
  `contenu` text NOT NULL,
  `date_creation` datetime NOT NULL,
  `statut` enum('commandé','en préparation','expédié') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Contenu de la table `orders`
--

INSERT INTO `orders` (`id`, `idMember`, `contenu`, `date_creation`, `statut`) VALUES
(1, 2, 'item 1, item 2, item 3', '2016-12-14 09:29:36', 'commandé'),
(2, 1, 'item 1, item 2, item 3', '2016-12-01 11:39:27', 'en préparation'),
(3, 2, 'item 1, item 2, item 3', '2016-11-30 11:39:27', 'expédié');

-- --------------------------------------------------------

--
-- Structure de la table `shipping`
--

CREATE TABLE `shipping` (
  `id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `content` text NOT NULL,
  `price` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Contenu de la table `shipping`
--

INSERT INTO `shipping` (`id`, `title`, `content`, `price`) VALUES
(1, 'Colissimo', 'Envoi du colis via Colissimo.\n\nDescription à peaufiner', 6);

-- --------------------------------------------------------

--
-- Structure de la table `slide`
--

CREATE TABLE `slide` (
  `id` int(11) NOT NULL,
  `title` varchar(250) NOT NULL,
  `picture` text NOT NULL,
  `link` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Contenu de la table `slide`
--

INSERT INTO `slide` (`id`, `title`, `picture`, `link`) VALUES
(1, 'Slide1', '', 'http://google.com'),
(2, 'Slide2', '', 'http://facebook.com'),
(3, 'Slide3', '', 'http://dogemask.cool');

-- --------------------------------------------------------

--
-- Structure de la table `subcategory`
--

CREATE TABLE `subcategory` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `social_title` enum('M','Mme') NOT NULL,
  `firstname` varchar(255) NOT NULL,
  `lastname` varchar(255) NOT NULL,
  `username` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `avatar` text NOT NULL,
  `role` enum('Admin','Utilisateur') NOT NULL,
  `adress` text NOT NULL,
  `zipcode` varchar(255) NOT NULL,
  `city` varchar(255) NOT NULL,
  `cart_item` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Contenu de la table `user`
--

INSERT INTO `user` (`id`, `social_title`, `firstname`, `lastname`, `username`, `email`, `password`, `avatar`, `role`, `adress`, `zipcode`, `city`, `cart_item`) VALUES
(1, 'M', 'Jean', 'Jean', 'Admin', 'JeanJean@gmail.com', '$2y$10$qr0A6lpa5uheUOvyWVgF5Opkz7gLOoSoO8XT2eFzGf9DB.Q1vB0Tu', '', 'Admin', '42 rue du Jean', '69000', 'Jean-Jean Town', ''),
(2, 'Mme', 'Shooberina', 'de la Dogga', 'shooberinadeladogga', 'sexy@shoobie.bork', '$2y$10$Dc8FUxMR7k7yAJM0HEYh4Oc5ZBF3gr9vkMudjc94krLNPm/Oi0b3W', '', 'Utilisateur', '420 Fluffy Clouds street', '69420', 'Shoob City', ''),
(3, 'M', 'Vladoge', 'Doggoskovic', 'russiandoggo', 'russian_doggo', '$2y$10$Dc8FUxMR7k7yAJM0HEYh4Oc5ZBF3gr9vkMudjc94krLNPm/Oi0b3W', '', 'Utilisateur', '420 Fluffy Clouds street', '69420', 'Shoob City', ''),
(4, 'M', 'Dogellini', 'Mafioshiba', 'mafioso', 'mafioshiba@ifuaintshibeuaintright.bork', '$2y$10$lhqelS3.ncIx7/FvJ/jXtO/pxRvFZlDDC3WgIkNwKgQAKWCaNX.Ay', '', 'Admin', '123 rue de la Vodka', '66666', 'Mafia City', '');

--
-- Index pour les tables exportées
--

--
-- Index pour la table `event`
--
ALTER TABLE `event`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `filter`
--
ALTER TABLE `filter`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `guestbook`
--
ALTER TABLE `guestbook`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `item`
--
ALTER TABLE `item`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `message`
--
ALTER TABLE `message`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `shipping`
--
ALTER TABLE `shipping`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `slide`
--
ALTER TABLE `slide`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `subcategory`
--
ALTER TABLE `subcategory`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT pour les tables exportées
--

--
-- AUTO_INCREMENT pour la table `event`
--
ALTER TABLE `event`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT pour la table `filter`
--
ALTER TABLE `filter`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT pour la table `guestbook`
--
ALTER TABLE `guestbook`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT pour la table `item`
--
ALTER TABLE `item`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT pour la table `message`
--
ALTER TABLE `message`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT pour la table `orders`
--
ALTER TABLE `orders`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT pour la table `shipping`
--
ALTER TABLE `shipping`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT pour la table `slide`
--
ALTER TABLE `slide`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT pour la table `subcategory`
--
ALTER TABLE `subcategory`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT pour la table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
