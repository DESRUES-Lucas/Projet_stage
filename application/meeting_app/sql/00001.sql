

SET SQL_MODE = "NO_AUTO_VALUE’_ON_ZERO";
SET time_zone = "+00:00";

--
-- Base de données :  `zeapps`
--

-- --------------------------------------------------------

--
-- Structure de la table `meeting_app_meets`
--

CREATE TABLE `meeting_app_meets` (
  `id` int(11) NOT NULL,
  `id_project` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `date_meet` date NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `meeting_app_notes`
--

CREATE TABLE `meeting_app_notes` (
  `id` int(11) NOT NULL,
  `id_subject` int(11) NOT NULL,
  `id_project` int(11) NOT NULL,
  `id_meet` int(11) NOT NULL,
  `description` text NOT NULL,
  `type_note` varchar(255) NOT NULL,
  `position` int(11) NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '0',
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `meeting_app_participants`
--

CREATE TABLE `meeting_app_participants` (
  `id` int(11) NOT NULL,
  `id_participant` int(11) NOT NULL,
  `id_meet` int(11) NOT NULL,
  `id_note` int(11) NOT NULL,
  `firstname` varchar(255) NOT NULL,
  `lastname` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00' ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `meeting_app_projects`
--

CREATE TABLE `meeting_app_projects` (
  `id` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
ALTER TABLE `meeting_app_projects`
  ADD PRIMARY KEY (`id`);
ALTER TABLE `meeting_app_projects`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

-- --------------------------------------------------------

--
-- Structure de la table `meeting_app_subjects`
--

CREATE TABLE `meeting_app_subjects` (
  `id` int(11) NOT NULL,
  `id_project` int(11) NOT NULL,
  `id_meet` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `position` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Index pour les tables exportées
--

--
-- Index pour la table `meeting_app_meets`
--
ALTER TABLE `meeting_app_meets`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `meeting_app_notes`
--
ALTER TABLE `meeting_app_notes`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `meeting_app_participants`
--
ALTER TABLE `meeting_app_participants`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `meeting_app_projects`
--


--
-- Index pour la table `meeting_app_subjects`
--
ALTER TABLE `meeting_app_subjects`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT pour les tables exportées
--

--
-- AUTO_INCREMENT pour la table `meeting_app_meets`
--
ALTER TABLE `meeting_app_meets`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT pour la table `meeting_app_notes`
--
ALTER TABLE `meeting_app_notes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT pour la table `meeting_app_participants`
--
ALTER TABLE `meeting_app_participants`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT pour la table `meeting_app_projects`
--

--
-- AUTO_INCREMENT pour la table `meeting_app_subjects`
--
ALTER TABLE `meeting_app_subjects`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;