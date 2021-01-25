# ************************************************************
# Sequel Pro SQL dump
# Versión 4541
#
# http://www.sequelpro.com/
# https://github.com/sequelpro/sequelpro
#
# Host: gsicore.com (MySQL 5.7.27)
# Base de datos: canti_dev
# Tiempo de Generación: 2019-09-18 20:33:27 +0000
# ************************************************************


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;


# Volcado de tabla ct_campanas
# ------------------------------------------------------------

DROP TABLE IF EXISTS `ct_campanas`;

CREATE TABLE `ct_campanas` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `cam_nombre` varchar(80) COLLATE utf8mb4_unicode_ci NOT NULL,
  `cam_estado` tinyint(1) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

LOCK TABLES `ct_campanas` WRITE;
/*!40000 ALTER TABLE `ct_campanas` DISABLE KEYS */;

INSERT INTO `ct_campanas` (`id`, `cam_nombre`, `cam_estado`)
VALUES
	(1,'POSTPAGO',1),
	(2,'PORTABILIDAD',1),
	(3,'HFC',1),
	(4,'TELEVISION',1),
	(5,'WTTX',1),
	(6,'MIGRACION OC',1),
	(7,'PRUEBASCANT',1);

/*!40000 ALTER TABLE `ct_campanas` ENABLE KEYS */;
UNLOCK TABLES;


# Volcado de tabla ct_par_globales
# ------------------------------------------------------------

DROP TABLE IF EXISTS `ct_par_globales`;

CREATE TABLE `ct_par_globales` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `par_codigo` varchar(60) COLLATE utf8mb4_unicode_ci NOT NULL,
  `par_valor` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `par_estado` tinyint(1) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;


# Volcado de tabla ct_tip_llamadas
# ------------------------------------------------------------

DROP TABLE IF EXISTS `ct_tip_llamadas`;

