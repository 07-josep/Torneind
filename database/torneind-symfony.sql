-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 18-02-2022 a las 23:40:40
-- Versión del servidor: 10.4.22-MariaDB
-- Versión de PHP: 7.4.27

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `torneind-symfony`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `doctrine_migration_versions`
--

CREATE TABLE `doctrine_migration_versions` (
  `version` varchar(191) COLLATE utf8_unicode_ci NOT NULL,
  `executed_at` datetime DEFAULT NULL,
  `execution_time` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `doctrine_migration_versions`
--

INSERT INTO `doctrine_migration_versions` (`version`, `executed_at`, `execution_time`) VALUES
('DoctrineMigrations\\Version20220205204752', '2022-02-18 14:05:40', 290),
('DoctrineMigrations\\Version20220215104742', '2022-02-18 14:05:40', 0),
('DoctrineMigrations\\Version20220215105021', '2022-02-18 14:05:40', 21),
('DoctrineMigrations\\Version20220216102147', '2022-02-18 14:05:40', 77),
('DoctrineMigrations\\Version20220217184922', '2022-02-18 14:05:41', 6),
('DoctrineMigrations\\Version20220218103442', '2022-02-18 14:05:41', 67);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `inscripcion`
--

CREATE TABLE `inscripcion` (
  `id` int(11) NOT NULL,
  `usuario_id` int(11) NOT NULL,
  `torneo_id` int(11) NOT NULL,
  `tagname` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `inscripcion`
--

INSERT INTO `inscripcion` (`id`, `usuario_id`, `torneo_id`, `tagname`) VALUES
(2, 1, 8, 'HJosepo'),
(4, 1, 8, 'ALEX'),
(8, 1, 10, 'HJosepo'),
(9, 1, 9, 'ALEX'),
(10, 1, 8, 'Equipo alpha');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `mensaje`
--

CREATE TABLE `mensaje` (
  `id` int(11) NOT NULL,
  `mensaje` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `enviado_id` int(11) NOT NULL,
  `recibidos_id` int(11) NOT NULL,
  `fecha` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `mensaje`
--

INSERT INTO `mensaje` (`id`, `mensaje`, `enviado_id`, `recibidos_id`, `fecha`) VALUES
(1, 'Mensaje de prueba 2', 1, 1, '2022-02-18 15:40:19'),
(2, 'Mensaje de prueba 2', 1, 1, '2022-02-18 20:10:32');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `modalidad`
--

CREATE TABLE `modalidad` (
  `id` int(11) NOT NULL,
  `modalidad` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `modalidad`
--

INSERT INTO `modalidad` (`id`, `modalidad`) VALUES
(1, 'Solitario'),
(2, 'Duos'),
(3, 'Trios'),
(4, 'Escuadrones'),
(5, 'MTL');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `opinion`
--

CREATE TABLE `opinion` (
  `id` int(11) NOT NULL,
  `texto` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `fecha` date NOT NULL,
  `torneo_id` int(11) NOT NULL,
  `usuario_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `plataforma`
--

CREATE TABLE `plataforma` (
  `id` int(11) NOT NULL,
  `plataforma` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `plataforma`
--

INSERT INTO `plataforma` (`id`, `plataforma`) VALUES
(1, 'PS4/PS5'),
(2, 'XBOX'),
(3, 'PC'),
(4, 'Nintendo Switch'),
(5, 'Android'),
(6, 'todas');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `torneo`
--

CREATE TABLE `torneo` (
  `id` int(11) NOT NULL,
  `usuario_id` int(11) NOT NULL,
  `modalidad_id` int(11) NOT NULL,
  `plataforma_id` int(11) NOT NULL,
  `nombre` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `descripcion` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `imagen` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `fecha` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `torneo`
--

INSERT INTO `torneo` (`id`, `usuario_id`, `modalidad_id`, `plataforma_id`, `nombre`, `descripcion`, `imagen`, `fecha`) VALUES
(1, 1, 4, 6, 'Hic Dolores Consequatur', 'Quia asperiores vel ut. Blanditiis consequatur sint vel mollitia. Dolore numquam commodi architecto est.', 'bc4aefd6-43a6-3f8d-976b-d8d0d60b63e1.jpg', '2022-02-22 22:07:51'),
(2, 1, 2, 4, 'Ad Deserunt Et', 'Eaque facilis alias fuga deserunt magni quisquam praesentium. Dolor adipisci atque amet. Architecto non rerum aut facilis inventore dolores natus.', '9da6ce0e-d0ba-3cfd-a6dc-753ace8e981b.jpg', '2022-02-15 15:47:53'),
(3, 1, 4, 1, 'Assumenda Cupiditate Consequatur', 'Est repudiandae vero qui nisi ut officia rerum. Quaerat optio ipsum aliquam. Rerum deleniti omnis modi placeat iure odit culpa sed. Nisi molestias voluptatem voluptatem quisquam ut quas enim.', 'f988742b-3a5d-35e6-a43a-d706ab9f41bd.jpg', '2022-02-18 01:19:43'),
(4, 1, 2, 4, 'Est Ut Cum', 'Libero veritatis asperiores ipsum nostrum. Beatae debitis est recusandae aut optio optio dolore ullam. Magni unde quo sint consectetur ipsam a animi. Magni ea velit iusto qui.', 'a5bb3403-8f1e-3876-b5ab-750f850eb49e.jpg', '2022-02-19 04:16:44'),
(6, 1, 5, 4, 'Repellendus Qui Tenetur', 'Ut voluptate labore libero quod temporibus. Excepturi aut tempore et sed sint. Non tenetur voluptates suscipit dolorum dolore. Eius ipsum sunt blanditiis officia.', '65bfabbe-f52f-3b24-843e-fbb3e378f210.png', '2022-02-14 08:33:07'),
(7, 1, 2, 3, 'Consectetur Fugit Aliquid', 'Voluptatem id doloribus ullam aut optio. Non eaque illo explicabo qui. Quos accusamus architecto aut qui magnam magni saepe. Quo enim voluptatem explicabo reiciendis reprehenderit facilis molestias.', '12529dc8-fe32-3b84-b1de-6c4282c95bf4.jpg', '2022-02-15 04:33:19'),
(8, 1, 1, 4, 'Reprehenderit Rerum Molestiae', 'Suscipit dignissimos minus sapiente nobis minima dolor. Odio quia consequatur aut adipisci. Ipsa distinctio quisquam doloremque iusto. Nihil hic fugit qui architecto.', 'b8b7d934-e2f7-3517-be47-1fae35e4f153.jpg', '2022-03-03 22:15:20'),
(9, 1, 2, 4, 'Autem Incidunt Eos', 'Aspernatur et itaque aut quam eos tenetur. Nihil assumenda magni commodi quaerat. Quia ratione molestiae minima cumque dolores aspernatur accusamus.', 'f9a0308b-326a-3fca-99ce-f8082db96091.jpg', '2022-02-24 00:25:36'),
(10, 1, 5, 2, 'Iste Et Aliquam', 'Qui fuga aut ex eum dolorum molestiae. Et sit unde voluptatibus molestiae error aut explicabo. Consectetur necessitatibus ullam sunt voluptatem atque nisi ab commodi.', 'a58e6509-954c-39cf-bdf3-7bc2da3fad70.jpg', '2022-02-16 13:24:07');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuario`
--

CREATE TABLE `usuario` (
  `id` int(11) NOT NULL,
  `nombre` varchar(30) COLLATE utf8mb4_unicode_ci NOT NULL,
  `correo` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `contrasenya` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `foto` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `role` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `usuario`
--

INSERT INTO `usuario` (`id`, `nombre`, `correo`, `contrasenya`, `foto`, `role`) VALUES
(1, 'admin', 'admin@gmail.com', '$2y$13$U4og1XXGQ/YnLtkixaqqP.V16SDUErBpuOhGvy8FZp/FJAVprodHC', 'icon-620fb2dc9cb4e214379275.png', 'ROLE_ADMIN');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `doctrine_migration_versions`
--
ALTER TABLE `doctrine_migration_versions`
  ADD PRIMARY KEY (`version`);

--
-- Indices de la tabla `inscripcion`
--
ALTER TABLE `inscripcion`
  ADD PRIMARY KEY (`id`),
  ADD KEY `IDX_935E99F0DB38439E` (`usuario_id`),
  ADD KEY `IDX_935E99F0A0139802` (`torneo_id`);

--
-- Indices de la tabla `mensaje`
--
ALTER TABLE `mensaje`
  ADD PRIMARY KEY (`id`),
  ADD KEY `IDX_9B631D0161AB9A50` (`enviado_id`),
  ADD KEY `IDX_9B631D01BC5A7B82` (`recibidos_id`);

--
-- Indices de la tabla `modalidad`
--
ALTER TABLE `modalidad`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `opinion`
--
ALTER TABLE `opinion`
  ADD PRIMARY KEY (`id`),
  ADD KEY `IDX_AB02B027A0139802` (`torneo_id`),
  ADD KEY `IDX_AB02B027DB38439E` (`usuario_id`);

--
-- Indices de la tabla `plataforma`
--
ALTER TABLE `plataforma`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `torneo`
--
ALTER TABLE `torneo`
  ADD PRIMARY KEY (`id`),
  ADD KEY `IDX_7CEB63FEDB38439E` (`usuario_id`),
  ADD KEY `IDX_7CEB63FE1E092B9F` (`modalidad_id`),
  ADD KEY `IDX_7CEB63FEEB90E430` (`plataforma_id`);

--
-- Indices de la tabla `usuario`
--
ALTER TABLE `usuario`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `inscripcion`
--
ALTER TABLE `inscripcion`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT de la tabla `mensaje`
--
ALTER TABLE `mensaje`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `modalidad`
--
ALTER TABLE `modalidad`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de la tabla `opinion`
--
ALTER TABLE `opinion`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `plataforma`
--
ALTER TABLE `plataforma`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT de la tabla `torneo`
--
ALTER TABLE `torneo`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT de la tabla `usuario`
--
ALTER TABLE `usuario`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `inscripcion`
--
ALTER TABLE `inscripcion`
  ADD CONSTRAINT `FK_935E99F0A0139802` FOREIGN KEY (`torneo_id`) REFERENCES `torneo` (`id`),
  ADD CONSTRAINT `FK_935E99F0DB38439E` FOREIGN KEY (`usuario_id`) REFERENCES `usuario` (`id`);

--
-- Filtros para la tabla `mensaje`
--
ALTER TABLE `mensaje`
  ADD CONSTRAINT `FK_9B631D0161AB9A50` FOREIGN KEY (`enviado_id`) REFERENCES `usuario` (`id`),
  ADD CONSTRAINT `FK_9B631D01BC5A7B82` FOREIGN KEY (`recibidos_id`) REFERENCES `usuario` (`id`);

--
-- Filtros para la tabla `opinion`
--
ALTER TABLE `opinion`
  ADD CONSTRAINT `FK_AB02B027A0139802` FOREIGN KEY (`torneo_id`) REFERENCES `torneo` (`id`),
  ADD CONSTRAINT `FK_AB02B027DB38439E` FOREIGN KEY (`usuario_id`) REFERENCES `usuario` (`id`);

--
-- Filtros para la tabla `torneo`
--
ALTER TABLE `torneo`
  ADD CONSTRAINT `FK_7CEB63FE1E092B9F` FOREIGN KEY (`modalidad_id`) REFERENCES `modalidad` (`id`),
  ADD CONSTRAINT `FK_7CEB63FEDB38439E` FOREIGN KEY (`usuario_id`) REFERENCES `usuario` (`id`),
  ADD CONSTRAINT `FK_7CEB63FEEB90E430` FOREIGN KEY (`plataforma_id`) REFERENCES `plataforma` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
