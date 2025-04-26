-- mysqldump-php https://github.com/ifsnop/mysqldump-php
--
-- Host: localhost	Database: id21070856_corba
-- ------------------------------------------------------
-- Server version 	5.5.30
-- Date: Thu, 27 Jul 2023 03:36:27 +0000

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40101 SET @OLD_AUTOCOMMIT=@@AUTOCOMMIT */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `cursos`
--

/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `cursos` (
  `ID_cur` varchar(11) NOT NULL,
  `nomb_cur` varchar(45) NOT NULL,
  `horar_cur` varchar(100) NOT NULL,
  `prec_cur` float NOT NULL,
  `cupos_cur_min` int(11) NOT NULL,
  `cupos_cur_max` int(11) NOT NULL,
  `conte_text` longtext DEFAULT NULL,
  `estado_cur` enum('Activo','Eliminado') DEFAULT 'Activo',
  PRIMARY KEY (`ID_cur`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `cursos`
--

LOCK TABLES `cursos` WRITE;
/*!40000 ALTER TABLE `cursos` DISABLE KEYS */;
SET autocommit=0;
INSERT INTO `cursos` VALUES ('Eng_I_A','Ingles I ','Sabado de 08:00am a 01:00pm',20.15,1,5,'<h1 style=\"text-align: center;\"><span style=\"font-size: 24pt;\">Curso online de INGLES I<br></span></h1>\r\n<p><span style=\"font-size: 14pt;\">En este curso aprenderas los temas basicos de ingles, como pronombres, verbo to be, como crear oraciones, entre otras cosas.</span></p>\r\n<p>&nbsp;</p>\r\n<h2><span style=\"font-size: 18pt;\">Contenido Program&aacute;tico</span></h2>\r\n<p>&nbsp;</p>\r\n<h3><span style=\"font-size: 18pt;\">TEMA 1:</span></h3>\r\n<ul>\r\n<li style=\"font-size: 18pt;\"><span style=\"font-size: 18pt;\">Saludos y presentaciones: Formales e Informales.</span></li>\r\n<li style=\"font-size: 18pt;\"><span style=\"font-size: 18pt;\">Verbo to Be: Forma Interrogativa y afirmativa.</span></li>\r\n<li style=\"font-size: 18pt;\"><span style=\"font-size: 18pt;\">Palabras interrogativas: What/where/how/who.</span></li>\r\n<li style=\"font-size: 18pt;\"><span style=\"font-size: 18pt;\">Alfabeto</span></li>\r\n<li style=\"font-size: 18pt;\"><span style=\"font-size: 18pt;\">Oficios,profesiones (ocupaciones).</span></li>\r\n<li style=\"font-size: 18pt;\"><span style=\"font-size: 18pt;\">Pronombres personales sujeto</span></li>\r\n<li style=\"font-size: 18pt;\"><span style=\"font-size: 18pt;\">Pa&iacute;ses, nacionalidades e idiomas.</span></li>\r\n<li style=\"font-size: 18pt;\"><span style=\"font-size: 18pt;\">N&uacute;meros cardinales (0-100)</span></li>\r\n<li style=\"font-size: 18pt;\"><span style=\"font-size: 18pt;\">Art&iacute;culos indefinidos (a / an)</span></li>\r\n<li style=\"font-size: 18pt;\"><span style=\"font-size: 18pt;\">Adjetivos posesivos</span></li>\r\n</ul>\r\n<p>&nbsp;</p>\r\n<h3><span style=\"font-size: 18pt;\">TEMA 2:</span></h3>\r\n<ul>\r\n<li style=\"font-size: 18pt;\"><span style=\"font-size: 18pt;\">Imperativo: Forma afirmativa y negativa (instrucciones dentro del sal&oacute;n de clase).</span></li>\r\n<li style=\"font-size: 18pt;\"><span style=\"font-size: 18pt;\">Expresiones dentro del sal&oacute;n de clase.</span></li>\r\n<li style=\"font-size: 18pt;\"><span style=\"font-size: 18pt;\">Vocabulario sobre objetos del sal&oacute;n de clase y personales.</span></li>\r\n</ul>\r\n<p>&nbsp;</p>\r\n<h3><span style=\"font-size: 18pt;\">TEMA 3:</span></h3>\r\n<ul>\r\n<li style=\"font-size: 18pt;\"><span style=\"font-size: 18pt;\">Verbo have</span></li>\r\n<li style=\"font-size: 18pt;\"><span style=\"font-size: 18pt;\">Vocabulario relaciones interpersonales y la familia</span></li>\r\n<li style=\"font-size: 18pt;\"><span style=\"font-size: 18pt;\">Caso posesivo (s)</span></li>\r\n</ul>\r\n<p>&nbsp;</p>\r\n<h3><span style=\"font-size: 18pt;\">TEMA 4:</span></h3>\r\n<ul>\r\n<li style=\"font-size: 18pt;\"><span style=\"font-size: 18pt;\">Preposiciones de lugar</span></li>\r\n<li style=\"font-size: 18pt;\"><span style=\"font-size: 18pt;\">Sustantivos plurales regulares e irregulares.</span></li>\r\n<li style=\"font-size: 18pt;\"><span style=\"font-size: 18pt;\">Vocabulario de las partes y objetos de la casa. Adjetivos para describirla.</span></li>\r\n<li style=\"font-size: 18pt;\"><span style=\"font-size: 18pt;\">Adjetivos demostrativos</span></li>\r\n<li style=\"font-size: 18pt;\"><span style=\"font-size: 18pt;\">Art&iacute;culo definido (the)</span></li>\r\n</ul>\r\n<div style=\"max-width: 650px;\" data-ephox-embed-iri=\"https://www.youtube.com/embed/9p-_NhWuuZQ\">\r\n<div style=\"left: 0; width: 100%; height: 0; position: relative; padding-bottom: 56.25%;\"><iframe style=\"top: 0; left: 0; width: 100%; height: 100%; position: absolute; border: 0;\" src=\"https://www.youtube.com/embed/9p-_NhWuuZQ?rel=0\" scrolling=\"no\" allow=\"accelerometer; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share;\" allowfullscreen=\"allowfullscreen\"></iframe></div>\r\n</div>\r\n<p>&nbsp;</p>\r\n<div style=\"max-width: 650px;\" data-ephox-embed-iri=\"https://www.youtube.com/embed/f0IhZBb0BQg\">\r\n<div style=\"left: 0; width: 100%; height: 0; position: relative; padding-bottom: 56.25%;\"><iframe style=\"top: 0; left: 0; width: 100%; height: 100%; position: absolute; border: 0;\" src=\"https://www.youtube.com/embed/f0IhZBb0BQg?rel=0\" scrolling=\"no\" allow=\"accelerometer; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share;\" allowfullscreen=\"allowfullscreen\"></iframe></div>\r\n<div style=\"left: 0; width: 100%; height: 0; position: relative; padding-bottom: 56.25%;\"><span style=\"font-size: 12pt;\">Material complementario:&nbsp;<a href=\"https://drive.google.com/file/d/0B7RjlDcAGU_1ZUgtU3NHSHYzVWs/view?resourcekey=0-v7Ah98_f5C94BJdK0f_PeA\" target=\"_blank\" rel=\"noopener\">Click aqu&iacute;.</a></span></div>\r\n</div>','Activo'),('IT_I_A','Italiano I','Sabado de 08:00am a 01:00pm',15,15,20,'<h1 style=\"text-align: center;\"><span style=\"font-size: 24pt;\">Curso online de Italiano&nbsp;I</span></h1>\r\n<p><span style=\"font-size: 14pt;\">En este curso aprenderas los temas basicos de italiano, como pronombres, verbo to be, como crear oraciones, entre otras cosas</span></p>\r\n<h2><span style=\"font-size: 18pt;\">Contenido Program&aacute;tico</span></h2>\r\n<h3><span style=\"font-size: 18pt;\">TEMA 1:</span></h3>\r\n<ul>\r\n<li style=\"font-size: 18pt;\">Presente de verbos de 1&ordf;, 2&ordf; y 3&ordf;</li>\r\n<li style=\"font-size: 18pt;\">conjugaci&oacute;n.</li>\r\n<li style=\"font-size: 18pt;\">Pret&eacute;rito Perfecto.</li>\r\n<li style=\"font-size: 18pt;\">Uso de los verbos auxiliares en el Pret&eacute;rito Perfecto.</li>\r\n<li style=\"font-size: 18pt;\">Verbos reflexivos en el Presente.</li>\r\n<li style=\"font-size: 18pt;\">Verbos modales.</li>\r\n</ul>\r\n<p>&nbsp;</p>\r\n<h3><span style=\"font-size: 18pt;\">TEMA 2:</span></h3>\r\n<ul>\r\n<li style=\"font-size: 18pt;\">Verbos irregulares: avere, essere, fare, andare, otros.</li>\r\n<li style=\"font-size: 18pt;\">Verbo essere + ci.&nbsp;</li>\r\n<li style=\"font-size: 18pt;\">Pronombres personales sujeto, objeto indirecto, objeto directo.</li>\r\n<li style=\"font-size: 18pt;\">Art&iacute;culos determinados e indeterminados, singulares y plurales.</li>\r\n<li style=\"font-size: 18pt;\">Art&iacute;culos partitivos.</li>\r\n</ul>\r\n<h3><span style=\"font-size: 18pt;\">TEMA 3:</span></h3>\r\n<ul>\r\n<li><span style=\"font-size: 18pt;\">Pronombres y adjetivos posesivos.</span></li>\r\n<li><span style=\"font-size: 18pt;\">Preposiciones simples y articuladas.</span></li>\r\n<li><span style=\"font-size: 18pt;\">G&eacute;nero y n&uacute;mero de sustantivos y adjetivos regulares e irregulares m&aacute;s frecuentes. </span></li>\r\n<li><span style=\"font-size: 18pt;\">Expresiones que indican nociones de lugar y de tiempo. </span></li>\r\n</ul>\r\n<p>&nbsp;</p>\r\n<h3>TEMA 4:</h3>\r\n<ul>\r\n<li style=\"font-size: 18pt;\"><span style=\"font-size: 18pt;\">Superlativo relativo.</span></li>\r\n<li style=\"font-size: 18pt;\"><span style=\"font-size: 18pt;\">Uso de da, fra y fa en las locuciones temporales.</span></li>\r\n<li style=\"font-size: 18pt;\"><span style=\"font-size: 18pt;\">N&uacute;meros cardinales y ordinales.</span></li>\r\n</ul>\r\n<p>&nbsp;</p>\r\n<p><span style=\"font-size: 18pt;\">Videos de referencia</span></p>\r\n<div style=\"max-width: 650px;\" data-ephox-embed-iri=\"https://www.youtube.com/watch?v=zxGuuJYXl3k&amp;ab_channel=SoyMiguelIdiomas\">\r\n<div style=\"left: 0; width: 100%; height: 0; position: relative; padding-bottom: 56.25%;\"><iframe style=\"top: 0; left: 0; width: 100%; height: 100%; position: absolute; border: 0;\" src=\"https://www.youtube.com/embed/zxGuuJYXl3k?rel=0\" scrolling=\"no\" allow=\"accelerometer; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share;\" allowfullscreen=\"allowfullscreen\"></iframe></div>\r\n</div>\r\n<p>&nbsp;</p>\r\n<div style=\"max-width: 650px;\" data-ephox-embed-iri=\"https://www.youtube.com/embed/xcM02ZtixDQ\">\r\n<div style=\"left: 0; width: 100%; height: 0; position: relative; padding-bottom: 56.25%;\"><iframe style=\"top: 0; left: 0; width: 100%; height: 100%; position: absolute; border: 0;\" src=\"https://www.youtube.com/embed/xcM02ZtixDQ?rel=0\" scrolling=\"no\" allow=\"accelerometer; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share;\" allowfullscreen=\"allowfullscreen\"></iframe></div>\r\n<p style=\"left: 0; width: 100%; height: 0; position: relative; padding-bottom: 56.25%;\"><span style=\"font-size: 12pt;\">Material complementario: <a href=\"https://drive.google.com/file/d/1vAUZcGOs6SI-aHw8IFFdFTS4eVCX8HhW/view\" target=\"_blank\" rel=\"noopener\">Click aqu&iacute;.</a></span></p>\r\n</div>','Activo'),('Port_I_A','Portugues 1','Lunes a Viernes 08:00am a 10:00am',15,15,20,'<h1 style=\"text-align: center;\"><span style=\"font-size: 24pt;\">Curso online de Portugues&nbsp;I</span></h1>\r\n<p><span style=\"font-size: 14pt;\">En este curso aprenderas los temas basicos de portugues, como pronombres, verbo to be, como crear oraciones, entre otras cosas</span></p>\r\n<h2><span style=\"font-size: 18pt;\">Contenido Program&aacute;tico</span></h2>\r\n<h3><span style=\"font-size: 18pt;\">TEMA 1:</span></h3>\r\n<ul>\r\n<li style=\"font-size: 18pt;\">Art&iacute;culos determinados e indeterminados.</li>\r\n<li style=\"font-size: 18pt;\">Formas de tratamiento.</li>\r\n<li style=\"font-size: 18pt;\">Presente&nbsp;de indicativo (verbos regulares y verbos irregulares m&aacute;s frecuentes.)</li>\r\n<li style=\"font-size: 18pt;\">Contraste entre ser y estar</li>\r\n</ul>\r\n<p>&nbsp;</p>\r\n<h3><span style=\"font-size: 18pt;\">TEMA 2:</span></h3>\r\n<ul>\r\n<li style=\"font-size: 18pt;\">Pronombres posesivos, demostrativos, indefinidos, interrogativos y exclamativos.</li>\r\n<li style=\"font-size: 18pt;\">Formaci&oacute;n del plural.</li>\r\n<li style=\"font-size: 18pt;\">Comparativos.</li>\r\n<li style=\"font-size: 18pt;\">Pret&eacute;rito&nbsp;perfecto de indicativo (verbos regulares y verbos irregulares m&aacute;s frecuentes)</li>\r\n</ul>\r\n<h3><span style=\"font-size: 18pt;\">TEMA 3:</span></h3>\r\n<ul>\r\n<li>Adverbios de lugar.</li>\r\n<li>Presente&nbsp;continuo: estar + gerundio.</li>\r\n<li>Ant&oacute;nimos usuales.</li>\r\n<li>Indefinidos&nbsp;de uso m&aacute;s frecuente (contraste entre tudo y todo.)</li>\r\n</ul>\r\n<p>&nbsp;</p>\r\n<h3><span style=\"font-size: 18pt;\">TEMA 4:</span></h3>\r\n<ul>\r\n<li>Algunos conectores frecuentes (e, ou, mas, que, nem, porque, quando, ent&atilde;o.).</li>\r\n<li>Verbo haver impersonal.</li>\r\n<li>Expresi&oacute;n del futuro: per&iacute;frasis ir + infinitivo - Imperativo.</li>\r\n</ul>\r\n<p>Videos explicativos:</p>\r\n<p><iframe src=\"https://www.youtube.com/embed/l9DTBkfZK40?ab_channel=CursodeIdiomasNeurociencia\" width=\"560\" height=\"314\" allowfullscreen=\"allowfullscreen\"></iframe><iframe src=\"https://www.youtube.com/embed/N8vBCIzevj8?ab_channel=CursodeIdiomasNeurociencia\" width=\"560\" height=\"314\" allowfullscreen=\"allowfullscreen\"></iframe></p>\r\n<p>Material complementario: <a href=\"https://philipebrazuca.com/wp-content/uploads/2023/07/Guia_Completa_PDF_Para_Aprender_Portugues_TIPS_Philipe_Brazuca_-_-1.pdf\">Click aqu&iacute;.</a></p>','Activo');
/*!40000 ALTER TABLE `cursos` ENABLE KEYS */;
UNLOCK TABLES;
COMMIT;

-- Dumped table `cursos` with 3 row(s)
--

--
-- Table structure for table `foro`
--

/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `foro` (
  `id_foro` int(11) NOT NULL AUTO_INCREMENT,
  `usuario_id_foro` varchar(11) DEFAULT NULL,
  `curso_id_foro` varchar(8) DEFAULT NULL,
  `mensaje_foro` longtext DEFAULT NULL,
  `fecha_mensaje_foro` datetime DEFAULT NULL,
  PRIMARY KEY (`id_foro`),
  KEY `foro_ibfk_1` (`usuario_id_foro`),
  KEY `foro_ibfk_2` (`curso_id_foro`),
  CONSTRAINT `foro_ibfk_1` FOREIGN KEY (`usuario_id_foro`) REFERENCES `usuario` (`cedu_user`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `foro_ibfk_2` FOREIGN KEY (`curso_id_foro`) REFERENCES `cursos` (`ID_cur`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `foro`
--

LOCK TABLES `foro` WRITE;
/*!40000 ALTER TABLE `foro` DISABLE KEYS */;
SET autocommit=0;
INSERT INTO `foro` VALUES (5,'V-8032002','Eng_I_A','Que prueba?','2023-07-18 18:34:54');
/*!40000 ALTER TABLE `foro` ENABLE KEYS */;
UNLOCK TABLES;
COMMIT;

-- Dumped table `foro` with 1 row(s)
--

--
-- Table structure for table `notifipago`
--

/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `notifipago` (
  `id_notifipago` int(11) NOT NULL AUTO_INCREMENT,
  `monto_notifipago` float DEFAULT NULL,
  `banco_notifipago` varchar(30) DEFAULT NULL,
  `cedu_titular_notifipago` varchar(11) DEFAULT NULL,
  `fecha_notifipago` date DEFAULT NULL,
  `referencia_notifipago` int(11) DEFAULT NULL,
  `motivo_notifipago` text DEFAULT NULL,
  `usuario_notifipago` varchar(11) DEFAULT NULL,
  `estado_notifipago` enum('Pendiente','Procesado','Rechazado') NOT NULL DEFAULT 'Pendiente',
  PRIMARY KEY (`id_notifipago`),
  KEY `notifipago_ibfk_1` (`usuario_notifipago`),
  CONSTRAINT `notifipago_ibfk_1` FOREIGN KEY (`usuario_notifipago`) REFERENCES `usuario` (`cedu_user`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `notifipago`
--

LOCK TABLES `notifipago` WRITE;
/*!40000 ALTER TABLE `notifipago` DISABLE KEYS */;
SET autocommit=0;
INSERT INTO `notifipago` VALUES (1,20,'Venezolano de Credito','26875009','2023-07-12',73473284,'Pago Ingles I','V-28409157','Procesado'),(2,15,'Banesco','26875009','2023-07-19',312312,'Pago Ingles II','V-28409157','Procesado'),(4,25.35,'Banco Provincial','V-14896137','2023-07-13',513545511,'Ingles I','V-28409157','Procesado'),(5,17.14,'Bancrecer','V-5456452','2023-07-03',6365654,'Ingles I','V-28409157','Procesado'),(6,176,'Banco Venezolano de Crédito','V-26875007','2023-07-17',874383,'Pago de Italiano I','V-28409157','Procesado'),(7,54543.5,'Bancrecer','V-28409156','2023-07-25',645652565,'Pago Ingles 8','V-28409157','Procesado');
/*!40000 ALTER TABLE `notifipago` ENABLE KEYS */;
UNLOCK TABLES;
COMMIT;

-- Dumped table `notifipago` with 6 row(s)
--

--
-- Table structure for table `periodo`
--

/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `periodo` (
  `ID_peri` varchar(8) NOT NULL,
  `nomb_peri` varchar(45) NOT NULL,
  `fech_ini_peri` date NOT NULL,
  `fech_fin_peri` date NOT NULL,
  `estado_peri` enum('Activo','Finalizado') NOT NULL,
  PRIMARY KEY (`ID_peri`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `periodo`
--

LOCK TABLES `periodo` WRITE;
/*!40000 ALTER TABLE `periodo` DISABLE KEYS */;
SET autocommit=0;
INSERT INTO `periodo` VALUES ('2023_2','Periodo Mayo Agosto 2023','2023-05-01','2023-08-01','Activo');
/*!40000 ALTER TABLE `periodo` ENABLE KEYS */;
UNLOCK TABLES;
COMMIT;

-- Dumped table `periodo` with 1 row(s)
--

--
-- Table structure for table `usuario`
--

/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `usuario` (
  `cedu_user` varchar(11) NOT NULL,
  `nomb_user` varchar(25) NOT NULL,
  `apelli_user` varchar(25) NOT NULL,
  `correo_user` varchar(45) NOT NULL,
  `contra_user` varchar(16) NOT NULL,
  `dirre_user` varchar(150) NOT NULL,
  `numer_user` varchar(15) NOT NULL,
  `fech_naci_user` date NOT NULL,
  `sexo_user` enum('M','F') NOT NULL,
  `estado_user` enum('Activo','Inactivo','Eliminado') NOT NULL DEFAULT 'Inactivo',
  PRIMARY KEY (`cedu_user`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `usuario`
--

LOCK TABLES `usuario` WRITE;
/*!40000 ALTER TABLE `usuario` DISABLE KEYS */;
SET autocommit=0;
INSERT INTO `usuario` VALUES ('V-10214983','Jaime','Acosta','JaimeAcosta@yahoo.es','Admin2023.','Campo Claro','0416-7813428','1990-07-04','M','Activo'),('V-10214988','Victoria','Sola','victoriasola@gmail.com','Victoria12345','Calle Extrarradio Alicia 2 Esc. 287','0414-4715324','1985-05-13','F','Activo'),('V-14854123','Eduardo','Vaquero','eduardo@gmail.com','Eduardo12345','Calle Aldea Rocio s/n. Esc. 707*','0412-6974583','1989-04-21','M','Activo'),('V-15241968','Delia','Rubio','DeliaRubio@gmail.com','Delia12345','Merida','0412-6974158','1982-04-05','F','Activo'),('V-17787513','Samara','Guerra','SamaraGuerra@gmail.com','Samara12345','Calle Barranco ','0414-8964715','1996-02-28','F','Activo'),('V-18146752','Placido ','Sacristan','PlacidoSacristan@gmail.com','Placido1234','Caracas','0412-5874169','1982-10-21','M','Activo'),('V-21874596','Jose David','Cantos','JoseCantos@hotmail.com','Jose12345','Calle 70, Avenida Circunvalación 4','0414-9745831','1997-08-04','M','Activo'),('V-28409157','Stefano','Casa','Stefano007Casa@hotmail.com','Stefano2001.','Palaima','0414-9664100','2001-12-24','M','Activo'),('V-29977530','Miguel','Gonzales','jetiscool280@gmail.com','Miguel12345','El Mojan','0412-7954993','2003-11-12','M','Activo'),('V-30139486','Santiago','Vilora','santilms10@gmail.com','Santi12345','Calle Quinta Mercedes 54','0412-6612959','2003-01-30','M','Activo'),('V-30251284','Lenin','Martinez','martinezlenin04@gmail.com','Lenin12345','Calle Bajada Susana Mascareñas','0414-6119988','2003-07-25','M','Activo'),('V-30423882','Sebastian','Torres','sebasss0390@gmail.com','Sebas12345','Calle Extramuros Alejandro Guerrero 8 Puerta 864*','0424-6802599','2003-04-08','M','Activo'),('V-78214693','Leire','Castello','Leire@gmail.com','Leire12345','Calle 116, Avenida Circunvalación 4','0416-9847128','1975-09-22','M','Activo'),('V-8032002','Jose','Rodriguez','JoseRodriguez@gmail.com','Profesor2001.','Bella Vista','0412-6987425','1983-04-13','M','Activo');
/*!40000 ALTER TABLE `usuario` ENABLE KEYS */;
UNLOCK TABLES;
COMMIT;

-- Dumped table `usuario` with 14 row(s)
--

--
-- Table structure for table `usuario_has_cursos`
--

/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `usuario_has_cursos` (
  `Usuario_ID_user` varchar(11) NOT NULL,
  `Cursos_ID_cur` varchar(8) DEFAULT NULL,
  `Periodo_ID_peri` varchar(8) DEFAULT NULL,
  `calificacion_user` float DEFAULT 0,
  `Usuario_rol` enum('Profesor','Estudiante','Administrador') NOT NULL,
  `estado_usuario_has_cursos` enum('Activo','Finalizado') DEFAULT NULL,
  KEY `usuario_has_cursos_ibfk_1` (`Usuario_ID_user`),
  KEY `usuario_has_cursos_ibfk_2` (`Cursos_ID_cur`),
  KEY `usuario_has_cursos_ibfk_3` (`Periodo_ID_peri`),
  CONSTRAINT `usuario_has_cursos_ibfk_1` FOREIGN KEY (`Usuario_ID_user`) REFERENCES `usuario` (`cedu_user`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `usuario_has_cursos_ibfk_2` FOREIGN KEY (`Cursos_ID_cur`) REFERENCES `cursos` (`ID_cur`) ON DELETE NO ACTION ON UPDATE CASCADE,
  CONSTRAINT `usuario_has_cursos_ibfk_3` FOREIGN KEY (`Periodo_ID_peri`) REFERENCES `periodo` (`ID_peri`) ON DELETE NO ACTION ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `usuario_has_cursos`
--

LOCK TABLES `usuario_has_cursos` WRITE;
/*!40000 ALTER TABLE `usuario_has_cursos` DISABLE KEYS */;
SET autocommit=0;
INSERT INTO `usuario_has_cursos` VALUES ('V-28409157','Eng_I_A','2023_2',0,'Estudiante','Activo'),('V-8032002','Eng_I_A','2023_2',0,'Profesor','Activo'),('V-10214983',NULL,NULL,0,'Administrador',NULL),('V-15241968','IT_I_A','2023_2',0,'Estudiante','Activo'),('V-18146752','IT_I_A','2023_2',0,'Profesor','Activo'),('V-17787513','Eng_I_A','2023_2',0,'Estudiante','Activo'),('V-21874596','Eng_I_A','2023_2',0,'Estudiante','Activo'),('V-10214988','IT_I_A','2023_2',0,'Estudiante','Activo'),('V-30251284','Port_I_A','2023_2',0,'Estudiante','Activo'),('V-30423882','Port_I_A','2023_2',0,'Estudiante','Activo'),('V-30139486','IT_I_A','2023_2',0,'Estudiante','Activo'),('V-29977530','IT_I_A','2023_2',0,'Estudiante','Activo'),('V-14854123','Port_I_A','2023_2',0,'Profesor','Activo'),('V-78214693','Port_I_A','2023_2',0,'Estudiante','Activo');
/*!40000 ALTER TABLE `usuario_has_cursos` ENABLE KEYS */;
UNLOCK TABLES;
COMMIT;

-- Dumped table `usuario_has_cursos` with 14 row(s)
--

/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;
/*!40101 SET AUTOCOMMIT=@OLD_AUTOCOMMIT */;
/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on: Thu, 27 Jul 2023 03:36:27 +0000
