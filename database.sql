-- phpMyAdmin SQL Dump
-- version 5.2.2
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Jul 30, 2026 at 09:49 AM
-- Server version: 8.0.30
-- PHP Version: 8.3.31

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `eventamikom3344-db`
--

-- --------------------------------------------------------

--
-- Table structure for table `cache`
--

CREATE TABLE `cache` (
  `key` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `value` mediumtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `expiration` bigint NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `cache_locks`
--

CREATE TABLE `cache_locks` (
  `key` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `owner` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `expiration` bigint NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `name`, `slug`, `created_at`, `updated_at`) VALUES
(1, 'Seminar IT', 'seminar-it', '2026-07-27 04:23:16', '2026-07-27 04:23:16'),
(2, 'Entertaiment', 'entertaiment', '2026-07-27 04:23:16', '2026-07-27 04:23:16');

-- --------------------------------------------------------

--
-- Table structure for table `events`
--

CREATE TABLE `events` (
  `id` bigint UNSIGNED NOT NULL,
  `category_id` bigint UNSIGNED NOT NULL,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci,
  `date` datetime NOT NULL,
  `location` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `price` int NOT NULL,
  `stock` int NOT NULL,
  `poster_path` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `user_id` bigint UNSIGNED DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `events`
--

INSERT INTO `events` (`id`, `category_id`, `title`, `description`, `date`, `location`, `price`, `stock`, `poster_path`, `created_at`, `updated_at`, `user_id`) VALUES
(1, 2, 'Jazz Night 2025', 'Nikmati malam yang indah dengan alunan musik jazz\r\n\r\nyang merdu.', '2026-05-10 19:00:00', 'Amikom Baru', 50000, 94, 'posters/j7xUwv7zXaqMQW5pGS0M15n3C6jmG6EVfwADdP7n.jpg', '2026-07-27 04:23:16', '2026-07-28 19:02:59', NULL),
(2, 1, 'Hackaton - Unleash Your Inner Developer', 'Ayo asah skill coding kamu dan ciptakan solusi\r\n\r\ninovatif untuk tantangan masa depan!', '2026-05-05 10:00:00', 'Inkubator Amikom', 50000, 96, 'posters/6a27NGboFqKIR3GdYDDHDGLQcstj9aLBMENh8UbM.jpg', '2026-07-27 04:23:16', '2026-07-29 04:55:08', NULL),
(3, 1, 'AI & FUTURE TECH SUMMIT 2026', 'Jelajahi tren terkini dalam kecerdasan buatan dan\r\n\r\nteknologi masa depan bersama para ahli di bidangnya.', '2026-05-01 13:00:00', 'Cinema Unit 6', 50000, 100, 'posters/3V5pGFFykU3KE0WqIFxLb7tpM6OpQRzsA4bf94c7.jpg', '2026-07-27 04:23:16', '2026-07-27 04:41:33', NULL),
(4, 1, 'seminar', 'seminar di amikom', '2026-07-29 18:46:00', 'Amikom Baru', 125000, 99, 'posters/aFd1pNUiGJ4M716SVflX6rZHEREiDNdSXwyu39gd.jpg', '2026-07-29 04:47:19', '2026-07-29 04:53:02', 7),
(5, 1, 'seminar', 'seminar it di amikom', '2026-07-30 18:46:00', 'kampus amikom', 120, 149, 'posters/nqwT3mAaTh6A572fTs3oTzJCDQMQS6reMUxavFak.jpg', '2026-07-29 04:48:34', '2026-07-29 04:51:06', 7);

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint UNSIGNED NOT NULL,
  `uuid` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `jobs`
--

CREATE TABLE `jobs` (
  `id` bigint UNSIGNED NOT NULL,
  `queue` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `attempts` tinyint UNSIGNED NOT NULL,
  `reserved_at` int UNSIGNED DEFAULT NULL,
  `available_at` int UNSIGNED NOT NULL,
  `created_at` int UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `job_batches`
--

CREATE TABLE `job_batches` (
  `id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `total_jobs` int NOT NULL,
  `pending_jobs` int NOT NULL,
  `failed_jobs` int NOT NULL,
  `failed_job_ids` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `options` mediumtext COLLATE utf8mb4_unicode_ci,
  `cancelled_at` int DEFAULT NULL,
  `created_at` int NOT NULL,
  `finished_at` int DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int UNSIGNED NOT NULL,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '0001_01_01_000000_create_users_table', 1),
(2, '0001_01_01_000001_create_cache_table', 1),
(3, '0001_01_01_000002_create_jobs_table', 1),
(4, '2026_04_24_023252_create_categories_table', 1),
(5, '2026_04_24_023350_create_events_table', 1),
(6, '2026_04_24_023357_create_transactions_table', 1),
(7, '2026_05_24_125730_create_partners_table', 1),
(8, '2026_07_27_093157_add_google_id_to_users_table', 1),
(9, '2026_07_27_140104_create_reviews_table', 2),
(10, '2026_07_27_141255_add_user_id_to_events_table', 3),
(11, '2026_07_27_141309_add_status_to_users_table', 3),
(12, '2026_07_27_164403_create_vouchers_table', 4),
(13, '2026_07_27_164412_create_ticket_tiers_table', 4),
(14, '2026_07_27_164420_add_voucher_and_tier_to_transactions_table', 4);

-- --------------------------------------------------------

--
-- Table structure for table `partners`
--

CREATE TABLE `partners` (
  `id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `logo_url` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `partners`
--

INSERT INTO `partners` (`id`, `name`, `logo_url`, `created_at`, `updated_at`) VALUES
(2, 'BUMN', 'https://1.bp.blogspot.com/-k3kKkDSfrRg/YG6qePH27CI/AAAAAAAACWg/pdWWM0zjNncFOnRjJHkpzCcTh0BDPPz9wCNcBGAsYHQ/s2048/Kementerian%2BBadan%2BUsaha%2BMilik%2BNegara.png', '2026-07-27 04:39:03', '2026-07-27 04:40:14'),
(3, 'PDIP', 'https://tse3.mm.bing.net/th/id/OIP.7zduwIrRZmDcwjxyJXQ7AwHaHi?r=0&rs=1&pid=ImgDetMain&o=7&rm=3', '2026-07-27 04:39:39', '2026-07-27 04:39:39');

-- --------------------------------------------------------

--
-- Table structure for table `password_reset_tokens`
--

CREATE TABLE `password_reset_tokens` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `reviews`
--

CREATE TABLE `reviews` (
  `id` bigint UNSIGNED NOT NULL,
  `event_id` bigint UNSIGNED NOT NULL,
  `user_id` bigint UNSIGNED NOT NULL,
  `rating` tinyint NOT NULL COMMENT '1 to 5',
  `comment` text COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `reviews`
--

INSERT INTO `reviews` (`id`, `event_id`, `user_id`, `rating`, `comment`, `created_at`, `updated_at`) VALUES
(1, 1, 2, 5, 'gacor', '2026-07-27 07:06:23', '2026-07-27 07:06:23'),
(2, 2, 7, 5, 'keren sekali', '2026-07-29 04:55:38', '2026-07-29 04:55:38');

-- --------------------------------------------------------

--
-- Table structure for table `sessions`
--

CREATE TABLE `sessions` (
  `id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` bigint UNSIGNED DEFAULT NULL,
  `ip_address` varchar(45) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `user_agent` text COLLATE utf8mb4_unicode_ci,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `last_activity` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `sessions`
--

INSERT INTO `sessions` (`id`, `user_id`, `ip_address`, `user_agent`, `payload`, `last_activity`) VALUES
('uq1k4kbN268NmE32FbELIBJLhSgxcbxz6isqoKYX', 7, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/150.0.0.0 Safari/537.36 Edg/150.0.0.0', 'eyJfdG9rZW4iOiJ0RG5DY0lwUkpOYVlPd2xyM0Q1SVlTZjlZc1RQUjgwQzJPSU84eU14IiwiX2ZsYXNoIjp7Im5ldyI6W10sIm9sZCI6W119LCJfcHJldmlvdXMiOnsidXJsIjoiaHR0cDpcL1wvMTI3LjAuMC4xOjgwMDBcL2FkbWluXC9ldmVudHMiLCJyb3V0ZSI6ImFkbWluLmV2ZW50cy5pbmRleCJ9LCJsb2dpbl93ZWJfNTliYTM2YWRkYzJiMmY5NDAxNTgwZjAxNGM3ZjU4ZWE0ZTMwOTg5ZCI6N30=', 1785326315);

-- --------------------------------------------------------

--
-- Table structure for table `ticket_tiers`
--

CREATE TABLE `ticket_tiers` (
  `id` bigint UNSIGNED NOT NULL,
  `event_id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `price` decimal(15,2) NOT NULL,
  `start_date` datetime NOT NULL,
  `end_date` datetime NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `transactions`
--

CREATE TABLE `transactions` (
  `id` bigint UNSIGNED NOT NULL,
  `event_id` bigint UNSIGNED NOT NULL,
  `order_id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `customer_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `customer_email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `customer_phone` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `total_price` int NOT NULL,
  `status` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'Pending',
  `snap_token` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `voucher_id` bigint UNSIGNED DEFAULT NULL,
  `discount_amount` decimal(15,2) NOT NULL DEFAULT '0.00',
  `ticket_tier_id` bigint UNSIGNED DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `transactions`
--

INSERT INTO `transactions` (`id`, `event_id`, `order_id`, `customer_name`, `customer_email`, `customer_phone`, `total_price`, `status`, `snap_token`, `created_at`, `updated_at`, `voucher_id`, `discount_amount`, `ticket_tier_id`) VALUES
(1, 2, 'TRX-1785152532-ZFUNH', 'fathya', 'fathya@gmail.com', '098765434567890', 55000, 'success', '997bea86-3278-4b1f-8638-ac45e8ab0843', '2026-07-27 04:42:12', '2026-07-27 04:43:20', NULL, 0.00, NULL),
(2, 1, 'TRX-1785161091-Q3SWU', '3344_ALFATHYA VIANDRA SAFAWI', 'alfathya@students.amikom.ac.id', '12345678999876', 55000, 'success', '4c90cc20-fed1-4a63-a672-605a3ae608e2', '2026-07-27 07:04:51', '2026-07-27 07:05:51', NULL, 0.00, NULL),
(3, 2, 'TRX-1785171139-WUTOG', 'fathya', 'fathya@gmail.com', '098765434567890', 0, 'success', NULL, '2026-07-27 09:52:19', '2026-07-27 09:52:19', 2, 50000.00, NULL),
(4, 1, 'TRX-1785171330-AIMRC', '3344_ALFATHYA VIANDRA SAFAWI', 'alfathya@students.amikom.ac.id', '098765443312', 30000, 'success', 'e6718582-b4fd-45d5-a7be-c67dfd729f78', '2026-07-27 09:55:30', '2026-07-27 09:56:10', 1, 25000.00, NULL),
(5, 1, 'TRX-1785171753-3Z90S', 'fathya safawi', 'fathyasafawi@gmail.com', '09876543213456', 30000, 'success', '4ccfc07d-d791-4b1c-a097-e25e459b220e', '2026-07-27 10:02:33', '2026-07-27 10:03:13', 1, 25000.00, NULL),
(6, 1, 'TRX-1785290262-S9AQY', '3344_ALFATHYA VIANDRA SAFAWI', 'alfathya@students.amikom.ac.id', '098765432123', 30000, 'success', 'd05d35f4-b42b-4c29-bfc5-687bc40347b2', '2026-07-28 18:57:42', '2026-07-28 18:58:26', 1, 25000.00, NULL),
(7, 1, 'TRX-1785290412-YIZA0', '3344_ALFATHYA VIANDRA SAFAWI', 'alfathya@students.amikom.ac.id', '098765443312', 30000, 'success', '82912f13-6c2d-49f0-9e9c-5bfc833312d2', '2026-07-28 19:00:12', '2026-07-28 19:00:37', 1, 25000.00, NULL),
(8, 2, 'TRX-1785290493-IHK59', '3344_ALFATHYA VIANDRA SAFAWI', 'alfathya@students.amikom.ac.id', '098765434567890', 30000, 'success', '3d81b40b-5c12-4b19-b4aa-8803cbdd7f13', '2026-07-28 19:01:33', '2026-07-28 19:01:54', 1, 25000.00, NULL),
(9, 1, 'TRX-1785290559-3AFVO', '3344_ALFATHYA VIANDRA SAFAWI', 'alfathya@students.amikom.ac.id', '098765432123', 30000, 'success', '8e00447a-debe-481c-b44c-836ea4c5579d', '2026-07-28 19:02:39', '2026-07-28 19:02:59', 1, 25000.00, NULL),
(10, 5, 'TRX-1785325800-ARYN4', 'fathya', 'fathyasafawi@gmail.com', '09876543213456', 5060, 'success', '069db04a-34c6-4687-a414-68a135bb80ce', '2026-07-29 04:50:00', '2026-07-29 04:51:06', 1, 60.00, NULL),
(11, 4, 'TRX-1785325954-VTH9U', 'alfathya', 'viandra@gmail.com', '09876543', 67500, 'success', 'cdefe535-5509-4e03-8de6-a4cc74ce301b', '2026-07-29 04:52:34', '2026-07-29 04:53:02', 1, 62500.00, NULL),
(12, 2, 'TRX-1785326086-KQWT6', 'PEMUDA KANTARA', 'pemudakantara@gmail.com', '0987654', 30000, 'success', '1a365f14-2109-48e9-8efd-9b22567297af', '2026-07-29 04:54:46', '2026-07-29 04:55:08', 1, 25000.00, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `google_id` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `avatar` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `role` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'user',
  `status` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'pending' COMMENT 'pending, active, suspended',
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `google_id`, `avatar`, `email_verified_at`, `password`, `role`, `status`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'Admin Amikom', 'admin@amikom.ac.id', NULL, NULL, NULL, '$2y$12$OO/Im19gD7oWSCvB8WgI5Oy70HRP2hEMjWRanj9xNTzwjmaAxByJS', 'admin', 'pending', NULL, '2026-07-27 04:23:16', '2026-07-27 04:23:16'),
(2, '3344_ALFATHYA VIANDRA SAFAWI', 'alfathya@students.amikom.ac.id', '116795757292829128992', 'https://lh3.googleusercontent.com/a/ACg8ocL_jaOkSm0QUKU7OSfBOyyezJU_ujtftwSE26J-ikUQRjSfaA=s96-c', NULL, NULL, 'user', 'pending', NULL, '2026-07-27 06:56:41', '2026-07-27 06:56:41'),
(3, 'HIMASI', 'himasi@gmail.com', NULL, NULL, NULL, '$2y$12$1ItcIB9Te.NVguWhapSJv.ZKquh5sQPyjY0PSxssV80N0YN2gtNgW', 'organizer', 'active', NULL, '2026-07-27 07:25:58', '2026-07-27 07:26:25'),
(4, 'kantara', 'kantara@gmail.com', NULL, NULL, NULL, '$2y$12$BJ5OQyY0sjW5RCOqlm6byOr8VV9h5yk.5GOF2pWcD7/dq17FcQAqi', 'organizer', 'active', NULL, '2026-07-27 09:58:34', '2026-07-27 10:00:03'),
(5, 'fathya safawi', 'fathyasafawi@gmail.com', '103632081632309606091', 'https://lh3.googleusercontent.com/a/ACg8ocIn3L5Xln5TpsUKvmE5mJxZOLz6RPOrvswZ9tFWy8GePWskAg=s96-c', NULL, NULL, 'user', 'pending', NULL, '2026-07-27 10:01:43', '2026-07-27 10:01:43'),
(6, 'PEMUDA', 'pemuda@gmail.com', NULL, NULL, NULL, '$2y$12$4HAXVT29h5lYGk7UZ57L.OsdN.VDMxkpj73JBmkQ0qMjFYV9kLlxq', 'organizer', 'pending', NULL, '2026-07-29 04:39:51', '2026-07-29 04:39:51'),
(7, 'PEMUDA KANTARA', 'pemudakantara@gmail.com', NULL, NULL, NULL, '$2y$12$I/364jpCczvf5Suz0XI2w.CUxoz6tHqOodYZUUCP44CN3xwAgXF52', 'organizer', 'active', NULL, '2026-07-29 04:44:35', '2026-07-29 04:45:25');

-- --------------------------------------------------------

--
-- Table structure for table `vouchers`
--

CREATE TABLE `vouchers` (
  `id` bigint UNSIGNED NOT NULL,
  `code` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `discount_percentage` decimal(5,2) DEFAULT NULL,
  `discount_nominal` decimal(15,2) DEFAULT NULL,
  `valid_until` datetime DEFAULT NULL,
  `quota` int DEFAULT NULL,
  `event_id` bigint UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `vouchers`
--

INSERT INTO `vouchers` (`id`, `code`, `discount_percentage`, `discount_nominal`, `valid_until`, `quota`, `event_id`, `created_at`, `updated_at`) VALUES
(1, 'MAHASISWA50', 50.00, NULL, '2026-08-26 16:51:34', 91, NULL, '2026-07-27 09:51:34', '2026-07-29 04:55:08'),
(2, 'GRATIS', 100.00, NULL, NULL, 9, NULL, '2026-07-27 09:51:34', '2026-07-27 09:52:19');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `cache`
--
ALTER TABLE `cache`
  ADD PRIMARY KEY (`key`),
  ADD KEY `cache_expiration_index` (`expiration`);

--
-- Indexes for table `cache_locks`
--
ALTER TABLE `cache_locks`
  ADD PRIMARY KEY (`key`),
  ADD KEY `cache_locks_expiration_index` (`expiration`);

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `categories_slug_unique` (`slug`);

--
-- Indexes for table `events`
--
ALTER TABLE `events`
  ADD PRIMARY KEY (`id`),
  ADD KEY `events_category_id_foreign` (`category_id`),
  ADD KEY `events_user_id_foreign` (`user_id`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indexes for table `jobs`
--
ALTER TABLE `jobs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `jobs_queue_index` (`queue`);

--
-- Indexes for table `job_batches`
--
ALTER TABLE `job_batches`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `partners`
--
ALTER TABLE `partners`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `password_reset_tokens`
--
ALTER TABLE `password_reset_tokens`
  ADD PRIMARY KEY (`email`);

--
-- Indexes for table `reviews`
--
ALTER TABLE `reviews`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `reviews_event_id_user_id_unique` (`event_id`,`user_id`),
  ADD KEY `reviews_user_id_foreign` (`user_id`);

--
-- Indexes for table `sessions`
--
ALTER TABLE `sessions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sessions_user_id_index` (`user_id`),
  ADD KEY `sessions_last_activity_index` (`last_activity`);

--
-- Indexes for table `ticket_tiers`
--
ALTER TABLE `ticket_tiers`
  ADD PRIMARY KEY (`id`),
  ADD KEY `ticket_tiers_event_id_foreign` (`event_id`);

--
-- Indexes for table `transactions`
--
ALTER TABLE `transactions`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `transactions_order_id_unique` (`order_id`),
  ADD KEY `transactions_event_id_foreign` (`event_id`),
  ADD KEY `transactions_voucher_id_foreign` (`voucher_id`),
  ADD KEY `transactions_ticket_tier_id_foreign` (`ticket_tier_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- Indexes for table `vouchers`
--
ALTER TABLE `vouchers`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `vouchers_code_unique` (`code`),
  ADD KEY `vouchers_event_id_foreign` (`event_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `events`
--
ALTER TABLE `events`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `jobs`
--
ALTER TABLE `jobs`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `partners`
--
ALTER TABLE `partners`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `reviews`
--
ALTER TABLE `reviews`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `ticket_tiers`
--
ALTER TABLE `ticket_tiers`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `transactions`
--
ALTER TABLE `transactions`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `vouchers`
--
ALTER TABLE `vouchers`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `events`
--
ALTER TABLE `events`
  ADD CONSTRAINT `events_category_id_foreign` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `events_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE SET NULL;

--
-- Constraints for table `reviews`
--
ALTER TABLE `reviews`
  ADD CONSTRAINT `reviews_event_id_foreign` FOREIGN KEY (`event_id`) REFERENCES `events` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `reviews_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `ticket_tiers`
--
ALTER TABLE `ticket_tiers`
  ADD CONSTRAINT `ticket_tiers_event_id_foreign` FOREIGN KEY (`event_id`) REFERENCES `events` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `transactions`
--
ALTER TABLE `transactions`
  ADD CONSTRAINT `transactions_event_id_foreign` FOREIGN KEY (`event_id`) REFERENCES `events` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `transactions_ticket_tier_id_foreign` FOREIGN KEY (`ticket_tier_id`) REFERENCES `ticket_tiers` (`id`) ON DELETE SET NULL,
  ADD CONSTRAINT `transactions_voucher_id_foreign` FOREIGN KEY (`voucher_id`) REFERENCES `vouchers` (`id`) ON DELETE SET NULL;

--
-- Constraints for table `vouchers`
--
ALTER TABLE `vouchers`
  ADD CONSTRAINT `vouchers_event_id_foreign` FOREIGN KEY (`event_id`) REFERENCES `events` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
