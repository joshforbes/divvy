# ************************************************************
# Divvy Database
# With example projects and users
# 
# email: mike@smith.com
# password: 123456
# 
# email: mary@jones.com
# password: 123456
# 
# As you will recall all users can be either admins or members, depending 
# on the project.  So mike is an admin of the "explore divvy" default 
# project that everyone gets.  And then I used mary to create another 
# project and invite mike to it, so that you can see the member view.  
# The difference is in what they can see on the project overview page.  
# Admins get the full picture - project completion percent, add/remove 
# project members, project activity log, add/remove/edit tasks.  
# Project members can access that same overview page, but their view
# consists of only the tasks that are assigned to them.  If you login with Mike, 
# view the 'prepare for presentation' project , and then login with Mary
# and view the same project you will see the difference.
# 
# Note - these accounts only work with this test database. On the live
# server simply register for an account and, as with all new users, you 
# will be bootstrapped an sample project that you are an admin of, to 
# play in.
# 
# ************************************************************


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;


# Dump of table activity
# ------------------------------------------------------------

DROP TABLE IF EXISTS `activity`;

CREATE TABLE `activity` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `action` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `subject_type` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `subject_id` int(11) NOT NULL,
  `user_id` int(10) unsigned NOT NULL,
  `project_id` int(10) unsigned NOT NULL,
  `task_id` int(10) unsigned DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`),
  KEY `activity_project_id_foreign` (`project_id`),
  CONSTRAINT `activity_project_id_foreign` FOREIGN KEY (`project_id`) REFERENCES `projects` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

LOCK TABLES `activity` WRITE;
/*!40000 ALTER TABLE `activity` DISABLE KEYS */;

INSERT INTO `activity` (`id`, `action`, `subject_type`, `subject_id`, `user_id`, `project_id`, `task_id`, `created_at`, `updated_at`)
VALUES
	(1,'add_task','App\\Task',1,1,1,1,'2015-05-05 11:43:17','2015-05-05 11:43:17'),
	(2,'add_subtask','App\\Subtask',1,1,1,1,'2015-05-05 11:43:18','2015-05-05 11:43:18'),
	(3,'add_subtask','App\\Subtask',2,3,1,1,'2015-05-05 11:43:19','2015-05-05 11:43:19'),
	(4,'add_subtask','App\\Subtask',3,1,1,1,'2015-05-05 11:43:20','2015-05-05 11:43:20'),
	(5,'add_subtask','App\\Subtask',4,2,1,1,'2015-05-05 11:43:22','2015-05-05 11:43:22'),
	(6,'start_discussion','App\\Discussion',1,3,1,1,'2015-05-05 11:43:23','2015-05-05 11:43:23'),
	(7,'add_task','App\\Task',2,1,1,2,'2015-05-05 11:43:24','2015-05-05 11:43:24'),
	(8,'start_discussion','App\\Discussion',2,3,1,2,'2015-05-05 11:43:25','2015-05-05 11:43:25'),
	(9,'add_task','App\\Task',3,1,2,3,'2015-05-05 11:43:44','2015-05-05 11:43:44'),
	(10,'add_subtask','App\\Subtask',5,1,2,3,'2015-05-05 11:43:45','2015-05-05 11:43:45'),
	(11,'add_subtask','App\\Subtask',6,3,2,3,'2015-05-05 11:43:46','2015-05-05 11:43:46'),
	(12,'add_subtask','App\\Subtask',7,1,2,3,'2015-05-05 11:43:48','2015-05-05 11:43:48'),
	(13,'add_subtask','App\\Subtask',8,2,2,3,'2015-05-05 11:43:49','2015-05-05 11:43:49'),
	(14,'start_discussion','App\\Discussion',3,3,2,3,'2015-05-05 11:43:50','2015-05-05 11:43:50'),
	(15,'add_task','App\\Task',4,1,2,4,'2015-05-05 11:43:51','2015-05-05 11:43:51'),
	(16,'start_discussion','App\\Discussion',4,3,2,4,'2015-05-05 11:43:52','2015-05-05 11:43:52'),
	(17,'reopen_task','App\\Task',4,5,2,4,'2015-05-05 11:46:52','2015-05-05 11:46:52'),
	(18,'modify_task','App\\Task',4,5,2,4,'2015-05-05 11:47:32','2015-05-05 11:47:32'),
	(19,'modify_task','App\\Task',3,5,2,3,'2015-05-05 11:47:51','2015-05-05 11:47:51'),
	(20,'remove_member','App\\User',2,5,2,NULL,'2015-05-05 11:48:02','2015-05-05 11:48:02'),
	(21,'remove_member','App\\User',1,5,2,NULL,'2015-05-05 11:48:04','2015-05-05 11:48:04'),
	(22,'add_member','App\\User',4,5,2,NULL,'2015-05-05 11:48:21','2015-05-05 11:48:21'),
	(23,'modify_task','App\\Task',3,5,2,3,'2015-05-05 11:48:36','2015-05-05 11:48:36'),
	(24,'modify_task','App\\Task',4,5,2,4,'2015-05-05 11:48:52','2015-05-05 11:48:52'),
	(25,'modify_subtask','App\\Subtask',8,5,2,3,'2015-05-05 11:49:14','2015-05-05 11:49:14'),
	(26,'modify_subtask','App\\Subtask',7,5,2,3,'2015-05-05 11:49:25','2015-05-05 11:49:25'),
	(27,'modify_subtask','App\\Subtask',6,5,2,3,'2015-05-05 11:49:33','2015-05-05 11:49:33'),
	(28,'modify_subtask','App\\Subtask',5,5,2,3,'2015-05-05 11:50:21','2015-05-05 11:50:21'),
	(29,'leave_comment_subtask','App\\Comment',1,4,2,3,'2015-05-05 11:52:13','2015-05-05 11:52:13'),
	(30,'modify_discussion','App\\Discussion',3,5,2,3,'2015-05-05 11:58:13','2015-05-05 11:58:13'),
	(31,'leave_comment_discussion','App\\Comment',2,5,2,3,'2015-05-05 12:04:19','2015-05-05 12:04:19'),
	(32,'complete_subtask','App\\Subtask',5,4,2,3,'2015-05-05 12:04:30','2015-05-05 12:04:30'),
	(33,'leave_comment_subtask','App\\Comment',3,4,2,3,'2015-05-05 12:05:05','2015-05-05 12:05:05'),
	(34,'leave_comment_subtask','App\\Comment',4,5,2,3,'2015-05-05 12:08:00','2015-05-05 12:08:00'),
	(35,'modify_discussion','App\\Discussion',4,5,2,4,'2015-05-05 12:09:27','2015-05-05 12:09:27'),
	(36,'add_subtask','App\\Subtask',9,4,2,4,'2015-05-05 12:09:47','2015-05-05 12:09:47'),
	(37,'add_subtask','App\\Subtask',10,4,2,4,'2015-05-05 12:10:03','2015-05-05 12:10:03'),
	(38,'add_subtask','App\\Subtask',11,4,2,4,'2015-05-05 12:10:13','2015-05-05 12:10:13');

/*!40000 ALTER TABLE `activity` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table attachments
# ------------------------------------------------------------

DROP TABLE IF EXISTS `attachments`;

CREATE TABLE `attachments` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `task_id` int(10) unsigned NOT NULL,
  `path` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`),
  KEY `attachments_task_id_foreign` (`task_id`),
  CONSTRAINT `attachments_task_id_foreign` FOREIGN KEY (`task_id`) REFERENCES `tasks` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;



