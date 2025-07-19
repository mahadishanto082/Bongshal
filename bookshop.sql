-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 01, 2025 at 11:01 AM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `bookshop`
--

-- --------------------------------------------------------

--
-- Table structure for table `activity_log`
--

CREATE TABLE `activity_log` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `log_name` varchar(255) DEFAULT NULL,
  `description` text NOT NULL,
  `subject_type` varchar(255) DEFAULT NULL,
  `event` varchar(255) DEFAULT NULL,
  `subject_id` bigint(20) UNSIGNED DEFAULT NULL,
  `causer_type` varchar(255) DEFAULT NULL,
  `causer_id` bigint(20) UNSIGNED DEFAULT NULL,
  `properties` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`properties`)),
  `batch_uuid` char(36) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `activity_log`
--

INSERT INTO `activity_log` (`id`, `log_name`, `description`, `subject_type`, `event`, `subject_id`, `causer_type`, `causer_id`, `properties`, `batch_uuid`, `created_at`, `updated_at`) VALUES
(1, 'default', 'created', 'App\\Models\\Category', 'created', 4, 'App\\Models\\Admin', 1, '{\"attributes\":{\"id\":4,\"slug\":\"65d1d882cac56-test\",\"parent_id\":0,\"name\":\"test\",\"description\":\"test\",\"image\":null,\"status\":\"Active\",\"feature\":\"No\",\"created_at\":\"2024-02-18T10:14:26.000000Z\",\"updated_at\":\"2024-02-18T10:14:26.000000Z\"}}', NULL, '2024-02-18 10:14:26', '2024-02-18 10:14:26'),
(2, 'default', 'deleted', 'App\\Models\\Category', 'deleted', 4, 'App\\Models\\Admin', 1, '{\"old\":{\"id\":4,\"slug\":\"65d1d882cac56-test\",\"parent_id\":0,\"name\":\"test\",\"description\":\"test\",\"image\":null,\"status\":\"Active\",\"feature\":\"No\",\"created_at\":\"2024-02-18T10:14:26.000000Z\",\"updated_at\":\"2024-02-18T10:14:26.000000Z\"}}', NULL, '2024-02-18 10:17:56', '2024-02-18 10:17:56'),
(3, 'default', 'updated', 'App\\Models\\Category', 'updated', 1, 'App\\Models\\Admin', 1, '{\"attributes\":{\"id\":1,\"slug\":\"65d1e56a1b428-category-1\",\"parent_id\":0,\"name\":\"Category 1\",\"description\":\"test edit\",\"image\":null,\"status\":\"Active\",\"feature\":\"Yes\",\"created_at\":\"2023-10-25T05:15:13.000000Z\",\"updated_at\":\"2024-02-18T11:09:30.000000Z\"},\"old\":{\"id\":1,\"slug\":\"6538a4614111f-category-1\",\"parent_id\":0,\"name\":\"Category 1\",\"description\":\"test\",\"image\":null,\"status\":\"Active\",\"feature\":\"Yes\",\"created_at\":\"2023-10-25T05:15:13.000000Z\",\"updated_at\":\"2023-10-25T05:15:13.000000Z\"}}', NULL, '2024-02-18 11:09:30', '2024-02-18 11:09:30');

-- --------------------------------------------------------

--
-- Table structure for table `admins`
--

CREATE TABLE `admins` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(191) DEFAULT NULL,
  `mobile` varchar(15) DEFAULT NULL,
  `image` varchar(255) DEFAULT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `status` enum('Active','Inactive') NOT NULL DEFAULT 'Inactive',
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `admins`
--

INSERT INTO `admins` (`id`, `name`, `email`, `mobile`, `image`, `email_verified_at`, `password`, `status`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'Mr Admin', 'admin@bookshop.com', '01700000000', NULL, '2023-10-22 08:38:11', '$2y$10$Z8sYeAp0XqPSqjDFkx2LjOknXFRuLqbppBfcnYpuBpoQisUwNuFVW', 'Active', NULL, '2023-10-22 08:38:11', '2023-10-22 08:38:11');

-- --------------------------------------------------------

--
-- Table structure for table `brands`
--

CREATE TABLE `brands` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `slug` varchar(191) DEFAULT NULL,
  `name` varchar(255) NOT NULL,
  `description` text DEFAULT NULL,
  `image` varchar(255) DEFAULT NULL,
  `status` enum('Active','Inactive') NOT NULL DEFAULT 'Inactive',
  `feature` enum('Yes','No') NOT NULL DEFAULT 'No',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `brands`
--

INSERT INTO `brands` (`id`, `slug`, `name`, `description`, `image`, `status`, `feature`, `created_at`, `updated_at`) VALUES
(1, '6538a54c86389-brand-1', 'Brand 1', NULL, NULL, 'Active', 'Yes', '2023-10-25 05:19:08', '2023-10-25 05:19:08'),
(2, '6538a5598b206-brand-2', 'Brand 2', NULL, NULL, 'Active', 'Yes', '2023-10-25 05:19:21', '2023-10-25 05:19:21'),
(3, '6538a5681c5ae-brand-3', 'Brand 3', NULL, NULL, 'Active', 'Yes', '2023-10-25 05:19:36', '2023-10-25 05:19:36');

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `slug` varchar(191) DEFAULT NULL,
  `parent_id` bigint(20) UNSIGNED NOT NULL DEFAULT 0,
  `name` varchar(255) NOT NULL,
  `description` text DEFAULT NULL,
  `image` varchar(255) DEFAULT NULL,
  `status` enum('Active','Inactive') NOT NULL DEFAULT 'Inactive',
  `feature` enum('Yes','No') NOT NULL DEFAULT 'No',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `slug`, `parent_id`, `name`, `description`, `image`, `status`, `feature`, `created_at`, `updated_at`) VALUES
(1, '65d1e56a1b428-category-1', 0, 'Category 1', 'test edit', NULL, 'Active', 'Yes', '2023-10-25 05:15:13', '2024-02-18 11:09:30'),
(2, '6538a47405b7f-category-2', 0, 'Category 2', 'test', NULL, 'Active', 'Yes', '2023-10-25 05:15:32', '2023-10-25 05:15:32'),
(3, '6538a492d8b5a-category-21', 2, 'Category 2.1', 'test', NULL, 'Active', 'Yes', '2023-10-25 05:16:02', '2023-10-25 05:16:02');

-- --------------------------------------------------------

--
-- Table structure for table `contact_messages`
--

CREATE TABLE `contact_messages` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `mobile` varchar(255) DEFAULT NULL,
  `subject` varchar(255) DEFAULT NULL,
  `message` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `contact_messages`
--

INSERT INTO `contact_messages` (`id`, `name`, `email`, `mobile`, `subject`, `message`, `created_at`, `updated_at`) VALUES
(2, 'Sarah Byrd', 'pogisofabu@mailinator.com', '3213213213213', 'Obcaecati dolor alia', 'Ullamco et ex ducimu', '2023-11-23 07:24:33', '2023-11-23 07:24:33'),
(3, 'Cameran Hoffman', 'saqod@mailinator.com', '67653612321', 'Labore aut doloremqu', 'Incidunt adipisci c', '2023-11-23 07:24:44', '2023-11-23 07:24:44'),
(4, 'Nyssa Ellison', 'xezajos@mailinator.com', '3213654230', 'Occaecat porro non m', 'Quia natus vel est', '2023-11-23 07:24:51', '2023-11-23 07:24:51'),
(5, 'Christian Anderson', 'xunita@mailinator.com', '875623', 'Quos sit qui id ut', 'Facere in dolore ull', '2023-11-23 07:24:59', '2023-11-23 07:24:59'),
(6, 'Christian Anderson', 'xunita@mailinator.com', '87562323', 'Quos sit qui id ut', 'Facere in dolore ull', '2023-11-23 07:25:00', '2023-11-23 07:25:00');

-- --------------------------------------------------------

--
-- Table structure for table `districts`
--