CREATE TABLE `ct_tip_llamadas` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `tip_lla_nombre` varchar(80) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tip_lla_estado` tinyint(1) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

LOCK TABLES `ct_tip_llamadas` WRITE;
/*!40000 ALTER TABLE `ct_tip_llamadas` DISABLE KEYS */;

INSERT INTO `ct_tip_llamadas` (`id`, `tip_lla_nombre`, `tip_lla_estado`)
VALUES
	(1,'Transferida',1),
	(2,'Agendada',1),
	(3,'OTRO',1),
	(4,'REFERIDO RRSS',1);

/*!40000 ALTER TABLE `ct_tip_llamadas` ENABLE KEYS */;
UNLOCK TABLES;


# Volcado de tabla fos_user
# ------------------------------------------------------------

DROP TABLE IF EXISTS `fos_user`;

CREATE TABLE `fos_user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
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
  `ctcampanas_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `UNIQ_957A647992FC23A8` (`username_canonical`),
  UNIQUE KEY `UNIQ_957A6479A0D96FBF` (`email_canonical`),
  UNIQUE KEY `UNIQ_957A6479C05FB297` (`confirmation_token`),
  KEY `IDX_957A64793689465B` (`ctcampanas_id`),
  CONSTRAINT `FK_957A64793689465B` FOREIGN KEY (`ctcampanas_id`) REFERENCES `ct_campanas` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

LOCK TABLES `fos_user` WRITE;
/*!40000 ALTER TABLE `fos_user` DISABLE KEYS */;

INSERT INTO `fos_user` (`id`, `username`, `username_canonical`, `email`, `email_canonical`, `enabled`, `salt`, `password`, `last_login`, `confirmation_token`, `password_requested_at`, `roles`, `USU_NOMBRES`, `USU_APELLIDOS`, `ctcampanas_id`)
VALUES
	(1,'jmejia','jmejia','jmejia@gsicore.com','jmejia@gsicore.com',1,NULL,'$2y$13$OLKJmIqPNYHj8/WVh1CO1.mayNmzMbFFWL5/w76/Qu9VZJ7UVO8T2','2019-08-13 16:13:25',NULL,NULL,'a:1:{i:0;s:13:\"ADMINISTRADOR\";}','JAMES','MEJIA',NULL),
	(2,'supervisor','supervisor','supervisor@gsicore.com','supervisor@gsicore.com',1,NULL,'$2y$13$xgRMSY6lOrioXqzUK/9G/OXtM2nWWd8S5q8O28BwlYSIaCM9tp826','2019-08-01 17:35:17',NULL,NULL,'a:2:{i:0;s:10:\"SUPERVISOR\";i:1;s:6:\"AGENTE\";}','Supervisor','pruebasS',2),
	(3,'agente','agente','agente@gsicore.com','agente@gsicore.com',1,NULL,'$2y$13$oZWSxBUU8lBsEjw9P7F66.5yGTUkCSGZw8Si3mpY95N5GIZwyp8Q6','2019-08-07 12:22:16',NULL,NULL,'a:1:{i:0;s:6:\"AGENTE\";}','Agente','Prueba',NULL),
	(4,'Agente 2','agente 2','age2@sdsd.com','age2@sdsd.com',1,NULL,'$2y$13$U2mxwcvPbDEg9xokh.pBteYPSyOg5/zbcMBP0gZ8yxaXZsikY.Vvy','2019-07-29 14:21:53',NULL,NULL,'a:1:{i:0;s:6:\"AGENTE\";}','Agente 2','Dos',NULL),
	(5,'ventas1','ventas1','v1@asdasd.com','v1@asdasd.com',1,NULL,'$2y$13$2qfqHFVws/mDjnaQrWv0j.QPj.tvOfDKAtaQDf5X.jNxmfW5zHR1G','2019-08-07 13:26:43',NULL,NULL,'a:1:{i:0;s:6:\"VENTAS\";}','ventas1','1',2),
	(6,'ventas2','ventas2','v2@gsicore.com','v2@gsicore.com',1,NULL,'$2y$13$a4GnzXNUr7t/NoabQo0ZWeo9zb/Xar5oaOik5BFyAf5MIVYikHCEK','2019-08-07 13:26:52',NULL,NULL,'a:1:{i:0;s:6:\"VENTAS\";}','Ventas 2','2',1),
	(7,'ventas3','ventas3','v3@asdsa.com','v3@asdsa.com',1,NULL,'$2y$13$EhjB9yEIZoPRN6027NoW/uj9cLkWESB4g8i693oPnKH3WdPYzgW5e','2019-08-02 22:55:39',NULL,NULL,'a:1:{i:0;s:6:\"VENTAS\";}','Ventas 3','3',3),
	(8,'fmoreno','fmoreno','francisco.moreno@grupocant.com','francisco.moreno@grupocant.com',1,NULL,'$2y$13$NTPlYCPzaytLtxpMm0126uZcdKu.mcUYvPPAW1AQ/Ju5qtYJ0xkOO','2019-08-19 19:39:08',NULL,NULL,'a:1:{i:0;s:13:\"ADMINISTRADOR\";}','Francisco','Moreno',NULL),
	(9,'superhfc','superhfc','superhfc@grupocant.com','superhfc@grupocant.com',1,NULL,'$2y$13$tL.lqUpqbHHKlKE44623reM1A1q5.P70N3AS/gRHRPHNg1yYqKoNW','2019-07-26 21:41:09',NULL,NULL,'a:1:{i:0;s:10:\"SUPERVISOR\";}','SUPER','HFC',3),
	(10,'supnew','supnew','asdaw@asdad.com','asdaw@asdad.com',1,NULL,'$2y$13$bzQQlC7rfkoRxuJOwoCd5.HCHQuTi0uwPu1xCKyKxMI82ee6p4ZhS','2019-07-29 13:40:40',NULL,NULL,'a:1:{i:0;s:10:\"SUPERVISOR\";}','Prueba NEW','apellido',3),
	(11,'dhernandez','dhernandez','estrategia@c-3contactcenter.com','estrategia@c-3contactcenter.com',1,NULL,'$2y$13$BR0fRIQRKeYNf97cqQbttOtp.RAPoYsB7S32yLMkZ4RGHCSPT5LGG','2019-08-19 19:23:47',NULL,NULL,'a:1:{i:0;s:6:\"AGENTE\";}','DAYANARA','HERNANDEZ',NULL),
	(12,'supertelevision','supertelevision','camalionec1@gmail.com','camalionec1@gmail.com',1,NULL,'$2y$13$G.uq1QeE1U7qgGUnEfYoOezJ27Ax67ccUSlzCZrvJ/nGsPHErO5h.','2019-07-30 17:06:26',NULL,NULL,'a:1:{i:0;s:10:\"SUPERVISOR\";}','Supervisor','Television',4),
	(13,'reporteria','reporteria','repo@asdasd.com','repo@asdasd.com',1,NULL,'$2y$13$2b0Be/qBeOYS6u9rYWs/IulP2Q5F7be45J4WNWfVAHbWIqf.h07Q2','2019-07-29 19:52:10',NULL,NULL,'a:1:{i:0;s:10:\"REPORTERIA\";}','Reporteria','REPO',NULL),
	(14,'estefynarvaez','estefynarvaez','coordinadorcial@soportegrupocant.com','coordinadorcial@soportegrupocant.com',1,NULL,'$2y$13$hYrEjmCGZHMtvKbCcke71.HvPX.rYKTdphWFCKEUKwCPBTXeWzQFO','2019-08-02 22:57:23',NULL,NULL,'a:1:{i:0;s:6:\"VENTAS\";}','ESTEFANIA','NARVAEZ',2),
	(15,'superportabilid','superportabilid','superportabilid@gmail.com','superportabilid@gmail.com',1,NULL,'$2y$13$8UEz1LJuDYzs2hUO7.XDE.KHWxn5wxM3sVELMtj56r5K8gh9034Hq','2019-08-02 23:02:23',NULL,NULL,'a:1:{i:0;s:10:\"SUPERVISOR\";}','SUPER','PORTABILIDAD',2),
	(16,'emartinez','emartinez','eduardo.martinez@grupocant.com','eduardo.martinez@grupocant.com',1,NULL,'$2y$13$mr4Kjs7Z8YIu3YEZs5s/rO4eIEDQlzWYkJPoHy.t/q.oFNQpV90l2','2019-08-06 23:24:14',NULL,NULL,'a:1:{i:0;s:13:\"ADMINISTRADOR\";}','EDUARDO','MARTINEZ',2),
	(17,'leosan','leosan','leosan@gmail.com','leosan@gmail.com',1,NULL,'$2y$13$g8Be7o/JGCau4Xx9w8qW1OQreC.zFRd8B/cG9q9drZmJVMkYJz5Fm','2019-08-02 22:56:11',NULL,NULL,'a:1:{i:0;s:6:\"AGENTE\";}','LEONARDO','SANCHEZ',NULL),
	(18,'MISHELL_CEDENO','mishell_cedeno','michellecedeno13@gmail.com','michellecedeno13@gmail.com',1,NULL,'$2y$13$ofceHPr.t/5eTKtTfp0HiewQF8liwZvguDmS.hHHPtAvhNyQNHbJC','2019-08-07 23:26:15',NULL,NULL,'a:2:{i:0;s:6:\"AGENTE\";i:1;s:10:\"REPORTERIA\";}','MISHELL','CEDEÑO',NULL),
	(19,'GERARDO GARCIA','gerardo garcia','sup.ventasdthgye2@soportegrupocant.com','sup.ventasdthgye2@soportegrupocant.com',1,NULL,'$2y$13$YSZ3EAHYSpibpGbVgbW.9uJMjQuUyF02XRADXxtDacPLzphnDllzC','2019-08-08 16:52:07',NULL,NULL,'a:2:{i:0;s:10:\"SUPERVISOR\";i:1;s:10:\"REPORTERIA\";}','GERARDO','GARCIA',5),
	(20,'MARLON NIETO','marlon nieto','MARLONNIETO@GMAIL.COM','marlonnieto@gmail.com',1,NULL,'$2y$13$XgKxDG55fRdrR3M.Oq8Pz.x7.dD6tO0a6Umujn5I13T1VgbP4y9Ja','2019-08-06 23:20:06',NULL,NULL,'a:1:{i:0;s:6:\"AGENTE\";}','MARLON','NIETO',NULL),
	(21,'DENISSE ZAMBRAN','denisse zambran','dzambrano@gmail.com','dzambrano@gmail.com',1,NULL,'$2y$13$ZGVkvH.vDk1Mub3ausX.UOXgCRNglEEWSOHAqKchA/NsiXfl21sTW','2019-08-06 23:23:07',NULL,NULL,'a:1:{i:0;s:6:\"AGENTE\";}','DENISSE','ZAMBRANO',NULL),
	(22,'jmejiasup','jmejiasup','awsda@asdad.com','awsda@asdad.com',1,NULL,'$2y$13$i1VAnCTojALLykZosvjakeXrBHl/tbzCoeBwAKhNFoR/7b2qgB746','2019-08-07 12:22:48',NULL,NULL,'a:1:{i:0;s:10:\"SUPERVISOR\";}','SUPE PRUEBAS','PRUEBAS',4),
	(23,'ventasw','ventasw','asdas@asda.com','asdas@asda.com',1,NULL,'$2y$13$P.XOGLTmfAA3Cn5GsFuQIujuzGFPpuLoFDjNBfmN8DyYezER3VNd6','2019-08-07 12:14:25',NULL,NULL,'a:1:{i:0;s:6:\"VENTAS\";}','VENTAS','W',5),
	(24,'gerardogarcia','gerardogarcia','sup.ventasdthgye21@soportegrupocant.com','sup.ventasdthgye21@soportegrupocant.com',1,NULL,'$2y$13$0TSsfSt911eTxgVURMsIieFrJUuVKuOZ817RtmXYvDxVk.KKjrTYW','2019-08-08 21:57:25',NULL,NULL,'a:1:{i:0;s:6:\"VENTAS\";}','GERARDO','GARCIA',2),
	(25,'suppruebas','suppruebas','suppruebas@cant.com','suppruebas@cant.com',1,NULL,'$2y$13$2.lOpi5cAOOStAh6hIUGmebyd43jFUtrjanBYfH6Qt1ZSXtpiI7k6','2019-08-19 19:27:42',NULL,NULL,'a:1:{i:0;s:10:\"SUPERVISOR\";}','SUPER','PRUEBAS',7),
	(26,'venpruebas','venpruebas','venpruebas@cant.com','venpruebas@cant.com',1,NULL,'$2y$13$OVE3AyN2Cg5SAeCJEtV7.edcgquQsn9qSa685dAcNkb.oHWL4hCze','2019-08-19 20:30:58',NULL,NULL,'a:1:{i:0;s:6:\"VENTAS\";}','VENTAS','PRUEBAS',7),
	(27,'venpruebas1','venpruebas1','venpruebas1@cant.com','venpruebas1@cant.com',1,NULL,'$2y$13$dY8QUqet/85dvWv06pKaZ.6PWnP3xwrQuNl4ZZCGYMRAUkuyct3.a','2019-08-19 19:29:03',NULL,NULL,'a:1:{i:0;s:6:\"VENTAS\";}','VENTAS2','PRUEBAS',7),
	(28,'venpruebas2','venpruebas2','venpruebas2@cant.com','venpruebas2@cant.com',1,NULL,'$2y$13$/eJYIRXi29KhwzW70/1nnOB1aQtfmvttTqUhAG25lG1r.zMnq4aDm','2019-08-19 19:29:32',NULL,NULL,'a:1:{i:0;s:6:\"VENTAS\";}','VENTAS3','PRUEBAS',7);

/*!40000 ALTER TABLE `fos_user` ENABLE KEYS */;
UNLOCK TABLES;

# Volcado de tabla ct_registros
# ------------------------------------------------------------

DROP TABLE IF EXISTS `ct_registros`;

CREATE TABLE `ct_registros` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
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
  `obs_otr_campana` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_237AAB523689465B` (`ctcampanas_id`),
  KEY `IDX_237AAB52456227CF` (`cttipllamadas_id`),
  KEY `IDX_237AAB52D8654DDA` (`userntg_id`),
  KEY `IDX_237AAB52BF15ED51` (`useraxis_id`),
  CONSTRAINT `FK_237AAB523689465B` FOREIGN KEY (`ctcampanas_id`) REFERENCES `ct_campanas` (`id`),
  CONSTRAINT `FK_237AAB52456227CF` FOREIGN KEY (`cttipllamadas_id`) REFERENCES `ct_tip_llamadas` (`id`),
  CONSTRAINT `FK_237AAB52BF15ED51` FOREIGN KEY (`useraxis_id`) REFERENCES `fos_user` (`id`),
  CONSTRAINT `FK_237AAB52D8654DDA` FOREIGN KEY (`userntg_id`) REFERENCES `fos_user` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

