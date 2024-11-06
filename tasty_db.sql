-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1
-- Généré le : mer. 06 nov. 2024 à 13:15
-- Version du serveur : 10.4.27-MariaDB
-- Version de PHP : 8.2.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `tasty_db`
--

-- --------------------------------------------------------

--
-- Structure de la table `reservations`
--

CREATE TABLE `reservations` (
  `id` int(11) NOT NULL,
  `full_name` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `phone` varchar(15) NOT NULL,
  `booking_date` date NOT NULL,
  `booking_time` time NOT NULL,
  `num_guests` int(11) NOT NULL,
  `special_request` text DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `reservations`
--

INSERT INTO `reservations` (`id`, `full_name`, `email`, `phone`, `booking_date`, `booking_time`, `num_guests`, `special_request`, `created_at`) VALUES
(1, 'user1', 'user1@gmail.Com', '23435345465', '2024-03-05', '15:04:00', 4, 'VBVBVBV', '2024-11-05 15:08:50'),
(4, 'qsqs', 'qsqs@gmail.com', '12345666', '2024-03-03', '15:04:00', 3, 'DDDDDDDDDDDDDDDDDDDD', '2024-11-05 15:46:43'),
(5, 'user1', 'user1@gmail.com', '12345666', '2000-03-03', '12:04:00', 4, 'XWCVBN', '2024-11-05 15:52:29'),
(6, 'anas', 'anas@gmail.Com', '12345666', '2024-04-03', '13:02:00', 3, 'A table near to the window', '2024-11-05 16:01:56'),
(7, 'khalid', 'khalid@gmail.com', '12345666', '2024-04-02', '12:04:00', 2, 'HGJGFHGGHJGJFHGJ', '2024-11-05 16:05:03'),
(8, 'soaad', 'soaad@gmail.com', '143456456', '2024-03-02', '12:04:00', 2, 'SSSSSSSSSSSSSSSSS', '2024-11-05 16:13:57'),
(9, 'user2', 'user2@gmail.Com', '123445677', '2024-02-04', '13:03:00', 2, 'WQWQWQWQWQWW', '2024-11-05 16:18:16'),
(10, 'qsqs', 'user1@gmail.com', '121212121212', '2024-03-04', '14:05:00', 3, 'AZERTT', '2024-11-05 16:22:16'),
(11, 'jeon', 'jeon@gmail.com', '121212121212', '2003-04-02', '15:07:00', 4, 'KJJKKKKKKKKKKJ', '2024-11-05 16:26:03'),
(12, 'fhfghfh', 'fhfhfh@gmail.Com', '23243444335', '2000-05-03', '12:03:00', 3, 'GHJGHKJGHJG', '2024-11-05 16:27:26'),
(13, 'cccc', 'cccc@gmail.com', '12345666', '2025-04-02', '16:06:00', 4, 'FFFFGGGHHHJJ', '2024-11-05 16:37:54');

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `reservations`
--
ALTER TABLE `reservations`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `reservations`
--
ALTER TABLE `reservations`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