CREATE TABLE `districts` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `division_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `bn_name` varchar(255) DEFAULT NULL,
  `lat` varchar(255) DEFAULT NULL,
  `lon` varchar(255) DEFAULT NULL,
  `url` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `districts`
--

INSERT INTO `districts` (`id`, `division_id`, `name`, `bn_name`, `lat`, `lon`, `url`, `created_at`, `updated_at`) VALUES
(1, 1, 'Comilla', 'কুমিল্লা', '23.4682747', '91.1788135', 'www.comilla.gov.bd', NULL, NULL),
(2, 1, 'Feni', 'ফেনী', '23.023231', '91.3840844', 'www.feni.gov.bd', NULL, NULL),
(3, 1, 'Brahmanbaria', 'ব্রাহ্মণবাড়িয়া', '23.9570904', '91.1119286', 'www.brahmanbaria.gov.bd', NULL, NULL),
(4, 1, 'Rangamati', 'রাঙ্গামাটি', '22.65561018', '92.17541121', 'www.rangamati.gov.bd', NULL, NULL),
(5, 1, 'Noakhali', 'নোয়াখালী', '22.869563', '91.099398', 'www.noakhali.gov.bd', NULL, NULL),
(6, 1, 'Chandpur', 'চাঁদপুর', '23.2332585', '90.6712912', 'www.chandpur.gov.bd', NULL, NULL),
(7, 1, 'Lakshmipur', 'লক্ষ্মীপুর', '22.942477', '90.841184', 'www.lakshmipur.gov.bd', NULL, NULL),
(8, 1, 'Chattogram', 'চট্টগ্রাম', '22.335109', '91.834073', 'www.chittagong.gov.bd', NULL, NULL),
(9, 1, 'Coxsbazar', 'কক্সবাজার', '21.44315751', '91.97381741', 'www.coxsbazar.gov.bd', NULL, NULL),
(10, 1, 'Khagrachhari', 'খাগড়াছড়ি', '23.119285', '91.984663', 'www.khagrachhari.gov.bd', NULL, NULL),
(11, 1, 'Bandarban', 'বান্দরবান', '22.1953275', '92.2183773', 'www.bandarban.gov.bd', NULL, NULL),
(12, 2, 'Sirajganj', 'সিরাজগঞ্জ', '24.4533978', '89.7006815', 'www.sirajganj.gov.bd', NULL, NULL),
(13, 2, 'Pabna', 'পাবনা', '23.998524', '89.233645', 'www.pabna.gov.bd', NULL, NULL),
(14, 2, 'Bogura', 'বগুড়া', '24.8465228', '89.377755', 'www.bogra.gov.bd', NULL, NULL),
(15, 2, 'Rajshahi', 'রাজশাহী', '24.37230298', '88.56307623', 'www.rajshahi.gov.bd', NULL, NULL),
(16, 2, 'Natore', 'নাটোর', '24.420556', '89.000282', 'www.natore.gov.bd', NULL, NULL),
(17, 2, 'Joypurhat', 'জয়পুরহাট', '25.09636876', '89.04004280', 'www.joypurhat.gov.bd', NULL, NULL),
(18, 2, 'Chapainawabganj', 'চাঁপাইনবাবগঞ্জ', '24.5965034', '88.2775122', 'www.chapainawabganj.gov.bd', NULL, NULL),
(19, 2, 'Naogaon', 'নওগাঁ', '24.83256191', '88.92485205', 'www.naogaon.gov.bd', NULL, NULL),
(20, 3, 'Jashore', 'যশোর', '23.16643', '89.2081126', 'www.jessore.gov.bd', NULL, NULL),
(21, 3, 'Satkhira', 'সাতক্ষীরা', '22.7180905', '89.0687033', 'www.satkhira.gov.bd', NULL, NULL),
(22, 3, 'Meherpur', 'মেহেরপুর', '23.762213', '88.631821', 'www.meherpur.gov.bd', NULL, NULL),
(23, 3, 'Narail', 'নড়াইল', '23.172534', '89.512672', 'www.narail.gov.bd', NULL, NULL),
(24, 3, 'Chuadanga', 'চুয়াডাঙ্গা', '23.6401961', '88.841841', 'www.chuadanga.gov.bd', NULL, NULL),
(25, 3, 'Kushtia', 'কুষ্টিয়া', '23.901258', '89.120482', 'www.kushtia.gov.bd', NULL, NULL),
(26, 3, 'Magura', 'মাগুরা', '23.487337', '89.419956', 'www.magura.gov.bd', NULL, NULL),
(27, 3, 'Khulna', 'খুলনা', '22.815774', '89.568679', 'www.khulna.gov.bd', NULL, NULL),
(28, 3, 'Bagerhat', 'বাগেরহাট', '22.651568', '89.785938', 'www.bagerhat.gov.bd', NULL, NULL),
(29, 3, 'Jhenaidah', 'ঝিনাইদহ', '23.5448176', '89.1539213', 'www.jhenaidah.gov.bd', NULL, NULL),
(30, 4, 'Jhalakathi', 'ঝালকাঠি', '22.6422689', '90.2003932', 'www.jhalakathi.gov.bd', NULL, NULL),
(31, 4, 'Patuakhali', 'পটুয়াখালী', '22.3596316', '90.3298712', 'www.patuakhali.gov.bd', NULL, NULL),
(32, 4, 'Pirojpur', 'পিরোজপুর', '22.5781398', '89.9983909', 'www.pirojpur.gov.bd', NULL, NULL),
(33, 4, 'Barisal', 'বরিশাল', '22.7004179', '90.3731568', 'www.barisal.gov.bd', NULL, NULL),
(34, 4, 'Bhola', 'ভোলা', '22.685923', '90.648179', 'www.bhola.gov.bd', NULL, NULL),
(35, 4, 'Barguna', 'বরগুনা', '22.159182', '90.125581', 'www.barguna.gov.bd', NULL, NULL),
(36, 5, 'Sylhet', 'সিলেট', '24.8897956', '91.8697894', 'www.sylhet.gov.bd', NULL, NULL),
(37, 5, 'Moulvibazar', 'মৌলভীবাজার', '24.482934', '91.777417', 'www.moulvibazar.gov.bd', NULL, NULL),
(38, 5, 'Habiganj', 'হবিগঞ্জ', '24.374945', '91.41553', 'www.habiganj.gov.bd', NULL, NULL),
(39, 5, 'Sunamganj', 'সুনামগঞ্জ', '25.0658042', '91.3950115', 'www.sunamganj.gov.bd', NULL, NULL),
(40, 6, 'Narsingdi', 'নরসিংদী', '23.932233', '90.71541', 'www.narsingdi.gov.bd', NULL, NULL),
(41, 6, 'Gazipur', 'গাজীপুর', '24.0022858', '90.4264283', 'www.gazipur.gov.bd', NULL, NULL),
(42, 6, 'Shariatpur', 'শরীয়তপুর', '23.2060195', '90.3477725', 'www.shariatpur.gov.bd', NULL, NULL),
(43, 6, 'Narayanganj', 'নারায়ণগঞ্জ', '23.63366', '90.496482', 'www.narayanganj.gov.bd', NULL, NULL),
(44, 6, 'Tangail', 'টাঙ্গাইল', '24.264145', '89.918029', 'www.tangail.gov.bd', NULL, NULL),
(45, 6, 'Kishoreganj', 'কিশোরগঞ্জ', '24.444937', '90.776575', 'www.kishoreganj.gov.bd', NULL, NULL),
(46, 6, 'Manikganj', 'মানিকগঞ্জ', '23.8602262', '90.0018293', 'www.manikganj.gov.bd', NULL, NULL),
(47, 6, 'Dhaka', 'ঢাকা', '23.7115253', '90.4111451', 'www.dhaka.gov.bd', NULL, NULL),
(48, 6, 'Munshiganj', 'মুন্সিগঞ্জ', '23.5435742', '90.5354327', 'www.munshiganj.gov.bd', NULL, NULL),
(49, 6, 'Rajbari', 'রাজবাড়ী', '23.7574305', '89.6444665', 'www.rajbari.gov.bd', NULL, NULL),
(50, 6, 'Madaripur', 'মাদারীপুর', '23.164102', '90.1896805', 'www.madaripur.gov.bd', NULL, NULL),
(51, 6, 'Gopalganj', 'গোপালগঞ্জ', '23.0050857', '89.8266059', 'www.gopalganj.gov.bd', NULL, NULL),
(52, 6, 'Faridpur', 'ফরিদপুর', '23.6070822', '89.8429406', 'www.faridpur.gov.bd', NULL, NULL),
(53, 7, 'Panchagarh', 'পঞ্চগড়', '26.3411', '88.5541606', 'www.panchagarh.gov.bd', NULL, NULL),
(54, 7, 'Dinajpur', 'দিনাজপুর', '25.6217061', '88.6354504', 'www.dinajpur.gov.bd', NULL, NULL),
(55, 7, 'Lalmonirhat', 'লালমনিরহাট', '25.9165451', '89.4532409', 'www.lalmonirhat.gov.bd', NULL, NULL),
(56, 7, 'Nilphamari', 'নীলফামারী', '25.931794', '88.856006', 'www.nilphamari.gov.bd', NULL, NULL),
(57, 7, 'Gaibandha', 'গাইবান্ধা', '25.328751', '89.528088', 'www.gaibandha.gov.bd', NULL, NULL),
(58, 7, 'Thakurgaon', 'ঠাকুরগাঁও', '26.0336945', '88.4616834', 'www.thakurgaon.gov.bd', NULL, NULL),
(59, 7, 'Rangpur', 'রংপুর', '25.7558096', '89.244462', 'www.rangpur.gov.bd', NULL, NULL),
(60, 7, 'Kurigram', 'কুড়িগ্রাম', '25.805445', '89.636174', 'www.kurigram.gov.bd', NULL, NULL),
(61, 8, 'Sherpur', 'শেরপুর', '25.0204933', '90.0152966', 'www.sherpur.gov.bd', NULL, NULL),
(62, 8, 'Mymensingh', 'ময়মনসিংহ', '24.7465670', '90.4072093', 'www.mymensingh.gov.bd', NULL, NULL),
(63, 8, 'Jamalpur', 'জামালপুর', '24.937533', '89.937775', 'www.jamalpur.gov.bd', NULL, NULL),
(64, 8, 'Netrokona', 'নেত্রকোণা', '24.870955', '90.727887', 'www.netrokona.gov.bd', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `divisions`
--

CREATE TABLE `divisions` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `bn_name` varchar(255) DEFAULT NULL,
  `url` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `divisions`
--

INSERT INTO `divisions` (`id`, `name`, `bn_name`, `url`, `created_at`, `updated_at`) VALUES
(1, 'Chattagram', 'চট্টগ্রাম', 'www.chittagongdiv.gov.bd', NULL, NULL),
(2, 'Rajshahi', 'রাজশাহী', 'www.rajshahidiv.gov.bd', NULL, NULL),
(3, 'Khulna', 'খুলনা', 'www.khulnadiv.gov.bd', NULL, NULL),
(4, 'Barisal', 'বরিশাল', 'www.barisaldiv.gov.bd', NULL, NULL),
(5, 'Sylhet', 'সিলেট', 'www.sylhetdiv.gov.bd', NULL, NULL),
(6, 'Dhaka', 'ঢাকা', 'www.dhakadiv.gov.bd', NULL, NULL),
(7, 'Rangpur', 'রংপুর', 'www.rangpurdiv.gov.bd', NULL, NULL),
(8, 'Mymensingh', 'ময়মনসিংহ', 'www.mymensinghdiv.gov.bd', NULL, NULL);

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
-- Table structure for table `merchants`
--

CREATE TABLE `merchants` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `slug` varchar(191) DEFAULT NULL,
  `name` varchar(255) NOT NULL,
  `description` text DEFAULT NULL,
  `image` varchar(255) DEFAULT NULL,
  `status` enum('Active','Inactive') NOT NULL DEFAULT 'Inactive',
  `feature` enum('Yes','No') NOT NULL DEFAULT 'No',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `merchants`
--

INSERT INTO `merchants` (`id`, `slug`, `name`, `description`, `image`, `status`, `feature`, `created_at`, `updated_at`) VALUES
(1, '6538a59f8da75-merchant', 'Merchant', NULL, NULL, 'Active', 'Yes', '2023-10-25 05:20:31', '2023-10-25 05:20:31'),
(2, '6538a5ad1fae6-merchant-2', 'Merchant 2', NULL, NULL, 'Active', 'Yes', '2023-10-25 05:20:45', '2023-10-25 05:20:45'),
(3, '6538a5b60b935-merchant-3', 'Merchant 3', NULL, NULL, 'Active', 'Yes', '2023-10-25 05:20:54', '2023-10-25 05:20:54');

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
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_reset_tokens_table', 1),
(3, '2014_10_12_100000_create_password_resets_table', 1),
(4, '2019_08_19_000000_create_failed_jobs_table', 1),
(5, '2019_12_14_000001_create_personal_access_tokens_table', 1),
(6, '2023_10_20_094942_create_admins_table', 1),
(7, '2023_10_20_230113_create_categories_table', 1),
(8, '2023_10_20_230559_create_brands_table', 1),
(9, '2023_10_21_152038_create_writers_table', 1),
(10, '2023_10_21_152039_create_merchants_table', 1),
(11, '2023_10_21_210215_create_taggable_table', 1),
(12, '2023_10_21_214848_create_products_table', 1),
(13, '2023_10_21_222741_create_product_images_table', 1),
(14, '2023_10_21_224702_create_user_points_table', 1),
(15, '2023_10_27_161326_create_sliders_table', 2),
(22, '2023_11_21_002531_create_settings_table', 5),
(23, '2023_11_21_234251_create_contact_messages_table', 5),
(29, '2023_11_06_132514_create_orders_table', 6),
(30, '2023_11_06_140541_create_order_details_table', 6),
(31, '2023_11_06_142606_create_transactions_table', 6),
(32, '2023_11_06_144721_create_order_addresses_table', 6),
(33, '2023_11_07_001017_create_user_addresses_table', 6),
(34, '2023_11_25_212759_create_divisions_table', 6),
(35, '2023_11_25_212811_create_districts_table', 6),
(36, '2023_11_25_212847_create_upazilas_table', 6),
(37, '2024_02_18_155912_create_activity_log_table', 7),
(38, '2024_02_18_155913_add_event_column_to_activity_log_table', 7),
(39, '2024_02_18_155914_add_batch_uuid_column_to_activity_log_table', 7);

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` varchar(36) DEFAULT NULL,
  `sub_total` decimal(8,2) UNSIGNED NOT NULL COMMENT 'sum of order_details total',
  `discount` decimal(8,2) UNSIGNED NOT NULL DEFAULT 0.00,
  `total_shipping_charge` decimal(8,2) UNSIGNED NOT NULL DEFAULT 0.00,
  `total` decimal(8,2) UNSIGNED NOT NULL COMMENT '(sub_total + total_shipping_charge) - discount',
  `total_returned` decimal(8,2) UNSIGNED NOT NULL DEFAULT 0.00 COMMENT 'sum of order_details returned',
  `final_total` decimal(8,2) UNSIGNED NOT NULL DEFAULT 0.00 COMMENT 'sum of order_details final',
  `status` enum('Pending','In Progress','Ready to Ship','Shipped','Returned','Canceled','Delivered','Failed') NOT NULL DEFAULT 'Pending',
  `delivered_at` timestamp NULL DEFAULT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `ref_agent_id` bigint(20) UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`id`, `uuid`, `sub_total`, `discount`, `total_shipping_charge`, `total`, `total_returned`, `final_total`, `status`, `delivered_at`, `user_id`, `ref_agent_id`, `created_at`, `updated_at`) VALUES
(1, NULL, 1300.00, 260.00, 80.00, 1120.00, 0.00, 1120.00, 'Pending', NULL, NULL, NULL, '2023-11-26 05:28:08', '2023-11-26 05:28:08'),
(6, NULL, 2600.00, 520.00, 80.00, 2160.00, 0.00, 2160.00, 'Pending', NULL, NULL, NULL, '2023-11-26 06:28:35', '2023-11-26 06:28:35'),
(7, NULL, 5600.00, 820.00, 130.00, 4910.00, 0.00, 4910.00, 'Pending', NULL, 1, NULL, '2023-11-26 06:48:01', '2023-11-26 06:48:01'),
(8, '9ab84502-331c-4945-b434-7791b8cf8ab1', 2600.00, 520.00, 80.00, 2160.00, 0.00, 2160.00, 'Pending', NULL, NULL, NULL, '2023-11-28 09:03:44', '2023-11-28 09:03:44');

-- --------------------------------------------------------

--
-- Table structure for table `order_addresses`
--

CREATE TABLE `order_addresses` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) DEFAULT NULL,
  `address_type` enum('primary','billing','shipping') NOT NULL DEFAULT 'primary',
  `address_line` varchar(255) NOT NULL,
  `district` varchar(255) DEFAULT NULL,
  `phone` varchar(255) NOT NULL,
  `order_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `order_addresses`
--

INSERT INTO `order_addresses` (`id`, `name`, `email`, `address_type`, `address_line`, `district`, `phone`, `order_id`, `created_at`, `updated_at`) VALUES
(1, 'Rashiqul Rony', 'rony@gmail.com', 'shipping', 'Adabor, Mohammadpur', 'Dhaka', '01738030343', 1, '2023-11-26 05:28:08', '2023-11-26 05:28:08'),
(2, 'Rashiqul Rony', 'rony@gmail.com', 'billing', 'Adabor, Mohammadpur', 'Dhaka', '01738030343', 1, '2023-11-26 05:28:08', '2023-11-26 05:28:08'),
(3, 'Rashiqul Rony', NULL, 'shipping', 'Adabor, Mohammadpur', 'Dhaka', '01738030343', 6, '2023-11-26 06:28:35', '2023-11-26 06:28:35'),
(4, 'Rashiqul Rony', NULL, 'billing', 'Adabor, Mohammadpur', 'Dhaka', '01738030343', 6, '2023-11-26 06:28:35', '2023-11-26 06:28:35'),
(5, 'Rashiqul Rony', 'rony.mmj@gmail.com', 'shipping', 'MMJ, Gobindoganj', 'Gaibandha', '01738030343', 7, '2023-11-26 06:48:01', '2023-11-26 06:48:01'),
(6, 'Rashiqul Rony', 'rony.mmj@gmail.com', 'billing', 'MMJ, Gobindoganj', 'Gaibandha', '01738030343', 7, '2023-11-26 06:48:01', '2023-11-26 06:48:01'),
(7, 'Rashiqul Rony', NULL, 'shipping', 'Adabor, Mohammadpur', 'Dhaka', '01738030343', 8, '2023-11-28 09:03:44', '2023-11-28 09:03:44'),
(8, 'Rashiqul Rony', NULL, 'billing', 'Adabor, Mohammadpur', 'Dhaka', '01738030343', 8, '2023-11-28 09:03:44', '2023-11-28 09:03:44');

-- --------------------------------------------------------

--
-- Table structure for table `order_details`
--

CREATE TABLE `order_details` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `product_name` varchar(255) NOT NULL,
  `product_unit_price` decimal(8,2) UNSIGNED NOT NULL,
  `product_size` varchar(255) DEFAULT NULL,
  `product_color` varchar(255) DEFAULT NULL,
  `discount` decimal(8,2) UNSIGNED NOT NULL DEFAULT 0.00 COMMENT 'unit discount amount',
  `product_quantity` int(10) UNSIGNED NOT NULL DEFAULT 1,
  `returned_quantity` int(10) UNSIGNED NOT NULL DEFAULT 0 COMMENT 'if admin return',
  `final_quantity` int(10) UNSIGNED NOT NULL,
  `sub_total` decimal(8,2) UNSIGNED NOT NULL DEFAULT 0.00 COMMENT 'product_unit_price * quantity',
  `total` decimal(8,2) UNSIGNED NOT NULL DEFAULT 0.00 COMMENT 'sub_total - discount',
  `returned_amount` decimal(8,2) UNSIGNED NOT NULL DEFAULT 0.00 COMMENT 'if admin return',
  `final_total` decimal(8,2) UNSIGNED NOT NULL DEFAULT 0.00 COMMENT 'total - returned_amount',
  `product_id` bigint(20) UNSIGNED NOT NULL,
  `order_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `order_details`
--

INSERT INTO `order_details` (`id`, `product_name`, `product_unit_price`, `product_size`, `product_color`, `discount`, `product_quantity`, `returned_quantity`, `final_quantity`, `sub_total`, `total`, `returned_amount`, `final_total`, `product_id`, `order_id`, `created_at`, `updated_at`) VALUES
(1, 'Carissa Sandoval', 1300.00, NULL, NULL, 260.00, 1, 0, 1, 1300.00, 1040.00, 0.00, 1040.00, 2, 1, '2023-11-26 05:28:08', '2023-11-26 05:28:08'),
(2, 'Carissa Sandoval - 2', 1300.00, 'C', NULL, 260.00, 1, 0, 1, 1300.00, 1040.00, 0.00, 1040.00, 3, 6, '2023-11-26 06:28:35', '2023-11-26 06:28:35'),
(3, 'Carissa Sandoval', 1300.00, 'B', 'Green', 260.00, 1, 0, 1, 1300.00, 1040.00, 0.00, 1040.00, 2, 6, '2023-11-26 06:28:35', '2023-11-26 06:28:35'),
(4, 'Carissa Sandoval', 1300.00, 'A', 'Red', 260.00, 1, 0, 1, 1300.00, 1040.00, 0.00, 1040.00, 2, 7, '2023-11-26 06:48:01', '2023-11-26 06:48:01'),
(5, 'Carissa Sandoval - 2', 1300.00, 'C', NULL, 260.00, 1, 0, 1, 1300.00, 1040.00, 0.00, 1040.00, 3, 7, '2023-11-26 06:48:01', '2023-11-26 06:48:01'),
(6, 'Raja Gibson', 1000.00, 'D', NULL, 100.00, 3, 0, 3, 3000.00, 2700.00, 0.00, 2700.00, 1, 7, '2023-11-26 06:48:01', '2023-11-26 06:48:01'),
(7, 'Carissa Sandoval - 2', 1300.00, 'B', NULL, 260.00, 1, 0, 1, 1300.00, 1040.00, 0.00, 1040.00, 3, 8, '2023-11-28 09:03:44', '2023-11-28 09:03:44'),
(8, 'Carissa Sandoval', 1300.00, 'B', 'Red', 260.00, 1, 0, 1, 1300.00, 1040.00, 0.00, 1040.00, 2, 8, '2023-11-28 09:03:44', '2023-11-28 09:03:44');

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(191) NOT NULL,
  `token` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `password_reset_tokens`
