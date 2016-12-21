CREATE TABLE `zeapps_companies` (
  `id` int(10) unsigned NOT NULL,
  `id_user_account_manager` int(10) unsigned NOT NULL,
  `name_user_account_manager` varchar(100) NOT NULL,
  `company_name` varchar(255) NOT NULL,
  `id_parent_company` int(10) unsigned NOT NULL,
  `name_parent_company` varchar(255) NOT NULL,
  `id_type_account` int(10) unsigned NOT NULL,
  `name_type_account` int(100) NOT NULL,
  `id_activity_area` int(10) unsigned NOT NULL,
  `name_activity_area` varchar(100) NOT NULL,
  `turnover` bigint(20) NOT NULL,
  `billing_address_1` varchar(100) NOT NULL,
  `billing_address_2` varchar(100) NOT NULL,
  `billing_address_3` varchar(100) NOT NULL,
  `billing_city` varchar(100) NOT NULL,
  `billing_zipcode` varchar(50) NOT NULL,
  `billing_state` varchar(100) NOT NULL,
  `billing_country_id` int(10) unsigned NOT NULL,
  `billing_country_name` varchar(100) NOT NULL,
  `delivery_address_1` varchar(100) NOT NULL,
  `delivery_address_2` varchar(100) NOT NULL,
  `delivery_address_3` varchar(100) NOT NULL,
  `delivery_city` varchar(100) NOT NULL,
  `delivery_zipcode` varchar(50) NOT NULL,
  `delivery_state` varchar(100) NOT NULL,
  `delivery_country_id` int(10) unsigned NOT NULL,
  `delivery_country_name` varchar(100) NOT NULL,
  `comment` text NOT NULL,
  `phone` varchar(25) NOT NULL,
  `fax` varchar(25) NOT NULL,
  `website_url` varchar(255) NOT NULL,
  `code_naf` varchar(15) NOT NULL,
  `company_number` varchar(30) NOT NULL,
  `accounting_number` varchar(15) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;


ALTER TABLE `zeapps_companies`
  ADD PRIMARY KEY (`id`);

ALTER TABLE `zeapps_companies`
  MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT;