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
('crm','crm','1.0.0','0','1'),
('database','Moduł pozwalający na zarządzanie bazą danych - tworzenie i przywracanie kopii zapasowych.','engine v.1.0','1','1'),
('errors','Moduł błędów','engine v.1.0','1','1'),
('home','Moduł widoków głównych','engine v.1.0','1','1'),
('lab','Moduł laboratorium','1.0.0','0','1'),
('modules','Zarządzanie modułami, dodawanie, usuwanie, włączanie i wyłączanie modułów.','engine v.1.0','1','1'),
('navigation','Zarządzanie nawigacją aplikacji. Dodawanie, usuwanie linków nawigacyjnych.','engine v.1.0','1','1'),
('rights','Moduł do zarządzania uprawnieniami użytkowników i grup','engine v.1.0','1','1'),
('users','Zarządzanie użytkownikami oraz grupami','engine v.1.0','1','1');


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
) ENGINE=InnoDB AUTO_INCREMENT=18 DEFAULT CHARSET=latin1;

-- Zrzut danych z tabeli_conf_navigation_links
INSERT INTO _conf_navigation_links (`id`,`link`,`description`,`location`,`_permission`,`_active`,`_parent`,`_possition`) VALUES 
('1','Strona główna','Strona główna aplikacji','home/index','0','1','0','0'),
('10','CRM','link do modułu CRM','crm/review','0','1','0','1'),
('11','Lista badań','Badania mas','lab/examinations/','0','1','0','2'),
('12','Harmonogram badań','Harmonogram badań','lab/schedule_month','0','1','0','3'),
('13','Laboratorium','Laboratorium','lab/index','0','1','0','4'),
('14','Zleć badanie','Zlecanie badań','lab/new_examination','0','1','13','1'),
('15','Nowy typ badań','Nowy typ badań','lab/new_type','0','1','13','3'),
('16','Świadectwa badań','Lista świadectw','lab/certificate_list','0','1','13','4'),
('17','Typy badań','Lista zarejestrowanych typów badań','lab/examination_types','0','1','13','2');


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
('1','000102'),
('3','000401'),
('3','000402'),
('3','000403'),
('3','000404'),
('3','000405');


-- Usunięcie tabeli_rights_set
DROP TABLE IF EXISTS _rights_set;

