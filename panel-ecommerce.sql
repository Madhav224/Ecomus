-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Aug 18, 2025 at 02:19 PM
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
-- Database: `panel-ecommerce`
--

-- --------------------------------------------------------

--
-- Table structure for table `administrators`
--

CREATE TABLE `administrators` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `parent_id` bigint(20) UNSIGNED DEFAULT NULL,
  `staff_role_id` bigint(20) UNSIGNED DEFAULT NULL,
  `usercode` varchar(20) DEFAULT NULL,
  `username` varchar(255) DEFAULT NULL,
  `name` varchar(191) NOT NULL,
  `profile_picture` text DEFAULT NULL,
  `mobile` varchar(25) DEFAULT NULL,
  `email` varchar(191) DEFAULT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(191) NOT NULL,
  `user_remark` text DEFAULT NULL,
  `user_position` enum('admin','supperadmin','staff') NOT NULL DEFAULT 'staff',
  `remember_token` varchar(100) DEFAULT NULL,
  `user_status` enum('active','deactive') NOT NULL DEFAULT 'active',
  `registered_ip` varchar(50) DEFAULT NULL,
  `last_login_ip` varchar(50) DEFAULT NULL,
  `last_login_at` datetime DEFAULT current_timestamp(),
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `administrators`
--

INSERT INTO `administrators` (`id`, `parent_id`, `staff_role_id`, `usercode`, `username`, `name`, `profile_picture`, `mobile`, `email`, `email_verified_at`, `password`, `user_remark`, `user_position`, `remember_token`, `user_status`, `registered_ip`, `last_login_ip`, `last_login_at`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, NULL, NULL, '897546', 'supperadmin', 'Supper Admin', '0503202511442667c7ebc26b70b.jpg', 'qmdoaWpta2ZocWs%3D', '7aWhopimlpqkoaeBqbClrrJ1q7i3', NULL, '$2y$10$IzFjG1ZuwXGjQK869rUCIuhNrqIWup62ubHMKAslp9rXgajDeVjA2', 'Supper Admin', 'admin', NULL, 'active', NULL, '192.168.0.119', '2025-08-18 17:41:23', NULL, '2025-08-18 12:11:23', NULL),
(7, 1, NULL, '260539', 'admin', 'Admin', NULL, 's2lqa2xtbm9wcQ%3D%3D', '25Sem6F0nKOYoaVvpbKx', NULL, '$2y$10$7ic0JvD7F5WgmW.ro3r9hOkewrUelrwFKoU5hGj9gVdR7t/PVNke6', NULL, 'admin', NULL, 'active', '::1', '192.168.0.119', '2025-08-18 17:21:45', '2025-06-02 08:49:03', '2025-08-18 11:51:45', NULL),
(8, 7, 2, '408149', 'staff', 'staff', NULL, 's2lha2xtbmZwcQ%3D%3D', '7aSSmJl0nKOYoaVvpbKx', NULL, '$2y$10$.BGF6QSp8bhh0NrbaMrvHOfe6/zLxn.nZymRcBavsF0CdpLESovtK', NULL, 'staff', NULL, 'active', '::1', '::1', '2025-06-06 14:07:30', '2025-06-02 09:06:40', '2025-07-18 10:27:08', '2025-07-18 10:27:08'),
(9, 8, 3, '406446', 'staff1', 'staff1', NULL, 'rWNjZGxtbW5rbA%3D%3D', '7aSSmJlldZ2kmaKtcKazsg%3D%3D', NULL, '$2y$10$WejaRJsAeeCK9uGd0CH6d.IVBugvpwmwmxyDI91OpZ49c54w7S75u', NULL, 'staff', NULL, 'active', '::1', '::1', '2025-06-02 14:54:01', '2025-06-02 09:23:32', '2025-06-02 09:24:59', NULL),
(10, 9, 2, '459351', 'abcd', 'ABCD', NULL, 'sWdmZ2ZnZmdwcQ%3D%3D', '25KUlnObopegpGeksbA%3D', NULL, '$2y$10$7bhvImBTtibDYkmHM8wtKuUtR0d9tP4FpiXjLCqt7opKcTyXPnEJe', NULL, 'staff', NULL, 'active', '::1', NULL, '2025-06-02 14:56:44', '2025-06-02 09:26:44', '2025-06-02 09:26:44', NULL),
(11, 7, 2, '248573', 'staff', 'Staff', NULL, 's2hnZ2ZmZmpucA%3D%3D', '7aSSmJl0nKOYoaVvpbKx', NULL, '$2y$10$zV2wOMeYueEfZ7FoUWcwPePxWUFO.XRJE865vodd7anL/jtkQVCtK', NULL, 'staff', NULL, 'active', '192.168.0.108', '127.0.0.1', '2025-08-02 11:37:14', '2025-07-18 10:34:28', '2025-08-02 06:07:14', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `applied_coupons`
--

CREATE TABLE `applied_coupons` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `cart_id` bigint(20) UNSIGNED NOT NULL,
  `coupon_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `banners`
--

CREATE TABLE `banners` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `heading_text` varchar(191) NOT NULL,
  `sub_heading_text` varchar(191) NOT NULL,
  `image` varchar(191) NOT NULL,
  `link_type` enum('product','category','link','') NOT NULL DEFAULT 'product',
  `link` varchar(191) NOT NULL,
  `status` enum('active','deactive') NOT NULL DEFAULT 'active',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `blogs`
--

CREATE TABLE `blogs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `title` varchar(191) NOT NULL,
  `image` varchar(191) NOT NULL,
  `categories` varchar(191) NOT NULL,
  `description` varchar(191) NOT NULL,
  `status` enum('active','deactive') NOT NULL DEFAULT 'active',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `brands`
--

CREATE TABLE `brands` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `brand_name` varchar(191) NOT NULL,
  `brand_slug` varchar(191) NOT NULL,
  `brand_description` varchar(191) DEFAULT NULL,
  `brand_image` varchar(191) DEFAULT NULL,
  `brand_sort_order` int(11) NOT NULL DEFAULT 0,
  `brand_path` varchar(191) DEFAULT NULL,
  `status` enum('active','deactive') NOT NULL DEFAULT 'active',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `carts`
--

CREATE TABLE `carts` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `device_id` longtext DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `cart_children`
--

CREATE TABLE `cart_children` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `cart_id` bigint(20) UNSIGNED NOT NULL,
  `product_id` bigint(20) UNSIGNED NOT NULL,
  `product_variant_id` bigint(20) UNSIGNED DEFAULT NULL,
  `qty` int(11) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `categorie_name` varchar(191) NOT NULL,
  `categorie_slug` varchar(191) NOT NULL,
  `categorie_description` varchar(191) DEFAULT NULL,
  `categorie_parent_id` bigint(20) UNSIGNED DEFAULT NULL,
  `categorie_sort_order` int(11) NOT NULL DEFAULT 0,
  `status` enum('active','deactive') NOT NULL DEFAULT 'active',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `categorie_images`
--

CREATE TABLE `categorie_images` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `categorie_id` bigint(20) UNSIGNED NOT NULL,
  `categorie_image_type` enum('mobile','desktop','banner') NOT NULL DEFAULT 'desktop',
  `categorie_image_path` varchar(191) NOT NULL,
  `sort_by` int(11) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `coupons`
--

CREATE TABLE `coupons` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `coupon_name` varchar(191) NOT NULL,
  `coupon_code` varchar(191) NOT NULL,
  `value_type` enum('in_percentage','in_amount') NOT NULL DEFAULT 'in_amount',
  `value` varchar(191) NOT NULL,
  `min_amount` int(11) NOT NULL,
  `start_date` date NOT NULL,
  `end_date` date NOT NULL,
  `use_limit` int(10) UNSIGNED NOT NULL DEFAULT 1,
  `for_new_member` enum('0','1') NOT NULL DEFAULT '0',
  `user_usage_type` enum('once','multiple') NOT NULL DEFAULT 'once',
  `coupon_validate_on` enum('cart','product','category') NOT NULL DEFAULT 'cart',
  `coupon_validate_ids` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`coupon_validate_ids`)),
  `status` enum('active','deactive') NOT NULL DEFAULT 'active',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `earns`
--

CREATE TABLE `earns` (
  `id` int(11) NOT NULL,
  `user_name` varchar(255) DEFAULT NULL,
  `user_email` varchar(255) DEFAULT NULL,
  `user_mobile` varchar(255) DEFAULT NULL,
  `code` varchar(255) DEFAULT NULL,
  `status` enum('active','deactive') NOT NULL DEFAULT 'active',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `email_otps`
--

CREATE TABLE `email_otps` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `email` varchar(191) NOT NULL,
  `otp` varchar(191) NOT NULL,
  `expires_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` varchar(191) NOT NULL,
  `connection` text NOT NULL,
  `queue` text NOT NULL,
  `payload` longtext NOT NULL,
  `exception` longtext NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(191) NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_100000_create_password_resets_table', 1),
(2, '2019_08_19_000000_create_failed_jobs_table', 1),
(3, '2019_12_14_000001_create_personal_access_tokens_table', 1),
(4, '2023_08_31_150927_create_administrators_table', 1),
(5, '2023_08_31_153448_create_permission_tables', 1),
(7, '2024_01_04_122311_create_job_batches_table', 2),
(8, '2024_01_05_125036_create_jobs_table', 3),
(9, '0000_00_00_000000_create_websockets_statistics_entries_table', 4),
(11, '2025_04_10_151859_create_categories_table', 6),
(12, '2025_04_11_105548_create_brands_table', 6),
(13, '2025_04_11_110011_create_categorie_images_table', 6),
(14, '2025_04_11_110952_create_variants_table', 6),
(18, '2025_04_14_163620_update_categories_table', 7),
(21, '2025_04_25_121031_create_product_tags_table', 9),
(22, '2025_04_25_140317_create_banners_table', 10),
(24, '2025_04_11_111805_create_products_table', 11),
(25, '2025_04_11_150901_create_product_variants_table', 12),
(26, '2025_05_20_104554_create_staff_roles_table', 13),
(27, '2025_05_20_170800_update_administrators_table', 14),
(33, '2025_06_05_120411_add_frequently_bought_to_products_table', 17),
(36, '2014_10_12_000000_create_users_table', 18),
(38, '2025_06_09_115547_sliders', 20),
(40, '2025_03_13_151055_create_blogs_table', 21),
(41, '2025_07_16_115429_create_carts_table', 22),
(42, '2025_07_16_115709_create_cart_children_table', 23),
(45, '2025_06_05_153245_create_user_addresses_table', 24),
(48, '2025_07_16_195608_create_order_children_table', 26),
(49, '2025_07_17_152356_create_order_addresses_table', 27),
(50, '2025_07_21_123716_create_email_otps_table', 28),
(53, '2025_07_25_114901_create_wish_lists_table', 29),
(55, '2025_04_23_174604_create_order_statuses_table', 30),
(56, '2025_06_04_121047_create_product_reviews_table', 31),
(59, '2025_06_04_191311_create_coupons_table', 32),
(60, '2025_08_06_131349_create_applied_coupons_table', 33),
(62, '2025_07_16_195454_create_orders_table', 34),
(63, '2025_08_08_171638_add_coupon_id_to_orders_table', 35),
(64, '2025_08_13_175410_create_payment_histories_table', 36),
(66, '2025_08_18_161651_create_stitches_table', 37);

-- --------------------------------------------------------

--
-- Table structure for table `model_has_permissions`
--

CREATE TABLE `model_has_permissions` (
  `permission_id` bigint(20) UNSIGNED NOT NULL,
  `model_type` varchar(191) NOT NULL,
  `model_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `model_has_roles`
--

CREATE TABLE `model_has_roles` (
  `role_id` bigint(20) UNSIGNED NOT NULL,
  `model_type` varchar(191) NOT NULL,
  `model_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `model_has_roles`
--

INSERT INTO `model_has_roles` (`role_id`, `model_type`, `model_id`) VALUES
(2, 'App\\Models\\Administrator', 5),
(2, 'App\\Models\\Administrator', 6),
(2, 'App\\Models\\Administrator', 7),
(8, 'App\\Models\\Administrator', 1),
(9, 'App\\Models\\Administrator', 8),
(9, 'App\\Models\\Administrator', 9),
(9, 'App\\Models\\Administrator', 10),
(9, 'App\\Models\\Administrator', 11);

-- --------------------------------------------------------

--
-- Table structure for table `module`
--

CREATE TABLE `module` (
  `id` int(11) NOT NULL,
  `table_name` varchar(50) DEFAULT NULL,
  `module_name` varchar(400) NOT NULL,
  `module_slug` varchar(400) NOT NULL,
  `form_type` enum('no_form','model','form') NOT NULL DEFAULT 'no_form' COMMENT 'form="open in new page",model=model form',
  `action_update` enum('0','1') NOT NULL DEFAULT '1' COMMENT '	0=deactive,1=active',
  `action_delete` enum('0','1') NOT NULL DEFAULT '1' COMMENT '	0=deactive,1=active',
  `action_status` enum('0','1') NOT NULL DEFAULT '1' COMMENT '	0=deactive,1=active',
  `action_view` enum('0','1') NOT NULL DEFAULT '0' COMMENT '	0=deactive,1=active',
  `action_add` enum('0','1') NOT NULL DEFAULT '1' COMMENT '	0=deactive,1=active',
  `import_btn` enum('0','1') NOT NULL DEFAULT '0' COMMENT '0=deactive,1=active',
  `export_btn` enum('0','1') NOT NULL DEFAULT '0' COMMENT '0=deactive,1=active',
  `has_api` enum('0','1') NOT NULL DEFAULT '0' COMMENT '0= not api and\r\n1= Enable api ',
  `api_actions` varchar(300) DEFAULT NULL,
  `created_by` int(11) NOT NULL,
  `module_status` enum('active','deactive') NOT NULL DEFAULT 'active',
  `created_at` datetime DEFAULT current_timestamp(),
  `updated_at` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `module`
--

INSERT INTO `module` (`id`, `table_name`, `module_name`, `module_slug`, `form_type`, `action_update`, `action_delete`, `action_status`, `action_view`, `action_add`, `import_btn`, `export_btn`, `has_api`, `api_actions`, `created_by`, `module_status`, `created_at`, `updated_at`) VALUES
(1, 'module_countries', 'Countries', 'countries', 'model', '0', '0', '0', '0', '0', '0', '0', '0', NULL, 1, 'active', '2025-04-17 14:35:30', '2025-04-17 14:37:17'),
(2, 'module_states', 'States', 'states', 'model', '0', '0', '0', '0', '0', '0', '0', '1', '[\"read\"]', 1, 'active', '2025-04-17 14:39:36', '2025-04-17 15:21:42'),
(3, 'module_cities', 'Cities', 'cities', 'model', '0', '0', '0', '0', '0', '0', '0', '1', '[\"read\"]', 1, 'active', '2025-04-17 15:02:37', '2025-04-17 15:24:11'),
(4, 'module_faq', 'FAQ', 'faq', 'model', '1', '1', '1', '0', '1', '0', '0', '0', NULL, 1, 'active', '2025-07-08 14:32:12', '2025-07-11 10:45:45'),
(5, 'module_pages', 'pages', 'pages', 'model', '1', '1', '1', '0', '1', '0', '0', '0', NULL, 1, 'active', '2025-07-08 14:34:17', '2025-07-08 14:34:17'),
(6, 'module_links', 'links', 'links', 'model', '1', '1', '1', '0', '1', '0', '0', '0', NULL, 1, 'active', '2025-07-08 14:36:49', '2025-07-08 14:36:49');

-- --------------------------------------------------------

--
-- Table structure for table `module_cities`
--

CREATE TABLE `module_cities` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `slug` varchar(191) DEFAULT NULL,
  `city_name` text NOT NULL,
  `state_name` text NOT NULL,
  `status` enum('active','deactive') NOT NULL DEFAULT 'active',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `module_cities`
--

INSERT INTO `module_cities` (`id`, `slug`, `city_name`, `state_name`, `status`, `created_at`, `updated_at`) VALUES
(1, NULL, 'Bamboo Flat', '1', 'active', '2025-04-17 09:51:56', '2025-04-17 09:51:56'),
(2, NULL, 'Nicobar', '1', 'active', '2025-04-17 09:51:56', '2025-04-17 09:51:56'),
(3, NULL, 'Port Blair', '1', 'active', '2025-04-17 09:51:56', '2025-04-17 09:51:56'),
(4, NULL, 'South Andaman', '1', 'active', '2025-04-17 09:51:56', '2025-04-17 09:51:56'),
(5, NULL, 'Addanki', '2', 'active', '2025-04-17 09:51:56', '2025-04-17 09:51:56'),
(6, NULL, 'Adoni', '2', 'active', '2025-04-17 09:51:56', '2025-04-17 09:51:56'),
(7, NULL, 'Akasahebpet', '2', 'active', '2025-04-17 09:51:56', '2025-04-17 09:51:56'),
(8, NULL, 'Akividu', '2', 'active', '2025-04-17 09:51:56', '2025-04-17 09:51:56'),
(9, NULL, 'Akkarampalle', '2', 'active', '2025-04-17 09:51:56', '2025-04-17 09:51:56'),
(10, NULL, 'Amalapuram', '2', 'active', '2025-04-17 09:51:56', '2025-04-17 09:51:56'),
(11, NULL, 'Amudalavalasa', '2', 'active', '2025-04-17 09:51:56', '2025-04-17 09:51:56'),
(12, NULL, 'Anakapalle', '2', 'active', '2025-04-17 09:51:56', '2025-04-17 09:51:56'),
(13, NULL, 'Anantapur', '2', 'active', '2025-04-17 09:51:56', '2025-04-17 09:51:56'),
(14, NULL, 'Atmakur', '2', 'active', '2025-04-17 09:51:56', '2025-04-17 09:51:56'),
(15, NULL, 'Attili', '2', 'active', '2025-04-17 09:51:56', '2025-04-17 09:51:56'),
(16, NULL, 'Avanigadda', '2', 'active', '2025-04-17 09:51:56', '2025-04-17 09:51:56'),
(17, NULL, 'Badvel', '2', 'active', '2025-04-17 09:51:56', '2025-04-17 09:51:56'),
(18, NULL, 'Banganapalle', '2', 'active', '2025-04-17 09:51:56', '2025-04-17 09:51:56'),
(19, NULL, 'Bapatla', '2', 'active', '2025-04-17 09:51:56', '2025-04-17 09:51:56'),
(20, NULL, 'Betamcherla', '2', 'active', '2025-04-17 09:51:56', '2025-04-17 09:51:56'),
(21, NULL, 'Bhattiprolu', '2', 'active', '2025-04-17 09:51:56', '2025-04-17 09:51:56'),
(22, NULL, 'Bhimavaram', '2', 'active', '2025-04-17 09:51:56', '2025-04-17 09:51:56'),
(23, NULL, 'Bhimunipatnam', '2', 'active', '2025-04-17 09:51:56', '2025-04-17 09:51:56'),
(24, NULL, 'Bobbili', '2', 'active', '2025-04-17 09:51:56', '2025-04-17 09:51:56'),
(25, NULL, 'Challapalle', '2', 'active', '2025-04-17 09:51:56', '2025-04-17 09:51:56'),
(26, NULL, 'Chemmumiahpet', '2', 'active', '2025-04-17 09:51:56', '2025-04-17 09:51:56'),
(27, NULL, 'Chilakalurupet', '2', 'active', '2025-04-17 09:51:56', '2025-04-17 09:51:56'),
(28, NULL, 'Chinnachowk', '2', 'active', '2025-04-17 09:51:56', '2025-04-17 09:51:56'),
(29, NULL, 'Chipurupalle', '2', 'active', '2025-04-17 09:51:56', '2025-04-17 09:51:56'),
(30, NULL, 'Chirala', '2', 'active', '2025-04-17 09:51:56', '2025-04-17 09:51:56'),
(31, NULL, 'Chittoor', '2', 'active', '2025-04-17 09:51:56', '2025-04-17 09:51:56'),
(32, NULL, 'Chodavaram', '2', 'active', '2025-04-17 09:51:56', '2025-04-17 09:51:56'),
(33, NULL, 'Cuddapah', '2', 'active', '2025-04-17 09:51:56', '2025-04-17 09:51:56'),
(34, NULL, 'Cumbum', '2', 'active', '2025-04-17 09:51:56', '2025-04-17 09:51:56'),
(35, NULL, 'Darsi', '2', 'active', '2025-04-17 09:51:56', '2025-04-17 09:51:56'),
(36, NULL, 'Dharmavaram', '2', 'active', '2025-04-17 09:51:56', '2025-04-17 09:51:56'),
(37, NULL, 'Dhone', '2', 'active', '2025-04-17 09:51:56', '2025-04-17 09:51:56'),
(38, NULL, 'Diguvametta', '2', 'active', '2025-04-17 09:51:56', '2025-04-17 09:51:56'),
(39, NULL, 'East Godavari', '2', 'active', '2025-04-17 09:51:56', '2025-04-17 09:51:56'),
(40, NULL, 'Elamanchili', '2', 'active', '2025-04-17 09:51:56', '2025-04-17 09:51:56'),
(41, NULL, 'Ellore', '2', 'active', '2025-04-17 09:51:56', '2025-04-17 09:51:56'),
(42, NULL, 'Emmiganur', '2', 'active', '2025-04-17 09:51:56', '2025-04-17 09:51:56'),
(43, NULL, 'Erraguntla', '2', 'active', '2025-04-17 09:51:56', '2025-04-17 09:51:56'),
(44, NULL, 'Etikoppaka', '2', 'active', '2025-04-17 09:51:56', '2025-04-17 09:51:56'),
(45, NULL, 'Gajuwaka', '2', 'active', '2025-04-17 09:51:56', '2025-04-17 09:51:56'),
(46, NULL, 'Ganguvada', '2', 'active', '2025-04-17 09:51:56', '2025-04-17 09:51:56'),
(47, NULL, 'Gannavaram', '2', 'active', '2025-04-17 09:51:56', '2025-04-17 09:51:56'),
(48, NULL, 'Giddalur', '2', 'active', '2025-04-17 09:51:56', '2025-04-17 09:51:56'),
(49, NULL, 'Gokavaram', '2', 'active', '2025-04-17 09:51:56', '2025-04-17 09:51:56'),
(50, NULL, 'Gorantla', '2', 'active', '2025-04-17 09:51:56', '2025-04-17 09:51:56'),
(51, NULL, 'GovindapuramChilakaluripetGuntur', '2', 'active', '2025-04-17 09:51:56', '2025-04-17 09:51:56'),
(52, NULL, 'Gudivada', '2', 'active', '2025-04-17 09:51:56', '2025-04-17 09:51:56'),
(53, NULL, 'Gudlavalleru', '2', 'active', '2025-04-17 09:51:56', '2025-04-17 09:51:56'),
(54, NULL, 'Gudur', '2', 'active', '2025-04-17 09:51:56', '2025-04-17 09:51:56'),
(55, NULL, 'Guntakal Junction', '2', 'active', '2025-04-17 09:51:56', '2025-04-17 09:51:56'),
(56, NULL, 'Guntur', '2', 'active', '2025-04-17 09:51:56', '2025-04-17 09:51:56'),
(57, NULL, 'Hindupur', '2', 'active', '2025-04-17 09:51:56', '2025-04-17 09:51:56'),
(58, NULL, 'Ichchapuram', '2', 'active', '2025-04-17 09:51:56', '2025-04-17 09:51:56'),
(59, NULL, 'Jaggayyapeta', '2', 'active', '2025-04-17 09:51:56', '2025-04-17 09:51:56'),
(60, NULL, 'Jammalamadugu', '2', 'active', '2025-04-17 09:51:56', '2025-04-17 09:51:56'),
(61, NULL, 'Kadiri', '2', 'active', '2025-04-17 09:51:56', '2025-04-17 09:51:56'),
(62, NULL, 'Kaikalur', '2', 'active', '2025-04-17 09:51:56', '2025-04-17 09:51:56'),
(63, NULL, 'Kakinada', '2', 'active', '2025-04-17 09:51:56', '2025-04-17 09:51:56'),
(64, NULL, 'Kalyandurg', '2', 'active', '2025-04-17 09:51:56', '2025-04-17 09:51:56'),
(65, NULL, 'Kamalapuram', '2', 'active', '2025-04-17 09:51:56', '2025-04-17 09:51:56'),
(66, NULL, 'Kandukur', '2', 'active', '2025-04-17 09:51:56', '2025-04-17 09:51:56'),
(67, NULL, 'Kanigiri', '2', 'active', '2025-04-17 09:51:56', '2025-04-17 09:51:56'),
(68, NULL, 'Kankipadu', '2', 'active', '2025-04-17 09:51:56', '2025-04-17 09:51:56'),
(69, NULL, 'Kanuru', '2', 'active', '2025-04-17 09:51:56', '2025-04-17 09:51:56'),
(70, NULL, 'Kavali', '2', 'active', '2025-04-17 09:51:56', '2025-04-17 09:51:56'),
(71, NULL, 'Kolanukonda', '2', 'active', '2025-04-17 09:51:56', '2025-04-17 09:51:56'),
(72, NULL, 'Kondapalle', '2', 'active', '2025-04-17 09:51:56', '2025-04-17 09:51:56'),
(73, NULL, 'Korukollu', '2', 'active', '2025-04-17 09:51:56', '2025-04-17 09:51:56'),
(74, NULL, 'Kosigi', '2', 'active', '2025-04-17 09:51:56', '2025-04-17 09:51:56'),
(75, NULL, 'Kovvur', '2', 'active', '2025-04-17 09:51:56', '2025-04-17 09:51:56'),
(76, NULL, 'Krishna', '2', 'active', '2025-04-17 09:51:56', '2025-04-17 09:51:56'),
(77, NULL, 'Kuppam', '2', 'active', '2025-04-17 09:51:56', '2025-04-17 09:51:56'),
(78, NULL, 'Kurnool', '2', 'active', '2025-04-17 09:51:56', '2025-04-17 09:51:56'),
(79, NULL, 'Macherla', '2', 'active', '2025-04-17 09:51:56', '2025-04-17 09:51:56'),
(80, NULL, 'Machilipatnam', '2', 'active', '2025-04-17 09:51:56', '2025-04-17 09:51:56'),
(81, NULL, 'Madanapalle', '2', 'active', '2025-04-17 09:51:56', '2025-04-17 09:51:56'),
(82, NULL, 'Madugula', '2', 'active', '2025-04-17 09:51:56', '2025-04-17 09:51:56'),
(83, NULL, 'Mandapeta', '2', 'active', '2025-04-17 09:51:56', '2025-04-17 09:51:56'),
(84, NULL, 'Mandasa', '2', 'active', '2025-04-17 09:51:56', '2025-04-17 09:51:56'),
(85, NULL, 'Mangalagiri', '2', 'active', '2025-04-17 09:51:56', '2025-04-17 09:51:56'),
(86, NULL, 'Markapur', '2', 'active', '2025-04-17 09:51:56', '2025-04-17 09:51:56'),
(87, NULL, 'Nagari', '2', 'active', '2025-04-17 09:51:56', '2025-04-17 09:51:56'),
(88, NULL, 'Nagireddipalli', '2', 'active', '2025-04-17 09:51:56', '2025-04-17 09:51:56'),
(89, NULL, 'Nandigama', '2', 'active', '2025-04-17 09:51:56', '2025-04-17 09:51:56'),
(90, NULL, 'Nandikotkur', '2', 'active', '2025-04-17 09:51:56', '2025-04-17 09:51:56'),
(91, NULL, 'Nandyal', '2', 'active', '2025-04-17 09:51:56', '2025-04-17 09:51:56'),
(92, NULL, 'Narasannapeta', '2', 'active', '2025-04-17 09:51:56', '2025-04-17 09:51:56'),
(93, NULL, 'Narasapur', '2', 'active', '2025-04-17 09:51:56', '2025-04-17 09:51:56'),
(94, NULL, 'Narasaraopet', '2', 'active', '2025-04-17 09:51:56', '2025-04-17 09:51:56'),
(95, NULL, 'Narasingapuram', '2', 'active', '2025-04-17 09:51:56', '2025-04-17 09:51:56'),
(96, NULL, 'Narayanavanam', '2', 'active', '2025-04-17 09:51:56', '2025-04-17 09:51:56'),
(97, NULL, 'Narsipatnam', '2', 'active', '2025-04-17 09:51:56', '2025-04-17 09:51:56'),
(98, NULL, 'Nayudupet', '2', 'active', '2025-04-17 09:51:56', '2025-04-17 09:51:56'),
(99, NULL, 'Nellore', '2', 'active', '2025-04-17 09:51:56', '2025-04-17 09:51:56'),
(100, NULL, 'Nidadavole', '2', 'active', '2025-04-17 09:51:56', '2025-04-17 09:51:56'),
(101, NULL, 'Nuzvid', '2', 'active', '2025-04-17 09:51:56', '2025-04-17 09:51:56'),
(102, NULL, 'Ongole', '2', 'active', '2025-04-17 09:51:56', '2025-04-17 09:51:56'),
(103, NULL, 'Pakala', '2', 'active', '2025-04-17 09:51:56', '2025-04-17 09:51:56'),
(104, NULL, 'Palakollu', '2', 'active', '2025-04-17 09:51:56', '2025-04-17 09:51:56'),
(105, NULL, 'Palasa', '2', 'active', '2025-04-17 09:51:56', '2025-04-17 09:51:56'),
(106, NULL, 'Palkonda', '2', 'active', '2025-04-17 09:51:56', '2025-04-17 09:51:56'),
(107, NULL, 'Pallevada', '2', 'active', '2025-04-17 09:51:56', '2025-04-17 09:51:56'),
(108, NULL, 'Palmaner', '2', 'active', '2025-04-17 09:51:56', '2025-04-17 09:51:56'),
(109, NULL, 'Parlakimidi', '2', 'active', '2025-04-17 09:51:56', '2025-04-17 09:51:56'),
(110, NULL, 'Parvatipuram', '2', 'active', '2025-04-17 09:51:56', '2025-04-17 09:51:56'),
(111, NULL, 'Pavuluru', '2', 'active', '2025-04-17 09:51:56', '2025-04-17 09:51:56'),
(112, NULL, 'Pedana', '2', 'active', '2025-04-17 09:51:56', '2025-04-17 09:51:56'),
(113, NULL, 'pedda nakkalapalem', '2', 'active', '2025-04-17 09:51:56', '2025-04-17 09:51:56'),
(114, NULL, 'Peddapuram', '2', 'active', '2025-04-17 09:51:56', '2025-04-17 09:51:56'),
(115, NULL, 'Penugonda', '2', 'active', '2025-04-17 09:51:56', '2025-04-17 09:51:56'),
(116, NULL, 'Penukonda', '2', 'active', '2025-04-17 09:51:56', '2025-04-17 09:51:56'),
(117, NULL, 'Phirangipuram', '2', 'active', '2025-04-17 09:51:56', '2025-04-17 09:51:56'),
(118, NULL, 'Pippara', '2', 'active', '2025-04-17 09:51:56', '2025-04-17 09:51:56'),
(119, NULL, 'Pithapuram', '2', 'active', '2025-04-17 09:51:56', '2025-04-17 09:51:56'),
(120, NULL, 'Polavaram', '2', 'active', '2025-04-17 09:51:56', '2025-04-17 09:51:56'),
(121, NULL, 'Ponnur', '2', 'active', '2025-04-17 09:51:56', '2025-04-17 09:51:56'),
(122, NULL, 'Ponnuru', '2', 'active', '2025-04-17 09:51:56', '2025-04-17 09:51:56'),
(123, NULL, 'Prakasam', '2', 'active', '2025-04-17 09:51:56', '2025-04-17 09:51:56'),
(124, NULL, 'Proddatur', '2', 'active', '2025-04-17 09:51:56', '2025-04-17 09:51:56'),
(125, NULL, 'Pulivendla', '2', 'active', '2025-04-17 09:51:56', '2025-04-17 09:51:56'),
(126, NULL, 'Punganuru', '2', 'active', '2025-04-17 09:51:56', '2025-04-17 09:51:56'),
(127, NULL, 'Puttaparthi', '2', 'active', '2025-04-17 09:51:56', '2025-04-17 09:51:56'),
(128, NULL, 'Puttur', '2', 'active', '2025-04-17 09:51:56', '2025-04-17 09:51:56'),
(129, NULL, 'Rajahmundry', '2', 'active', '2025-04-17 09:51:56', '2025-04-17 09:51:56'),
(130, NULL, 'Ramachandrapuram', '2', 'active', '2025-04-17 09:51:56', '2025-04-17 09:51:56'),
(131, NULL, 'Ramanayyapeta', '2', 'active', '2025-04-17 09:51:56', '2025-04-17 09:51:56'),
(132, NULL, 'Ramapuram', '2', 'active', '2025-04-17 09:51:56', '2025-04-17 09:51:56'),
(133, NULL, 'Rampachodavaram', '2', 'active', '2025-04-17 09:51:56', '2025-04-17 09:51:56'),
(134, NULL, 'Rayachoti', '2', 'active', '2025-04-17 09:51:56', '2025-04-17 09:51:56'),
(135, NULL, 'Rayadrug', '2', 'active', '2025-04-17 09:51:56', '2025-04-17 09:51:56'),
(136, NULL, 'Razam', '2', 'active', '2025-04-17 09:51:56', '2025-04-17 09:51:56'),
(137, NULL, 'Razampeta', '2', 'active', '2025-04-17 09:51:56', '2025-04-17 09:51:56'),
(138, NULL, 'Razole', '2', 'active', '2025-04-17 09:51:56', '2025-04-17 09:51:56'),
(139, NULL, 'Renigunta', '2', 'active', '2025-04-17 09:51:56', '2025-04-17 09:51:56'),
(140, NULL, 'Repalle', '2', 'active', '2025-04-17 09:51:56', '2025-04-17 09:51:56'),
(141, NULL, 'Salur', '2', 'active', '2025-04-17 09:51:56', '2025-04-17 09:51:56'),
(142, NULL, 'Samalkot', '2', 'active', '2025-04-17 09:51:56', '2025-04-17 09:51:56'),
(143, NULL, 'Sattenapalle', '2', 'active', '2025-04-17 09:51:56', '2025-04-17 09:51:56'),
(144, NULL, 'Singarayakonda', '2', 'active', '2025-04-17 09:51:56', '2025-04-17 09:51:56'),
(145, NULL, 'Sompeta', '2', 'active', '2025-04-17 09:51:56', '2025-04-17 09:51:56'),
(146, NULL, 'Srikakulam', '2', 'active', '2025-04-17 09:51:56', '2025-04-17 09:51:56'),
(147, NULL, 'Srisailain', '2', 'active', '2025-04-17 09:51:56', '2025-04-17 09:51:56'),
(148, NULL, 'Suluru', '2', 'active', '2025-04-17 09:51:56', '2025-04-17 09:51:56'),
(149, NULL, 'Tadepalle', '2', 'active', '2025-04-17 09:51:56', '2025-04-17 09:51:56'),
(150, NULL, 'Tadepallegudem', '2', 'active', '2025-04-17 09:51:56', '2025-04-17 09:51:56'),
(151, NULL, 'Tadpatri', '2', 'active', '2025-04-17 09:51:56', '2025-04-17 09:51:56'),
(152, NULL, 'Tanuku', '2', 'active', '2025-04-17 09:51:56', '2025-04-17 09:51:56'),
(153, NULL, 'Tekkali', '2', 'active', '2025-04-17 09:51:56', '2025-04-17 09:51:56'),
(154, NULL, 'Tirumala', '2', 'active', '2025-04-17 09:51:56', '2025-04-17 09:51:56'),
(155, NULL, 'Tirupati', '2', 'active', '2025-04-17 09:51:56', '2025-04-17 09:51:56'),
(156, NULL, 'Tuni', '2', 'active', '2025-04-17 09:51:56', '2025-04-17 09:51:56'),
(157, NULL, 'Uravakonda', '2', 'active', '2025-04-17 09:51:56', '2025-04-17 09:51:56'),
(158, NULL, 'vadlamuru', '2', 'active', '2025-04-17 09:51:56', '2025-04-17 09:51:56'),
(159, NULL, 'Vadlapudi', '2', 'active', '2025-04-17 09:51:56', '2025-04-17 09:51:56'),
(160, NULL, 'Venkatagiri', '2', 'active', '2025-04-17 09:51:56', '2025-04-17 09:51:56'),
(161, NULL, 'Vepagunta', '2', 'active', '2025-04-17 09:51:56', '2025-04-17 09:51:56'),
(162, NULL, 'Vetapalem', '2', 'active', '2025-04-17 09:51:56', '2025-04-17 09:51:56'),
(163, NULL, 'Vijayawada', '2', 'active', '2025-04-17 09:51:56', '2025-04-17 09:51:56'),
(164, NULL, 'Vinukonda', '2', 'active', '2025-04-17 09:51:56', '2025-04-17 09:51:56'),
(165, NULL, 'Visakhapatnam', '2', 'active', '2025-04-17 09:51:56', '2025-04-17 09:51:56'),
(166, NULL, 'Vizianagaram', '2', 'active', '2025-04-17 09:51:56', '2025-04-17 09:51:56'),
(167, NULL, 'Vizianagaram District', '2', 'active', '2025-04-17 09:51:56', '2025-04-17 09:51:56'),
(168, NULL, 'Vuyyuru', '2', 'active', '2025-04-17 09:51:56', '2025-04-17 09:51:56'),
(169, NULL, 'West Godavari', '2', 'active', '2025-04-17 09:51:56', '2025-04-17 09:51:56'),
(170, NULL, 'Yanam', '2', 'active', '2025-04-17 09:51:56', '2025-04-17 09:51:56'),
(171, NULL, 'Yanamalakuduru', '2', 'active', '2025-04-17 09:51:56', '2025-04-17 09:51:56'),
(172, NULL, 'Yarada', '2', 'active', '2025-04-17 09:51:56', '2025-04-17 09:51:56'),
(173, NULL, 'Along', '3', 'active', '2025-04-17 09:51:56', '2025-04-17 09:51:56'),
(174, NULL, 'Anjaw', '3', 'active', '2025-04-17 09:51:56', '2025-04-17 09:51:56'),
(175, NULL, 'Basar', '3', 'active', '2025-04-17 09:51:56', '2025-04-17 09:51:56'),
(176, NULL, 'Bomdila', '3', 'active', '2025-04-17 09:51:56', '2025-04-17 09:51:56'),
(177, NULL, 'Changlang', '3', 'active', '2025-04-17 09:51:56', '2025-04-17 09:51:56'),
(178, NULL, 'Dibang Valley', '3', 'active', '2025-04-17 09:51:56', '2025-04-17 09:51:56'),
(179, NULL, 'East Kameng', '3', 'active', '2025-04-17 09:51:56', '2025-04-17 09:51:56'),
(180, NULL, 'East Siang', '3', 'active', '2025-04-17 09:51:56', '2025-04-17 09:51:56'),
(181, NULL, 'Hayuliang', '3', 'active', '2025-04-17 09:51:56', '2025-04-17 09:51:56'),
(182, NULL, 'Itanagar', '3', 'active', '2025-04-17 09:51:56', '2025-04-17 09:51:56'),
(183, NULL, 'Khonsa', '3', 'active', '2025-04-17 09:51:56', '2025-04-17 09:51:56'),
(184, NULL, 'Kurung Kumey', '3', 'active', '2025-04-17 09:51:56', '2025-04-17 09:51:56'),
(185, NULL, 'Lohit District', '3', 'active', '2025-04-17 09:51:56', '2025-04-17 09:51:56'),
(186, NULL, 'Lower Dibang Valley', '3', 'active', '2025-04-17 09:51:56', '2025-04-17 09:51:56'),
(187, NULL, 'Lower Subansiri', '3', 'active', '2025-04-17 09:51:56', '2025-04-17 09:51:56'),
(188, NULL, 'Margherita', '3', 'active', '2025-04-17 09:51:56', '2025-04-17 09:51:56'),
(189, NULL, 'Naharlagun', '3', 'active', '2025-04-17 09:51:56', '2025-04-17 09:51:56'),
(190, NULL, 'Pasighat', '3', 'active', '2025-04-17 09:51:56', '2025-04-17 09:51:56'),
(191, NULL, 'Tawang', '3', 'active', '2025-04-17 09:51:56', '2025-04-17 09:51:56'),
(192, NULL, 'Tezu', '3', 'active', '2025-04-17 09:51:56', '2025-04-17 09:51:56'),
(193, NULL, 'Tirap', '3', 'active', '2025-04-17 09:51:56', '2025-04-17 09:51:56'),
(194, NULL, 'Upper Siang', '3', 'active', '2025-04-17 09:51:56', '2025-04-17 09:51:56'),
(195, NULL, 'Upper Subansiri', '3', 'active', '2025-04-17 09:51:56', '2025-04-17 09:51:56'),
(196, NULL, 'West Kameng', '3', 'active', '2025-04-17 09:51:56', '2025-04-17 09:51:56'),
(197, NULL, 'West Siang', '3', 'active', '2025-04-17 09:51:56', '2025-04-17 09:51:56'),
(198, NULL, 'Ziro', '3', 'active', '2025-04-17 09:51:56', '2025-04-17 09:51:56'),
(199, NULL, 'Abhayapuri', '4', 'active', '2025-04-17 09:51:56', '2025-04-17 09:51:56'),
(200, NULL, 'Amguri', '4', 'active', '2025-04-17 09:51:56', '2025-04-17 09:51:56'),
(201, NULL, 'Badarpur', '4', 'active', '2025-04-17 09:51:56', '2025-04-17 09:51:56'),
(202, NULL, 'Baksa', '4', 'active', '2025-04-17 09:51:56', '2025-04-17 09:51:56'),
(203, NULL, 'Barpathar', '4', 'active', '2025-04-17 09:51:56', '2025-04-17 09:51:56'),
(204, NULL, 'Barpeta', '4', 'active', '2025-04-17 09:51:56', '2025-04-17 09:51:56'),
(205, NULL, 'Barpeta Road', '4', 'active', '2025-04-17 09:51:56', '2025-04-17 09:51:56'),
(206, NULL, 'Basugaon', '4', 'active', '2025-04-17 09:51:56', '2025-04-17 09:51:56'),
(207, NULL, 'Bihpuriagaon', '4', 'active', '2025-04-17 09:51:56', '2025-04-17 09:51:56'),
(208, NULL, 'Bijni', '4', 'active', '2025-04-17 09:51:56', '2025-04-17 09:51:56'),
(209, NULL, 'Bilasipara', '4', 'active', '2025-04-17 09:51:56', '2025-04-17 09:51:56'),
(210, NULL, 'Bokajan', '4', 'active', '2025-04-17 09:51:56', '2025-04-17 09:51:56'),
(211, NULL, 'Bokakhat', '4', 'active', '2025-04-17 09:51:56', '2025-04-17 09:51:56'),
(212, NULL, 'Bongaigaon', '4', 'active', '2025-04-17 09:51:56', '2025-04-17 09:51:56'),
(213, NULL, 'Cachar', '4', 'active', '2025-04-17 09:51:56', '2025-04-17 09:51:56'),
(214, NULL, 'Chabua', '4', 'active', '2025-04-17 09:51:56', '2025-04-17 09:51:56'),
(215, NULL, 'Chapar', '4', 'active', '2025-04-17 09:51:56', '2025-04-17 09:51:56'),
(216, NULL, 'Chirang', '4', 'active', '2025-04-17 09:51:56', '2025-04-17 09:51:56'),
(217, NULL, 'Darrang', '4', 'active', '2025-04-17 09:51:56', '2025-04-17 09:51:56'),
(218, NULL, 'Dergaon', '4', 'active', '2025-04-17 09:51:56', '2025-04-17 09:51:56'),
(219, NULL, 'Dhekiajuli', '4', 'active', '2025-04-17 09:51:56', '2025-04-17 09:51:56'),
(220, NULL, 'Dhemaji', '4', 'active', '2025-04-17 09:51:56', '2025-04-17 09:51:56'),
(221, NULL, 'Dhing', '4', 'active', '2025-04-17 09:51:56', '2025-04-17 09:51:56'),
(222, NULL, 'Dhubri', '4', 'active', '2025-04-17 09:51:56', '2025-04-17 09:51:56'),
(223, NULL, 'Dibrugarh', '4', 'active', '2025-04-17 09:51:57', '2025-04-17 09:51:57'),
(224, NULL, 'Digboi', '4', 'active', '2025-04-17 09:51:57', '2025-04-17 09:51:57'),
(225, NULL, 'Dima Hasao District', '4', 'active', '2025-04-17 09:51:57', '2025-04-17 09:51:57'),
(226, NULL, 'Diphu', '4', 'active', '2025-04-17 09:51:57', '2025-04-17 09:51:57'),
(227, NULL, 'Dispur', '4', 'active', '2025-04-17 09:51:57', '2025-04-17 09:51:57'),
(228, NULL, 'Duliagaon', '4', 'active', '2025-04-17 09:51:57', '2025-04-17 09:51:57'),
(229, NULL, 'Dum Duma', '4', 'active', '2025-04-17 09:51:57', '2025-04-17 09:51:57'),
(230, NULL, 'Gauripur', '4', 'active', '2025-04-17 09:51:57', '2025-04-17 09:51:57'),
(231, NULL, 'Goalpara', '4', 'active', '2025-04-17 09:51:57', '2025-04-17 09:51:57'),
(232, NULL, 'Gohpur', '4', 'active', '2025-04-17 09:51:57', '2025-04-17 09:51:57'),
(233, NULL, 'Golaghat', '4', 'active', '2025-04-17 09:51:57', '2025-04-17 09:51:57'),
(234, NULL, 'Golakganj', '4', 'active', '2025-04-17 09:51:57', '2025-04-17 09:51:57'),
(235, NULL, 'Goshaingaon', '4', 'active', '2025-04-17 09:51:57', '2025-04-17 09:51:57'),
(236, NULL, 'Guwahati', '4', 'active', '2025-04-17 09:51:57', '2025-04-17 09:51:57'),
(237, NULL, 'Haflong', '4', 'active', '2025-04-17 09:51:57', '2025-04-17 09:51:57'),
(238, NULL, 'Hailakandi', '4', 'active', '2025-04-17 09:51:57', '2025-04-17 09:51:57'),
(239, NULL, 'Hajo', '4', 'active', '2025-04-17 09:51:57', '2025-04-17 09:51:57'),
(240, NULL, 'Hojai', '4', 'active', '2025-04-17 09:51:57', '2025-04-17 09:51:57'),
(241, NULL, 'Howli', '4', 'active', '2025-04-17 09:51:57', '2025-04-17 09:51:57'),
(242, NULL, 'Jogighopa', '4', 'active', '2025-04-17 09:51:57', '2025-04-17 09:51:57'),
(243, NULL, 'Jorhat', '4', 'active', '2025-04-17 09:51:57', '2025-04-17 09:51:57'),
(244, NULL, 'Kamrup', '4', 'active', '2025-04-17 09:51:57', '2025-04-17 09:51:57'),
(245, NULL, 'Kamrup Metropolitan', '4', 'active', '2025-04-17 09:51:57', '2025-04-17 09:51:57'),
(246, NULL, 'Karbi Anglong', '4', 'active', '2025-04-17 09:51:57', '2025-04-17 09:51:57'),
(247, NULL, 'Karimganj', '4', 'active', '2025-04-17 09:51:57', '2025-04-17 09:51:57'),
(248, NULL, 'Kharupatia', '4', 'active', '2025-04-17 09:51:57', '2025-04-17 09:51:57'),
(249, NULL, 'Kokrajhar', '4', 'active', '2025-04-17 09:51:57', '2025-04-17 09:51:57'),
(250, NULL, 'Lakhimpur', '4', 'active', '2025-04-17 09:51:57', '2025-04-17 09:51:57'),
(251, NULL, 'Lakhipur', '4', 'active', '2025-04-17 09:51:57', '2025-04-17 09:51:57'),
(252, NULL, 'Lala', '4', 'active', '2025-04-17 09:51:57', '2025-04-17 09:51:57'),
(253, NULL, 'Lumding Railway Colony', '4', 'active', '2025-04-17 09:51:57', '2025-04-17 09:51:57'),
(254, NULL, 'Mahur', '4', 'active', '2025-04-17 09:51:57', '2025-04-17 09:51:57'),
(255, NULL, 'Maibong', '4', 'active', '2025-04-17 09:51:57', '2025-04-17 09:51:57'),
(256, NULL, 'Makum', '4', 'active', '2025-04-17 09:51:57', '2025-04-17 09:51:57'),
(257, NULL, 'Mangaldai', '4', 'active', '2025-04-17 09:51:57', '2025-04-17 09:51:57'),
(258, NULL, 'Mariani', '4', 'active', '2025-04-17 09:51:57', '2025-04-17 09:51:57'),
(259, NULL, 'Moranha', '4', 'active', '2025-04-17 09:51:57', '2025-04-17 09:51:57'),
(260, NULL, 'Morigaon', '4', 'active', '2025-04-17 09:51:57', '2025-04-17 09:51:57'),
(261, NULL, 'Nagaon', '4', 'active', '2025-04-17 09:51:57', '2025-04-17 09:51:57'),
(262, NULL, 'Nahorkatiya', '4', 'active', '2025-04-17 09:51:57', '2025-04-17 09:51:57'),
(263, NULL, 'Nalbari', '4', 'active', '2025-04-17 09:51:57', '2025-04-17 09:51:57'),
(264, NULL, 'Namrup', '4', 'active', '2025-04-17 09:51:57', '2025-04-17 09:51:57'),
(265, NULL, 'Nazira', '4', 'active', '2025-04-17 09:51:57', '2025-04-17 09:51:57'),
(266, NULL, 'North Guwahati', '4', 'active', '2025-04-17 09:51:57', '2025-04-17 09:51:57'),
(267, NULL, 'North Lakhimpur', '4', 'active', '2025-04-17 09:51:57', '2025-04-17 09:51:57'),
(268, NULL, 'Numaligarh', '4', 'active', '2025-04-17 09:51:57', '2025-04-17 09:51:57'),
(269, NULL, 'Palasbari', '4', 'active', '2025-04-17 09:51:57', '2025-04-17 09:51:57'),
(270, NULL, 'Raha', '4', 'active', '2025-04-17 09:51:57', '2025-04-17 09:51:57'),
(271, NULL, 'Rangapara', '4', 'active', '2025-04-17 09:51:57', '2025-04-17 09:51:57'),
(272, NULL, 'Rangia', '4', 'active', '2025-04-17 09:51:57', '2025-04-17 09:51:57'),
(273, NULL, 'Sapatgram', '4', 'active', '2025-04-17 09:51:57', '2025-04-17 09:51:57'),
(274, NULL, 'Sarupathar', '4', 'active', '2025-04-17 09:51:57', '2025-04-17 09:51:57'),
(275, NULL, 'Sibsagar', '4', 'active', '2025-04-17 09:51:57', '2025-04-17 09:51:57'),
(276, NULL, 'Silapathar', '4', 'active', '2025-04-17 09:51:57', '2025-04-17 09:51:57'),
(277, NULL, 'Silchar', '4', 'active', '2025-04-17 09:51:57', '2025-04-17 09:51:57'),
(278, NULL, 'Soalkuchi', '4', 'active', '2025-04-17 09:51:57', '2025-04-17 09:51:57'),
(279, NULL, 'Sonari', '4', 'active', '2025-04-17 09:51:57', '2025-04-17 09:51:57'),
(280, NULL, 'Sonitpur', '4', 'active', '2025-04-17 09:51:57', '2025-04-17 09:51:57'),
(281, NULL, 'Sorbhog', '4', 'active', '2025-04-17 09:51:57', '2025-04-17 09:51:57'),
(282, NULL, 'Tezpur', '4', 'active', '2025-04-17 09:51:57', '2025-04-17 09:51:57'),
(283, NULL, 'Tinsukia', '4', 'active', '2025-04-17 09:51:57', '2025-04-17 09:51:57'),
(284, NULL, 'Titabar', '4', 'active', '2025-04-17 09:51:57', '2025-04-17 09:51:57'),
(285, NULL, 'Udalguri', '4', 'active', '2025-04-17 09:51:57', '2025-04-17 09:51:57'),
(286, NULL, 'Amarpur', '5', 'active', '2025-04-17 09:51:57', '2025-04-17 09:51:57'),
(287, NULL, 'Araria', '5', 'active', '2025-04-17 09:51:57', '2025-04-17 09:51:57'),
(288, NULL, 'Arrah', '5', 'active', '2025-04-17 09:51:57', '2025-04-17 09:51:57'),
(289, NULL, 'Arwal', '5', 'active', '2025-04-17 09:51:57', '2025-04-17 09:51:57'),
(290, NULL, 'Asarganj', '5', 'active', '2025-04-17 09:51:57', '2025-04-17 09:51:57'),
(291, NULL, 'Aurangabad', '5', 'active', '2025-04-17 09:51:57', '2025-04-17 09:51:57'),
(292, NULL, 'Bagaha', '5', 'active', '2025-04-17 09:51:57', '2025-04-17 09:51:57'),
(293, NULL, 'Bahadurganj', '5', 'active', '2025-04-17 09:51:57', '2025-04-17 09:51:57'),
(294, NULL, 'Bairagnia', '5', 'active', '2025-04-17 09:51:57', '2025-04-17 09:51:57'),
(295, NULL, 'Baisi', '5', 'active', '2025-04-17 09:51:57', '2025-04-17 09:51:57'),
(296, NULL, 'Bakhtiyarpur', '5', 'active', '2025-04-17 09:51:57', '2025-04-17 09:51:57'),
(297, NULL, 'Bangaon', '5', 'active', '2025-04-17 09:51:57', '2025-04-17 09:51:57'),
(298, NULL, 'Banka', '5', 'active', '2025-04-17 09:51:57', '2025-04-17 09:51:57'),
(299, NULL, 'Banmankhi', '5', 'active', '2025-04-17 09:51:57', '2025-04-17 09:51:57'),
(300, NULL, 'Bar Bigha', '5', 'active', '2025-04-17 09:51:57', '2025-04-17 09:51:57'),
(301, NULL, 'Barauli', '5', 'active', '2025-04-17 09:51:57', '2025-04-17 09:51:57'),
(302, NULL, 'Barh', '5', 'active', '2025-04-17 09:51:57', '2025-04-17 09:51:57'),
(303, NULL, 'Barhiya', '5', 'active', '2025-04-17 09:51:57', '2025-04-17 09:51:57'),
(304, NULL, 'Bariarpur', '5', 'active', '2025-04-17 09:51:57', '2025-04-17 09:51:57'),
(305, NULL, 'Baruni', '5', 'active', '2025-04-17 09:51:57', '2025-04-17 09:51:57'),
(306, NULL, 'Begusarai', '5', 'active', '2025-04-17 09:51:57', '2025-04-17 09:51:57'),
(307, NULL, 'Belsand', '5', 'active', '2025-04-17 09:51:57', '2025-04-17 09:51:57'),
(308, NULL, 'Bettiah', '5', 'active', '2025-04-17 09:51:57', '2025-04-17 09:51:57'),
(309, NULL, 'Bhabhua', '5', 'active', '2025-04-17 09:51:57', '2025-04-17 09:51:57'),
(310, NULL, 'Bhagalpur', '5', 'active', '2025-04-17 09:51:57', '2025-04-17 09:51:57'),
(311, NULL, 'Bhagirathpur', '5', 'active', '2025-04-17 09:51:57', '2025-04-17 09:51:57'),
(312, NULL, 'Bhawanipur', '5', 'active', '2025-04-17 09:51:57', '2025-04-17 09:51:57'),
(313, NULL, 'Bhojpur', '5', 'active', '2025-04-17 09:51:57', '2025-04-17 09:51:57'),
(314, NULL, 'Bihar Sharif', '5', 'active', '2025-04-17 09:51:57', '2025-04-17 09:51:57'),
(315, NULL, 'Bihariganj', '5', 'active', '2025-04-17 09:51:57', '2025-04-17 09:51:57'),
(316, NULL, 'Bikramganj', '5', 'active', '2025-04-17 09:51:57', '2025-04-17 09:51:57'),
(317, NULL, 'Birpur', '5', 'active', '2025-04-17 09:51:57', '2025-04-17 09:51:57'),
(318, NULL, 'Bodh Gaya', '5', 'active', '2025-04-17 09:51:57', '2025-04-17 09:51:57'),
(319, NULL, 'Buxar', '5', 'active', '2025-04-17 09:51:57', '2025-04-17 09:51:57'),
(320, NULL, 'Chakia', '5', 'active', '2025-04-17 09:51:57', '2025-04-17 09:51:57'),
(321, NULL, 'Chapra', '5', 'active', '2025-04-17 09:51:57', '2025-04-17 09:51:57'),
(322, NULL, 'Chhatapur', '5', 'active', '2025-04-17 09:51:57', '2025-04-17 09:51:57'),
(323, NULL, 'Colgong', '5', 'active', '2025-04-17 09:51:57', '2025-04-17 09:51:57'),
(324, NULL, 'Dalsingh Sarai', '5', 'active', '2025-04-17 09:51:57', '2025-04-17 09:51:57'),
(325, NULL, 'Darbhanga', '5', 'active', '2025-04-17 09:51:57', '2025-04-17 09:51:57'),
(326, NULL, 'Daudnagar', '5', 'active', '2025-04-17 09:51:57', '2025-04-17 09:51:57'),
(327, NULL, 'Dehri', '5', 'active', '2025-04-17 09:51:57', '2025-04-17 09:51:57'),
(328, NULL, 'Dhaka', '5', 'active', '2025-04-17 09:51:57', '2025-04-17 09:51:57'),
(329, NULL, 'Dighwara', '5', 'active', '2025-04-17 09:51:57', '2025-04-17 09:51:57'),
(330, NULL, 'Dinapore', '5', 'active', '2025-04-17 09:51:57', '2025-04-17 09:51:57'),
(331, NULL, 'Dumra', '5', 'active', '2025-04-17 09:51:57', '2025-04-17 09:51:57'),
(332, NULL, 'Dumraon', '5', 'active', '2025-04-17 09:51:57', '2025-04-17 09:51:57'),
(333, NULL, 'Fatwa', '5', 'active', '2025-04-17 09:51:57', '2025-04-17 09:51:57'),
(334, NULL, 'Forbesganj', '5', 'active', '2025-04-17 09:51:57', '2025-04-17 09:51:57'),
(335, NULL, 'Gaya', '5', 'active', '2025-04-17 09:51:57', '2025-04-17 09:51:57'),
(336, NULL, 'Ghoga', '5', 'active', '2025-04-17 09:51:57', '2025-04-17 09:51:57'),
(337, NULL, 'Gopalganj', '5', 'active', '2025-04-17 09:51:57', '2025-04-17 09:51:57'),
(338, NULL, 'Hajipur', '5', 'active', '2025-04-17 09:51:57', '2025-04-17 09:51:57'),
(339, NULL, 'Hilsa', '5', 'active', '2025-04-17 09:51:57', '2025-04-17 09:51:57'),
(340, NULL, 'Hisua', '5', 'active', '2025-04-17 09:51:57', '2025-04-17 09:51:57'),
(341, NULL, 'Islampur', '5', 'active', '2025-04-17 09:51:57', '2025-04-17 09:51:57'),
(342, NULL, 'Jagdispur', '5', 'active', '2025-04-17 09:51:57', '2025-04-17 09:51:57'),
(343, NULL, 'Jahanabad', '5', 'active', '2025-04-17 09:51:57', '2025-04-17 09:51:57'),
(344, NULL, 'Jamalpur', '5', 'active', '2025-04-17 09:51:57', '2025-04-17 09:51:57'),
(345, NULL, 'Jamui', '5', 'active', '2025-04-17 09:51:57', '2025-04-17 09:51:57'),
(346, NULL, 'Jaynagar', '5', 'active', '2025-04-17 09:51:57', '2025-04-17 09:51:57'),
(347, NULL, 'Jehanabad', '5', 'active', '2025-04-17 09:51:57', '2025-04-17 09:51:57'),
(348, NULL, 'Jha-Jha', '5', 'active', '2025-04-17 09:51:57', '2025-04-17 09:51:57'),
(349, NULL, 'Jhanjharpur', '5', 'active', '2025-04-17 09:51:57', '2025-04-17 09:51:57'),
(350, NULL, 'Jogbani', '5', 'active', '2025-04-17 09:51:57', '2025-04-17 09:51:57'),
(351, NULL, 'Kaimur District', '5', 'active', '2025-04-17 09:51:57', '2025-04-17 09:51:57'),
(352, NULL, 'Kasba', '5', 'active', '2025-04-17 09:51:57', '2025-04-17 09:51:57'),
(353, NULL, 'Katihar', '5', 'active', '2025-04-17 09:51:57', '2025-04-17 09:51:57'),
(354, NULL, 'Khagaria', '5', 'active', '2025-04-17 09:51:57', '2025-04-17 09:51:57'),
(355, NULL, 'Khagaul', '5', 'active', '2025-04-17 09:51:57', '2025-04-17 09:51:57'),
(356, NULL, 'Kharagpur', '5', 'active', '2025-04-17 09:51:57', '2025-04-17 09:51:57'),
(357, NULL, 'Khusropur', '5', 'active', '2025-04-17 09:51:57', '2025-04-17 09:51:57'),
(358, NULL, 'Kishanganj', '5', 'active', '2025-04-17 09:51:57', '2025-04-17 09:51:57'),
(359, NULL, 'Koath', '5', 'active', '2025-04-17 09:51:57', '2025-04-17 09:51:57'),
(360, NULL, 'Koelwar', '5', 'active', '2025-04-17 09:51:57', '2025-04-17 09:51:57'),
(361, NULL, 'Lakhisarai', '5', 'active', '2025-04-17 09:51:57', '2025-04-17 09:51:57'),
(362, NULL, 'Lalganj', '5', 'active', '2025-04-17 09:51:57', '2025-04-17 09:51:57'),
(363, NULL, 'Luckeesarai', '5', 'active', '2025-04-17 09:51:57', '2025-04-17 09:51:57'),
(364, NULL, 'Madhepura', '5', 'active', '2025-04-17 09:51:57', '2025-04-17 09:51:57'),
(365, NULL, 'Madhubani', '5', 'active', '2025-04-17 09:51:57', '2025-04-17 09:51:57'),
(366, NULL, 'Maharajgani', '5', 'active', '2025-04-17 09:51:57', '2025-04-17 09:51:57'),
(367, NULL, 'Mairwa', '5', 'active', '2025-04-17 09:51:57', '2025-04-17 09:51:57'),
(368, NULL, 'Maner', '5', 'active', '2025-04-17 09:51:57', '2025-04-17 09:51:57'),
(369, NULL, 'Manihari', '5', 'active', '2025-04-17 09:51:57', '2025-04-17 09:51:57'),
(370, NULL, 'Marhaura', '5', 'active', '2025-04-17 09:51:57', '2025-04-17 09:51:57'),
(371, NULL, 'Masaurhi Buzurg', '5', 'active', '2025-04-17 09:51:57', '2025-04-17 09:51:57'),
(372, NULL, 'Mohiuddi nagar', '5', 'active', '2025-04-17 09:51:57', '2025-04-17 09:51:57'),
(373, NULL, 'Mokameh', '5', 'active', '2025-04-17 09:51:57', '2025-04-17 09:51:57'),
(374, NULL, 'Monghyr', '5', 'active', '2025-04-17 09:51:57', '2025-04-17 09:51:57'),
(375, NULL, 'Mothihari', '5', 'active', '2025-04-17 09:51:57', '2025-04-17 09:51:57'),
(376, NULL, 'Munger', '5', 'active', '2025-04-17 09:51:57', '2025-04-17 09:51:57'),
(377, NULL, 'Murliganj', '5', 'active', '2025-04-17 09:51:57', '2025-04-17 09:51:57'),
(378, NULL, 'Muzaffarpur', '5', 'active', '2025-04-17 09:51:57', '2025-04-17 09:51:57'),
(379, NULL, 'Nabinagar', '5', 'active', '2025-04-17 09:51:57', '2025-04-17 09:51:57'),
(380, NULL, 'Nalanda', '5', 'active', '2025-04-17 09:51:57', '2025-04-17 09:51:57'),
(381, NULL, 'Nasriganj', '5', 'active', '2025-04-17 09:51:57', '2025-04-17 09:51:57'),
(382, NULL, 'Naugachhia', '5', 'active', '2025-04-17 09:51:57', '2025-04-17 09:51:57'),
(383, NULL, 'Nawada', '5', 'active', '2025-04-17 09:51:57', '2025-04-17 09:51:57'),
(384, NULL, 'Nirmali', '5', 'active', '2025-04-17 09:51:57', '2025-04-17 09:51:57'),
(385, NULL, 'Pashchim Champaran', '5', 'active', '2025-04-17 09:51:57', '2025-04-17 09:51:57'),
(386, NULL, 'Patna', '5', 'active', '2025-04-17 09:51:57', '2025-04-17 09:51:57'),
(387, NULL, 'Piro', '5', 'active', '2025-04-17 09:51:57', '2025-04-17 09:51:57'),
(388, NULL, 'Pupri', '5', 'active', '2025-04-17 09:51:57', '2025-04-17 09:51:57'),
(389, NULL, 'Purba Champaran', '5', 'active', '2025-04-17 09:51:57', '2025-04-17 09:51:57'),
(390, NULL, 'Purnia', '5', 'active', '2025-04-17 09:51:57', '2025-04-17 09:51:57'),
(391, NULL, 'Rafiganj', '5', 'active', '2025-04-17 09:51:57', '2025-04-17 09:51:57'),
(392, NULL, 'Raghunathpur', '5', 'active', '2025-04-17 09:51:57', '2025-04-17 09:51:57'),
(393, NULL, 'Rajgir', '5', 'active', '2025-04-17 09:51:57', '2025-04-17 09:51:57'),
(394, NULL, 'Ramnagar', '5', 'active', '2025-04-17 09:51:57', '2025-04-17 09:51:57'),
(395, NULL, 'Raxaul', '5', 'active', '2025-04-17 09:51:57', '2025-04-17 09:51:57'),
(396, NULL, 'Revelganj', '5', 'active', '2025-04-17 09:51:57', '2025-04-17 09:51:57'),
(397, NULL, 'Rohtas', '5', 'active', '2025-04-17 09:51:57', '2025-04-17 09:51:57'),
(398, NULL, 'Rusera', '5', 'active', '2025-04-17 09:51:57', '2025-04-17 09:51:57'),
(399, NULL, 'Sagauli', '5', 'active', '2025-04-17 09:51:57', '2025-04-17 09:51:57'),
(400, NULL, 'Saharsa', '5', 'active', '2025-04-17 09:51:57', '2025-04-17 09:51:57'),
(401, NULL, 'Samastipur', '5', 'active', '2025-04-17 09:51:57', '2025-04-17 09:51:57'),
(402, NULL, 'Saran', '5', 'active', '2025-04-17 09:51:57', '2025-04-17 09:51:57'),
(403, NULL, 'Shahbazpur', '5', 'active', '2025-04-17 09:51:57', '2025-04-17 09:51:57'),
(404, NULL, 'Shahpur', '5', 'active', '2025-04-17 09:51:57', '2025-04-17 09:51:57'),
(405, NULL, 'Sheikhpura', '5', 'active', '2025-04-17 09:51:57', '2025-04-17 09:51:57'),
(406, NULL, 'Sheohar', '5', 'active', '2025-04-17 09:51:57', '2025-04-17 09:51:57'),
(407, NULL, 'Sherghati', '5', 'active', '2025-04-17 09:51:57', '2025-04-17 09:51:57'),
(408, NULL, 'Silao', '5', 'active', '2025-04-17 09:51:57', '2025-04-17 09:51:57'),
(409, NULL, 'Sitamarhi', '5', 'active', '2025-04-17 09:51:57', '2025-04-17 09:51:57'),
(410, NULL, 'Siwan', '5', 'active', '2025-04-17 09:51:57', '2025-04-17 09:51:57'),
(411, NULL, 'Supaul', '5', 'active', '2025-04-17 09:51:57', '2025-04-17 09:51:57'),
(412, NULL, 'Teghra', '5', 'active', '2025-04-17 09:51:57', '2025-04-17 09:51:57'),
(413, NULL, 'Tekari', '5', 'active', '2025-04-17 09:51:57', '2025-04-17 09:51:57'),
(414, NULL, 'Thakurganj', '5', 'active', '2025-04-17 09:51:57', '2025-04-17 09:51:57'),
(415, NULL, 'Vaishali', '5', 'active', '2025-04-17 09:51:57', '2025-04-17 09:51:57'),
(416, NULL, 'Waris Aliganj', '5', 'active', '2025-04-17 09:51:57', '2025-04-17 09:51:57'),
(417, NULL, 'Chandigarh', '6', 'active', '2025-04-17 09:51:57', '2025-04-17 09:51:57'),
(418, NULL, 'Akaltara', '7', 'active', '2025-04-17 09:51:57', '2025-04-17 09:51:57'),
(419, NULL, 'Ambagarh Chauki', '7', 'active', '2025-04-17 09:51:57', '2025-04-17 09:51:57'),
(420, NULL, 'Ambikapur', '7', 'active', '2025-04-17 09:51:57', '2025-04-17 09:51:57'),
(421, NULL, 'Arang', '7', 'active', '2025-04-17 09:51:57', '2025-04-17 09:51:57'),
(422, NULL, 'Baikunthpur', '7', 'active', '2025-04-17 09:51:57', '2025-04-17 09:51:57'),
(423, NULL, 'Balod', '7', 'active', '2025-04-17 09:51:57', '2025-04-17 09:51:57'),
(424, NULL, 'Baloda', '7', 'active', '2025-04-17 09:51:57', '2025-04-17 09:51:57'),
(425, NULL, 'Baloda Bazar', '7', 'active', '2025-04-17 09:51:57', '2025-04-17 09:51:57'),
(426, NULL, 'Basna', '7', 'active', '2025-04-17 09:51:57', '2025-04-17 09:51:57'),
(427, NULL, 'Bastar', '7', 'active', '2025-04-17 09:51:57', '2025-04-17 09:51:57'),
(428, NULL, 'Bemetara', '7', 'active', '2025-04-17 09:51:57', '2025-04-17 09:51:57'),
(429, NULL, 'Bhanpuri', '7', 'active', '2025-04-17 09:51:57', '2025-04-17 09:51:57'),
(430, NULL, 'Bhatapara', '7', 'active', '2025-04-17 09:51:57', '2025-04-17 09:51:57'),
(431, NULL, 'Bhatgaon', '7', 'active', '2025-04-17 09:51:57', '2025-04-17 09:51:57'),
(432, NULL, 'Bhilai', '7', 'active', '2025-04-17 09:51:57', '2025-04-17 09:51:57'),
(433, NULL, 'Bijapur', '7', 'active', '2025-04-17 09:51:57', '2025-04-17 09:51:57'),
(434, NULL, 'Bilaspur', '7', 'active', '2025-04-17 09:51:57', '2025-04-17 09:51:57'),
(435, NULL, 'Champa', '7', 'active', '2025-04-17 09:51:57', '2025-04-17 09:51:57'),
(436, NULL, 'Chhuikhadan', '7', 'active', '2025-04-17 09:51:57', '2025-04-17 09:51:57'),
(437, NULL, 'Dantewada', '7', 'active', '2025-04-17 09:51:57', '2025-04-17 09:51:57'),
(438, NULL, 'Deori', '7', 'active', '2025-04-17 09:51:57', '2025-04-17 09:51:57'),
(439, NULL, 'Dhamtari', '7', 'active', '2025-04-17 09:51:57', '2025-04-17 09:51:57'),
(440, NULL, 'Dongargaon', '7', 'active', '2025-04-17 09:51:57', '2025-04-17 09:51:57'),
(441, NULL, 'Dongargarh', '7', 'active', '2025-04-17 09:51:57', '2025-04-17 09:51:57'),
(442, NULL, 'Durg', '7', 'active', '2025-04-17 09:51:57', '2025-04-17 09:51:57'),
(443, NULL, 'Gandai', '7', 'active', '2025-04-17 09:51:57', '2025-04-17 09:51:57'),
(444, NULL, 'Gariaband', '7', 'active', '2025-04-17 09:51:57', '2025-04-17 09:51:57'),
(445, NULL, 'Gaurela', '7', 'active', '2025-04-17 09:51:57', '2025-04-17 09:51:57'),
(446, NULL, 'Gharghoda', '7', 'active', '2025-04-17 09:51:57', '2025-04-17 09:51:57'),
(447, NULL, 'Gidam', '7', 'active', '2025-04-17 09:51:57', '2025-04-17 09:51:57'),
(448, NULL, 'Jagdalpur', '7', 'active', '2025-04-17 09:51:57', '2025-04-17 09:51:57'),
(449, NULL, 'Janjgir', '7', 'active', '2025-04-17 09:51:57', '2025-04-17 09:51:57'),
(450, NULL, 'Janjgir-Champa', '7', 'active', '2025-04-17 09:51:57', '2025-04-17 09:51:57'),
(451, NULL, 'Jashpur', '7', 'active', '2025-04-17 09:51:57', '2025-04-17 09:51:57'),
(452, NULL, 'Jashpurnagar', '7', 'active', '2025-04-17 09:51:57', '2025-04-17 09:51:57'),
(453, NULL, 'Junagarh', '7', 'active', '2025-04-17 09:51:57', '2025-04-17 09:51:57'),
(454, NULL, 'Kabeerdham', '7', 'active', '2025-04-17 09:51:57', '2025-04-17 09:51:57'),
(455, NULL, 'Kanker', '7', 'active', '2025-04-17 09:51:57', '2025-04-17 09:51:57'),
(456, NULL, 'Katghora', '7', 'active', '2025-04-17 09:51:57', '2025-04-17 09:51:57'),
(457, NULL, 'Kawardha', '7', 'active', '2025-04-17 09:51:57', '2025-04-17 09:51:57'),
(458, NULL, 'Khairagarh', '7', 'active', '2025-04-17 09:51:57', '2025-04-17 09:51:57'),
(459, NULL, 'Khamharia', '7', 'active', '2025-04-17 09:51:57', '2025-04-17 09:51:57'),
(460, NULL, 'Kharod', '7', 'active', '2025-04-17 09:51:57', '2025-04-17 09:51:57'),
(461, NULL, 'Kharsia', '7', 'active', '2025-04-17 09:51:57', '2025-04-17 09:51:57'),
(462, NULL, 'Kirandul', '7', 'active', '2025-04-17 09:51:57', '2025-04-17 09:51:57'),
(463, NULL, 'Kondagaon', '7', 'active', '2025-04-17 09:51:57', '2025-04-17 09:51:57'),
(464, NULL, 'Korba', '7', 'active', '2025-04-17 09:51:57', '2025-04-17 09:51:57'),
(465, NULL, 'Koria', '7', 'active', '2025-04-17 09:51:57', '2025-04-17 09:51:57'),
(466, NULL, 'Kota', '7', 'active', '2025-04-17 09:51:57', '2025-04-17 09:51:57'),
(467, NULL, 'Kotaparh', '7', 'active', '2025-04-17 09:51:57', '2025-04-17 09:51:57'),
(468, NULL, 'Kumhari', '7', 'active', '2025-04-17 09:51:57', '2025-04-17 09:51:57'),
(469, NULL, 'Kurud', '7', 'active', '2025-04-17 09:51:57', '2025-04-17 09:51:57'),
(470, NULL, 'Lormi', '7', 'active', '2025-04-17 09:51:57', '2025-04-17 09:51:57'),
(471, NULL, 'Mahasamund', '7', 'active', '2025-04-17 09:51:57', '2025-04-17 09:51:57'),
(472, NULL, 'Mungeli', '7', 'active', '2025-04-17 09:51:57', '2025-04-17 09:51:57'),
(473, NULL, 'Narayanpur', '7', 'active', '2025-04-17 09:51:57', '2025-04-17 09:51:57'),
(474, NULL, 'Narharpur', '7', 'active', '2025-04-17 09:51:57', '2025-04-17 09:51:57'),
(475, NULL, 'Pandaria', '7', 'active', '2025-04-17 09:51:57', '2025-04-17 09:51:57'),
(476, NULL, 'Pandatarai', '7', 'active', '2025-04-17 09:51:57', '2025-04-17 09:51:57'),
(477, NULL, 'Pasan', '7', 'active', '2025-04-17 09:51:57', '2025-04-17 09:51:57'),
(478, NULL, 'Patan', '7', 'active', '2025-04-17 09:51:57', '2025-04-17 09:51:57'),
(479, NULL, 'Pathalgaon', '7', 'active', '2025-04-17 09:51:57', '2025-04-17 09:51:57'),
(480, NULL, 'Pendra', '7', 'active', '2025-04-17 09:51:57', '2025-04-17 09:51:57'),
(481, NULL, 'Pithora', '7', 'active', '2025-04-17 09:51:57', '2025-04-17 09:51:57'),
(482, NULL, 'Raigarh', '7', 'active', '2025-04-17 09:51:57', '2025-04-17 09:51:57'),
(483, NULL, 'Raipur', '7', 'active', '2025-04-17 09:51:57', '2025-04-17 09:51:57'),
(484, NULL, 'Raj Nandgaon', '7', 'active', '2025-04-17 09:51:57', '2025-04-17 09:51:57'),
(485, NULL, 'Ramanuj Ganj', '7', 'active', '2025-04-17 09:51:57', '2025-04-17 09:51:57'),
(486, NULL, 'Ratanpur', '7', 'active', '2025-04-17 09:51:57', '2025-04-17 09:51:57'),
(487, NULL, 'Sakti', '7', 'active', '2025-04-17 09:51:57', '2025-04-17 09:51:57'),
(488, NULL, 'Saraipali', '7', 'active', '2025-04-17 09:51:57', '2025-04-17 09:51:57'),
(489, NULL, 'Sarangarh', '7', 'active', '2025-04-17 09:51:57', '2025-04-17 09:51:57'),
(490, NULL, 'Seorinarayan', '7', 'active', '2025-04-17 09:51:57', '2025-04-17 09:51:57'),
(491, NULL, 'Simga', '7', 'active', '2025-04-17 09:51:57', '2025-04-17 09:51:57'),
(492, NULL, 'Surguja', '7', 'active', '2025-04-17 09:51:57', '2025-04-17 09:51:57'),
(493, NULL, 'Takhatpur', '7', 'active', '2025-04-17 09:51:57', '2025-04-17 09:51:57'),
(494, NULL, 'Umarkot', '7', 'active', '2025-04-17 09:51:57', '2025-04-17 09:51:57'),
(495, NULL, 'Uttar Bastar Kanker', '7', 'active', '2025-04-17 09:51:57', '2025-04-17 09:51:57'),
(496, NULL, 'Amli', '8', 'active', '2025-04-17 09:51:57', '2025-04-17 09:51:57'),
(497, NULL, 'Dadra', '8', 'active', '2025-04-17 09:51:57', '2025-04-17 09:51:57'),
(498, NULL, 'Dadra & Nagar Haveli', '8', 'active', '2025-04-17 09:51:57', '2025-04-17 09:51:57'),
(499, NULL, 'Daman', '8', 'active', '2025-04-17 09:51:57', '2025-04-17 09:51:57'),
(500, NULL, 'Diu', '8', 'active', '2025-04-17 09:51:57', '2025-04-17 09:51:57'),
(501, NULL, 'Silvassa', '8', 'active', '2025-04-17 09:51:57', '2025-04-17 09:51:57'),
(502, NULL, 'Alipur', '9', 'active', '2025-04-17 09:51:57', '2025-04-17 09:51:57'),
(503, NULL, 'Bawana', '9', 'active', '2025-04-17 09:51:57', '2025-04-17 09:51:57'),
(504, NULL, 'Central Delhi', '9', 'active', '2025-04-17 09:51:57', '2025-04-17 09:51:57'),
(505, NULL, 'Delhi', '9', 'active', '2025-04-17 09:51:57', '2025-04-17 09:51:57'),
(506, NULL, 'Deoli', '9', 'active', '2025-04-17 09:51:57', '2025-04-17 09:51:57'),
(507, NULL, 'East Delhi', '9', 'active', '2025-04-17 09:51:57', '2025-04-17 09:51:57'),
(508, NULL, 'Karol Bagh', '9', 'active', '2025-04-17 09:51:57', '2025-04-17 09:51:57'),
(509, NULL, 'Najafgarh', '9', 'active', '2025-04-17 09:51:57', '2025-04-17 09:51:57'),
(510, NULL, 'Nangloi Jat', '9', 'active', '2025-04-17 09:51:57', '2025-04-17 09:51:57'),
(511, NULL, 'Narela', '9', 'active', '2025-04-17 09:51:57', '2025-04-17 09:51:57'),
(512, NULL, 'New Delhi', '9', 'active', '2025-04-17 09:51:57', '2025-04-17 09:51:57'),
(513, NULL, 'North Delhi', '9', 'active', '2025-04-17 09:51:57', '2025-04-17 09:51:57'),
(514, NULL, 'North East Delhi', '9', 'active', '2025-04-17 09:51:57', '2025-04-17 09:51:57'),
(515, NULL, 'North West Delhi', '9', 'active', '2025-04-17 09:51:57', '2025-04-17 09:51:57'),
(516, NULL, 'Pitampura', '9', 'active', '2025-04-17 09:51:57', '2025-04-17 09:51:57'),
(517, NULL, 'Rohini', '9', 'active', '2025-04-17 09:51:57', '2025-04-17 09:51:57'),
(518, NULL, 'South Delhi', '9', 'active', '2025-04-17 09:51:57', '2025-04-17 09:51:57'),
(519, NULL, 'South West Delhi', '9', 'active', '2025-04-17 09:51:57', '2025-04-17 09:51:57'),
(520, NULL, 'West Delhi', '9', 'active', '2025-04-17 09:51:57', '2025-04-17 09:51:57'),
(521, NULL, 'Aldona', '10', 'active', '2025-04-17 09:51:57', '2025-04-17 09:51:57'),
(522, NULL, 'Arambol', '10', 'active', '2025-04-17 09:51:57', '2025-04-17 09:51:57'),
(523, NULL, 'Baga', '10', 'active', '2025-04-17 09:51:57', '2025-04-17 09:51:57'),
(524, NULL, 'Bambolim', '10', 'active', '2025-04-17 09:51:57', '2025-04-17 09:51:57'),
(525, NULL, 'Bandora', '10', 'active', '2025-04-17 09:51:57', '2025-04-17 09:51:57'),
(526, NULL, 'Benaulim', '10', 'active', '2025-04-17 09:51:57', '2025-04-17 09:51:57'),
(527, NULL, 'Calangute', '10', 'active', '2025-04-17 09:51:57', '2025-04-17 09:51:57'),
(528, NULL, 'Candolim', '10', 'active', '2025-04-17 09:51:57', '2025-04-17 09:51:57'),
(529, NULL, 'Carapur', '10', 'active', '2025-04-17 09:51:57', '2025-04-17 09:51:57'),
(530, NULL, 'Cavelossim', '10', 'active', '2025-04-17 09:51:57', '2025-04-17 09:51:57'),
(531, NULL, 'Chicalim', '10', 'active', '2025-04-17 09:51:57', '2025-04-17 09:51:57'),
(532, NULL, 'Chinchinim', '10', 'active', '2025-04-17 09:51:57', '2025-04-17 09:51:57'),
(533, NULL, 'Colovale', '10', 'active', '2025-04-17 09:51:57', '2025-04-17 09:51:57'),
(534, NULL, 'Colva', '10', 'active', '2025-04-17 09:51:57', '2025-04-17 09:51:57'),
(535, NULL, 'Cortalim', '10', 'active', '2025-04-17 09:51:57', '2025-04-17 09:51:57'),
(536, NULL, 'Cuncolim', '10', 'active', '2025-04-17 09:51:57', '2025-04-17 09:51:57'),
(537, NULL, 'Curchorem', '10', 'active', '2025-04-17 09:51:57', '2025-04-17 09:51:57'),
(538, NULL, 'Curti', '10', 'active', '2025-04-17 09:51:57', '2025-04-17 09:51:57'),
(539, NULL, 'Davorlim', '10', 'active', '2025-04-17 09:51:57', '2025-04-17 09:51:57'),
(540, NULL, 'Dicholi', '10', 'active', '2025-04-17 09:51:57', '2025-04-17 09:51:57'),
(541, NULL, 'Goa Velha', '10', 'active', '2025-04-17 09:51:57', '2025-04-17 09:51:57'),
(542, NULL, 'Guirim', '10', 'active', '2025-04-17 09:51:57', '2025-04-17 09:51:57'),
(543, NULL, 'Jua', '10', 'active', '2025-04-17 09:51:57', '2025-04-17 09:51:57'),
(544, NULL, 'Kankon', '10', 'active', '2025-04-17 09:51:57', '2025-04-17 09:51:57'),
(545, NULL, 'Madgaon', '10', 'active', '2025-04-17 09:51:57', '2025-04-17 09:51:57'),
(546, NULL, 'Mapuca', '10', 'active', '2025-04-17 09:51:57', '2025-04-17 09:51:57'),
(547, NULL, 'Morjim', '10', 'active', '2025-04-17 09:51:57', '2025-04-17 09:51:57'),
(548, NULL, 'Mormugao', '10', 'active', '2025-04-17 09:51:57', '2025-04-17 09:51:57'),
(549, NULL, 'Navelim', '10', 'active', '2025-04-17 09:51:57', '2025-04-17 09:51:57'),
(550, NULL, 'North Goa', '10', 'active', '2025-04-17 09:51:57', '2025-04-17 09:51:57'),
(551, NULL, 'Palle', '10', 'active', '2025-04-17 09:51:57', '2025-04-17 09:51:57'),
(552, NULL, 'Panaji', '10', 'active', '2025-04-17 09:51:57', '2025-04-17 09:51:57'),
(553, NULL, 'Pernem', '10', 'active', '2025-04-17 09:51:57', '2025-04-17 09:51:57'),
(554, NULL, 'Ponda', '10', 'active', '2025-04-17 09:51:57', '2025-04-17 09:51:57'),
(555, NULL, 'Quepem', '10', 'active', '2025-04-17 09:51:57', '2025-04-17 09:51:57'),
(556, NULL, 'Queula', '10', 'active', '2025-04-17 09:51:57', '2025-04-17 09:51:57'),
(557, NULL, 'Raia', '10', 'active', '2025-04-17 09:51:57', '2025-04-17 09:51:57'),
(558, NULL, 'Saligao', '10', 'active', '2025-04-17 09:51:57', '2025-04-17 09:51:57'),
(559, NULL, 'Sancoale', '10', 'active', '2025-04-17 09:51:57', '2025-04-17 09:51:57'),
(560, NULL, 'Sanguem', '10', 'active', '2025-04-17 09:51:57', '2025-04-17 09:51:57'),
(561, NULL, 'Sanquelim', '10', 'active', '2025-04-17 09:51:57', '2025-04-17 09:51:57'),
(562, NULL, 'Sanvordem', '10', 'active', '2025-04-17 09:51:57', '2025-04-17 09:51:57'),
(563, NULL, 'Serula', '10', 'active', '2025-04-17 09:51:57', '2025-04-17 09:51:57'),
(564, NULL, 'Solim', '10', 'active', '2025-04-17 09:51:57', '2025-04-17 09:51:57'),
(565, NULL, 'South Goa', '10', 'active', '2025-04-17 09:51:57', '2025-04-17 09:51:57'),
(566, NULL, 'Taleigao', '10', 'active', '2025-04-17 09:51:57', '2025-04-17 09:51:57'),
(567, NULL, 'Vagator', '10', 'active', '2025-04-17 09:51:57', '2025-04-17 09:51:57'),
(568, NULL, 'Valpoy', '10', 'active', '2025-04-17 09:51:57', '2025-04-17 09:51:57'),
(569, NULL, 'Varca', '10', 'active', '2025-04-17 09:51:57', '2025-04-17 09:51:57'),
(570, NULL, 'Vasco da Gama', '10', 'active', '2025-04-17 09:51:57', '2025-04-17 09:51:57'),
(571, NULL, 'Abrama', '11', 'active', '2025-04-17 09:51:57', '2025-04-17 09:51:57'),
(572, NULL, 'Adalaj', '11', 'active', '2025-04-17 09:51:57', '2025-04-17 09:51:57'),
(573, NULL, 'Agol', '11', 'active', '2025-04-17 09:51:57', '2025-04-17 09:51:57'),
(574, NULL, 'Ahmedabad', '11', 'active', '2025-04-17 09:51:57', '2025-04-17 09:51:57'),
(575, NULL, 'Ahwa', '11', 'active', '2025-04-17 09:51:57', '2025-04-17 09:51:57'),
(576, NULL, 'Akrund', '11', 'active', '2025-04-17 09:51:57', '2025-04-17 09:51:57'),
(577, NULL, 'Amod', '11', 'active', '2025-04-17 09:51:57', '2025-04-17 09:51:57'),
(578, NULL, 'Amreli', '11', 'active', '2025-04-17 09:51:57', '2025-04-17 09:51:57'),
(579, NULL, 'Amroli', '11', 'active', '2025-04-17 09:51:57', '2025-04-17 09:51:57'),
(580, NULL, 'Anand', '11', 'active', '2025-04-17 09:51:57', '2025-04-17 09:51:57'),
(581, NULL, 'Anjar', '11', 'active', '2025-04-17 09:51:57', '2025-04-17 09:51:57'),
(582, NULL, 'Ankleshwar', '11', 'active', '2025-04-17 09:51:57', '2025-04-17 09:51:57'),
(583, NULL, 'Babra', '11', 'active', '2025-04-17 09:51:57', '2025-04-17 09:51:57'),
(584, NULL, 'Bagasara', '11', 'active', '2025-04-17 09:51:57', '2025-04-17 09:51:57'),
(585, NULL, 'Bagasra', '11', 'active', '2025-04-17 09:51:57', '2025-04-17 09:51:57'),
(586, NULL, 'Bakharla', '11', 'active', '2025-04-17 09:51:57', '2025-04-17 09:51:57'),
(587, NULL, 'Balagam', '11', 'active', '2025-04-17 09:51:57', '2025-04-17 09:51:57'),
(588, NULL, 'Balasinor', '11', 'active', '2025-04-17 09:51:57', '2025-04-17 09:51:57'),
(589, NULL, 'Balisana', '11', 'active', '2025-04-17 09:51:57', '2025-04-17 09:51:57'),
(590, NULL, 'Bamanbore', '11', 'active', '2025-04-17 09:51:57', '2025-04-17 09:51:57'),
(591, NULL, 'Banas Kantha', '11', 'active', '2025-04-17 09:51:57', '2025-04-17 09:51:57');
INSERT INTO `module_cities` (`id`, `slug`, `city_name`, `state_name`, `status`, `created_at`, `updated_at`) VALUES
(592, NULL, 'Bandia', '11', 'active', '2025-04-17 09:51:57', '2025-04-17 09:51:57'),
(593, NULL, 'Bantva', '11', 'active', '2025-04-17 09:51:57', '2025-04-17 09:51:57'),
(594, NULL, 'Bardoli', '11', 'active', '2025-04-17 09:51:57', '2025-04-17 09:51:57'),
(595, NULL, 'Bavla', '11', 'active', '2025-04-17 09:51:57', '2025-04-17 09:51:57'),
(596, NULL, 'Bedi', '11', 'active', '2025-04-17 09:51:57', '2025-04-17 09:51:57'),
(597, NULL, 'Bhachau', '11', 'active', '2025-04-17 09:51:57', '2025-04-17 09:51:57'),
(598, NULL, 'Bhadran', '11', 'active', '2025-04-17 09:51:57', '2025-04-17 09:51:57'),
(599, NULL, 'Bhandu', '11', 'active', '2025-04-17 09:51:57', '2025-04-17 09:51:57'),
(600, NULL, 'Bhanvad', '11', 'active', '2025-04-17 09:51:57', '2025-04-17 09:51:57'),
(601, NULL, 'Bharuch', '11', 'active', '2025-04-17 09:51:57', '2025-04-17 09:51:57'),
(602, NULL, 'Bhatha', '11', 'active', '2025-04-17 09:51:57', '2025-04-17 09:51:57'),
(603, NULL, 'Bhavnagar', '11', 'active', '2025-04-17 09:51:57', '2025-04-17 09:51:57'),
(604, NULL, 'Bhayavadar', '11', 'active', '2025-04-17 09:51:57', '2025-04-17 09:51:57'),
(605, NULL, 'Bhildi', '11', 'active', '2025-04-17 09:51:57', '2025-04-17 09:51:57'),
(606, NULL, 'Bhojpur Dharampur', '11', 'active', '2025-04-17 09:51:57', '2025-04-17 09:51:57'),
(607, NULL, 'Bhuj', '11', 'active', '2025-04-17 09:51:57', '2025-04-17 09:51:57'),
(608, NULL, 'Bilimora', '11', 'active', '2025-04-17 09:51:57', '2025-04-17 09:51:57'),
(609, NULL, 'Bilkha', '11', 'active', '2025-04-17 09:51:57', '2025-04-17 09:51:57'),
(610, NULL, 'Borsad', '11', 'active', '2025-04-17 09:51:57', '2025-04-17 09:51:57'),
(611, NULL, 'Botad', '11', 'active', '2025-04-17 09:51:57', '2025-04-17 09:51:57'),
(612, NULL, 'Chaklasi', '11', 'active', '2025-04-17 09:51:57', '2025-04-17 09:51:57'),
(613, NULL, 'Chalala', '11', 'active', '2025-04-17 09:51:57', '2025-04-17 09:51:57'),
(614, NULL, 'Chaloda', '11', 'active', '2025-04-17 09:51:57', '2025-04-17 09:51:57'),
(615, NULL, 'Champaner', '11', 'active', '2025-04-17 09:51:57', '2025-04-17 09:51:57'),
(616, NULL, 'Chanasma', '11', 'active', '2025-04-17 09:51:57', '2025-04-17 09:51:57'),
(617, NULL, 'Chhala', '11', 'active', '2025-04-17 09:51:57', '2025-04-17 09:51:57'),
(618, NULL, 'Chhota Udepur', '11', 'active', '2025-04-17 09:51:57', '2025-04-17 09:51:57'),
(619, NULL, 'Chikhli', '11', 'active', '2025-04-17 09:51:57', '2025-04-17 09:51:57'),
(620, NULL, 'Chotila', '11', 'active', '2025-04-17 09:51:57', '2025-04-17 09:51:57'),
(621, NULL, 'Chuda', '11', 'active', '2025-04-17 09:51:57', '2025-04-17 09:51:57'),
(622, NULL, 'Dabhoda', '11', 'active', '2025-04-17 09:51:57', '2025-04-17 09:51:57'),
(623, NULL, 'Dabhoi', '11', 'active', '2025-04-17 09:51:57', '2025-04-17 09:51:57'),
(624, NULL, 'Dahegam', '11', 'active', '2025-04-17 09:51:57', '2025-04-17 09:51:57'),
(625, NULL, 'Dahod', '11', 'active', '2025-04-17 09:51:57', '2025-04-17 09:51:57'),
(626, NULL, 'Dakor', '11', 'active', '2025-04-17 09:51:57', '2025-04-17 09:51:57'),
(627, NULL, 'Damnagar', '11', 'active', '2025-04-17 09:51:57', '2025-04-17 09:51:57'),
(628, NULL, 'Dandi', '11', 'active', '2025-04-17 09:51:57', '2025-04-17 09:51:57'),
(629, NULL, 'Dangs (India)', '11', 'active', '2025-04-17 09:51:57', '2025-04-17 09:51:57'),
(630, NULL, 'Danta', '11', 'active', '2025-04-17 09:51:57', '2025-04-17 09:51:57'),
(631, NULL, 'Dayapar', '11', 'active', '2025-04-17 09:51:57', '2025-04-17 09:51:57'),
(632, NULL, 'Delvada', '11', 'active', '2025-04-17 09:51:57', '2025-04-17 09:51:57'),
(633, NULL, 'Delwada', '11', 'active', '2025-04-17 09:51:57', '2025-04-17 09:51:57'),
(634, NULL, 'Detroj', '11', 'active', '2025-04-17 09:51:57', '2025-04-17 09:51:57'),
(635, NULL, 'Devbhumi Dwarka', '11', 'active', '2025-04-17 09:51:57', '2025-04-17 09:51:57'),
(636, NULL, 'Devgadh Bariya', '11', 'active', '2025-04-17 09:51:57', '2025-04-17 09:51:57'),
(637, NULL, 'Dhandhuka', '11', 'active', '2025-04-17 09:51:57', '2025-04-17 09:51:57'),
(638, NULL, 'Dhanera', '11', 'active', '2025-04-17 09:51:57', '2025-04-17 09:51:57'),
(639, NULL, 'Dhansura', '11', 'active', '2025-04-17 09:51:57', '2025-04-17 09:51:57'),
(640, NULL, 'Dharampur', '11', 'active', '2025-04-17 09:51:57', '2025-04-17 09:51:57'),
(641, NULL, 'Dharasana', '11', 'active', '2025-04-17 09:51:57', '2025-04-17 09:51:57'),
(642, NULL, 'Dhari', '11', 'active', '2025-04-17 09:51:57', '2025-04-17 09:51:57'),
(643, NULL, 'Dhasa', '11', 'active', '2025-04-17 09:51:57', '2025-04-17 09:51:57'),
(644, NULL, 'Dhola', '11', 'active', '2025-04-17 09:51:57', '2025-04-17 09:51:57'),
(645, NULL, 'Dholera', '11', 'active', '2025-04-17 09:51:57', '2025-04-17 09:51:57'),
(646, NULL, 'Dholka', '11', 'active', '2025-04-17 09:51:57', '2025-04-17 09:51:57'),
(647, NULL, 'Dhoraji', '11', 'active', '2025-04-17 09:51:57', '2025-04-17 09:51:57'),
(648, NULL, 'Dhrangadhra', '11', 'active', '2025-04-17 09:51:57', '2025-04-17 09:51:57'),
(649, NULL, 'Dhrol', '11', 'active', '2025-04-17 09:51:57', '2025-04-17 09:51:57'),
(650, NULL, 'Dhuwaran', '11', 'active', '2025-04-17 09:51:57', '2025-04-17 09:51:57'),
(651, NULL, 'Disa', '11', 'active', '2025-04-17 09:51:57', '2025-04-17 09:51:57'),
(652, NULL, 'Dohad', '11', 'active', '2025-04-17 09:51:57', '2025-04-17 09:51:57'),
(653, NULL, 'Dumkhal', '11', 'active', '2025-04-17 09:51:57', '2025-04-17 09:51:57'),
(654, NULL, 'Dungarpur', '11', 'active', '2025-04-17 09:51:57', '2025-04-17 09:51:57'),
(655, NULL, 'Dwarka', '11', 'active', '2025-04-17 09:51:57', '2025-04-17 09:51:57'),
(656, NULL, 'Gadhada', '11', 'active', '2025-04-17 09:51:57', '2025-04-17 09:51:57'),
(657, NULL, 'Gandevi', '11', 'active', '2025-04-17 09:51:57', '2025-04-17 09:51:57'),
(658, NULL, 'Gandhidham', '11', 'active', '2025-04-17 09:51:57', '2025-04-17 09:51:57'),
(659, NULL, 'Gandhinagar', '11', 'active', '2025-04-17 09:51:57', '2025-04-17 09:51:57'),
(660, NULL, 'Gariadhar', '11', 'active', '2025-04-17 09:51:57', '2025-04-17 09:51:57'),
(661, NULL, 'Ghodasar', '11', 'active', '2025-04-17 09:51:57', '2025-04-17 09:51:57'),
(662, NULL, 'Ghogha', '11', 'active', '2025-04-17 09:51:57', '2025-04-17 09:51:57'),
(663, NULL, 'Gir Somnath', '11', 'active', '2025-04-17 09:51:57', '2025-04-17 09:51:57'),
(664, NULL, 'Godhra', '11', 'active', '2025-04-17 09:51:57', '2025-04-17 09:51:57'),
(665, NULL, 'Gondal', '11', 'active', '2025-04-17 09:51:57', '2025-04-17 09:51:57'),
(666, NULL, 'Gorwa', '11', 'active', '2025-04-17 09:51:57', '2025-04-17 09:51:57'),
(667, NULL, 'Halenda', '11', 'active', '2025-04-17 09:51:57', '2025-04-17 09:51:57'),
(668, NULL, 'Halol', '11', 'active', '2025-04-17 09:51:57', '2025-04-17 09:51:57'),
(669, NULL, 'Halvad', '11', 'active', '2025-04-17 09:51:57', '2025-04-17 09:51:57'),
(670, NULL, 'Hansot', '11', 'active', '2025-04-17 09:51:57', '2025-04-17 09:51:57'),
(671, NULL, 'Harij', '11', 'active', '2025-04-17 09:51:57', '2025-04-17 09:51:57'),
(672, NULL, 'Harsol', '11', 'active', '2025-04-17 09:51:57', '2025-04-17 09:51:57'),
(673, NULL, 'Hathuran', '11', 'active', '2025-04-17 09:51:57', '2025-04-17 09:51:57'),
(674, NULL, 'Himatnagar', '11', 'active', '2025-04-17 09:51:57', '2025-04-17 09:51:57'),
(675, NULL, 'Idar', '11', 'active', '2025-04-17 09:51:57', '2025-04-17 09:51:57'),
(676, NULL, 'Jakhau', '11', 'active', '2025-04-17 09:51:57', '2025-04-17 09:51:57'),
(677, NULL, 'Jalalpore', '11', 'active', '2025-04-17 09:51:57', '2025-04-17 09:51:57'),
(678, NULL, 'Jalalpur', '11', 'active', '2025-04-17 09:51:57', '2025-04-17 09:51:57'),
(679, NULL, 'Jalia', '11', 'active', '2025-04-17 09:51:57', '2025-04-17 09:51:57'),
(680, NULL, 'Jambuda', '11', 'active', '2025-04-17 09:51:57', '2025-04-17 09:51:57'),
(681, NULL, 'Jambusar', '11', 'active', '2025-04-17 09:51:57', '2025-04-17 09:51:57'),
(682, NULL, 'Jamnagar', '11', 'active', '2025-04-17 09:51:57', '2025-04-17 09:51:57'),
(683, NULL, 'Jarod', '11', 'active', '2025-04-17 09:51:57', '2025-04-17 09:51:57'),
(684, NULL, 'Jasdan', '11', 'active', '2025-04-17 09:51:57', '2025-04-17 09:51:57'),
(685, NULL, 'Jetalpur', '11', 'active', '2025-04-17 09:51:57', '2025-04-17 09:51:57'),
(686, NULL, 'Jetalsar', '11', 'active', '2025-04-17 09:51:57', '2025-04-17 09:51:57'),
(687, NULL, 'Jetpur', '11', 'active', '2025-04-17 09:51:57', '2025-04-17 09:51:57'),
(688, NULL, 'Jetpur (Navagadh)', '11', 'active', '2025-04-17 09:51:57', '2025-04-17 09:51:57'),
(689, NULL, 'Jhalod', '11', 'active', '2025-04-17 09:51:57', '2025-04-17 09:51:57'),
(690, NULL, 'Jhulasan', '11', 'active', '2025-04-17 09:51:57', '2025-04-17 09:51:57'),
(691, NULL, 'Jodhpur', '11', 'active', '2025-04-17 09:51:57', '2025-04-17 09:51:57'),
(692, NULL, 'Jodhpur (Ahmedabad)', '11', 'active', '2025-04-17 09:51:57', '2025-04-17 09:51:57'),
(693, NULL, 'Jodia', '11', 'active', '2025-04-17 09:51:57', '2025-04-17 09:51:57'),
(694, NULL, 'Jodiya Bandar', '11', 'active', '2025-04-17 09:51:57', '2025-04-17 09:51:57'),
(695, NULL, 'Junagadh', '11', 'active', '2025-04-17 09:51:57', '2025-04-17 09:51:57'),
(696, NULL, 'Kachchh', '11', 'active', '2025-04-17 09:51:57', '2025-04-17 09:51:57'),
(697, NULL, 'Kachholi', '11', 'active', '2025-04-17 09:51:57', '2025-04-17 09:51:57'),
(698, NULL, 'Kadi', '11', 'active', '2025-04-17 09:51:57', '2025-04-17 09:51:57'),
(699, NULL, 'Kadod', '11', 'active', '2025-04-17 09:51:57', '2025-04-17 09:51:57'),
(700, NULL, 'Kalavad', '11', 'active', '2025-04-17 09:51:57', '2025-04-17 09:51:57'),
(701, NULL, 'Kalol', '11', 'active', '2025-04-17 09:51:57', '2025-04-17 09:51:57'),
(702, NULL, 'Kandla', '11', 'active', '2025-04-17 09:51:57', '2025-04-17 09:51:57'),
(703, NULL, 'Kandla port', '11', 'active', '2025-04-17 09:51:57', '2025-04-17 09:51:57'),
(704, NULL, 'Kanodar', '11', 'active', '2025-04-17 09:51:57', '2025-04-17 09:51:57'),
(705, NULL, 'Kapadvanj', '11', 'active', '2025-04-17 09:51:57', '2025-04-17 09:51:57'),
(706, NULL, 'Karamsad', '11', 'active', '2025-04-17 09:51:57', '2025-04-17 09:51:57'),
(707, NULL, 'Kariana', '11', 'active', '2025-04-17 09:51:57', '2025-04-17 09:51:57'),
(708, NULL, 'Karjan', '11', 'active', '2025-04-17 09:51:57', '2025-04-17 09:51:57'),
(709, NULL, 'Kathor', '11', 'active', '2025-04-17 09:51:57', '2025-04-17 09:51:57'),
(710, NULL, 'Katpur', '11', 'active', '2025-04-17 09:51:57', '2025-04-17 09:51:57'),
(711, NULL, 'Kawant', '11', 'active', '2025-04-17 09:51:57', '2025-04-17 09:51:57'),
(712, NULL, 'Kayavarohan', '11', 'active', '2025-04-17 09:51:57', '2025-04-17 09:51:57'),
(713, NULL, 'Kerwada', '11', 'active', '2025-04-17 09:51:57', '2025-04-17 09:51:57'),
(714, NULL, 'Keshod', '11', 'active', '2025-04-17 09:51:57', '2025-04-17 09:51:57'),
(715, NULL, 'Khambhalia', '11', 'active', '2025-04-17 09:51:57', '2025-04-17 09:51:57'),
(716, NULL, 'Khambhat', '11', 'active', '2025-04-17 09:51:57', '2025-04-17 09:51:57'),
(717, NULL, 'Khavda', '11', 'active', '2025-04-17 09:51:57', '2025-04-17 09:51:57'),
(718, NULL, 'Kheda', '11', 'active', '2025-04-17 09:51:57', '2025-04-17 09:51:57'),
(719, NULL, 'Khedbrahma', '11', 'active', '2025-04-17 09:51:57', '2025-04-17 09:51:57'),
(720, NULL, 'Khedoi', '11', 'active', '2025-04-17 09:51:57', '2025-04-17 09:51:57'),
(721, NULL, 'Kherali', '11', 'active', '2025-04-17 09:51:57', '2025-04-17 09:51:57'),
(722, NULL, 'Kheralu', '11', 'active', '2025-04-17 09:51:57', '2025-04-17 09:51:57'),
(723, NULL, 'Kodinar', '11', 'active', '2025-04-17 09:51:57', '2025-04-17 09:51:57'),
(724, NULL, 'Kosamba', '11', 'active', '2025-04-17 09:51:57', '2025-04-17 09:51:57'),
(725, NULL, 'Kothara', '11', 'active', '2025-04-17 09:51:57', '2025-04-17 09:51:57'),
(726, NULL, 'Kotharia', '11', 'active', '2025-04-17 09:51:57', '2025-04-17 09:51:57'),
(727, NULL, 'Kukarmunda', '11', 'active', '2025-04-17 09:51:57', '2025-04-17 09:51:57'),
(728, NULL, 'Kukma', '11', 'active', '2025-04-17 09:51:57', '2025-04-17 09:51:57'),
(729, NULL, 'Kundla', '11', 'active', '2025-04-17 09:51:57', '2025-04-17 09:51:57'),
(730, NULL, 'Kutch district', '11', 'active', '2025-04-17 09:51:57', '2025-04-17 09:51:57'),
(731, NULL, 'Kutiyana', '11', 'active', '2025-04-17 09:51:57', '2025-04-17 09:51:57'),
(732, NULL, 'Ladol', '11', 'active', '2025-04-17 09:51:57', '2025-04-17 09:51:57'),
(733, NULL, 'Lakhpat', '11', 'active', '2025-04-17 09:51:57', '2025-04-17 09:51:57'),
(734, NULL, 'Lakhtar', '11', 'active', '2025-04-17 09:51:57', '2025-04-17 09:51:57'),
(735, NULL, 'Lalpur', '11', 'active', '2025-04-17 09:51:57', '2025-04-17 09:51:57'),
(736, NULL, 'Langhnaj', '11', 'active', '2025-04-17 09:51:57', '2025-04-17 09:51:57'),
(737, NULL, 'Lathi', '11', 'active', '2025-04-17 09:51:57', '2025-04-17 09:51:57'),
(738, NULL, 'Limbdi', '11', 'active', '2025-04-17 09:51:57', '2025-04-17 09:51:57'),
(739, NULL, 'Limkheda', '11', 'active', '2025-04-17 09:51:57', '2025-04-17 09:51:57'),
(740, NULL, 'Lunavada', '11', 'active', '2025-04-17 09:51:57', '2025-04-17 09:51:57'),
(741, NULL, 'Madhavpur Ghed', '11', 'active', '2025-04-17 09:51:57', '2025-04-17 09:51:57'),
(742, NULL, 'Madhi', '11', 'active', '2025-04-17 09:51:57', '2025-04-17 09:51:57'),
(743, NULL, 'Mahemdavad', '11', 'active', '2025-04-17 09:51:57', '2025-04-17 09:51:57'),
(744, NULL, 'Mahesana', '11', 'active', '2025-04-17 09:51:57', '2025-04-17 09:51:57'),
(745, NULL, 'Mahisa', '11', 'active', '2025-04-17 09:51:57', '2025-04-17 09:51:57'),
(746, NULL, 'Mahudha', '11', 'active', '2025-04-17 09:51:57', '2025-04-17 09:51:57'),
(747, NULL, 'Mahuva', '11', 'active', '2025-04-17 09:51:57', '2025-04-17 09:51:57'),
(748, NULL, 'Mahuva (Surat)', '11', 'active', '2025-04-17 09:51:57', '2025-04-17 09:51:57'),
(749, NULL, 'Malpur', '11', 'active', '2025-04-17 09:51:57', '2025-04-17 09:51:57'),
(750, NULL, 'Manavadar', '11', 'active', '2025-04-17 09:51:57', '2025-04-17 09:51:57'),
(751, NULL, 'Mandal', '11', 'active', '2025-04-17 09:51:57', '2025-04-17 09:51:57'),
(752, NULL, 'Mandvi', '11', 'active', '2025-04-17 09:51:57', '2025-04-17 09:51:57'),
(753, NULL, 'Mandvi (Surat)', '11', 'active', '2025-04-17 09:51:57', '2025-04-17 09:51:57'),
(754, NULL, 'Mangrol', '11', 'active', '2025-04-17 09:51:57', '2025-04-17 09:51:57'),
(755, NULL, 'Mangrol (Junagadh)', '11', 'active', '2025-04-17 09:51:57', '2025-04-17 09:51:57'),
(756, NULL, 'Mansa', '11', 'active', '2025-04-17 09:51:57', '2025-04-17 09:51:57'),
(757, NULL, 'Meghraj', '11', 'active', '2025-04-17 09:51:57', '2025-04-17 09:51:57'),
(758, NULL, 'Mehsana', '11', 'active', '2025-04-17 09:51:57', '2025-04-17 09:51:57'),
(759, NULL, 'Mendarda', '11', 'active', '2025-04-17 09:51:57', '2025-04-17 09:51:57'),
(760, NULL, 'Mithapur', '11', 'active', '2025-04-17 09:51:57', '2025-04-17 09:51:57'),
(761, NULL, 'Modasa', '11', 'active', '2025-04-17 09:51:57', '2025-04-17 09:51:57'),
(762, NULL, 'Morbi', '11', 'active', '2025-04-17 09:51:57', '2025-04-17 09:51:57'),
(763, NULL, 'Morva (Hadaf)', '11', 'active', '2025-04-17 09:51:57', '2025-04-17 09:51:57'),
(764, NULL, 'Morwa', '11', 'active', '2025-04-17 09:51:57', '2025-04-17 09:51:57'),
(765, NULL, 'Mundra', '11', 'active', '2025-04-17 09:51:57', '2025-04-17 09:51:57'),
(766, NULL, 'Nadiad', '11', 'active', '2025-04-17 09:51:57', '2025-04-17 09:51:57'),
(767, NULL, 'Nagwa', '11', 'active', '2025-04-17 09:51:57', '2025-04-17 09:51:57'),
(768, NULL, 'Naldhara', '11', 'active', '2025-04-17 09:51:57', '2025-04-17 09:51:57'),
(769, NULL, 'Naliya', '11', 'active', '2025-04-17 09:51:57', '2025-04-17 09:51:57'),
(770, NULL, 'Nargol', '11', 'active', '2025-04-17 09:51:57', '2025-04-17 09:51:57'),
(771, NULL, 'Narmada', '11', 'active', '2025-04-17 09:51:57', '2025-04-17 09:51:57'),
(772, NULL, 'Naroda', '11', 'active', '2025-04-17 09:51:57', '2025-04-17 09:51:57'),
(773, NULL, 'Navsari', '11', 'active', '2025-04-17 09:51:57', '2025-04-17 09:51:57'),
(774, NULL, 'Nikora', '11', 'active', '2025-04-17 09:51:57', '2025-04-17 09:51:57'),
(775, NULL, 'Nizar', '11', 'active', '2025-04-17 09:51:57', '2025-04-17 09:51:57'),
(776, NULL, 'Odadar', '11', 'active', '2025-04-17 09:51:57', '2025-04-17 09:51:57'),
(777, NULL, 'Okha', '11', 'active', '2025-04-17 09:51:57', '2025-04-17 09:51:57'),
(778, NULL, 'Olpad', '11', 'active', '2025-04-17 09:51:57', '2025-04-17 09:51:57'),
(779, NULL, 'Paddhari', '11', 'active', '2025-04-17 09:51:57', '2025-04-17 09:51:57'),
(780, NULL, 'Padra', '11', 'active', '2025-04-17 09:51:57', '2025-04-17 09:51:57'),
(781, NULL, 'Palanpur', '11', 'active', '2025-04-17 09:51:57', '2025-04-17 09:51:57'),
(782, NULL, 'Palanswa', '11', 'active', '2025-04-17 09:51:57', '2025-04-17 09:51:57'),
(783, NULL, 'Palitana', '11', 'active', '2025-04-17 09:51:57', '2025-04-17 09:51:57'),
(784, NULL, 'Paliyad', '11', 'active', '2025-04-17 09:51:57', '2025-04-17 09:51:57'),
(785, NULL, 'Palsana', '11', 'active', '2025-04-17 09:51:57', '2025-04-17 09:51:57'),
(786, NULL, 'Panch Mahals', '11', 'active', '2025-04-17 09:51:57', '2025-04-17 09:51:57'),
(787, NULL, 'Panchmahal district', '11', 'active', '2025-04-17 09:51:57', '2025-04-17 09:51:57'),
(788, NULL, 'Pardi', '11', 'active', '2025-04-17 09:51:57', '2025-04-17 09:51:57'),
(789, NULL, 'Parnera', '11', 'active', '2025-04-17 09:51:57', '2025-04-17 09:51:57'),
(790, NULL, 'Patan', '11', 'active', '2025-04-17 09:51:57', '2025-04-17 09:51:57'),
(791, NULL, 'Pavi Jetpur', '11', 'active', '2025-04-17 09:51:57', '2025-04-17 09:51:57'),
(792, NULL, 'Petlad', '11', 'active', '2025-04-17 09:51:57', '2025-04-17 09:51:57'),
(793, NULL, 'Pipavav', '11', 'active', '2025-04-17 09:51:57', '2025-04-17 09:51:57'),
(794, NULL, 'Piplod', '11', 'active', '2025-04-17 09:51:57', '2025-04-17 09:51:57'),
(795, NULL, 'Porbandar', '11', 'active', '2025-04-17 09:51:57', '2025-04-17 09:51:57'),
(796, NULL, 'Prabhas Patan', '11', 'active', '2025-04-17 09:51:57', '2025-04-17 09:51:57'),
(797, NULL, 'Prantij', '11', 'active', '2025-04-17 09:51:57', '2025-04-17 09:51:57'),
(798, NULL, 'Radhanpur', '11', 'active', '2025-04-17 09:51:57', '2025-04-17 09:51:57'),
(799, NULL, 'Rajkot', '11', 'active', '2025-04-17 09:51:57', '2025-04-17 09:51:57'),
(800, NULL, 'Rajpipla', '11', 'active', '2025-04-17 09:51:57', '2025-04-17 09:51:57'),
(801, NULL, 'Rajula', '11', 'active', '2025-04-17 09:51:57', '2025-04-17 09:51:57'),
(802, NULL, 'Ranavav', '11', 'active', '2025-04-17 09:51:57', '2025-04-17 09:51:57'),
(803, NULL, 'Ranpur', '11', 'active', '2025-04-17 09:51:57', '2025-04-17 09:51:57'),
(804, NULL, 'Rapar', '11', 'active', '2025-04-17 09:51:57', '2025-04-17 09:51:57'),
(805, NULL, 'Reha', '11', 'active', '2025-04-17 09:51:57', '2025-04-17 09:51:57'),
(806, NULL, 'Roha', '11', 'active', '2025-04-17 09:51:57', '2025-04-17 09:51:57'),
(807, NULL, 'Sabar Kantha', '11', 'active', '2025-04-17 09:51:57', '2025-04-17 09:51:57'),
(808, NULL, 'Sachin', '11', 'active', '2025-04-17 09:51:57', '2025-04-17 09:51:57'),
(809, NULL, 'Salaya', '11', 'active', '2025-04-17 09:51:57', '2025-04-17 09:51:57'),
(810, NULL, 'Samakhiali', '11', 'active', '2025-04-17 09:51:57', '2025-04-17 09:51:57'),
(811, NULL, 'Sanand', '11', 'active', '2025-04-17 09:51:57', '2025-04-17 09:51:57'),
(812, NULL, 'Sankheda', '11', 'active', '2025-04-17 09:51:57', '2025-04-17 09:51:57'),
(813, NULL, 'Sarbhon', '11', 'active', '2025-04-17 09:51:57', '2025-04-17 09:51:57'),
(814, NULL, 'Sardoi', '11', 'active', '2025-04-17 09:51:57', '2025-04-17 09:51:57'),
(815, NULL, 'Sarkhej', '11', 'active', '2025-04-17 09:51:57', '2025-04-17 09:51:57'),
(816, NULL, 'Sathamba', '11', 'active', '2025-04-17 09:51:57', '2025-04-17 09:51:57'),
(817, NULL, 'Savarkundla', '11', 'active', '2025-04-17 09:51:57', '2025-04-17 09:51:57'),
(818, NULL, 'Savli', '11', 'active', '2025-04-17 09:51:57', '2025-04-17 09:51:57'),
(819, NULL, 'Sayla', '11', 'active', '2025-04-17 09:51:57', '2025-04-17 09:51:57'),
(820, NULL, 'Shahpur', '11', 'active', '2025-04-17 09:51:57', '2025-04-17 09:51:57'),
(821, NULL, 'Shivrajpur', '11', 'active', '2025-04-17 09:51:57', '2025-04-17 09:51:57'),
(822, NULL, 'Siddhpur', '11', 'active', '2025-04-17 09:51:57', '2025-04-17 09:51:57'),
(823, NULL, 'Sihor', '11', 'active', '2025-04-17 09:51:57', '2025-04-17 09:51:57'),
(824, NULL, 'Sikka', '11', 'active', '2025-04-17 09:51:57', '2025-04-17 09:51:57'),
(825, NULL, 'Sinor', '11', 'active', '2025-04-17 09:51:57', '2025-04-17 09:51:57'),
(826, NULL, 'Sojitra', '11', 'active', '2025-04-17 09:51:57', '2025-04-17 09:51:57'),
(827, NULL, 'Songadh', '11', 'active', '2025-04-17 09:51:57', '2025-04-17 09:51:57'),
(828, NULL, 'Supedi', '11', 'active', '2025-04-17 09:51:57', '2025-04-17 09:51:57'),
(829, NULL, 'Surat', '11', 'active', '2025-04-17 09:51:57', '2025-04-17 09:51:57'),
(830, NULL, 'Surendranagar', '11', 'active', '2025-04-17 09:51:57', '2025-04-17 09:51:57'),
(831, NULL, 'Sutrapada', '11', 'active', '2025-04-17 09:51:57', '2025-04-17 09:51:57'),
(832, NULL, 'Talaja', '11', 'active', '2025-04-17 09:51:57', '2025-04-17 09:51:57'),
(833, NULL, 'Tankara', '11', 'active', '2025-04-17 09:51:57', '2025-04-17 09:51:57'),
(834, NULL, 'Tapi', '11', 'active', '2025-04-17 09:51:57', '2025-04-17 09:51:57'),
(835, NULL, 'Than', '11', 'active', '2025-04-17 09:51:57', '2025-04-17 09:51:57'),
(836, NULL, 'Thangadh', '11', 'active', '2025-04-17 09:51:57', '2025-04-17 09:51:57'),
(837, NULL, 'Tharad', '11', 'active', '2025-04-17 09:51:57', '2025-04-17 09:51:57'),
(838, NULL, 'Thasra', '11', 'active', '2025-04-17 09:51:57', '2025-04-17 09:51:57'),
(839, NULL, 'The Dangs', '11', 'active', '2025-04-17 09:51:57', '2025-04-17 09:51:57'),
(840, NULL, 'Umarpada', '11', 'active', '2025-04-17 09:51:57', '2025-04-17 09:51:57'),
(841, NULL, 'Umrala', '11', 'active', '2025-04-17 09:51:57', '2025-04-17 09:51:57'),
(842, NULL, 'Umreth', '11', 'active', '2025-04-17 09:51:57', '2025-04-17 09:51:57'),
(843, NULL, 'Un', '11', 'active', '2025-04-17 09:51:57', '2025-04-17 09:51:57'),
(844, NULL, 'Una', '11', 'active', '2025-04-17 09:51:57', '2025-04-17 09:51:57'),
(845, NULL, 'Unjha', '11', 'active', '2025-04-17 09:51:57', '2025-04-17 09:51:57'),
(846, NULL, 'Upleta', '11', 'active', '2025-04-17 09:51:57', '2025-04-17 09:51:57'),
(847, NULL, 'Utran', '11', 'active', '2025-04-17 09:51:57', '2025-04-17 09:51:57'),
(848, NULL, 'Vadgam', '11', 'active', '2025-04-17 09:51:57', '2025-04-17 09:51:57'),
(849, NULL, 'Vadnagar', '11', 'active', '2025-04-17 09:51:57', '2025-04-17 09:51:57'),
(850, NULL, 'Vadodara', '11', 'active', '2025-04-17 09:51:57', '2025-04-17 09:51:57'),
(851, NULL, 'Vaghodia', '11', 'active', '2025-04-17 09:51:57', '2025-04-17 09:51:57'),
(852, NULL, 'Vaghodia INA', '11', 'active', '2025-04-17 09:51:57', '2025-04-17 09:51:57'),
(853, NULL, 'Vallabh Vidyanagar', '11', 'active', '2025-04-17 09:51:57', '2025-04-17 09:51:57'),
(854, NULL, 'Vallabhipur', '11', 'active', '2025-04-17 09:51:57', '2025-04-17 09:51:57'),
(855, NULL, 'Valsad', '11', 'active', '2025-04-17 09:51:57', '2025-04-17 09:51:57'),
(856, NULL, 'Vanala', '11', 'active', '2025-04-17 09:51:57', '2025-04-17 09:51:57'),
(857, NULL, 'Vansda', '11', 'active', '2025-04-17 09:51:57', '2025-04-17 09:51:57'),
(858, NULL, 'Vanthli', '11', 'active', '2025-04-17 09:51:57', '2025-04-17 09:51:57'),
(859, NULL, 'Vapi', '11', 'active', '2025-04-17 09:51:57', '2025-04-17 09:51:57'),
(860, NULL, 'Vartej', '11', 'active', '2025-04-17 09:51:57', '2025-04-17 09:51:57'),
(861, NULL, 'Vasa', '11', 'active', '2025-04-17 09:51:57', '2025-04-17 09:51:57'),
(862, NULL, 'Vasavad', '11', 'active', '2025-04-17 09:51:57', '2025-04-17 09:51:57'),
(863, NULL, 'Vaso', '11', 'active', '2025-04-17 09:51:57', '2025-04-17 09:51:57'),
(864, NULL, 'Vataman', '11', 'active', '2025-04-17 09:51:57', '2025-04-17 09:51:57'),
(865, NULL, 'Vejalpur', '11', 'active', '2025-04-17 09:51:57', '2025-04-17 09:51:57'),
(866, NULL, 'Veraval', '11', 'active', '2025-04-17 09:51:57', '2025-04-17 09:51:57'),
(867, NULL, 'Vijapur', '11', 'active', '2025-04-17 09:51:57', '2025-04-17 09:51:57'),
(868, NULL, 'Vinchhiya', '11', 'active', '2025-04-17 09:51:57', '2025-04-17 09:51:57'),
(869, NULL, 'Viramgam', '11', 'active', '2025-04-17 09:51:57', '2025-04-17 09:51:57'),
(870, NULL, 'Virpur', '11', 'active', '2025-04-17 09:51:57', '2025-04-17 09:51:57'),
(871, NULL, 'Visavadar', '11', 'active', '2025-04-17 09:51:57', '2025-04-17 09:51:57'),
(872, NULL, 'Visnagar', '11', 'active', '2025-04-17 09:51:57', '2025-04-17 09:51:57'),
(873, NULL, 'Vyara', '11', 'active', '2025-04-17 09:51:57', '2025-04-17 09:51:57'),
(874, NULL, 'Wadhai', '11', 'active', '2025-04-17 09:51:57', '2025-04-17 09:51:57'),
(875, NULL, 'Wadhwan', '11', 'active', '2025-04-17 09:51:57', '2025-04-17 09:51:57'),
(876, NULL, 'Waghai', '11', 'active', '2025-04-17 09:51:57', '2025-04-17 09:51:57'),
(877, NULL, 'Wankaner', '11', 'active', '2025-04-17 09:51:57', '2025-04-17 09:51:57'),
(878, NULL, 'Ambala', '12', 'active', '2025-04-17 09:51:57', '2025-04-17 09:51:57'),
(879, NULL, 'Asandh', '12', 'active', '2025-04-17 09:51:57', '2025-04-17 09:51:57'),
(880, NULL, 'Ateli Mandi', '12', 'active', '2025-04-17 09:51:57', '2025-04-17 09:51:57'),
(881, NULL, 'Bahadurgarh', '12', 'active', '2025-04-17 09:51:57', '2025-04-17 09:51:57'),
(882, NULL, 'Bara Uchana', '12', 'active', '2025-04-17 09:51:57', '2025-04-17 09:51:57'),
(883, NULL, 'Barwala', '12', 'active', '2025-04-17 09:51:57', '2025-04-17 09:51:57'),
(884, NULL, 'Bawal', '12', 'active', '2025-04-17 09:51:57', '2025-04-17 09:51:57'),
(885, NULL, 'Beri Khas', '12', 'active', '2025-04-17 09:51:57', '2025-04-17 09:51:57'),
(886, NULL, 'Bhiwani', '12', 'active', '2025-04-17 09:51:57', '2025-04-17 09:51:57'),
(887, NULL, 'Bilaspur', '12', 'active', '2025-04-17 09:51:57', '2025-04-17 09:51:57'),
(888, NULL, 'Buriya', '12', 'active', '2025-04-17 09:51:57', '2025-04-17 09:51:57'),
(889, NULL, 'Charkhi Dadri', '12', 'active', '2025-04-17 09:51:57', '2025-04-17 09:51:57'),
(890, NULL, 'Chhachhrauli', '12', 'active', '2025-04-17 09:51:57', '2025-04-17 09:51:57'),
(891, NULL, 'Dabwali', '12', 'active', '2025-04-17 09:51:57', '2025-04-17 09:51:57'),
(892, NULL, 'Dharuhera', '12', 'active', '2025-04-17 09:51:57', '2025-04-17 09:51:57'),
(893, NULL, 'Ellenabad', '12', 'active', '2025-04-17 09:51:57', '2025-04-17 09:51:57'),
(894, NULL, 'Faridabad', '12', 'active', '2025-04-17 09:51:57', '2025-04-17 09:51:57'),
(895, NULL, 'Farrukhnagar', '12', 'active', '2025-04-17 09:51:57', '2025-04-17 09:51:57'),
(896, NULL, 'Fatehabad', '12', 'active', '2025-04-17 09:51:57', '2025-04-17 09:51:57'),
(897, NULL, 'Firozpur Jhirka', '12', 'active', '2025-04-17 09:51:57', '2025-04-17 09:51:57'),
(898, NULL, 'Gharaunda', '12', 'active', '2025-04-17 09:51:57', '2025-04-17 09:51:57'),
(899, NULL, 'Gohana', '12', 'active', '2025-04-17 09:51:57', '2025-04-17 09:51:57'),
(900, NULL, 'Gorakhpur', '12', 'active', '2025-04-17 09:51:57', '2025-04-17 09:51:57'),
(901, NULL, 'Gurgaon', '12', 'active', '2025-04-17 09:51:57', '2025-04-17 09:51:57'),
(902, NULL, 'Hansi', '12', 'active', '2025-04-17 09:51:57', '2025-04-17 09:51:57'),
(903, NULL, 'Hasanpur', '12', 'active', '2025-04-17 09:51:57', '2025-04-17 09:51:57'),
(904, NULL, 'Hisar', '12', 'active', '2025-04-17 09:51:57', '2025-04-17 09:51:57'),
(905, NULL, 'Hodal', '12', 'active', '2025-04-17 09:51:57', '2025-04-17 09:51:57'),
(906, NULL, 'Inda Chhoi', '12', 'active', '2025-04-17 09:51:57', '2025-04-17 09:51:57'),
(907, NULL, 'Indri', '12', 'active', '2025-04-17 09:51:57', '2025-04-17 09:51:57'),
(908, NULL, 'Jagadhri', '12', 'active', '2025-04-17 09:51:57', '2025-04-17 09:51:57'),
(909, NULL, 'Jakhal', '12', 'active', '2025-04-17 09:51:57', '2025-04-17 09:51:57'),
(910, NULL, 'Jhajjar', '12', 'active', '2025-04-17 09:51:57', '2025-04-17 09:51:57'),
(911, NULL, 'Jind', '12', 'active', '2025-04-17 09:51:57', '2025-04-17 09:51:57'),
(912, NULL, 'Kaithal', '12', 'active', '2025-04-17 09:51:57', '2025-04-17 09:51:57'),
(913, NULL, 'Kalanaur', '12', 'active', '2025-04-17 09:51:57', '2025-04-17 09:51:57'),
(914, NULL, 'Kalanwali', '12', 'active', '2025-04-17 09:51:57', '2025-04-17 09:51:57'),
(915, NULL, 'Kanina Khas', '12', 'active', '2025-04-17 09:51:57', '2025-04-17 09:51:57'),
(916, NULL, 'Karnal', '12', 'active', '2025-04-17 09:51:57', '2025-04-17 09:51:57'),
(917, NULL, 'Kharkhauda', '12', 'active', '2025-04-17 09:51:57', '2025-04-17 09:51:57'),
(918, NULL, 'Kheri Sampla', '12', 'active', '2025-04-17 09:51:57', '2025-04-17 09:51:57'),
(919, NULL, 'Kurukshetra', '12', 'active', '2025-04-17 09:51:57', '2025-04-17 09:51:57'),
(920, NULL, 'Ladwa', '12', 'active', '2025-04-17 09:51:57', '2025-04-17 09:51:57'),
(921, NULL, 'Loharu', '12', 'active', '2025-04-17 09:51:57', '2025-04-17 09:51:57'),
(922, NULL, 'Maham', '12', 'active', '2025-04-17 09:51:57', '2025-04-17 09:51:57'),
(923, NULL, 'Mahendragarh', '12', 'active', '2025-04-17 09:51:57', '2025-04-17 09:51:57'),
(924, NULL, 'Mandholi Kalan', '12', 'active', '2025-04-17 09:51:57', '2025-04-17 09:51:57'),
(925, NULL, 'Mustafabad', '12', 'active', '2025-04-17 09:51:57', '2025-04-17 09:51:57'),
(926, NULL, 'Narayangarh', '12', 'active', '2025-04-17 09:51:57', '2025-04-17 09:51:57'),
(927, NULL, 'Narnaul', '12', 'active', '2025-04-17 09:51:57', '2025-04-17 09:51:57'),
(928, NULL, 'Narnaund', '12', 'active', '2025-04-17 09:51:57', '2025-04-17 09:51:57'),
(929, NULL, 'Narwana', '12', 'active', '2025-04-17 09:51:57', '2025-04-17 09:51:57'),
(930, NULL, 'Nilokheri', '12', 'active', '2025-04-17 09:51:57', '2025-04-17 09:51:57'),
(931, NULL, 'Nuh', '12', 'active', '2025-04-17 09:51:57', '2025-04-17 09:51:57'),
(932, NULL, 'Palwal', '12', 'active', '2025-04-17 09:51:57', '2025-04-17 09:51:57'),
(933, NULL, 'Panchkula', '12', 'active', '2025-04-17 09:51:57', '2025-04-17 09:51:57'),
(934, NULL, 'Panipat', '12', 'active', '2025-04-17 09:51:57', '2025-04-17 09:51:57'),
(935, NULL, 'Pataudi', '12', 'active', '2025-04-17 09:51:57', '2025-04-17 09:51:57'),
(936, NULL, 'Pehowa', '12', 'active', '2025-04-17 09:51:57', '2025-04-17 09:51:57'),
(937, NULL, 'Pinjaur', '12', 'active', '2025-04-17 09:51:57', '2025-04-17 09:51:57'),
(938, NULL, 'Punahana', '12', 'active', '2025-04-17 09:51:57', '2025-04-17 09:51:57'),
(939, NULL, 'Pundri', '12', 'active', '2025-04-17 09:51:57', '2025-04-17 09:51:57'),
(940, NULL, 'Radaur', '12', 'active', '2025-04-17 09:51:57', '2025-04-17 09:51:57'),
(941, NULL, 'Rania', '12', 'active', '2025-04-17 09:51:57', '2025-04-17 09:51:57'),
(942, NULL, 'Ratia', '12', 'active', '2025-04-17 09:51:57', '2025-04-17 09:51:57'),
(943, NULL, 'Rewari', '12', 'active', '2025-04-17 09:51:57', '2025-04-17 09:51:57'),
(944, NULL, 'Rohtak', '12', 'active', '2025-04-17 09:51:57', '2025-04-17 09:51:57'),
(945, NULL, 'Safidon', '12', 'active', '2025-04-17 09:51:57', '2025-04-17 09:51:57'),
(946, NULL, 'Samalkha', '12', 'active', '2025-04-17 09:51:57', '2025-04-17 09:51:57'),
(947, NULL, 'Shadipur Julana', '12', 'active', '2025-04-17 09:51:57', '2025-04-17 09:51:57'),
(948, NULL, 'Shahabad', '12', 'active', '2025-04-17 09:51:57', '2025-04-17 09:51:57'),
(949, NULL, 'Sirsa', '12', 'active', '2025-04-17 09:51:57', '2025-04-17 09:51:57'),
(950, NULL, 'Sohna', '12', 'active', '2025-04-17 09:51:57', '2025-04-17 09:51:57'),
(951, NULL, 'Sonipat', '12', 'active', '2025-04-17 09:51:57', '2025-04-17 09:51:57'),
(952, NULL, 'Taoru', '12', 'active', '2025-04-17 09:51:57', '2025-04-17 09:51:57'),
(953, NULL, 'Thanesar', '12', 'active', '2025-04-17 09:51:57', '2025-04-17 09:51:57'),
(954, NULL, 'Tohana', '12', 'active', '2025-04-17 09:51:57', '2025-04-17 09:51:57'),
(955, NULL, 'Tosham', '12', 'active', '2025-04-17 09:51:57', '2025-04-17 09:51:57'),
(956, NULL, 'Uklana', '12', 'active', '2025-04-17 09:51:57', '2025-04-17 09:51:57'),
(957, NULL, 'Yamunanagar', '12', 'active', '2025-04-17 09:51:57', '2025-04-17 09:51:57'),
(958, NULL, 'Arki', '13', 'active', '2025-04-17 09:51:57', '2025-04-17 09:51:57'),
(959, NULL, 'Baddi', '13', 'active', '2025-04-17 09:51:57', '2025-04-17 09:51:57'),
(960, NULL, 'Banjar', '13', 'active', '2025-04-17 09:51:57', '2025-04-17 09:51:57'),
(961, NULL, 'Bilaspur', '13', 'active', '2025-04-17 09:51:57', '2025-04-17 09:51:57'),
(962, NULL, 'Chamba', '13', 'active', '2025-04-17 09:51:57', '2025-04-17 09:51:57'),
(963, NULL, 'Chaupal', '13', 'active', '2025-04-17 09:51:57', '2025-04-17 09:51:57'),
(964, NULL, 'Chowari', '13', 'active', '2025-04-17 09:51:57', '2025-04-17 09:51:57'),
(965, NULL, 'Chuari Khas', '13', 'active', '2025-04-17 09:51:57', '2025-04-17 09:51:57'),
(966, NULL, 'Dagshai', '13', 'active', '2025-04-17 09:51:57', '2025-04-17 09:51:57'),
(967, NULL, 'Dalhousie', '13', 'active', '2025-04-17 09:51:57', '2025-04-17 09:51:57'),
(968, NULL, 'Daulatpur', '13', 'active', '2025-04-17 09:51:57', '2025-04-17 09:51:57'),
(969, NULL, 'Dera Gopipur', '13', 'active', '2025-04-17 09:51:57', '2025-04-17 09:51:57'),
(970, NULL, 'Dharamsala', '13', 'active', '2025-04-17 09:51:57', '2025-04-17 09:51:57'),
(971, NULL, 'Gagret', '13', 'active', '2025-04-17 09:51:57', '2025-04-17 09:51:57'),
(972, NULL, 'Ghumarwin', '13', 'active', '2025-04-17 09:51:57', '2025-04-17 09:51:57'),
(973, NULL, 'Hamirpur', '13', 'active', '2025-04-17 09:51:57', '2025-04-17 09:51:57'),
(974, NULL, 'Jawala Mukhi', '13', 'active', '2025-04-17 09:51:57', '2025-04-17 09:51:57'),
(975, NULL, 'Jogindarnagar', '13', 'active', '2025-04-17 09:51:57', '2025-04-17 09:51:57'),
(976, NULL, 'Jubbal', '13', 'active', '2025-04-17 09:51:57', '2025-04-17 09:51:57'),
(977, NULL, 'Jutogh', '13', 'active', '2025-04-17 09:51:57', '2025-04-17 09:51:57'),
(978, NULL, 'Kalka', '13', 'active', '2025-04-17 09:51:57', '2025-04-17 09:51:57'),
(979, NULL, 'Kangar', '13', 'active', '2025-04-17 09:51:57', '2025-04-17 09:51:57'),
(980, NULL, 'Kangra', '13', 'active', '2025-04-17 09:51:57', '2025-04-17 09:51:57'),
(981, NULL, 'Kasauli', '13', 'active', '2025-04-17 09:51:57', '2025-04-17 09:51:57'),
(982, NULL, 'Kinnaur', '13', 'active', '2025-04-17 09:51:57', '2025-04-17 09:51:57'),
(983, NULL, 'Kotkhai', '13', 'active', '2025-04-17 09:51:57', '2025-04-17 09:51:57'),
(984, NULL, 'Kotla', '13', 'active', '2025-04-17 09:51:57', '2025-04-17 09:51:57'),
(985, NULL, 'Kulu', '13', 'active', '2025-04-17 09:51:57', '2025-04-17 09:51:57'),
(986, NULL, 'Kyelang', '13', 'active', '2025-04-17 09:51:57', '2025-04-17 09:51:57'),
(987, NULL, 'Lahul and Spiti', '13', 'active', '2025-04-17 09:51:57', '2025-04-17 09:51:57'),
(988, NULL, 'Manali', '13', 'active', '2025-04-17 09:51:57', '2025-04-17 09:51:57'),
(989, NULL, 'Mandi', '13', 'active', '2025-04-17 09:51:57', '2025-04-17 09:51:57'),
(990, NULL, 'Nadaun', '13', 'active', '2025-04-17 09:51:57', '2025-04-17 09:51:57'),
(991, NULL, 'Nagar', '13', 'active', '2025-04-17 09:51:57', '2025-04-17 09:51:57'),
(992, NULL, 'Nagrota', '13', 'active', '2025-04-17 09:51:57', '2025-04-17 09:51:57'),
(993, NULL, 'Nahan', '13', 'active', '2025-04-17 09:51:57', '2025-04-17 09:51:57'),
(994, NULL, 'Nalagarh', '13', 'active', '2025-04-17 09:51:57', '2025-04-17 09:51:57'),
(995, NULL, 'Palampur', '13', 'active', '2025-04-17 09:51:57', '2025-04-17 09:51:57'),
(996, NULL, 'Pandoh', '13', 'active', '2025-04-17 09:51:57', '2025-04-17 09:51:57'),
(997, NULL, 'Paonta Sahib', '13', 'active', '2025-04-17 09:51:57', '2025-04-17 09:51:57'),
(998, NULL, 'Parwanoo', '13', 'active', '2025-04-17 09:51:57', '2025-04-17 09:51:57'),
(999, NULL, 'Rajgarh', '13', 'active', '2025-04-17 09:51:57', '2025-04-17 09:51:57'),
(1000, NULL, 'Rampur', '13', 'active', '2025-04-17 09:51:57', '2025-04-17 09:51:57'),
(1001, NULL, 'Rohru', '13', 'active', '2025-04-17 09:51:57', '2025-04-17 09:51:57'),
(1002, NULL, 'Sabathu', '13', 'active', '2025-04-17 09:51:57', '2025-04-17 09:51:57'),
(1003, NULL, 'Santokhgarh', '13', 'active', '2025-04-17 09:51:57', '2025-04-17 09:51:57'),
(1004, NULL, 'Sarahan', '13', 'active', '2025-04-17 09:51:57', '2025-04-17 09:51:57'),
(1005, NULL, 'Sarka Ghat', '13', 'active', '2025-04-17 09:51:57', '2025-04-17 09:51:57'),
(1006, NULL, 'Seoni', '13', 'active', '2025-04-17 09:51:57', '2025-04-17 09:51:57'),
(1007, NULL, 'Shimla', '13', 'active', '2025-04-17 09:51:57', '2025-04-17 09:51:57'),
(1008, NULL, 'Sirmaur', '13', 'active', '2025-04-17 09:51:57', '2025-04-17 09:51:57'),
(1009, NULL, 'Solan', '13', 'active', '2025-04-17 09:51:57', '2025-04-17 09:51:57'),
(1010, NULL, 'Sundarnagar', '13', 'active', '2025-04-17 09:51:57', '2025-04-17 09:51:57'),
(1011, NULL, 'Theog', '13', 'active', '2025-04-17 09:51:57', '2025-04-17 09:51:57'),
(1012, NULL, 'Tira Sujanpur', '13', 'active', '2025-04-17 09:51:57', '2025-04-17 09:51:57'),
(1013, NULL, 'Una', '13', 'active', '2025-04-17 09:51:57', '2025-04-17 09:51:57'),
(1014, NULL, 'Yol', '13', 'active', '2025-04-17 09:51:57', '2025-04-17 09:51:57'),
(1015, NULL, 'Akhnur', '14', 'active', '2025-04-17 09:51:57', '2025-04-17 09:51:57'),
(1016, NULL, 'Anantnag', '14', 'active', '2025-04-17 09:51:57', '2025-04-17 09:51:57'),
(1017, NULL, 'Awantipur', '14', 'active', '2025-04-17 09:51:57', '2025-04-17 09:51:57'),
(1018, NULL, 'Badgam', '14', 'active', '2025-04-17 09:51:57', '2025-04-17 09:51:57'),
(1019, NULL, 'Bandipore', '14', 'active', '2025-04-17 09:51:57', '2025-04-17 09:51:57'),
(1020, NULL, 'Banihal', '14', 'active', '2025-04-17 09:51:57', '2025-04-17 09:51:57'),
(1021, NULL, 'Baramula', '14', 'active', '2025-04-17 09:51:57', '2025-04-17 09:51:57'),
(1022, NULL, 'Batoti', '14', 'active', '2025-04-17 09:51:57', '2025-04-17 09:51:57'),
(1023, NULL, 'Bhadarwah', '14', 'active', '2025-04-17 09:51:57', '2025-04-17 09:51:57'),
(1024, NULL, 'Bijbehara', '14', 'active', '2025-04-17 09:51:57', '2025-04-17 09:51:57'),
(1025, NULL, 'Bishnah', '14', 'active', '2025-04-17 09:51:57', '2025-04-17 09:51:57'),
(1026, NULL, 'Doda', '14', 'active', '2025-04-17 09:51:57', '2025-04-17 09:51:57'),
(1027, NULL, 'Ganderbal', '14', 'active', '2025-04-17 09:51:57', '2025-04-17 09:51:57'),
(1028, NULL, 'Gho Brahmanan de', '14', 'active', '2025-04-17 09:51:57', '2025-04-17 09:51:57'),
(1029, NULL, 'Hajan', '14', 'active', '2025-04-17 09:51:57', '2025-04-17 09:51:57'),
(1030, NULL, 'Hiranagar', '14', 'active', '2025-04-17 09:51:57', '2025-04-17 09:51:57'),
(1031, NULL, 'Jammu', '14', 'active', '2025-04-17 09:51:57', '2025-04-17 09:51:57'),
(1032, NULL, 'Jaurian', '14', 'active', '2025-04-17 09:51:57', '2025-04-17 09:51:57'),
(1033, NULL, 'Kathua', '14', 'active', '2025-04-17 09:51:57', '2025-04-17 09:51:57'),
(1034, NULL, 'Katra', '14', 'active', '2025-04-17 09:51:57', '2025-04-17 09:51:57'),
(1035, NULL, 'Khaur', '14', 'active', '2025-04-17 09:51:57', '2025-04-17 09:51:57'),
(1036, NULL, 'Kishtwar', '14', 'active', '2025-04-17 09:51:57', '2025-04-17 09:51:57'),
(1037, NULL, 'Kud', '14', 'active', '2025-04-17 09:51:57', '2025-04-17 09:51:57'),
(1038, NULL, 'Kulgam', '14', 'active', '2025-04-17 09:51:57', '2025-04-17 09:51:57'),
(1039, NULL, 'Kupwara', '14', 'active', '2025-04-17 09:51:57', '2025-04-17 09:51:57'),
(1040, NULL, 'Ladakh', '14', 'active', '2025-04-17 09:51:57', '2025-04-17 09:51:57'),
(1041, NULL, 'Magam', '14', 'active', '2025-04-17 09:51:57', '2025-04-17 09:51:57'),
(1042, NULL, 'Nawanshahr', '14', 'active', '2025-04-17 09:51:57', '2025-04-17 09:51:57'),
(1043, NULL, 'Noria', '14', 'active', '2025-04-17 09:51:57', '2025-04-17 09:51:57'),
(1044, NULL, 'Padam', '14', 'active', '2025-04-17 09:51:57', '2025-04-17 09:51:57'),
(1045, NULL, 'Pahlgam', '14', 'active', '2025-04-17 09:51:57', '2025-04-17 09:51:57'),
(1046, NULL, 'Parol', '14', 'active', '2025-04-17 09:51:57', '2025-04-17 09:51:57'),
(1047, NULL, 'Pattan', '14', 'active', '2025-04-17 09:51:57', '2025-04-17 09:51:57'),
(1048, NULL, 'Pulwama', '14', 'active', '2025-04-17 09:51:57', '2025-04-17 09:51:57'),
(1049, NULL, 'Punch', '14', 'active', '2025-04-17 09:51:57', '2025-04-17 09:51:57'),
(1050, NULL, 'Qazigund', '14', 'active', '2025-04-17 09:51:57', '2025-04-17 09:51:57'),
(1051, NULL, 'Rajaori', '14', 'active', '2025-04-17 09:51:57', '2025-04-17 09:51:57'),
(1052, NULL, 'Rajauri', '14', 'active', '2025-04-17 09:51:57', '2025-04-17 09:51:57'),
(1053, NULL, 'Ramban', '14', 'active', '2025-04-17 09:51:57', '2025-04-17 09:51:57'),
(1054, NULL, 'Ramgarh', '14', 'active', '2025-04-17 09:51:57', '2025-04-17 09:51:57'),
(1055, NULL, 'Ramnagar', '14', 'active', '2025-04-17 09:51:57', '2025-04-17 09:51:57'),
(1056, NULL, 'Riasi', '14', 'active', '2025-04-17 09:51:57', '2025-04-17 09:51:57'),
(1057, NULL, 'Samba', '14', 'active', '2025-04-17 09:51:57', '2025-04-17 09:51:57'),
(1058, NULL, 'Shupiyan', '14', 'active', '2025-04-17 09:51:57', '2025-04-17 09:51:57'),
(1059, NULL, 'Sopur', '14', 'active', '2025-04-17 09:51:57', '2025-04-17 09:51:57'),
(1060, NULL, 'Soyibug', '14', 'active', '2025-04-17 09:51:57', '2025-04-17 09:51:57'),
(1061, NULL, 'Srinagar', '14', 'active', '2025-04-17 09:51:57', '2025-04-17 09:51:57'),
(1062, NULL, 'Sumbal', '14', 'active', '2025-04-17 09:51:57', '2025-04-17 09:51:57'),
(1063, NULL, 'Thang', '14', 'active', '2025-04-17 09:51:57', '2025-04-17 09:51:57'),
(1064, NULL, 'Thanna Mandi', '14', 'active', '2025-04-17 09:51:57', '2025-04-17 09:51:57'),
(1065, NULL, 'Tral', '14', 'active', '2025-04-17 09:51:57', '2025-04-17 09:51:57'),
(1066, NULL, 'Tsrar Sharif', '14', 'active', '2025-04-17 09:51:57', '2025-04-17 09:51:57'),
(1067, NULL, 'Udhampur', '14', 'active', '2025-04-17 09:51:57', '2025-04-17 09:51:57'),
(1068, NULL, 'Uri', '14', 'active', '2025-04-17 09:51:57', '2025-04-17 09:51:57'),
(1069, NULL, 'Bagra', '15', 'active', '2025-04-17 09:51:57', '2025-04-17 09:51:57'),
(1070, NULL, 'Barka Kana', '15', 'active', '2025-04-17 09:51:57', '2025-04-17 09:51:57'),
(1071, NULL, 'Barki Saria', '15', 'active', '2025-04-17 09:51:57', '2025-04-17 09:51:57'),
(1072, NULL, 'Barwadih', '15', 'active', '2025-04-17 09:51:57', '2025-04-17 09:51:57'),
(1073, NULL, 'Bhojudih', '15', 'active', '2025-04-17 09:51:57', '2025-04-17 09:51:57'),
(1074, NULL, 'Bokaro', '15', 'active', '2025-04-17 09:51:57', '2025-04-17 09:51:57'),
(1075, NULL, 'Bundu', '15', 'active', '2025-04-17 09:51:57', '2025-04-17 09:51:57'),
(1076, NULL, 'Chaibasa', '15', 'active', '2025-04-17 09:51:57', '2025-04-17 09:51:57'),
(1077, NULL, 'Chakradharpur', '15', 'active', '2025-04-17 09:51:57', '2025-04-17 09:51:57'),
(1078, NULL, 'Chakulia', '15', 'active', '2025-04-17 09:51:57', '2025-04-17 09:51:57'),
(1079, NULL, 'Chandil', '15', 'active', '2025-04-17 09:51:57', '2025-04-17 09:51:57'),
(1080, NULL, 'Chas', '15', 'active', '2025-04-17 09:51:57', '2025-04-17 09:51:57'),
(1081, NULL, 'Chatra', '15', 'active', '2025-04-17 09:51:57', '2025-04-17 09:51:57'),
(1082, NULL, 'Chiria', '15', 'active', '2025-04-17 09:51:57', '2025-04-17 09:51:57'),
(1083, NULL, 'Daltonganj', '15', 'active', '2025-04-17 09:51:57', '2025-04-17 09:51:57'),
(1084, NULL, 'Deogarh', '15', 'active', '2025-04-17 09:51:57', '2025-04-17 09:51:57'),
(1085, NULL, 'Dhanbad', '15', 'active', '2025-04-17 09:51:57', '2025-04-17 09:51:57'),
(1086, NULL, 'Dhanwar', '15', 'active', '2025-04-17 09:51:57', '2025-04-17 09:51:57'),
(1087, NULL, 'Dugda', '15', 'active', '2025-04-17 09:51:57', '2025-04-17 09:51:57'),
(1088, NULL, 'Dumka', '15', 'active', '2025-04-17 09:51:57', '2025-04-17 09:51:57'),
(1089, NULL, 'Garhwa', '15', 'active', '2025-04-17 09:51:57', '2025-04-17 09:51:57'),
(1090, NULL, 'Ghatsila', '15', 'active', '2025-04-17 09:51:57', '2025-04-17 09:51:57'),
(1091, NULL, 'Giridih', '15', 'active', '2025-04-17 09:51:57', '2025-04-17 09:51:57'),
(1092, NULL, 'Gobindpur', '15', 'active', '2025-04-17 09:51:57', '2025-04-17 09:51:57'),
(1093, NULL, 'Godda', '15', 'active', '2025-04-17 09:51:57', '2025-04-17 09:51:57'),
(1094, NULL, 'Gomoh', '15', 'active', '2025-04-17 09:51:57', '2025-04-17 09:51:57'),
(1095, NULL, 'Gopinathpur', '15', 'active', '2025-04-17 09:51:57', '2025-04-17 09:51:57'),
(1096, NULL, 'Gua', '15', 'active', '2025-04-17 09:51:57', '2025-04-17 09:51:57'),
(1097, NULL, 'Gumia', '15', 'active', '2025-04-17 09:51:57', '2025-04-17 09:51:57'),
(1098, NULL, 'Gumla', '15', 'active', '2025-04-17 09:51:57', '2025-04-17 09:51:57'),
(1099, NULL, 'Hazaribag', '15', 'active', '2025-04-17 09:51:57', '2025-04-17 09:51:57'),
(1100, NULL, 'Hazaribagh', '15', 'active', '2025-04-17 09:51:57', '2025-04-17 09:51:57'),
(1101, NULL, 'Hesla', '15', 'active', '2025-04-17 09:51:57', '2025-04-17 09:51:57'),
(1102, NULL, 'Husainabad', '15', 'active', '2025-04-17 09:51:57', '2025-04-17 09:51:57'),
(1103, NULL, 'Jagannathpur', '15', 'active', '2025-04-17 09:51:57', '2025-04-17 09:51:57'),
(1104, NULL, 'Jamadoba', '15', 'active', '2025-04-17 09:51:57', '2025-04-17 09:51:57'),
(1105, NULL, 'Jamshedpur', '15', 'active', '2025-04-17 09:51:57', '2025-04-17 09:51:57'),
(1106, NULL, 'Jamtara', '15', 'active', '2025-04-17 09:51:57', '2025-04-17 09:51:57'),
(1107, NULL, 'Jasidih', '15', 'active', '2025-04-17 09:51:57', '2025-04-17 09:51:57'),
(1108, NULL, 'Jharia', '15', 'active', '2025-04-17 09:51:57', '2025-04-17 09:51:57'),
(1109, NULL, 'Jugsalai', '15', 'active', '2025-04-17 09:51:57', '2025-04-17 09:51:57'),
(1110, NULL, 'Jumri Tilaiya', '15', 'active', '2025-04-17 09:51:57', '2025-04-17 09:51:57'),
(1111, NULL, 'Kalikapur', '15', 'active', '2025-04-17 09:51:57', '2025-04-17 09:51:57'),
(1112, NULL, 'Kandra', '15', 'active', '2025-04-17 09:51:57', '2025-04-17 09:51:57'),
(1113, NULL, 'Kanke', '15', 'active', '2025-04-17 09:51:57', '2025-04-17 09:51:57'),
(1114, NULL, 'Katras', '15', 'active', '2025-04-17 09:51:57', '2025-04-17 09:51:57'),
(1115, NULL, 'Kenduadih', '15', 'active', '2025-04-17 09:51:57', '2025-04-17 09:51:57'),
(1116, NULL, 'Kharsawan', '15', 'active', '2025-04-17 09:51:57', '2025-04-17 09:51:57'),
(1117, NULL, 'Khunti', '15', 'active', '2025-04-17 09:51:57', '2025-04-17 09:51:57'),
(1118, NULL, 'Kodarma', '15', 'active', '2025-04-17 09:51:57', '2025-04-17 09:51:57'),
(1119, NULL, 'Kuju', '15', 'active', '2025-04-17 09:51:57', '2025-04-17 09:51:57'),
(1120, NULL, 'Latehar', '15', 'active', '2025-04-17 09:51:57', '2025-04-17 09:51:57'),
(1121, NULL, 'Lohardaga', '15', 'active', '2025-04-17 09:51:57', '2025-04-17 09:51:57'),
(1122, NULL, 'Madhupur', '15', 'active', '2025-04-17 09:51:57', '2025-04-17 09:51:57'),
(1123, NULL, 'Malkera', '15', 'active', '2025-04-17 09:51:57', '2025-04-17 09:51:57'),
(1124, NULL, 'Manoharpur', '15', 'active', '2025-04-17 09:51:57', '2025-04-17 09:51:57'),
(1125, NULL, 'Mugma', '15', 'active', '2025-04-17 09:51:57', '2025-04-17 09:51:57'),
(1126, NULL, 'Mushabani', '15', 'active', '2025-04-17 09:51:57', '2025-04-17 09:51:57'),
(1127, NULL, 'Neturhat', '15', 'active', '2025-04-17 09:51:57', '2025-04-17 09:51:57'),
(1128, NULL, 'Nirsa', '15', 'active', '2025-04-17 09:51:57', '2025-04-17 09:51:57'),
(1129, NULL, 'Noamundi', '15', 'active', '2025-04-17 09:51:57', '2025-04-17 09:51:57'),
(1130, NULL, 'Pakur', '15', 'active', '2025-04-17 09:51:57', '2025-04-17 09:51:57'),
(1131, NULL, 'Palamu', '15', 'active', '2025-04-17 09:51:57', '2025-04-17 09:51:57'),
(1132, NULL, 'Pashchim Singhbhum', '15', 'active', '2025-04-17 09:51:57', '2025-04-17 09:51:57'),
(1133, NULL, 'patamda', '15', 'active', '2025-04-17 09:51:57', '2025-04-17 09:51:57'),
(1134, NULL, 'Pathardih', '15', 'active', '2025-04-17 09:51:57', '2025-04-17 09:51:57'),
(1135, NULL, 'Purba Singhbhum', '15', 'active', '2025-04-17 09:51:57', '2025-04-17 09:51:57'),
(1136, NULL, 'Ramgarh', '15', 'active', '2025-04-17 09:51:57', '2025-04-17 09:51:57'),
(1137, NULL, 'Ranchi', '15', 'active', '2025-04-17 09:51:57', '2025-04-17 09:51:57'),
(1138, NULL, 'Ray', '15', 'active', '2025-04-17 09:51:57', '2025-04-17 09:51:57'),
(1139, NULL, 'Sahibganj', '15', 'active', '2025-04-17 09:51:57', '2025-04-17 09:51:57'),
(1140, NULL, 'Saraikela', '15', 'active', '2025-04-17 09:51:57', '2025-04-17 09:51:57'),
(1141, NULL, 'Sarubera', '15', 'active', '2025-04-17 09:51:57', '2025-04-17 09:51:57'),
(1142, NULL, 'Sijua', '15', 'active', '2025-04-17 09:51:57', '2025-04-17 09:51:57'),
(1143, NULL, 'Simdega', '15', 'active', '2025-04-17 09:51:57', '2025-04-17 09:51:57'),
(1144, NULL, 'Sini', '15', 'active', '2025-04-17 09:51:57', '2025-04-17 09:51:57'),
(1145, NULL, 'Topchanchi', '15', 'active', '2025-04-17 09:51:57', '2025-04-17 09:51:57'),
(1146, NULL, 'Afzalpur', '16', 'active', '2025-04-17 09:51:57', '2025-04-17 09:51:57'),
(1147, NULL, 'Ajjampur', '16', 'active', '2025-04-17 09:51:57', '2025-04-17 09:51:57'),
(1148, NULL, 'Aland', '16', 'active', '2025-04-17 09:51:57', '2025-04-17 09:51:57'),
(1149, NULL, 'Alnavar', '16', 'active', '2025-04-17 09:51:57', '2025-04-17 09:51:57'),
(1150, NULL, 'Alur', '16', 'active', '2025-04-17 09:51:57', '2025-04-17 09:51:57'),
(1151, NULL, 'Anekal', '16', 'active', '2025-04-17 09:51:57', '2025-04-17 09:51:57'),
(1152, NULL, 'Ankola', '16', 'active', '2025-04-17 09:51:57', '2025-04-17 09:51:57'),
(1153, NULL, 'Annigeri', '16', 'active', '2025-04-17 09:51:57', '2025-04-17 09:51:57'),
(1154, NULL, 'Arkalgud', '16', 'active', '2025-04-17 09:51:57', '2025-04-17 09:51:57'),
(1155, NULL, 'Arsikere', '16', 'active', '2025-04-17 09:51:57', '2025-04-17 09:51:57'),
(1156, NULL, 'Athni', '16', 'active', '2025-04-17 09:51:57', '2025-04-17 09:51:57'),
(1157, NULL, 'Aurad', '16', 'active', '2025-04-17 09:51:57', '2025-04-17 09:51:57'),
(1158, NULL, 'Badami', '16', 'active', '2025-04-17 09:51:57', '2025-04-17 09:51:57'),
(1159, NULL, 'Bagalkot', '16', 'active', '2025-04-17 09:51:57', '2025-04-17 09:51:57'),
(1160, NULL, 'Bagepalli', '16', 'active', '2025-04-17 09:51:57', '2025-04-17 09:51:57'),
(1161, NULL, 'Bail-Hongal', '16', 'active', '2025-04-17 09:51:57', '2025-04-17 09:51:57'),
(1162, NULL, 'Ballari', '16', 'active', '2025-04-17 09:51:57', '2025-04-17 09:51:57'),
(1163, NULL, 'Banavar', '16', 'active', '2025-04-17 09:51:57', '2025-04-17 09:51:57'),
(1164, NULL, 'Bangarapet', '16', 'active', '2025-04-17 09:51:57', '2025-04-17 09:51:57'),
(1165, NULL, 'Bannur', '16', 'active', '2025-04-17 09:51:57', '2025-04-17 09:51:57'),
(1166, NULL, 'Bantval', '16', 'active', '2025-04-17 09:51:57', '2025-04-17 09:51:57'),
(1167, NULL, 'Basavakalyan', '16', 'active', '2025-04-17 09:51:57', '2025-04-17 09:51:57'),
(1168, NULL, 'Basavana Bagevadi', '16', 'active', '2025-04-17 09:51:57', '2025-04-17 09:51:57'),
(1169, NULL, 'Belagavi', '16', 'active', '2025-04-17 09:51:57', '2025-04-17 09:51:57'),
(1170, NULL, 'Belluru', '16', 'active', '2025-04-17 09:51:57', '2025-04-17 09:51:57'),
(1171, NULL, 'Beltangadi', '16', 'active', '2025-04-17 09:51:57', '2025-04-17 09:51:57'),
(1172, NULL, 'Belur', '16', 'active', '2025-04-17 09:51:57', '2025-04-17 09:51:57'),
(1173, NULL, 'Bengaluru', '16', 'active', '2025-04-17 09:51:57', '2025-04-17 09:51:57'),
(1174, NULL, 'Bengaluru Rural', '16', 'active', '2025-04-17 09:51:57', '2025-04-17 09:51:57'),
(1175, NULL, 'Bengaluru Urban', '16', 'active', '2025-04-17 09:51:57', '2025-04-17 09:51:57'),
(1176, NULL, 'Bhadravati', '16', 'active', '2025-04-17 09:51:57', '2025-04-17 09:51:57'),
(1177, NULL, 'Bhalki', '16', 'active', '2025-04-17 09:51:57', '2025-04-17 09:51:57'),
(1178, NULL, 'Bhatkal', '16', 'active', '2025-04-17 09:51:57', '2025-04-17 09:51:57'),
(1179, NULL, 'Bidar', '16', 'active', '2025-04-17 09:51:57', '2025-04-17 09:51:57');
INSERT INTO `module_cities` (`id`, `slug`, `city_name`, `state_name`, `status`, `created_at`, `updated_at`) VALUES
(1180, NULL, 'Bilgi', '16', 'active', '2025-04-17 09:51:57', '2025-04-17 09:51:57'),
(1181, NULL, 'Birur', '16', 'active', '2025-04-17 09:51:57', '2025-04-17 09:51:57'),
(1182, NULL, 'Byadgi', '16', 'active', '2025-04-17 09:51:57', '2025-04-17 09:51:57'),
(1183, NULL, 'Byndoor', '16', 'active', '2025-04-17 09:51:57', '2025-04-17 09:51:57'),
(1184, NULL, 'Canacona', '16', 'active', '2025-04-17 09:51:57', '2025-04-17 09:51:57'),
(1185, NULL, 'Challakere', '16', 'active', '2025-04-17 09:51:57', '2025-04-17 09:51:57'),
(1186, NULL, 'Chamrajnagar', '16', 'active', '2025-04-17 09:51:57', '2025-04-17 09:51:57'),
(1187, NULL, 'Channagiri', '16', 'active', '2025-04-17 09:51:57', '2025-04-17 09:51:57'),
(1188, NULL, 'Channapatna', '16', 'active', '2025-04-17 09:51:57', '2025-04-17 09:51:57'),
(1189, NULL, 'Channarayapatna', '16', 'active', '2025-04-17 09:51:57', '2025-04-17 09:51:57'),
(1190, NULL, 'Chik Ballapur', '16', 'active', '2025-04-17 09:51:57', '2025-04-17 09:51:57'),
(1191, NULL, 'Chikkaballapur', '16', 'active', '2025-04-17 09:51:57', '2025-04-17 09:51:57'),
(1192, NULL, 'Chikkamagaluru', '16', 'active', '2025-04-17 09:51:57', '2025-04-17 09:51:57'),
(1193, NULL, 'Chiknayakanhalli', '16', 'active', '2025-04-17 09:51:57', '2025-04-17 09:51:57'),
(1194, NULL, 'Chikodi', '16', 'active', '2025-04-17 09:51:57', '2025-04-17 09:51:57'),
(1195, NULL, 'Chincholi', '16', 'active', '2025-04-17 09:51:57', '2025-04-17 09:51:57'),
(1196, NULL, 'Chintamani', '16', 'active', '2025-04-17 09:51:57', '2025-04-17 09:51:57'),
(1197, NULL, 'Chitapur', '16', 'active', '2025-04-17 09:51:57', '2025-04-17 09:51:57'),
(1198, NULL, 'Chitradurga', '16', 'active', '2025-04-17 09:51:57', '2025-04-17 09:51:57'),
(1199, NULL, 'Closepet', '16', 'active', '2025-04-17 09:51:57', '2025-04-17 09:51:57'),
(1200, NULL, 'Coondapoor', '16', 'active', '2025-04-17 09:51:57', '2025-04-17 09:51:57'),
(1201, NULL, 'Dakshina Kannada', '16', 'active', '2025-04-17 09:51:57', '2025-04-17 09:51:57'),
(1202, NULL, 'Dandeli', '16', 'active', '2025-04-17 09:51:57', '2025-04-17 09:51:57'),
(1203, NULL, 'Davanagere', '16', 'active', '2025-04-17 09:51:57', '2025-04-17 09:51:57'),
(1204, NULL, 'Devanhalli', '16', 'active', '2025-04-17 09:51:57', '2025-04-17 09:51:57'),
(1205, NULL, 'Dharwad', '16', 'active', '2025-04-17 09:51:57', '2025-04-17 09:51:57'),
(1206, NULL, 'Dod Ballapur', '16', 'active', '2025-04-17 09:51:57', '2025-04-17 09:51:57'),
(1207, NULL, 'French Rocks', '16', 'active', '2025-04-17 09:51:57', '2025-04-17 09:51:57'),
(1208, NULL, 'Gadag', '16', 'active', '2025-04-17 09:51:57', '2025-04-17 09:51:57'),
(1209, NULL, 'Gadag-Betageri', '16', 'active', '2025-04-17 09:51:57', '2025-04-17 09:51:57'),
(1210, NULL, 'Gajendragarh', '16', 'active', '2025-04-17 09:51:57', '2025-04-17 09:51:57'),
(1211, NULL, 'Gangawati', '16', 'active', '2025-04-17 09:51:57', '2025-04-17 09:51:57'),
(1212, NULL, 'Gangolli', '16', 'active', '2025-04-17 09:51:57', '2025-04-17 09:51:57'),
(1213, NULL, 'Gokak', '16', 'active', '2025-04-17 09:51:57', '2025-04-17 09:51:57'),
(1214, NULL, 'Gokarna', '16', 'active', '2025-04-17 09:51:57', '2025-04-17 09:51:57'),
(1215, NULL, 'Goribidnur', '16', 'active', '2025-04-17 09:51:57', '2025-04-17 09:51:57'),
(1216, NULL, 'Gorur', '16', 'active', '2025-04-17 09:51:57', '2025-04-17 09:51:57'),
(1217, NULL, 'Gubbi', '16', 'active', '2025-04-17 09:51:57', '2025-04-17 09:51:57'),
(1218, NULL, 'Gudibanda', '16', 'active', '2025-04-17 09:51:57', '2025-04-17 09:51:57'),
(1219, NULL, 'Guledagudda', '16', 'active', '2025-04-17 09:51:57', '2025-04-17 09:51:57'),
(1220, NULL, 'Gundlupet', '16', 'active', '2025-04-17 09:51:57', '2025-04-17 09:51:57'),
(1221, NULL, 'Gurmatkal', '16', 'active', '2025-04-17 09:51:57', '2025-04-17 09:51:57'),
(1222, NULL, 'Hadagalli', '16', 'active', '2025-04-17 09:51:57', '2025-04-17 09:51:57'),
(1223, NULL, 'Haliyal', '16', 'active', '2025-04-17 09:51:57', '2025-04-17 09:51:57'),
(1224, NULL, 'Hampi', '16', 'active', '2025-04-17 09:51:57', '2025-04-17 09:51:57'),
(1225, NULL, 'Hangal', '16', 'active', '2025-04-17 09:51:57', '2025-04-17 09:51:57'),
(1226, NULL, 'Harihar', '16', 'active', '2025-04-17 09:51:57', '2025-04-17 09:51:57'),
(1227, NULL, 'Harpanahalli', '16', 'active', '2025-04-17 09:51:57', '2025-04-17 09:51:57'),
(1228, NULL, 'Hassan', '16', 'active', '2025-04-17 09:51:57', '2025-04-17 09:51:57'),
(1229, NULL, 'Haveri', '16', 'active', '2025-04-17 09:51:57', '2025-04-17 09:51:57'),
(1230, NULL, 'Heggadadevankote', '16', 'active', '2025-04-17 09:51:57', '2025-04-17 09:51:57'),
(1231, NULL, 'Hirekerur', '16', 'active', '2025-04-17 09:51:57', '2025-04-17 09:51:57'),
(1232, NULL, 'Hiriyur', '16', 'active', '2025-04-17 09:51:57', '2025-04-17 09:51:57'),
(1233, NULL, 'Holalkere', '16', 'active', '2025-04-17 09:51:57', '2025-04-17 09:51:57'),
(1234, NULL, 'Hole Narsipur', '16', 'active', '2025-04-17 09:51:57', '2025-04-17 09:51:57'),
(1235, NULL, 'Homnabad', '16', 'active', '2025-04-17 09:51:57', '2025-04-17 09:51:57'),
(1236, NULL, 'Honavar', '16', 'active', '2025-04-17 09:51:57', '2025-04-17 09:51:57'),
(1237, NULL, 'Honnali', '16', 'active', '2025-04-17 09:51:57', '2025-04-17 09:51:57'),
(1238, NULL, 'Hosanagara', '16', 'active', '2025-04-17 09:51:57', '2025-04-17 09:51:57'),
(1239, NULL, 'Hosangadi', '16', 'active', '2025-04-17 09:51:57', '2025-04-17 09:51:57'),
(1240, NULL, 'Hosdurga', '16', 'active', '2025-04-17 09:51:57', '2025-04-17 09:51:57'),
(1241, NULL, 'Hoskote', '16', 'active', '2025-04-17 09:51:57', '2025-04-17 09:51:57'),
(1242, NULL, 'Hospet', '16', 'active', '2025-04-17 09:51:57', '2025-04-17 09:51:57'),
(1243, NULL, 'Hubballi', '16', 'active', '2025-04-17 09:51:57', '2025-04-17 09:51:57'),
(1244, NULL, 'Hukeri', '16', 'active', '2025-04-17 09:51:57', '2025-04-17 09:51:57'),
(1245, NULL, 'Hungund', '16', 'active', '2025-04-17 09:51:57', '2025-04-17 09:51:57'),
(1246, NULL, 'Hunsur', '16', 'active', '2025-04-17 09:51:57', '2025-04-17 09:51:57'),
(1247, NULL, 'Ilkal', '16', 'active', '2025-04-17 09:51:57', '2025-04-17 09:51:57'),
(1248, NULL, 'Indi', '16', 'active', '2025-04-17 09:51:57', '2025-04-17 09:51:57'),
(1249, NULL, 'Jagalur', '16', 'active', '2025-04-17 09:51:57', '2025-04-17 09:51:57'),
(1250, NULL, 'Jamkhandi', '16', 'active', '2025-04-17 09:51:57', '2025-04-17 09:51:57'),
(1251, NULL, 'Jevargi', '16', 'active', '2025-04-17 09:51:57', '2025-04-17 09:51:57'),
(1252, NULL, 'Kadur', '16', 'active', '2025-04-17 09:51:57', '2025-04-17 09:51:57'),
(1253, NULL, 'Kalaburgi', '16', 'active', '2025-04-17 09:51:57', '2025-04-17 09:51:57'),
(1254, NULL, 'Kalghatgi', '16', 'active', '2025-04-17 09:51:57', '2025-04-17 09:51:57'),
(1255, NULL, 'Kampli', '16', 'active', '2025-04-17 09:51:57', '2025-04-17 09:51:57'),
(1256, NULL, 'Kankanhalli', '16', 'active', '2025-04-17 09:51:57', '2025-04-17 09:51:57'),
(1257, NULL, 'Karkala', '16', 'active', '2025-04-17 09:51:57', '2025-04-17 09:51:57'),
(1258, NULL, 'Karwar', '16', 'active', '2025-04-17 09:51:57', '2025-04-17 09:51:57'),
(1259, NULL, 'Kavalur', '16', 'active', '2025-04-17 09:51:57', '2025-04-17 09:51:57'),
(1260, NULL, 'Kerur', '16', 'active', '2025-04-17 09:51:57', '2025-04-17 09:51:57'),
(1261, NULL, 'Khanapur', '16', 'active', '2025-04-17 09:51:57', '2025-04-17 09:51:57'),
(1262, NULL, 'Kodagu', '16', 'active', '2025-04-17 09:51:57', '2025-04-17 09:51:57'),
(1263, NULL, 'Kodigenahalli', '16', 'active', '2025-04-17 09:51:57', '2025-04-17 09:51:57'),
(1264, NULL, 'Kodlipet', '16', 'active', '2025-04-17 09:51:57', '2025-04-17 09:51:57'),
(1265, NULL, 'Kolar', '16', 'active', '2025-04-17 09:51:58', '2025-04-17 09:51:58'),
(1266, NULL, 'Kollegal', '16', 'active', '2025-04-17 09:51:58', '2025-04-17 09:51:58'),
(1267, NULL, 'Konanur', '16', 'active', '2025-04-17 09:51:58', '2025-04-17 09:51:58'),
(1268, NULL, 'Konnur', '16', 'active', '2025-04-17 09:51:58', '2025-04-17 09:51:58'),
(1269, NULL, 'Koppa', '16', 'active', '2025-04-17 09:51:58', '2025-04-17 09:51:58'),
(1270, NULL, 'Koppal', '16', 'active', '2025-04-17 09:51:58', '2025-04-17 09:51:58'),
(1271, NULL, 'Koratagere', '16', 'active', '2025-04-17 09:51:58', '2025-04-17 09:51:58'),
(1272, NULL, 'Kotturu', '16', 'active', '2025-04-17 09:51:58', '2025-04-17 09:51:58'),
(1273, NULL, 'Krishnarajpet', '16', 'active', '2025-04-17 09:51:58', '2025-04-17 09:51:58'),
(1274, NULL, 'Kudachi', '16', 'active', '2025-04-17 09:51:58', '2025-04-17 09:51:58'),
(1275, NULL, 'Kudligi', '16', 'active', '2025-04-17 09:51:58', '2025-04-17 09:51:58'),
(1276, NULL, 'Kumsi', '16', 'active', '2025-04-17 09:51:58', '2025-04-17 09:51:58'),
(1277, NULL, 'Kumta', '16', 'active', '2025-04-17 09:51:58', '2025-04-17 09:51:58'),
(1278, NULL, 'Kundgol', '16', 'active', '2025-04-17 09:51:58', '2025-04-17 09:51:58'),
(1279, NULL, 'Kunigal', '16', 'active', '2025-04-17 09:51:58', '2025-04-17 09:51:58'),
(1280, NULL, 'Kurgunta', '16', 'active', '2025-04-17 09:51:58', '2025-04-17 09:51:58'),
(1281, NULL, 'Kushalnagar', '16', 'active', '2025-04-17 09:51:58', '2025-04-17 09:51:58'),
(1282, NULL, 'Kushtagi', '16', 'active', '2025-04-17 09:51:58', '2025-04-17 09:51:58'),
(1283, NULL, 'Lakshmeshwar', '16', 'active', '2025-04-17 09:51:58', '2025-04-17 09:51:58'),
(1284, NULL, 'Lingsugur', '16', 'active', '2025-04-17 09:51:58', '2025-04-17 09:51:58'),
(1285, NULL, 'Londa', '16', 'active', '2025-04-17 09:51:58', '2025-04-17 09:51:58'),
(1286, NULL, 'Maddagiri', '16', 'active', '2025-04-17 09:51:58', '2025-04-17 09:51:58'),
(1287, NULL, 'Maddur', '16', 'active', '2025-04-17 09:51:58', '2025-04-17 09:51:58'),
(1288, NULL, 'Madikeri', '16', 'active', '2025-04-17 09:51:58', '2025-04-17 09:51:58'),
(1289, NULL, 'Magadi', '16', 'active', '2025-04-17 09:51:58', '2025-04-17 09:51:58'),
(1290, NULL, 'Mahalingpur', '16', 'active', '2025-04-17 09:51:58', '2025-04-17 09:51:58'),
(1291, NULL, 'Malavalli', '16', 'active', '2025-04-17 09:51:58', '2025-04-17 09:51:58'),
(1292, NULL, 'Malpe', '16', 'active', '2025-04-17 09:51:58', '2025-04-17 09:51:58'),
(1293, NULL, 'Malur', '16', 'active', '2025-04-17 09:51:58', '2025-04-17 09:51:58'),
(1294, NULL, 'Mandya', '16', 'active', '2025-04-17 09:51:58', '2025-04-17 09:51:58'),
(1295, NULL, 'Mangaluru', '16', 'active', '2025-04-17 09:51:58', '2025-04-17 09:51:58'),
(1296, NULL, 'Manipal', '16', 'active', '2025-04-17 09:51:58', '2025-04-17 09:51:58'),
(1297, NULL, 'Manvi', '16', 'active', '2025-04-17 09:51:58', '2025-04-17 09:51:58'),
(1298, NULL, 'Mayakonda', '16', 'active', '2025-04-17 09:51:58', '2025-04-17 09:51:58'),
(1299, NULL, 'Melukote', '16', 'active', '2025-04-17 09:51:58', '2025-04-17 09:51:58'),
(1300, NULL, 'Mudbidri', '16', 'active', '2025-04-17 09:51:58', '2025-04-17 09:51:58'),
(1301, NULL, 'Muddebihal', '16', 'active', '2025-04-17 09:51:58', '2025-04-17 09:51:58'),
(1302, NULL, 'Mudgal', '16', 'active', '2025-04-17 09:51:58', '2025-04-17 09:51:58'),
(1303, NULL, 'Mudgere', '16', 'active', '2025-04-17 09:51:58', '2025-04-17 09:51:58'),
(1304, NULL, 'Mudhol', '16', 'active', '2025-04-17 09:51:58', '2025-04-17 09:51:58'),
(1305, NULL, 'Mulbagal', '16', 'active', '2025-04-17 09:51:58', '2025-04-17 09:51:58'),
(1306, NULL, 'Mulgund', '16', 'active', '2025-04-17 09:51:58', '2025-04-17 09:51:58'),
(1307, NULL, 'Mulki', '16', 'active', '2025-04-17 09:51:58', '2025-04-17 09:51:58'),
(1308, NULL, 'Mundargi', '16', 'active', '2025-04-17 09:51:58', '2025-04-17 09:51:58'),
(1309, NULL, 'Mundgod', '16', 'active', '2025-04-17 09:51:58', '2025-04-17 09:51:58'),
(1310, NULL, 'Munirabad', '16', 'active', '2025-04-17 09:51:58', '2025-04-17 09:51:58'),
(1311, NULL, 'Murudeshwara', '16', 'active', '2025-04-17 09:51:58', '2025-04-17 09:51:58'),
(1312, NULL, 'Mysuru', '16', 'active', '2025-04-17 09:51:58', '2025-04-17 09:51:58'),
(1313, NULL, 'Nagamangala', '16', 'active', '2025-04-17 09:51:58', '2025-04-17 09:51:58'),
(1314, NULL, 'Nanjangud', '16', 'active', '2025-04-17 09:51:58', '2025-04-17 09:51:58'),
(1315, NULL, 'Narasimharajapura', '16', 'active', '2025-04-17 09:51:58', '2025-04-17 09:51:58'),
(1316, NULL, 'Naregal', '16', 'active', '2025-04-17 09:51:58', '2025-04-17 09:51:58'),
(1317, NULL, 'Nargund', '16', 'active', '2025-04-17 09:51:58', '2025-04-17 09:51:58'),
(1318, NULL, 'Navalgund', '16', 'active', '2025-04-17 09:51:58', '2025-04-17 09:51:58'),
(1319, NULL, 'Nelamangala', '16', 'active', '2025-04-17 09:51:58', '2025-04-17 09:51:58'),
(1320, NULL, 'Nyamti', '16', 'active', '2025-04-17 09:51:58', '2025-04-17 09:51:58'),
(1321, NULL, 'Pangala', '16', 'active', '2025-04-17 09:51:58', '2025-04-17 09:51:58'),
(1322, NULL, 'Pavugada', '16', 'active', '2025-04-17 09:51:58', '2025-04-17 09:51:58'),
(1323, NULL, 'Piriyapatna', '16', 'active', '2025-04-17 09:51:58', '2025-04-17 09:51:58'),
(1324, NULL, 'Ponnampet', '16', 'active', '2025-04-17 09:51:58', '2025-04-17 09:51:58'),
(1325, NULL, 'Puttur', '16', 'active', '2025-04-17 09:51:58', '2025-04-17 09:51:58'),
(1326, NULL, 'Rabkavi', '16', 'active', '2025-04-17 09:51:58', '2025-04-17 09:51:58'),
(1327, NULL, 'Raichur', '16', 'active', '2025-04-17 09:51:58', '2025-04-17 09:51:58'),
(1328, NULL, 'Ramanagara', '16', 'active', '2025-04-17 09:51:58', '2025-04-17 09:51:58'),
(1329, NULL, 'Ranibennur', '16', 'active', '2025-04-17 09:51:58', '2025-04-17 09:51:58'),
(1330, NULL, 'Raybag', '16', 'active', '2025-04-17 09:51:58', '2025-04-17 09:51:58'),
(1331, NULL, 'Robertsonpet', '16', 'active', '2025-04-17 09:51:58', '2025-04-17 09:51:58'),
(1332, NULL, 'Ron', '16', 'active', '2025-04-17 09:51:58', '2025-04-17 09:51:58'),
(1333, NULL, 'Sadalgi', '16', 'active', '2025-04-17 09:51:58', '2025-04-17 09:51:58'),
(1334, NULL, 'Sagar', '16', 'active', '2025-04-17 09:51:58', '2025-04-17 09:51:58'),
(1335, NULL, 'Sakleshpur', '16', 'active', '2025-04-17 09:51:58', '2025-04-17 09:51:58'),
(1336, NULL, 'Sandur', '16', 'active', '2025-04-17 09:51:58', '2025-04-17 09:51:58'),
(1337, NULL, 'Sanivarsante', '16', 'active', '2025-04-17 09:51:58', '2025-04-17 09:51:58'),
(1338, NULL, 'Sankeshwar', '16', 'active', '2025-04-17 09:51:58', '2025-04-17 09:51:58'),
(1339, NULL, 'Sargur', '16', 'active', '2025-04-17 09:51:58', '2025-04-17 09:51:58'),
(1340, NULL, 'Saundatti', '16', 'active', '2025-04-17 09:51:58', '2025-04-17 09:51:58'),
(1341, NULL, 'Savanur', '16', 'active', '2025-04-17 09:51:58', '2025-04-17 09:51:58'),
(1342, NULL, 'Seram', '16', 'active', '2025-04-17 09:51:58', '2025-04-17 09:51:58'),
(1343, NULL, 'Shahabad', '16', 'active', '2025-04-17 09:51:58', '2025-04-17 09:51:58'),
(1344, NULL, 'Shahpur', '16', 'active', '2025-04-17 09:51:58', '2025-04-17 09:51:58'),
(1345, NULL, 'Shiggaon', '16', 'active', '2025-04-17 09:51:58', '2025-04-17 09:51:58'),
(1346, NULL, 'Shikarpur', '16', 'active', '2025-04-17 09:51:58', '2025-04-17 09:51:58'),
(1347, NULL, 'Shimoga', '16', 'active', '2025-04-17 09:51:58', '2025-04-17 09:51:58'),
(1348, NULL, 'Shirhatti', '16', 'active', '2025-04-17 09:51:58', '2025-04-17 09:51:58'),
(1349, NULL, 'Shorapur', '16', 'active', '2025-04-17 09:51:58', '2025-04-17 09:51:58'),
(1350, NULL, 'Shrirangapattana', '16', 'active', '2025-04-17 09:51:58', '2025-04-17 09:51:58'),
(1351, NULL, 'Siddapur', '16', 'active', '2025-04-17 09:51:58', '2025-04-17 09:51:58'),
(1352, NULL, 'Sidlaghatta', '16', 'active', '2025-04-17 09:51:58', '2025-04-17 09:51:58'),
(1353, NULL, 'Sindgi', '16', 'active', '2025-04-17 09:51:58', '2025-04-17 09:51:58'),
(1354, NULL, 'Sindhnur', '16', 'active', '2025-04-17 09:51:58', '2025-04-17 09:51:58'),
(1355, NULL, 'Sira', '16', 'active', '2025-04-17 09:51:58', '2025-04-17 09:51:58'),
(1356, NULL, 'Sirsi', '16', 'active', '2025-04-17 09:51:58', '2025-04-17 09:51:58'),
(1357, NULL, 'Siruguppa', '16', 'active', '2025-04-17 09:51:58', '2025-04-17 09:51:58'),
(1358, NULL, 'Someshwar', '16', 'active', '2025-04-17 09:51:58', '2025-04-17 09:51:58'),
(1359, NULL, 'Somvarpet', '16', 'active', '2025-04-17 09:51:58', '2025-04-17 09:51:58'),
(1360, NULL, 'Sorab', '16', 'active', '2025-04-17 09:51:58', '2025-04-17 09:51:58'),
(1361, NULL, 'Sravana Belgola', '16', 'active', '2025-04-17 09:51:58', '2025-04-17 09:51:58'),
(1362, NULL, 'Sringeri', '16', 'active', '2025-04-17 09:51:58', '2025-04-17 09:51:58'),
(1363, NULL, 'Srinivaspur', '16', 'active', '2025-04-17 09:51:58', '2025-04-17 09:51:58'),
(1364, NULL, 'Sulya', '16', 'active', '2025-04-17 09:51:58', '2025-04-17 09:51:58'),
(1365, NULL, 'Suntikoppa', '16', 'active', '2025-04-17 09:51:58', '2025-04-17 09:51:58'),
(1366, NULL, 'Talikota', '16', 'active', '2025-04-17 09:51:58', '2025-04-17 09:51:58'),
(1367, NULL, 'Tarikere', '16', 'active', '2025-04-17 09:51:58', '2025-04-17 09:51:58'),
(1368, NULL, 'Tekkalakote', '16', 'active', '2025-04-17 09:51:58', '2025-04-17 09:51:58'),
(1369, NULL, 'Terdal', '16', 'active', '2025-04-17 09:51:58', '2025-04-17 09:51:58'),
(1370, NULL, 'Tiptur', '16', 'active', '2025-04-17 09:51:58', '2025-04-17 09:51:58'),
(1371, NULL, 'Tirthahalli', '16', 'active', '2025-04-17 09:51:58', '2025-04-17 09:51:58'),
(1372, NULL, 'Tirumakudal Narsipur', '16', 'active', '2025-04-17 09:51:58', '2025-04-17 09:51:58'),
(1373, NULL, 'Tumakuru', '16', 'active', '2025-04-17 09:51:58', '2025-04-17 09:51:58'),
(1374, NULL, 'Turuvekere', '16', 'active', '2025-04-17 09:51:58', '2025-04-17 09:51:58'),
(1375, NULL, 'Udupi', '16', 'active', '2025-04-17 09:51:58', '2025-04-17 09:51:58'),
(1376, NULL, 'Ullal', '16', 'active', '2025-04-17 09:51:58', '2025-04-17 09:51:58'),
(1377, NULL, 'Uttar Kannada', '16', 'active', '2025-04-17 09:51:58', '2025-04-17 09:51:58'),
(1378, NULL, 'Vadigenhalli', '16', 'active', '2025-04-17 09:51:58', '2025-04-17 09:51:58'),
(1379, NULL, 'Vijayapura', '16', 'active', '2025-04-17 09:51:58', '2025-04-17 09:51:58'),
(1380, NULL, 'Virarajendrapet', '16', 'active', '2025-04-17 09:51:58', '2025-04-17 09:51:58'),
(1381, NULL, 'Wadi', '16', 'active', '2025-04-17 09:51:58', '2025-04-17 09:51:58'),
(1382, NULL, 'Yadgir', '16', 'active', '2025-04-17 09:51:58', '2025-04-17 09:51:58'),
(1383, NULL, 'Yelahanka', '16', 'active', '2025-04-17 09:51:58', '2025-04-17 09:51:58'),
(1384, NULL, 'Yelandur', '16', 'active', '2025-04-17 09:51:58', '2025-04-17 09:51:58'),
(1385, NULL, 'Yelbarga', '16', 'active', '2025-04-17 09:51:58', '2025-04-17 09:51:58'),
(1386, NULL, 'Yellapur', '16', 'active', '2025-04-17 09:51:58', '2025-04-17 09:51:58'),
(1387, NULL, 'Adoor', '17', 'active', '2025-04-17 09:51:58', '2025-04-17 09:51:58'),
(1388, NULL, 'Alappuzha', '17', 'active', '2025-04-17 09:51:58', '2025-04-17 09:51:58'),
(1389, NULL, 'Aluva', '17', 'active', '2025-04-17 09:51:58', '2025-04-17 09:51:58'),
(1390, NULL, 'Alwaye', '17', 'active', '2025-04-17 09:51:58', '2025-04-17 09:51:58'),
(1391, NULL, 'Angamali', '17', 'active', '2025-04-17 09:51:58', '2025-04-17 09:51:58'),
(1392, NULL, 'Aroor', '17', 'active', '2025-04-17 09:51:58', '2025-04-17 09:51:58'),
(1393, NULL, 'Arukutti', '17', 'active', '2025-04-17 09:51:58', '2025-04-17 09:51:58'),
(1394, NULL, 'Attingal', '17', 'active', '2025-04-17 09:51:58', '2025-04-17 09:51:58'),
(1395, NULL, 'Avanoor', '17', 'active', '2025-04-17 09:51:58', '2025-04-17 09:51:58'),
(1396, NULL, 'Azhikkal', '17', 'active', '2025-04-17 09:51:58', '2025-04-17 09:51:58'),
(1397, NULL, 'Beypore', '17', 'active', '2025-04-17 09:51:58', '2025-04-17 09:51:58'),
(1398, NULL, 'Changanacheri', '17', 'active', '2025-04-17 09:51:58', '2025-04-17 09:51:58'),
(1399, NULL, 'Chelakara', '17', 'active', '2025-04-17 09:51:58', '2025-04-17 09:51:58'),
(1400, NULL, 'Chengannur', '17', 'active', '2025-04-17 09:51:58', '2025-04-17 09:51:58'),
(1401, NULL, 'Cherpulassery', '17', 'active', '2025-04-17 09:51:58', '2025-04-17 09:51:58'),
(1402, NULL, 'Cherthala', '17', 'active', '2025-04-17 09:51:58', '2025-04-17 09:51:58'),
(1403, NULL, 'Chetwayi', '17', 'active', '2025-04-17 09:51:58', '2025-04-17 09:51:58'),
(1404, NULL, 'Chittur', '17', 'active', '2025-04-17 09:51:58', '2025-04-17 09:51:58'),
(1405, NULL, 'Cochin', '17', 'active', '2025-04-17 09:51:58', '2025-04-17 09:51:58'),
(1406, NULL, 'Dharmadom', '17', 'active', '2025-04-17 09:51:58', '2025-04-17 09:51:58'),
(1407, NULL, 'Edakkulam', '17', 'active', '2025-04-17 09:51:58', '2025-04-17 09:51:58'),
(1408, NULL, 'Elur', '17', 'active', '2025-04-17 09:51:58', '2025-04-17 09:51:58'),
(1409, NULL, 'Erattupetta', '17', 'active', '2025-04-17 09:51:58', '2025-04-17 09:51:58'),
(1410, NULL, 'Ernakulam', '17', 'active', '2025-04-17 09:51:58', '2025-04-17 09:51:58'),
(1411, NULL, 'Ferokh', '17', 'active', '2025-04-17 09:51:58', '2025-04-17 09:51:58'),
(1412, NULL, 'Guruvayur', '17', 'active', '2025-04-17 09:51:58', '2025-04-17 09:51:58'),
(1413, NULL, 'Idukki', '17', 'active', '2025-04-17 09:51:58', '2025-04-17 09:51:58'),
(1414, NULL, 'Iringal', '17', 'active', '2025-04-17 09:51:58', '2025-04-17 09:51:58'),
(1415, NULL, 'Irinjalakuda', '17', 'active', '2025-04-17 09:51:58', '2025-04-17 09:51:58'),
(1416, NULL, 'Kadakkavoor', '17', 'active', '2025-04-17 09:51:58', '2025-04-17 09:51:58'),
(1417, NULL, 'Kalamassery', '17', 'active', '2025-04-17 09:51:58', '2025-04-17 09:51:58'),
(1418, NULL, 'Kalavoor', '17', 'active', '2025-04-17 09:51:58', '2025-04-17 09:51:58'),
(1419, NULL, 'Kalpetta', '17', 'active', '2025-04-17 09:51:58', '2025-04-17 09:51:58'),
(1420, NULL, 'Kanhangad', '17', 'active', '2025-04-17 09:51:58', '2025-04-17 09:51:58'),
(1421, NULL, 'Kannavam', '17', 'active', '2025-04-17 09:51:58', '2025-04-17 09:51:58'),
(1422, NULL, 'Kannur', '17', 'active', '2025-04-17 09:51:58', '2025-04-17 09:51:58'),
(1423, NULL, 'Kasaragod', '17', 'active', '2025-04-17 09:51:58', '2025-04-17 09:51:58'),
(1424, NULL, 'Kattanam', '17', 'active', '2025-04-17 09:51:58', '2025-04-17 09:51:58'),
(1425, NULL, 'Kayankulam', '17', 'active', '2025-04-17 09:51:58', '2025-04-17 09:51:58'),
(1426, NULL, 'Kizhake Chalakudi', '17', 'active', '2025-04-17 09:51:58', '2025-04-17 09:51:58'),
(1427, NULL, 'Kodungallur', '17', 'active', '2025-04-17 09:51:58', '2025-04-17 09:51:58'),
(1428, NULL, 'Kollam', '17', 'active', '2025-04-17 09:51:58', '2025-04-17 09:51:58'),
(1429, NULL, 'Kotamangalam', '17', 'active', '2025-04-17 09:51:58', '2025-04-17 09:51:58'),
(1430, NULL, 'Kottayam', '17', 'active', '2025-04-17 09:51:58', '2025-04-17 09:51:58'),
(1431, NULL, 'Kovalam', '17', 'active', '2025-04-17 09:51:58', '2025-04-17 09:51:58'),
(1432, NULL, 'Kozhikode', '17', 'active', '2025-04-17 09:51:58', '2025-04-17 09:51:58'),
(1433, NULL, 'Kumbalam', '17', 'active', '2025-04-17 09:51:58', '2025-04-17 09:51:58'),
(1434, NULL, 'Kunnamangalam', '17', 'active', '2025-04-17 09:51:58', '2025-04-17 09:51:58'),
(1435, NULL, 'Kunnamkulam', '17', 'active', '2025-04-17 09:51:58', '2025-04-17 09:51:58'),
(1436, NULL, 'Kunnumma', '17', 'active', '2025-04-17 09:51:58', '2025-04-17 09:51:58'),
(1437, NULL, 'Kutiatodu', '17', 'active', '2025-04-17 09:51:58', '2025-04-17 09:51:58'),
(1438, NULL, 'Kuttampuzha', '17', 'active', '2025-04-17 09:51:58', '2025-04-17 09:51:58'),
(1439, NULL, 'Lalam', '17', 'active', '2025-04-17 09:51:58', '2025-04-17 09:51:58'),
(1440, NULL, 'Mahe', '17', 'active', '2025-04-17 09:51:58', '2025-04-17 09:51:58'),
(1441, NULL, 'Malappuram', '17', 'active', '2025-04-17 09:51:58', '2025-04-17 09:51:58'),
(1442, NULL, 'Manjeri', '17', 'active', '2025-04-17 09:51:58', '2025-04-17 09:51:58'),
(1443, NULL, 'Manjeshwaram', '17', 'active', '2025-04-17 09:51:58', '2025-04-17 09:51:58'),
(1444, NULL, 'Mannarakkat', '17', 'active', '2025-04-17 09:51:58', '2025-04-17 09:51:58'),
(1445, NULL, 'Marayur', '17', 'active', '2025-04-17 09:51:58', '2025-04-17 09:51:58'),
(1446, NULL, 'Mattanur', '17', 'active', '2025-04-17 09:51:58', '2025-04-17 09:51:58'),
(1447, NULL, 'Mavelikara', '17', 'active', '2025-04-17 09:51:58', '2025-04-17 09:51:58'),
(1448, NULL, 'Mavoor', '17', 'active', '2025-04-17 09:51:58', '2025-04-17 09:51:58'),
(1449, NULL, 'Muluppilagadu', '17', 'active', '2025-04-17 09:51:58', '2025-04-17 09:51:58'),
(1450, NULL, 'Munnar', '17', 'active', '2025-04-17 09:51:58', '2025-04-17 09:51:58'),
(1451, NULL, 'Muvattupula', '17', 'active', '2025-04-17 09:51:58', '2025-04-17 09:51:58'),
(1452, NULL, 'Muvattupuzha', '17', 'active', '2025-04-17 09:51:58', '2025-04-17 09:51:58'),
(1453, NULL, 'Nadapuram', '17', 'active', '2025-04-17 09:51:58', '2025-04-17 09:51:58'),
(1454, NULL, 'Naduvannur', '17', 'active', '2025-04-17 09:51:58', '2025-04-17 09:51:58'),
(1455, NULL, 'Nedumangad', '17', 'active', '2025-04-17 09:51:58', '2025-04-17 09:51:58'),
(1456, NULL, 'Neyyattinkara', '17', 'active', '2025-04-17 09:51:58', '2025-04-17 09:51:58'),
(1457, NULL, 'Nileshwar', '17', 'active', '2025-04-17 09:51:58', '2025-04-17 09:51:58'),
(1458, NULL, 'Ottappalam', '17', 'active', '2025-04-17 09:51:58', '2025-04-17 09:51:58'),
(1459, NULL, 'Palackattumala', '17', 'active', '2025-04-17 09:51:58', '2025-04-17 09:51:58'),
(1460, NULL, 'Palakkad district', '17', 'active', '2025-04-17 09:51:58', '2025-04-17 09:51:58'),
(1461, NULL, 'Palghat', '17', 'active', '2025-04-17 09:51:58', '2025-04-17 09:51:58'),
(1462, NULL, 'Panamaram', '17', 'active', '2025-04-17 09:51:58', '2025-04-17 09:51:58'),
(1463, NULL, 'Pappinissheri', '17', 'active', '2025-04-17 09:51:58', '2025-04-17 09:51:58'),
(1464, NULL, 'Paravur Tekkumbhagam', '17', 'active', '2025-04-17 09:51:58', '2025-04-17 09:51:58'),
(1465, NULL, 'Pariyapuram', '17', 'active', '2025-04-17 09:51:58', '2025-04-17 09:51:58'),
(1466, NULL, 'Pathanamthitta', '17', 'active', '2025-04-17 09:51:58', '2025-04-17 09:51:58'),
(1467, NULL, 'Pattanamtitta', '17', 'active', '2025-04-17 09:51:58', '2025-04-17 09:51:58'),
(1468, NULL, 'Payyanur', '17', 'active', '2025-04-17 09:51:58', '2025-04-17 09:51:58'),
(1469, NULL, 'Perinthalmanna', '17', 'active', '2025-04-17 09:51:58', '2025-04-17 09:51:58'),
(1470, NULL, 'Perumbavoor', '17', 'active', '2025-04-17 09:51:58', '2025-04-17 09:51:58'),
(1471, NULL, 'Perumpavur', '17', 'active', '2025-04-17 09:51:58', '2025-04-17 09:51:58'),
(1472, NULL, 'Perya', '17', 'active', '2025-04-17 09:51:58', '2025-04-17 09:51:58'),
(1473, NULL, 'Piravam', '17', 'active', '2025-04-17 09:51:58', '2025-04-17 09:51:58'),
(1474, NULL, 'Ponmana', '17', 'active', '2025-04-17 09:51:58', '2025-04-17 09:51:58'),
(1475, NULL, 'Ponnani', '17', 'active', '2025-04-17 09:51:58', '2025-04-17 09:51:58'),
(1476, NULL, 'Punalur', '17', 'active', '2025-04-17 09:51:58', '2025-04-17 09:51:58'),
(1477, NULL, 'Ramamangalam', '17', 'active', '2025-04-17 09:51:58', '2025-04-17 09:51:58'),
(1478, NULL, 'Shertallai', '17', 'active', '2025-04-17 09:51:58', '2025-04-17 09:51:58'),
(1479, NULL, 'Shoranur', '17', 'active', '2025-04-17 09:51:58', '2025-04-17 09:51:58'),
(1480, NULL, 'Taliparamba', '17', 'active', '2025-04-17 09:51:58', '2025-04-17 09:51:58'),
(1481, NULL, 'Thalassery', '17', 'active', '2025-04-17 09:51:58', '2025-04-17 09:51:58'),
(1482, NULL, 'Thanniyam', '17', 'active', '2025-04-17 09:51:58', '2025-04-17 09:51:58'),
(1483, NULL, 'Thiruvananthapuram', '17', 'active', '2025-04-17 09:51:58', '2025-04-17 09:51:58'),
(1484, NULL, 'Thrissur', '17', 'active', '2025-04-17 09:51:58', '2025-04-17 09:51:58'),
(1485, NULL, 'Tirur', '17', 'active', '2025-04-17 09:51:58', '2025-04-17 09:51:58'),
(1486, NULL, 'Tiruvalla', '17', 'active', '2025-04-17 09:51:58', '2025-04-17 09:51:58'),
(1487, NULL, 'Vaikam', '17', 'active', '2025-04-17 09:51:58', '2025-04-17 09:51:58'),
(1488, NULL, 'Varkala', '17', 'active', '2025-04-17 09:51:58', '2025-04-17 09:51:58'),
(1489, NULL, 'Vatakara', '17', 'active', '2025-04-17 09:51:58', '2025-04-17 09:51:58'),
(1490, NULL, 'Vayalar', '17', 'active', '2025-04-17 09:51:58', '2025-04-17 09:51:58'),
(1491, NULL, 'Vettur', '17', 'active', '2025-04-17 09:51:58', '2025-04-17 09:51:58'),
(1492, NULL, 'Wayanad', '17', 'active', '2025-04-17 09:51:58', '2025-04-17 09:51:58'),
(1493, NULL, 'Kargil', '18', 'active', '2025-04-17 09:51:58', '2025-04-17 09:51:58'),
(1494, NULL, 'Leh', '18', 'active', '2025-04-17 09:51:58', '2025-04-17 09:51:58'),
(1495, NULL, 'Kavaratti', '19', 'active', '2025-04-17 09:51:58', '2025-04-17 09:51:58'),
(1496, NULL, 'Lakshadweep', '19', 'active', '2025-04-17 09:51:58', '2025-04-17 09:51:58'),
(1497, NULL, 'Agar', '20', 'active', '2025-04-17 09:51:58', '2025-04-17 09:51:58'),
(1498, NULL, 'Ajaigarh', '20', 'active', '2025-04-17 09:51:58', '2025-04-17 09:51:58'),
(1499, NULL, 'Akodia', '20', 'active', '2025-04-17 09:51:58', '2025-04-17 09:51:58'),
(1500, NULL, 'Alampur', '20', 'active', '2025-04-17 09:51:58', '2025-04-17 09:51:58'),
(1501, NULL, 'Alirajpur', '20', 'active', '2025-04-17 09:51:58', '2025-04-17 09:51:58'),
(1502, NULL, 'Alot', '20', 'active', '2025-04-17 09:51:58', '2025-04-17 09:51:58'),
(1503, NULL, 'Amanganj', '20', 'active', '2025-04-17 09:51:58', '2025-04-17 09:51:58'),
(1504, NULL, 'Amarkantak', '20', 'active', '2025-04-17 09:51:58', '2025-04-17 09:51:58'),
(1505, NULL, 'Amarpatan', '20', 'active', '2025-04-17 09:51:58', '2025-04-17 09:51:58'),
(1506, NULL, 'Amarwara', '20', 'active', '2025-04-17 09:51:58', '2025-04-17 09:51:58'),
(1507, NULL, 'Ambah', '20', 'active', '2025-04-17 09:51:58', '2025-04-17 09:51:58'),
(1508, NULL, 'Amla', '20', 'active', '2025-04-17 09:51:58', '2025-04-17 09:51:58'),
(1509, NULL, 'Anjad', '20', 'active', '2025-04-17 09:51:58', '2025-04-17 09:51:58'),
(1510, NULL, 'Antri', '20', 'active', '2025-04-17 09:51:58', '2025-04-17 09:51:58'),
(1511, NULL, 'Anuppur', '20', 'active', '2025-04-17 09:51:58', '2025-04-17 09:51:58'),
(1512, NULL, 'Aron', '20', 'active', '2025-04-17 09:51:58', '2025-04-17 09:51:58'),
(1513, NULL, 'Ashoknagar', '20', 'active', '2025-04-17 09:51:58', '2025-04-17 09:51:58'),
(1514, NULL, 'Ashta', '20', 'active', '2025-04-17 09:51:58', '2025-04-17 09:51:58'),
(1515, NULL, 'Babai', '20', 'active', '2025-04-17 09:51:58', '2025-04-17 09:51:58'),
(1516, NULL, 'Badarwas', '20', 'active', '2025-04-17 09:51:58', '2025-04-17 09:51:58'),
(1517, NULL, 'Badnawar', '20', 'active', '2025-04-17 09:51:58', '2025-04-17 09:51:58'),
(1518, NULL, 'Bagh', '20', 'active', '2025-04-17 09:51:58', '2025-04-17 09:51:58'),
(1519, NULL, 'Bagli', '20', 'active', '2025-04-17 09:51:58', '2025-04-17 09:51:58'),
(1520, NULL, 'Baihar', '20', 'active', '2025-04-17 09:51:58', '2025-04-17 09:51:58'),
(1521, NULL, 'Baikunthpur', '20', 'active', '2025-04-17 09:51:58', '2025-04-17 09:51:58'),
(1522, NULL, 'Bakshwaha', '20', 'active', '2025-04-17 09:51:58', '2025-04-17 09:51:58'),
(1523, NULL, 'Balaghat', '20', 'active', '2025-04-17 09:51:58', '2025-04-17 09:51:58'),
(1524, NULL, 'Baldeogarh', '20', 'active', '2025-04-17 09:51:58', '2025-04-17 09:51:58'),
(1525, NULL, 'Bamna', '20', 'active', '2025-04-17 09:51:58', '2025-04-17 09:51:58'),
(1526, NULL, 'Bamor Kalan', '20', 'active', '2025-04-17 09:51:58', '2025-04-17 09:51:58'),
(1527, NULL, 'Bamora', '20', 'active', '2025-04-17 09:51:58', '2025-04-17 09:51:58'),
(1528, NULL, 'Banda', '20', 'active', '2025-04-17 09:51:58', '2025-04-17 09:51:58'),
(1529, NULL, 'Barela', '20', 'active', '2025-04-17 09:51:58', '2025-04-17 09:51:58'),
(1530, NULL, 'Barghat', '20', 'active', '2025-04-17 09:51:58', '2025-04-17 09:51:58'),
(1531, NULL, 'Bargi', '20', 'active', '2025-04-17 09:51:58', '2025-04-17 09:51:58'),
(1532, NULL, 'Barhi', '20', 'active', '2025-04-17 09:51:58', '2025-04-17 09:51:58'),
(1533, NULL, 'Barwani', '20', 'active', '2025-04-17 09:51:58', '2025-04-17 09:51:58'),
(1534, NULL, 'Basoda', '20', 'active', '2025-04-17 09:51:58', '2025-04-17 09:51:58'),
(1535, NULL, 'Begamganj', '20', 'active', '2025-04-17 09:51:58', '2025-04-17 09:51:58'),
(1536, NULL, 'Beohari', '20', 'active', '2025-04-17 09:51:58', '2025-04-17 09:51:58'),
(1537, NULL, 'Berasia', '20', 'active', '2025-04-17 09:51:58', '2025-04-17 09:51:58'),
(1538, NULL, 'Betma', '20', 'active', '2025-04-17 09:51:58', '2025-04-17 09:51:58'),
(1539, NULL, 'Betul', '20', 'active', '2025-04-17 09:51:58', '2025-04-17 09:51:58'),
(1540, NULL, 'Betul Bazar', '20', 'active', '2025-04-17 09:51:58', '2025-04-17 09:51:58'),
(1541, NULL, 'Bhabhra', '20', 'active', '2025-04-17 09:51:58', '2025-04-17 09:51:58'),
(1542, NULL, 'Bhainsdehi', '20', 'active', '2025-04-17 09:51:58', '2025-04-17 09:51:58'),
(1543, NULL, 'Bhander', '20', 'active', '2025-04-17 09:51:58', '2025-04-17 09:51:58'),
(1544, NULL, 'Bhanpura', '20', 'active', '2025-04-17 09:51:58', '2025-04-17 09:51:58'),
(1545, NULL, 'Bhawaniganj', '20', 'active', '2025-04-17 09:51:58', '2025-04-17 09:51:58'),
(1546, NULL, 'Bhikangaon', '20', 'active', '2025-04-17 09:51:58', '2025-04-17 09:51:58'),
(1547, NULL, 'Bhind', '20', 'active', '2025-04-17 09:51:58', '2025-04-17 09:51:58'),
(1548, NULL, 'Bhitarwar', '20', 'active', '2025-04-17 09:51:58', '2025-04-17 09:51:58'),
(1549, NULL, 'Bhopal', '20', 'active', '2025-04-17 09:51:58', '2025-04-17 09:51:58'),
(1550, NULL, 'Biaora', '20', 'active', '2025-04-17 09:51:58', '2025-04-17 09:51:58'),
(1551, NULL, 'Bijawar', '20', 'active', '2025-04-17 09:51:58', '2025-04-17 09:51:58'),
(1552, NULL, 'Bijrauni', '20', 'active', '2025-04-17 09:51:58', '2025-04-17 09:51:58'),
(1553, NULL, 'Bodri', '20', 'active', '2025-04-17 09:51:58', '2025-04-17 09:51:58'),
(1554, NULL, 'Burhanpur', '20', 'active', '2025-04-17 09:51:58', '2025-04-17 09:51:58'),
(1555, NULL, 'Burhar', '20', 'active', '2025-04-17 09:51:58', '2025-04-17 09:51:58'),
(1556, NULL, 'Chanderi', '20', 'active', '2025-04-17 09:51:58', '2025-04-17 09:51:58'),
(1557, NULL, 'Chandia', '20', 'active', '2025-04-17 09:51:58', '2025-04-17 09:51:58'),
(1558, NULL, 'Chandla', '20', 'active', '2025-04-17 09:51:58', '2025-04-17 09:51:58'),
(1559, NULL, 'Chhatarpur', '20', 'active', '2025-04-17 09:51:58', '2025-04-17 09:51:58'),
(1560, NULL, 'Chhindwara', '20', 'active', '2025-04-17 09:51:58', '2025-04-17 09:51:58'),
(1561, NULL, 'Chichli', '20', 'active', '2025-04-17 09:51:58', '2025-04-17 09:51:58'),
(1562, NULL, 'Chorhat', '20', 'active', '2025-04-17 09:51:58', '2025-04-17 09:51:58'),
(1563, NULL, 'Daboh', '20', 'active', '2025-04-17 09:51:58', '2025-04-17 09:51:58'),
(1564, NULL, 'Dabra', '20', 'active', '2025-04-17 09:51:58', '2025-04-17 09:51:58'),
(1565, NULL, 'Damoh', '20', 'active', '2025-04-17 09:51:58', '2025-04-17 09:51:58'),
(1566, NULL, 'Datia', '20', 'active', '2025-04-17 09:51:58', '2025-04-17 09:51:58'),
(1567, NULL, 'Deori Khas', '20', 'active', '2025-04-17 09:51:58', '2025-04-17 09:51:58'),
(1568, NULL, 'Depalpur', '20', 'active', '2025-04-17 09:51:58', '2025-04-17 09:51:58'),
(1569, NULL, 'Dewas', '20', 'active', '2025-04-17 09:51:58', '2025-04-17 09:51:58'),
(1570, NULL, 'Dhamnod', '20', 'active', '2025-04-17 09:51:58', '2025-04-17 09:51:58'),
(1571, NULL, 'Dhana', '20', 'active', '2025-04-17 09:51:58', '2025-04-17 09:51:58'),
(1572, NULL, 'Dhar', '20', 'active', '2025-04-17 09:51:58', '2025-04-17 09:51:58'),
(1573, NULL, 'Dharampuri', '20', 'active', '2025-04-17 09:51:58', '2025-04-17 09:51:58'),
(1574, NULL, 'Dindori', '20', 'active', '2025-04-17 09:51:58', '2025-04-17 09:51:58'),
(1575, NULL, 'Etawa', '20', 'active', '2025-04-17 09:51:58', '2025-04-17 09:51:58'),
(1576, NULL, 'Gadarwara', '20', 'active', '2025-04-17 09:51:58', '2025-04-17 09:51:58'),
(1577, NULL, 'Garha Brahman', '20', 'active', '2025-04-17 09:51:58', '2025-04-17 09:51:58'),
(1578, NULL, 'Garhakota', '20', 'active', '2025-04-17 09:51:58', '2025-04-17 09:51:58'),
(1579, NULL, 'Gautampura', '20', 'active', '2025-04-17 09:51:58', '2025-04-17 09:51:58'),
(1580, NULL, 'Ghansor', '20', 'active', '2025-04-17 09:51:58', '2025-04-17 09:51:58'),
(1581, NULL, 'Gogapur', '20', 'active', '2025-04-17 09:51:58', '2025-04-17 09:51:58'),
(1582, NULL, 'Gohadi', '20', 'active', '2025-04-17 09:51:58', '2025-04-17 09:51:58'),
(1583, NULL, 'Govindgarh', '20', 'active', '2025-04-17 09:51:58', '2025-04-17 09:51:58'),
(1584, NULL, 'Guna', '20', 'active', '2025-04-17 09:51:58', '2025-04-17 09:51:58'),
(1585, NULL, 'Gurh', '20', 'active', '2025-04-17 09:51:58', '2025-04-17 09:51:58'),
(1586, NULL, 'Gwalior', '20', 'active', '2025-04-17 09:51:58', '2025-04-17 09:51:58'),
(1587, NULL, 'Harda', '20', 'active', '2025-04-17 09:51:58', '2025-04-17 09:51:58'),
(1588, NULL, 'Harda Khas', '20', 'active', '2025-04-17 09:51:58', '2025-04-17 09:51:58'),
(1589, NULL, 'Harpalpur', '20', 'active', '2025-04-17 09:51:58', '2025-04-17 09:51:58'),
(1590, NULL, 'Harrai', '20', 'active', '2025-04-17 09:51:58', '2025-04-17 09:51:58'),
(1591, NULL, 'Harsud', '20', 'active', '2025-04-17 09:51:58', '2025-04-17 09:51:58'),
(1592, NULL, 'Hatod', '20', 'active', '2025-04-17 09:51:58', '2025-04-17 09:51:58'),
(1593, NULL, 'Hatta', '20', 'active', '2025-04-17 09:51:58', '2025-04-17 09:51:58'),
(1594, NULL, 'Hindoria', '20', 'active', '2025-04-17 09:51:58', '2025-04-17 09:51:58'),
(1595, NULL, 'Hoshangabad', '20', 'active', '2025-04-17 09:51:58', '2025-04-17 09:51:58'),
(1596, NULL, 'Iawar', '20', 'active', '2025-04-17 09:51:58', '2025-04-17 09:51:58'),
(1597, NULL, 'Ichhawar', '20', 'active', '2025-04-17 09:51:58', '2025-04-17 09:51:58'),
(1598, NULL, 'Iklehra', '20', 'active', '2025-04-17 09:51:58', '2025-04-17 09:51:58'),
(1599, NULL, 'Indore', '20', 'active', '2025-04-17 09:51:58', '2025-04-17 09:51:58'),
(1600, NULL, 'Isagarh', '20', 'active', '2025-04-17 09:51:58', '2025-04-17 09:51:58'),
(1601, NULL, 'Itarsi', '20', 'active', '2025-04-17 09:51:58', '2025-04-17 09:51:58'),
(1602, NULL, 'Jabalpur', '20', 'active', '2025-04-17 09:51:58', '2025-04-17 09:51:58'),
(1603, NULL, 'Jaisinghnagar', '20', 'active', '2025-04-17 09:51:58', '2025-04-17 09:51:58'),
(1604, NULL, 'Jaithari', '20', 'active', '2025-04-17 09:51:58', '2025-04-17 09:51:58'),
(1605, NULL, 'Jamai', '20', 'active', '2025-04-17 09:51:58', '2025-04-17 09:51:58'),
(1606, NULL, 'Jaora', '20', 'active', '2025-04-17 09:51:58', '2025-04-17 09:51:58'),
(1607, NULL, 'Jatara', '20', 'active', '2025-04-17 09:51:58', '2025-04-17 09:51:58'),
(1608, NULL, 'Jawad', '20', 'active', '2025-04-17 09:51:58', '2025-04-17 09:51:58'),
(1609, NULL, 'Jhabua', '20', 'active', '2025-04-17 09:51:58', '2025-04-17 09:51:58'),
(1610, NULL, 'Jiran', '20', 'active', '2025-04-17 09:51:58', '2025-04-17 09:51:58'),
(1611, NULL, 'Jobat', '20', 'active', '2025-04-17 09:51:58', '2025-04-17 09:51:58'),
(1612, NULL, 'Kailaras', '20', 'active', '2025-04-17 09:51:58', '2025-04-17 09:51:58'),
(1613, NULL, 'Kaimori', '20', 'active', '2025-04-17 09:51:58', '2025-04-17 09:51:58'),
(1614, NULL, 'Kannod', '20', 'active', '2025-04-17 09:51:58', '2025-04-17 09:51:58'),
(1615, NULL, 'Kareli', '20', 'active', '2025-04-17 09:51:58', '2025-04-17 09:51:58'),
(1616, NULL, 'Karera', '20', 'active', '2025-04-17 09:51:58', '2025-04-17 09:51:58'),
(1617, NULL, 'Karrapur', '20', 'active', '2025-04-17 09:51:58', '2025-04-17 09:51:58'),
(1618, NULL, 'Kasrawad', '20', 'active', '2025-04-17 09:51:58', '2025-04-17 09:51:58'),
(1619, NULL, 'Katangi', '20', 'active', '2025-04-17 09:51:58', '2025-04-17 09:51:58'),
(1620, NULL, 'Katni', '20', 'active', '2025-04-17 09:51:58', '2025-04-17 09:51:58'),
(1621, NULL, 'Khachrod', '20', 'active', '2025-04-17 09:51:58', '2025-04-17 09:51:58'),
(1622, NULL, 'Khailar', '20', 'active', '2025-04-17 09:51:58', '2025-04-17 09:51:58'),
(1623, NULL, 'Khajuraho Group of Monuments', '20', 'active', '2025-04-17 09:51:58', '2025-04-17 09:51:58'),
(1624, NULL, 'Khamaria', '20', 'active', '2025-04-17 09:51:58', '2025-04-17 09:51:58'),
(1625, NULL, 'Khandwa', '20', 'active', '2025-04-17 09:51:58', '2025-04-17 09:51:58'),
(1626, NULL, 'Khargapur', '20', 'active', '2025-04-17 09:51:58', '2025-04-17 09:51:58'),
(1627, NULL, 'Khargone', '20', 'active', '2025-04-17 09:51:58', '2025-04-17 09:51:58'),
(1628, NULL, 'Khategaon', '20', 'active', '2025-04-17 09:51:58', '2025-04-17 09:51:58'),
(1629, NULL, 'Khilchipur', '20', 'active', '2025-04-17 09:51:58', '2025-04-17 09:51:58'),
(1630, NULL, 'Khirkiyan', '20', 'active', '2025-04-17 09:51:58', '2025-04-17 09:51:58'),
(1631, NULL, 'Khujner', '20', 'active', '2025-04-17 09:51:58', '2025-04-17 09:51:58'),
(1632, NULL, 'Khurai', '20', 'active', '2025-04-17 09:51:58', '2025-04-17 09:51:58'),
(1633, NULL, 'Kolaras', '20', 'active', '2025-04-17 09:51:58', '2025-04-17 09:51:58'),
(1634, NULL, 'Korwai', '20', 'active', '2025-04-17 09:51:58', '2025-04-17 09:51:58'),
(1635, NULL, 'Kotar', '20', 'active', '2025-04-17 09:51:58', '2025-04-17 09:51:58'),
(1636, NULL, 'Kothi', '20', 'active', '2025-04-17 09:51:58', '2025-04-17 09:51:58'),
(1637, NULL, 'Kotma', '20', 'active', '2025-04-17 09:51:58', '2025-04-17 09:51:58'),
(1638, NULL, 'Kotwa', '20', 'active', '2025-04-17 09:51:58', '2025-04-17 09:51:58'),
(1639, NULL, 'Kukshi', '20', 'active', '2025-04-17 09:51:58', '2025-04-17 09:51:58'),
(1640, NULL, 'Kumbhraj', '20', 'active', '2025-04-17 09:51:58', '2025-04-17 09:51:58'),
(1641, NULL, 'Lahar', '20', 'active', '2025-04-17 09:51:58', '2025-04-17 09:51:58'),
(1642, NULL, 'Lakhnadon', '20', 'active', '2025-04-17 09:51:58', '2025-04-17 09:51:58'),
(1643, NULL, 'Leteri', '20', 'active', '2025-04-17 09:51:58', '2025-04-17 09:51:58'),
(1644, NULL, 'Lodhikheda', '20', 'active', '2025-04-17 09:51:58', '2025-04-17 09:51:58'),
(1645, NULL, 'Machalpur', '20', 'active', '2025-04-17 09:51:58', '2025-04-17 09:51:58'),
(1646, NULL, 'Madhogarh', '20', 'active', '2025-04-17 09:51:58', '2025-04-17 09:51:58'),
(1647, NULL, 'Maheshwar', '20', 'active', '2025-04-17 09:51:58', '2025-04-17 09:51:58'),
(1648, NULL, 'Mahgawan', '20', 'active', '2025-04-17 09:51:58', '2025-04-17 09:51:58'),
(1649, NULL, 'Maihar', '20', 'active', '2025-04-17 09:51:58', '2025-04-17 09:51:58'),
(1650, NULL, 'Majholi', '20', 'active', '2025-04-17 09:51:58', '2025-04-17 09:51:58'),
(1651, NULL, 'Maksi', '20', 'active', '2025-04-17 09:51:58', '2025-04-17 09:51:58'),
(1652, NULL, 'Malhargarh', '20', 'active', '2025-04-17 09:51:58', '2025-04-17 09:51:58'),
(1653, NULL, 'Manasa', '20', 'active', '2025-04-17 09:51:58', '2025-04-17 09:51:58'),
(1654, NULL, 'Manawar', '20', 'active', '2025-04-17 09:51:58', '2025-04-17 09:51:58'),
(1655, NULL, 'Mandideep', '20', 'active', '2025-04-17 09:51:58', '2025-04-17 09:51:58'),
(1656, NULL, 'Mandla', '20', 'active', '2025-04-17 09:51:58', '2025-04-17 09:51:58'),
(1657, NULL, 'Mandleshwar', '20', 'active', '2025-04-17 09:51:58', '2025-04-17 09:51:58'),
(1658, NULL, 'Mandsaur', '20', 'active', '2025-04-17 09:51:58', '2025-04-17 09:51:58'),
(1659, NULL, 'Mangawan', '20', 'active', '2025-04-17 09:51:58', '2025-04-17 09:51:58'),
(1660, NULL, 'Manpur', '20', 'active', '2025-04-17 09:51:58', '2025-04-17 09:51:58'),
(1661, NULL, 'Mau', '20', 'active', '2025-04-17 09:51:58', '2025-04-17 09:51:58'),
(1662, NULL, 'Mauganj', '20', 'active', '2025-04-17 09:51:58', '2025-04-17 09:51:58'),
(1663, NULL, 'Mihona', '20', 'active', '2025-04-17 09:51:58', '2025-04-17 09:51:58'),
(1664, NULL, 'Mohgaon', '20', 'active', '2025-04-17 09:51:58', '2025-04-17 09:51:58'),
(1665, NULL, 'Morar', '20', 'active', '2025-04-17 09:51:58', '2025-04-17 09:51:58'),
(1666, NULL, 'Morena', '20', 'active', '2025-04-17 09:51:58', '2025-04-17 09:51:58'),
(1667, NULL, 'Multai', '20', 'active', '2025-04-17 09:51:58', '2025-04-17 09:51:58'),
(1668, NULL, 'Mundi', '20', 'active', '2025-04-17 09:51:58', '2025-04-17 09:51:58'),
(1669, NULL, 'Mungaoli', '20', 'active', '2025-04-17 09:51:58', '2025-04-17 09:51:58'),
(1670, NULL, 'Murwara', '20', 'active', '2025-04-17 09:51:58', '2025-04-17 09:51:58'),
(1671, NULL, 'Nagda', '20', 'active', '2025-04-17 09:51:58', '2025-04-17 09:51:58'),
(1672, NULL, 'Nagod', '20', 'active', '2025-04-17 09:51:58', '2025-04-17 09:51:58'),
(1673, NULL, 'Naigarhi', '20', 'active', '2025-04-17 09:51:58', '2025-04-17 09:51:58'),
(1674, NULL, 'Nainpur', '20', 'active', '2025-04-17 09:51:58', '2025-04-17 09:51:58'),
(1675, NULL, 'Namli', '20', 'active', '2025-04-17 09:51:58', '2025-04-17 09:51:58'),
(1676, NULL, 'Naraini', '20', 'active', '2025-04-17 09:51:58', '2025-04-17 09:51:58'),
(1677, NULL, 'Narayangarh', '20', 'active', '2025-04-17 09:51:58', '2025-04-17 09:51:58'),
(1678, NULL, 'Narsimhapur', '20', 'active', '2025-04-17 09:51:58', '2025-04-17 09:51:58'),
(1679, NULL, 'Narsinghgarh', '20', 'active', '2025-04-17 09:51:58', '2025-04-17 09:51:58'),
(1680, NULL, 'Narwar', '20', 'active', '2025-04-17 09:51:58', '2025-04-17 09:51:58'),
(1681, NULL, 'Nasrullahganj', '20', 'active', '2025-04-17 09:51:58', '2025-04-17 09:51:58'),
(1682, NULL, 'Neemuch', '20', 'active', '2025-04-17 09:51:58', '2025-04-17 09:51:58'),
(1683, NULL, 'Nepanagar', '20', 'active', '2025-04-17 09:51:58', '2025-04-17 09:51:58'),
(1684, NULL, 'Orchha', '20', 'active', '2025-04-17 09:51:58', '2025-04-17 09:51:58'),
(1685, NULL, 'Pachmarhi', '20', 'active', '2025-04-17 09:51:58', '2025-04-17 09:51:58'),
(1686, NULL, 'Palera', '20', 'active', '2025-04-17 09:51:58', '2025-04-17 09:51:58'),
(1687, NULL, 'Pali', '20', 'active', '2025-04-17 09:51:58', '2025-04-17 09:51:58'),
(1688, NULL, 'Panagar', '20', 'active', '2025-04-17 09:51:58', '2025-04-17 09:51:58'),
(1689, NULL, 'Panara', '20', 'active', '2025-04-17 09:51:58', '2025-04-17 09:51:58'),
(1690, NULL, 'Pandhana', '20', 'active', '2025-04-17 09:51:58', '2025-04-17 09:51:58'),
(1691, NULL, 'Pandhurna', '20', 'active', '2025-04-17 09:51:58', '2025-04-17 09:51:58'),
(1692, NULL, 'Panna', '20', 'active', '2025-04-17 09:51:58', '2025-04-17 09:51:58'),
(1693, NULL, 'Pansemal', '20', 'active', '2025-04-17 09:51:58', '2025-04-17 09:51:58'),
(1694, NULL, 'Parasia', '20', 'active', '2025-04-17 09:51:58', '2025-04-17 09:51:58'),
(1695, NULL, 'Patan', '20', 'active', '2025-04-17 09:51:58', '2025-04-17 09:51:58'),
(1696, NULL, 'Patharia', '20', 'active', '2025-04-17 09:51:58', '2025-04-17 09:51:58'),
(1697, NULL, 'Pawai', '20', 'active', '2025-04-17 09:51:58', '2025-04-17 09:51:58'),
(1698, NULL, 'Petlawad', '20', 'active', '2025-04-17 09:51:58', '2025-04-17 09:51:58'),
(1699, NULL, 'Piploda', '20', 'active', '2025-04-17 09:51:58', '2025-04-17 09:51:58'),
(1700, NULL, 'Pithampur', '20', 'active', '2025-04-17 09:51:58', '2025-04-17 09:51:58'),
(1701, NULL, 'Porsa', '20', 'active', '2025-04-17 09:51:58', '2025-04-17 09:51:58'),
(1702, NULL, 'Punasa', '20', 'active', '2025-04-17 09:51:58', '2025-04-17 09:51:58'),
(1703, NULL, 'Raghogarh', '20', 'active', '2025-04-17 09:51:58', '2025-04-17 09:51:58'),
(1704, NULL, 'Rahatgarh', '20', 'active', '2025-04-17 09:51:58', '2025-04-17 09:51:58'),
(1705, NULL, 'Raisen', '20', 'active', '2025-04-17 09:51:58', '2025-04-17 09:51:58'),
(1706, NULL, 'Rajgarh', '20', 'active', '2025-04-17 09:51:58', '2025-04-17 09:51:58'),
(1707, NULL, 'Rajnagar', '20', 'active', '2025-04-17 09:51:58', '2025-04-17 09:51:58'),
(1708, NULL, 'Rajpur', '20', 'active', '2025-04-17 09:51:58', '2025-04-17 09:51:58'),
(1709, NULL, 'Rampura', '20', 'active', '2025-04-17 09:51:58', '2025-04-17 09:51:58'),
(1710, NULL, 'Ranapur', '20', 'active', '2025-04-17 09:51:58', '2025-04-17 09:51:58'),
(1711, NULL, 'Ratangarh', '20', 'active', '2025-04-17 09:51:58', '2025-04-17 09:51:58'),
(1712, NULL, 'Ratlam', '20', 'active', '2025-04-17 09:51:58', '2025-04-17 09:51:58'),
(1713, NULL, 'Rehli', '20', 'active', '2025-04-17 09:51:58', '2025-04-17 09:51:58'),
(1714, NULL, 'Rehti', '20', 'active', '2025-04-17 09:51:58', '2025-04-17 09:51:58'),
(1715, NULL, 'Rewa', '20', 'active', '2025-04-17 09:51:58', '2025-04-17 09:51:58'),
(1716, NULL, 'Sabalgarh', '20', 'active', '2025-04-17 09:51:58', '2025-04-17 09:51:58'),
(1717, NULL, 'Sagar', '20', 'active', '2025-04-17 09:51:58', '2025-04-17 09:51:58'),
(1718, NULL, 'Sailana', '20', 'active', '2025-04-17 09:51:58', '2025-04-17 09:51:58'),
(1719, NULL, 'Sanawad', '20', 'active', '2025-04-17 09:51:58', '2025-04-17 09:51:58'),
(1720, NULL, 'Sanchi', '20', 'active', '2025-04-17 09:51:58', '2025-04-17 09:51:58'),
(1721, NULL, 'Sanwer', '20', 'active', '2025-04-17 09:51:58', '2025-04-17 09:51:58'),
(1722, NULL, 'Sarangpur', '20', 'active', '2025-04-17 09:51:58', '2025-04-17 09:51:58'),
(1723, NULL, 'Satna', '20', 'active', '2025-04-17 09:51:58', '2025-04-17 09:51:58'),
(1724, NULL, 'Satwas', '20', 'active', '2025-04-17 09:51:58', '2025-04-17 09:51:58'),
(1725, NULL, 'Saugor', '20', 'active', '2025-04-17 09:51:58', '2025-04-17 09:51:58'),
(1726, NULL, 'Sausar', '20', 'active', '2025-04-17 09:51:58', '2025-04-17 09:51:58'),
(1727, NULL, 'Sehore', '20', 'active', '2025-04-17 09:51:58', '2025-04-17 09:51:58'),
(1728, NULL, 'Sendhwa', '20', 'active', '2025-04-17 09:51:58', '2025-04-17 09:51:58'),
(1729, NULL, 'Seondha', '20', 'active', '2025-04-17 09:51:58', '2025-04-17 09:51:58'),
(1730, NULL, 'Seoni', '20', 'active', '2025-04-17 09:51:58', '2025-04-17 09:51:58'),
(1731, NULL, 'Seoni Malwa', '20', 'active', '2025-04-17 09:51:58', '2025-04-17 09:51:58'),
(1732, NULL, 'Shahdol', '20', 'active', '2025-04-17 09:51:58', '2025-04-17 09:51:58'),
(1733, NULL, 'Shahgarh', '20', 'active', '2025-04-17 09:51:58', '2025-04-17 09:51:58'),
(1734, NULL, 'Shahpur', '20', 'active', '2025-04-17 09:51:58', '2025-04-17 09:51:58'),
(1735, NULL, 'Shahpura', '20', 'active', '2025-04-17 09:51:58', '2025-04-17 09:51:58'),
(1736, NULL, 'Shajapur', '20', 'active', '2025-04-17 09:51:58', '2025-04-17 09:51:58'),
(1737, NULL, 'Shamgarh', '20', 'active', '2025-04-17 09:51:58', '2025-04-17 09:51:58'),
(1738, NULL, 'Sheopur', '20', 'active', '2025-04-17 09:51:58', '2025-04-17 09:51:58'),
(1739, NULL, 'Shivpuri', '20', 'active', '2025-04-17 09:51:58', '2025-04-17 09:51:58'),
(1740, NULL, 'Shujalpur', '20', 'active', '2025-04-17 09:51:58', '2025-04-17 09:51:58'),
(1741, NULL, 'Sidhi', '20', 'active', '2025-04-17 09:51:58', '2025-04-17 09:51:58'),
(1742, NULL, 'Sihora', '20', 'active', '2025-04-17 09:51:58', '2025-04-17 09:51:58'),
(1743, NULL, 'Simaria', '20', 'active', '2025-04-17 09:51:58', '2025-04-17 09:51:58'),
(1744, NULL, 'Singoli', '20', 'active', '2025-04-17 09:51:58', '2025-04-17 09:51:58'),
(1745, NULL, 'Singrauli', '20', 'active', '2025-04-17 09:51:58', '2025-04-17 09:51:58'),
(1746, NULL, 'Sirmaur', '20', 'active', '2025-04-17 09:51:58', '2025-04-17 09:51:58'),
(1747, NULL, 'Sironj', '20', 'active', '2025-04-17 09:51:58', '2025-04-17 09:51:58'),
(1748, NULL, 'Sitamau', '20', 'active', '2025-04-17 09:51:58', '2025-04-17 09:51:58'),
(1749, NULL, 'Sohagi', '20', 'active', '2025-04-17 09:51:58', '2025-04-17 09:51:58'),
(1750, NULL, 'Sohagpur', '20', 'active', '2025-04-17 09:51:58', '2025-04-17 09:51:58'),
(1751, NULL, 'Sultanpur', '20', 'active', '2025-04-17 09:51:58', '2025-04-17 09:51:58'),
(1752, NULL, 'Susner', '20', 'active', '2025-04-17 09:51:58', '2025-04-17 09:51:58'),
(1753, NULL, 'Tal', '20', 'active', '2025-04-17 09:51:58', '2025-04-17 09:51:58'),
(1754, NULL, 'Talen', '20', 'active', '2025-04-17 09:51:58', '2025-04-17 09:51:58'),
(1755, NULL, 'Tarana', '20', 'active', '2025-04-17 09:51:58', '2025-04-17 09:51:58'),
(1756, NULL, 'Tekanpur', '20', 'active', '2025-04-17 09:51:58', '2025-04-17 09:51:58'),
(1757, NULL, 'Tendukheda', '20', 'active', '2025-04-17 09:51:58', '2025-04-17 09:51:58'),
(1758, NULL, 'Teonthar', '20', 'active', '2025-04-17 09:51:58', '2025-04-17 09:51:58'),
(1759, NULL, 'Thandla', '20', 'active', '2025-04-17 09:51:58', '2025-04-17 09:51:58');
INSERT INTO `module_cities` (`id`, `slug`, `city_name`, `state_name`, `status`, `created_at`, `updated_at`) VALUES
(1760, NULL, 'Tikamgarh', '20', 'active', '2025-04-17 09:51:58', '2025-04-17 09:51:58'),
(1761, NULL, 'Tirodi', '20', 'active', '2025-04-17 09:51:58', '2025-04-17 09:51:58'),
(1762, NULL, 'Udaipura', '20', 'active', '2025-04-17 09:51:58', '2025-04-17 09:51:58'),
(1763, NULL, 'Ujjain', '20', 'active', '2025-04-17 09:51:58', '2025-04-17 09:51:58'),
(1764, NULL, 'Ukwa', '20', 'active', '2025-04-17 09:51:58', '2025-04-17 09:51:58'),
(1765, NULL, 'Umaria', '20', 'active', '2025-04-17 09:51:58', '2025-04-17 09:51:58'),
(1766, NULL, 'Umri', '20', 'active', '2025-04-17 09:51:58', '2025-04-17 09:51:58'),
(1767, NULL, 'Unhel', '20', 'active', '2025-04-17 09:51:58', '2025-04-17 09:51:58'),
(1768, NULL, 'Vidisha', '20', 'active', '2025-04-17 09:51:58', '2025-04-17 09:51:58'),
(1769, NULL, 'Waraseoni', '20', 'active', '2025-04-17 09:51:58', '2025-04-17 09:51:58'),
(1770, NULL, 'Achalpur', '21', 'active', '2025-04-17 09:51:58', '2025-04-17 09:51:58'),
(1771, NULL, 'Adawad', '21', 'active', '2025-04-17 09:51:58', '2025-04-17 09:51:58'),
(1772, NULL, 'Agar Panchaitan', '21', 'active', '2025-04-17 09:51:58', '2025-04-17 09:51:58'),
(1773, NULL, 'Aheri', '21', 'active', '2025-04-17 09:51:58', '2025-04-17 09:51:58'),
(1774, NULL, 'Ahmadpur', '21', 'active', '2025-04-17 09:51:58', '2025-04-17 09:51:58'),
(1775, NULL, 'Ahmednagar', '21', 'active', '2025-04-17 09:51:58', '2025-04-17 09:51:58'),
(1776, NULL, 'Airoli', '21', 'active', '2025-04-17 09:51:58', '2025-04-17 09:51:58'),
(1777, NULL, 'Ajara', '21', 'active', '2025-04-17 09:51:58', '2025-04-17 09:51:58'),
(1778, NULL, 'Akalkot', '21', 'active', '2025-04-17 09:51:58', '2025-04-17 09:51:58'),
(1779, NULL, 'Akluj', '21', 'active', '2025-04-17 09:51:58', '2025-04-17 09:51:58'),
(1780, NULL, 'Akola', '21', 'active', '2025-04-17 09:51:58', '2025-04-17 09:51:58'),
(1781, NULL, 'Akolner', '21', 'active', '2025-04-17 09:51:58', '2025-04-17 09:51:58'),
(1782, NULL, 'Akot', '21', 'active', '2025-04-17 09:51:58', '2025-04-17 09:51:58'),
(1783, NULL, 'Akrani', '21', 'active', '2025-04-17 09:51:58', '2025-04-17 09:51:58'),
(1784, NULL, 'Alandi', '21', 'active', '2025-04-17 09:51:58', '2025-04-17 09:51:58'),
(1785, NULL, 'Ale', '21', 'active', '2025-04-17 09:51:58', '2025-04-17 09:51:58'),
(1786, NULL, 'Alibag', '21', 'active', '2025-04-17 09:51:58', '2025-04-17 09:51:58'),
(1787, NULL, 'Alkuti', '21', 'active', '2025-04-17 09:51:58', '2025-04-17 09:51:58'),
(1788, NULL, 'Allapalli', '21', 'active', '2025-04-17 09:51:58', '2025-04-17 09:51:58'),
(1789, NULL, 'Amalner', '21', 'active', '2025-04-17 09:51:58', '2025-04-17 09:51:58'),
(1790, NULL, 'Amarnath', '21', 'active', '2025-04-17 09:51:58', '2025-04-17 09:51:58'),
(1791, NULL, 'Ambad', '21', 'active', '2025-04-17 09:51:58', '2025-04-17 09:51:58'),
(1792, NULL, 'Ambajogai', '21', 'active', '2025-04-17 09:51:58', '2025-04-17 09:51:58'),
(1793, NULL, 'Ambegaon', '21', 'active', '2025-04-17 09:51:58', '2025-04-17 09:51:58'),
(1794, NULL, 'Ambernath', '21', 'active', '2025-04-17 09:51:58', '2025-04-17 09:51:58'),
(1795, NULL, 'Amgaon', '21', 'active', '2025-04-17 09:51:58', '2025-04-17 09:51:58'),
(1796, NULL, 'Amravati', '21', 'active', '2025-04-17 09:51:58', '2025-04-17 09:51:58'),
(1797, NULL, 'Andheri', '21', 'active', '2025-04-17 09:51:58', '2025-04-17 09:51:58'),
(1798, NULL, 'Andura', '21', 'active', '2025-04-17 09:51:58', '2025-04-17 09:51:58'),
(1799, NULL, 'Anjangaon', '21', 'active', '2025-04-17 09:51:58', '2025-04-17 09:51:58'),
(1800, NULL, 'Anjarle', '21', 'active', '2025-04-17 09:51:58', '2025-04-17 09:51:58'),
(1801, NULL, 'Anshing', '21', 'active', '2025-04-17 09:51:58', '2025-04-17 09:51:58'),
(1802, NULL, 'Arag', '21', 'active', '2025-04-17 09:51:58', '2025-04-17 09:51:58'),
(1803, NULL, 'Arangaon', '21', 'active', '2025-04-17 09:51:58', '2025-04-17 09:51:58'),
(1804, NULL, 'Ardhapur', '21', 'active', '2025-04-17 09:51:58', '2025-04-17 09:51:58'),
(1805, NULL, 'Argaon', '21', 'active', '2025-04-17 09:51:58', '2025-04-17 09:51:58'),
(1806, NULL, 'Artist Village', '21', 'active', '2025-04-17 09:51:58', '2025-04-17 09:51:58'),
(1807, NULL, 'Arvi', '21', 'active', '2025-04-17 09:51:58', '2025-04-17 09:51:58'),
(1808, NULL, 'Ashta', '21', 'active', '2025-04-17 09:51:58', '2025-04-17 09:51:58'),
(1809, NULL, 'Ashti', '21', 'active', '2025-04-17 09:51:58', '2025-04-17 09:51:58'),
(1810, NULL, 'Asoda', '21', 'active', '2025-04-17 09:51:58', '2025-04-17 09:51:58'),
(1811, NULL, 'Assaye', '21', 'active', '2025-04-17 09:51:58', '2025-04-17 09:51:58'),
(1812, NULL, 'Astagaon', '21', 'active', '2025-04-17 09:51:58', '2025-04-17 09:51:58'),
(1813, NULL, 'Aundh Satara', '21', 'active', '2025-04-17 09:51:58', '2025-04-17 09:51:58'),
(1814, NULL, 'Aurangabad', '21', 'active', '2025-04-17 09:51:58', '2025-04-17 09:51:58'),
(1815, NULL, 'Ausa', '21', 'active', '2025-04-17 09:51:58', '2025-04-17 09:51:58'),
(1816, NULL, 'Badlapur', '21', 'active', '2025-04-17 09:51:58', '2025-04-17 09:51:58'),
(1817, NULL, 'Badnapur', '21', 'active', '2025-04-17 09:51:58', '2025-04-17 09:51:58'),
(1818, NULL, 'Badnera', '21', 'active', '2025-04-17 09:51:58', '2025-04-17 09:51:58'),
(1819, NULL, 'Bagewadi', '21', 'active', '2025-04-17 09:51:58', '2025-04-17 09:51:58'),
(1820, NULL, 'Balapur', '21', 'active', '2025-04-17 09:51:58', '2025-04-17 09:51:58'),
(1821, NULL, 'Balapur Akola district', '21', 'active', '2025-04-17 09:51:58', '2025-04-17 09:51:58'),
(1822, NULL, 'Ballalpur', '21', 'active', '2025-04-17 09:51:58', '2025-04-17 09:51:58'),
(1823, NULL, 'Ballard Estate', '21', 'active', '2025-04-17 09:51:58', '2025-04-17 09:51:58'),
(1824, NULL, 'Ballarpur', '21', 'active', '2025-04-17 09:51:58', '2025-04-17 09:51:58'),
(1825, NULL, 'Banda Maharashtra', '21', 'active', '2025-04-17 09:51:58', '2025-04-17 09:51:58'),
(1826, NULL, 'Bandra', '21', 'active', '2025-04-17 09:51:58', '2025-04-17 09:51:58'),
(1827, NULL, 'Baner', '21', 'active', '2025-04-17 09:51:58', '2025-04-17 09:51:58'),
(1828, NULL, 'Bankot', '21', 'active', '2025-04-17 09:51:58', '2025-04-17 09:51:58'),
(1829, NULL, 'Baramati', '21', 'active', '2025-04-17 09:51:58', '2025-04-17 09:51:58'),
(1830, NULL, 'Barsi', '21', 'active', '2025-04-17 09:51:58', '2025-04-17 09:51:58'),
(1831, NULL, 'Basmat', '21', 'active', '2025-04-17 09:51:58', '2025-04-17 09:51:58'),
(1832, NULL, 'Bavdhan', '21', 'active', '2025-04-17 09:51:58', '2025-04-17 09:51:58'),
(1833, NULL, 'Bawanbir', '21', 'active', '2025-04-17 09:51:58', '2025-04-17 09:51:58'),
(1834, NULL, 'Beed', '21', 'active', '2025-04-17 09:51:58', '2025-04-17 09:51:58'),
(1835, NULL, 'Bhadgaon Maharashtra', '21', 'active', '2025-04-17 09:51:58', '2025-04-17 09:51:58'),
(1836, NULL, 'Bhandara', '21', 'active', '2025-04-17 09:51:58', '2025-04-17 09:51:58'),
(1837, NULL, 'Bhandardara', '21', 'active', '2025-04-17 09:51:58', '2025-04-17 09:51:58'),
(1838, NULL, 'Bhandup', '21', 'active', '2025-04-17 09:51:58', '2025-04-17 09:51:58'),
(1839, NULL, 'Bhayandar', '21', 'active', '2025-04-17 09:51:58', '2025-04-17 09:51:58'),
(1840, NULL, 'Bhigvan', '21', 'active', '2025-04-17 09:51:58', '2025-04-17 09:51:58'),
(1841, NULL, 'Bhiwandi', '21', 'active', '2025-04-17 09:51:58', '2025-04-17 09:51:58'),
(1842, NULL, 'Bhiwapur', '21', 'active', '2025-04-17 09:51:58', '2025-04-17 09:51:58'),
(1843, NULL, 'Bhokar', '21', 'active', '2025-04-17 09:51:58', '2025-04-17 09:51:58'),
(1844, NULL, 'Bhokardan', '21', 'active', '2025-04-17 09:51:58', '2025-04-17 09:51:58'),
(1845, NULL, 'Bhoom', '21', 'active', '2025-04-17 09:51:58', '2025-04-17 09:51:58'),
(1846, NULL, 'Bhor', '21', 'active', '2025-04-17 09:51:58', '2025-04-17 09:51:58'),
(1847, NULL, 'Bhudgaon', '21', 'active', '2025-04-17 09:51:58', '2025-04-17 09:51:58'),
(1848, NULL, 'Bhugaon', '21', 'active', '2025-04-17 09:51:58', '2025-04-17 09:51:58'),
(1849, NULL, 'Bhusaval', '21', 'active', '2025-04-17 09:51:58', '2025-04-17 09:51:58'),
(1850, NULL, 'Bijur', '21', 'active', '2025-04-17 09:51:58', '2025-04-17 09:51:58'),
(1851, NULL, 'Bilashi', '21', 'active', '2025-04-17 09:51:58', '2025-04-17 09:51:58'),
(1852, NULL, 'Biloli', '21', 'active', '2025-04-17 09:51:58', '2025-04-17 09:51:58'),
(1853, NULL, 'Boisar', '21', 'active', '2025-04-17 09:51:58', '2025-04-17 09:51:58'),
(1854, NULL, 'Borgaon Manju', '21', 'active', '2025-04-17 09:51:58', '2025-04-17 09:51:58'),
(1855, NULL, 'Borivali', '21', 'active', '2025-04-17 09:51:58', '2025-04-17 09:51:58'),
(1856, NULL, 'Brahmapuri', '21', 'active', '2025-04-17 09:51:58', '2025-04-17 09:51:58'),
(1857, NULL, 'Breach Candy', '21', 'active', '2025-04-17 09:51:58', '2025-04-17 09:51:58'),
(1858, NULL, 'Buldana', '21', 'active', '2025-04-17 09:51:58', '2025-04-17 09:51:58'),
(1859, NULL, 'Byculla', '21', 'active', '2025-04-17 09:51:58', '2025-04-17 09:51:58'),
(1860, NULL, 'Chakan', '21', 'active', '2025-04-17 09:51:58', '2025-04-17 09:51:58'),
(1861, NULL, 'Chakur', '21', 'active', '2025-04-17 09:51:58', '2025-04-17 09:51:58'),
(1862, NULL, 'Chalisgaon', '21', 'active', '2025-04-17 09:51:58', '2025-04-17 09:51:58'),
(1863, NULL, 'Chanda', '21', 'active', '2025-04-17 09:51:58', '2025-04-17 09:51:58'),
(1864, NULL, 'Chandgad', '21', 'active', '2025-04-17 09:51:58', '2025-04-17 09:51:58'),
(1865, NULL, 'Chandor', '21', 'active', '2025-04-17 09:51:58', '2025-04-17 09:51:58'),
(1866, NULL, 'Chandrapur', '21', 'active', '2025-04-17 09:51:58', '2025-04-17 09:51:58'),
(1867, NULL, 'Chandur', '21', 'active', '2025-04-17 09:51:58', '2025-04-17 09:51:58'),
(1868, NULL, 'Chandur Bazar', '21', 'active', '2025-04-17 09:51:58', '2025-04-17 09:51:58'),
(1869, NULL, 'Chausala', '21', 'active', '2025-04-17 09:51:58', '2025-04-17 09:51:58'),
(1870, NULL, 'Chembur', '21', 'active', '2025-04-17 09:51:58', '2025-04-17 09:51:58'),
(1871, NULL, 'Chicholi', '21', 'active', '2025-04-17 09:51:58', '2025-04-17 09:51:58'),
(1872, NULL, 'Chichondi Patil', '21', 'active', '2025-04-17 09:51:58', '2025-04-17 09:51:58'),
(1873, NULL, 'Chikhli (Buldhana)', '21', 'active', '2025-04-17 09:51:58', '2025-04-17 09:51:58'),
(1874, NULL, 'Chikhli (Jalna)', '21', 'active', '2025-04-17 09:51:58', '2025-04-17 09:51:58'),
(1875, NULL, 'Chimur', '21', 'active', '2025-04-17 09:51:58', '2025-04-17 09:51:58'),
(1876, NULL, 'Chinchani', '21', 'active', '2025-04-17 09:51:58', '2025-04-17 09:51:58'),
(1877, NULL, 'Chinchpokli', '21', 'active', '2025-04-17 09:51:58', '2025-04-17 09:51:58'),
(1878, NULL, 'Chiplun', '21', 'active', '2025-04-17 09:51:58', '2025-04-17 09:51:58'),
(1879, NULL, 'Chopda', '21', 'active', '2025-04-17 09:51:58', '2025-04-17 09:51:58'),
(1880, NULL, 'Colaba', '21', 'active', '2025-04-17 09:51:58', '2025-04-17 09:51:58'),
(1881, NULL, 'Dabhol', '21', 'active', '2025-04-17 09:51:58', '2025-04-17 09:51:58'),
(1882, NULL, 'Daddi', '21', 'active', '2025-04-17 09:51:58', '2025-04-17 09:51:58'),
(1883, NULL, 'Dahanu', '21', 'active', '2025-04-17 09:51:58', '2025-04-17 09:51:58'),
(1884, NULL, 'Dahivel', '21', 'active', '2025-04-17 09:51:58', '2025-04-17 09:51:58'),
(1885, NULL, 'Dapoli', '21', 'active', '2025-04-17 09:51:58', '2025-04-17 09:51:58'),
(1886, NULL, 'Darwha', '21', 'active', '2025-04-17 09:51:58', '2025-04-17 09:51:58'),
(1887, NULL, 'Daryapur', '21', 'active', '2025-04-17 09:51:58', '2025-04-17 09:51:58'),
(1888, NULL, 'Dattapur', '21', 'active', '2025-04-17 09:51:58', '2025-04-17 09:51:58'),
(1889, NULL, 'Daulatabad', '21', 'active', '2025-04-17 09:51:58', '2025-04-17 09:51:58'),
(1890, NULL, 'Daund', '21', 'active', '2025-04-17 09:51:58', '2025-04-17 09:51:58'),
(1891, NULL, 'Deccan Gymkhana', '21', 'active', '2025-04-17 09:51:58', '2025-04-17 09:51:58'),
(1892, NULL, 'Deglur', '21', 'active', '2025-04-17 09:51:58', '2025-04-17 09:51:58'),
(1893, NULL, 'Dehu', '21', 'active', '2025-04-17 09:51:58', '2025-04-17 09:51:58'),
(1894, NULL, 'Deolali', '21', 'active', '2025-04-17 09:51:58', '2025-04-17 09:51:58'),
(1895, NULL, 'Deolapar', '21', 'active', '2025-04-17 09:51:58', '2025-04-17 09:51:58'),
(1896, NULL, 'Deoli', '21', 'active', '2025-04-17 09:51:58', '2025-04-17 09:51:58'),
(1897, NULL, 'Deoni', '21', 'active', '2025-04-17 09:51:58', '2025-04-17 09:51:58'),
(1898, NULL, 'Deulgaon Raja', '21', 'active', '2025-04-17 09:51:58', '2025-04-17 09:51:58'),
(1899, NULL, 'Devrukh', '21', 'active', '2025-04-17 09:51:58', '2025-04-17 09:51:58'),
(1900, NULL, 'Dharangaon', '21', 'active', '2025-04-17 09:51:58', '2025-04-17 09:51:58'),
(1901, NULL, 'Dharavi', '21', 'active', '2025-04-17 09:51:58', '2025-04-17 09:51:58'),
(1902, NULL, 'Dharmabad', '21', 'active', '2025-04-17 09:51:58', '2025-04-17 09:51:58'),
(1903, NULL, 'Dharur', '21', 'active', '2025-04-17 09:51:58', '2025-04-17 09:51:58'),
(1904, NULL, 'Dhawalpuri', '21', 'active', '2025-04-17 09:51:58', '2025-04-17 09:51:58'),
(1905, NULL, 'Dhule', '21', 'active', '2025-04-17 09:51:58', '2025-04-17 09:51:58'),
(1906, NULL, 'Dhulia', '21', 'active', '2025-04-17 09:51:58', '2025-04-17 09:51:58'),
(1907, NULL, 'Dighori', '21', 'active', '2025-04-17 09:51:58', '2025-04-17 09:51:58'),
(1908, NULL, 'Diglur', '21', 'active', '2025-04-17 09:51:58', '2025-04-17 09:51:58'),
(1909, NULL, 'Digras', '21', 'active', '2025-04-17 09:51:58', '2025-04-17 09:51:58'),
(1910, NULL, 'Dindori Maharashtra', '21', 'active', '2025-04-17 09:51:58', '2025-04-17 09:51:58'),
(1911, NULL, 'Diveagar', '21', 'active', '2025-04-17 09:51:58', '2025-04-17 09:51:58'),
(1912, NULL, 'Dombivli', '21', 'active', '2025-04-17 09:51:58', '2025-04-17 09:51:58'),
(1913, NULL, 'Dondaicha', '21', 'active', '2025-04-17 09:51:58', '2025-04-17 09:51:58'),
(1914, NULL, 'Dongri', '21', 'active', '2025-04-17 09:51:58', '2025-04-17 09:51:58'),
(1915, NULL, 'Dudhani', '21', 'active', '2025-04-17 09:51:58', '2025-04-17 09:51:58'),
(1916, NULL, 'Durgapur', '21', 'active', '2025-04-17 09:51:58', '2025-04-17 09:51:58'),
(1917, NULL, 'Durgapur Chandrapur', '21', 'active', '2025-04-17 09:51:58', '2025-04-17 09:51:58'),
(1918, NULL, 'Erandol', '21', 'active', '2025-04-17 09:51:58', '2025-04-17 09:51:58'),
(1919, NULL, 'Faizpur', '21', 'active', '2025-04-17 09:51:58', '2025-04-17 09:51:58'),
(1920, NULL, 'Fort', '21', 'active', '2025-04-17 09:51:58', '2025-04-17 09:51:58'),
(1921, NULL, 'Gadchiroli', '21', 'active', '2025-04-17 09:51:58', '2025-04-17 09:51:58'),
(1922, NULL, 'Gadhinglaj', '21', 'active', '2025-04-17 09:51:58', '2025-04-17 09:51:58'),
(1923, NULL, 'Gangakher', '21', 'active', '2025-04-17 09:51:58', '2025-04-17 09:51:58'),
(1924, NULL, 'Gangapur', '21', 'active', '2025-04-17 09:51:58', '2025-04-17 09:51:58'),
(1925, NULL, 'Ganpatipule', '21', 'active', '2025-04-17 09:51:58', '2025-04-17 09:51:58'),
(1926, NULL, 'Gevrai', '21', 'active', '2025-04-17 09:51:58', '2025-04-17 09:51:58'),
(1927, NULL, 'Ghargaon', '21', 'active', '2025-04-17 09:51:58', '2025-04-17 09:51:58'),
(1928, NULL, 'Ghatanji', '21', 'active', '2025-04-17 09:51:58', '2025-04-17 09:51:58'),
(1929, NULL, 'Ghatkopar', '21', 'active', '2025-04-17 09:51:58', '2025-04-17 09:51:58'),
(1930, NULL, 'Ghoti Budrukh', '21', 'active', '2025-04-17 09:51:58', '2025-04-17 09:51:58'),
(1931, NULL, 'Ghugus', '21', 'active', '2025-04-17 09:51:58', '2025-04-17 09:51:58'),
(1932, NULL, 'Girgaon', '21', 'active', '2025-04-17 09:51:58', '2025-04-17 09:51:58'),
(1933, NULL, 'Gondia', '21', 'active', '2025-04-17 09:51:58', '2025-04-17 09:51:58'),
(1934, NULL, 'Gorai', '21', 'active', '2025-04-17 09:51:58', '2025-04-17 09:51:58'),
(1935, NULL, 'Goregaon', '21', 'active', '2025-04-17 09:51:58', '2025-04-17 09:51:58'),
(1936, NULL, 'Guhagar', '21', 'active', '2025-04-17 09:51:58', '2025-04-17 09:51:58'),
(1937, NULL, 'Hadapsar Pune', '21', 'active', '2025-04-17 09:51:58', '2025-04-17 09:51:58'),
(1938, NULL, 'Hadgaon', '21', 'active', '2025-04-17 09:51:58', '2025-04-17 09:51:58'),
(1939, NULL, 'Halkarni', '21', 'active', '2025-04-17 09:51:58', '2025-04-17 09:51:58'),
(1940, NULL, 'Harangul', '21', 'active', '2025-04-17 09:51:58', '2025-04-17 09:51:58'),
(1941, NULL, 'Harnai', '21', 'active', '2025-04-17 09:51:58', '2025-04-17 09:51:58'),
(1942, NULL, 'Helwak', '21', 'active', '2025-04-17 09:51:58', '2025-04-17 09:51:58'),
(1943, NULL, 'Hinganghat', '21', 'active', '2025-04-17 09:51:58', '2025-04-17 09:51:58'),
(1944, NULL, 'Hingoli', '21', 'active', '2025-04-17 09:51:58', '2025-04-17 09:51:58'),
(1945, NULL, 'Hirapur', '21', 'active', '2025-04-17 09:51:58', '2025-04-17 09:51:58'),
(1946, NULL, 'Hirapur Hamesha', '21', 'active', '2025-04-17 09:51:58', '2025-04-17 09:51:58'),
(1947, NULL, 'Hotgi', '21', 'active', '2025-04-17 09:51:58', '2025-04-17 09:51:58'),
(1948, NULL, 'Ichalkaranji', '21', 'active', '2025-04-17 09:51:58', '2025-04-17 09:51:58'),
(1949, NULL, 'Igatpuri', '21', 'active', '2025-04-17 09:51:58', '2025-04-17 09:51:58'),
(1950, NULL, 'Indapur', '21', 'active', '2025-04-17 09:51:58', '2025-04-17 09:51:58'),
(1951, NULL, 'Jaisingpur', '21', 'active', '2025-04-17 09:51:58', '2025-04-17 09:51:58'),
(1952, NULL, 'Jaitapur', '21', 'active', '2025-04-17 09:51:58', '2025-04-17 09:51:58'),
(1953, NULL, 'Jakhangaon', '21', 'active', '2025-04-17 09:51:58', '2025-04-17 09:51:58'),
(1954, NULL, 'Jalgaon', '21', 'active', '2025-04-17 09:51:58', '2025-04-17 09:51:58'),
(1955, NULL, 'Jalgaon Jamod', '21', 'active', '2025-04-17 09:51:58', '2025-04-17 09:51:58'),
(1956, NULL, 'Jalkot', '21', 'active', '2025-04-17 09:51:58', '2025-04-17 09:51:58'),
(1957, NULL, 'Jalna', '21', 'active', '2025-04-17 09:51:58', '2025-04-17 09:51:58'),
(1958, NULL, 'Jamkhed', '21', 'active', '2025-04-17 09:51:58', '2025-04-17 09:51:58'),
(1959, NULL, 'Jamod', '21', 'active', '2025-04-17 09:51:58', '2025-04-17 09:51:58'),
(1960, NULL, 'Janephal', '21', 'active', '2025-04-17 09:51:58', '2025-04-17 09:51:58'),
(1961, NULL, 'Jaoli', '21', 'active', '2025-04-17 09:51:58', '2025-04-17 09:51:58'),
(1962, NULL, 'Jat Sangli', '21', 'active', '2025-04-17 09:51:58', '2025-04-17 09:51:58'),
(1963, NULL, 'Jategaon', '21', 'active', '2025-04-17 09:51:58', '2025-04-17 09:51:58'),
(1964, NULL, 'Jawhar', '21', 'active', '2025-04-17 09:51:58', '2025-04-17 09:51:58'),
(1965, NULL, 'Jaysingpur', '21', 'active', '2025-04-17 09:51:58', '2025-04-17 09:51:58'),
(1966, NULL, 'Jejuri', '21', 'active', '2025-04-17 09:51:58', '2025-04-17 09:51:58'),
(1967, NULL, 'Jintur', '21', 'active', '2025-04-17 09:51:58', '2025-04-17 09:51:58'),
(1968, NULL, 'Jogeshwari', '21', 'active', '2025-04-17 09:51:58', '2025-04-17 09:51:58'),
(1969, NULL, 'Juhu', '21', 'active', '2025-04-17 09:51:58', '2025-04-17 09:51:58'),
(1970, NULL, 'Junnar', '21', 'active', '2025-04-17 09:51:58', '2025-04-17 09:51:58'),
(1971, NULL, 'Kachurwahi', '21', 'active', '2025-04-17 09:51:58', '2025-04-17 09:51:58'),
(1972, NULL, 'Kadegaon', '21', 'active', '2025-04-17 09:51:58', '2025-04-17 09:51:58'),
(1973, NULL, 'Kadus', '21', 'active', '2025-04-17 09:51:58', '2025-04-17 09:51:58'),
(1974, NULL, 'Kagal', '21', 'active', '2025-04-17 09:51:58', '2025-04-17 09:51:58'),
(1975, NULL, 'Kaij', '21', 'active', '2025-04-17 09:51:58', '2025-04-17 09:51:58'),
(1976, NULL, 'Kalamb', '21', 'active', '2025-04-17 09:51:58', '2025-04-17 09:51:58'),
(1977, NULL, 'Kalamb Osmanabad', '21', 'active', '2025-04-17 09:51:58', '2025-04-17 09:51:58'),
(1978, NULL, 'Kalamboli', '21', 'active', '2025-04-17 09:51:58', '2025-04-17 09:51:58'),
(1979, NULL, 'Kalamnuri', '21', 'active', '2025-04-17 09:51:58', '2025-04-17 09:51:58'),
(1980, NULL, 'Kalas', '21', 'active', '2025-04-17 09:51:58', '2025-04-17 09:51:58'),
(1981, NULL, 'Kali(DK)', '21', 'active', '2025-04-17 09:51:58', '2025-04-17 09:51:58'),
(1982, NULL, 'Kalmeshwar', '21', 'active', '2025-04-17 09:51:58', '2025-04-17 09:51:58'),
(1983, NULL, 'Kalundri', '21', 'active', '2025-04-17 09:51:58', '2025-04-17 09:51:58'),
(1984, NULL, 'Kalyan', '21', 'active', '2025-04-17 09:51:58', '2025-04-17 09:51:58'),
(1985, NULL, 'Kalyani Nagar', '21', 'active', '2025-04-17 09:51:58', '2025-04-17 09:51:58'),
(1986, NULL, 'Kamargaon', '21', 'active', '2025-04-17 09:51:58', '2025-04-17 09:51:58'),
(1987, NULL, 'Kamatgi', '21', 'active', '2025-04-17 09:51:58', '2025-04-17 09:51:58'),
(1988, NULL, 'Kamptee', '21', 'active', '2025-04-17 09:51:58', '2025-04-17 09:51:58'),
(1989, NULL, 'Kandri', '21', 'active', '2025-04-17 09:51:58', '2025-04-17 09:51:58'),
(1990, NULL, 'Kankauli', '21', 'active', '2025-04-17 09:51:58', '2025-04-17 09:51:58'),
(1991, NULL, 'Kankavli', '21', 'active', '2025-04-17 09:51:58', '2025-04-17 09:51:58'),
(1992, NULL, 'Kannad', '21', 'active', '2025-04-17 09:51:58', '2025-04-17 09:51:58'),
(1993, NULL, 'Karad', '21', 'active', '2025-04-17 09:51:58', '2025-04-17 09:51:58'),
(1994, NULL, 'Karajagi', '21', 'active', '2025-04-17 09:51:58', '2025-04-17 09:51:58'),
(1995, NULL, 'Karanja', '21', 'active', '2025-04-17 09:51:58', '2025-04-17 09:51:58'),
(1996, NULL, 'Karanja Lad', '21', 'active', '2025-04-17 09:51:58', '2025-04-17 09:51:58'),
(1997, NULL, 'Karjat', '21', 'active', '2025-04-17 09:51:58', '2025-04-17 09:51:58'),
(1998, NULL, 'Karkamb', '21', 'active', '2025-04-17 09:51:58', '2025-04-17 09:51:58'),
(1999, NULL, 'Karmala', '21', 'active', '2025-04-17 09:51:58', '2025-04-17 09:51:58'),
(2000, NULL, 'Kasara', '21', 'active', '2025-04-17 09:51:58', '2025-04-17 09:51:58'),
(2001, NULL, 'Kasoda', '21', 'active', '2025-04-17 09:51:58', '2025-04-17 09:51:58'),
(2002, NULL, 'Kati', '21', 'active', '2025-04-17 09:51:58', '2025-04-17 09:51:58'),
(2003, NULL, 'Katol', '21', 'active', '2025-04-17 09:51:58', '2025-04-17 09:51:58'),
(2004, NULL, 'Katral', '21', 'active', '2025-04-17 09:51:58', '2025-04-17 09:51:58'),
(2005, NULL, 'Khadki', '21', 'active', '2025-04-17 09:51:58', '2025-04-17 09:51:58'),
(2006, NULL, 'Khalapur', '21', 'active', '2025-04-17 09:51:58', '2025-04-17 09:51:58'),
(2007, NULL, 'Khallar', '21', 'active', '2025-04-17 09:51:58', '2025-04-17 09:51:58'),
(2008, NULL, 'Khamgaon', '21', 'active', '2025-04-17 09:51:58', '2025-04-17 09:51:58'),
(2009, NULL, 'Khanapur', '21', 'active', '2025-04-17 09:51:58', '2025-04-17 09:51:58'),
(2010, NULL, 'Khandala', '21', 'active', '2025-04-17 09:51:58', '2025-04-17 09:51:58'),
(2011, NULL, 'Khangaon', '21', 'active', '2025-04-17 09:51:58', '2025-04-17 09:51:58'),
(2012, NULL, 'Khapa', '21', 'active', '2025-04-17 09:51:58', '2025-04-17 09:51:58'),
(2013, NULL, 'Kharakvasla', '21', 'active', '2025-04-17 09:51:58', '2025-04-17 09:51:58'),
(2014, NULL, 'Kharda', '21', 'active', '2025-04-17 09:51:58', '2025-04-17 09:51:58'),
(2015, NULL, 'Kharghar', '21', 'active', '2025-04-17 09:51:58', '2025-04-17 09:51:58'),
(2016, NULL, 'Kharsundi', '21', 'active', '2025-04-17 09:51:58', '2025-04-17 09:51:58'),
(2017, NULL, 'Khed', '21', 'active', '2025-04-17 09:51:58', '2025-04-17 09:51:58'),
(2018, NULL, 'Khetia', '21', 'active', '2025-04-17 09:51:58', '2025-04-17 09:51:58'),
(2019, NULL, 'Khoni', '21', 'active', '2025-04-17 09:51:58', '2025-04-17 09:51:58'),
(2020, NULL, 'Khopoli', '21', 'active', '2025-04-17 09:51:58', '2025-04-17 09:51:58'),
(2021, NULL, 'Khuldabad', '21', 'active', '2025-04-17 09:51:58', '2025-04-17 09:51:58'),
(2022, NULL, 'Kinwat', '21', 'active', '2025-04-17 09:51:58', '2025-04-17 09:51:58'),
(2023, NULL, 'Kodoli', '21', 'active', '2025-04-17 09:51:58', '2025-04-17 09:51:58'),
(2024, NULL, 'Kolhapur', '21', 'active', '2025-04-17 09:51:58', '2025-04-17 09:51:58'),
(2025, NULL, 'Kondalwadi', '21', 'active', '2025-04-17 09:51:58', '2025-04-17 09:51:58'),
(2026, NULL, 'Kondhali', '21', 'active', '2025-04-17 09:51:58', '2025-04-17 09:51:58'),
(2027, NULL, 'Kopar Khairane', '21', 'active', '2025-04-17 09:51:58', '2025-04-17 09:51:58'),
(2028, NULL, 'Kopargaon', '21', 'active', '2025-04-17 09:51:58', '2025-04-17 09:51:58'),
(2029, NULL, 'Kopela', '21', 'active', '2025-04-17 09:51:58', '2025-04-17 09:51:58'),
(2030, NULL, 'Koradi', '21', 'active', '2025-04-17 09:51:58', '2025-04-17 09:51:58'),
(2031, NULL, 'Koregaon', '21', 'active', '2025-04-17 09:51:58', '2025-04-17 09:51:58'),
(2032, NULL, 'Koynanagar', '21', 'active', '2025-04-17 09:51:58', '2025-04-17 09:51:58'),
(2033, NULL, 'Kudal', '21', 'active', '2025-04-17 09:51:58', '2025-04-17 09:51:58'),
(2034, NULL, 'Kuhi', '21', 'active', '2025-04-17 09:51:58', '2025-04-17 09:51:58'),
(2035, NULL, 'Kurandvad', '21', 'active', '2025-04-17 09:51:58', '2025-04-17 09:51:58'),
(2036, NULL, 'Kurankhed', '21', 'active', '2025-04-17 09:51:58', '2025-04-17 09:51:58'),
(2037, NULL, 'Kurduvadi', '21', 'active', '2025-04-17 09:51:58', '2025-04-17 09:51:58'),
(2038, NULL, 'Kusumba', '21', 'active', '2025-04-17 09:51:58', '2025-04-17 09:51:58'),
(2039, NULL, 'Lakhandur', '21', 'active', '2025-04-17 09:51:58', '2025-04-17 09:51:58'),
(2040, NULL, 'Lanja', '21', 'active', '2025-04-17 09:51:58', '2025-04-17 09:51:58'),
(2041, NULL, 'Lasalgaon', '21', 'active', '2025-04-17 09:51:58', '2025-04-17 09:51:58'),
(2042, NULL, 'Latur', '21', 'active', '2025-04-17 09:51:58', '2025-04-17 09:51:58'),
(2043, NULL, 'Lavasa', '21', 'active', '2025-04-17 09:51:58', '2025-04-17 09:51:58'),
(2044, NULL, 'Lohogaon', '21', 'active', '2025-04-17 09:51:58', '2025-04-17 09:51:58'),
(2045, NULL, 'Lonar', '21', 'active', '2025-04-17 09:51:58', '2025-04-17 09:51:58'),
(2046, NULL, 'Lonavla', '21', 'active', '2025-04-17 09:51:58', '2025-04-17 09:51:58'),
(2047, NULL, 'Mahabaleshwar', '21', 'active', '2025-04-17 09:51:58', '2025-04-17 09:51:58'),
(2048, NULL, 'Mahad', '21', 'active', '2025-04-17 09:51:58', '2025-04-17 09:51:58'),
(2049, NULL, 'Mahape', '21', 'active', '2025-04-17 09:51:58', '2025-04-17 09:51:58'),
(2050, NULL, 'Mahim', '21', 'active', '2025-04-17 09:51:58', '2025-04-17 09:51:58'),
(2051, NULL, 'Maindargi', '21', 'active', '2025-04-17 09:51:58', '2025-04-17 09:51:58'),
(2052, NULL, 'Majalgaon', '21', 'active', '2025-04-17 09:51:58', '2025-04-17 09:51:58'),
(2053, NULL, 'Makhjan', '21', 'active', '2025-04-17 09:51:58', '2025-04-17 09:51:58'),
(2054, NULL, 'Malabar Hill', '21', 'active', '2025-04-17 09:51:58', '2025-04-17 09:51:58'),
(2055, NULL, 'Malad', '21', 'active', '2025-04-17 09:51:58', '2025-04-17 09:51:58'),
(2056, NULL, 'Malegaon', '21', 'active', '2025-04-17 09:51:58', '2025-04-17 09:51:58'),
(2057, NULL, 'Malkapur', '21', 'active', '2025-04-17 09:51:58', '2025-04-17 09:51:58'),
(2058, NULL, 'Malvan', '21', 'active', '2025-04-17 09:51:58', '2025-04-17 09:51:58'),
(2059, NULL, 'Manchar', '21', 'active', '2025-04-17 09:51:58', '2025-04-17 09:51:58'),
(2060, NULL, 'Mandangad', '21', 'active', '2025-04-17 09:51:58', '2025-04-17 09:51:58'),
(2061, NULL, 'Mandhal', '21', 'active', '2025-04-17 09:51:58', '2025-04-17 09:51:58'),
(2062, NULL, 'Mandwa', '21', 'active', '2025-04-17 09:51:58', '2025-04-17 09:51:58'),
(2063, NULL, 'Mangaon', '21', 'active', '2025-04-17 09:51:58', '2025-04-17 09:51:58'),
(2064, NULL, 'Mangrul Pir', '21', 'active', '2025-04-17 09:51:58', '2025-04-17 09:51:58'),
(2065, NULL, 'Manjlegaon', '21', 'active', '2025-04-17 09:51:58', '2025-04-17 09:51:58'),
(2066, NULL, 'Mankeshwar', '21', 'active', '2025-04-17 09:51:58', '2025-04-17 09:51:58'),
(2067, NULL, 'Mankhurd', '21', 'active', '2025-04-17 09:51:58', '2025-04-17 09:51:58'),
(2068, NULL, 'Manmad', '21', 'active', '2025-04-17 09:51:58', '2025-04-17 09:51:58'),
(2069, NULL, 'Manor', '21', 'active', '2025-04-17 09:51:58', '2025-04-17 09:51:58'),
(2070, NULL, 'Mansar', '21', 'active', '2025-04-17 09:51:58', '2025-04-17 09:51:58'),
(2071, NULL, 'Manwat', '21', 'active', '2025-04-17 09:51:58', '2025-04-17 09:51:58'),
(2072, NULL, 'Maregaon', '21', 'active', '2025-04-17 09:51:58', '2025-04-17 09:51:58'),
(2073, NULL, 'Mastiholi', '21', 'active', '2025-04-17 09:51:58', '2025-04-17 09:51:58'),
(2074, NULL, 'Masur India', '21', 'active', '2025-04-17 09:51:58', '2025-04-17 09:51:58'),
(2075, NULL, 'Matheran', '21', 'active', '2025-04-17 09:51:58', '2025-04-17 09:51:58'),
(2076, NULL, 'Matunga', '21', 'active', '2025-04-17 09:51:58', '2025-04-17 09:51:58'),
(2077, NULL, 'Mazagaon', '21', 'active', '2025-04-17 09:51:58', '2025-04-17 09:51:58'),
(2078, NULL, 'Mehekar', '21', 'active', '2025-04-17 09:51:58', '2025-04-17 09:51:58'),
(2079, NULL, 'Mehergaon', '21', 'active', '2025-04-17 09:51:58', '2025-04-17 09:51:58'),
(2080, NULL, 'Mehkar', '21', 'active', '2025-04-17 09:51:58', '2025-04-17 09:51:58'),
(2081, NULL, 'Mhasla', '21', 'active', '2025-04-17 09:51:58', '2025-04-17 09:51:58'),
(2082, NULL, 'Mhasvad', '21', 'active', '2025-04-17 09:51:58', '2025-04-17 09:51:58'),
(2083, NULL, 'Miraj', '21', 'active', '2025-04-17 09:51:58', '2025-04-17 09:51:58'),
(2084, NULL, 'Mohadi', '21', 'active', '2025-04-17 09:51:58', '2025-04-17 09:51:58'),
(2085, NULL, 'Mohol', '21', 'active', '2025-04-17 09:51:58', '2025-04-17 09:51:58'),
(2086, NULL, 'Mohpa', '21', 'active', '2025-04-17 09:51:58', '2025-04-17 09:51:58'),
(2087, NULL, 'Mokhada taluka', '21', 'active', '2025-04-17 09:51:58', '2025-04-17 09:51:58'),
(2088, NULL, 'Mora Maharashtra', '21', 'active', '2025-04-17 09:51:58', '2025-04-17 09:51:58'),
(2089, NULL, 'Moram', '21', 'active', '2025-04-17 09:51:58', '2025-04-17 09:51:58'),
(2090, NULL, 'Morsi', '21', 'active', '2025-04-17 09:51:58', '2025-04-17 09:51:58'),
(2091, NULL, 'Mowad', '21', 'active', '2025-04-17 09:51:58', '2025-04-17 09:51:58'),
(2092, NULL, 'Mudkhed', '21', 'active', '2025-04-17 09:51:58', '2025-04-17 09:51:58'),
(2093, NULL, 'Mukher', '21', 'active', '2025-04-17 09:51:58', '2025-04-17 09:51:58'),
(2094, NULL, 'Mul', '21', 'active', '2025-04-17 09:51:58', '2025-04-17 09:51:58'),
(2095, NULL, 'Mulher', '21', 'active', '2025-04-17 09:51:58', '2025-04-17 09:51:58'),
(2096, NULL, 'Mulund', '21', 'active', '2025-04-17 09:51:58', '2025-04-17 09:51:58'),
(2097, NULL, 'Mumbai', '21', 'active', '2025-04-17 09:51:58', '2025-04-17 09:51:58'),
(2098, NULL, 'Mumbai Suburban', '21', 'active', '2025-04-17 09:51:58', '2025-04-17 09:51:58'),
(2099, NULL, 'Murbad', '21', 'active', '2025-04-17 09:51:58', '2025-04-17 09:51:58'),
(2100, NULL, 'Murgud', '21', 'active', '2025-04-17 09:51:58', '2025-04-17 09:51:58'),
(2101, NULL, 'Murtajapur', '21', 'active', '2025-04-17 09:51:58', '2025-04-17 09:51:58'),
(2102, NULL, 'Murud (Raigad)', '21', 'active', '2025-04-17 09:51:58', '2025-04-17 09:51:58'),
(2103, NULL, 'Murud (Ratnagiri)', '21', 'active', '2025-04-17 09:51:58', '2025-04-17 09:51:58'),
(2104, NULL, 'Murum', '21', 'active', '2025-04-17 09:51:58', '2025-04-17 09:51:58'),
(2105, NULL, 'Nadgaon', '21', 'active', '2025-04-17 09:51:58', '2025-04-17 09:51:58'),
(2106, NULL, 'Nagapur', '21', 'active', '2025-04-17 09:51:58', '2025-04-17 09:51:58'),
(2107, NULL, 'Nagothana', '21', 'active', '2025-04-17 09:51:58', '2025-04-17 09:51:58'),
(2108, NULL, 'Nagpur', '21', 'active', '2025-04-17 09:51:58', '2025-04-17 09:51:58'),
(2109, NULL, 'Nagpur Division', '21', 'active', '2025-04-17 09:51:58', '2025-04-17 09:51:58'),
(2110, NULL, 'Nala Sopara', '21', 'active', '2025-04-17 09:51:58', '2025-04-17 09:51:58'),
(2111, NULL, 'Naldurg', '21', 'active', '2025-04-17 09:51:58', '2025-04-17 09:51:58'),
(2112, NULL, 'Nalegaon', '21', 'active', '2025-04-17 09:51:58', '2025-04-17 09:51:58'),
(2113, NULL, 'Nampur', '21', 'active', '2025-04-17 09:51:58', '2025-04-17 09:51:58'),
(2114, NULL, 'Nanded', '21', 'active', '2025-04-17 09:51:58', '2025-04-17 09:51:58'),
(2115, NULL, 'Nandgaon', '21', 'active', '2025-04-17 09:51:58', '2025-04-17 09:51:58'),
(2116, NULL, 'Nandnee', '21', 'active', '2025-04-17 09:51:58', '2025-04-17 09:51:58'),
(2117, NULL, 'Nandura', '21', 'active', '2025-04-17 09:51:58', '2025-04-17 09:51:58'),
(2118, NULL, 'Nandura Buzurg', '21', 'active', '2025-04-17 09:51:58', '2025-04-17 09:51:58'),
(2119, NULL, 'Nandurbar', '21', 'active', '2025-04-17 09:51:58', '2025-04-17 09:51:58'),
(2120, NULL, 'Narayangaon', '21', 'active', '2025-04-17 09:51:58', '2025-04-17 09:51:58'),
(2121, NULL, 'Nardana', '21', 'active', '2025-04-17 09:51:58', '2025-04-17 09:51:58'),
(2122, NULL, 'Nariman Point', '21', 'active', '2025-04-17 09:51:58', '2025-04-17 09:51:58'),
(2123, NULL, 'Narkhed', '21', 'active', '2025-04-17 09:51:58', '2025-04-17 09:51:58'),
(2124, NULL, 'Nashik', '21', 'active', '2025-04-17 09:51:58', '2025-04-17 09:51:58'),
(2125, NULL, 'Nashik Division', '21', 'active', '2025-04-17 09:51:58', '2025-04-17 09:51:58'),
(2126, NULL, 'Navapur', '21', 'active', '2025-04-17 09:51:58', '2025-04-17 09:51:58'),
(2127, NULL, 'Navi Mumbai', '21', 'active', '2025-04-17 09:51:58', '2025-04-17 09:51:58'),
(2128, NULL, 'Neral', '21', 'active', '2025-04-17 09:51:58', '2025-04-17 09:51:58'),
(2129, NULL, 'Nerur', '21', 'active', '2025-04-17 09:51:58', '2025-04-17 09:51:58'),
(2130, NULL, 'Nevasa', '21', 'active', '2025-04-17 09:51:58', '2025-04-17 09:51:58'),
(2131, NULL, 'Nighoj', '21', 'active', '2025-04-17 09:51:58', '2025-04-17 09:51:58'),
(2132, NULL, 'Nilanga', '21', 'active', '2025-04-17 09:51:58', '2025-04-17 09:51:58'),
(2133, NULL, 'Nipani', '21', 'active', '2025-04-17 09:51:58', '2025-04-17 09:51:58'),
(2134, NULL, 'Niphad', '21', 'active', '2025-04-17 09:51:58', '2025-04-17 09:51:58'),
(2135, NULL, 'Nira Narsingpur', '21', 'active', '2025-04-17 09:51:58', '2025-04-17 09:51:58'),
(2136, NULL, 'Osmanabad', '21', 'active', '2025-04-17 09:51:58', '2025-04-17 09:51:58'),
(2137, NULL, 'Ozar', '21', 'active', '2025-04-17 09:51:58', '2025-04-17 09:51:58'),
(2138, NULL, 'Pabal', '21', 'active', '2025-04-17 09:51:58', '2025-04-17 09:51:58'),
(2139, NULL, 'Pachora', '21', 'active', '2025-04-17 09:51:58', '2025-04-17 09:51:58'),
(2140, NULL, 'Pahur Maharashtra', '21', 'active', '2025-04-17 09:51:58', '2025-04-17 09:51:58'),
(2141, NULL, 'Paithan', '21', 'active', '2025-04-17 09:51:58', '2025-04-17 09:51:58'),
(2142, NULL, 'Palghar', '21', 'active', '2025-04-17 09:51:58', '2025-04-17 09:51:58'),
(2143, NULL, 'Pali Raigad', '21', 'active', '2025-04-17 09:51:58', '2025-04-17 09:51:58'),
(2144, NULL, 'Palso', '21', 'active', '2025-04-17 09:51:58', '2025-04-17 09:51:58'),
(2145, NULL, 'Panchgani', '21', 'active', '2025-04-17 09:51:58', '2025-04-17 09:51:58'),
(2146, NULL, 'Pandharpur', '21', 'active', '2025-04-17 09:51:58', '2025-04-17 09:51:58'),
(2147, NULL, 'Pandhurli', '21', 'active', '2025-04-17 09:51:58', '2025-04-17 09:51:58'),
(2148, NULL, 'Panhala', '21', 'active', '2025-04-17 09:51:58', '2025-04-17 09:51:58'),
(2149, NULL, 'Panvel', '21', 'active', '2025-04-17 09:51:58', '2025-04-17 09:51:58'),
(2150, NULL, 'Parbhani', '21', 'active', '2025-04-17 09:51:58', '2025-04-17 09:51:58'),
(2151, NULL, 'Parel', '21', 'active', '2025-04-17 09:51:58', '2025-04-17 09:51:58'),
(2152, NULL, 'Parli Vaijnath', '21', 'active', '2025-04-17 09:51:58', '2025-04-17 09:51:58'),
(2153, NULL, 'Parner', '21', 'active', '2025-04-17 09:51:58', '2025-04-17 09:51:58'),
(2154, NULL, 'Parola', '21', 'active', '2025-04-17 09:51:58', '2025-04-17 09:51:58'),
(2155, NULL, 'Parseoni', '21', 'active', '2025-04-17 09:51:58', '2025-04-17 09:51:58'),
(2156, NULL, 'Partur', '21', 'active', '2025-04-17 09:51:58', '2025-04-17 09:51:58'),
(2157, NULL, 'Patan', '21', 'active', '2025-04-17 09:51:58', '2025-04-17 09:51:58'),
(2158, NULL, 'Pathardi', '21', 'active', '2025-04-17 09:51:58', '2025-04-17 09:51:58'),
(2159, NULL, 'Pathri', '21', 'active', '2025-04-17 09:51:58', '2025-04-17 09:51:58'),
(2160, NULL, 'Patur', '21', 'active', '2025-04-17 09:51:58', '2025-04-17 09:51:58'),
(2161, NULL, 'Paturda', '21', 'active', '2025-04-17 09:51:58', '2025-04-17 09:51:58'),
(2162, NULL, 'Paud', '21', 'active', '2025-04-17 09:51:58', '2025-04-17 09:51:58'),
(2163, NULL, 'Pauni', '21', 'active', '2025-04-17 09:51:58', '2025-04-17 09:51:58'),
(2164, NULL, 'Pawni', '21', 'active', '2025-04-17 09:51:58', '2025-04-17 09:51:58'),
(2165, NULL, 'Pedgaon', '21', 'active', '2025-04-17 09:51:58', '2025-04-17 09:51:58'),
(2166, NULL, 'Peint', '21', 'active', '2025-04-17 09:51:58', '2025-04-17 09:51:58'),
(2167, NULL, 'Pen', '21', 'active', '2025-04-17 09:51:58', '2025-04-17 09:51:58'),
(2168, NULL, 'Phaltan', '21', 'active', '2025-04-17 09:51:58', '2025-04-17 09:51:58'),
(2169, NULL, 'Phulambri', '21', 'active', '2025-04-17 09:51:58', '2025-04-17 09:51:58'),
(2170, NULL, 'Piliv', '21', 'active', '2025-04-17 09:51:58', '2025-04-17 09:51:58'),
(2171, NULL, 'Pimpalgaon Baswant', '21', 'active', '2025-04-17 09:51:58', '2025-04-17 09:51:58'),
(2172, NULL, 'Pimpalgaon Raja', '21', 'active', '2025-04-17 09:51:58', '2025-04-17 09:51:58'),
(2173, NULL, 'Pimpri', '21', 'active', '2025-04-17 09:51:58', '2025-04-17 09:51:58'),
(2174, NULL, 'Pimpri-Chinchwad', '21', 'active', '2025-04-17 09:51:58', '2025-04-17 09:51:58'),
(2175, NULL, 'Pipri', '21', 'active', '2025-04-17 09:51:58', '2025-04-17 09:51:58'),
(2176, NULL, 'Powai', '21', 'active', '2025-04-17 09:51:58', '2025-04-17 09:51:58'),
(2177, NULL, 'Prabhadevi', '21', 'active', '2025-04-17 09:51:58', '2025-04-17 09:51:58'),
(2178, NULL, 'Prakasha', '21', 'active', '2025-04-17 09:51:58', '2025-04-17 09:51:58'),
(2179, NULL, 'Pulgaon', '21', 'active', '2025-04-17 09:51:58', '2025-04-17 09:51:58'),
(2180, NULL, 'Pune', '21', 'active', '2025-04-17 09:51:58', '2025-04-17 09:51:58'),
(2181, NULL, 'Pune Division', '21', 'active', '2025-04-17 09:51:58', '2025-04-17 09:51:58'),
(2182, NULL, 'Puntamba', '21', 'active', '2025-04-17 09:51:58', '2025-04-17 09:51:58'),
(2183, NULL, 'Pural', '21', 'active', '2025-04-17 09:51:58', '2025-04-17 09:51:58'),
(2184, NULL, 'Purna', '21', 'active', '2025-04-17 09:51:58', '2025-04-17 09:51:58'),
(2185, NULL, 'Pusad', '21', 'active', '2025-04-17 09:51:58', '2025-04-17 09:51:58'),
(2186, NULL, 'Radhanagari', '21', 'active', '2025-04-17 09:51:58', '2025-04-17 09:51:58'),
(2187, NULL, 'Rahata', '21', 'active', '2025-04-17 09:51:58', '2025-04-17 09:51:58'),
(2188, NULL, 'Rahimatpur', '21', 'active', '2025-04-17 09:51:58', '2025-04-17 09:51:58'),
(2189, NULL, 'Rahuri', '21', 'active', '2025-04-17 09:51:58', '2025-04-17 09:51:58'),
(2190, NULL, 'Raigarh', '21', 'active', '2025-04-17 09:51:58', '2025-04-17 09:51:58'),
(2191, NULL, 'Raireshwar', '21', 'active', '2025-04-17 09:51:58', '2025-04-17 09:51:58'),
(2192, NULL, 'Rajapur', '21', 'active', '2025-04-17 09:51:58', '2025-04-17 09:51:58'),
(2193, NULL, 'Rajgurunagar', '21', 'active', '2025-04-17 09:51:58', '2025-04-17 09:51:58'),
(2194, NULL, 'Rajur', '21', 'active', '2025-04-17 09:51:58', '2025-04-17 09:51:58'),
(2195, NULL, 'Rajura', '21', 'active', '2025-04-17 09:51:58', '2025-04-17 09:51:58'),
(2196, NULL, 'Ralegaon', '21', 'active', '2025-04-17 09:51:58', '2025-04-17 09:51:58'),
(2197, NULL, 'Ramewadi', '21', 'active', '2025-04-17 09:51:58', '2025-04-17 09:51:58'),
(2198, NULL, 'Ramtek', '21', 'active', '2025-04-17 09:51:58', '2025-04-17 09:51:58'),
(2199, NULL, 'Ratnagiri', '21', 'active', '2025-04-17 09:51:58', '2025-04-17 09:51:58'),
(2200, NULL, 'Raver', '21', 'active', '2025-04-17 09:51:58', '2025-04-17 09:51:58'),
(2201, NULL, 'Renapur', '21', 'active', '2025-04-17 09:51:58', '2025-04-17 09:51:58'),
(2202, NULL, 'Renavi', '21', 'active', '2025-04-17 09:51:58', '2025-04-17 09:51:58'),
(2203, NULL, 'Revadanda', '21', 'active', '2025-04-17 09:51:58', '2025-04-17 09:51:58'),
(2204, NULL, 'Revdanda', '21', 'active', '2025-04-17 09:51:58', '2025-04-17 09:51:58'),
(2205, NULL, 'Risod', '21', 'active', '2025-04-17 09:51:58', '2025-04-17 09:51:58'),
(2206, NULL, 'Roha', '21', 'active', '2025-04-17 09:51:58', '2025-04-17 09:51:58'),
(2207, NULL, 'Sailu', '21', 'active', '2025-04-17 09:51:58', '2025-04-17 09:51:58'),
(2208, NULL, 'Sakol', '21', 'active', '2025-04-17 09:51:58', '2025-04-17 09:51:58'),
(2209, NULL, 'Sakoli', '21', 'active', '2025-04-17 09:51:58', '2025-04-17 09:51:58'),
(2210, NULL, 'Sakri', '21', 'active', '2025-04-17 09:51:58', '2025-04-17 09:51:58'),
(2211, NULL, 'Samudrapur', '21', 'active', '2025-04-17 09:51:58', '2025-04-17 09:51:58'),
(2212, NULL, 'Sangameshwar', '21', 'active', '2025-04-17 09:51:58', '2025-04-17 09:51:58'),
(2213, NULL, 'Sangamner', '21', 'active', '2025-04-17 09:51:58', '2025-04-17 09:51:58'),
(2214, NULL, 'Sangli', '21', 'active', '2025-04-17 09:51:58', '2025-04-17 09:51:58'),
(2215, NULL, 'Sangola', '21', 'active', '2025-04-17 09:51:58', '2025-04-17 09:51:58'),
(2216, NULL, 'Sangrampur Maharashtra', '21', 'active', '2025-04-17 09:51:58', '2025-04-17 09:51:58'),
(2217, NULL, 'Saoli', '21', 'active', '2025-04-17 09:51:58', '2025-04-17 09:51:58'),
(2218, NULL, 'Saoner', '21', 'active', '2025-04-17 09:51:58', '2025-04-17 09:51:58'),
(2219, NULL, 'Sarangkheda', '21', 'active', '2025-04-17 09:51:58', '2025-04-17 09:51:58'),
(2220, NULL, 'Saswad', '21', 'active', '2025-04-17 09:51:58', '2025-04-17 09:51:58'),
(2221, NULL, 'Satana', '21', 'active', '2025-04-17 09:51:58', '2025-04-17 09:51:58'),
(2222, NULL, 'Satara', '21', 'active', '2025-04-17 09:51:58', '2025-04-17 09:51:58'),
(2223, NULL, 'Satara Division', '21', 'active', '2025-04-17 09:51:58', '2025-04-17 09:51:58'),
(2224, NULL, 'Satpati', '21', 'active', '2025-04-17 09:51:58', '2025-04-17 09:51:58'),
(2225, NULL, 'Savantvadi', '21', 'active', '2025-04-17 09:51:58', '2025-04-17 09:51:58'),
(2226, NULL, 'Savda', '21', 'active', '2025-04-17 09:51:58', '2025-04-17 09:51:58'),
(2227, NULL, 'Savlaj', '21', 'active', '2025-04-17 09:51:58', '2025-04-17 09:51:58'),
(2228, NULL, 'Sawantvadi', '21', 'active', '2025-04-17 09:51:58', '2025-04-17 09:51:58'),
(2229, NULL, 'Selu', '21', 'active', '2025-04-17 09:51:58', '2025-04-17 09:51:58'),
(2230, NULL, 'Sevagram', '21', 'active', '2025-04-17 09:51:58', '2025-04-17 09:51:58'),
(2231, NULL, 'Sewri', '21', 'active', '2025-04-17 09:51:58', '2025-04-17 09:51:58'),
(2232, NULL, 'Shahada', '21', 'active', '2025-04-17 09:51:58', '2025-04-17 09:51:58'),
(2233, NULL, 'Shahapur', '21', 'active', '2025-04-17 09:51:58', '2025-04-17 09:51:58'),
(2234, NULL, 'Shedbal', '21', 'active', '2025-04-17 09:51:58', '2025-04-17 09:51:58'),
(2235, NULL, 'Shegaon', '21', 'active', '2025-04-17 09:51:58', '2025-04-17 09:51:58'),
(2236, NULL, 'Shevgaon', '21', 'active', '2025-04-17 09:51:58', '2025-04-17 09:51:58'),
(2237, NULL, 'Shikrapur', '21', 'active', '2025-04-17 09:51:58', '2025-04-17 09:51:58'),
(2238, NULL, 'Shiraguppi', '21', 'active', '2025-04-17 09:51:58', '2025-04-17 09:51:58'),
(2239, NULL, 'Shirala', '21', 'active', '2025-04-17 09:51:58', '2025-04-17 09:51:58'),
(2240, NULL, 'Shirdi', '21', 'active', '2025-04-17 09:51:58', '2025-04-17 09:51:58'),
(2241, NULL, 'Shirgaon', '21', 'active', '2025-04-17 09:51:58', '2025-04-17 09:51:58'),
(2242, NULL, 'Shirol', '21', 'active', '2025-04-17 09:51:58', '2025-04-17 09:51:58'),
(2243, NULL, 'Shirpur', '21', 'active', '2025-04-17 09:51:58', '2025-04-17 09:51:58'),
(2244, NULL, 'Shirud', '21', 'active', '2025-04-17 09:51:58', '2025-04-17 09:51:58'),
(2245, NULL, 'Shirwal', '21', 'active', '2025-04-17 09:51:58', '2025-04-17 09:51:58'),
(2246, NULL, 'Shivaji Nagar', '21', 'active', '2025-04-17 09:51:58', '2025-04-17 09:51:58'),
(2247, NULL, 'Shrigonda', '21', 'active', '2025-04-17 09:51:58', '2025-04-17 09:51:58'),
(2248, NULL, 'Sillod', '21', 'active', '2025-04-17 09:51:58', '2025-04-17 09:51:58'),
(2249, NULL, 'Sindewahi', '21', 'active', '2025-04-17 09:51:58', '2025-04-17 09:51:58'),
(2250, NULL, 'Sindhudurg', '21', 'active', '2025-04-17 09:51:58', '2025-04-17 09:51:58'),
(2251, NULL, 'Sindi', '21', 'active', '2025-04-17 09:51:58', '2025-04-17 09:51:58'),
(2252, NULL, 'Sindkheda', '21', 'active', '2025-04-17 09:51:58', '2025-04-17 09:51:58'),
(2253, NULL, 'Sinnar', '21', 'active', '2025-04-17 09:51:58', '2025-04-17 09:51:58'),
(2254, NULL, 'Sion Mumbai', '21', 'active', '2025-04-17 09:51:58', '2025-04-17 09:51:58'),
(2255, NULL, 'Sironcha', '21', 'active', '2025-04-17 09:51:58', '2025-04-17 09:51:58'),
(2256, NULL, 'Sirur', '21', 'active', '2025-04-17 09:51:58', '2025-04-17 09:51:58'),
(2257, NULL, 'Sivala East Godavari district', '21', 'active', '2025-04-17 09:51:58', '2025-04-17 09:51:58'),
(2258, NULL, 'Solapur', '21', 'active', '2025-04-17 09:51:58', '2025-04-17 09:51:58'),
(2259, NULL, 'Sonala', '21', 'active', '2025-04-17 09:51:58', '2025-04-17 09:51:58'),
(2260, NULL, 'Sonegaon', '21', 'active', '2025-04-17 09:51:58', '2025-04-17 09:51:58'),
(2261, NULL, 'Songir', '21', 'active', '2025-04-17 09:51:58', '2025-04-17 09:51:58'),
(2262, NULL, 'Sonvad', '21', 'active', '2025-04-17 09:51:58', '2025-04-17 09:51:58'),
(2263, NULL, 'Soygaon', '21', 'active', '2025-04-17 09:51:58', '2025-04-17 09:51:58'),
(2264, NULL, 'Srivardhan', '21', 'active', '2025-04-17 09:51:58', '2025-04-17 09:51:58'),
(2265, NULL, 'Surgana', '21', 'active', '2025-04-17 09:51:58', '2025-04-17 09:51:58'),
(2266, NULL, 'Taklibhan', '21', 'active', '2025-04-17 09:51:58', '2025-04-17 09:51:58'),
(2267, NULL, 'Talbid', '21', 'active', '2025-04-17 09:51:58', '2025-04-17 09:51:58'),
(2268, NULL, 'Talegaon Dabhade', '21', 'active', '2025-04-17 09:51:58', '2025-04-17 09:51:58'),
(2269, NULL, 'Talegaon Dhamdhere', '21', 'active', '2025-04-17 09:51:58', '2025-04-17 09:51:58'),
(2270, NULL, 'Taloda', '21', 'active', '2025-04-17 09:51:58', '2025-04-17 09:51:58'),
(2271, NULL, 'Talode', '21', 'active', '2025-04-17 09:51:58', '2025-04-17 09:51:58'),
(2272, NULL, 'Tarapur', '21', 'active', '2025-04-17 09:51:58', '2025-04-17 09:51:58'),
(2273, NULL, 'Tardeo', '21', 'active', '2025-04-17 09:51:58', '2025-04-17 09:51:58'),
(2274, NULL, 'Tasgaon', '21', 'active', '2025-04-17 09:51:58', '2025-04-17 09:51:58'),
(2275, NULL, 'Telhara', '21', 'active', '2025-04-17 09:51:58', '2025-04-17 09:51:58'),
(2276, NULL, 'Thalner', '21', 'active', '2025-04-17 09:51:58', '2025-04-17 09:51:58'),
(2277, NULL, 'Thane', '21', 'active', '2025-04-17 09:51:58', '2025-04-17 09:51:58'),
(2278, NULL, 'Trimbak', '21', 'active', '2025-04-17 09:51:58', '2025-04-17 09:51:58'),
(2279, NULL, 'Trombay', '21', 'active', '2025-04-17 09:51:58', '2025-04-17 09:51:58'),
(2280, NULL, 'Tuljapur', '21', 'active', '2025-04-17 09:51:58', '2025-04-17 09:51:58'),
(2281, NULL, 'Tumsar', '21', 'active', '2025-04-17 09:51:58', '2025-04-17 09:51:58'),
(2282, NULL, 'Udgir', '21', 'active', '2025-04-17 09:51:58', '2025-04-17 09:51:58'),
(2283, NULL, 'Ulhasnagar', '21', 'active', '2025-04-17 09:51:58', '2025-04-17 09:51:58'),
(2284, NULL, 'Umarga', '21', 'active', '2025-04-17 09:51:58', '2025-04-17 09:51:58'),
(2285, NULL, 'Umarkhed', '21', 'active', '2025-04-17 09:51:58', '2025-04-17 09:51:58'),
(2286, NULL, 'Umred', '21', 'active', '2025-04-17 09:51:58', '2025-04-17 09:51:58'),
(2287, NULL, 'Uran', '21', 'active', '2025-04-17 09:51:58', '2025-04-17 09:51:58'),
(2288, NULL, 'Uruli Kanchan', '21', 'active', '2025-04-17 09:51:58', '2025-04-17 09:51:58'),
(2289, NULL, 'Vada', '21', 'active', '2025-04-17 09:51:58', '2025-04-17 09:51:58'),
(2290, NULL, 'Vadgaon', '21', 'active', '2025-04-17 09:51:58', '2025-04-17 09:51:58'),
(2291, NULL, 'Vadner', '21', 'active', '2025-04-17 09:51:58', '2025-04-17 09:51:58'),
(2292, NULL, 'Vaijapur', '21', 'active', '2025-04-17 09:51:58', '2025-04-17 09:51:58'),
(2293, NULL, 'Vairag', '21', 'active', '2025-04-17 09:51:58', '2025-04-17 09:51:58'),
(2294, NULL, 'Valsang', '21', 'active', '2025-04-17 09:51:58', '2025-04-17 09:51:58'),
(2295, NULL, 'Vangaon', '21', 'active', '2025-04-17 09:51:58', '2025-04-17 09:51:58'),
(2296, NULL, 'Varangaon', '21', 'active', '2025-04-17 09:51:58', '2025-04-17 09:51:58'),
(2297, NULL, 'Vashi', '21', 'active', '2025-04-17 09:51:58', '2025-04-17 09:51:58'),
(2298, NULL, 'Vasind', '21', 'active', '2025-04-17 09:51:58', '2025-04-17 09:51:58'),
(2299, NULL, 'Vatul', '21', 'active', '2025-04-17 09:51:58', '2025-04-17 09:51:58'),
(2300, NULL, 'Velas Maharashtra', '21', 'active', '2025-04-17 09:51:58', '2025-04-17 09:51:58'),
(2301, NULL, 'Velneshwar', '21', 'active', '2025-04-17 09:51:58', '2025-04-17 09:51:58'),
(2302, NULL, 'Vengurla', '21', 'active', '2025-04-17 09:51:58', '2025-04-17 09:51:58'),
(2303, NULL, 'Vijaydurg', '21', 'active', '2025-04-17 09:51:58', '2025-04-17 09:51:58'),
(2304, NULL, 'Vikhroli', '21', 'active', '2025-04-17 09:51:58', '2025-04-17 09:51:58'),
(2305, NULL, 'Vile Parle', '21', 'active', '2025-04-17 09:51:58', '2025-04-17 09:51:58'),
(2306, NULL, 'Vinchur', '21', 'active', '2025-04-17 09:51:58', '2025-04-17 09:51:58'),
(2307, NULL, 'Virar', '21', 'active', '2025-04-17 09:51:58', '2025-04-17 09:51:58'),
(2308, NULL, 'Vita Maharashtra', '21', 'active', '2025-04-17 09:51:58', '2025-04-17 09:51:58'),
(2309, NULL, 'Vite', '21', 'active', '2025-04-17 09:51:58', '2025-04-17 09:51:58'),
(2310, NULL, 'Wadala', '21', 'active', '2025-04-17 09:51:58', '2025-04-17 09:51:58'),
(2311, NULL, 'Wadgaon', '21', 'active', '2025-04-17 09:51:58', '2025-04-17 09:51:58'),
(2312, NULL, 'Wadner', '21', 'active', '2025-04-17 09:51:58', '2025-04-17 09:51:58'),
(2313, NULL, 'Wadwani', '21', 'active', '2025-04-17 09:51:59', '2025-04-17 09:51:59'),
(2314, NULL, 'Wagholi', '21', 'active', '2025-04-17 09:51:59', '2025-04-17 09:51:59'),
(2315, NULL, 'Wai', '21', 'active', '2025-04-17 09:51:59', '2025-04-17 09:51:59'),
(2316, NULL, 'Wakad', '21', 'active', '2025-04-17 09:51:59', '2025-04-17 09:51:59'),
(2317, NULL, 'Walgaon', '21', 'active', '2025-04-17 09:51:59', '2025-04-17 09:51:59'),
(2318, NULL, 'Walki', '21', 'active', '2025-04-17 09:51:59', '2025-04-17 09:51:59'),
(2319, NULL, 'Wani', '21', 'active', '2025-04-17 09:51:59', '2025-04-17 09:51:59'),
(2320, NULL, 'Wardha', '21', 'active', '2025-04-17 09:51:59', '2025-04-17 09:51:59'),
(2321, NULL, 'Warora', '21', 'active', '2025-04-17 09:51:59', '2025-04-17 09:51:59'),
(2322, NULL, 'Warud', '21', 'active', '2025-04-17 09:51:59', '2025-04-17 09:51:59'),
(2323, NULL, 'Washim', '21', 'active', '2025-04-17 09:51:59', '2025-04-17 09:51:59'),
(2324, NULL, 'Worli', '21', 'active', '2025-04-17 09:51:59', '2025-04-17 09:51:59'),
(2325, NULL, 'Yaval', '21', 'active', '2025-04-17 09:51:59', '2025-04-17 09:51:59'),
(2326, NULL, 'Yavatmal', '21', 'active', '2025-04-17 09:51:59', '2025-04-17 09:51:59'),
(2327, NULL, 'Yeola', '21', 'active', '2025-04-17 09:51:59', '2025-04-17 09:51:59'),
(2328, NULL, 'Bishnupur', '22', 'active', '2025-04-17 09:51:59', '2025-04-17 09:51:59'),
(2329, NULL, 'Chandel', '22', 'active', '2025-04-17 09:51:59', '2025-04-17 09:51:59'),
(2330, NULL, 'Churachandpur', '22', 'active', '2025-04-17 09:51:59', '2025-04-17 09:51:59'),
(2331, NULL, 'Imphal East', '22', 'active', '2025-04-17 09:51:59', '2025-04-17 09:51:59'),
(2332, NULL, 'Imphal West', '22', 'active', '2025-04-17 09:51:59', '2025-04-17 09:51:59'),
(2333, NULL, 'Jiribam', '22', 'active', '2025-04-17 09:51:59', '2025-04-17 09:51:59'),
(2334, NULL, 'Kakching', '22', 'active', '2025-04-17 09:51:59', '2025-04-17 09:51:59'),
(2335, NULL, 'Kamjong', '22', 'active', '2025-04-17 09:51:59', '2025-04-17 09:51:59'),
(2336, NULL, 'Kangpokpi', '22', 'active', '2025-04-17 09:51:59', '2025-04-17 09:51:59'),
(2337, NULL, 'Noney', '22', 'active', '2025-04-17 09:51:59', '2025-04-17 09:51:59'),
(2338, NULL, 'Pherzawl', '22', 'active', '2025-04-17 09:51:59', '2025-04-17 09:51:59'),
(2339, NULL, 'Senapati', '22', 'active', '2025-04-17 09:51:59', '2025-04-17 09:51:59'),
(2340, NULL, 'Tamenglong', '22', 'active', '2025-04-17 09:51:59', '2025-04-17 09:51:59');
INSERT INTO `module_cities` (`id`, `slug`, `city_name`, `state_name`, `status`, `created_at`, `updated_at`) VALUES
(2341, NULL, 'Tengnoupal', '22', 'active', '2025-04-17 09:51:59', '2025-04-17 09:51:59'),
(2342, NULL, 'Thoubal', '22', 'active', '2025-04-17 09:51:59', '2025-04-17 09:51:59'),
(2343, NULL, 'Ukhrul', '22', 'active', '2025-04-17 09:51:59', '2025-04-17 09:51:59'),
(2344, NULL, 'Cherrapunji', '23', 'active', '2025-04-17 09:51:59', '2025-04-17 09:51:59'),
(2345, NULL, 'East Garo Hills', '23', 'active', '2025-04-17 09:51:59', '2025-04-17 09:51:59'),
(2346, NULL, 'East Jaintia Hills', '23', 'active', '2025-04-17 09:51:59', '2025-04-17 09:51:59'),
(2347, NULL, 'East Khasi Hills', '23', 'active', '2025-04-17 09:51:59', '2025-04-17 09:51:59'),
(2348, NULL, 'Mairang', '23', 'active', '2025-04-17 09:51:59', '2025-04-17 09:51:59'),
(2349, NULL, 'Mankachar', '23', 'active', '2025-04-17 09:51:59', '2025-04-17 09:51:59'),
(2350, NULL, 'Nongpoh', '23', 'active', '2025-04-17 09:51:59', '2025-04-17 09:51:59'),
(2351, NULL, 'Nongstoin', '23', 'active', '2025-04-17 09:51:59', '2025-04-17 09:51:59'),
(2352, NULL, 'North Garo Hills', '23', 'active', '2025-04-17 09:51:59', '2025-04-17 09:51:59'),
(2353, NULL, 'Ri-Bhoi', '23', 'active', '2025-04-17 09:51:59', '2025-04-17 09:51:59'),
(2354, NULL, 'Shillong', '23', 'active', '2025-04-17 09:51:59', '2025-04-17 09:51:59'),
(2355, NULL, 'South Garo Hills', '23', 'active', '2025-04-17 09:51:59', '2025-04-17 09:51:59'),
(2356, NULL, 'South West Garo Hills', '23', 'active', '2025-04-17 09:51:59', '2025-04-17 09:51:59'),
(2357, NULL, 'South West Khasi Hills', '23', 'active', '2025-04-17 09:51:59', '2025-04-17 09:51:59'),
(2358, NULL, 'Tura', '23', 'active', '2025-04-17 09:51:59', '2025-04-17 09:51:59'),
(2359, NULL, 'West Garo Hills', '23', 'active', '2025-04-17 09:51:59', '2025-04-17 09:51:59'),
(2360, NULL, 'West Jaintia Hills', '23', 'active', '2025-04-17 09:51:59', '2025-04-17 09:51:59'),
(2361, NULL, 'West Khasi Hills', '23', 'active', '2025-04-17 09:51:59', '2025-04-17 09:51:59'),
(2362, NULL, 'Aizawl', '24', 'active', '2025-04-17 09:51:59', '2025-04-17 09:51:59'),
(2363, NULL, 'Champhai', '24', 'active', '2025-04-17 09:51:59', '2025-04-17 09:51:59'),
(2364, NULL, 'Darlawn', '24', 'active', '2025-04-17 09:51:59', '2025-04-17 09:51:59'),
(2365, NULL, 'Khawhai', '24', 'active', '2025-04-17 09:51:59', '2025-04-17 09:51:59'),
(2366, NULL, 'Kolasib', '24', 'active', '2025-04-17 09:51:59', '2025-04-17 09:51:59'),
(2367, NULL, 'Lawngtlai', '24', 'active', '2025-04-17 09:51:59', '2025-04-17 09:51:59'),
(2368, NULL, 'Lunglei', '24', 'active', '2025-04-17 09:51:59', '2025-04-17 09:51:59'),
(2369, NULL, 'Mamit', '24', 'active', '2025-04-17 09:51:59', '2025-04-17 09:51:59'),
(2370, NULL, 'North Vanlaiphai', '24', 'active', '2025-04-17 09:51:59', '2025-04-17 09:51:59'),
(2371, NULL, 'Saiha', '24', 'active', '2025-04-17 09:51:59', '2025-04-17 09:51:59'),
(2372, NULL, 'Sairang', '24', 'active', '2025-04-17 09:51:59', '2025-04-17 09:51:59'),
(2373, NULL, 'Saitlaw', '24', 'active', '2025-04-17 09:51:59', '2025-04-17 09:51:59'),
(2374, NULL, 'Serchhip', '24', 'active', '2025-04-17 09:51:59', '2025-04-17 09:51:59'),
(2375, NULL, 'Thenzawl', '24', 'active', '2025-04-17 09:51:59', '2025-04-17 09:51:59'),
(2376, NULL, 'Dimapur', '25', 'active', '2025-04-17 09:51:59', '2025-04-17 09:51:59'),
(2377, NULL, 'Kohima', '25', 'active', '2025-04-17 09:51:59', '2025-04-17 09:51:59'),
(2378, NULL, 'Mokokchung', '25', 'active', '2025-04-17 09:51:59', '2025-04-17 09:51:59'),
(2379, NULL, 'Mon', '25', 'active', '2025-04-17 09:51:59', '2025-04-17 09:51:59'),
(2380, NULL, 'Peren', '25', 'active', '2025-04-17 09:51:59', '2025-04-17 09:51:59'),
(2381, NULL, 'Phek', '25', 'active', '2025-04-17 09:51:59', '2025-04-17 09:51:59'),
(2382, NULL, 'Tuensang', '25', 'active', '2025-04-17 09:51:59', '2025-04-17 09:51:59'),
(2383, NULL, 'Tuensang District', '25', 'active', '2025-04-17 09:51:59', '2025-04-17 09:51:59'),
(2384, NULL, 'Wokha', '25', 'active', '2025-04-17 09:51:59', '2025-04-17 09:51:59'),
(2385, NULL, 'Zunheboto', '25', 'active', '2025-04-17 09:51:59', '2025-04-17 09:51:59'),
(2386, NULL, 'Angul', '26', 'active', '2025-04-17 09:51:59', '2025-04-17 09:51:59'),
(2387, NULL, 'Angul District', '26', 'active', '2025-04-17 09:51:59', '2025-04-17 09:51:59'),
(2388, NULL, 'Asika', '26', 'active', '2025-04-17 09:51:59', '2025-04-17 09:51:59'),
(2389, NULL, 'Athagarh', '26', 'active', '2025-04-17 09:51:59', '2025-04-17 09:51:59'),
(2390, NULL, 'Bada Barabil', '26', 'active', '2025-04-17 09:51:59', '2025-04-17 09:51:59'),
(2391, NULL, 'Balangir', '26', 'active', '2025-04-17 09:51:59', '2025-04-17 09:51:59'),
(2392, NULL, 'Balasore', '26', 'active', '2025-04-17 09:51:59', '2025-04-17 09:51:59'),
(2393, NULL, 'Baleshwar', '26', 'active', '2025-04-17 09:51:59', '2025-04-17 09:51:59'),
(2394, NULL, 'Balimila', '26', 'active', '2025-04-17 09:51:59', '2025-04-17 09:51:59'),
(2395, NULL, 'Balugaon', '26', 'active', '2025-04-17 09:51:59', '2025-04-17 09:51:59'),
(2396, NULL, 'Banapur', '26', 'active', '2025-04-17 09:51:59', '2025-04-17 09:51:59'),
(2397, NULL, 'Banki', '26', 'active', '2025-04-17 09:51:59', '2025-04-17 09:51:59'),
(2398, NULL, 'Banposh', '26', 'active', '2025-04-17 09:51:59', '2025-04-17 09:51:59'),
(2399, NULL, 'Baragarh', '26', 'active', '2025-04-17 09:51:59', '2025-04-17 09:51:59'),
(2400, NULL, 'Barbil', '26', 'active', '2025-04-17 09:51:59', '2025-04-17 09:51:59'),
(2401, NULL, 'Bargarh', '26', 'active', '2025-04-17 09:51:59', '2025-04-17 09:51:59'),
(2402, NULL, 'Barpali', '26', 'active', '2025-04-17 09:51:59', '2025-04-17 09:51:59'),
(2403, NULL, 'Basudebpur', '26', 'active', '2025-04-17 09:51:59', '2025-04-17 09:51:59'),
(2404, NULL, 'Baud', '26', 'active', '2025-04-17 09:51:59', '2025-04-17 09:51:59'),
(2405, NULL, 'Baudh', '26', 'active', '2025-04-17 09:51:59', '2025-04-17 09:51:59'),
(2406, NULL, 'Belaguntha', '26', 'active', '2025-04-17 09:51:59', '2025-04-17 09:51:59'),
(2407, NULL, 'Bhadrak', '26', 'active', '2025-04-17 09:51:59', '2025-04-17 09:51:59'),
(2408, NULL, 'Bhadrakh', '26', 'active', '2025-04-17 09:51:59', '2025-04-17 09:51:59'),
(2409, NULL, 'Bhanjanagar', '26', 'active', '2025-04-17 09:51:59', '2025-04-17 09:51:59'),
(2410, NULL, 'Bhawanipatna', '26', 'active', '2025-04-17 09:51:59', '2025-04-17 09:51:59'),
(2411, NULL, 'Bhuban', '26', 'active', '2025-04-17 09:51:59', '2025-04-17 09:51:59'),
(2412, NULL, 'Bhubaneswar', '26', 'active', '2025-04-17 09:51:59', '2025-04-17 09:51:59'),
(2413, NULL, 'Binka', '26', 'active', '2025-04-17 09:51:59', '2025-04-17 09:51:59'),
(2414, NULL, 'Birmitrapur', '26', 'active', '2025-04-17 09:51:59', '2025-04-17 09:51:59'),
(2415, NULL, 'Bolanikhodan', '26', 'active', '2025-04-17 09:51:59', '2025-04-17 09:51:59'),
(2416, NULL, 'Brahmapur', '26', 'active', '2025-04-17 09:51:59', '2025-04-17 09:51:59'),
(2417, NULL, 'Brajarajnagar', '26', 'active', '2025-04-17 09:51:59', '2025-04-17 09:51:59'),
(2418, NULL, 'Buguda', '26', 'active', '2025-04-17 09:51:59', '2025-04-17 09:51:59'),
(2419, NULL, 'Burla', '26', 'active', '2025-04-17 09:51:59', '2025-04-17 09:51:59'),
(2420, NULL, 'Champua', '26', 'active', '2025-04-17 09:51:59', '2025-04-17 09:51:59'),
(2421, NULL, 'Chandbali', '26', 'active', '2025-04-17 09:51:59', '2025-04-17 09:51:59'),
(2422, NULL, 'Chatrapur', '26', 'active', '2025-04-17 09:51:59', '2025-04-17 09:51:59'),
(2423, NULL, 'Chikitigarh', '26', 'active', '2025-04-17 09:51:59', '2025-04-17 09:51:59'),
(2424, NULL, 'Chittarkonda', '26', 'active', '2025-04-17 09:51:59', '2025-04-17 09:51:59'),
(2425, NULL, 'Cuttack', '26', 'active', '2025-04-17 09:51:59', '2025-04-17 09:51:59'),
(2426, NULL, 'Daitari', '26', 'active', '2025-04-17 09:51:59', '2025-04-17 09:51:59'),
(2427, NULL, 'Deogarh', '26', 'active', '2025-04-17 09:51:59', '2025-04-17 09:51:59'),
(2428, NULL, 'Dhenkanal', '26', 'active', '2025-04-17 09:51:59', '2025-04-17 09:51:59'),
(2429, NULL, 'Digapahandi', '26', 'active', '2025-04-17 09:51:59', '2025-04-17 09:51:59'),
(2430, NULL, 'Gajapati', '26', 'active', '2025-04-17 09:51:59', '2025-04-17 09:51:59'),
(2431, NULL, 'Ganjam', '26', 'active', '2025-04-17 09:51:59', '2025-04-17 09:51:59'),
(2432, NULL, 'Gopalpur', '26', 'active', '2025-04-17 09:51:59', '2025-04-17 09:51:59'),
(2433, NULL, 'Gudari', '26', 'active', '2025-04-17 09:51:59', '2025-04-17 09:51:59'),
(2434, NULL, 'Gunupur', '26', 'active', '2025-04-17 09:51:59', '2025-04-17 09:51:59'),
(2435, NULL, 'Hinjilikatu', '26', 'active', '2025-04-17 09:51:59', '2025-04-17 09:51:59'),
(2436, NULL, 'Hirakud', '26', 'active', '2025-04-17 09:51:59', '2025-04-17 09:51:59'),
(2437, NULL, 'Jagatsinghpur', '26', 'active', '2025-04-17 09:51:59', '2025-04-17 09:51:59'),
(2438, NULL, 'Jajpur', '26', 'active', '2025-04-17 09:51:59', '2025-04-17 09:51:59'),
(2439, NULL, 'Jaleshwar', '26', 'active', '2025-04-17 09:51:59', '2025-04-17 09:51:59'),
(2440, NULL, 'Jatani', '26', 'active', '2025-04-17 09:51:59', '2025-04-17 09:51:59'),
(2441, NULL, 'Jeypore', '26', 'active', '2025-04-17 09:51:59', '2025-04-17 09:51:59'),
(2442, NULL, 'Jharsuguda', '26', 'active', '2025-04-17 09:51:59', '2025-04-17 09:51:59'),
(2443, NULL, 'Jharsuguda District', '26', 'active', '2025-04-17 09:51:59', '2025-04-17 09:51:59'),
(2444, NULL, 'Kaintragarh', '26', 'active', '2025-04-17 09:51:59', '2025-04-17 09:51:59'),
(2445, NULL, 'Kalahandi', '26', 'active', '2025-04-17 09:51:59', '2025-04-17 09:51:59'),
(2446, NULL, 'Kamakhyanagar', '26', 'active', '2025-04-17 09:51:59', '2025-04-17 09:51:59'),
(2447, NULL, 'Kandhamal', '26', 'active', '2025-04-17 09:51:59', '2025-04-17 09:51:59'),
(2448, NULL, 'Kantabanji', '26', 'active', '2025-04-17 09:51:59', '2025-04-17 09:51:59'),
(2449, NULL, 'Kantilo', '26', 'active', '2025-04-17 09:51:59', '2025-04-17 09:51:59'),
(2450, NULL, 'Kendrapara', '26', 'active', '2025-04-17 09:51:59', '2025-04-17 09:51:59'),
(2451, NULL, 'Kendujhar', '26', 'active', '2025-04-17 09:51:59', '2025-04-17 09:51:59'),
(2452, NULL, 'Kesinga', '26', 'active', '2025-04-17 09:51:59', '2025-04-17 09:51:59'),
(2453, NULL, 'Khallikot', '26', 'active', '2025-04-17 09:51:59', '2025-04-17 09:51:59'),
(2454, NULL, 'Kharhial', '26', 'active', '2025-04-17 09:51:59', '2025-04-17 09:51:59'),
(2455, NULL, 'Khordha', '26', 'active', '2025-04-17 09:51:59', '2025-04-17 09:51:59'),
(2456, NULL, 'Khurda', '26', 'active', '2025-04-17 09:51:59', '2025-04-17 09:51:59'),
(2457, NULL, 'Kiri Buru', '26', 'active', '2025-04-17 09:51:59', '2025-04-17 09:51:59'),
(2458, NULL, 'Kodala', '26', 'active', '2025-04-17 09:51:59', '2025-04-17 09:51:59'),
(2459, NULL, 'Konarka', '26', 'active', '2025-04-17 09:51:59', '2025-04-17 09:51:59'),
(2460, NULL, 'Koraput', '26', 'active', '2025-04-17 09:51:59', '2025-04-17 09:51:59'),
(2461, NULL, 'Kuchaiburi', '26', 'active', '2025-04-17 09:51:59', '2025-04-17 09:51:59'),
(2462, NULL, 'Kuchinda', '26', 'active', '2025-04-17 09:51:59', '2025-04-17 09:51:59'),
(2463, NULL, 'Malkangiri', '26', 'active', '2025-04-17 09:51:59', '2025-04-17 09:51:59'),
(2464, NULL, 'Mayurbhanj', '26', 'active', '2025-04-17 09:51:59', '2025-04-17 09:51:59'),
(2465, NULL, 'Nabarangpur', '26', 'active', '2025-04-17 09:51:59', '2025-04-17 09:51:59'),
(2466, NULL, 'Nayagarh', '26', 'active', '2025-04-17 09:51:59', '2025-04-17 09:51:59'),
(2467, NULL, 'Nayagarh District', '26', 'active', '2025-04-17 09:51:59', '2025-04-17 09:51:59'),
(2468, NULL, 'Nilgiri', '26', 'active', '2025-04-17 09:51:59', '2025-04-17 09:51:59'),
(2469, NULL, 'Nimaparha', '26', 'active', '2025-04-17 09:51:59', '2025-04-17 09:51:59'),
(2470, NULL, 'Nowrangapur', '26', 'active', '2025-04-17 09:51:59', '2025-04-17 09:51:59'),
(2471, NULL, 'Nuapada', '26', 'active', '2025-04-17 09:51:59', '2025-04-17 09:51:59'),
(2472, NULL, 'Padampur', '26', 'active', '2025-04-17 09:51:59', '2025-04-17 09:51:59'),
(2473, NULL, 'Paradip Garh', '26', 'active', '2025-04-17 09:51:59', '2025-04-17 09:51:59'),
(2474, NULL, 'Patamundai', '26', 'active', '2025-04-17 09:51:59', '2025-04-17 09:51:59'),
(2475, NULL, 'Patnagarh', '26', 'active', '2025-04-17 09:51:59', '2025-04-17 09:51:59'),
(2476, NULL, 'Phulbani', '26', 'active', '2025-04-17 09:51:59', '2025-04-17 09:51:59'),
(2477, NULL, 'Pipili', '26', 'active', '2025-04-17 09:51:59', '2025-04-17 09:51:59'),
(2478, NULL, 'Polasara', '26', 'active', '2025-04-17 09:51:59', '2025-04-17 09:51:59'),
(2479, NULL, 'Puri', '26', 'active', '2025-04-17 09:51:59', '2025-04-17 09:51:59'),
(2480, NULL, 'Purushottampur', '26', 'active', '2025-04-17 09:51:59', '2025-04-17 09:51:59'),
(2481, NULL, 'Rambha', '26', 'active', '2025-04-17 09:51:59', '2025-04-17 09:51:59'),
(2482, NULL, 'Raurkela', '26', 'active', '2025-04-17 09:51:59', '2025-04-17 09:51:59'),
(2483, NULL, 'Rayagada', '26', 'active', '2025-04-17 09:51:59', '2025-04-17 09:51:59'),
(2484, NULL, 'Remuna', '26', 'active', '2025-04-17 09:51:59', '2025-04-17 09:51:59'),
(2485, NULL, 'Rengali', '26', 'active', '2025-04-17 09:51:59', '2025-04-17 09:51:59'),
(2486, NULL, 'Sambalpur', '26', 'active', '2025-04-17 09:51:59', '2025-04-17 09:51:59'),
(2487, NULL, 'Sonepur', '26', 'active', '2025-04-17 09:51:59', '2025-04-17 09:51:59'),
(2488, NULL, 'Sorada', '26', 'active', '2025-04-17 09:51:59', '2025-04-17 09:51:59'),
(2489, NULL, 'Soro', '26', 'active', '2025-04-17 09:51:59', '2025-04-17 09:51:59'),
(2490, NULL, 'Subarnapur', '26', 'active', '2025-04-17 09:51:59', '2025-04-17 09:51:59'),
(2491, NULL, 'Sundargarh', '26', 'active', '2025-04-17 09:51:59', '2025-04-17 09:51:59'),
(2492, NULL, 'Talcher', '26', 'active', '2025-04-17 09:51:59', '2025-04-17 09:51:59'),
(2493, NULL, 'Tarabha', '26', 'active', '2025-04-17 09:51:59', '2025-04-17 09:51:59'),
(2494, NULL, 'Titlagarh', '26', 'active', '2025-04-17 09:51:59', '2025-04-17 09:51:59'),
(2495, NULL, 'Udayagiri', '26', 'active', '2025-04-17 09:51:59', '2025-04-17 09:51:59'),
(2496, NULL, 'Karaikal', '27', 'active', '2025-04-17 09:51:59', '2025-04-17 09:51:59'),
(2497, NULL, 'Mahe', '27', 'active', '2025-04-17 09:51:59', '2025-04-17 09:51:59'),
(2498, NULL, 'Puducherry', '27', 'active', '2025-04-17 09:51:59', '2025-04-17 09:51:59'),
(2499, NULL, 'Yanam', '27', 'active', '2025-04-17 09:51:59', '2025-04-17 09:51:59'),
(2500, NULL, 'Abohar', '28', 'active', '2025-04-17 09:51:59', '2025-04-17 09:51:59'),
(2501, NULL, 'Adampur', '28', 'active', '2025-04-17 09:51:59', '2025-04-17 09:51:59'),
(2502, NULL, 'Ajitgarh', '28', 'active', '2025-04-17 09:51:59', '2025-04-17 09:51:59'),
(2503, NULL, 'Ajnala', '28', 'active', '2025-04-17 09:51:59', '2025-04-17 09:51:59'),
(2504, NULL, 'Akalgarh', '28', 'active', '2025-04-17 09:51:59', '2025-04-17 09:51:59'),
(2505, NULL, 'Alawalpur', '28', 'active', '2025-04-17 09:51:59', '2025-04-17 09:51:59'),
(2506, NULL, 'Amloh', '28', 'active', '2025-04-17 09:51:59', '2025-04-17 09:51:59'),
(2507, NULL, 'Amritsar', '28', 'active', '2025-04-17 09:51:59', '2025-04-17 09:51:59'),
(2508, NULL, 'Anandpur Sahib', '28', 'active', '2025-04-17 09:51:59', '2025-04-17 09:51:59'),
(2509, NULL, 'Badhni Kalan', '28', 'active', '2025-04-17 09:51:59', '2025-04-17 09:51:59'),
(2510, NULL, 'Bagha Purana', '28', 'active', '2025-04-17 09:51:59', '2025-04-17 09:51:59'),
(2511, NULL, 'Bakloh', '28', 'active', '2025-04-17 09:51:59', '2025-04-17 09:51:59'),
(2512, NULL, 'Balachor', '28', 'active', '2025-04-17 09:51:59', '2025-04-17 09:51:59'),
(2513, NULL, 'Banga', '28', 'active', '2025-04-17 09:51:59', '2025-04-17 09:51:59'),
(2514, NULL, 'Banur', '28', 'active', '2025-04-17 09:51:59', '2025-04-17 09:51:59'),
(2515, NULL, 'Barnala', '28', 'active', '2025-04-17 09:51:59', '2025-04-17 09:51:59'),
(2516, NULL, 'Batala', '28', 'active', '2025-04-17 09:51:59', '2025-04-17 09:51:59'),
(2517, NULL, 'Begowal', '28', 'active', '2025-04-17 09:51:59', '2025-04-17 09:51:59'),
(2518, NULL, 'Bhadaur', '28', 'active', '2025-04-17 09:51:59', '2025-04-17 09:51:59'),
(2519, NULL, 'Bhatinda', '28', 'active', '2025-04-17 09:51:59', '2025-04-17 09:51:59'),
(2520, NULL, 'Bhawanigarh', '28', 'active', '2025-04-17 09:51:59', '2025-04-17 09:51:59'),
(2521, NULL, 'Bhikhi', '28', 'active', '2025-04-17 09:51:59', '2025-04-17 09:51:59'),
(2522, NULL, 'Bhogpur', '28', 'active', '2025-04-17 09:51:59', '2025-04-17 09:51:59'),
(2523, NULL, 'Bholath', '28', 'active', '2025-04-17 09:51:59', '2025-04-17 09:51:59'),
(2524, NULL, 'Budhlada', '28', 'active', '2025-04-17 09:51:59', '2025-04-17 09:51:59'),
(2525, NULL, 'Chima', '28', 'active', '2025-04-17 09:51:59', '2025-04-17 09:51:59'),
(2526, NULL, 'Dasuya', '28', 'active', '2025-04-17 09:51:59', '2025-04-17 09:51:59'),
(2527, NULL, 'Dera Baba Nanak', '28', 'active', '2025-04-17 09:51:59', '2025-04-17 09:51:59'),
(2528, NULL, 'Dera Bassi', '28', 'active', '2025-04-17 09:51:59', '2025-04-17 09:51:59'),
(2529, NULL, 'Dhanaula', '28', 'active', '2025-04-17 09:51:59', '2025-04-17 09:51:59'),
(2530, NULL, 'Dhariwal', '28', 'active', '2025-04-17 09:51:59', '2025-04-17 09:51:59'),
(2531, NULL, 'Dhilwan', '28', 'active', '2025-04-17 09:51:59', '2025-04-17 09:51:59'),
(2532, NULL, 'Dhudi', '28', 'active', '2025-04-17 09:51:59', '2025-04-17 09:51:59'),
(2533, NULL, 'Dhuri', '28', 'active', '2025-04-17 09:51:59', '2025-04-17 09:51:59'),
(2534, NULL, 'Dina Nagar', '28', 'active', '2025-04-17 09:51:59', '2025-04-17 09:51:59'),
(2535, NULL, 'Dirba', '28', 'active', '2025-04-17 09:51:59', '2025-04-17 09:51:59'),
(2536, NULL, 'Doraha', '28', 'active', '2025-04-17 09:51:59', '2025-04-17 09:51:59'),
(2537, NULL, 'Faridkot', '28', 'active', '2025-04-17 09:51:59', '2025-04-17 09:51:59'),
(2538, NULL, 'Fatehgarh Churian', '28', 'active', '2025-04-17 09:51:59', '2025-04-17 09:51:59'),
(2539, NULL, 'Fatehgarh Sahib', '28', 'active', '2025-04-17 09:51:59', '2025-04-17 09:51:59'),
(2540, NULL, 'Fazilka', '28', 'active', '2025-04-17 09:51:59', '2025-04-17 09:51:59'),
(2541, NULL, 'Firozpur', '28', 'active', '2025-04-17 09:51:59', '2025-04-17 09:51:59'),
(2542, NULL, 'Firozpur District', '28', 'active', '2025-04-17 09:51:59', '2025-04-17 09:51:59'),
(2543, NULL, 'Gardhiwala', '28', 'active', '2025-04-17 09:51:59', '2025-04-17 09:51:59'),
(2544, NULL, 'Garhshankar', '28', 'active', '2025-04-17 09:51:59', '2025-04-17 09:51:59'),
(2545, NULL, 'Ghanaur', '28', 'active', '2025-04-17 09:51:59', '2025-04-17 09:51:59'),
(2546, NULL, 'Giddarbaha', '28', 'active', '2025-04-17 09:51:59', '2025-04-17 09:51:59'),
(2547, NULL, 'Gurdaspur', '28', 'active', '2025-04-17 09:51:59', '2025-04-17 09:51:59'),
(2548, NULL, 'Guru Har Sahai', '28', 'active', '2025-04-17 09:51:59', '2025-04-17 09:51:59'),
(2549, NULL, 'Hajipur', '28', 'active', '2025-04-17 09:51:59', '2025-04-17 09:51:59'),
(2550, NULL, 'Hariana', '28', 'active', '2025-04-17 09:51:59', '2025-04-17 09:51:59'),
(2551, NULL, 'Hoshiarpur', '28', 'active', '2025-04-17 09:51:59', '2025-04-17 09:51:59'),
(2552, NULL, 'Ishanpur', '28', 'active', '2025-04-17 09:51:59', '2025-04-17 09:51:59'),
(2553, NULL, 'Jagraon', '28', 'active', '2025-04-17 09:51:59', '2025-04-17 09:51:59'),
(2554, NULL, 'Jaito', '28', 'active', '2025-04-17 09:51:59', '2025-04-17 09:51:59'),
(2555, NULL, 'Jalalabad', '28', 'active', '2025-04-17 09:51:59', '2025-04-17 09:51:59'),
(2556, NULL, 'Jalandhar', '28', 'active', '2025-04-17 09:51:59', '2025-04-17 09:51:59'),
(2557, NULL, 'Jandiala', '28', 'active', '2025-04-17 09:51:59', '2025-04-17 09:51:59'),
(2558, NULL, 'Jandiala Guru', '28', 'active', '2025-04-17 09:51:59', '2025-04-17 09:51:59'),
(2559, NULL, 'Kalanaur', '28', 'active', '2025-04-17 09:51:59', '2025-04-17 09:51:59'),
(2560, NULL, 'Kapurthala', '28', 'active', '2025-04-17 09:51:59', '2025-04-17 09:51:59'),
(2561, NULL, 'Kartarpur', '28', 'active', '2025-04-17 09:51:59', '2025-04-17 09:51:59'),
(2562, NULL, 'Khamanon', '28', 'active', '2025-04-17 09:51:59', '2025-04-17 09:51:59'),
(2563, NULL, 'Khanna', '28', 'active', '2025-04-17 09:51:59', '2025-04-17 09:51:59'),
(2564, NULL, 'Kharar', '28', 'active', '2025-04-17 09:51:59', '2025-04-17 09:51:59'),
(2565, NULL, 'Khemkaran', '28', 'active', '2025-04-17 09:51:59', '2025-04-17 09:51:59'),
(2566, NULL, 'Kot Isa Khan', '28', 'active', '2025-04-17 09:51:59', '2025-04-17 09:51:59'),
(2567, NULL, 'Kotkapura', '28', 'active', '2025-04-17 09:51:59', '2025-04-17 09:51:59'),
(2568, NULL, 'Laungowal', '28', 'active', '2025-04-17 09:51:59', '2025-04-17 09:51:59'),
(2569, NULL, 'Ludhiana', '28', 'active', '2025-04-17 09:51:59', '2025-04-17 09:51:59'),
(2570, NULL, 'Machhiwara', '28', 'active', '2025-04-17 09:51:59', '2025-04-17 09:51:59'),
(2571, NULL, 'Majitha', '28', 'active', '2025-04-17 09:51:59', '2025-04-17 09:51:59'),
(2572, NULL, 'Makhu', '28', 'active', '2025-04-17 09:51:59', '2025-04-17 09:51:59'),
(2573, NULL, 'Malaut', '28', 'active', '2025-04-17 09:51:59', '2025-04-17 09:51:59'),
(2574, NULL, 'Malerkotla', '28', 'active', '2025-04-17 09:51:59', '2025-04-17 09:51:59'),
(2575, NULL, 'Mansa', '28', 'active', '2025-04-17 09:51:59', '2025-04-17 09:51:59'),
(2576, NULL, 'Maur Mandi', '28', 'active', '2025-04-17 09:51:59', '2025-04-17 09:51:59'),
(2577, NULL, 'Moga', '28', 'active', '2025-04-17 09:51:59', '2025-04-17 09:51:59'),
(2578, NULL, 'Mohali', '28', 'active', '2025-04-17 09:51:59', '2025-04-17 09:51:59'),
(2579, NULL, 'Morinda', '28', 'active', '2025-04-17 09:51:59', '2025-04-17 09:51:59'),
(2580, NULL, 'Mukerian', '28', 'active', '2025-04-17 09:51:59', '2025-04-17 09:51:59'),
(2581, NULL, 'Nabha', '28', 'active', '2025-04-17 09:51:59', '2025-04-17 09:51:59'),
(2582, NULL, 'Nakodar', '28', 'active', '2025-04-17 09:51:59', '2025-04-17 09:51:59'),
(2583, NULL, 'Nangal', '28', 'active', '2025-04-17 09:51:59', '2025-04-17 09:51:59'),
(2584, NULL, 'Nawanshahr', '28', 'active', '2025-04-17 09:51:59', '2025-04-17 09:51:59'),
(2585, NULL, 'Nurmahal', '28', 'active', '2025-04-17 09:51:59', '2025-04-17 09:51:59'),
(2586, NULL, 'Nurpur Kalan', '28', 'active', '2025-04-17 09:51:59', '2025-04-17 09:51:59'),
(2587, NULL, 'Pathankot', '28', 'active', '2025-04-17 09:51:59', '2025-04-17 09:51:59'),
(2588, NULL, 'Patiala', '28', 'active', '2025-04-17 09:51:59', '2025-04-17 09:51:59'),
(2589, NULL, 'Patti', '28', 'active', '2025-04-17 09:51:59', '2025-04-17 09:51:59'),
(2590, NULL, 'Phagwara', '28', 'active', '2025-04-17 09:51:59', '2025-04-17 09:51:59'),
(2591, NULL, 'Phillaur', '28', 'active', '2025-04-17 09:51:59', '2025-04-17 09:51:59'),
(2592, NULL, 'Qadian', '28', 'active', '2025-04-17 09:51:59', '2025-04-17 09:51:59'),
(2593, NULL, 'Rahon', '28', 'active', '2025-04-17 09:51:59', '2025-04-17 09:51:59'),
(2594, NULL, 'Raikot', '28', 'active', '2025-04-17 09:51:59', '2025-04-17 09:51:59'),
(2595, NULL, 'Rajasansi', '28', 'active', '2025-04-17 09:51:59', '2025-04-17 09:51:59'),
(2596, NULL, 'Rajpura', '28', 'active', '2025-04-17 09:51:59', '2025-04-17 09:51:59'),
(2597, NULL, 'Ram Das', '28', 'active', '2025-04-17 09:51:59', '2025-04-17 09:51:59'),
(2598, NULL, 'Rampura', '28', 'active', '2025-04-17 09:51:59', '2025-04-17 09:51:59'),
(2599, NULL, 'Rupnagar', '28', 'active', '2025-04-17 09:51:59', '2025-04-17 09:51:59'),
(2600, NULL, 'Samrala', '28', 'active', '2025-04-17 09:51:59', '2025-04-17 09:51:59'),
(2601, NULL, 'Sanaur', '28', 'active', '2025-04-17 09:51:59', '2025-04-17 09:51:59'),
(2602, NULL, 'Sangrur', '28', 'active', '2025-04-17 09:51:59', '2025-04-17 09:51:59'),
(2603, NULL, 'Sardulgarh', '28', 'active', '2025-04-17 09:51:59', '2025-04-17 09:51:59'),
(2604, NULL, 'Shahid Bhagat Singh Nagar', '28', 'active', '2025-04-17 09:51:59', '2025-04-17 09:51:59'),
(2605, NULL, 'Shahkot', '28', 'active', '2025-04-17 09:51:59', '2025-04-17 09:51:59'),
(2606, NULL, 'Sham Churasi', '28', 'active', '2025-04-17 09:51:59', '2025-04-17 09:51:59'),
(2607, NULL, 'Sirhind-Fategarh', '28', 'active', '2025-04-17 09:51:59', '2025-04-17 09:51:59'),
(2608, NULL, 'Sri Muktsar Sahib', '28', 'active', '2025-04-17 09:51:59', '2025-04-17 09:51:59'),
(2609, NULL, 'Sultanpur Lodhi', '28', 'active', '2025-04-17 09:51:59', '2025-04-17 09:51:59'),
(2610, NULL, 'Sunam', '28', 'active', '2025-04-17 09:51:59', '2025-04-17 09:51:59'),
(2611, NULL, 'Talwandi Bhai', '28', 'active', '2025-04-17 09:51:59', '2025-04-17 09:51:59'),
(2612, NULL, 'Talwara', '28', 'active', '2025-04-17 09:51:59', '2025-04-17 09:51:59'),
(2613, NULL, 'Tarn Taran Sahib', '28', 'active', '2025-04-17 09:51:59', '2025-04-17 09:51:59'),
(2614, NULL, 'Zira', '28', 'active', '2025-04-17 09:51:59', '2025-04-17 09:51:59'),
(2615, NULL, 'Abhaneri', '29', 'active', '2025-04-17 09:51:59', '2025-04-17 09:51:59'),
(2616, NULL, 'Abu', '29', 'active', '2025-04-17 09:51:59', '2025-04-17 09:51:59'),
(2617, NULL, 'Abu Road', '29', 'active', '2025-04-17 09:51:59', '2025-04-17 09:51:59'),
(2618, NULL, 'Ajmer', '29', 'active', '2025-04-17 09:51:59', '2025-04-17 09:51:59'),
(2619, NULL, 'Aklera', '29', 'active', '2025-04-17 09:51:59', '2025-04-17 09:51:59'),
(2620, NULL, 'Alwar', '29', 'active', '2025-04-17 09:51:59', '2025-04-17 09:51:59'),
(2621, NULL, 'Amet', '29', 'active', '2025-04-17 09:51:59', '2025-04-17 09:51:59'),
(2622, NULL, 'Anta', '29', 'active', '2025-04-17 09:51:59', '2025-04-17 09:51:59'),
(2623, NULL, 'Anupgarh', '29', 'active', '2025-04-17 09:51:59', '2025-04-17 09:51:59'),
(2624, NULL, 'Asind', '29', 'active', '2025-04-17 09:51:59', '2025-04-17 09:51:59'),
(2625, NULL, 'Bagar', '29', 'active', '2025-04-17 09:51:59', '2025-04-17 09:51:59'),
(2626, NULL, 'Bakani', '29', 'active', '2025-04-17 09:51:59', '2025-04-17 09:51:59'),
(2627, NULL, 'Bali', '29', 'active', '2025-04-17 09:51:59', '2025-04-17 09:51:59'),
(2628, NULL, 'Balotra', '29', 'active', '2025-04-17 09:51:59', '2025-04-17 09:51:59'),
(2629, NULL, 'Bandikui', '29', 'active', '2025-04-17 09:51:59', '2025-04-17 09:51:59'),
(2630, NULL, 'Banswara', '29', 'active', '2025-04-17 09:51:59', '2025-04-17 09:51:59'),
(2631, NULL, 'Baran', '29', 'active', '2025-04-17 09:51:59', '2025-04-17 09:51:59'),
(2632, NULL, 'Bari', '29', 'active', '2025-04-17 09:51:59', '2025-04-17 09:51:59'),
(2633, NULL, 'Bari Sadri', '29', 'active', '2025-04-17 09:51:59', '2025-04-17 09:51:59'),
(2634, NULL, 'Barmer', '29', 'active', '2025-04-17 09:51:59', '2025-04-17 09:51:59'),
(2635, NULL, 'Basi', '29', 'active', '2025-04-17 09:51:59', '2025-04-17 09:51:59'),
(2636, NULL, 'Basni', '29', 'active', '2025-04-17 09:51:59', '2025-04-17 09:51:59'),
(2637, NULL, 'Baswa', '29', 'active', '2025-04-17 09:51:59', '2025-04-17 09:51:59'),
(2638, NULL, 'Bayana', '29', 'active', '2025-04-17 09:51:59', '2025-04-17 09:51:59'),
(2639, NULL, 'Beawar', '29', 'active', '2025-04-17 09:51:59', '2025-04-17 09:51:59'),
(2640, NULL, 'Begun', '29', 'active', '2025-04-17 09:51:59', '2025-04-17 09:51:59'),
(2641, NULL, 'Behror', '29', 'active', '2025-04-17 09:51:59', '2025-04-17 09:51:59'),
(2642, NULL, 'Bhadasar', '29', 'active', '2025-04-17 09:51:59', '2025-04-17 09:51:59'),
(2643, NULL, 'Bhadra', '29', 'active', '2025-04-17 09:51:59', '2025-04-17 09:51:59'),
(2644, NULL, 'Bharatpur', '29', 'active', '2025-04-17 09:51:59', '2025-04-17 09:51:59'),
(2645, NULL, 'Bhasawar', '29', 'active', '2025-04-17 09:51:59', '2025-04-17 09:51:59'),
(2646, NULL, 'Bhilwara', '29', 'active', '2025-04-17 09:51:59', '2025-04-17 09:51:59'),
(2647, NULL, 'Bhindar', '29', 'active', '2025-04-17 09:51:59', '2025-04-17 09:51:59'),
(2648, NULL, 'Bhinmal', '29', 'active', '2025-04-17 09:51:59', '2025-04-17 09:51:59'),
(2649, NULL, 'Bhiwadi', '29', 'active', '2025-04-17 09:51:59', '2025-04-17 09:51:59'),
(2650, NULL, 'Bhuma', '29', 'active', '2025-04-17 09:51:59', '2025-04-17 09:51:59'),
(2651, NULL, 'Bikaner', '29', 'active', '2025-04-17 09:51:59', '2025-04-17 09:51:59'),
(2652, NULL, 'Bilara', '29', 'active', '2025-04-17 09:51:59', '2025-04-17 09:51:59'),
(2653, NULL, 'Bissau', '29', 'active', '2025-04-17 09:51:59', '2025-04-17 09:51:59'),
(2654, NULL, 'Borkhera', '29', 'active', '2025-04-17 09:51:59', '2025-04-17 09:51:59'),
(2655, NULL, 'Bundi', '29', 'active', '2025-04-17 09:51:59', '2025-04-17 09:51:59'),
(2656, NULL, 'Chaksu', '29', 'active', '2025-04-17 09:51:59', '2025-04-17 09:51:59'),
(2657, NULL, 'Chechat', '29', 'active', '2025-04-17 09:51:59', '2025-04-17 09:51:59'),
(2658, NULL, 'Chhabra', '29', 'active', '2025-04-17 09:51:59', '2025-04-17 09:51:59'),
(2659, NULL, 'Chhapar', '29', 'active', '2025-04-17 09:51:59', '2025-04-17 09:51:59'),
(2660, NULL, 'Chhoti Sadri', '29', 'active', '2025-04-17 09:51:59', '2025-04-17 09:51:59'),
(2661, NULL, 'Chidawa', '29', 'active', '2025-04-17 09:51:59', '2025-04-17 09:51:59'),
(2662, NULL, 'Chittaurgarh', '29', 'active', '2025-04-17 09:51:59', '2025-04-17 09:51:59'),
(2663, NULL, 'Churu', '29', 'active', '2025-04-17 09:51:59', '2025-04-17 09:51:59'),
(2664, NULL, 'Dariba', '29', 'active', '2025-04-17 09:51:59', '2025-04-17 09:51:59'),
(2665, NULL, 'Dausa', '29', 'active', '2025-04-17 09:51:59', '2025-04-17 09:51:59'),
(2666, NULL, 'Deoli', '29', 'active', '2025-04-17 09:51:59', '2025-04-17 09:51:59'),
(2667, NULL, 'Deshnoke', '29', 'active', '2025-04-17 09:51:59', '2025-04-17 09:51:59'),
(2668, NULL, 'Devgarh', '29', 'active', '2025-04-17 09:51:59', '2025-04-17 09:51:59'),
(2669, NULL, 'Dhaulpur', '29', 'active', '2025-04-17 09:51:59', '2025-04-17 09:51:59'),
(2670, NULL, 'Didwana', '29', 'active', '2025-04-17 09:51:59', '2025-04-17 09:51:59'),
(2671, NULL, 'Dig', '29', 'active', '2025-04-17 09:51:59', '2025-04-17 09:51:59'),
(2672, NULL, 'Dungarpur', '29', 'active', '2025-04-17 09:51:59', '2025-04-17 09:51:59'),
(2673, NULL, 'Fatehpur', '29', 'active', '2025-04-17 09:51:59', '2025-04-17 09:51:59'),
(2674, NULL, 'Galiakot', '29', 'active', '2025-04-17 09:51:59', '2025-04-17 09:51:59'),
(2675, NULL, 'Ganganagar', '29', 'active', '2025-04-17 09:51:59', '2025-04-17 09:51:59'),
(2676, NULL, 'Gangapur', '29', 'active', '2025-04-17 09:51:59', '2025-04-17 09:51:59'),
(2677, NULL, 'Govindgarh', '29', 'active', '2025-04-17 09:51:59', '2025-04-17 09:51:59'),
(2678, NULL, 'Gulabpura', '29', 'active', '2025-04-17 09:51:59', '2025-04-17 09:51:59'),
(2679, NULL, 'Hanumangarh', '29', 'active', '2025-04-17 09:51:59', '2025-04-17 09:51:59'),
(2680, NULL, 'Hindaun', '29', 'active', '2025-04-17 09:51:59', '2025-04-17 09:51:59'),
(2681, NULL, 'Jahazpur', '29', 'active', '2025-04-17 09:51:59', '2025-04-17 09:51:59'),
(2682, NULL, 'Jaipur', '29', 'active', '2025-04-17 09:51:59', '2025-04-17 09:51:59'),
(2683, NULL, 'Jaisalmer', '29', 'active', '2025-04-17 09:51:59', '2025-04-17 09:51:59'),
(2684, NULL, 'Jaitaran', '29', 'active', '2025-04-17 09:51:59', '2025-04-17 09:51:59'),
(2685, NULL, 'Jalor', '29', 'active', '2025-04-17 09:51:59', '2025-04-17 09:51:59'),
(2686, NULL, 'Jalore', '29', 'active', '2025-04-17 09:51:59', '2025-04-17 09:51:59'),
(2687, NULL, 'Jhalawar', '29', 'active', '2025-04-17 09:51:59', '2025-04-17 09:51:59'),
(2688, NULL, 'Jhalrapatan', '29', 'active', '2025-04-17 09:51:59', '2025-04-17 09:51:59'),
(2689, NULL, 'Jhunjhunun', '29', 'active', '2025-04-17 09:51:59', '2025-04-17 09:51:59'),
(2690, NULL, 'Jobner', '29', 'active', '2025-04-17 09:51:59', '2025-04-17 09:51:59'),
(2691, NULL, 'Jodhpur', '29', 'active', '2025-04-17 09:51:59', '2025-04-17 09:51:59'),
(2692, NULL, 'Kaman', '29', 'active', '2025-04-17 09:51:59', '2025-04-17 09:51:59'),
(2693, NULL, 'Kanor', '29', 'active', '2025-04-17 09:51:59', '2025-04-17 09:51:59'),
(2694, NULL, 'Kapren', '29', 'active', '2025-04-17 09:51:59', '2025-04-17 09:51:59'),
(2695, NULL, 'Karanpur', '29', 'active', '2025-04-17 09:51:59', '2025-04-17 09:51:59'),
(2696, NULL, 'Karauli', '29', 'active', '2025-04-17 09:51:59', '2025-04-17 09:51:59'),
(2697, NULL, 'Kekri', '29', 'active', '2025-04-17 09:51:59', '2025-04-17 09:51:59'),
(2698, NULL, 'Keshorai Patan', '29', 'active', '2025-04-17 09:51:59', '2025-04-17 09:51:59'),
(2699, NULL, 'Khandela', '29', 'active', '2025-04-17 09:51:59', '2025-04-17 09:51:59'),
(2700, NULL, 'Khanpur', '29', 'active', '2025-04-17 09:51:59', '2025-04-17 09:51:59'),
(2701, NULL, 'Khetri', '29', 'active', '2025-04-17 09:51:59', '2025-04-17 09:51:59'),
(2702, NULL, 'Kishangarh', '29', 'active', '2025-04-17 09:51:59', '2025-04-17 09:51:59'),
(2703, NULL, 'Kota', '29', 'active', '2025-04-17 09:51:59', '2025-04-17 09:51:59'),
(2704, NULL, 'Kotputli', '29', 'active', '2025-04-17 09:51:59', '2025-04-17 09:51:59'),
(2705, NULL, 'Kuchaman', '29', 'active', '2025-04-17 09:51:59', '2025-04-17 09:51:59'),
(2706, NULL, 'Kuchera', '29', 'active', '2025-04-17 09:51:59', '2025-04-17 09:51:59'),
(2707, NULL, 'Kumher', '29', 'active', '2025-04-17 09:51:59', '2025-04-17 09:51:59'),
(2708, NULL, 'Kushalgarh', '29', 'active', '2025-04-17 09:51:59', '2025-04-17 09:51:59'),
(2709, NULL, 'Lachhmangarh Sikar', '29', 'active', '2025-04-17 09:51:59', '2025-04-17 09:51:59'),
(2710, NULL, 'Ladnun', '29', 'active', '2025-04-17 09:51:59', '2025-04-17 09:51:59'),
(2711, NULL, 'Lakheri', '29', 'active', '2025-04-17 09:51:59', '2025-04-17 09:51:59'),
(2712, NULL, 'Lalsot', '29', 'active', '2025-04-17 09:51:59', '2025-04-17 09:51:59'),
(2713, NULL, 'Losal', '29', 'active', '2025-04-17 09:51:59', '2025-04-17 09:51:59'),
(2714, NULL, 'Mahwah', '29', 'active', '2025-04-17 09:51:59', '2025-04-17 09:51:59'),
(2715, NULL, 'Makrana', '29', 'active', '2025-04-17 09:51:59', '2025-04-17 09:51:59'),
(2716, NULL, 'Malpura', '29', 'active', '2025-04-17 09:51:59', '2025-04-17 09:51:59'),
(2717, NULL, 'Mandal', '29', 'active', '2025-04-17 09:51:59', '2025-04-17 09:51:59'),
(2718, NULL, 'Mandalgarh', '29', 'active', '2025-04-17 09:51:59', '2025-04-17 09:51:59'),
(2719, NULL, 'Mandawar', '29', 'active', '2025-04-17 09:51:59', '2025-04-17 09:51:59'),
(2720, NULL, 'Mangrol', '29', 'active', '2025-04-17 09:51:59', '2025-04-17 09:51:59'),
(2721, NULL, 'Manohar Thana', '29', 'active', '2025-04-17 09:51:59', '2025-04-17 09:51:59'),
(2722, NULL, 'Manoharpur', '29', 'active', '2025-04-17 09:51:59', '2025-04-17 09:51:59'),
(2723, NULL, 'Meethari Marwar', '29', 'active', '2025-04-17 09:51:59', '2025-04-17 09:51:59'),
(2724, NULL, 'Merta', '29', 'active', '2025-04-17 09:51:59', '2025-04-17 09:51:59'),
(2725, NULL, 'Mundwa', '29', 'active', '2025-04-17 09:51:59', '2025-04-17 09:51:59'),
(2726, NULL, 'Nadbai', '29', 'active', '2025-04-17 09:51:59', '2025-04-17 09:51:59'),
(2727, NULL, 'Nagar', '29', 'active', '2025-04-17 09:51:59', '2025-04-17 09:51:59'),
(2728, NULL, 'Nagaur', '29', 'active', '2025-04-17 09:51:59', '2025-04-17 09:51:59'),
(2729, NULL, 'Nainwa', '29', 'active', '2025-04-17 09:51:59', '2025-04-17 09:51:59'),
(2730, NULL, 'Napasar', '29', 'active', '2025-04-17 09:51:59', '2025-04-17 09:51:59'),
(2731, NULL, 'Naraina', '29', 'active', '2025-04-17 09:51:59', '2025-04-17 09:51:59'),
(2732, NULL, 'Nasirabad', '29', 'active', '2025-04-17 09:51:59', '2025-04-17 09:51:59'),
(2733, NULL, 'Nathdwara', '29', 'active', '2025-04-17 09:51:59', '2025-04-17 09:51:59'),
(2734, NULL, 'Nawa', '29', 'active', '2025-04-17 09:51:59', '2025-04-17 09:51:59'),
(2735, NULL, 'Nawalgarh', '29', 'active', '2025-04-17 09:51:59', '2025-04-17 09:51:59'),
(2736, NULL, 'Neem ka Thana', '29', 'active', '2025-04-17 09:51:59', '2025-04-17 09:51:59'),
(2737, NULL, 'Nimaj', '29', 'active', '2025-04-17 09:51:59', '2025-04-17 09:51:59'),
(2738, NULL, 'Nimbahera', '29', 'active', '2025-04-17 09:51:59', '2025-04-17 09:51:59'),
(2739, NULL, 'Niwai', '29', 'active', '2025-04-17 09:51:59', '2025-04-17 09:51:59'),
(2740, NULL, 'Nohar', '29', 'active', '2025-04-17 09:51:59', '2025-04-17 09:51:59'),
(2741, NULL, 'Nokha', '29', 'active', '2025-04-17 09:51:59', '2025-04-17 09:51:59'),
(2742, NULL, 'Padampur', '29', 'active', '2025-04-17 09:51:59', '2025-04-17 09:51:59'),
(2743, NULL, 'Pali', '29', 'active', '2025-04-17 09:51:59', '2025-04-17 09:51:59'),
(2744, NULL, 'Partapur', '29', 'active', '2025-04-17 09:51:59', '2025-04-17 09:51:59'),
(2745, NULL, 'Parvatsar', '29', 'active', '2025-04-17 09:51:59', '2025-04-17 09:51:59'),
(2746, NULL, 'Phalodi', '29', 'active', '2025-04-17 09:51:59', '2025-04-17 09:51:59'),
(2747, NULL, 'Phulera', '29', 'active', '2025-04-17 09:51:59', '2025-04-17 09:51:59'),
(2748, NULL, 'Pilani', '29', 'active', '2025-04-17 09:51:59', '2025-04-17 09:51:59'),
(2749, NULL, 'Pilibangan', '29', 'active', '2025-04-17 09:51:59', '2025-04-17 09:51:59'),
(2750, NULL, 'Pindwara', '29', 'active', '2025-04-17 09:51:59', '2025-04-17 09:51:59'),
(2751, NULL, 'Pipar', '29', 'active', '2025-04-17 09:51:59', '2025-04-17 09:51:59'),
(2752, NULL, 'Pirawa', '29', 'active', '2025-04-17 09:51:59', '2025-04-17 09:51:59'),
(2753, NULL, 'Pokaran', '29', 'active', '2025-04-17 09:51:59', '2025-04-17 09:51:59'),
(2754, NULL, 'Pratapgarh', '29', 'active', '2025-04-17 09:51:59', '2025-04-17 09:51:59'),
(2755, NULL, 'Pushkar', '29', 'active', '2025-04-17 09:51:59', '2025-04-17 09:51:59'),
(2756, NULL, 'Raipur', '29', 'active', '2025-04-17 09:51:59', '2025-04-17 09:51:59'),
(2757, NULL, 'Raisinghnagar', '29', 'active', '2025-04-17 09:51:59', '2025-04-17 09:51:59'),
(2758, NULL, 'Rajakhera', '29', 'active', '2025-04-17 09:51:59', '2025-04-17 09:51:59'),
(2759, NULL, 'Rajaldesar', '29', 'active', '2025-04-17 09:51:59', '2025-04-17 09:51:59'),
(2760, NULL, 'Rajgarh', '29', 'active', '2025-04-17 09:51:59', '2025-04-17 09:51:59'),
(2761, NULL, 'Rajsamand', '29', 'active', '2025-04-17 09:51:59', '2025-04-17 09:51:59'),
(2762, NULL, 'Ramganj Mandi', '29', 'active', '2025-04-17 09:51:59', '2025-04-17 09:51:59'),
(2763, NULL, 'Ramgarh', '29', 'active', '2025-04-17 09:51:59', '2025-04-17 09:51:59'),
(2764, NULL, 'Rani', '29', 'active', '2025-04-17 09:51:59', '2025-04-17 09:51:59'),
(2765, NULL, 'Ratangarh', '29', 'active', '2025-04-17 09:51:59', '2025-04-17 09:51:59'),
(2766, NULL, 'Rawatbhata', '29', 'active', '2025-04-17 09:51:59', '2025-04-17 09:51:59'),
(2767, NULL, 'Rawatsar', '29', 'active', '2025-04-17 09:51:59', '2025-04-17 09:51:59'),
(2768, NULL, 'Ringas', '29', 'active', '2025-04-17 09:51:59', '2025-04-17 09:51:59'),
(2769, NULL, 'Sadri', '29', 'active', '2025-04-17 09:51:59', '2025-04-17 09:51:59'),
(2770, NULL, 'Salumbar', '29', 'active', '2025-04-17 09:51:59', '2025-04-17 09:51:59'),
(2771, NULL, 'Sambhar', '29', 'active', '2025-04-17 09:51:59', '2025-04-17 09:51:59'),
(2772, NULL, 'Samdari', '29', 'active', '2025-04-17 09:51:59', '2025-04-17 09:51:59'),
(2773, NULL, 'Sanchor', '29', 'active', '2025-04-17 09:51:59', '2025-04-17 09:51:59'),
(2774, NULL, 'Sangaria', '29', 'active', '2025-04-17 09:51:59', '2025-04-17 09:51:59'),
(2775, NULL, 'Sangod', '29', 'active', '2025-04-17 09:51:59', '2025-04-17 09:51:59'),
(2776, NULL, 'Sardarshahr', '29', 'active', '2025-04-17 09:51:59', '2025-04-17 09:51:59'),
(2777, NULL, 'Sarwar', '29', 'active', '2025-04-17 09:51:59', '2025-04-17 09:51:59'),
(2778, NULL, 'Sawai Madhopur', '29', 'active', '2025-04-17 09:51:59', '2025-04-17 09:51:59'),
(2779, NULL, 'Shahpura', '29', 'active', '2025-04-17 09:51:59', '2025-04-17 09:51:59'),
(2780, NULL, 'Sheoganj', '29', 'active', '2025-04-17 09:51:59', '2025-04-17 09:51:59'),
(2781, NULL, 'Sikar', '29', 'active', '2025-04-17 09:51:59', '2025-04-17 09:51:59'),
(2782, NULL, 'Sirohi', '29', 'active', '2025-04-17 09:51:59', '2025-04-17 09:51:59'),
(2783, NULL, 'Siwana', '29', 'active', '2025-04-17 09:51:59', '2025-04-17 09:51:59'),
(2784, NULL, 'Sojat', '29', 'active', '2025-04-17 09:51:59', '2025-04-17 09:51:59'),
(2785, NULL, 'Sri Dungargarh', '29', 'active', '2025-04-17 09:51:59', '2025-04-17 09:51:59'),
(2786, NULL, 'Sri Madhopur', '29', 'active', '2025-04-17 09:51:59', '2025-04-17 09:51:59'),
(2787, NULL, 'Sujangarh', '29', 'active', '2025-04-17 09:51:59', '2025-04-17 09:51:59'),
(2788, NULL, 'Suket', '29', 'active', '2025-04-17 09:51:59', '2025-04-17 09:51:59'),
(2789, NULL, 'Sunel', '29', 'active', '2025-04-17 09:51:59', '2025-04-17 09:51:59'),
(2790, NULL, 'Surajgarh', '29', 'active', '2025-04-17 09:51:59', '2025-04-17 09:51:59'),
(2791, NULL, 'Suratgarh', '29', 'active', '2025-04-17 09:51:59', '2025-04-17 09:51:59'),
(2792, NULL, 'Takhatgarh', '29', 'active', '2025-04-17 09:51:59', '2025-04-17 09:51:59'),
(2793, NULL, 'Taranagar', '29', 'active', '2025-04-17 09:51:59', '2025-04-17 09:51:59'),
(2794, NULL, 'Tijara', '29', 'active', '2025-04-17 09:51:59', '2025-04-17 09:51:59'),
(2795, NULL, 'Todabhim', '29', 'active', '2025-04-17 09:51:59', '2025-04-17 09:51:59'),
(2796, NULL, 'Todaraisingh', '29', 'active', '2025-04-17 09:51:59', '2025-04-17 09:51:59'),
(2797, NULL, 'Tonk', '29', 'active', '2025-04-17 09:51:59', '2025-04-17 09:51:59'),
(2798, NULL, 'Udaipur', '29', 'active', '2025-04-17 09:51:59', '2025-04-17 09:51:59'),
(2799, NULL, 'Udpura', '29', 'active', '2025-04-17 09:51:59', '2025-04-17 09:51:59'),
(2800, NULL, 'Uniara', '29', 'active', '2025-04-17 09:51:59', '2025-04-17 09:51:59'),
(2801, NULL, 'Wer', '29', 'active', '2025-04-17 09:51:59', '2025-04-17 09:51:59'),
(2802, NULL, 'East District', '30', 'active', '2025-04-17 09:51:59', '2025-04-17 09:51:59'),
(2803, NULL, 'Gangtok', '30', 'active', '2025-04-17 09:51:59', '2025-04-17 09:51:59'),
(2804, NULL, 'Gyalshing', '30', 'active', '2025-04-17 09:51:59', '2025-04-17 09:51:59'),
(2805, NULL, 'Jorethang', '30', 'active', '2025-04-17 09:51:59', '2025-04-17 09:51:59'),
(2806, NULL, 'Mangan', '30', 'active', '2025-04-17 09:51:59', '2025-04-17 09:51:59'),
(2807, NULL, 'Namchi', '30', 'active', '2025-04-17 09:51:59', '2025-04-17 09:51:59'),
(2808, NULL, 'Naya Bazar', '30', 'active', '2025-04-17 09:51:59', '2025-04-17 09:51:59'),
(2809, NULL, 'North District', '30', 'active', '2025-04-17 09:51:59', '2025-04-17 09:51:59'),
(2810, NULL, 'Rangpo', '30', 'active', '2025-04-17 09:51:59', '2025-04-17 09:51:59'),
(2811, NULL, 'Singtam', '30', 'active', '2025-04-17 09:51:59', '2025-04-17 09:51:59'),
(2812, NULL, 'South District', '30', 'active', '2025-04-17 09:51:59', '2025-04-17 09:51:59'),
(2813, NULL, 'West District', '30', 'active', '2025-04-17 09:51:59', '2025-04-17 09:51:59'),
(2814, NULL, 'Abiramam', '31', 'active', '2025-04-17 09:51:59', '2025-04-17 09:51:59'),
(2815, NULL, 'Adirampattinam', '31', 'active', '2025-04-17 09:51:59', '2025-04-17 09:51:59'),
(2816, NULL, 'Aduthurai', '31', 'active', '2025-04-17 09:51:59', '2025-04-17 09:51:59'),
(2817, NULL, 'Alagapuram', '31', 'active', '2025-04-17 09:51:59', '2025-04-17 09:51:59'),
(2818, NULL, 'Alandur', '31', 'active', '2025-04-17 09:51:59', '2025-04-17 09:51:59'),
(2819, NULL, 'Alanganallur', '31', 'active', '2025-04-17 09:51:59', '2025-04-17 09:51:59'),
(2820, NULL, 'Alangayam', '31', 'active', '2025-04-17 09:51:59', '2025-04-17 09:51:59'),
(2821, NULL, 'Alangudi', '31', 'active', '2025-04-17 09:51:59', '2025-04-17 09:51:59'),
(2822, NULL, 'Alangulam', '31', 'active', '2025-04-17 09:51:59', '2025-04-17 09:51:59'),
(2823, NULL, 'Alappakkam', '31', 'active', '2025-04-17 09:51:59', '2025-04-17 09:51:59'),
(2824, NULL, 'Alwa Tirunagari', '31', 'active', '2025-04-17 09:51:59', '2025-04-17 09:51:59'),
(2825, NULL, 'Ambasamudram', '31', 'active', '2025-04-17 09:51:59', '2025-04-17 09:51:59'),
(2826, NULL, 'Ambattur', '31', 'active', '2025-04-17 09:51:59', '2025-04-17 09:51:59'),
(2827, NULL, 'Ambur', '31', 'active', '2025-04-17 09:51:59', '2025-04-17 09:51:59'),
(2828, NULL, 'Ammapettai', '31', 'active', '2025-04-17 09:51:59', '2025-04-17 09:51:59'),
(2829, NULL, 'Anamalais', '31', 'active', '2025-04-17 09:51:59', '2025-04-17 09:51:59'),
(2830, NULL, 'Andippatti', '31', 'active', '2025-04-17 09:51:59', '2025-04-17 09:51:59'),
(2831, NULL, 'Annamalainagar', '31', 'active', '2025-04-17 09:51:59', '2025-04-17 09:51:59'),
(2832, NULL, 'Annavasal', '31', 'active', '2025-04-17 09:51:59', '2025-04-17 09:51:59'),
(2833, NULL, 'Annur', '31', 'active', '2025-04-17 09:51:59', '2025-04-17 09:51:59'),
(2834, NULL, 'Anthiyur', '31', 'active', '2025-04-17 09:51:59', '2025-04-17 09:51:59'),
(2835, NULL, 'Arakkonam', '31', 'active', '2025-04-17 09:51:59', '2025-04-17 09:51:59'),
(2836, NULL, 'Arantangi', '31', 'active', '2025-04-17 09:51:59', '2025-04-17 09:51:59'),
(2837, NULL, 'Arcot', '31', 'active', '2025-04-17 09:51:59', '2025-04-17 09:51:59'),
(2838, NULL, 'Arimalam', '31', 'active', '2025-04-17 09:51:59', '2025-04-17 09:51:59'),
(2839, NULL, 'Ariyalur', '31', 'active', '2025-04-17 09:51:59', '2025-04-17 09:51:59'),
(2840, NULL, 'Arni', '31', 'active', '2025-04-17 09:51:59', '2025-04-17 09:51:59'),
(2841, NULL, 'Arumbavur', '31', 'active', '2025-04-17 09:51:59', '2025-04-17 09:51:59'),
(2842, NULL, 'Arumuganeri', '31', 'active', '2025-04-17 09:51:59', '2025-04-17 09:51:59'),
(2843, NULL, 'Aruppukkottai', '31', 'active', '2025-04-17 09:51:59', '2025-04-17 09:51:59'),
(2844, NULL, 'Aruvankad', '31', 'active', '2025-04-17 09:51:59', '2025-04-17 09:51:59'),
(2845, NULL, 'Attayyampatti', '31', 'active', '2025-04-17 09:51:59', '2025-04-17 09:51:59'),
(2846, NULL, 'Attur', '31', 'active', '2025-04-17 09:51:59', '2025-04-17 09:51:59'),
(2847, NULL, 'Auroville', '31', 'active', '2025-04-17 09:51:59', '2025-04-17 09:51:59'),
(2848, NULL, 'Avadi', '31', 'active', '2025-04-17 09:51:59', '2025-04-17 09:51:59'),
(2849, NULL, 'Avinashi', '31', 'active', '2025-04-17 09:51:59', '2025-04-17 09:51:59'),
(2850, NULL, 'Ayakudi', '31', 'active', '2025-04-17 09:51:59', '2025-04-17 09:51:59'),
(2851, NULL, 'Ayyampettai', '31', 'active', '2025-04-17 09:51:59', '2025-04-17 09:51:59'),
(2852, NULL, 'Belur', '31', 'active', '2025-04-17 09:51:59', '2025-04-17 09:51:59'),
(2853, NULL, 'Bhavani', '31', 'active', '2025-04-17 09:51:59', '2025-04-17 09:51:59'),
(2854, NULL, 'Bodinayakkanur', '31', 'active', '2025-04-17 09:51:59', '2025-04-17 09:51:59'),
(2855, NULL, 'Chengam', '31', 'active', '2025-04-17 09:51:59', '2025-04-17 09:51:59'),
(2856, NULL, 'Chennai', '31', 'active', '2025-04-17 09:51:59', '2025-04-17 09:51:59'),
(2857, NULL, 'Chennimalai', '31', 'active', '2025-04-17 09:51:59', '2025-04-17 09:51:59'),
(2858, NULL, 'Chetput', '31', 'active', '2025-04-17 09:51:59', '2025-04-17 09:51:59'),
(2859, NULL, 'Chettipalaiyam', '31', 'active', '2025-04-17 09:51:59', '2025-04-17 09:51:59'),
(2860, NULL, 'Cheyyar', '31', 'active', '2025-04-17 09:51:59', '2025-04-17 09:51:59'),
(2861, NULL, 'Cheyyur', '31', 'active', '2025-04-17 09:51:59', '2025-04-17 09:51:59'),
(2862, NULL, 'Chidambaram', '31', 'active', '2025-04-17 09:51:59', '2025-04-17 09:51:59'),
(2863, NULL, 'Chingleput', '31', 'active', '2025-04-17 09:51:59', '2025-04-17 09:51:59'),
(2864, NULL, 'Chinna Salem', '31', 'active', '2025-04-17 09:51:59', '2025-04-17 09:51:59'),
(2865, NULL, 'Chinnamanur', '31', 'active', '2025-04-17 09:51:59', '2025-04-17 09:51:59'),
(2866, NULL, 'Chinnasekkadu', '31', 'active', '2025-04-17 09:51:59', '2025-04-17 09:51:59'),
(2867, NULL, 'Cholapuram', '31', 'active', '2025-04-17 09:51:59', '2025-04-17 09:51:59'),
(2868, NULL, 'Coimbatore', '31', 'active', '2025-04-17 09:51:59', '2025-04-17 09:51:59'),
(2869, NULL, 'Colachel', '31', 'active', '2025-04-17 09:51:59', '2025-04-17 09:51:59'),
(2870, NULL, 'Cuddalore', '31', 'active', '2025-04-17 09:51:59', '2025-04-17 09:51:59'),
(2871, NULL, 'Cumbum', '31', 'active', '2025-04-17 09:51:59', '2025-04-17 09:51:59'),
(2872, NULL, 'Denkanikota', '31', 'active', '2025-04-17 09:51:59', '2025-04-17 09:51:59'),
(2873, NULL, 'Desur', '31', 'active', '2025-04-17 09:51:59', '2025-04-17 09:51:59'),
(2874, NULL, 'Devadanappatti', '31', 'active', '2025-04-17 09:51:59', '2025-04-17 09:51:59'),
(2875, NULL, 'Devakottai', '31', 'active', '2025-04-17 09:51:59', '2025-04-17 09:51:59'),
(2876, NULL, 'Dhali', '31', 'active', '2025-04-17 09:51:59', '2025-04-17 09:51:59'),
(2877, NULL, 'Dharapuram', '31', 'active', '2025-04-17 09:51:59', '2025-04-17 09:51:59'),
(2878, NULL, 'Dharmapuri', '31', 'active', '2025-04-17 09:51:59', '2025-04-17 09:51:59'),
(2879, NULL, 'Dindigul', '31', 'active', '2025-04-17 09:51:59', '2025-04-17 09:51:59'),
(2880, NULL, 'Dusi', '31', 'active', '2025-04-17 09:51:59', '2025-04-17 09:51:59'),
(2881, NULL, 'Elayirampannai', '31', 'active', '2025-04-17 09:51:59', '2025-04-17 09:51:59'),
(2882, NULL, 'Elumalai', '31', 'active', '2025-04-17 09:51:59', '2025-04-17 09:51:59'),
(2883, NULL, 'Eral', '31', 'active', '2025-04-17 09:51:59', '2025-04-17 09:51:59'),
(2884, NULL, 'Eraniel', '31', 'active', '2025-04-17 09:51:59', '2025-04-17 09:51:59'),
(2885, NULL, 'Erode', '31', 'active', '2025-04-17 09:51:59', '2025-04-17 09:51:59'),
(2886, NULL, 'Erumaippatti', '31', 'active', '2025-04-17 09:51:59', '2025-04-17 09:51:59'),
(2887, NULL, 'Ettaiyapuram', '31', 'active', '2025-04-17 09:51:59', '2025-04-17 09:51:59'),
(2888, NULL, 'Gandhi Nagar', '31', 'active', '2025-04-17 09:51:59', '2025-04-17 09:51:59'),
(2889, NULL, 'Gangaikondan', '31', 'active', '2025-04-17 09:51:59', '2025-04-17 09:51:59'),
(2890, NULL, 'Gangavalli', '31', 'active', '2025-04-17 09:51:59', '2025-04-17 09:51:59'),
(2891, NULL, 'Gingee', '31', 'active', '2025-04-17 09:51:59', '2025-04-17 09:51:59'),
(2892, NULL, 'Gobichettipalayam', '31', 'active', '2025-04-17 09:51:59', '2025-04-17 09:51:59'),
(2893, NULL, 'Gudalur', '31', 'active', '2025-04-17 09:51:59', '2025-04-17 09:51:59'),
(2894, NULL, 'Gudiyatham', '31', 'active', '2025-04-17 09:51:59', '2025-04-17 09:51:59'),
(2895, NULL, 'Guduvancheri', '31', 'active', '2025-04-17 09:51:59', '2025-04-17 09:51:59'),
(2896, NULL, 'Gummidipundi', '31', 'active', '2025-04-17 09:51:59', '2025-04-17 09:51:59'),
(2897, NULL, 'Harur', '31', 'active', '2025-04-17 09:51:59', '2025-04-17 09:51:59'),
(2898, NULL, 'Hosur', '31', 'active', '2025-04-17 09:51:59', '2025-04-17 09:51:59'),
(2899, NULL, 'Idappadi', '31', 'active', '2025-04-17 09:51:59', '2025-04-17 09:51:59'),
(2900, NULL, 'Ilampillai', '31', 'active', '2025-04-17 09:51:59', '2025-04-17 09:51:59'),
(2901, NULL, 'Iluppur', '31', 'active', '2025-04-17 09:51:59', '2025-04-17 09:51:59'),
(2902, NULL, 'Injambakkam', '31', 'active', '2025-04-17 09:51:59', '2025-04-17 09:51:59'),
(2903, NULL, 'Irugur', '31', 'active', '2025-04-17 09:51:59', '2025-04-17 09:51:59'),
(2904, NULL, 'Jalakandapuram', '31', 'active', '2025-04-17 09:51:59', '2025-04-17 09:51:59'),
(2905, NULL, 'Jalarpet', '31', 'active', '2025-04-17 09:51:59', '2025-04-17 09:51:59'),
(2906, NULL, 'Jayamkondacholapuram', '31', 'active', '2025-04-17 09:51:59', '2025-04-17 09:51:59'),
(2907, NULL, 'Kadambur', '31', 'active', '2025-04-17 09:51:59', '2025-04-17 09:51:59'),
(2908, NULL, 'Kadayanallur', '31', 'active', '2025-04-17 09:51:59', '2025-04-17 09:51:59'),
(2909, NULL, 'Kalakkadu', '31', 'active', '2025-04-17 09:51:59', '2025-04-17 09:51:59'),
(2910, NULL, 'Kalavai', '31', 'active', '2025-04-17 09:51:59', '2025-04-17 09:51:59'),
(2911, NULL, 'Kallakkurichchi', '31', 'active', '2025-04-17 09:51:59', '2025-04-17 09:51:59'),
(2912, NULL, 'Kallidaikurichi', '31', 'active', '2025-04-17 09:51:59', '2025-04-17 09:51:59'),
(2913, NULL, 'Kallupatti', '31', 'active', '2025-04-17 09:51:59', '2025-04-17 09:51:59'),
(2914, NULL, 'Kalugumalai', '31', 'active', '2025-04-17 09:51:59', '2025-04-17 09:51:59'),
(2915, NULL, 'Kamuthi', '31', 'active', '2025-04-17 09:51:59', '2025-04-17 09:51:59'),
(2916, NULL, 'Kanadukattan', '31', 'active', '2025-04-17 09:51:59', '2025-04-17 09:51:59'),
(2917, NULL, 'Kancheepuram', '31', 'active', '2025-04-17 09:51:59', '2025-04-17 09:51:59');
INSERT INTO `module_cities` (`id`, `slug`, `city_name`, `state_name`, `status`, `created_at`, `updated_at`) VALUES
(2918, NULL, 'Kanchipuram', '31', 'active', '2025-04-17 09:51:59', '2025-04-17 09:51:59'),
(2919, NULL, 'Kangayam', '31', 'active', '2025-04-17 09:51:59', '2025-04-17 09:51:59'),
(2920, NULL, 'Kanniyakumari', '31', 'active', '2025-04-17 09:51:59', '2025-04-17 09:51:59'),
(2921, NULL, 'Karaikkudi', '31', 'active', '2025-04-17 09:51:59', '2025-04-17 09:51:59'),
(2922, NULL, 'Karamadai', '31', 'active', '2025-04-17 09:51:59', '2025-04-17 09:51:59'),
(2923, NULL, 'Karambakkudi', '31', 'active', '2025-04-17 09:51:59', '2025-04-17 09:51:59'),
(2924, NULL, 'Kariapatti', '31', 'active', '2025-04-17 09:51:59', '2025-04-17 09:51:59'),
(2925, NULL, 'Karumbakkam', '31', 'active', '2025-04-17 09:51:59', '2025-04-17 09:51:59'),
(2926, NULL, 'Karur', '31', 'active', '2025-04-17 09:51:59', '2025-04-17 09:51:59'),
(2927, NULL, 'Katpadi', '31', 'active', '2025-04-17 09:51:59', '2025-04-17 09:51:59'),
(2928, NULL, 'Kattivakkam', '31', 'active', '2025-04-17 09:51:59', '2025-04-17 09:51:59'),
(2929, NULL, 'Kattupputtur', '31', 'active', '2025-04-17 09:51:59', '2025-04-17 09:51:59'),
(2930, NULL, 'Kaveripatnam', '31', 'active', '2025-04-17 09:51:59', '2025-04-17 09:51:59'),
(2931, NULL, 'Kayalpattinam', '31', 'active', '2025-04-17 09:51:59', '2025-04-17 09:51:59'),
(2932, NULL, 'Kayattar', '31', 'active', '2025-04-17 09:51:59', '2025-04-17 09:51:59'),
(2933, NULL, 'Keelakarai', '31', 'active', '2025-04-17 09:51:59', '2025-04-17 09:51:59'),
(2934, NULL, 'Kelamangalam', '31', 'active', '2025-04-17 09:51:59', '2025-04-17 09:51:59'),
(2935, NULL, 'Kil Bhuvanagiri', '31', 'active', '2025-04-17 09:51:59', '2025-04-17 09:51:59'),
(2936, NULL, 'Kilvelur', '31', 'active', '2025-04-17 09:51:59', '2025-04-17 09:51:59'),
(2937, NULL, 'Kiranur', '31', 'active', '2025-04-17 09:51:59', '2025-04-17 09:51:59'),
(2938, NULL, 'Kodaikanal', '31', 'active', '2025-04-17 09:51:59', '2025-04-17 09:51:59'),
(2939, NULL, 'Kodumudi', '31', 'active', '2025-04-17 09:51:59', '2025-04-17 09:51:59'),
(2940, NULL, 'Kombai', '31', 'active', '2025-04-17 09:51:59', '2025-04-17 09:51:59'),
(2941, NULL, 'Konganapuram', '31', 'active', '2025-04-17 09:51:59', '2025-04-17 09:51:59'),
(2942, NULL, 'Koothanallur', '31', 'active', '2025-04-17 09:51:59', '2025-04-17 09:51:59'),
(2943, NULL, 'Koradachcheri', '31', 'active', '2025-04-17 09:51:59', '2025-04-17 09:51:59'),
(2944, NULL, 'Korampallam', '31', 'active', '2025-04-17 09:51:59', '2025-04-17 09:51:59'),
(2945, NULL, 'Kotagiri', '31', 'active', '2025-04-17 09:51:59', '2025-04-17 09:51:59'),
(2946, NULL, 'Kottaiyur', '31', 'active', '2025-04-17 09:51:59', '2025-04-17 09:51:59'),
(2947, NULL, 'Kovilpatti', '31', 'active', '2025-04-17 09:51:59', '2025-04-17 09:51:59'),
(2948, NULL, 'Krishnagiri', '31', 'active', '2025-04-17 09:51:59', '2025-04-17 09:51:59'),
(2949, NULL, 'Kulattur', '31', 'active', '2025-04-17 09:51:59', '2025-04-17 09:51:59'),
(2950, NULL, 'Kulittalai', '31', 'active', '2025-04-17 09:51:59', '2025-04-17 09:51:59'),
(2951, NULL, 'Kumaralingam', '31', 'active', '2025-04-17 09:51:59', '2025-04-17 09:51:59'),
(2952, NULL, 'Kumbakonam', '31', 'active', '2025-04-17 09:51:59', '2025-04-17 09:51:59'),
(2953, NULL, 'Kunnattur', '31', 'active', '2025-04-17 09:51:59', '2025-04-17 09:51:59'),
(2954, NULL, 'Kurinjippadi', '31', 'active', '2025-04-17 09:51:59', '2025-04-17 09:51:59'),
(2955, NULL, 'Kuttalam', '31', 'active', '2025-04-17 09:51:59', '2025-04-17 09:51:59'),
(2956, NULL, 'Kuzhithurai', '31', 'active', '2025-04-17 09:51:59', '2025-04-17 09:51:59'),
(2957, NULL, 'Lalgudi', '31', 'active', '2025-04-17 09:51:59', '2025-04-17 09:51:59'),
(2958, NULL, 'Madambakkam', '31', 'active', '2025-04-17 09:51:59', '2025-04-17 09:51:59'),
(2959, NULL, 'Madipakkam', '31', 'active', '2025-04-17 09:51:59', '2025-04-17 09:51:59'),
(2960, NULL, 'Madukkarai', '31', 'active', '2025-04-17 09:51:59', '2025-04-17 09:51:59'),
(2961, NULL, 'Madukkur', '31', 'active', '2025-04-17 09:51:59', '2025-04-17 09:51:59'),
(2962, NULL, 'Madurai', '31', 'active', '2025-04-17 09:51:59', '2025-04-17 09:51:59'),
(2963, NULL, 'Madurantakam', '31', 'active', '2025-04-17 09:51:59', '2025-04-17 09:51:59'),
(2964, NULL, 'Mallapuram', '31', 'active', '2025-04-17 09:51:59', '2025-04-17 09:51:59'),
(2965, NULL, 'Mallasamudram', '31', 'active', '2025-04-17 09:51:59', '2025-04-17 09:51:59'),
(2966, NULL, 'Mallur', '31', 'active', '2025-04-17 09:51:59', '2025-04-17 09:51:59'),
(2967, NULL, 'Manali', '31', 'active', '2025-04-17 09:51:59', '2025-04-17 09:51:59'),
(2968, NULL, 'Manalurpettai', '31', 'active', '2025-04-17 09:51:59', '2025-04-17 09:51:59'),
(2969, NULL, 'Manamadurai', '31', 'active', '2025-04-17 09:51:59', '2025-04-17 09:51:59'),
(2970, NULL, 'Manappakkam', '31', 'active', '2025-04-17 09:51:59', '2025-04-17 09:51:59'),
(2971, NULL, 'Manapparai', '31', 'active', '2025-04-17 09:51:59', '2025-04-17 09:51:59'),
(2972, NULL, 'Manavalakurichi', '31', 'active', '2025-04-17 09:51:59', '2025-04-17 09:51:59'),
(2973, NULL, 'Mandapam', '31', 'active', '2025-04-17 09:51:59', '2025-04-17 09:51:59'),
(2974, NULL, 'Mangalam', '31', 'active', '2025-04-17 09:51:59', '2025-04-17 09:51:59'),
(2975, NULL, 'Mannargudi', '31', 'active', '2025-04-17 09:51:59', '2025-04-17 09:51:59'),
(2976, NULL, 'Marakkanam', '31', 'active', '2025-04-17 09:51:59', '2025-04-17 09:51:59'),
(2977, NULL, 'Marandahalli', '31', 'active', '2025-04-17 09:51:59', '2025-04-17 09:51:59'),
(2978, NULL, 'Masinigudi', '31', 'active', '2025-04-17 09:51:59', '2025-04-17 09:51:59'),
(2979, NULL, 'Mattur', '31', 'active', '2025-04-17 09:51:59', '2025-04-17 09:51:59'),
(2980, NULL, 'Mayiladuthurai', '31', 'active', '2025-04-17 09:51:59', '2025-04-17 09:51:59'),
(2981, NULL, 'Melur', '31', 'active', '2025-04-17 09:51:59', '2025-04-17 09:51:59'),
(2982, NULL, 'Mettuppalaiyam', '31', 'active', '2025-04-17 09:51:59', '2025-04-17 09:51:59'),
(2983, NULL, 'Mettur', '31', 'active', '2025-04-17 09:51:59', '2025-04-17 09:51:59'),
(2984, NULL, 'Minjur', '31', 'active', '2025-04-17 09:51:59', '2025-04-17 09:51:59'),
(2985, NULL, 'Mohanur', '31', 'active', '2025-04-17 09:51:59', '2025-04-17 09:51:59'),
(2986, NULL, 'Mudukulattur', '31', 'active', '2025-04-17 09:51:59', '2025-04-17 09:51:59'),
(2987, NULL, 'Mulanur', '31', 'active', '2025-04-17 09:51:59', '2025-04-17 09:51:59'),
(2988, NULL, 'Musiri', '31', 'active', '2025-04-17 09:51:59', '2025-04-17 09:51:59'),
(2989, NULL, 'Muttupet', '31', 'active', '2025-04-17 09:51:59', '2025-04-17 09:51:59'),
(2990, NULL, 'Naduvattam', '31', 'active', '2025-04-17 09:51:59', '2025-04-17 09:51:59'),
(2991, NULL, 'Nagapattinam', '31', 'active', '2025-04-17 09:51:59', '2025-04-17 09:51:59'),
(2992, NULL, 'Nagercoil', '31', 'active', '2025-04-17 09:51:59', '2025-04-17 09:51:59'),
(2993, NULL, 'Namagiripettai', '31', 'active', '2025-04-17 09:51:59', '2025-04-17 09:51:59'),
(2994, NULL, 'Namakkal', '31', 'active', '2025-04-17 09:51:59', '2025-04-17 09:51:59'),
(2995, NULL, 'Nambiyur', '31', 'active', '2025-04-17 09:51:59', '2025-04-17 09:51:59'),
(2996, NULL, 'Nambutalai', '31', 'active', '2025-04-17 09:51:59', '2025-04-17 09:51:59'),
(2997, NULL, 'Nandambakkam', '31', 'active', '2025-04-17 09:51:59', '2025-04-17 09:51:59'),
(2998, NULL, 'Nangavalli', '31', 'active', '2025-04-17 09:51:59', '2025-04-17 09:51:59'),
(2999, NULL, 'Nangilickondan', '31', 'active', '2025-04-17 09:51:59', '2025-04-17 09:51:59'),
(3000, NULL, 'Nanguneri', '31', 'active', '2025-04-17 09:51:59', '2025-04-17 09:51:59'),
(3001, NULL, 'Nannilam', '31', 'active', '2025-04-17 09:51:59', '2025-04-17 09:51:59'),
(3002, NULL, 'Naravarikuppam', '31', 'active', '2025-04-17 09:51:59', '2025-04-17 09:51:59'),
(3003, NULL, 'Nattam', '31', 'active', '2025-04-17 09:51:59', '2025-04-17 09:51:59'),
(3004, NULL, 'Nattarasankottai', '31', 'active', '2025-04-17 09:51:59', '2025-04-17 09:51:59'),
(3005, NULL, 'Needamangalam', '31', 'active', '2025-04-17 09:51:59', '2025-04-17 09:51:59'),
(3006, NULL, 'Neelankarai', '31', 'active', '2025-04-17 09:51:59', '2025-04-17 09:51:59'),
(3007, NULL, 'Negapatam', '31', 'active', '2025-04-17 09:51:59', '2025-04-17 09:51:59'),
(3008, NULL, 'Nellikkuppam', '31', 'active', '2025-04-17 09:51:59', '2025-04-17 09:51:59'),
(3009, NULL, 'Nilakottai', '31', 'active', '2025-04-17 09:51:59', '2025-04-17 09:51:59'),
(3010, NULL, 'Nilgiris', '31', 'active', '2025-04-17 09:51:59', '2025-04-17 09:51:59'),
(3011, NULL, 'Odugattur', '31', 'active', '2025-04-17 09:51:59', '2025-04-17 09:51:59'),
(3012, NULL, 'Omalur', '31', 'active', '2025-04-17 09:51:59', '2025-04-17 09:51:59'),
(3013, NULL, 'Ooty', '31', 'active', '2025-04-17 09:51:59', '2025-04-17 09:51:59'),
(3014, NULL, 'Padmanabhapuram', '31', 'active', '2025-04-17 09:51:59', '2025-04-17 09:51:59'),
(3015, NULL, 'Palakkodu', '31', 'active', '2025-04-17 09:51:59', '2025-04-17 09:51:59'),
(3016, NULL, 'Palamedu', '31', 'active', '2025-04-17 09:51:59', '2025-04-17 09:51:59'),
(3017, NULL, 'Palani', '31', 'active', '2025-04-17 09:51:59', '2025-04-17 09:51:59'),
(3018, NULL, 'Palavakkam', '31', 'active', '2025-04-17 09:51:59', '2025-04-17 09:51:59'),
(3019, NULL, 'Palladam', '31', 'active', '2025-04-17 09:51:59', '2025-04-17 09:51:59'),
(3020, NULL, 'Pallappatti', '31', 'active', '2025-04-17 09:51:59', '2025-04-17 09:51:59'),
(3021, NULL, 'Pallattur', '31', 'active', '2025-04-17 09:51:59', '2025-04-17 09:51:59'),
(3022, NULL, 'Pallavaram', '31', 'active', '2025-04-17 09:51:59', '2025-04-17 09:51:59'),
(3023, NULL, 'Pallikondai', '31', 'active', '2025-04-17 09:51:59', '2025-04-17 09:51:59'),
(3024, NULL, 'Pallipattu', '31', 'active', '2025-04-17 09:51:59', '2025-04-17 09:51:59'),
(3025, NULL, 'Pallippatti', '31', 'active', '2025-04-17 09:51:59', '2025-04-17 09:51:59'),
(3026, NULL, 'Panruti', '31', 'active', '2025-04-17 09:51:59', '2025-04-17 09:51:59'),
(3027, NULL, 'Papanasam', '31', 'active', '2025-04-17 09:51:59', '2025-04-17 09:51:59'),
(3028, NULL, 'Papireddippatti', '31', 'active', '2025-04-17 09:51:59', '2025-04-17 09:51:59'),
(3029, NULL, 'Papparappatti', '31', 'active', '2025-04-17 09:51:59', '2025-04-17 09:51:59'),
(3030, NULL, 'Paramagudi', '31', 'active', '2025-04-17 09:51:59', '2025-04-17 09:51:59'),
(3031, NULL, 'Pattukkottai', '31', 'active', '2025-04-17 09:51:59', '2025-04-17 09:51:59'),
(3032, NULL, 'Pennadam', '31', 'active', '2025-04-17 09:51:59', '2025-04-17 09:51:59'),
(3033, NULL, 'Pennagaram', '31', 'active', '2025-04-17 09:51:59', '2025-04-17 09:51:59'),
(3034, NULL, 'Pennathur', '31', 'active', '2025-04-17 09:51:59', '2025-04-17 09:51:59'),
(3035, NULL, 'Peraiyur', '31', 'active', '2025-04-17 09:51:59', '2025-04-17 09:51:59'),
(3036, NULL, 'Perambalur', '31', 'active', '2025-04-17 09:51:59', '2025-04-17 09:51:59'),
(3037, NULL, 'Peranamallur', '31', 'active', '2025-04-17 09:51:59', '2025-04-17 09:51:59'),
(3038, NULL, 'Peranampattu', '31', 'active', '2025-04-17 09:51:59', '2025-04-17 09:51:59'),
(3039, NULL, 'Peravurani', '31', 'active', '2025-04-17 09:51:59', '2025-04-17 09:51:59'),
(3040, NULL, 'Periyakulam', '31', 'active', '2025-04-17 09:51:59', '2025-04-17 09:51:59'),
(3041, NULL, 'Periyanayakkanpalaiyam', '31', 'active', '2025-04-17 09:51:59', '2025-04-17 09:51:59'),
(3042, NULL, 'Periyanegamam', '31', 'active', '2025-04-17 09:51:59', '2025-04-17 09:51:59'),
(3043, NULL, 'Periyapatti', '31', 'active', '2025-04-17 09:51:59', '2025-04-17 09:51:59'),
(3044, NULL, 'Periyapattinam', '31', 'active', '2025-04-17 09:51:59', '2025-04-17 09:51:59'),
(3045, NULL, 'Perundurai', '31', 'active', '2025-04-17 09:51:59', '2025-04-17 09:51:59'),
(3046, NULL, 'Perungudi', '31', 'active', '2025-04-17 09:51:59', '2025-04-17 09:51:59'),
(3047, NULL, 'Perur', '31', 'active', '2025-04-17 09:51:59', '2025-04-17 09:51:59'),
(3048, NULL, 'Pollachi', '31', 'active', '2025-04-17 09:51:59', '2025-04-17 09:51:59'),
(3049, NULL, 'Polur', '31', 'active', '2025-04-17 09:51:59', '2025-04-17 09:51:59'),
(3050, NULL, 'Ponnamaravati', '31', 'active', '2025-04-17 09:51:59', '2025-04-17 09:51:59'),
(3051, NULL, 'Ponneri', '31', 'active', '2025-04-17 09:51:59', '2025-04-17 09:51:59'),
(3052, NULL, 'Poonamalle', '31', 'active', '2025-04-17 09:51:59', '2025-04-17 09:51:59'),
(3053, NULL, 'Porur', '31', 'active', '2025-04-17 09:51:59', '2025-04-17 09:51:59'),
(3054, NULL, 'Pudukkottai', '31', 'active', '2025-04-17 09:51:59', '2025-04-17 09:51:59'),
(3055, NULL, 'Puduppatti', '31', 'active', '2025-04-17 09:51:59', '2025-04-17 09:51:59'),
(3056, NULL, 'Pudur', '31', 'active', '2025-04-17 09:51:59', '2025-04-17 09:51:59'),
(3057, NULL, 'Puduvayal', '31', 'active', '2025-04-17 09:51:59', '2025-04-17 09:51:59'),
(3058, NULL, 'Puliyangudi', '31', 'active', '2025-04-17 09:51:59', '2025-04-17 09:51:59'),
(3059, NULL, 'Puliyur', '31', 'active', '2025-04-17 09:51:59', '2025-04-17 09:51:59'),
(3060, NULL, 'Pullambadi', '31', 'active', '2025-04-17 09:51:59', '2025-04-17 09:51:59'),
(3061, NULL, 'Punjai Puliyampatti', '31', 'active', '2025-04-17 09:51:59', '2025-04-17 09:51:59'),
(3062, NULL, 'Rajapalaiyam', '31', 'active', '2025-04-17 09:51:59', '2025-04-17 09:51:59'),
(3063, NULL, 'Ramanathapuram', '31', 'active', '2025-04-17 09:51:59', '2025-04-17 09:51:59'),
(3064, NULL, 'Rameswaram', '31', 'active', '2025-04-17 09:51:59', '2025-04-17 09:51:59'),
(3065, NULL, 'Ranipet', '31', 'active', '2025-04-17 09:51:59', '2025-04-17 09:51:59'),
(3066, NULL, 'Rasipuram', '31', 'active', '2025-04-17 09:51:59', '2025-04-17 09:51:59'),
(3067, NULL, 'Saint Thomas Mount', '31', 'active', '2025-04-17 09:51:59', '2025-04-17 09:51:59'),
(3068, NULL, 'Salem', '31', 'active', '2025-04-17 09:51:59', '2025-04-17 09:51:59'),
(3069, NULL, 'Sathankulam', '31', 'active', '2025-04-17 09:51:59', '2025-04-17 09:51:59'),
(3070, NULL, 'Sathyamangalam', '31', 'active', '2025-04-17 09:51:59', '2025-04-17 09:51:59'),
(3071, NULL, 'Sattur', '31', 'active', '2025-04-17 09:51:59', '2025-04-17 09:51:59'),
(3072, NULL, 'Sayalkudi', '31', 'active', '2025-04-17 09:51:59', '2025-04-17 09:51:59'),
(3073, NULL, 'Seven Pagodas', '31', 'active', '2025-04-17 09:51:59', '2025-04-17 09:51:59'),
(3074, NULL, 'Sholinghur', '31', 'active', '2025-04-17 09:51:59', '2025-04-17 09:51:59'),
(3075, NULL, 'Singanallur', '31', 'active', '2025-04-17 09:51:59', '2025-04-17 09:51:59'),
(3076, NULL, 'Singapperumalkovil', '31', 'active', '2025-04-17 09:51:59', '2025-04-17 09:51:59'),
(3077, NULL, 'Sirkazhi', '31', 'active', '2025-04-17 09:51:59', '2025-04-17 09:51:59'),
(3078, NULL, 'Sirumugai', '31', 'active', '2025-04-17 09:51:59', '2025-04-17 09:51:59'),
(3079, NULL, 'Sivaganga', '31', 'active', '2025-04-17 09:51:59', '2025-04-17 09:51:59'),
(3080, NULL, 'Sivagiri', '31', 'active', '2025-04-17 09:51:59', '2025-04-17 09:51:59'),
(3081, NULL, 'Sivakasi', '31', 'active', '2025-04-17 09:51:59', '2025-04-17 09:51:59'),
(3082, NULL, 'Srimushnam', '31', 'active', '2025-04-17 09:51:59', '2025-04-17 09:51:59'),
(3083, NULL, 'Sriperumbudur', '31', 'active', '2025-04-17 09:51:59', '2025-04-17 09:51:59'),
(3084, NULL, 'Srivaikuntam', '31', 'active', '2025-04-17 09:51:59', '2025-04-17 09:51:59'),
(3085, NULL, 'Srivilliputhur', '31', 'active', '2025-04-17 09:51:59', '2025-04-17 09:51:59'),
(3086, NULL, 'Suchindram', '31', 'active', '2025-04-17 09:51:59', '2025-04-17 09:51:59'),
(3087, NULL, 'Sulur', '31', 'active', '2025-04-17 09:51:59', '2025-04-17 09:51:59'),
(3088, NULL, 'Surandai', '31', 'active', '2025-04-17 09:51:59', '2025-04-17 09:51:59'),
(3089, NULL, 'Swamimalai', '31', 'active', '2025-04-17 09:51:59', '2025-04-17 09:51:59'),
(3090, NULL, 'Tambaram', '31', 'active', '2025-04-17 09:51:59', '2025-04-17 09:51:59'),
(3091, NULL, 'Tanjore', '31', 'active', '2025-04-17 09:51:59', '2025-04-17 09:51:59'),
(3092, NULL, 'Taramangalam', '31', 'active', '2025-04-17 09:51:59', '2025-04-17 09:51:59'),
(3093, NULL, 'Tattayyangarpettai', '31', 'active', '2025-04-17 09:51:59', '2025-04-17 09:51:59'),
(3094, NULL, 'Thanjavur', '31', 'active', '2025-04-17 09:51:59', '2025-04-17 09:51:59'),
(3095, NULL, 'Tharangambadi', '31', 'active', '2025-04-17 09:51:59', '2025-04-17 09:51:59'),
(3096, NULL, 'Theni', '31', 'active', '2025-04-17 09:51:59', '2025-04-17 09:51:59'),
(3097, NULL, 'Thenkasi', '31', 'active', '2025-04-17 09:51:59', '2025-04-17 09:51:59'),
(3098, NULL, 'Thirukattupalli', '31', 'active', '2025-04-17 09:51:59', '2025-04-17 09:51:59'),
(3099, NULL, 'Thiruthani', '31', 'active', '2025-04-17 09:51:59', '2025-04-17 09:51:59'),
(3100, NULL, 'Thiruvaiyaru', '31', 'active', '2025-04-17 09:51:59', '2025-04-17 09:51:59'),
(3101, NULL, 'Thiruvallur', '31', 'active', '2025-04-17 09:51:59', '2025-04-17 09:51:59'),
(3102, NULL, 'Thiruvarur', '31', 'active', '2025-04-17 09:51:59', '2025-04-17 09:51:59'),
(3103, NULL, 'Thiruvidaimaruthur', '31', 'active', '2025-04-17 09:51:59', '2025-04-17 09:51:59'),
(3104, NULL, 'Thoothukudi', '31', 'active', '2025-04-17 09:51:59', '2025-04-17 09:51:59'),
(3105, NULL, 'Tindivanam', '31', 'active', '2025-04-17 09:51:59', '2025-04-17 09:51:59'),
(3106, NULL, 'Tinnanur', '31', 'active', '2025-04-17 09:51:59', '2025-04-17 09:51:59'),
(3107, NULL, 'Tiruchchendur', '31', 'active', '2025-04-17 09:51:59', '2025-04-17 09:51:59'),
(3108, NULL, 'Tiruchengode', '31', 'active', '2025-04-17 09:51:59', '2025-04-17 09:51:59'),
(3109, NULL, 'Tiruchirappalli', '31', 'active', '2025-04-17 09:51:59', '2025-04-17 09:51:59'),
(3110, NULL, 'Tirukkoyilur', '31', 'active', '2025-04-17 09:51:59', '2025-04-17 09:51:59'),
(3111, NULL, 'Tirumullaivasal', '31', 'active', '2025-04-17 09:51:59', '2025-04-17 09:51:59'),
(3112, NULL, 'Tirunelveli', '31', 'active', '2025-04-17 09:51:59', '2025-04-17 09:51:59'),
(3113, NULL, 'Tirunelveli Kattabo', '31', 'active', '2025-04-17 09:51:59', '2025-04-17 09:51:59'),
(3114, NULL, 'Tiruppalaikudi', '31', 'active', '2025-04-17 09:51:59', '2025-04-17 09:51:59'),
(3115, NULL, 'Tirupparangunram', '31', 'active', '2025-04-17 09:51:59', '2025-04-17 09:51:59'),
(3116, NULL, 'Tiruppur', '31', 'active', '2025-04-17 09:51:59', '2025-04-17 09:51:59'),
(3117, NULL, 'Tiruppuvanam', '31', 'active', '2025-04-17 09:51:59', '2025-04-17 09:51:59'),
(3118, NULL, 'Tiruttangal', '31', 'active', '2025-04-17 09:51:59', '2025-04-17 09:51:59'),
(3119, NULL, 'Tiruvannamalai', '31', 'active', '2025-04-17 09:51:59', '2025-04-17 09:51:59'),
(3120, NULL, 'Tiruvottiyur', '31', 'active', '2025-04-17 09:51:59', '2025-04-17 09:51:59'),
(3121, NULL, 'Tisaiyanvilai', '31', 'active', '2025-04-17 09:51:59', '2025-04-17 09:51:59'),
(3122, NULL, 'Tondi', '31', 'active', '2025-04-17 09:51:59', '2025-04-17 09:51:59'),
(3123, NULL, 'Turaiyur', '31', 'active', '2025-04-17 09:51:59', '2025-04-17 09:51:59'),
(3124, NULL, 'Udangudi', '31', 'active', '2025-04-17 09:51:59', '2025-04-17 09:51:59'),
(3125, NULL, 'Udumalaippettai', '31', 'active', '2025-04-17 09:51:59', '2025-04-17 09:51:59'),
(3126, NULL, 'Uppiliyapuram', '31', 'active', '2025-04-17 09:51:59', '2025-04-17 09:51:59'),
(3127, NULL, 'Usilampatti', '31', 'active', '2025-04-17 09:51:59', '2025-04-17 09:51:59'),
(3128, NULL, 'Uttamapalaiyam', '31', 'active', '2025-04-17 09:51:59', '2025-04-17 09:51:59'),
(3129, NULL, 'Uttiramerur', '31', 'active', '2025-04-17 09:51:59', '2025-04-17 09:51:59'),
(3130, NULL, 'Uttukkuli', '31', 'active', '2025-04-17 09:51:59', '2025-04-17 09:51:59'),
(3131, NULL, 'V.S.K.Valasai (Dindigul-Dist.)', '31', 'active', '2025-04-17 09:51:59', '2025-04-17 09:51:59'),
(3132, NULL, 'Vadakku Valliyur', '31', 'active', '2025-04-17 09:51:59', '2025-04-17 09:51:59'),
(3133, NULL, 'Vadakku Viravanallur', '31', 'active', '2025-04-17 09:51:59', '2025-04-17 09:51:59'),
(3134, NULL, 'Vadamadurai', '31', 'active', '2025-04-17 09:51:59', '2025-04-17 09:51:59'),
(3135, NULL, 'Vadippatti', '31', 'active', '2025-04-17 09:51:59', '2025-04-17 09:51:59'),
(3136, NULL, 'Valangaiman', '31', 'active', '2025-04-17 09:51:59', '2025-04-17 09:51:59'),
(3137, NULL, 'Valavanur', '31', 'active', '2025-04-17 09:51:59', '2025-04-17 09:51:59'),
(3138, NULL, 'Vallam', '31', 'active', '2025-04-17 09:51:59', '2025-04-17 09:51:59'),
(3139, NULL, 'Valparai', '31', 'active', '2025-04-17 09:51:59', '2025-04-17 09:51:59'),
(3140, NULL, 'Vandalur', '31', 'active', '2025-04-17 09:51:59', '2025-04-17 09:51:59'),
(3141, NULL, 'Vandavasi', '31', 'active', '2025-04-17 09:51:59', '2025-04-17 09:51:59'),
(3142, NULL, 'Vaniyambadi', '31', 'active', '2025-04-17 09:51:59', '2025-04-17 09:51:59'),
(3143, NULL, 'Vasudevanallur', '31', 'active', '2025-04-17 09:51:59', '2025-04-17 09:51:59'),
(3144, NULL, 'Vattalkundu', '31', 'active', '2025-04-17 09:51:59', '2025-04-17 09:51:59'),
(3145, NULL, 'Vedaraniyam', '31', 'active', '2025-04-17 09:51:59', '2025-04-17 09:51:59'),
(3146, NULL, 'Vedasandur', '31', 'active', '2025-04-17 09:51:59', '2025-04-17 09:51:59'),
(3147, NULL, 'Velankanni', '31', 'active', '2025-04-17 09:51:59', '2025-04-17 09:51:59'),
(3148, NULL, 'Vellanur', '31', 'active', '2025-04-17 09:51:59', '2025-04-17 09:51:59'),
(3149, NULL, 'Vellore', '31', 'active', '2025-04-17 09:51:59', '2025-04-17 09:51:59'),
(3150, NULL, 'Velur', '31', 'active', '2025-04-17 09:51:59', '2025-04-17 09:51:59'),
(3151, NULL, 'Vengavasal', '31', 'active', '2025-04-17 09:51:59', '2025-04-17 09:51:59'),
(3152, NULL, 'Vettaikkaranpudur', '31', 'active', '2025-04-17 09:51:59', '2025-04-17 09:51:59'),
(3153, NULL, 'Vettavalam', '31', 'active', '2025-04-17 09:51:59', '2025-04-17 09:51:59'),
(3154, NULL, 'Vijayapuri', '31', 'active', '2025-04-17 09:51:59', '2025-04-17 09:51:59'),
(3155, NULL, 'Vikravandi', '31', 'active', '2025-04-17 09:51:59', '2025-04-17 09:51:59'),
(3156, NULL, 'Vilattikulam', '31', 'active', '2025-04-17 09:51:59', '2025-04-17 09:51:59'),
(3157, NULL, 'Villupuram', '31', 'active', '2025-04-17 09:51:59', '2025-04-17 09:51:59'),
(3158, NULL, 'Viraganur', '31', 'active', '2025-04-17 09:51:59', '2025-04-17 09:51:59'),
(3159, NULL, 'Virudhunagar', '31', 'active', '2025-04-17 09:51:59', '2025-04-17 09:51:59'),
(3160, NULL, 'Vriddhachalam', '31', 'active', '2025-04-17 09:51:59', '2025-04-17 09:51:59'),
(3161, NULL, 'Walajapet', '31', 'active', '2025-04-17 09:51:59', '2025-04-17 09:51:59'),
(3162, NULL, 'Wallajahbad', '31', 'active', '2025-04-17 09:51:59', '2025-04-17 09:51:59'),
(3163, NULL, 'Wellington', '31', 'active', '2025-04-17 09:51:59', '2025-04-17 09:51:59'),
(3164, NULL, 'Adilabad', '32', 'active', '2025-04-17 09:51:59', '2025-04-17 09:51:59'),
(3165, NULL, 'Alampur', '32', 'active', '2025-04-17 09:51:59', '2025-04-17 09:51:59'),
(3166, NULL, 'Andol', '32', 'active', '2025-04-17 09:51:59', '2025-04-17 09:51:59'),
(3167, NULL, 'Asifabad', '32', 'active', '2025-04-17 09:51:59', '2025-04-17 09:51:59'),
(3168, NULL, 'Balapur', '32', 'active', '2025-04-17 09:51:59', '2025-04-17 09:51:59'),
(3169, NULL, 'Banswada', '32', 'active', '2025-04-17 09:51:59', '2025-04-17 09:51:59'),
(3170, NULL, 'Bellampalli', '32', 'active', '2025-04-17 09:51:59', '2025-04-17 09:51:59'),
(3171, NULL, 'Bhadrachalam', '32', 'active', '2025-04-17 09:51:59', '2025-04-17 09:51:59'),
(3172, NULL, 'Bhadradri Kothagudem', '32', 'active', '2025-04-17 09:51:59', '2025-04-17 09:51:59'),
(3173, NULL, 'Bhaisa', '32', 'active', '2025-04-17 09:51:59', '2025-04-17 09:51:59'),
(3174, NULL, 'Bhongir', '32', 'active', '2025-04-17 09:51:59', '2025-04-17 09:51:59'),
(3175, NULL, 'Bodhan', '32', 'active', '2025-04-17 09:51:59', '2025-04-17 09:51:59'),
(3176, NULL, 'Chandur', '32', 'active', '2025-04-17 09:51:59', '2025-04-17 09:51:59'),
(3177, NULL, 'Chatakonda', '32', 'active', '2025-04-17 09:51:59', '2025-04-17 09:51:59'),
(3178, NULL, 'Dasnapur', '32', 'active', '2025-04-17 09:51:59', '2025-04-17 09:51:59'),
(3179, NULL, 'Devarkonda', '32', 'active', '2025-04-17 09:51:59', '2025-04-17 09:51:59'),
(3180, NULL, 'Dornakal', '32', 'active', '2025-04-17 09:51:59', '2025-04-17 09:51:59'),
(3181, NULL, 'Farrukhnagar', '32', 'active', '2025-04-17 09:51:59', '2025-04-17 09:51:59'),
(3182, NULL, 'Gaddi Annaram', '32', 'active', '2025-04-17 09:51:59', '2025-04-17 09:51:59'),
(3183, NULL, 'Gadwal', '32', 'active', '2025-04-17 09:51:59', '2025-04-17 09:51:59'),
(3184, NULL, 'Ghatkesar', '32', 'active', '2025-04-17 09:51:59', '2025-04-17 09:51:59'),
(3185, NULL, 'Gopalur', '32', 'active', '2025-04-17 09:51:59', '2025-04-17 09:51:59'),
(3186, NULL, 'Gudur', '32', 'active', '2025-04-17 09:51:59', '2025-04-17 09:51:59'),
(3187, NULL, 'Hyderabad', '32', 'active', '2025-04-17 09:51:59', '2025-04-17 09:51:59'),
(3188, NULL, 'Jagtial', '32', 'active', '2025-04-17 09:51:59', '2025-04-17 09:51:59'),
(3189, NULL, 'Jangaon', '32', 'active', '2025-04-17 09:51:59', '2025-04-17 09:51:59'),
(3190, NULL, 'Jayashankar Bhupalapally', '32', 'active', '2025-04-17 09:51:59', '2025-04-17 09:51:59'),
(3191, NULL, 'Jogulamba Gadwal', '32', 'active', '2025-04-17 09:51:59', '2025-04-17 09:51:59'),
(3192, NULL, 'Kagaznagar', '32', 'active', '2025-04-17 09:51:59', '2025-04-17 09:51:59'),
(3193, NULL, 'Kamareddi', '32', 'active', '2025-04-17 09:51:59', '2025-04-17 09:51:59'),
(3194, NULL, 'Kamareddy', '32', 'active', '2025-04-17 09:51:59', '2025-04-17 09:51:59'),
(3195, NULL, 'Karimnagar', '32', 'active', '2025-04-17 09:51:59', '2025-04-17 09:51:59'),
(3196, NULL, 'Khammam', '32', 'active', '2025-04-17 09:51:59', '2025-04-17 09:51:59'),
(3197, NULL, 'Kodar', '32', 'active', '2025-04-17 09:51:59', '2025-04-17 09:51:59'),
(3198, NULL, 'Koratla', '32', 'active', '2025-04-17 09:51:59', '2025-04-17 09:51:59'),
(3199, NULL, 'Kothapet', '32', 'active', '2025-04-17 09:51:59', '2025-04-17 09:51:59'),
(3200, NULL, 'Kottagudem', '32', 'active', '2025-04-17 09:51:59', '2025-04-17 09:51:59'),
(3201, NULL, 'Kottapalli', '32', 'active', '2025-04-17 09:51:59', '2025-04-17 09:51:59'),
(3202, NULL, 'Kukatpally', '32', 'active', '2025-04-17 09:51:59', '2025-04-17 09:51:59'),
(3203, NULL, 'Kyathampalle', '32', 'active', '2025-04-17 09:51:59', '2025-04-17 09:51:59'),
(3204, NULL, 'Lakshettipet', '32', 'active', '2025-04-17 09:51:59', '2025-04-17 09:51:59'),
(3205, NULL, 'Lal Bahadur Nagar', '32', 'active', '2025-04-17 09:51:59', '2025-04-17 09:51:59'),
(3206, NULL, 'Mahabubabad', '32', 'active', '2025-04-17 09:51:59', '2025-04-17 09:51:59'),
(3207, NULL, 'Mahbubnagar', '32', 'active', '2025-04-17 09:51:59', '2025-04-17 09:51:59'),
(3208, NULL, 'Malkajgiri', '32', 'active', '2025-04-17 09:51:59', '2025-04-17 09:51:59'),
(3209, NULL, 'Mancheral', '32', 'active', '2025-04-17 09:51:59', '2025-04-17 09:51:59'),
(3210, NULL, 'Mandamarri', '32', 'active', '2025-04-17 09:51:59', '2025-04-17 09:51:59'),
(3211, NULL, 'Manthani', '32', 'active', '2025-04-17 09:51:59', '2025-04-17 09:51:59'),
(3212, NULL, 'Manuguru', '32', 'active', '2025-04-17 09:51:59', '2025-04-17 09:51:59'),
(3213, NULL, 'Medak', '32', 'active', '2025-04-17 09:51:59', '2025-04-17 09:51:59'),
(3214, NULL, 'Medchal', '32', 'active', '2025-04-17 09:51:59', '2025-04-17 09:51:59'),
(3215, NULL, 'Medchal Malkajgiri', '32', 'active', '2025-04-17 09:51:59', '2025-04-17 09:51:59'),
(3216, NULL, 'Mirialguda', '32', 'active', '2025-04-17 09:51:59', '2025-04-17 09:51:59'),
(3217, NULL, 'Nagar Karnul', '32', 'active', '2025-04-17 09:51:59', '2025-04-17 09:51:59'),
(3218, NULL, 'Nalgonda', '32', 'active', '2025-04-17 09:51:59', '2025-04-17 09:51:59'),
(3219, NULL, 'Narayanpet', '32', 'active', '2025-04-17 09:51:59', '2025-04-17 09:51:59'),
(3220, NULL, 'Narsingi', '32', 'active', '2025-04-17 09:51:59', '2025-04-17 09:51:59'),
(3221, NULL, 'Naspur', '32', 'active', '2025-04-17 09:51:59', '2025-04-17 09:51:59'),
(3222, NULL, 'Nirmal', '32', 'active', '2025-04-17 09:51:59', '2025-04-17 09:51:59'),
(3223, NULL, 'Nizamabad', '32', 'active', '2025-04-17 09:51:59', '2025-04-17 09:51:59'),
(3224, NULL, 'Paloncha', '32', 'active', '2025-04-17 09:51:59', '2025-04-17 09:51:59'),
(3225, NULL, 'Palwancha', '32', 'active', '2025-04-17 09:51:59', '2025-04-17 09:51:59'),
(3226, NULL, 'Patancheru', '32', 'active', '2025-04-17 09:51:59', '2025-04-17 09:51:59'),
(3227, NULL, 'Peddapalli', '32', 'active', '2025-04-17 09:51:59', '2025-04-17 09:51:59'),
(3228, NULL, 'Quthbullapur', '32', 'active', '2025-04-17 09:51:59', '2025-04-17 09:51:59'),
(3229, NULL, 'Rajanna Sircilla', '32', 'active', '2025-04-17 09:51:59', '2025-04-17 09:51:59'),
(3230, NULL, 'Ramagundam', '32', 'active', '2025-04-17 09:51:59', '2025-04-17 09:51:59'),
(3231, NULL, 'Ramgundam', '32', 'active', '2025-04-17 09:51:59', '2025-04-17 09:51:59'),
(3232, NULL, 'Rangareddi', '32', 'active', '2025-04-17 09:51:59', '2025-04-17 09:51:59'),
(3233, NULL, 'Sadaseopet', '32', 'active', '2025-04-17 09:51:59', '2025-04-17 09:51:59'),
(3234, NULL, 'Sangareddi', '32', 'active', '2025-04-17 09:51:59', '2025-04-17 09:51:59'),
(3235, NULL, 'Sathupalli', '32', 'active', '2025-04-17 09:51:59', '2025-04-17 09:51:59'),
(3236, NULL, 'Secunderabad', '32', 'active', '2025-04-17 09:51:59', '2025-04-17 09:51:59'),
(3237, NULL, 'Serilingampalle', '32', 'active', '2025-04-17 09:51:59', '2025-04-17 09:51:59'),
(3238, NULL, 'Siddipet', '32', 'active', '2025-04-17 09:51:59', '2025-04-17 09:51:59'),
(3239, NULL, 'Singapur', '32', 'active', '2025-04-17 09:51:59', '2025-04-17 09:51:59'),
(3240, NULL, 'Sirpur', '32', 'active', '2025-04-17 09:51:59', '2025-04-17 09:51:59'),
(3241, NULL, 'Sirsilla', '32', 'active', '2025-04-17 09:51:59', '2025-04-17 09:51:59'),
(3242, NULL, 'Sriramnagar', '32', 'active', '2025-04-17 09:51:59', '2025-04-17 09:51:59'),
(3243, NULL, 'Suriapet', '32', 'active', '2025-04-17 09:51:59', '2025-04-17 09:51:59'),
(3244, NULL, 'Tandur', '32', 'active', '2025-04-17 09:51:59', '2025-04-17 09:51:59'),
(3245, NULL, 'Uppal Kalan', '32', 'active', '2025-04-17 09:51:59', '2025-04-17 09:51:59'),
(3246, NULL, 'Vemalwada', '32', 'active', '2025-04-17 09:51:59', '2025-04-17 09:51:59'),
(3247, NULL, 'Vikarabad', '32', 'active', '2025-04-17 09:51:59', '2025-04-17 09:51:59'),
(3248, NULL, 'Wanparti', '32', 'active', '2025-04-17 09:51:59', '2025-04-17 09:51:59'),
(3249, NULL, 'Warangal', '32', 'active', '2025-04-17 09:51:59', '2025-04-17 09:51:59'),
(3250, NULL, 'Yellandu', '32', 'active', '2025-04-17 09:51:59', '2025-04-17 09:51:59'),
(3251, NULL, 'Zahirabad', '32', 'active', '2025-04-17 09:51:59', '2025-04-17 09:51:59'),
(3252, NULL, 'Agartala', '33', 'active', '2025-04-17 09:51:59', '2025-04-17 09:51:59'),
(3253, NULL, 'Amarpur', '33', 'active', '2025-04-17 09:51:59', '2025-04-17 09:51:59'),
(3254, NULL, 'Ambasa', '33', 'active', '2025-04-17 09:51:59', '2025-04-17 09:51:59'),
(3255, NULL, 'Barjala', '33', 'active', '2025-04-17 09:51:59', '2025-04-17 09:51:59'),
(3256, NULL, 'Belonia', '33', 'active', '2025-04-17 09:51:59', '2025-04-17 09:51:59'),
(3257, NULL, 'Dhalai', '33', 'active', '2025-04-17 09:51:59', '2025-04-17 09:51:59'),
(3258, NULL, 'Dharmanagar', '33', 'active', '2025-04-17 09:51:59', '2025-04-17 09:51:59'),
(3259, NULL, 'Gomati', '33', 'active', '2025-04-17 09:51:59', '2025-04-17 09:51:59'),
(3260, NULL, 'Kailashahar', '33', 'active', '2025-04-17 09:51:59', '2025-04-17 09:51:59'),
(3261, NULL, 'Kamalpur', '33', 'active', '2025-04-17 09:51:59', '2025-04-17 09:51:59'),
(3262, NULL, 'Khowai', '33', 'active', '2025-04-17 09:51:59', '2025-04-17 09:51:59'),
(3263, NULL, 'North Tripura', '33', 'active', '2025-04-17 09:51:59', '2025-04-17 09:51:59'),
(3264, NULL, 'Ranir Bazar', '33', 'active', '2025-04-17 09:51:59', '2025-04-17 09:51:59'),
(3265, NULL, 'Sabrum', '33', 'active', '2025-04-17 09:51:59', '2025-04-17 09:51:59'),
(3266, NULL, 'Sonamura', '33', 'active', '2025-04-17 09:51:59', '2025-04-17 09:51:59'),
(3267, NULL, 'South Tripura', '33', 'active', '2025-04-17 09:51:59', '2025-04-17 09:51:59'),
(3268, NULL, 'Udaipur', '33', 'active', '2025-04-17 09:51:59', '2025-04-17 09:51:59'),
(3269, NULL, 'Unakoti', '33', 'active', '2025-04-17 09:51:59', '2025-04-17 09:51:59'),
(3270, NULL, 'West Tripura', '33', 'active', '2025-04-17 09:51:59', '2025-04-17 09:51:59'),
(3271, NULL, 'Achhnera', '34', 'active', '2025-04-17 09:51:59', '2025-04-17 09:51:59'),
(3272, NULL, 'Afzalgarh', '34', 'active', '2025-04-17 09:51:59', '2025-04-17 09:51:59'),
(3273, NULL, 'Agra', '34', 'active', '2025-04-17 09:51:59', '2025-04-17 09:51:59'),
(3274, NULL, 'Ahraura', '34', 'active', '2025-04-17 09:51:59', '2025-04-17 09:51:59'),
(3275, NULL, 'Aidalpur', '34', 'active', '2025-04-17 09:51:59', '2025-04-17 09:51:59'),
(3276, NULL, 'Airwa', '34', 'active', '2025-04-17 09:51:59', '2025-04-17 09:51:59'),
(3277, NULL, 'Akbarpur', '34', 'active', '2025-04-17 09:51:59', '2025-04-17 09:51:59'),
(3278, NULL, 'Akola', '34', 'active', '2025-04-17 09:51:59', '2025-04-17 09:51:59'),
(3279, NULL, 'Aliganj', '34', 'active', '2025-04-17 09:51:59', '2025-04-17 09:51:59'),
(3280, NULL, 'Aligarh', '34', 'active', '2025-04-17 09:51:59', '2025-04-17 09:51:59'),
(3281, NULL, 'Allahabad', '34', 'active', '2025-04-17 09:51:59', '2025-04-17 09:51:59'),
(3282, NULL, 'Allahganj', '34', 'active', '2025-04-17 09:51:59', '2025-04-17 09:51:59'),
(3283, NULL, 'Amanpur', '34', 'active', '2025-04-17 09:51:59', '2025-04-17 09:51:59'),
(3284, NULL, 'Amauli', '34', 'active', '2025-04-17 09:51:59', '2025-04-17 09:51:59'),
(3285, NULL, 'Ambahta', '34', 'active', '2025-04-17 09:51:59', '2025-04-17 09:51:59'),
(3286, NULL, 'Ambedkar Nagar', '34', 'active', '2025-04-17 09:51:59', '2025-04-17 09:51:59'),
(3287, NULL, 'Amethi', '34', 'active', '2025-04-17 09:51:59', '2025-04-17 09:51:59'),
(3288, NULL, 'Amroha', '34', 'active', '2025-04-17 09:51:59', '2025-04-17 09:51:59'),
(3289, NULL, 'Anandnagar', '34', 'active', '2025-04-17 09:51:59', '2025-04-17 09:51:59'),
(3290, NULL, 'Antu', '34', 'active', '2025-04-17 09:51:59', '2025-04-17 09:51:59'),
(3291, NULL, 'Anupshahr', '34', 'active', '2025-04-17 09:51:59', '2025-04-17 09:51:59'),
(3292, NULL, 'Aonla', '34', 'active', '2025-04-17 09:51:59', '2025-04-17 09:51:59'),
(3293, NULL, 'Araul', '34', 'active', '2025-04-17 09:51:59', '2025-04-17 09:51:59'),
(3294, NULL, 'Asalatganj', '34', 'active', '2025-04-17 09:51:59', '2025-04-17 09:51:59'),
(3295, NULL, 'Atarra', '34', 'active', '2025-04-17 09:51:59', '2025-04-17 09:51:59'),
(3296, NULL, 'Atrauli', '34', 'active', '2025-04-17 09:51:59', '2025-04-17 09:51:59'),
(3297, NULL, 'Atraulia', '34', 'active', '2025-04-17 09:51:59', '2025-04-17 09:51:59'),
(3298, NULL, 'Auraiya', '34', 'active', '2025-04-17 09:51:59', '2025-04-17 09:51:59'),
(3299, NULL, 'Auras', '34', 'active', '2025-04-17 09:51:59', '2025-04-17 09:51:59'),
(3300, NULL, 'Ayodhya', '34', 'active', '2025-04-17 09:51:59', '2025-04-17 09:51:59'),
(3301, NULL, 'Azamgarh', '34', 'active', '2025-04-17 09:51:59', '2025-04-17 09:51:59'),
(3302, NULL, 'Azizpur', '34', 'active', '2025-04-17 09:51:59', '2025-04-17 09:51:59'),
(3303, NULL, 'Baberu', '34', 'active', '2025-04-17 09:52:00', '2025-04-17 09:52:00'),
(3304, NULL, 'Babina', '34', 'active', '2025-04-17 09:52:00', '2025-04-17 09:52:00'),
(3305, NULL, 'Babrala', '34', 'active', '2025-04-17 09:52:00', '2025-04-17 09:52:00'),
(3306, NULL, 'Babugarh', '34', 'active', '2025-04-17 09:52:00', '2025-04-17 09:52:00'),
(3307, NULL, 'Bachhraon', '34', 'active', '2025-04-17 09:52:00', '2025-04-17 09:52:00'),
(3308, NULL, 'Bachhrawan', '34', 'active', '2025-04-17 09:52:00', '2025-04-17 09:52:00'),
(3309, NULL, 'Baghpat', '34', 'active', '2025-04-17 09:52:00', '2025-04-17 09:52:00'),
(3310, NULL, 'Baghra', '34', 'active', '2025-04-17 09:52:00', '2025-04-17 09:52:00'),
(3311, NULL, 'Bah', '34', 'active', '2025-04-17 09:52:00', '2025-04-17 09:52:00'),
(3312, NULL, 'Baheri', '34', 'active', '2025-04-17 09:52:00', '2025-04-17 09:52:00'),
(3313, NULL, 'Bahjoi', '34', 'active', '2025-04-17 09:52:00', '2025-04-17 09:52:00'),
(3314, NULL, 'Bahraich', '34', 'active', '2025-04-17 09:52:00', '2025-04-17 09:52:00'),
(3315, NULL, 'Bahraigh', '34', 'active', '2025-04-17 09:52:00', '2025-04-17 09:52:00'),
(3316, NULL, 'Bahsuma', '34', 'active', '2025-04-17 09:52:00', '2025-04-17 09:52:00'),
(3317, NULL, 'Bahua', '34', 'active', '2025-04-17 09:52:00', '2025-04-17 09:52:00'),
(3318, NULL, 'Bajna', '34', 'active', '2025-04-17 09:52:00', '2025-04-17 09:52:00'),
(3319, NULL, 'Bakewar', '34', 'active', '2025-04-17 09:52:00', '2025-04-17 09:52:00'),
(3320, NULL, 'Baksar', '34', 'active', '2025-04-17 09:52:00', '2025-04-17 09:52:00'),
(3321, NULL, 'Balamau', '34', 'active', '2025-04-17 09:52:00', '2025-04-17 09:52:00'),
(3322, NULL, 'Baldeo', '34', 'active', '2025-04-17 09:52:00', '2025-04-17 09:52:00'),
(3323, NULL, 'Baldev', '34', 'active', '2025-04-17 09:52:00', '2025-04-17 09:52:00'),
(3324, NULL, 'Ballia', '34', 'active', '2025-04-17 09:52:00', '2025-04-17 09:52:00'),
(3325, NULL, 'Balrampur', '34', 'active', '2025-04-17 09:52:00', '2025-04-17 09:52:00'),
(3326, NULL, 'Banat', '34', 'active', '2025-04-17 09:52:00', '2025-04-17 09:52:00'),
(3327, NULL, 'Banbasa', '34', 'active', '2025-04-17 09:52:00', '2025-04-17 09:52:00'),
(3328, NULL, 'Banda', '34', 'active', '2025-04-17 09:52:00', '2025-04-17 09:52:00'),
(3329, NULL, 'Bangarmau', '34', 'active', '2025-04-17 09:52:00', '2025-04-17 09:52:00'),
(3330, NULL, 'Bansdih', '34', 'active', '2025-04-17 09:52:00', '2025-04-17 09:52:00'),
(3331, NULL, 'Bansgaon', '34', 'active', '2025-04-17 09:52:00', '2025-04-17 09:52:00'),
(3332, NULL, 'Bansi', '34', 'active', '2025-04-17 09:52:00', '2025-04-17 09:52:00'),
(3333, NULL, 'Banthra', '34', 'active', '2025-04-17 09:52:00', '2025-04-17 09:52:00'),
(3334, NULL, 'Bara Banki', '34', 'active', '2025-04-17 09:52:00', '2025-04-17 09:52:00'),
(3335, NULL, 'Baragaon', '34', 'active', '2025-04-17 09:52:00', '2025-04-17 09:52:00'),
(3336, NULL, 'Baraut', '34', 'active', '2025-04-17 09:52:00', '2025-04-17 09:52:00'),
(3337, NULL, 'Bareilly', '34', 'active', '2025-04-17 09:52:00', '2025-04-17 09:52:00'),
(3338, NULL, 'Barhalganj', '34', 'active', '2025-04-17 09:52:00', '2025-04-17 09:52:00'),
(3339, NULL, 'Barkhera', '34', 'active', '2025-04-17 09:52:00', '2025-04-17 09:52:00'),
(3340, NULL, 'Barkhera Kalan', '34', 'active', '2025-04-17 09:52:00', '2025-04-17 09:52:00'),
(3341, NULL, 'Barokhar', '34', 'active', '2025-04-17 09:52:00', '2025-04-17 09:52:00'),
(3342, NULL, 'Barsana', '34', 'active', '2025-04-17 09:52:00', '2025-04-17 09:52:00'),
(3343, NULL, 'Barwar (Lakhimpur Kheri)', '34', 'active', '2025-04-17 09:52:00', '2025-04-17 09:52:00'),
(3344, NULL, 'Basti', '34', 'active', '2025-04-17 09:52:00', '2025-04-17 09:52:00'),
(3345, NULL, 'Behat', '34', 'active', '2025-04-17 09:52:00', '2025-04-17 09:52:00'),
(3346, NULL, 'Bela', '34', 'active', '2025-04-17 09:52:00', '2025-04-17 09:52:00'),
(3347, NULL, 'Belthara', '34', 'active', '2025-04-17 09:52:00', '2025-04-17 09:52:00'),
(3348, NULL, 'Beniganj', '34', 'active', '2025-04-17 09:52:00', '2025-04-17 09:52:00'),
(3349, NULL, 'Beswan', '34', 'active', '2025-04-17 09:52:00', '2025-04-17 09:52:00'),
(3350, NULL, 'Bewar', '34', 'active', '2025-04-17 09:52:00', '2025-04-17 09:52:00'),
(3351, NULL, 'Bhadarsa', '34', 'active', '2025-04-17 09:52:00', '2025-04-17 09:52:00'),
(3352, NULL, 'Bhadohi', '34', 'active', '2025-04-17 09:52:00', '2025-04-17 09:52:00'),
(3353, NULL, 'Bhagwantnagar', '34', 'active', '2025-04-17 09:52:00', '2025-04-17 09:52:00'),
(3354, NULL, 'Bharatpura', '34', 'active', '2025-04-17 09:52:00', '2025-04-17 09:52:00'),
(3355, NULL, 'Bhargain', '34', 'active', '2025-04-17 09:52:00', '2025-04-17 09:52:00'),
(3356, NULL, 'Bharthana', '34', 'active', '2025-04-17 09:52:00', '2025-04-17 09:52:00'),
(3357, NULL, 'Bharwari', '34', 'active', '2025-04-17 09:52:00', '2025-04-17 09:52:00'),
(3358, NULL, 'Bhaupur', '34', 'active', '2025-04-17 09:52:00', '2025-04-17 09:52:00'),
(3359, NULL, 'Bhimtal', '34', 'active', '2025-04-17 09:52:00', '2025-04-17 09:52:00'),
(3360, NULL, 'Bhinga', '34', 'active', '2025-04-17 09:52:00', '2025-04-17 09:52:00'),
(3361, NULL, 'Bhognipur', '34', 'active', '2025-04-17 09:52:00', '2025-04-17 09:52:00'),
(3362, NULL, 'Bhongaon', '34', 'active', '2025-04-17 09:52:00', '2025-04-17 09:52:00'),
(3363, NULL, 'Bidhnu', '34', 'active', '2025-04-17 09:52:00', '2025-04-17 09:52:00'),
(3364, NULL, 'Bidhuna', '34', 'active', '2025-04-17 09:52:00', '2025-04-17 09:52:00'),
(3365, NULL, 'Bighapur', '34', 'active', '2025-04-17 09:52:00', '2025-04-17 09:52:00'),
(3366, NULL, 'Bighapur Khurd', '34', 'active', '2025-04-17 09:52:00', '2025-04-17 09:52:00'),
(3367, NULL, 'Bijnor', '34', 'active', '2025-04-17 09:52:00', '2025-04-17 09:52:00'),
(3368, NULL, 'Bikapur', '34', 'active', '2025-04-17 09:52:00', '2025-04-17 09:52:00'),
(3369, NULL, 'Bilari', '34', 'active', '2025-04-17 09:52:00', '2025-04-17 09:52:00'),
(3370, NULL, 'Bilariaganj', '34', 'active', '2025-04-17 09:52:00', '2025-04-17 09:52:00'),
(3371, NULL, 'Bilaspur', '34', 'active', '2025-04-17 09:52:00', '2025-04-17 09:52:00'),
(3372, NULL, 'Bilgram', '34', 'active', '2025-04-17 09:52:00', '2025-04-17 09:52:00'),
(3373, NULL, 'Bilhaur', '34', 'active', '2025-04-17 09:52:00', '2025-04-17 09:52:00'),
(3374, NULL, 'Bilsanda', '34', 'active', '2025-04-17 09:52:00', '2025-04-17 09:52:00'),
(3375, NULL, 'Bilsi', '34', 'active', '2025-04-17 09:52:00', '2025-04-17 09:52:00'),
(3376, NULL, 'Bilthra', '34', 'active', '2025-04-17 09:52:00', '2025-04-17 09:52:00'),
(3377, NULL, 'Binauli', '34', 'active', '2025-04-17 09:52:00', '2025-04-17 09:52:00'),
(3378, NULL, 'Binaur', '34', 'active', '2025-04-17 09:52:00', '2025-04-17 09:52:00'),
(3379, NULL, 'Bindki', '34', 'active', '2025-04-17 09:52:00', '2025-04-17 09:52:00'),
(3380, NULL, 'Birdpur', '34', 'active', '2025-04-17 09:52:00', '2025-04-17 09:52:00'),
(3381, NULL, 'Birpur', '34', 'active', '2025-04-17 09:52:00', '2025-04-17 09:52:00'),
(3382, NULL, 'Bisalpur', '34', 'active', '2025-04-17 09:52:00', '2025-04-17 09:52:00'),
(3383, NULL, 'Bisanda Buzurg', '34', 'active', '2025-04-17 09:52:00', '2025-04-17 09:52:00'),
(3384, NULL, 'Bisauli', '34', 'active', '2025-04-17 09:52:00', '2025-04-17 09:52:00'),
(3385, NULL, 'Bisenda Buzurg', '34', 'active', '2025-04-17 09:52:00', '2025-04-17 09:52:00'),
(3386, NULL, 'Bishunpur Urf Maharajganj', '34', 'active', '2025-04-17 09:52:00', '2025-04-17 09:52:00'),
(3387, NULL, 'Biswan', '34', 'active', '2025-04-17 09:52:00', '2025-04-17 09:52:00'),
(3388, NULL, 'Bithur', '34', 'active', '2025-04-17 09:52:00', '2025-04-17 09:52:00'),
(3389, NULL, 'Budaun', '34', 'active', '2025-04-17 09:52:00', '2025-04-17 09:52:00'),
(3390, NULL, 'Budhana', '34', 'active', '2025-04-17 09:52:00', '2025-04-17 09:52:00'),
(3391, NULL, 'Bulandshahr', '34', 'active', '2025-04-17 09:52:00', '2025-04-17 09:52:00'),
(3392, NULL, 'Captainganj', '34', 'active', '2025-04-17 09:52:00', '2025-04-17 09:52:00'),
(3393, NULL, 'Chail', '34', 'active', '2025-04-17 09:52:00', '2025-04-17 09:52:00'),
(3394, NULL, 'Chakia', '34', 'active', '2025-04-17 09:52:00', '2025-04-17 09:52:00'),
(3395, NULL, 'Chandauli', '34', 'active', '2025-04-17 09:52:00', '2025-04-17 09:52:00'),
(3396, NULL, 'Chandauli District', '34', 'active', '2025-04-17 09:52:00', '2025-04-17 09:52:00'),
(3397, NULL, 'Chandausi', '34', 'active', '2025-04-17 09:52:00', '2025-04-17 09:52:00'),
(3398, NULL, 'Chandpur', '34', 'active', '2025-04-17 09:52:00', '2025-04-17 09:52:00'),
(3399, NULL, 'Chanduasi', '34', 'active', '2025-04-17 09:52:00', '2025-04-17 09:52:00'),
(3400, NULL, 'Charkhari', '34', 'active', '2025-04-17 09:52:00', '2025-04-17 09:52:00'),
(3401, NULL, 'Charthawal', '34', 'active', '2025-04-17 09:52:00', '2025-04-17 09:52:00'),
(3402, NULL, 'Chhaprauli', '34', 'active', '2025-04-17 09:52:00', '2025-04-17 09:52:00'),
(3403, NULL, 'Chharra', '34', 'active', '2025-04-17 09:52:00', '2025-04-17 09:52:00'),
(3404, NULL, 'Chhata', '34', 'active', '2025-04-17 09:52:00', '2025-04-17 09:52:00'),
(3405, NULL, 'Chhibramau', '34', 'active', '2025-04-17 09:52:00', '2025-04-17 09:52:00'),
(3406, NULL, 'Chhitauni', '34', 'active', '2025-04-17 09:52:00', '2025-04-17 09:52:00'),
(3407, NULL, 'Chhutmalpur', '34', 'active', '2025-04-17 09:52:00', '2025-04-17 09:52:00'),
(3408, NULL, 'Chillupar', '34', 'active', '2025-04-17 09:52:00', '2025-04-17 09:52:00'),
(3409, NULL, 'Chirgaon', '34', 'active', '2025-04-17 09:52:00', '2025-04-17 09:52:00'),
(3410, NULL, 'Chitrakoot', '34', 'active', '2025-04-17 09:52:00', '2025-04-17 09:52:00'),
(3411, NULL, 'Chitrakoot Dham', '34', 'active', '2025-04-17 09:52:00', '2025-04-17 09:52:00'),
(3412, NULL, 'Chopan', '34', 'active', '2025-04-17 09:52:00', '2025-04-17 09:52:00'),
(3413, NULL, 'Chunar', '34', 'active', '2025-04-17 09:52:00', '2025-04-17 09:52:00'),
(3414, NULL, 'Churk', '34', 'active', '2025-04-17 09:52:00', '2025-04-17 09:52:00'),
(3415, NULL, 'Colonelganj', '34', 'active', '2025-04-17 09:52:00', '2025-04-17 09:52:00'),
(3416, NULL, 'Dadri', '34', 'active', '2025-04-17 09:52:00', '2025-04-17 09:52:00'),
(3417, NULL, 'Dalmau', '34', 'active', '2025-04-17 09:52:00', '2025-04-17 09:52:00'),
(3418, NULL, 'Dankaur', '34', 'active', '2025-04-17 09:52:00', '2025-04-17 09:52:00'),
(3419, NULL, 'Daraganj', '34', 'active', '2025-04-17 09:52:00', '2025-04-17 09:52:00'),
(3420, NULL, 'Daranagar', '34', 'active', '2025-04-17 09:52:00', '2025-04-17 09:52:00'),
(3421, NULL, 'Dasna', '34', 'active', '2025-04-17 09:52:00', '2025-04-17 09:52:00'),
(3422, NULL, 'Dataganj', '34', 'active', '2025-04-17 09:52:00', '2025-04-17 09:52:00'),
(3423, NULL, 'Daurala', '34', 'active', '2025-04-17 09:52:00', '2025-04-17 09:52:00'),
(3424, NULL, 'Dayal Bagh', '34', 'active', '2025-04-17 09:52:00', '2025-04-17 09:52:00'),
(3425, NULL, 'Deoband', '34', 'active', '2025-04-17 09:52:00', '2025-04-17 09:52:00'),
(3426, NULL, 'Deogarh', '34', 'active', '2025-04-17 09:52:00', '2025-04-17 09:52:00'),
(3427, NULL, 'Deoranian', '34', 'active', '2025-04-17 09:52:00', '2025-04-17 09:52:00'),
(3428, NULL, 'Deoria', '34', 'active', '2025-04-17 09:52:00', '2025-04-17 09:52:00'),
(3429, NULL, 'Derapur', '34', 'active', '2025-04-17 09:52:00', '2025-04-17 09:52:00'),
(3430, NULL, 'Dewa', '34', 'active', '2025-04-17 09:52:00', '2025-04-17 09:52:00'),
(3431, NULL, 'Dhampur', '34', 'active', '2025-04-17 09:52:00', '2025-04-17 09:52:00'),
(3432, NULL, 'Dhanaura', '34', 'active', '2025-04-17 09:52:00', '2025-04-17 09:52:00'),
(3433, NULL, 'Dhanghata', '34', 'active', '2025-04-17 09:52:00', '2025-04-17 09:52:00'),
(3434, NULL, 'Dharau', '34', 'active', '2025-04-17 09:52:00', '2025-04-17 09:52:00'),
(3435, NULL, 'Dhaurahra', '34', 'active', '2025-04-17 09:52:00', '2025-04-17 09:52:00'),
(3436, NULL, 'Dibai', '34', 'active', '2025-04-17 09:52:00', '2025-04-17 09:52:00'),
(3437, NULL, 'Divrasai', '34', 'active', '2025-04-17 09:52:00', '2025-04-17 09:52:00'),
(3438, NULL, 'Dohrighat', '34', 'active', '2025-04-17 09:52:00', '2025-04-17 09:52:00'),
(3439, NULL, 'Domariaganj', '34', 'active', '2025-04-17 09:52:00', '2025-04-17 09:52:00'),
(3440, NULL, 'Dostpur', '34', 'active', '2025-04-17 09:52:00', '2025-04-17 09:52:00'),
(3441, NULL, 'Dudhi', '34', 'active', '2025-04-17 09:52:00', '2025-04-17 09:52:00'),
(3442, NULL, 'Etah', '34', 'active', '2025-04-17 09:52:00', '2025-04-17 09:52:00'),
(3443, NULL, 'Etawah', '34', 'active', '2025-04-17 09:52:00', '2025-04-17 09:52:00'),
(3444, NULL, 'Etmadpur', '34', 'active', '2025-04-17 09:52:00', '2025-04-17 09:52:00'),
(3445, NULL, 'Faizabad', '34', 'active', '2025-04-17 09:52:00', '2025-04-17 09:52:00'),
(3446, NULL, 'Farah', '34', 'active', '2025-04-17 09:52:00', '2025-04-17 09:52:00'),
(3447, NULL, 'Faridnagar', '34', 'active', '2025-04-17 09:52:00', '2025-04-17 09:52:00'),
(3448, NULL, 'Faridpur', '34', 'active', '2025-04-17 09:52:00', '2025-04-17 09:52:00'),
(3449, NULL, 'Farrukhabad', '34', 'active', '2025-04-17 09:52:00', '2025-04-17 09:52:00'),
(3450, NULL, 'Fatehabad', '34', 'active', '2025-04-17 09:52:00', '2025-04-17 09:52:00'),
(3451, NULL, 'Fatehganj West', '34', 'active', '2025-04-17 09:52:00', '2025-04-17 09:52:00'),
(3452, NULL, 'Fatehgarh', '34', 'active', '2025-04-17 09:52:00', '2025-04-17 09:52:00'),
(3453, NULL, 'Fatehpur', '34', 'active', '2025-04-17 09:52:00', '2025-04-17 09:52:00'),
(3454, NULL, 'Fatehpur (Barabanki)', '34', 'active', '2025-04-17 09:52:00', '2025-04-17 09:52:00'),
(3455, NULL, 'Fatehpur Chaurasi', '34', 'active', '2025-04-17 09:52:00', '2025-04-17 09:52:00'),
(3456, NULL, 'Fatehpur Sikri', '34', 'active', '2025-04-17 09:52:00', '2025-04-17 09:52:00'),
(3457, NULL, 'Firozabad', '34', 'active', '2025-04-17 09:52:00', '2025-04-17 09:52:00'),
(3458, NULL, 'Fyzabad', '34', 'active', '2025-04-17 09:52:00', '2025-04-17 09:52:00'),
(3459, NULL, 'Gahlon', '34', 'active', '2025-04-17 09:52:00', '2025-04-17 09:52:00'),
(3460, NULL, 'Gahmar', '34', 'active', '2025-04-17 09:52:00', '2025-04-17 09:52:00'),
(3461, NULL, 'Gaini', '34', 'active', '2025-04-17 09:52:00', '2025-04-17 09:52:00'),
(3462, NULL, 'Gajraula', '34', 'active', '2025-04-17 09:52:00', '2025-04-17 09:52:00'),
(3463, NULL, 'Gangoh', '34', 'active', '2025-04-17 09:52:00', '2025-04-17 09:52:00'),
(3464, NULL, 'Ganj Dundawara', '34', 'active', '2025-04-17 09:52:00', '2025-04-17 09:52:00'),
(3465, NULL, 'Ganj Dundwara', '34', 'active', '2025-04-17 09:52:00', '2025-04-17 09:52:00'),
(3466, NULL, 'Ganj Muradabad', '34', 'active', '2025-04-17 09:52:00', '2025-04-17 09:52:00'),
(3467, NULL, 'Garautha', '34', 'active', '2025-04-17 09:52:00', '2025-04-17 09:52:00'),
(3468, NULL, 'Garhi Pukhta', '34', 'active', '2025-04-17 09:52:00', '2025-04-17 09:52:00'),
(3469, NULL, 'Garhmuktesar', '34', 'active', '2025-04-17 09:52:00', '2025-04-17 09:52:00'),
(3470, NULL, 'Garhwa', '34', 'active', '2025-04-17 09:52:00', '2025-04-17 09:52:00'),
(3471, NULL, 'Gauriganj', '34', 'active', '2025-04-17 09:52:00', '2025-04-17 09:52:00'),
(3472, NULL, 'Gautam Buddha Nagar', '34', 'active', '2025-04-17 09:52:00', '2025-04-17 09:52:00'),
(3473, NULL, 'Gawan', '34', 'active', '2025-04-17 09:52:00', '2025-04-17 09:52:00'),
(3474, NULL, 'Ghatampur', '34', 'active', '2025-04-17 09:52:00', '2025-04-17 09:52:00'),
(3475, NULL, 'Ghaziabad', '34', 'active', '2025-04-17 09:52:00', '2025-04-17 09:52:00'),
(3476, NULL, 'Ghazipur', '34', 'active', '2025-04-17 09:52:00', '2025-04-17 09:52:00'),
(3477, NULL, 'Ghiror', '34', 'active', '2025-04-17 09:52:00', '2025-04-17 09:52:00'),
(3478, NULL, 'Ghorawal', '34', 'active', '2025-04-17 09:52:00', '2025-04-17 09:52:00'),
(3479, NULL, 'Ghosi', '34', 'active', '2025-04-17 09:52:00', '2025-04-17 09:52:00'),
(3480, NULL, 'Gohand', '34', 'active', '2025-04-17 09:52:00', '2025-04-17 09:52:00'),
(3481, NULL, 'Gokul', '34', 'active', '2025-04-17 09:52:00', '2025-04-17 09:52:00'),
(3482, NULL, 'Gola Bazar', '34', 'active', '2025-04-17 09:52:00', '2025-04-17 09:52:00'),
(3483, NULL, 'Gola Gokarannath', '34', 'active', '2025-04-17 09:52:00', '2025-04-17 09:52:00'),
(3484, NULL, 'Gonda', '34', 'active', '2025-04-17 09:52:00', '2025-04-17 09:52:00'),
(3485, NULL, 'Gopamau', '34', 'active', '2025-04-17 09:52:00', '2025-04-17 09:52:00'),
(3486, NULL, 'Gorakhpur', '34', 'active', '2025-04-17 09:52:00', '2025-04-17 09:52:00'),
(3487, NULL, 'Gosainganj', '34', 'active', '2025-04-17 09:52:00', '2025-04-17 09:52:00'),
(3488, NULL, 'Goshainganj', '34', 'active', '2025-04-17 09:52:00', '2025-04-17 09:52:00');
INSERT INTO `module_cities` (`id`, `slug`, `city_name`, `state_name`, `status`, `created_at`, `updated_at`) VALUES
(3489, NULL, 'Govardhan', '34', 'active', '2025-04-17 09:52:00', '2025-04-17 09:52:00'),
(3490, NULL, 'Greater Noida', '34', 'active', '2025-04-17 09:52:00', '2025-04-17 09:52:00'),
(3491, NULL, 'Gulaothi', '34', 'active', '2025-04-17 09:52:00', '2025-04-17 09:52:00'),
(3492, NULL, 'Gunnaur', '34', 'active', '2025-04-17 09:52:00', '2025-04-17 09:52:00'),
(3493, NULL, 'Gursahaiganj', '34', 'active', '2025-04-17 09:52:00', '2025-04-17 09:52:00'),
(3494, NULL, 'Gursarai', '34', 'active', '2025-04-17 09:52:00', '2025-04-17 09:52:00'),
(3495, NULL, 'Gyanpur', '34', 'active', '2025-04-17 09:52:00', '2025-04-17 09:52:00'),
(3496, NULL, 'Haldaur', '34', 'active', '2025-04-17 09:52:00', '2025-04-17 09:52:00'),
(3497, NULL, 'Hamirpur', '34', 'active', '2025-04-17 09:52:00', '2025-04-17 09:52:00'),
(3498, NULL, 'Handia', '34', 'active', '2025-04-17 09:52:00', '2025-04-17 09:52:00'),
(3499, NULL, 'Hapur', '34', 'active', '2025-04-17 09:52:00', '2025-04-17 09:52:00'),
(3500, NULL, 'Haraipur', '34', 'active', '2025-04-17 09:52:00', '2025-04-17 09:52:00'),
(3501, NULL, 'Haraiya', '34', 'active', '2025-04-17 09:52:00', '2025-04-17 09:52:00'),
(3502, NULL, 'Harchandpur', '34', 'active', '2025-04-17 09:52:00', '2025-04-17 09:52:00'),
(3503, NULL, 'Hardoi', '34', 'active', '2025-04-17 09:52:00', '2025-04-17 09:52:00'),
(3504, NULL, 'Harduaganj', '34', 'active', '2025-04-17 09:52:00', '2025-04-17 09:52:00'),
(3505, NULL, 'Hasanpur', '34', 'active', '2025-04-17 09:52:00', '2025-04-17 09:52:00'),
(3506, NULL, 'Hastinapur', '34', 'active', '2025-04-17 09:52:00', '2025-04-17 09:52:00'),
(3507, NULL, 'Hata', '34', 'active', '2025-04-17 09:52:00', '2025-04-17 09:52:00'),
(3508, NULL, 'Hata (India)', '34', 'active', '2025-04-17 09:52:00', '2025-04-17 09:52:00'),
(3509, NULL, 'Hathras', '34', 'active', '2025-04-17 09:52:00', '2025-04-17 09:52:00'),
(3510, NULL, 'Hulas', '34', 'active', '2025-04-17 09:52:00', '2025-04-17 09:52:00'),
(3511, NULL, 'Ibrahimpur', '34', 'active', '2025-04-17 09:52:00', '2025-04-17 09:52:00'),
(3512, NULL, 'Iglas', '34', 'active', '2025-04-17 09:52:00', '2025-04-17 09:52:00'),
(3513, NULL, 'Ikauna', '34', 'active', '2025-04-17 09:52:00', '2025-04-17 09:52:00'),
(3514, NULL, 'Indergarh', '34', 'active', '2025-04-17 09:52:00', '2025-04-17 09:52:00'),
(3515, NULL, 'Indragarh', '34', 'active', '2025-04-17 09:52:00', '2025-04-17 09:52:00'),
(3516, NULL, 'Islamnagar', '34', 'active', '2025-04-17 09:52:00', '2025-04-17 09:52:00'),
(3517, NULL, 'Islamnagar (Badaun)', '34', 'active', '2025-04-17 09:52:00', '2025-04-17 09:52:00'),
(3518, NULL, 'Itaunja', '34', 'active', '2025-04-17 09:52:00', '2025-04-17 09:52:00'),
(3519, NULL, 'Itimadpur', '34', 'active', '2025-04-17 09:52:00', '2025-04-17 09:52:00'),
(3520, NULL, 'Jagdishpur', '34', 'active', '2025-04-17 09:52:00', '2025-04-17 09:52:00'),
(3521, NULL, 'Jagnair', '34', 'active', '2025-04-17 09:52:00', '2025-04-17 09:52:00'),
(3522, NULL, 'Jahanabad', '34', 'active', '2025-04-17 09:52:00', '2025-04-17 09:52:00'),
(3523, NULL, 'Jahanabad (Pilibhit)', '34', 'active', '2025-04-17 09:52:00', '2025-04-17 09:52:00'),
(3524, NULL, 'Jahangirabad', '34', 'active', '2025-04-17 09:52:00', '2025-04-17 09:52:00'),
(3525, NULL, 'Jahangirpur', '34', 'active', '2025-04-17 09:52:00', '2025-04-17 09:52:00'),
(3526, NULL, 'Jainpur', '34', 'active', '2025-04-17 09:52:00', '2025-04-17 09:52:00'),
(3527, NULL, 'Jais', '34', 'active', '2025-04-17 09:52:00', '2025-04-17 09:52:00'),
(3528, NULL, 'Jalalabad', '34', 'active', '2025-04-17 09:52:00', '2025-04-17 09:52:00'),
(3529, NULL, 'Jalali', '34', 'active', '2025-04-17 09:52:00', '2025-04-17 09:52:00'),
(3530, NULL, 'Jalalpur', '34', 'active', '2025-04-17 09:52:00', '2025-04-17 09:52:00'),
(3531, NULL, 'Jalaun', '34', 'active', '2025-04-17 09:52:00', '2025-04-17 09:52:00'),
(3532, NULL, 'Jalesar', '34', 'active', '2025-04-17 09:52:00', '2025-04-17 09:52:00'),
(3533, NULL, 'Janghai', '34', 'active', '2025-04-17 09:52:00', '2025-04-17 09:52:00'),
(3534, NULL, 'Jansath', '34', 'active', '2025-04-17 09:52:00', '2025-04-17 09:52:00'),
(3535, NULL, 'Jarwa', '34', 'active', '2025-04-17 09:52:00', '2025-04-17 09:52:00'),
(3536, NULL, 'Jarwal', '34', 'active', '2025-04-17 09:52:00', '2025-04-17 09:52:00'),
(3537, NULL, 'Jasrana', '34', 'active', '2025-04-17 09:52:00', '2025-04-17 09:52:00'),
(3538, NULL, 'Jaswantnagar', '34', 'active', '2025-04-17 09:52:00', '2025-04-17 09:52:00'),
(3539, NULL, 'Jaunpur', '34', 'active', '2025-04-17 09:52:00', '2025-04-17 09:52:00'),
(3540, NULL, 'Jewar', '34', 'active', '2025-04-17 09:52:00', '2025-04-17 09:52:00'),
(3541, NULL, 'Jhajhar', '34', 'active', '2025-04-17 09:52:00', '2025-04-17 09:52:00'),
(3542, NULL, 'Jhalu', '34', 'active', '2025-04-17 09:52:00', '2025-04-17 09:52:00'),
(3543, NULL, 'Jhansi', '34', 'active', '2025-04-17 09:52:00', '2025-04-17 09:52:00'),
(3544, NULL, 'Jhinjhak', '34', 'active', '2025-04-17 09:52:00', '2025-04-17 09:52:00'),
(3545, NULL, 'Jhinjhana', '34', 'active', '2025-04-17 09:52:00', '2025-04-17 09:52:00'),
(3546, NULL, 'Jhusi', '34', 'active', '2025-04-17 09:52:00', '2025-04-17 09:52:00'),
(3547, NULL, 'Jiyanpur', '34', 'active', '2025-04-17 09:52:00', '2025-04-17 09:52:00'),
(3548, NULL, 'Jyotiba Phule Nagar', '34', 'active', '2025-04-17 09:52:00', '2025-04-17 09:52:00'),
(3549, NULL, 'Kabrai', '34', 'active', '2025-04-17 09:52:00', '2025-04-17 09:52:00'),
(3550, NULL, 'Kachhwa', '34', 'active', '2025-04-17 09:52:00', '2025-04-17 09:52:00'),
(3551, NULL, 'Kadaura', '34', 'active', '2025-04-17 09:52:00', '2025-04-17 09:52:00'),
(3552, NULL, 'Kadipur', '34', 'active', '2025-04-17 09:52:00', '2025-04-17 09:52:00'),
(3553, NULL, 'Kagarol', '34', 'active', '2025-04-17 09:52:00', '2025-04-17 09:52:00'),
(3554, NULL, 'Kaimganj', '34', 'active', '2025-04-17 09:52:00', '2025-04-17 09:52:00'),
(3555, NULL, 'Kairana', '34', 'active', '2025-04-17 09:52:00', '2025-04-17 09:52:00'),
(3556, NULL, 'Kakori', '34', 'active', '2025-04-17 09:52:00', '2025-04-17 09:52:00'),
(3557, NULL, 'Kakrala', '34', 'active', '2025-04-17 09:52:00', '2025-04-17 09:52:00'),
(3558, NULL, 'Kalinagar', '34', 'active', '2025-04-17 09:52:00', '2025-04-17 09:52:00'),
(3559, NULL, 'Kalpi', '34', 'active', '2025-04-17 09:52:00', '2025-04-17 09:52:00'),
(3560, NULL, 'Kalyanpur', '34', 'active', '2025-04-17 09:52:00', '2025-04-17 09:52:00'),
(3561, NULL, 'Kamalganj', '34', 'active', '2025-04-17 09:52:00', '2025-04-17 09:52:00'),
(3562, NULL, 'Kampil', '34', 'active', '2025-04-17 09:52:00', '2025-04-17 09:52:00'),
(3563, NULL, 'Kandhla', '34', 'active', '2025-04-17 09:52:00', '2025-04-17 09:52:00'),
(3564, NULL, 'Kannauj', '34', 'active', '2025-04-17 09:52:00', '2025-04-17 09:52:00'),
(3565, NULL, 'Kanpur', '34', 'active', '2025-04-17 09:52:00', '2025-04-17 09:52:00'),
(3566, NULL, 'Kanpur Dehat', '34', 'active', '2025-04-17 09:52:00', '2025-04-17 09:52:00'),
(3567, NULL, 'Kant', '34', 'active', '2025-04-17 09:52:00', '2025-04-17 09:52:00'),
(3568, NULL, 'Kanth', '34', 'active', '2025-04-17 09:52:00', '2025-04-17 09:52:00'),
(3569, NULL, 'Kaptanganj', '34', 'active', '2025-04-17 09:52:00', '2025-04-17 09:52:00'),
(3570, NULL, 'Kara', '34', 'active', '2025-04-17 09:52:00', '2025-04-17 09:52:00'),
(3571, NULL, 'Karari', '34', 'active', '2025-04-17 09:52:00', '2025-04-17 09:52:00'),
(3572, NULL, 'Karbigwan', '34', 'active', '2025-04-17 09:52:00', '2025-04-17 09:52:00'),
(3573, NULL, 'Karchana', '34', 'active', '2025-04-17 09:52:00', '2025-04-17 09:52:00'),
(3574, NULL, 'Karhal', '34', 'active', '2025-04-17 09:52:00', '2025-04-17 09:52:00'),
(3575, NULL, 'Kasganj', '34', 'active', '2025-04-17 09:52:00', '2025-04-17 09:52:00'),
(3576, NULL, 'Katra', '34', 'active', '2025-04-17 09:52:00', '2025-04-17 09:52:00'),
(3577, NULL, 'Kausani', '34', 'active', '2025-04-17 09:52:00', '2025-04-17 09:52:00'),
(3578, NULL, 'Kaushambi District', '34', 'active', '2025-04-17 09:52:00', '2025-04-17 09:52:00'),
(3579, NULL, 'Kemri', '34', 'active', '2025-04-17 09:52:00', '2025-04-17 09:52:00'),
(3580, NULL, 'Khada', '34', 'active', '2025-04-17 09:52:00', '2025-04-17 09:52:00'),
(3581, NULL, 'Khaga', '34', 'active', '2025-04-17 09:52:00', '2025-04-17 09:52:00'),
(3582, NULL, 'Khailar', '34', 'active', '2025-04-17 09:52:00', '2025-04-17 09:52:00'),
(3583, NULL, 'Khair', '34', 'active', '2025-04-17 09:52:00', '2025-04-17 09:52:00'),
(3584, NULL, 'Khairabad', '34', 'active', '2025-04-17 09:52:00', '2025-04-17 09:52:00'),
(3585, NULL, 'Khalilabad', '34', 'active', '2025-04-17 09:52:00', '2025-04-17 09:52:00'),
(3586, NULL, 'Khanpur', '34', 'active', '2025-04-17 09:52:00', '2025-04-17 09:52:00'),
(3587, NULL, 'Kharela', '34', 'active', '2025-04-17 09:52:00', '2025-04-17 09:52:00'),
(3588, NULL, 'Khargupur', '34', 'active', '2025-04-17 09:52:00', '2025-04-17 09:52:00'),
(3589, NULL, 'Kharkhauda', '34', 'active', '2025-04-17 09:52:00', '2025-04-17 09:52:00'),
(3590, NULL, 'Khatauli', '34', 'active', '2025-04-17 09:52:00', '2025-04-17 09:52:00'),
(3591, NULL, 'Khekra', '34', 'active', '2025-04-17 09:52:00', '2025-04-17 09:52:00'),
(3592, NULL, 'Kheri', '34', 'active', '2025-04-17 09:52:00', '2025-04-17 09:52:00'),
(3593, NULL, 'Khudaganj', '34', 'active', '2025-04-17 09:52:00', '2025-04-17 09:52:00'),
(3594, NULL, 'Khurja', '34', 'active', '2025-04-17 09:52:00', '2025-04-17 09:52:00'),
(3595, NULL, 'Khutar', '34', 'active', '2025-04-17 09:52:00', '2025-04-17 09:52:00'),
(3596, NULL, 'Kirakat', '34', 'active', '2025-04-17 09:52:00', '2025-04-17 09:52:00'),
(3597, NULL, 'Kiraoli', '34', 'active', '2025-04-17 09:52:00', '2025-04-17 09:52:00'),
(3598, NULL, 'Kiratpur', '34', 'active', '2025-04-17 09:52:00', '2025-04-17 09:52:00'),
(3599, NULL, 'Kishanpur', '34', 'active', '2025-04-17 09:52:00', '2025-04-17 09:52:00'),
(3600, NULL, 'Kishanpur baral', '34', 'active', '2025-04-17 09:52:00', '2025-04-17 09:52:00'),
(3601, NULL, 'Kishni', '34', 'active', '2025-04-17 09:52:00', '2025-04-17 09:52:00'),
(3602, NULL, 'Kithor', '34', 'active', '2025-04-17 09:52:00', '2025-04-17 09:52:00'),
(3603, NULL, 'Konch', '34', 'active', '2025-04-17 09:52:00', '2025-04-17 09:52:00'),
(3604, NULL, 'Kopaganj', '34', 'active', '2025-04-17 09:52:00', '2025-04-17 09:52:00'),
(3605, NULL, 'Kosi', '34', 'active', '2025-04-17 09:52:00', '2025-04-17 09:52:00'),
(3606, NULL, 'Kota', '34', 'active', '2025-04-17 09:52:00', '2025-04-17 09:52:00'),
(3607, NULL, 'Kotra', '34', 'active', '2025-04-17 09:52:00', '2025-04-17 09:52:00'),
(3608, NULL, 'Kuchesar', '34', 'active', '2025-04-17 09:52:00', '2025-04-17 09:52:00'),
(3609, NULL, 'Kudarkot', '34', 'active', '2025-04-17 09:52:00', '2025-04-17 09:52:00'),
(3610, NULL, 'Kulpahar', '34', 'active', '2025-04-17 09:52:00', '2025-04-17 09:52:00'),
(3611, NULL, 'Kunda', '34', 'active', '2025-04-17 09:52:00', '2025-04-17 09:52:00'),
(3612, NULL, 'Kundarkhi', '34', 'active', '2025-04-17 09:52:00', '2025-04-17 09:52:00'),
(3613, NULL, 'Kundarki', '34', 'active', '2025-04-17 09:52:00', '2025-04-17 09:52:00'),
(3614, NULL, 'Kurara', '34', 'active', '2025-04-17 09:52:00', '2025-04-17 09:52:00'),
(3615, NULL, 'Kurebharsaidkhanpur', '34', 'active', '2025-04-17 09:52:00', '2025-04-17 09:52:00'),
(3616, NULL, 'Kushinagar', '34', 'active', '2025-04-17 09:52:00', '2025-04-17 09:52:00'),
(3617, NULL, 'Kusmara', '34', 'active', '2025-04-17 09:52:00', '2025-04-17 09:52:00'),
(3618, NULL, 'Kuthaund', '34', 'active', '2025-04-17 09:52:00', '2025-04-17 09:52:00'),
(3619, NULL, 'Laharpur', '34', 'active', '2025-04-17 09:52:00', '2025-04-17 09:52:00'),
(3620, NULL, 'Lakhimpur', '34', 'active', '2025-04-17 09:52:00', '2025-04-17 09:52:00'),
(3621, NULL, 'Lakhna', '34', 'active', '2025-04-17 09:52:00', '2025-04-17 09:52:00'),
(3622, NULL, 'Lalganj', '34', 'active', '2025-04-17 09:52:00', '2025-04-17 09:52:00'),
(3623, NULL, 'Lalitpur', '34', 'active', '2025-04-17 09:52:00', '2025-04-17 09:52:00'),
(3624, NULL, 'Lambhua', '34', 'active', '2025-04-17 09:52:00', '2025-04-17 09:52:00'),
(3625, NULL, 'Lar', '34', 'active', '2025-04-17 09:52:00', '2025-04-17 09:52:00'),
(3626, NULL, 'Lawar', '34', 'active', '2025-04-17 09:52:00', '2025-04-17 09:52:00'),
(3627, NULL, 'Lawar Khas', '34', 'active', '2025-04-17 09:52:00', '2025-04-17 09:52:00'),
(3628, NULL, 'Loni', '34', 'active', '2025-04-17 09:52:00', '2025-04-17 09:52:00'),
(3629, NULL, 'Lucknow', '34', 'active', '2025-04-17 09:52:00', '2025-04-17 09:52:00'),
(3630, NULL, 'Lucknow District', '34', 'active', '2025-04-17 09:52:00', '2025-04-17 09:52:00'),
(3631, NULL, 'Machhali Shahar', '34', 'active', '2025-04-17 09:52:00', '2025-04-17 09:52:00'),
(3632, NULL, 'Machhlishahr', '34', 'active', '2025-04-17 09:52:00', '2025-04-17 09:52:00'),
(3633, NULL, 'Madhoganj', '34', 'active', '2025-04-17 09:52:00', '2025-04-17 09:52:00'),
(3634, NULL, 'Madhogarh', '34', 'active', '2025-04-17 09:52:00', '2025-04-17 09:52:00'),
(3635, NULL, 'Maghar', '34', 'active', '2025-04-17 09:52:00', '2025-04-17 09:52:00'),
(3636, NULL, 'Mahaban', '34', 'active', '2025-04-17 09:52:00', '2025-04-17 09:52:00'),
(3637, NULL, 'Maharajganj', '34', 'active', '2025-04-17 09:52:00', '2025-04-17 09:52:00'),
(3638, NULL, 'Mahmudabad', '34', 'active', '2025-04-17 09:52:00', '2025-04-17 09:52:00'),
(3639, NULL, 'Mahoba', '34', 'active', '2025-04-17 09:52:00', '2025-04-17 09:52:00'),
(3640, NULL, 'Maholi', '34', 'active', '2025-04-17 09:52:00', '2025-04-17 09:52:00'),
(3641, NULL, 'Mahrajganj', '34', 'active', '2025-04-17 09:52:00', '2025-04-17 09:52:00'),
(3642, NULL, 'Mahrajganj (Raebareli)', '34', 'active', '2025-04-17 09:52:00', '2025-04-17 09:52:00'),
(3643, NULL, 'Mahroni', '34', 'active', '2025-04-17 09:52:00', '2025-04-17 09:52:00'),
(3644, NULL, 'Mahul', '34', 'active', '2025-04-17 09:52:00', '2025-04-17 09:52:00'),
(3645, NULL, 'Mailani', '34', 'active', '2025-04-17 09:52:00', '2025-04-17 09:52:00'),
(3646, NULL, 'Mainpuri', '34', 'active', '2025-04-17 09:52:00', '2025-04-17 09:52:00'),
(3647, NULL, 'Majhupur', '34', 'active', '2025-04-17 09:52:00', '2025-04-17 09:52:00'),
(3648, NULL, 'Makanpur', '34', 'active', '2025-04-17 09:52:00', '2025-04-17 09:52:00'),
(3649, NULL, 'Malasa', '34', 'active', '2025-04-17 09:52:00', '2025-04-17 09:52:00'),
(3650, NULL, 'Malihabad', '34', 'active', '2025-04-17 09:52:00', '2025-04-17 09:52:00'),
(3651, NULL, 'Mandawar', '34', 'active', '2025-04-17 09:52:00', '2025-04-17 09:52:00'),
(3652, NULL, 'Maniar', '34', 'active', '2025-04-17 09:52:00', '2025-04-17 09:52:00'),
(3653, NULL, 'Manikpur', '34', 'active', '2025-04-17 09:52:00', '2025-04-17 09:52:00'),
(3654, NULL, 'Manjhanpur', '34', 'active', '2025-04-17 09:52:00', '2025-04-17 09:52:00'),
(3655, NULL, 'Mankapur', '34', 'active', '2025-04-17 09:52:00', '2025-04-17 09:52:00'),
(3656, NULL, 'Marahra', '34', 'active', '2025-04-17 09:52:00', '2025-04-17 09:52:00'),
(3657, NULL, 'Mariahu', '34', 'active', '2025-04-17 09:52:00', '2025-04-17 09:52:00'),
(3658, NULL, 'Mataundh', '34', 'active', '2025-04-17 09:52:00', '2025-04-17 09:52:00'),
(3659, NULL, 'Mathura', '34', 'active', '2025-04-17 09:52:00', '2025-04-17 09:52:00'),
(3660, NULL, 'Mau', '34', 'active', '2025-04-17 09:52:00', '2025-04-17 09:52:00'),
(3661, NULL, 'Mau Aima', '34', 'active', '2025-04-17 09:52:00', '2025-04-17 09:52:00'),
(3662, NULL, 'Mau Aimma', '34', 'active', '2025-04-17 09:52:00', '2025-04-17 09:52:00'),
(3663, NULL, 'Maudaha', '34', 'active', '2025-04-17 09:52:00', '2025-04-17 09:52:00'),
(3664, NULL, 'Maurawan', '34', 'active', '2025-04-17 09:52:00', '2025-04-17 09:52:00'),
(3665, NULL, 'Mawana', '34', 'active', '2025-04-17 09:52:00', '2025-04-17 09:52:00'),
(3666, NULL, 'Mawar', '34', 'active', '2025-04-17 09:52:00', '2025-04-17 09:52:00'),
(3667, NULL, 'Meerut', '34', 'active', '2025-04-17 09:52:00', '2025-04-17 09:52:00'),
(3668, NULL, 'Mehdawal', '34', 'active', '2025-04-17 09:52:00', '2025-04-17 09:52:00'),
(3669, NULL, 'Mehnagar', '34', 'active', '2025-04-17 09:52:00', '2025-04-17 09:52:00'),
(3670, NULL, 'Mehndawal', '34', 'active', '2025-04-17 09:52:00', '2025-04-17 09:52:00'),
(3671, NULL, 'Milak', '34', 'active', '2025-04-17 09:52:00', '2025-04-17 09:52:00'),
(3672, NULL, 'Milkipur', '34', 'active', '2025-04-17 09:52:00', '2025-04-17 09:52:00'),
(3673, NULL, 'Miranpur', '34', 'active', '2025-04-17 09:52:00', '2025-04-17 09:52:00'),
(3674, NULL, 'Miranpur Katra', '34', 'active', '2025-04-17 09:52:00', '2025-04-17 09:52:00'),
(3675, NULL, 'Mirganj', '34', 'active', '2025-04-17 09:52:00', '2025-04-17 09:52:00'),
(3676, NULL, 'Mirzapur', '34', 'active', '2025-04-17 09:52:00', '2025-04-17 09:52:00'),
(3677, NULL, 'Misrikh', '34', 'active', '2025-04-17 09:52:00', '2025-04-17 09:52:00'),
(3678, NULL, 'Mohan', '34', 'active', '2025-04-17 09:52:00', '2025-04-17 09:52:00'),
(3679, NULL, 'Mohanpur', '34', 'active', '2025-04-17 09:52:00', '2025-04-17 09:52:00'),
(3680, NULL, 'Moradabad', '34', 'active', '2025-04-17 09:52:00', '2025-04-17 09:52:00'),
(3681, NULL, 'Moth', '34', 'active', '2025-04-17 09:52:00', '2025-04-17 09:52:00'),
(3682, NULL, 'Mubarakpur', '34', 'active', '2025-04-17 09:52:00', '2025-04-17 09:52:00'),
(3683, NULL, 'Mughal Sarai', '34', 'active', '2025-04-17 09:52:00', '2025-04-17 09:52:00'),
(3684, NULL, 'Muhammadabad', '34', 'active', '2025-04-17 09:52:00', '2025-04-17 09:52:00'),
(3685, NULL, 'Mukteshwar', '34', 'active', '2025-04-17 09:52:00', '2025-04-17 09:52:00'),
(3686, NULL, 'Mungra Badshahpur', '34', 'active', '2025-04-17 09:52:00', '2025-04-17 09:52:00'),
(3687, NULL, 'Munsyari', '34', 'active', '2025-04-17 09:52:00', '2025-04-17 09:52:00'),
(3688, NULL, 'Muradabad', '34', 'active', '2025-04-17 09:52:00', '2025-04-17 09:52:00'),
(3689, NULL, 'Muradnagar', '34', 'active', '2025-04-17 09:52:00', '2025-04-17 09:52:00'),
(3690, NULL, 'Mursan', '34', 'active', '2025-04-17 09:52:00', '2025-04-17 09:52:00'),
(3691, NULL, 'Musafir-Khana', '34', 'active', '2025-04-17 09:52:00', '2025-04-17 09:52:00'),
(3692, NULL, 'Musafirkhana', '34', 'active', '2025-04-17 09:52:00', '2025-04-17 09:52:00'),
(3693, NULL, 'Muzaffarnagar', '34', 'active', '2025-04-17 09:52:00', '2025-04-17 09:52:00'),
(3694, NULL, 'Nadigaon', '34', 'active', '2025-04-17 09:52:00', '2025-04-17 09:52:00'),
(3695, NULL, 'Nagina', '34', 'active', '2025-04-17 09:52:00', '2025-04-17 09:52:00'),
(3696, NULL, 'Nagla', '34', 'active', '2025-04-17 09:52:00', '2025-04-17 09:52:00'),
(3697, NULL, 'Nagram', '34', 'active', '2025-04-17 09:52:00', '2025-04-17 09:52:00'),
(3698, NULL, 'Najibabad', '34', 'active', '2025-04-17 09:52:00', '2025-04-17 09:52:00'),
(3699, NULL, 'Nakur', '34', 'active', '2025-04-17 09:52:00', '2025-04-17 09:52:00'),
(3700, NULL, 'Nanauta', '34', 'active', '2025-04-17 09:52:00', '2025-04-17 09:52:00'),
(3701, NULL, 'Nandgaon', '34', 'active', '2025-04-17 09:52:00', '2025-04-17 09:52:00'),
(3702, NULL, 'Nanpara', '34', 'active', '2025-04-17 09:52:00', '2025-04-17 09:52:00'),
(3703, NULL, 'Narauli', '34', 'active', '2025-04-17 09:52:00', '2025-04-17 09:52:00'),
(3704, NULL, 'Naraura', '34', 'active', '2025-04-17 09:52:00', '2025-04-17 09:52:00'),
(3705, NULL, 'Narora', '34', 'active', '2025-04-17 09:52:00', '2025-04-17 09:52:00'),
(3706, NULL, 'Naugama', '34', 'active', '2025-04-17 09:52:00', '2025-04-17 09:52:00'),
(3707, NULL, 'Naurangpur', '34', 'active', '2025-04-17 09:52:00', '2025-04-17 09:52:00'),
(3708, NULL, 'Nautanwa', '34', 'active', '2025-04-17 09:52:00', '2025-04-17 09:52:00'),
(3709, NULL, 'Nawabganj', '34', 'active', '2025-04-17 09:52:00', '2025-04-17 09:52:00'),
(3710, NULL, 'Nawabganj (Barabanki)', '34', 'active', '2025-04-17 09:52:00', '2025-04-17 09:52:00'),
(3711, NULL, 'Nawabganj (Bareilly)', '34', 'active', '2025-04-17 09:52:00', '2025-04-17 09:52:00'),
(3712, NULL, 'Newara', '34', 'active', '2025-04-17 09:52:00', '2025-04-17 09:52:00'),
(3713, NULL, 'Nichlaul', '34', 'active', '2025-04-17 09:52:00', '2025-04-17 09:52:00'),
(3714, NULL, 'Nigoh', '34', 'active', '2025-04-17 09:52:00', '2025-04-17 09:52:00'),
(3715, NULL, 'Nihtaur', '34', 'active', '2025-04-17 09:52:00', '2025-04-17 09:52:00'),
(3716, NULL, 'Niwari', '34', 'active', '2025-04-17 09:52:00', '2025-04-17 09:52:00'),
(3717, NULL, 'Nizamabad', '34', 'active', '2025-04-17 09:52:00', '2025-04-17 09:52:00'),
(3718, NULL, 'Noida', '34', 'active', '2025-04-17 09:52:00', '2025-04-17 09:52:00'),
(3719, NULL, 'Nurpur', '34', 'active', '2025-04-17 09:52:00', '2025-04-17 09:52:00'),
(3720, NULL, 'Obra', '34', 'active', '2025-04-17 09:52:00', '2025-04-17 09:52:00'),
(3721, NULL, 'Orai', '34', 'active', '2025-04-17 09:52:00', '2025-04-17 09:52:00'),
(3722, NULL, 'Oran', '34', 'active', '2025-04-17 09:52:00', '2025-04-17 09:52:00'),
(3723, NULL, 'Pachperwa', '34', 'active', '2025-04-17 09:52:00', '2025-04-17 09:52:00'),
(3724, NULL, 'Padrauna', '34', 'active', '2025-04-17 09:52:00', '2025-04-17 09:52:00'),
(3725, NULL, 'Pahasu', '34', 'active', '2025-04-17 09:52:00', '2025-04-17 09:52:00'),
(3726, NULL, 'Paigaon', '34', 'active', '2025-04-17 09:52:00', '2025-04-17 09:52:00'),
(3727, NULL, 'Pali', '34', 'active', '2025-04-17 09:52:00', '2025-04-17 09:52:00'),
(3728, NULL, 'Palia Kalan', '34', 'active', '2025-04-17 09:52:00', '2025-04-17 09:52:00'),
(3729, NULL, 'Paras Rampur', '34', 'active', '2025-04-17 09:52:00', '2025-04-17 09:52:00'),
(3730, NULL, 'Parichha', '34', 'active', '2025-04-17 09:52:00', '2025-04-17 09:52:00'),
(3731, NULL, 'Parichhatgarh', '34', 'active', '2025-04-17 09:52:00', '2025-04-17 09:52:00'),
(3732, NULL, 'Parshadepur', '34', 'active', '2025-04-17 09:52:00', '2025-04-17 09:52:00'),
(3733, NULL, 'Pathakpura', '34', 'active', '2025-04-17 09:52:00', '2025-04-17 09:52:00'),
(3734, NULL, 'Patiali', '34', 'active', '2025-04-17 09:52:00', '2025-04-17 09:52:00'),
(3735, NULL, 'Patti', '34', 'active', '2025-04-17 09:52:00', '2025-04-17 09:52:00'),
(3736, NULL, 'Pawayan', '34', 'active', '2025-04-17 09:52:00', '2025-04-17 09:52:00'),
(3737, NULL, 'Payagpur', '34', 'active', '2025-04-17 09:52:00', '2025-04-17 09:52:00'),
(3738, NULL, 'Phalauda', '34', 'active', '2025-04-17 09:52:00', '2025-04-17 09:52:00'),
(3739, NULL, 'Phaphamau', '34', 'active', '2025-04-17 09:52:00', '2025-04-17 09:52:00'),
(3740, NULL, 'Phaphund', '34', 'active', '2025-04-17 09:52:00', '2025-04-17 09:52:00'),
(3741, NULL, 'Phariha', '34', 'active', '2025-04-17 09:52:00', '2025-04-17 09:52:00'),
(3742, NULL, 'Pheona', '34', 'active', '2025-04-17 09:52:00', '2025-04-17 09:52:00'),
(3743, NULL, 'Phulpur', '34', 'active', '2025-04-17 09:52:00', '2025-04-17 09:52:00'),
(3744, NULL, 'Pichhaura', '34', 'active', '2025-04-17 09:52:00', '2025-04-17 09:52:00'),
(3745, NULL, 'Pihani', '34', 'active', '2025-04-17 09:52:00', '2025-04-17 09:52:00'),
(3746, NULL, 'Pilibhit', '34', 'active', '2025-04-17 09:52:00', '2025-04-17 09:52:00'),
(3747, NULL, 'Pilkhua', '34', 'active', '2025-04-17 09:52:00', '2025-04-17 09:52:00'),
(3748, NULL, 'Pilkhuwa', '34', 'active', '2025-04-17 09:52:00', '2025-04-17 09:52:00'),
(3749, NULL, 'Pinahat', '34', 'active', '2025-04-17 09:52:00', '2025-04-17 09:52:00'),
(3750, NULL, 'Pipraich', '34', 'active', '2025-04-17 09:52:00', '2025-04-17 09:52:00'),
(3751, NULL, 'Pipri', '34', 'active', '2025-04-17 09:52:00', '2025-04-17 09:52:00'),
(3752, NULL, 'Pratapgarh', '34', 'active', '2025-04-17 09:52:00', '2025-04-17 09:52:00'),
(3753, NULL, 'Prayagraj (Allahabad)', '34', 'active', '2025-04-17 09:52:00', '2025-04-17 09:52:00'),
(3754, NULL, 'Pukhrayan', '34', 'active', '2025-04-17 09:52:00', '2025-04-17 09:52:00'),
(3755, NULL, 'Puranpur', '34', 'active', '2025-04-17 09:52:00', '2025-04-17 09:52:00'),
(3756, NULL, 'Purmafi', '34', 'active', '2025-04-17 09:52:00', '2025-04-17 09:52:00'),
(3757, NULL, 'Purwa', '34', 'active', '2025-04-17 09:52:00', '2025-04-17 09:52:00'),
(3758, NULL, 'Qadirganj', '34', 'active', '2025-04-17 09:52:00', '2025-04-17 09:52:00'),
(3759, NULL, 'Rabupura', '34', 'active', '2025-04-17 09:52:00', '2025-04-17 09:52:00'),
(3760, NULL, 'Radha Kund', '34', 'active', '2025-04-17 09:52:00', '2025-04-17 09:52:00'),
(3761, NULL, 'Radhakund', '34', 'active', '2025-04-17 09:52:00', '2025-04-17 09:52:00'),
(3762, NULL, 'Raebareli', '34', 'active', '2025-04-17 09:52:00', '2025-04-17 09:52:00'),
(3763, NULL, 'Rajapur', '34', 'active', '2025-04-17 09:52:00', '2025-04-17 09:52:00'),
(3764, NULL, 'Ramkola', '34', 'active', '2025-04-17 09:52:00', '2025-04-17 09:52:00'),
(3765, NULL, 'Ramnagar', '34', 'active', '2025-04-17 09:52:00', '2025-04-17 09:52:00'),
(3766, NULL, 'Rampur', '34', 'active', '2025-04-17 09:52:00', '2025-04-17 09:52:00'),
(3767, NULL, 'Rampura', '34', 'active', '2025-04-17 09:52:00', '2025-04-17 09:52:00'),
(3768, NULL, 'Ranipur', '34', 'active', '2025-04-17 09:52:00', '2025-04-17 09:52:00'),
(3769, NULL, 'Ranipur Barsi', '34', 'active', '2025-04-17 09:52:00', '2025-04-17 09:52:00'),
(3770, NULL, 'Rasra', '34', 'active', '2025-04-17 09:52:00', '2025-04-17 09:52:00'),
(3771, NULL, 'Rasulabad', '34', 'active', '2025-04-17 09:52:00', '2025-04-17 09:52:00'),
(3772, NULL, 'Rath', '34', 'active', '2025-04-17 09:52:00', '2025-04-17 09:52:00'),
(3773, NULL, 'Raya', '34', 'active', '2025-04-17 09:52:00', '2025-04-17 09:52:00'),
(3774, NULL, 'Rehar', '34', 'active', '2025-04-17 09:52:00', '2025-04-17 09:52:00'),
(3775, NULL, 'Renukoot', '34', 'active', '2025-04-17 09:52:00', '2025-04-17 09:52:00'),
(3776, NULL, 'Renukut', '34', 'active', '2025-04-17 09:52:00', '2025-04-17 09:52:00'),
(3777, NULL, 'Reoti', '34', 'active', '2025-04-17 09:52:00', '2025-04-17 09:52:00'),
(3778, NULL, 'Reotipur', '34', 'active', '2025-04-17 09:52:00', '2025-04-17 09:52:00'),
(3779, NULL, 'Richha', '34', 'active', '2025-04-17 09:52:00', '2025-04-17 09:52:00'),
(3780, NULL, 'Robertsganj', '34', 'active', '2025-04-17 09:52:00', '2025-04-17 09:52:00'),
(3781, NULL, 'Rudarpur', '34', 'active', '2025-04-17 09:52:00', '2025-04-17 09:52:00'),
(3782, NULL, 'Rudauli', '34', 'active', '2025-04-17 09:52:00', '2025-04-17 09:52:00'),
(3783, NULL, 'Rura', '34', 'active', '2025-04-17 09:52:00', '2025-04-17 09:52:00'),
(3784, NULL, 'Sabalpur', '34', 'active', '2025-04-17 09:52:00', '2025-04-17 09:52:00'),
(3785, NULL, 'Sachendi', '34', 'active', '2025-04-17 09:52:00', '2025-04-17 09:52:00'),
(3786, NULL, 'Sadabad', '34', 'active', '2025-04-17 09:52:00', '2025-04-17 09:52:00'),
(3787, NULL, 'Sadat', '34', 'active', '2025-04-17 09:52:00', '2025-04-17 09:52:00'),
(3788, NULL, 'Safipur', '34', 'active', '2025-04-17 09:52:00', '2025-04-17 09:52:00'),
(3789, NULL, 'Saharanpur', '34', 'active', '2025-04-17 09:52:00', '2025-04-17 09:52:00'),
(3790, NULL, 'Sahaspur', '34', 'active', '2025-04-17 09:52:00', '2025-04-17 09:52:00'),
(3791, NULL, 'Sahaswan', '34', 'active', '2025-04-17 09:52:00', '2025-04-17 09:52:00'),
(3792, NULL, 'Sahawar', '34', 'active', '2025-04-17 09:52:00', '2025-04-17 09:52:00'),
(3793, NULL, 'Sahibabad', '34', 'active', '2025-04-17 09:52:00', '2025-04-17 09:52:00'),
(3794, NULL, 'Sahpau', '34', 'active', '2025-04-17 09:52:00', '2025-04-17 09:52:00'),
(3795, NULL, 'Saidpur', '34', 'active', '2025-04-17 09:52:00', '2025-04-17 09:52:00'),
(3796, NULL, 'Sakhanu', '34', 'active', '2025-04-17 09:52:00', '2025-04-17 09:52:00'),
(3797, NULL, 'Sakit', '34', 'active', '2025-04-17 09:52:00', '2025-04-17 09:52:00'),
(3798, NULL, 'Salempur', '34', 'active', '2025-04-17 09:52:00', '2025-04-17 09:52:00'),
(3799, NULL, 'Salon', '34', 'active', '2025-04-17 09:52:00', '2025-04-17 09:52:00'),
(3800, NULL, 'Sambhal', '34', 'active', '2025-04-17 09:52:00', '2025-04-17 09:52:00'),
(3801, NULL, 'Samthar', '34', 'active', '2025-04-17 09:52:00', '2025-04-17 09:52:00'),
(3802, NULL, 'Sandi', '34', 'active', '2025-04-17 09:52:00', '2025-04-17 09:52:00'),
(3803, NULL, 'Sandila', '34', 'active', '2025-04-17 09:52:00', '2025-04-17 09:52:00'),
(3804, NULL, 'Sant Kabir Nagar', '34', 'active', '2025-04-17 09:52:00', '2025-04-17 09:52:00'),
(3805, NULL, 'Sant Ravi Das Nagar', '34', 'active', '2025-04-17 09:52:00', '2025-04-17 09:52:00'),
(3806, NULL, 'Sarai Akil', '34', 'active', '2025-04-17 09:52:00', '2025-04-17 09:52:00'),
(3807, NULL, 'Sarai Ekdil', '34', 'active', '2025-04-17 09:52:00', '2025-04-17 09:52:00'),
(3808, NULL, 'Sarai Mir', '34', 'active', '2025-04-17 09:52:00', '2025-04-17 09:52:00'),
(3809, NULL, 'Sarauli', '34', 'active', '2025-04-17 09:52:00', '2025-04-17 09:52:00'),
(3810, NULL, 'Sardhana', '34', 'active', '2025-04-17 09:52:00', '2025-04-17 09:52:00'),
(3811, NULL, 'Sarila', '34', 'active', '2025-04-17 09:52:00', '2025-04-17 09:52:00'),
(3812, NULL, 'Sarurpur', '34', 'active', '2025-04-17 09:52:00', '2025-04-17 09:52:00'),
(3813, NULL, 'Sasni', '34', 'active', '2025-04-17 09:52:00', '2025-04-17 09:52:00'),
(3814, NULL, 'Satrikh', '34', 'active', '2025-04-17 09:52:00', '2025-04-17 09:52:00'),
(3815, NULL, 'Saurikh', '34', 'active', '2025-04-17 09:52:00', '2025-04-17 09:52:00'),
(3816, NULL, 'Sector', '34', 'active', '2025-04-17 09:52:00', '2025-04-17 09:52:00'),
(3817, NULL, 'Seohara', '34', 'active', '2025-04-17 09:52:00', '2025-04-17 09:52:00'),
(3818, NULL, 'Shahabad', '34', 'active', '2025-04-17 09:52:00', '2025-04-17 09:52:00'),
(3819, NULL, 'Shahganj', '34', 'active', '2025-04-17 09:52:00', '2025-04-17 09:52:00'),
(3820, NULL, 'Shahi', '34', 'active', '2025-04-17 09:52:00', '2025-04-17 09:52:00'),
(3821, NULL, 'Shahjahanpur', '34', 'active', '2025-04-17 09:52:00', '2025-04-17 09:52:00'),
(3822, NULL, 'Shahpur', '34', 'active', '2025-04-17 09:52:00', '2025-04-17 09:52:00'),
(3823, NULL, 'Shamli', '34', 'active', '2025-04-17 09:52:00', '2025-04-17 09:52:00'),
(3824, NULL, 'Shamsabad', '34', 'active', '2025-04-17 09:52:00', '2025-04-17 09:52:00'),
(3825, NULL, 'Shankargarh', '34', 'active', '2025-04-17 09:52:00', '2025-04-17 09:52:00'),
(3826, NULL, 'Shergarh', '34', 'active', '2025-04-17 09:52:00', '2025-04-17 09:52:00'),
(3827, NULL, 'Sherkot', '34', 'active', '2025-04-17 09:52:00', '2025-04-17 09:52:00'),
(3828, NULL, 'Shibnagar', '34', 'active', '2025-04-17 09:52:00', '2025-04-17 09:52:00'),
(3829, NULL, 'Shikarpur', '34', 'active', '2025-04-17 09:52:00', '2025-04-17 09:52:00'),
(3830, NULL, 'Shikarpur (Bulandshahr)', '34', 'active', '2025-04-17 09:52:00', '2025-04-17 09:52:00'),
(3831, NULL, 'Shikohabad', '34', 'active', '2025-04-17 09:52:00', '2025-04-17 09:52:00'),
(3832, NULL, 'Shishgarh', '34', 'active', '2025-04-17 09:52:00', '2025-04-17 09:52:00'),
(3833, NULL, 'Shivrajpur', '34', 'active', '2025-04-17 09:52:00', '2025-04-17 09:52:00'),
(3834, NULL, 'Shrawasti', '34', 'active', '2025-04-17 09:52:00', '2025-04-17 09:52:00'),
(3835, NULL, 'Siddharthnagar', '34', 'active', '2025-04-17 09:52:00', '2025-04-17 09:52:00'),
(3836, NULL, 'Siddhaur', '34', 'active', '2025-04-17 09:52:00', '2025-04-17 09:52:00'),
(3837, NULL, 'Sidhauli', '34', 'active', '2025-04-17 09:52:00', '2025-04-17 09:52:00'),
(3838, NULL, 'Sidhpura', '34', 'active', '2025-04-17 09:52:00', '2025-04-17 09:52:00'),
(3839, NULL, 'Sikandarabad', '34', 'active', '2025-04-17 09:52:00', '2025-04-17 09:52:00'),
(3840, NULL, 'Sikandarpur', '34', 'active', '2025-04-17 09:52:00', '2025-04-17 09:52:00'),
(3841, NULL, 'Sikandra', '34', 'active', '2025-04-17 09:52:00', '2025-04-17 09:52:00'),
(3842, NULL, 'Sikandra Rao', '34', 'active', '2025-04-17 09:52:00', '2025-04-17 09:52:00'),
(3843, NULL, 'Sikandrabad', '34', 'active', '2025-04-17 09:52:00', '2025-04-17 09:52:00'),
(3844, NULL, 'Sirathu', '34', 'active', '2025-04-17 09:52:00', '2025-04-17 09:52:00'),
(3845, NULL, 'Sirsa', '34', 'active', '2025-04-17 09:52:00', '2025-04-17 09:52:00'),
(3846, NULL, 'Sirsaganj', '34', 'active', '2025-04-17 09:52:00', '2025-04-17 09:52:00'),
(3847, NULL, 'Sirsi', '34', 'active', '2025-04-17 09:52:00', '2025-04-17 09:52:00'),
(3848, NULL, 'Sisauli', '34', 'active', '2025-04-17 09:52:00', '2025-04-17 09:52:00'),
(3849, NULL, 'Siswa Bazar', '34', 'active', '2025-04-17 09:52:00', '2025-04-17 09:52:00'),
(3850, NULL, 'Sitapur', '34', 'active', '2025-04-17 09:52:00', '2025-04-17 09:52:00'),
(3851, NULL, 'Sonbhadra', '34', 'active', '2025-04-17 09:52:00', '2025-04-17 09:52:00'),
(3852, NULL, 'Soron', '34', 'active', '2025-04-17 09:52:00', '2025-04-17 09:52:00'),
(3853, NULL, 'Suar', '34', 'active', '2025-04-17 09:52:00', '2025-04-17 09:52:00'),
(3854, NULL, 'Sultanpur', '34', 'active', '2025-04-17 09:52:00', '2025-04-17 09:52:00'),
(3855, NULL, 'Surianwan', '34', 'active', '2025-04-17 09:52:00', '2025-04-17 09:52:00'),
(3856, NULL, 'Tajpur', '34', 'active', '2025-04-17 09:52:00', '2025-04-17 09:52:00'),
(3857, NULL, 'Talbahat', '34', 'active', '2025-04-17 09:52:00', '2025-04-17 09:52:00'),
(3858, NULL, 'Talgram', '34', 'active', '2025-04-17 09:52:00', '2025-04-17 09:52:00'),
(3859, NULL, 'Tanda', '34', 'active', '2025-04-17 09:52:00', '2025-04-17 09:52:00'),
(3860, NULL, 'Terha', '34', 'active', '2025-04-17 09:52:00', '2025-04-17 09:52:00'),
(3861, NULL, 'Thakurdwara', '34', 'active', '2025-04-17 09:52:00', '2025-04-17 09:52:00'),
(3862, NULL, 'Thana Bhawan', '34', 'active', '2025-04-17 09:52:00', '2025-04-17 09:52:00'),
(3863, NULL, 'Tigri', '34', 'active', '2025-04-17 09:52:00', '2025-04-17 09:52:00'),
(3864, NULL, 'Tikaitnagar', '34', 'active', '2025-04-17 09:52:00', '2025-04-17 09:52:00'),
(3865, NULL, 'Tikri', '34', 'active', '2025-04-17 09:52:00', '2025-04-17 09:52:00'),
(3866, NULL, 'Tilhar', '34', 'active', '2025-04-17 09:52:00', '2025-04-17 09:52:00'),
(3867, NULL, 'Tilsahri', '34', 'active', '2025-04-17 09:52:00', '2025-04-17 09:52:00'),
(3868, NULL, 'Tindwari', '34', 'active', '2025-04-17 09:52:00', '2025-04-17 09:52:00'),
(3869, NULL, 'Titron', '34', 'active', '2025-04-17 09:52:00', '2025-04-17 09:52:00'),
(3870, NULL, 'Tori Fatehpur', '34', 'active', '2025-04-17 09:52:00', '2025-04-17 09:52:00'),
(3871, NULL, 'Tori-Fatehpur', '34', 'active', '2025-04-17 09:52:00', '2025-04-17 09:52:00'),
(3872, NULL, 'Tulsipur', '34', 'active', '2025-04-17 09:52:00', '2025-04-17 09:52:00'),
(3873, NULL, 'Tundla', '34', 'active', '2025-04-17 09:52:00', '2025-04-17 09:52:00'),
(3874, NULL, 'Ugu', '34', 'active', '2025-04-17 09:52:00', '2025-04-17 09:52:00'),
(3875, NULL, 'Ujhani', '34', 'active', '2025-04-17 09:52:00', '2025-04-17 09:52:00'),
(3876, NULL, 'Umri', '34', 'active', '2025-04-17 09:52:00', '2025-04-17 09:52:00'),
(3877, NULL, 'Un', '34', 'active', '2025-04-17 09:52:00', '2025-04-17 09:52:00'),
(3878, NULL, 'Unnao', '34', 'active', '2025-04-17 09:52:00', '2025-04-17 09:52:00'),
(3879, NULL, 'Usawan', '34', 'active', '2025-04-17 09:52:00', '2025-04-17 09:52:00'),
(3880, NULL, 'Usehat', '34', 'active', '2025-04-17 09:52:00', '2025-04-17 09:52:00'),
(3881, NULL, 'Uska', '34', 'active', '2025-04-17 09:52:00', '2025-04-17 09:52:00'),
(3882, NULL, 'Utraula', '34', 'active', '2025-04-17 09:52:00', '2025-04-17 09:52:00'),
(3883, NULL, 'Varanasi', '34', 'active', '2025-04-17 09:52:00', '2025-04-17 09:52:00'),
(3884, NULL, 'Vindhyachal', '34', 'active', '2025-04-17 09:52:00', '2025-04-17 09:52:00'),
(3885, NULL, 'Vrindavan', '34', 'active', '2025-04-17 09:52:00', '2025-04-17 09:52:00'),
(3886, NULL, 'Walterganj', '34', 'active', '2025-04-17 09:52:00', '2025-04-17 09:52:00'),
(3887, NULL, 'Wazirganj', '34', 'active', '2025-04-17 09:52:00', '2025-04-17 09:52:00'),
(3888, NULL, 'Yusufpur', '34', 'active', '2025-04-17 09:52:00', '2025-04-17 09:52:00'),
(3889, NULL, 'Zafarabad', '34', 'active', '2025-04-17 09:52:00', '2025-04-17 09:52:00'),
(3890, NULL, 'Zaidpur', '34', 'active', '2025-04-17 09:52:00', '2025-04-17 09:52:00'),
(3891, NULL, 'Zamania', '34', 'active', '2025-04-17 09:52:00', '2025-04-17 09:52:00'),
(3892, NULL, 'Almora', '35', 'active', '2025-04-17 09:52:00', '2025-04-17 09:52:00'),
(3893, NULL, 'Bageshwar', '35', 'active', '2025-04-17 09:52:00', '2025-04-17 09:52:00'),
(3894, NULL, 'Barkot', '35', 'active', '2025-04-17 09:52:00', '2025-04-17 09:52:00'),
(3895, NULL, 'Bazpur', '35', 'active', '2025-04-17 09:52:00', '2025-04-17 09:52:00'),
(3896, NULL, 'Bhim Tal', '35', 'active', '2025-04-17 09:52:00', '2025-04-17 09:52:00'),
(3897, NULL, 'Bhowali', '35', 'active', '2025-04-17 09:52:00', '2025-04-17 09:52:00'),
(3898, NULL, 'Birbhaddar', '35', 'active', '2025-04-17 09:52:00', '2025-04-17 09:52:00'),
(3899, NULL, 'Chakrata', '35', 'active', '2025-04-17 09:52:00', '2025-04-17 09:52:00'),
(3900, NULL, 'Chamoli', '35', 'active', '2025-04-17 09:52:00', '2025-04-17 09:52:00'),
(3901, NULL, 'Champawat', '35', 'active', '2025-04-17 09:52:00', '2025-04-17 09:52:00'),
(3902, NULL, 'Clement Town', '35', 'active', '2025-04-17 09:52:00', '2025-04-17 09:52:00'),
(3903, NULL, 'Dehradun', '35', 'active', '2025-04-17 09:52:00', '2025-04-17 09:52:00'),
(3904, NULL, 'Devaprayag', '35', 'active', '2025-04-17 09:52:00', '2025-04-17 09:52:00'),
(3905, NULL, 'Dharchula', '35', 'active', '2025-04-17 09:52:00', '2025-04-17 09:52:00'),
(3906, NULL, 'Doiwala', '35', 'active', '2025-04-17 09:52:00', '2025-04-17 09:52:00'),
(3907, NULL, 'Dugadda', '35', 'active', '2025-04-17 09:52:00', '2025-04-17 09:52:00'),
(3908, NULL, 'Dwarahat', '35', 'active', '2025-04-17 09:52:00', '2025-04-17 09:52:00'),
(3909, NULL, 'Garhwal', '35', 'active', '2025-04-17 09:52:00', '2025-04-17 09:52:00'),
(3910, NULL, 'Haldwani', '35', 'active', '2025-04-17 09:52:00', '2025-04-17 09:52:00'),
(3911, NULL, 'Harbatpur', '35', 'active', '2025-04-17 09:52:00', '2025-04-17 09:52:00'),
(3912, NULL, 'Haridwar', '35', 'active', '2025-04-17 09:52:00', '2025-04-17 09:52:00'),
(3913, NULL, 'Jaspur', '35', 'active', '2025-04-17 09:52:00', '2025-04-17 09:52:00'),
(3914, NULL, 'Joshimath', '35', 'active', '2025-04-17 09:52:00', '2025-04-17 09:52:00'),
(3915, NULL, 'Kaladhungi', '35', 'active', '2025-04-17 09:52:00', '2025-04-17 09:52:00'),
(3916, NULL, 'Kalagarh Project Colony', '35', 'active', '2025-04-17 09:52:00', '2025-04-17 09:52:00'),
(3917, NULL, 'Kashipur', '35', 'active', '2025-04-17 09:52:00', '2025-04-17 09:52:00'),
(3918, NULL, 'Khatima', '35', 'active', '2025-04-17 09:52:00', '2025-04-17 09:52:00'),
(3919, NULL, 'Kichha', '35', 'active', '2025-04-17 09:52:00', '2025-04-17 09:52:00'),
(3920, NULL, 'Kotdwara', '35', 'active', '2025-04-17 09:52:00', '2025-04-17 09:52:00'),
(3921, NULL, 'Laksar', '35', 'active', '2025-04-17 09:52:00', '2025-04-17 09:52:00'),
(3922, NULL, 'Lansdowne', '35', 'active', '2025-04-17 09:52:00', '2025-04-17 09:52:00'),
(3923, NULL, 'Lohaghat', '35', 'active', '2025-04-17 09:52:00', '2025-04-17 09:52:00'),
(3924, NULL, 'Manglaur', '35', 'active', '2025-04-17 09:52:00', '2025-04-17 09:52:00'),
(3925, NULL, 'Mussoorie', '35', 'active', '2025-04-17 09:52:00', '2025-04-17 09:52:00'),
(3926, NULL, 'Naini Tal', '35', 'active', '2025-04-17 09:52:00', '2025-04-17 09:52:00'),
(3927, NULL, 'Narendranagar', '35', 'active', '2025-04-17 09:52:00', '2025-04-17 09:52:00'),
(3928, NULL, 'Pauri', '35', 'active', '2025-04-17 09:52:00', '2025-04-17 09:52:00'),
(3929, NULL, 'Pipalkoti', '35', 'active', '2025-04-17 09:52:00', '2025-04-17 09:52:00'),
(3930, NULL, 'Pithoragarh', '35', 'active', '2025-04-17 09:52:00', '2025-04-17 09:52:00'),
(3931, NULL, 'Raipur', '35', 'active', '2025-04-17 09:52:00', '2025-04-17 09:52:00'),
(3932, NULL, 'Raiwala Bara', '35', 'active', '2025-04-17 09:52:00', '2025-04-17 09:52:00'),
(3933, NULL, 'Ramnagar', '35', 'active', '2025-04-17 09:52:00', '2025-04-17 09:52:00'),
(3934, NULL, 'Ranikhet', '35', 'active', '2025-04-17 09:52:00', '2025-04-17 09:52:00'),
(3935, NULL, 'Rishikesh', '35', 'active', '2025-04-17 09:52:00', '2025-04-17 09:52:00'),
(3936, NULL, 'Roorkee', '35', 'active', '2025-04-17 09:52:00', '2025-04-17 09:52:00'),
(3937, NULL, 'Rudraprayag', '35', 'active', '2025-04-17 09:52:00', '2025-04-17 09:52:00'),
(3938, NULL, 'Sitarganj', '35', 'active', '2025-04-17 09:52:00', '2025-04-17 09:52:00'),
(3939, NULL, 'Srinagar', '35', 'active', '2025-04-17 09:52:00', '2025-04-17 09:52:00'),
(3940, NULL, 'Sultanpur', '35', 'active', '2025-04-17 09:52:00', '2025-04-17 09:52:00'),
(3941, NULL, 'Tanakpur', '35', 'active', '2025-04-17 09:52:00', '2025-04-17 09:52:00'),
(3942, NULL, 'Tehri', '35', 'active', '2025-04-17 09:52:00', '2025-04-17 09:52:00'),
(3943, NULL, 'Tehri-Garhwal', '35', 'active', '2025-04-17 09:52:00', '2025-04-17 09:52:00'),
(3944, NULL, 'Udham Singh Nagar', '35', 'active', '2025-04-17 09:52:00', '2025-04-17 09:52:00'),
(3945, NULL, 'Uttarkashi', '35', 'active', '2025-04-17 09:52:00', '2025-04-17 09:52:00'),
(3946, NULL, 'Vikasnagar', '35', 'active', '2025-04-17 09:52:00', '2025-04-17 09:52:00'),
(3947, NULL, 'Adra', '36', 'active', '2025-04-17 09:52:00', '2025-04-17 09:52:00'),
(3948, NULL, 'Ahmedpur', '36', 'active', '2025-04-17 09:52:00', '2025-04-17 09:52:00'),
(3949, NULL, 'Aistala', '36', 'active', '2025-04-17 09:52:00', '2025-04-17 09:52:00'),
(3950, NULL, 'Aknapur', '36', 'active', '2025-04-17 09:52:00', '2025-04-17 09:52:00'),
(3951, NULL, 'Alipurduar', '36', 'active', '2025-04-17 09:52:00', '2025-04-17 09:52:00'),
(3952, NULL, 'Amlagora', '36', 'active', '2025-04-17 09:52:00', '2025-04-17 09:52:00'),
(3953, NULL, 'Amta', '36', 'active', '2025-04-17 09:52:00', '2025-04-17 09:52:00'),
(3954, NULL, 'Amtala', '36', 'active', '2025-04-17 09:52:00', '2025-04-17 09:52:00'),
(3955, NULL, 'Andal', '36', 'active', '2025-04-17 09:52:00', '2025-04-17 09:52:00'),
(3956, NULL, 'Arambagh community development block', '36', 'active', '2025-04-17 09:52:00', '2025-04-17 09:52:00'),
(3957, NULL, 'Asansol', '36', 'active', '2025-04-17 09:52:00', '2025-04-17 09:52:00'),
(3958, NULL, 'Ashoknagar Kalyangarh', '36', 'active', '2025-04-17 09:52:00', '2025-04-17 09:52:00'),
(3959, NULL, 'Badkulla', '36', 'active', '2025-04-17 09:52:00', '2025-04-17 09:52:00'),
(3960, NULL, 'Baduria', '36', 'active', '2025-04-17 09:52:00', '2025-04-17 09:52:00'),
(3961, NULL, 'Bagdogra', '36', 'active', '2025-04-17 09:52:00', '2025-04-17 09:52:00'),
(3962, NULL, 'Bagnan', '36', 'active', '2025-04-17 09:52:00', '2025-04-17 09:52:00'),
(3963, NULL, 'Bagula', '36', 'active', '2025-04-17 09:52:00', '2025-04-17 09:52:00'),
(3964, NULL, 'Bahula', '36', 'active', '2025-04-17 09:52:00', '2025-04-17 09:52:00'),
(3965, NULL, 'Baidyabati', '36', 'active', '2025-04-17 09:52:00', '2025-04-17 09:52:00'),
(3966, NULL, 'Bakreswar', '36', 'active', '2025-04-17 09:52:00', '2025-04-17 09:52:00'),
(3967, NULL, 'Balarampur', '36', 'active', '2025-04-17 09:52:00', '2025-04-17 09:52:00'),
(3968, NULL, 'Bali Chak', '36', 'active', '2025-04-17 09:52:00', '2025-04-17 09:52:00'),
(3969, NULL, 'Bally', '36', 'active', '2025-04-17 09:52:00', '2025-04-17 09:52:00'),
(3970, NULL, 'Balurghat', '36', 'active', '2025-04-17 09:52:00', '2025-04-17 09:52:00'),
(3971, NULL, 'Bamangola community development block', '36', 'active', '2025-04-17 09:52:00', '2025-04-17 09:52:00'),
(3972, NULL, 'Baneswar', '36', 'active', '2025-04-17 09:52:00', '2025-04-17 09:52:00'),
(3973, NULL, 'Bangaon', '36', 'active', '2025-04-17 09:52:00', '2025-04-17 09:52:00'),
(3974, NULL, 'Bankra', '36', 'active', '2025-04-17 09:52:00', '2025-04-17 09:52:00'),
(3975, NULL, 'Bankura', '36', 'active', '2025-04-17 09:52:00', '2025-04-17 09:52:00'),
(3976, NULL, 'Bansberia', '36', 'active', '2025-04-17 09:52:00', '2025-04-17 09:52:00'),
(3977, NULL, 'Bansihari community development block', '36', 'active', '2025-04-17 09:52:00', '2025-04-17 09:52:00'),
(3978, NULL, 'Barabazar', '36', 'active', '2025-04-17 09:52:00', '2025-04-17 09:52:00'),
(3979, NULL, 'Baranagar', '36', 'active', '2025-04-17 09:52:00', '2025-04-17 09:52:00'),
(3980, NULL, 'Barasat', '36', 'active', '2025-04-17 09:52:00', '2025-04-17 09:52:00'),
(3981, NULL, 'Bardhaman', '36', 'active', '2025-04-17 09:52:00', '2025-04-17 09:52:00'),
(3982, NULL, 'Barjora', '36', 'active', '2025-04-17 09:52:00', '2025-04-17 09:52:00'),
(3983, NULL, 'Barrackpore', '36', 'active', '2025-04-17 09:52:00', '2025-04-17 09:52:00'),
(3984, NULL, 'Baruipur', '36', 'active', '2025-04-17 09:52:00', '2025-04-17 09:52:00'),
(3985, NULL, 'Basanti', '36', 'active', '2025-04-17 09:52:00', '2025-04-17 09:52:00'),
(3986, NULL, 'Basirhat', '36', 'active', '2025-04-17 09:52:00', '2025-04-17 09:52:00'),
(3987, NULL, 'Bawali', '36', 'active', '2025-04-17 09:52:00', '2025-04-17 09:52:00'),
(3988, NULL, 'Begampur', '36', 'active', '2025-04-17 09:52:00', '2025-04-17 09:52:00'),
(3989, NULL, 'Belda', '36', 'active', '2025-04-17 09:52:00', '2025-04-17 09:52:00'),
(3990, NULL, 'Beldanga', '36', 'active', '2025-04-17 09:52:00', '2025-04-17 09:52:00'),
(3991, NULL, 'Beliatore', '36', 'active', '2025-04-17 09:52:00', '2025-04-17 09:52:00'),
(3992, NULL, 'Berhampore', '36', 'active', '2025-04-17 09:52:00', '2025-04-17 09:52:00'),
(3993, NULL, 'Bhadreswar', '36', 'active', '2025-04-17 09:52:00', '2025-04-17 09:52:00'),
(3994, NULL, 'Bhandardaha', '36', 'active', '2025-04-17 09:52:00', '2025-04-17 09:52:00'),
(3995, NULL, 'Bhatpara', '36', 'active', '2025-04-17 09:52:00', '2025-04-17 09:52:00'),
(3996, NULL, 'Birbhum district', '36', 'active', '2025-04-17 09:52:00', '2025-04-17 09:52:00'),
(3997, NULL, 'Birpara', '36', 'active', '2025-04-17 09:52:00', '2025-04-17 09:52:00'),
(3998, NULL, 'Bishnupur', '36', 'active', '2025-04-17 09:52:00', '2025-04-17 09:52:00'),
(3999, NULL, 'Bolpur', '36', 'active', '2025-04-17 09:52:00', '2025-04-17 09:52:00'),
(4000, NULL, 'Budge Budge', '36', 'active', '2025-04-17 09:52:00', '2025-04-17 09:52:00'),
(4001, NULL, 'Canning', '36', 'active', '2025-04-17 09:52:00', '2025-04-17 09:52:00'),
(4002, NULL, 'Chakapara', '36', 'active', '2025-04-17 09:52:00', '2025-04-17 09:52:00'),
(4003, NULL, 'Chakdaha', '36', 'active', '2025-04-17 09:52:00', '2025-04-17 09:52:00'),
(4004, NULL, 'Champadanga', '36', 'active', '2025-04-17 09:52:00', '2025-04-17 09:52:00'),
(4005, NULL, 'Champahati', '36', 'active', '2025-04-17 09:52:00', '2025-04-17 09:52:00'),
(4006, NULL, 'Champdani', '36', 'active', '2025-04-17 09:52:00', '2025-04-17 09:52:00'),
(4007, NULL, 'Chandannagar', '36', 'active', '2025-04-17 09:52:00', '2025-04-17 09:52:00'),
(4008, NULL, 'Chandrakona', '36', 'active', '2025-04-17 09:52:00', '2025-04-17 09:52:00'),
(4009, NULL, 'Chittaranjan', '36', 'active', '2025-04-17 09:52:00', '2025-04-17 09:52:00'),
(4010, NULL, 'Churulia', '36', 'active', '2025-04-17 09:52:00', '2025-04-17 09:52:00'),
(4011, NULL, 'Contai', '36', 'active', '2025-04-17 09:52:00', '2025-04-17 09:52:00'),
(4012, NULL, 'Cooch Behar', '36', 'active', '2025-04-17 09:52:00', '2025-04-17 09:52:00'),
(4013, NULL, 'Cossimbazar', '36', 'active', '2025-04-17 09:52:00', '2025-04-17 09:52:00'),
(4014, NULL, 'Dakshin Dinajpur district', '36', 'active', '2025-04-17 09:52:00', '2025-04-17 09:52:00'),
(4015, NULL, 'Dalkola', '36', 'active', '2025-04-17 09:52:00', '2025-04-17 09:52:00'),
(4016, NULL, 'Dam Dam', '36', 'active', '2025-04-17 09:52:00', '2025-04-17 09:52:00'),
(4017, NULL, 'Darjeeling', '36', 'active', '2025-04-17 09:52:00', '2025-04-17 09:52:00'),
(4018, NULL, 'Daulatpur', '36', 'active', '2025-04-17 09:52:00', '2025-04-17 09:52:00'),
(4019, NULL, 'Debagram', '36', 'active', '2025-04-17 09:52:00', '2025-04-17 09:52:00'),
(4020, NULL, 'Debipur', '36', 'active', '2025-04-17 09:52:00', '2025-04-17 09:52:00'),
(4021, NULL, 'Dhaniakhali community development block', '36', 'active', '2025-04-17 09:52:00', '2025-04-17 09:52:00'),
(4022, NULL, 'Dhulagari', '36', 'active', '2025-04-17 09:52:00', '2025-04-17 09:52:00'),
(4023, NULL, 'Dhulian', '36', 'active', '2025-04-17 09:52:00', '2025-04-17 09:52:00'),
(4024, NULL, 'Dhupguri', '36', 'active', '2025-04-17 09:52:00', '2025-04-17 09:52:00'),
(4025, NULL, 'Diamond Harbour', '36', 'active', '2025-04-17 09:52:00', '2025-04-17 09:52:00'),
(4026, NULL, 'Digha', '36', 'active', '2025-04-17 09:52:00', '2025-04-17 09:52:00'),
(4027, NULL, 'Dinhata', '36', 'active', '2025-04-17 09:52:00', '2025-04-17 09:52:00'),
(4028, NULL, 'Domjur', '36', 'active', '2025-04-17 09:52:00', '2025-04-17 09:52:00'),
(4029, NULL, 'Dubrajpur', '36', 'active', '2025-04-17 09:52:00', '2025-04-17 09:52:00'),
(4030, NULL, 'Durgapur', '36', 'active', '2025-04-17 09:52:00', '2025-04-17 09:52:00'),
(4031, NULL, 'Egra', '36', 'active', '2025-04-17 09:52:00', '2025-04-17 09:52:00'),
(4032, NULL, 'Falakata', '36', 'active', '2025-04-17 09:52:00', '2025-04-17 09:52:00'),
(4033, NULL, 'Farakka', '36', 'active', '2025-04-17 09:52:00', '2025-04-17 09:52:00'),
(4034, NULL, 'Fort Gloster', '36', 'active', '2025-04-17 09:52:00', '2025-04-17 09:52:00'),
(4035, NULL, 'Gaighata community development block', '36', 'active', '2025-04-17 09:52:00', '2025-04-17 09:52:00'),
(4036, NULL, 'Gairkata', '36', 'active', '2025-04-17 09:52:00', '2025-04-17 09:52:00'),
(4037, NULL, 'Gangadharpur', '36', 'active', '2025-04-17 09:52:00', '2025-04-17 09:52:00'),
(4038, NULL, 'Gangarampur', '36', 'active', '2025-04-17 09:52:00', '2025-04-17 09:52:00'),
(4039, NULL, 'Garui', '36', 'active', '2025-04-17 09:52:00', '2025-04-17 09:52:00'),
(4040, NULL, 'Garulia', '36', 'active', '2025-04-17 09:52:00', '2025-04-17 09:52:00'),
(4041, NULL, 'Ghatal', '36', 'active', '2025-04-17 09:52:00', '2025-04-17 09:52:00'),
(4042, NULL, 'Giria', '36', 'active', '2025-04-17 09:52:00', '2025-04-17 09:52:00'),
(4043, NULL, 'Gobardanga', '36', 'active', '2025-04-17 09:52:00', '2025-04-17 09:52:00'),
(4044, NULL, 'Gobindapur', '36', 'active', '2025-04-17 09:52:00', '2025-04-17 09:52:00'),
(4045, NULL, 'Gopalpur', '36', 'active', '2025-04-17 09:52:00', '2025-04-17 09:52:00'),
(4046, NULL, 'Gopinathpur', '36', 'active', '2025-04-17 09:52:00', '2025-04-17 09:52:00'),
(4047, NULL, 'Gorubathan', '36', 'active', '2025-04-17 09:52:00', '2025-04-17 09:52:00'),
(4048, NULL, 'Gosaba', '36', 'active', '2025-04-17 09:52:00', '2025-04-17 09:52:00'),
(4049, NULL, 'Gosanimari', '36', 'active', '2025-04-17 09:52:00', '2025-04-17 09:52:00'),
(4050, NULL, 'Gurdaha', '36', 'active', '2025-04-17 09:52:00', '2025-04-17 09:52:00'),
(4051, NULL, 'Guskhara', '36', 'active', '2025-04-17 09:52:00', '2025-04-17 09:52:00'),
(4052, NULL, 'Habra', '36', 'active', '2025-04-17 09:52:00', '2025-04-17 09:52:00'),
(4053, NULL, 'Haldia', '36', 'active', '2025-04-17 09:52:00', '2025-04-17 09:52:00'),
(4054, NULL, 'Haldibari', '36', 'active', '2025-04-17 09:52:00', '2025-04-17 09:52:00'),
(4055, NULL, 'Halisahar', '36', 'active', '2025-04-17 09:52:00', '2025-04-17 09:52:00'),
(4056, NULL, 'Harindanga', '36', 'active', '2025-04-17 09:52:00', '2025-04-17 09:52:00'),
(4057, NULL, 'Haringhata', '36', 'active', '2025-04-17 09:52:00', '2025-04-17 09:52:00'),
(4058, NULL, 'Haripur', '36', 'active', '2025-04-17 09:52:00', '2025-04-17 09:52:00'),
(4059, NULL, 'Hasimara', '36', 'active', '2025-04-17 09:52:00', '2025-04-17 09:52:00'),
(4060, NULL, 'Hindusthan Cables Town', '36', 'active', '2025-04-17 09:52:00', '2025-04-17 09:52:00'),
(4061, NULL, 'Hooghly district', '36', 'active', '2025-04-17 09:52:00', '2025-04-17 09:52:00'),
(4062, NULL, 'Howrah', '36', 'active', '2025-04-17 09:52:00', '2025-04-17 09:52:00'),
(4063, NULL, 'Ichapur', '36', 'active', '2025-04-17 09:52:00', '2025-04-17 09:52:00'),
(4064, NULL, 'Indpur community development block', '36', 'active', '2025-04-17 09:52:00', '2025-04-17 09:52:00');
INSERT INTO `module_cities` (`id`, `slug`, `city_name`, `state_name`, `status`, `created_at`, `updated_at`) VALUES
(4065, NULL, 'Ingraj Bazar', '36', 'active', '2025-04-17 09:52:00', '2025-04-17 09:52:00'),
(4066, NULL, 'Islampur', '36', 'active', '2025-04-17 09:52:00', '2025-04-17 09:52:00'),
(4067, NULL, 'Jafarpur', '36', 'active', '2025-04-17 09:52:00', '2025-04-17 09:52:00'),
(4068, NULL, 'Jaigaon', '36', 'active', '2025-04-17 09:52:00', '2025-04-17 09:52:00'),
(4069, NULL, 'Jalpaiguri', '36', 'active', '2025-04-17 09:52:00', '2025-04-17 09:52:00'),
(4070, NULL, 'Jamuria', '36', 'active', '2025-04-17 09:52:00', '2025-04-17 09:52:00'),
(4071, NULL, 'Jangipur', '36', 'active', '2025-04-17 09:52:00', '2025-04-17 09:52:00'),
(4072, NULL, 'Jaynagar Majilpur', '36', 'active', '2025-04-17 09:52:00', '2025-04-17 09:52:00'),
(4073, NULL, 'Jejur', '36', 'active', '2025-04-17 09:52:00', '2025-04-17 09:52:00'),
(4074, NULL, 'Jhalida', '36', 'active', '2025-04-17 09:52:00', '2025-04-17 09:52:00'),
(4075, NULL, 'Jhargram', '36', 'active', '2025-04-17 09:52:00', '2025-04-17 09:52:00'),
(4076, NULL, 'Jhilimili', '36', 'active', '2025-04-17 09:52:00', '2025-04-17 09:52:00'),
(4077, NULL, 'Kakdwip', '36', 'active', '2025-04-17 09:52:00', '2025-04-17 09:52:00'),
(4078, NULL, 'Kalaikunda', '36', 'active', '2025-04-17 09:52:00', '2025-04-17 09:52:00'),
(4079, NULL, 'Kaliaganj', '36', 'active', '2025-04-17 09:52:00', '2025-04-17 09:52:00'),
(4080, NULL, 'Kalimpong', '36', 'active', '2025-04-17 09:52:00', '2025-04-17 09:52:00'),
(4081, NULL, 'Kalna', '36', 'active', '2025-04-17 09:52:00', '2025-04-17 09:52:00'),
(4082, NULL, 'Kalyani', '36', 'active', '2025-04-17 09:52:00', '2025-04-17 09:52:00'),
(4083, NULL, 'Kamarhati', '36', 'active', '2025-04-17 09:52:00', '2025-04-17 09:52:00'),
(4084, NULL, 'Kamarpukur', '36', 'active', '2025-04-17 09:52:00', '2025-04-17 09:52:00'),
(4085, NULL, 'Kanchrapara', '36', 'active', '2025-04-17 09:52:00', '2025-04-17 09:52:00'),
(4086, NULL, 'Kandi', '36', 'active', '2025-04-17 09:52:00', '2025-04-17 09:52:00'),
(4087, NULL, 'Karimpur', '36', 'active', '2025-04-17 09:52:00', '2025-04-17 09:52:00'),
(4088, NULL, 'Katwa', '36', 'active', '2025-04-17 09:52:00', '2025-04-17 09:52:00'),
(4089, NULL, 'Kenda', '36', 'active', '2025-04-17 09:52:00', '2025-04-17 09:52:00'),
(4090, NULL, 'Keshabpur', '36', 'active', '2025-04-17 09:52:00', '2025-04-17 09:52:00'),
(4091, NULL, 'Kharagpur', '36', 'active', '2025-04-17 09:52:00', '2025-04-17 09:52:00'),
(4092, NULL, 'Kharar', '36', 'active', '2025-04-17 09:52:00', '2025-04-17 09:52:00'),
(4093, NULL, 'Kharba', '36', 'active', '2025-04-17 09:52:00', '2025-04-17 09:52:00'),
(4094, NULL, 'Khardaha', '36', 'active', '2025-04-17 09:52:00', '2025-04-17 09:52:00'),
(4095, NULL, 'Khatra', '36', 'active', '2025-04-17 09:52:00', '2025-04-17 09:52:00'),
(4096, NULL, 'Kirnahar', '36', 'active', '2025-04-17 09:52:00', '2025-04-17 09:52:00'),
(4097, NULL, 'Kolkata', '36', 'active', '2025-04-17 09:52:00', '2025-04-17 09:52:00'),
(4098, NULL, 'Konnagar', '36', 'active', '2025-04-17 09:52:00', '2025-04-17 09:52:00'),
(4099, NULL, 'Krishnanagar', '36', 'active', '2025-04-17 09:52:00', '2025-04-17 09:52:00'),
(4100, NULL, 'Krishnapur', '36', 'active', '2025-04-17 09:52:00', '2025-04-17 09:52:00'),
(4101, NULL, 'Kshirpai', '36', 'active', '2025-04-17 09:52:00', '2025-04-17 09:52:00'),
(4102, NULL, 'Kulpi', '36', 'active', '2025-04-17 09:52:00', '2025-04-17 09:52:00'),
(4103, NULL, 'Kultali', '36', 'active', '2025-04-17 09:52:00', '2025-04-17 09:52:00'),
(4104, NULL, 'Kulti', '36', 'active', '2025-04-17 09:52:00', '2025-04-17 09:52:00'),
(4105, NULL, 'Kurseong', '36', 'active', '2025-04-17 09:52:00', '2025-04-17 09:52:00'),
(4106, NULL, 'Lalgarh', '36', 'active', '2025-04-17 09:52:00', '2025-04-17 09:52:00'),
(4107, NULL, 'Lalgola', '36', 'active', '2025-04-17 09:52:00', '2025-04-17 09:52:00'),
(4108, NULL, 'Loyabad', '36', 'active', '2025-04-17 09:52:00', '2025-04-17 09:52:00'),
(4109, NULL, 'Madanpur', '36', 'active', '2025-04-17 09:52:00', '2025-04-17 09:52:00'),
(4110, NULL, 'Madhyamgram', '36', 'active', '2025-04-17 09:52:00', '2025-04-17 09:52:00'),
(4111, NULL, 'Mahiari', '36', 'active', '2025-04-17 09:52:00', '2025-04-17 09:52:00'),
(4112, NULL, 'Mahishadal community development block', '36', 'active', '2025-04-17 09:52:00', '2025-04-17 09:52:00'),
(4113, NULL, 'Mainaguri', '36', 'active', '2025-04-17 09:52:00', '2025-04-17 09:52:00'),
(4114, NULL, 'Manikpara', '36', 'active', '2025-04-17 09:52:00', '2025-04-17 09:52:00'),
(4115, NULL, 'Masila', '36', 'active', '2025-04-17 09:52:00', '2025-04-17 09:52:00'),
(4116, NULL, 'Mathabhanga', '36', 'active', '2025-04-17 09:52:00', '2025-04-17 09:52:00'),
(4117, NULL, 'Matiali community development block', '36', 'active', '2025-04-17 09:52:00', '2025-04-17 09:52:00'),
(4118, NULL, 'Matigara community development block', '36', 'active', '2025-04-17 09:52:00', '2025-04-17 09:52:00'),
(4119, NULL, 'Medinipur', '36', 'active', '2025-04-17 09:52:00', '2025-04-17 09:52:00'),
(4120, NULL, 'Mejia community development block', '36', 'active', '2025-04-17 09:52:00', '2025-04-17 09:52:00'),
(4121, NULL, 'Memari', '36', 'active', '2025-04-17 09:52:00', '2025-04-17 09:52:00'),
(4122, NULL, 'Mirik', '36', 'active', '2025-04-17 09:52:00', '2025-04-17 09:52:00'),
(4123, NULL, 'Monoharpur', '36', 'active', '2025-04-17 09:52:00', '2025-04-17 09:52:00'),
(4124, NULL, 'Muragacha', '36', 'active', '2025-04-17 09:52:00', '2025-04-17 09:52:00'),
(4125, NULL, 'Muri', '36', 'active', '2025-04-17 09:52:00', '2025-04-17 09:52:00'),
(4126, NULL, 'Murshidabad', '36', 'active', '2025-04-17 09:52:00', '2025-04-17 09:52:00'),
(4127, NULL, 'Nabadwip', '36', 'active', '2025-04-17 09:52:00', '2025-04-17 09:52:00'),
(4128, NULL, 'Nabagram', '36', 'active', '2025-04-17 09:52:00', '2025-04-17 09:52:00'),
(4129, NULL, 'Nadia district', '36', 'active', '2025-04-17 09:52:00', '2025-04-17 09:52:00'),
(4130, NULL, 'Nagarukhra', '36', 'active', '2025-04-17 09:52:00', '2025-04-17 09:52:00'),
(4131, NULL, 'Nagrakata', '36', 'active', '2025-04-17 09:52:00', '2025-04-17 09:52:00'),
(4132, NULL, 'Naihati', '36', 'active', '2025-04-17 09:52:00', '2025-04-17 09:52:00'),
(4133, NULL, 'Naksalbari', '36', 'active', '2025-04-17 09:52:00', '2025-04-17 09:52:00'),
(4134, NULL, 'Nalhati', '36', 'active', '2025-04-17 09:52:00', '2025-04-17 09:52:00'),
(4135, NULL, 'Nalpur', '36', 'active', '2025-04-17 09:52:00', '2025-04-17 09:52:00'),
(4136, NULL, 'Namkhana community development block', '36', 'active', '2025-04-17 09:52:00', '2025-04-17 09:52:00'),
(4137, NULL, 'Nandigram', '36', 'active', '2025-04-17 09:52:00', '2025-04-17 09:52:00'),
(4138, NULL, 'Nangi', '36', 'active', '2025-04-17 09:52:00', '2025-04-17 09:52:00'),
(4139, NULL, 'Nayagram community development block', '36', 'active', '2025-04-17 09:52:00', '2025-04-17 09:52:00'),
(4140, NULL, 'North 24 Parganas district', '36', 'active', '2025-04-17 09:52:00', '2025-04-17 09:52:00'),
(4141, NULL, 'Odlabari', '36', 'active', '2025-04-17 09:52:00', '2025-04-17 09:52:00'),
(4142, NULL, 'Paikpara', '36', 'active', '2025-04-17 09:52:00', '2025-04-17 09:52:00'),
(4143, NULL, 'Panagarh', '36', 'active', '2025-04-17 09:52:00', '2025-04-17 09:52:00'),
(4144, NULL, 'Panchla', '36', 'active', '2025-04-17 09:52:00', '2025-04-17 09:52:00'),
(4145, NULL, 'Panchmura', '36', 'active', '2025-04-17 09:52:00', '2025-04-17 09:52:00'),
(4146, NULL, 'Pandua', '36', 'active', '2025-04-17 09:52:00', '2025-04-17 09:52:00'),
(4147, NULL, 'Panihati', '36', 'active', '2025-04-17 09:52:00', '2025-04-17 09:52:00'),
(4148, NULL, 'Panskura', '36', 'active', '2025-04-17 09:52:00', '2025-04-17 09:52:00'),
(4149, NULL, 'Parbatipur', '36', 'active', '2025-04-17 09:52:00', '2025-04-17 09:52:00'),
(4150, NULL, 'Paschim Medinipur district', '36', 'active', '2025-04-17 09:52:00', '2025-04-17 09:52:00'),
(4151, NULL, 'Patiram', '36', 'active', '2025-04-17 09:52:00', '2025-04-17 09:52:00'),
(4152, NULL, 'Patrasaer', '36', 'active', '2025-04-17 09:52:00', '2025-04-17 09:52:00'),
(4153, NULL, 'Patuli', '36', 'active', '2025-04-17 09:52:00', '2025-04-17 09:52:00'),
(4154, NULL, 'Pujali', '36', 'active', '2025-04-17 09:52:00', '2025-04-17 09:52:00'),
(4155, NULL, 'Puncha community development block', '36', 'active', '2025-04-17 09:52:00', '2025-04-17 09:52:00'),
(4156, NULL, 'Purba Medinipur district', '36', 'active', '2025-04-17 09:52:00', '2025-04-17 09:52:00'),
(4157, NULL, 'Purulia', '36', 'active', '2025-04-17 09:52:00', '2025-04-17 09:52:00'),
(4158, NULL, 'Raghudebbati', '36', 'active', '2025-04-17 09:52:00', '2025-04-17 09:52:00'),
(4159, NULL, 'Raghunathpur', '36', 'active', '2025-04-17 09:52:00', '2025-04-17 09:52:00'),
(4160, NULL, 'Raiganj', '36', 'active', '2025-04-17 09:52:00', '2025-04-17 09:52:00'),
(4161, NULL, 'Rajmahal', '36', 'active', '2025-04-17 09:52:00', '2025-04-17 09:52:00'),
(4162, NULL, 'Rajnagar community development block', '36', 'active', '2025-04-17 09:52:00', '2025-04-17 09:52:00'),
(4163, NULL, 'Ramchandrapur', '36', 'active', '2025-04-17 09:52:00', '2025-04-17 09:52:00'),
(4164, NULL, 'Ramjibanpur', '36', 'active', '2025-04-17 09:52:00', '2025-04-17 09:52:00'),
(4165, NULL, 'Ramnagar', '36', 'active', '2025-04-17 09:52:00', '2025-04-17 09:52:00'),
(4166, NULL, 'Rampur Hat', '36', 'active', '2025-04-17 09:52:00', '2025-04-17 09:52:00'),
(4167, NULL, 'Ranaghat', '36', 'active', '2025-04-17 09:52:00', '2025-04-17 09:52:00'),
(4168, NULL, 'Raniganj', '36', 'active', '2025-04-17 09:52:00', '2025-04-17 09:52:00'),
(4169, NULL, 'Raypur', '36', 'active', '2025-04-17 09:52:00', '2025-04-17 09:52:00'),
(4170, NULL, 'Rishra', '36', 'active', '2025-04-17 09:52:00', '2025-04-17 09:52:00'),
(4171, NULL, 'Sahapur', '36', 'active', '2025-04-17 09:52:00', '2025-04-17 09:52:00'),
(4172, NULL, 'Sainthia', '36', 'active', '2025-04-17 09:52:00', '2025-04-17 09:52:00'),
(4173, NULL, 'Salanpur community development block', '36', 'active', '2025-04-17 09:52:00', '2025-04-17 09:52:00'),
(4174, NULL, 'Sankarpur', '36', 'active', '2025-04-17 09:52:00', '2025-04-17 09:52:00'),
(4175, NULL, 'Sankrail', '36', 'active', '2025-04-17 09:52:00', '2025-04-17 09:52:00'),
(4176, NULL, 'Santipur', '36', 'active', '2025-04-17 09:52:00', '2025-04-17 09:52:00'),
(4177, NULL, 'Santoshpur', '36', 'active', '2025-04-17 09:52:00', '2025-04-17 09:52:00'),
(4178, NULL, 'Santuri community development block', '36', 'active', '2025-04-17 09:52:00', '2025-04-17 09:52:00'),
(4179, NULL, 'Sarenga', '36', 'active', '2025-04-17 09:52:00', '2025-04-17 09:52:00'),
(4180, NULL, 'Serampore', '36', 'active', '2025-04-17 09:52:00', '2025-04-17 09:52:00'),
(4181, NULL, 'Serpur', '36', 'active', '2025-04-17 09:52:00', '2025-04-17 09:52:00'),
(4182, NULL, 'Shyamnagar West Bengal', '36', 'active', '2025-04-17 09:52:00', '2025-04-17 09:52:00'),
(4183, NULL, 'Siliguri', '36', 'active', '2025-04-17 09:52:00', '2025-04-17 09:52:00'),
(4184, NULL, 'Singur', '36', 'active', '2025-04-17 09:52:00', '2025-04-17 09:52:00'),
(4185, NULL, 'Sodpur', '36', 'active', '2025-04-17 09:52:00', '2025-04-17 09:52:00'),
(4186, NULL, 'Solap', '36', 'active', '2025-04-17 09:52:00', '2025-04-17 09:52:00'),
(4187, NULL, 'Sonada', '36', 'active', '2025-04-17 09:52:00', '2025-04-17 09:52:00'),
(4188, NULL, 'Sonamukhi', '36', 'active', '2025-04-17 09:52:00', '2025-04-17 09:52:00'),
(4189, NULL, 'Sonarpur community development block', '36', 'active', '2025-04-17 09:52:00', '2025-04-17 09:52:00'),
(4190, NULL, 'South 24 Parganas district', '36', 'active', '2025-04-17 09:52:00', '2025-04-17 09:52:00'),
(4191, NULL, 'Srikhanda', '36', 'active', '2025-04-17 09:52:00', '2025-04-17 09:52:00'),
(4192, NULL, 'Srirampur', '36', 'active', '2025-04-17 09:52:00', '2025-04-17 09:52:00'),
(4193, NULL, 'Suri', '36', 'active', '2025-04-17 09:52:00', '2025-04-17 09:52:00'),
(4194, NULL, 'Swarupnagar community development block', '36', 'active', '2025-04-17 09:52:00', '2025-04-17 09:52:00'),
(4195, NULL, 'Takdah', '36', 'active', '2025-04-17 09:52:00', '2025-04-17 09:52:00'),
(4196, NULL, 'Taki', '36', 'active', '2025-04-17 09:52:00', '2025-04-17 09:52:00'),
(4197, NULL, 'Tamluk', '36', 'active', '2025-04-17 09:52:00', '2025-04-17 09:52:00'),
(4198, NULL, 'Tarakeswar', '36', 'active', '2025-04-17 09:52:00', '2025-04-17 09:52:00'),
(4199, NULL, 'Titagarh', '36', 'active', '2025-04-17 09:52:00', '2025-04-17 09:52:00'),
(4200, NULL, 'Tufanganj', '36', 'active', '2025-04-17 09:52:00', '2025-04-17 09:52:00'),
(4201, NULL, 'Tulin', '36', 'active', '2025-04-17 09:52:00', '2025-04-17 09:52:00'),
(4202, NULL, 'Uchalan', '36', 'active', '2025-04-17 09:52:00', '2025-04-17 09:52:00'),
(4203, NULL, 'Ula', '36', 'active', '2025-04-17 09:52:00', '2025-04-17 09:52:00'),
(4204, NULL, 'Uluberia', '36', 'active', '2025-04-17 09:52:00', '2025-04-17 09:52:00'),
(4205, NULL, 'Uttar Dinajpur district', '36', 'active', '2025-04-17 09:52:00', '2025-04-17 09:52:00');

-- --------------------------------------------------------

--
-- Table structure for table `module_countries`
--

CREATE TABLE `module_countries` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `slug` varchar(191) DEFAULT NULL,
  `country_name` text DEFAULT NULL,
  `status` enum('active','deactive') NOT NULL DEFAULT 'active',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `module_countries`
--

INSERT INTO `module_countries` (`id`, `slug`, `country_name`, `status`, `created_at`, `updated_at`) VALUES
(1, NULL, 'India', 'active', '2025-04-17 09:06:43', '2025-04-17 09:06:43');

-- --------------------------------------------------------

--
-- Table structure for table `module_faq`
--

CREATE TABLE `module_faq` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `slug` varchar(191) DEFAULT NULL,
  `title` text NOT NULL,
  `faq` text NOT NULL,
  `status` enum('active','deactive') NOT NULL DEFAULT 'active',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `module_fields`
--

CREATE TABLE `module_fields` (
  `id` int(11) NOT NULL,
  `module_id` int(11) NOT NULL,
  `name` varchar(200) NOT NULL,
  `is_slug` enum('0','1') NOT NULL DEFAULT '0',
  `title` varchar(500) DEFAULT NULL,
  `fields` varchar(500) DEFAULT NULL,
  `file_types` varchar(2000) DEFAULT NULL,
  `repeater_fields` varchar(2000) DEFAULT NULL,
  `default_val` varchar(2000) DEFAULT NULL,
  `placeholder` varchar(200) DEFAULT NULL,
  `required` enum('0','1') NOT NULL DEFAULT '0' COMMENT '0=not required,1=Required',
  `options` varchar(1000) DEFAULT NULL,
  `form_sort` int(11) NOT NULL COMMENT 'This Shorting for form structure\r\n',
  `layout_class` varchar(100) NOT NULL DEFAULT 'col-md-12',
  `table_sort` int(11) NOT NULL DEFAULT 0 COMMENT 'This Shorting for table structure\r\n',
  `table_status` enum('0','1') NOT NULL DEFAULT '1' COMMENT '0=deactive,1=active,This status for show feilds in table\r\n',
  `is_relational` enum('0','1') DEFAULT '0' COMMENT '0=static values,1=dynamic values',
  `relational_table` varchar(400) DEFAULT NULL,
  `relational_table_label_field` varchar(400) DEFAULT NULL,
  `relational_table_value_field` varchar(400) DEFAULT NULL,
  `is_filter` enum('0','1') NOT NULL DEFAULT '0' COMMENT '0="not filter" and 1="Filter"',
  `filter_type` varchar(300) DEFAULT NULL,
  `badge_color` text DEFAULT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_at` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `module_fields`
--

INSERT INTO `module_fields` (`id`, `module_id`, `name`, `is_slug`, `title`, `fields`, `file_types`, `repeater_fields`, `default_val`, `placeholder`, `required`, `options`, `form_sort`, `layout_class`, `table_sort`, `table_status`, `is_relational`, `relational_table`, `relational_table_label_field`, `relational_table_value_field`, `is_filter`, `filter_type`, `badge_color`, `created_at`, `updated_at`) VALUES
(1, 1, 'country_name', '0', 'Country Name', 'text', NULL, NULL, NULL, NULL, '0', NULL, 0, 'col-md-12', 0, '1', '0', NULL, NULL, NULL, '0', NULL, NULL, '2025-04-17 14:35:30', '2025-04-17 14:37:17'),
(2, 2, 'state_name', '0', 'State Name', 'text', NULL, NULL, NULL, NULL, '1', NULL, 0, 'col-md-12', 0, '1', '0', NULL, NULL, NULL, '0', NULL, NULL, '2025-04-17 14:39:36', '2025-04-17 15:21:42'),
(3, 2, 'country_name', '0', 'Country Name', 'select', NULL, NULL, NULL, NULL, '1', '[null]', 0, 'col-md-12', 0, '1', '1', 'module_countries', 'country_name', 'id', '0', NULL, NULL, '2025-04-17 14:39:36', '2025-04-17 15:21:42'),
(4, 3, 'city_name', '0', 'city name', 'text', NULL, NULL, NULL, NULL, '1', NULL, 0, 'col-md-12', 1, '1', '0', NULL, NULL, NULL, '0', NULL, NULL, '2025-04-17 15:02:37', '2025-04-17 15:24:24'),
(5, 3, 'state_name', '0', 'State Name', 'select', NULL, NULL, NULL, NULL, '1', '[null]', 0, 'col-md-12', 2, '1', '1', 'module_states', 'state_name', 'id', '1', 'select', NULL, '2025-04-17 15:02:37', '2025-04-17 15:24:28'),
(6, 4, 'title', '0', 'title', 'text', NULL, NULL, NULL, 'Title', '1', NULL, 1, 'col-md-12', 0, '1', '0', NULL, NULL, NULL, '0', NULL, NULL, '2025-07-08 14:32:12', '2025-07-11 10:45:45'),
(7, 4, 'faq', '0', 'FAQ', 'container_repeater', NULL, '[{\"field\":\"text\",\"title\":\"question\",\"name\":\"question\",\"placeholder\":\"question\",\"default_value\":null,\"layout\":\"col-md-12\"},{\"field\":\"textarea\",\"title\":\"answer\",\"name\":\"answer\",\"placeholder\":\"answer\",\"default_value\":null,\"layout\":\"col-md-12\"}]', NULL, NULL, '1', NULL, 2, 'col-md-12', 0, '1', '0', NULL, NULL, NULL, '0', NULL, NULL, '2025-07-08 14:32:12', '2025-07-11 10:45:45'),
(8, 5, 'title', '0', 'title', 'text', NULL, NULL, NULL, 'Enter title', '1', NULL, 1, 'col-md-12', 0, '1', '0', NULL, NULL, NULL, '0', NULL, NULL, '2025-07-08 14:34:17', '2025-07-08 14:34:17'),
(9, 5, 'description', '0', 'description', 'text_editor', NULL, NULL, NULL, 'Enter Description', '1', NULL, 2, 'col-md-12', 0, '1', '0', NULL, NULL, NULL, '0', NULL, NULL, '2025-07-08 14:34:17', '2025-07-08 14:34:17'),
(10, 6, 'title', '0', 'title', 'text', NULL, NULL, NULL, 'Enter title', '1', NULL, 1, 'col-md-12', 0, '1', '0', NULL, NULL, NULL, '0', NULL, NULL, '2025-07-08 14:36:49', '2025-07-08 14:36:49'),
(11, 6, 'image', '0', 'image', 'single_file', '[\"image\\/jpeg\",\"image\\/png\",\"image\\/bmp\",\"image\\/webp\"]', NULL, NULL, NULL, '1', NULL, 2, 'col-md-12', 0, '1', '0', NULL, NULL, NULL, '0', NULL, NULL, '2025-07-08 14:36:49', '2025-07-08 14:36:49'),
(12, 6, 'link', '0', 'link', 'text', NULL, NULL, NULL, 'Enter link', '1', NULL, 3, 'col-md-12', 0, '1', '0', NULL, NULL, NULL, '0', NULL, NULL, '2025-07-08 14:36:49', '2025-07-08 14:36:49');

-- --------------------------------------------------------

--
-- Table structure for table `module_links`
--

CREATE TABLE `module_links` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `slug` varchar(191) DEFAULT NULL,
  `title` text NOT NULL,
  `image` text NOT NULL,
  `link` text NOT NULL,
  `status` enum('active','deactive') NOT NULL DEFAULT 'active',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `module_pages`
--

CREATE TABLE `module_pages` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `slug` varchar(191) DEFAULT NULL,
  `title` text NOT NULL,
  `description` text NOT NULL,
  `status` enum('active','deactive') NOT NULL DEFAULT 'active',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `module_states`
--

CREATE TABLE `module_states` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `slug` varchar(191) DEFAULT NULL,
  `state_name` text NOT NULL,
  `country_name` text NOT NULL,
  `status` enum('active','deactive') NOT NULL DEFAULT 'active',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `module_states`
--

INSERT INTO `module_states` (`id`, `slug`, `state_name`, `country_name`, `status`, `created_at`, `updated_at`) VALUES
(1, NULL, 'Andaman and Nicobar Islands', '1', 'active', '2025-04-17 09:29:58', '2025-04-17 09:29:58'),
(2, NULL, 'Andhra Pradesh', '1', 'active', '2025-04-17 09:29:58', '2025-04-17 09:29:58'),
(3, NULL, 'Arunachal Pradesh', '1', 'active', '2025-04-17 09:29:58', '2025-04-17 09:29:58'),
(4, NULL, 'Assam', '1', 'active', '2025-04-17 09:29:58', '2025-04-17 09:29:58'),
(5, NULL, 'Bihar', '1', 'active', '2025-04-17 09:29:58', '2025-04-17 09:29:58'),
(6, NULL, 'Chandigarh', '1', 'active', '2025-04-17 09:29:58', '2025-04-17 09:29:58'),
(7, NULL, 'Chhattisgarh', '1', 'active', '2025-04-17 09:29:58', '2025-04-17 09:29:58'),
(8, NULL, 'Dadra and Nagar Haveli and Daman and Diu', '1', 'active', '2025-04-17 09:29:58', '2025-04-17 09:29:58'),
(9, NULL, 'Delhi', '1', 'active', '2025-04-17 09:29:58', '2025-04-17 09:29:58'),
(10, NULL, 'Goa', '1', 'active', '2025-04-17 09:29:58', '2025-04-17 09:29:58'),
(11, NULL, 'Gujarat', '1', 'active', '2025-04-17 09:29:58', '2025-04-17 09:29:58'),
(12, NULL, 'Haryana', '1', 'active', '2025-04-17 09:29:58', '2025-04-17 09:29:58'),
(13, NULL, 'Himachal Pradesh', '1', 'active', '2025-04-17 09:29:58', '2025-04-17 09:29:58'),
(14, NULL, 'Jammu and Kashmir', '1', 'active', '2025-04-17 09:29:58', '2025-04-17 09:29:58'),
(15, NULL, 'Jharkhand', '1', 'active', '2025-04-17 09:29:58', '2025-04-17 09:29:58'),
(16, NULL, 'Karnataka', '1', 'active', '2025-04-17 09:29:58', '2025-04-17 09:29:58'),
(17, NULL, 'Kerala', '1', 'active', '2025-04-17 09:29:58', '2025-04-17 09:29:58'),
(18, NULL, 'Ladakh', '1', 'active', '2025-04-17 09:29:58', '2025-04-17 09:29:58'),
(19, NULL, 'Lakshadweep', '1', 'active', '2025-04-17 09:29:58', '2025-04-17 09:29:58'),
(20, NULL, 'Madhya Pradesh', '1', 'active', '2025-04-17 09:29:58', '2025-04-17 09:29:58'),
(21, NULL, 'Maharashtra', '1', 'active', '2025-04-17 09:29:58', '2025-04-17 09:29:58'),
(22, NULL, 'Manipur', '1', 'active', '2025-04-17 09:29:58', '2025-04-17 09:29:58'),
(23, NULL, 'Meghalaya', '1', 'active', '2025-04-17 09:29:58', '2025-04-17 09:29:58'),
(24, NULL, 'Mizoram', '1', 'active', '2025-04-17 09:29:58', '2025-04-17 09:29:58'),
(25, NULL, 'Nagaland', '1', 'active', '2025-04-17 09:29:58', '2025-04-17 09:29:58'),
(26, NULL, 'Odisha', '1', 'active', '2025-04-17 09:29:58', '2025-04-17 09:29:58'),
(27, NULL, 'Puducherry', '1', 'active', '2025-04-17 09:29:58', '2025-04-17 09:29:58'),
(28, NULL, 'Punjab', '1', 'active', '2025-04-17 09:29:58', '2025-04-17 09:29:58'),
(29, NULL, 'Rajasthan', '1', 'active', '2025-04-17 09:29:58', '2025-04-17 09:29:58'),
(30, NULL, 'Sikkim', '1', 'active', '2025-04-17 09:29:58', '2025-04-17 09:29:58'),
(31, NULL, 'Tamil Nadu', '1', 'active', '2025-04-17 09:29:58', '2025-04-17 09:29:58'),
(32, NULL, 'Telangana', '1', 'active', '2025-04-17 09:29:58', '2025-04-17 09:29:58'),
(33, NULL, 'Tripura', '1', 'active', '2025-04-17 09:29:58', '2025-04-17 09:29:58'),
(34, NULL, 'Uttar Pradesh', '1', 'active', '2025-04-17 09:29:58', '2025-04-17 09:29:58'),
(35, NULL, 'Uttarakhand', '1', 'active', '2025-04-17 09:29:58', '2025-04-17 09:29:58'),
(36, NULL, 'West Bengal', '1', 'active', '2025-04-17 09:47:55', '2025-04-17 09:47:55');

-- --------------------------------------------------------

--
-- Table structure for table `nex_settings`
--

CREATE TABLE `nex_settings` (
  `id` int(11) NOT NULL,
  `setting_field_name` text NOT NULL,
  `setting_field_value` text NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `nex_settings`
--

INSERT INTO `nex_settings` (`id`, `setting_field_name`, `setting_field_value`, `created_at`, `updated_at`) VALUES
(1, 'site_name', 'LaxmiDhara Fashion', '2023-09-09 04:07:00', '2025-08-13 15:14:55'),
(2, 'site_description', 'Welcome to LaxmiDhara Fashion.', '2023-09-09 16:09:52', '2025-08-13 15:14:55'),
(3, 'site_postal_address', '1ST FLOOR, 463, New GIDC, Old GIDC, Katargam, Surat, Gujarat 395008', '2023-09-09 16:12:37', '2025-08-13 15:14:55'),
(4, 'site_office_time_message', 'Monday to Saturday(10AM - 06PM)', '2023-09-09 16:13:28', '2023-09-09 16:13:28'),
(5, 'site_about_us', 'Welcome to LaxmiDhara Fashion. We stay always for you.', '2023-09-09 16:14:23', '2025-08-13 15:14:55'),
(6, 'site_keywords', 'Welcome to LaxmiDhara Fashion.', '2023-09-09 16:15:37', '2025-08-13 15:14:55'),
(7, 'site_logo', '13082025151455.jpeg', '2023-09-09 16:16:32', '2025-08-13 15:14:55'),
(8, 'site_favicon_logo', '13082025151455.png', '2023-09-09 16:17:09', '2025-08-13 15:14:55'),
(9, 'site_email', 'ldfstudio@gmail.com', '2023-09-09 16:17:34', '2025-08-13 15:14:55'),
(10, 'site_contact', '963 837 3401', '2023-09-09 16:18:15', '2025-08-13 15:14:55'),
(11, 'site_whattsapp_number', '963 837 3401', '2023-09-09 16:20:04', '2025-08-13 15:14:55'),
(12, 'site_link', 'http://127.0.0.1:8000', '2023-09-09 16:20:48', '2025-08-13 15:14:55'),
(13, 'site_mail_host', 'sridixtechnology@gmail.com', '2023-09-09 16:21:54', '2025-05-20 14:45:16'),
(14, 'site_mail_username', 'sridixtechnology@gmail.com', '2023-09-09 16:22:43', '2025-05-20 14:45:16'),
(15, 'site_mail_password', '987654321', '2023-09-09 16:23:19', '2025-05-20 14:45:16'),
(16, 'site_mail_port', '987654321', '2023-09-09 16:23:47', '2025-05-20 14:45:16'),
(17, 'site_404_image', '', '2023-09-09 16:24:14', '2023-09-09 16:24:14'),
(18, 'site_status', 'publish', '2023-09-09 16:24:29', '2025-08-13 15:14:55'),
(19, 'site_gst_percentage', '', '2023-09-09 16:25:04', '2023-09-09 16:25:04'),
(20, 'site_topbar_header_background_color', '#ffffff', '2023-09-09 16:25:38', '2025-08-18 12:26:53'),
(21, 'site_topbar_header_color', '#000000', '2023-09-09 16:26:08', '2025-08-18 12:26:53'),
(22, 'site_page_title_background_color', '#ffffff', '2023-09-09 16:27:02', '2025-08-18 12:26:53'),
(23, 'site_page_title_color', '#000000', '2023-09-09 16:27:36', '2025-08-18 12:26:53'),
(24, 'site_sidebar_background_color', '#ffffff', '2023-09-09 16:27:53', '2025-08-18 12:26:53'),
(25, 'site_sidebar_color', '#000000', '2023-09-09 16:28:12', '2025-08-18 12:26:53'),
(26, 'site_modal_action', 'fadeIn', '2023-09-09 16:28:41', '2025-08-18 12:26:53'),
(27, 'site_security', 'on', '2023-09-09 17:44:48', '2025-08-13 15:14:55'),
(28, 'site_meta_title', 'LaxmiDhara Fashion', '2024-12-27 13:10:25', '2025-08-13 15:14:55'),
(29, 'site_meta_url', 'LaxmiDhara Fashion', '2024-12-27 13:10:25', '2025-08-13 15:14:55'),
(30, 'site_meta_keyword', 'LaxmiDhara Fashion', '2024-12-27 13:10:25', '2025-08-13 15:14:55'),
(31, 'site_meta_description', 'LaxmiDhara Fashion', '2024-12-27 13:10:25', '2025-08-13 15:14:55'),
(32, 'site_primary_color', '#3b82f6', '2025-03-11 10:46:42', '2025-08-18 12:26:53');

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `order_number` varchar(191) NOT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `order_status` bigint(20) UNSIGNED DEFAULT NULL,
  `payment_type` enum('cod','razorpay','paypal') NOT NULL DEFAULT 'cod',
  `payment_status` enum('pending','failed','complete') NOT NULL DEFAULT 'pending',
  `sub_amount` int(11) NOT NULL,
  `discount_amount` int(11) DEFAULT NULL,
  `tax_amount` int(11) DEFAULT NULL,
  `total_amount` int(11) NOT NULL,
  `coupon_id` bigint(20) UNSIGNED DEFAULT NULL,
  `status_message` varchar(191) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `order_addresses`
--

CREATE TABLE `order_addresses` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `order_id` bigint(20) UNSIGNED DEFAULT NULL,
  `address_type` enum('billing','delivery') NOT NULL DEFAULT 'billing',
  `pincode` int(11) DEFAULT NULL,
  `address_line_1` longtext NOT NULL,
  `address_line_2` longtext DEFAULT NULL,
  `landmark` varchar(191) DEFAULT NULL,
  `city` varchar(191) NOT NULL,
  `state_name` varchar(191) NOT NULL,
  `state_id` bigint(20) UNSIGNED DEFAULT NULL,
  `country_name` varchar(191) NOT NULL,
  `country_id` bigint(20) UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `order_children`
--

CREATE TABLE `order_children` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `order_id` bigint(20) UNSIGNED DEFAULT NULL,
  `product_id` bigint(20) UNSIGNED NOT NULL,
  `product_variant_id` bigint(20) UNSIGNED DEFAULT NULL,
  `qty` int(11) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `order_statuses`
--

CREATE TABLE `order_statuses` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `orderstatus_name` varchar(191) NOT NULL,
  `status_group` enum('pending','processing','complete','cancel') NOT NULL DEFAULT 'pending',
  `bg_color` varchar(300) NOT NULL,
  `sort_status` int(11) NOT NULL DEFAULT 0,
  `status` enum('active','deactive') NOT NULL DEFAULT 'active',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `order_statuses`
--

INSERT INTO `order_statuses` (`id`, `orderstatus_name`, `status_group`, `bg_color`, `sort_status`, `status`, `created_at`, `updated_at`) VALUES
(1, 'pending', 'pending', '#e9f448', 1, 'active', '2025-07-29 10:23:43', '2025-08-13 12:11:26'),
(2, 'processing', 'processing', '#41dfe1', 2, 'active', '2025-07-29 10:24:05', '2025-08-13 12:11:26'),
(3, 'complete', 'complete', '#38d675', 4, 'active', '2025-07-29 10:24:23', '2025-07-29 11:02:09'),
(4, 'cancel', 'cancel', '#d62e2e', 3, 'active', '2025-07-29 10:24:42', '2025-07-29 11:02:09');

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(191) NOT NULL,
  `token` varchar(191) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `payment_histories`
--

CREATE TABLE `payment_histories` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `gateway_order_id` varchar(191) DEFAULT NULL,
  `receipt` varchar(191) DEFAULT NULL,
  `amount` decimal(10,2) NOT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `order_id` bigint(20) UNSIGNED DEFAULT NULL,
  `payment_type` enum('cod','razorpay','paypal') NOT NULL DEFAULT 'cod',
  `payment_status` enum('pending','failed','complete') NOT NULL DEFAULT 'pending',
  `status_message` varchar(191) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `permissions`
--

CREATE TABLE `permissions` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(191) NOT NULL,
  `guard_name` varchar(191) NOT NULL,
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `permissions`
--

INSERT INTO `permissions` (`id`, `name`, `guard_name`, `created_at`, `updated_at`) VALUES
(1, '2.user.read', 'admin', NULL, NULL),
(2, '2.user.create', 'admin', NULL, NULL),
(3, '2.user.edit', 'admin', NULL, NULL),
(4, '2.user.delete', 'admin', NULL, NULL),
(5, '2.user.view', 'admin', NULL, NULL),
(6, '2.user.status', 'admin', NULL, NULL),
(7, '2.user.export', 'admin', NULL, NULL),
(8, '2.user.import', 'admin', NULL, NULL),
(9, '2.role.read', 'admin', NULL, NULL),
(10, '2.role.create', 'admin', NULL, NULL),
(11, '2.role.edit', 'admin', NULL, NULL),
(12, '2.role.delete', 'admin', NULL, NULL),
(13, '2.role.view', 'admin', NULL, NULL),
(14, '2.role.status', 'admin', NULL, NULL),
(15, '2.role.export', 'admin', NULL, NULL),
(16, '2.role.import', 'admin', NULL, NULL),
(17, '2.permission.read', 'admin', NULL, NULL),
(18, '2.permission.create', 'admin', NULL, NULL),
(19, '2.permission.edit', 'admin', NULL, NULL),
(20, '2.permission.delete', 'admin', NULL, NULL),
(21, '2.permission.view', 'admin', NULL, NULL),
(22, '2.permission.status', 'admin', NULL, NULL),
(23, '2.permission.export', 'admin', NULL, NULL),
(24, '2.permission.import', 'admin', NULL, NULL),
(25, '3.user.read', 'admin', NULL, NULL),
(26, '3.user.create', 'admin', NULL, NULL),
(27, '3.user.edit', 'admin', NULL, NULL),
(28, '3.user.delete', 'admin', NULL, NULL),
(29, '3.user.view', 'admin', NULL, NULL),
(30, '3.user.status', 'admin', NULL, NULL),
(31, '3.user.export', 'admin', NULL, NULL),
(32, '3.user.import', 'admin', NULL, NULL),
(33, '3.role.read', 'admin', NULL, NULL),
(34, '3.role.create', 'admin', NULL, NULL),
(35, '3.role.edit', 'admin', NULL, NULL),
(36, '3.role.delete', 'admin', NULL, NULL),
(37, '3.role.view', 'admin', NULL, NULL),
(38, '3.role.status', 'admin', NULL, NULL),
(39, '3.role.export', 'admin', NULL, NULL),
(40, '3.role.import', 'admin', NULL, NULL),
(41, '3.permission.read', 'admin', NULL, NULL),
(42, '3.permission.create', 'admin', NULL, NULL),
(43, '3.permission.edit', 'admin', NULL, NULL),
(44, '3.permission.delete', 'admin', NULL, NULL),
(45, '3.permission.view', 'admin', NULL, NULL),
(46, '3.permission.status', 'admin', NULL, NULL),
(47, '3.permission.export', 'admin', NULL, NULL),
(48, '3.permission.import', 'admin', NULL, NULL),
(49, '2.testing.read', 'admin', NULL, NULL),
(50, '2.testing.create', 'admin', NULL, NULL),
(51, '2.testing.edit', 'admin', NULL, NULL),
(52, '2.testing.delete', 'admin', NULL, NULL),
(53, '2.testing.view', 'admin', NULL, NULL),
(54, '2.testing.status', 'admin', NULL, NULL),
(55, '2.testing.export', 'admin', NULL, NULL),
(56, '2.testing.import', 'admin', NULL, NULL),
(209, '3.testing.read', 'admin', NULL, NULL),
(210, '3.testing.create', 'admin', NULL, NULL),
(211, '3.testing.edit', 'admin', NULL, NULL),
(212, '3.testing.delete', 'admin', NULL, NULL),
(213, '3.testing.view', 'admin', NULL, NULL),
(214, '3.testing.status', 'admin', NULL, NULL),
(215, '3.testing.export', 'admin', NULL, NULL),
(216, '3.testing.import', 'admin', NULL, NULL),
(337, '2.producttags.read', 'admin', NULL, NULL),
(338, '2.producttags.create', 'admin', NULL, NULL),
(339, '2.producttags.edit', 'admin', NULL, NULL),
(340, '2.producttags.delete', 'admin', NULL, NULL),
(341, '2.producttags.view', 'admin', NULL, NULL),
(342, '2.producttags.status', 'admin', NULL, NULL),
(343, '2.producttags.export', 'admin', NULL, NULL),
(344, '2.producttags.import', 'admin', NULL, NULL),
(1177, '2.categories.read', 'admin', NULL, NULL),
(1178, '2.categories.create', 'admin', NULL, NULL),
(1179, '2.categories.edit', 'admin', NULL, NULL),
(1180, '2.categories.delete', 'admin', NULL, NULL),
(1181, '2.categories.view', 'admin', NULL, NULL),
(1182, '2.categories.status', 'admin', NULL, NULL),
(1183, '2.categories.export', 'admin', NULL, NULL),
(1184, '2.categories.import', 'admin', NULL, NULL),
(2233, '2.variants.read', 'admin', NULL, NULL),
(2234, '2.variants.create', 'admin', NULL, NULL),
(2235, '2.variants.edit', 'admin', NULL, NULL),
(2236, '2.variants.delete', 'admin', NULL, NULL),
(2237, '2.variants.view', 'admin', NULL, NULL),
(2238, '2.variants.status', 'admin', NULL, NULL),
(2239, '2.variants.export', 'admin', NULL, NULL),
(2240, '2.variants.import', 'admin', NULL, NULL),
(2354, '2.productflag.read', 'admin', '2025-06-03 08:44:40', '2025-06-03 08:44:40'),
(2355, '2.productflag.create', 'admin', '2025-06-03 08:44:40', '2025-06-03 08:44:40'),
(2356, '2.productflag.edit', 'admin', '2025-06-03 08:44:40', '2025-06-03 08:44:40'),
(2357, '2.productflag.delete', 'admin', '2025-06-03 08:44:40', '2025-06-03 08:44:40'),
(2358, '2.productflag.view', 'admin', '2025-06-03 08:44:40', '2025-06-03 08:44:40'),
(2359, '2.productflag.status', 'admin', '2025-06-03 08:44:40', '2025-06-03 08:44:40'),
(2360, '2.productflag.export', 'admin', '2025-06-03 08:44:40', '2025-06-03 08:44:40'),
(2361, '2.productflag.import', 'admin', '2025-06-03 08:44:40', '2025-06-03 08:44:40'),
(2418, '2.productflags.read', 'admin', '2025-06-03 08:45:06', '2025-06-03 08:45:06'),
(2419, '2.productflags.create', 'admin', '2025-06-03 08:45:06', '2025-06-03 08:45:06'),
(2420, '2.productflags.edit', 'admin', '2025-06-03 08:45:06', '2025-06-03 08:45:06'),
(2421, '2.productflags.delete', 'admin', '2025-06-03 08:45:06', '2025-06-03 08:45:06'),
(2422, '2.productflags.view', 'admin', '2025-06-03 08:45:06', '2025-06-03 08:45:06'),
(2423, '2.productflags.status', 'admin', '2025-06-03 08:45:06', '2025-06-03 08:45:06'),
(2424, '2.productflags.export', 'admin', '2025-06-03 08:45:06', '2025-06-03 08:45:06'),
(2425, '2.productflags.import', 'admin', '2025-06-03 08:45:06', '2025-06-03 08:45:06'),
(2994, '2.brands.read', 'admin', '2025-06-03 09:30:43', '2025-06-03 09:30:43'),
(2995, '2.brands.create', 'admin', '2025-06-03 09:30:43', '2025-06-03 09:30:43'),
(2996, '2.brands.edit', 'admin', '2025-06-03 09:30:43', '2025-06-03 09:30:43'),
(2997, '2.brands.delete', 'admin', '2025-06-03 09:30:43', '2025-06-03 09:30:43'),
(2998, '2.brands.view', 'admin', '2025-06-03 09:30:43', '2025-06-03 09:30:43'),
(2999, '2.brands.status', 'admin', '2025-06-03 09:30:43', '2025-06-03 09:30:43'),
(3000, '2.brands.export', 'admin', '2025-06-03 09:30:43', '2025-06-03 09:30:43'),
(3001, '2.brands.import', 'admin', '2025-06-03 09:30:43', '2025-06-03 09:30:43'),
(3714, '2.orderstatus.read', 'admin', '2025-06-03 10:06:57', '2025-06-03 10:06:57'),
(3715, '2.orderstatus.create', 'admin', '2025-06-03 10:06:57', '2025-06-03 10:06:57'),
(3716, '2.orderstatus.edit', 'admin', '2025-06-03 10:06:57', '2025-06-03 10:06:57'),
(3717, '2.orderstatus.delete', 'admin', '2025-06-03 10:06:57', '2025-06-03 10:06:57'),
(3718, '2.orderstatus.view', 'admin', '2025-06-03 10:06:57', '2025-06-03 10:06:57'),
(3719, '2.orderstatus.status', 'admin', '2025-06-03 10:06:57', '2025-06-03 10:06:57'),
(3720, '2.orderstatus.export', 'admin', '2025-06-03 10:06:57', '2025-06-03 10:06:57'),
(3721, '2.orderstatus.import', 'admin', '2025-06-03 10:06:57', '2025-06-03 10:06:57'),
(4514, '2.coupons.read', 'admin', '2025-06-03 10:47:08', '2025-06-03 10:47:08'),
(4515, '2.coupons.create', 'admin', '2025-06-03 10:47:08', '2025-06-03 10:47:08'),
(4516, '2.coupons.edit', 'admin', '2025-06-03 10:47:08', '2025-06-03 10:47:08'),
(4517, '2.coupons.delete', 'admin', '2025-06-03 10:47:08', '2025-06-03 10:47:08'),
(4518, '2.coupons.view', 'admin', '2025-06-03 10:47:08', '2025-06-03 10:47:08'),
(4519, '2.coupons.status', 'admin', '2025-06-03 10:47:08', '2025-06-03 10:47:08'),
(4520, '2.coupons.export', 'admin', '2025-06-03 10:47:08', '2025-06-03 10:47:08'),
(4521, '2.coupons.import', 'admin', '2025-06-03 10:47:08', '2025-06-03 10:47:08'),
(5218, '2.banners.read', 'admin', '2025-06-03 11:27:46', '2025-06-03 11:27:46'),
(5219, '2.banners.create', 'admin', '2025-06-03 11:27:46', '2025-06-03 11:27:46'),
(5220, '2.banners.edit', 'admin', '2025-06-03 11:27:46', '2025-06-03 11:27:46'),
(5221, '2.banners.delete', 'admin', '2025-06-03 11:27:46', '2025-06-03 11:27:46'),
(5222, '2.banners.view', 'admin', '2025-06-03 11:27:46', '2025-06-03 11:27:46'),
(5223, '2.banners.status', 'admin', '2025-06-03 11:27:46', '2025-06-03 11:27:46'),
(5224, '2.banners.export', 'admin', '2025-06-03 11:27:46', '2025-06-03 11:27:46'),
(5225, '2.banners.import', 'admin', '2025-06-03 11:27:46', '2025-06-03 11:27:46'),
(5794, '2.product.read', 'admin', '2025-06-03 11:48:23', '2025-06-03 11:48:23'),
(5795, '2.product.create', 'admin', '2025-06-03 11:48:23', '2025-06-03 11:48:23'),
(5796, '2.product.edit', 'admin', '2025-06-03 11:48:23', '2025-06-03 11:48:23'),
(5797, '2.product.delete', 'admin', '2025-06-03 11:48:23', '2025-06-03 11:48:23'),
(5798, '2.product.view', 'admin', '2025-06-03 11:48:23', '2025-06-03 11:48:23'),
(5799, '2.product.status', 'admin', '2025-06-03 11:48:23', '2025-06-03 11:48:23'),
(5800, '2.product.export', 'admin', '2025-06-03 11:48:23', '2025-06-03 11:48:23'),
(5801, '2.product.import', 'admin', '2025-06-03 11:48:23', '2025-06-03 11:48:23'),
(6002, '2.products.read', 'admin', '2025-06-03 11:48:44', '2025-06-03 11:48:44'),
(6003, '2.products.create', 'admin', '2025-06-03 11:48:44', '2025-06-03 11:48:44'),
(6004, '2.products.edit', 'admin', '2025-06-03 11:48:44', '2025-06-03 11:48:44'),
(6005, '2.products.delete', 'admin', '2025-06-03 11:48:44', '2025-06-03 11:48:44'),
(6006, '2.products.view', 'admin', '2025-06-03 11:48:44', '2025-06-03 11:48:44'),
(6007, '2.products.status', 'admin', '2025-06-03 11:48:44', '2025-06-03 11:48:44'),
(6008, '2.products.export', 'admin', '2025-06-03 11:48:44', '2025-06-03 11:48:44'),
(6009, '2.products.import', 'admin', '2025-06-03 11:48:44', '2025-06-03 11:48:44'),
(9155, '2.productreview.read', 'admin', '2025-06-04 13:27:05', '2025-06-04 13:27:05'),
(9156, '2.productreview.create', 'admin', '2025-06-04 13:27:05', '2025-06-04 13:27:05'),
(9157, '2.productreview.edit', 'admin', '2025-06-04 13:27:05', '2025-06-04 13:27:05'),
(9158, '2.productreview.delete', 'admin', '2025-06-04 13:27:05', '2025-06-04 13:27:05'),
(9159, '2.productreview.view', 'admin', '2025-06-04 13:27:05', '2025-06-04 13:27:05'),
(9160, '2.productreview.status', 'admin', '2025-06-04 13:27:05', '2025-06-04 13:27:05'),
(9161, '2.productreview.export', 'admin', '2025-06-04 13:27:05', '2025-06-04 13:27:05'),
(9162, '2.productreview.import', 'admin', '2025-06-04 13:27:05', '2025-06-04 13:27:05'),
(10092, '2.client.read', 'admin', '2025-08-02 06:07:43', '2025-08-02 06:07:43'),
(10093, '2.client.create', 'admin', '2025-08-02 06:07:43', '2025-08-02 06:07:43'),
(10094, '2.client.edit', 'admin', '2025-08-02 06:07:43', '2025-08-02 06:07:43'),
(10095, '2.client.delete', 'admin', '2025-08-02 06:07:43', '2025-08-02 06:07:43'),
(10096, '2.client.view', 'admin', '2025-08-02 06:07:43', '2025-08-02 06:07:43'),
(10097, '2.client.status', 'admin', '2025-08-02 06:07:43', '2025-08-02 06:07:43'),
(10098, '2.client.export', 'admin', '2025-08-02 06:07:43', '2025-08-02 06:07:43'),
(10099, '2.client.import', 'admin', '2025-08-02 06:07:43', '2025-08-02 06:07:43'),
(10100, '2.countries.read', 'admin', '2025-08-02 06:07:43', '2025-08-02 06:07:43'),
(10101, '2.countries.create', 'admin', '2025-08-02 06:07:43', '2025-08-02 06:07:43'),
(10102, '2.countries.edit', 'admin', '2025-08-02 06:07:43', '2025-08-02 06:07:43'),
(10103, '2.countries.delete', 'admin', '2025-08-02 06:07:43', '2025-08-02 06:07:43'),
(10104, '2.countries.view', 'admin', '2025-08-02 06:07:43', '2025-08-02 06:07:43'),
(10105, '2.countries.status', 'admin', '2025-08-02 06:07:43', '2025-08-02 06:07:43'),
(10106, '2.countries.export', 'admin', '2025-08-02 06:07:43', '2025-08-02 06:07:43'),
(10107, '2.countries.import', 'admin', '2025-08-02 06:07:43', '2025-08-02 06:07:43'),
(10108, '2.states.read', 'admin', '2025-08-02 06:07:43', '2025-08-02 06:07:43'),
(10109, '2.states.create', 'admin', '2025-08-02 06:07:43', '2025-08-02 06:07:43'),
(10110, '2.states.edit', 'admin', '2025-08-02 06:07:43', '2025-08-02 06:07:43'),
(10111, '2.states.delete', 'admin', '2025-08-02 06:07:43', '2025-08-02 06:07:43'),
(10112, '2.states.view', 'admin', '2025-08-02 06:07:43', '2025-08-02 06:07:43'),
(10113, '2.states.status', 'admin', '2025-08-02 06:07:43', '2025-08-02 06:07:43'),
(10114, '2.states.export', 'admin', '2025-08-02 06:07:43', '2025-08-02 06:07:43'),
(10115, '2.states.import', 'admin', '2025-08-02 06:07:43', '2025-08-02 06:07:43'),
(10116, '2.cities.read', 'admin', '2025-08-02 06:07:43', '2025-08-02 06:07:43'),
(10117, '2.cities.create', 'admin', '2025-08-02 06:07:43', '2025-08-02 06:07:43'),
(10118, '2.cities.edit', 'admin', '2025-08-02 06:07:43', '2025-08-02 06:07:43'),
(10119, '2.cities.delete', 'admin', '2025-08-02 06:07:43', '2025-08-02 06:07:43'),
(10120, '2.cities.view', 'admin', '2025-08-02 06:07:43', '2025-08-02 06:07:43'),
(10121, '2.cities.status', 'admin', '2025-08-02 06:07:43', '2025-08-02 06:07:43'),
(10122, '2.cities.export', 'admin', '2025-08-02 06:07:43', '2025-08-02 06:07:43'),
(10123, '2.cities.import', 'admin', '2025-08-02 06:07:43', '2025-08-02 06:07:43'),
(10124, '2.faq.read', 'admin', '2025-08-02 06:07:43', '2025-08-02 06:07:43'),
(10125, '2.faq.create', 'admin', '2025-08-02 06:07:43', '2025-08-02 06:07:43'),
(10126, '2.faq.edit', 'admin', '2025-08-02 06:07:43', '2025-08-02 06:07:43'),
(10127, '2.faq.delete', 'admin', '2025-08-02 06:07:43', '2025-08-02 06:07:43'),
(10128, '2.faq.view', 'admin', '2025-08-02 06:07:43', '2025-08-02 06:07:43'),
(10129, '2.faq.status', 'admin', '2025-08-02 06:07:43', '2025-08-02 06:07:43'),
(10130, '2.faq.export', 'admin', '2025-08-02 06:07:43', '2025-08-02 06:07:43'),
(10131, '2.faq.import', 'admin', '2025-08-02 06:07:43', '2025-08-02 06:07:43'),
(10132, '2.pages.read', 'admin', '2025-08-02 06:07:43', '2025-08-02 06:07:43'),
(10133, '2.pages.create', 'admin', '2025-08-02 06:07:43', '2025-08-02 06:07:43'),
(10134, '2.pages.edit', 'admin', '2025-08-02 06:07:43', '2025-08-02 06:07:43'),
(10135, '2.pages.delete', 'admin', '2025-08-02 06:07:43', '2025-08-02 06:07:43'),
(10136, '2.pages.view', 'admin', '2025-08-02 06:07:43', '2025-08-02 06:07:43'),
(10137, '2.pages.status', 'admin', '2025-08-02 06:07:43', '2025-08-02 06:07:43'),
(10138, '2.pages.export', 'admin', '2025-08-02 06:07:43', '2025-08-02 06:07:43'),
(10139, '2.pages.import', 'admin', '2025-08-02 06:07:43', '2025-08-02 06:07:43'),
(10140, '2.links.read', 'admin', '2025-08-02 06:07:43', '2025-08-02 06:07:43'),
(10141, '2.links.create', 'admin', '2025-08-02 06:07:43', '2025-08-02 06:07:43'),
(10142, '2.links.edit', 'admin', '2025-08-02 06:07:43', '2025-08-02 06:07:43'),
(10143, '2.links.delete', 'admin', '2025-08-02 06:07:43', '2025-08-02 06:07:43'),
(10144, '2.links.view', 'admin', '2025-08-02 06:07:43', '2025-08-02 06:07:43'),
(10145, '2.links.status', 'admin', '2025-08-02 06:07:43', '2025-08-02 06:07:43'),
(10146, '2.links.export', 'admin', '2025-08-02 06:07:43', '2025-08-02 06:07:43'),
(10147, '2.links.import', 'admin', '2025-08-02 06:07:43', '2025-08-02 06:07:43');

-- --------------------------------------------------------

--
-- Table structure for table `personal_access_tokens`
--

CREATE TABLE `personal_access_tokens` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `tokenable_type` varchar(191) NOT NULL,
  `tokenable_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(191) NOT NULL,
  `token` varchar(64) NOT NULL,
  `abilities` text DEFAULT NULL,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `product_name` varchar(191) NOT NULL,
  `product_slug` varchar(191) NOT NULL,
  `product_sku_code` varchar(191) NOT NULL,
  `product_categorie_id` longtext DEFAULT NULL,
  `product_brand_id` bigint(20) UNSIGNED DEFAULT NULL,
  `frequently_bought` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`frequently_bought`)),
  `product_short_description` varchar(191) DEFAULT NULL,
  `product_long_description` longtext DEFAULT NULL,
  `product_details` longtext DEFAULT NULL,
  `product_additional_details` longtext DEFAULT NULL,
  `product_thumbnail_image` varchar(191) DEFAULT NULL,
  `product_images` longtext DEFAULT NULL,
  `product_mrp` int(11) NOT NULL,
  `product_price` int(11) NOT NULL,
  `product_discount` int(11) NOT NULL,
  `product_stock` int(11) NOT NULL,
  `views` int(11) NOT NULL,
  `status` enum('active','deactive') NOT NULL DEFAULT 'active',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `product_flags`
--

CREATE TABLE `product_flags` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `flag_name` varchar(255) NOT NULL,
  `product_id` longtext NOT NULL,
  `batch_color` varchar(255) NOT NULL,
  `status` enum('active','deactive') NOT NULL DEFAULT 'active',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `product_reviews`
--

CREATE TABLE `product_reviews` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `product_id` bigint(20) UNSIGNED DEFAULT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `stars` int(11) NOT NULL,
  `review_title` longtext NOT NULL,
  `review_description` longtext NOT NULL,
  `review_images` longtext DEFAULT NULL,
  `status` enum('active','deactive') NOT NULL DEFAULT 'active',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `product_tags`
--

CREATE TABLE `product_tags` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `tag_name` varchar(191) NOT NULL,
  `status` enum('active','deactive') NOT NULL DEFAULT 'active',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `product_variants`
--

CREATE TABLE `product_variants` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `product_id` bigint(20) UNSIGNED NOT NULL,
  `variant_parent_id` text NOT NULL,
  `variant_combination` longtext NOT NULL,
  `variant_ids` longtext NOT NULL,
  `product_variant_skucode` varchar(191) DEFAULT NULL,
  `product_variant_youtube_link` varchar(191) DEFAULT NULL,
  `product_variant_thumbnail_image` varchar(191) DEFAULT NULL,
  `product_variant_images` longtext DEFAULT NULL,
  `product_variant_mrp` int(11) NOT NULL,
  `product_variant_price` int(11) NOT NULL,
  `product_variant_discount` int(11) NOT NULL,
  `product_variant_stock` int(11) NOT NULL,
  `status` enum('active','deactive') NOT NULL DEFAULT 'active',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `roles`
--

CREATE TABLE `roles` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(191) NOT NULL,
  `guard_name` varchar(191) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `roles`
--

INSERT INTO `roles` (`id`, `name`, `guard_name`, `created_at`, `updated_at`) VALUES
(2, 'admin', 'admin', '2023-09-01 06:49:49', '2023-09-01 06:49:49'),
(8, 'supperadmin', 'admin', '2024-12-04 09:42:44', '2024-12-04 09:42:44'),
(9, 'staff', 'admin', '2024-12-04 09:42:45', '2024-12-04 09:42:45');

-- --------------------------------------------------------

--
-- Table structure for table `role_has_permissions`
--

CREATE TABLE `role_has_permissions` (
  `permission_id` bigint(20) UNSIGNED NOT NULL,
  `role_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `role_has_permissions`
--

INSERT INTO `role_has_permissions` (`permission_id`, `role_id`) VALUES
(337, 9),
(338, 9),
(339, 9),
(340, 9),
(342, 9),
(1177, 9),
(1178, 9),
(1179, 9),
(1180, 9),
(1182, 9),
(2233, 9),
(2234, 9),
(2235, 9),
(2236, 9),
(2238, 9),
(2354, 9),
(2418, 9),
(2419, 9),
(2420, 9),
(2421, 9),
(2423, 9),
(2994, 9),
(2995, 9),
(2996, 9),
(2997, 9),
(2999, 9),
(3714, 9),
(3715, 9),
(3716, 9),
(3717, 9),
(3719, 9),
(4514, 9),
(4515, 9),
(4516, 9),
(4517, 9),
(4519, 9),
(5218, 9),
(5219, 9),
(5220, 9),
(5221, 9),
(5223, 9),
(5794, 9),
(6002, 9),
(6003, 9),
(6004, 9),
(6005, 9),
(6007, 9),
(9155, 9),
(9156, 9),
(9157, 9),
(9158, 9),
(9160, 9),
(10092, 9),
(10093, 9),
(10094, 9),
(10095, 9),
(10097, 9),
(10100, 9),
(10108, 9),
(10116, 9),
(10124, 9),
(10125, 9),
(10126, 9),
(10127, 9),
(10129, 9),
(10132, 9),
(10133, 9),
(10134, 9),
(10135, 9),
(10137, 9),
(10140, 9),
(10141, 9),
(10142, 9),
(10143, 9),
(10145, 9);

-- --------------------------------------------------------

--
-- Table structure for table `sectiondata`
--

CREATE TABLE `sectiondata` (
  `id` int(11) NOT NULL,
  `section_title` varchar(255) DEFAULT NULL,
  `section_image` varchar(255) DEFAULT NULL,
  `section_description` text DEFAULT NULL,
  `status` enum('active','deactive') NOT NULL DEFAULT 'active',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `sectiondata`
--

INSERT INTO `sectiondata` (`id`, `section_title`, `section_image`, `section_description`, `status`, `created_at`, `updated_at`) VALUES
(1, 'I/C Section', 'Screenshot 2024-09-06 165611.png', 'This is very important.', 'active', '2024-12-26 10:05:37', '2024-12-26 10:06:11');

-- --------------------------------------------------------

--
-- Table structure for table `sidebar`
--

CREATE TABLE `sidebar` (
  `id` int(11) NOT NULL,
  `sidebar_label` varchar(500) NOT NULL,
  `link_type` enum('internal_route','external_link','dynamic_module') DEFAULT NULL,
  `sidebar_link` varchar(500) DEFAULT NULL,
  `sidebar_link_attribute` varchar(500) DEFAULT NULL,
  `is_dropdown` enum('0','1') NOT NULL DEFAULT '0' COMMENT '0= not dropdown and 1= is dropdown',
  `parent_id` int(11) NOT NULL DEFAULT 0,
  `sidebar_icon` varchar(400) DEFAULT NULL,
  `sidebar_roles` varchar(400) NOT NULL,
  `created_by` int(11) NOT NULL,
  `sidebar_sort_index` int(11) DEFAULT 0,
  `dy_module` enum('0','1') NOT NULL DEFAULT '0',
  `module_name` varchar(300) DEFAULT NULL,
  `permissions_slug` varchar(300) DEFAULT NULL,
  `status` enum('active','deactive') NOT NULL DEFAULT 'active',
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_at` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `sidebar`
--

INSERT INTO `sidebar` (`id`, `sidebar_label`, `link_type`, `sidebar_link`, `sidebar_link_attribute`, `is_dropdown`, `parent_id`, `sidebar_icon`, `sidebar_roles`, `created_by`, `sidebar_sort_index`, `dy_module`, `module_name`, `permissions_slug`, `status`, `created_at`, `updated_at`) VALUES
(1, 'dashboard', 'internal_route', 'admin.dashboard', NULL, '0', 0, 'home', '[\"staff\",\"supperadmin\",\"admin\"]', 1, 1, '0', NULL, NULL, 'active', '2025-04-14 16:12:18', '2025-06-02 14:46:06'),
(2, 'Users', NULL, NULL, NULL, '1', 0, 'users', '[\"staff\",\"supperadmin\",\"admin\"]', 1, 11, '0', NULL, 'user', 'active', '2025-04-14 16:12:52', '2025-08-18 12:29:12'),
(3, 'admins', 'internal_route', 'view.user', 'admin', '0', 2, 'circle', '[\"supperadmin\"]', 1, 0, '0', NULL, NULL, 'active', '2025-04-14 16:13:37', '2025-04-14 16:13:37'),
(4, 'Staff', 'internal_route', 'view.user', 'staff', '0', 2, 'circle', '[\"staff\",\"admin\"]', 1, 0, '0', NULL, 'user', 'active', '2025-04-14 16:14:14', '2025-06-02 15:28:19'),
(5, 'Product Config', NULL, NULL, NULL, '1', 0, 'settings', '[\"staff\",\"supperadmin\",\"admin\"]', 1, 3, '0', NULL, NULL, 'active', '2025-04-14 16:14:39', '2025-08-18 12:29:12'),
(6, 'Blogs', 'internal_route', 'blog.index', NULL, '0', 0, 'circle', '[\"staff\",\"supperadmin\",\"admin\"]', 1, 10, '0', NULL, 'blogs', 'deactive', '2025-04-14 16:16:00', '2025-08-18 12:29:12'),
(7, 'Variant', 'internal_route', 'variant.index', NULL, '0', 5, 'circle', '[\"staff\",\"supperadmin\",\"admin\"]', 1, 2, '0', NULL, 'variants', 'active', '2025-04-14 17:19:57', '2025-06-02 19:20:42'),
(8, 'categories', 'internal_route', 'categories.index', NULL, '0', 5, 'circle', '[\"staff\",\"supperadmin\",\"admin\"]', 1, 1, '0', NULL, 'categories', 'active', '2025-04-14 18:10:17', '2025-06-02 18:24:07'),
(9, 'Product Flag', 'internal_route', 'productflag.index', NULL, '0', 5, 'circle', '[\"staff\",\"supperadmin\",\"admin\"]', 1, 3, '0', NULL, 'productflags', 'active', '2025-04-21 18:15:18', '2025-08-18 12:28:11'),
(10, 'Brand Management', 'internal_route', 'brand.index', NULL, '0', 0, 'git-branch', '[\"staff\",\"supperadmin\",\"admin\"]', 1, 7, '0', NULL, 'brands', 'active', '2025-04-23 12:28:29', '2025-08-18 12:29:57'),
(11, 'Order Management', NULL, NULL, NULL, '1', 0, 'shopping-cart', '[\"staff\",\"supperadmin\",\"admin\"]', 1, 5, '0', NULL, '', 'active', '2025-04-23 15:41:31', '2025-08-18 12:29:26'),
(12, 'Coupon', 'internal_route', 'coupon.index', NULL, '0', 0, 'archive', '[\"staff\",\"supperadmin\",\"admin\"]', 1, 6, '0', NULL, 'coupons', 'active', '2025-04-23 16:16:05', '2025-08-18 12:29:57'),
(13, 'Order Status', 'internal_route', 'orderstatus.index', NULL, '0', 11, 'circle', '[\"staff\",\"supperadmin\",\"admin\"]', 1, 2, '0', NULL, 'orderstatus', 'active', '2025-04-23 18:43:02', '2025-07-17 16:35:56'),
(14, 'Product tags', 'internal_route', 'producttags.index', NULL, '0', 5, 'circle', '[\"staff\",\"supperadmin\",\"admin\"]', 1, 5, '0', NULL, 'producttags', 'deactive', '2025-04-25 12:40:56', '2025-08-18 16:34:33'),
(15, 'Banner', 'internal_route', 'banner.index', NULL, '0', 0, 'book-open', '[\"staff\",\"supperadmin\",\"admin\"]', 1, 8, '0', NULL, 'banners', 'active', '2025-04-25 14:22:56', '2025-08-18 12:29:12'),
(17, 'Product', 'internal_route', 'product.index', NULL, '0', 0, 'circle', '[\"staff\",\"supperadmin\",\"admin\"]', 1, 2, '0', NULL, 'products', 'active', '2025-05-21 15:59:57', '2025-08-18 12:29:12'),
(22, 'Product Review', 'internal_route', 'productreview.index', NULL, '0', 0, 'star', '[\"staff\",\"supperadmin\",\"admin\"]', 1, 4, '0', NULL, 'productreview', 'active', '2025-06-04 12:43:45', '2025-08-18 12:29:12'),
(23, 'clients', 'internal_route', 'client.index', NULL, '0', 2, 'circle', '[\"staff\",\"supperadmin\",\"admin\"]', 1, 0, '0', NULL, 'client', 'active', '2025-06-05 17:22:30', '2025-06-06 15:35:08'),
(24, 'slider', 'internal_route', 'slider.index', NULL, '0', 0, 'sliders', '[\"staff\",\"supperadmin\",\"admin\"]', 1, 9, '0', NULL, 'sliders', 'active', '2025-07-07 14:35:07', '2025-08-18 12:29:12'),
(25, 'Other Pages', NULL, NULL, NULL, '1', 0, 'settings', '[\"staff\",\"supperadmin\",\"admin\"]', 1, 12, '0', NULL, '', 'active', '2025-07-08 14:29:36', '2025-08-18 12:29:12'),
(26, 'faqs', 'dynamic_module', 'show.datatable', 'faq', '0', 25, 'circle', '[\"staff\",\"supperadmin\",\"admin\"]', 1, 0, '1', 'faq', '', 'active', '2025-07-08 14:39:33', '2025-07-08 14:39:46'),
(27, 'Pages', 'dynamic_module', 'show.datatable', 'pages', '0', 25, 'circle', '[\"staff\",\"supperadmin\",\"admin\"]', 1, 0, '1', 'pages', '', 'active', '2025-07-08 14:40:15', '2025-07-08 14:40:15'),
(28, 'Links', 'dynamic_module', 'show.datatable', 'links', '0', 25, 'circle', '[\"staff\",\"supperadmin\",\"admin\"]', 1, 0, '1', 'links', '', 'active', '2025-07-08 14:40:47', '2025-07-08 14:40:47'),
(29, 'Orders', 'internal_route', 'order.index', NULL, '0', 11, 'circle', '[\"staff\",\"supperadmin\",\"admin\"]', 1, 1, '0', NULL, 'orders', 'active', '2025-07-17 16:35:20', '2025-07-17 16:35:56'),
(30, 'Stitches', 'internal_route', 'stitches.index', NULL, '0', 5, 'circle', '[\"staff\",\"supperadmin\",\"admin\"]', 1, 4, '0', NULL, 'stitches', 'active', '2025-08-18 16:34:21', '2025-08-18 16:34:33');

-- --------------------------------------------------------

--
-- Table structure for table `sliders`
--

CREATE TABLE `sliders` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `heading_text` varchar(191) NOT NULL,
  `sub_heading_text` varchar(191) NOT NULL,
  `image` varchar(191) NOT NULL,
  `link_type` enum('product','category','link') NOT NULL DEFAULT 'product',
  `link` varchar(191) NOT NULL,
  `status` enum('active','deactive') NOT NULL DEFAULT 'active',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `sliders`
--

INSERT INTO `sliders` (`id`, `heading_text`, `sub_heading_text`, `image`, `link_type`, `link`, `status`, `created_at`, `updated_at`) VALUES
(1, 'slider1slider1slider1slider1', 'get 10% off now', 'upload/slider/2120101622.jpg', 'category', 'example', 'active', '2025-06-09 01:50:12', '2025-06-09 03:47:19'),
(2, 'slider2slider2slider2slider2', 'get 90% off now', 'upload/slider/1134764806.jpg', 'product', 'product4', 'active', '2025-06-09 01:51:33', '2025-07-14 09:21:20'),
(3, 'slider3slider3slider3slider3', 'get 50% off', 'upload/slider/910913985.webp', 'category', 'demo', 'active', '2025-06-09 01:53:55', '2025-07-14 09:22:09');

-- --------------------------------------------------------

--
-- Table structure for table `sort_modules`
--

CREATE TABLE `sort_modules` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `module_id` bigint(20) UNSIGNED NOT NULL,
  `status` enum('0','1') NOT NULL DEFAULT '0',
  `position` int(11) NOT NULL DEFAULT 0,
  `box_size` varchar(300) NOT NULL DEFAULT 'col-md-6',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `staff_roles`
--

CREATE TABLE `staff_roles` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(191) NOT NULL,
  `role_id` bigint(20) UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `staff_roles`
--

INSERT INTO `staff_roles` (`id`, `name`, `role_id`, `created_at`, `updated_at`) VALUES
(2, 'sub_admin', 9, '2025-06-02 06:15:05', '2025-06-02 06:15:13'),
(3, 'demo', 9, '2025-06-02 08:58:08', '2025-06-02 08:58:08');

-- --------------------------------------------------------

--
-- Table structure for table `stitches`
--

CREATE TABLE `stitches` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `title` varchar(191) NOT NULL,
  `price` int(20) NOT NULL DEFAULT 0,
  `status` enum('active','deactive') NOT NULL DEFAULT 'active',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `summary_boxes`
--

CREATE TABLE `summary_boxes` (
  `id` int(11) NOT NULL,
  `box_title` varchar(200) NOT NULL,
  `aggregate_val` enum('count','sum','avg','max','min') NOT NULL,
  `column_name` varchar(200) NOT NULL,
  `table_name` varchar(200) NOT NULL,
  `box_icon` varchar(200) NOT NULL,
  `box_theme` varchar(200) NOT NULL,
  `box_sort` int(11) NOT NULL DEFAULT 0,
  `status` enum('active','deactive') DEFAULT 'active',
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_at` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(191) NOT NULL,
  `email` varchar(191) NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(191) NOT NULL,
  `profile_image` varchar(191) DEFAULT NULL,
  `phone_no` varchar(191) NOT NULL,
  `phone_verified_at` timestamp NULL DEFAULT NULL,
  `gender` enum('male','female','other') NOT NULL DEFAULT 'male',
  `dob` date DEFAULT NULL,
  `user_city_id` bigint(20) UNSIGNED DEFAULT NULL,
  `user_state_id` bigint(20) UNSIGNED DEFAULT NULL,
  `user_country_id` bigint(20) UNSIGNED DEFAULT NULL,
  `pincode` int(11) DEFAULT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `email_verified` enum('verified','not_verified') NOT NULL DEFAULT 'not_verified',
  `phone_verified` enum('verified','not_verified') NOT NULL DEFAULT 'not_verified',
  `status` enum('active','deactive') NOT NULL DEFAULT 'active',
  `status_message` varchar(191) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `profile_image`, `phone_no`, `phone_verified_at`, `gender`, `dob`, `user_city_id`, `user_state_id`, `user_country_id`, `pincode`, `remember_token`, `email_verified`, `phone_verified`, `status`, `status_message`, `created_at`, `updated_at`) VALUES
(1, 'Harsh Dige', 'harshx0522@gmail.com', '2025-07-28 09:15:16', '$2y$10$yywzF51acn7dz.MnvStdy.PEA.wxgN.pmGPjf9.gaxKMc.hwuS9kW', 'upload/clients/110820251718446899d89c73748.jpeg', 's2lqa2hpamtwag%3D%3D', NULL, 'male', '2000-06-05', NULL, NULL, NULL, NULL, NULL, 'verified', 'not_verified', 'active', NULL, '2025-07-28 09:15:16', '2025-08-11 11:48:44'),
(5, 'Admin', 'admin123@gmail.com', '2025-08-06 05:12:41', '$2y$10$EH0nY/H8KoAQ7p8sXvBBEegOafZ4FBuiWDyxKm75f.UF/YM7zAp2i', NULL, 's2lnaGZnZ2hsbQ%3D%3D', NULL, 'male', NULL, NULL, NULL, NULL, NULL, NULL, 'verified', 'not_verified', 'active', NULL, '2025-08-06 05:12:41', '2025-08-06 05:12:41'),
(6, 'Siddharth', 'sidd@gmail.com', '2025-08-07 14:12:29', '$2y$10$t7FCmxy8NrCCh7kvFbLQNOZicJY5hedDL40TkMG6SFG1R12bRrUni', NULL, 'q2JiZGRmZmhoag%3D%3D', NULL, 'male', NULL, NULL, NULL, NULL, NULL, NULL, 'verified', 'not_verified', 'active', NULL, '2025-08-07 14:12:29', '2025-08-07 14:12:29');

-- --------------------------------------------------------

--
-- Table structure for table `user_addresses`
--

CREATE TABLE `user_addresses` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `name` varchar(191) NOT NULL,
  `phone_no` varchar(191) NOT NULL,
  `pincode` int(11) DEFAULT NULL,
  `address_line_1` longtext NOT NULL,
  `address_line_2` longtext DEFAULT NULL,
  `landmark` varchar(191) DEFAULT NULL,
  `city` varchar(191) NOT NULL,
  `state_id` bigint(20) UNSIGNED DEFAULT NULL,
  `country_id` bigint(20) UNSIGNED DEFAULT NULL,
  `default` enum('1','0') NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `user_addresses`
--

INSERT INTO `user_addresses` (`id`, `user_id`, `name`, `phone_no`, `pincode`, `address_line_1`, `address_line_2`, `landmark`, `city`, `state_id`, `country_id`, `default`, `created_at`, `updated_at`) VALUES
(1, 1, 'Harsh Dige', 's2lkZGhsbGpocQ%3D%3D', 395007, 'U1, new supreme chamber, first floor, opp chasswala, ring road', 'asnabad, olpad', 'Opp. CNG', 'Surat', 11, 1, '1', '2025-07-29 07:18:44', '2025-07-29 07:19:38');

-- --------------------------------------------------------

--
-- Table structure for table `variants`
--

CREATE TABLE `variants` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `variant_name` varchar(191) NOT NULL,
  `variant_value` varchar(191) DEFAULT NULL,
  `variant_parent_id` bigint(20) UNSIGNED DEFAULT NULL,
  `is_color` enum('0','1') NOT NULL DEFAULT '0',
  `status` enum('active','deactive') NOT NULL DEFAULT 'active',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `wish_lists`
--

CREATE TABLE `wish_lists` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `product_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `administrators`
--
ALTER TABLE `administrators`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `usercode` (`usercode`),
  ADD KEY `administrators_staff_role_id_foreign` (`staff_role_id`);

--
-- Indexes for table `applied_coupons`
--
ALTER TABLE `applied_coupons`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `applied_coupons_cart_id_unique` (`cart_id`),
  ADD KEY `applied_coupons_user_id_foreign` (`user_id`),
  ADD KEY `applied_coupons_coupon_id_foreign` (`coupon_id`);

--
-- Indexes for table `banners`
--
ALTER TABLE `banners`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `blogs`
--
ALTER TABLE `blogs`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `brands`
--
ALTER TABLE `brands`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `brands_brand_name_unique` (`brand_name`),
  ADD UNIQUE KEY `brands_brand_slug_unique` (`brand_slug`);

--
-- Indexes for table `carts`
--
ALTER TABLE `carts`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `carts_user_id_unique` (`user_id`);

--
-- Indexes for table `cart_children`
--
ALTER TABLE `cart_children`
  ADD PRIMARY KEY (`id`),
  ADD KEY `cart_children_cart_id_foreign` (`cart_id`),
  ADD KEY `cart_children_product_id_foreign` (`product_id`),
  ADD KEY `cart_children_product_variant_id_foreign` (`product_variant_id`);

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `categories_categorie_slug_unique` (`categorie_slug`),
  ADD KEY `categories_categorie_parent_id_foreign` (`categorie_parent_id`);

--
-- Indexes for table `categorie_images`
--
ALTER TABLE `categorie_images`
  ADD PRIMARY KEY (`id`),
  ADD KEY `categorie_images_categorie_id_foreign` (`categorie_id`);

--
-- Indexes for table `coupons`
--
ALTER TABLE `coupons`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `coupons_coupon_name_unique` (`coupon_name`),
  ADD UNIQUE KEY `coupons_coupon_code_unique` (`coupon_code`);

--
-- Indexes for table `earns`
--
ALTER TABLE `earns`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `email_otps`
--
ALTER TABLE `email_otps`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

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
-- Indexes for table `module`
--
ALTER TABLE `module`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `table_name` (`table_name`);

--
-- Indexes for table `module_cities`
--
ALTER TABLE `module_cities`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `module_cities_slug_unique` (`slug`);

--
-- Indexes for table `module_countries`
--
ALTER TABLE `module_countries`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `module_countries_slug_unique` (`slug`);

--
-- Indexes for table `module_faq`
--
ALTER TABLE `module_faq`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `module_faq_slug_unique` (`slug`);

--
-- Indexes for table `module_fields`
--
ALTER TABLE `module_fields`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `module_links`
--
ALTER TABLE `module_links`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `module_inks_slug_unique` (`slug`);

--
-- Indexes for table `module_pages`
--
ALTER TABLE `module_pages`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `module_pages_slug_unique` (`slug`);

--
-- Indexes for table `module_states`
--
ALTER TABLE `module_states`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `module_states_slug_unique` (`slug`);

--
-- Indexes for table `nex_settings`
--
ALTER TABLE `nex_settings`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `orders_order_number_unique` (`order_number`),
  ADD KEY `orders_user_id_foreign` (`user_id`),
  ADD KEY `orders_order_status_foreign` (`order_status`),
  ADD KEY `orders_coupon_id_foreign` (`coupon_id`);

--
-- Indexes for table `order_addresses`
--
ALTER TABLE `order_addresses`
  ADD PRIMARY KEY (`id`),
  ADD KEY `order_addresses_order_id_foreign` (`order_id`),
  ADD KEY `order_addresses_state_id_foreign` (`state_id`),
  ADD KEY `order_addresses_country_id_foreign` (`country_id`);

--
-- Indexes for table `order_children`
--
ALTER TABLE `order_children`
  ADD PRIMARY KEY (`id`),
  ADD KEY `order_children_order_id_foreign` (`order_id`),
  ADD KEY `order_children_product_id_foreign` (`product_id`),
  ADD KEY `order_children_product_variant_id_foreign` (`product_variant_id`);

--
-- Indexes for table `order_statuses`
--
ALTER TABLE `order_statuses`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`);

--
-- Indexes for table `payment_histories`
--
ALTER TABLE `payment_histories`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `payment_histories_gateway_order_id_unique` (`gateway_order_id`),
  ADD UNIQUE KEY `payment_histories_receipt_unique` (`receipt`),
  ADD KEY `payment_histories_user_id_foreign` (`user_id`),
  ADD KEY `payment_histories_order_id_foreign` (`order_id`);

--
-- Indexes for table `permissions`
--
ALTER TABLE `permissions`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `permissions_name_guard_name_unique` (`name`,`guard_name`);

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
  ADD UNIQUE KEY `products_product_slug_unique` (`product_slug`),
  ADD UNIQUE KEY `products_product_sku_code_unique` (`product_sku_code`),
  ADD KEY `products_product_brand_id_foreign` (`product_brand_id`);

--
-- Indexes for table `product_flags`
--
ALTER TABLE `product_flags`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `product_reviews`
--
ALTER TABLE `product_reviews`
  ADD PRIMARY KEY (`id`),
  ADD KEY `product_reviews_product_id_foreign` (`product_id`),
  ADD KEY `product_reviews_user_id_foreign` (`user_id`);

--
-- Indexes for table `product_tags`
--
ALTER TABLE `product_tags`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `product_tags_tag_name_unique` (`tag_name`);

--
-- Indexes for table `product_variants`
--
ALTER TABLE `product_variants`
  ADD PRIMARY KEY (`id`),
  ADD KEY `product_variants_product_id_foreign` (`product_id`);

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
-- Indexes for table `sectiondata`
--
ALTER TABLE `sectiondata`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sidebar`
--
ALTER TABLE `sidebar`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sliders`
--
ALTER TABLE `sliders`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sort_modules`
--
ALTER TABLE `sort_modules`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_modules_user_id_foreign` (`user_id`);

--
-- Indexes for table `staff_roles`
--
ALTER TABLE `staff_roles`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `staff_roles_name_unique` (`name`),
  ADD KEY `staff_roles_role_id_foreign` (`role_id`);

--
-- Indexes for table `stitches`
--
ALTER TABLE `stitches`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `summary_boxes`
--
ALTER TABLE `summary_boxes`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`),
  ADD UNIQUE KEY `users_phone_no_unique` (`phone_no`),
  ADD KEY `users_user_city_id_foreign` (`user_city_id`),
  ADD KEY `users_user_state_id_foreign` (`user_state_id`),
  ADD KEY `users_user_country_id_foreign` (`user_country_id`);

--
-- Indexes for table `user_addresses`
--
ALTER TABLE `user_addresses`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_addresses_user_id_foreign` (`user_id`),
  ADD KEY `user_addresses_state_id_foreign` (`state_id`),
  ADD KEY `user_addresses_country_id_foreign` (`country_id`);

--
-- Indexes for table `variants`
--
ALTER TABLE `variants`
  ADD PRIMARY KEY (`id`),
  ADD KEY `variants_variant_parent_id_foreign` (`variant_parent_id`);

--
-- Indexes for table `wish_lists`
--
ALTER TABLE `wish_lists`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `wish_lists_product_id_unique` (`product_id`),
  ADD KEY `wish_lists_user_id_foreign` (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `administrators`
--
ALTER TABLE `administrators`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `applied_coupons`
--
ALTER TABLE `applied_coupons`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT for table `banners`
--
ALTER TABLE `banners`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `blogs`
--
ALTER TABLE `blogs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `brands`
--
ALTER TABLE `brands`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `carts`
--
ALTER TABLE `carts`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `cart_children`
--
ALTER TABLE `cart_children`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `categorie_images`
--
ALTER TABLE `categorie_images`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `coupons`
--
ALTER TABLE `coupons`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `earns`
--
ALTER TABLE `earns`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `email_otps`
--
ALTER TABLE `email_otps`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=67;

--
-- AUTO_INCREMENT for table `module`
--
ALTER TABLE `module`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `module_cities`
--
ALTER TABLE `module_cities`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4206;

--
-- AUTO_INCREMENT for table `module_countries`
--
ALTER TABLE `module_countries`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `module_faq`
--
ALTER TABLE `module_faq`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `module_fields`
--
ALTER TABLE `module_fields`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `module_links`
--
ALTER TABLE `module_links`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `module_pages`
--
ALTER TABLE `module_pages`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `module_states`
--
ALTER TABLE `module_states`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=37;

--
-- AUTO_INCREMENT for table `nex_settings`
--
ALTER TABLE `nex_settings`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `order_addresses`
--
ALTER TABLE `order_addresses`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `order_children`
--
ALTER TABLE `order_children`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `order_statuses`
--
ALTER TABLE `order_statuses`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `payment_histories`
--
ALTER TABLE `payment_histories`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `permissions`
--
ALTER TABLE `permissions`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10253;

--
-- AUTO_INCREMENT for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `product_flags`
--
ALTER TABLE `product_flags`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `product_reviews`
--
ALTER TABLE `product_reviews`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `product_tags`
--
ALTER TABLE `product_tags`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `product_variants`
--
ALTER TABLE `product_variants`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `roles`
--
ALTER TABLE `roles`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `sectiondata`
--
ALTER TABLE `sectiondata`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `sidebar`
--
ALTER TABLE `sidebar`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- AUTO_INCREMENT for table `sliders`
--
ALTER TABLE `sliders`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `sort_modules`
--
ALTER TABLE `sort_modules`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `staff_roles`
--
ALTER TABLE `staff_roles`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `stitches`
--
ALTER TABLE `stitches`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `summary_boxes`
--
ALTER TABLE `summary_boxes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `user_addresses`
--
ALTER TABLE `user_addresses`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `variants`
--
ALTER TABLE `variants`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=120;

--
-- AUTO_INCREMENT for table `wish_lists`
--
ALTER TABLE `wish_lists`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `administrators`
--
ALTER TABLE `administrators`
  ADD CONSTRAINT `administrators_staff_role_id_foreign` FOREIGN KEY (`staff_role_id`) REFERENCES `staff_roles` (`id`) ON DELETE SET NULL;

--
-- Constraints for table `applied_coupons`
--
ALTER TABLE `applied_coupons`
  ADD CONSTRAINT `applied_coupons_cart_id_foreign` FOREIGN KEY (`cart_id`) REFERENCES `carts` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `applied_coupons_coupon_id_foreign` FOREIGN KEY (`coupon_id`) REFERENCES `coupons` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `applied_coupons_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `carts`
--
ALTER TABLE `carts`
  ADD CONSTRAINT `carts_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `cart_children`
--
ALTER TABLE `cart_children`
  ADD CONSTRAINT `cart_children_cart_id_foreign` FOREIGN KEY (`cart_id`) REFERENCES `carts` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `cart_children_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `cart_children_product_variant_id_foreign` FOREIGN KEY (`product_variant_id`) REFERENCES `product_variants` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `categories`
--
ALTER TABLE `categories`
  ADD CONSTRAINT `categories_categorie_parent_id_foreign` FOREIGN KEY (`categorie_parent_id`) REFERENCES `categories` (`id`) ON DELETE SET NULL;

--
-- Constraints for table `categorie_images`
--
ALTER TABLE `categorie_images`
  ADD CONSTRAINT `categorie_images_categorie_id_foreign` FOREIGN KEY (`categorie_id`) REFERENCES `categories` (`id`) ON DELETE CASCADE;

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
-- Constraints for table `orders`
--
ALTER TABLE `orders`
  ADD CONSTRAINT `orders_coupon_id_foreign` FOREIGN KEY (`coupon_id`) REFERENCES `coupons` (`id`) ON DELETE SET NULL,
  ADD CONSTRAINT `orders_order_status_foreign` FOREIGN KEY (`order_status`) REFERENCES `order_statuses` (`id`),
  ADD CONSTRAINT `orders_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Constraints for table `order_addresses`
--
ALTER TABLE `order_addresses`
  ADD CONSTRAINT `order_addresses_country_id_foreign` FOREIGN KEY (`country_id`) REFERENCES `module_countries` (`id`) ON DELETE SET NULL,
  ADD CONSTRAINT `order_addresses_order_id_foreign` FOREIGN KEY (`order_id`) REFERENCES `orders` (`id`),
  ADD CONSTRAINT `order_addresses_state_id_foreign` FOREIGN KEY (`state_id`) REFERENCES `module_states` (`id`) ON DELETE SET NULL;

--
-- Constraints for table `order_children`
--
ALTER TABLE `order_children`
  ADD CONSTRAINT `order_children_order_id_foreign` FOREIGN KEY (`order_id`) REFERENCES `orders` (`id`),
  ADD CONSTRAINT `order_children_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`),
  ADD CONSTRAINT `order_children_product_variant_id_foreign` FOREIGN KEY (`product_variant_id`) REFERENCES `product_variants` (`id`);

--
-- Constraints for table `payment_histories`
--
ALTER TABLE `payment_histories`
  ADD CONSTRAINT `payment_histories_order_id_foreign` FOREIGN KEY (`order_id`) REFERENCES `orders` (`id`) ON DELETE SET NULL,
  ADD CONSTRAINT `payment_histories_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE SET NULL;

--
-- Constraints for table `products`
--
ALTER TABLE `products`
  ADD CONSTRAINT `products_product_brand_id_foreign` FOREIGN KEY (`product_brand_id`) REFERENCES `brands` (`id`) ON DELETE SET NULL;

--
-- Constraints for table `product_reviews`
--
ALTER TABLE `product_reviews`
  ADD CONSTRAINT `product_reviews_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `product_reviews_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `product_variants`
--
ALTER TABLE `product_variants`
  ADD CONSTRAINT `product_variants_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `role_has_permissions`
--
ALTER TABLE `role_has_permissions`
  ADD CONSTRAINT `role_has_permissions_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `role_has_permissions_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `sort_modules`
--
ALTER TABLE `sort_modules`
  ADD CONSTRAINT `user_modules_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `administrators` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `staff_roles`
--
ALTER TABLE `staff_roles`
  ADD CONSTRAINT `staff_roles_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `users_user_city_id_foreign` FOREIGN KEY (`user_city_id`) REFERENCES `module_cities` (`id`) ON DELETE SET NULL,
  ADD CONSTRAINT `users_user_country_id_foreign` FOREIGN KEY (`user_country_id`) REFERENCES `module_countries` (`id`) ON DELETE SET NULL,
  ADD CONSTRAINT `users_user_state_id_foreign` FOREIGN KEY (`user_state_id`) REFERENCES `module_states` (`id`) ON DELETE SET NULL;

--
-- Constraints for table `user_addresses`
--
ALTER TABLE `user_addresses`
  ADD CONSTRAINT `user_addresses_country_id_foreign` FOREIGN KEY (`country_id`) REFERENCES `module_countries` (`id`) ON DELETE SET NULL,
  ADD CONSTRAINT `user_addresses_state_id_foreign` FOREIGN KEY (`state_id`) REFERENCES `module_states` (`id`) ON DELETE SET NULL,
  ADD CONSTRAINT `user_addresses_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `variants`
--
ALTER TABLE `variants`
  ADD CONSTRAINT `variants_variant_parent_id_foreign` FOREIGN KEY (`variant_parent_id`) REFERENCES `variants` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `wish_lists`
--
ALTER TABLE `wish_lists`
  ADD CONSTRAINT `wish_lists_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `wish_lists_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
