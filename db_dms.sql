-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Aug 29, 2020 at 06:11 AM
-- Server version: 10.4.13-MariaDB
-- PHP Version: 7.3.19

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_dms`
--

-- --------------------------------------------------------

--
-- Table structure for table `departments`
--

CREATE TABLE `departments` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` mediumtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `departments`
--

INSERT INTO `departments` (`id`, `name`, `description`, `created_at`, `updated_at`) VALUES
(1, 'HR', 'HR', '2020-07-04 05:19:26', '2020-07-18 21:51:43'),
(2, 'QA', 'QA', '2020-07-04 05:22:24', '2020-07-04 05:22:30');

-- --------------------------------------------------------

--
-- Table structure for table `documents`
--

CREATE TABLE `documents` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `item_name` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `service_type_id` bigint(20) UNSIGNED NOT NULL,
  `brand` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `model` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `serial_no` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `unit_id` bigint(20) UNSIGNED NOT NULL,
  `department_id` bigint(20) UNSIGNED NOT NULL,
  `user` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `original_placement_location` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `original_document_location` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `last_renewal_date` date NOT NULL,
  `next_renewal_date` date NOT NULL,
  `vendor` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `amount` double(8,2) NOT NULL,
  `remarks` mediumtext COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `file` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `documents`
--

INSERT INTO `documents` (`id`, `item_name`, `service_type_id`, `brand`, `model`, `serial_no`, `unit_id`, `department_id`, `user`, `original_placement_location`, `original_document_location`, `last_renewal_date`, `next_renewal_date`, `vendor`, `amount`, `remarks`, `file`, `created_at`, `updated_at`) VALUES
(1, 'TEST1', 1, 'TEST1', 'TEST1', 'TEST1', 1, 2, 'TEST1', 'TEST1', 'TEST1', '2020-07-07', '2021-07-06', 'TEST1', 4000.00, 'TEST1', NULL, '2020-07-06 01:54:35', '2020-08-12 21:13:02'),
(2, 'TEST2', 1, 'TEST2', 'TEST2', 'TEST2', 3, 1, 'TEST2', 'TEST2', 'TEST2', '2020-07-01', '2021-07-01', 'TEST2', 5000.00, NULL, NULL, '2020-07-06 04:15:56', '2020-07-25 00:10:15'),
(3, 'TEST3', 1, 'TEST3', 'TEST3', 'TEST3', 1, 1, 'TEST3', 'TEST3', 'TEST3', '2020-07-02', '2021-07-02', 'TEST3', 2000.00, 'TEST3', NULL, '2020-07-06 05:00:43', '2020-07-06 05:00:43'),
(4, 'TEST4', 1, 'TEST4', 'TEST4', 'TEST4', 1, 1, 'TEST4', 'TEST4', 'TEST4', '2020-07-04', '2021-07-04', 'TEST4', 2100.00, 'TEST4', NULL, '2020-07-06 05:05:22', '2020-07-06 05:05:22'),
(5, 'TEST5', 1, 'TEST5', 'TEST5', 'TEST5', 2, 2, 'TEST5', 'TEST5', 'TEST5', '2020-06-30', '2021-06-30', 'TEST5', 2500.00, 'TEST5', NULL, '2020-07-06 05:15:20', '2020-07-06 06:05:22'),
(6, 'TEST6', 1, 'TEST6', 'TEST6', 'TEST6', 2, 2, 'TEST6', 'TEST6', 'TEST6', '2020-07-08', '2021-07-08', 'TEST6', 2500.00, 'TEST6', NULL, '2020-07-06 05:37:57', '2020-07-06 06:05:50'),
(7, 'TEST7', 1, 'TEST7', 'TEST7', 'TEST7', 1, 2, 'TEST7', 'TEST7', 'TEST7', '2020-07-09', '2021-07-09', 'TEST7', 6500.00, NULL, NULL, '2020-07-06 05:41:41', '2020-07-06 06:06:12'),
(8, 'TEST8', 1, 'TEST8', 'TEST8', 'TEST8', 3, 2, 'TEST8', 'TEST8', 'TEST8', '2020-07-10', '2021-07-10', 'TEST8', 6500.00, NULL, NULL, '2020-07-06 05:57:09', '2020-07-06 06:06:33'),
(9, 'TEST9', 1, 'TEST9', 'TEST9', 'TEST9', 3, 2, 'TEST9', 'TEST9', 'TEST9', '2020-07-07', '2021-07-07', 'TEST9', 3000.00, NULL, NULL, '2020-07-06 06:04:08', '2020-07-06 06:06:48'),
(10, 'TEST10', 1, 'TEST10', 'TEST10', 'TEST10', 1, 2, 'TEST10', 'TEST10', 'TEST10', '2020-07-08', '2021-07-08', 'TEST10', 1000.00, NULL, 'file_format_1594788393.xls', '2020-07-07 05:18:41', '2020-07-14 23:07:00'),
(11, 'TEST11', 1, 'TEST11', 'TEST11', 'TEST11', 2, 1, 'TEST11', 'TEST11', 'TEST11', '2020-07-08', '2021-07-08', 'TEST11', 4500.00, 'TEST11', 'file_format_pts_1595327124.csv', '2020-07-07 22:11:52', '2020-07-21 04:25:24');

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

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
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_resets_table', 1),
(3, '2019_08_19_000000_create_failed_jobs_table', 1),
(4, '2020_07_02_084908_create_units_table', 2),
(5, '2020_07_04_095335_create_departments_table', 3),
(6, '2020_07_05_054924_create_service_types_table', 4),
(7, '2020_07_05_095414_create_documents_table', 5),
(8, '2020_07_05_100723_create_documents_table', 6),
(9, '2020_07_06_061501_create_documents_table', 7),
(10, '2020_07_06_065015_create_documents_table', 8),
(11, '2020_07_06_065232_create_documents_table', 9),
(13, '2020_07_06_095231_add_file_to_documents_table', 10),
(14, '2020_07_15_062056_add_unit_department_to_users_table', 11);

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
-- Table structure for table `service_types`
--

