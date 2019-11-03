-- phpMyAdmin SQL Dump
-- version 4.8.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 03, 2019 at 12:00 PM
-- Server version: 10.1.37-MariaDB
-- PHP Version: 7.2.13

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `waters`
--

-- --------------------------------------------------------

--
-- Table structure for table `access_levels`
--

CREATE TABLE `access_levels` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `level` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `level_number` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `access_levels`
--

INSERT INTO `access_levels` (`id`, `level`, `level_number`, `created_at`, `updated_at`) VALUES
(1, 'low level', 0, '2019-11-02 18:51:03', '2019-11-02 18:51:03'),
(2, 'Medium Level', 1, '2019-11-02 19:14:52', '2019-11-02 19:14:52'),
(3, 'High Level', 2, '2019-11-02 19:14:59', '2019-11-02 19:14:59');

-- --------------------------------------------------------

--
-- Table structure for table `activities`
--

CREATE TABLE `activities` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `action` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `model_id` bigint(20) UNSIGNED DEFAULT NULL,
  `affected_url` bigint(20) UNSIGNED DEFAULT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `attachments`
--

CREATE TABLE `attachments` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `title` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `file_url` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `downloads` int(11) DEFAULT NULL,
  `knowledge_product_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `attachments`
--

INSERT INTO `attachments` (`id`, `title`, `file_url`, `downloads`, `knowledge_product_id`, `created_at`, `updated_at`) VALUES
(1, 'news', 'news_1572730520.jpg', 0, 1, '2019-11-02 19:35:20', '2019-11-02 19:35:20'),
(2, 'chill', 'chill_1572730520.png', 0, 1, '2019-11-02 19:35:20', '2019-11-02 19:35:20'),
(3, 'logo', 'logo_1572731260.png', 1, 3, '2019-11-02 19:47:41', '2019-11-02 19:58:48'),
(4, 'article (2)', 'article (2)_1572732781.jpg', 0, 4, '2019-11-02 20:13:01', '2019-11-02 20:13:01'),
(5, 'article', 'article_1572732782.jpg', 0, 4, '2019-11-02 20:13:02', '2019-11-02 20:13:02');

-- --------------------------------------------------------

--
-- Table structure for table `blogs`
--

CREATE TABLE `blogs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `title` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `sub_title` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `photo` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `message` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `views` int(11) DEFAULT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `blogs`
--

INSERT INTO `blogs` (`id`, `title`, `sub_title`, `photo`, `message`, `views`, `user_id`, `created_at`, `updated_at`) VALUES
(1, 'በኢትዮጵያ የውሃ ሥራዎች ስታንዳርድ ኮድ ሊዘጋጅ እንደሆነ ተገለጸ::', 'sub title', 'news_1572733040.jpg', 'sunt aut facere repellat provident occaecati excepturi optio reprehenderit', NULL, 1, '2019-11-02 20:17:20', '2019-11-02 20:17:20');

-- --------------------------------------------------------

--
-- Table structure for table `contacts`
--

CREATE TABLE `contacts` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `office` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `manager` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `phone` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `fax` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `remark` text COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `directorates`
--

CREATE TABLE `directorates` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `contact` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `manager` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `directorates`
--

INSERT INTO `directorates` (`id`, `name`, `contact`, `manager`, `description`, `created_at`, `updated_at`) VALUES
(1, 'ICT', '+2519000000', 'Obo Guta', 'Information Communication Technology', '2019-11-02 18:51:03', '2019-11-02 18:51:03'),
(2, 'Sanitation', '+25196868666', 'Biruk Belay', 'Sanitation directorate is responsible for clean city', '2019-11-02 19:06:31', '2019-11-02 19:06:31'),
(3, 'Research and development', '+2511158799', 'Aziti', 'Research and development', '2019-11-02 19:07:46', '2019-11-02 19:07:46');

-- --------------------------------------------------------

--
-- Table structure for table `documents`
--

CREATE TABLE `documents` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `issued_date` date DEFAULT NULL,
  `document_category_id` bigint(20) UNSIGNED NOT NULL,
  `knowledge_product_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `documents`
--

INSERT INTO `documents` (`id`, `issued_date`, `document_category_id`, `knowledge_product_id`, `created_at`, `updated_at`) VALUES
(1, '2019-11-02', 1, 4, '2019-11-02 20:13:01', '2019-11-02 20:13:01');

-- --------------------------------------------------------

--
-- Table structure for table `document_categories`
--

CREATE TABLE `document_categories` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `category` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `document_categories`
--

INSERT INTO `document_categories` (`id`, `category`, `created_at`, `updated_at`) VALUES
(1, 'Report', '2019-11-02 19:08:31', '2019-11-02 19:08:31'),
(2, 'Case Study', '2019-11-02 19:08:41', '2019-11-02 19:08:41'),
(3, 'Research', '2019-11-02 19:08:48', '2019-11-02 19:08:48');

-- --------------------------------------------------------

--
-- Table structure for table `finances`
--

CREATE TABLE `finances` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `donner_name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `credit` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `contact` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `address` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `finances`
--

