CREATE TABLE `zeapps_contacts` (
  `id` int(10) unsigned NOT NULL,
  `id_user_account_manager` int(10) unsigned NOT NULL,
  `name_user_account_manager` varchar(100) NOT NULL,
  `id_company` int(10) unsigned NOT NULL,
  `name_company` int(255) NOT NULL,
  `title_name` varchar(30) NOT NULL,
  `first_name` varchar(50) NOT NULL,
  `last_name` varchar(50) NOT NULL,
  `email` varchar(255) NOT NULL,
  `phone` varchar(25) NOT NULL,
  `other_phone` varchar(25) NOT NULL,
  `mobile` varchar(25) NOT NULL,
  `fax` varchar(25) NOT NULL,
  `assistant` varchar(70) NOT NULL,
  `assistant_phone` varchar(25) NOT NULL,
  `department` varchar(100) NOT NULL,
  `job` varchar(100) NOT NULL,
  `email_opt_out` enum('Y','N') NOT NULL DEFAULT 'N',
  `skype_id` varchar(100) NOT NULL,
  `twitter` varchar(100) NOT NULL,
  `date_of_birth` date NOT NULL DEFAULT '0000-00-00',
  `address_1` varchar(100) NOT NULL,
  `address_2` varchar(100) NOT NULL,
  `address_3` varchar(100) NOT NULL,
  `city` varchar(100) NOT NULL,
  `zipcode` varchar(50) NOT NULL,
  `state` varchar(100) NOT NULL,
  `country_id` int(10) unsigned NOT NULL,
  `country_name` varchar(100) NOT NULL,
  `comment` text NOT NULL,
  `website_url` varchar(255) NOT NULL,
  `accounting_number` varchar(15) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

ALTER TABLE `zeapps_contacts`
  ADD PRIMARY KEY (`id`);

ALTER TABLE `zeapps_contacts`
  MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT;