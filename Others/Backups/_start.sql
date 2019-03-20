-- Usunięcie tabeli_conf_module_list
DROP TABLE IF EXISTS _conf_module_list;

-- Struktura tabeli_conf_module_list
CREATE TABLE `_conf_module_list` (
  `module_name` varchar(255) COLLATE utf8_polish_ci NOT NULL,
  `description` varchar(255) COLLATE utf8_polish_ci NOT NULL,
  `version` varchar(30) COLLATE utf8_polish_ci NOT NULL,
  `required` int(11) NOT NULL DEFAULT '0',
  `_active` int(11) NOT NULL DEFAULT '1',
  PRIMARY KEY (`module_name`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_polish_ci;

-- Zrzut danych z tabeli_conf_module_list
INSERT INTO _conf_module_list (`module_name`,`description`,`version`,`required`,`_active`) VALUES
('database','Moduł pozwalający na zarządzanie bazą danych - tworzenie i przywracanie kopii zapasowych.','engine no.1','1','1'),
('errors','Moduł błędów','engine no.1','1','1'),
('home','Moduł widoków głównych','engine no.1','1','1'),
('modules','Zarządzanie modułami, dodawanie, usuwanie, włączanie i wyłączanie modułów.','engine no.1','1','1'),
('navigation','Zarządzanie nawigacją aplikacji. Dodawanie, usuwanie linków nawigacyjnych.','engine no.1','1','1'),
('rights','Moduł do zarządzania uprawnieniami użytkowników i grup','engine no.1','1','1'),
('users','Zarządzanie użytkownikami oraz grupami','engine no.1','1','1');

-- Usunięcie tabeli_conf_navigation_links
DROP TABLE IF EXISTS _conf_navigation_links;

-- Struktura tabeli_conf_navigation_links
CREATE TABLE `_conf_navigation_links` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `link` varchar(255) CHARACTER SET utf8 COLLATE utf8_polish_ci NOT NULL,
  `description` text CHARACTER SET utf8 COLLATE utf8_polish_ci NOT NULL,
  `location` varchar(255) CHARACTER SET utf8 COLLATE utf8_polish_ci NOT NULL,
  `_permission` int(11) NOT NULL DEFAULT '0',
  `_active` int(11) NOT NULL DEFAULT '1',
  `_parent` int(11) NOT NULL DEFAULT '0',
  `_possition` int(11) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

-- Zrzut danych z tabeli_conf_navigation_links
INSERT INTO _conf_navigation_links (`id`,`link`,`description`,`location`,`_permission`,`_active`,`_parent`,`_possition`) VALUES
('1','Strona główna','Strona główna aplikacji','/home/index','0','1','0','0');

-- Usunięcie tabeli_database_info
DROP TABLE IF EXISTS _database_info;

-- Struktura tabeli_database_info
CREATE TABLE `_database_info` (
  `copy_number` varchar(255) COLLATE utf8_polish_ci NOT NULL,
  `date` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_polish_ci;

-- Zrzut danych z tabeli_database_info
-- Usunięcie tabeli_rights_groups
DROP TABLE IF EXISTS _rights_groups;

-- Struktura tabeli_rights_groups
CREATE TABLE `_rights_groups` (
  `group_id` int(11) NOT NULL,
  `right_id` int(6) unsigned zerofill NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_polish_ci;

-- Zrzut danych z tabeli_rights_groups
INSERT INTO _rights_groups (`group_id`,`right_id`) VALUES
('1','000301'),
('1','000302'),
('1','000303'),
('1','000304'),
('1','000305'),
('1','000501'),
('1','000101'),
('1','000102');

-- Usunięcie tabeli_rights_set
DROP TABLE IF EXISTS _rights_set;

-- Struktura tabeli_rights_set
CREATE TABLE `_rights_set` (
  `id` int(6) unsigned zerofill NOT NULL,
  `right_name` varchar(70) COLLATE utf8_polish_ci NOT NULL,
  `_default` tinyint(4) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_polish_ci;

-- Zrzut danych z tabeli_rights_set
INSERT INTO _rights_set (`id`,`right_name`,`_default`) VALUES
('000001','users','0'),
('000002','users_manage','0'),
('000003','users_new_one','0'),
('000004','users_details','0'),
('000005','users_edit','0'),
('000006','users_delete','0'),
('000007','users_groups','0'),
('000008','users_group_new','0'),
('000009','users_group_edit','0'),
('000010','users_group_delete','0'),
('000101','home','1'),
('000102','home_index','1'),
('000201','settings','0'),
('000202','settings_modules','0'),
('000301','database','0'),
('000302','database_backups','0'),
('000303','database _backup_new','0'),
('000304','database_backup_delete','0'),
('000305','database_backup_restore','0'),
('000401','navigation','0'),
('000402','navigation_links_list','0'),
('000403','navigation_ link_new','0'),
('000404','navigation_link_edit','0'),
('000405','navigation_link_delete','0'),
('000501','errors','0'),
('000601','rights','0'),
('000602','rights_edit','0');


-- Usunięcie tabeli_rights_users
DROP TABLE IF EXISTS _rights_users;

-- Struktura tabeli_rights_users
CREATE TABLE `_rights_users` (
  `user_id` int(11) NOT NULL,
  `right_id` int(6) unsigned zerofill NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_polish_ci;

-- Usunięcie tabeli_users_groups
DROP TABLE IF EXISTS _users_groups;

-- Struktura tabeli_users_groups
CREATE TABLE `_users_groups` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `type_name` varchar(50) COLLATE utf8_polish_ci NOT NULL,
  `description` text COLLATE utf8_polish_ci NOT NULL,
  `_active` tinyint(4) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8 COLLATE=utf8_polish_ci;

-- Zrzut danych z tabeli_users_groups
INSERT INTO _users_groups (`id`,`type_name`,`description`,`_active`) VALUES
('1','Administratorzy','Użytkownicy, którzy są administratorami, posiadają znaczącą wiedzę o zarządzaniu aplikacją i jej ustawieniami.','1'),
('2','Użytkownicy','Zwykli użytkownicy aplikacji.','1'),
('3','Nowa grupa','Grupa testowa','1'),
('4','Brak grupy','Użytkownicy, którzy nie zostali przydzieleni do żadnej grupy.','1');

-- Usunięcie tabeli_users_list
DROP TABLE IF EXISTS _users_list;

-- Struktura tabeli_users_list
CREATE TABLE `_users_list` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `forename` varchar(50) COLLATE utf8_polish_ci NOT NULL,
  `surname` varchar(50) COLLATE utf8_polish_ci NOT NULL,
  `email` varchar(50) COLLATE utf8_polish_ci NOT NULL,
  `login` varchar(50) COLLATE utf8_polish_ci NOT NULL,
  `password` varchar(150) COLLATE utf8_polish_ci NOT NULL,
  `group` tinyint(1) NOT NULL DEFAULT '0',
  `_active` tinyint(4) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8 COLLATE=utf8_polish_ci;