-- Struktura tabeli_rights_set
CREATE TABLE `_rights_set` (
  `id` int(6) unsigned zerofill NOT NULL AUTO_INCREMENT,
  `right_name` varchar(70) COLLATE utf8_polish_ci NOT NULL,
  `_default` tinyint(4) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=805 DEFAULT CHARSET=utf8 COLLATE=utf8_polish_ci;

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
('000304','database_backup_restore','0'),
('000401','navigation','0'),
('000402','navigation_links_list','0'),
('000403','navigation_ link_new','0'),
('000404','navigation_link_edit','0'),
('000405','navigation_link_delete','0'),
('000501','rights','0'),
('000502','rights_edit','0'),
('000601','crm','0'),
('000602','crm_review','0'),
('000603','crm_search','0'),
('000604','crm_new_one','0'),
('000605','crm_details','0'),
('000606','crm_edit','0'),
('000607','crm_new_contact','0'),
('000608','crm_edit_contact','0'),
('000609','crm_delete_contact','0'),
('000610','crm_new_building','0'),
('000611','crm_edit_building','0'),
('000612','crm_delete_build','0'),
('000613','crm_archive','0'),
('000701','lab','0'),
('000702','lab_standards','0'),
('000703','lab_new_standard','0'),
('000704','lab_standard_details','0'),
('000705','lab_standard_edit','0'),
('000706','lab_standard_archivize','0'),
('000707','lab_standard_manage_descriptions','0'),
('000708','lab_standard_new_description','0'),
('000709','lab_standard_delete_description','0'),
('000710','lab_standard_manage_types','0'),
('000711','lab_standard_delete_types','0'),
('000712','lab_standard_manage_categories','0'),
('000713','lab_standard_register_borders','0'),
('000714','lab_standard_register_deviations','0'),
('000715','lab_standard_edit_deviations','0'),
('000716','lab_examination_types','0'),
('000717','lab_new_examination_type','0'),
('000718','lab_examination_type','0'),
('000719','lab_register_curve','0'),
('000720','lab_delete_curve','0'),
('000721','lab_archivize','0'),
('000722','lab_new_examination','0'),
('000723','lab_confirm_sample','0'),
('000724','lab_delete_examination','0'),
('000725','lab_run_examination','0'),
('000726','lab_examination_results','0'),
('000727','lab_register_certificate','0'),
('000728','lab_show_certificate','0'),
('000729','lab_certificate_list','0'),
('000730','lab_schedule_month','0'),
('000731','lab_schedule_day','0'),
('000732','lab_settings','0'),
('000733','lab_examination_list','0'),
('000734','lab_examination_archive','0'),
('000735','lab_examination_details','0'),
('000736','lab_standard_delete_categories','0'),
('000801','modules','0'),
('000802','modules_list','0'),
('000803','modules_change_status','0'),
('000804','modules_new_one','0');


-- Usunięcie tabeli_rights_users
DROP TABLE IF EXISTS _rights_users;

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
('19','000201'),
('1','000601'),
('1','000602'),
('1','000603'),
('1','000604'),
('1','000605'),
('1','000606'),
('1','000607'),
('1','000608'),
('1','000609'),
('1','000610'),
('1','000611'),
('1','000612'),
('1','000613'),
('1','000301'),
('1','000302'),
('1','000303'),
('1','000304'),
('1','000101'),
('1','000102'),
('1','000701'),
('1','000702'),
('1','000703'),
('1','000704'),
('1','000705'),
('1','000706'),
('1','000707'),
('1','000708'),
('1','000709'),
('1','000710'),
('1','000711'),
('1','000712'),
('1','000736'),
('1','000713'),
('1','000714'),
('1','000715'),
('1','000732'),
('1','000716'),
('1','000717'),
('1','000718'),
('1','000719'),
('1','000720'),
('1','000721'),
('1','000733'),
('1','000722'),
('1','000735'),
('1','000723'),
('1','000724'),
('1','000725'),
('1','000726'),
('1','000727'),
('1','000734'),
('1','000729'),
('1','000728'),
('1','000730'),
('1','000731'),
('1','000801'),
('1','000802'),
('1','000401'),
('1','000402'),
('1','000403'),
('1','000404'),
('1','000405'),
('1','000201'),
('1','000202'),
('1','000001'),
('1','000002'),
('1','000003'),
('1','000004'),
('1','000005'),
('1','000006'),
('1','000007'),
('1','000008'),
('1','000009'),
('1','000010');


-- Usunięcie tabeli_users_groups
DROP TABLE IF EXISTS _users_groups;

-- Struktura tabeli_users_groups
CREATE TABLE `_users_groups` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `type_name` varchar(50) COLLATE utf8_polish_ci NOT NULL,
  `description` text COLLATE utf8_polish_ci NOT NULL,
  `_active` tinyint(4) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8 COLLATE=utf8_polish_ci;

-- Zrzut danych z tabeli_users_groups
INSERT INTO _users_groups (`id`,`type_name`,`description`,`_active`) VALUES 
('1','Administratorzy','Użytkownicy, którzy są administratorami, posiadają znaczącą wiedzę o zarządzaniu aplikacją i jej ustawieniami.','1'),
('2','Użytkownicy','Zwykli użytkownicy aplikacji.','1'),
('3','Grupa testowa','Test','1'),
('4','Brak grupy','Użytkownicy, którzy nie zostali przydzieleni do żadnej grupy.','1'),
('5','Testowa','testowa','1');


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
  `group` int(12) NOT NULL DEFAULT '0',
  `_active` tinyint(4) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=20 DEFAULT CHARSET=utf8 COLLATE=utf8_polish_ci;

-- Zrzut danych z tabeli_users_list
INSERT INTO _users_list (`id`,`forename`,`surname`,`email`,`login`,`password`,`group`,`_active`) VALUES 
('1','Tomasz','Żukowski','tomasz.zukowski91@gmail.com','admin','a94a8fe5ccb19ba61c4c0873d391e987982fbbd3','1','1'),
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
('15','Jan','Bloch','bloch@wp.pl','bloch','b444ac06613fc8d63795be9ad0beaf55011936ac','2','1'),
('16','Piotr','Fracik','fracik.trans@vp.pl','fracik','b444ac06613fc8d63795be9ad0beaf55011936ac','2','1'),
('17','Marian','Krach','krach.gieldow@yw.pl','krach','b444ac06613fc8d63795be9ad0beaf55011936ac','2','1'),
('18','Artur','Lukaszuk','ad@www.pl','test35','a94a8fe5ccb19ba61c4c0873d391e987982fbbd3','1','1'),
('19','Przemyslaw','Barzybut','parzybut@test.pl','parzybut','a94a8fe5ccb19ba61c4c0873d391e987982fbbd3','0','1');


-- Usunięcie tabelicrm_client_buildings
DROP TABLE IF EXISTS crm_client_buildings;

-- Struktura tabelicrm_client_buildings
CREATE TABLE `crm_client_buildings` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `client_id` int(11) NOT NULL,
  `name` varchar(255) CHARACTER SET utf8 COLLATE utf8_polish_ci NOT NULL,
  `str_type` varchar(15) CHARACTER SET utf8 COLLATE utf8_polish_ci NOT NULL,
  `street` varchar(100) CHARACTER SET utf8 COLLATE utf8_polish_ci NOT NULL,
  `number` varchar(15) CHARACTER SET utf8 COLLATE utf8_polish_ci NOT NULL,
  `post_code` varchar(10) CHARACTER SET utf8 COLLATE utf8_polish_ci NOT NULL,
  `city` varchar(100) CHARACTER SET utf8 COLLATE utf8_polish_ci NOT NULL,
  `comments` text CHARACTER SET utf8 COLLATE utf8_polish_ci,
  `_active` int(11) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

-- Zrzut danych z tabelicrm_client_buildings
INSERT INTO crm_client_buildings (`id`,`client_id`,`name`,`str_type`,`street`,`number`,`post_code`,`city`,`comments`,`_active`) VALUES 
('1','1','Budowa testowa nr 12','ul','Dębnica','50','77-300','Człuchów','Test','1'),
('2','1','Budowa testowa nr 33','ul','Dębnica','5','77-300','Człuchów','test','0'),
('3','4','Chojnice - Batorego','ul','Batorego','23','69-900','Chojnice','','1'),
('4','5','Wiejska 23','ul','Wiejska','23','00-480','Warszawa','','1'),
('5','5','Kolejowa 13','ul','Kolejowa','13','00-480','Warszawa','','1');


-- Usunięcie tabelicrm_client_contacts
DROP TABLE IF EXISTS crm_client_contacts;

-- Struktura tabelicrm_client_contacts
CREATE TABLE `crm_client_contacts` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `client_id` int(11) NOT NULL,
  `description` varchar(255) CHARACTER SET utf8 COLLATE utf8_polish_ci DEFAULT NULL,
  `phone` varchar(30) CHARACTER SET utf8 COLLATE utf8_polish_ci DEFAULT NULL,
  `email` varchar(70) CHARACTER SET utf8 COLLATE utf8_polish_ci DEFAULT NULL,
  `comments` text CHARACTER SET utf8 COLLATE utf8_polish_ci,
  `_active` int(11) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;

-- Zrzut danych z tabelicrm_client_contacts
INSERT INTO crm_client_contacts (`id`,`client_id`,`description`,`phone`,`email`,`comments`,`_active`) VALUES 
('1','1','Tomasz Żukowski','880-166-527','tomasz.zukowski91@gmail.com','To jest kontakt testowy, proszę dzwonić w godzinach 8.00 do 15.00. Jeżeli nie to rano odpowiada na maile.','1'),
('2','1','Marcin Żukowski','721874749','','Test kontaktu nr 223','0'),
('3','4','Jan Kowalski','888-809-810','jan@brodnica.psb.pl','Dzwonić pn-czw w godzinach 12-17','1'),
('4','4','Maria Bernacka','721-877-241','maria@brodnica.psb.pl','','1'),
('5','1','test','123','test@test.pl','test','0'),
('6','5','Joanna Macierzak','721-842-241','macierzak@labtom.com.pl','','1');


-- Usunięcie tabelicrm_clients_list
DROP TABLE IF EXISTS crm_clients_list;

-- Struktura tabelicrm_clients_list
CREATE TABLE `crm_clients_list` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) CHARACTER SET utf8 COLLATE utf8_polish_ci NOT NULL,
  `name2` varchar(255) CHARACTER SET utf8 COLLATE utf8_polish_ci NOT NULL,
  `str_type` varchar(15) CHARACTER SET utf8 COLLATE utf8_polish_ci NOT NULL,
  `street` varchar(100) CHARACTER SET utf8 COLLATE utf8_polish_ci NOT NULL,
  `number` varchar(15) CHARACTER SET utf8 COLLATE utf8_polish_ci NOT NULL,
  `post_code` varchar(10) CHARACTER SET utf8 COLLATE utf8_polish_ci NOT NULL,
  `city` varchar(100) CHARACTER SET utf8 COLLATE utf8_polish_ci NOT NULL,
  `country` varchar(100) CHARACTER SET utf8 COLLATE utf8_polish_ci NOT NULL,
  `nip` int(10) NOT NULL,
  `eunip` int(15) DEFAULT NULL,
  `activity_description` text CHARACTER SET utf8 COLLATE utf8_polish_ci NOT NULL,
  `_active` int(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

-- Zrzut danych z tabelicrm_clients_list
INSERT INTO crm_clients_list (`id`,`name`,`name2`,`str_type`,`street`,`number`,`post_code`,`city`,`country`,`nip`,`eunip`,`activity_description`,`_active`) VALUES 
('1','Frito','Frito','ul','Dębnica','5','77-300','Człuchów','Polska','1231412512','2147483647','Testowa dzialalnosc','1'),
('2','Frito2','Frito SC2','ul.','Dębnica','5','77-300','Człuchów','Polska','1231412512','2147483647','Testowa dzialalnosc','1'),
('3','Testowy klient','Testowy klient boskosci','ul','Koszalińska','1','77-300','Człuchów','Polska','1233211233','2147483647','','0'),
('4','PDB Brodnica','Przedsiębiorstwo Drogowo-Budowlane Brodnica','ul','Długa','27','87-300','Brodnica','Polska','2147483647','','Produkcja asfaltu','1'),
('5','LabTom','Laboratorium budowlane Tomasz Kowal','ul','Wiejska','23','00-480','Warszawa','Polska','2147483647','0','','1');


-- Usunięcie tabelilab_certificate
DROP TABLE IF EXISTS lab_certificate;

-- Struktura tabelilab_certificate
CREATE TABLE `lab_certificate` (
  `_examination` int(11) NOT NULL,
  `_date` date NOT NULL,
  `_time` time NOT NULL,
  `creator` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Zrzut danych z tabelilab_certificate
INSERT INTO lab_certificate (`_examination`,`_date`,`_time`,`creator`) VALUES 
('1','2015-05-29','16:31:00','Zukowski Tomasz'),
('7','2015-06-01','12:07:00','Zukowski Tomasz'),
('8','2015-06-03','16:36:00','?ukowski Tomasz');


-- Usunięcie tabelilab_configuration
DROP TABLE IF EXISTS lab_configuration;

-- Struktura tabelilab_configuration
CREATE TABLE `lab_configuration` (
  `tests_per_day` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Zrzut danych z tabelilab_configuration
INSERT INTO lab_configuration (`tests_per_day`) VALUES 
('8');


-- Usunięcie tabelilab_curves
DROP TABLE IF EXISTS lab_curves;

-- Struktura tabelilab_curves
CREATE TABLE `lab_curves` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `_examination_type` int(3) NOT NULL,
  `S063` decimal(5,2) DEFAULT NULL,
  `S125` decimal(5,2) DEFAULT NULL,
  `S2` decimal(5,2) DEFAULT NULL,
  `S4` decimal(5,2) DEFAULT NULL,
  `S5` decimal(5,2) DEFAULT NULL,
  `S8` decimal(5,2) DEFAULT NULL,
  `S11` decimal(5,2) DEFAULT NULL,
  `S16` decimal(5,2) DEFAULT NULL,
  `S22` decimal(5,2) DEFAULT NULL,
  `S31` decimal(5,2) DEFAULT NULL,
  `S45` decimal(5,2) DEFAULT NULL,
  `bitum` decimal(5,2) DEFAULT NULL,
  `register_date` date NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=6 DEFAULT CHARSET=latin2;

-- Zrzut danych z tabelilab_curves
INSERT INTO lab_curves (`id`,`_examination_type`,`S063`,`S125`,`S2`,`S4`,`S5`,`S8`,`S11`,`S16`,`S22`,`S31`,`S45`,`bitum`,`register_date`) VALUES 
('5','1','5.13','13.22','30.00','','','72.00','','95.00','','','','5.80','2015-05-29');


-- Usunięcie tabelilab_examination_orders
DROP TABLE IF EXISTS lab_examination_orders;

-- Struktura tabelilab_examination_orders
CREATE TABLE `lab_examination_orders` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `_client` int(11) NOT NULL,
  `_client_building` int(11) NOT NULL,
  `_client_contact` int(11) NOT NULL,
  `examination_date` date NOT NULL,
  `_examination_type` int(11) NOT NULL,
  `_sample` int(11) DEFAULT NULL,
  `sample_status` int(11) NOT NULL DEFAULT '0' COMMENT '0 - oczekujaca, 1- dostarczona',
  `status` int(11) NOT NULL DEFAULT '0' COMMENT '0 - aktywne, 1 - zakonczone',
  `status_changed_date` date DEFAULT NULL,
  `status_changed_time` time DEFAULT NULL,
  `user` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=latin1;

-- Zrzut danych z tabelilab_examination_orders
INSERT INTO lab_examination_orders (`id`,`_client`,`_client_building`,`_client_contact`,`examination_date`,`_examination_type`,`_sample`,`sample_status`,`status`,`status_changed_date`,`status_changed_time`,`user`) VALUES 
('1','4','3','3','2015-06-05','1','1','1','1','2015-05-29','16:31:14','0'),
('3','4','3','4','2015-06-12','1','3','1','0','','','0'),
('7','1','1','1','2015-06-10','1','7','1','1','2015-06-01','12:07:05','0'),
('8','4','3','3','2015-06-11','1','8','1','1','2015-06-03','16:36:36','1'),
('9','4','3','3','2015-06-11','1','9','1','1','2015-06-03','21:26:42','1'),
('10','4','3','3','2015-06-11','1','10','1','0','','','1'),
('11','1','1','1','2015-06-04','1','11','0','0','','','1'),
('12','1','1','1','2015-06-05','1','12','1','0','','','1'),
('13','5','5','6','2015-06-25','1','13','1','0','','','1');


-- Usunięcie tabelilab_examination_results
DROP TABLE IF EXISTS lab_examination_results;

-- Struktura tabelilab_examination_results
CREATE TABLE `lab_examination_results` (
  `_examination_order` int(11) NOT NULL,
  `client` int(11) NOT NULL,
  `_examination_type` int(3) NOT NULL,
  `S063` decimal(5,2) DEFAULT NULL,
  `S125` decimal(5,2) DEFAULT NULL,
  `S2` decimal(5,2) DEFAULT NULL,
  `S4` decimal(5,2) DEFAULT NULL,
  `S5` decimal(5,2) DEFAULT NULL,
  `S8` decimal(5,2) DEFAULT NULL,
  `S11` decimal(5,2) DEFAULT NULL,
  `S16` decimal(5,2) DEFAULT NULL,
  `S22` decimal(5,2) DEFAULT NULL,
  `S31` decimal(5,2) DEFAULT NULL,
  `S45` decimal(5,2) DEFAULT NULL,
  `bitum` decimal(5,2) DEFAULT NULL,
  `register_date` date NOT NULL,
  `result` tinyint(1) NOT NULL COMMENT '1 zgodne ,0 niezgodne'
) ENGINE=MyISAM DEFAULT CHARSET=latin2;

-- Zrzut danych z tabelilab_examination_results
INSERT INTO lab_examination_results (`_examination_order`,`client`,`_examination_type`,`S063`,`S125`,`S2`,`S4`,`S5`,`S8`,`S11`,`S16`,`S22`,`S31`,`S45`,`bitum`,`register_date`,`result`) VALUES 
('1','4','1','4.00','2.00','4.00','','','24.00','','14.00','','','','12.00','2015-05-29','0'),
('7','1','1','1.00','2.00','12.00','','','24.00','','76.00','','','','7.00','2015-06-01','0'),
('8','4','1','2.97','7.10','13.35','','','32.54','','72.13','','','','8.20','2015-06-03','0'),
('9','4','1','3.00','18.00','21.00','','','24.00','','83.00','','','','8.20','2015-06-03','0');


-- Usunięcie tabelilab_examination_samples
DROP TABLE IF EXISTS lab_examination_samples;

-- Struktura tabelilab_examination_samples
CREATE TABLE `lab_examination_samples` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `number` text NOT NULL,
  `status` int(11) NOT NULL COMMENT '1 - dostarczona, 0 oczekujaca',
  `method` int(11) DEFAULT NULL COMMENT '0 - odbior, 1 wysylka',
  `collection_date` date DEFAULT NULL,
  `user` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=latin1;

-- Zrzut danych z tabelilab_examination_samples
INSERT INTO lab_examination_samples (`id`,`number`,`status`,`method`,`collection_date`,`user`) VALUES 
('1','Test1','1','0','2015-05-28','1'),
('3','C0975/2015','0','1','2015-05-28','1'),
('7','C0875/2015','0','0','2015-05-28','1'),
('8','PR/Z23/2015','1','0','0000-00-00','1'),
('9','PR/Z23/2015','1','0','0000-00-00','1'),
('10','PR/Z23/2015','1','0','2015-06-03','1'),
('11','SAM87/2015','0','1','0000-00-00','0'),
('12','SAM11A/2015','0','0','2015-06-05','1'),
('13','PR525/2015','0','0','2015-06-14','1');


-- Usunięcie tabelilab_examination_types
DROP TABLE IF EXISTS lab_examination_types;

-- Struktura tabelilab_examination_types
CREATE TABLE `lab_examination_types` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `symbol` varchar(255) NOT NULL,
  `standard` int(11) NOT NULL,
  `description` int(11) NOT NULL,
  `type` int(11) NOT NULL,
  `categorie` int(11) NOT NULL,
  `created` date NOT NULL,
  `_active` int(11) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

-- Zrzut danych z tabelilab_examination_types
INSERT INTO lab_examination_types (`id`,`symbol`,`standard`,`description`,`type`,`categorie`,`created`,`_active`) VALUES 
('1','AC11S/V1/2014','1','3','12','1','2015-05-20','1'),
('2','AC16P/K3-4/R/2015','1','1','8','2','2015-06-03','1');


-- Usunięcie tabelilab_standards
DROP TABLE IF EXISTS lab_standards;

-- Struktura tabelilab_standards
CREATE TABLE `lab_standards` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) CHARACTER SET utf8 COLLATE utf8_polish_ci NOT NULL,
  `year` int(4) NOT NULL,
  `document` varchar(255) CHARACTER SET utf16 COLLATE utf16_polish_ci NOT NULL,
  `_active` int(11) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

-- Zrzut danych z tabelilab_standards
INSERT INTO lab_standards (`id`,`name`,`year`,`document`,`_active`) VALUES 
('1','WT2 2014','2014','WT2 2014 GDDKiA','1'),
('2','WT2 2015','2015','Test2','0');


-- Usunięcie tabelilab_standards_borders
DROP TABLE IF EXISTS lab_standards_borders;

-- Struktura tabelilab_standards_borders
CREATE TABLE `lab_standards_borders` (
  `_categorie` int(3) NOT NULL,
  `_type` int(3) NOT NULL,
  `S063l` decimal(5,2) DEFAULT NULL,
  `S063r` decimal(5,2) DEFAULT NULL,
  `S125l` decimal(5,2) DEFAULT NULL,
  `S125r` decimal(5,2) DEFAULT NULL,
  `S2l` decimal(5,2) DEFAULT NULL,
  `S2r` decimal(5,2) DEFAULT NULL,
  `S4l` decimal(5,2) DEFAULT NULL,
  `S4r` decimal(5,2) DEFAULT NULL,
  `S5l` decimal(5,2) DEFAULT NULL,
  `S5r` decimal(5,2) DEFAULT NULL,
  `S8l` decimal(5,2) DEFAULT NULL,
  `S8r` decimal(5,2) DEFAULT NULL,
  `S11l` decimal(5,2) DEFAULT NULL,
  `S11r` decimal(5,2) DEFAULT NULL,
  `S16l` decimal(5,2) DEFAULT NULL,
  `S16r` decimal(5,2) DEFAULT NULL,
  `S22l` decimal(5,2) DEFAULT NULL,
  `S22r` decimal(5,2) DEFAULT NULL,
  `S31l` decimal(5,2) DEFAULT NULL,
  `S31r` decimal(5,2) DEFAULT NULL,
  `S45l` decimal(5,2) DEFAULT NULL,
  `S45r` decimal(5,2) DEFAULT NULL,
  `bituml` decimal(5,2) DEFAULT NULL,
  `bitumr` decimal(5,2) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin2;

-- Zrzut danych z tabelilab_standards_borders
INSERT INTO lab_standards_borders (`_categorie`,`_type`,`S063l`,`S063r`,`S125l`,`S125r`,`S2l`,`S2r`,`S4l`,`S4r`,`S5l`,`S5r`,`S8l`,`S8r`,`S11l`,`S11r`,`S16l`,`S16r`,`S22l`,`S22r`,`S31l`,`S31r`,`S45l`,`S45r`,`bituml`,`bitumr`) VALUES 
('1','12','5.00','5.80','8.00','20.00','30.00','35.00','','','','','70.00','90.00','','','90.00','100.00','','','','','','','5.80','5.80'),
('1','11','','','','','','','','','','','23.00','123.00','','','','','11.00','111.00','23.00','32.00','','','6.00','6.00');


-- Usunięcie tabelilab_standards_categories
DROP TABLE IF EXISTS lab_standards_categories;

-- Struktura tabelilab_standards_categories
CREATE TABLE `lab_standards_categories` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `categorie` varchar(100) CHARACTER SET utf8 COLLATE utf8_polish_ci NOT NULL,
  `standard` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

-- Zrzut danych z tabelilab_standards_categories
INSERT INTO lab_standards_categories (`id`,`categorie`,`standard`) VALUES 
('1','KR1 - KR2','1'),
('2','KR3 - KR4','1'),
('3','KR5 - KR6','1');


-- Usunięcie tabelilab_standards_descriptions
DROP TABLE IF EXISTS lab_standards_descriptions;

-- Struktura tabelilab_standards_descriptions
CREATE TABLE `lab_standards_descriptions` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `description` varchar(255) CHARACTER SET utf8 COLLATE utf8_polish_ci NOT NULL,
  `standard` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

-- Zrzut danych z tabelilab_standards_descriptions
INSERT INTO lab_standards_descriptions (`id`,`description`,`standard`) VALUES 
('1','Beton asfaltowy do podbudowy','1'),
('2','Beton asfaltowy do warstwy wiążącej','1'),
('3','Beton asfaltowy do warstwy ścieralnej','1');


-- Usunięcie tabelilab_standards_deviations
DROP TABLE IF EXISTS lab_standards_deviations;

-- Struktura tabelilab_standards_deviations
CREATE TABLE `lab_standards_deviations` (
  `_standard` int(3) NOT NULL,
  `S063l` decimal(5,2) DEFAULT NULL,
  `S063r` decimal(5,2) DEFAULT NULL,
  `S125l` decimal(5,2) DEFAULT NULL,
  `S125r` decimal(5,2) DEFAULT NULL,
  `S2l` decimal(5,2) DEFAULT NULL,
  `S2r` decimal(5,2) DEFAULT NULL,
  `S4l` decimal(5,2) DEFAULT NULL,
  `S4r` decimal(5,2) DEFAULT NULL,
  `S5l` decimal(5,2) DEFAULT NULL,
  `S5r` decimal(5,2) DEFAULT NULL,
  `S8l` decimal(5,2) DEFAULT NULL,
  `S8r` decimal(5,2) DEFAULT NULL,
  `S11l` decimal(5,2) DEFAULT NULL,
  `S11r` decimal(5,2) DEFAULT NULL,
  `S16l` decimal(5,2) DEFAULT NULL,
  `S16r` decimal(5,2) DEFAULT NULL,
  `S22l` decimal(5,2) DEFAULT NULL,
  `S22r` decimal(5,2) DEFAULT NULL,
  `S31l` decimal(5,2) DEFAULT NULL,
  `S31r` decimal(5,2) DEFAULT NULL,
  `S45l` decimal(5,2) DEFAULT NULL,
  `S45r` decimal(5,2) DEFAULT NULL,
  `bituml` decimal(5,2) DEFAULT NULL,
  `bitumr` decimal(5,2) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin2;

-- Zrzut danych z tabelilab_standards_deviations
INSERT INTO lab_standards_deviations (`_standard`,`S063l`,`S063r`,`S125l`,`S125r`,`S2l`,`S2r`,`S4l`,`S4r`,`S5l`,`S5r`,`S8l`,`S8r`,`S11l`,`S11r`,`S16l`,`S16r`,`S22l`,`S22r`,`S31l`,`S31r`,`S45l`,`S45r`,`bituml`,`bitumr`) VALUES 
('1','','','','','','','','','','','','','','','','','','','-3.00','8.00','-10.00','10.00','-5.00','7.00');


-- Usunięcie tabelilab_standards_types
DROP TABLE IF EXISTS lab_standards_types;

-- Struktura tabelilab_standards_types
CREATE TABLE `lab_standards_types` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `type` varchar(100) CHARACTER SET utf8 COLLATE utf8_polish_ci NOT NULL,
  `standard` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=latin1;

-- Zrzut danych z tabelilab_standards_types
INSERT INTO lab_standards_types (`id`,`type`,`standard`) VALUES 
('1','AC 16W','1'),
('5','AC 11W','1'),
('7','AC 22W','1'),
('8','AC 16P','1'),
('9','AC 22P','1'),
('10','AC 32P','1'),
('11','AC 5S','1'),
('12','AC 11S','1'),
('14','AC 8S','1');


