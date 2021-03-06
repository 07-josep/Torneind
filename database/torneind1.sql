-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 05-06-2022 a las 17:45:45
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
-- Base de datos: `torneind1`
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
('DoctrineMigrations\\Version20220530172759', '2022-05-30 19:28:03', 54),
('DoctrineMigrations\\Version20220530175441', '2022-05-30 19:54:50', 56);

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
(2, 1, 9, 'Josep'),
(3, 1, 8, 'TheKillerMine'),
(4, 1, 8, 'yujyujyujy'),
(5, 1, 8, 'Equipo alpha');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `mensaje`
--

CREATE TABLE `mensaje` (
  `id` int(11) NOT NULL,
  `enviado_id` int(11) NOT NULL,
  `recibidos_id` int(11) NOT NULL,
  `mensaje` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `fecha` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

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
(1, 'Solitarío'),
(2, 'Dúos'),
(3, 'Tríos'),
(4, 'Escuadrones'),
(6, 'MTL');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `opinion`
--

CREATE TABLE `opinion` (
  `id` int(11) NOT NULL,
  `torneo_id` int(11) NOT NULL,
  `usuario_id` int(11) NOT NULL,
  `texto` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `fecha` date NOT NULL
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
(5, 'Andriod'),
(6, 'Todas las plataformas');

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
  `fecha` datetime NOT NULL,
  `retransmision` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `codigo` varchar(4) COLLATE utf8mb4_unicode_ci NOT NULL,
  `ganador` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `torneo`
--

INSERT INTO `torneo` (`id`, `usuario_id`, `modalidad_id`, `plataforma_id`, `nombre`, `descripcion`, `imagen`, `fecha`, `retransmision`, `codigo`, `ganador`) VALUES
(5, 1, 1, 6, 'LA PEGO CUP tgt', 'Copa para todos los residentes de pego para que el mejor de la Localidad demuestre que el es el mejor !', 'uzrbdo7oyvpvhufyk4b6fh-6291569991148451778660.jpg', '2022-06-14 10:00:00', 'https://youtu.be/N2i6C0ZELcc', 'Q123', NULL),
(6, 1, 2, 6, 'COPA DE ORO', 'La copa de oro indica que el dúo que mas bajas haga en las partidas es el ganador ! A por todas !', 'epic-game-fortnite-at-2000x1270-629156dd04473605426764.jpg', '2022-06-15 11:00:00', NULL, 'Q123', NULL),
(7, 1, 3, 6, 'COPA DE LA MARINA ALTA', 'El mejor equipo de la marina alta gana, cada top, cada baja y cada movimiento cuenta.', 'uzrbdo7oyvpvhufyk4b6fh-629157207e14a304385254.jpg', '2022-06-16 18:00:00', NULL, 'S234', NULL),
(8, 1, 2, 1, 'COPA PLAY STATION', 'Copa solo para jugadores de play station, en dúos', 'l-l-ln-629157565ee33411345696.png', '2022-07-16 16:00:00', NULL, 'F456', NULL),
(9, 1, 2, 6, 'FNCS IV', 'FNCS IV', 'l-n-ln-ln-nl-6291577be1dab379932564.png', '2022-06-14 09:00:00', NULL, 'FNCS', 'Josep'),
(10, 1, 2, 2, 'LA PEGO CUP 2022', 'Nueva copa para los residentes de Pego ! Que gane el mejor', 'il-film-di-fortnite-potrebbe-essere-realta-epic-games-vuole-espandersi-gamesoul-629157cc82ab2513053839.jpg', '2022-06-14 17:45:00', NULL, 'PEGO', NULL),
(11, 1, 3, 1, 'ASIAN CUP', 'Copa para jugar contra los de la región de Ásia', 'maxresdefault-6291580a39003552333213.jpg', '2022-06-14 09:00:00', NULL, 'asin', NULL);

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
  `role` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `cuenta` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `directo` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `cuenta_sony` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `cuenta_microsoft` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `cuenta_epic` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `retranmision` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `usuario`
--

INSERT INTO `usuario` (`id`, `nombre`, `correo`, `contrasenya`, `foto`, `role`, `cuenta`, `directo`, `cuenta_sony`, `cuenta_microsoft`, `cuenta_epic`, `retranmision`) VALUES
(1, 'Daveind YT', 'admin@gmail.com', '$2y$13$nvphzr0XeLYsV0R.JlSyr.gZxm8DBd9Yb22/kNFUX9LLwceXLYPQ2', 'icon-6293888dd7260309953912.png', 'ROLE_ADMIN', 'daveind', 'daveind', 'daveind', 'Daveind YT', 'daveind ʸᵗ ツ', 'https://youtu.be/4r3mxRbN0rk'),
(7, 'TheKillerMine', 'TheKillerMine@gmail.com', '$2y$13$OgN6l1XaBAjInSXj2jRKLuGf5W5wrO.sJS14GRMnLDmO6Dks6S.gy', 'whatsapp-image-2022-06-04-at-7-21-50-pm-629b951c1d87f666048235.jpeg', 'ROLE_USER', NULL, NULL, NULL, NULL, NULL, NULL),
(8, 'MBeer', 'mb@gmail.com', '$2y$13$hD7bl5.btAngjNYAkos0MOJBp5LFX7FORuPZ7dcxsoRkvXyQv77bG', 'img-2386-629a8cb02d664956532489.jpeg', 'ROLE_USER', NULL, NULL, NULL, NULL, NULL, NULL),
(9, 'Joan Ortola', 'joanortola@gmail.com', '$2y$13$D0/Zu8oT.tS4NOtzheFEvuQKXdH64s45JknMwHVa4NK0MHvdBMfy6', 'fbi-swat-thermite-rainbow-six-siege-game-wallpaper-2560x1600-629a8d73ab445611258622.jpg', 'ROLE_USER', NULL, NULL, NULL, NULL, NULL, NULL),
(10, 'Joan Pons', 'joanpons@gmail.com', '$2y$13$Al6fNE/p7bm9x0LqlpzSuuH9AOxN.pI1SHLdtq9QBD./xPTlxpsqu', 'captura-629b93347dfe5802616013.png', 'ROLE_USER', NULL, NULL, NULL, NULL, NULL, NULL),
(11, 'Masis_', 'masima@gmail.com', '$2y$13$XzLHlc2tGWn05fB/s0Cm7e3dyGqnkv/bzAl1pl.1HHSpmOqNzyHpq', 'fgdfgdfg-629b93b2e0a7e900311444.png', 'ROLE_USER', NULL, NULL, NULL, NULL, NULL, NULL),
(12, 'Sara_1997', 'sararita@gmail.com', '$2y$13$B9pwdNhb68p/kAHqenZg0eJjUoACrDAdab6F5QwHE2shQ9178dKfC', 'captura-629b93ea80217503565769.png', 'ROLE_USER', NULL, NULL, NULL, NULL, NULL, NULL),
(13, 'Ariana', 'agrand@gmail.com', '$2y$13$rmjAjHFajqvOydKtflFU6us79Q6qattAujVqjYp/remxR9rXzDCpO', '25284-629c80c7d6217454670095.jpg', 'ROLE_ADMIN', NULL, NULL, NULL, NULL, NULL, NULL),
(14, 'Crespo', 'david.crespo@iesevalorpego.org', '$2y$13$hMZahtHLep/kEJRTMj/yKOE5oWevdw3sh8VPe0ucwa9mMU6.x9mc.', 'crewspo-629cce116effc653370741.png', 'ROLE_USER', NULL, NULL, NULL, NULL, NULL, NULL),
(15, 'Jorda', 'vicent.jorda@iesevalorpego.org', '$2y$13$d6H8n9gI6wa2QPX46VycFewDbYaYG.36wPg6MEHEDvgxN0.wjxYE6', 'homer-simpson-629ccf4f8c9d0653543126.jpg', 'ROLE_USER', NULL, NULL, NULL, NULL, NULL, NULL),
(16, 'Donet', 'joan.donet@iesevalorpego.org', '$2y$13$yWYxu1AJPcglarzsyZUbsO8qSgd/B4ohM/xmDSXQKOK4NmleVzTRe', 'homer-simpson-2006-629ccf3b473e8551105838.png', 'ROLE_USER', NULL, NULL, NULL, NULL, NULL, NULL),
(17, 'Javier Signes', 'javier.signes@iesevalorpego.org', '$2y$13$1F.w35fQyM8FTrWq.SzAWeUBK2cgQJkVTNCrf2N3CQpBprbpYFdtq', 'homer-simpson-2006-629ccf7529410267895292.png', 'ROLE_ADMIN', NULL, NULL, NULL, NULL, NULL, NULL);

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de la tabla `mensaje`
--
ALTER TABLE `mensaje`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `modalidad`
--
ALTER TABLE `modalidad`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT de la tabla `usuario`
--
ALTER TABLE `usuario`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

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