CREATE TABLE `service_types` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` mediumtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `service_types`
--

INSERT INTO `service_types` (`id`, `name`, `description`, `created_at`, `updated_at`) VALUES
(1, 'Yearly Calibration', 'Yearly Calibration', '2020-07-05 03:14:37', '2020-07-18 21:52:59');

-- --------------------------------------------------------

--
-- Table structure for table `test`
--

CREATE TABLE `test` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `units`
--

CREATE TABLE `units` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` mediumtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `units`
--

INSERT INTO `units` (`id`, `name`, `description`, `created_at`, `updated_at`) VALUES
(1, 'ISML-1', 'ISML-1', '2020-07-04 02:10:01', '2020-07-04 03:56:22'),
(2, 'ISML-2', 'ISML-2', '2020-07-04 02:13:58', '2020-07-04 03:56:13'),
(3, 'ECOFAB', 'ECOFAB', '2020-07-04 02:14:17', '2020-07-04 02:14:17');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `unit_id` int(11) DEFAULT NULL,
  `department_id` int(11) DEFAULT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `unit_id`, `department_id`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'NIPUN', 'nipun.sarker@interfabshirt.com', NULL, '$2y$10$R1pAqe0gLp9tDfH.JBNdguBjg9m1t1ynajfZQTY7Z9Ff1KAtlIXw6', NULL, NULL, 'nYutmQQVAzlaaFEwEf4gJmxASfXq86zmLvqwssEuxIzPRao2Ib0gKg2XtBiR', '2020-07-02 01:44:21', '2020-07-14 05:26:10'),
(9, 'Saiful Amin', 'saiful.amin@interfabshirt.com', NULL, '$2y$10$p32k3eRKFmcza7T5h5lG1eZxoHipPlEammSlUcR93iuNftKNIN8.W', NULL, NULL, NULL, '2020-08-26 00:11:53', '2020-08-26 00:11:53');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `departments`
--
ALTER TABLE `departments`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `documents`
--
ALTER TABLE `documents`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
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
-- Indexes for table `service_types`
--
ALTER TABLE `service_types`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `test`
--
ALTER TABLE `test`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `units`
--
ALTER TABLE `units`
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
-- AUTO_INCREMENT for table `departments`
--
ALTER TABLE `departments`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `documents`
--
ALTER TABLE `documents`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `service_types`
--
ALTER TABLE `service_types`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `test`
--
ALTER TABLE `test`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `units`
--
ALTER TABLE `units`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
