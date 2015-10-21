-- phpMyAdmin SQL Dump
-- version 3.5.1
-- http://www.phpmyadmin.net
--
-- Хост: 127.0.0.1
-- Время создания: Окт 10 2014 г., 11:15
-- Версия сервера: 5.5.25
-- Версия PHP: 5.3.13

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- База данных: `main`
--

-- --------------------------------------------------------

--
-- Структура таблицы `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `login` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `age` tinyint(4) NOT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `ip` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `user_agent` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `hash` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `active` tinyint(1) NOT NULL DEFAULT '0',
  `access` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=25 ;

--
-- Дамп данных таблицы `users`
--

INSERT INTO `users` (`id`, `login`, `password`, `age`, `email`, `ip`, `user_agent`, `hash`, `active`, `access`) VALUES
(1, 'Петрович', '', 0, '', '0', 'Mozilla/5.0 (Windows NT 6.1; rv:31.0) Gecko/20100101 Firefox/31.0', 'CBZw9ZmwyVwDc', 0, 0),
(2, ' Yamamoto', '', 10, '', '0', 'Mozilla/5.0 (Windows NT 6.1; rv:31.0) Gecko/20100101 Firefox/31.0', 'CBZw9ZmwyVwDc', 0, 0),
(3, 'inpost', '123', 2, 'inpost@list.ru', '0', 'Mozilla/5.0 (Windows NT 6.1; rv:31.0) Gecko/20100101 Firefox/31.0', 'CBZw9ZmwyVwDc', 0, 0),
(4, 'milko', '678', 22, 'milko@mail.ru', '0', 'Mozilla/5.0 (Windows NT 6.1; rv:31.0) Gecko/20100101 Firefox/31.0', 'CBZw9ZmwyVwDc', 0, 0),
(6, 'nusichka', 'CB0rpMAfi5jCM', 78, 'ann.gashenko@mail.ru', '0', 'Mozilla/5.0 (Windows NT 6.1; rv:31.0) Gecko/20100101 Firefox/31.0', 'CBZw9ZmwyVwDc', 0, 0),
(7, 'nusichka22', 'CB0rpMAfi5jCM', 70, 'gashenko@mail.ru', '0', 'Mozilla/5.0 (Windows NT 6.1; rv:31.0) Gecko/20100101 Firefox/31.0', 'CBZw9ZmwyVwDc', 0, 0),
(8, 'aja', 'CB1LZ4jvb0fcw', 32, 'annenko@mail.ru', '0', 'Mozilla/5.0 (Windows NT 6.1; rv:31.0) Gecko/20100101 Firefox/31.0', 'CBZw9ZmwyVwDc', 0, 0),
(9, 'ajan', 'CBDrAJStJiVyE', 43, 'annenvvvko@mail.ru', '0', 'Mozilla/5.0 (Windows NT 6.1; rv:31.0) Gecko/20100101 Firefox/31.0', 'CBZw9ZmwyVwDc', 0, 0),
(10, 'enrike', 'CBXwApSmBRYPM', 33, 'enegl@mail.ru', '0', 'Mozilla/5.0 (Windows NT 6.1; rv:31.0) Gecko/20100101 Firefox/31.0', 'CBZw9ZmwyVwDc', 0, 0),
(11, 'enrike45', 'CBXwApSmBRYPM', 0, 'enegl34@mail.ru', '0', 'Mozilla/5.0 (Windows NT 6.1; rv:31.0) Gecko/20100101 Firefox/31.0', 'CBZw9ZmwyVwDc', 0, 0),
(12, 'nusichka000', 'CBWbP4iMKl.OM', 127, 'ene4@mail.ru', '0', 'Mozilla/5.0 (Windows NT 6.1; rv:31.0) Gecko/20100101 Firefox/31.0', 'CBZw9ZmwyVwDc', 0, 0),
(13, 'ajana', 'CBgwEXq2GnmNU', 33, 'ankjgfn.gashenko@mail.ru', '0', 'Mozilla/5.0 (Windows NT 6.1; rv:31.0) Gecko/20100101 Firefox/31.0', 'CBZw9ZmwyVwDc', 0, 0),
(14, 'ajahhhh', 'CBFE6GuERKvfY', 55, 'ankjgfn.ggggashenko@mail.ru', '0', 'Mozilla/5.0 (Windows NT 6.1; rv:31.0) Gecko/20100101 Firefox/31.0', 'CBZw9ZmwyVwDc', 0, 0),
(15, 'nusichka55', 'CBj8yWDsBK6.Q', 55, 'an333n.gashenko@mail.ru', '0', 'Mozilla/5.0 (Windows NT 6.1; rv:31.0) Gecko/20100101 Firefox/31.0', 'CBZw9ZmwyVwDc', 0, 0),
(17, 'stalkerstasss81', 'CB/8ujVB7ZSDQ', 55, 'stalkerstas8111@gmail.com', '0', 'Mozilla/5.0 (Windows NT 6.1; rv:31.0) Gecko/20100101 Firefox/31.0', 'CBZw9ZmwyVwDc', 1, 0),
(18, 'ajapppp', 'CBPQic0Yg0a62', 90, 'anjjjjjjjjn.gashenko@mail.ru', '0', 'Mozilla/5.0 (Windows NT 6.1; rv:31.0) Gecko/20100101 Firefox/31.0', 'CBZw9ZmwyVwDc', 0, 0),
(19, 'test', 'CBFO3Ao9BB7tg', 33, 'ann.gashenko22@mail.ru', '127.0.0.1', 'Mozilla/5.0 (Windows NT 5.1; rv:32.0) Gecko/20100101 Firefox/32.0', 'CBqbsDFnmKkSg', 1, 5),
(24, 'mia', 'CBFO3Ao9BB7tg', 5, 'mia.gashenko@mail.ru', '127.0.0.1', 'Mozilla/5.0 (Windows NT 6.1; rv:31.0) Gecko/20100101 Firefox/31.0', 'CB14e4bx69.PM', 1, 0),
(21, 'satas', 'CBFO3Ao9BB7tg', 34, 'satasnko@mail.ru', '0', 'Mozilla/5.0 (Windows NT 6.1; rv:31.0) Gecko/20100101 Firefox/31.0', 'CBZw9ZmwyVwDc', 0, 0),
(23, '', '', 0, '', '0', 'Mozilla/5.0 (Windows NT 6.1; rv:31.0) Gecko/20100101 Firefox/31.0', 'CBZw9ZmwyVwDc', 0, 0);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