# Dump of table comments
# ------------------------------------------------------------

DROP TABLE IF EXISTS `comments`;

CREATE TABLE `comments` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `body` text COLLATE utf8_unicode_ci NOT NULL,
  `user_id` int(10) unsigned NOT NULL,
  `commentable_id` int(11) NOT NULL,
  `commentable_type` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `comments_user_id_foreign` (`user_id`),
  CONSTRAINT `comments_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

LOCK TABLES `comments` WRITE;
/*!40000 ALTER TABLE `comments` DISABLE KEYS */;

INSERT INTO `comments` (`id`, `body`, `user_id`, `commentable_id`, `commentable_type`, `created_at`, `updated_at`, `deleted_at`)
VALUES
	(1,'Finished!',4,5,'App\\Subtask','2015-05-05 11:52:13','2015-05-05 11:52:13',NULL),
	(2,'Please let me know if you have any questions',5,3,'App\\Discussion','2015-05-05 12:04:19','2015-05-05 12:04:19',NULL),
	(3,'Tests are green - will run again before upload them mark as complete',4,6,'App\\Subtask','2015-05-05 12:05:05','2015-05-05 12:05:05',NULL),
	(4,'Sounds good, keep us updated',5,6,'App\\Subtask','2015-05-05 12:08:00','2015-05-05 12:08:00',NULL);

/*!40000 ALTER TABLE `comments` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table discussions
# ------------------------------------------------------------

DROP TABLE IF EXISTS `discussions`;

CREATE TABLE `discussions` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `body` text COLLATE utf8_unicode_ci,
  `user_id` int(10) unsigned NOT NULL,
  `task_id` int(10) unsigned NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `discussions_task_id_foreign` (`task_id`),
  KEY `discussions_user_id_foreign` (`user_id`),
  CONSTRAINT `discussions_task_id_foreign` FOREIGN KEY (`task_id`) REFERENCES `tasks` (`id`) ON DELETE CASCADE,
  CONSTRAINT `discussions_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

