-- phpMyAdmin SQL Dump
-- version 5.1.0
-- https://www.phpmyadmin.net/
--
-- Хост: 127.0.0.1:3306
-- Время создания: Мар 16 2022 г., 19:29
-- Версия сервера: 8.0.24
-- Версия PHP: 8.0.8

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- База данных: `ddstdt`
--

-- --------------------------------------------------------

--
-- Структура таблицы `categories`
--

CREATE TABLE `categories` (
  `id` int NOT NULL,
  `title` tinytext NOT NULL,
  `parent` int NOT NULL,
  `date` datetime NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb3;

--
-- Дамп данных таблицы `categories`
--

INSERT INTO `categories` (`id`, `title`, `parent`, `date`) VALUES
(1, 'Общие', 0, '2022-03-08 14:04:50'),
(2, 'Другие', 0, '2022-03-08 14:06:07');

-- --------------------------------------------------------

--
-- Структура таблицы `chat`
--

CREATE TABLE `chat` (
  `id` int NOT NULL,
  `id_user` int NOT NULL,
  `admin` int NOT NULL,
  `answer` int NOT NULL,
  `my_like` int NOT NULL,
  `message` text CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `date` datetime NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `chat`
--

INSERT INTO `chat` (`id`, `id_user`, `admin`, `answer`, `my_like`, `message`, `date`) VALUES
(46, 9, 0, 0, 0, 'вапва', '2022-03-05 19:37:34'),
(47, 9, 0, 0, 0, 'вапва', '2022-03-05 19:37:38'),
(36, 9, 0, 0, 0, 'вапвап', '2022-03-05 19:36:51'),
(37, 9, 0, 0, 0, 'впвпв', '2022-03-05 19:36:55'),
(38, 9, 0, 0, 0, 'цукцуе', '2022-03-05 19:37:04'),
(39, 9, 0, 0, 0, 'укеукн', '2022-03-05 19:37:07'),
(40, 9, 0, 0, 0, 'кеукнукн', '2022-03-05 19:37:11'),
(41, 9, 0, 0, 0, 'впепва', '2022-03-05 19:37:15'),
(42, 9, 0, 0, 0, 'впуквар', '2022-03-05 19:37:19'),
(43, 9, 0, 0, 0, 'вкпвпва', '2022-03-05 19:37:22'),
(44, 9, 0, 0, 0, 'weter', '2022-03-05 19:37:27'),
(45, 9, 0, 0, 0, 'вапваа', '2022-03-05 19:37:31'),
(34, 9, 0, 0, 0, 'вапвапварвар', '2022-03-05 19:36:40'),
(35, 9, 0, 0, 0, 'вапвапва', '2022-03-05 19:36:48'),
(31, 9, 0, 0, 0, 'dfsf', '2022-03-05 19:36:28'),
(32, 9, 0, 0, 0, 'вапвапа', '2022-03-05 19:36:31'),
(33, 9, 0, 0, 0, 'чапваавр', '2022-03-05 19:36:35'),
(26, 9, 0, 0, 0, 'салом', '2022-02-26 23:48:56'),
(27, 10, 0, 0, 0, 'Алекумсалом', '2022-02-26 23:49:32'),
(28, 9, 0, 0, 0, 'Часанчик шумо нагз саломатиё нагз хаматарафа нагз', '2022-03-05 19:30:14');

-- --------------------------------------------------------

--
-- Структура таблицы `dialog`
--

CREATE TABLE `dialog` (
  `id` int NOT NULL,
  `sender` int NOT NULL,
  `recipient` int NOT NULL,
  `status` int NOT NULL,
  `date` datetime NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb3;

--
-- Дамп данных таблицы `dialog`
--

INSERT INTO `dialog` (`id`, `sender`, `recipient`, `status`, `date`) VALUES
(8, 10, 9, 1, '2022-02-27 00:05:50');

-- --------------------------------------------------------

--
-- Структура таблицы `message`
--

CREATE TABLE `message` (
  `id` int NOT NULL,
  `message` text NOT NULL,
  `id_dialog` int NOT NULL,
  `id_user` int NOT NULL,
  `status` int NOT NULL,
  `time` varchar(255) NOT NULL,
  `date` datetime NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb3;

--
-- Дамп данных таблицы `message`
--

INSERT INTO `message` (`id`, `message`, `id_dialog`, `id_user`, `status`, `time`, `date`) VALUES
(20, 'Алооо', 8, 9, 1, '1645909291', '2022-02-27 00:09:30'),
(21, 'Алооо', 8, 9, 1, '1645909296', '2022-02-27 00:09:30'),
(22, 'Алооо', 8, 9, 1, '1645909390', '2022-02-27 00:09:30'),
(23, 'Лаббай', 8, 10, 1, '1645909550', '2022-02-27 00:09:30');

-- --------------------------------------------------------

--
-- Структура таблицы `online`
--

CREATE TABLE `online` (
  `id` int NOT NULL,
  `id_user` int NOT NULL,
  `ip` varchar(255) NOT NULL,
  `date` datetime NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb3;

--
-- Дамп данных таблицы `online`
--

INSERT INTO `online` (`id`, `id_user`, `ip`, `date`) VALUES
(12, 9, '127.0.0.1', '2022-03-12 17:41:01');

-- --------------------------------------------------------

--
-- Структура таблицы `products`
--

CREATE TABLE `products` (
  `id` int NOT NULL,
  `title` tinytext NOT NULL,
  `summa` float NOT NULL,
  `parent` int NOT NULL,
  `text` text NOT NULL,
  `up_date` datetime NOT NULL,
  `date` datetime NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb3;

--
-- Дамп данных таблицы `products`
--

INSERT INTO `products` (`id`, `title`, `summa`, `parent`, `text`, `up_date`, `date`) VALUES
(1, 'Ноутбук Asus X543MA‐GQ552T (90NB0IR7-M25920) ', 3000, 1, 'Intel Celeron N4000/15.6\"/1366x768/4 GB/1000 GB', '2022-03-09 16:35:14', '2022-03-09 16:35:14');

-- --------------------------------------------------------

--
-- Структура таблицы `users`
--

CREATE TABLE `users` (
  `id` int NOT NULL,
  `name` varchar(255) NOT NULL,
  `sex` int NOT NULL,
  `id_friend` int NOT NULL,
  `city` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `phone` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `email` varchar(255) NOT NULL,
  `id_code` varchar(100) NOT NULL,
  `online` datetime NOT NULL,
  `date` datetime NOT NULL,
  `text` text NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb3;

--
-- Дамп данных таблицы `users`
--

INSERT INTO `users` (`id`, `name`, `sex`, `id_friend`, `city`, `password`, `phone`, `email`, `id_code`, `online`, `date`, `text`) VALUES
(10, 'Манижа', 2, 0, '0', '4a7d1ed414474e4033ac29ccb8653d9b', '+992985336005', 'abdushakur97@mail.ru', '120000102063', '2022-02-27 00:10:23', '2022-02-26 23:46:42', '...'),
(9, 'Абдушакур Савзаев+', 1, 0, '0', '81dc9bdb52d04dc20036dbd8313ed055', '+992985060681', 'abdushakur97@mail.ru', '120000915696', '2022-03-12 17:41:01', '2022-02-26 22:54:04', '123142432'),
(11, 'Abdushukur Savzaev', 2, 0, '0', 'b4b147bc522828731f1a016bfa72c073', '+992985060683', 'abdushakur97@mail.ru', '120000116465', '2022-02-27 21:41:27', '2022-02-27 21:41:02', '...'),
(12, 'Jamoliddin Сайдов', 1, 0, '0', 'e10adc3949ba59abbe56e057f20f883e', '+992985060690', 'Abc@mail.ru', '120000129806', '2022-02-27 22:13:51', '2022-02-27 21:47:36', '...');

-- --------------------------------------------------------

--
-- Структура таблицы `wallet`
--

CREATE TABLE `wallet` (
  `id` int NOT NULL,
  `id_user` int NOT NULL,
  `summa` float NOT NULL,
  `date` datetime NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb3;

--
-- Дамп данных таблицы `wallet`
--

INSERT INTO `wallet` (`id`, `id_user`, `summa`, `date`) VALUES
(10, 11, 0, '2022-02-27 21:41:02'),
(9, 10, 0, '2022-02-26 23:46:42'),
(8, 9, 0, '2022-02-26 22:54:04'),
(11, 12, 0, '2022-02-27 21:47:36');

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `chat`
--
ALTER TABLE `chat`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `dialog`
--
ALTER TABLE `dialog`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `message`
--
ALTER TABLE `message`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `online`
--
ALTER TABLE `online`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `wallet`
--
ALTER TABLE `wallet`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `categories`
--
ALTER TABLE `categories`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT для таблицы `chat`
--
ALTER TABLE `chat`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=48;

--
-- AUTO_INCREMENT для таблицы `dialog`
--
ALTER TABLE `dialog`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT для таблицы `message`
--
ALTER TABLE `message`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT для таблицы `online`
--
ALTER TABLE `online`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT для таблицы `products`
--
ALTER TABLE `products`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT для таблицы `users`
--
ALTER TABLE `users`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT для таблицы `wallet`
--
ALTER TABLE `wallet`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
