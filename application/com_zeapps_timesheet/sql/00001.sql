--
-- Structure de la table `zeapps_timesheet_contracts`
--

CREATE TABLE `zeapps_timesheet_contracts` (
  `id` int(11) NOT NULL,
  `contract_name` varchar(255) CHARACTER SET utf8 NOT NULL,
  `time` int(10) unsigned NOT NULL DEFAULT '0',
  `alert` int(10) unsigned NOT NULL DEFAULT '0',
  `opened_at` date NOT NULL,
  `end_at` date NOT NULL,
  `company_id` int(11) NOT NULL,
  `company_name` varchar(255) CHARACTER SET utf8 NOT NULL,
  `user_id` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=20 DEFAULT CHARSET=latin1;



--
-- Structure de la table `zeapps_timesheet_timesheets`
--

CREATE TABLE `zeapps_timesheet_timesheets` (
  `id` int(10) unsigned NOT NULL,
  `time_spent` int(10) unsigned NOT NULL DEFAULT '0',
  `date_work` date NOT NULL,
  `reason` varchar(255) NOT NULL,
  `contract_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=51 DEFAULT CHARSET=latin1;