LOCK TABLES `discussions` WRITE;
/*!40000 ALTER TABLE `discussions` DISABLE KEYS */;

INSERT INTO `discussions` (`id`, `title`, `body`, `user_id`, `task_id`, `created_at`, `updated_at`, `deleted_at`)
VALUES
	(1,'Discussions allow Task members to collaborate','Any questions about what needs to be done? Discussions are the communication channel to figure out problems and come to solutions.',3,1,'2015-05-05 11:43:23','2015-05-05 11:43:23',NULL),
	(2,'A completed task still contains discussion and completed subtasks','These items become accessible again if the task is reopened. Members can pick up where they left off.',3,2,'2015-05-05 11:43:25','2015-05-05 11:43:25',NULL),
	(3,'Check Subtasks for a list of things to do','The items listed under subtasks are everything that needs to be finished before the captstone can be submitted. Please mark as complete as you go.',3,3,'2015-05-05 11:43:50','2015-05-05 11:58:13',NULL),
	(4,'In this task let\'s brainstorm things to talk about during the presentation','Go',3,4,'2015-05-05 11:43:52','2015-05-05 12:09:27',NULL);

/*!40000 ALTER TABLE `discussions` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table migrations
# ------------------------------------------------------------

DROP TABLE IF EXISTS `migrations`;

CREATE TABLE `migrations` (
  `migration` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

LOCK TABLES `migrations` WRITE;
/*!40000 ALTER TABLE `migrations` DISABLE KEYS */;

INSERT INTO `migrations` (`migration`, `batch`)
VALUES
	('2014_10_12_000000_create_users_table',1),
	('2014_10_12_100000_create_password_resets_table',1),
	('2015_02_05_002126_create_profiles_table',1),
	('2015_02_16_002407_create_projects_table',1),
	('2015_02_16_002917_create_tasks_table',1),
	('2015_02_16_003716_create_attachments_table',1),
	('2015_02_16_004848_create_project_user_table',1),
	('2015_02_16_004907_create_project_adminUser_table',1),
	('2015_02_26_001756_create_task_user_table',1),
	('2015_03_03_165004_create_subtasks_table',1),
	('2015_03_05_224129_create_discussions_table',1),
	('2015_03_06_123645_create_comments_table',1),
	('2015_03_14_133137_create_activity_table',1),
	('2015_03_22_102054_create_notifications_table',1);

/*!40000 ALTER TABLE `migrations` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table notifications
# ------------------------------------------------------------

DROP TABLE IF EXISTS `notifications`;

CREATE TABLE `notifications` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `action` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `read` tinyint(1) NOT NULL,
  `subject_type` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `subject_id` int(11) NOT NULL,
  `project_id` int(10) unsigned NOT NULL,
  `actor_id` int(10) unsigned NOT NULL,
  `user_id` int(10) unsigned NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`),
  KEY `notifications_user_id_foreign` (`user_id`),
  CONSTRAINT `notifications_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

LOCK TABLES `notifications` WRITE;
/*!40000 ALTER TABLE `notifications` DISABLE KEYS */;

