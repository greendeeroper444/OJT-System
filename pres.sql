-- MySQL dump 10.13  Distrib 8.0.40, for Linux (x86_64)
--
-- Host: localhost    Database: pres
-- ------------------------------------------------------
-- Server version	8.0.40-0ubuntu0.22.04.1

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!50503 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `request_photo`
--

DROP TABLE IF EXISTS `request_photo`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `request_photo` (
  `r_id` int NOT NULL AUTO_INCREMENT,
  `r_type` varchar(255) DEFAULT 'PHOTO',
  `r_activityname` varchar(255) NOT NULL,
  `r_durationStart` varchar(255) NOT NULL,
  `r_durationEnd` varchar(255) NOT NULL,
  `r_purpose` varchar(255) NOT NULL,
  PRIMARY KEY (`r_id`)
) ENGINE=InnoDB AUTO_INCREMENT=19 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `request_photo`
--

LOCK TABLES `request_photo` WRITE;
/*!40000 ALTER TABLE `request_photo` DISABLE KEYS */;
/*!40000 ALTER TABLE `request_photo` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `request_pio`
--

DROP TABLE IF EXISTS `request_pio`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `request_pio` (
  `r_id` int NOT NULL AUTO_INCREMENT,
  `r_type` varchar(255) DEFAULT 'PIO',
  `r_activityname` varchar(255) NOT NULL,
  `r_durationStart` varchar(255) NOT NULL,
  `r_durationEnd` varchar(255) NOT NULL,
  `r_venue` varchar(255) NOT NULL,
  `r_highlights` varchar(255) DEFAULT NULL,
  `r_participants` varchar(255) NOT NULL,
  `r_keyofficials` varchar(255) NOT NULL,
  `r_additionalInfo` longtext,
  `r_services` longtext NOT NULL,
  `r_platforms` longtext NOT NULL,
  `r_attachements` longtext,
  `r_request_code` varchar(255) NOT NULL,
  PRIMARY KEY (`r_id`)
) ENGINE=InnoDB AUTO_INCREMENT=95 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `request_pio`
--

LOCK TABLES `request_pio` WRITE;
/*!40000 ALTER TABLE `request_pio` DISABLE KEYS */;
INSERT INTO `request_pio` VALUES (82,'PIO','test','1720540800','1720799940','test','test','test','test','This is a link\r\n\r\n\r\n\r\nhttps://ph.indeed.com/?r=us','[\"On-site Documentation\",\"Article Drafting\"]','[\"College Website: dnsc.edu.ph\",\"Facebook: @officialDNSC\"]','[]','DNSC-PIO-2024-172'),(83,'PIO','5-Day Faculty Capability Training','1724112000','1725267600','DNSC Gymnasium','L&D','210 Faculty','Please see attached program','','[\"On-site Documentation\",\"Article Drafting\"]','[\"Facebook: @officialDNSC\"]','[\"jcODPdQ4WBgUp0O$-$-$5-day Faculty Capability Training.pdf\"]','DNSC-PIO-2024-173'),(84,'PIO','DNSC TALENTFEST 2024 IN CELEBRATION OF THE 124th PCSA','1725379200','1726847940','DNSC Gymnasium','None','All Employees','Please see attached program','','[\"On-site Documentation\",\"Article Drafting\"]','[\"Facebook: @officialDNSC\"]','[\"UJLJ2hIH3oxS8Z0$-$-$14A_PCSA and Teambuilding.docx\"]','DNSC-PIO-2024-174'),(85,'PIO','CALLING FOR Batch II CASH FOR WORK BENEFICIARIES','','','NA','','DNSC GRADUATES(2020-2024)','NA','','[\"Graphics and Content Design\"]','[\"College Website: dnsc.edu.ph\",\"Facebook: @officialDNSC\"]','[]','DNSC-PIO-2024-175'),(86,'PIO','CALLING FOR Batch II CASH FOR WORK BENEFICIARIES','1725897600','1726847940','NA','NA','DNSC GRADUATES(2020-2024)','NA','','[\"Graphics and Content Design\"]','[\"College Website: dnsc.edu.ph\",\"Facebook: @officialDNSC\"]','[\"6fVafLJkjgcsSK7$-$-$2ND BATCH ANNOUNCEMENT.docx\"]','DNSC-PIO-2024-176'),(87,'PIO','Mental Health Awareness 2024 ','1729062000','1729069200','Academic Building 1st to 4th Floor','','Understanding the Self Enrolled Students and Other Interested Students','Guidance Personnel, Medical-Dental Personnel and  Social Science Faculties','Link for Pre-Registration: https://tinyurl.com/Pre-RegistrationFormMHA2024','[\"On-site Documentation\",\"Article Drafting\",\"Graphics and Content Design\"]','[\"College Website: dnsc.edu.ph\",\"Facebook: @officialDNSC\"]','[]','DNSC-PIO-2024-177'),(88,'PIO','Mental Health Awareness 2024 \"Striking the Balance: Academic Success and Mental Health\"','1729062000','1729069200','Academic Building 1st to 4th Floor','','Understanding the Self Enrolled Students and Other Interested Students','Guidance Personnel, Medical-Dental Personnel and  Social Science Faculties','Pre-Registration Link: https://tinyurl.com/Pre-RegistrationFormMHA2024','[\"On-site Documentation\",\"Article Drafting\",\"Graphics and Content Design\"]','[\"College Website: dnsc.edu.ph\",\"Facebook: @officialDNSC\"]','[\"JKUisLJculqycoB$-$-$MHA Pre-Reg QR.png\"]','DNSC-PIO-2024-178'),(89,'PIO','COURSE FAIR 2024 ACTIVITY','1729612800','1729871940','DNSC GYMNASIUM','','GRADE 12 STUDENTS','SIGFRED B. JORGE AND SHARMINE P. NOGAN','Interested applicants may fill out this form\r\n\r\n*https://tinyurl.com/COURSE-FAIR-2024-REG-FORM\r\n\r\n\r\n\r\n*Requesting all participants to wear Complete School Uniform and School ID\r\n\r\n*Remind the participants for No Single Use Plastics\r\n* Remind participants to bring umbrella\r\n\r\n\r\n\r\n\r\n\r\n','[\"On-site Documentation\",\"Article Drafting\",\"Graphics and Content Design\"]','[\"College Website: dnsc.edu.ph\",\"Facebook: @officialDNSC\"]','[\"6YOB10gYmQPsSDA$-$-$COURSE FAIR 1.png\",\"mIGtKz3y2CHAvyF$-$-$COURSE FAIR 2.png\",\"NDlsJVXZewfqgAp$-$-$COURSE FAIR 3.png\",\"HTkNZuew3j3qgwA$-$-$COURSE FAIR FRONT (3).png\"]','DNSC-PIO-2024-179'),(90,'PIO','Focused Group Discussion conducted by DBM Central Office-IAS','1729562400','1729612740','GAD Conference Room','Back Draft for the GAD Conference Room LED Wall','7 internal auditors from DBM CO, 1 DBM-ROXI Personnel, 22 Personnel from DNSC','DBM Central Office IAS','','[\"Graphics and Content Design\"]','[\"No Required Plaftorm\"]','[]','DNSC-PIO-2024-180'),(91,'PIO','Focused Group Discussion conducted by DBM Central Office-IAS','1729562400','1729612740','GAD Conference Room','On-site Documentation for the mentioned event','7 internal auditors from DBM CO, 1 DBM-ROXI Personnel, 22 Personnel from DNSC','DBM Central Office IAS','','[\"On-site Documentation\"]','[\"College Website: dnsc.edu.ph\",\"Facebook: @officialDNSC\"]','[]','DNSC-PIO-2024-181'),(92,'PIO','CASH FOR WORK PROGRAM APPLICATION FOR BATCH 3','1731024000','1732438800','DNSC-JPO','N/A','DNSC ALUMNI','N/A','','[\"On-site Documentation\",\"Article Drafting\",\"Graphics and Content Design\",\"Content Updating on the College Website\"]','[\"College Website: dnsc.edu.ph\",\"Facebook: @officialDNSC\"]','[\"3MW3mEUGND9umkJ$-$-$3rd Batch.docx\"]','DNSC-PIO-2024-182'),(93,'PIO','Popcorn Day - A Movie Date - Melody 1963: Love Has to Win ','1732086000','1732093200','Sports Complex','include that the participants will bring their own picnic MAT','Interested or Invited Students','N/A','Activity Design Link:  https://drive.google.com/file/d/1HJcchEuUUDTJ-2ifYu6JotQkirb0xdgL/view?usp=drive_link\r\n\r\n\r\n\r\n-dili po ko maka upload file since magfailed.\r\n-TIME: 3-5:00 PM .. sa request po pagsave kay mag8am to 8pm','[\"On-site Documentation\",\"Article Drafting\",\"Graphics and Content Design\",\"Content Updating on the College Website\"]','[\"College Website: dnsc.edu.ph\",\"Facebook: @officialDNSC\"]','[]','DNSC-PIO-2024-183'),(94,'PIO','CASH FOR WORK PROGRAM CULMINATION ACTIVITY','1731974400','1731988800','DNSC GYMNASIUM','NA','DNSC CFW BENEFICIARIES (STUDENTS)','NA','','[\"On-site Documentation\",\"Article Drafting\",\"Graphics and Content Design\"]','[\"College Website: dnsc.edu.ph\",\"Facebook: @officialDNSC\"]','[]','DNSC-PIO-2024-184');
/*!40000 ALTER TABLE `request_pio` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `request_posting`
--

DROP TABLE IF EXISTS `request_posting`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `request_posting` (
  `r_id` int NOT NULL AUTO_INCREMENT,
  `r_type` varchar(255) DEFAULT 'POSTING',
  `r_title` varchar(255) NOT NULL,
  `r_content` varchar(255) NOT NULL,
  `r_attachements` longtext,
  `r_platforms` text NOT NULL,
  `r_link` varchar(255) NOT NULL,
  PRIMARY KEY (`r_id`)
) ENGINE=InnoDB AUTO_INCREMENT=36 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `request_posting`
--

LOCK TABLES `request_posting` WRITE;
/*!40000 ALTER TABLE `request_posting` DISABLE KEYS */;
INSERT INTO `request_posting` VALUES (35,'POSTING','Popcorn Day - A Movie Date - Melody 1963: Love Has to Win \"A Bully Proof Campaign: Celebrate Differences, Embrace Similarities\"','To promote accepting individual differences and prevent bullying cases within the campus.&#10&#10&#10&#10Date of event: November 20, 2024&#10&#10Time: 3 - 5:00 PM&#10&#10Venue: Sports Complex','[]','[\"Facebook: @officialDNSC\"]','https://drive.google.com/file/d/1HJcchEuUUDTJ-2ifYu6JotQkirb0xdgL/view?usp=drive_link');
/*!40000 ALTER TABLE `request_posting` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `transaction`
--

DROP TABLE IF EXISTS `transaction`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `transaction` (
  `t_id` int NOT NULL AUTO_INCREMENT,
  `t_userID` int NOT NULL,
  `t_r_id` int NOT NULL,
  `t_r_type` varchar(255) NOT NULL,
  `t_status` int NOT NULL COMMENT '1 - completed\r\n2 - approved\r\n3 - pending\r\n4 - cancelled\r\n5 - Declined\r\n',
  `t_output_status` varchar(255) DEFAULT 'For Admin Approval' COMMENT '1 - approved by client\r\n2 - for review\r\n3 - for revisions',
  `t_messageResponse` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin,
  `t_adminAttachements` longtext,
  `t_clientReponse` varchar(255) DEFAULT NULL,
  `t_datetimerequested` varchar(255) NOT NULL,
  `t_datemodified` varchar(255) DEFAULT NULL,
  `t_datecompleted` varchar(255) DEFAULT NULL,
  `t_viewedAdmin` varchar(255) DEFAULT NULL,
  `t_viewedClient` varchar(255) DEFAULT NULL,
  `t_declineDetails` varchar(255) DEFAULT NULL,
  `t_forceCompleteDetails` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`t_id`)
) ENGINE=InnoDB AUTO_INCREMENT=129 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `transaction`
--

LOCK TABLES `transaction` WRITE;
/*!40000 ALTER TABLE `transaction` DISABLE KEYS */;
INSERT INTO `transaction` VALUES (116,7,82,'PIO',1,'Forced Completed',NULL,NULL,NULL,'1720728685','1720728741','1720728741','Yes','Yes','null','Test Reason\r\n'),(117,10,83,'PIO',1,'Forced Completed','{\"conversation\":[{\"identifier\":\"PIO Office\",\"text\":\"https:\\/\\/dnsc.edu.ph\\/2024-faculty-capability-building-series-to-cover-foundation-ethics-and-innovative-teaching-approaches\\/\",\"time\":1725940052,\"attachement\":\"[]\"}]}',NULL,NULL,'1724052444','1725940166','1725940166','Yes',NULL,'null','Already posted in the college website and fb page.'),(118,10,84,'PIO',1,'Forced Completed',NULL,NULL,NULL,'1725414341','1729495905','1729495905','Yes',NULL,'null',''),(119,13,86,'PIO',1,'Forced Completed','{\"conversation\":[{\"identifier\":\"PIO Office\",\"text\":\"https:\\/\\/www.facebook.com\\/photo\\/?fbid=841728714776933&set=a.580217840928023\",\"time\":1727231177,\"attachement\":\"[\\\"RBqztu2LPWUhSoC$-$-$CFW3.jpg\\\"]\"}]}',NULL,NULL,'1725953103','1727231211','1727231211','Yes','Yes','null',''),(120,319,87,'PIO',4,'Request Has been Cancelled',NULL,NULL,NULL,'1728270026','1728281027',NULL,'Yes','Yes','null','null'),(121,319,88,'PIO',1,'Forced Completed','{\"conversation\":[{\"identifier\":\"PIO Office\",\"text\":\"https:\\/\\/www.facebook.com\\/share\\/p\\/NJcofRJxX8EYBPpF\\/\",\"time\":1729496019,\"attachement\":\"[]\"}]}',NULL,NULL,'1728282260','1729496037','1729496037','Yes','Yes','null',''),(122,13,89,'PIO',1,'Forced Completed',NULL,NULL,NULL,'1728887370','1731907430','1731907430','Yes','Yes','null',''),(123,887,90,'PIO',2,'No Output',NULL,NULL,NULL,'1729496756','1729497075',NULL,'Yes',NULL,'null','null'),(124,887,91,'PIO',2,'No Output',NULL,NULL,NULL,'1729558512','1729559899',NULL,'Yes',NULL,'null','null'),(125,319,92,'PIO',2,'No Output',NULL,NULL,NULL,'1729579212','1730179417',NULL,'Yes','Yes','null','null'),(126,319,93,'PIO',2,'No Output',NULL,NULL,NULL,'1731545877','1731547220',NULL,'Yes','Yes','null','null'),(127,13,94,'PIO',2,'No Output',NULL,NULL,NULL,'1731633325','1731633773',NULL,'Yes',NULL,'null','null'),(128,319,35,'POSTING',1,'Request Completed',NULL,NULL,NULL,'1731651796','1731918080',NULL,'Yes','Yes','null','null');
/*!40000 ALTER TABLE `transaction` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `user`
--

DROP TABLE IF EXISTS `user`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `user` (
  `user_id` int NOT NULL AUTO_INCREMENT,
  `user_fn` varchar(255) NOT NULL,
  `user_mn` varchar(255) NOT NULL,
  `user_ln` varchar(255) NOT NULL,
  `user_office` varchar(255) NOT NULL,
  `user_position` varchar(255) NOT NULL,
  `user_email` varchar(255) NOT NULL,
  `user_password` varchar(30) NOT NULL,
  `pass_hash` varchar(64) NOT NULL,
  `hash_salt` varchar(64) NOT NULL,
  `user_type` int NOT NULL COMMENT '1 - admin\r\n2 - requestor',
  `user_status` int NOT NULL COMMENT '1 - approved\r\n2 - pending\r\n3 - declined',
  `user_date_created` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `user_contact` varchar(255) NOT NULL,
  PRIMARY KEY (`user_id`)
) ENGINE=InnoDB AUTO_INCREMENT=888 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `user`
--

LOCK TABLES `user` WRITE;
/*!40000 ALTER TABLE `user` DISABLE KEYS */;
INSERT INTO `user` VALUES (7,'Jumarr ','N/A','Buladaco','PIO','Information Officer II','juma@dnsc.edu.ph','mozilla22','4ff222136845a194716300b6b773e81b667209a353d9d452fa7df301a62cac0d','cace11bdbcac89ee8c0c87a77d4babc4c7de283bdd0a9d57713902fa6f7e0a57',2,1,'2024-06-10 11:26:42','0912345672'),(8,'Verzon Jay','Roble','Calipayan','PIO','Administrative Aide VI','verzonjay.calipayan@dnsc.edu.ph','Dnsc1234++','00ed3cc72a01e510ed69042694a878a0d052f558120726690bc623347ac05088','bd6cbcab49c0f51bfb12695486165d88f69f6ccd70a4d81506511568af3a691d',1,1,'2024-06-10 11:32:04','09854654242'),(9,'Ian','S. ','Somosot','Other','Coordinator','ian.somosot@dnsc.edu.ph','Dnsc12345','4c79939ef30b01bfd6c5db02a1ad75b1d59ded9f68cd0ae003c246f036b37eb5','d211e2b07e3e92311bab6ae582de1177f8f5b616f361ada633220e57a597d880',2,1,'2024-06-24 14:48:44','08980107557'),(10,'Nestle Joy','R','Arguilla','Other','HRMOII','nestlejoy.arguilla@dnsc.edu.ph','1994nEst**0119Le','839dd5d10aa1ea2c50be91b516549eb9b278816c7f88c9ce337c9de4a3e189dc','32fc8a23d9753851e93bca8ce87fb617db302c6471104bf8f785a23e5218fa91',2,1,'2024-06-25 16:04:07','09329691550'),(11,'ARNOLD','M','DUPING','Other','Dean','arnold.duping@dnsc.edu.ph','aissaplasabas1978','934a3c26e19dfe4524797ff7141117875313479c6563154168c10512f7f86ed4','0276988be686f3dda8a72b57e31c279a279f5244ee75be8234d3276db540332f',2,1,'2024-06-26 10:21:40','09637472972'),(12,'Christian Paolo','Apale','Mora','Other','Project Development Officer II','c.mora@dnsc.edu.ph','12qwaszx,.','2159cd370d79a5e6dff40c5a0789cae5e43c4eb3117ac0a4a476e0219b9c1b9b','b6ddefc300795e02ae682390e2b6fae941e9d6a10bddbb54193d3e7abbc78c5d',2,1,'2024-07-29 19:55:34','09913523939'),(13,'Kimverly','Badal','Idlao','Other','Job Placement Office Staff','jpo@dnsc.edu.ph','dnscjpo2024','adc41ed1f6db5a16362c42c46b5eabee6522b4a43afa0021220bf8ad219fe389','1bfd7abc73f148a4ee69a868683197424e5a5a4f0f8df99ca8ba627849750a29',2,1,'2024-09-10 11:50:09','09382423226'),(318,'Flordelyn','N/A','Bastasa','Other','Staff','guidance@dnsc.edu.ph','guidancePIO24','92eca27cab42d93014926c5179f3fa8c9e5035097a64944f11f91dbf6cbda39e','f6927e4b5c396d3329dec6ca566c52b5a5d49c54a7b25482f4b425b535a6ef7f',2,1,'2024-09-25 09:47:10','09994790738'),(319,'Flordelyn','Florito','Bastasa','Other','Staff','guidancednsc@gmail.com','PReS2024++','56f2b1ed2962faa82e9671e097fe6483e11e26793cbaee068794cab6c9513a6b','f388167697c31404c6f73530dd19a7e3d6423ce6b2d607cfd1516373708535cd',2,1,'2024-10-07 10:47:32','09994790738'),(887,'Anjenel','Monda','Davin','Other','Admin Officer IV','anjenel.davin@dnsc.edu.ph','adavinonel','70b43d7b1fb3f838e2aacc9783b8f43e065e285016559249d411357ba88efa52','9f60541277669d3420727c0a80b9c6e4aea7c4a09198991bcbc484557e873410',2,1,'2024-10-21 15:19:34','09301830449');
/*!40000 ALTER TABLE `user` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2024-11-20 12:30:58
