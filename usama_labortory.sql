-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 25, 2021 at 03:36 PM
-- Server version: 10.4.14-MariaDB
-- PHP Version: 7.4.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `usama_labortory`
--

-- --------------------------------------------------------

--
-- Table structure for table `available_tests`
--

CREATE TABLE `available_tests` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `category_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `testFee` varchar(11) COLLATE utf8mb4_unicode_ci NOT NULL,
  `urgentFee` varchar(11) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `available_tests`
--

INSERT INTO `available_tests` (`id`, `category_id`, `name`, `testFee`, `urgentFee`, `created_at`, `updated_at`) VALUES
(6, 2, 'test one', '1', '2', '2021-05-22 22:01:28', '2021-05-23 00:25:14'),
(7, 2, 'test two', '100', '200', '2021-05-23 00:26:11', '2021-05-24 01:10:00'),
(8, 3, 'latest', '1000', '1500', '2021-05-24 07:07:33', '2021-05-24 07:07:33');

-- --------------------------------------------------------

--
-- Table structure for table `available_test_inventories`
--

CREATE TABLE `available_test_inventories` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `available_test_id` int(11) NOT NULL,
  `inventory_id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `itemUsed` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `available_test_inventories`
--

INSERT INTO `available_test_inventories` (`id`, `available_test_id`, `inventory_id`, `itemUsed`, `created_at`, `updated_at`) VALUES
(1, 1, '1', 200, '2021-05-18 13:59:31', NULL),
(2, 3, '2', 400, '2021-05-21 00:11:59', '2021-05-21 00:11:59'),
(3, 4, '2', 100, '2021-05-21 00:15:39', '2021-05-21 00:15:39'),
(5, 5, '2', 200, '2021-05-21 09:31:02', '2021-05-21 09:44:51'),
(6, 5, '1', 100, '2021-05-21 09:38:32', '2021-05-21 09:42:48'),
(7, 5, '3', 300, '2021-05-21 09:39:25', '2021-05-21 09:39:25'),
(9, 6, '2', 6, '2021-05-22 23:00:02', '2021-05-22 23:00:02'),
(10, 7, '3', 100, '2021-05-23 00:26:11', '2021-05-24 01:10:00'),
(12, 7, '2', 100, '2021-05-23 03:24:05', '2021-05-24 01:10:01'),
(13, 8, '1', 100, '2021-05-24 07:07:33', '2021-05-24 07:07:33'),
(14, 8, '2', 100, '2021-05-24 07:07:33', '2021-05-24 07:07:33');

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `Cname` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `Cname`, `created_at`, `updated_at`) VALUES
(1, 'category1', '2021-05-20 07:12:09', '2021-05-20 07:12:09'),
(2, 'category2', '2021-05-20 07:12:22', '2021-05-20 07:12:22'),
(3, 'category3', '2021-05-20 07:15:01', '2021-05-20 07:15:01');

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `inventories`
--

