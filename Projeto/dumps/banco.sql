CREATE DATABASE  IF NOT EXISTS `dbdeliciagelada` /*!40100 DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci */ /*!80016 DEFAULT ENCRYPTION='N' */;
USE `dbdeliciagelada`;
-- MySQL dump 10.13  Distrib 8.0.17, for Win64 (x86_64)
--
-- Host: localhost    Database: dbdeliciagelada
-- ------------------------------------------------------
-- Server version	8.0.17

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!50503 SET NAMES utf8 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `categoria_subcategoria`
--

DROP TABLE IF EXISTS `categoria_subcategoria`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `categoria_subcategoria` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_categoria` int(11) NOT NULL,
  `id_subcategoria` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `FK_categoria_idx` (`id_categoria`),
  KEY `FK subcategoria_idx` (`id_subcategoria`),
  CONSTRAINT `FK subcategoria` FOREIGN KEY (`id_subcategoria`) REFERENCES `tblsubcategoria` (`id_subcategoria`),
  CONSTRAINT `FK_categoria` FOREIGN KEY (`id_categoria`) REFERENCES `tblcategoria` (`id_categoria`)
) ENGINE=InnoDB AUTO_INCREMENT=188 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `categoria_subcategoria`
--

LOCK TABLES `categoria_subcategoria` WRITE;
/*!40000 ALTER TABLE `categoria_subcategoria` DISABLE KEYS */;
INSERT INTO `categoria_subcategoria` VALUES (172,8,13),(173,8,19),(174,8,22),(175,8,26),(176,8,27),(177,22,13),(178,22,16),(179,20,12),(180,20,13),(181,20,15),(182,20,16),(183,20,17),(184,20,19),(185,20,22),(186,20,26),(187,20,27);
/*!40000 ALTER TABLE `categoria_subcategoria` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tblcategoria`
--

DROP TABLE IF EXISTS `tblcategoria`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `tblcategoria` (
  `id_categoria` int(11) NOT NULL AUTO_INCREMENT,
  `nome_categoria` varchar(75) NOT NULL,
  `status` tinyint(4) NOT NULL,
  PRIMARY KEY (`id_categoria`)
) ENGINE=InnoDB AUTO_INCREMENT=23 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tblcategoria`
--

LOCK TABLES `tblcategoria` WRITE;
/*!40000 ALTER TABLE `tblcategoria` DISABLE KEYS */;
INSERT INTO `tblcategoria` VALUES (8,'Sucos Naturais',1),(20,'Sucos Integrais',1),(22,'Sucos com Leite',1);
/*!40000 ALTER TABLE `tblcategoria` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tblcontatenos`
--