INSERT INTO `finances` (`id`, `donner_name`, `credit`, `contact`, `address`, `created_at`, `updated_at`) VALUES
(1, 'UNICF', 'SWITH:5989', '+25196868666', 'Addis Ababa, Piyasa, Arada', '2019-11-02 19:12:12', '2019-11-02 19:12:12'),
(2, 'Weter Aid', 'BIT-7895', '+25195868966', 'USA', '2019-11-02 19:12:41', '2019-11-02 19:12:41'),
(3, 'Ethiopian Governement', 'CBE-152658', '+2511158799', 'Addis Ababa, Piyasa, Arada', '2019-11-02 19:13:00', '2019-11-02 19:13:00');

-- --------------------------------------------------------

--
-- Table structure for table `knowledge_categories`
--

CREATE TABLE `knowledge_categories` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `category` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `knowledge_categories`
--

INSERT INTO `knowledge_categories` (`id`, `category`, `created_at`, `updated_at`) VALUES
(1, 'Video', '2019-11-02 19:35:19', '2019-11-02 19:35:19'),
(2, 'Document', '2019-11-02 19:35:24', '2019-11-02 19:35:24'),
(3, 'Project', '2019-11-02 19:41:31', '2019-11-02 19:41:31');

-- --------------------------------------------------------

--
-- Table structure for table `knowledge_comments`
--

CREATE TABLE `knowledge_comments` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `message` mediumtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `knowledge_product_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `knowledge_comments`
--

INSERT INTO `knowledge_comments` (`id`, `message`, `user_id`, `knowledge_product_id`, `created_at`, `updated_at`) VALUES
(1, 'Comment', 1, 3, '2019-11-02 20:00:50', '2019-11-02 20:00:50');

-- --------------------------------------------------------

--
-- Table structure for table `knowledge_products`
--

CREATE TABLE `knowledge_products` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `title` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `source` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `contact` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `keywords` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `views` int(11) DEFAULT NULL,
  `knowledge_description` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `approved` tinyint(1) NOT NULL DEFAULT '0',
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `directorate_id` bigint(20) UNSIGNED NOT NULL,
  `knowledge_category_id` bigint(20) UNSIGNED NOT NULL,
  `access_level_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `knowledge_products`
--

INSERT INTO `knowledge_products` (`id`, `title`, `source`, `contact`, `keywords`, `views`, `knowledge_description`, `approved`, `user_id`, `directorate_id`, `knowledge_category_id`, `access_level_id`, `created_at`, `updated_at`) VALUES
(1, 'የኢትዮጵያ ውሃ ሥራዎች ስታንዳርድ( የጥራት ደረጃ)', 'Jone', '+25411159879', 'water, capture', 1, 'የኢትዮጵያ ውሃ ሥራዎች ስታንዳርድ( የጥራት ደረጃ)', 0, 3, 3, 1, 1, '2019-11-02 19:35:19', '2019-11-02 19:35:37'),
(2, 'የኢትዮጵያ ውሃ ሥራዎች ስታንዳርድ( የጥራት ደረጃ)', 'Unknown', 'Dayana', ',Burayu,,Burayu,energy', 3, 'When suspiciously goodness labrador understood rethought yawned grew piously endearingly inarticulate oh goodness jeez trout distinct hence cobra despite taped laughed the much audacious less inside tiger groaned darn stuffily metaphoric unihibitedly inside cobra.', 0, 3, 2, 3, 1, '2019-11-02 19:41:32', '2019-11-02 19:53:17'),
(3, 'የኢትዮጵያ ውሃ ሥራዎች ስታንዳርድ( የጥራት ደረጃ)', 'Unknown', 'Dayana', ',Burayu,energy', 7, 'When suspiciously goodness labrador understood rethought yawned grew piously endearingly inarticulate oh goodness jeez trout distinct hence cobra despite taped laughed the much audacious less inside tiger groaned darn stuffily metaphoric unihibitedly inside cobra.', 1, 3, 2, 3, 1, '2019-11-02 19:47:40', '2019-11-02 20:01:33'),
(4, 'Nestle Waters', 'Ambo University', '+25196868666', 'water', 0, 'Nestle Waters Ethiopia to pursue Sululta watershed project', 0, 1, 3, 2, 1, '2019-11-02 20:13:01', '2019-11-02 20:13:01');

-- --------------------------------------------------------

--
-- Table structure for table `knowledge_ratings`
--

CREATE TABLE `knowledge_ratings` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `rating` int(11) NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `knowledge_product_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `languages`
--

CREATE TABLE `languages` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `abbreviation` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `languages`
--

INSERT INTO `languages` (`id`, `name`, `abbreviation`, `created_at`, `updated_at`) VALUES
(1, 'English', 'en', '2019-11-02 19:10:00', '2019-11-02 19:10:00'),
(2, 'amharic', 'am', '2019-11-02 19:10:13', '2019-11-02 19:10:13'),
(3, 'Afan Oromo', 'ao', '2019-11-02 19:10:26', '2019-11-02 19:10:26');

-- --------------------------------------------------------

--
-- Table structure for table `links`
--

CREATE TABLE `links` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `link` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `maps`
--

CREATE TABLE `maps` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `created_date` date DEFAULT NULL,
  `map_type_id` bigint(20) UNSIGNED NOT NULL,
  `knowledge_product_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `map_types`
--

CREATE TABLE `map_types` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `type` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `map_types`
--

