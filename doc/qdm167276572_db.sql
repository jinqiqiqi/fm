-- MySQL dump 10.13  Distrib 5.7.9, for osx10.9 (x86_64)
--
-- Host: qdm167276572.my3w.com    Database: qdm167276572_db
-- ------------------------------------------------------
-- Server version	5.1.48-log

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `ws_comment`
--

DROP TABLE IF EXISTS `ws_comment`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `ws_comment` (
  `id` int(8) NOT NULL AUTO_INCREMENT,
  `page_id` int(8) NOT NULL,
  `openid` varchar(30) NOT NULL,
  `nickname` varchar(50) NOT NULL,
  `weixinid` varchar(20) NOT NULL,
  `headimgurl` varchar(256) NOT NULL,
  `comment` varchar(1024) NOT NULL,
  `img_comment` varchar(30) NOT NULL,
  `date` int(20) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=37 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `ws_comment`
--

LOCK TABLES `ws_comment` WRITE;
/*!40000 ALTER TABLE `ws_comment` DISABLE KEYS */;
/*!40000 ALTER TABLE `ws_comment` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `ws_page`
--

DROP TABLE IF EXISTS `ws_page`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `ws_page` (
  `id` int(8) NOT NULL AUTO_INCREMENT,
  `openid` varchar(30) NOT NULL,
  `img_front` varchar(30) NOT NULL,
  `title` varchar(128) NOT NULL,
  `provience` varchar(50) NOT NULL,
  `city` varchar(50) NOT NULL,
  `nickname` varchar(128) NOT NULL,
  `gender` varchar(2) NOT NULL,
  `age` int(4) NOT NULL,
  `my_skill` varchar(1024) NOT NULL,
  `want_skill` varchar(1024) NOT NULL,
  `img_1` varchar(30) NOT NULL,
  `img_2` varchar(30) NOT NULL,
  `img_3` varchar(30) NOT NULL,
  `date` int(20) NOT NULL,
  `offline` varchar(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=50 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `ws_page`
--

LOCK TABLES `ws_page` WRITE;
/*!40000 ALTER TABLE `ws_page` DISABLE KEYS */;
INSERT INTO `ws_page` VALUES (47,'o94P_s--_WuTUMdTeZ5YXG6H3AKM','201605232346273499.jpg','我的介绍','山东','青岛','norasun','男',1984,'大概是个好人','美腻','','','',1464018548,'0'),(48,'o94P_s9yLSc4GYSPPeEkW9EinOKs','201605271308124290.jpg','这是第一篇','江苏','苏州','啦啦啦','男',1999,'介绍一下自己','说说对她的期望','2016052713092972.jpg','','',1464325770,'1'),(49,'o94P_s9yLSc4GYSPPeEkW9EinOKs','201605301228091655','1','北京','东城区','1','女',1999,'1','1','201605301228572446.jpg','201605301228591693.jpg','',1464582540,'0');
/*!40000 ALTER TABLE `ws_page` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `ws_zan`
--

DROP TABLE IF EXISTS `ws_zan`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `ws_zan` (
  `id` int(8) NOT NULL AUTO_INCREMENT,
  `page_id` int(8) NOT NULL,
  `openid` varchar(30) NOT NULL,
  `date` int(20) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=15 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `ws_zan`
--

LOCK TABLES `ws_zan` WRITE;
/*!40000 ALTER TABLE `ws_zan` DISABLE KEYS */;
/*!40000 ALTER TABLE `ws_zan` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `wx_access_token`
--

DROP TABLE IF EXISTS `wx_access_token`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `wx_access_token` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `token` varchar(15) NOT NULL,
  `expire_time` int(15) NOT NULL,
  `access_token` varchar(512) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `wx_access_token`
--

LOCK TABLES `wx_access_token` WRITE;
/*!40000 ALTER TABLE `wx_access_token` DISABLE KEYS */;
INSERT INTO `wx_access_token` VALUES (7,'gh_0cd081a29ac3',1464935205,'WLThTP4FGFBi7H_3buzGJWWvDxdSy5eBz14zo14KosGDu4L1GdvaiD6F_sRjgKPyBzHO1-ACWeqD4oiHv2jHZFGV3dlFQ7Cyf_H3pABTRrOu6lqOG9lKu4KlrnDRubJ4EDUgAAAZYP');
/*!40000 ALTER TABLE `wx_access_token` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `wx_config`
--

DROP TABLE IF EXISTS `wx_config`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `wx_config` (
  `id` int(5) NOT NULL AUTO_INCREMENT,
  `token` varchar(15) NOT NULL,
  `message` varchar(20) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `wx_config`
--

LOCK TABLES `wx_config` WRITE;
/*!40000 ALTER TABLE `wx_config` DISABLE KEYS */;
/*!40000 ALTER TABLE `wx_config` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `wx_cur_wechat`
--

DROP TABLE IF EXISTS `wx_cur_wechat`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `wx_cur_wechat` (
  `token` varchar(15) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `wx_cur_wechat`
--

LOCK TABLES `wx_cur_wechat` WRITE;
/*!40000 ALTER TABLE `wx_cur_wechat` DISABLE KEYS */;
INSERT INTO `wx_cur_wechat` VALUES ('gh_0cd081a29ac3');
/*!40000 ALTER TABLE `wx_cur_wechat` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `wx_debug`
--

DROP TABLE IF EXISTS `wx_debug`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `wx_debug` (
  `id` int(8) NOT NULL AUTO_INCREMENT,
  `time` varchar(20) NOT NULL,
  `content` varchar(512) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=213 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `wx_debug`
--

LOCK TABLES `wx_debug` WRITE;
/*!40000 ALTER TABLE `wx_debug` DISABLE KEYS */;
/*!40000 ALTER TABLE `wx_debug` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `wx_location`
--

DROP TABLE IF EXISTS `wx_location`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `wx_location` (
  `id` int(8) NOT NULL AUTO_INCREMENT,
  `openid` varchar(30) NOT NULL,
  `longitude` varchar(10) NOT NULL,
  `latitude` varchar(10) NOT NULL,
  `city` varchar(50) NOT NULL,
  `date` int(15) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=9 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `wx_location`
--

LOCK TABLES `wx_location` WRITE;
/*!40000 ALTER TABLE `wx_location` DISABLE KEYS */;
/*!40000 ALTER TABLE `wx_location` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `wx_member`
--

DROP TABLE IF EXISTS `wx_member`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `wx_member` (
  `id` int(8) NOT NULL AUTO_INCREMENT,
  `token` varchar(15) NOT NULL,
  `openid` varchar(30) NOT NULL,
  `nickname` varchar(50) NOT NULL,
  `headimgurl` varchar(256) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=182 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `wx_member`
--

LOCK TABLES `wx_member` WRITE;
/*!40000 ALTER TABLE `wx_member` DISABLE KEYS */;
INSERT INTO `wx_member` VALUES (168,'gh_0cd081a29ac3','o94P_s9OkX7cGy0sdk2V3bmRiE54','胡子大王是个吃货','http://wx.qlogo.cn/mmopen/Q3auHgzwzM6u476f4nhmvEIG9eaicjicWoyss9n9xTVbRT6ALZkX2fDyfibkeUc2zDqPhgcZicCNGwnzETYia07wbLg/0'),(166,'gh_0cd081a29ac3','o94P_s9yLSc4GYSPPeEkW9EinOKs','东方','http://wx.qlogo.cn/mmopen/Q3auHgzwzM5JVSeEdL8L9f3icRFyWA1aKoiacM64unnUiaEQr8Q62hPAZP32gwK1xkNbSPrq8Av1broApPibtAJyHg/0'),(167,'gh_0cd081a29ac3','o94P_s60Hol5D_Rmaw1aVoAUUn78','吴夫','http://wx.qlogo.cn/mmopen/icFTnRoibgibp99IQsiaQTZs8JAiaBo5kwjTcJ5h4rbRTicuZxHG68xV66lcR9Rqica2EviaRSibbRa38nQtibdeibgaaGVuxoEYmmtFWDp/0'),(169,'gh_0cd081a29ac3','o94P_s--_WuTUMdTeZ5YXG6H3AKM','Space','http://wx.qlogo.cn/mmopen/icFTnRoibgibp8bKhs23xezqXE6Ns8LqiahbiazYC0ZU6GMHajZHn4ZJLolFfUPHevXGrVukWh5zQDASBTqN7FjZuoA/0'),(170,'gh_0cd081a29ac3','o94P_s6-WqLMPyt3d3mD9Acx4F80','小脸一捏咯咯','http://wx.qlogo.cn/mmopen/x0UibHiae88wibrUGe40Hayxbxvveq8qWHPIc8XIv1dO4BCVAAgBRDFtAElhibX5v1ayl5FoqXbUDVGoqmibDeibxNTJPa88paXhvI/0'),(171,'gh_0cd081a29ac3','o94P_s30MeI6v14rxG5d-LLGUP60','弘餐厅','http://wx.qlogo.cn/mmopen/IVQbsicZ16rXNksOrGY7f1ibaYfSf6PHT7c8IKeJQLjaLGibl2ia3wPSiaic6cRFTIfemUtAuvn1BDRmDApY7C8yBq2UxdrTuRGCVK/0'),(172,'gh_0cd081a29ac3','o94P_s7dG-HprvMjfCoJlYtcJ4wM','黄鹍鹏～～','http://wx.qlogo.cn/mmopen/x0UibHiae88wibrUGe40HayxVveXrwGs1HAI9qNAHDia9lfibMjloMuDgrr2Ohn4NW1Wksyp0fpoDORiaY5zZ5ia2J4C1LuhRiaOKlEr/0'),(173,'gh_0cd081a29ac3','o94P_s5m3SQPop2fQmvChX4UC8Qc','梅西好東西但約翰是壞蛋','http://wx.qlogo.cn/mmopen/PiajxSqBRaELqlQo71CB5aptdDddNbiazDg94FTIrpSSGlyHxNtVbcRr1oibQo9Hr89ibia6j76YXCoj4MLvrjAibMPA/0'),(174,'gh_0cd081a29ac3','o94P_swUD7Wgy3-SottZkzxkFwBs','pupu猫','http://wx.qlogo.cn/mmopen/nFumtDLn9icRaBicFgYGnZ9w4nzeEjXEoGVk8RJ2xoAGy73BxaAk0L2LxnTVYGDqTowzHsIK6qCFBAjicqcPnmKWICcYicibstkSk/0'),(175,'gh_0cd081a29ac3','o94P_s-hjRWbK2TKhOWcRDQZbq0o','王的世界','http://wx.qlogo.cn/mmopen/icFTnRoibgibpib4uW5rAOickPItgoO4PFsV7uG9QKg9jAgwdxia3yICwbZzdznIJGe3Wnn35MZYlHhK2qvnILNGiaH7A/0'),(176,'gh_0cd081a29ac3','o94P_sy47Fgka6yT9KrSxbkFYVVg','杨扬','http://wx.qlogo.cn/mmopen/icFTnRoibgibp9ciaBh1TwlW3Ug2zyWSgDiabIm4zwFCDR42aX2VYicvRZOE4u4WSZSxS1ZyV5ZDBxHeE3XbFdNuUmVg/0'),(177,'gh_0cd081a29ac3','o94P_s4ge_L4sQ7BqHl1DbMaLbKs','周如意','http://wx.qlogo.cn/mmopen/icFTnRoibgibpibN0UagvBmj2wibDZ4QZHbjP2TpdAlKbpaWt0KDFbMZVwWvUAFZ4RlWnib40k6kUoYqMAFqR6eZbzkg3rZJyHot8d/0'),(178,'gh_0cd081a29ac3','o94P_sxKzrDTJDmqy7uPlARX1I2U','Babysbreath♪','http://wx.qlogo.cn/mmopen/IVQbsicZ16rXNksOrGY7f149lsonHJVyynvaPicXwY2AxC5subI56NYkFzSuBHf5ojtRiaTuwqSAibbxxzDvUjjzSsDQgO9QHiaVV/0'),(179,'gh_0cd081a29ac3','o94P_s6JtsrsszxKkbfizIDl_R_k','蒲公英','http://wx.qlogo.cn/mmopen/Q3auHgzwzM6hcs0W0uTiaMxoy3lsTMEWGfg2nenfsQrjbeAR0aApcNKhWTz1IiamLSFAb2PU1Fy7IsxfYuKlIiafA/0'),(180,'gh_0cd081a29ac3','o94P_s1h5E1DfTuC44uNVk9mlqTg','小莫','http://wx.qlogo.cn/mmopen/x0UibHiae88wibVJyTgTxFVzlAI2oIdZqtRVG8xmlAxwZamsNmdPa3UlQNXqrzxU9LQBD0tUM150RnXor5nGSKsJpM7iaNgpDiaeo/0'),(181,'gh_0cd081a29ac3','o94P_s3ooAVF0F65h8lUDxh7NvW0','鱼豆','http://wx.qlogo.cn/mmopen/nFumtDLn9icTuvGPE69At0JdKjsiajKMh3icagOmwNFVk5VUds51pfu6Kk7ExAuTmz7EO22ltPgkibbWwvI8xUlXWavgMarUXPoK/0');
/*!40000 ALTER TABLE `wx_member` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `wx_menu`
--

DROP TABLE IF EXISTS `wx_menu`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `wx_menu` (
  `id` int(8) NOT NULL AUTO_INCREMENT,
  `level` int(1) NOT NULL,
  `parent` varchar(10) NOT NULL,
  `number` int(2) NOT NULL,
  `type` varchar(30) NOT NULL,
  `name` varchar(30) NOT NULL,
  `url` varchar(256) NOT NULL,
  `key` varchar(256) NOT NULL,
  `token` varchar(15) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=21 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `wx_menu`
--

LOCK TABLES `wx_menu` WRITE;
/*!40000 ALTER TABLE `wx_menu` DISABLE KEYS */;
/*!40000 ALTER TABLE `wx_menu` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `wx_wechat`
--

DROP TABLE IF EXISTS `wx_wechat`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `wx_wechat` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `token` char(15) NOT NULL,
  `appid` char(18) NOT NULL,
  `appsecret` char(128) NOT NULL,
  `name` varchar(30) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=23 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `wx_wechat`
--

LOCK TABLES `wx_wechat` WRITE;
/*!40000 ALTER TABLE `wx_wechat` DISABLE KEYS */;
INSERT INTO `wx_wechat` VALUES (22,'gh_0cd081a29ac3','wxc784a9c1fd00e7e1','dba5511462fc690b1d7e623a81422b7b','友媒社交');
/*!40000 ALTER TABLE `wx_wechat` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2016-06-04  8:20:26