INSERT INTO `notifications` (`id`, `action`, `read`, `subject_type`, `subject_id`, `project_id`, `actor_id`, `user_id`, `created_at`, `updated_at`)
VALUES
	(1,'add_task',0,'App\\Task',1,1,1,2,'2015-05-05 11:43:17','2015-05-05 11:43:17'),
	(2,'add_task',0,'App\\Task',1,1,1,3,'2015-05-05 11:43:17','2015-05-05 11:43:17'),
	(3,'add_task',1,'App\\Task',1,1,1,4,'2015-05-05 11:43:17','2015-05-05 11:48:42'),
	(4,'add_subtask',0,'App\\Subtask',1,1,1,2,'2015-05-05 11:43:18','2015-05-05 11:43:18'),
	(5,'add_subtask',0,'App\\Subtask',1,1,1,3,'2015-05-05 11:43:18','2015-05-05 11:43:18'),
	(6,'add_subtask',1,'App\\Subtask',1,1,1,4,'2015-05-05 11:43:18','2015-05-05 11:48:42'),
	(7,'add_subtask',0,'App\\Subtask',2,1,3,2,'2015-05-05 11:43:19','2015-05-05 11:43:19'),
	(8,'add_subtask',1,'App\\Subtask',2,1,3,4,'2015-05-05 11:43:19','2015-05-05 11:48:42'),
	(9,'add_subtask',0,'App\\Subtask',3,1,1,2,'2015-05-05 11:43:20','2015-05-05 11:43:20'),
	(10,'add_subtask',0,'App\\Subtask',3,1,1,3,'2015-05-05 11:43:20','2015-05-05 11:43:20'),
	(11,'add_subtask',1,'App\\Subtask',3,1,1,4,'2015-05-05 11:43:20','2015-05-05 11:48:42'),
	(12,'add_subtask',0,'App\\Subtask',4,1,2,3,'2015-05-05 11:43:22','2015-05-05 11:43:22'),
	(13,'add_subtask',1,'App\\Subtask',4,1,2,4,'2015-05-05 11:43:22','2015-05-05 11:48:42'),
	(14,'start_discussion',0,'App\\Discussion',1,1,3,2,'2015-05-05 11:43:23','2015-05-05 11:43:23'),
	(15,'start_discussion',1,'App\\Discussion',1,1,3,4,'2015-05-05 11:43:23','2015-05-05 11:48:42'),
	(16,'add_task',1,'App\\Task',2,1,1,4,'2015-05-05 11:43:24','2015-05-05 11:48:42'),
	(17,'add_task',0,'App\\Task',2,1,1,3,'2015-05-05 11:43:24','2015-05-05 11:43:24'),
	(18,'start_discussion',1,'App\\Discussion',2,1,3,4,'2015-05-05 11:43:25','2015-05-05 11:48:42'),
	(19,'add_task',0,'App\\Task',3,2,1,2,'2015-05-05 11:43:44','2015-05-05 11:43:44'),
	(20,'add_task',0,'App\\Task',3,2,1,3,'2015-05-05 11:43:44','2015-05-05 11:43:44'),
	(21,'add_task',0,'App\\Task',3,2,1,5,'2015-05-05 11:43:44','2015-05-05 11:43:44'),
	(22,'add_subtask',0,'App\\Subtask',5,2,1,2,'2015-05-05 11:43:45','2015-05-05 11:43:45'),
	(23,'add_subtask',0,'App\\Subtask',5,2,1,3,'2015-05-05 11:43:45','2015-05-05 11:43:45'),
	(24,'add_subtask',0,'App\\Subtask',5,2,1,5,'2015-05-05 11:43:45','2015-05-05 11:43:45'),
	(25,'add_subtask',0,'App\\Subtask',6,2,3,2,'2015-05-05 11:43:46','2015-05-05 11:43:46'),
	(26,'add_subtask',0,'App\\Subtask',6,2,3,5,'2015-05-05 11:43:46','2015-05-05 11:43:46'),
	(27,'add_subtask',0,'App\\Subtask',7,2,1,2,'2015-05-05 11:43:48','2015-05-05 11:43:48'),
	(28,'add_subtask',0,'App\\Subtask',7,2,1,3,'2015-05-05 11:43:48','2015-05-05 11:43:48'),
	(29,'add_subtask',0,'App\\Subtask',7,2,1,5,'2015-05-05 11:43:48','2015-05-05 11:43:48'),
	(30,'add_subtask',0,'App\\Subtask',8,2,2,3,'2015-05-05 11:43:49','2015-05-05 11:43:49'),
	(31,'add_subtask',0,'App\\Subtask',8,2,2,5,'2015-05-05 11:43:49','2015-05-05 11:43:49'),
	(32,'start_discussion',0,'App\\Discussion',3,2,3,2,'2015-05-05 11:43:50','2015-05-05 11:43:50'),
	(33,'start_discussion',0,'App\\Discussion',3,2,3,5,'2015-05-05 11:43:50','2015-05-05 11:43:50'),
	(34,'add_task',0,'App\\Task',4,2,1,5,'2015-05-05 11:43:51','2015-05-05 11:43:51'),
	(35,'add_task',0,'App\\Task',4,2,1,3,'2015-05-05 11:43:51','2015-05-05 11:43:51'),
	(36,'start_discussion',0,'App\\Discussion',4,2,3,5,'2015-05-05 11:43:52','2015-05-05 11:43:52'),
	(37,'modify_project',0,'App\\Project',2,2,5,1,'2015-05-05 11:46:26','2015-05-05 11:46:26'),
	(38,'modify_project',0,'App\\Project',2,2,5,2,'2015-05-05 11:46:26','2015-05-05 11:46:26'),
	(39,'modify_project',0,'App\\Project',2,2,5,3,'2015-05-05 11:46:26','2015-05-05 11:46:26'),
	(40,'reopen_task',0,'App\\Task',4,2,5,3,'2015-05-05 11:46:52','2015-05-05 11:46:52'),
	(41,'modify_task',0,'App\\Task',3,2,5,2,'2015-05-05 11:47:51','2015-05-05 11:47:51'),
	(42,'modify_task',0,'App\\Task',3,2,5,3,'2015-05-05 11:47:51','2015-05-05 11:47:51'),
	(43,'remove_member',0,'App\\User',2,2,5,2,'2015-05-05 11:48:02','2015-05-05 11:48:02'),
	(44,'remove_member',0,'App\\User',1,2,5,1,'2015-05-05 11:48:04','2015-05-05 11:48:04'),
	(45,'add_member',1,'App\\User',4,2,5,4,'2015-05-05 11:48:21','2015-05-05 11:48:42'),
	(46,'modify_task',0,'App\\Task',3,2,5,3,'2015-05-05 11:48:36','2015-05-05 11:48:36'),
	(47,'modify_task',1,'App\\Task',3,2,5,4,'2015-05-05 11:48:36','2015-05-05 11:48:42'),
	(48,'modify_task',0,'App\\Task',4,2,5,4,'2015-05-05 11:48:52','2015-05-05 11:48:52'),
	(49,'modify_subtask',0,'App\\Subtask',8,2,5,3,'2015-05-05 11:49:14','2015-05-05 11:49:14'),
	(50,'modify_subtask',0,'App\\Subtask',8,2,5,4,'2015-05-05 11:49:14','2015-05-05 11:49:14'),
	(51,'modify_subtask',0,'App\\Subtask',7,2,5,3,'2015-05-05 11:49:25','2015-05-05 11:49:25'),
	(52,'modify_subtask',0,'App\\Subtask',7,2,5,4,'2015-05-05 11:49:25','2015-05-05 11:49:25'),
	(53,'modify_subtask',0,'App\\Subtask',6,2,5,3,'2015-05-05 11:49:33','2015-05-05 11:49:33'),
	(54,'modify_subtask',0,'App\\Subtask',6,2,5,4,'2015-05-05 11:49:33','2015-05-05 11:49:33'),
	(55,'modify_subtask',0,'App\\Subtask',5,2,5,3,'2015-05-05 11:50:21','2015-05-05 11:50:21'),
	(56,'modify_subtask',0,'App\\Subtask',5,2,5,4,'2015-05-05 11:50:21','2015-05-05 11:50:21'),
	(57,'leave_comment_subtask',0,'App\\Comment',1,2,4,3,'2015-05-05 11:52:13','2015-05-05 11:52:13'),
	(58,'leave_comment_subtask',0,'App\\Comment',1,2,4,5,'2015-05-05 11:52:13','2015-05-05 11:52:13'),
	(59,'modify_discussion',0,'App\\Discussion',3,2,5,3,'2015-05-05 11:58:13','2015-05-05 11:58:13'),
	(60,'modify_discussion',0,'App\\Discussion',3,2,5,4,'2015-05-05 11:58:13','2015-05-05 11:58:13'),
	(61,'leave_comment_discussion',0,'App\\Comment',2,2,5,3,'2015-05-05 12:04:19','2015-05-05 12:04:19'),
	(62,'leave_comment_discussion',0,'App\\Comment',2,2,5,4,'2015-05-05 12:04:19','2015-05-05 12:04:19'),
	(63,'complete_subtask',0,'App\\Subtask',5,2,4,3,'2015-05-05 12:04:30','2015-05-05 12:04:30'),
	(64,'complete_subtask',0,'App\\Subtask',5,2,4,5,'2015-05-05 12:04:30','2015-05-05 12:04:30'),
	(65,'leave_comment_subtask',0,'App\\Comment',3,2,4,3,'2015-05-05 12:05:05','2015-05-05 12:05:05'),
	(66,'leave_comment_subtask',0,'App\\Comment',3,2,4,5,'2015-05-05 12:05:05','2015-05-05 12:05:05'),
	(67,'leave_comment_subtask',0,'App\\Comment',4,2,5,3,'2015-05-05 12:08:00','2015-05-05 12:08:00'),
	(68,'leave_comment_subtask',0,'App\\Comment',4,2,5,4,'2015-05-05 12:08:00','2015-05-05 12:08:00'),
	(69,'modify_discussion',0,'App\\Discussion',4,2,5,4,'2015-05-05 12:09:27','2015-05-05 12:09:27'),
	(70,'add_subtask',0,'App\\Subtask',9,2,4,5,'2015-05-05 12:09:47','2015-05-05 12:09:47'),
	(71,'add_subtask',0,'App\\Subtask',10,2,4,5,'2015-05-05 12:10:03','2015-05-05 12:10:03'),
	(72,'add_subtask',0,'App\\Subtask',11,2,4,5,'2015-05-05 12:10:13','2015-05-05 12:10:13');