LOCK TABLES `ct_registros` WRITE;
/*!40000 ALTER TABLE `ct_registros` DISABLE KEYS */;

INSERT INTO `ct_registros` (`id`, `ctcampanas_id`, `cttipllamadas_id`, `userntg_id`, `useraxis_id`, `reg_documento`, `reg_telefono`, `reg_nombre`, `reg_producto`, `reg_tip_gestion`, `reg_fec_registro`, `reg_fec_gestion`, `reg_estado`, `obs_otr_campana`)
VALUES
	(1,5,4,18,23,'1311494106','0984720871','VERONICA MERA','GIGA HOME',NULL,'2019-08-06 00:00:00',NULL,'ASIGNADO',NULL),
	(2,4,2,3,NULL,'asd','asd','asd','JHB',NULL,'2019-08-07 00:00:00',NULL,'REGISTRADO',NULL),
	(3,7,2,11,26,'0202010011','0995253778','FM','P1',NULL,'2019-08-19 00:00:00',NULL,'ASIGNADO',NULL),
	(4,7,3,11,27,'1722998101','0999048424','ALEJANDRO','p1',NULL,'2019-08-19 00:00:00',NULL,'ASIGNADO',NULL),
	(5,7,2,11,28,'1718772914','09555385561','estefania','P1, observacion SE CAMBIO A OTRA CAMPAÑA','VOLVER A LLAMAR','2019-08-19 00:00:00','2019-08-19 00:00:00','ATENDIDO','TELEVISION');

/*!40000 ALTER TABLE `ct_registros` ENABLE KEYS */;
UNLOCK TABLES;

/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
