-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 06, 2026 at 03:13 AM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `healthcare_hms`
--

-- --------------------------------------------------------

--
-- Table structure for table `appointments`
--

CREATE TABLE `appointments` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `doctor_id` bigint(20) UNSIGNED NOT NULL,
  `patient_id` bigint(20) UNSIGNED NOT NULL,
  `date` date NOT NULL,
  `time_slot` varchar(255) DEFAULT NULL,
  `status` varchar(255) NOT NULL DEFAULT 'booked',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `appointments`
--

INSERT INTO `appointments` (`id`, `doctor_id`, `patient_id`, `date`, `time_slot`, `status`, `created_at`, `updated_at`) VALUES
(6, 2, 12, '2026-01-07', '17:08:00 - 18:08:00', 'booked', '2026-01-05 17:47:44', '2026-01-05 17:47:44'),
(7, 2, 12, '2026-01-11', '16:06:00 - 19:06:00', 'booked', '2026-01-05 17:47:47', '2026-01-05 17:47:47'),
(8, 12, 12, '2026-01-07', '20:31:00 - 22:31:00', 'booked', '2026-01-05 19:32:33', '2026-01-05 19:32:33');

-- --------------------------------------------------------

--
-- Table structure for table `bookings`
--

CREATE TABLE `bookings` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `package_title` varchar(255) NOT NULL,
  `package_price` decimal(10,2) DEFAULT NULL,
  `patient_id` bigint(20) UNSIGNED NOT NULL,
  `booking_date` date DEFAULT NULL,
  `time_slot` varchar(255) DEFAULT NULL,
  `amount` decimal(10,2) DEFAULT NULL,
  `status` varchar(255) NOT NULL DEFAULT 'pending',
  `notes` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `bookings`
--

INSERT INTO `bookings` (`id`, `package_title`, `package_price`, `patient_id`, `booking_date`, `time_slot`, `amount`, `status`, `notes`, `created_at`, `updated_at`) VALUES
(38, 'Whole Body Check', 699.00, 12, '2026-01-09', '45', 699.00, 'pending', NULL, '2026-01-05 18:29:01', '2026-01-05 18:29:01'),
(39, 'Whole Body Check', 599.00, 12, '2026-01-10', '45', 599.00, 'pending', NULL, '2026-01-05 18:29:09', '2026-01-05 18:29:09');

-- --------------------------------------------------------

--
-- Table structure for table `cache`
--

