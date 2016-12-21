ALTER TABLE `zeapps_users` ADD `deleted_at` TIMESTAMP NOT NULL AFTER `updated_at`;

ALTER TABLE `zeapps_users` CHANGE `deleted_at` `deleted_at` TIMESTAMP NULL DEFAULT NULL;

ALTER TABLE `zeapps_users` DROP `deleted`;

ALTER TABLE `zeapps_users` ADD `right_list` TEXT NOT NULL AFTER `password`;

ALTER TABLE `zeapps_users` ADD `groups_list` VARCHAR(255) NOT NULL AFTER `right_list`;





CREATE TABLE `zeapps_user_groups` (
  `id` int(10) unsigned NOT NULL,
  `name` varchar(50) NOT NULL,
  `right_list` text NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

ALTER TABLE `zeapps_user_groups`
  ADD PRIMARY KEY (`id`);

ALTER TABLE `zeapps_user_groups`
  MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT;