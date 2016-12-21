--
-- Structure de la table `zeapps_workload_workloads`
--

CREATE TABLE `zeapps_workload_workloads` (
  `id` int(11) NOT NULL,
  `folder` varchar(255) NOT NULL,
  `company` varchar(255) NOT NULL,
  `amount` decimal(9,2) NOT NULL DEFAULT '0.00',
  `commission` decimal(9,2) NOT NULL DEFAULT '0.00',
  `invoiced` decimal(9,2) NOT NULL DEFAULT '0.00',
  `opened_at` date NOT NULL,
  `delivered_at` date NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `deleted_at` timestamp NULL DEFAULT NULL,
  `status` int(11) NOT NULL,
  `position` int(10) unsigned NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=138 DEFAULT CHARSET=utf8;




--
-- Structure de la table `zeapps_workload_statuses`
--

CREATE TABLE `zeapps_workload_statuses` (
  `id` int(10) unsigned NOT NULL,
  `name` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;