--

CREATE TABLE `password_reset_tokens` (
  `email` varchar(191) NOT NULL,
  `token` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `personal_access_tokens`
--

CREATE TABLE `personal_access_tokens` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `tokenable_type` varchar(255) NOT NULL,
  `tokenable_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `token` varchar(64) NOT NULL,
  `abilities` text DEFAULT NULL,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `expires_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `category_id` bigint(20) UNSIGNED NOT NULL,
  `brand_id` bigint(20) UNSIGNED NOT NULL DEFAULT 0,
  `writer_id` bigint(20) UNSIGNED NOT NULL DEFAULT 0,
  `merchant_id` bigint(20) UNSIGNED NOT NULL DEFAULT 0,
  `type` enum('Book','General') NOT NULL,
  `slug` varchar(255) DEFAULT NULL,
  `name` varchar(255) NOT NULL,
  `code` varchar(255) NOT NULL,
  `buy_price` decimal(8,2) NOT NULL DEFAULT 0.00,
  `price` decimal(8,2) NOT NULL DEFAULT 0.00,
  `discount_type` enum('Taka','Percentage') NOT NULL DEFAULT 'Percentage',
  `discount_value` int(10) UNSIGNED NOT NULL DEFAULT 0,
  `stock` int(10) UNSIGNED NOT NULL DEFAULT 0,
  `point` int(10) UNSIGNED NOT NULL DEFAULT 0,
  `shipping_in_dhaka` decimal(8,2) NOT NULL DEFAULT 0.00,
  `shipping_out_dhaka` decimal(8,2) NOT NULL DEFAULT 0.00,
  `image` varchar(255) DEFAULT NULL,
  `first_release` varchar(255) DEFAULT NULL,
  `language` varchar(255) DEFAULT NULL,
  `description` longtext DEFAULT NULL,
  `size` varchar(255) DEFAULT NULL,
  `color` varchar(255) DEFAULT NULL,
  `fabrics` varchar(255) DEFAULT NULL,
  `weight` varchar(255) DEFAULT NULL,
  `delivery_info` varchar(255) DEFAULT NULL,
  `warranty` varchar(255) DEFAULT NULL,
  `feature` enum('Yes','No') NOT NULL DEFAULT 'No',
  `status` enum('Active','Inactive') NOT NULL DEFAULT 'Inactive',
  `sort` int(10) UNSIGNED NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `category_id`, `brand_id`, `writer_id`, `merchant_id`, `type`, `slug`, `name`, `code`, `buy_price`, `price`, `discount_type`, `discount_value`, `stock`, `point`, `shipping_in_dhaka`, `shipping_out_dhaka`, `image`, `first_release`, `language`, `description`, `size`, `color`, `fabrics`, `weight`, `delivery_info`, `warranty`, `feature`, `status`, `sort`, `created_at`, `updated_at`) VALUES
(1, 1, 1, 0, 1, 'General', '65548fa113226-raja-gibson', 'Raja Gibson', 'Ullamco voluptatibus', 500.00, 1000.00, 'Taka', 100, 20, 200, 60.00, 150.00, '1700040609-7.jpg', NULL, NULL, '<span style=\"font-family: \"Open Sans\", Arial, sans-serif; text-align: justify;\">It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. The point of using Lorem Ipsum is that it has a more-or-less normal distribution of letters, as opposed to using \'Content here, content here\', making it look like readable English. Many desktop publishing packages and web page editors now use Lorem Ipsum as their default model text, and a search for \'lorem ipsum\' will uncover many web sites still in their infancy. Various versions have evolved over the years, sometimes by accident, sometimes on purpose (injected humour and the like).</span>', '[\"A\",\"    B\",\"    C\",\"    D\"]', NULL, NULL, '180', '3-5 days', '1 Years', 'Yes', 'Active', 3, '2023-10-30 06:10:31', '2023-11-15 09:30:09'),
(2, 1, 2, 0, 1, 'General', '6562e0db5581c-carissa-sandoval', 'Carissa Sandoval', 'AABB22', 700.00, 1300.00, 'Percentage', 20, 10, 200, 60.00, 150.00, '1700040563-c.jpg', NULL, NULL, '<p><span style=\"margin: 0px; padding: 0px; font-family: \" open=\"\" sans\",=\"\" arial,=\"\" sans-serif;=\"\" text-align:=\"\" justify;\"=\"\">Lorem Ipsum</span><span style=\"font-family: \" open=\"\" sans\",=\"\" arial,=\"\" sans-serif;=\"\" text-align:=\"\" justify;\"=\"\"> is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s,</span></p><p><span style=\"font-family: \" open=\"\" sans\",=\"\" arial,=\"\" sans-serif;=\"\" text-align:=\"\" justify;\"=\"\"><span open=\"\" sans\",=\"\" arial,=\"\" sans-serif;=\"\" text-align:=\"\" justify;\"=\"\" style=\"margin: 0px; padding: 0px;\">Lorem Ipsum</span><span open=\"\" sans\",=\"\" arial,=\"\" sans-serif;=\"\" text-align:=\"\" justify;\"=\"\"> is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s,</span></span></p><p><span style=\"font-family: \" open=\"\" sans\",=\"\" arial,=\"\" sans-serif;=\"\" text-align:=\"\" justify;\"=\"\"><span open=\"\" sans\",=\"\" arial,=\"\" sans-serif;=\"\" text-align:=\"\" justify;\"=\"\"><span open=\"\" sans\",=\"\" arial,=\"\" sans-serif;=\"\" text-align:=\"\" justify;\"=\"\" style=\"margin: 0px; padding: 0px;\">Lorem Ipsum</span><span open=\"\" sans\",=\"\" arial,=\"\" sans-serif;=\"\" text-align:=\"\" justify;\"=\"\"> is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, </span><span open=\"\" sans\",=\"\" arial,=\"\" sans-serif;=\"\" text-align:=\"\" justify;\"=\"\" style=\"margin: 0px; padding: 0px;\">Lorem Ipsum</span><span open=\"\" sans\",=\"\" arial,=\"\" sans-serif;=\"\" text-align:=\"\" justify;\"=\"\"> is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s,</span><span open=\"\" sans\",=\"\" arial,=\"\" sans-serif;=\"\" text-align:=\"\" justify;\"=\"\" style=\"margin: 0px; padding: 0px;\">Lorem Ipsum</span><span open=\"\" sans\",=\"\" arial,=\"\" sans-serif;=\"\" text-align:=\"\" justify;\"=\"\"> is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s,</span><span open=\"\" sans\",=\"\" arial,=\"\" sans-serif;=\"\" text-align:=\"\" justify;\"=\"\" style=\"margin: 0px; padding: 0px;\">Lorem Ipsum</span><span open=\"\" sans\",=\"\" arial,=\"\" sans-serif;=\"\" text-align:=\"\" justify;\"=\"\"> is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s,</span><span open=\"\" sans\",=\"\" arial,=\"\" sans-serif;=\"\" text-align:=\"\" justify;\"=\"\" style=\"margin: 0px; padding: 0px;\">Lorem Ipsum</span><span open=\"\" sans\",=\"\" arial,=\"\" sans-serif;=\"\" text-align:=\"\" justify;\"=\"\"> is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s,</span><span open=\"\" sans\",=\"\" arial,=\"\" sans-serif;=\"\" text-align:=\"\" justify;\"=\"\" style=\"margin: 0px; padding: 0px;\">Lorem Ipsum</span><span open=\"\" sans\",=\"\" arial,=\"\" sans-serif;=\"\" text-align:=\"\" justify;\"=\"\"> is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s,</span><br></span><br></span></p>', '[\"A\",\"          B\",\"          C\"]', '[\"Red\",\"  Green\"]', NULL, '55', 'Sit voluptatibus vo', '1 Years', 'Yes', 'Active', 1, '2023-10-30 06:18:49', '2024-01-21 05:50:56'),
(3, 2, 2, 0, 1, 'General', '65548f865180f-carissa-sandoval-2', 'Carissa Sandoval - 2', 'AABB23', 700.00, 1300.00, 'Percentage', 20, 5, 200, 60.00, 150.00, '1700040582-10.jpg', NULL, NULL, '<span style=\"margin: 0px; padding: 0px; font-family: \"Open Sans\", Arial, sans-serif; text-align: justify;\">Lorem Ipsum</span><span style=\"font-family: \"Open Sans\", Arial, sans-serif; text-align: justify;\"> is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s,</span>', '[\"A\",\"      B\",\"      C\"]', NULL, NULL, '55', 'Sit voluptatibus vo', '1 Years', 'Yes', 'Active', 2, '2023-10-30 06:18:49', '2024-01-21 05:50:38');

-- --------------------------------------------------------

--
-- Table structure for table `product_images`
--

CREATE TABLE `product_images` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `product_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `url` varchar(255) DEFAULT NULL,
  `size` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `product_images`
--

INSERT INTO `product_images` (`id`, `product_id`, `name`, `url`, `size`, `created_at`, `updated_at`) VALUES
(1, 2, '1700040563-d.jpg', 'http://127.0.0.1:8000/storage/products/2/1700040563-d.jpg', '35483', NULL, NULL),
(2, 2, '1700040563-e.jpg', 'http://127.0.0.1:8000/storage/products/2/1700040563-e.jpg', '243691', NULL, NULL),
(3, 2, '1700040563-f.jpg', 'http://127.0.0.1:8000/storage/products/2/1700040563-f.jpg', '171975', NULL, NULL),
(4, 2, '1700040563-g.jpg', 'http://127.0.0.1:8000/storage/products/2/1700040563-g.jpg', '143710', NULL, NULL),
(5, 3, '1700040582-10-a.jpg', 'http://127.0.0.1:8000/storage/products/3/1700040582-10-a.jpg', '58199', NULL, NULL),
(6, 3, '1700040582-11.jpg', 'http://127.0.0.1:8000/storage/products/3/1700040582-11.jpg', '60231', NULL, NULL),
(7, 3, '1700040582-11-a.jpg', 'http://127.0.0.1:8000/storage/products/3/1700040582-11-a.jpg', '54543', NULL, NULL),
(8, 3, '1700040582-12.jpg', 'http://127.0.0.1:8000/storage/products/3/1700040582-12.jpg', '72968', NULL, NULL),
(9, 1, '1700040609-1-a.jpg', 'http://127.0.0.1:8000/storage/products/1/1700040609-1-a.jpg', '106510', NULL, NULL),
(10, 1, '1700040609-6.jpg', 'http://127.0.0.1:8000/storage/products/1/1700040609-6.jpg', '23139', NULL, NULL),
(11, 1, '1700040609-6-a.jpg', 'http://127.0.0.1:8000/storage/products/1/1700040609-6-a.jpg', '23036', NULL, NULL),
(12, 1, '1700040609-8.jpg', 'http://127.0.0.1:8000/storage/products/1/1700040609-8.jpg', '46785', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `settings`
--

CREATE TABLE `settings` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `title` varchar(255) DEFAULT NULL,
  `address` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `email_2` varchar(255) DEFAULT NULL,
  `mobile` varchar(255) DEFAULT NULL,
  `mobile_2` varchar(255) DEFAULT NULL,
  `facebook` varchar(255) DEFAULT NULL,
  `instagram` varchar(255) DEFAULT NULL,
  `linkedin` varchar(255) DEFAULT NULL,
  `youtube` varchar(255) DEFAULT NULL,
  `twitter` varchar(255) DEFAULT NULL,
  `logo` varchar(255) DEFAULT NULL,
  `shipping_in_dhaka` decimal(8,2) NOT NULL DEFAULT 0.00,
  `shipping_out_dhaka` decimal(8,2) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `settings`
--

INSERT INTO `settings` (`id`, `title`, `address`, `email`, `email_2`, `mobile`, `mobile_2`, `facebook`, `instagram`, `linkedin`, `youtube`, `twitter`, `logo`, `shipping_in_dhaka`, `shipping_out_dhaka`, `created_at`, `updated_at`) VALUES
(1, 'বাংলাদেশের বিশ্বস্ত অনলাইন শপ । সারাদেশে ক্যাশ অন ডেলিভারি (৪৮ থেকে ৭২ ঘণ্টার মধ্যে নিশ্চিত ডেলিভারি)', 'Dhaka, Bangladesh', 'info@hajjshops.com', 'info@hajjshops.com', '01700000000', '01700000000', NULL, NULL, NULL, NULL, NULL, '', 80.00, 130.00, NULL, '2023-11-26 06:46:31');

-- --------------------------------------------------------

--
-- Table structure for table `sliders`
--

CREATE TABLE `sliders` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `category_id` bigint(20) UNSIGNED DEFAULT NULL,
  `title` varchar(255) DEFAULT NULL,
  `sub_title` varchar(255) DEFAULT NULL,
  `description` text DEFAULT NULL,
  `image` varchar(255) DEFAULT NULL,
  `status` enum('Active','Inactive') NOT NULL DEFAULT 'Inactive',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `sliders`
--

INSERT INTO `sliders` (`id`, `category_id`, `title`, `sub_title`, `description`, `image`, `status`, `created_at`, `updated_at`) VALUES
(1, 1, 'Slider 1', NULL, 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s,', '1698640787-4-47732-hacker-boy-hacker.jpg', 'Active', '2023-10-30 04:39:47', '2023-10-30 06:12:18'),
(2, 2, 'Slider 2', NULL, 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s,', '1698640816-wp11266119.jpg', 'Active', '2023-10-30 04:40:17', '2023-10-30 06:12:25'),
(3, 1, 'Slider 3', NULL, 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s,', '1698640946-hd-wallpaper-game-over-hacker-setup.jpg', 'Active', '2023-10-30 04:42:26', '2023-10-30 06:12:32');

-- --------------------------------------------------------

--
-- Table structure for table `taggable_taggables`
--

CREATE TABLE `taggable_taggables` (
  `tag_id` bigint(20) UNSIGNED NOT NULL,
  `taggable_id` bigint(20) UNSIGNED NOT NULL,
  `taggable_type` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `taggable_tags`
--

CREATE TABLE `taggable_tags` (
  `tag_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `normalized` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `transactions`
--

CREATE TABLE `transactions` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `type` enum('Cash on delivery','Bkash','Rocket','Nogod') NOT NULL DEFAULT 'Cash on delivery',
  `status` enum('hold','processing','done','canceled','failed') NOT NULL DEFAULT 'hold',
  `amount` decimal(8,2) UNSIGNED NOT NULL,
  `payment_gateway_response` longtext DEFAULT NULL,
  `order_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `transactions`
--

INSERT INTO `transactions` (`id`, `type`, `status`, `amount`, `payment_gateway_response`, `order_id`, `created_at`, `updated_at`) VALUES
(1, 'Cash on delivery', 'hold', 1120.00, NULL, 1, '2023-11-26 05:28:08', '2023-11-26 05:28:08'),
(2, 'Cash on delivery', 'hold', 2160.00, NULL, 6, '2023-11-26 06:28:35', '2023-11-26 06:28:35'),
(3, 'Cash on delivery', 'hold', 4910.00, NULL, 7, '2023-11-26 06:48:01', '2023-11-26 06:48:01'),
(4, 'Cash on delivery', 'hold', 2160.00, NULL, 8, '2023-11-28 09:03:44', '2023-11-28 09:03:44');

-- --------------------------------------------------------

--
-- Table structure for table `upazilas`
--

CREATE TABLE `upazilas` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `district_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `bn_name` varchar(255) DEFAULT NULL,
  `url` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `upazilas`