CREATE TABLE `inventories` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `inventoryName` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `inventoryUnit` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remainingItem` varchar(110) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `inventories`
--

INSERT INTO `inventories` (`id`, `inventoryName`, `inventoryUnit`, `remainingItem`, `created_at`, `updated_at`) VALUES
(1, 'chemical1', 'ml', '1100', '2021-05-20 07:49:56', '2021-05-25 06:42:52'),
(2, 'chemical2', 'ml', '2894', '2021-05-20 07:54:09', '2021-05-25 06:42:52'),
(3, 'chemical3', 'ml', '2200', '2021-05-20 07:54:35', '2021-05-25 03:27:53');

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_100000_create_password_resets_table', 1),
(2, '2019_08_19_000000_create_failed_jobs_table', 1),
(3, '2020_03_30_000003_create_users_table', 1),
(4, '2021_05_09_163711_create_categories_table', 1),
(5, '2021_05_09_164115_create_available_tests_table', 1),
(6, '2021_05_09_164258_create_statuses_table', 1),
(7, '2021_05_09_164434_create_patients_table', 1),
(8, '2021_05_09_164613_create_test_performeds_table', 1),
(9, '2021_05_09_164754_create_patient_categories_table', 1),
(10, '2021_05_11_080126_create_inventories_table', 1),
(11, '2021_05_11_120523_create_available_test_inventories_table', 1);

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `patients`
--

CREATE TABLE `patients` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `Pname` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `phone` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `start_time` datetime NOT NULL,
  `dob` date NOT NULL,
  `catagory` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `gend` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `patients`
--

INSERT INTO `patients` (`id`, `Pname`, `email`, `phone`, `start_time`, `dob`, `catagory`, `gend`, `created_at`, `updated_at`) VALUES
(1, 'Zenia Potts', 'zaner@mailinator.com', '21', '2021-05-21 19:50:00', '1986-02-14', '2', 'male', '2021-05-21 09:48:36', '2021-05-21 10:43:47'),
(2, 'Tana Bowen', 'hycolyz@mailinator.com', '0313656335', '2021-05-25 13:30:00', '1971-12-25', '3', 'male', '2021-05-25 03:32:07', '2021-05-25 03:32:07');

-- --------------------------------------------------------

--
-- Table structure for table `patient_categories`
--

CREATE TABLE `patient_categories` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `Pcategory` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `discount` int(11) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `patient_categories`
--

INSERT INTO `patient_categories` (`id`, `Pcategory`, `discount`, `created_at`, `updated_at`) VALUES
(1, 'patient category 1', 0, '2021-05-21 09:46:50', '2021-05-21 09:46:50'),
(2, 'patient category 2', 20, '2021-05-21 09:47:03', '2021-05-21 09:47:47'),
(3, 'patient category 3', 30, '2021-05-21 09:47:11', '2021-05-21 09:48:03');

-- --------------------------------------------------------

--
-- Table structure for table `statuses`
--

CREATE TABLE `statuses` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `Sname` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `statuses`
--

INSERT INTO `statuses` (`id`, `Sname`, `created_at`, `updated_at`) VALUES
(1, 'Progressing', NULL, NULL),
(2, 'Verified', NULL, NULL),
(3, 'Not Received', NULL, NULL),
(4, 'Cancelled', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `test_performeds`
--

CREATE TABLE `test_performeds` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `available_test_id` bigint(20) UNSIGNED NOT NULL,
  `patient_id` bigint(20) UNSIGNED NOT NULL,
  `Sname_id` bigint(20) UNSIGNED NOT NULL,
  `fee` varchar(11) COLLATE utf8mb4_unicode_ci NOT NULL,
  `type` varchar(200) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `test_performeds`
--

INSERT INTO `test_performeds` (`id`, `available_test_id`, `patient_id`, `Sname_id`, `fee`, `type`, `created_at`, `updated_at`) VALUES
(6, 8, 1, 3, '800', 'standard', '2021-05-24 07:18:49', '2021-05-24 07:18:49'),
(7, 8, 1, 3, '800', 'standard', '2021-05-24 07:36:26', '2021-05-24 07:36:26'),
(8, 8, 1, 1, '800', 'standard', '2021-05-25 03:25:29', '2021-05-25 03:25:29'),
(9, 7, 1, 1, '80', 'standard', '2021-05-25 03:27:54', '2021-05-25 03:27:54'),
(10, 8, 2, 1, '700', 'standard', '2021-05-25 03:33:45', '2021-05-25 03:33:45'),
(11, 8, 1, 1, '1', 'urgent', '2021-05-25 04:05:11', '2021-05-25 04:05:11'),
(12, 8, 1, 2, '20', 'standard', '2021-05-25 06:42:52', '2021-05-25 06:42:52');

-- --------------------------------------------------------

--
-- Table structure for table `test_reports`
--

CREATE TABLE `test_reports` (
  `id` int(11) NOT NULL,
  `test_performed_id` int(11) NOT NULL,
  `test_report_item_id` int(11) NOT NULL,
  `value` varchar(200) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `test_reports`
--

INSERT INTO `test_reports` (`id`, `test_performed_id`, `test_report_item_id`, `value`, `created_at`, `updated_at`) VALUES
(1, 4, 12, '12', '2021-05-23 22:28:39', '2021-05-23 22:28:39'),
(2, 4, 13, '50', '2021-05-23 22:28:39', '2021-05-23 22:28:39'),
(14, 5, 14, '15000', '2021-05-24 02:42:17', '2021-05-24 02:42:17'),
(15, 5, 15, '150', '2021-05-24 02:42:17', '2021-05-24 02:42:17'),
(16, 6, 21, '1500', '2021-05-24 07:18:49', '2021-05-24 07:18:49'),
(17, 6, 22, '3000', '2021-05-24 07:18:49', '2021-05-24 07:18:49'),
(18, 7, 21, '1000', '2021-05-24 07:36:26', '2021-05-24 07:36:26'),
(19, 7, 22, '10000', '2021-05-24 07:36:26', '2021-05-24 07:36:26'),
(20, 8, 21, '20', '2021-05-25 03:25:29', '2021-05-25 03:25:29'),
(21, 8, 22, '20', '2021-05-25 03:25:29', '2021-05-25 03:25:29'),
(22, 9, 14, '10', '2021-05-25 03:27:54', '2021-05-25 03:27:54'),
(23, 9, 15, '10', '2021-05-25 03:27:54', '2021-05-25 03:27:54'),
(24, 10, 21, '100', '2021-05-25 03:33:45', '2021-05-25 03:33:45'),
(25, 10, 22, '200', '2021-05-25 03:33:45', '2021-05-25 03:33:45'),
(26, 11, 21, '12', '2021-05-25 04:05:11', '2021-05-25 04:05:11'),
(27, 11, 22, '322222', '2021-05-25 04:05:11', '2021-05-25 04:05:11'),
(28, 12, 21, '12', '2021-05-25 06:42:52', '2021-05-25 06:42:52'),
(29, 12, 22, '12', '2021-05-25 06:42:52', '2021-05-25 06:42:52');

-- --------------------------------------------------------

--
-- Table structure for table `test_report_items`
--

CREATE TABLE `test_report_items` (
  `id` int(11) NOT NULL,
  `test_id` int(11) NOT NULL,
  `title` varchar(200) DEFAULT NULL,
  `initialNormalValue` varchar(100) DEFAULT NULL,
  `finalNormalValue` varchar(200) DEFAULT NULL,
  `firstCriticalValue` varchar(100) DEFAULT NULL,
  `finalCriticalValue` varchar(100) DEFAULT NULL,
  `unit` varchar(100) DEFAULT NULL,
  `status` varchar(11) DEFAULT 'active',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `test_report_items`
--

INSERT INTO `test_report_items` (`id`, `test_id`, `title`, `initialNormalValue`, `finalNormalValue`, `firstCriticalValue`, `finalCriticalValue`, `unit`, `status`, `created_at`, `updated_at`) VALUES
(1, 1, 'title1', '50', '100', '25', '125', 'ml', 'active', '2021-05-26 02:56:09', NULL),
(2, 6, 'title test', '68', '51', '11', '26', 'ui', 'inactive', '2021-05-22 22:01:29', '2021-05-22 23:00:02'),
(3, 6, 'Report Item1', '1', '2', '4', '5', 'ui3', 'inactive', '2021-05-22 23:00:02', '2021-05-22 23:03:10'),
(4, 6, 'Red Blood Cells', '1', '2', '4', '5', 'ml', 'inactive', '2021-05-22 23:03:10', '2021-05-23 00:25:14'),
(5, 6, 'Red Blood Cells', '1', '2', '4', '5', 'ml', 'active', '2021-05-23 00:25:14', '2021-05-23 00:25:14'),
(6, 7, 'white blood cells', '15', '67', '19', '33', 'cells', 'inactive', '2021-05-23 00:26:11', '2021-05-23 00:26:46'),
(7, 7, 'white blood cells', '15', '67', '19', '33', 'cells', 'inactive', '2021-05-23 00:26:46', '2021-05-23 02:33:10'),
(8, 7, 'white blood cells', '15', '67', '19', '33', 'cells', 'inactive', '2021-05-23 02:33:10', '2021-05-23 03:21:04'),
(9, 7, 'hb', '15', '67', '19', '33', 'mg', 'inactive', '2021-05-23 02:33:10', '2021-05-23 03:21:04'),
(10, 7, 'white blood cells', '15', '67', '19', '33', 'cells', 'inactive', '2021-05-23 03:21:04', '2021-05-23 03:24:05'),
(11, 7, 'hb', '15', '67', '19', '33', 'mg', 'inactive', '2021-05-23 03:21:04', '2021-05-23 03:24:05'),
(12, 7, 'white blood cells', '15', '67', '19', '33', 'cells', 'inactive', '2021-05-23 03:24:05', '2021-05-24 01:10:01'),
(13, 7, 'hb', '15', '67', '19', '33', 'mg', 'inactive', '2021-05-23 03:24:06', '2021-05-24 01:10:01'),
(14, 7, 'white blood cells', '10000', '20000', '8000', '22000', 'cells', 'active', '2021-05-24 01:10:01', '2021-05-24 01:10:01'),
(15, 7, 'hb', '100', '200', '80', '120', 'mg', 'active', '2021-05-24 01:10:01', '2021-05-24 01:10:01'),
(16, 8, 'red blood', '100', '200', '80', '220', 'ml', 'inactive', '2021-05-24 07:07:34', '2021-05-24 07:11:51'),
(17, 8, 'hb', '2000', '3000', '1500', '3500', 'ui', 'inactive', '2021-05-24 07:07:34', '2021-05-24 07:11:51'),
(18, 8, 'red blood 2', '100', '200', '80', '220', 'ml', 'inactive', '2021-05-24 07:11:51', '2021-05-24 07:13:57'),
(19, 8, 'hb', '2000', '3000', '1500', '3500', 'ui', 'inactive', '2021-05-24 07:11:51', '2021-05-24 07:13:57'),
(20, 8, 'hb', '2000', '3000', '1500', '3500', 'ui', 'inactive', '2021-05-24 07:13:57', '2021-05-24 07:17:38'),
(21, 8, 'hb', '2000', '3000', '1500', '3500', 'ui', 'active', '2021-05-24 07:17:38', '2021-05-24 07:17:38'),
(22, 8, 'hb2', '2000', '3000', '1500', '3500', 'ui', 'active', '2021-05-24 07:17:38', '2021-05-24 07:17:38');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `role` varchar(200) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `role`, `name`, `email`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'admin', 'Rana Nadeem Tahir', 'rananadeemsports@gmail.com', NULL, '$2y$10$L24K0Syqqaud5aWvv4Sd0Os/LTlBrGPPrnuVX17JK.9zjCZHcZw7S', 'oOxLMQY3RGjp63izBS8iF5EZiBynHLfOSMtChV0d38yonH2twUBv0rnblR5U', '2021-05-19 09:17:02', '2021-05-19 09:17:02'),
(2, 'technician', 'Channing Lowery', 'daxelo@mailinator.com', NULL, '$2y$10$.RxD6Mr8dJzYRqyZhLJzRuHeYlEU9zt6I3JZhJYq.K1AIN3WDcJe6', NULL, '2021-05-19 09:54:06', '2021-05-19 09:54:06');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `available_tests`
--
ALTER TABLE `available_tests`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `available_tests_name_unique` (`name`),
  ADD KEY `available_tests_category_id_foreign` (`category_id`);

--
-- Indexes for table `available_test_inventories`
--
ALTER TABLE `available_test_inventories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indexes for table `inventories`
--
ALTER TABLE `inventories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`);

