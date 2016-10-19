-- --------------------------------------------------------
-- Хост:                         127.0.0.1
-- Версия сервера:               5.5.52-0ubuntu0.12.04.1 - (Ubuntu)
-- ОС Сервера:                   debian-linux-gnu
-- HeidiSQL Версия:              8.3.0.4694
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;

-- Дамп структуры для таблица myads.ads
CREATE TABLE IF NOT EXISTS `ads` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(50) DEFAULT NULL,
  `text` text,
  `price` float DEFAULT NULL,
  `tree` int(11) DEFAULT NULL,
  `ctime` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `mtime` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Дамп данных таблицы myads.ads: ~0 rows (приблизительно)
/*!40000 ALTER TABLE `ads` DISABLE KEYS */;
/*!40000 ALTER TABLE `ads` ENABLE KEYS */;


-- Дамп структуры для таблица myads.category
CREATE TABLE IF NOT EXISTS `category` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `parent` int(11) NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `path` varchar(255) NOT NULL,
  `visible` int(1) NOT NULL DEFAULT '1',
  `table_ads` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=70 DEFAULT CHARSET=utf8;

-- Дамп данных таблицы myads.category: ~6 rows (приблизительно)
/*!40000 ALTER TABLE `category` DISABLE KEYS */;
INSERT INTO `category` (`id`, `parent`, `name`, `path`, `visible`, `table_ads`) VALUES
	(1, 0, 'Категория', '', 1, ''),
	(65, 1, 'Мобильная связь', 'mobilnaya_svyaz', 1, 'mobilnaya_svyaz'),
	(66, 65, 'Смартфоны, телефоны', 'telefoni_smartfoni_cdma', 1, 'telefoni_smartfoni_cdma'),
	(67, 65, 'Аксессуары для телефонов', 'chehli_i_aksessuari', 1, 'chehli_i_aksessuari'),
	(68, 65, 'Умные часы (Smartwatch)', 'smartwatch', 1, 'smartwatch'),
	(69, 65, 'Запчасти для смартфонов и телефонов', 'zapchasti_dlya_telefonov', 1, 'zapchasti_dlya_telefonov');
/*!40000 ALTER TABLE `category` ENABLE KEYS */;


-- Дамп структуры для таблица myads.chehli_i_aksessuari
CREATE TABLE IF NOT EXISTS `chehli_i_aksessuari` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(50) DEFAULT NULL,
  `text` text,
  `price` float DEFAULT NULL,
  `tree` int(11) DEFAULT NULL,
  `ctime` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `mtime` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

-- Дамп данных таблицы myads.chehli_i_aksessuari: ~1 rows (приблизительно)
/*!40000 ALTER TABLE `chehli_i_aksessuari` DISABLE KEYS */;
INSERT INTO `chehli_i_aksessuari` (`id`, `title`, `text`, `price`, `tree`, `ctime`, `mtime`) VALUES
	(1, 'Внешний аккумулятор (Power Bank) ExtraDigital MP-5', 'Продам Внешние аккумуляторы, Power Bank\r\nВнешний аккумулятор (Power Bank) ExtraDigital MP-5000 (PB00ED0007) Ёмкость (мАч): 5000; Технология: Li-Pol; Время полной зарядки (ч): 8; Макс. ток USB (А): 1; Адаптеры: Apple 30pin; Nokia DC 2.0;', 150, 0, '2016-07-08 11:26:13', NULL);
/*!40000 ALTER TABLE `chehli_i_aksessuari` ENABLE KEYS */;


-- Дамп структуры для таблица myads.images
CREATE TABLE IF NOT EXISTS `images` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `filename` varchar(255) NOT NULL,
  `type` varchar(100) NOT NULL,
  `size` int(11) unsigned NOT NULL,
  `caption` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

-- Дамп данных таблицы myads.images: ~2 rows (приблизительно)
/*!40000 ALTER TABLE `images` DISABLE KEYS */;
INSERT INTO `images` (`id`, `filename`, `type`, `size`, `caption`) VALUES
	(1, 'wall.jpg', 'image/jpeg', 607118, 'walll'),
	(2, 'roof.jpg', 'image/jpeg', 524574, 'roof');
/*!40000 ALTER TABLE `images` ENABLE KEYS */;