--

INSERT INTO `upazilas` (`id`, `district_id`, `name`, `bn_name`, `url`, `created_at`, `updated_at`) VALUES
(1, 1, 'Debidwar', 'দেবিদ্বার', 'debidwar.comilla.gov.bd', NULL, NULL),
(2, 1, 'Barura', 'বরুড়া', 'barura.comilla.gov.bd', NULL, NULL),
(3, 1, 'Brahmanpara', 'ব্রাহ্মণপাড়া', 'brahmanpara.comilla.gov.bd', NULL, NULL),
(4, 1, 'Chandina', 'চান্দিনা', 'chandina.comilla.gov.bd', NULL, NULL),
(5, 1, 'Chauddagram', 'চৌদ্দগ্রাম', 'chauddagram.comilla.gov.bd', NULL, NULL),
(6, 1, 'Daudkandi', 'দাউদকান্দি', 'daudkandi.comilla.gov.bd', NULL, NULL),
(7, 1, 'Homna', 'হোমনা', 'homna.comilla.gov.bd', NULL, NULL),
(8, 1, 'Laksam', 'লাকসাম', 'laksam.comilla.gov.bd', NULL, NULL),
(9, 1, 'Muradnagar', 'মুরাদনগর', 'muradnagar.comilla.gov.bd', NULL, NULL),
(10, 1, 'Nangalkot', 'নাঙ্গলকোট', 'nangalkot.comilla.gov.bd', NULL, NULL),
(11, 1, 'Comilla Sadar', 'কুমিল্লা সদর', 'comillasadar.comilla.gov.bd', NULL, NULL),
(12, 1, 'Meghna', 'মেঘনা', 'meghna.comilla.gov.bd', NULL, NULL),
(13, 1, 'Monohargonj', 'মনোহরগঞ্জ', 'monohargonj.comilla.gov.bd', NULL, NULL),
(14, 1, 'Sadarsouth', 'সদর দক্ষিণ', 'sadarsouth.comilla.gov.bd', NULL, NULL),
(15, 1, 'Titas', 'তিতাস', 'titas.comilla.gov.bd', NULL, NULL),
(16, 1, 'Burichang', 'বুড়িচং', 'burichang.comilla.gov.bd', NULL, NULL),
(17, 1, 'Lalmai', 'লালমাই', 'lalmai.comilla.gov.bd', NULL, NULL),
(18, 2, 'Chhagalnaiya', 'ছাগলনাইয়া', 'chhagalnaiya.feni.gov.bd', NULL, NULL),
(19, 2, 'Feni Sadar', 'ফেনী সদর', 'sadar.feni.gov.bd', NULL, NULL),
(20, 2, 'Sonagazi', 'সোনাগাজী', 'sonagazi.feni.gov.bd', NULL, NULL),
(21, 2, 'Fulgazi', 'ফুলগাজী', 'fulgazi.feni.gov.bd', NULL, NULL),
(22, 2, 'Parshuram', 'পরশুরাম', 'parshuram.feni.gov.bd', NULL, NULL),
(23, 2, 'Daganbhuiyan', 'দাগনভূঞা', 'daganbhuiyan.feni.gov.bd', NULL, NULL),
(24, 3, 'Brahmanbaria Sadar', 'ব্রাহ্মণবাড়িয়া সদর', 'sadar.brahmanbaria.gov.bd', NULL, NULL),
(25, 3, 'Kasba', 'কসবা', 'kasba.brahmanbaria.gov.bd', NULL, NULL),
(26, 3, 'Nasirnagar', 'নাসিরনগর', 'nasirnagar.brahmanbaria.gov.bd', NULL, NULL),
(27, 3, 'Sarail', 'সরাইল', 'sarail.brahmanbaria.gov.bd', NULL, NULL),
(28, 3, 'Ashuganj', 'আশুগঞ্জ', 'ashuganj.brahmanbaria.gov.bd', NULL, NULL),
(29, 3, 'Akhaura', 'আখাউড়া', 'akhaura.brahmanbaria.gov.bd', NULL, NULL),
(30, 3, 'Nabinagar', 'নবীনগর', 'nabinagar.brahmanbaria.gov.bd', NULL, NULL),
(31, 3, 'Bancharampur', 'বাঞ্ছারামপুর', 'bancharampur.brahmanbaria.gov.bd', NULL, NULL),
(32, 3, 'Bijoynagar', 'বিজয়নগর', 'bijoynagar.brahmanbaria.gov.bd    ', NULL, NULL),
(33, 4, 'Rangamati Sadar', 'রাঙ্গামাটি সদর', 'sadar.rangamati.gov.bd', NULL, NULL),
(34, 4, 'Kaptai', 'কাপ্তাই', 'kaptai.rangamati.gov.bd', NULL, NULL),
(35, 4, 'Kawkhali', 'কাউখালী', 'kawkhali.rangamati.gov.bd', NULL, NULL),
(36, 4, 'Baghaichari', 'বাঘাইছড়ি', 'baghaichari.rangamati.gov.bd', NULL, NULL),
(37, 4, 'Barkal', 'বরকল', 'barkal.rangamati.gov.bd', NULL, NULL),
(38, 4, 'Langadu', 'লংগদু', 'langadu.rangamati.gov.bd', NULL, NULL),
(39, 4, 'Rajasthali', 'রাজস্থলী', 'rajasthali.rangamati.gov.bd', NULL, NULL),
(40, 4, 'Belaichari', 'বিলাইছড়ি', 'belaichari.rangamati.gov.bd', NULL, NULL),
(41, 4, 'Juraichari', 'জুরাছড়ি', 'juraichari.rangamati.gov.bd', NULL, NULL),
(42, 4, 'Naniarchar', 'নানিয়ারচর', 'naniarchar.rangamati.gov.bd', NULL, NULL),
(43, 5, 'Noakhali Sadar', 'নোয়াখালী সদর', 'sadar.noakhali.gov.bd', NULL, NULL),
(44, 5, 'Companiganj', 'কোম্পানীগঞ্জ', 'companiganj.noakhali.gov.bd', NULL, NULL),
(45, 5, 'Begumganj', 'বেগমগঞ্জ', 'begumganj.noakhali.gov.bd', NULL, NULL),
(46, 5, 'Hatia', 'হাতিয়া', 'hatia.noakhali.gov.bd', NULL, NULL),
(47, 5, 'Subarnachar', 'সুবর্ণচর', 'subarnachar.noakhali.gov.bd', NULL, NULL),
(48, 5, 'Kabirhat', 'কবিরহাট', 'kabirhat.noakhali.gov.bd', NULL, NULL),
(49, 5, 'Senbug', 'সেনবাগ', 'senbug.noakhali.gov.bd', NULL, NULL),
(50, 5, 'Chatkhil', 'চাটখিল', 'chatkhil.noakhali.gov.bd', NULL, NULL),
(51, 5, 'Sonaimori', 'সোনাইমুড়ী', 'sonaimori.noakhali.gov.bd', NULL, NULL),
(52, 6, 'Haimchar', 'হাইমচর', 'haimchar.chandpur.gov.bd', NULL, NULL),
(53, 6, 'Kachua', 'কচুয়া', 'kachua.chandpur.gov.bd', NULL, NULL),
(54, 6, 'Shahrasti', 'শাহরাস্তি	', 'shahrasti.chandpur.gov.bd', NULL, NULL),
(55, 6, 'Chandpur Sadar', 'চাঁদপুর সদর', 'sadar.chandpur.gov.bd', NULL, NULL),
(56, 6, 'Matlab South', 'মতলব দক্ষিণ', 'matlabsouth.chandpur.gov.bd', NULL, NULL),
(57, 6, 'Hajiganj', 'হাজীগঞ্জ', 'hajiganj.chandpur.gov.bd', NULL, NULL),
(58, 6, 'Matlab North', 'মতলব উত্তর', 'matlabnorth.chandpur.gov.bd', NULL, NULL),
(59, 6, 'Faridgonj', 'ফরিদগঞ্জ', 'faridgonj.chandpur.gov.bd', NULL, NULL),
(60, 7, 'Lakshmipur Sadar', 'লক্ষ্মীপুর সদর', 'sadar.lakshmipur.gov.bd', NULL, NULL),
(61, 7, 'Kamalnagar', 'কমলনগর', 'kamalnagar.lakshmipur.gov.bd', NULL, NULL),
(62, 7, 'Raipur', 'রায়পুর', 'raipur.lakshmipur.gov.bd', NULL, NULL),
(63, 7, 'Ramgati', 'রামগতি', 'ramgati.lakshmipur.gov.bd', NULL, NULL),
(64, 7, 'Ramganj', 'রামগঞ্জ', 'ramganj.lakshmipur.gov.bd', NULL, NULL),
(65, 8, 'Rangunia', 'রাঙ্গুনিয়া', 'rangunia.chittagong.gov.bd', NULL, NULL),
(66, 8, 'Sitakunda', 'সীতাকুন্ড', 'sitakunda.chittagong.gov.bd', NULL, NULL),
(67, 8, 'Mirsharai', 'মীরসরাই', 'mirsharai.chittagong.gov.bd', NULL, NULL),
(68, 8, 'Patiya', 'পটিয়া', 'patiya.chittagong.gov.bd', NULL, NULL),
(69, 8, 'Sandwip', 'সন্দ্বীপ', 'sandwip.chittagong.gov.bd', NULL, NULL),
(70, 8, 'Banshkhali', 'বাঁশখালী', 'banshkhali.chittagong.gov.bd', NULL, NULL),
(71, 8, 'Boalkhali', 'বোয়ালখালী', 'boalkhali.chittagong.gov.bd', NULL, NULL),
(72, 8, 'Anwara', 'আনোয়ারা', 'anwara.chittagong.gov.bd', NULL, NULL),
(73, 8, 'Chandanaish', 'চন্দনাইশ', 'chandanaish.chittagong.gov.bd', NULL, NULL),
(74, 8, 'Satkania', 'সাতকানিয়া', 'satkania.chittagong.gov.bd', NULL, NULL),
(75, 8, 'Lohagara', 'লোহাগাড়া', 'lohagara.chittagong.gov.bd', NULL, NULL),
(76, 8, 'Hathazari', 'হাটহাজারী', 'hathazari.chittagong.gov.bd', NULL, NULL),
(77, 8, 'Fatikchhari', 'ফটিকছড়ি', 'fatikchhari.chittagong.gov.bd', NULL, NULL),
(78, 8, 'Raozan', 'রাউজান', 'raozan.chittagong.gov.bd', NULL, NULL),
(79, 8, 'Karnafuli', 'কর্ণফুলী', 'karnafuli.chittagong.gov.bd', NULL, NULL),
(80, 9, 'Coxsbazar Sadar', 'কক্সবাজার সদর', 'sadar.coxsbazar.gov.bd', NULL, NULL),
(81, 9, 'Chakaria', 'চকরিয়া', 'chakaria.coxsbazar.gov.bd', NULL, NULL),
(82, 9, 'Kutubdia', 'কুতুবদিয়া', 'kutubdia.coxsbazar.gov.bd', NULL, NULL),
(83, 9, 'Ukhiya', 'উখিয়া', 'ukhiya.coxsbazar.gov.bd', NULL, NULL),
(84, 9, 'Moheshkhali', 'মহেশখালী', 'moheshkhali.coxsbazar.gov.bd', NULL, NULL),
(85, 9, 'Pekua', 'পেকুয়া', 'pekua.coxsbazar.gov.bd', NULL, NULL),
(86, 9, 'Ramu', 'রামু', 'ramu.coxsbazar.gov.bd', NULL, NULL),
(87, 9, 'Teknaf', 'টেকনাফ', 'teknaf.coxsbazar.gov.bd', NULL, NULL),
(88, 10, 'Khagrachhari Sadar', 'খাগড়াছড়ি সদর', 'sadar.khagrachhari.gov.bd', NULL, NULL),
(89, 10, 'Dighinala', 'দিঘীনালা', 'dighinala.khagrachhari.gov.bd', NULL, NULL),
(90, 10, 'Panchari', 'পানছড়ি', 'panchari.khagrachhari.gov.bd', NULL, NULL),
(91, 10, 'Laxmichhari', 'লক্ষীছড়ি', 'laxmichhari.khagrachhari.gov.bd', NULL, NULL),
(92, 10, 'Mohalchari', 'মহালছড়ি', 'mohalchari.khagrachhari.gov.bd', NULL, NULL),
(93, 10, 'Manikchari', 'মানিকছড়ি', 'manikchari.khagrachhari.gov.bd', NULL, NULL),
(94, 10, 'Ramgarh', 'রামগড়', 'ramgarh.khagrachhari.gov.bd', NULL, NULL),
(95, 10, 'Matiranga', 'মাটিরাঙ্গা', 'matiranga.khagrachhari.gov.bd', NULL, NULL),
(96, 10, 'Guimara', 'গুইমারা', 'guimara.khagrachhari.gov.bd', NULL, NULL),
(97, 11, 'Bandarban Sadar', 'বান্দরবান সদর', 'sadar.bandarban.gov.bd', NULL, NULL),
(98, 11, 'Alikadam', 'আলীকদম', 'alikadam.bandarban.gov.bd', NULL, NULL),
(99, 11, 'Naikhongchhari', 'নাইক্ষ্যংছড়ি', 'naikhongchhari.bandarban.gov.bd', NULL, NULL),
(100, 11, 'Rowangchhari', 'রোয়াংছড়ি', 'rowangchhari.bandarban.gov.bd', NULL, NULL),
(101, 11, 'Lama', 'লামা', 'lama.bandarban.gov.bd', NULL, NULL),
(102, 11, 'Ruma', 'রুমা', 'ruma.bandarban.gov.bd', NULL, NULL),
(103, 11, 'Thanchi', 'থানচি', 'thanchi.bandarban.gov.bd', NULL, NULL),
(104, 12, 'Belkuchi', 'বেলকুচি', 'belkuchi.sirajganj.gov.bd', NULL, NULL),
(105, 12, 'Chauhali', 'চৌহালি', 'chauhali.sirajganj.gov.bd', NULL, NULL),
(106, 12, 'Kamarkhand', 'কামারখন্দ', 'kamarkhand.sirajganj.gov.bd', NULL, NULL),
(107, 12, 'Kazipur', 'কাজীপুর', 'kazipur.sirajganj.gov.bd', NULL, NULL),
(108, 12, 'Raigonj', 'রায়গঞ্জ', 'raigonj.sirajganj.gov.bd', NULL, NULL),
(109, 12, 'Shahjadpur', 'শাহজাদপুর', 'shahjadpur.sirajganj.gov.bd', NULL, NULL),
(110, 12, 'Sirajganj Sadar', 'সিরাজগঞ্জ সদর', 'sirajganjsadar.sirajganj.gov.bd', NULL, NULL),
(111, 12, 'Tarash', 'তাড়াশ', 'tarash.sirajganj.gov.bd', NULL, NULL),
(112, 12, 'Ullapara', 'উল্লাপাড়া', 'ullapara.sirajganj.gov.bd', NULL, NULL),
(113, 13, 'Sujanagar', 'সুজানগর', 'sujanagar.pabna.gov.bd', NULL, NULL),
(114, 13, 'Ishurdi', 'ঈশ্বরদী', 'ishurdi.pabna.gov.bd', NULL, NULL),
(115, 13, 'Bhangura', 'ভাঙ্গুড়া', 'bhangura.pabna.gov.bd', NULL, NULL),
(116, 13, 'Pabna Sadar', 'পাবনা সদর', 'pabnasadar.pabna.gov.bd', NULL, NULL),
(117, 13, 'Bera', 'বেড়া', 'bera.pabna.gov.bd', NULL, NULL),
(118, 13, 'Atghoria', 'আটঘরিয়া', 'atghoria.pabna.gov.bd', NULL, NULL),
(119, 13, 'Chatmohar', 'চাটমোহর', 'chatmohar.pabna.gov.bd', NULL, NULL),
(120, 13, 'Santhia', 'সাঁথিয়া', 'santhia.pabna.gov.bd', NULL, NULL),
(121, 13, 'Faridpur', 'ফরিদপুর', 'faridpur.pabna.gov.bd', NULL, NULL),
(122, 14, 'Kahaloo', 'কাহালু', 'kahaloo.bogra.gov.bd', NULL, NULL),
(123, 14, 'Bogra Sadar', 'বগুড়া সদর', 'sadar.bogra.gov.bd', NULL, NULL),
(124, 14, 'Shariakandi', 'সারিয়াকান্দি', 'shariakandi.bogra.gov.bd', NULL, NULL),
(125, 14, 'Shajahanpur', 'শাজাহানপুর', 'shajahanpur.bogra.gov.bd', NULL, NULL),
(126, 14, 'Dupchanchia', 'দুপচাচিঁয়া', 'dupchanchia.bogra.gov.bd', NULL, NULL),
(127, 14, 'Adamdighi', 'আদমদিঘি', 'adamdighi.bogra.gov.bd', NULL, NULL),
(128, 14, 'Nondigram', 'নন্দিগ্রাম', 'nondigram.bogra.gov.bd', NULL, NULL),
(129, 14, 'Sonatala', 'সোনাতলা', 'sonatala.bogra.gov.bd', NULL, NULL),
(130, 14, 'Dhunot', 'ধুনট', 'dhunot.bogra.gov.bd', NULL, NULL),
(131, 14, 'Gabtali', 'গাবতলী', 'gabtali.bogra.gov.bd', NULL, NULL),
(132, 14, 'Sherpur', 'শেরপুর', 'sherpur.bogra.gov.bd', NULL, NULL),
(133, 14, 'Shibganj', 'শিবগঞ্জ', 'shibganj.bogra.gov.bd', NULL, NULL),
(134, 15, 'Paba', 'পবা', 'paba.rajshahi.gov.bd', NULL, NULL),
(135, 15, 'Durgapur', 'দুর্গাপুর', 'durgapur.rajshahi.gov.bd', NULL, NULL),
(136, 15, 'Mohonpur', 'মোহনপুর', 'mohonpur.rajshahi.gov.bd', NULL, NULL),
(137, 15, 'Charghat', 'চারঘাট', 'charghat.rajshahi.gov.bd', NULL, NULL),
(138, 15, 'Puthia', 'পুঠিয়া', 'puthia.rajshahi.gov.bd', NULL, NULL),
(139, 15, 'Bagha', 'বাঘা', 'bagha.rajshahi.gov.bd', NULL, NULL),
(140, 15, 'Godagari', 'গোদাগাড়ী', 'godagari.rajshahi.gov.bd', NULL, NULL),
(141, 15, 'Tanore', 'তানোর', 'tanore.rajshahi.gov.bd', NULL, NULL),
(142, 15, 'Bagmara', 'বাগমারা', 'bagmara.rajshahi.gov.bd', NULL, NULL),
(143, 16, 'Natore Sadar', 'নাটোর সদর', 'natoresadar.natore.gov.bd', NULL, NULL),
(144, 16, 'Singra', 'সিংড়া', 'singra.natore.gov.bd', NULL, NULL),
(145, 16, 'Baraigram', 'বড়াইগ্রাম', 'baraigram.natore.gov.bd', NULL, NULL),
(146, 16, 'Bagatipara', 'বাগাতিপাড়া', 'bagatipara.natore.gov.bd', NULL, NULL),
(147, 16, 'Lalpur', 'লালপুর', 'lalpur.natore.gov.bd', NULL, NULL),
(148, 16, 'Gurudaspur', 'গুরুদাসপুর', 'gurudaspur.natore.gov.bd', NULL, NULL),
(149, 16, 'Naldanga', 'নলডাঙ্গা', 'naldanga.natore.gov.bd', NULL, NULL),
(150, 17, 'Akkelpur', 'আক্কেলপুর', 'akkelpur.joypurhat.gov.bd', NULL, NULL),
(151, 17, 'Kalai', 'কালাই', 'kalai.joypurhat.gov.bd', NULL, NULL),
(152, 17, 'Khetlal', 'ক্ষেতলাল', 'khetlal.joypurhat.gov.bd', NULL, NULL),
(153, 17, 'Panchbibi', 'পাঁচবিবি', 'panchbibi.joypurhat.gov.bd', NULL, NULL),
(154, 17, 'Joypurhat Sadar', 'জয়পুরহাট সদর', 'joypurhatsadar.joypurhat.gov.bd', NULL, NULL),
(155, 18, 'Chapainawabganj Sadar', 'চাঁপাইনবাবগঞ্জ সদর', 'chapainawabganjsadar.chapainawabganj.gov.bd', NULL, NULL),
(156, 18, 'Gomostapur', 'গোমস্তাপুর', 'gomostapur.chapainawabganj.gov.bd', NULL, NULL),
(157, 18, 'Nachol', 'নাচোল', 'nachol.chapainawabganj.gov.bd', NULL, NULL),
(158, 18, 'Bholahat', 'ভোলাহাট', 'bholahat.chapainawabganj.gov.bd', NULL, NULL),
(159, 18, 'Shibganj', 'শিবগঞ্জ', 'shibganj.chapainawabganj.gov.bd', NULL, NULL),
(160, 19, 'Mohadevpur', 'মহাদেবপুর', 'mohadevpur.naogaon.gov.bd', NULL, NULL),
(161, 19, 'Badalgachi', 'বদলগাছী', 'badalgachi.naogaon.gov.bd', NULL, NULL),
(162, 19, 'Patnitala', 'পত্নিতলা', 'patnitala.naogaon.gov.bd', NULL, NULL),
(163, 19, 'Dhamoirhat', 'ধামইরহাট', 'dhamoirhat.naogaon.gov.bd', NULL, NULL),
(164, 19, 'Niamatpur', 'নিয়ামতপুর', 'niamatpur.naogaon.gov.bd', NULL, NULL),
(165, 19, 'Manda', 'মান্দা', 'manda.naogaon.gov.bd', NULL, NULL),
(166, 19, 'Atrai', 'আত্রাই', 'atrai.naogaon.gov.bd', NULL, NULL),
(167, 19, 'Raninagar', 'রাণীনগর', 'raninagar.naogaon.gov.bd', NULL, NULL),
(168, 19, 'Naogaon Sadar', 'নওগাঁ সদর', 'naogaonsadar.naogaon.gov.bd', NULL, NULL),
(169, 19, 'Porsha', 'পোরশা', 'porsha.naogaon.gov.bd', NULL, NULL),
(170, 19, 'Sapahar', 'সাপাহার', 'sapahar.naogaon.gov.bd', NULL, NULL),
(171, 20, 'Manirampur', 'মণিরামপুর', 'manirampur.jessore.gov.bd', NULL, NULL),
(172, 20, 'Abhaynagar', 'অভয়নগর', 'abhaynagar.jessore.gov.bd', NULL, NULL),
(173, 20, 'Bagherpara', 'বাঘারপাড়া', 'bagherpara.jessore.gov.bd', NULL, NULL),
(174, 20, 'Chougachha', 'চৌগাছা', 'chougachha.jessore.gov.bd', NULL, NULL),
(175, 20, 'Jhikargacha', 'ঝিকরগাছা', 'jhikargacha.jessore.gov.bd', NULL, NULL),
(176, 20, 'Keshabpur', 'কেশবপুর', 'keshabpur.jessore.gov.bd', NULL, NULL),
(177, 20, 'Jessore Sadar', 'যশোর সদর', 'sadar.jessore.gov.bd', NULL, NULL),
(178, 20, 'Sharsha', 'শার্শা', 'sharsha.jessore.gov.bd', NULL, NULL),
(179, 21, 'Assasuni', 'আশাশুনি', 'assasuni.satkhira.gov.bd', NULL, NULL),
(180, 21, 'Debhata', 'দেবহাটা', 'debhata.satkhira.gov.bd', NULL, NULL),
(181, 21, 'Kalaroa', 'কলারোয়া', 'kalaroa.satkhira.gov.bd', NULL, NULL),
(182, 21, 'Satkhira Sadar', 'সাতক্ষীরা সদর', 'satkhirasadar.satkhira.gov.bd', NULL, NULL),
(183, 21, 'Shyamnagar', 'শ্যামনগর', 'shyamnagar.satkhira.gov.bd', NULL, NULL),
(184, 21, 'Tala', 'তালা', 'tala.satkhira.gov.bd', NULL, NULL),
(185, 21, 'Kaliganj', 'কালিগঞ্জ', 'kaliganj.satkhira.gov.bd', NULL, NULL),
(186, 22, 'Mujibnagar', 'মুজিবনগর', 'mujibnagar.meherpur.gov.bd', NULL, NULL),
(187, 22, 'Meherpur Sadar', 'মেহেরপুর সদর', 'meherpursadar.meherpur.gov.bd', NULL, NULL),
(188, 22, 'Gangni', 'গাংনী', 'gangni.meherpur.gov.bd', NULL, NULL),
(189, 23, 'Narail Sadar', 'নড়াইল সদর', 'narailsadar.narail.gov.bd', NULL, NULL),
(190, 23, 'Lohagara', 'লোহাগড়া', 'lohagara.narail.gov.bd', NULL, NULL),
(191, 23, 'Kalia', 'কালিয়া', 'kalia.narail.gov.bd', NULL, NULL),
(192, 24, 'Chuadanga Sadar', 'চুয়াডাঙ্গা সদর', 'chuadangasadar.chuadanga.gov.bd', NULL, NULL),
(193, 24, 'Alamdanga', 'আলমডাঙ্গা', 'alamdanga.chuadanga.gov.bd', NULL, NULL),
(194, 24, 'Damurhuda', 'দামুড়হুদা', 'damurhuda.chuadanga.gov.bd', NULL, NULL),
(195, 24, 'Jibannagar', 'জীবননগর', 'jibannagar.chuadanga.gov.bd', NULL, NULL),
(196, 25, 'Kushtia Sadar', 'কুষ্টিয়া সদর', 'kushtiasadar.kushtia.gov.bd', NULL, NULL),
(197, 25, 'Kumarkhali', 'কুমারখালী', 'kumarkhali.kushtia.gov.bd', NULL, NULL),
(198, 25, 'Khoksa', 'খোকসা', 'khoksa.kushtia.gov.bd', NULL, NULL),
(199, 25, 'Mirpur', 'মিরপুর', 'mirpurkushtia.kushtia.gov.bd', NULL, NULL),
(200, 25, 'Daulatpur', 'দৌলতপুর', 'daulatpur.kushtia.gov.bd', NULL, NULL),
(201, 25, 'Bheramara', 'ভেড়ামারা', 'bheramara.kushtia.gov.bd', NULL, NULL),
(202, 26, 'Shalikha', 'শালিখা', 'shalikha.magura.gov.bd', NULL, NULL),
(203, 26, 'Sreepur', 'শ্রীপুর', 'sreepur.magura.gov.bd', NULL, NULL),
(204, 26, 'Magura Sadar', 'মাগুরা সদর', 'magurasadar.magura.gov.bd', NULL, NULL),
(205, 26, 'Mohammadpur', 'মহম্মদপুর', 'mohammadpur.magura.gov.bd', NULL, NULL),
(206, 27, 'Paikgasa', 'পাইকগাছা', 'paikgasa.khulna.gov.bd', NULL, NULL),
(207, 27, 'Fultola', 'ফুলতলা', 'fultola.khulna.gov.bd', NULL, NULL),
(208, 27, 'Digholia', 'দিঘলিয়া', 'digholia.khulna.gov.bd', NULL, NULL),
(209, 27, 'Rupsha', 'রূপসা', 'rupsha.khulna.gov.bd', NULL, NULL),
(210, 27, 'Terokhada', 'তেরখাদা', 'terokhada.khulna.gov.bd', NULL, NULL),
(211, 27, 'Dumuria', 'ডুমুরিয়া', 'dumuria.khulna.gov.bd', NULL, NULL),
(212, 27, 'Botiaghata', 'বটিয়াঘাটা', 'botiaghata.khulna.gov.bd', NULL, NULL),
(213, 27, 'Dakop', 'দাকোপ', 'dakop.khulna.gov.bd', NULL, NULL),
(214, 27, 'Koyra', 'কয়রা', 'koyra.khulna.gov.bd', NULL, NULL),
(215, 28, 'Fakirhat', 'ফকিরহাট', 'fakirhat.bagerhat.gov.bd', NULL, NULL),
(216, 28, 'Bagerhat Sadar', 'বাগেরহাট সদর', 'sadar.bagerhat.gov.bd', NULL, NULL),
(217, 28, 'Mollahat', 'মোল্লাহাট', 'mollahat.bagerhat.gov.bd', NULL, NULL),
(218, 28, 'Sarankhola', 'শরণখোলা', 'sarankhola.bagerhat.gov.bd', NULL, NULL),
(219, 28, 'Rampal', 'রামপাল', 'rampal.bagerhat.gov.bd', NULL, NULL),
(220, 28, 'Morrelganj', 'মোড়েলগঞ্জ', 'morrelganj.bagerhat.gov.bd', NULL, NULL),
(221, 28, 'Kachua', 'কচুয়া', 'kachua.bagerhat.gov.bd', NULL, NULL),
(222, 28, 'Mongla', 'মোংলা', 'mongla.bagerhat.gov.bd', NULL, NULL),
(223, 28, 'Chitalmari', 'চিতলমারী', 'chitalmari.bagerhat.gov.bd', NULL, NULL),
(224, 29, 'Jhenaidah Sadar', 'ঝিনাইদহ সদর', 'sadar.jhenaidah.gov.bd', NULL, NULL),
(225, 29, 'Shailkupa', 'শৈলকুপা', 'shailkupa.jhenaidah.gov.bd', NULL, NULL),
(226, 29, 'Harinakundu', 'হরিণাকুন্ডু', 'harinakundu.jhenaidah.gov.bd', NULL, NULL),
(227, 29, 'Kaliganj', 'কালীগঞ্জ', 'kaliganj.jhenaidah.gov.bd', NULL, NULL),
(228, 29, 'Kotchandpur', 'কোটচাঁদপুর', 'kotchandpur.jhenaidah.gov.bd', NULL, NULL),
(229, 29, 'Moheshpur', 'মহেশপুর', 'moheshpur.jhenaidah.gov.bd', NULL, NULL),
(230, 30, 'Jhalakathi Sadar', 'ঝালকাঠি সদর', 'sadar.jhalakathi.gov.bd', NULL, NULL),
(231, 30, 'Kathalia', 'কাঠালিয়া', 'kathalia.jhalakathi.gov.bd', NULL, NULL),
(232, 30, 'Nalchity', 'নলছিটি', 'nalchity.jhalakathi.gov.bd', NULL, NULL),
(233, 30, 'Rajapur', 'রাজাপুর', 'rajapur.jhalakathi.gov.bd', NULL, NULL),
(234, 31, 'Bauphal', 'বাউফল', 'bauphal.patuakhali.gov.bd', NULL, NULL),
(235, 31, 'Patuakhali Sadar', 'পটুয়াখালী সদর', 'sadar.patuakhali.gov.bd', NULL, NULL),
(236, 31, 'Dumki', 'দুমকি', 'dumki.patuakhali.gov.bd', NULL, NULL),
(237, 31, 'Dashmina', 'দশমিনা', 'dashmina.patuakhali.gov.bd', NULL, NULL),
(238, 31, 'Kalapara', 'কলাপাড়া', 'kalapara.patuakhali.gov.bd', NULL, NULL),
(239, 31, 'Mirzaganj', 'মির্জাগঞ্জ', 'mirzaganj.patuakhali.gov.bd', NULL, NULL),
(240, 31, 'Galachipa', 'গলাচিপা', 'galachipa.patuakhali.gov.bd', NULL, NULL),
(241, 31, 'Rangabali', 'রাঙ্গাবালী', 'rangabali.patuakhali.gov.bd', NULL, NULL),
(242, 32, 'Pirojpur Sadar', 'পিরোজপুর সদর', 'sadar.pirojpur.gov.bd', NULL, NULL),
(243, 32, 'Nazirpur', 'নাজিরপুর', 'nazirpur.pirojpur.gov.bd', NULL, NULL),
(244, 32, 'Kawkhali', 'কাউখালী', 'kawkhali.pirojpur.gov.bd', NULL, NULL),
(245, 32, 'Zianagar', 'জিয়ানগর', 'zianagar.pirojpur.gov.bd', NULL, NULL),
(246, 32, 'Bhandaria', 'ভান্ডারিয়া', 'bhandaria.pirojpur.gov.bd', NULL, NULL),
(247, 32, 'Mathbaria', 'মঠবাড়ীয়া', 'mathbaria.pirojpur.gov.bd', NULL, NULL),
(248, 32, 'Nesarabad', 'নেছারাবাদ', 'nesarabad.pirojpur.gov.bd', NULL, NULL),
(249, 33, 'Barisal Sadar', 'বরিশাল সদর', 'barisalsadar.barisal.gov.bd', NULL, NULL),
(250, 33, 'Bakerganj', 'বাকেরগঞ্জ', 'bakerganj.barisal.gov.bd', NULL, NULL),
(251, 33, 'Babuganj', 'বাবুগঞ্জ', 'babuganj.barisal.gov.bd', NULL, NULL),
(252, 33, 'Wazirpur', 'উজিরপুর', 'wazirpur.barisal.gov.bd', NULL, NULL),
(253, 33, 'Banaripara', 'বানারীপাড়া', 'banaripara.barisal.gov.bd', NULL, NULL),
(254, 33, 'Gournadi', 'গৌরনদী', 'gournadi.barisal.gov.bd', NULL, NULL),
(255, 33, 'Agailjhara', 'আগৈলঝাড়া', 'agailjhara.barisal.gov.bd', NULL, NULL),
(256, 33, 'Mehendiganj', 'মেহেন্দিগঞ্জ', 'mehendiganj.barisal.gov.bd', NULL, NULL),
(257, 33, 'Muladi', 'মুলাদী', 'muladi.barisal.gov.bd', NULL, NULL),
(258, 33, 'Hizla', 'হিজলা', 'hizla.barisal.gov.bd', NULL, NULL),
(259, 34, 'Bhola Sadar', 'ভোলা সদর', 'sadar.bhola.gov.bd', NULL, NULL),
(260, 34, 'Borhan Sddin', 'বোরহান উদ্দিন', 'borhanuddin.bhola.gov.bd', NULL, NULL),
(261, 34, 'Charfesson', 'চরফ্যাশন', 'charfesson.bhola.gov.bd', NULL, NULL),
(262, 34, 'Doulatkhan', 'দৌলতখান', 'doulatkhan.bhola.gov.bd', NULL, NULL),
(263, 34, 'Monpura', 'মনপুরা', 'monpura.bhola.gov.bd', NULL, NULL),
(264, 34, 'Tazumuddin', 'তজুমদ্দিন', 'tazumuddin.bhola.gov.bd', NULL, NULL),
(265, 34, 'Lalmohan', 'লালমোহন', 'lalmohan.bhola.gov.bd', NULL, NULL),
(266, 35, 'Amtali', 'আমতলী', 'amtali.barguna.gov.bd', NULL, NULL),
(267, 35, 'Barguna Sadar', 'বরগুনা সদর', 'sadar.barguna.gov.bd', NULL, NULL),
(268, 35, 'Betagi', 'বেতাগী', 'betagi.barguna.gov.bd', NULL, NULL),
(269, 35, 'Bamna', 'বামনা', 'bamna.barguna.gov.bd', NULL, NULL),
(270, 35, 'Pathorghata', 'পাথরঘাটা', 'pathorghata.barguna.gov.bd', NULL, NULL),
(271, 35, 'Taltali', 'তালতলি', 'taltali.barguna.gov.bd', NULL, NULL),
(272, 36, 'Balaganj', 'বালাগঞ্জ', 'balaganj.sylhet.gov.bd', NULL, NULL),
(273, 36, 'Beanibazar', 'বিয়ানীবাজার', 'beanibazar.sylhet.gov.bd', NULL, NULL),
(274, 36, 'Bishwanath', 'বিশ্বনাথ', 'bishwanath.sylhet.gov.bd', NULL, NULL),
(275, 36, 'Companiganj', 'কোম্পানীগঞ্জ', 'companiganj.sylhet.gov.bd', NULL, NULL),
(276, 36, 'Fenchuganj', 'ফেঞ্চুগঞ্জ', 'fenchuganj.sylhet.gov.bd', NULL, NULL),
(277, 36, 'Golapganj', 'গোলাপগঞ্জ', 'golapganj.sylhet.gov.bd', NULL, NULL),
(278, 36, 'Gowainghat', 'গোয়াইনঘাট', 'gowainghat.sylhet.gov.bd', NULL, NULL),
(279, 36, 'Jaintiapur', 'জৈন্তাপুর', 'jaintiapur.sylhet.gov.bd', NULL, NULL),
(280, 36, 'Kanaighat', 'কানাইঘাট', 'kanaighat.sylhet.gov.bd', NULL, NULL),
(281, 36, 'Sylhet Sadar', 'সিলেট সদর', 'sylhetsadar.sylhet.gov.bd', NULL, NULL),
(282, 36, 'Zakiganj', 'জকিগঞ্জ', 'zakiganj.sylhet.gov.bd', NULL, NULL),
(283, 36, 'Dakshinsurma', 'দক্ষিণ সুরমা', 'dakshinsurma.sylhet.gov.bd', NULL, NULL),
(284, 36, 'Osmaninagar', 'ওসমানী নগর', 'osmaninagar.sylhet.gov.bd', NULL, NULL),
(285, 37, 'Barlekha', 'বড়লেখা', 'barlekha.moulvibazar.gov.bd', NULL, NULL),
(286, 37, 'Kamolganj', 'কমলগঞ্জ', 'kamolganj.moulvibazar.gov.bd', NULL, NULL),
(287, 37, 'Kulaura', 'কুলাউড়া', 'kulaura.moulvibazar.gov.bd', NULL, NULL),
(288, 37, 'Moulvibazar Sadar', 'মৌলভীবাজার সদর', 'moulvibazarsadar.moulvibazar.gov.bd', NULL, NULL),
(289, 37, 'Rajnagar', 'রাজনগর', 'rajnagar.moulvibazar.gov.bd', NULL, NULL),
(290, 37, 'Sreemangal', 'শ্রীমঙ্গল', 'sreemangal.moulvibazar.gov.bd', NULL, NULL),
(291, 37, 'Juri', 'জুড়ী', 'juri.moulvibazar.gov.bd', NULL, NULL),
(292, 38, 'Nabiganj', 'নবীগঞ্জ', 'nabiganj.habiganj.gov.bd', NULL, NULL),
(293, 38, 'Bahubal', 'বাহুবল', 'bahubal.habiganj.gov.bd', NULL, NULL),
(294, 38, 'Ajmiriganj', 'আজমিরীগঞ্জ', 'ajmiriganj.habiganj.gov.bd', NULL, NULL),
(295, 38, 'Baniachong', 'বানিয়াচং', 'baniachong.habiganj.gov.bd', NULL, NULL),
(296, 38, 'Lakhai', 'লাখাই', 'lakhai.habiganj.gov.bd', NULL, NULL),
(297, 38, 'Chunarughat', 'চুনারুঘাট', 'chunarughat.habiganj.gov.bd', NULL, NULL),
(298, 38, 'Habiganj Sadar', 'হবিগঞ্জ সদর', 'habiganjsadar.habiganj.gov.bd', NULL, NULL),
(299, 38, 'Madhabpur', 'মাধবপুর', 'madhabpur.habiganj.gov.bd', NULL, NULL),
(300, 39, 'Sunamganj Sadar', 'সুনামগঞ্জ সদর', 'sadar.sunamganj.gov.bd', NULL, NULL),
(301, 39, 'South Sunamganj', 'দক্ষিণ সুনামগঞ্জ', 'southsunamganj.sunamganj.gov.bd', NULL, NULL),
(302, 39, 'Bishwambarpur', 'বিশ্বম্ভরপুর', 'bishwambarpur.sunamganj.gov.bd', NULL, NULL),
(303, 39, 'Chhatak', 'ছাতক', 'chhatak.sunamganj.gov.bd', NULL, NULL),
(304, 39, 'Jagannathpur', 'জগন্নাথপুর', 'jagannathpur.sunamganj.gov.bd', NULL, NULL),
(305, 39, 'Dowarabazar', 'দোয়ারাবাজার', 'dowarabazar.sunamganj.gov.bd', NULL, NULL),
(306, 39, 'Tahirpur', 'তাহিরপুর', 'tahirpur.sunamganj.gov.bd', NULL, NULL),
(307, 39, 'Dharmapasha', 'ধর্মপাশা', 'dharmapasha.sunamganj.gov.bd', NULL, NULL),
(308, 39, 'Jamalganj', 'জামালগঞ্জ', 'jamalganj.sunamganj.gov.bd', NULL, NULL),
(309, 39, 'Shalla', 'শাল্লা', 'shalla.sunamganj.gov.bd', NULL, NULL),
(310, 39, 'Derai', 'দিরাই', 'derai.sunamganj.gov.bd', NULL, NULL),
(311, 40, 'Belabo', 'বেলাবো', 'belabo.narsingdi.gov.bd', NULL, NULL),
(312, 40, 'Monohardi', 'মনোহরদী', 'monohardi.narsingdi.gov.bd', NULL, NULL),
(313, 40, 'Narsingdi Sadar', 'নরসিংদী সদর', 'narsingdisadar.narsingdi.gov.bd', NULL, NULL),
(314, 40, 'Palash', 'পলাশ', 'palash.narsingdi.gov.bd', NULL, NULL),
(315, 40, 'Raipura', 'রায়পুরা', 'raipura.narsingdi.gov.bd', NULL, NULL),
(316, 40, 'Shibpur', 'শিবপুর', 'shibpur.narsingdi.gov.bd', NULL, NULL),
(317, 41, 'Kaliganj', 'কালীগঞ্জ', 'kaliganj.gazipur.gov.bd', NULL, NULL),
(318, 41, 'Kaliakair', 'কালিয়াকৈর', 'kaliakair.gazipur.gov.bd', NULL, NULL),
(319, 41, 'Kapasia', 'কাপাসিয়া', 'kapasia.gazipur.gov.bd', NULL, NULL),
(320, 41, 'Gazipur Sadar', 'গাজীপুর সদর', 'sadar.gazipur.gov.bd', NULL, NULL),
(321, 41, 'Sreepur', 'শ্রীপুর', 'sreepur.gazipur.gov.bd', NULL, NULL),
(322, 42, 'Shariatpur Sadar', 'শরিয়তপুর সদর', 'sadar.shariatpur.gov.bd', NULL, NULL),
(323, 42, 'Naria', 'নড়িয়া', 'naria.shariatpur.gov.bd', NULL, NULL),
(324, 42, 'Zajira', 'জাজিরা', 'zajira.shariatpur.gov.bd', NULL, NULL),
(325, 42, 'Gosairhat', 'গোসাইরহাট', 'gosairhat.shariatpur.gov.bd', NULL, NULL),
(326, 42, 'Bhedarganj', 'ভেদরগঞ্জ', 'bhedarganj.shariatpur.gov.bd', NULL, NULL),
(327, 42, 'Damudya', 'ডামুড্যা', 'damudya.shariatpur.gov.bd', NULL, NULL),
(328, 43, 'Araihazar', 'আড়াইহাজার', 'araihazar.narayanganj.gov.bd', NULL, NULL),
(329, 43, 'Bandar', 'বন্দর', 'bandar.narayanganj.gov.bd', NULL, NULL),
(330, 43, 'Narayanganj Sadar', 'নারায়নগঞ্জ সদর', 'narayanganjsadar.narayanganj.gov.bd', NULL, NULL),
(331, 43, 'Rupganj', 'রূপগঞ্জ', 'rupganj.narayanganj.gov.bd', NULL, NULL),
(332, 43, 'Sonargaon', 'সোনারগাঁ', 'sonargaon.narayanganj.gov.bd', NULL, NULL),
(333, 44, 'Basail', 'বাসাইল', 'basail.tangail.gov.bd', NULL, NULL),
(334, 44, 'Bhuapur', 'ভুয়াপুর', 'bhuapur.tangail.gov.bd', NULL, NULL),
(335, 44, 'Delduar', 'দেলদুয়ার', 'delduar.tangail.gov.bd', NULL, NULL),
(336, 44, 'Ghatail', 'ঘাটাইল', 'ghatail.tangail.gov.bd', NULL, NULL),
(337, 44, 'Gopalpur', 'গোপালপুর', 'gopalpur.tangail.gov.bd', NULL, NULL),
(338, 44, 'Madhupur', 'মধুপুর', 'madhupur.tangail.gov.bd', NULL, NULL),
(339, 44, 'Mirzapur', 'মির্জাপুর', 'mirzapur.tangail.gov.bd', NULL, NULL),
(340, 44, 'Nagarpur', 'নাগরপুর', 'nagarpur.tangail.gov.bd', NULL, NULL),
(341, 44, 'Sakhipur', 'সখিপুর', 'sakhipur.tangail.gov.bd', NULL, NULL),
(342, 44, 'Tangail Sadar', 'টাঙ্গাইল সদর', 'tangailsadar.tangail.gov.bd', NULL, NULL),
(343, 44, 'Kalihati', 'কালিহাতী', 'kalihati.tangail.gov.bd', NULL, NULL),
(344, 44, 'Dhanbari', 'ধনবাড়ী', 'dhanbari.tangail.gov.bd', NULL, NULL),
(345, 45, 'Itna', 'ইটনা', 'itna.kishoreganj.gov.bd', NULL, NULL),
(346, 45, 'Katiadi', 'কটিয়াদী', 'katiadi.kishoreganj.gov.bd', NULL, NULL),
(347, 45, 'Bhairab', 'ভৈরব', 'bhairab.kishoreganj.gov.bd', NULL, NULL),
(348, 45, 'Tarail', 'তাড়াইল', 'tarail.kishoreganj.gov.bd', NULL, NULL),
(349, 45, 'Hossainpur', 'হোসেনপুর', 'hossainpur.kishoreganj.gov.bd', NULL, NULL),
(350, 45, 'Pakundia', 'পাকুন্দিয়া', 'pakundia.kishoreganj.gov.bd', NULL, NULL),
(351, 45, 'Kuliarchar', 'কুলিয়ারচর', 'kuliarchar.kishoreganj.gov.bd', NULL, NULL),
(352, 45, 'Kishoreganj Sadar', 'কিশোরগঞ্জ সদর', 'kishoreganjsadar.kishoreganj.gov.bd', NULL, NULL),
(353, 45, 'Karimgonj', 'করিমগঞ্জ', 'karimgonj.kishoreganj.gov.bd', NULL, NULL),
(354, 45, 'Bajitpur', 'বাজিতপুর', 'bajitpur.kishoreganj.gov.bd', NULL, NULL),
(355, 45, 'Austagram', 'অষ্টগ্রাম', 'austagram.kishoreganj.gov.bd', NULL, NULL),
(356, 45, 'Mithamoin', 'মিঠামইন', 'mithamoin.kishoreganj.gov.bd', NULL, NULL),
(357, 45, 'Nikli', 'নিকলী', 'nikli.kishoreganj.gov.bd', NULL, NULL),
(358, 46, 'Harirampur', 'হরিরামপুর', 'harirampur.manikganj.gov.bd', NULL, NULL),
(359, 46, 'Saturia', 'সাটুরিয়া', 'saturia.manikganj.gov.bd', NULL, NULL),
(360, 46, 'Manikganj Sadar', 'মানিকগঞ্জ সদর', 'sadar.manikganj.gov.bd', NULL, NULL),
(361, 46, 'Gior', 'ঘিওর', 'gior.manikganj.gov.bd', NULL, NULL),
(362, 46, 'Shibaloy', 'শিবালয়', 'shibaloy.manikganj.gov.bd', NULL, NULL),
(363, 46, 'Doulatpur', 'দৌলতপুর', 'doulatpur.manikganj.gov.bd', NULL, NULL),
(364, 46, 'Singiar', 'সিংগাইর', 'singiar.manikganj.gov.bd', NULL, NULL),
(365, 47, 'Savar', 'সাভার', 'savar.dhaka.gov.bd', NULL, NULL),
(366, 47, 'Dhamrai', 'ধামরাই', 'dhamrai.dhaka.gov.bd', NULL, NULL),
(367, 47, 'Keraniganj', 'কেরাণীগঞ্জ', 'keraniganj.dhaka.gov.bd', NULL, NULL),
(368, 47, 'Nawabganj', 'নবাবগঞ্জ', 'nawabganj.dhaka.gov.bd', NULL, NULL),
(369, 47, 'Dohar', 'দোহার', 'dohar.dhaka.gov.bd', NULL, NULL),
(370, 48, 'Munshiganj Sadar', 'মুন্সিগঞ্জ সদর', 'sadar.munshiganj.gov.bd', NULL, NULL),
(371, 48, 'Sreenagar', 'শ্রীনগর', 'sreenagar.munshiganj.gov.bd', NULL, NULL),
(372, 48, 'Sirajdikhan', 'সিরাজদিখান', 'sirajdikhan.munshiganj.gov.bd', NULL, NULL),
(373, 48, 'Louhajanj', 'লৌহজং', 'louhajanj.munshiganj.gov.bd', NULL, NULL),
(374, 48, 'Gajaria', 'গজারিয়া', 'gajaria.munshiganj.gov.bd', NULL, NULL),
(375, 48, 'Tongibari', 'টংগীবাড়ি', 'tongibari.munshiganj.gov.bd', NULL, NULL),
(376, 49, 'Rajbari Sadar', 'রাজবাড়ী সদর', 'sadar.rajbari.gov.bd', NULL, NULL),
(377, 49, 'Goalanda', 'গোয়ালন্দ', 'goalanda.rajbari.gov.bd', NULL, NULL),
(378, 49, 'Pangsa', 'পাংশা', 'pangsa.rajbari.gov.bd', NULL, NULL),
(379, 49, 'Baliakandi', 'বালিয়াকান্দি', 'baliakandi.rajbari.gov.bd', NULL, NULL),
(380, 49, 'Kalukhali', 'কালুখালী', 'kalukhali.rajbari.gov.bd', NULL, NULL),
(381, 50, 'Madaripur Sadar', 'মাদারীপুর সদর', 'sadar.madaripur.gov.bd', NULL, NULL),
(382, 50, 'Shibchar', 'শিবচর', 'shibchar.madaripur.gov.bd', NULL, NULL),
(383, 50, 'Kalkini', 'কালকিনি', 'kalkini.madaripur.gov.bd', NULL, NULL),
(384, 50, 'Rajoir', 'রাজৈর', 'rajoir.madaripur.gov.bd', NULL, NULL),
(385, 51, 'Gopalganj Sadar', 'গোপালগঞ্জ সদর', 'sadar.gopalganj.gov.bd', NULL, NULL),
(386, 51, 'Kashiani', 'কাশিয়ানী', 'kashiani.gopalganj.gov.bd', NULL, NULL),
(387, 51, 'Tungipara', 'টুংগীপাড়া', 'tungipara.gopalganj.gov.bd', NULL, NULL),
(388, 51, 'Kotalipara', 'কোটালীপাড়া', 'kotalipara.gopalganj.gov.bd', NULL, NULL),
(389, 51, 'Muksudpur', 'মুকসুদপুর', 'muksudpur.gopalganj.gov.bd', NULL, NULL),
(390, 52, 'Faridpur Sadar', 'ফরিদপুর সদর', 'sadar.faridpur.gov.bd', NULL, NULL),
(391, 52, 'Alfadanga', 'আলফাডাঙ্গা', 'alfadanga.faridpur.gov.bd', NULL, NULL),
(392, 52, 'Boalmari', 'বোয়ালমারী', 'boalmari.faridpur.gov.bd', NULL, NULL),
(393, 52, 'Sadarpur', 'সদরপুর', 'sadarpur.faridpur.gov.bd', NULL, NULL),
(394, 52, 'Nagarkanda', 'নগরকান্দা', 'nagarkanda.faridpur.gov.bd', NULL, NULL),
(395, 52, 'Bhanga', 'ভাঙ্গা', 'bhanga.faridpur.gov.bd', NULL, NULL),
(396, 52, 'Charbhadrasan', 'চরভদ্রাসন', 'charbhadrasan.faridpur.gov.bd', NULL, NULL),
(397, 52, 'Madhukhali', 'মধুখালী', 'madhukhali.faridpur.gov.bd', NULL, NULL),
(398, 52, 'Saltha', 'সালথা', 'saltha.faridpur.gov.bd', NULL, NULL),
(399, 53, 'Panchagarh Sadar', 'পঞ্চগড় সদর', 'panchagarhsadar.panchagarh.gov.bd', NULL, NULL),
(400, 53, 'Debiganj', 'দেবীগঞ্জ', 'debiganj.panchagarh.gov.bd', NULL, NULL),
(401, 53, 'Boda', 'বোদা', 'boda.panchagarh.gov.bd', NULL, NULL),
(402, 53, 'Atwari', 'আটোয়ারী', 'atwari.panchagarh.gov.bd', NULL, NULL),
(403, 53, 'Tetulia', 'তেতুলিয়া', 'tetulia.panchagarh.gov.bd', NULL, NULL),
(404, 54, 'Nawabganj', 'নবাবগঞ্জ', 'nawabganj.dinajpur.gov.bd', NULL, NULL),
(405, 54, 'Birganj', 'বীরগঞ্জ', 'birganj.dinajpur.gov.bd', NULL, NULL),
(406, 54, 'Ghoraghat', 'ঘোড়াঘাট', 'ghoraghat.dinajpur.gov.bd', NULL, NULL),
(407, 54, 'Birampur', 'বিরামপুর', 'birampur.dinajpur.gov.bd', NULL, NULL),
(408, 54, 'Parbatipur', 'পার্বতীপুর', 'parbatipur.dinajpur.gov.bd', NULL, NULL),
(409, 54, 'Bochaganj', 'বোচাগঞ্জ', 'bochaganj.dinajpur.gov.bd', NULL, NULL),
(410, 54, 'Kaharol', 'কাহারোল', 'kaharol.dinajpur.gov.bd', NULL, NULL),
(411, 54, 'Fulbari', 'ফুলবাড়ী', 'fulbari.dinajpur.gov.bd', NULL, NULL),
(412, 54, 'Dinajpur Sadar', 'দিনাজপুর সদর', 'dinajpursadar.dinajpur.gov.bd', NULL, NULL),
(413, 54, 'Hakimpur', 'হাকিমপুর', 'hakimpur.dinajpur.gov.bd', NULL, NULL),
(414, 54, 'Khansama', 'খানসামা', 'khansama.dinajpur.gov.bd', NULL, NULL),
(415, 54, 'Birol', 'বিরল', 'birol.dinajpur.gov.bd', NULL, NULL),
(416, 54, 'Chirirbandar', 'চিরিরবন্দর', 'chirirbandar.dinajpur.gov.bd', NULL, NULL),
(417, 55, 'Lalmonirhat Sadar', 'লালমনিরহাট সদর', 'sadar.lalmonirhat.gov.bd', NULL, NULL),
(418, 55, 'Kaliganj', 'কালীগঞ্জ', 'kaliganj.lalmonirhat.gov.bd', NULL, NULL),
(419, 55, 'Hatibandha', 'হাতীবান্ধা', 'hatibandha.lalmonirhat.gov.bd', NULL, NULL),
(420, 55, 'Patgram', 'পাটগ্রাম', 'patgram.lalmonirhat.gov.bd', NULL, NULL),
(421, 55, 'Aditmari', 'আদিতমারী', 'aditmari.lalmonirhat.gov.bd', NULL, NULL),
(422, 56, 'Syedpur', 'সৈয়দপুর', 'syedpur.nilphamari.gov.bd', NULL, NULL),
(423, 56, 'Domar', 'ডোমার', 'domar.nilphamari.gov.bd', NULL, NULL),
(424, 56, 'Dimla', 'ডিমলা', 'dimla.nilphamari.gov.bd', NULL, NULL),
(425, 56, 'Jaldhaka', 'জলঢাকা', 'jaldhaka.nilphamari.gov.bd', NULL, NULL),
(426, 56, 'Kishorganj', 'কিশোরগঞ্জ', 'kishorganj.nilphamari.gov.bd', NULL, NULL),
(427, 56, 'Nilphamari Sadar', 'নীলফামারী সদর', 'nilphamarisadar.nilphamari.gov.bd', NULL, NULL),
(428, 57, 'Sadullapur', 'সাদুল্লাপুর', 'sadullapur.gaibandha.gov.bd', NULL, NULL),
(429, 57, 'Gaibandha Sadar', 'গাইবান্ধা সদর', 'gaibandhasadar.gaibandha.gov.bd', NULL, NULL),
(430, 57, 'Palashbari', 'পলাশবাড়ী', 'palashbari.gaibandha.gov.bd', NULL, NULL),
(431, 57, 'Saghata', 'সাঘাটা', 'saghata.gaibandha.gov.bd', NULL, NULL),
(432, 57, 'Gobindaganj', 'গোবিন্দগঞ্জ', 'gobindaganj.gaibandha.gov.bd', NULL, NULL),
(433, 57, 'Sundarganj', 'সুন্দরগঞ্জ', 'sundarganj.gaibandha.gov.bd', NULL, NULL),
(434, 57, 'Phulchari', 'ফুলছড়ি', 'phulchari.gaibandha.gov.bd', NULL, NULL),
(435, 58, 'Thakurgaon Sadar', 'ঠাকুরগাঁও সদর', 'thakurgaonsadar.thakurgaon.gov.bd', NULL, NULL),
(436, 58, 'Pirganj', 'পীরগঞ্জ', 'pirganj.thakurgaon.gov.bd', NULL, NULL),
(437, 58, 'Ranisankail', 'রাণীশংকৈল', 'ranisankail.thakurgaon.gov.bd', NULL, NULL),
(438, 58, 'Haripur', 'হরিপুর', 'haripur.thakurgaon.gov.bd', NULL, NULL),
(439, 58, 'Baliadangi', 'বালিয়াডাঙ্গী', 'baliadangi.thakurgaon.gov.bd', NULL, NULL),
(440, 59, 'Rangpur Sadar', 'রংপুর সদর', 'rangpursadar.rangpur.gov.bd', NULL, NULL),
(441, 59, 'Gangachara', 'গংগাচড়া', 'gangachara.rangpur.gov.bd', NULL, NULL),
(442, 59, 'Taragonj', 'তারাগঞ্জ', 'taragonj.rangpur.gov.bd', NULL, NULL),
(443, 59, 'Badargonj', 'বদরগঞ্জ', 'badargonj.rangpur.gov.bd', NULL, NULL),
(444, 59, 'Mithapukur', 'মিঠাপুকুর', 'mithapukur.rangpur.gov.bd', NULL, NULL),
(445, 59, 'Pirgonj', 'পীরগঞ্জ', 'pirgonj.rangpur.gov.bd', NULL, NULL),
(446, 59, 'Kaunia', 'কাউনিয়া', 'kaunia.rangpur.gov.bd', NULL, NULL),
(447, 59, 'Pirgacha', 'পীরগাছা', 'pirgacha.rangpur.gov.bd', NULL, NULL),
(448, 60, 'Kurigram Sadar', 'কুড়িগ্রাম সদর', 'kurigramsadar.kurigram.gov.bd', NULL, NULL),
(449, 60, 'Nageshwari', 'নাগেশ্বরী', 'nageshwari.kurigram.gov.bd', NULL, NULL),
(450, 60, 'Bhurungamari', 'ভুরুঙ্গামারী', 'bhurungamari.kurigram.gov.bd', NULL, NULL),
(451, 60, 'Phulbari', 'ফুলবাড়ী', 'phulbari.kurigram.gov.bd', NULL, NULL),
(452, 60, 'Rajarhat', 'রাজারহাট', 'rajarhat.kurigram.gov.bd', NULL, NULL),
(453, 60, 'Ulipur', 'উলিপুর', 'ulipur.kurigram.gov.bd', NULL, NULL),
(454, 60, 'Chilmari', 'চিলমারী', 'chilmari.kurigram.gov.bd', NULL, NULL),
(455, 60, 'Rowmari', 'রৌমারী', 'rowmari.kurigram.gov.bd', NULL, NULL),
(456, 60, 'Charrajibpur', 'চর রাজিবপুর', 'charrajibpur.kurigram.gov.bd', NULL, NULL),
(457, 61, 'Sherpur Sadar', 'শেরপুর সদর', 'sherpursadar.sherpur.gov.bd', NULL, NULL),
(458, 61, 'Nalitabari', 'নালিতাবাড়ী', 'nalitabari.sherpur.gov.bd', NULL, NULL),
(459, 61, 'Sreebordi', 'শ্রীবরদী', 'sreebordi.sherpur.gov.bd', NULL, NULL),
(460, 61, 'Nokla', 'নকলা', 'nokla.sherpur.gov.bd', NULL, NULL),
(461, 61, 'Jhenaigati', 'ঝিনাইগাতী', 'jhenaigati.sherpur.gov.bd', NULL, NULL),
(462, 62, 'Fulbaria', 'ফুলবাড়ীয়া', 'fulbaria.mymensingh.gov.bd', NULL, NULL),
(463, 62, 'Trishal', 'ত্রিশাল', 'trishal.mymensingh.gov.bd', NULL, NULL),
(464, 62, 'Bhaluka', 'ভালুকা', 'bhaluka.mymensingh.gov.bd', NULL, NULL),
(465, 62, 'Muktagacha', 'মুক্তাগাছা', 'muktagacha.mymensingh.gov.bd', NULL, NULL),
(466, 62, 'Mymensingh Sadar', 'ময়মনসিংহ সদর', 'mymensinghsadar.mymensingh.gov.bd', NULL, NULL),
(467, 62, 'Dhobaura', 'ধোবাউড়া', 'dhobaura.mymensingh.gov.bd', NULL, NULL),
(468, 62, 'Phulpur', 'ফুলপুর', 'phulpur.mymensingh.gov.bd', NULL, NULL),
(469, 62, 'Haluaghat', 'হালুয়াঘাট', 'haluaghat.mymensingh.gov.bd', NULL, NULL),
(470, 62, 'Gouripur', 'গৌরীপুর', 'gouripur.mymensingh.gov.bd', NULL, NULL),
(471, 62, 'Gafargaon', 'গফরগাঁও', 'gafargaon.mymensingh.gov.bd', NULL, NULL),
(472, 62, 'Iswarganj', 'ঈশ্বরগঞ্জ', 'iswarganj.mymensingh.gov.bd', NULL, NULL),
(473, 62, 'Nandail', 'নান্দাইল', 'nandail.mymensingh.gov.bd', NULL, NULL),
(474, 62, 'Tarakanda', 'তারাকান্দা', 'tarakanda.mymensingh.gov.bd', NULL, NULL),
(475, 63, 'Jamalpur Sadar', 'জামালপুর সদর', 'jamalpursadar.jamalpur.gov.bd', NULL, NULL),
(476, 63, 'Melandah', 'মেলান্দহ', 'melandah.jamalpur.gov.bd', NULL, NULL),
(477, 63, 'Islampur', 'ইসলামপুর', 'islampur.jamalpur.gov.bd', NULL, NULL),
(478, 63, 'Dewangonj', 'দেওয়ানগঞ্জ', 'dewangonj.jamalpur.gov.bd', NULL, NULL),
(479, 63, 'Sarishabari', 'সরিষাবাড়ী', 'sarishabari.jamalpur.gov.bd', NULL, NULL),
(480, 63, 'Madarganj', 'মাদারগঞ্জ', 'madarganj.jamalpur.gov.bd', NULL, NULL),
(481, 63, 'Bokshiganj', 'বকশীগঞ্জ', 'bokshiganj.jamalpur.gov.bd', NULL, NULL),
(482, 64, 'Barhatta', 'বারহাট্টা', 'barhatta.netrokona.gov.bd', NULL, NULL),
(483, 64, 'Durgapur', 'দুর্গাপুর', 'durgapur.netrokona.gov.bd', NULL, NULL),
(484, 64, 'Kendua', 'কেন্দুয়া', 'kendua.netrokona.gov.bd', NULL, NULL),
(485, 64, 'Atpara', 'আটপাড়া', 'atpara.netrokona.gov.bd', NULL, NULL),
(486, 64, 'Madan', 'মদন', 'madan.netrokona.gov.bd', NULL, NULL),
(487, 64, 'Khaliajuri', 'খালিয়াজুরী', 'khaliajuri.netrokona.gov.bd', NULL, NULL),
(488, 64, 'Kalmakanda', 'কলমাকান্দা', 'kalmakanda.netrokona.gov.bd', NULL, NULL),
(489, 64, 'Mohongonj', 'মোহনগঞ্জ', 'mohongonj.netrokona.gov.bd', NULL, NULL),
(490, 64, 'Purbadhala', 'পূর্বধলা', 'purbadhala.netrokona.gov.bd', NULL, NULL),
(491, 64, 'Netrokona Sadar', 'নেত্রকোণা সদর', 'netrokonasadar.netrokona.gov.bd', NULL, NULL),
(492, 9, 'Eidgaon', 'ঈদগাঁও', 'null', NULL, NULL),
(493, 39, 'Madhyanagar', 'মধ্যনগর', 'null', NULL, NULL),
(494, 50, 'Dasar', 'ডাসার', 'null', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `role` enum('Agent','User') NOT NULL DEFAULT 'User',
  `name` varchar(255) NOT NULL,
  `email` varchar(191) DEFAULT NULL,
  `mobile` varchar(15) DEFAULT NULL,
  `image` varchar(255) DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `point` int(10) UNSIGNED NOT NULL DEFAULT 0,
  `reference` varchar(255) DEFAULT NULL,
  `status` enum('Active','Inactive') NOT NULL DEFAULT 'Inactive',
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `role`, `name`, `email`, `mobile`, `image`, `password`, `point`, `reference`, `status`, `email_verified_at`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'User', 'Rashiqul Rony', 'rashiqulrony@gmail.com', NULL, NULL, '$2y$10$lRXVDesBCRIs/6Iiy9BfdepvDNNfaV7L/dOvlgTTnmPsZMFM5dTLq', 0, NULL, 'Inactive', '2023-11-23 03:49:35', NULL, '2023-11-23 03:48:57', '2023-11-23 03:48:57'),
(2, 'Agent', 'Rashiqul Rony', 'rony.mmj@gmail.com', '01738030343', NULL, '$2y$10$0fAxjLeXrIrhC0HDrT3na.5MpGa64s64k5fLJYasInqoR/ENUOEbO', 0, '123AA123', 'Active', '2023-11-28 09:59:29', NULL, '2023-11-28 09:59:29', '2023-11-28 10:00:43');