INSERT INTO `map_types` (`id`, `type`, `created_at`, `updated_at`) VALUES
(1, 'Biulding Map', '2019-11-02 19:10:59', '2019-11-02 19:10:59'),
(2, 'GIS', '2019-11-02 19:11:08', '2019-11-02 19:11:08');

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_160000_create_user_statuses_table', 1),
(2, '2014_10_12_170000_create_directorates_table', 1),
(3, '2014_10_12_180000_create_access_levels_table', 1),
(4, '2014_10_12_190000_create_users_table', 1),
(5, '2014_10_12_200000_create_password_resets_table', 1),
(6, '2019_04_30_091145_create_finances_table', 1),
(7, '2019_04_30_100242_create_project_statuses_table', 1),
(8, '2019_04_30_100401_create_regions_table', 1),
(9, '2019_04_30_100729_create_knowledge_categories_table', 1),
(10, '2019_04_30_130545_create_project_categories_table', 1),
(11, '2019_04_30_135228_create_knowledge_products_table', 1),
(12, '2019_04_30_195332_create_projects_table', 1),
(13, '2019_05_03_154512_create_blogs_table', 1),
(14, '2019_05_09_054337_create_links_table', 1),
(15, '2019_05_21_181642_create_document_categories_table', 1),
(16, '2019_05_21_182329_create_documents_table', 1),
(17, '2019_05_21_200548_create_videos_table', 1),
(18, '2019_05_21_203835_create_photos_table', 1),
(19, '2019_05_22_130441_create_attachments_table', 1),
(20, '2019_05_22_145732_create_map_types_table', 1),
(21, '2019_05_22_155557_create_maps_table', 1),
(22, '2019_05_22_164622_create_knowledge_comments_table', 1),
(23, '2019_05_22_202316_create_knowledge_ratings_table', 1),
(24, '2019_05_23_050945_create_activities_table', 1),
(25, '2019_05_27_064104_create_permission_tables', 1),
(26, '2019_05_30_161233_create_sliders_table', 1),
(27, '2019_05_31_060046_create_notice_boards_table', 1),
(28, '2019_06_21_014334_create_contacts_table', 1),
(29, '2019_08_26_191654_create_user_logs_table', 1),
(30, '2019_09_23_162129_create_user_notice_boards_table', 1),
(31, '2019_09_26_044815_create_languages_table', 1),
(32, '2019_09_29_184935_create_units_table', 1),
(33, '2019_10_07_115855_create_notifications_table', 1),
(34, '2019_10_21_180452_create_project_finances_table', 1);

-- --------------------------------------------------------

--
-- Table structure for table `model_has_permissions`
--

