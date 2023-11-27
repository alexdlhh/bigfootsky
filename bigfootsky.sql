/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

DROP TABLE IF EXISTS `category`;
CREATE TABLE `category` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

DROP TABLE IF EXISTS `client`;
CREATE TABLE `client` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `surname` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `dni` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `address` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `phone` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `height` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `weight` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `shoe_size` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `ski_level` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `snow_level` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `snow_front` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `birthdate` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `colaborator_id` bigint(20) NOT NULL,
  `firma` varchar(2550) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `consent1` int(11) DEFAULT NULL,
  `consent2` int(11) DEFAULT NULL,
  `consent3` int(11) DEFAULT NULL,
  `dnia` varchar(2550) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `dnib` varchar(2550) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `colaborator` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

DROP TABLE IF EXISTS `colaborators`;
CREATE TABLE `colaborators` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `employees` int(11) DEFAULT NULL,
  `name` varchar(255) DEFAULT NULL,
  `stats` text,
  `discount` double DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  UNIQUE KEY `id` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

DROP TABLE IF EXISTS `course`;
CREATE TABLE `course` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `teacher_id` int(11) DEFAULT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `date` date NOT NULL,
  `time_start` time NOT NULL,
  `time_end` time NOT NULL,
  `status` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `max_students` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `material` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

DROP TABLE IF EXISTS `course_list`;
CREATE TABLE `course_list` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `id_client` bigint(20) DEFAULT NULL,
  `id_course` bigint(20) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `product` bigint(20) DEFAULT NULL,
  UNIQUE KEY `id` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

DROP TABLE IF EXISTS `failed_jobs`;
CREATE TABLE `failed_jobs` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `uuid` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

DROP TABLE IF EXISTS `migrations`;
CREATE TABLE `migrations` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

DROP TABLE IF EXISTS `particular`;
CREATE TABLE `particular` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `teacher_id` int(11) DEFAULT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `date` date NOT NULL,
  `time_start` time NOT NULL,
  `time_end` time NOT NULL,
  `status` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `max_students` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

DROP TABLE IF EXISTS `particular_list`;
CREATE TABLE `particular_list` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `id_client` bigint(20) DEFAULT NULL,
  `id_particular` bigint(20) DEFAULT NULL,
  `product` bigint(20) DEFAULT NULL,
  UNIQUE KEY `id` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

DROP TABLE IF EXISTS `password_resets`;
CREATE TABLE `password_resets` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  KEY `password_resets_email_index` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

DROP TABLE IF EXISTS `personal_access_tokens`;
CREATE TABLE `personal_access_tokens` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `tokenable_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tokenable_id` bigint(20) unsigned NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(64) COLLATE utf8mb4_unicode_ci NOT NULL,
  `abilities` text COLLATE utf8mb4_unicode_ci,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

DROP TABLE IF EXISTS `product`;
CREATE TABLE `product` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `size` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `quality` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `health` int(11) NOT NULL,
  `category_id` bigint(20) unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `precio` text COLLATE utf8mb4_unicode_ci,
  PRIMARY KEY (`id`),
  KEY `product_category_id_foreign` (`category_id`),
  CONSTRAINT `product_category_id_foreign` FOREIGN KEY (`category_id`) REFERENCES `category` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