DROP TABLE IF EXISTS `tblcontatenos`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `tblcontatenos` (
  `codigo_contato` int(11) NOT NULL AUTO_INCREMENT,
  `nome` varchar(100) NOT NULL,
  `telefone` varchar(45) DEFAULT NULL,
  `celular` varchar(45) NOT NULL,
  `email` varchar(45) NOT NULL,
  `home_page` varchar(100) DEFAULT NULL,
  `facebook` varchar(100) DEFAULT NULL,
  `tipo_mensagem` varchar(10) DEFAULT NULL,
  `mensagem` varchar(2000) NOT NULL,
  `sexo` varchar(1) NOT NULL,
  `profissao` varchar(50) NOT NULL,
  PRIMARY KEY (`codigo_contato`)
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tblcontatenos`
--

LOCK TABLES `tblcontatenos` WRITE;
/*!40000 ALTER TABLE `tblcontatenos` DISABLE KEYS */;
INSERT INTO `tblcontatenos` VALUES (9,'vinicius','(011) 4002-8922','(236) 95361-6616','vinicius@gmail.com','','','critica','nbcndhvcgdezggfgdfgvrv\r\n\r\ntvttbt','M','Sem Rumo!!'),(13,'Wd73828','','0111q222wwww1111','ewuwuhshsvshdush@gmail.com','','','critica','Jhjjj','M','Lenhadir');
/*!40000 ALTER TABLE `tblcontatenos` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tblconteudo_layout`
--

DROP TABLE IF EXISTS `tblconteudo_layout`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `tblconteudo_layout` (
  `codigo` int(11) NOT NULL AUTO_INCREMENT,
  `layout` varchar(50) NOT NULL,
  PRIMARY KEY (`codigo`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tblconteudo_layout`
--

LOCK TABLES `tblconteudo_layout` WRITE;
/*!40000 ALTER TABLE `tblconteudo_layout` DISABLE KEYS */;
INSERT INTO `tblconteudo_layout` VALUES (1,'simples'),(2,'inversa'),(3,'unica'),(4,'lista');
/*!40000 ALTER TABLE `tblconteudo_layout` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tblcuriosidades`
--

DROP TABLE IF EXISTS `tblcuriosidades`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `tblcuriosidades` (
  `codigo` int(11) NOT NULL AUTO_INCREMENT,
  `titulo` varchar(70) NOT NULL,
  `imagem` varchar(250) DEFAULT NULL,
  `descricao` varchar(5000) NOT NULL,
  `fundo` varchar(250) DEFAULT NULL,
  `codigo_layout` int(11) NOT NULL,
  `status` tinyint(4) NOT NULL,
  PRIMARY KEY (`codigo`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tblcuriosidades`
--

LOCK TABLES `tblcuriosidades` WRITE;
/*!40000 ALTER TABLE `tblcuriosidades` DISABLE KEYS */;
INSERT INTO `tblcuriosidades` VALUES (3,'Nossos Produtos','4357bfdd7e108f896fed345a8f13b13c.png','São diversos os benefícios de suco natural para a saúde. Sucos feitos com fruta e na hora proporcionam ao nosso corpo grande parte das vitaminas, sais minerais, aminoácidos e enzimas necessárias. Refrescantes e deliciosos, os bons motivos para consumi-los vão muito além do sabor.','',1,1),(4,' Beneficios ao tomar suco','c563f3e1ef2c0e84ed0841ddea6cd6b8.png','Diminuição da pressão arterial;\r\nControle da temperatura corporal;\r\nMelhoria do desempenho físico e cardiovascular;\r\nMelhoria do sistema imunológico;\r\nOs sucos de frutas são ainda fonte de vitaminas e sais minerais. Estes nutrientes exercem funções de extrema importância em nosso organismo, tais como: crescimento e transporte de oxigênio.','',4,1),(5,'Sucos da Empresa','d9e1e9af592a86f4f0b1b103eccfe611.png','Seja de laranja, abacaxi, limão, goiaba, maçã, uva ou maracujá, o importante é optar sempre por sucos integrais e naturais e em especial, dos comercializados pela Delícia Gelada. Isto porque os sucos oferecidos por esta empresa são livres de qualquer tipo de conservante ou outro aditivo químico.','326d3dc65b3c46d5b6d5466830b8893d.jpg',2,1),(6,'Dica','','Portanto, substitua os refrigerantes, que nada mais são do que bebidas ricas em calorias vazias, por sucos naturais e integrais da Delícia Gelada e contribua com a saúde e bem estar de sua família.','',3,1),(10,'Ola Mundo','ce2c14d8d3ebf9a1ca0dd8f0d7c78f9f.png','vinicius;\r\nvinicius;\r\nvinicius;\r\nvinicius;\r\nvinicius;\r\n\r\njdnckjdbjdvjkbnvkjnv dkjvnsvnnj nnjnjdjk vknsvnvkndkvl vskdkvndvn vdknndknvkksn vsdsnvlkkdnvi vlkkvmknvsvn vksdmnmvlksdn\r\njhdjhdjh dkdnfnjedhnfw\r\ndfjhbdfujdf','8e82ed27aebee357e5fab36efb2ccca4.jpg',2,1);
/*!40000 ALTER TABLE `tblcuriosidades` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tblmissao_visao_valores`
--

DROP TABLE IF EXISTS `tblmissao_visao_valores`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `tblmissao_visao_valores` (
  `codigo` int(11) NOT NULL AUTO_INCREMENT,
  `titulo` varchar(100) NOT NULL,
  `descricao` varchar(250) NOT NULL,
  `status` tinyint(4) NOT NULL,
  PRIMARY KEY (`codigo`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tblmissao_visao_valores`
--

LOCK TABLES `tblmissao_visao_valores` WRITE;
/*!40000 ALTER TABLE `tblmissao_visao_valores` DISABLE KEYS */;
INSERT INTO `tblmissao_visao_valores` VALUES (1,'Missão','REFRESCAR E TRANSFORMAR A VIDA DAS PESSOAS COM SABOR.',1),(2,'Visão','A MELHOR E MAIS INOVADORA EXPERIÊNCIA DE COMPRA DE SUCOS.',1),(3,'Valores','SABOR, VITAMINAS, ESPÍRITO DE EQUIPE, INSPIRAÇÃO E FOCO.',1),(5,'Missão','REFRESCAR E TRANSFORMAR A VIDA DAS PESSOAS COM SABOR.',0),(6,'ksksks','lodnhdscvndsvbrfnk\r\nfposjfpoefósenfpeife\r\n\r\nopfjepoffejopfpfo\r\n\r\nhfoiefoiejfjfirporfirrjro\r\n<br>\r\nfdkdhndfh',0),(7,' Beneficios ao tomar suco','LIKE NCNJNBPVOJÓPVDKFRN´VOI K \r\nfpovbmpvbmetpigket[~pvrfg\r\ntjmvtigj[profm[fff\r\nFFF\r\nFFFFFFFFFFFFFFFFFFFF',0),(8,'Ola Mundo','System auto printl<br>\r\n(\"Olá Mundo\");',0);
/*!40000 ALTER TABLE `tblmissao_visao_valores` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tblniveis`
--

DROP TABLE IF EXISTS `tblniveis`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `tblniveis` (
  `codigo` int(11) NOT NULL AUTO_INCREMENT,
  `nome_nivel` varchar(250) NOT NULL,
  `adm_conteudo` tinyint(4) NOT NULL,
  `adm_fale_conosco` tinyint(4) NOT NULL,
  `adm_user` tinyint(4) NOT NULL,
  `status` tinyint(4) NOT NULL,
  PRIMARY KEY (`codigo`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tblniveis`
--

LOCK TABLES `tblniveis` WRITE;
/*!40000 ALTER TABLE `tblniveis` DISABLE KEYS */;
INSERT INTO `tblniveis` VALUES (1,'administrador',1,1,1,1),(2,'operador de conteúdo',1,0,0,1),(3,'relacionamento com o cliente',0,1,0,1),(9,'vinicius',1,1,0,1);
/*!40000 ALTER TABLE `tblniveis` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tblnossas_lojas`
--

DROP TABLE IF EXISTS `tblnossas_lojas`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `tblnossas_lojas` (
  `codigo` int(11) NOT NULL AUTO_INCREMENT,
  `local` varchar(250) NOT NULL,
  `num_loja` int(11) NOT NULL,
  `cep` varchar(20) NOT NULL,
  `telefone` varchar(15) NOT NULL,
  `status` tinyint(4) NOT NULL,
  PRIMARY KEY (`codigo`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tblnossas_lojas`
--

LOCK TABLES `tblnossas_lojas` WRITE;
/*!40000 ALTER TABLE `tblnossas_lojas` DISABLE KEYS */;
INSERT INTO `tblnossas_lojas` VALUES (2,'Av. Luis Carlos Berrini',666,'00000-00','(011) 4321-5678',1),(3,'localhost',8080,'08080-270','(098) 4569-9876',0);
/*!40000 ALTER TABLE `tblnossas_lojas` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tblproduto`
--

DROP TABLE IF EXISTS `tblproduto`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `tblproduto` (
  `codigo` int(11) NOT NULL AUTO_INCREMENT,
  `nome` varchar(100) NOT NULL,
  `codigo_categoria` int(11) DEFAULT NULL,
  `preco` float NOT NULL,
  `codigo_subcategoria` int(11) DEFAULT NULL,
  `promocao` tinyint(4) NOT NULL,
  `porcentagem` int(11) DEFAULT NULL,
  `validade_promocao` date DEFAULT NULL,
  `descricao` varchar(500) NOT NULL,
  `produto_do_mes` tinyint(4) DEFAULT NULL,
  `imagem` varchar(150) NOT NULL,
  `status` tinyint(4) NOT NULL,
  `visualizacoes` int(11) DEFAULT NULL,
  PRIMARY KEY (`codigo`),
  KEY `FK id_categoria_idx` (`codigo_categoria`),
  KEY `FK id_subcategoria_idx` (`codigo_subcategoria`),
  CONSTRAINT `FK cod_categoria` FOREIGN KEY (`codigo_categoria`) REFERENCES `tblcategoria` (`id_categoria`) ON DELETE SET NULL ON UPDATE SET NULL,
  CONSTRAINT `FK cod_subcategoria` FOREIGN KEY (`codigo_subcategoria`) REFERENCES `tblsubcategoria` (`id_subcategoria`) ON DELETE SET NULL ON UPDATE SET NULL
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tblproduto`
--

LOCK TABLES `tblproduto` WRITE;
/*!40000 ALTER TABLE `tblproduto` DISABLE KEYS */;
INSERT INTO `tblproduto` VALUES (1,'Suco de Maracuja',8,17.5,13,0,NULL,NULL,'Sucos de Maracuja.',1,'e53c886d1ac08b89b2a52addbf9b394d.png',1,69),(2,'Suco de Limão',8,20.66,27,1,30,'2020-02-10','Suco de Limão',0,'05da46d8aa725fe832d9c1ebf677ab23.png',1,53),(3,'Suco de Laranja',8,20.66,26,0,NULL,NULL,'Suco de laranja. Forte em vitaminas C',1,'5c75cc7bf60c068c2787e25390147acb.png',0,9),(4,'Suco de Abacaxi',8,17.5,20,1,13,'2020-01-12','Lorem Ipsum é simplesmente um texto fictício da indústria tipográfica e de impressão. Lorem Ipsum é o texto fictício padrão do setor desde os anos 1500, quando uma impressora desconhecida pegou uma galera do tipo e a mexeu para fazer um livro de amostras do tipo. Ele sobreviveu não apenas cinco séculos, mas também o salto para a composição eletrônica, permanecendo essencialmente inalterado. Foi popularizado na década de 1960 com o lançamento de folhas de Letraset contendo passagens de Lorem Ipsu',1,'4e2f8ec044b1b22c5c6cd436583ed06c.png',0,64),(6,'Suco de Uva Branco',20,23.5,22,0,NULL,NULL,'O suco de uva branco integral Superbom é um produto 100% natural, produzido a partir de um blend especial de uvas cultivadas na Serra Gaúcha, proporcionando um sabor único. Excelente como acompanhamento para refeições e lanches, esse saboroso suco de fruta também é indicado para pré e pós treino. O suco de uva integral é uma bebida saudável que oferece muitos benefícios à saúde, entre eles tem efeito antioxidante e previne o câncer.',1,'2ff449107d3bc15ce8f3c070fc8de503.png',1,24),(7,'Suco de Uva ',20,15.5,22,0,NULL,NULL,'O suco de uva integral Superbom é um produto 100% natural, produzido a partir de uma única variedade de uva: a Isabel. Tendo características próprias e extremamente marcantes dessa uva, esse saboroso suco de uva tem um sabor único desde 1925. Excelente como acompanhamento para refeições, lanches, também é indicado para pré e pós treino, o suco de uva integral Superbom é uma bebida saudável que oferece muitos benefícios à saúde e também está disponível em 300 ML ou 1 L.',0,'61221c2e5c82b6fa96960eaec1237309.png',1,2);
/*!40000 ALTER TABLE `tblproduto` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tblredes_parceiro`
--

DROP TABLE IF EXISTS `tblredes_parceiro`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `tblredes_parceiro` (
  `codigo` int(11) NOT NULL AUTO_INCREMENT,
  `tipo` varchar(45) NOT NULL,
  `imagem` varchar(250) NOT NULL,
  `status` tinyint(4) NOT NULL,
  PRIMARY KEY (`codigo`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tblredes_parceiro`
--

LOCK TABLES `tblredes_parceiro` WRITE;
/*!40000 ALTER TABLE `tblredes_parceiro` DISABLE KEYS */;
INSERT INTO `tblredes_parceiro` VALUES (1,'Rede Sociais','7aa75bfd47d1b8b9cbfef177a510e026.png',1),(2,'Parceiros','56ef0899c5ae3ce27d1a9cb64a863b70.png',1),(3,'Parceiros','f8fdaa65c895f21f1fe824661f96a8ed.png',0),(4,'Rede Sociais','c3a292958904f2cb13e8869e67a75a29.png',1),(6,'Parceiros','710a0efc86e352b00b44ebf1a36093cc.png',1),(7,'Rede Sociais','bc4ea2769b1d955fe79b392e1a32a8c2.png',1);
/*!40000 ALTER TABLE `tblredes_parceiro` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tblsessoes_sobre`
--

DROP TABLE IF EXISTS `tblsessoes_sobre`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `tblsessoes_sobre` (
  `codigo` int(11) NOT NULL AUTO_INCREMENT,
  `titulo` varchar(100) NOT NULL,
  `imagem` varchar(200) NOT NULL,
  `descricao` varchar(2000) NOT NULL,
  `status` tinyint(4) NOT NULL,
  PRIMARY KEY (`codigo`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tblsessoes_sobre`
--

LOCK TABLES `tblsessoes_sobre` WRITE;
/*!40000 ALTER TABLE `tblsessoes_sobre` DISABLE KEYS */;
INSERT INTO `tblsessoes_sobre` VALUES (2,'Porque Delícia Gelada?','8bbe0b44f05069ee4096757fd9b7bc8f.png','Você pode ter se perguntado, o motivo de nossa empresa se chamar Delícia Gelada. Teriamos muitos motivos para chama-la assim. Um deles é que nossas frutas são fresca, e isso faz que o sabor do suco fique mais saboroso e tenha mais vitaminas e beneficie você.',1),(3,'Missão','15d8f46ac7435167e59ead2077b9d315.png','12354 123 abc abcmbk,b´~gmbglmmg bc abc 123 123 abc abc 123 123 abl,,l,fmflsdllm m,çlsmvlfsm vl \r\n3 123 abc abc 123 123b  vcb bv abc abc 123 123 abc abc 123 124543 abc abc 123 123 abc abc 123 123 abc abc 123 123 abc abc 123kvmfvmnfklv  km abc abc 123 123 abc abc 123 123 abc abc ',1);
/*!40000 ALTER TABLE `tblsessoes_sobre` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tblsobre`
--

DROP TABLE IF EXISTS `tblsobre`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `tblsobre` (
  `codigo` int(11) NOT NULL AUTO_INCREMENT,
  `nome_sessao` varchar(50) NOT NULL,
  `status` tinyint(4) NOT NULL,
  PRIMARY KEY (`codigo`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tblsobre`
--

LOCK TABLES `tblsobre` WRITE;
/*!40000 ALTER TABLE `tblsobre` DISABLE KEYS */;
INSERT INTO `tblsobre` VALUES (1,'Missão, Visão, Valores',1),(2,'redes sociais e parceiros',1);
/*!40000 ALTER TABLE `tblsobre` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tblsubcategoria`
--

DROP TABLE IF EXISTS `tblsubcategoria`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `tblsubcategoria` (
  `id_subcategoria` int(11) NOT NULL AUTO_INCREMENT,
  `nome_subcategoria` varchar(50) NOT NULL,
  `status` tinyint(4) NOT NULL,
  PRIMARY KEY (`id_subcategoria`)
) ENGINE=InnoDB AUTO_INCREMENT=28 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tblsubcategoria`
--

LOCK TABLES `tblsubcategoria` WRITE;
/*!40000 ALTER TABLE `tblsubcategoria` DISABLE KEYS */;
INSERT INTO `tblsubcategoria` VALUES (12,'Morango',1),(13,'Maracuja',1),(14,'Frutas Vermelhas',0),(15,'Melancia',1),(16,'Caju',1),(17,'Goiaba',1),(19,'Maçã',1),(20,'Abacaxi',0),(22,'Uva',1),(26,'Laranja',1),(27,'Limão',1);
/*!40000 ALTER TABLE `tblsubcategoria` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tblusuario`
--

DROP TABLE IF EXISTS `tblusuario`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `tblusuario` (
  `codigo` int(11) NOT NULL AUTO_INCREMENT,
  `nome` varchar(120) NOT NULL,
  `usuario` varchar(50) NOT NULL,
  `senha` varchar(200) NOT NULL,
  `codigo_nivel` int(11) NOT NULL,
  `status` tinyint(4) NOT NULL,
  PRIMARY KEY (`codigo`),
  KEY `FK_nivel_idx` (`codigo_nivel`),
  CONSTRAINT `FK_nivel` FOREIGN KEY (`codigo_nivel`) REFERENCES `tblniveis` (`codigo`)
) ENGINE=InnoDB AUTO_INCREMENT=17 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tblusuario`
--

LOCK TABLES `tblusuario` WRITE;
/*!40000 ALTER TABLE `tblusuario` DISABLE KEYS */;
INSERT INTO `tblusuario` VALUES (13,'Vinicius Domiciano Alexandrino','vinicius','121bc0a30cc629270f5ea394edb7c675',1,1),(16,'bvvhkh hgvbhjhh kjhkljkkj uhhpojb','myUser','d0783aab1fbeeb1bc2d2b4f10a03a6c7',9,1);
/*!40000 ALTER TABLE `tblusuario` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2020-01-21 10:27:23