CREATE TABLE `model_has_permissions` (
  `permission_id` int(10) UNSIGNED NOT NULL,
  `model_type` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `model_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `model_has_roles`
--

CREATE TABLE `model_has_roles` (
  `role_id` int(10) UNSIGNED NOT NULL,
  `model_type` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `model_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `model_has_roles`
--

INSERT INTO `model_has_roles` (`role_id`, `model_type`, `model_id`) VALUES
(1, 'App\\User', 1),
(2, 'App\\User', 2),
(3, 'App\\User', 2),
(3, 'App\\User', 3);

-- --------------------------------------------------------

--
-- Table structure for table `notice_boards`
--

CREATE TABLE `notice_boards` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `message` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `attachment` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `header` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `notifications`
--

CREATE TABLE `notifications` (
  `id` char(36) COLLATE utf8mb4_unicode_ci NOT NULL,
  `type` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `notifiable_type` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `notifiable_id` bigint(20) UNSIGNED NOT NULL,
  `data` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `read_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `permissions`
--

CREATE TABLE `permissions` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `guard_name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `permissions`
--

INSERT INTO `permissions` (`id`, `name`, `guard_name`, `created_at`, `updated_at`) VALUES
(1, 'all', 'web', '2019-11-02 18:51:04', '2019-11-02 18:51:04'),
(2, 'manage knowledge', 'web', '2019-11-02 18:51:04', '2019-11-02 18:51:04'),
(3, 'manage directorate', 'web', '2019-11-02 18:51:04', '2019-11-02 18:51:04');

-- --------------------------------------------------------

--
-- Table structure for table `photos`
--

CREATE TABLE `photos` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `event_date` date DEFAULT NULL,
  `photographer` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `knowledge_product_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `projects`
--

CREATE TABLE `projects` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `project_title` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `contract_no` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `knowledge_description` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `outcome` text COLLATE utf8mb4_unicode_ci,
  `starting_date` date DEFAULT NULL,
  `end_date` date DEFAULT NULL,
  `beneficiaries_region` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `wereda_kebele` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `manager` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `project_description` text COLLATE utf8mb4_unicode_ci,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `knowledge_product_id` bigint(20) UNSIGNED NOT NULL,
  `project_category_id` bigint(20) UNSIGNED NOT NULL,
  `directorate_id` bigint(20) UNSIGNED NOT NULL,
  `project_status_id` bigint(20) UNSIGNED NOT NULL,
  `access_level_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `projects`
--

INSERT INTO `projects` (`id`, `project_title`, `contract_no`, `knowledge_description`, `outcome`, `starting_date`, `end_date`, `beneficiaries_region`, `wereda_kebele`, `manager`, `project_description`, `user_id`, `knowledge_product_id`, `project_category_id`, `directorate_id`, `project_status_id`, `access_level_id`, `created_at`, `updated_at`) VALUES
(1, 'የኢትዮጵያ ውሃ ሥራዎች ስታንዳርድ( የጥራት ደረጃ)', '+2514889989', 'When suspiciously goodness labrador understood rethought yawned grew piously endearingly inarticulate oh goodness jeez trout distinct hence cobra despite taped laughed the much audacious less inside tiger groaned darn stuffily metaphoric unihibitedly inside cobra.', 'When suspiciously goodness labrador understood rethought yawned grew piously endearingly inarticulate oh goodness jeez trout distinct hence cobra despite taped laughed the much audacious less inside tiger groaned darn stuffily metaphoric unihibitedly inside cobra.', '2018-11-02', '2020-11-02', 'oromia, amhara', 'Burayu', 'Dayana', 'When suspiciously goodness labrador understood rethought yawned grew piously endearingly inarticulate oh goodness jeez trout distinct hence cobra despite taped laughed the much audacious less inside tiger groaned darn stuffily metaphoric unihibitedly inside cobra.', 3, 2, 2, 2, 1, 1, '2019-11-02 19:41:32', '2019-11-02 19:41:32'),
(2, 'የኢትዮጵያ ውሃ ሥራዎች ስታንዳርድ( የጥራት ደረጃ)', '+2514889989', 'When suspiciously goodness labrador understood rethought yawned grew piously endearingly inarticulate oh goodness jeez trout distinct hence cobra despite taped laughed the much audacious less inside tiger groaned darn stuffily metaphoric unihibitedly inside cobra.', 'When suspiciously goodness labrador understood rethought yawned grew piously endearingly inarticulate oh goodness jeez trout distinct hence cobra despite taped laughed the much audacious less inside tiger groaned darn stuffily metaphoric unihibitedly inside cobra.', '2018-11-02', '2020-11-02', 'oromia, amhara', 'Burayu', 'Dayana', 'When suspiciously goodness labrador understood rethought yawned grew piously endearingly inarticulate oh goodness jeez trout distinct hence cobra despite taped laughed the much audacious less inside tiger groaned darn stuffily metaphoric unihibitedly inside cobra.', 3, 3, 2, 2, 1, 1, '2019-11-02 19:47:40', '2019-11-02 19:47:40');

-- --------------------------------------------------------

--
-- Table structure for table `project_categories`
--

CREATE TABLE `project_categories` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `category` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `project_categories`
--

INSERT INTO `project_categories` (`id`, `category`, `created_at`, `updated_at`) VALUES
(1, 'Sanitation', '2019-11-02 19:09:03', '2019-11-02 19:09:03'),
(2, 'Energy', '2019-11-02 19:09:11', '2019-11-02 19:09:11');

-- --------------------------------------------------------

--
-- Table structure for table `project_finances`
--

CREATE TABLE `project_finances` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `budget` double NOT NULL,
  `project_id` bigint(20) UNSIGNED NOT NULL,
  `finance_id` bigint(20) UNSIGNED NOT NULL,
  `unit_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `project_finances`
--

INSERT INTO `project_finances` (`id`, `budget`, `project_id`, `finance_id`, `unit_id`, `created_at`, `updated_at`) VALUES
(1, 10000, 2, 1, 1, '2019-11-02 19:47:40', '2019-11-02 19:47:40'),
(2, 58799, 1, 1, 1, '2019-11-02 19:49:58', '2019-11-02 19:49:58');

-- --------------------------------------------------------

--
-- Table structure for table `project_statuses`
--

CREATE TABLE `project_statuses` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `status` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `project_statuses`
--

INSERT INTO `project_statuses` (`id`, `status`, `created_at`, `updated_at`) VALUES
(1, 'Pending', '2019-11-02 19:09:19', '2019-11-02 19:09:19'),
(2, 'Cancelled', '2019-11-02 19:09:29', '2019-11-02 19:09:29'),
(3, 'Complete', '2019-11-02 19:09:50', '2019-11-02 19:09:50');

-- --------------------------------------------------------

--
-- Table structure for table `regions`
--

CREATE TABLE `regions` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `regions`
--

INSERT INTO `regions` (`id`, `name`, `created_at`, `updated_at`) VALUES
(1, 'Oromia', '2019-11-02 19:11:20', '2019-11-02 19:11:20'),
(2, 'Amhara', '2019-11-02 19:11:44', '2019-11-02 19:11:44');

-- --------------------------------------------------------

--
-- Table structure for table `roles`
--

CREATE TABLE `roles` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `guard_name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `roles`
--

INSERT INTO `roles` (`id`, `name`, `guard_name`, `created_at`, `updated_at`) VALUES
(1, 'admin', 'web', '2019-11-02 18:51:04', '2019-11-02 18:51:04'),
(2, 'Directorate manager', 'web', '2019-11-02 18:51:33', '2019-11-02 18:51:33'),
(3, 'Knowledge creator', 'web', '2019-11-02 19:04:54', '2019-11-02 19:04:54'),
(4, 'guest', 'web', '2019-11-02 19:05:01', '2019-11-02 19:05:01');

-- --------------------------------------------------------

--
-- Table structure for table `role_has_permissions`
--

CREATE TABLE `role_has_permissions` (
  `permission_id` int(10) UNSIGNED NOT NULL,
  `role_id` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `role_has_permissions`
--

INSERT INTO `role_has_permissions` (`permission_id`, `role_id`) VALUES
(1, 1),
(2, 3),
(3, 2);

-- --------------------------------------------------------

--
-- Table structure for table `sliders`
--

CREATE TABLE `sliders` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `title` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `message` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `photo` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `active` tinyint(1) NOT NULL,
  `url` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `sliders`
--

INSERT INTO `sliders` (`id`, `title`, `message`, `photo`, `active`, `url`, `created_at`, `updated_at`) VALUES
(1, 'በኢትዮጵያ የውሃ ሥራዎች ስታንዳርድ ኮድ ሊዘጋጅ እንደሆነ ተገለጸ::', 'sunt aut facere repellat provident occaecati excepturi optio reprehenderit', 'world_1572733083.png', 1, NULL, '2019-11-02 20:18:03', '2019-11-02 20:18:03');

-- --------------------------------------------------------

--
-- Table structure for table `units`
--

CREATE TABLE `units` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `units`
--

INSERT INTO `units` (`id`, `name`, `created_at`, `updated_at`) VALUES
(1, 'Dollar', '2019-11-02 19:10:41', '2019-11-02 19:10:41'),
(2, 'Birr', '2019-11-02 19:10:49', '2019-11-02 19:10:49');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `job_title` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `username` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `phone` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `photo` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `directorate_id` bigint(20) UNSIGNED NOT NULL,
  `user_status_id` bigint(20) UNSIGNED NOT NULL,
  `access_level_id` bigint(20) UNSIGNED NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `job_title`, `email`, `username`, `email_verified_at`, `phone`, `photo`, `password`, `directorate_id`, `user_status_id`, `access_level_id`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'Obo Guta', 'ICT Administrator', 'guta@gmail.com', 'administrator', NULL, '+2519000000', 'nofile.jpg', '$2y$10$hx5YQO3cpnFP0d4fKWiXCOrJ8AQGsQqar0GmvqHl7BxbsCGAT0oWC', 1, 1, 1, NULL, '2019-11-02 18:51:04', '2019-11-02 18:51:04'),
(2, 'Manager', 'Directorate manager', 'manager@gmail.com', 'manager', NULL, '(777) 777-7777', 'avatar_1572729273.png', '$2y$10$0qPH6bZoa2NNEWXeSmbzh.E21s.VUMGv/x6f3OBNyf4xxolNLdrwu', 3, 1, 1, NULL, '2019-11-02 18:52:48', '2019-11-02 19:14:35'),
(3, 'creator', 'Knowledge Creator', 'walia@gmail.com', 'creator', NULL, '(988) 778-8787', 'nofile.jpg', '$2y$10$bfU04w0uqag51PgjyEGsRO2TFH.pRGMsQh4OGFLdk9w0Lwvc7824u', 3, 1, 2, NULL, '2019-11-02 19:17:55', '2019-11-02 19:20:37');

-- --------------------------------------------------------

--
-- Table structure for table `user_logs`
--

CREATE TABLE `user_logs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `action` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `operation` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `date` date DEFAULT NULL,
  `remark` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `affected_url` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `affected_table` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `user_logs`
--

INSERT INTO `user_logs` (`id`, `action`, `operation`, `date`, `remark`, `affected_url`, `affected_table`, `user_id`, `created_at`, `updated_at`) VALUES
(1, 'Created New Role', 'create', NULL, 'Added New Role \"Directorate manager\"', '', 'roles', 1, '2019-11-02 18:51:33', '2019-11-02 18:51:33'),
(2, 'Assigned Permission To Role', 'create', NULL, 'Assigned \"manage directorate\" To Role \"Directorate manager\"', '', 'role_has_permissions', 1, '2019-11-02 18:51:44', '2019-11-02 18:51:44'),
(3, 'Register New User', 'create', NULL, 'Registered User \"Embossed Green TR\"', 'users/2', 'users', 1, '2019-11-02 18:52:48', '2019-11-02 18:52:48'),
(4, 'Assign Role To User', 'create', NULL, 'Assigned \"Directorate manager\" Role To User \"Embossed Green TR\"', 'users/2', 'model_has_roles', 1, '2019-11-02 18:53:00', '2019-11-02 18:53:00'),
(5, 'Created New Role', 'create', NULL, 'Added New Role \"Knowledge creator\"', '', 'roles', 1, '2019-11-02 19:04:54', '2019-11-02 19:04:54'),
(6, 'Created New Role', 'create', NULL, 'Added New Role \"guest\"', '', 'roles', 1, '2019-11-02 19:05:01', '2019-11-02 19:05:01'),
(7, 'Assigned Permission To Role', 'create', NULL, 'Assigned \"manage knowledge\" To Role \"Knowledge creator\"', '', 'role_has_permissions', 1, '2019-11-02 19:05:09', '2019-11-02 19:05:09'),
(8, 'Updated User Profile', 'Update', NULL, 'Updated Profile Of \"Manager\"', 'users/2', 'users', 1, '2019-11-02 19:14:35', '2019-11-02 19:14:35'),
(9, 'Assign Role To User', 'create', NULL, 'Assigned \"Knowledge creator\" Role To User \"Manager\"', 'users/2', 'model_has_roles', 1, '2019-11-02 19:16:01', '2019-11-02 19:16:01'),
(10, 'Register New User', 'create', NULL, 'Registered User \"creator\"', 'users/3', 'users', 2, '2019-11-02 19:17:55', '2019-11-02 19:17:55'),
(11, 'Updated User Profile', 'Update', NULL, 'Updated Profile Of \"creator\"', 'users/3', 'users', 1, '2019-11-02 19:20:37', '2019-11-02 19:20:37'),
(12, 'Assign Role To User', 'create', NULL, 'Assigned \"Knowledge creator\" Role To User \"creator\"', 'users/3', 'model_has_roles', 2, '2019-11-02 19:20:55', '2019-11-02 19:20:55'),
(13, 'Register Knowledge Product', 'create', NULL, 'Added This \"የኢትዮጵያ ውሃ ሥራዎች ስታንዳርድ( የጥራት ደረጃ)\" Video', 'search/detail/1', 'videos', 3, '2019-11-02 19:35:20', '2019-11-02 19:35:20'),
(14, 'Create Knowledge Product', 'create', NULL, 'Register This \"የኢትዮጵያ ውሃ ሥራዎች ስታንዳርድ( የጥራት ደረጃ)\" Project Information', 'search/detail/3', 'projects', 3, '2019-11-02 19:47:41', '2019-11-02 19:47:41'),
(15, 'Create Knowledge Product', 'create', NULL, 'Updated This \"የኢትዮጵያ ውሃ ሥራዎች ስታንዳርድ( የጥራት ደረጃ)\" Project Information', 'search/detail/2', 'projects', 3, '2019-11-02 19:49:58', '2019-11-02 19:49:58'),
(16, 'Created Knowledge Product', 'create', NULL, 'Registered this \"\" Document', '', 'documents', 1, '2019-11-02 20:13:02', '2019-11-02 20:13:02');

-- --------------------------------------------------------

--
-- Table structure for table `user_notice_boards`
--

CREATE TABLE `user_notice_boards` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `seen` tinyint(1) DEFAULT NULL,
  `seen_at` date DEFAULT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `notice_board_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `user_statuses`
--

CREATE TABLE `user_statuses` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `status` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `user_statuses`
--

INSERT INTO `user_statuses` (`id`, `status`, `created_at`, `updated_at`) VALUES
(1, 'active', '2019-11-02 18:51:03', '2019-11-02 18:51:03'),
(2, 'inactive', '2019-11-02 19:08:14', '2019-11-02 19:08:14');

-- --------------------------------------------------------

--
-- Table structure for table `videos`
--

CREATE TABLE `videos` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `created_date` date DEFAULT NULL,
  `goal` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `knowledge_product_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `videos`
--

INSERT INTO `videos` (`id`, `created_date`, `goal`, `knowledge_product_id`, `created_at`, `updated_at`) VALUES
(1, '2019-11-02', 'Capture an event', 1, '2019-11-02 19:35:20', '2019-11-02 19:35:20');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `access_levels`
--
ALTER TABLE `access_levels`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `activities`
--
ALTER TABLE `activities`
  ADD PRIMARY KEY (`id`),
  ADD KEY `activities_user_id_foreign` (`user_id`);

--
-- Indexes for table `attachments`
--
ALTER TABLE `attachments`
  ADD PRIMARY KEY (`id`),
  ADD KEY `attachments_knowledge_product_id_foreign` (`knowledge_product_id`);

--
-- Indexes for table `blogs`
--
ALTER TABLE `blogs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `blogs_user_id_foreign` (`user_id`);

--
-- Indexes for table `contacts`
--
ALTER TABLE `contacts`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `directorates`
--
ALTER TABLE `directorates`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `documents`
--
ALTER TABLE `documents`
  ADD PRIMARY KEY (`id`),
  ADD KEY `documents_document_category_id_foreign` (`document_category_id`),
  ADD KEY `documents_knowledge_product_id_foreign` (`knowledge_product_id`);

--
-- Indexes for table `document_categories`
--
ALTER TABLE `document_categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `finances`
--
ALTER TABLE `finances`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `knowledge_categories`
--
ALTER TABLE `knowledge_categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `knowledge_comments`
--
ALTER TABLE `knowledge_comments`
  ADD PRIMARY KEY (`id`),
  ADD KEY `knowledge_comments_user_id_foreign` (`user_id`),
  ADD KEY `knowledge_comments_knowledge_product_id_foreign` (`knowledge_product_id`);

--
-- Indexes for table `knowledge_products`
--
ALTER TABLE `knowledge_products`
  ADD PRIMARY KEY (`id`),
  ADD KEY `knowledge_products_knowledge_category_id_foreign` (`knowledge_category_id`),
  ADD KEY `knowledge_products_user_id_foreign` (`user_id`),
  ADD KEY `knowledge_products_directorate_id_foreign` (`directorate_id`),
  ADD KEY `knowledge_products_access_level_id_foreign` (`access_level_id`);

--
-- Indexes for table `knowledge_ratings`
--
ALTER TABLE `knowledge_ratings`
  ADD PRIMARY KEY (`id`),
  ADD KEY `knowledge_ratings_user_id_foreign` (`user_id`),
  ADD KEY `knowledge_ratings_knowledge_product_id_foreign` (`knowledge_product_id`);

--
-- Indexes for table `languages`
--
ALTER TABLE `languages`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `links`
--
ALTER TABLE `links`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `maps`
--
ALTER TABLE `maps`
  ADD PRIMARY KEY (`id`),
  ADD KEY `maps_map_type_id_foreign` (`map_type_id`),
  ADD KEY `maps_knowledge_product_id_foreign` (`knowledge_product_id`);

--
-- Indexes for table `map_types`
--
ALTER TABLE `map_types`
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
-- Indexes for table `notice_boards`
--
ALTER TABLE `notice_boards`
  ADD PRIMARY KEY (`id`),
  ADD KEY `notice_boards_user_id_foreign` (`user_id`);

--
-- Indexes for table `notifications`
--
ALTER TABLE `notifications`
  ADD PRIMARY KEY (`id`),
  ADD KEY `notifications_notifiable_type_notifiable_id_index` (`notifiable_type`,`notifiable_id`);

--
-- Indexes for table `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`);

--
-- Indexes for table `permissions`
--
ALTER TABLE `permissions`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `photos`
--
ALTER TABLE `photos`
  ADD PRIMARY KEY (`id`),
  ADD KEY `photos_knowledge_product_id_foreign` (`knowledge_product_id`);

--
-- Indexes for table `projects`
--
ALTER TABLE `projects`
  ADD PRIMARY KEY (`id`),
  ADD KEY `projects_knowledge_product_id_foreign` (`knowledge_product_id`),
  ADD KEY `projects_user_id_foreign` (`user_id`),
  ADD KEY `projects_directorate_id_foreign` (`directorate_id`),
  ADD KEY `projects_project_status_id_foreign` (`project_status_id`),
  ADD KEY `projects_access_level_id_foreign` (`access_level_id`),
  ADD KEY `projects_project_category_id_foreign` (`project_category_id`);

--
-- Indexes for table `project_categories`
--
ALTER TABLE `project_categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `project_finances`
--
ALTER TABLE `project_finances`
  ADD PRIMARY KEY (`id`),
  ADD KEY `project_finances_project_id_foreign` (`project_id`),
  ADD KEY `project_finances_finance_id_foreign` (`finance_id`),
  ADD KEY `project_finances_unit_id_foreign` (`unit_id`);

--
-- Indexes for table `project_statuses`
--
ALTER TABLE `project_statuses`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `regions`
--
ALTER TABLE `regions`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `role_has_permissions`
--
ALTER TABLE `role_has_permissions`
  ADD PRIMARY KEY (`permission_id`,`role_id`),
  ADD KEY `role_has_permissions_role_id_foreign` (`role_id`);

--
-- Indexes for table `sliders`
--
ALTER TABLE `sliders`
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
  ADD UNIQUE KEY `users_username_unique` (`username`),
  ADD UNIQUE KEY `users_email_unique` (`email`),
  ADD KEY `users_access_level_id_foreign` (`access_level_id`),
  ADD KEY `users_directorate_id_foreign` (`directorate_id`),
  ADD KEY `users_user_status_id_foreign` (`user_status_id`);

--
-- Indexes for table `user_logs`
--
ALTER TABLE `user_logs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_logs_user_id_foreign` (`user_id`);

--
-- Indexes for table `user_notice_boards`
--
ALTER TABLE `user_notice_boards`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_notice_boards_notice_board_id_foreign` (`notice_board_id`),
  ADD KEY `user_notice_boards_user_id_foreign` (`user_id`);

--
-- Indexes for table `user_statuses`
--
ALTER TABLE `user_statuses`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `videos`
--
ALTER TABLE `videos`
  ADD PRIMARY KEY (`id`),
  ADD KEY `videos_knowledge_product_id_foreign` (`knowledge_product_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `access_levels`
--
ALTER TABLE `access_levels`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `activities`
--
ALTER TABLE `activities`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `attachments`
--
ALTER TABLE `attachments`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `blogs`
--
ALTER TABLE `blogs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `contacts`
--
ALTER TABLE `contacts`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `directorates`
--
ALTER TABLE `directorates`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `documents`
--
ALTER TABLE `documents`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `document_categories`
--
ALTER TABLE `document_categories`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `finances`
--
ALTER TABLE `finances`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `knowledge_categories`
--
ALTER TABLE `knowledge_categories`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `knowledge_comments`
--
ALTER TABLE `knowledge_comments`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `knowledge_products`
--
ALTER TABLE `knowledge_products`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `knowledge_ratings`
--
ALTER TABLE `knowledge_ratings`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `languages`
--
ALTER TABLE `languages`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `links`
--
ALTER TABLE `links`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `maps`
--
ALTER TABLE `maps`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `map_types`
--
ALTER TABLE `map_types`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=35;

--
-- AUTO_INCREMENT for table `notice_boards`
--
ALTER TABLE `notice_boards`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `permissions`
--
ALTER TABLE `permissions`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `photos`
--
ALTER TABLE `photos`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `projects`
--
ALTER TABLE `projects`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `project_categories`
--
ALTER TABLE `project_categories`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `project_finances`
--
ALTER TABLE `project_finances`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `project_statuses`
--
ALTER TABLE `project_statuses`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `regions`
--
ALTER TABLE `regions`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `roles`
--
ALTER TABLE `roles`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `sliders`
--
ALTER TABLE `sliders`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `units`
--
ALTER TABLE `units`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `user_logs`
--
ALTER TABLE `user_logs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `user_notice_boards`
--
ALTER TABLE `user_notice_boards`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `user_statuses`
--
ALTER TABLE `user_statuses`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `videos`
--
ALTER TABLE `videos`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `activities`
--
ALTER TABLE `activities`
  ADD CONSTRAINT `activities_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `attachments`
--
ALTER TABLE `attachments`
  ADD CONSTRAINT `attachments_knowledge_product_id_foreign` FOREIGN KEY (`knowledge_product_id`) REFERENCES `knowledge_products` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `blogs`
--
ALTER TABLE `blogs`
  ADD CONSTRAINT `blogs_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `documents`
--
ALTER TABLE `documents`
  ADD CONSTRAINT `documents_document_category_id_foreign` FOREIGN KEY (`document_category_id`) REFERENCES `document_categories` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `documents_knowledge_product_id_foreign` FOREIGN KEY (`knowledge_product_id`) REFERENCES `knowledge_products` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `knowledge_comments`
--
ALTER TABLE `knowledge_comments`
  ADD CONSTRAINT `knowledge_comments_knowledge_product_id_foreign` FOREIGN KEY (`knowledge_product_id`) REFERENCES `knowledge_products` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `knowledge_comments_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `knowledge_products`
--
ALTER TABLE `knowledge_products`
  ADD CONSTRAINT `knowledge_products_access_level_id_foreign` FOREIGN KEY (`access_level_id`) REFERENCES `access_levels` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `knowledge_products_directorate_id_foreign` FOREIGN KEY (`directorate_id`) REFERENCES `directorates` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `knowledge_products_knowledge_category_id_foreign` FOREIGN KEY (`knowledge_category_id`) REFERENCES `knowledge_categories` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `knowledge_products_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `knowledge_ratings`
--
ALTER TABLE `knowledge_ratings`
  ADD CONSTRAINT `knowledge_ratings_knowledge_product_id_foreign` FOREIGN KEY (`knowledge_product_id`) REFERENCES `knowledge_products` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `knowledge_ratings_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `maps`
--
ALTER TABLE `maps`
  ADD CONSTRAINT `maps_knowledge_product_id_foreign` FOREIGN KEY (`knowledge_product_id`) REFERENCES `knowledge_products` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `maps_map_type_id_foreign` FOREIGN KEY (`map_type_id`) REFERENCES `map_types` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

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
-- Constraints for table `notice_boards`
--
ALTER TABLE `notice_boards`
  ADD CONSTRAINT `notice_boards_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `photos`
--
ALTER TABLE `photos`
  ADD CONSTRAINT `photos_knowledge_product_id_foreign` FOREIGN KEY (`knowledge_product_id`) REFERENCES `knowledge_products` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `projects`
--
ALTER TABLE `projects`
  ADD CONSTRAINT `projects_access_level_id_foreign` FOREIGN KEY (`access_level_id`) REFERENCES `access_levels` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `projects_directorate_id_foreign` FOREIGN KEY (`directorate_id`) REFERENCES `directorates` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `projects_knowledge_product_id_foreign` FOREIGN KEY (`knowledge_product_id`) REFERENCES `knowledge_products` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `projects_project_category_id_foreign` FOREIGN KEY (`project_category_id`) REFERENCES `project_categories` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `projects_project_status_id_foreign` FOREIGN KEY (`project_status_id`) REFERENCES `project_statuses` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `projects_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `project_finances`
--
ALTER TABLE `project_finances`
  ADD CONSTRAINT `project_finances_finance_id_foreign` FOREIGN KEY (`finance_id`) REFERENCES `finances` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `project_finances_project_id_foreign` FOREIGN KEY (`project_id`) REFERENCES `projects` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `project_finances_unit_id_foreign` FOREIGN KEY (`unit_id`) REFERENCES `units` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `role_has_permissions`
--
ALTER TABLE `role_has_permissions`
  ADD CONSTRAINT `role_has_permissions_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `role_has_permissions_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `users_access_level_id_foreign` FOREIGN KEY (`access_level_id`) REFERENCES `access_levels` (`id`),
  ADD CONSTRAINT `users_directorate_id_foreign` FOREIGN KEY (`directorate_id`) REFERENCES `directorates` (`id`),
  ADD CONSTRAINT `users_user_status_id_foreign` FOREIGN KEY (`user_status_id`) REFERENCES `user_statuses` (`id`);

--
-- Constraints for table `user_logs`
--
ALTER TABLE `user_logs`
  ADD CONSTRAINT `user_logs_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `user_notice_boards`
--
ALTER TABLE `user_notice_boards`
  ADD CONSTRAINT `user_notice_boards_notice_board_id_foreign` FOREIGN KEY (`notice_board_id`) REFERENCES `notice_boards` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `user_notice_boards_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `videos`
--
ALTER TABLE `videos`
  ADD CONSTRAINT `videos_knowledge_product_id_foreign` FOREIGN KEY (`knowledge_product_id`) REFERENCES `knowledge_products` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