CREATE TABLE `cache` (
  `key` varchar(255) NOT NULL,
  `value` mediumtext NOT NULL,
  `expiration` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `cache_locks`
--

CREATE TABLE `cache_locks` (
  `key` varchar(255) NOT NULL,
  `owner` varchar(255) NOT NULL,
  `expiration` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `doctors`
--

CREATE TABLE `doctors` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `specialization` varchar(255) DEFAULT NULL,
  `qualifications` varchar(255) DEFAULT NULL,
  `license_number` varchar(255) DEFAULT NULL,
  `years_experience` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `doctors`
--

INSERT INTO `doctors` (`id`, `user_id`, `specialization`, `qualifications`, `license_number`, `years_experience`, `created_at`, `updated_at`) VALUES
(2, 10, 'Medicine', NULL, NULL, NULL, '2026-01-05 03:04:30', '2026-01-05 03:04:30'),
(3, 17, 'Medicine', NULL, NULL, NULL, '2026-01-05 03:04:30', '2026-01-05 03:04:30'),
(9, 23, 'Cardiology', NULL, NULL, NULL, '2026-01-05 07:05:58', '2026-01-05 07:05:58'),
(10, 24, 'Neurology', NULL, NULL, NULL, '2026-01-05 07:08:26', '2026-01-05 07:08:26'),
(11, 25, 'Orthopedics', NULL, NULL, NULL, '2026-01-05 11:06:00', '2026-01-05 11:06:00'),
(12, 26, 'Oncologist', NULL, NULL, NULL, '2026-01-05 18:28:16', '2026-01-05 18:28:16'),
(14, 29, 'Pediatrics', NULL, NULL, NULL, '2026-01-05 18:41:18', '2026-01-05 18:41:18');

-- --------------------------------------------------------

--
-- Table structure for table `doctor_schedules`
--

CREATE TABLE `doctor_schedules` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `doctor_id` bigint(20) UNSIGNED NOT NULL,
  `day_of_week` varchar(255) NOT NULL,
  `start_time` time NOT NULL,
  `end_time` time NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `doctor_schedules`
--

INSERT INTO `doctor_schedules` (`id`, `doctor_id`, `day_of_week`, `start_time`, `end_time`, `created_at`, `updated_at`) VALUES
(3, 10, 'Friday', '16:47:00', '20:47:00', '2026-01-05 11:47:21', '2026-01-05 11:47:21'),
(4, 10, 'Wednesday', '16:47:00', '17:47:00', '2026-01-05 11:47:53', '2026-01-05 11:47:53'),
(5, 10, 'Sunday', '16:02:00', '17:02:00', '2026-01-05 12:02:22', '2026-01-05 12:02:22'),
(7, 2, 'Sunday', '16:06:00', '19:06:00', '2026-01-05 12:06:13', '2026-01-05 12:06:13'),
(8, 2, 'Wednesday', '17:08:00', '18:08:00', '2026-01-05 12:08:09', '2026-01-05 12:08:09'),
(9, 2, 'Friday', '17:10:00', '22:10:00', '2026-01-05 12:10:10', '2026-01-05 12:10:10'),
(11, 12, 'Wednesday', '20:31:00', '22:31:00', '2026-01-05 19:32:09', '2026-01-05 19:32:09'),
(12, 12, 'Friday', '20:31:00', '22:31:00', '2026-01-05 19:32:09', '2026-01-05 19:32:09'),
(13, 12, 'Sunday', '20:31:00', '22:31:00', '2026-01-05 19:32:09', '2026-01-05 19:32:09');

-- --------------------------------------------------------

--
-- Table structure for table `donors`
--

CREATE TABLE `donors` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `phone` varchar(255) NOT NULL,
  `address` varchar(255) DEFAULT NULL,
  `blood_group` varchar(255) NOT NULL,
  `status` enum('active','inactive') NOT NULL DEFAULT 'active',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `donors`
--

INSERT INTO `donors` (`id`, `user_id`, `name`, `email`, `phone`, `address`, `blood_group`, `status`, `created_at`, `updated_at`) VALUES
(10, 12, 'nisha', 'n@example.com', '01621924444', 'Dhaka', 'O+', 'active', '2026-01-05 19:30:20', '2026-01-05 19:30:20');

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` varchar(255) NOT NULL,
  `connection` text NOT NULL,
  `queue` text NOT NULL,
  `payload` longtext NOT NULL,
  `exception` longtext NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `jobs`
--

CREATE TABLE `jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `queue` varchar(255) NOT NULL,
  `payload` longtext NOT NULL,
  `attempts` tinyint(3) UNSIGNED NOT NULL,
  `reserved_at` int(10) UNSIGNED DEFAULT NULL,
  `available_at` int(10) UNSIGNED NOT NULL,
  `created_at` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `job_batches`
--

CREATE TABLE `job_batches` (
  `id` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `total_jobs` int(11) NOT NULL,
  `pending_jobs` int(11) NOT NULL,
  `failed_jobs` int(11) NOT NULL,
  `failed_job_ids` longtext NOT NULL,
  `options` mediumtext DEFAULT NULL,
  `cancelled_at` int(11) DEFAULT NULL,
  `created_at` int(11) NOT NULL,
  `finished_at` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '0001_01_01_000000_create_users_table', 1),
(2, '0001_01_01_000001_create_cache_table', 1),
(3, '0001_01_01_000002_create_jobs_table', 1),
(4, '2025_12_30_072131_create_permission_tables', 1),
(5, '2025_12_30_072132_add_two_factor_columns_to_users_table', 1),
(6, '2025_12_30_172246_add_profile_fields_to_users_table', 2),
(7, '2025_12_30_172747_add_profile_fields_to_users_table', 2),
(8, '2025_12_30_175015_add_extended_profile_fields_to_users_table', 3),
(9, '2025_12_31_160143_add_status_and_role_to_users_table', 4),
(12, '2026_01_05_083445_create_doctors_table', 7),
(13, '2026_01_05_094453_make_time_slot_nullable_in_appointments_table', 8),
(14, '2026_01_05_150328_create_donors_table', 9),
(15, '2026_01_05_151528_create_donors_table', 10),
(16, '2026_01_05_071641_create_doctor_schedules_table', 11),
(17, '2026_01_05_080909_create_appointments_table', 12),
(18, '2026_01_06_000001_create_prescriptions_table', 13),
(20, '2026_01_06_000002_create_bookings_table', 14);

-- --------------------------------------------------------

--
-- Table structure for table `model_has_permissions`
--

CREATE TABLE `model_has_permissions` (
  `permission_id` bigint(20) UNSIGNED NOT NULL,
  `model_type` varchar(255) NOT NULL,
  `model_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `model_has_roles`
--

CREATE TABLE `model_has_roles` (
  `role_id` bigint(20) UNSIGNED NOT NULL,
  `model_type` varchar(255) NOT NULL,
  `model_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `model_has_roles`
--

INSERT INTO `model_has_roles` (`role_id`, `model_type`, `model_id`) VALUES
(1, 'App\\Models\\User', 2),
(2, 'App\\Models\\User', 3),
(3, 'App\\Models\\User', 5),
(3, 'App\\Models\\User', 6),
(3, 'App\\Models\\User', 7);

-- --------------------------------------------------------

--
-- Table structure for table `packages`
--

CREATE TABLE `packages` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `package_title` varchar(255) NOT NULL,
  `package_price` decimal(10,2) DEFAULT NULL,
  `patient_id` bigint(20) UNSIGNED NOT NULL,
  `booking_date` date DEFAULT NULL,
  `time_slot` varchar(255) DEFAULT NULL,
  `amount` decimal(10,2) DEFAULT NULL,
  `status` varchar(255) NOT NULL DEFAULT 'pending',
  `notes` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `password_reset_tokens`
--

CREATE TABLE `password_reset_tokens` (
  `email` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `permissions`
--

CREATE TABLE `permissions` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `guard_name` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `prescriptions`
--

CREATE TABLE `prescriptions` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `doctor_id` bigint(20) UNSIGNED NOT NULL,
  `patient_id` bigint(20) UNSIGNED NOT NULL,
  `content` text NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `prescriptions`
--

INSERT INTO `prescriptions` (`id`, `doctor_id`, `patient_id`, `content`, `created_at`, `updated_at`) VALUES
(3, 12, 12, 'Napa Extra Extended Ultra Pro Max', '2026-01-05 19:33:42', '2026-01-05 19:33:42');

-- --------------------------------------------------------

--
-- Table structure for table `roles`
--

CREATE TABLE `roles` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `guard_name` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `roles`
--

INSERT INTO `roles` (`id`, `name`, `guard_name`, `created_at`, `updated_at`) VALUES
(1, 'admin', 'web', '2025-12-30 02:11:02', '2025-12-30 02:11:02'),
(2, 'doctor', 'web', '2025-12-30 02:11:02', '2025-12-30 02:11:02'),
(3, 'patient', 'web', '2025-12-30 02:11:02', '2025-12-30 02:11:02');

-- --------------------------------------------------------

--
-- Table structure for table `role_has_permissions`
--

CREATE TABLE `role_has_permissions` (
  `permission_id` bigint(20) UNSIGNED NOT NULL,
  `role_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `sessions`
--

CREATE TABLE `sessions` (
  `id` varchar(255) NOT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `ip_address` varchar(45) DEFAULT NULL,
  `user_agent` text DEFAULT NULL,
  `payload` longtext NOT NULL,
  `last_activity` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `sessions`
--

INSERT INTO `sessions` (`id`, `user_id`, `ip_address`, `user_agent`, `payload`, `last_activity`) VALUES
('Bhj2wdSdZeOdwzyD5wrylWZOamwWKFFBiCvQZEAq', 2, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/143.0.0.0 Safari/537.36', 'YTo0OntzOjY6Il90b2tlbiI7czo0MDoiWVVJMHRsajE1cVRZOXBXRzdNb1pYM3hjY1J5Y3ZjRjZvbEw1Wmt6TiI7czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6NDE6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC9hZG1pbi9ib29raW5ncy9qc29uIjtzOjU6InJvdXRlIjtOO31zOjUwOiJsb2dpbl93ZWJfNTliYTM2YWRkYzJiMmY5NDAxNTgwZjAxNGM3ZjU4ZWE0ZTMwOTg5ZCI7aToyO30=', 1767665412);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `blood_group` varchar(3) DEFAULT NULL,
  `address` varchar(255) DEFAULT NULL,
  `phone` varchar(20) DEFAULT NULL,
  `profile_picture` varchar(255) DEFAULT NULL,
  `dob` date DEFAULT NULL,
  `gender` varchar(255) DEFAULT NULL,
  `emergency_contact` varchar(255) DEFAULT NULL,
  `insurance_provider` varchar(255) DEFAULT NULL,
  `policy_number` varchar(255) DEFAULT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `two_factor_secret` text DEFAULT NULL,
  `two_factor_recovery_codes` text DEFAULT NULL,
  `two_factor_confirmed_at` timestamp NULL DEFAULT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `status` varchar(255) NOT NULL DEFAULT 'pending',
  `role` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `blood_group`, `address`, `phone`, `profile_picture`, `dob`, `gender`, `emergency_contact`, `insurance_provider`, `policy_number`, `email_verified_at`, `password`, `two_factor_secret`, `two_factor_recovery_codes`, `two_factor_confirmed_at`, `remember_token`, `created_at`, `updated_at`, `status`, `role`) VALUES
(2, 'Super Admin', 'admin@example.com', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '$2y$12$cQOXdHI6aTUaUTB9UWUepOh3uUlsjpQK/65e4pqCCSAFFl7nYwJ2G', NULL, NULL, NULL, NULL, '2025-12-30 02:11:02', '2025-12-31 10:42:58', 'approved', 'admin'),
(10, 'GOLAM MOSTAFA', 'a@example.com', NULL, NULL, '01621924444', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '$2y$12$OiKSTAnnTQO4ia4Hb62W4eq3mUbpOENNKzaAdCKs4uzHd7P4Th4j2', NULL, NULL, NULL, NULL, '2025-12-31 11:40:14', '2025-12-31 11:41:17', 'approved', 'doctor'),
(12, 'nisha', 'n@example.com', 'O+', 'Dhaka', '01621924444', NULL, '2026-01-01', 'Female', '435345', '34534', '345534', NULL, '$2y$12$8yvD1OXDVJZ6TeZEV9Kg2uN6yK4LT3xWVFeO3HJjtvuD2TZtDuRHW', NULL, NULL, NULL, NULL, '2025-12-31 11:40:59', '2026-01-05 09:54:56', 'approved', 'patient'),
(14, 'Mostafa', 'dfs@gmail.com', NULL, NULL, '01621924444', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '$2y$12$wBLhB1mVcOgjjmCGfO5DxOqmtb2JzEbrCj44yRGhM01qw753VodN6', NULL, NULL, NULL, NULL, '2025-12-31 11:57:07', '2025-12-31 11:57:11', 'approved', 'patient'),
(17, 'masud', 'masud@masud.com', NULL, NULL, '2313', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '$2y$12$j5pGKQkqfX2Bzc8oVZKNLOk2abyLrWjkx1ktZzrTAOGULtaGPia2O', NULL, NULL, NULL, NULL, '2025-12-31 13:12:53', '2025-12-31 13:17:12', 'approved', 'doctor'),
(23, 'MOFIJUL ISLAM', 'ura@g.com', NULL, NULL, '32112323', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '$2y$12$0/w5zzsJGFeYTI232z329u0oFl0LrMxJm2HQgkiuqykFG9zIJjrkK', NULL, NULL, NULL, NULL, '2026-01-05 07:05:58', '2026-01-05 07:05:58', 'approved', 'doctor'),
(24, 'AHTESHAM IBNE MOSTAFA', 'ahteshamibnemostofa@gmail.com', NULL, NULL, '01621924444', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '$2y$12$00j43I9bHha2mA7rmzjPluHLio6RA3QRTvB7ABcOD9A5AXqHGGm8y', NULL, NULL, NULL, NULL, '2026-01-05 07:08:26', '2026-01-05 07:08:26', 'approved', 'doctor'),
(25, 'Kuddus ALi', 'ali@example.com', NULL, NULL, '342343', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '$2y$12$LKyaddSgYVCYNRJqwV0eNeOE8LluT9ZZRTqa6jXpsDxF3cKybqlbW', NULL, NULL, NULL, NULL, '2026-01-05 11:06:00', '2026-01-05 11:06:00', 'approved', 'doctor'),
(26, 'Strange', 'doctor@example.com', NULL, NULL, '01621924444', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '$2y$12$eYnk0fN0AcqfF3G6dwMrIOoTrMfuL7KD/BcGqHDQektgB8KKrCRNy', NULL, NULL, NULL, NULL, '2026-01-05 18:28:16', '2026-01-05 18:28:16', 'approved', 'doctor'),
(29, 'Kobiraj', 'kobi@raj.com', NULL, NULL, '45345', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '$2y$12$tAZ3rku4rFfXVbG8KL.kmu5R2CgOLAG0Y.nEh/f2vriv3hWnk1EnG', NULL, NULL, NULL, NULL, '2026-01-05 18:41:18', '2026-01-05 18:41:18', 'approved', 'doctor'),
(30, 'Mostafa', 'fdggfdgf@dsfds.com', NULL, NULL, '01621924444', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '$2y$12$dLEopmZ1YrW88NXYrRdQN.ctWSLo0rrXbR6HI1h4fACoI9e2e5sv.', NULL, NULL, NULL, NULL, '2026-01-05 19:27:50', '2026-01-05 19:27:50', 'pending', 'patient');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `appointments`
--
ALTER TABLE `appointments`
  ADD PRIMARY KEY (`id`),
  ADD KEY `appointments_doctor_id_foreign` (`doctor_id`),
  ADD KEY `appointments_patient_id_foreign` (`patient_id`);

--
-- Indexes for table `bookings`
--
ALTER TABLE `bookings`
  ADD PRIMARY KEY (`id`),
  ADD KEY `bookings_patient_id_foreign` (`patient_id`);

--
-- Indexes for table `cache`
--
ALTER TABLE `cache`
  ADD PRIMARY KEY (`key`);

--
-- Indexes for table `cache_locks`
--
ALTER TABLE `cache_locks`
  ADD PRIMARY KEY (`key`);

--
-- Indexes for table `doctors`
--
ALTER TABLE `doctors`
  ADD PRIMARY KEY (`id`),
  ADD KEY `doctors_user_id_foreign` (`user_id`);

--
-- Indexes for table `doctor_schedules`
--
ALTER TABLE `doctor_schedules`
  ADD PRIMARY KEY (`id`),
  ADD KEY `doctor_schedules_doctor_id_foreign` (`doctor_id`);

--
-- Indexes for table `donors`
--
ALTER TABLE `donors`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `donors_email_unique` (`email`),
  ADD KEY `donors_user_id_foreign` (`user_id`);

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
-- Indexes for table `model_has_permissions`
--
ALTER TABLE `model_has_permissions`
  ADD PRIMARY KEY (`permission_id`,`model_id`,`model_type`),
  ADD KEY `model_has_permissions_model_id_model_type_index` (`model_id`,`model_type`);

--
-- Indexes for table `model_has_roles`
--
ALTER TABLE `model_has_roles`
  ADD PRIMARY KEY (`role_id`,`model_id`,`model_type`),
  ADD KEY `model_has_roles_model_id_model_type_index` (`model_id`,`model_type`);

--
-- Indexes for table `packages`
--
ALTER TABLE `packages`
  ADD PRIMARY KEY (`id`),
  ADD KEY `packages_patient_id_foreign` (`patient_id`);

--
-- Indexes for table `password_reset_tokens`
--
ALTER TABLE `password_reset_tokens`
  ADD PRIMARY KEY (`email`);

--
-- Indexes for table `permissions`
--
ALTER TABLE `permissions`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `permissions_name_guard_name_unique` (`name`,`guard_name`);

--
-- Indexes for table `prescriptions`
--
ALTER TABLE `prescriptions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `prescriptions_doctor_id_foreign` (`doctor_id`),
  ADD KEY `prescriptions_patient_id_foreign` (`patient_id`);

--
-- Indexes for table `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `roles_name_guard_name_unique` (`name`,`guard_name`);

--
-- Indexes for table `role_has_permissions`
--
ALTER TABLE `role_has_permissions`
  ADD PRIMARY KEY (`permission_id`,`role_id`),
  ADD KEY `role_has_permissions_role_id_foreign` (`role_id`);

--
-- Indexes for table `sessions`
--
ALTER TABLE `sessions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sessions_user_id_index` (`user_id`),
  ADD KEY `sessions_last_activity_index` (`last_activity`);

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
-- AUTO_INCREMENT for table `appointments`
--
ALTER TABLE `appointments`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `bookings`
--
ALTER TABLE `bookings`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=40;

--
-- AUTO_INCREMENT for table `doctors`
--
ALTER TABLE `doctors`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `doctor_schedules`
--
ALTER TABLE `doctor_schedules`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `donors`
--
ALTER TABLE `donors`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `jobs`
--
ALTER TABLE `jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `packages`
--
ALTER TABLE `packages`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `permissions`
--
ALTER TABLE `permissions`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `prescriptions`
--
ALTER TABLE `prescriptions`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `roles`
--
ALTER TABLE `roles`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `appointments`
--
ALTER TABLE `appointments`
  ADD CONSTRAINT `appointments_doctor_id_foreign` FOREIGN KEY (`doctor_id`) REFERENCES `doctors` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `appointments_patient_id_foreign` FOREIGN KEY (`patient_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `bookings`
--
ALTER TABLE `bookings`
  ADD CONSTRAINT `bookings_patient_id_foreign` FOREIGN KEY (`patient_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `doctors`
--
ALTER TABLE `doctors`
  ADD CONSTRAINT `doctors_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `doctor_schedules`
--
ALTER TABLE `doctor_schedules`
  ADD CONSTRAINT `doctor_schedules_doctor_id_foreign` FOREIGN KEY (`doctor_id`) REFERENCES `doctors` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `donors`
--
ALTER TABLE `donors`
  ADD CONSTRAINT `donors_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `model_has_permissions`
--
ALTER TABLE `model_has_permissions`
  ADD CONSTRAINT `model_has_permissions_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `model_has_roles`
--
ALTER TABLE `model_has_roles`
  ADD CONSTRAINT `model_has_roles_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `packages`
--
ALTER TABLE `packages`
  ADD CONSTRAINT `packages_patient_id_foreign` FOREIGN KEY (`patient_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `prescriptions`
--
ALTER TABLE `prescriptions`
  ADD CONSTRAINT `prescriptions_doctor_id_foreign` FOREIGN KEY (`doctor_id`) REFERENCES `doctors` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `prescriptions_patient_id_foreign` FOREIGN KEY (`patient_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `role_has_permissions`
--
ALTER TABLE `role_has_permissions`
  ADD CONSTRAINT `role_has_permissions_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `role_has_permissions_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