/*!40000 ALTER TABLE `notifications` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table password_resets
# ------------------------------------------------------------

DROP TABLE IF EXISTS `password_resets`;

CREATE TABLE `password_resets` (
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  KEY `password_resets_email_index` (`email`),
  KEY `password_resets_token_index` (`token`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;



# Dump of table profiles
# ------------------------------------------------------------

DROP TABLE IF EXISTS `profiles`;

CREATE TABLE `profiles` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(10) unsigned NOT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `company` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `location` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `bio` text COLLATE utf8_unicode_ci,
  `avatar_path` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`),
  KEY `profiles_user_id_foreign` (`user_id`),
  CONSTRAINT `profiles_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

LOCK TABLES `profiles` WRITE;
/*!40000 ALTER TABLE `profiles` DISABLE KEYS */;

INSERT INTO `profiles` (`id`, `user_id`, `name`, `company`, `location`, `bio`, `avatar_path`, `created_at`, `updated_at`)
VALUES
	(1,1,'System','Divvy',NULL,NULL,'system.jpg','1994-12-13 00:00:00','2015-05-05 11:39:19'),
	(2,2,'John Doe','Divvy',NULL,NULL,'johndoe.jpg','1997-02-05 00:00:00','2015-05-05 11:39:19'),
	(3,3,'Jane Doe','Divvy',NULL,NULL,'janedoe.jpg','2003-01-03 00:00:00','2015-05-05 11:39:19'),
	(4,4,NULL,NULL,NULL,NULL,'5548ad2abffefjpg','2015-05-05 11:43:17','2015-05-05 11:44:42'),
	(5,5,NULL,NULL,NULL,NULL,'5548ad53172c1jpg','2015-05-05 11:43:44','2015-05-05 11:45:23');