-- --------------------------------------------------------

--
-- Table structure for table `user_addresses`
--

CREATE TABLE `user_addresses` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) DEFAULT NULL,
  `address_type` enum('primary','billing','shipping') NOT NULL DEFAULT 'primary',
  `address_line` varchar(255) NOT NULL,
  `district` varchar(255) DEFAULT NULL,
  `phone` varchar(255) NOT NULL,
  `is_default` tinyint(1) NOT NULL DEFAULT 0,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `user_addresses`
--

INSERT INTO `user_addresses` (`id`, `name`, `email`, `address_type`, `address_line`, `district`, `phone`, `is_default`, `user_id`, `created_at`, `updated_at`) VALUES
(1, 'Rashiqul Rony', 'rony.mmj@gmail.com', 'shipping', 'Adabor, Mohammadpur', 'Dhaka', '01738030343', 1, 1, '2023-11-26 06:41:41', '2023-11-26 06:41:41');

-- --------------------------------------------------------

--
-- Table structure for table `user_points`
--

CREATE TABLE `user_points` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `product_id` bigint(20) UNSIGNED DEFAULT NULL,
  `order_details_id` bigint(20) UNSIGNED DEFAULT NULL,
  `point` int(10) UNSIGNED NOT NULL DEFAULT 0,
  `flag` enum('Earn','Withdraw') NOT NULL DEFAULT 'Earn',
  `notes` text DEFAULT NULL,
  `status` enum('Pending','Complete','Failed','') NOT NULL DEFAULT 'Pending',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `writers`
