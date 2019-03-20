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
INSERT INTO _users_list (id,forename,surname,email,login,password,group,_active) VALUES 
('1','Tomasz','Żukowski','tomasz.zukowski91@gmail.com','admin','a94a8fe5ccb19ba61c4c0873d391e987982fbbd3','1','1'),
('2','Jan','Kowalski','jan@kowalski.pl','test','a94a8fe5ccb19ba61c4c0873d391e987982fbbd3','0','0'),
('3','Karolina','Kowaleczko','karolina.kowaleczko94@gmail.com','kowaleczko','b444ac06613fc8d63795be9ad0beaf55011936ac','1','1'),
('4','Juliusz','Słowacki','juliusz.slowacki@wp.pl','slowacki','109f4b3c50d7b0df729d299bc6f8e9ef9066971f','0','1'),
('5','Arkadiusz','Niemier','niemier.arkadiusz@wp.pl','niemier','b444ac06613fc8d63795be9ad0beaf55011936ac','2','1'),
('6','Kamil','Gawroński','gawrnoskis.kamil@vp.pl','gawronski','cdef94f9fadb63f0adc64b7d806d43e9df5692d6','2','1'),
('7','Sebastian','Wróblewski','wroblewski@wp.pl','wroblewski','b444ac06613fc8d63795be9ad0beaf55011936ac','2','1'),
('9','Tomasz','Ludka','hasłoto@test1.pl','ludka','b444ac06613fc8d63795be9ad0beaf55011936ac','0','1'),
('10','Kamil','Krajan','admin@test.pl','admin2','b444ac06613fc8d63795be9ad0beaf55011936ac','0','1'),
('11','Patryk','Kowalewski','kowalewski@on.pl','kowlewski','b444ac06613fc8d63795be9ad0beaf55011936ac','0','1'),
('12','Magdalena','Kadłubek','kadmag@wp.pl','magdalena','b444ac06613fc8d63795be9ad0beaf55011936ac','2','1'),
('13','Imię','Nazwisko','test@test.pl','test33','b444ac06613fc8d63795be9ad0beaf55011936ac','2','1'),
('14','Lukasz','Zagrobelny','lukasz@zagro.pl','zagrobelny','a94a8fe5ccb19ba61c4c0873d391e987982fbbd3','0','1'),
('15','Jannw','Bloch','bloch@wp.pl','bloch','b444ac06613fc8d63795be9ad0beaf55011936ac','2','1'),
('16','Piotr','Frącik','fracik.trans@vp.pl','fracik','b444ac06613fc8d63795be9ad0beaf55011936ac','2','1'),
('17','Marian','Krach','krach.gieldow@yw.pl','krach','b444ac06613fc8d63795be9ad0beaf55011936ac','2','1'),
('18','Artur','Lukaszuk','ad@www.pl','test35','a94a8fe5ccb19ba61c4c0873d391e987982fbbd3','1','1'),
('19','Przemysław','Barzybut','parzybut@test.pl','parzybut','a94a8fe5ccb19ba61c4c0873d391e987982fbbd3','3','1');


