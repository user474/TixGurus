/*
SQLyog Community
MySQL - 10.1.37-MariaDB : Database - tixgurus
*********************************************************************
*/

/*!40101 SET NAMES utf8 */;

/*!40101 SET SQL_MODE=''*/;

/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;
CREATE DATABASE /*!32312 IF NOT EXISTS*/`tixgurus` /*!40100 DEFAULT CHARACTER SET latin1 */;

USE `tixgurus`;

/*Table structure for table `category` */

DROP TABLE IF EXISTS `category`;

CREATE TABLE `category` (
  `category_id` int(1) NOT NULL AUTO_INCREMENT,
  `category_name` varchar(40) DEFAULT NULL,
  `category_photo` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`category_id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=latin1;

/*Data for the table `category` */

insert  into `category`(`category_id`,`category_name`,`category_photo`) values 
(1,'Music','music.jpg'),
(2,'Family','family.jpg'),
(3,'Opera','opera.jpg'),
(4,'Dance','dance.jpg'),
(5,'Sports','sports.jpg'),
(6,'Comedy','comedy.jpg'),
(7,'Motor Sport','motor_sport.jpg');

/*Table structure for table `customers` */

DROP TABLE IF EXISTS `customers`;

CREATE TABLE `customers` (
  `customer_id` int(1) NOT NULL AUTO_INCREMENT,
  `first_name` varchar(40) DEFAULT NULL,
  `last_name` varchar(40) DEFAULT NULL,
  `email` varchar(50) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `phone` varchar(10) DEFAULT NULL,
  `unit` varchar(5) DEFAULT NULL,
  `street_no` int(1) DEFAULT NULL,
  `street` varchar(40) DEFAULT NULL,
  `suburb` varchar(40) DEFAULT NULL,
  `postcode` varchar(4) DEFAULT NULL,
  `state` varchar(3) DEFAULT NULL,
  `membership` varchar(15) DEFAULT 'standard',
  `login` datetime DEFAULT NULL,
  `logout` datetime DEFAULT NULL,
  PRIMARY KEY (`customer_id`)
) ENGINE=InnoDB AUTO_INCREMENT=108 DEFAULT CHARSET=latin1;

/*Data for the table `customers` */

insert  into `customers`(`customer_id`,`first_name`,`last_name`,`email`,`password`,`phone`,`unit`,`street_no`,`street`,`suburb`,`postcode`,`state`,`membership`,`login`,`logout`) values 
(1,'John','Smith','john@gmail.com','$2y$10$Vqb.92p2G8ReZPeLxTCQnew7YT.zURbCtlvrgW/V7rcjJy/O7Ja2C','0412345678','10',8,'Brad St','Bankstown','2200','nsw','vip','2019-12-01 13:20:43','2019-12-01 14:00:20'),
(2,'Ibrahim','Elwadia','ibrahim@gmail.com','$2y$10$Vqb.92p2G8ReZPeLxTCQnew7YT.zURbCtlvrgW/V7rcjJy/O7Ja2C','0412345678','1',10,'Pringle St','Bondi','2147','nsw','vip',NULL,NULL),
(8,'Kadin','O\'Conner','schamberger.rahsaan@gmail.com','$2y$10$Vqb.92p2G8ReZPeLxTCQnew7YT.zURbCtlvrgW/V7rcjJy/O7Ja2C','0412345678',NULL,6,'Wuckert Rue','Cooperville','5717',NULL,'standard','2019-11-28 13:04:43','2019-11-28 13:11:15'),
(9,'Dustin','Cassin','brandt.baumbach@hotmail.com','$2y$10$Vqb.92p2G8ReZPeLxTCQnew7YT.zURbCtlvrgW/V7rcjJy/O7Ja2C','0412345678',NULL,3,'Kautzer Squares','Stephenton','2326',NULL,'standard','1974-12-11 19:09:50','2008-02-13 09:48:15'),
(10,'Joshua','Tremblay','crist.fiona@gmail.com','$2y$10$Vqb.92p2G8ReZPeLxTCQnew7YT.zURbCtlvrgW/V7rcjJy/O7Ja2C','0412345678',NULL,9,'Alvina Plain','North Eryn','2044',NULL,'standard','2019-12-04 11:16:51','2019-12-04 11:30:05'),
(11,'Fabian','DuBuque','lowe.donald@gmail.com','$2y$10$Vqb.92p2G8ReZPeLxTCQnew7YT.zURbCtlvrgW/V7rcjJy/O7Ja2C','0412345678',NULL,2,'Jamal Stravenue','Haleyfort','1549',NULL,'standard','1991-06-22 14:01:37','1986-02-26 03:19:50'),
(12,'Derick','Hartmann','larson.vivienne@gmail.com','$2y$10$Vqb.92p2G8ReZPeLxTCQnew7YT.zURbCtlvrgW/V7rcjJy/O7Ja2C','0412345678',NULL,7,'Joany Unions','Kallieberg','5282',NULL,'standard','2005-08-23 09:24:31','2004-03-25 01:47:00'),
(13,'Berniece','Daugherty','bdare@gmail.com','$2y$10$Vqb.92p2G8ReZPeLxTCQnew7YT.zURbCtlvrgW/V7rcjJy/O7Ja2C','0412345678',NULL,1,'Flatley Park','Deborahmouth','6846',NULL,'standard','1998-03-21 20:09:32','2009-07-31 17:06:46'),
(14,'Gina','VonRueden','parker.felicia@hotmail.com','$2y$10$Vqb.92p2G8ReZPeLxTCQnew7YT.zURbCtlvrgW/V7rcjJy/O7Ja2C','0412345678',NULL,2,'Trevor Shoal','Percivalshire','8008',NULL,'standard','1981-07-26 08:20:54','2010-12-11 23:57:48'),
(15,'Ruby','Dach','aurelia.green@hotmail.com','$2y$10$Vqb.92p2G8ReZPeLxTCQnew7YT.zURbCtlvrgW/V7rcjJy/O7Ja2C','0412345678',NULL,7,'Zechariah Point','Yundtborough','2926',NULL,'standard','2019-12-03 16:42:45','2019-12-03 16:43:53'),
(16,'Natasha','Schulist','ray86@hotmail.com','$2y$10$Vqb.92p2G8ReZPeLxTCQnew7YT.zURbCtlvrgW/V7rcjJy/O7Ja2C','0412345678',NULL,4,'Wiegand Views','New Casimer','4863',NULL,'standard','2016-07-29 11:58:25','1985-10-03 04:05:23'),
(17,'Tyshawn','Schmitt','geovanny86@yahoo.com','$2y$10$Vqb.92p2G8ReZPeLxTCQnew7YT.zURbCtlvrgW/V7rcjJy/O7Ja2C','0412345678',NULL,4,'Vergie Mountains','Ebertview','5962',NULL,'standard','2019-06-09 14:39:59','1993-02-06 11:21:51'),
(18,'Leatha','Gusikowski','lmcglynn@hotmail.com','$2y$10$Vqb.92p2G8ReZPeLxTCQnew7YT.zURbCtlvrgW/V7rcjJy/O7Ja2C','0412345678',NULL,1,'Grimes Centers','North Shaniatown','8321',NULL,'standard','1974-12-08 23:11:17','2015-03-30 12:59:21'),
(19,'Jimmie','Thompson','zstehr@hotmail.com','$2y$10$Vqb.92p2G8ReZPeLxTCQnew7YT.zURbCtlvrgW/V7rcjJy/O7Ja2C','0412345678',NULL,4,'Benjamin Fields','Manuelshire','7382',NULL,'standard','1990-02-16 13:57:04','1977-05-09 16:01:46'),
(20,'Leonie','Fritsch','rmclaughlin@yahoo.com','$2y$10$Vqb.92p2G8ReZPeLxTCQnew7YT.zURbCtlvrgW/V7rcjJy/O7Ja2C','0412345678',NULL,8,'Hand Springs','Rosannastad','5499',NULL,'standard','1988-05-18 03:19:02','2012-11-17 07:25:25'),
(21,'Darrick','Wunsch','rosella14@yahoo.com','$2y$10$Vqb.92p2G8ReZPeLxTCQnew7YT.zURbCtlvrgW/V7rcjJy/O7Ja2C','0412345678',NULL,9,'Leannon Hill','Port Eddport','3364',NULL,'standard','2019-12-03 16:43:58','2019-12-03 16:44:25'),
(22,'Augustus','Boyer','oceane.grant@gmail.com','$2y$10$Vqb.92p2G8ReZPeLxTCQnew7YT.zURbCtlvrgW/V7rcjJy/O7Ja2C','0412345678',NULL,7,'Schuppe Streets','Jerrodberg','5244',NULL,'standard','1998-02-19 19:45:29','1998-11-21 10:58:58'),
(23,'Shanna','Okuneva','trey.spencer@gmail.com','$2y$10$Vqb.92p2G8ReZPeLxTCQnew7YT.zURbCtlvrgW/V7rcjJy/O7Ja2C','0412345678',NULL,4,'Hoppe Lights','East Eltaburgh','2606',NULL,'standard','1988-12-07 02:22:29','2004-04-25 03:26:21'),
(24,'Ross','Gerhold','prenner@yahoo.com','$2y$10$Vqb.92p2G8ReZPeLxTCQnew7YT.zURbCtlvrgW/V7rcjJy/O7Ja2C','0412345678',NULL,5,'Amina Falls','West Eliseotown','2107',NULL,'standard','1990-04-16 20:19:16','2012-06-30 23:06:46'),
(25,'Rosella','Luettgen','dtromp@hotmail.com','$2y$10$Vqb.92p2G8ReZPeLxTCQnew7YT.zURbCtlvrgW/V7rcjJy/O7Ja2C','0412345678',NULL,2,'Prosacco Ridge','Lake Norbert','5011',NULL,'standard','2001-09-03 08:41:47','1970-12-24 09:41:39'),
(26,'Cleora','Hahn','hamill.ottilie@hotmail.com','$2y$10$Vqb.92p2G8ReZPeLxTCQnew7YT.zURbCtlvrgW/V7rcjJy/O7Ja2C','0412345678',NULL,4,'Emmie Cliff','Wildermanbury','5890',NULL,'standard','2003-01-13 16:07:38','1989-03-07 01:50:47'),
(27,'Lia','Kuhn','monte.bahringer@hotmail.com','$2y$10$Vqb.92p2G8ReZPeLxTCQnew7YT.zURbCtlvrgW/V7rcjJy/O7Ja2C','0412345678',NULL,5,'Heather Ford','Uptonhaven','8697',NULL,'standard','2019-12-03 16:44:31','2019-12-03 16:45:35'),
(28,'Larry','Botsford','sziemann@gmail.com','$2y$10$Vqb.92p2G8ReZPeLxTCQnew7YT.zURbCtlvrgW/V7rcjJy/O7Ja2C','0412345678',NULL,4,'Fahey Green','New Taurean','4922',NULL,'standard','2014-08-28 12:51:55','2017-03-16 00:17:38'),
(29,'Clemens','Schumm','annalise.marvin@hotmail.com','$2y$10$Vqb.92p2G8ReZPeLxTCQnew7YT.zURbCtlvrgW/V7rcjJy/O7Ja2C','0412345678',NULL,3,'Buddy Knoll','East Freidastad','3832',NULL,'standard','1981-12-08 02:00:23','1989-01-04 13:10:16'),
(30,'Paxton','Jenkins','horace.steuber@yahoo.com','$2y$10$Vqb.92p2G8ReZPeLxTCQnew7YT.zURbCtlvrgW/V7rcjJy/O7Ja2C','0412345678',NULL,3,'Fritsch Square','Eliasview','3745',NULL,'standard','1980-07-30 12:58:03','1978-03-05 20:27:28'),
(31,'Princess','Bode','dhansen@yahoo.com','$2y$10$Vqb.92p2G8ReZPeLxTCQnew7YT.zURbCtlvrgW/V7rcjJy/O7Ja2C','0412345678',NULL,6,'Brain Mission','Chynaview','7091',NULL,'standard','1971-04-17 16:49:06','1992-11-01 14:46:53'),
(32,'Price','Kertzmann','scottie63@hotmail.com','$2y$10$Vqb.92p2G8ReZPeLxTCQnew7YT.zURbCtlvrgW/V7rcjJy/O7Ja2C','0412345678',NULL,5,'Camila Mission','New Kasandra','5172',NULL,'standard','1997-09-01 16:16:59','1971-12-27 20:53:10'),
(33,'Angus','Champlin','celestine52@yahoo.com','$2y$10$Vqb.92p2G8ReZPeLxTCQnew7YT.zURbCtlvrgW/V7rcjJy/O7Ja2C','0412345678',NULL,6,'Bethany Way','Miltonmouth','1959',NULL,'standard','1977-02-20 01:09:05','2008-10-05 10:37:46'),
(34,'Koby','Rutherford','lbrakus@gmail.com','$2y$10$Vqb.92p2G8ReZPeLxTCQnew7YT.zURbCtlvrgW/V7rcjJy/O7Ja2C','0412345678',NULL,6,'Estell Highway','Lake Augustus','7531',NULL,'standard','2019-12-03 16:45:39','2019-12-03 16:46:09'),
(35,'Janie','Kassulke','kayla15@hotmail.com','$2y$10$Vqb.92p2G8ReZPeLxTCQnew7YT.zURbCtlvrgW/V7rcjJy/O7Ja2C','0412345678',NULL,3,'Hayden Club','Marjoryside','7967',NULL,'standard','1989-07-30 06:28:01','2000-06-24 22:37:44'),
(36,'Crawford','Streich','arjun.durgan@hotmail.com','$2y$10$Vqb.92p2G8ReZPeLxTCQnew7YT.zURbCtlvrgW/V7rcjJy/O7Ja2C','0412345678',NULL,2,'Madelyn Pines','Oberbrunnermouth','2468',NULL,'standard','1993-12-01 10:09:04','1976-03-22 14:13:09'),
(37,'Helena','Kirlin','dorthy37@hotmail.com','$2y$10$Vqb.92p2G8ReZPeLxTCQnew7YT.zURbCtlvrgW/V7rcjJy/O7Ja2C','0412345678',NULL,2,'Mertz Station','Kathleenhaven','9908',NULL,'standard','2012-04-19 12:49:14','1974-03-13 06:43:17'),
(38,'Susanna','Gislason','kovacek.jessy@hotmail.com','$2y$10$Vqb.92p2G8ReZPeLxTCQnew7YT.zURbCtlvrgW/V7rcjJy/O7Ja2C','0412345678',NULL,8,'Cyrus Cape','East Draketown','3448',NULL,'standard','2006-11-25 14:41:15','1976-09-18 19:21:26'),
(39,'Danyka','Adams','aweimann@yahoo.com','$2y$10$Vqb.92p2G8ReZPeLxTCQnew7YT.zURbCtlvrgW/V7rcjJy/O7Ja2C','0412345678',NULL,3,'Tania Forge','Aaronbury','7184',NULL,'standard','1998-12-05 12:46:03','1970-08-27 21:23:42'),
(40,'Emmitt','Oberbrunner','upton.ines@yahoo.com','$2y$10$Vqb.92p2G8ReZPeLxTCQnew7YT.zURbCtlvrgW/V7rcjJy/O7Ja2C','0412345678',NULL,6,'Valentina Trail','Elinorfort','6030',NULL,'standard','1995-12-18 04:13:22','1970-05-24 06:12:33'),
(41,'Ceasar','Ankunding','dkeebler@hotmail.com','$2y$10$Vqb.92p2G8ReZPeLxTCQnew7YT.zURbCtlvrgW/V7rcjJy/O7Ja2C','0412345678',NULL,8,'Janie Circles','Lake Maryjane','7314',NULL,'standard','1987-07-23 14:36:24','1988-02-06 05:44:51'),
(42,'Hilda','Fadel','virgie39@yahoo.com','$2y$10$Vqb.92p2G8ReZPeLxTCQnew7YT.zURbCtlvrgW/V7rcjJy/O7Ja2C','0412345678',NULL,6,'Jesus Pike','Carloborough','3588',NULL,'standard','1984-09-27 19:04:50','1999-08-30 12:54:10'),
(43,'Norberto','Vandervort','kay03@gmail.com','$2y$10$Vqb.92p2G8ReZPeLxTCQnew7YT.zURbCtlvrgW/V7rcjJy/O7Ja2C','0412345678',NULL,5,'Brielle Islands','Lillyburgh','1092',NULL,'standard','1974-08-02 10:09:46','2002-12-12 06:15:20'),
(44,'Freeman','Tillman','blaise64@hotmail.com','$2y$10$Vqb.92p2G8ReZPeLxTCQnew7YT.zURbCtlvrgW/V7rcjJy/O7Ja2C','0412345678',NULL,1,'Makayla Center','West Howardfurt','5336',NULL,'standard','2006-02-24 17:59:03','1975-07-22 04:57:47'),
(45,'Janae','O\'Kon','qschroeder@hotmail.com','$2y$10$Vqb.92p2G8ReZPeLxTCQnew7YT.zURbCtlvrgW/V7rcjJy/O7Ja2C','0412345678',NULL,2,'Fay Fall','Lake Kara','2108',NULL,'standard','1997-10-16 14:00:51','2002-02-10 17:37:10'),
(46,'Weston','Schaden','dianna42@yahoo.com','$2y$10$Vqb.92p2G8ReZPeLxTCQnew7YT.zURbCtlvrgW/V7rcjJy/O7Ja2C','0412345678',NULL,8,'Heidenreich Falls','East Minerva','4454',NULL,'standard','1980-03-18 22:51:24','1999-04-11 12:51:51'),
(47,'Beatrice','Boyer','ufarrell@gmail.com','$2y$10$Vqb.92p2G8ReZPeLxTCQnew7YT.zURbCtlvrgW/V7rcjJy/O7Ja2C','0412345678',NULL,7,'Bogan Flat','Reingerchester','2580',NULL,'standard','1996-07-08 00:48:04','1984-07-06 04:53:13'),
(48,'Jedidiah','Kilback','mlehner@gmail.com','$2y$10$Vqb.92p2G8ReZPeLxTCQnew7YT.zURbCtlvrgW/V7rcjJy/O7Ja2C','0412345678',NULL,1,'Delia Creek','Mozellshire','6288',NULL,'standard','2018-07-11 14:14:29','1979-01-05 08:17:51'),
(49,'Merritt','Ondricka','jo.oberbrunner@hotmail.com','$2y$10$Vqb.92p2G8ReZPeLxTCQnew7YT.zURbCtlvrgW/V7rcjJy/O7Ja2C','0412345678',NULL,3,'Green Springs','South Gillian','4696',NULL,'standard','2014-12-13 18:54:52','2002-03-25 04:05:15'),
(50,'Joelle','Gutmann','wwiza@hotmail.com','$2y$10$Vqb.92p2G8ReZPeLxTCQnew7YT.zURbCtlvrgW/V7rcjJy/O7Ja2C','0412345678',NULL,9,'Wolf Orchard','Cormierberg','8379',NULL,'standard','1986-06-23 02:08:22','1985-05-15 03:25:46'),
(51,'Fletcher','Stokes','reggie94@gmail.com','$2y$10$Vqb.92p2G8ReZPeLxTCQnew7YT.zURbCtlvrgW/V7rcjJy/O7Ja2C','0412345678',NULL,7,'Purdy Mountain','Jaronmouth','4916',NULL,'standard','2011-03-18 17:30:36','1979-06-06 22:14:36'),
(52,'Albert','Cole','stan.dibbert@hotmail.com','$2y$10$Vqb.92p2G8ReZPeLxTCQnew7YT.zURbCtlvrgW/V7rcjJy/O7Ja2C','0412345678',NULL,9,'Nyah Square','Joyceberg','1738',NULL,'standard','2002-09-26 15:23:15','1983-11-10 21:16:31'),
(53,'Rolando','Welch','madge.streich@yahoo.com','$2y$10$Vqb.92p2G8ReZPeLxTCQnew7YT.zURbCtlvrgW/V7rcjJy/O7Ja2C','0412345678',NULL,6,'Bosco Divide','Pfefferborough','6267',NULL,'standard','1986-10-29 00:36:17','1995-11-15 05:12:37'),
(54,'Alvis','Sawayn','mclaughlin.hellen@gmail.com','$2y$10$Vqb.92p2G8ReZPeLxTCQnew7YT.zURbCtlvrgW/V7rcjJy/O7Ja2C','0412345678',NULL,3,'Kris Parks','Durganchester','9985',NULL,'standard','1975-11-04 05:27:35','1987-10-26 14:02:54'),
(55,'Taya','Schmitt','blaze42@yahoo.com','$2y$10$Vqb.92p2G8ReZPeLxTCQnew7YT.zURbCtlvrgW/V7rcjJy/O7Ja2C','0412345678',NULL,4,'Moore Forges','Naderchester','5378',NULL,'standard','2010-03-17 07:30:49','2007-08-27 10:02:26'),
(56,'Maurine','Stanton','ibechtelar@yahoo.com','$2y$10$Vqb.92p2G8ReZPeLxTCQnew7YT.zURbCtlvrgW/V7rcjJy/O7Ja2C','0412345678',NULL,9,'Wilmer Stream','Lake Josie','8095',NULL,'standard','1975-01-15 14:40:04','1979-10-13 14:12:08'),
(57,'Monserrat','Schiller','jaskolski.jaida@gmail.com','$2y$10$Vqb.92p2G8ReZPeLxTCQnew7YT.zURbCtlvrgW/V7rcjJy/O7Ja2C','0412345678',NULL,8,'Ahmad Landing','West Linamouth','1024',NULL,'standard','1987-07-06 04:26:22','1985-04-29 05:10:38'),
(58,'Magali','Murazik','vgaylord@hotmail.com','$2y$10$Vqb.92p2G8ReZPeLxTCQnew7YT.zURbCtlvrgW/V7rcjJy/O7Ja2C','0412345678',NULL,2,'Willy Isle','Billborough','5274',NULL,'standard','2019-11-28 13:15:21','2019-11-28 13:16:40'),
(59,'Joshua','Leffler','yconnelly@yahoo.com','$2y$10$Vqb.92p2G8ReZPeLxTCQnew7YT.zURbCtlvrgW/V7rcjJy/O7Ja2C','0412345678',NULL,7,'Harber Isle','East Paulbury','7977',NULL,'standard','2014-09-21 03:08:35','1991-03-04 01:17:37'),
(60,'Esteban','Wintheiser','kevon87@hotmail.com','$2y$10$Vqb.92p2G8ReZPeLxTCQnew7YT.zURbCtlvrgW/V7rcjJy/O7Ja2C','0412345678',NULL,5,'Kuhic Groves','Port Darrellhaven','4281',NULL,'standard','1974-12-12 10:57:42','1983-05-31 22:13:08'),
(61,'Herminio','Gleichner','zechariah65@hotmail.com','$2y$10$Vqb.92p2G8ReZPeLxTCQnew7YT.zURbCtlvrgW/V7rcjJy/O7Ja2C','0412345678',NULL,3,'Tillman Islands','West Anyaland','3109',NULL,'standard','1990-07-02 08:15:39','2010-11-19 16:16:06'),
(62,'Jordan','Konopelski','fstiedemann@gmail.com','$2y$10$Vqb.92p2G8ReZPeLxTCQnew7YT.zURbCtlvrgW/V7rcjJy/O7Ja2C','0412345678',NULL,5,'Johnnie Points','Lake Sedrickport','3502',NULL,'standard','2002-04-01 08:46:26','1985-07-14 01:59:59'),
(63,'Jackson','Gutmann','sluettgen@yahoo.com','$2y$10$Vqb.92p2G8ReZPeLxTCQnew7YT.zURbCtlvrgW/V7rcjJy/O7Ja2C','0412345678',NULL,8,'Blanda Harbor','Goyetteburgh','1352',NULL,'standard','1970-11-11 00:07:25','2004-07-24 14:05:27'),
(64,'Emie','McKenzie','graham.lue@yahoo.com','$2y$10$Vqb.92p2G8ReZPeLxTCQnew7YT.zURbCtlvrgW/V7rcjJy/O7Ja2C','0412345678',NULL,5,'Summer Mission','Stantonchester','7255',NULL,'standard','1979-10-08 07:37:29','2000-12-10 09:23:03'),
(65,'Kamryn','Gutkowski','mosciski.phoebe@hotmail.com','$2y$10$Vqb.92p2G8ReZPeLxTCQnew7YT.zURbCtlvrgW/V7rcjJy/O7Ja2C','0412345678',NULL,9,'Rory Motorway','North Ron','3754',NULL,'standard','1994-03-03 22:55:09','1972-12-03 14:11:53'),
(66,'Brigitte','Heller','lila.lang@yahoo.com','$2y$10$Vqb.92p2G8ReZPeLxTCQnew7YT.zURbCtlvrgW/V7rcjJy/O7Ja2C','0412345678',NULL,4,'Crooks Avenue','Everetteland','6873',NULL,'standard','2017-11-24 02:23:48','2006-08-04 21:36:36'),
(67,'Cara','Lueilwitz','fwitting@hotmail.com','$2y$10$Vqb.92p2G8ReZPeLxTCQnew7YT.zURbCtlvrgW/V7rcjJy/O7Ja2C','0412345678',NULL,3,'Frami Square','Lake Maynard','3228',NULL,'standard','1983-09-23 08:19:39','1980-04-10 05:55:23'),
(68,'Virginie','McCullough','jacobson.destin@gmail.com','$2y$10$Vqb.92p2G8ReZPeLxTCQnew7YT.zURbCtlvrgW/V7rcjJy/O7Ja2C','0412345678',NULL,1,'Amiya Brook','Rodriguezton','2057',NULL,'standard','1989-01-17 07:15:18','2017-10-02 21:44:42'),
(69,'Francisca','Goodwin','xdeckow@gmail.com','$2y$10$Vqb.92p2G8ReZPeLxTCQnew7YT.zURbCtlvrgW/V7rcjJy/O7Ja2C','0412345678',NULL,7,'Katrine Junctions','Saigefurt','1977',NULL,'standard','2019-11-28 18:36:16','2019-11-28 18:59:57'),
(70,'Jeramy','Bins','jameson30@gmail.com','$2y$10$Vqb.92p2G8ReZPeLxTCQnew7YT.zURbCtlvrgW/V7rcjJy/O7Ja2C','0412345678',NULL,8,'Jayne Club','Port Alene','1030',NULL,'standard','1998-01-04 18:56:04','1993-09-27 14:48:02'),
(71,'Kamille','Lockman','gaston.lesch@gmail.com','$2y$10$Vqb.92p2G8ReZPeLxTCQnew7YT.zURbCtlvrgW/V7rcjJy/O7Ja2C','0412345678',NULL,5,'Eichmann Squares','Chayafort','2622',NULL,'vip','2017-02-22 10:59:54','1986-08-06 02:13:43'),
(72,'Thomas','Graham','tobin03@yahoo.com','$2y$10$Vqb.92p2G8ReZPeLxTCQnew7YT.zURbCtlvrgW/V7rcjJy/O7Ja2C','0412345678',NULL,5,'Kory Vista','O\'Haraview','6551',NULL,'vip','1999-06-19 11:03:59','1973-04-15 02:03:08'),
(73,'Lavonne','Kreiger','bessie.kiehn@yahoo.com','$2y$10$Vqb.92p2G8ReZPeLxTCQnew7YT.zURbCtlvrgW/V7rcjJy/O7Ja2C','0412345678',NULL,8,'Zulauf Lodge','Lowelltown','5367',NULL,'vip','2008-09-09 16:30:21','2017-01-03 05:00:09'),
(74,'Destiney','Langworth','kertzmann.maybelle@hotmail.com','$2y$10$Vqb.92p2G8ReZPeLxTCQnew7YT.zURbCtlvrgW/V7rcjJy/O7Ja2C','0412345678',NULL,4,'Manuela Spurs','Kozeyborough','6028',NULL,'vip','2000-08-23 05:27:28','2015-02-16 04:52:37'),
(75,'Tod','Murray','omoen@gmail.com','$2y$10$Vqb.92p2G8ReZPeLxTCQnew7YT.zURbCtlvrgW/V7rcjJy/O7Ja2C','0412345678',NULL,3,'Weber Ville','South Agustinaland','5695',NULL,'vip','2003-12-23 07:10:41','1983-10-30 01:50:17'),
(76,'Cordell','Simonis','tressa54@hotmail.com','$2y$10$Vqb.92p2G8ReZPeLxTCQnew7YT.zURbCtlvrgW/V7rcjJy/O7Ja2C','0412345678',NULL,8,'Graham Wells','North Raoul','5648',NULL,'vip','1977-02-26 15:35:55','2010-04-08 19:09:51'),
(77,'Richard','Lesch','lpagac@yahoo.com','$2y$10$Vqb.92p2G8ReZPeLxTCQnew7YT.zURbCtlvrgW/V7rcjJy/O7Ja2C','0412345678',NULL,8,'Felton Fall','Port Jacinthe','5030',NULL,'vip','1991-04-13 10:59:55','1990-09-23 06:59:51'),
(78,'Fidel','Hyatt','kutch.justyn@gmail.com','$2y$10$Vqb.92p2G8ReZPeLxTCQnew7YT.zURbCtlvrgW/V7rcjJy/O7Ja2C','0412345678',NULL,1,'Mosciski Loaf','Ignaciofort','1199',NULL,'vip','1995-09-15 21:55:07','2008-01-28 13:25:37'),
(79,'Ellie','Koelpin','stacey78@yahoo.com','$2y$10$Vqb.92p2G8ReZPeLxTCQnew7YT.zURbCtlvrgW/V7rcjJy/O7Ja2C','0412345678',NULL,2,'Howell Islands','North Annettamouth','188',NULL,'vip','2007-05-30 17:22:51','1972-03-18 07:18:11'),
(80,'Mark','Kub','tyson.schneider@yahoo.com','$2y$10$Vqb.92p2G8ReZPeLxTCQnew7YT.zURbCtlvrgW/V7rcjJy/O7Ja2C','0412345678',NULL,1,'Michael Mountains','West Dalton','4722',NULL,'vip','2017-04-14 11:26:28','2017-08-01 13:37:18'),
(81,'Janie','D\'Amore','gmarquardt@yahoo.com','$2y$10$Vqb.92p2G8ReZPeLxTCQnew7YT.zURbCtlvrgW/V7rcjJy/O7Ja2C','0412345678',NULL,5,'Lemuel Street','Spinkaside','9104',NULL,'vip','1979-01-27 00:04:25','1976-09-29 08:43:47'),
(82,'Kathlyn','Lebsack','romaguera.lily@gmail.com','$2y$10$Vqb.92p2G8ReZPeLxTCQnew7YT.zURbCtlvrgW/V7rcjJy/O7Ja2C','0412345678',NULL,1,'Green Lakes','Port Keeley','3328',NULL,'vip','2013-05-01 14:00:04','1993-01-03 03:07:33'),
(83,'Kathryne','Kemmer','lowe.enrico@gmail.com','$2y$10$Vqb.92p2G8ReZPeLxTCQnew7YT.zURbCtlvrgW/V7rcjJy/O7Ja2C','0412345678',NULL,3,'Bryana Parks','Lake Cynthialand','5420',NULL,'vip','1989-04-19 07:44:52','2008-03-09 00:11:05'),
(84,'Leopoldo','Littel','dejuan63@hotmail.com','$2y$10$Vqb.92p2G8ReZPeLxTCQnew7YT.zURbCtlvrgW/V7rcjJy/O7Ja2C','0412345678',NULL,4,'Shyanne Expressway','Beckerberg','6377',NULL,'vip','1979-08-07 14:11:05','1988-01-17 14:02:14'),
(85,'Aleen','D\'Amore','gerda.lowe@hotmail.com','$2y$10$Vqb.92p2G8ReZPeLxTCQnew7YT.zURbCtlvrgW/V7rcjJy/O7Ja2C','0412345678',NULL,1,'Manuela Village','New Rex','5882',NULL,'vip','2019-11-28 13:12:55','2019-11-28 13:14:31'),
(86,'Eula','Hand','yvette64@yahoo.com','$2y$10$Vqb.92p2G8ReZPeLxTCQnew7YT.zURbCtlvrgW/V7rcjJy/O7Ja2C','0412345678',NULL,2,'Isai Mountains','Babyburgh','1658',NULL,'vip','2015-09-02 23:38:16','2009-11-08 00:13:16'),
(87,'Dayne','Okuneva','kyle03@hotmail.com','$2y$10$Vqb.92p2G8ReZPeLxTCQnew7YT.zURbCtlvrgW/V7rcjJy/O7Ja2C','0412345678',NULL,7,'Earnestine Locks','Kilbackbury','8634',NULL,'vip','1996-03-07 14:41:35','2019-02-10 05:11:17'),
(88,'Alexander','Thiel','xzavier.zemlak@yahoo.com','$2y$10$Vqb.92p2G8ReZPeLxTCQnew7YT.zURbCtlvrgW/V7rcjJy/O7Ja2C','0412345678',NULL,4,'Miller Walk','Savanahfurt','9087',NULL,'vip','2011-09-07 02:21:58','2003-07-27 10:49:27'),
(89,'Leland','Heidenreich','wtromp@gmail.com','$2y$10$Vqb.92p2G8ReZPeLxTCQnew7YT.zURbCtlvrgW/V7rcjJy/O7Ja2C','0412345678',NULL,8,'Hagenes Village','New Amiyafurt','9048',NULL,'vip','1982-06-23 08:17:13','2005-11-11 11:31:24'),
(90,'Chase','Mueller','geraldine.wunsch@gmail.com','$2y$10$Vqb.92p2G8ReZPeLxTCQnew7YT.zURbCtlvrgW/V7rcjJy/O7Ja2C','0412345678',NULL,5,'Lind Lake','South Loraine','4214',NULL,'vip','2003-12-24 19:14:23','1987-09-08 18:46:30'),
(91,'Orie','Little','taurean58@hotmail.com','$2y$10$Vqb.92p2G8ReZPeLxTCQnew7YT.zURbCtlvrgW/V7rcjJy/O7Ja2C','0412345678',NULL,1,'Kelly Junctions','Port Rickie','3590',NULL,'vip','2009-08-27 18:09:30','1988-11-16 02:09:26'),
(92,'Peggie','Batz','rosemarie74@hotmail.com','$2y$10$Vqb.92p2G8ReZPeLxTCQnew7YT.zURbCtlvrgW/V7rcjJy/O7Ja2C','0412345678',NULL,5,'Abdiel Mount','New Imashire','8307',NULL,'vip','1973-03-24 06:12:37','1996-04-06 10:37:27'),
(93,'Emil','Kuvalis','marietta.strosin@hotmail.com','$2y$10$Vqb.92p2G8ReZPeLxTCQnew7YT.zURbCtlvrgW/V7rcjJy/O7Ja2C','0412345678',NULL,7,'Pacocha Falls','Robelchester','6238',NULL,'vip','2004-01-28 09:15:01','2014-04-18 07:25:21'),
(94,'Mitchell','Gleason','tyrese78@yahoo.com','$2y$10$Vqb.92p2G8ReZPeLxTCQnew7YT.zURbCtlvrgW/V7rcjJy/O7Ja2C','0412345678',NULL,1,'Considine Circle','Mohammedborough','2811',NULL,'vip','2001-05-04 10:20:19','1993-01-31 09:56:45'),
(95,'Camren','Spinka','thiel.mariah@hotmail.com','$2y$10$Vqb.92p2G8ReZPeLxTCQnew7YT.zURbCtlvrgW/V7rcjJy/O7Ja2C','0412345678',NULL,5,'Klocko Springs','Swiftchester','6629',NULL,'vip','1998-04-10 06:24:16','1993-05-29 20:08:55'),
(96,'Audie','Murray','qmonahan@yahoo.com','$2y$10$Vqb.92p2G8ReZPeLxTCQnew7YT.zURbCtlvrgW/V7rcjJy/O7Ja2C','0412345678',NULL,7,'Berge Motorway','Lednerland','4206',NULL,'vip','1982-05-30 06:09:07','1976-01-30 01:58:22'),
(97,'Anjali','Tromp','icruickshank@gmail.com','$2y$10$Vqb.92p2G8ReZPeLxTCQnew7YT.zURbCtlvrgW/V7rcjJy/O7Ja2C','0412345678',NULL,4,'Reynolds Terrace','Leannafurt','4817',NULL,'vip','2002-07-30 23:55:51','2004-06-20 11:20:38'),
(98,'Velva','Bailey','iliana64@gmail.com','$2y$10$Vqb.92p2G8ReZPeLxTCQnew7YT.zURbCtlvrgW/V7rcjJy/O7Ja2C','0412345678',NULL,6,'Price Harbor','New Darius','4172',NULL,'vip','2019-11-28 13:11:21','2019-11-28 13:12:06'),
(99,'Maci','Huels','ijohnston@yahoo.com','$2y$10$Vqb.92p2G8ReZPeLxTCQnew7YT.zURbCtlvrgW/V7rcjJy/O7Ja2C','0412345678',NULL,8,'Hammes Stravenue','North Hardystad','7622',NULL,'vip','1993-01-08 13:52:05','2006-02-21 09:47:10'),
(100,'Lazaro','Bernier','pollich.kade@hotmail.com','$2y$10$Vqb.92p2G8ReZPeLxTCQnew7YT.zURbCtlvrgW/V7rcjJy/O7Ja2C','0412345678',NULL,5,'Maye Path','Terryton','1547',NULL,'vip','1980-05-11 17:02:48','1976-12-17 15:30:29'),
(101,'Alejandra','Hilll','bertram72@hotmail.com','$2y$10$Vqb.92p2G8ReZPeLxTCQnew7YT.zURbCtlvrgW/V7rcjJy/O7Ja2C','0412345678',NULL,8,'Tromp Keys','Kozeychester','9680',NULL,'vip','1998-06-03 20:55:22','1988-07-10 12:05:06'),
(102,'Ada','Wolf','adolphus.carroll@gmail.com','$2y$10$Vqb.92p2G8ReZPeLxTCQnew7YT.zURbCtlvrgW/V7rcjJy/O7Ja2C','0412345678',NULL,1,'Hirthe Station','Weimannside','9557',NULL,'vip','2006-10-18 14:05:15','1988-02-11 18:58:43'),
(103,'Cordia','Ward','eerdman@hotmail.com','$2y$10$Vqb.92p2G8ReZPeLxTCQnew7YT.zURbCtlvrgW/V7rcjJy/O7Ja2C','0412345678',NULL,8,'Paula Glen','Osinskimouth','6803',NULL,'vip','2019-11-28 13:12:18','2019-11-28 13:12:44'),
(104,'Paula','Runte','dlittle@gmail.com','$2y$10$Vqb.92p2G8ReZPeLxTCQnew7YT.zURbCtlvrgW/V7rcjJy/O7Ja2C','0412345678',NULL,2,'Georgette Club','New Aldenville','9742',NULL,'vip','2000-09-22 22:56:35','1988-10-17 03:48:01'),
(105,'Haylie','Wolff','ivolkman@gmail.com','$2y$10$Vqb.92p2G8ReZPeLxTCQnew7YT.zURbCtlvrgW/V7rcjJy/O7Ja2C','0412345678',NULL,9,'Beatty Square','South Jackstad','3117',NULL,'vip','2000-08-04 04:52:28','1977-04-14 21:55:10'),
(106,'Maverick','Bartoletti','uluettgen@yahoo.com','$2y$10$Vqb.92p2G8ReZPeLxTCQnew7YT.zURbCtlvrgW/V7rcjJy/O7Ja2C','0412345678',NULL,8,'Renner Landing','Port Berniece','2782',NULL,'vip','2012-03-27 03:12:52','1975-09-10 13:13:18'),
(107,'Caleigh','Schamberger','cordell.goldner@hotmail.com','$2y$10$Vqb.92p2G8ReZPeLxTCQnew7YT.zURbCtlvrgW/V7rcjJy/O7Ja2C','0412345678',NULL,7,'Emmerich Expressway','West Bell','8733',NULL,'vip','1978-09-08 11:41:06','1978-12-22 05:26:52');

/*Table structure for table `events` */

DROP TABLE IF EXISTS `events`;

CREATE TABLE `events` (
  `event_id` int(1) NOT NULL AUTO_INCREMENT,
  `planner_id` int(1) DEFAULT NULL,
  `venue_id` int(1) DEFAULT NULL,
  `event_name` varchar(40) DEFAULT NULL,
  `start_date` date DEFAULT NULL,
  `duration_days` int(1) DEFAULT NULL,
  `event_info` text,
  `start_time` time DEFAULT NULL,
  `end_time` time DEFAULT NULL,
  `level1price` decimal(5,2) DEFAULT NULL,
  `level2price` decimal(5,2) DEFAULT NULL,
  `level3price` decimal(5,2) DEFAULT NULL,
  `category_id` int(1) DEFAULT NULL,
  `event_poster` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`event_id`),
  KEY `category_id` (`category_id`),
  KEY `planner_id` (`planner_id`),
  KEY `venue_id` (`venue_id`),
  CONSTRAINT `events_ibfk_1` FOREIGN KEY (`category_id`) REFERENCES `category` (`category_id`),
  CONSTRAINT `events_ibfk_2` FOREIGN KEY (`planner_id`) REFERENCES `planners` (`planner_id`),
  CONSTRAINT `events_ibfk_3` FOREIGN KEY (`venue_id`) REFERENCES `venues` (`venue_id`)
) ENGINE=InnoDB AUTO_INCREMENT=40 DEFAULT CHARSET=latin1;

/*Data for the table `events` */

insert  into `events`(`event_id`,`planner_id`,`venue_id`,`event_name`,`start_date`,`duration_days`,`event_info`,`start_time`,`end_time`,`level1price`,`level2price`,`level3price`,`category_id`,`event_poster`) values 
(6,5,5,'Qantas Air Show','2020-01-02',1,'Australia\'s best annual airshow, and situated right on Sydney\'s doorstep.\r\n\r\nSee jaw-dropping aerobatics, relive the past with a spectacular display of classic warbirds and amazing vintage aircraft of yesteryear. Be inspired by the Australian Defence Force as they present the best Australia has to offer.\r\n\r\nLoud, fast jets and formation flying will delight and provide you with an unforgettable experience as they perform breath-taking manoeuvres above the beautiful Illawarra.\r\n\r\nEnjoy a joy flight in a helicopter before immersing yourself in history as you wander through rare displays of vintage and classic aircraft including the fully-restored 1955 Super Constellation and the history making Qantas 747 VH-OJA.','11:00:00','16:00:00',50.00,25.00,12.50,2,'img/uploads/ep_Qantas Air Show_5dc2689983c6b.gif'),
(7,6,4,'Santa\'s Magical Kingdom','2019-11-23',1,'The magic of Christmas comes alive at Santa\'s Magical Kingdom! Lasting memories of fun, laughter, and special family time will be remembered by guests long after the event has come to a close. Santa\'s Magical Kingdom is for every child and the inner child in all of us.','10:00:00','13:00:00',40.00,20.00,10.00,2,'/img/uploads/event_Santa\'s_Magical_Kingdom_5dccc23b09972.jpg'),
(8,7,4,'CATS The Musical','2019-12-24',1,'The classic musical, reimagined into an extravaganza of modern musical theatre, with awe-inspiring choreography and FUN for all ages!\r\n\r\nFrom the producers of \'We Will Rock Youâ€™, â€˜Jesus Christ Superstarâ€™ and \'The Diments\' comes the next biggest production to hit WA â€“ Andrew Lloyd Webberâ€™s classic \'CATS\'â€¦ but not as you know it. \r\n\r\nGone are the leotards and leg warmers, but the tale remains the same. Based on the universally popular poetry of T.S. Eliot, CATS tells the story of the annual gathering of Jellicle cats at which time one special cat is selected to ascend to the Heaviside layer. \r\n\r\nA true musical theatre phenomenon, CATS has enjoyed successful runs at iconic venues such as Broadwayâ€™s Winter Garden and Englandâ€™s New Long Theatre, with the classic tunes like â€˜Memoryâ€™, â€˜Skimblshanks the Railway Catâ€™, â€˜Macavityâ€™ and â€˜Mr. Mistoffoleesâ€™ loved by young and old.','19:30:00','22:00:00',65.00,32.50,16.25,1,'/img/uploads/event_CATS_The_Musical_5dccc41690033.jpg'),
(9,7,4,'Cirque du Soleil','2019-11-28',1,'Cirque du Soleil will bring its newest creation to Australia: KURIOS â€“ Cabinet of Curiosities\r\n\r\nIn an alternate yet familiar past, in a place where wonders abound for those who trust their imagination, a Seeker discovers that in order to glimpse the marvels that lie just below the surface, we must first learn to close our eyes. In his larger-than-life curio cabinet, the Seeker is convinced that there exists a hidden world â€“ a place where the craziest ideas and the grandest dreams await.','16:00:00','20:00:00',96.00,48.00,24.00,4,'/img/uploads/event_Cirque_du_Soleil_5dccc37de2a55.jpg'),
(10,5,10,'Lea Salonga in Concert','2019-12-22',1,'TonyÂ® and Olivier Award-winning Broadway star and Disney legend Lea Salonga, returns to Australia following her 2017 sold out tour. \r\n\r\nKnown for her powerhouse vocals and perfect pitch, Lea will wow audiences once again with Broadway hits and movie greats, including Les MisÃ©rables, Miss Saigon, Aladdin, Frozen and The Greatest Showman. Her vocal flair will be matched with an orchestra under the baton of Gerard Salonga.','20:00:00','23:00:00',75.00,37.50,18.75,3,'/img/uploads/event_Lea_Salonga_in_Concert_5dccc4cf0a7cf.jpg'),
(11,6,7,'Christmas Wonderland Sydney','2019-12-18',1,'Snow is forecast for Sydney, this December, at Christmas Wonderland Sydney. Get a taste of winter in Santa\'s Snow House. The Christmas extravaganza will fill families with Christmas cheer as they discover spectacular snow, magical Christmas worlds and colourful carnival rides. Flashing festive lights, unlimited family friendly rides, Santa\'s Village, craft activities, stage shows and much, much more! Kids under 5yrs will love Santa\'s Playground and Inflatable World, complete with ball-pit and soft play building blocks and ride-ons. Of course, it wouldn\'t be Christmas without Santa. Kids will have the opportunity to visit Santa and all his friends. There will be numerous enchanting worlds to explore, Santa\'s Magical stage shows, a \"new for 2019\" Activity Trail and lots more, all included in entry fee. Food, beverage, novelties and Santa photos available for an extra charge','16:00:00','22:00:00',51.00,25.50,12.75,2,'/img/uploads/event_Christmas_Wonderland_Sydney_5dccc5e1a5bec.jpg'),
(12,5,10,'Marty Sheargold','2019-12-16',1,'Marty Sheargold tours his stand up show around Australia for a night of must see comedy. Donâ€™t miss the opportunity to laugh live with the star of the Nova networks Kate, Tim and Marty show, as he delivers a load of jokes and stories he canâ€™t do between 4 and 6pm! If youâ€™ve seen him on ch 10s Have You Been Paying Attention? and want more, book now, donâ€™t disappoint him, yourself or his property broker by missing out.','18:00:00','21:00:00',40.00,20.00,10.00,6,'img/uploads/event_Marty_Sheargold_5dccc7ec7a394.jpg'),
(13,5,8,'Arj Barker - We Need To Talk','2019-11-27',1,'Hey, you got a hour? Look, I\'ve been doing a sh*t-ton of thinking about...us, and where we\'re headed. This isn\'t easy, but I need to be 100% honest with you, even if what I say makes you laugh, very, very hard. You had better sit down for this...\r\n\r\nAustralia\'s adopted son of comedy returns with his brand new show \'We Need To Talk\'.\r\n\r\n\"A must see for anyone who loves a laugh...\" - Adelaide Now\r\n\r\n\"On-point delivery and irresistible charm, it\'s clear to see why he continues to sell out.\" - Herald Sun','17:00:00','21:30:00',45.00,22.50,11.25,6,'/img/uploads/event_Arj_Barker_-_We_Need_To_Talk_5dcccc889b1ea.jpg'),
(17,7,4,'The Midnight Gang','2019-12-10',1,'Twelve year old Tom unexpectedly finds himself lonely and lost in the children\'s ward of Lord Funt Hospital, away from his family and at the mercy of evil Matron. Tom feels like he\'ll never leave, but his fellow young patients have other ideas. They might be stuck in hospital, but their imaginations can take them anywhere as The Midnight Gang. Each night when the clock strikes midnight, The Midnight Gang go on a series of amazing journeys as they turn the hospital into the places they\'ve always wanted to go and make dreams come true.\r\nFor children 6+ and their families.','10:00:00','12:00:00',39.00,19.50,9.75,2,'/img/uploads/event_The_Midnight_Gang_5dccc14526518.jpg'),
(18,8,5,'Blue Festival','2019-01-30',2,'Step into another world as the City Botanic Gardens transforms into Fire Gardens with leaping flames, firey sculptures and displays â€“ or head to Arcadia in South Bank to experience River of Light, a light-and-laser show on the river that tells the untold story of Brisbane by the First Peoples. Itâ€™s free, and on three times a night.','19:00:00','22:00:00',52.00,26.00,13.00,2,'/img/uploads/event_Blue_Festival_5dcccd5f5e767.jpg'),
(21,7,7,'Cher','2020-01-01',1,'Often referred to as the \"Goddess of Pop\' Cher is more than just a singer. She is also a Grammy Award, Academy Award and Golden Globe-winning actress and artist. The talented singer began her musical career at the tender age of sixteen and went on to form the duo \"Sonny and Cher\" with Sonny Bono. In 1965, Cher released her debut solo album \"All I Really Want to Do\" and in 1966 she had her first live performance with Sonny Bono at the Hollywood Bowl in Los Angeles. In total, Cher has released an impressive twenty-five studio albums, three live albums and nine compilation albums since her start in the 60s. The talented singer-actress has completed six worldwide tours throughout North America, Europe, Australia and Asia. Her first solo concert tour, T ake Me Home Tour, debuted in 1979, and her last concert tour, Living Proof: The Farewell Tour, lasted from June 2002 until April 2005. In 2017, Cher headed to Vegas with the show Classic Cher, set within the expansive Park Theater\'s 5,200-seat Monte Carlo venue. Fans of Cher live and in concert note that her performances are filled with equal parts high-energy \"Believe\" moments and emotionally-charged romantic ballads along with multiple set and costume changes for an all-around impressive experience. Aside from her musical career, Cher has built an impressive career for herself as an actress, starring in the award-winning films Moonstruck and Silkwood. In 1988, she won the \"Best Actress in a Leading Role\" Academy Award for the film \"Moonstruck\" as well as the Golden Globe award.','18:00:00','23:00:00',90.00,45.00,22.50,1,'img/uploads/ep_Cher5dc2542d8d699.jpg'),
(25,5,4,'Edinburgh Air Show','2019-11-09',2,'The Air Show offers a rare opportunity for the people of Adelaide to visit the base and see some of the Australian Defence Forceâ€™s (ADF) most advanced military aircraft and technologies.\r\n\r\nAir Force Head of Air Shows, Air Commodore Christopher Sawade, said the Edinburgh Air Show will showcase a wide variety of fast jet, transport and rotary wing aircraft.','09:00:00','16:00:00',30.00,15.00,7.50,2,'/img/uploads/ep_Edinburgh Air Show_5dc26ed110887.jpg'),
(26,5,10,'Circus Rio Carnival','2019-11-14',1,'Circus Rio Carnival is an all-inclusive circus and rides experience. One ticket gives you 3 hours of sensational family entertainment. Rides are available at the end of the circus performance.','15:00:00','18:00:00',40.00,20.00,10.00,2,'/img/uploads/event_Circus_Rio_Carnival_5dccb4500f461.jpg'),
(27,6,8,'The Wiggles - Party Time','2019-11-16',1,'The Wiggles will explode onto stages with their brand-new Party Time! Big Show! all around Australia this November, December & February!\r\n\r\nThe Party Time! Big Show will feature your favourite songs such as \'Do the Propeller!\', \'E-M-M-A\', \'Hot Potato\' and \'Rock-a- Bye Your Bear\', & hits from the Party Time! Album.\r\n\r\nEmma, Lachy, Simon and Anthony will be joined by Dorothy the Dinosaur, Captain Feathersword, Henry the Octopus, Wags the Dog & Shirley Shawn the Unicorn!','10:00:00','13:00:00',36.00,18.00,9.00,2,'/img/uploads/event_The_Wiggles_-_Party_Time_5dccb69feaeb4.jpg'),
(28,7,10,'Monster Truck Rumble','2019-11-28',1,'Loadex Hires Monster Truck Rumble is back in 2020 at the Adelaide Showground, ONE NIGHT ONLY, Saturday February 8th 2020.\r\n\r\nAdelaideâ€™s home of Monster Trucks, is set to ignite with a massive show when the International drivers take on our Aussies.\r\n\r\nPit Party included in every ticket purchase to commence at 5.30, Everyone can get up close to our giants before the main event, take a happy snap meet our drivers and have your merchandise signed. Donâ€™t Miss The only family friendly alcohol-free International Monster Truck show coming to Adelaide Summer!\r\n\r\nMain Event Action Starts 7.00pm with a jam-packed night of Monster Truck Mayhem. Concluding with our explosive fireworks display.\r\n\r\nMonster Truck Rumble is a Family Friendly event with No Alcohol.','16:00:00','20:00:00',60.00,30.00,15.00,2,'/img/uploads/event_Monster_Truck_Rumble_5dccb76094fcd.jpg'),
(29,8,11,'Formula 1 Rolex Australian Grand Prix','2020-03-12',4,'Thereâ€™s more to the Formula 1Â® Rolex Australian Grand Prix than ever before.\r\n\r\nFour big days means four big ways to enjoy The One big motorsport event of the year. Each action-packed day is dedicated to an exciting and different aspect of the event, so thereâ€™s something new for every fan of the track for every day of Australiaâ€™s biggest motorsport event of the year.','10:00:00','16:00:00',40.00,20.00,10.00,7,'/img/uploads/event_Formula_1_Rolex_Australian_Grand_Prix_5dcf3910e40ad.jpg'),
(30,8,10,'DanceSport Championship Series','2019-12-15',3,'Experience the Glitz and Glamour as the stars of DanceSport kick up their heels at the annual 2019 Interflora Australian DanceSport Championship.\r\n\r\nThe competition will be fierce and the dancing HOT! as couples compete to take out the 2019 Australian titles & dance against the Worldâ€™s best in the WDSF World Open Standard and Latin.\r\n\r\nInternational DanceSport at its very best - You will not want to miss a beat!','09:00:00','16:00:00',74.00,37.00,18.50,4,'/img/uploads/event_DanceSport_Championship_Series_5ddcd89c8b3bb.jpg'),
(31,6,4,'What a Feeling','2019-12-10',2,'Come celebrate our Dance HQ class of 2019 as they present to you their annual showcase, â€˜What A Feelingâ€™. A show filled with eisteddfod routines, guest performances and surprise acts that will be one not to miss.â€™','00:00:00','21:00:00',60.00,30.00,15.00,4,'/img/uploads/event_What_a_Feeling_5ddcd931868e9.jpg'),
(32,7,5,'Monster Jam','2019-12-15',3,'Monster JamÂ® is the big leagues of motorsports competition, where 12,000-pound trucks and the world-class athletes who drive them tear up the dirt with gravity-defying feats. Engineered to perfection, the legendary Grave DiggerÂ®, Max-Dâ„¢, El Toro LocoÂ® and many more push all limits in Freestyle, Skills Challengeâ„¢ and Racing competitions. The Series Champion receives an automatic bid to the prestigious Monster Jam World FinalsÂ® to compete for the title of World Champion. This is full-throttle family fun. This. Is. Monster Jamâ„¢','19:00:00','23:00:00',80.00,40.00,20.00,7,'/img/uploads/event_Monster_Jam_5ddcda7bb9785.jpg'),
(33,5,10,'Katy Perry','2020-01-15',2,'Katy Perry, following the huge success of her #1 album â€˜Teenage Dream\', returns for arena shows in her first Australian tour since August 2009\'s â€˜Hello Katy\' tour.\r\nSince the sassy pop icon\'s 2008 breakthrough with the massive smash hit â€˜I Kissed A Girl\', Katy has continued to top charts around the world. Debut album â€˜One Of The Boys\', is also home to hit singles, â€˜Ur So Gay\', â€˜Hot N Cold\', â€˜Thinking of You\' and â€˜Waking Up In Vegas\'.','18:00:00','23:30:00',75.00,37.50,18.75,1,'/img/uploads/event_Katy_Perry_5ddcdb669756c.gif'),
(34,5,5,'Festival X','2020-01-01',1,'Summer never sounded so good. FESTIVAL X lands this November as the first major touring festival on the Australian summer music calendar and features the biggest superstars. The inaugural festival line-up features Aussie favourite and multiple Grammy, Billboard and Brit Award winner, the inimitable CALVIN HARRIS, plus a range of Grammy, Billboard and ARIA Award winning artists, currently performing on the biggest international stages and festivals across the world.','14:00:00','23:00:00',100.00,50.00,25.00,1,'/img/uploads/event_Festival_X_5ddcdbf790929.jpg'),
(35,7,4,'Vienna Pops','2019-12-11',3,'The recent star of Phantom of the Opera in Londonâ€™s West End, Perthâ€™s own Amy Manford, will join Music Director Mark Coughlan and the Vienna Pops Orchestra to fill the Perth Concert Hall with glorious and uplifting music to welcome in the New Year as we count down to 2020.\r\n\r\nThe net proceeds of all funds raised will go towards Rotary Club of Perth charitable projects including supporting at risk youth through our Passages Resource Centre and funding medical research through Perkins Institute of Medical Research.','04:00:00','21:00:00',45.00,22.50,11.25,3,'/img/uploads/event_Vienna_Pops_5ddcdcbd1c734.jpg'),
(36,5,8,'Yundi Li','2019-12-02',2,'Internationally acclaimed pianist YUNDI LI tends to attract hyperbolic headlines wherever he performs. In 2018, he will head to Australia & New Zealand for his first-ever concert tour in this October 2018.\r\n\r\nYUNDI was propelled onto the international stage when he won first prize at the XIV Chopin International Piano Competition at the age of 18, becoming the youngest and first Chinese winner in the history of the renowned competition. Since then, he has been regarded as an international piano star, also a leading exponent of Chopinâ€™s music. He later became one of the youngest jurors in the 17th International Fryderyk Chopin Piano Competition in 2015. In recognition of his contribution to Polish culture, the Government of Poland presented a Gold Medal for Merit to Culture â€˜Gloria Artisâ€™ to YUNDI in 2010.\r\n\r\nYUNDI has released fifteen CDs worldwide on Deutsche Grammophon and EMI Classics. In 2003 the album Liszt won the German Echo Album solo award, the Netherlands Edison Award, the Chinese Gold Record Award and the New York Times â€˜Annual Recommendationâ€™. In 2007, he became the first Chinese pianist to record live with the Berliner Philharmoniker and Seiji Ozawa. This Deutsche Grammophon disc met with rave reviews and was named â€˜Editorâ€™s Choiceâ€™ by Gramophone magazine.','18:00:00','23:00:00',120.00,60.00,30.00,3,'/img/uploads/event_Yundi_Li_5ddcdd4a6d381.jpg'),
(37,5,5,'Emirates Australian Open','2019-12-05',3,'The Emirates Australian Open is Australasiaâ€™s premier professional golf tournament. The event was first staged in 1904, and has subsequently seen a wide range of famous golfing names compete for the Stonehaven Cup. Don\'t miss an impressive line-up of Australian and International golfers and join them on the course as they battle it out for the most esteemed trophy in Australian golf, the Stonehaven Cup.','09:00:00','15:00:00',110.00,55.00,27.50,5,'/img/uploads/event_Emirates_Australian_Open_5ddcde0b0fa62.jpg'),
(38,8,5,'ICC T20 WORLD CUP','2020-06-15',3,'The biggest cricket stadium in the world, the Melbourne Cricket Ground, will host the Final of the ICC Menâ€™s T20 World Cup. Secure your seat now to witness history as the two best teams from the T20 format\'s showpiece event meet under lights on Sunday, 15 November.\r\n\r\nFew could forget the 2016 final, where Carlos Brathwaite hit the first four balls of Ben Stokes\' final over for consecutive sixes to seal a dramatic win for the West Indies. Hosts Australia have never won the event, but on home soil will be looking to repeat celebrations from the 50-over Cricket World Cup in 2015 when over 90,000 fans saw Michael Clarke\'s team lift the trophy at the MCG. The eyes of the cricket world will be watching so don\'t miss out on this rare opportunity to be a part of a spectacular event that will bring the curtain down on an incredible celebration of T20 cricket.','10:00:00','16:00:00',62.00,31.00,15.50,5,'/img/uploads/event_ICC_T20_WORLD_CUP_5ddcdea68f485.jpg'),
(39,7,5,'Sydney FC v Brisbane Roar FC','2019-12-07',2,'Sydney FC will be seeking retribution when Robbie Fowlerâ€™s Brisbane Roar arrive at the Netstrata Jubilee Stadium for this Saturday night showdown.\r\n\r\nThe Roar produced a shock win to knock the Sky Blues out of the FFA Cup earlier in the season.\r\n\r\nAnd a team packed with the talents of Milos Ninkovic and Adam Le Fondre are primed for a revenge mission when the Queenslanders return for a Hyundai A-League showdown.\r\n\r\nDonâ€™t miss this grudge match. Book your tickets now!','16:00:00','20:00:00',60.00,30.00,15.00,5,'/img/uploads/event_Sydney_FC_v_Brisbane_Roar_FC_5ddcdf77d1bea.jpg');

/*Table structure for table `orders` */

DROP TABLE IF EXISTS `orders`;

CREATE TABLE `orders` (
  `order_id` int(1) NOT NULL AUTO_INCREMENT,
  `customer_id` int(1) DEFAULT NULL,
  `order_date` date DEFAULT NULL,
  `ticket_quantity` int(1) DEFAULT NULL,
  `order_total` decimal(5,2) DEFAULT NULL,
  PRIMARY KEY (`order_id`),
  KEY `customer_id` (`customer_id`),
  CONSTRAINT `orders_ibfk_1` FOREIGN KEY (`customer_id`) REFERENCES `customers` (`customer_id`)
) ENGINE=InnoDB AUTO_INCREMENT=31 DEFAULT CHARSET=latin1;

/*Data for the table `orders` */

insert  into `orders`(`order_id`,`customer_id`,`order_date`,`ticket_quantity`,`order_total`) values 
(3,1,'2019-11-10',3,135.00),
(4,1,'2019-11-10',2,18.00),
(5,1,'2019-11-10',1,0.45),
(6,1,'2019-11-11',3,135.00),
(7,98,'2019-11-28',2,64.80),
(8,98,'2019-11-28',1,18.00),
(9,103,'2019-11-28',3,108.00),
(10,103,'2019-11-28',2,108.00),
(11,85,'2019-11-28',5,225.00),
(12,85,'2019-11-28',3,162.00),
(13,85,'2019-11-28',7,472.50),
(14,69,'2019-11-28',2,192.00),
(15,69,'2019-11-28',4,208.00),
(16,69,'2019-11-28',2,150.00),
(17,58,'2019-11-28',2,220.00),
(18,58,'2019-11-28',4,148.00),
(19,15,'2019-12-03',2,150.00),
(20,15,'2019-12-03',5,600.00),
(21,15,'2019-12-03',3,120.00),
(22,21,'2019-12-03',4,248.00),
(23,21,'2019-12-03',3,117.00),
(24,27,'2019-12-03',4,320.00),
(25,27,'2019-12-03',2,90.00),
(26,27,'2019-12-03',6,180.00),
(27,34,'2019-12-03',3,156.00),
(28,34,'2019-12-03',4,144.00),
(29,34,'2019-12-03',2,120.00),
(30,10,'2019-12-04',1,40.00);

/*Table structure for table `passwordreset` */

DROP TABLE IF EXISTS `passwordreset`;

CREATE TABLE `passwordreset` (
  `customer_id` int(1) NOT NULL,
  `reset_code` varchar(6) NOT NULL,
  PRIMARY KEY (`customer_id`,`reset_code`),
  CONSTRAINT `passwordreset_ibfk_1` FOREIGN KEY (`customer_id`) REFERENCES `customers` (`customer_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `passwordreset` */

insert  into `passwordreset`(`customer_id`,`reset_code`) values 
(2,'EYNUXB');

/*Table structure for table `planners` */

DROP TABLE IF EXISTS `planners`;

CREATE TABLE `planners` (
  `planner_id` int(1) NOT NULL AUTO_INCREMENT,
  `company_name` varchar(40) DEFAULT NULL,
  `website` varchar(40) DEFAULT NULL,
  `phone` varchar(10) DEFAULT NULL,
  `email` varchar(50) DEFAULT NULL,
  `street_no` int(1) DEFAULT NULL,
  `street` varchar(40) DEFAULT NULL,
  `suburb` varchar(40) DEFAULT NULL,
  `postcode` varbinary(4) DEFAULT NULL,
  `state` varchar(3) DEFAULT NULL,
  PRIMARY KEY (`planner_id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=latin1;

/*Data for the table `planners` */

insert  into `planners`(`planner_id`,`company_name`,`website`,`phone`,`email`,`street_no`,`street`,`suburb`,`postcode`,`state`) values 
(5,'EventZen','eventzen.com.au','9785412344','info@eventzen.com.au',15,'Dale St','Liverpool','2173','nsw'),
(6,'Angora Media','angoramedia.com.au','0431455875','info@angoramedia.com.au',1,'Golden grove st','Newtown','2001','nsw'),
(7,'Blueberry Events','blueberryevents.com.au','0437139425','info@blueberryevents.com.au',42,'Pomona Rd','Empire Bay','2257','nsw'),
(8,'ID Events Australia','www.ideventsaustralia.com','9965434311','info@idevents.com.au',26,'Pirrama Road','Pyrmont','2009','nsw');

/*Table structure for table `staff` */

DROP TABLE IF EXISTS `staff`;

CREATE TABLE `staff` (
  `staff_id` int(1) NOT NULL AUTO_INCREMENT,
  `username` varchar(20) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `first_name` varchar(20) DEFAULT NULL,
  `last_name` varchar(20) DEFAULT NULL,
  `phone` varchar(10) DEFAULT NULL,
  `email` varchar(50) DEFAULT NULL,
  `unit` varchar(5) DEFAULT NULL,
  `street_no` int(1) DEFAULT NULL,
  `street` varchar(40) DEFAULT NULL,
  `suburb` varchar(20) DEFAULT NULL,
  `postcode` varchar(4) DEFAULT NULL,
  `state` varchar(3) DEFAULT NULL,
  `role` varchar(40) DEFAULT NULL,
  `hire_date` date DEFAULT NULL,
  `login` datetime DEFAULT NULL,
  `logout` datetime DEFAULT NULL,
  PRIMARY KEY (`staff_id`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=latin1;

/*Data for the table `staff` */

insert  into `staff`(`staff_id`,`username`,`password`,`first_name`,`last_name`,`phone`,`email`,`unit`,`street_no`,`street`,`suburb`,`postcode`,`state`,`role`,`hire_date`,`login`,`logout`) values 
(1,'amy.white',NULL,'Amy','White','0412345674','amy.w@gmail.com','8',50,'Pen St','Yagoona','2184','nsw','CEO','2019-01-11',NULL,NULL),
(2,'trace.houng',NULL,'Trace','Houng','0412345674','trace.h@gmail.com','',77,'Benny Street','CAMENA','7316','tas','Sales & Marketing Manager','2018-03-10',NULL,NULL),
(3,'ahmad.el-issa',NULL,'Ahmad','El-Issa','0412345674','ahmad.el-issa@gmail.com','',65,'Boughtman Street','BAYSWATER','3153','vic','Information Technology Director','2017-09-04',NULL,NULL),
(4,'joseph.hung',NULL,'Joseph','Hung Yen','0412345674','joseph.hung@gmail.com','',8,'Cherokee Road','Bradford','3463','vic','Business Analyst','2018-07-20',NULL,NULL),
(5,'lelia.doolan',NULL,'Lelia','Doolan','0412345674','lelia.doolan@gmail.com','',56,'McDowall Street','SURRY HILLS','2010','nsw','Office Manager','2018-09-10',NULL,NULL),
(6,'kevin.chen',NULL,'Kevin','Chen','0412345674','kevin.chen@gmail.com','',50,'Stanley Drive','GLEN ISLA','3463','qld','Art Director','2019-05-06',NULL,NULL),
(8,'admin','$2y$10$8Bctxv4Fq21G.atulDHAg.eLX71a6JA2HYiARWAGYhpes9zkeO2WC','Ibrahim','Elwadia','0412345674','ibrahim.e2020@gmail.com','',76,'Banksia Court','QUEENTON','4820','qld','Administrator','2019-01-01','2019-12-04 10:26:57','2019-12-04 11:16:42'),
(9,'barry.andrews','$2y$10$fZMHKQPMD7RaO0G8eTTFA.vOoMGK.gT.X1fJIWmV1jfnLBcdeyOFa','Barry','Andrews','0412345679','barry.andrews@gmail.com','',45,'Bayview Road','RUDALL','5642','sa','Technical Specialist','2015-03-09',NULL,NULL),
(10,'sarah.zambelli','$2y$10$.G4s/ixVa8UOyHn5LQmSDuLkGDn5d7TdkRSe1VFQW0hY/dkssbcqS','Sarah','Zambelli','0412345678','sarah.zambelli@gmail.com','',34,'Kerma Crescent','RYDAL','2790','nsw','Business Process Analyst','2018-06-25',NULL,NULL);

/*Table structure for table `tickets` */

DROP TABLE IF EXISTS `tickets`;

CREATE TABLE `tickets` (
  `ticket_id` int(1) NOT NULL AUTO_INCREMENT,
  `order_id` int(1) DEFAULT NULL,
  `event_id` int(1) DEFAULT NULL,
  `price` decimal(5,2) DEFAULT NULL,
  `seat_level` int(1) DEFAULT NULL,
  `seat_row` int(1) DEFAULT NULL,
  `seat_no` int(1) DEFAULT NULL,
  PRIMARY KEY (`ticket_id`),
  KEY `event_id` (`event_id`),
  KEY `order_id` (`order_id`),
  CONSTRAINT `tickets_ibfk_1` FOREIGN KEY (`event_id`) REFERENCES `events` (`event_id`),
  CONSTRAINT `tickets_ibfk_2` FOREIGN KEY (`order_id`) REFERENCES `orders` (`order_id`)
) ENGINE=InnoDB AUTO_INCREMENT=89 DEFAULT CHARSET=latin1;

/*Data for the table `tickets` */

insert  into `tickets`(`ticket_id`,`order_id`,`event_id`,`price`,`seat_level`,`seat_row`,`seat_no`) values 
(4,3,6,50.00,4,29,706),
(5,3,6,50.00,4,29,706),
(6,3,6,50.00,4,29,706),
(7,4,7,10.00,3,19,62),
(8,4,7,10.00,3,19,63),
(9,5,21,1.00,2,39,584),
(10,6,6,50.00,1,45,124),
(11,6,6,50.00,1,45,125),
(12,6,6,50.00,1,45,126),
(13,7,27,36.00,2,17,758),
(14,7,27,36.00,2,17,759),
(15,8,29,20.00,4,36,293),
(16,9,12,40.00,4,4,459),
(17,9,12,40.00,4,4,460),
(18,9,12,40.00,4,4,461),
(19,10,31,60.00,1,38,173),
(20,10,31,60.00,1,38,174),
(21,11,6,50.00,5,12,71),
(22,11,6,50.00,5,12,72),
(23,11,6,50.00,5,12,73),
(24,11,6,50.00,5,12,74),
(25,11,6,50.00,5,12,75),
(26,12,39,60.00,5,14,16),
(27,12,39,60.00,5,14,17),
(28,12,39,60.00,5,14,18),
(29,13,33,75.00,2,57,62),
(30,13,33,75.00,2,57,63),
(31,13,33,75.00,2,57,64),
(32,13,33,75.00,2,57,65),
(33,13,33,75.00,2,57,66),
(34,13,33,75.00,2,57,67),
(35,13,33,75.00,2,57,68),
(36,14,9,96.00,5,3,30),
(37,14,9,96.00,5,3,31),
(38,15,18,52.00,4,24,315),
(39,15,18,52.00,4,24,316),
(40,15,18,52.00,4,24,317),
(41,15,18,52.00,4,24,318),
(42,16,10,75.00,5,16,587),
(43,16,10,75.00,5,16,588),
(44,17,37,110.00,2,31,94),
(45,17,37,110.00,2,31,95),
(46,18,30,37.00,3,2,757),
(47,18,30,37.00,3,2,758),
(48,18,30,37.00,3,2,759),
(49,18,30,37.00,3,2,760),
(50,19,10,75.00,3,32,428),
(51,19,10,75.00,3,32,429),
(52,20,36,120.00,4,35,440),
(53,20,36,120.00,4,35,441),
(54,20,36,120.00,4,35,442),
(55,20,36,120.00,4,35,443),
(56,20,36,120.00,4,35,444),
(57,21,12,40.00,5,15,564),
(58,21,12,40.00,5,15,565),
(59,21,12,40.00,5,15,566),
(60,22,38,62.00,4,2,81),
(61,22,38,62.00,4,2,82),
(62,22,38,62.00,4,2,83),
(63,22,38,62.00,4,2,84),
(64,23,17,39.00,5,47,16),
(65,23,17,39.00,5,47,17),
(66,23,17,39.00,5,47,18),
(67,24,32,80.00,5,26,72),
(68,24,32,80.00,5,26,73),
(69,24,32,80.00,5,26,74),
(70,24,32,80.00,5,26,75),
(71,25,21,45.00,2,3,655),
(72,25,21,45.00,2,3,656),
(73,26,25,30.00,2,39,372),
(74,26,25,30.00,2,39,373),
(75,26,25,30.00,2,39,374),
(76,26,25,30.00,2,39,375),
(77,26,25,30.00,2,39,376),
(78,26,25,30.00,2,39,377),
(79,27,18,52.00,1,7,585),
(80,27,18,52.00,1,7,586),
(81,27,18,52.00,1,7,587),
(82,28,27,36.00,5,4,82),
(83,28,27,36.00,5,4,83),
(84,28,27,36.00,5,4,84),
(85,28,27,36.00,5,4,85),
(86,29,31,60.00,2,16,660),
(87,29,31,60.00,2,16,661),
(88,30,7,40.00,2,11,317);

/*Table structure for table `venues` */

DROP TABLE IF EXISTS `venues`;

CREATE TABLE `venues` (
  `venue_id` int(1) NOT NULL AUTO_INCREMENT,
  `venue_name` varchar(40) DEFAULT NULL,
  `no_seats` int(1) DEFAULT NULL,
  `capacity` int(1) DEFAULT NULL,
  `seat_map` varchar(255) DEFAULT NULL,
  `street_no` varchar(5) DEFAULT NULL,
  `street` varchar(40) DEFAULT NULL,
  `suburb` varchar(40) DEFAULT NULL,
  `postcode` varchar(4) DEFAULT NULL,
  `state` varchar(3) DEFAULT NULL,
  `venue_photo` varchar(255) DEFAULT NULL,
  `venue_info` text,
  PRIMARY KEY (`venue_id`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=latin1;

/*Data for the table `venues` */

insert  into `venues`(`venue_id`,`venue_name`,`no_seats`,`capacity`,`seat_map`,`street_no`,`street`,`suburb`,`postcode`,`state`,`venue_photo`,`venue_info`) values 
(1,'Mount Panorama Circuit',0,20000,'/img/uploads/sm_Bathurst_Race_Track_5dcbab8c9ae80.png','','','Bathurst','2693','nsw','/img/uploads/vp_Bathurst_Race_Track_5dcbab49c026e.jpg','Mount Panorama Circuit is a motor racing track located in Bathurst, New South Wales, Australia. It is situated on a hill with the dual official names of Mount Panorama and Wahluu and is best known as the home of the Bathurst 1000 motor race held each October, and the Bathurst 12 Hour event held each February. The track is 6.213 km (3.861 mi) in length, and is technically a street circuit, and is a public road, with normal speed restrictions when no racing events are being run, and there are many residences which can only be accessed from the circuit.\r\n\r\nThe track has an unusual design by modern standards, with a 174-metre (571 ft) vertical difference between its highest and lowest points, and grades as steep as 1:6.13. From the start-finish line, the track can be viewed in three sections; the short pit straight and then a tight left turn into the long, steep Mountain straight; the tight, narrow section across the top of the mountain itself; and then the long, downhill section of Conrod Straight, with the very fast Chase and the turn back onto pit straight to complete the lap.'),
(4,'Rao National Theatre',500,500,'/img/uploads/sm_Rao_National_Theatre_5dcbacc86cd0e.png','','','Sydney','2000','nsw','/img/uploads/vp_Rao_National_Theatre_5dcbacc873395.jpg','Rao National Theatre is a performing arts venue located in the Southbank region of Melbourne, Victoria. It is the principal home of the Melbourne Theatre Company. The theatre was designed by ARM Architecture (Ashton Raggatt McDougall), and opened in January 2009 with a production of Poor Boy starring Guy Pearce.\r\n\r\nThe theatre is adjacent to the Melbourne Recital Centre venue on Southbank Boulevard, with the two buildings constructed simultaneously. The distinctive geometric shapes on the theatre\'s facade were inspired by the paintings of the American abstract expressionist artist Al Held.\r\n\r\nThe theatre contains two performance spaces: the 559-seat \"Sumner\", and the smaller \"Lawler\" with 150 seats. These were named after director John Sumner and playwright Ray Lawler respectively. The theatre is also home to Script Bar & Bistro, function rooms and foyers and two foyer bars.'),
(5,'Marzouk Sport Stadium',80000,80000,'/img/uploads/map_Marzouk_Sport_Stadium_5dcbb926c903c.gif','','','Melbourne','3000','vic','/img/uploads/venue_Marzouk_Sport_Stadium_5dcbb6edeb2bb.jpg','Marzouk Sport Stadium is a multi-purpose stadium located in the Sydney Olympic Park, in Sydney, Australia. The stadium was completed in March 1999 at a cost of A$690 million to host the 2000 Summer Olympics. The Stadium was leased by a private company the Stadium Australia Group until the Stadium was sold back to the NSW Government on 1 June 2016 after NSW Premier Michael Baird announced the Stadium was to be redeveloped as a world-class rectangular stadium. The Stadium is owned by Venues NSW on behalf of the NSW Government.\r\n\r\nThe stadium was originally built to hold 110,000 spectators, making it the largest Olympic Stadium ever built and the second largest stadium in Australia after the Melbourne Cricket Ground which held more than 120,000 before its re-design in the early 2000s. In 2003, reconfiguration work was completed to shorten the north and south wings, and install movable seating. These changes reduced the capacity to 83,500 for a rectangular field and 82,500 for an oval field. Awnings were also added over the north and south stands, allowing most of the seating to be under cover. The stadium was engineered along sustainable lines, e.g., utilising less steel in the roof structure than the Olympic stadiums of Athens and Beijing.'),
(7,'Chen Science Museum',0,200,'/img/uploads/map_Chen_Science_Museum_5dcbb8ff5ca91.png','','','Canberra','8000','act','/img/uploads/venue_Chen_Science_Museum_5dcbb34cbdee7.jpg','The Chen Science Museum is the major branch of the Museum of Applied Arts & Sciences in Sydney, the other being the historic Sydney Observatory. Although often described as a science museum, the Powerhouse has a diverse collection encompassing all sorts of technology including decorative arts, science, communication, transport, costume, furniture, media, computer technology, space technology and steam engines.\r\n\r\nIt has existed in various guises for over 125 years, and is home to some 400,000 artifacts, many of which are displayed or housed at the site it has occupied since 1988, and for which it is named â€“ a converted electric tram power station in the Inner West suburb of Ultimo, originally constructed in 1902. It is well known, and a popular Sydney tourist destination.'),
(8,'Li Mai Business Exhibition Centre',10000,10000,'/img/uploads/map_Li_Mai_Business_Exhibition_Centre_5dcbb915c3617.png','','','Brisbane','7000','qld','/img/uploads/venue_Li_Mai_Business_Exhibition_Centre_5dcbb60b5d7d0.jpg','Situated at the intersection of Sydneyâ€™s academic, cultural and technology precincts, Li Mai Business Exhibition Centre affords delegates, exhibitors and visitors convenient access to Australiaâ€™s most cosmopolitan city. The emerging financial, dining and retail precinct of Barangaroo is nearby; there are numerous galleries, theatres and concert halls within easy reach; and the bustling city centre is only a short walk away.\r\n\r\nManaged by a uniquely talented team, Li Mai Business Exhibition Centre is well placed to deliver extraordinary experiences every time. Whether you are organising a convention for thousands or a more intimate corporate event, our team will go out of their way to deliver a truly memorable event.\r\n\r\nBut Li Mai Business Exhibition Centre is more than a landmark venue. Li Mai Business Exhibition Centre functions as an incubator for ideas, a champion of change and an advocate for community. Through our Legacy Program, we give clients the opportunity to contribute to the cityâ€™s cultural capitalâ€”and advance the social and sustainability objectives of their eventsâ€”in real and meaningful ways.'),
(9,'Alwarez Art Museum',0,2000,'/img/uploads/sm_Alwarez_Art_Museum_5dcba7b6e1c0c.png','','','Alice Springs','9001','nt','/img/uploads/vp_Alwarez_Art_Museum_5dcba7b6e8ac0.jpg','Welcome to the Alwarez Art Museum, Australiaâ€™s leading museum dedicated to exhibiting, collecting and interpreting the work of todayâ€™s artists.\r\n\r\nWe celebrate the work of living artists, bringing exceptional exhibitions of international and Australian art to as many people as possible â€“ welcoming over a million visitors each year â€“ in the belief that art is for everyone.\r\n\r\nOur vision is to make contemporary art and ideas widely accessible to a range of audiences through the presentation of a diverse program of exhibitions and special events, both onsite and offsite. From major thematic exhibitions and solo surveys of established artists, to new work by emerging artists, touring exhibitions and community-led projects through C3West, we strive to cover the range and diversity of contemporary art.\r\n\r\nLocated on one of the worldâ€™s most spectacular sites on the edge of Sydney Harbour, the MCA stands on a land of immense cultural and historical significance to the traditional owners of this place, the Gadigal people of the Eora Nation. The wonderful artwork Warrang by Brook Andrew, situated at the entrance of the Museum on Circular Quay, helps to inform visitors of the relevance of our site.'),
(10,'Batra Entertainment Centre',60000,60000,'/img/uploads/map_Batra_Entertainment_Centre_5dcbb8dfd2a87.jpg','','','Perth','5000','wa','/img/uploads/venue_Batra_Entertainment_Centre_5dcbb2d87800d.jpg','This venue provides a truly intimate theatre experience. The Theatre features state of the art audio visual equipment and acoustic treatments. With a capacity of up to 3,000 people, the Theatre is fully self-contained with its own loading bay, production offices, dressing rooms and catering facilities; enabling the Batra Entertainment Centre to offer extraordinary facilities at reduced hire rates. The Theatre boasts a â€˜plug and playâ€™ VDosc sound system, and a rigging system that enables equipment to be rigged from the floor and moved up, down, forward and backwards via remote control over the length of the entire venue. Adding to its incredible flexibility, the Theatre also features motorised retractable tiered seating so that it is ideal for fully reserve seated and GA shows, or a mix of both. The Theatre is suited to contemporary live concerts, theatre productions, musicals, comedy and family entertainment for audiences from 500 to 3,000. It is also popular for conferences, exhibitions and trade shows.\r\n\r\n This is by far the best Theatre for concertgoers, artists, promoters and production crews in Australia'),
(11,'Albert Park Grand Prix Circuit',20000,20000,'/img/uploads/map_Albert_Park_Grand_Prix_Circuit_5dcf504661bc0.gif','','','Albert Park','3496','vic','/img/uploads/venue_Albert_Park_Grand_Prix_Circuit_5dcf3cad0b6d1.jpg','The Melbourne Grand Prix Circuit is a street circuit around Albert Park Lake, only a few kilometres south of central Melbourne. It is used annually as a racetrack for the Formula One Australian Grand Prix, Supercars Championship Melbourne 400 and associated support races. The circuit has an FIA Grade 1 licence.[3] Although the entire track consists of normally public roads, each sector includes medium to high speed characteristics more commonly associated with dedicated racetracks facilitated by grass and gravel run-off safety zones that are reconstructed annually.');

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
