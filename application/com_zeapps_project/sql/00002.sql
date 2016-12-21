CREATE TABLE `zeapps_project_sections` (
  `id` int(10) unsigned NOT NULL,
  `id_project` int(10) unsigned NOT NULL DEFAULT '0',
  `name` varchar(255) NOT NULL,
  `order_section` int(10) unsigned NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;


ALTER TABLE `zeapps_project_sections`
  ADD PRIMARY KEY (`id`);


ALTER TABLE `zeapps_project_sections`
  MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT;