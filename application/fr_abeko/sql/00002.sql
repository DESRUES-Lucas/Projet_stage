CREATE TABLE `fr_abeko_logos` (
  `id` int(11) NOT NULL,
  `libelle` varchar(255) CHARACTER SET utf8 NOT NULL,
  `path` varchar(255) CHARACTER SET utf8 NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=19 DEFAULT CHARSET=latin1;

--
-- Contenu de la table `fr_abeko_logos`
--

INSERT INTO `fr_abeko_logos` (`id`, `libelle`, `path`, `created_at`, `updated_at`, `deleted_at`) VALUES
(14, 'dvfg rzef', '/assets/upload/logo/157298001476454092.jpg', '2016-10-14 14:08:12', '0000-00-00 00:00:00', '2016-10-14 14:19:28'),
(15, 'dvfg rzef', '/assets/upload/logo/329989001476454092.jpg', '2016-10-14 14:08:12', '0000-00-00 00:00:00', '2016-10-14 14:19:29'),
(16, 'dvfg rzef', '/assets/upload/logo/492454001476454092.jpg', '2016-10-14 14:08:12', '0000-00-00 00:00:00', '2016-10-14 14:19:30'),
(17, 'dvfg rzef', '/assets/upload/logo/645400001476454092.jpg', '2016-10-14 14:08:12', '0000-00-00 00:00:00', '2016-10-14 14:19:31'),
(18, 'dvfg rzef', '/assets/upload/logo/813269001476454092.jpg', '2016-10-14 14:08:12', '0000-00-00 00:00:00', '2016-10-14 14:19:33');

--
-- Index pour les tables exportées
--

--
-- Index pour la table `fr_abeko_logos`
--
ALTER TABLE `fr_abeko_logos`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT pour les tables exportées
--

--
-- AUTO_INCREMENT pour la table `fr_abeko_logos`
--
ALTER TABLE `fr_abeko_logos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=19;