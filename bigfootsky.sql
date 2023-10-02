/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

INSERT INTO `category` (`id`, `name`, `created_at`, `updated_at`) VALUES
(1, 'esquí', '2023-09-24 18:28:36', '2023-09-24 18:28:36');
INSERT INTO `category` (`id`, `name`, `created_at`, `updated_at`) VALUES
(2, 'snow', '2023-09-24 18:28:36', '2023-09-24 18:28:36');


INSERT INTO `product` (`id`, `name`, `size`, `quality`, `status`, `health`, `category_id`, `created_at`, `updated_at`) VALUES
(1, 'Esquís #ma1', 'estandar', 'Media-Alta', '1', 10, 1, '2023-09-24 19:31:16', '2023-09-24 19:31:16');
INSERT INTO `product` (`id`, `name`, `size`, `quality`, `status`, `health`, `category_id`, `created_at`, `updated_at`) VALUES
(2, 'Esquís #ma2', 'estandar', 'Media-Alta', '1', 10, 1, '2023-09-24 19:31:32', '2023-09-24 19:31:32');
INSERT INTO `product` (`id`, `name`, `size`, `quality`, `status`, `health`, `category_id`, `created_at`, `updated_at`) VALUES
(3, 'Esquís #ma3', 'estandar', 'Media-Alta', '1', 10, 1, '2023-09-25 18:55:36', '2023-09-25 18:55:36');
INSERT INTO `product` (`id`, `name`, `size`, `quality`, `status`, `health`, `category_id`, `created_at`, `updated_at`) VALUES
(4, 'Esquís #ma4', 'estandar', 'Media-Alta', '1', 10, 1, '2023-09-25 18:56:23', '2023-09-25 20:05:14'),
(5, 'Esquís #ma5', 'estandar', 'Media-Alta', '1', 10, 1, '2023-09-25 19:27:44', '2023-09-25 20:05:02'),
(6, 'Esquís #ma6', 'estandar', 'Media-Alta', '1', 10, 1, '2023-09-25 19:28:41', '2023-09-25 20:04:44');

INSERT INTO `users` (`id`, `name`, `email`, `password`, `role`, `teacher_relation`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'Alex', 'alexdlhh@gmail.com', '$2y$10$fG5/uQ.RU4FQTp3U7RrZ5.prn3B8Kxd2dcbA5cLzwCDZq0hdHM4rO', 'admin', NULL, NULL, '2023-09-22 19:19:51', '2023-09-22 19:19:51');



/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;