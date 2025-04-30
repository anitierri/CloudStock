-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 23-11-2024 a las 12:17:57
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
-- Base de datos: `appweb_cs_inventario`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `categoria`
--

CREATE TABLE `categoria` (
  `id_categoria` int(11) NOT NULL,
  `nombre_categoria` varchar(50) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `categoria`
--

INSERT INTO `categoria` (`id_categoria`, `nombre_categoria`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'Cocina', '2024-11-02 07:42:40', '2024-11-08 08:12:57', NULL),
(2, 'Pequeños Electrodomésticos', '2024-11-08 08:14:49', '2024-11-08 08:14:49', NULL),
(3, 'Limpieza y Lavandería', '2024-11-08 08:15:04', '2024-11-08 08:15:04', NULL),
(4, 'Climatización', '2024-11-08 08:15:18', '2024-11-08 08:15:18', NULL),
(5, 'Belleza y Cuidado Personal', '2024-11-08 08:15:31', '2024-11-08 08:15:31', NULL),
(6, 'Salud', '2024-11-08 08:15:43', '2024-11-08 08:15:43', NULL),
(7, 'Computación', '2024-11-08 08:15:53', '2024-11-08 08:15:53', NULL),
(8, 'TV', '2024-11-08 08:16:03', '2024-11-08 08:16:03', NULL),
(9, 'Audio', '2024-11-08 08:16:14', '2024-11-08 08:16:14', NULL),
(10, 'Dispositivos Móviles', '2024-11-08 08:16:25', '2024-11-08 08:16:25', NULL),
(11, 'Entretenimiento', '2024-11-08 08:16:35', '2024-11-08 08:16:35', NULL),
(12, 'Fotografía', '2024-11-08 08:16:47', '2024-11-08 08:16:47', NULL),
(13, 'Juguetes', '2024-11-08 08:16:56', '2024-11-08 08:16:56', NULL),
(14, 'Smart Home', '2024-11-08 08:17:07', '2024-11-08 08:17:07', NULL),
(15, 'Jardín y Exteriores', '2024-11-08 08:17:19', '2024-11-08 08:17:19', NULL),
(16, 'Otros', '2024-11-08 08:17:28', '2024-11-08 08:17:28', NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `movimiento_stock`
--

CREATE TABLE `movimiento_stock` (
  `id_movimiento` int(11) NOT NULL,
  `id_producto` int(11) NOT NULL,
  `nombre_producto` varchar(255) NOT NULL,
  `cantidad` int(11) NOT NULL,
  `tipo_movimiento` enum('entrada','salida') NOT NULL,
  `fecha_movimiento` datetime NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `movimiento_stock`
--

INSERT INTO `movimiento_stock` (`id_movimiento`, `id_producto`, `nombre_producto`, `cantidad`, `tipo_movimiento`, `fecha_movimiento`, `created_at`, `updated_at`, `deleted_at`) VALUES
(74, 17, 'Microondas Liliana 3000', 40, 'entrada', '2024-11-23 12:14:30', '2024-11-23 11:14:30', '2024-11-23 11:15:14', '2024-11-23 11:15:14'),
(75, 17, 'Microondas Liliana 3000', 1, 'salida', '2024-11-23 12:14:49', '2024-11-23 11:14:49', '2024-11-23 11:14:58', '2024-11-23 11:14:58');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `orden_compra`
--

CREATE TABLE `orden_compra` (
  `id_orden` int(11) NOT NULL,
  `id_proveedor` int(11) NOT NULL,
  `id_usuario` int(11) NOT NULL,
  `fecha_orden` datetime NOT NULL,
  `producto` varchar(150) NOT NULL,
  `cantidad` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `orden_compra`
--

INSERT INTO `orden_compra` (`id_orden`, `id_proveedor`, `id_usuario`, `fecha_orden`, `producto`, `cantidad`, `created_at`, `updated_at`, `deleted_at`) VALUES
(16, 6, 4, '2024-11-19 08:09:00', 'mandame un freezer', 13, '2024-11-23 11:09:18', '2024-11-23 11:10:40', '2024-11-23 11:10:40'),
(17, 6, 4, '2024-11-19 08:09:00', 'freezer atma', 13, '2024-11-23 11:10:25', '2024-11-23 11:10:25', NULL),
(18, 4, 4, '2024-11-23 08:11:00', 'notebook dell d-348', 12, '2024-11-23 11:11:11', '2024-11-23 11:11:11', NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `producto`
--

CREATE TABLE `producto` (
  `id_producto` int(11) NOT NULL,
  `id_proveedor` int(11) NOT NULL,
  `id_categoria` int(11) NOT NULL,
  `codigo_producto` varchar(50) NOT NULL,
  `nombre_producto` varchar(50) NOT NULL,
  `cantidad` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `producto`
--

INSERT INTO `producto` (`id_producto`, `id_proveedor`, `id_categoria`, `codigo_producto`, `nombre_producto`, `cantidad`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 1, 1, '34522345', 'Heladera 20 LTS', 0, '2024-11-02 07:43:05', '2024-11-23 10:58:38', NULL),
(3, 4, 9, '345348768', 'Auriculares Over-Head 650BT', 0, '2024-11-02 10:37:10', '2024-11-23 10:58:55', NULL),
(4, 6, 15, '92387458', 'Pileta Estructural Pelopincho', 0, '2024-11-02 10:38:33', '2024-11-23 10:55:41', NULL),
(6, 4, 7, '123456', 'Notebook Acer SM-4673', 0, '2024-11-11 18:14:01', '2024-11-23 10:59:39', NULL),
(15, 1, 10, '092384702', 'Samsung Galaxy A12', 0, '2024-11-23 11:02:22', '2024-11-23 11:02:22', NULL),
(17, 6, 1, '038472345', 'Microondas Liliana 3000', 0, '2024-11-23 11:04:11', '2024-11-23 11:15:14', NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `proveedor`
--

CREATE TABLE `proveedor` (
  `id_proveedor` int(11) NOT NULL,
  `razon_social` varchar(50) NOT NULL,
  `cuit` varchar(20) NOT NULL,
  `direccion` varchar(50) NOT NULL,
  `telefono` varchar(20) DEFAULT NULL,
  `email` varchar(50) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `proveedor`
--

INSERT INTO `proveedor` (`id_proveedor`, `razon_social`, `cuit`, `direccion`, `telefono`, `email`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'Mario El Amigazo', '29387445673', 'B7540, Mitre 1080', '2926 374658', 'marioelmejor@gmail.com', '2024-11-02 04:58:44', '2024-11-23 11:00:45', NULL),
(3, 'Tirrus S.A', '92874598274', 'B8170, Belgrano 58', '121221111', 'tirrussa@hotmail.com', '2024-11-02 05:04:46', '2024-11-23 11:00:45', NULL),
(4, 'PCInsumos', '46352413243', 'B4637, San Martín 3409', '293 2546 3746', 'joaquina1330@gmail.com', '2024-11-02 05:10:54', '2024-11-23 11:00:45', NULL),
(6, 'Diarca', '25364758699', 'B6475, Av. Sarmiento 233', '354 2637 7465', 'anitaaapalaaa3@gmail.com', '2024-11-02 05:13:02', '2024-11-23 07:46:57', NULL),
(35, 'Rodriguez S.A', '34923472844', 'B7346, Echeverría 273', '234498727844', 'anitaaapalaaa3@gmail.com', '2024-11-23 11:12:35', '2024-11-23 11:12:53', NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuario`
--

CREATE TABLE `usuario` (
  `id_usuario` int(11) NOT NULL,
  `nombre` varchar(50) NOT NULL,
  `apellido` varchar(50) NOT NULL,
  `dni` varchar(20) NOT NULL,
  `email` varchar(50) NOT NULL,
  `pass` blob NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `usuario`
--

INSERT INTO `usuario` (`id_usuario`, `nombre`, `apellido`, `dni`, `email`, `pass`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'Joaquina', 'Aguilar', '123', 'jota_aguilar@hotmail.com', 0x6bd0103d6b9549b70813b0ad803fbca7, '2024-10-20 20:54:01', '2024-11-16 12:11:24', NULL),
(2, 'carlos', 'guagua', '3425254', 'anitaaapalaaa3@gmail.com', 0x938e832f73557d73e7f1c08e8f4b2ae3, '2024-10-23 00:20:41', '2024-10-26 16:55:21', NULL),
(4, 'Ana', 'Ristaño', '234', 'danysego7@gmail.com', 0x938e832f73557d73e7f1c08e8f4b2ae3, '2024-10-24 00:14:59', '2024-10-24 00:14:59', NULL);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `categoria`
--
ALTER TABLE `categoria`
  ADD PRIMARY KEY (`id_categoria`),
  ADD UNIQUE KEY `nombre_categoria` (`nombre_categoria`);

--
-- Indices de la tabla `movimiento_stock`
--
ALTER TABLE `movimiento_stock`
  ADD PRIMARY KEY (`id_movimiento`),
  ADD KEY `id_producto` (`id_producto`);

--
-- Indices de la tabla `orden_compra`
--
ALTER TABLE `orden_compra`
  ADD PRIMARY KEY (`id_orden`),
  ADD KEY `id_proveedor` (`id_proveedor`),
  ADD KEY `id_usuario` (`id_usuario`);

--
-- Indices de la tabla `producto`
--
ALTER TABLE `producto`
  ADD PRIMARY KEY (`id_producto`),
  ADD KEY `id_proveedor` (`id_proveedor`),
  ADD KEY `id_categoria` (`id_categoria`);

--
-- Indices de la tabla `proveedor`
--
ALTER TABLE `proveedor`
  ADD PRIMARY KEY (`id_proveedor`),
  ADD UNIQUE KEY `cuit` (`cuit`);

--
-- Indices de la tabla `usuario`
--
ALTER TABLE `usuario`
  ADD PRIMARY KEY (`id_usuario`),
  ADD UNIQUE KEY `dni` (`dni`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `categoria`
--
ALTER TABLE `categoria`
  MODIFY `id_categoria` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT de la tabla `movimiento_stock`
--
ALTER TABLE `movimiento_stock`
  MODIFY `id_movimiento` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=76;

--
-- AUTO_INCREMENT de la tabla `orden_compra`
--
ALTER TABLE `orden_compra`
  MODIFY `id_orden` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT de la tabla `producto`
--
ALTER TABLE `producto`
  MODIFY `id_producto` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT de la tabla `proveedor`
--
ALTER TABLE `proveedor`
  MODIFY `id_proveedor` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=37;

--
-- AUTO_INCREMENT de la tabla `usuario`
--
ALTER TABLE `usuario`
  MODIFY `id_usuario` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `movimiento_stock`
--
ALTER TABLE `movimiento_stock`
  ADD CONSTRAINT `movimiento_stock_ibfk_1` FOREIGN KEY (`id_producto`) REFERENCES `producto` (`id_producto`) ON DELETE CASCADE;

--
-- Filtros para la tabla `orden_compra`
--
ALTER TABLE `orden_compra`
  ADD CONSTRAINT `orden_compra_ibfk_1` FOREIGN KEY (`id_proveedor`) REFERENCES `proveedor` (`id_proveedor`),
  ADD CONSTRAINT `orden_compra_ibfk_2` FOREIGN KEY (`id_usuario`) REFERENCES `usuario` (`id_usuario`);

--
-- Filtros para la tabla `producto`
--
ALTER TABLE `producto`
  ADD CONSTRAINT `producto_ibfk_1` FOREIGN KEY (`id_proveedor`) REFERENCES `proveedor` (`id_proveedor`) ON DELETE CASCADE,
  ADD CONSTRAINT `producto_ibfk_2` FOREIGN KEY (`id_categoria`) REFERENCES `categoria` (`id_categoria`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