/*!40000 ALTER TABLE `profiles` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table project_adminUser
# ------------------------------------------------------------

DROP TABLE IF EXISTS `project_adminUser`;

CREATE TABLE `project_adminUser` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `project_id` int(10) unsigned NOT NULL,
  `user_id` int(10) unsigned NOT NULL,
  PRIMARY KEY (`id`),
  KEY `project_adminuser_project_id_index` (`project_id`),
  KEY `project_adminuser_user_id_index` (`user_id`),
  CONSTRAINT `project_adminuser_project_id_foreign` FOREIGN KEY (`project_id`) REFERENCES `projects` (`id`) ON DELETE CASCADE,
  CONSTRAINT `project_adminuser_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

LOCK TABLES `project_adminUser` WRITE;
/*!40000 ALTER TABLE `project_adminUser` DISABLE KEYS */;

INSERT INTO `project_adminUser` (`id`, `project_id`, `user_id`)
VALUES
	(1,1,1),
	(2,1,4),
	(3,2,1),
	(4,2,5);

/*!40000 ALTER TABLE `project_adminUser` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table project_user
# ------------------------------------------------------------

DROP TABLE IF EXISTS `project_user`;

CREATE TABLE `project_user` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `project_id` int(10) unsigned NOT NULL,
  `user_id` int(10) unsigned NOT NULL,
  PRIMARY KEY (`id`),
  KEY `project_user_project_id_index` (`project_id`),
  KEY `project_user_user_id_index` (`user_id`),
  CONSTRAINT `project_user_project_id_foreign` FOREIGN KEY (`project_id`) REFERENCES `projects` (`id`) ON DELETE CASCADE,
  CONSTRAINT `project_user_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

LOCK TABLES `project_user` WRITE;
/*!40000 ALTER TABLE `project_user` DISABLE KEYS */;