-- Дамп структуры для таблица myads.list
CREATE TABLE IF NOT EXISTS `list` (
  `id` smallint(6) unsigned NOT NULL AUTO_INCREMENT,
  `list` tinytext,
  `level` tinyint(4) unsigned DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Дамп данных таблицы myads.list: ~0 rows (приблизительно)
/*!40000 ALTER TABLE `list` DISABLE KEYS */;
/*!40000 ALTER TABLE `list` ENABLE KEYS */;


-- Дамп структуры для таблица myads.mobilnaya_svyaz
CREATE TABLE IF NOT EXISTS `mobilnaya_svyaz` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(50) DEFAULT NULL,
  `text` text,
  `price` float DEFAULT NULL,
  `tree` int(11) DEFAULT NULL,
  `ctime` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `mtime` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

-- Дамп данных таблицы myads.mobilnaya_svyaz: ~1 rows (приблизительно)
/*!40000 ALTER TABLE `mobilnaya_svyaz` DISABLE KEYS */;
INSERT INTO `mobilnaya_svyaz` (`id`, `title`, `text`, `price`, `tree`, `ctime`, `mtime`) VALUES
	(1, 'Повер банк (Power Bank) до 12000mAh', 'Продам Внешние аккумуляторы, Power Bank\r\nЗарядное устройство Power Bank на 4 аккумулятора, формфактора 18650 до 12000mAh. Он способен заряжать одновременно два устройства с силой тока в 1А и в 2А, так же есть встроенный фонарик', 100, 0, '2016-07-06 19:23:47', NULL);
/*!40000 ALTER TABLE `mobilnaya_svyaz` ENABLE KEYS */;


-- Дамп структуры для таблица myads.relations
CREATE TABLE IF NOT EXISTS `relations` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `tree` int(11) NOT NULL,
  `table` varchar(50) NOT NULL,
  `tid` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Дамп данных таблицы myads.relations: ~0 rows (приблизительно)
/*!40000 ALTER TABLE `relations` DISABLE KEYS */;
/*!40000 ALTER TABLE `relations` ENABLE KEYS */;


-- Дамп структуры для таблица myads.smartwatch
CREATE TABLE IF NOT EXISTS `smartwatch` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(50) DEFAULT NULL,
  `text` text,
  `price` float DEFAULT NULL,
  `tree` int(11) DEFAULT NULL,
  `ctime` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `mtime` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

-- Дамп данных таблицы myads.smartwatch: ~1 rows (приблизительно)
/*!40000 ALTER TABLE `smartwatch` DISABLE KEYS */;
INSERT INTO `smartwatch` (`id`, `title`, `text`, `price`, `tree`, `ctime`, `mtime`) VALUES
	(1, 'Наручные часы-телефон DZ09 Smart Watch (2 цвета).', 'Продам\r\nЧасы Smartwatch DZ09 представляет собой мини-компьютер. Теперь на вашем запястье пульт управления вашим мобильным телефоном и одновременно самостоятельное смарт-устройство.', 599, 0, '2016-07-08 11:53:29', NULL);
/*!40000 ALTER TABLE `smartwatch` ENABLE KEYS */;


-- Дамп структуры для таблица myads.telefoni_smartfoni_cdma
CREATE TABLE IF NOT EXISTS `telefoni_smartfoni_cdma` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(50) DEFAULT NULL,
  `text` text,
  `price` float DEFAULT NULL,
  `tree` int(11) DEFAULT NULL,
  `ctime` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `mtime` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8;

-- Дамп данных таблицы myads.telefoni_smartfoni_cdma: ~10 rows (приблизительно)
/*!40000 ALTER TABLE `telefoni_smartfoni_cdma` DISABLE KEYS */;
INSERT INTO `telefoni_smartfoni_cdma` (`id`, `title`, `text`, `price`, `tree`, `ctime`, `mtime`) VALUES
	(1, 'Apple iPhone 4S 16 Gb с гарантией от Дома Айфонов', 'Продам Apple iPhone 4S 16 Gb с гарантией 3 месяца от Дома Айфонов в отличном состоянии за 4 800 гривен! Есть белые, черные - любые! Только в Доме Айфонов Ты можешь не только купить любой Айфон, но и обмен', 4800, 0, '2016-07-06 19:12:54', NULL),
	(2, 'Apple iPhone 5 16 Gb с гарантией от Дома Айфонов', 'Продам\r\nApple iPhone 5 16 Gb с гарантией 3 месяца от Дома Айфонов в отличном состоянии за 5 100 гривен! Есть белые, черные, с разным объемом памяти - любые! Только в Доме Айфонов Ты можешь не только купить', 5100, 0, '2016-07-06 19:14:40', NULL),
	(3, 'Продам iphone 5s 16 gb neverlock айфон 5ес неверло', 'Продам\r\nApple iPhone 5s 16gb Space Gray Never Косметическое состояние как на фото, 4-/5. Работоспособность 100%. iOS 9,3,3! Телефон в ремонте не был, не тонул. Комплект!', 6400, 0, '2016-07-06 19:15:57', NULL),
	(4, 'смартфон Samsung N920C Galaxy Note 5 32GB (Black S', 'Продам\r\nПродам смартфон Samsung N920C Galaxy Note 5 32GB (Black Sapphire) новый в упаковке. Официальный UA UCRF, гарантия 1 год. в любом сервисном центре Samsung в Украине. Коробка не открывалась.', 14900, 0, '2016-07-06 19:16:48', NULL),
	(5, 'Iphone 6 64GB Space Gray. Гарантия, постоянная тех', 'Продам\r\nApple iPhone 6 64GB Space Gray из США, в Украине не использовался, NEVERLOCK (работает с любым оператором). 100% функциональность. Общее косметическое состояние - как новый. - коробка - кабель', 560, 0, '2016-07-06 19:17:47', NULL),
	(6, 'Куплю телефоны Nokia 8800 Arte', 'Куплю\r\nКуплю телефоны Nokia 8800 Arte Цена указана условная. Реальную цену обсудим в зависимости от модели, состояния и комплектации. Nokia 8800 Arte Gold куплю значительно дороже, от 7000 грн. и выше!', 7000, 0, '2016-07-06 19:18:33', NULL),
	(7, 'Куплю телефон Vertu Ascent X', 'Куплю\r\nКуплю телефон Vertu Ascent X. Только Титан. Обычный или Knurled. Предпочтительно комплектный. С конкретными предложениями прошу в Л.С. или звоните. Так же можно предлагать Vertu Signature и Vertu A', 700, 0, '2016-07-06 19:19:11', NULL),
	(8, 'Продам BlackBerry Storm 9530 1 Гб ПЗУ', 'Обменяю\r\nBlackBerry Storm 9530 Корпус прорезиненный метал 1 Гб ПЗУ, работа в частотных диапазонах GSM 850/900/1800/1900, UMTS 850/2100, CDMA 2000 1x EV-DO, поддержка стандартов передачи данных GPRS 10, EDGE', 9530, 0, '2016-07-06 19:20:14', NULL),
	(9, 'Мобильный телефон Samsung Galaxy Core 2 G355 Black', 'Продам\r\nВсе документы и коробки, зарядка в наличии, покупался в АЛЛО год назад не падал, пользовался аккуратно, в пленке и чехле.. работает отлично, но хочу поменять на что-то с побольше памяти', 1699, 0, '2016-07-06 19:20:55', NULL),
	(10, 'Iphone 5S 16GB Gold. Гарантия, постоянная техподде', 'Продам\r\nApple iPhone 5S 16GB Gold, из США, в Украине не использовался, NEVERLOCK (работает с любым оператором). 100% функциональность. Общее косметическое состояние - близкий к идеальному/как новый', 6000, 0, '2016-07-06 19:21:43', NULL);
/*!40000 ALTER TABLE `telefoni_smartfoni_cdma` ENABLE KEYS */;


-- Дамп структуры для таблица myads.users
CREATE TABLE IF NOT EXISTS `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `first_name` varchar(30) NOT NULL,
  `last_name` varchar(30) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

-- Дамп данных таблицы myads.users: ~3 rows (приблизительно)
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` (`id`, `username`, `password`, `first_name`, `last_name`) VALUES
	(1, 'admin', '$2y$10$1oFx2HFnwilYRT8VBsjZuOKaeKP6b67fRHJN5pYmgbZ3eEfGjNzD6', 'Alexandr', 'Mih'),
	(2, 'user', '$2y$10$kK2dZ//kbzY3noqBAizWLut.Cc7lzHfeYfDeXNe6eC6sZccssMV1u', 'Vasya', 'Pup'),
	(4, 'aaa111', '$2y$10$pYs0OmFVAUxFCrwX29dbs.lRwhjkCceYhFwyX86pzvsJ2Ihrf46UK', 'aaa', 'aaa');
/*!40000 ALTER TABLE `users` ENABLE KEYS */;


-- Дамп структуры для таблица myads.zapchasti_dlya_telefonov
CREATE TABLE IF NOT EXISTS `zapchasti_dlya_telefonov` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(50) DEFAULT NULL,
  `text` text,
  `price` float DEFAULT NULL,
  `tree` int(11) DEFAULT NULL,
  `ctime` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `mtime` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Дамп данных таблицы myads.zapchasti_dlya_telefonov: ~0 rows (приблизительно)
/*!40000 ALTER TABLE `zapchasti_dlya_telefonov` DISABLE KEYS */;
/*!40000 ALTER TABLE `zapchasti_dlya_telefonov` ENABLE KEYS */;
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IF(@OLD_FOREIGN_KEY_CHECKS IS NULL, 1, @OLD_FOREIGN_KEY_CHECKS) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
