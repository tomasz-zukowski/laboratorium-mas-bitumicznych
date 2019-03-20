CREATE TABLE IF NOT EXISTS `crm_clients_list` (
`id` int(11) NOT NULL,
  `name` varchar(100) CHARACTER SET utf8 COLLATE utf8_polish_ci NOT NULL,
  `name2` varchar(100) CHARACTER SET utf8 COLLATE utf8_polish_ci NOT NULL,
  `str` varchar(15) CHARACTER SET utf8 COLLATE utf8_polish_ci NOT NULL,
  `street` varchar(100) CHARACTER SET utf8 COLLATE utf8_polish_ci NOT NULL,
  `number` varchar(15) CHARACTER SET utf8 COLLATE utf8_polish_ci NOT NULL,
  `post_code` varchar(10) CHARACTER SET utf8 COLLATE utf8_polish_ci NOT NULL,
  `city` varchar(100) CHARACTER SET utf8 COLLATE utf8_polish_ci NOT NULL,
  `country` varchar(100) CHARACTER SET utf8 COLLATE utf8_polish_ci NOT NULL,
  `nip` int(10) NOT NULL,
  `eunip` int(15) NOT NULL,
  `activity_description` text NOT NULL,
  `_active` int(1) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

CREATE TABLE IF NOT EXISTS `crm_client_contacts` (
`id` int(11) NOT NULL,
  `description` varchar(255) CHARACTER SET utf8 COLLATE utf8_polish_ci DEFAULT NULL,
  `phone` varchar(30) CHARACTER SET utf8 COLLATE utf8_polish_ci DEFAULT NULL,
  `email` varchar(70) CHARACTER SET utf8 COLLATE utf8_polish_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

ALTER TABLE `crm_clients_list`
 ADD PRIMARY KEY (`id`);

ALTER TABLE `crm_client_contacts`
 ADD PRIMARY KEY (`id`);

ALTER TABLE `crm_clients_list`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

ALTER TABLE `crm_client_contacts`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

INSERT INTO `_conf_module_list` (`module_name`, `description`, `version`, `required`, `_active`) VALUES ('crm', 'crm', '1', '0', '1');