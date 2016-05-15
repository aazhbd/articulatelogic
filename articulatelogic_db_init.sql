-- Adminer 4.2.4 MySQL dump

SET NAMES utf8;
SET time_zone = '+00:00';

USE `articulatelogic_com_db`;

CREATE TABLE `articles` (
  `id` int(11) NOT NULL,
  `uid` int(11) NOT NULL,
  `category_id` int(11) NOT NULL,
  `url` varchar(250) NOT NULL,
  `title` varchar(250) NOT NULL,
  `subtitle` varchar(500) NOT NULL,
  `body` mediumtext,
  `remarks` varchar(500) NOT NULL,
  `meta_tags` varchar(200) NOT NULL,
  `privacy` int(11) NOT NULL,
  `atype` int(11) NOT NULL,
  `date_inserted` datetime NOT NULL,
  `date_updated` datetime NOT NULL,
  `state` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;


CREATE TABLE `categories` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `catname` varchar(50) NOT NULL,
  `mtype` int(11) NOT NULL,
  `date_inserted` datetime NOT NULL,
  `date_updated` datetime NOT NULL,
  `state` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;


CREATE TABLE `files` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `uid` int(11) NOT NULL,
  `category_id` int(11) NOT NULL,
  `name` varchar(512) NOT NULL,
  `path` varchar(512) NOT NULL,
  `ftype` varchar(32) NOT NULL,
  `mtype` varchar(64) NOT NULL,
  `tags` varchar(128) NOT NULL,
  `date_inserted` datetime NOT NULL,
  `date_updated` datetime NOT NULL,
  `state` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;


CREATE TABLE `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `email` varchar(50) NOT NULL,
  `pass` varchar(20) DEFAULT NULL,
  `firstname` varchar(50) DEFAULT NULL,
  `lastname` varchar(50) DEFAULT NULL,
  `gender` char(1) DEFAULT NULL,
  `date_ofbirth` date DEFAULT NULL,
  `validator` varchar(42) DEFAULT NULL,
  `utype` int(11) NOT NULL,
  `ustatus` int(11) NOT NULL,
  `date_lastlogin` datetime DEFAULT NULL,
  `date_inserted` datetime DEFAULT NULL,
  `date_updated` datetime DEFAULT NULL,
  `state` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `em_index` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` VALUES (1,'admin','admin','admin','user','m','2010-03-01','632667547e7cd3e0466547863e1207a8c0c0c549',1,1,'2016-01-04 15:27:46','2010-03-11 04:22:24','2010-03-11 04:22:24',0);
/*!40000 ALTER TABLE `users` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

-- 2016-05-15 09:10:26