--
-- Indexes for table `patients`
--
ALTER TABLE `patients`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `patient_categories`
--
ALTER TABLE `patient_categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `statuses`
--
ALTER TABLE `statuses`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `test_performeds`
--
ALTER TABLE `test_performeds`
  ADD PRIMARY KEY (`id`),
  ADD KEY `test_performeds_available_test_id_foreign` (`available_test_id`),
  ADD KEY `test_performeds_patient_id_foreign` (`patient_id`),
  ADD KEY `test_performeds_sname_id_foreign` (`Sname_id`);

--
-- Indexes for table `test_reports`
--
ALTER TABLE `test_reports`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `test_report_items`
--
ALTER TABLE `test_report_items`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `available_tests`
--
ALTER TABLE `available_tests`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `available_test_inventories`
--
ALTER TABLE `available_test_inventories`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `inventories`
--
ALTER TABLE `inventories`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `patients`
--
ALTER TABLE `patients`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `patient_categories`
--
ALTER TABLE `patient_categories`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `statuses`
--
ALTER TABLE `statuses`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `test_performeds`
--
ALTER TABLE `test_performeds`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `test_reports`
--
ALTER TABLE `test_reports`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;

--
-- AUTO_INCREMENT for table `test_report_items`
--
ALTER TABLE `test_report_items`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `available_tests`
--
ALTER TABLE `available_tests`
  ADD CONSTRAINT `available_tests_category_id_foreign` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `test_performeds`
--
ALTER TABLE `test_performeds`
  ADD CONSTRAINT `test_performeds_available_test_id_foreign` FOREIGN KEY (`available_test_id`) REFERENCES `available_tests` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `test_performeds_patient_id_foreign` FOREIGN KEY (`patient_id`) REFERENCES `patients` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `test_performeds_sname_id_foreign` FOREIGN KEY (`Sname_id`) REFERENCES `statuses` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