DROP TABLE IF EXISTS `rent`;
CREATE TABLE `rent` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `product_id` bigint(20) unsigned DEFAULT NULL,
  `clients` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `date` date NOT NULL,
  `time_start` time NOT NULL,
  `time_end` time NOT NULL,
  `status` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `price` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `rent_product_id_foreign` (`product_id`),
  KEY `rent_client_id_foreign` (`clients`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

DROP TABLE IF EXISTS `repair`;
CREATE TABLE `repair` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `fecha_recogida` date DEFAULT NULL,
  `fecha_entrega` date DEFAULT NULL,
  `precio` double DEFAULT NULL,
  `id_cliente` bigint(20) DEFAULT NULL,
  `name` varchar(255) DEFAULT NULL,
  `updated_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `status` int(11) DEFAULT NULL,
  UNIQUE KEY `id` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

DROP TABLE IF EXISTS `teacher`;
CREATE TABLE `teacher` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `dni` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `langs` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `phone` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `modality` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `disponibility` text COLLATE utf8mb4_unicode_ci,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

DROP TABLE IF EXISTS `users`;
CREATE TABLE `users` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `role` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `teacher_relation` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_email_unique` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO `category` (`id`, `name`, `created_at`, `updated_at`) VALUES
(1, 'esquí', '2023-09-24 18:28:36', '2023-09-24 18:28:36');
INSERT INTO `category` (`id`, `name`, `created_at`, `updated_at`) VALUES
(2, 'snow', '2023-09-24 18:28:36', '2023-09-24 18:28:36');
INSERT INTO `category` (`id`, `name`, `created_at`, `updated_at`) VALUES
(3, 'Servicio', '2023-11-26 19:03:05', '2023-11-26 19:06:21');
INSERT INTO `category` (`id`, `name`, `created_at`, `updated_at`) VALUES
(4, 'Extras', '2023-11-26 19:06:44', '2023-11-26 19:06:44');

INSERT INTO `client` (`id`, `name`, `surname`, `dni`, `address`, `phone`, `height`, `weight`, `shoe_size`, `ski_level`, `snow_level`, `snow_front`, `birthdate`, `created_at`, `updated_at`, `email`, `colaborator_id`, `firma`, `consent1`, `consent2`, `consent3`, `dnia`, `dnib`, `colaborator`) VALUES
(1, 'Alejandro', 'de la Haba', '32731456H', 'plz huesas, 2, 2ºd', '637192482', '174', '84', '42', 'nulo', 'nulo', 'Diestro', '2023-10-03', '2023-10-03 17:09:35', '2023-10-03 17:09:35', 'alexdlhh@gmail.com', 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `client` (`id`, `name`, `surname`, `dni`, `address`, `phone`, `height`, `weight`, `shoe_size`, `ski_level`, `snow_level`, `snow_front`, `birthdate`, `created_at`, `updated_at`, `email`, `colaborator_id`, `firma`, `consent1`, `consent2`, `consent3`, `dnia`, `dnib`, `colaborator`) VALUES
(3, 'Leticia', 'Fernández', '76751691R', 'ejej', '637192482', '164', '79', '37', 'nulo', 'nulo', 'Diestro', '2023-10-03', '2023-10-03 17:12:57', '2023-10-03 17:12:57', 'alexdlhh@gmail.com', 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `client` (`id`, `name`, `surname`, `dni`, `address`, `phone`, `height`, `weight`, `shoe_size`, `ski_level`, `snow_level`, `snow_front`, `birthdate`, `created_at`, `updated_at`, `email`, `colaborator_id`, `firma`, `consent1`, `consent2`, `consent3`, `dnia`, `dnib`, `colaborator`) VALUES
(4, 'drfghdfh', 'gfhfgd', '56754756765', 'sñujdfisdfbgv', '6516516541', '190', '98', '50', 'alto', 'alto', 'Zurdo', '2023-10-03', '2023-10-03 17:55:25', '2023-10-03 17:55:25', 'gdfhfdgh@dfslgvjndf.ed', 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL);

INSERT INTO `colaborators` (`id`, `employees`, `name`, `stats`, `discount`, `created_at`, `updated_at`) VALUES
(2, 69, 'Daniel', NULL, 80, '2023-10-24 19:41:21', '2023-10-24 19:41:21');


INSERT INTO `course` (`id`, `teacher_id`, `name`, `description`, `date`, `time_start`, `time_end`, `status`, `max_students`, `created_at`, `updated_at`, `material`) VALUES
(2, 1, 'erwe', '<p>hg rtedshg dxf hgdxfh fdg h</p>', '2023-10-10', '10:00:00', '12:45:00', '1', '8', '2023-10-03 17:47:41', '2023-10-03 17:47:41', 1);


INSERT INTO `course_list` (`id`, `id_client`, `id_course`, `created_at`, `updated_at`, `product`) VALUES
(1, 1, 2, '2023-11-27 15:23:47', '2023-11-27 15:23:47', 9);




INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_000000_create_users_table', 1);
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(2, '2014_10_12_100000_create_password_resets_table', 1);
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(3, '2019_08_19_000000_create_failed_jobs_table', 1);
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(4, '2019_12_14_000001_create_personal_access_tokens_table', 1),
(5, '2023_09_22_165109_create_category_table', 1),
(6, '2023_09_22_165110_create_product_table', 1),
(7, '2023_09_22_170106_create_course_table', 1),
(8, '2023_09_22_170204_create_teacher_table', 1),
(9, '2023_09_22_170242_create_client_table', 1),
(10, '2023_09_22_170325_create_particular_table', 1),
(11, '2023_09_22_170418_create_asigned_table', 1),
(12, '2023_09_22_170500_create_rent_table', 1);

INSERT INTO `particular` (`id`, `teacher_id`, `name`, `description`, `date`, `time_start`, `time_end`, `status`, `max_students`, `created_at`, `updated_at`) VALUES
(1, 1, 'ergsertgy', '<p>gfdh dfg hfgd&nbsp;</p>', '2023-10-11', '19:50:00', '19:50:00', '1', '8', '2023-10-03 17:50:37', '2023-10-03 17:50:37');








INSERT INTO `product` (`id`, `name`, `size`, `quality`, `status`, `health`, `category_id`, `created_at`, `updated_at`, `precio`) VALUES
(8, 'test', '170', 'MEDIA-ALTA', '1', 1, 1, '2023-11-26 18:51:17', '2023-11-26 18:51:17', '{\"1\":\"1\",\"2\":\"2\",\"3\":\"3\",\"4\":\"4\",\"5\":\"5\",\"6\":\"6\",\"7\":\"7\"}');
INSERT INTO `product` (`id`, `name`, `size`, `quality`, `status`, `health`, `category_id`, `created_at`, `updated_at`, `precio`) VALUES
(9, 'test2', '175', 'MEDIA-ALTA', '1', 9, 1, '2023-11-26 19:01:04', '2023-11-26 19:01:04', '{\"1\":\"1\",\"2\":\"2\",\"3\":\"3\",\"4\":\"4\",\"5\":\"5\",\"6\":\"6\",\"7\":\"7\"}');
INSERT INTO `product` (`id`, `name`, `size`, `quality`, `status`, `health`, `category_id`, `created_at`, `updated_at`, `precio`) VALUES
(10, 'test3', '180', 'MEDIA-ALTA', '1', 8, 2, '2023-11-26 19:01:39', '2023-11-26 19:01:39', '{\"1\":\"1\",\"2\":\"2\",\"3\":\"3\",\"4\":\"4\",\"5\":\"5\",\"6\":\"6\",\"7\":\"7\"}');
INSERT INTO `product` (`id`, `name`, `size`, `quality`, `status`, `health`, `category_id`, `created_at`, `updated_at`, `precio`) VALUES
(11, 'tset4', '175', 'MEDIA-ALTA', '1', 9, 2, '2023-11-26 19:02:23', '2023-11-26 19:02:23', '{\"1\":\"1\",\"2\":\"2\",\"3\":\"3\",\"4\":\"4\",\"5\":\"5\",\"6\":\"6\",\"7\":\"7\"}'),
(12, 'test5', 'L', 'MEDIA-ALTA', '1', 8, 3, '2023-11-26 19:03:48', '2023-11-26 19:04:04', '{\"1\":\"1\",\"2\":\"2\",\"3\":\"3\",\"4\":\"4\",\"5\":\"5\",\"6\":\"6\",\"7\":\"7\"}'),
(13, 'test6', 'L', 'MEDIA-ALTA', '1', 8, 3, '2023-11-26 19:04:40', '2023-11-26 19:04:40', '{\"1\":\"1\",\"2\":\"2\",\"3\":\"3\",\"4\":\"4\",\"5\":\"5\",\"6\":\"6\",\"7\":\"7\"}'),
(14, 'dfssdf', 'L', 'MEDIA-ALTA', '1', 1, 3, '2023-11-26 19:05:20', '2023-11-26 19:05:20', '{\"1\":\"1\",\"2\":\"2\",\"3\":\"3\",\"4\":\"4\",\"5\":\"5\",\"6\":\"6\",\"7\":\"7\"}'),
(15, 'dfssdf', 'L', 'MEDIA-ALTA', '1', 1, 3, '2023-11-26 19:05:21', '2023-11-26 19:05:21', '{\"1\":\"1\",\"2\":\"2\",\"3\":\"3\",\"4\":\"4\",\"5\":\"5\",\"6\":\"6\",\"7\":\"7\"}');

INSERT INTO `rent` (`id`, `created_at`, `updated_at`, `product_id`, `clients`, `date`, `time_start`, `time_end`, `status`, `price`) VALUES
(1, '2023-11-26 19:40:45', '2023-11-26 19:40:45', NULL, '1', '2023-11-26', '19:38:00', '19:38:00', '1', NULL);


INSERT INTO `repair` (`id`, `fecha_recogida`, `fecha_entrega`, `precio`, `id_cliente`, `name`, `updated_at`, `created_at`, `status`) VALUES
(1, NULL, NULL, NULL, NULL, 'yo', '2023-10-25 13:09:05', '2023-10-25 12:56:56', NULL);
INSERT INTO `repair` (`id`, `fecha_recogida`, `fecha_entrega`, `precio`, `id_cliente`, `name`, `updated_at`, `created_at`, `status`) VALUES
(2, NULL, NULL, NULL, NULL, 'gertghrfdtgh', '2023-10-25 13:10:05', '2023-10-25 13:10:05', NULL);
INSERT INTO `repair` (`id`, `fecha_recogida`, `fecha_entrega`, `precio`, `id_cliente`, `name`, `updated_at`, `created_at`, `status`) VALUES
(3, '2023-10-27', '2023-10-21', NULL, NULL, 'gertghrfdtgh', '2023-10-25 13:10:27', '2023-10-25 13:10:27', 1);

INSERT INTO `teacher` (`id`, `name`, `email`, `dni`, `langs`, `type`, `phone`, `created_at`, `updated_at`, `modality`, `disponibility`) VALUES
(1, 'pedro garcia aguado', 'peteraguado@gmail.com', '23155656G', 'Español', 'Interno', '600151515', '2023-10-03 17:39:32', '2023-10-03 17:39:32', NULL, NULL);


INSERT INTO `users` (`id`, `name`, `email`, `password`, `role`, `teacher_relation`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'Alex', 'alexdlhh@gmail.com', '$2y$10$fG5/uQ.RU4FQTp3U7RrZ5.prn3B8Kxd2dcbA5cLzwCDZq0hdHM4rO', 'admin', NULL, NULL, '2023-09-22 19:19:51', '2023-09-22 19:19:51');



/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;