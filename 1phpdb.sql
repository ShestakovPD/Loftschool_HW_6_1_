-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Хост: 127.0.0.1:3306
-- Время создания: Май 14 2022 г., 10:36
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
-- База данных: `1phpdb`
--

-- --------------------------------------------------------

--
-- Структура таблицы `posts`
--

CREATE TABLE `posts` (
  `id` int NOT NULL,
  `user_id` int NOT NULL,
  `texts` text CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

--
-- Дамп данных таблицы `posts`
--

INSERT INTO `posts` (`id`, `user_id`, `texts`, `created_at`, `updated_at`) VALUES
(1, 1, 'Это тот самый пост', '2022-04-20 03:14:44', '2022-05-14 06:19:46'),
(4, 2, 'это еще одно сообщение', '2022-04-21 09:15:53', '2022-05-14 06:19:46'),
(5, 3, 'это сообщение от Дмитрия..', '2022-04-21 09:23:27', '2022-05-14 06:19:46'),
(54, 11, 'asdasdas', '2022-05-14 04:19:56', '2022-05-14 04:19:56');

-- --------------------------------------------------------

--
-- Структура таблицы `users`
--

CREATE TABLE `users` (
  `id` int NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `gender` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

--
-- Дамп данных таблицы `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `password`, `created_at`, `updated_at`, `gender`) VALUES
(1, 'Pavel', '11pasha@mail.ru', '466bb5bb2d78aec1fc8ef2f2d45793cc77d7670f', '2022-04-20 13:54:01', '2022-05-14 05:01:41', '1'),
(2, 'Petro', 'Petro@mail.ru', '466bb5bb2d78aec1fc8ef2f2d45793cc77d7670f', '2022-04-20 13:54:54', '2022-05-14 05:01:41', '1'),
(3, 'Dmitry', 'Dmitry@gmail.com', '466bb5bb2d78aec1fc8ef2f2d45793cc77d7670f', '2022-04-21 11:22:54', '2022-05-14 05:01:41', '1'),
(4, 'Nikolaus', '11pasha@mail.ru', '466bb5bb2d78aec1fc8ef2f2d45793cc77d7670f', '2022-04-22 04:40:50', '2022-05-14 05:01:41', '1'),
(11, 'SkyNet', 'SkyNet@mail.ru', '466bb5bb2d78aec1fc8ef2f2d45793cc77d7670f', '2022-05-14 03:09:54', '2022-05-14 03:09:55', '1'),
(12, 'Prometey', 'Prometey@mail.ru', '466bb5bb2d78aec1fc8ef2f2d45793cc77d7670f', '2022-05-14 04:54:29', '2022-05-14 04:54:29', '1'),
(20, 'Ikarus', 'Ikarus@mail.ru', '466bb5bb2d78aec1fc8ef2f2d45793cc77d7670f', '2022-05-14 05:34:06', '2022-05-14 05:34:06', '1');

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
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=58;

--
-- AUTO_INCREMENT для таблицы `users`
--
ALTER TABLE `users`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