--

CREATE TABLE `writers` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `slug` varchar(191) DEFAULT NULL,
  `name` varchar(255) NOT NULL,
  `bio` text DEFAULT NULL,
  `image` varchar(255) DEFAULT NULL,
  `status` enum('Active','Inactive') NOT NULL DEFAULT 'Inactive',
  `feature` enum('Yes','No') NOT NULL DEFAULT 'No',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `writers`
--

INSERT INTO `writers` (`id`, `slug`, `name`, `bio`, `image`, `status`, `feature`, `created_at`, `updated_at`) VALUES
(1, '6538a57e2c845-writer', 'Writer', NULL, NULL, 'Active', 'Yes', '2023-10-25 05:19:58', '2023-10-25 05:19:58'),
(2, '6538a5896ac3e-writer-2', 'Writer 2', NULL, NULL, 'Active', 'Yes', '2023-10-25 05:20:09', '2023-10-25 05:20:09'),
(3, '6538a5951d699-writer-3', 'Writer 3', NULL, NULL, 'Active', 'Yes', '2023-10-25 05:20:21', '2023-10-25 05:20:21');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `activity_log`
--
ALTER TABLE `activity_log`
  ADD PRIMARY KEY (`id`),
  ADD KEY `subject` (`subject_type`,`subject_id`),
  ADD KEY `causer` (`causer_type`,`causer_id`),
  ADD KEY `activity_log_log_name_index` (`log_name`);

--
-- Indexes for table `admins`
--
ALTER TABLE `admins`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `admins_email_unique` (`email`),
  ADD UNIQUE KEY `admins_mobile_unique` (`mobile`);

--
-- Indexes for table `brands`
--
ALTER TABLE `brands`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `brands_slug_unique` (`slug`);

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `categories_slug_unique` (`slug`);

--
-- Indexes for table `contact_messages`
--
ALTER TABLE `contact_messages`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `districts`
--
ALTER TABLE `districts`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `divisions`
--
ALTER TABLE `divisions`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indexes for table `merchants`
--
ALTER TABLE `merchants`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `merchants_slug_unique` (`slug`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`),
  ADD KEY `orders_user_id_foreign` (`user_id`);

--
-- Indexes for table `order_addresses`
--
ALTER TABLE `order_addresses`
  ADD PRIMARY KEY (`id`),
  ADD KEY `order_addresses_order_id_foreign` (`order_id`);

--
-- Indexes for table `order_details`
--
ALTER TABLE `order_details`
  ADD PRIMARY KEY (`id`),
  ADD KEY `order_details_order_id_foreign` (`order_id`);

--
-- Indexes for table `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`);

--
-- Indexes for table `password_reset_tokens`
--
ALTER TABLE `password_reset_tokens`
  ADD PRIMARY KEY (`email`);

--
-- Indexes for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  ADD KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `products_code_unique` (`code`),
  ADD UNIQUE KEY `products_slug_unique` (`slug`);

--
-- Indexes for table `product_images`
--
ALTER TABLE `product_images`
  ADD PRIMARY KEY (`id`),
  ADD KEY `product_images_product_id_foreign` (`product_id`);

--
-- Indexes for table `settings`
--
ALTER TABLE `settings`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sliders`
--
ALTER TABLE `sliders`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `taggable_taggables`
--
ALTER TABLE `taggable_taggables`
  ADD UNIQUE KEY `taggable_taggables_tag_id_taggable_id_taggable_type_unique` (`tag_id`,`taggable_id`,`taggable_type`),
  ADD KEY `i_taggable_fwd` (`tag_id`,`taggable_id`),
  ADD KEY `i_taggable_rev` (`taggable_id`,`tag_id`),
  ADD KEY `i_taggable_type` (`taggable_type`);

--
-- Indexes for table `taggable_tags`
--
ALTER TABLE `taggable_tags`
  ADD PRIMARY KEY (`tag_id`),
  ADD UNIQUE KEY `taggable_tags_normalized_unique` (`normalized`),
  ADD KEY `taggable_tags_normalized_index` (`normalized`);

--
-- Indexes for table `transactions`
--
ALTER TABLE `transactions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `transactions_order_id_foreign` (`order_id`);

--
-- Indexes for table `upazilas`
--
ALTER TABLE `upazilas`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`),
  ADD UNIQUE KEY `users_mobile_unique` (`mobile`);

--
-- Indexes for table `user_addresses`
--
ALTER TABLE `user_addresses`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_addresses_user_id_foreign` (`user_id`);

--
-- Indexes for table `user_points`
--
ALTER TABLE `user_points`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_points_user_id_foreign` (`user_id`);

--
-- Indexes for table `writers`
--
ALTER TABLE `writers`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `writers_slug_unique` (`slug`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `activity_log`
--
ALTER TABLE `activity_log`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `admins`
--
ALTER TABLE `admins`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `brands`
--
ALTER TABLE `brands`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `contact_messages`
--
ALTER TABLE `contact_messages`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `districts`
--
ALTER TABLE `districts`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=65;

--
-- AUTO_INCREMENT for table `divisions`
--
ALTER TABLE `divisions`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `merchants`
--
ALTER TABLE `merchants`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=40;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `order_addresses`
--
ALTER TABLE `order_addresses`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `order_details`
--
ALTER TABLE `order_details`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `product_images`
--
ALTER TABLE `product_images`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `settings`
--
ALTER TABLE `settings`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `sliders`
--
ALTER TABLE `sliders`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `taggable_tags`
--
ALTER TABLE `taggable_tags`
  MODIFY `tag_id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `transactions`
--
ALTER TABLE `transactions`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `upazilas`
--
ALTER TABLE `upazilas`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=495;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `user_addresses`
--
ALTER TABLE `user_addresses`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `user_points`
--
ALTER TABLE `user_points`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `writers`
--
ALTER TABLE `writers`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `orders`
--
ALTER TABLE `orders`
  ADD CONSTRAINT `orders_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `order_addresses`
--
ALTER TABLE `order_addresses`
  ADD CONSTRAINT `order_addresses_order_id_foreign` FOREIGN KEY (`order_id`) REFERENCES `orders` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `order_details`
--
ALTER TABLE `order_details`
  ADD CONSTRAINT `order_details_order_id_foreign` FOREIGN KEY (`order_id`) REFERENCES `orders` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `product_images`
--
ALTER TABLE `product_images`
  ADD CONSTRAINT `product_images_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `transactions`
--
ALTER TABLE `transactions`
  ADD CONSTRAINT `transactions_order_id_foreign` FOREIGN KEY (`order_id`) REFERENCES `orders` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `user_addresses`
--
ALTER TABLE `user_addresses`
  ADD CONSTRAINT `user_addresses_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `user_points`
--
ALTER TABLE `user_points`
  ADD CONSTRAINT `user_points_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
