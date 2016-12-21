CREATE TABLE `fr_abeko_baches` (
  `id` int(10) unsigned NOT NULL,
  `nom` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;


ALTER TABLE `fr_abeko_baches`
  ADD PRIMARY KEY (`id`);


ALTER TABLE `fr_abeko_baches`
  MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT;





CREATE TABLE `fr_abeko_citerne_tarifs` (
  `id` int(10) unsigned NOT NULL,
  `nom` varchar(255) NOT NULL,
  `id_bache` int(10) unsigned NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;


ALTER TABLE `fr_abeko_citerne_tarifs`
  ADD PRIMARY KEY (`id`);


ALTER TABLE `fr_abeko_citerne_tarifs`
  MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT;



CREATE TABLE `fr_abeko_citerne_tarifs_lignes` (
  `id` int(10) unsigned NOT NULL,
  `id_tarif` int(10) unsigned NOT NULL,
  `m3` int(10) unsigned NOT NULL,
  `largeur` double NOT NULL,
  `profondeur` double NOT NULL,
  `tarif` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;


ALTER TABLE `fr_abeko_citerne_tarifs_lignes`
  ADD PRIMARY KEY (`id`);


ALTER TABLE `fr_abeko_citerne_tarifs_lignes`
  MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT;

ALTER TABLE `fr_abeko_citerne_tarifs_lignes` CHANGE `tarif` `tarif` DOUBLE NOT NULL;




CREATE TABLE `fr_abeko_articles_composes` (
  `id` int(10) unsigned NOT NULL,
  `ref` varchar(25) NOT NULL,
  `nom` varchar(255) NOT NULL,
  `descriptif` text NOT NULL,
  `prix_ht` double NOT NULL,
  `calcul_auto_prix` enum('Y','N') NOT NULL DEFAULT 'N',
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;


ALTER TABLE `fr_abeko_articles_composes`
  ADD PRIMARY KEY (`id`);


ALTER TABLE `fr_abeko_articles_composes`
  MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT;




CREATE TABLE `fr_abeko_articles_composes_lignes` (
  `id` int(10) unsigned NOT NULL,
  `id_article_compose` int(10) unsigned NOT NULL,
  `id_produit` int(10) unsigned NOT NULL,
  `quantite` double NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;


ALTER TABLE `fr_abeko_articles_composes_lignes`
  ADD PRIMARY KEY (`id`);


ALTER TABLE `fr_abeko_articles_composes_lignes`
  MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT;



CREATE TABLE `fr_abeko_citernes_types` (
  `id` int(10) unsigned NOT NULL,
  `nom` varchar(255) NOT NULL,
  `tarif_applicable` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;


ALTER TABLE `fr_abeko_citernes_types`
  ADD PRIMARY KEY (`id`);


ALTER TABLE `fr_abeko_citernes_types`
  MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT;


ALTER TABLE `fr_abeko_citernes_types` ADD `liste_point_actif` VARCHAR(255) NOT NULL AFTER `tarif_applicable`;



CREATE TABLE `fr_abeko_citernes_types_articles` (
  `id` int(10) unsigned NOT NULL,
  `id_citerne_type` int(10) unsigned NOT NULL,
  `id_article_compose` int(10) unsigned NOT NULL,
  `type_point` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;


ALTER TABLE `fr_abeko_citernes_types_articles`
  ADD PRIMARY KEY (`id`);


ALTER TABLE `fr_abeko_citernes_types_articles`
  MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT;



CREATE TABLE `fr_abeko_plans` (
  `id` int(10) unsigned NOT NULL,
  `nom` varchar(255) NOT NULL,
  `id_citerne_type` int(10) unsigned NOT NULL DEFAULT '0',
  `id_tarif_applicable` int(10) unsigned NOT NULL DEFAULT '0',
  `liste_point_actif` varchar(255) NOT NULL,
  `m3` int(10) unsigned NOT NULL,
  `largeur` double NOT NULL,
  `profondeur` double NOT NULL,
  `tarif_ht` double NOT NULL,
  `id_bache` int(10) unsigned NOT NULL,
  `nom_bache` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;


ALTER TABLE `fr_abeko_plans`
  ADD PRIMARY KEY (`id`);


ALTER TABLE `fr_abeko_plans`
  MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT;

ALTER TABLE `fr_abeko_plans` ADD `id_tarif_applicable_ligne` INT UNSIGNED NOT NULL DEFAULT '0' AFTER `id_tarif_applicable`;



CREATE TABLE `fr_abeko_plan_articles_composes` (
  `id` int(10) unsigned NOT NULL,
  `id_plan` int(10) unsigned NOT NULL DEFAULT '0',
  `ref` varchar(25) NOT NULL,
  `nom` varchar(255) NOT NULL,
  `descriptif` text NOT NULL,
  `prix_unitaire_ht` double NOT NULL,
  `quantite` double NOT NULL,
  `id_position` int(10) unsigned NOT NULL DEFAULT '0',
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;


ALTER TABLE `fr_abeko_plan_articles_composes`
  ADD PRIMARY KEY (`id`);


ALTER TABLE `fr_abeko_plan_articles_composes`
  MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT;




CREATE TABLE `fr_abeko_plan_articles_composes_lignes` (
  `id` int(10) unsigned NOT NULL,
  `id_article_compose` int(10) unsigned NOT NULL,
  `id_produit` int(10) unsigned NOT NULL,
  `ref` varchar(25) NOT NULL,
  `nom` int(255) NOT NULL,
  `prix_unitaire_ht` double NOT NULL,
  `quantite` double NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;


ALTER TABLE `fr_abeko_plan_articles_composes_lignes`
  ADD PRIMARY KEY (`id`);


ALTER TABLE `fr_abeko_plan_articles_composes_lignes`
  MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT;

ALTER TABLE `fr_abeko_plan_articles_composes` ADD `id_article_compose` INT NOT NULL DEFAULT '0' AFTER `id`;

ALTER TABLE `fr_abeko_plan_articles_composes_lignes` CHANGE `nom` `nom` VARCHAR(255) NOT NULL;