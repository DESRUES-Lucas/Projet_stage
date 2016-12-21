-- phpMyAdmin SQL Dump
-- version 4.4.10
-- http://www.phpmyadmin.net
--
-- Client :  localhost:3306
-- Généré le :  Lun 12 Septembre 2016 à 12:15
-- Version du serveur :  5.5.42
-- Version de PHP :  7.0.8

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";

--
-- Base de données :  `zeapps`
--

-- --------------------------------------------------------

--
-- Structure de la table `com_zeapps_crm_product_category`
--

CREATE TABLE `com_zeapps_crm_product_categories` (
  `id` int(10) NOT NULL,
  `id_parent` int(10) NOT NULL,
  `name` varchar(255) NOT NULL,
  `sort` int(10) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Index pour les tables exportées
--

--
-- Index pour la table `com_zeapps_crm_product_category`
--
ALTER TABLE `com_zeapps_crm_product_categories`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT pour les tables exportées
--

--
-- AUTO_INCREMENT pour la table `com_zeapps_crm_product_category`
--
ALTER TABLE `com_zeapps_crm_product_categories`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT;



-- phpMyAdmin SQL Dump
-- version 4.4.10
-- http://www.phpmyadmin.net
--
-- Client :  localhost:3306
-- Généré le :  Mar 13 Septembre 2016 à 12:58
-- Version du serveur :  5.5.42
-- Version de PHP :  7.0.8

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";

--
-- Base de données :  `zeapps`
--

-- --------------------------------------------------------

--
-- Structure de la table `com_zeapps_crm_product_products`
--

CREATE TABLE `com_zeapps_crm_product_products` (
  `id` int(10) NOT NULL,
  `name` varchar(255) NOT NULL,
  `desc_short` varchar(140) NOT NULL,
  `category` int(10) NOT NULL,
  `price` decimal(7,2) NOT NULL DEFAULT '0.00',
  `account` int(10) NOT NULL,
  `taxe` int(10) NOT NULL,
  `desc_long` varchar(1000) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Index pour les tables exportées
--

--
-- Index pour la table `com_zeapps_crm_product_products`
--
ALTER TABLE `com_zeapps_crm_product_products`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `name` (`name`);

--
-- AUTO_INCREMENT pour les tables exportées
--

--
-- AUTO_INCREMENT pour la table `com_zeapps_crm_product_products`
--
ALTER TABLE `com_zeapps_crm_product_products`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT;