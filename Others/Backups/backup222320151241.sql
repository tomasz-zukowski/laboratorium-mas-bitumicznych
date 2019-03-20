-- Usunięcie tabeli_conf_module_list
DROP TABLE _conf_module_list;

-- Struktura tabeli_conf_module_list
CREATE TABLE `_conf_module_list` (
  `module_name` varchar(255) COLLATE utf8_polish_ci NOT NULL,
  `description` varchar(255) COLLATE utf8_polish_ci NOT NULL,
  PRIMARY KEY (`module_name`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_polish_ci;

-- Zrzut danych z tabeli_conf_module_list
INSERT INTO _conf_module_list (`module_name`,`description`) VALUES 
('database','Moduł pozwalający na zarządzanie bazą danych - tworzenie i przywracanie kopii zapasowych.'),
('errors','Moduł błędów'),
('home','Moduł widoków głównych'),
('modules','Zarządzanie modułami, dodawanie, usuwanie, włączanie i wyłączanie modułów.'),
('navigation','Zarządzanie nawigacją aplikacji. Dodawanie, usuwanie linków nawigacyjnych.'),
('rights','Moduł do zarządzania uprawnieniami użytkowników i grup'),
('users','Zarządzanie użytkownikami oraz grupami');


-- Usunięcie tabeli_conf_navigation_links
DROP TABLE _conf_navigation_links;

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
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=latin1;

-- Zrzut danych z tabeli_conf_navigation_links
INSERT INTO _conf_navigation_links (`id`,`link`,`description`,`location`,`_permission`,`_active`,`_parent`,`_possition`) VALUES 
('1','Strona główna','Strona główna aplikacji','/home/index','0','1','0','0'),
('2','Link testowy','Opis testowy','linkt/estowy','1','1','1','1'),
('3','Link testowydwa','Test','test','1','1','1','1'),
('7','Uczelnia','test','test','0','1','0','1'),
('8','Uczelnia dwa','Uczelnia','test','0','1','0','1'),
('9','Uczelnia','uczelnia','test','0','1','0','1');


-- Usunięcie tabeli_database_info
DROP TABLE _database_info;

-- Struktura tabeli_database_info
CREATE TABLE `_database_info` (
  `copy_number` varchar(255) COLLATE utf8_polish_ci NOT NULL,
  `date` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_polish_ci;

-- Zrzut danych z tabeli_database_info
-- Usunięcie tabeli_rights_groups
DROP TABLE _rights_groups;

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
('1','000102'),
('3','000401'),
('3','000402'),
('3','000403'),
('3','000404'),
('3','000405');


-- Usunięcie tabeli_rights_set
DROP TABLE _rights_set;

-- Struktura tabeli_rights_set
CREATE TABLE `_rights_set` (
  `id` int(6) unsigned zerofill NOT NULL AUTO_INCREMENT,
  `right_name` varchar(70) COLLATE utf8_polish_ci NOT NULL,
  `_default` tinyint(4) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=603 DEFAULT CHARSET=utf8 COLLATE=utf8_polish_ci;

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
DROP TABLE _rights_users;

-- Struktura tabeli_rights_users
CREATE TABLE `_rights_users` (
  `user_id` int(11) NOT NULL,
  `right_id` int(6) unsigned zerofill NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_polish_ci;

-- Zrzut danych z tabeli_rights_users
INSERT INTO _rights_users (`user_id`,`right_id`) VALUES 
('15','000101'),
('15','000102'),
('19','000101'),
('19','000102'),
('19','000201');


-- Usunięcie tabeli_test_test
DROP TABLE _test_test;

-- Struktura tabeli_test_test
CREATE TABLE `_test_test` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `test1` varchar(255) COLLATE utf8_polish_ci NOT NULL,
  `test` varchar(255) COLLATE utf8_polish_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_polish_ci;

-- Zrzut danych z tabeli_test_test
-- Usunięcie tabeli_users_groups
DROP TABLE _users_groups;

-- Struktura tabeli_users_groups
CREATE TABLE `_users_groups` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `type_name` varchar(50) COLLATE utf8_polish_ci NOT NULL,
  `description` text COLLATE utf8_polish_ci NOT NULL,
  `_active` tinyint(4) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8 COLLATE=utf8_polish_ci;

-- Zrzut danych z tabeli_users_groups
INSERT INTO _users_groups (`id`,`type_name`,`description`,`_active`) VALUES 
('1','Administratorzy','Użytkownicy, którzy są administratorami, posiadają znaczącą wiedzę o zarządzaniu aplikacją i jej ustawieniami.','1'),
('2','Użytkownicy','Zwykli użytkownicy aplikacji.','1'),
('3','Grupa testowa','Test','1'),
('4','Brak grupy','Użytkownicy, którzy nie zostali przydzieleni do żadnej grupy.','1');


-- Usunięcie tabeli_users_list
DROP TABLE _users_list;

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
) ENGINE=InnoDB AUTO_INCREMENT=20 DEFAULT CHARSET=utf8 COLLATE=utf8_polish_ci;

-- Zrzut danych z tabeli_users_list
INSERT INTO _users_list (`id`,`forename`,`surname`,`email`,`login`,`password`,`group`,`_active`) VALUES 
('1','Tomasz','Zukowski','tomasz.zukowski91@gmail.com','admin','a94a8fe5ccb19ba61c4c0873d391e987982fbbd3','1','1'),
('2','Jan','Kowalski','jan@kowalski.pl','test','a94a8fe5ccb19ba61c4c0873d391e987982fbbd3','0','0'),
('3','Karolina','Kowaleczko','karolina.kowaleczko94@gmail.com','kowaleczko','b444ac06613fc8d63795be9ad0beaf55011936ac','1','1'),
('4','Juliusz','Slowacki','juliusz.slowacki@wp.pl','slowacki','109f4b3c50d7b0df729d299bc6f8e9ef9066971f','0','1'),
('5','Arkadiusz','Niemier','niemier.arkadiusz@wp.pl','niemier','b444ac06613fc8d63795be9ad0beaf55011936ac','2','1'),
('6','Kamil','Gawronski','gawrnoskis.kamil@vp.pl','gawronski','cdef94f9fadb63f0adc64b7d806d43e9df5692d6','2','1'),
('7','Sebastian','Wroblewski','wroblewski@wp.pl','wroblewski','b444ac06613fc8d63795be9ad0beaf55011936ac','2','1'),
('9','Tomasz','Ludka','hasłoto@test1.pl','ludka','b444ac06613fc8d63795be9ad0beaf55011936ac','0','1'),
('10','Kamil','Krajan','admin@test.pl','admin2','b444ac06613fc8d63795be9ad0beaf55011936ac','0','1'),
('11','Patryk','Kowalewski','kowalewski@on.pl','kowlewski','b444ac06613fc8d63795be9ad0beaf55011936ac','0','1'),
('12','Magdalena','Kadlubek','kadmag@wp.pl','magdalena','b444ac06613fc8d63795be9ad0beaf55011936ac','2','1'),
('13','Imie','Nazwisko','test@test.pl','test33','b444ac06613fc8d63795be9ad0beaf55011936ac','2','1'),
('14','Lukasz','Zagrobelny','lukasz@zagro.pl','zagrobelny','a94a8fe5ccb19ba61c4c0873d391e987982fbbd3','0','1'),
('15','Jannw','Bloch','bloch@wp.pl','bloch','b444ac06613fc8d63795be9ad0beaf55011936ac','2','1'),
('16','Piotr','Fracik','fracik.trans@vp.pl','fracik','b444ac06613fc8d63795be9ad0beaf55011936ac','2','1'),
('17','Marian','Krach','krach.gieldow@yw.pl','krach','b444ac06613fc8d63795be9ad0beaf55011936ac','2','1'),
('18','Artur','Lukaszuk','ad@www.pl','test35','a94a8fe5ccb19ba61c4c0873d391e987982fbbd3','1','1'),
('19','Przemyslaw','Barzybut','parzybut@test.pl','parzybut','a94a8fe5ccb19ba61c4c0873d391e987982fbbd3','0','1');


-- Usunięcie tabelicrm_client_contacts
DROP TABLE crm_client_contacts;

-- Struktura tabelicrm_client_contacts
CREATE TABLE `crm_client_contacts` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `description` varchar(255) CHARACTER SET utf8 COLLATE utf8_polish_ci DEFAULT NULL,
  `phone` varchar(30) CHARACTER SET utf8 COLLATE utf8_polish_ci DEFAULT NULL,
  `email` varchar(70) CHARACTER SET utf8 COLLATE utf8_polish_ci DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Zrzut danych z tabelicrm_client_contacts
-- Usunięcie tabelicrm_clients_list
DROP TABLE crm_clients_list;

-- Struktura tabelicrm_clients_list
CREATE TABLE `crm_clients_list` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
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
  `_active` int(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Zrzut danych z tabelicrm_clients_list