INSERT INTO `project_user` (`id`, `project_id`, `user_id`)
VALUES
	(1,1,1),
	(2,1,4),
	(3,1,2),
	(4,1,3),
	(6,2,5),
	(8,2,3),
	(9,2,4);

/*!40000 ALTER TABLE `project_user` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table projects
# ------------------------------------------------------------

DROP TABLE IF EXISTS `projects`;

CREATE TABLE `projects` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `description` text COLLATE utf8_unicode_ci,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

LOCK TABLES `projects` WRITE;
/*!40000 ALTER TABLE `projects` DISABLE KEYS */;

INSERT INTO `projects` (`id`, `name`, `description`, `created_at`, `updated_at`, `deleted_at`)
VALUES
	(1,'Explore Divvy','A sample project to help you learn your way around Divvy','2015-05-05 11:43:17','2015-05-05 11:43:17',NULL),
	(2,'Prepare for the presentation','We need to get ready for the capstone presentation','2015-05-05 11:43:44','2015-05-05 11:46:26',NULL);

/*!40000 ALTER TABLE `projects` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table subtasks
# ------------------------------------------------------------

DROP TABLE IF EXISTS `subtasks`;

CREATE TABLE `subtasks` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `task_id` int(10) unsigned NOT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `is_complete` tinyint(1) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `subtasks_task_id_foreign` (`task_id`),
  CONSTRAINT `subtasks_task_id_foreign` FOREIGN KEY (`task_id`) REFERENCES `tasks` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

LOCK TABLES `subtasks` WRITE;
/*!40000 ALTER TABLE `subtasks` DISABLE KEYS */;

INSERT INTO `subtasks` (`id`, `task_id`, `name`, `is_complete`, `created_at`, `updated_at`, `deleted_at`)
VALUES
	(1,1,'Only members assigned to a task can see the task or any activity associated with it.',0,'2015-05-05 11:43:18','2015-05-05 11:43:18',NULL),
	(2,1,'Clicking another user allows you to see all of their activity within the task.',0,'2015-05-05 11:43:19','2015-05-05 11:43:19',NULL),
	(3,1,'Project admins can also add subtasks to provide direction to members',0,'2015-05-05 11:43:20','2015-05-05 11:43:20',NULL),
	(4,1,'Task members can split the Task into smaller subtasks',0,'2015-05-05 11:43:22','2015-05-05 11:43:22',NULL),
	(5,3,'Make forms consistent across the site',1,'2015-05-05 11:43:45','2015-05-05 12:04:30',NULL),
	(6,3,'Run unit tests',0,'2015-05-05 11:43:46','2015-05-05 11:49:33',NULL),
	(7,3,'Compress images',0,'2015-05-05 11:43:47','2015-05-05 11:49:25',NULL),
	(8,3,'Upload to live server',0,'2015-05-05 11:43:49','2015-05-05 11:49:14',NULL),
	(9,4,'Origin',0,'2015-05-05 12:09:47','2015-05-05 12:09:47',NULL),
	(10,4,'Test Suite',0,'2015-05-05 12:10:03','2015-05-05 12:10:03',NULL),
	(11,4,'Pusher.com realtime integration',0,'2015-05-05 12:10:13','2015-05-05 12:10:13',NULL);

