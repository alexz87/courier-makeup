-- phpMyAdmin SQL Dump
-- version 4.9.3
-- https://www.phpmyadmin.net/
--
-- Хост: localhost:8889
-- Час створення: Чрв 03 2022 р., 13:57
-- Версія сервера: 5.7.26
-- Версія PHP: 7.4.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";

--
-- База даних: `Nasty`
--

-- --------------------------------------------------------

--
-- Структура таблиці `courier_makeup`
--

CREATE TABLE `courier_makeup` (
  `id` int(11) UNSIGNED NOT NULL,
  `login` varchar(32) NOT NULL,
  `pass` varchar(256) NOT NULL,
  `photo` varchar(32) NOT NULL,
  `tip` int(11) UNSIGNED NOT NULL,
  `spentTips` int(11) UNSIGNED NOT NULL,
  `myCash` int(11) UNSIGNED NOT NULL,
  `salary` int(11) UNSIGNED NOT NULL,
  `date` varchar(11) NOT NULL,
  `mounth` varchar(11) NOT NULL,
  `day` varchar(11) NOT NULL,
  `fullOrders` int(11) UNSIGNED NOT NULL,
  `allOrders` int(11) UNSIGNED NOT NULL,
  `allWeekendOrders` int(11) UNSIGNED NOT NULL,
  `orders` int(11) UNSIGNED NOT NULL,
  `newPost` int(11) UNSIGNED NOT NULL,
  `weekendOrders` int(11) UNSIGNED NOT NULL,
  `weekendNewPost` int(11) UNSIGNED NOT NULL,
  `reports` text NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Дамп даних таблиці `courier_makeup`
--

INSERT INTO `courier_makeup` (`id`, `login`, `pass`, `photo`, `tip`, `spentTips`, `myCash`, `salary`, `date`, `mounth`, `day`, `fullOrders`, `allOrders`, `allWeekendOrders`, `orders`, `newPost`, `weekendOrders`, `weekendNewPost`, `reports`) VALUES
(1, 'admin', '$2y$10$NzxrXId8p1mxwuhdecdF8efyY0krQpatn7ZP4YT9DQRuxidk8sCri', 'IMG_1.jpg', 5, 179, 5, 1010, '02.06.2022', '06', '31', 44, 44, 0, 41, 3, 0, 0, 'PGRpdiBjbGFzcz0icmVwb3J0IGJnLXdhcm5pbmciPgoJCQkJCQkJCTxoMj7QotGA0LDQstC10L3RjCAyMDIyINGA0L7QutGDPC9oMj4KCQkJCQkJCQk8aDM+0JfQsNCz0LDQu9GM0L3QviDQt9Cw0LzQvtCy0LvQtdC90Yw6IDg0NCDRiNGCLjwvaDM+CgkJCQkJCQkJPGI+0JHRg9C00LXQvdC90ZYg0LfQsNC80L7QstC70LXQvdC90Y86PC9iPiA4MjEg0YjRgi48YnI+CgkJCQkJCQkJPGI+0J3QvtCy0LAg0J/QvtGI0YLQsDo8L2I+IDIzINGI0YIuPGJyPgoJCQkJCQkJCTxiPtCS0LjRhdGW0LTQvdGWINC30LDQvNC+0LLQu9C10L3QvdGPOjwvYj4gMCDRiNGCLjxicj4KCQkJCQkJCQk8Yj7QndC+0LLQsCDQn9C+0YjRgtCwINGDINCy0LjRhdGW0LTQvdGWOjwvYj4gMCDRiNGCLjxicj4KCQkJCQkJCQk8aDM+0JfQsNGA0L7QsdGW0YLQvdCwINC/0LvQsNGC0LA6IDE5MzcwIFVBSDwvaDM+CgkJCQkJCQk8L2Rpdj4=');

--
-- Індекси збережених таблиць
--

--
-- Індекси таблиці `courier_makeup`
--
ALTER TABLE `courier_makeup`
  ADD UNIQUE KEY `id` (`id`);

--
-- AUTO_INCREMENT для збережених таблиць
--

--
-- AUTO_INCREMENT для таблиці `courier_makeup`
--
ALTER TABLE `courier_makeup`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
