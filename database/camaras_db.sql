-- phpMyAdmin SQL Dump
-- version 4.8.3
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 06-09-2019 a las 04:20:15
-- Versión del servidor: 10.1.36-MariaDB
-- Versión de PHP: 7.2.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `camaras_db`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cameras`
--

CREATE TABLE `cameras` (
  `id` int(11) NOT NULL,
  `type` char(1) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` varchar(30) COLLATE utf8mb4_unicode_ci NOT NULL,
  `image_path` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '1',
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `cameras`
--

INSERT INTO `cameras` (`id`, `type`, `description`, `image_path`, `status`, `created_at`, `updated_at`) VALUES
(1, 'I', 'CÁMARA 1', 'images/cam_int_azul.png', 1, '2019-08-30 02:09:23', '2019-08-30 02:09:23'),
(2, 'I', 'CÁMARA 2', 'images/cam_int_azul.png', 1, '2019-08-30 02:19:26', '2019-08-30 02:19:26'),
(3, 'I', 'CÁMARA 3', 'images/cam_int_azul.png', 1, '2019-08-30 02:19:39', '2019-08-30 02:19:39'),
(4, 'I', 'CÁMARA 4', 'images/cam_int_azul.png', 1, '2019-08-30 02:20:16', '2019-08-30 02:20:16'),
(5, 'I', 'CÁMARA 5', 'images/cam_int_azul.png', 1, '2019-08-30 02:20:24', '2019-08-30 02:20:24'),
(6, 'I', 'CÁMARA 6', 'images/cam_int_azul.png', 1, '2019-08-30 02:20:33', '2019-08-30 02:20:33'),
(7, 'E', 'CÁMARA 1', 'images/cam_ext_azul.png', 1, '2019-08-30 02:43:55', '2019-08-30 02:43:55'),
(8, 'E', 'CÁMARA 2', 'images/cam_ext_azul.png', 1, '2019-08-30 02:45:07', '2019-08-30 02:45:07'),
(9, 'E', 'CÁMARA 3', 'images/cam_ext_azul.png', 1, '2019-08-30 02:53:04', '2019-08-30 02:53:04'),
(10, 'E', 'CÁMARA 4', 'images/cam_ext_azul.png', 1, '2019-08-30 02:53:56', '2019-08-30 02:53:56'),
(11, 'E', 'CÁMARA 5', 'images/cam_ext_azul.png', 1, '2019-08-30 02:55:16', '2019-08-30 02:55:16'),
(12, 'E', 'CÁMARA 6', 'images/cam_ext_azul.png', 1, '2019-08-30 03:10:32', '2019-08-30 03:10:32');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `incidents`
--

CREATE TABLE `incidents` (
  `id` int(11) NOT NULL,
  `camera_id` int(11) NOT NULL,
  `date` date NOT NULL,
  `detail` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `incidents`
--

INSERT INTO `incidents` (`id`, `camera_id`, `date`, `detail`, `created_at`, `updated_at`) VALUES
(1, 2, '2019-09-03', 'camara dejo de grabar', '2019-09-04 01:48:10', '2019-09-04 01:48:10'),
(2, 1, '2019-08-22', 'camara se callo', '2019-09-04 01:56:41', '2019-09-04 01:56:41');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `maintenance`
--

CREATE TABLE `maintenance` (
  `id` int(11) NOT NULL,
  `camera_id` int(11) NOT NULL,
  `date` date NOT NULL,
  `detail` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `applied` tinyint(1) NOT NULL DEFAULT '0',
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `maintenance`
--

INSERT INTO `maintenance` (`id`, `camera_id`, `date`, `detail`, `applied`, `created_at`, `updated_at`) VALUES
(1, 1, '2019-09-03', 'limpiar el lente', 1, '2019-09-04 02:08:04', '2019-09-04 02:51:23'),
(2, 1, '2019-09-05', 'cambiar cable', 0, '2019-09-04 03:39:14', '2019-09-04 03:39:14');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_resets_table', 1),
(3, '2019_09_04_030630_create_notifications_table', 2);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `notifications`
--

CREATE TABLE `notifications` (
  `id` char(36) COLLATE utf8mb4_unicode_ci NOT NULL,
  `type` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `notifiable_type` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `notifiable_id` bigint(20) UNSIGNED NOT NULL,
  `data` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `read_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `notifications`
--

INSERT INTO `notifications` (`id`, `type`, `notifiable_type`, `notifiable_id`, `data`, `read_at`, `created_at`, `updated_at`) VALUES
('1fa9c8af-24d1-45fd-b7e2-b73fd96be14b', 'App\\Notifications\\alertMaintenance', 'App\\User', 1, '{\"camera_id\":\"1\",\"detail\":\"cambio de lente\"}', '2019-09-04 08:25:26', '2019-09-04 08:11:53', '2019-09-04 08:25:26'),
('544c7085-5c56-4c7a-b769-4ebd3a62b743', 'App\\Notifications\\alertMaintenance', 'App\\User', 1, '{\"camera_id\":\"1\",\"detail\":\"cambio de lente\"}', '2019-09-04 08:26:30', '2019-09-04 08:08:29', '2019-09-04 08:26:30'),
('590b72ae-0202-4df8-8727-0a8be5381a6a', 'App\\Notifications\\alertMaintenance', 'App\\User', 1, '{\"camera_id\":\"1\",\"detail\":\"cambio de lente\"}', '2019-09-04 08:31:04', '2019-09-04 08:29:05', '2019-09-04 08:31:04'),
('b2ac3f08-fb4c-40fa-a80f-b5e5212c07b9', 'App\\Notifications\\alertMaintenance', 'App\\User', 1, '{\"camera_id\":\"1\",\"detail\":\"cambio de lente\"}', '2019-09-04 08:23:55', '2019-09-04 08:12:27', '2019-09-04 08:23:55'),
('b9203d6f-9a6c-4966-81e3-2f95a0268ed3', 'App\\Notifications\\alertMaintenance', 'App\\User', 1, '{\"camera_id\":\"1\",\"detail\":\"cambio de lente\"}', '2019-09-04 08:26:25', '2019-09-04 08:10:09', '2019-09-04 08:26:25'),
('b93918ae-4d25-4ced-97ab-7b342bbc3292', 'App\\Notifications\\alertMaintenance', 'App\\User', 1, '{\"camera_id\":\"1\",\"detail\":\"cambio de lente\"}', '2019-09-04 08:25:56', '2019-09-04 08:10:34', '2019-09-04 08:25:56');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'Administrador', 'prueba@prueba.com', NULL, '$2y$10$AVlXozIX.heGWp6S3YZrTOJz7zKsUuMc8N8NZsWjeaZCjn6LWw4Tm', 'CkVgwDe8lcPxiU7oc4m1nuMtB5R66k2rYTC0RSX4OiK7LnVA74jm7ff4jGQQ', '2019-07-05 07:16:32', '2019-07-05 07:16:32');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `cameras`
--
ALTER TABLE `cameras`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `incidents`
--
ALTER TABLE `incidents`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_incdents_cameras` (`camera_id`);

--
-- Indices de la tabla `maintenance`
--
ALTER TABLE `maintenance`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `notifications`
--
ALTER TABLE `notifications`
  ADD PRIMARY KEY (`id`),
  ADD KEY `notifications_notifiable_type_notifiable_id_index` (`notifiable_type`,`notifiable_id`);

--
-- Indices de la tabla `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`);

--
-- Indices de la tabla `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `cameras`
--
ALTER TABLE `cameras`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT de la tabla `incidents`
--
ALTER TABLE `incidents`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `maintenance`
--
ALTER TABLE `maintenance`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