/*!40000 ALTER TABLE `subtasks` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table task_user
# ------------------------------------------------------------

DROP TABLE IF EXISTS `task_user`;

CREATE TABLE `task_user` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `task_id` int(10) unsigned NOT NULL,
  `user_id` int(10) unsigned NOT NULL,
  PRIMARY KEY (`id`),
  KEY `task_user_task_id_index` (`task_id`),
  KEY `task_user_user_id_index` (`user_id`),
  CONSTRAINT `task_user_task_id_foreign` FOREIGN KEY (`task_id`) REFERENCES `tasks` (`id`) ON DELETE CASCADE,
  CONSTRAINT `task_user_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

LOCK TABLES `task_user` WRITE;
/*!40000 ALTER TABLE `task_user` DISABLE KEYS */;

INSERT INTO `task_user` (`id`, `task_id`, `user_id`)
VALUES
	(1,1,4),
	(2,1,3),
	(3,1,2),
	(4,2,4),
	(5,2,3),
	(6,3,5),
	(7,3,3),
	(9,4,5),
	(11,3,4),
	(12,4,4);

/*!40000 ALTER TABLE `task_user` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table tasks
# ------------------------------------------------------------

DROP TABLE IF EXISTS `tasks`;

CREATE TABLE `tasks` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `project_id` int(10) unsigned NOT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `description` text COLLATE utf8_unicode_ci,
  `is_complete` tinyint(1) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `tasks_project_id_foreign` (`project_id`),
  CONSTRAINT `tasks_project_id_foreign` FOREIGN KEY (`project_id`) REFERENCES `projects` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

LOCK TABLES `tasks` WRITE;
/*!40000 ALTER TABLE `tasks` DISABLE KEYS */;

INSERT INTO `tasks` (`id`, `project_id`, `name`, `description`, `is_complete`, `created_at`, `updated_at`, `deleted_at`)
VALUES
	(1,1,'A Task','Tasks are a way to assign work to a group of project members. Only members assigned to the task can see it.',0,'2015-05-05 11:43:17','2015-05-05 11:43:17',NULL),
	(2,1,'Another Task','When a task has been finished it can be marked as complete. Something else comes up, just reopen it.',1,'2015-05-05 11:43:24','2015-05-05 11:43:25',NULL),
	(3,2,'Project completion checklist','What still needs to be done?',0,'2015-05-05 11:43:44','2015-05-05 11:47:51',NULL),
	(4,2,'Presentation subjects','Things we can talk about',0,'2015-05-05 11:43:51','2015-05-05 11:47:32',NULL);

/*!40000 ALTER TABLE `tasks` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table users
# ------------------------------------------------------------

DROP TABLE IF EXISTS `users`;

CREATE TABLE `users` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `username` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(60) COLLATE utf8_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_username_unique` (`username`),
  UNIQUE KEY `users_email_unique` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;

INSERT INTO `users` (`id`, `username`, `email`, `password`, `remember_token`, `created_at`, `updated_at`)
VALUES
	(1,'System','system@divvytask.com','$2y$10$LnpRsybuh9tH7cLyekVGu.vXJ6im7m0WLw5k44fH3ecF0TGVFajsi',NULL,'1973-08-26 00:00:00','2003-08-02 00:00:00'),
	(2,'johndoe','johndoe@divvytask.com','$2y$10$LnpRsybuh9tH7cLyekVGu.vXJ6im7m0WLw5k44fH3ecF0TGVFajsi',NULL,'1978-08-30 00:00:00','1994-10-03 00:00:00'),
	(3,'janedoe','janedoe@divvytask.com','$2y$10$LnpRsybuh9tH7cLyekVGu.vXJ6im7m0WLw5k44fH3ecF0TGVFajsi',NULL,'2012-08-02 00:00:00','1972-05-22 00:00:00'),
	(4,'mikesmith','mike@smith.com','$2y$10$IFmtFtp/v0FZo5V9njl1LeADNXnNQImyO9gehxC6d4.WEPrmzbeYa',NULL,'2015-05-05 11:43:16','2015-05-05 11:43:16'),
	(5,'maryjones','mary@jones.com','$2y$10$EgX8.tUIUNS8nal0Oww.BeerP.GjUlEpVcWH6S6Vw7./CeAgTeOoS',NULL,'2015-05-05 11:43:44','2015-05-05 11:43:44');

/*!40000 ALTER TABLE `users` ENABLE KEYS */;
UNLOCK TABLES;



/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
