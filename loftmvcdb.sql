-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Хост: 127.0.0.1:3306
-- Время создания: Апр 24 2022 г., 17:25
-- Версия сервера: 8.0.24
-- Версия PHP: 7.4.27

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- База данных: `loftmvcdb`
--

-- --------------------------------------------------------

--
-- Структура таблицы `posts`
--

CREATE TABLE `posts` (
  `id` int NOT NULL,
  `user_id` int NOT NULL,
  `texts` text CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `createdAt` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

--
-- Дамп данных таблицы `posts`
--

INSERT INTO `posts` (`id`, `user_id`, `texts`, `createdAt`) VALUES
(1, 1, 'Это тот самый пост', '2022-04-20 08:14:44'),
(2, 2, 'Это другой пост', '2022-04-20 09:31:18'),
(3, 2, 'это еще одно сообщение', '2022-04-21 14:13:47'),
(4, 2, 'это еще одно сообщение', '2022-04-21 14:15:53'),
(5, 3, 'это сообщение от Дмитрия..', '2022-04-21 14:23:27'),
(6, 1, 'gdfgdf', '2022-04-22 09:25:40'),
(7, 1, 'сообщение с картинкой', '2022-04-22 09:30:09'),
(23, 1, 'и еще одно сообщение 7', '2022-04-22 10:45:13'),
(24, 2, 'это сообщение от Петра', '2022-04-22 11:56:27'),
(25, 2, 'rtrewrwer', '2022-04-22 13:15:45'),
(43, 2, 'rtrewrwer', '2022-04-22 13:55:10');

-- --------------------------------------------------------

--
-- Структура таблицы `users`
--

CREATE TABLE `users` (
  `id` int NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `gender` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

--
-- Дамп данных таблицы `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `password`, `created_at`, `gender`) VALUES
(1, 'Pavel', '11pasha@mail.ru', '466bb5bb2d78aec1fc8ef2f2d45793cc77d7670f', '2022-04-20 18:54:01', '1'),
(2, 'Petro', 'Petro@mail.ru', '466bb5bb2d78aec1fc8ef2f2d45793cc77d7670f', '2022-04-20 18:54:54', '1'),
(3, 'Dmitry', 'Dmitry@gmail.com', '466bb5bb2d78aec1fc8ef2f2d45793cc77d7670f', '2022-04-21 16:22:54', '1'),
(4, 'Nikola', '11pasha@mail.ru', '466bb5bb2d78aec1fc8ef2f2d45793cc77d7670f', '2022-04-22 09:40:50', '1'),
(5, 'Chebur', 'Chebur@mail.ru', '466bb5bb2d78aec1fc8ef2f2d45793cc77d7670f', '2022-04-22 09:46:35', '1'),
(6, 'Pavelв', '11padfdfsha@mail.ru', '5079bbd0c5f83c9bb94062420379899e16af408c', '2022-04-22 09:58:11', '1'),
(7, 'PavelQ', '11pashQa@mail.ru', '3f2e412de208f3a3f4d20992429528c6e0fa165f', '2022-04-22 10:01:45', '1'),
(8, 'NikolaQ', 'NikolaQ@mail.ru', '466bb5bb2d78aec1fc8ef2f2d45793cc77d7670f', '2022-04-22 10:05:41', '1');

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `posts`
--
ALTER TABLE `posts`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `name` (`name`);

--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `posts`
--
ALTER TABLE `posts`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=53;

--
-- AUTO_INCREMENT для таблицы `users`
--
ALTER TABLE `users`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
