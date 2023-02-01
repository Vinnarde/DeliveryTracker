-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Хост: 127.0.0.1:3306
-- Время создания: Фев 01 2023 г., 17:43
-- Версия сервера: 8.0.30
-- Версия PHP: 8.1.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- База данных: `DeliveryTracker`
--

-- --------------------------------------------------------

--
-- Структура таблицы `address`
--

CREATE TABLE `address` (
  `addressId` int NOT NULL,
  `country` varchar(64) NOT NULL,
  `state` varchar(64) NOT NULL,
  `city` varchar(64) NOT NULL,
  `street` varchar(128) NOT NULL,
  `postalCode` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

--
-- Дамп данных таблицы `address`
--

INSERT INTO `address` (`addressId`, `country`, `state`, `city`, `street`, `postalCode`) VALUES
(1, 'US', 'AK', 'ANCHORAGE', '', 99502),
(2, 'US', 'AK', 'ANCHORAGE', '', 99502),
(3, 'US', 'AK', 'ANCHORAGE', '', 99502),
(4, 'US', 'AK', 'ANCHORAGE', '', 99502),
(5, 'US', 'AK', 'ANCHORAGE', '', 99502),
(6, 'US', 'AK', 'ANCHORAGE', '', 99502),
(7, 'US', 'AK', 'ANCHORAGE', '', 99502),
(8, 'US', 'AK', 'ANCHORAGE', '', 99502),
(9, 'US', 'AK', 'ANCHORAGE', '', 99502),
(10, 'US', 'AK', 'ANCHORAGE', '', 99502),
(11, 'US', 'AK', 'ANCHORAGE', '', 99502),
(12, 'US', 'AK', 'ANCHORAGE', '', 99502),
(13, 'US', 'AK', 'ANCHORAGE', '', 99502),
(14, 'US', 'AK', 'ANCHORAGE', '', 99502),
(15, 'US', 'AK', 'ANCHORAGE', '', 99502);

-- --------------------------------------------------------

--
-- Структура таблицы `trackInfo`
--

CREATE TABLE `trackInfo` (
  `trackNumber` varchar(32) NOT NULL,
  `dateRegistered` timestamp NOT NULL,
  `status` varchar(32) NOT NULL,
  `addressId` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

--
-- Дамп данных таблицы `trackInfo`
--

INSERT INTO `trackInfo` (`trackNumber`, `dateRegistered`, `status`, `addressId`) VALUES
('RR000000001CN', '2023-01-31 06:22:00', 'DeliveryFailure', 15),
('RR121234567891CN', '2022-05-23 14:22:00', 'InTransit', 13),
('RR12314567891CN', '2022-05-23 14:22:00', 'InTransit', 11),
('RR123156189CN', '2022-05-23 14:22:00', 'InTransit', 4),
('RR12324567891CN', '2022-05-23 14:22:00', 'InTransit', 10),
('RR123451267891CN', '2022-05-23 14:22:00', 'InTransit', 12),
('RR123456189CN', '2022-05-23 14:22:00', 'InTransit', 3),
('RR123456780CN', '2022-05-23 14:22:00', 'Delivered', 2),
('RR12345678191CN', '2022-05-23 14:22:00', 'InTransit', 9),
('RR12345678291CN', '2022-05-23 14:22:00', 'InTransit', 7),
('RR1234567890CN', '2022-05-23 14:22:00', 'DeliveryFailure', 5),
('RR12345678913CN', '2022-05-23 14:22:00', 'InTransit', 8),
('RR1234567891CN', '2022-05-23 14:22:00', 'InTransit', 6),
('RR123456789CN', '2022-05-23 14:22:00', 'InTransit', 1),
('RR987654321CN', '2022-05-23 14:22:00', 'Delivered', 14);

-- --------------------------------------------------------

--
-- Структура таблицы `trackingHistory`
--

CREATE TABLE `trackingHistory` (
  `trackingId` int NOT NULL,
  `trackNumber` varchar(32) NOT NULL,
  `status` varchar(32) NOT NULL,
  `description` varchar(128) NOT NULL,
  `dateUpdated` timestamp NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

--
-- Дамп данных таблицы `trackingHistory`
--

INSERT INTO `trackingHistory` (`trackingId`, `trackNumber`, `status`, `description`, `dateUpdated`) VALUES
(1, 'RR123456789CN', 'InTransit', '', '2022-05-23 14:22:00'),
(2, 'RR123456789CN', 'Delivered', '', '2022-05-23 14:23:00'),
(3, 'RR123456780CN', 'InTransit', '', '2022-05-23 14:22:00'),
(4, 'RR123456189CN', 'InTransit', '', '2022-05-23 14:22:00'),
(5, 'RR123156189CN', 'InTransit', '', '2022-05-23 14:22:00'),
(6, 'RR123456789CN', 'InTransit', '', '2022-05-23 14:22:00'),
(7, 'RR123456789CN', 'InTransit', '', '2022-05-23 14:22:00'),
(8, 'RR1234567890CN', 'InTransit', 'The plane entered the port', '2022-05-23 14:22:00'),
(9, 'RR123456789CN', 'Delivered', '', '2022-05-23 14:22:00'),
(10, 'RR123456789CN', 'Delivered', '', '2022-05-23 14:22:00'),
(11, 'RR123456789CN', 'Delivered', '', '2022-05-23 14:22:00'),
(12, 'RR123456789CN', 'InTransit', '', '2022-05-23 14:22:00'),
(13, 'RR123456789CN', 'DeliveryFailure', '', '2022-05-23 14:22:00'),
(14, 'RR123456789CN', 'DeliveryFailure', 'The plane entered the port', '2022-05-23 14:22:00'),
(15, 'RR123456789CN', 'DeliveryFailure', 'The plane entered the port', '2022-05-23 14:22:00'),
(16, 'RR123456789CN', 'AvailableForPickup', 'The plane entered the port', '2022-05-23 14:22:00'),
(17, 'RR1234567890CN', 'Delivered', 'The plane entered the port', '2022-05-23 14:22:00'),
(18, 'RR1234567890CN', 'DeliveryFailure', 'The plane entered the port', '2022-05-23 14:22:00'),
(19, 'RR123456780CN', 'Delivered', 'The plane entered the port', '2022-05-23 14:22:00'),
(20, 'RR123456789CN', 'InTransit', 'The plane entered the port', '2022-05-23 14:22:00'),
(21, 'RR123456789CN', 'InTransit', 'The plane entered the port', '2022-05-23 14:22:00'),
(22, 'RR123456789CN', 'InTransit', 'The plane entered the port', '2022-05-23 14:22:00'),
(23, 'RR123456789CN', 'InTransit', 'The plane entered the port', '2022-05-23 14:22:00'),
(24, 'RR123456789CN', 'InTransit', 'The plane entered the port', '2022-05-23 14:22:00'),
(25, 'RR123456789CN', 'InTransit', 'The plane entered the port', '2022-05-23 14:22:00'),
(26, 'RR1234567891CN', 'InTransit', 'The plane entered the port', '2022-05-23 14:22:00'),
(27, 'RR12345678291CN', 'InTransit', 'The plane entered the port', '2022-05-23 14:22:00'),
(28, 'RR12345678913CN', 'InTransit', 'The plane entered the port', '2022-05-23 14:22:00'),
(29, 'RR12345678191CN', 'InTransit', 'The plane entered the port', '2022-05-23 14:22:00'),
(30, 'RR12324567891CN', 'InTransit', 'The plane entered the port', '2022-05-23 14:22:00'),
(31, 'RR12314567891CN', 'InTransit', 'The plane entered the port', '2022-05-23 14:22:00'),
(32, 'RR123451267891CN', 'InTransit', 'The plane entered the port', '2022-05-23 14:22:00'),
(33, 'RR121234567891CN', 'InTransit', 'The plane entered the port', '2022-05-23 14:22:00'),
(34, 'RR123456789CN', 'InTransit', 'The plane entered the port', '2022-05-23 14:22:00'),
(35, 'RR987654321CN', 'InTransit', 'The plane entered the port', '2022-05-23 14:22:00'),
(36, 'RR987654321CN', 'InTransit', 'The plane entered the port', '2022-05-24 15:22:00'),
(37, 'RR987654321CN', 'AvailableForPickup', 'The plane entered the port', '2022-05-25 15:22:00'),
(38, 'RR987654321CN', 'Delivered', 'The plane entered the port', '2022-05-26 15:22:00'),
(39, 'RR000000001CN', 'InTransit', 'The plane entered the port', '2023-01-31 06:22:00'),
(40, 'RR000000001CN', 'InTransit', 'The plane entered the port', '2023-01-31 06:22:00'),
(41, 'RR000000001CN', 'AvailableForPickup', 'The package has been delivered to the local post office', '2023-01-31 07:22:00'),
(42, 'RR000000001CN', 'DeliveryFailure', 'The package was seriously damaged', '2023-01-31 10:22:00');

-- --------------------------------------------------------

--
-- Структура таблицы `users`
--

CREATE TABLE `users` (
  `userId` int NOT NULL,
  `login` varchar(128) NOT NULL,
  `password` varchar(256) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

--
-- Дамп данных таблицы `users`
--

INSERT INTO `users` (`userId`, `login`, `password`) VALUES
(1, 'admin', '$2y$10$IRMV7IMYt.lAMRMOrxf8U.DrjTFTxZNqLh5PF3yPfgkjXgWX6.KcG'),
(2, 'admin', '$2y$10$IRMV7IMYt.lAMRMOrxf8U.DrjTFTxZNqLh5PF3yPfgkjXgWX6.KcG');

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `address`
--
ALTER TABLE `address`
  ADD PRIMARY KEY (`addressId`);

--
-- Индексы таблицы `trackInfo`
--
ALTER TABLE `trackInfo`
  ADD PRIMARY KEY (`trackNumber`(20)),
  ADD KEY `trackNumber` (`trackNumber`),
  ADD KEY `addressId` (`addressId`);

--
-- Индексы таблицы `trackingHistory`
--
ALTER TABLE `trackingHistory`
  ADD PRIMARY KEY (`trackingId`),
  ADD KEY `trackNumber` (`trackNumber`);

--
-- Индексы таблицы `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`userId`);

--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `address`
--
ALTER TABLE `address`
  MODIFY `addressId` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT для таблицы `trackingHistory`
--
ALTER TABLE `trackingHistory`
  MODIFY `trackingId` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=43;

--
-- AUTO_INCREMENT для таблицы `users`
--
ALTER TABLE `users`
  MODIFY `userId` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Ограничения внешнего ключа сохраненных таблиц
--

--
-- Ограничения внешнего ключа таблицы `trackInfo`
--
ALTER TABLE `trackInfo`
  ADD CONSTRAINT `trackinfo_ibfk_2` FOREIGN KEY (`addressId`) REFERENCES `address` (`addressId`) ON DELETE RESTRICT ON UPDATE RESTRICT;

--
-- Ограничения внешнего ключа таблицы `trackingHistory`
--
ALTER TABLE `trackingHistory`
  ADD CONSTRAINT `trackinghistory_ibfk_1` FOREIGN KEY (`trackNumber`) REFERENCES `trackInfo` (`trackNumber`) ON DELETE RESTRICT ON UPDATE RESTRICT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
