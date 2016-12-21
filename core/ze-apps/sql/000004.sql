--
-- Base de données :  `zeapps`
--

-- --------------------------------------------------------

--
-- Structure de la table `zeapps_notifications`
--

CREATE TABLE `zeapps_notifications` (
  `id` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `module` varchar(255) NOT NULL,
  `status` int(11) NOT NULL,
  `message` varchar(255) NOT NULL,
  `seen` tinyint(1) NOT NULL,
  `read_state` tinyint(1) NOT NULL,
  `link` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Index pour les tables exportées
--

--
-- Index pour la table `zeapps_notifications`
--
ALTER TABLE `zeapps_notifications`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT pour les tables exportées
--

--
-- AUTO_INCREMENT pour la table `zeapps_notifications`
--
ALTER TABLE `zeapps_notifications`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;






ALTER TABLE `zeapps_notifications` CHANGE `status` `status` VARCHAR(255) NOT NULL;
ALTER TABLE `zeapps_notifications` ADD `color` VARCHAR(32) NOT NULL AFTER `module`;