CREATE TABLE `zeapps_token` (
  `id` int(10) unsigned NOT NULL,
  `id_user` int(10) unsigned NOT NULL,
  `token` varchar(64) NOT NULL,
  `date_expire` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;


ALTER TABLE `zeapps_token`
  ADD PRIMARY KEY (`id`);


ALTER TABLE `zeapps_token`
  MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT;

  ALTER TABLE `zeapps_token` ADD `created_at` TIMESTAMP NULL DEFAULT NULL AFTER `date_expire`, ADD `updated_at` TIMESTAMP NULL DEFAULT NULL AFTER `created_at`;