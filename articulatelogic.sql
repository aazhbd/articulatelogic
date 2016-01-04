

/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;

CREATE DATABASE IF NOT EXISTS `articulatelogic_db` DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci;
USE `articulatelogic_db`;

--
-- Table structure for table `articles`
--

DROP TABLE IF EXISTS `articles`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `articles` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
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
  `state` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `em_index` (`url`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `articles`
--

LOCK TABLES `articles` WRITE;
/*!40000 ALTER TABLE `articles` DISABLE KEYS */;
INSERT INTO `articles` VALUES (1,1,1,'home','ArticulateCMS','an Open Source Content Management System platform for publishing text contents','<p style=\\\"text-align: justify; width: auto;\\\">ArticulateCMS is a simple  text-based Open Source Content Management System platform powered by  ArticulatePHP framework and MySQL database engine in  Model-View-Controller (MVC) web development architecture.</p>\r\n<p style=\\\"text-align: justify; width: auto;\\\">It\\\'s main components are  Smarty - a template engine, PHP Data Objects (PDO) extension to manage  the MySQL database connection, JQuery for JavaScript functionalities,  and FCKeditor - the WYSIWYG content editing tool. It supports page  caching, publishing of blogs, articles, and searching for contents. It  is designed to be simple, robust, flexible, scalable, portable, secured  and search engine optimized witha rich PHP function and class library.</p>\r\n<div style=\\\"width: 98%;\\\">\r\n<h3>System Requirements</h3>\r\n<div>\r\n<ul>\r\n    <ul>\r\n        <li>Windows/Linux/MAC Operating System Server</li>\r\n    </ul>\r\n    <ul>\r\n        <li>PHP  5.0 or higher</li>\r\n    </ul>\r\n    <ul>\r\n        <li>MySQL Sever(default)</li>\r\n    </ul>\r\n    <ul>\r\n        <li>All  modern Web browsers with JavaScript support enabled</li>\r\n    </ul>\r\n</ul>\r\n</div>\r\n<h3>Features</h3>\r\n<p><strong>Document management: </strong><br />\r\nIt can provide a means of managing the life cycle of a document from  initial creation time, through revisions, publication and document  destruction.<br />\r\n<br />\r\n<strong>Workflow management:</strong><br />\r\nWorkflow is the process of creating cycles of sequential and parallel  tasks that must be accomplished in the CMS. ArticulateCMS has an admin  panel that takes care of the work flow management.<br />\r\n<br />\r\n<strong>Web standards upgrades:</strong></p>\r\n<p>Each individual component can be updated regularly that include new  feature sets and keep the system up to current web standards.</p>\r\n<p><strong>Scalable feature sets:</strong><br />\r\nPlug-ins or modules can be easily installed to extend an existing site\\\'s  functionality.</p>\r\n<p><strong>Easily editable content:</strong><br />\r\nContent is separate from the visual presentation, and so it is easier  and quicker to edit and manipulate. It includes a WYSIWYG editing tool,  FCK editor allowing non-technical individuals to create and edit  content.</p>\r\n<p><strong>Versatile database support: </strong><br />\r\nArticulateCMS supports the use of any database engine by virtue of the  use of PDO extension. For example, SQLite, Oracle etc.</p>\r\n<p><strong>Search Engine optimized URL:</strong><br />\r\nAll URLs in ArticulateCMS are search engine optimized.</p>\r\n</div>','ArticulateCMS is a simple text-based Open Source Content Management System platform powered by ArticulatePHP framework and MySQL database engine','Articulate CMS, Content Management System, platform , publishing, text, contents, search engine optimization,pdo, seo, php framework, mysql, simple design, admin panel, secured, user friendly, caching',0,0,'2010-03-11 04:33:30','2010-03-11 04:34:19',0),(2,1,1,'lorem_Ipsum','Lorem Ipsum','','&lt;p&gt;Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod  tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim  veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea  commodo consequat. Duis aute irure dolor in reprehenderit in voluptate  velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint  occaecat cupidatat non proident, sunt in culpa qui officia deserunt  mollit anim id est laborum.&lt;/p&gt;\r\n&lt;p&gt;Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod  tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim  veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea  commodo consequat. Duis aute irure dolor in reprehenderit in voluptate  velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint  occaecat cupidatat non proident, sunt in culpa qui officia deserunt  mollit anim id est laborum.&lt;/p&gt;\r\n&lt;p&gt;Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod  tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim  veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea  commodo consequat. Duis aute irure dolor in reprehenderit in voluptate  velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint  occaecat cupidatat non proident, sunt in culpa qui officia deserunt  mollit anim id est laborum.&lt;/p&gt;\r\n&lt;p&gt;Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod  tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim  veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea  commodo consequat. Duis aute irure dolor in reprehenderit in voluptate  velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint  occaecat cupidatat non proident, sunt in culpa qui officia deserunt  mollit anim id est laborum.&lt;/p&gt;\r\n&lt;p&gt;Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod  tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim  veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea  commodo consequat. Duis aute irure dolor in reprehenderit in voluptate  velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint  occaecat cupidatat non proident, sunt in culpa qui officia deserunt  mollit anim id est laborum.&lt;/p&gt;\r\n&lt;p&gt;Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod  tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim  veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea  commodo consequat. Duis aute irure dolor in reprehenderit in voluptate  velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint  occaecat cupidatat non proident, sunt in culpa qui officia deserunt  mollit anim id est laborum.&lt;/p&gt;','','',0,0,'2010-03-11 04:36:04','2010-03-11 04:36:04',0);
/*!40000 ALTER TABLE `articles` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `categories`
--

DROP TABLE IF EXISTS `categories`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `categories` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `catname` varchar(50) NOT NULL,
  `mtype` int(11) NOT NULL,
  `date_inserted` datetime NOT NULL,
  `date_updated` datetime NOT NULL,
  `state` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `categories`
--

LOCK TABLES `categories` WRITE;
/*!40000 ALTER TABLE `categories` DISABLE KEYS */;
INSERT INTO `categories` VALUES (1,'Page',1,'2010-03-11 04:32:01','2010-03-11 04:32:27',0);
/*!40000 ALTER TABLE `categories` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `files`
--

DROP TABLE IF EXISTS `files`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
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
) ENGINE=InnoDB AUTO_INCREMENT=22 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `files`
--

LOCK TABLES `files` WRITE;
/*!40000 ALTER TABLE `files` DISABLE KEYS */;
/*!40000 ALTER TABLE `files` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
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
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users`
--

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` VALUES (1,'admin','admin','admin','user','m','2010-03-01','632667547e7cd3e0466547863e1207a8c0c0c549',1,1,'2016-01-04 13:45:06','2010-03-11 04:22:24','2010-03-11 04:22:24',0);
/*!40000 ALTER TABLE `users` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
