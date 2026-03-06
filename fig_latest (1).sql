-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Oct 09, 2025 at 04:39 AM
-- Server version: 9.1.0
-- PHP Version: 8.3.14

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `fig_latest`
--

-- --------------------------------------------------------

--
-- Table structure for table `ads`
--

DROP TABLE IF EXISTS `ads`;
CREATE TABLE IF NOT EXISTS `ads` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `image` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `link` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `description` text COLLATE utf8mb4_unicode_ci,
  `status` tinyint(1) NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `ads`
--

INSERT INTO `ads` (`id`, `title`, `image`, `link`, `description`, `status`, `created_at`, `updated_at`) VALUES
(2, 'svgg', 'uploads/ads/1759316946_11-min.jpg', 'https://www.bing.com/search?filters=ufn%3a%22YouTube%22+sid%3a%224fe14df6-d63f-93e5-3032-b0e7050bca8c%22', 'svsd', 1, '2025-10-01 05:39:06', '2025-10-03 05:09:15');

-- --------------------------------------------------------

--
-- Table structure for table `cache`
--

DROP TABLE IF EXISTS `cache`;
CREATE TABLE IF NOT EXISTS `cache` (
  `key` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `value` mediumtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `expiration` int NOT NULL,
  PRIMARY KEY (`key`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `cache`
--

INSERT INTO `cache` (`key`, `value`, `expiration`) VALUES
('laravel-cache-dee@gmail.com|127.0.0.1', 'i:1;', 1759814428),
('laravel-cache-dee@gmail.com|127.0.0.1:timer', 'i:1759814428;', 1759814428);

-- --------------------------------------------------------

--
-- Table structure for table `cache_locks`
--

DROP TABLE IF EXISTS `cache_locks`;
CREATE TABLE IF NOT EXISTS `cache_locks` (
  `key` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `owner` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `expiration` int NOT NULL,
  PRIMARY KEY (`key`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `events`
--

DROP TABLE IF EXISTS `events`;
CREATE TABLE IF NOT EXISTS `events` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci,
  `event_date` datetime NOT NULL,
  `location` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `image` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=12 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `events`
--

INSERT INTO `events` (`id`, `title`, `description`, `event_date`, `location`, `image`, `created_at`, `updated_at`) VALUES
(7, 'wv', 'vds', '2004-08-25 00:00:00', 'svs', NULL, '2025-10-08 00:21:53', '2025-10-08 00:21:53'),
(6, 'dht', 'bdr', '2025-12-24 00:00:00', 'kochi', NULL, '2025-10-07 23:59:59', '2025-10-07 23:59:59'),
(8, 'vwse', 'vewssvsdvs', '2025-01-28 00:00:00', 'sacv', 'events/RdcfKV2YSjUVNqmQUXHg2Uq7HctlGMpiW9515RiT.jpg', '2025-10-08 00:27:49', '2025-10-08 00:27:49'),
(9, 'onam', 'wew', '2025-02-12 00:00:00', 'vsd', 'events/MjKyLn7HJsKEbN15cVMLZdRpOnKlNZvFI3CCuhrw.jpg', '2025-10-08 01:11:12', '2025-10-08 01:11:12'),
(10, 'visu', 'wv', '2025-05-04 00:00:00', 'wvwe', 'events/VhbEPxMmggO5LccBpzg2ajzc9bQ9jEoEndMO0bG9.webp', '2025-10-08 01:13:05', '2025-10-08 01:13:05'),
(11, 'deepavali', 'wv', '2025-04-12 00:00:00', 'wv', 'events/pWYCKTsTEwn0IJpocagIqDkdCuAVYK0jLGiKfThL.jpg', '2025-10-08 01:13:57', '2025-10-08 01:13:57');

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

DROP TABLE IF EXISTS `failed_jobs`;
CREATE TABLE IF NOT EXISTS `failed_jobs` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `uuid` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `jobs`
--

DROP TABLE IF EXISTS `jobs`;
CREATE TABLE IF NOT EXISTS `jobs` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `queue` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `attempts` tinyint UNSIGNED NOT NULL,
  `reserved_at` int UNSIGNED DEFAULT NULL,
  `available_at` int UNSIGNED NOT NULL,
  `created_at` int UNSIGNED NOT NULL,
  PRIMARY KEY (`id`),
  KEY `jobs_queue_index` (`queue`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `job_batches`
--

DROP TABLE IF EXISTS `job_batches`;
CREATE TABLE IF NOT EXISTS `job_batches` (
  `id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `total_jobs` int NOT NULL,
  `pending_jobs` int NOT NULL,
  `failed_jobs` int NOT NULL,
  `failed_job_ids` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `options` mediumtext COLLATE utf8mb4_unicode_ci,
  `cancelled_at` int DEFAULT NULL,
  `created_at` int NOT NULL,
  `finished_at` int DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `locations`
--

DROP TABLE IF EXISTS `locations`;
CREATE TABLE IF NOT EXISTS `locations` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `locations`
--

INSERT INTO `locations` (`id`, `name`, `created_at`, `updated_at`) VALUES
(1, 'tvm', '2025-09-30 11:54:54', '2025-09-30 11:54:54');

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

DROP TABLE IF EXISTS `migrations`;
CREATE TABLE IF NOT EXISTS `migrations` (
  `id` int UNSIGNED NOT NULL AUTO_INCREMENT,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=24 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '0001_01_01_000000_create_users_table', 1),
(2, '0001_01_01_000001_create_cache_table', 1),
(3, '0001_01_01_000002_create_jobs_table', 1),
(4, '2025_09_05_110840_create_post_categories_table', 1),
(5, '2025_09_05_170409_create_posts_table', 1),
(6, '2025_09_05_200200_create_product_categories_table', 1),
(7, '2025_09_05_200628_create_products_table', 1),
(8, '2025_09_05_211853_create_product_images_table', 2),
(9, '2025_09_12_152248_add_barcode_and_serial_number_to_products_table', 3),
(12, '2025_09_15_000001_create_protection_plans_table', 5),
(13, '2025_09_15_000002_create_protection_product_map_table', 6),
(14, '2025_09_13_192048_create_warranty_registrations_table', 7),
(15, '2025_09_29_131821_create_locations_table', 8),
(16, '2025_09_30_065647_add_profile_and_multiple_images_to_users_table', 9),
(17, '2025_09_30_165024_add_profile_location_description_coverimage_to_users_table', 10),
(18, '2025_10_01_070301_create_user_multipleimages_table', 11),
(19, '2025_10_01_071848_create_usermultipleimages_table', 12),
(20, '2025_10_01_072652_create_user_multipleimages_table', 13),
(21, '2025_10_01_101054_create_ads_table', 14),
(22, '2025_10_04_133635_create_events_table', 15),
(23, '2025_10_08_055613_add_image_to_events_table', 16);

-- --------------------------------------------------------

--
-- Table structure for table `password_reset_tokens`
--

DROP TABLE IF EXISTS `password_reset_tokens`;
CREATE TABLE IF NOT EXISTS `password_reset_tokens` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `posts`
--

DROP TABLE IF EXISTS `posts`;
CREATE TABLE IF NOT EXISTS `posts` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `body` text COLLATE utf8mb4_unicode_ci,
  `image` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `post_category_id` bigint UNSIGNED NOT NULL,
  `user_id` bigint UNSIGNED DEFAULT NULL,
  `published` tinyint(1) NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `posts_slug_unique` (`slug`),
  KEY `posts_post_category_id_foreign` (`post_category_id`),
  KEY `posts_user_id_foreign` (`user_id`)
) ENGINE=InnoDB AUTO_INCREMENT=54 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `posts`
--

INSERT INTO `posts` (`id`, `title`, `slug`, `body`, `image`, `post_category_id`, `user_id`, `published`, `created_at`, `updated_at`) VALUES
(4, 'Velocera 95 – Where Gloss Meets Strength', 'velocera-95-where-gloss-meets-strength-2', 'Experience the world’s most advanced ceramic coating, engineered with an extraordinary 95% SiO₂ concentration.', 'posts/1757360933.png', 1, NULL, 1, '2025-09-06 16:10:25', '2025-09-08 14:18:53'),
(5, 'Revolutionizing networking for business owners', 'revolutionizing-networking-for-business-owners', 'We are dedicated to empowering business owners to harness the full potential of their networks. We serve as a trusted platform where genuine and authentic connections thrive. Recognizing that success in business hinges on trusted relationships, we are committed to making it easier for individuals to connect and support each other in their journey towards success.', 'posts/1759831628.webp', 2, NULL, 1, '2025-09-08 03:34:09', '2025-10-07 04:37:08'),
(6, 'Low Maintenance', 'low-maintenance', 'Easy to clean and care for, eliminating the need for pH-neutral shampoos or special products.', 'posts/1757532776.png', 3, NULL, 1, '2025-09-08 03:43:33', '2025-09-17 16:37:40'),
(7, 'Long-Lasting Performance', 'long-lasting-performance', 'Designed to endure years of use, maintaining shine and strength without frequent reapplication', 'posts/1757532752.png', 3, NULL, 1, '2025-09-08 03:44:39', '2025-09-17 16:37:09'),
(8, 'UV & Weather Resistance', 'uv-weather-resistance', 'Shields your car from harsh sun, acid rain, and daily pollutants, keeping surfaces fresh and flawless.', 'posts/1757532544.png', 3, NULL, 1, '2025-09-08 03:45:30', '2025-09-17 16:36:36'),
(9, 'Premium Materials', 'premium-materials', 'Made with globally recognized raw materials like Covestro TPU and Ashland adhesives for reliability you can count on.', 'posts/1757532349.png', 3, NULL, 1, '2025-09-08 03:46:11', '2025-09-17 16:35:55'),
(10, 'German Technology', 'german-technology', 'Backed by precision engineering and advanced R&D, our products deliver world-class performance trusted worldwide.', 'posts/1757528275.png', 3, NULL, 1, '2025-09-08 03:46:56', '2025-09-17 16:35:25'),
(11, '232', '232', 'Happy Clients', NULL, 4, NULL, 1, '2025-09-08 04:25:24', '2025-09-08 04:25:24'),
(12, '521', '521', 'Cars', NULL, 4, NULL, 1, '2025-09-08 04:25:50', '2025-09-08 04:25:50'),
(13, '1463', '1463', 'Hours Of Support', NULL, 4, NULL, 0, '2025-09-08 04:26:17', '2025-09-08 04:26:17'),
(14, '15', '15', 'HardWorkers', NULL, 4, NULL, 1, '2025-09-08 04:26:40', '2025-09-08 04:26:40'),
(16, 'Hardness', 'hardness', 'Stronger, longer-lasting surface protection with 9H+ strength', NULL, 6, NULL, 0, '2025-09-08 04:37:29', '2025-09-08 04:37:29'),
(17, 'Gloss', 'gloss', 'Deep, wet-look shine measured at 96&deg; gloss level', NULL, 6, NULL, 1, '2025-09-08 04:37:53', '2025-09-08 04:37:53'),
(18, 'Hydrophobic effect', 'hydrophobic-effect', 'Contact angle over 115&deg; ensures dirt, mud, and water slide off effortlessly', NULL, 6, NULL, 0, '2025-09-08 04:38:36', '2025-09-08 04:38:36'),
(19, 'Balanced performance', 'balanced-performance', 'Not just hard, not just shiny &mdash; but the perfect equilibrium', NULL, 6, NULL, 0, '2025-09-08 04:39:29', '2025-09-08 04:39:29'),
(20, 'Image 1', 'image-1', NULL, 'posts/1757534740.jpg', 7, NULL, 1, '2025-09-08 05:03:23', '2025-09-10 14:35:40'),
(21, 'Image 2', 'image-2', NULL, 'posts/1757534701.jpg', 7, NULL, 1, '2025-09-08 05:03:46', '2025-09-10 14:35:01'),
(22, 'Image 3', 'image-3', NULL, 'posts/1757534681.jpg', 7, NULL, 1, '2025-09-08 05:04:18', '2025-09-10 14:34:41'),
(23, 'Image 4', 'image-4', NULL, 'posts/1757534653.jpg', 7, NULL, 1, '2025-09-08 05:04:36', '2025-09-10 14:34:13'),
(24, 'Image 5', 'image-5', NULL, 'posts/1757534627.jpg', 7, NULL, 1, '2025-09-08 05:04:54', '2025-09-10 14:33:47'),
(25, 'Sara Wilson', 'sara-wilson', 'Long-Lasting Protection & Gloss', 'posts/1757535136.jpg', 8, NULL, 1, '2025-09-08 05:15:20', '2025-09-10 14:42:16'),
(26, 'John', 'john', 'Adds Depth & Hydrophobic Finish', 'posts/1757535101.jpg', 8, NULL, 1, '2025-09-08 05:15:53', '2025-09-10 14:41:41'),
(27, 'Aravind', 'aravind', 'UV & Chemical Resistance', 'posts/1757535069.jpg', 8, NULL, 0, '2025-09-08 05:16:27', '2025-09-10 14:41:09'),
(28, '1. How long does Velocera 95 last?', '1-how-long-does-velocera-95-last', 'Velocera 95 offers years of protection with a single application, even under harsh Indian weather.', NULL, 9, NULL, 1, '2025-09-08 05:19:14', '2025-09-08 05:19:14'),
(29, '2.Do I need special shampoos or cleaners?', '2do-i-need-special-shampoos-or-cleaners', 'No. Unlike other coatings, Velocera 95 does not require pH-neutral shampoos. Regular car shampoos work perfectly.', NULL, 9, NULL, 1, '2025-09-08 05:19:41', '2025-09-08 05:19:41'),
(30, '3.Will it protect against scratches?', '3will-it-protect-against-scratches', 'Yes, the 9H+ hardness resists swirl marks, light scratches, and daily wear &amp; tear.', NULL, 9, NULL, 1, '2025-09-08 05:20:06', '2025-09-08 05:20:06'),
(31, '4.How many washes can it withstand?', '4how-many-washes-can-it-withstand', 'Velocera 95 stays strong for 75+ washes without losing its gloss or hydrophobic properties.', NULL, 9, NULL, 1, '2025-09-08 05:20:32', '2025-09-08 05:20:32'),
(32, '5.Can it withstand Indian climate?', '5can-it-withstand-indian-climate', 'Absolutely. It is tested for Indian roads, dust, rain, and extreme sun exposure.', NULL, 9, NULL, 1, '2025-09-08 05:20:53', '2025-09-08 05:20:53'),
(33, '7034303303', '7034303303', NULL, NULL, 10, NULL, 0, '2025-09-08 05:25:50', '2025-09-08 05:25:50'),
(34, 'hello@velocera.com', 'hello-at-veloceracom', NULL, NULL, 11, NULL, 1, '2025-09-08 05:26:07', '2025-09-08 05:26:07'),
(35, 'Address', 'address', 'V SREEDHARAN ROAD Near Choice House & Ramada Resort PANANGAD, Kumbalam, Kochi, Kerala 682506', NULL, 12, NULL, 1, '2025-09-08 12:04:32', '2025-09-08 12:04:32'),
(36, 'facebook', 'facebook', 'https://facebook.com', 'posts/1757535398.png', 13, NULL, 1, '2025-09-08 12:11:07', '2025-09-18 01:24:40'),
(37, 'instagram', 'instagram', 'https://instagram.com', 'posts/1757535378.png', 13, NULL, 1, '2025-09-08 12:14:08', '2025-09-18 01:24:27'),
(38, 'Velocera 95', 'velocera-95', NULL, 'posts/1758093660.png', 14, NULL, 1, '2025-09-08 12:16:35', '2025-09-17 01:51:00'),
(39, 'Veloskin PPF -  Where Clarity Meets Protection', 'veloskin-ppf-where-clarity-meets-protection', 'An Invisible layer that protects your car paint finish', 'posts/1758237542.png', 1, NULL, 1, '2025-09-17 02:58:41', '2025-09-21 08:14:07'),
(40, 'Trusted by Experts', 'trusted-by-experts', 'The preferred choice of professional detailers and automotive enthusiasts across India.', NULL, 3, NULL, 0, '2025-09-17 16:38:36', '2025-09-17 16:38:36'),
(41, '6.What is Veloskin PPF?', '6what-is-veloskin-ppf', 'Veloskin PPF is a premium Paint Protection Film designed to shield your vehicle’s paint from scratches, chips, stains, and environmental damage while maintaining a crystal-clear, glossy finish.', NULL, 9, NULL, 0, '2025-09-17 18:40:49', '2025-09-17 18:40:49'),
(44, 'pachalam', 'pachalam', 'sdvsd', NULL, 16, NULL, 0, '2025-09-30 06:44:42', '2025-09-30 06:44:42'),
(48, 'wf', 'wf', 'wfw', NULL, 2, NULL, 0, '2025-10-03 05:12:42', '2025-10-03 05:12:42'),
(49, 'uny', 'uny', 'tbt', 'posts/1759918720.png', 5, NULL, 0, '2025-10-03 06:50:15', '2025-10-08 04:48:40'),
(50, 'Find What You Want', 'find-what-you-want', 'cas', 'posts/1759912936.jpg', 18, 18, 0, '2025-10-08 03:12:16', '2025-10-08 03:12:16'),
(51, 'vweew', 'vweew', 'verb', 'posts/1759915511.jpg', 18, 18, 0, '2025-10-08 03:55:11', '2025-10-08 03:55:11'),
(52, 'kkjkj', 'kkjkj', 'n sa', 'posts/1759915548.jpg', 18, 18, 0, '2025-10-08 03:55:31', '2025-10-08 03:55:48');

-- --------------------------------------------------------

--
-- Table structure for table `post_categories`
--

DROP TABLE IF EXISTS `post_categories`;
CREATE TABLE IF NOT EXISTS `post_categories` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `post_categories_slug_unique` (`slug`)
) ENGINE=InnoDB AUTO_INCREMENT=20 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `post_categories`
--

INSERT INTO `post_categories` (`id`, `name`, `slug`, `created_at`, `updated_at`) VALUES
(1, 'Slider', 'slider', '2025-09-06 15:10:42', '2025-09-06 15:10:42'),
(2, 'About S', 'about-s', '2025-09-07 15:57:37', '2025-09-07 15:57:37'),
(3, 'Features', 'features', '2025-09-08 03:41:19', '2025-09-08 03:41:19'),
(4, 'Counter', 'counter', '2025-09-08 04:23:48', '2025-09-08 04:23:48'),
(5, 'Whychooseus', 'whychooseus', '2025-09-08 04:29:56', '2025-09-08 04:29:56'),
(6, 'Facilities', 'facilities', '2025-09-08 04:36:20', '2025-09-08 04:36:20'),
(7, 'Gallery', 'gallery', '2025-09-08 05:01:21', '2025-09-08 05:01:21'),
(8, 'Testimonials', 'testimonials', '2025-09-08 05:09:50', '2025-09-08 05:09:50'),
(9, 'Faq', 'faq', '2025-09-08 05:18:39', '2025-09-08 05:18:39'),
(10, 'Phone', 'phone', '2025-09-08 05:22:56', '2025-09-08 05:22:56'),
(11, 'Email', 'email', '2025-09-08 05:25:20', '2025-09-08 05:25:20'),
(12, 'Address', 'address', '2025-09-08 12:01:13', '2025-09-08 12:01:13'),
(13, 'Social Icons', 'social-icons', '2025-09-08 12:05:16', '2025-09-08 12:05:16'),
(14, 'Logo', 'logo', '2025-09-08 12:16:16', '2025-09-08 12:16:16'),
(16, 'Locations', 'locations', '2025-09-30 06:44:09', '2025-09-30 06:44:09'),
(17, 'events', 'events', '2025-10-07 23:58:59', '2025-10-07 23:58:59'),
(18, 'howitworks', 'howitworks', '2025-10-08 03:08:44', '2025-10-08 03:08:44'),
(19, 'social-icons', 'social-icons-2', '2025-10-08 04:14:34', '2025-10-08 04:14:34');

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

DROP TABLE IF EXISTS `products`;
CREATE TABLE IF NOT EXISTS `products` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci,
  `image` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `barcode` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `serial_number` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `product_category_id` bigint UNSIGNED NOT NULL,
  `slug` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `products_product_category_id_foreign` (`product_category_id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `name`, `description`, `image`, `barcode`, `serial_number`, `product_category_id`, `slug`, `created_at`, `updated_at`) VALUES
(4, 'Velocera 95 Ceramic Coating', 'Velocera 95 sets a new benchmark in ceramic coating technology with an industry-leading 95% SiO₂ concentration. Specially crafted for enthusiasts and premium car owners, it provides a protective shell that enhances paintwork, ensures long-lasting gloss, and simplifies maintenance. With superior hardness and advanced hydrophobic properties, Velocera 95 keeps your vehicle looking showroom-fresh, no matter the conditions. <br/>\r\n\r\nUnlike conventional coatings, Velocera 95 is engineered to resist UV rays, environmental contaminants, water spots, and swirl marks. Its unique formulation bonds at the molecular level, creating a smooth, high-gloss finish that not only looks stunning but also defends your paintwork against the harshest elements.<br/>\r\n\r\nBacked by rigorous testing, Velocera 95 guarantees protection that endures 75+ washes without losing effect, making it one of the most reliable ceramic coatings in the market. Easy to maintain and crafted for India’s climate, it delivers the perfect balance of beauty and performance.<br/><br/>\r\n\r\n🔹 Key Features<br/><br/>\r\n<ul> <li><i class=\"bi bi-check\"></i><span> <b>95% SiO₂ Formula</b> – delivers extreme durability and chemical resistance for years of protection.</span></li> <li><i class=\"bi bi-check\"></i><span> <b>96° Gloss Angle</b> – creates a deep, mirror-like shine that enhances your car’s natural color.</span></li> <li><i class=\"bi bi-check\"></i><span> <b>Hydrophobic 115°+ Contact Angle</b> – water, mud, and grime simply bead and roll off effortlessly.</span></li> <li><i class=\"bi bi-check\"></i><span> <b>9H+ Hardness</b> – resists scratches, UV rays, bird droppings, and harsh weather damage.</span></li> <li><i class=\"bi bi-check\"></i><span> <b>No pH Neutral Shampoo Required</b> – enjoy hassle-free cleaning with regular shampoos.</span></li> <li><i class=\"bi bi-check\"></i><span> <b>Withstands 75+ Washes</b> – proven durability, retaining gloss and hydrophobic properties over time.</span></li> <li><i class=\"bi bi-check\"></i><span> <b>Anti-Fading Protection</b> – safeguards against oxidation and paint dullness caused by sun exposure.</span></li> <li><i class=\"bi bi-check\"></i><span> <b>Easy Maintenance</b> – less time cleaning, more time enjoying your car’s brilliance.</span></li> <li><i class=\"bi bi-check\"></i><span> <b>Made for Indian Conditions</b> – designed to withstand high heat, humidity, and pollution.</span></li> </ul>', 'products/1758151967.jpg', NULL, NULL, 2, 'velocera-95-ceramic-coating', '2025-09-08 03:57:31', '2025-09-17 18:24:19'),
(7, 'Veloskin PPF', 'Veloskin PPF is engineered with German TPU technology from Covestro’s Desmopan® UP and the world’s best Ashland adhesive from the USA. At 195 microns of multilayered strength, it creates an invisible yet powerful shield over your car’s paintwork. Designed to endure India’s harsh climate, it offers clarity, durability, and self-healing protection that keeps your car looking brand new for years. <br/>\r\n\r\nUnlike ordinary films, Veloskin PPF is non-yellowing, highly hydrophobic, scratch-resistant, and UV-stable. It doesn’t just protect—it enhances your car’s gloss with a crystal-clear finish that highlights the paint beneath. Backed by thousands of hours of weather testing and a free 2-year accidental protection plan, Veloskin PPF is built to deliver unmatched peace of mind.<br/><br/>\r\n🔹 Key Features<br/><br/>\r\n<ul> <li><i class=\"bi bi-check\"></i><span> <b>195 Micron Thickness</b> – multilayer construction for superior impact and scratch resistance.</span></li> <li><i class=\"bi bi-check\"></i><span> <b>Covestro Desmopan® TPU</b> – premium German polymer offering 10 years of protection with self-healing properties.</span></li> <li><i class=\"bi bi-check\"></i><span> <b>Ashland Adhesive</b> – world-class glue from the USA ensuring zero yellowing, bubble-free installation, and best-in-class grip.</span></li> <li><i class=\"bi bi-check\"></i><span> <b>Top Gloss Finish</b> – delivers unmatched optical clarity and a mirror-like shine.</span></li> <li><i class=\"bi bi-check\"></i><span> <b>2000+ Hours Weathering Tested</b> – proven to withstand extreme UV, rain, and environmental stress.</span></li> <li><i class=\"bi bi-check\"></i><span> <b>Hydrophobic & Anti-Fading</b> – repels water, dirt, and stains while maintaining vibrant paint color.</span></li> <li><i class=\"bi bi-check\"></i><span> <b>Scratch & Swirl Resistance</b> – heals minor scratches with heat or sunlight, keeping surfaces flawless.</span></li> <li><i class=\"bi bi-check\"></i><span> <b>Made for Indian Roads</b> – built to handle India’s climate, dust, and traffic conditions.</span></li> <li><i class=\"bi bi-check\"></i><span> <b>Free 2-Year Protection Plan</b> – accidental damages covered with hassle-free replacement support.</span></li> </ul>', 'products/1758237853.png', '4252552385', '645645456', 2, 'veloskin-ppf', '2025-09-08 04:04:37', '2025-09-18 17:54:13');

-- --------------------------------------------------------

--
-- Table structure for table `product_categories`
--

DROP TABLE IF EXISTS `product_categories`;
CREATE TABLE IF NOT EXISTS `product_categories` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `image` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `product_categories`
--

INSERT INTO `product_categories` (`id`, `name`, `image`, `created_at`, `updated_at`) VALUES
(1, 'Shafi mc', 'product_categories/1757535859.png', '2025-09-05 15:45:07', '2025-09-10 14:54:19'),
(2, 'Ceramic coating', 'product_categories/1757535840.png', '2025-09-08 03:54:22', '2025-09-10 14:54:00');

-- --------------------------------------------------------

--
-- Table structure for table `product_images`
--

DROP TABLE IF EXISTS `product_images`;
CREATE TABLE IF NOT EXISTS `product_images` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `product_id` bigint UNSIGNED NOT NULL,
  `path` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `product_images_product_id_foreign` (`product_id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `protection_plans`
--

DROP TABLE IF EXISTS `protection_plans`;
CREATE TABLE IF NOT EXISTS `protection_plans` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `purchase_date` date DEFAULT NULL,
  `expiry_date` date DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `protection_product_map`
--

DROP TABLE IF EXISTS `protection_product_map`;
CREATE TABLE IF NOT EXISTS `protection_product_map` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `product_id` bigint UNSIGNED NOT NULL,
  `protection_plan_id` bigint UNSIGNED NOT NULL,
  `vehicle_number` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `protection_product_map_product_id_foreign` (`product_id`),
  KEY `protection_product_map_protection_plan_id_foreign` (`protection_plan_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `sessions`
--

DROP TABLE IF EXISTS `sessions`;
CREATE TABLE IF NOT EXISTS `sessions` (
  `id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` bigint UNSIGNED DEFAULT NULL,
  `ip_address` varchar(45) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `user_agent` text COLLATE utf8mb4_unicode_ci,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `last_activity` int NOT NULL,
  PRIMARY KEY (`id`),
  KEY `sessions_user_id_index` (`user_id`),
  KEY `sessions_last_activity_index` (`last_activity`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `sessions`
--

INSERT INTO `sessions` (`id`, `user_id`, `ip_address`, `user_agent`, `payload`, `last_activity`) VALUES
('lPotDaIlkCqYO2XDu5cPs25R5v2uxTktAxAAMRGO', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/140.0.0.0 Safari/537.36', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiWWdyWWNORjZjUExMS00yajg0V1RaSXZJQkV3cktDd0Nvaktqa2hsUiI7czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6Mjc6Imh0dHA6Ly9sb2NhbGhvc3Q6ODAwMC9sb2dpbiI7fX0=', 1758841470),
('ynAPS56hOBz5cxhhfCdYJTQh3KwvkNecep7M9sSs', 1, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/140.0.0.0 Safari/537.36', 'YTo2OntzOjY6Il90b2tlbiI7czo0MDoiYnZZUmNSSFhrYmpiQ0hlSFo3VndmdHNCamc1cHVBZHB6Q2hYR2t1diI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6Mzk6Imh0dHA6Ly9sb2NhbGhvc3Q6ODAwMC93YXJyYW50eS9yZWdpc3RlciI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fXM6MzoidXJsIjthOjA6e31zOjUwOiJsb2dpbl93ZWJfNTliYTM2YWRkYzJiMmY5NDAxNTgwZjAxNGM3ZjU4ZWE0ZTMwOTg5ZCI7aToxO3M6NDoiYXV0aCI7YToxOntzOjIxOiJwYXNzd29yZF9jb25maXJtZWRfYXQiO2k6MTc1ODgzMTUzNDt9fQ==', 1758841917);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `profile_image` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `location` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `description` text COLLATE utf8mb4_unicode_ci,
  `cover_image` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_email_unique` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=25 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `profile_image`, `location`, `description`, `cover_image`, `remember_token`, `created_at`, `updated_at`) VALUES
(17, 'suman', 'suman1@gmail.com', NULL, '$2y$12$428wETLyDQHn.qOyQpad/un7Omk5V3cRHLFxzoJQaf9qgHPOrbpP6', 'profiles/1759830394_OIP (16).webp', NULL, 'ewgerwgww', 'uploads/covers/1759837437_cover_OIP (20).webp', NULL, '2025-10-07 03:39:45', '2025-10-07 06:18:35'),
(18, 'vgygyg', 'sumhan1@gmail.com', NULL, '$2y$12$6TWIBH7bEd/yX9w9IfyROuI0L4FtE86U1Pm3gVn9Ucdb.slm2rijm', 'uploads/profiles/1759842453_profile_OIP (16).webp', NULL, 'hgtfhf', 'uploads/covers/1759842453_cover_images (6).jpg', NULL, '2025-10-07 07:35:33', '2025-10-07 07:37:33'),
(19, 'jibin mdigitz', 'jibinmdigitz@gmail.com', NULL, '$2y$12$Bi1q82UcNpADRK0qaW.uD.4ZL3DAw.jRPEAFaBSloXtrsEHewxSYu', 'uploads/profiles/1759924791_profile_gdlQxuQ8LM1y9RpkCyPe--1--1fl6h.webp', NULL, 'full stack developer', 'uploads/covers/1759924791_cover_OIP (38).jpg', NULL, '2025-10-08 06:28:09', '2025-10-08 06:29:51'),
(22, 'amaljith', 'amaljith@gmail.com', NULL, '$2y$12$cqRDDauJlZo/AQcMleO5CeQ7oltutqrdoWCM/l4pAXkQkbJxQ/JzO', 'uploads/profiles/1759925289_profile_OIP (26).webp', NULL, NULL, 'uploads/covers/1759925289_cover_OIP (26).webp', NULL, '2025-10-08 06:37:48', '2025-10-08 06:38:09'),
(23, 'iamajay', 'iamajay123@gmail.com', NULL, '$2y$12$pqWYSXHabnQKKWk6EBd6ce9Npj.VxbggD3NyiICCAG0M8uBajzXfi', 'uploads/profiles/1759925391_profile_business-ideas-with-almost-no-investment.png', NULL, 'java developer', 'uploads/covers/1759925391_cover_business-ideas-with-almost-no-investment.png', NULL, '2025-10-08 06:39:20', '2025-10-08 06:39:51'),
(24, 'arunkumar', 'arunkumar@gmail.com', NULL, '$2y$12$R47iN2porNaxx/0SKDnR1.yBfFkVX16KWG5DHlGQVgMliYz7oGRMC', 'uploads/profiles/1759925586_profile_OIP (27).webp', NULL, NULL, 'uploads/covers/1759925593_cover_OIP (27).webp', NULL, '2025-10-08 06:42:13', '2025-10-08 06:43:13');

-- --------------------------------------------------------

--
-- Table structure for table `user_multipleimages`
--

DROP TABLE IF EXISTS `user_multipleimages`;
CREATE TABLE IF NOT EXISTS `user_multipleimages` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `user_id` bigint UNSIGNED NOT NULL,
  `image` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `user_multipleimages_user_id_foreign` (`user_id`)
) ENGINE=MyISAM AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `user_multipleimages`
--

INSERT INTO `user_multipleimages` (`id`, `user_id`, `image`, `created_at`, `updated_at`) VALUES
(1, 13, 'uploads/user_images/1759303724_127-min.jpg', '2025-10-01 01:58:44', '2025-10-01 01:58:44'),
(2, 13, 'uploads/user_images/1759303724_101-min.jpg', '2025-10-01 01:58:44', '2025-10-01 01:58:44'),
(3, 13, 'uploads/user_images/1759303724_100-min.jpg', '2025-10-01 01:58:44', '2025-10-01 01:58:44'),
(4, 14, 'uploads/user_images/1759486240_images (2).jpg', '2025-10-03 04:40:40', '2025-10-03 04:40:40'),
(5, 14, 'uploads/user_images/1759486240_images (1).jpg', '2025-10-03 04:40:40', '2025-10-03 04:40:40'),
(6, 14, 'uploads/user_images/1759486240_images.jpg', '2025-10-03 04:40:40', '2025-10-03 04:40:40');

-- --------------------------------------------------------

--
-- Table structure for table `variations`
--

DROP TABLE IF EXISTS `variations`;
CREATE TABLE IF NOT EXISTS `variations` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `serial_number` varchar(255) COLLATE utf8mb3_unicode_ci NOT NULL,
  `product_id` bigint UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_variations_product` (`product_id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;

--
-- Dumping data for table `variations`
--

INSERT INTO `variations` (`id`, `serial_number`, `product_id`, `created_at`, `updated_at`) VALUES
(2, '45454', 7, '2025-09-23 12:17:38', '2025-09-23 12:17:38');

-- --------------------------------------------------------

--
-- Table structure for table `warranty_registrations`
--

DROP TABLE IF EXISTS `warranty_registrations`;
CREATE TABLE IF NOT EXISTS `warranty_registrations` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `product_id` bigint UNSIGNED NOT NULL,
  `serial_number` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `phone_number` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `vehicle_number` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `address` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `expiry_date` date DEFAULT NULL,
  `customer_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `dealer_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `dealer_phone_number` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `area` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `body_parts` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `warranty_registrations_product_id_foreign` (`product_id`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `warranty_registrations`
--

INSERT INTO `warranty_registrations` (`id`, `product_id`, `serial_number`, `phone_number`, `vehicle_number`, `address`, `expiry_date`, `customer_name`, `dealer_name`, `dealer_phone_number`, `area`, `body_parts`, `email`, `created_at`, `updated_at`) VALUES
(1, 7, '45454', '09495009985', 'jkl56565', 'afaf\r\ndsf', '2025-09-26', 'Shafi mc', 'My delar', '09495009985', '325', 'ddgd', 'iamshafimc@gmail.com', '2025-09-25 15:06:34', '2025-09-25 15:06:34'),
(3, 7, '45454', '09495009985', 'jkl56565', 'afaf\r\ndsf', '2025-09-26', 'Shafi mc', 'My delar', '09495009985', '325', 'ddgd', 'iamshafimc@gmail.com', '2025-09-25 15:31:49', '2025-09-25 15:31:49'),
(4, 7, '645645456789', '09495009985', 'jkl56565', 'afaf\r\ndsf', '2025-09-26', 'Shafi mc', 'My delar', '09495009985', '325', 'ddgd', 'iamshafimc@gmail.com', '2025-09-25 15:42:10', '2025-09-25 15:42:10'),
(5, 7, '645645456789', '09495009985', 'jkl56565', 'afaf\r\ndsf', '2025-09-26', 'Shafi mc', 'My delar', '09495009985', '325', 'ddgd', 'iamshafimc@gmail.com', '2025-09-25 16:52:55', '2025-09-25 16:52:55'),
(6, 7, '45454', '09495009985', 'jkl56565', 'afaf\r\ndsf', '2025-09-26', 'Shafi mc', 'My delar', '09495009985', '325', 'ddgd', 'iamshafimc@gmail.com', '2025-09-25 16:56:50', '2025-09-25 16:56:50'),
(7, 7, '645645456789', '09495009985', 'jkl56565', 'afaf\r\ndsf', '2025-09-26', 'Shafi mc', 'My delar', '09495009985', '325', 'ddgd', 'iamshafimc@gmail.com', '2025-09-25 16:59:20', '2025-09-25 16:59:20'),
(8, 7, '645645456789', '09495009985', 'jkl56565', 'afaf\r\ndsf', '2025-09-26', 'Shafi mc', 'My delar', '09495009985', '325', 'ddgd', 'iamshafimc@gmail.com', '2025-09-25 17:07:19', '2025-09-25 17:07:19'),
(9, 7, '645645456789', '09495009985', 'jkl56565', 'afaf\r\ndsf', '2025-09-26', 'Shafi mc', 'My delar', '09495009985', '325', 'ddgd', 'iamshafimc@gmail.com', '2025-09-25 17:12:35', '2025-09-25 17:12:35'),
(10, 7, '645645456789', '09495009985', 'jkl56565', 'afaf\r\ndsf', '2025-09-26', 'Shafi mc', 'My delar', '09495009985', '325', 'ddgd', 'iamshafimc@gmail.com', '2025-09-25 17:15:18', '2025-09-25 17:15:18'),
(11, 7, '645645456789', '09495009985', 'jkl56565', 'afaf\r\ndsf', '2025-09-26', 'Shafi mc', 'My delar', '09495009985', '325', 'ddgd', 'iamshafimc@gmail.com', '2025-09-25 17:15:30', '2025-09-25 17:15:30'),
(12, 7, '645645456789', '09495009985', 'jkl56565', 'afaf\r\ndsf', '2025-09-26', 'Shafi mc', 'My delar', '09495009985', '325', 'ddgd', 'iamshafimc@gmail.com', '2025-09-25 17:18:32', '2025-09-25 17:18:32');

--
-- Constraints for dumped tables
--

--
-- Constraints for table `posts`
--
ALTER TABLE `posts`
  ADD CONSTRAINT `posts_post_category_id_foreign` FOREIGN KEY (`post_category_id`) REFERENCES `post_categories` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `posts_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE SET NULL;

--
-- Constraints for table `products`
--
ALTER TABLE `products`
  ADD CONSTRAINT `products_product_category_id_foreign` FOREIGN KEY (`product_category_id`) REFERENCES `product_categories` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `product_images`
--
ALTER TABLE `product_images`
  ADD CONSTRAINT `product_images_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `protection_product_map`
--
ALTER TABLE `protection_product_map`
  ADD CONSTRAINT `protection_product_map_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `protection_product_map_protection_plan_id_foreign` FOREIGN KEY (`protection_plan_id`) REFERENCES `protection_plans` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `variations`
--
ALTER TABLE `variations`
  ADD CONSTRAINT `fk_variations_product` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `warranty_registrations`
--
ALTER TABLE `warranty_registrations`
  ADD CONSTRAINT `warranty_registrations_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
