CREATE TABLE `zeapps_projects` (
  `id` int(10) unsigned NOT NULL,
  `id_company` int(10) unsigned NOT NULL,
  `company_name` varchar(100) NOT NULL,
  `id_user_project_manager` int(10) unsigned NOT NULL,
  `name_user_project_manager` varchar(100) NOT NULL,
  `project_name` varchar(150) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;


ALTER TABLE `zeapps_projects`
  ADD PRIMARY KEY (`id`);


ALTER TABLE `zeapps_projects`
  MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT;