-- Usunięcie tabeli_conf_module_list
DROP TABLE _conf_module_list;

-- Struktura tabeli_conf_module_list
CREATE TABLE `_conf_module_list` (
  `module_name` varchar(255) COLLATE utf8_polish_ci NOT NULL,
  `description` varchar(255) COLLATE utf8_polish_ci NOT NULL,
  PRIMARY KEY (`module_name`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_polish_ci;

-- Zrzut danych z tabeli_conf_module_list
INSERT INTO _conf_module_list (module_name,description) VALUES 
('database','Moduł pozwalający na zarządzanie bazą danych - tworzenie i przywracanie kopii zapasowych.'),
('errors','Moduł błędów'),
('home','Moduł widoków głównych'),
('modules','Zarządzanie modułami, dodawanie, usuwanie, włączanie i wyłączanie modułów.'),
('navigation','Zarządzanie nawigacją aplikacji. Dodawanie, usuwanie linków nawigacyjnych.'),
('rights','Moduł do zarządzania uprawnieniami użytkowników i grup'),
('users','Zarządzanie użytkownikami oraz grupami');


