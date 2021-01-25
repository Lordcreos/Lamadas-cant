-- phpMyAdmin SQL Dump
-- version 4.9.2
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 30-01-2020 a las 00:04:56
-- Versión del servidor: 10.4.11-MariaDB
-- Versión de PHP: 7.2.26

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `canti_dev`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `ct_campanas`
--

CREATE TABLE `ct_campanas` (
  `id` int(11) NOT NULL,
  `cam_nombre` varchar(80) COLLATE utf8mb4_unicode_ci NOT NULL,
  `cam_estado` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `ct_campanas`
--

INSERT INTO `ct_campanas` (`id`, `cam_nombre`, `cam_estado`) VALUES
(1, 'POSTPAGO', 1),
(2, 'PORTABILIDAD', 1),
(3, 'HFC', 1),
(4, 'TELEVISION', 1),
(5, 'WTTX', 1),
(6, 'MIGRACION OC', 1),
(7, 'PRUEBASCANT', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `ct_par_globales`
--

CREATE TABLE `ct_par_globales` (
  `id` int(11) NOT NULL,
  `par_codigo` varchar(60) COLLATE utf8mb4_unicode_ci NOT NULL,
  `par_valor` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `par_estado` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `ct_registros`
--

CREATE TABLE `ct_registros` (
  `id` int(11) NOT NULL,
  `ctcampanas_id` int(11) DEFAULT NULL,
  `cttipllamadas_id` int(11) DEFAULT NULL,
  `userntg_id` int(11) DEFAULT NULL,
  `useraxis_id` int(11) DEFAULT NULL,
  `reg_documento` varchar(15) COLLATE utf8mb4_unicode_ci NOT NULL,
  `reg_telefono` varchar(45) COLLATE utf8mb4_unicode_ci NOT NULL,
  `reg_nombre` varchar(200) COLLATE utf8mb4_unicode_ci NOT NULL,
  `reg_producto` varchar(200) COLLATE utf8mb4_unicode_ci NOT NULL,
  `reg_tip_gestion` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `reg_fec_registro` datetime NOT NULL,
  `reg_fec_gestion` datetime DEFAULT NULL,
  `reg_estado` varchar(30) COLLATE utf8mb4_unicode_ci NOT NULL,
  `obs_otr_campana` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `ct_registros`
--

INSERT INTO `ct_registros` (`id`, `ctcampanas_id`, `cttipllamadas_id`, `userntg_id`, `useraxis_id`, `reg_documento`, `reg_telefono`, `reg_nombre`, `reg_producto`, `reg_tip_gestion`, `reg_fec_registro`, `reg_fec_gestion`, `reg_estado`, `obs_otr_campana`) VALUES
(12, 3, 3, 30, 38, '1718829193', '92773536', 'Fredy Caiza', 'hfc', 'VENTA', '2020-01-28 00:00:00', '2020-01-28 00:00:00', 'ATENDIDO', 'HFC'),
(13, 2, 3, 39, 33, '1234567', '2356987', 'pepe', 'protabilidad', 'VENTA', '2020-01-27 00:00:00', '2020-01-28 00:00:00', 'ATENDIDO', 'PORTABILIDAD'),
(14, 3, 3, 39, 38, '1724559354', '998925558', 'jorge', 'hfc', 'NO VENTA', '2020-01-28 00:00:00', '2020-01-28 00:00:00', 'ATENDIDO', 'HFC'),
(15, 3, 3, 40, 38, 'pas-652980', '9961940307', 'ariel arrechaga', 'hfc', 'NO VENTA', '2020-01-28 00:00:00', '2020-01-28 00:00:00', 'ATENDIDO', 'HFC'),
(16, 2, 3, 40, 41, '1234567', '2356987', 'pepe', 'protabilidad', 'VENTA', '2020-01-28 00:00:00', '2020-01-28 00:00:00', 'ATENDIDO', 'PORTABILIDAD'),
(17, 3, 3, 40, 38, '0920518115', '0961940838', 'juan carlo molina', 'hfc', 'VENTA', '2020-01-28 00:00:00', '2020-01-28 00:00:00', 'ATENDIDO', 'HFC');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `ct_tip_llamadas`
--

CREATE TABLE `ct_tip_llamadas` (
  `id` int(11) NOT NULL,
  `tip_lla_nombre` varchar(80) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tip_lla_estado` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `ct_tip_llamadas`
--

INSERT INTO `ct_tip_llamadas` (`id`, `tip_lla_nombre`, `tip_lla_estado`) VALUES
(1, 'Transferida', 1),
(2, 'Agendada', 1),
(3, 'confirmaciones', 1),
(4, 'REFERIDO RRSS', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `fos_user`
--

CREATE TABLE `fos_user` (
  `id` int(11) NOT NULL,
  `username` varchar(180) COLLATE utf8mb4_unicode_ci NOT NULL,
  `username_canonical` varchar(180) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(180) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_canonical` varchar(180) COLLATE utf8mb4_unicode_ci NOT NULL,
  `enabled` tinyint(1) NOT NULL,
  `salt` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `last_login` datetime DEFAULT NULL,
  `confirmation_token` varchar(180) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `password_requested_at` datetime DEFAULT NULL,
  `roles` longtext COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '(DC2Type:array)',
  `USU_NOMBRES` varchar(200) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `USU_APELLIDOS` varchar(200) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `ctcampanas_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `fos_user`
--

INSERT INTO `fos_user` (`id`, `username`, `username_canonical`, `email`, `email_canonical`, `enabled`, `salt`, `password`, `last_login`, `confirmation_token`, `password_requested_at`, `roles`, `USU_NOMBRES`, `USU_APELLIDOS`, `ctcampanas_id`) VALUES
(8, 'fmoreno', 'fmoreno', 'francisco.moreno@grupocant.com', 'francisco.moreno@grupocant.com', 1, NULL, '$2y$13$NTPlYCPzaytLtxpMm0126uZcdKu.mcUYvPPAW1AQ/Ju5qtYJ0xkOO', '2020-01-12 02:30:01', NULL, NULL, 'a:1:{i:0;s:13:\"ADMINISTRADOR\";}', 'Francisco', 'Moreno', NULL),
(29, 'leosan', 'leosan', 'leosan@gmail.com', 'leosan@gmail.com', 1, NULL, '$2y$13$uZHxMG7Np/LhiTe.pCrPVeNmVik7yedt7kcmBJuJ7MuIxtHbibJXe', '2020-01-28 01:05:35', NULL, NULL, 'a:1:{i:0;s:13:\"ADMINISTRADOR\";}', 'leonardo', 'sanchez', NULL),
(30, 'asiscall1', 'asiscall1', 'asiscall1@gmail.com', 'asiscall1@gmail.com', 1, NULL, '$2y$13$vYilyGDR0FcVAjo8fSK/sOIgKDe8dEDcNOGYQKwhgIO0gfClIpjJ.', '2020-01-28 02:51:12', NULL, NULL, 'a:1:{i:0;s:6:\"AGENTE\";}', 'asiscall', 'asiscall1', NULL),
(31, 'asiscall2', 'asiscall2', 'asiscall2@gmail.com', 'asiscall2@gmail.com', 1, NULL, '$2y$13$d/RpmJK5BertvTmplzXWpurveFFHjJH2nwu5FxBcUBbEc/iEgAzs2', '2020-01-12 02:43:27', NULL, NULL, 'a:1:{i:0;s:6:\"AGENTE\";}', '123456', '123456', NULL),
(32, 'ventas1', 'ventas1', 'ventas1@gmail.com', 'ventas1@gmail.com', 1, NULL, '$2y$13$F6BGmWi4RBb5o3Ctg.Mn4eZJm4.TlX7/ZeDoeQ59PrDrHrz.svzB2', '2020-01-28 00:10:34', NULL, NULL, 'a:1:{i:0;s:6:\"VENTAS\";}', 'ventas1', 'ventas1', 2),
(33, 'ventas2', 'ventas2', 'ventas2@gmail.com', 'ventas2@gmail.com', 1, NULL, '$2y$13$ifeTkoUdYAeNchFtfR6QF.Nnm..zXxJWTUoKXL3a7tbhVomKJo1H2', '2020-01-28 00:40:26', NULL, NULL, 'a:1:{i:0;s:6:\"VENTAS\";}', 'ventas2', 'ventas2', 2),
(34, 'suporta', 'suporta', 'suporta@gmail.com', 'suporta@gmail.com', 1, NULL, '$2y$13$bLtlT5fqsInxhizo9/qBmOio5FLOhYjjrAgDOjnpHwipKRCRfs4HC', '2020-01-28 00:40:00', NULL, NULL, 'a:1:{i:0;s:10:\"SUPERVISOR\";}', 'suporta', 'suporta', 2),
(35, 'fersuptv', 'fersuptv', 'fer@gmail.com', 'fer@gmail.com', 1, NULL, '$2y$13$jwvQsdv2Rym0YJBz4sSrMebAyTUb.zAjV//2TObD9gDV5HkBGenP2', '2020-01-28 00:01:22', NULL, NULL, 'a:1:{i:0;s:10:\"SUPERVISOR\";}', 'fer', 'fer', 4),
(36, 'ventastv', 'ventastv', 'ventatv@gmail.com', 'ventatv@gmail.com', 1, NULL, '$2y$13$ZQuODFopMNbtJlQSnd9CT.j5U4tw7So/wNTqxFGsq1KXiAlHqCAl6', '2020-01-22 03:16:39', NULL, NULL, 'a:1:{i:0;s:6:\"VENTAS\";}', 'miguel', 'mibuel', 4),
(37, 'suphfc', 'suphfc', 'suphfc@gmail.com', 'suphfc@gmail.com', 1, NULL, '$2y$13$vw62swjM048iUgouZBRUSeaBk57QxNp7lJu.B3i53Z1Ydy3ZvkfJK', '2020-01-28 01:07:55', NULL, NULL, 'a:1:{i:0;s:10:\"SUPERVISOR\";}', 'suphfc', 'suphfc', 3),
(38, 'ventahfc', 'ventahfc', 'ventahfc@gmail.com', 'ventahfc@gmail.com', 1, NULL, '$2y$13$DBmBduXCte41MHB7g4wa/.YPLHJhU/c0462hGKiIlnr8SbwA/w6Fm', '2020-01-28 01:08:34', NULL, NULL, 'a:1:{i:0;s:6:\"VENTAS\";}', 'ventahfc', 'ventahfc', 3),
(39, 'jorgetituaña', 'jorgetituaña', 'jorge@gmail.com', 'jorge@gmail.com', 1, NULL, '$2y$13$/4/hH4ny0eBHjCFjlK09vuFt41DOioMcgwGLUOvrz7y3y4CdVkpUa', '2020-01-28 01:10:06', NULL, NULL, 'a:3:{i:0;s:13:\"ADMINISTRADOR\";i:1;s:6:\"AGENTE\";i:2;s:10:\"REPORTERIA\";}', 'jorge', 'tituaña', 3),
(40, 'jorgetit', 'jorgetit', 'jorgetit@gmail.com', 'jorgetit@gmail.com', 1, NULL, '$2y$13$yLUAUV.24Nd3xFzTmsbS6OdrJ9W47kvbArvDX2ziyTTTXJkaD4H36', '2020-01-28 01:06:10', NULL, NULL, 'a:1:{i:0;s:6:\"AGENTE\";}', 'jorgetit', 'jorgetit', 2),
(41, 'fredyport', 'fredyport', 'fredy@gmail.com', 'fredy@gmail.com', 1, NULL, '$2y$13$B2oEvt69MR1EAcqbbz.NL.cWVjfT0uiQVC3HboXJy2j3Gy3z8iWeq', '2020-01-28 01:04:39', NULL, NULL, 'a:1:{i:0;s:6:\"VENTAS\";}', 'fredy', 'fredy', 2);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `ct_campanas`
--
ALTER TABLE `ct_campanas`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `ct_par_globales`
--
ALTER TABLE `ct_par_globales`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `ct_registros`
--
ALTER TABLE `ct_registros`
  ADD PRIMARY KEY (`id`),
  ADD KEY `IDX_237AAB523689465B` (`ctcampanas_id`),
  ADD KEY `IDX_237AAB52456227CF` (`cttipllamadas_id`),
  ADD KEY `IDX_237AAB52D8654DDA` (`userntg_id`),
  ADD KEY `IDX_237AAB52BF15ED51` (`useraxis_id`);

--
-- Indices de la tabla `ct_tip_llamadas`
--
ALTER TABLE `ct_tip_llamadas`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `fos_user`
--
ALTER TABLE `fos_user`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `UNIQ_957A647992FC23A8` (`username_canonical`),
  ADD UNIQUE KEY `UNIQ_957A6479A0D96FBF` (`email_canonical`),
  ADD UNIQUE KEY `UNIQ_957A6479C05FB297` (`confirmation_token`),
  ADD KEY `IDX_957A64793689465B` (`ctcampanas_id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `ct_campanas`
--
ALTER TABLE `ct_campanas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT de la tabla `ct_par_globales`
--
ALTER TABLE `ct_par_globales`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `ct_registros`
--
ALTER TABLE `ct_registros`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT de la tabla `ct_tip_llamadas`
--
ALTER TABLE `ct_tip_llamadas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `fos_user`
--
ALTER TABLE `fos_user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=42;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `ct_registros`
--
ALTER TABLE `ct_registros`
  ADD CONSTRAINT `FK_237AAB523689465B` FOREIGN KEY (`ctcampanas_id`) REFERENCES `ct_campanas` (`id`),
  ADD CONSTRAINT `FK_237AAB52456227CF` FOREIGN KEY (`cttipllamadas_id`) REFERENCES `ct_tip_llamadas` (`id`),
  ADD CONSTRAINT `FK_237AAB52BF15ED51` FOREIGN KEY (`useraxis_id`) REFERENCES `fos_user` (`id`),
  ADD CONSTRAINT `FK_237AAB52D8654DDA` FOREIGN KEY (`userntg_id`) REFERENCES `fos_user` (`id`);

--
-- Filtros para la tabla `fos_user`
--
ALTER TABLE `fos_user`
  ADD CONSTRAINT `FK_957A64793689465B` FOREIGN KEY (`ctcampanas_id`) REFERENCES `ct_campanas` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
