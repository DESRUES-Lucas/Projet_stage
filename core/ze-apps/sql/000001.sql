--
-- Structure de la table `zeapps_users`
--

CREATE TABLE `zeapps_users` (
  `id` int(10) unsigned NOT NULL,
  `firstname` varchar(50) NOT NULL,
  `lastname` varchar(50) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(64) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `deleted` tinyint(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Index pour les tables exportées
--

--
-- Index pour la table `zeapps_users`
--
ALTER TABLE `zeapps_users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT pour les tables exportées
--

--
-- AUTO_INCREMENT pour la table `zeapps_users`
--
ALTER TABLE `zeapps_users`
  MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT;


ALTER TABLE `zeapps_users` ADD `lang` VARCHAR(6) NOT NULL AFTER `groups_list`;