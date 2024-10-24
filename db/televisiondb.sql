-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 24-10-2024 a las 15:22:01
-- Versión del servidor: 10.4.32-MariaDB
-- Versión de PHP: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `televisiondb`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `orders`
--

CREATE TABLE `orders` (
  `id` int(11) NOT NULL,
  `UserId` int(11) NOT NULL,
  `Completed` tinyint(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `products`
--

CREATE TABLE `products` (
  `id` int(11) NOT NULL,
  `name` text NOT NULL,
  `description` text NOT NULL,
  `images` text NOT NULL,
  `resolution` text DEFAULT NULL,
  `launched` text DEFAULT NULL,
  `stock` int(11) DEFAULT NULL,
  `price` decimal(11,0) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `products`
--

INSERT INTO `products` (`id`, `name`, `description`, `images`, `resolution`, `launched`, `stock`, `price`) VALUES
(1, 'Samsung Series 8 TV UE50CU8580UXZT Crystal UHD 4K', 'Dynamic Crystal Color\r\nTrue-to-life, crystal-clear colours\r\nImmerse yourself in images with a billion colors. Dynamic Crystal Color technology offers absolute realism, so you won\'t miss even the slightest subtlety.\r\n\r\nAirslim\r\nSleek, slim design\r\nThe slim and striking design of the TV harmonizes perfectly with its surroundings.', 'https://static1.unieuro.it/medias/sys_master/root/h0c/h6c/45308974006302/-api-rest-00ed29448a7522f610cac04d7b9ea7e0-assets-b7e35b7b39f920d752ec7f440afc873d-preview-sgmConversionBaseFormat-sgmProductFormat.jpg', '4k', '12-02-2019', 25, 530),
(2, 'Samsung Series 8 TV UE50CU8580UXZT Crystal UHD 4K', 'Dynamic Crystal Color\r\nTrue-to-life, crystal-clear colours\r\nImmerse yourself in images with a billion colors. Dynamic Crystal Color technology offers absolute realism, so you won\'t miss even the slightest subtlety.\r\n\r\nAirslim\r\nSleek, slim design\r\nThe slim and striking design of the TV harmonizes perfectly with its surroundings.', 'https://static1.unieuro.it/medias/sys_master/root/h0c/h6c/45308974006302/-api-rest-00ed29448a7522f610cac04d7b9ea7e0-assets-b7e35b7b39f920d752ec7f440afc873d-preview-sgmConversionBaseFormat-sgmProductFormat.jpg', '4k', '12-02-2019', 25, 530),
(3, 'Samsung Series 8 TV UE50CU8580UXZT Crystal UHD 4K', 'Dynamic Crystal Color\r\nTrue-to-life, crystal-clear colours\r\nImmerse yourself in images with a billion colors. Dynamic Crystal Color technology offers absolute realism, so you won\'t miss even the slightest subtlety.\r\n\r\nAirslim\r\nSleek, slim design\r\nThe slim and striking design of the TV harmonizes perfectly with its surroundings.', 'https://static1.unieuro.it/medias/sys_master/root/h0c/h6c/45308974006302/-api-rest-00ed29448a7522f610cac04d7b9ea7e0-assets-b7e35b7b39f920d752ec7f440afc873d-preview-sgmConversionBaseFormat-sgmProductFormat.jpg', '4k', '12-02-2019', 25, 530),
(4, 'Samsung Series 8 TV UE50CU8580UXZT Crystal UHD 4K', 'Dynamic Crystal Color\r\nTrue-to-life, crystal-clear colours\r\nImmerse yourself in images with a billion colors. Dynamic Crystal Color technology offers absolute realism, so you won\'t miss even the slightest subtlety.\r\n\r\nAirslim\r\nSleek, slim design\r\nThe slim and striking design of the TV harmonizes perfectly with its surroundings.', 'https://static1.unieuro.it/medias/sys_master/root/h0c/h6c/45308974006302/-api-rest-00ed29448a7522f610cac04d7b9ea7e0-assets-b7e35b7b39f920d752ec7f440afc873d-preview-sgmConversionBaseFormat-sgmProductFormat.jpg', '4k', '12-02-2019', 25, 530),
(5, 'Samsung Series 8 TV UE50CU8580UXZT Crystal UHD 4K', 'Dynamic Crystal Color\r\nTrue-to-life, crystal-clear colours\r\nImmerse yourself in images with a billion colors. Dynamic Crystal Color technology offers absolute realism, so you won\'t miss even the slightest subtlety.\r\n\r\nAirslim\r\nSleek, slim design\r\nThe slim and striking design of the TV harmonizes perfectly with its surroundings.', 'https://static1.unieuro.it/medias/sys_master/root/h0c/h6c/45308974006302/-api-rest-00ed29448a7522f610cac04d7b9ea7e0-assets-b7e35b7b39f920d752ec7f440afc873d-preview-sgmConversionBaseFormat-sgmProductFormat.jpg', '4k', '12-02-2019', 25, 530),
(6, 'Samsung Series 8 TV UE50CU8580UXZT Crystal UHD 4K', 'Dynamic Crystal Color\r\nTrue-to-life, crystal-clear colours\r\nImmerse yourself in images with a billion colors. Dynamic Crystal Color technology offers absolute realism, so you won\'t miss even the slightest subtlety.\r\n\r\nAirslim\r\nSleek, slim design\r\nThe slim and striking design of the TV harmonizes perfectly with its surroundings.', 'https://static1.unieuro.it/medias/sys_master/root/h0c/h6c/45308974006302/-api-rest-00ed29448a7522f610cac04d7b9ea7e0-assets-b7e35b7b39f920d752ec7f440afc873d-preview-sgmConversionBaseFormat-sgmProductFormat.jpg', '4k', '12-02-2019', 25, 530);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `firstname` text NOT NULL,
  `lastname` text NOT NULL,
  `email` text NOT NULL,
  `password` text NOT NULL,
  `remember_token` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `users`
--

INSERT INTO `users` (`id`, `firstname`, `lastname`, `email`, `password`, `remember_token`) VALUES
(5, 'Nestor', 'Salom', 'trabajo.nestor.098@gmail.com', '$2y$10$l68l11FwlGFMI.kxkw4N/ewmittb.rBv0rMRKIACqMl/S.5N7lEPu', NULL);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `orders`
--
ALTER TABLE `orders`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `products`
--
ALTER TABLE `products`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT de la tabla `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
