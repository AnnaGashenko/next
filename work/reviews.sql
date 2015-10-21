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
-- Структура таблицы `reviews`
--

CREATE TABLE IF NOT EXISTS `reviews` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `login` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `text` text COLLATE utf8_unicode_ci NOT NULL,
  `date` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=13 ;

--
-- Дамп данных таблицы `reviews`
--

INSERT INTO `reviews` (`id`, `login`, `email`, `text`, `date`) VALUES
(1, 'admin', 'ann.gashenko@mail.ru', 'Тра та та', '2014-07-15 14:56:50'),
(2, 'Ann', 'tarlapan85@rambler.ru', 'Родилась Алена в красивом южном городе Сухуми. В августе 1992 года, их город стал полем боевых действий между грузинами и абхазцами. ', '2014-07-15 15:26:59'),
(3, '2619996400978', 'stalkerstas81@gmail.com', '5.10 We will usually refund any money received from you using the same method originally used by you to pay for your purchase. Where you have purchased an item online and return it to one of our stores, where you originally paid by credit or debit card we will be able to process the refund in store provided you bring with you the card on which you made the original purchase. Where the item was originally purchased using Paypal, or paid in part or full using vouchers, or if you do not bring your credit/debit card with you, we will be unable to immediately process the refund in store and we will return the item to our warehouse where the refund will be processed. ', '2014-07-15 15:49:49'),
(4, 'admin', 'stalkerstas81@gmail.com', '6. RISK, TITLE AND LIABILITY \n6.1 The products will be at your risk from the time of delivery. \n6.2 Ownership of the products will only pass to you when we receive full payment of all sums due in respect of the products, including delivery charges. ', '2014-07-15 15:54:02'),
(5, 'admin', 'ann.gashenko@mail.ru', '6. RISK, TITLE AND LIABILITY \n6.1 The products will be at your risk from the time of delivery. \n6.2 Ownership of the products will only pass to you when we receive full payment of all sums due in respect of the products, including delivery charges. ', '2014-07-15 15:55:57'),
(6, 'Гена', 'anyabelaya21@mail.ru', 'Спасибо Вам огромное за такие прекрасные курсы! В уроках все очень понятно рассказано по этапам с самого начала. С помощью Ваших уроков порог входа в РНР минимален и легок как никогда! Спасибо за Ваш труд!!!', '2014-07-15 16:32:05'),
(7, 'Тарас', 'taras@mail.ru', 'привет\r\nпроверка\r\nсвязи', '2014-07-15 16:35:26'),
(8, 'admin', 'ann.gashenko@mail.ru', '<Script Language="JavaScript">alert("Приветик!");</Script>', '2014-07-15 18:47:08'),
(10, '2619996400978', 'tarlapan85@rambler.ru', 'echo "<div style="text-decoration:underline">HELOO</div>";', '2014-08-18 11:47:53'),
(11, '55555555555555555555', 'ann.gashenko@mail.ru', 'Текс '' т', '2014-08-18 11:48:46'),
(12, 'jjjjjjjjjjjjjjjjjjjjjjjjjjj', 'anyabelaya21@mail.ru', 'ТЕКС''СТ', '2014-08-18 11:51:40');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
