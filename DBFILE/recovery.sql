-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 11, 2023 at 03:05 PM
-- Server version: 10.4.25-MariaDB
-- PHP Version: 8.1.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `recovery`
--

-- --------------------------------------------------------

--
-- Table structure for table `additional_detail`
--

CREATE TABLE `additional_detail` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `claim_id` bigint(20) UNSIGNED NOT NULL,
  `reference_no` bigint(20) NOT NULL,
  `date_time` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remarks` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `additional_sadad`
--

CREATE TABLE `additional_sadad` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `claim_id` bigint(20) UNSIGNED NOT NULL,
  `update_by` int(11) NOT NULL,
  `tranid` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `trackid` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `amount` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `sadadNumber` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `billNumber` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `hashResponse` text COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `admin_doc`
--

CREATE TABLE `admin_doc` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `claim_id` bigint(20) UNSIGNED NOT NULL,
  `document` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `admin_doc`
--

INSERT INTO `admin_doc` (`id`, `claim_id`, `document`, `status`, `created_at`, `updated_at`) VALUES
(1, 1, 'claims/1/company/98/AdminDoc/16970206848240.pdf', 1, '2023-10-11 08:38:04', '2023-10-11 08:38:04'),
(2, 1, 'claims/1/company/98/AdminDoc/16970206842007.pdf', 1, '2023-10-11 08:38:04', '2023-10-11 08:38:04'),
(3, 2, 'claims/2/company/98/AdminDoc/16970248141791.xlsx', 1, '2023-10-11 09:46:54', '2023-10-11 09:46:54'),
(4, 2, 'claims/2/company/98/AdminDoc/16970248144429.xlsx', 1, '2023-10-11 09:46:54', '2023-10-11 09:46:54'),
(5, 2, 'claims/2/company/98/AdminDoc/16970248146668.xlsx', 1, '2023-10-11 09:46:54', '2023-10-11 09:46:54');

-- --------------------------------------------------------

--
-- Table structure for table `bactch_num`
--

CREATE TABLE `bactch_num` (
  `id` int(11) NOT NULL,
  `batch_Id` text NOT NULL,
  `claim_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `batch_id`
--

CREATE TABLE `batch_id` (
  `id` int(11) NOT NULL,
  `claim` int(11) NOT NULL,
  `batch_iden` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `call_response`
--

CREATE TABLE `call_response` (
  `id` int(11) NOT NULL,
  `confidence` varchar(255) NOT NULL,
  `digits` varchar(255) NOT NULL,
  `callerId` varchar(255) NOT NULL,
  `direction` varchar(255) NOT NULL,
  `recipient` int(255) NOT NULL,
  `speechResult` varchar(255) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `call_status`
--

CREATE TABLE `call_status` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `claim_id` bigint(20) UNSIGNED NOT NULL,
  `callId` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `referenceId` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `statuss` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `duration` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `claims`
--

CREATE TABLE `claims` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `cid` bigint(20) UNSIGNED NOT NULL,
  `rec_amt` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `acc_date` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `acc_location` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `rec_reason` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `deb_iqama` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `deb_name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `deb_age` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `deb_mob` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `deb_type` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `status` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '0' COMMENT '20 when he pay by admin link',
  `claim_no` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `link` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `link_count` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `rejection_reason` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `pay_status` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `call_count` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT '0',
  `ivr_status` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `ic_mail` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `company_id` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `remarks` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `remarkUpdated` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `ic_email` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `type` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `libpercent` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `claim_type` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `is_assign` int(11) NOT NULL DEFAULT 0,
  `amount_after_discount` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `our_responsipility_per` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `claims`
--

INSERT INTO `claims` (`id`, `cid`, `rec_amt`, `acc_date`, `acc_location`, `rec_reason`, `deb_iqama`, `deb_name`, `deb_age`, `deb_mob`, `deb_type`, `created_at`, `updated_at`, `status`, `claim_no`, `link`, `link_count`, `rejection_reason`, `pay_status`, `call_count`, `ivr_status`, `ic_mail`, `company_id`, `remarks`, `remarkUpdated`, `ic_email`, `type`, `libpercent`, `claim_type`, `is_assign`, `amount_after_discount`, `our_responsipility_per`) VALUES
(1, 98, '7719.95', '07-Dec-2018', 'Jeddah', NULL, '1004189310', 'عبدالله دخيل الله زايد المطيري', NULL, NULL, NULL, '2023-10-10 19:00:00', '2023-10-11 11:03:05', '0', '20-2018-CV-2018-12-1872', '27311art72078', '0', NULL, NULL, '13', NULL, NULL, NULL, '', NULL, NULL, 'From Insured', '100', NULL, 0, '7719.95', '100');

-- --------------------------------------------------------

--
-- Table structure for table `claims_excels`
--

CREATE TABLE `claims_excels` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `file_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `file_original_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `uploader` int(11) NOT NULL,
  `total` int(11) NOT NULL,
  `complete` int(11) NOT NULL,
  `status` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `claim_collected`
--

CREATE TABLE `claim_collected` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `claim_id` bigint(20) UNSIGNED NOT NULL,
  `payment` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `update_by` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `claim_comments`
--

CREATE TABLE `claim_comments` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `claim_id` bigint(20) UNSIGNED NOT NULL,
  `ic_id` int(11) NOT NULL,
  `update_by` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `comment` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `claim_data`
--

CREATE TABLE `claim_data` (
  `id` int(11) NOT NULL,
  `claim_id` int(11) NOT NULL,
  `recovery_type` varchar(255) DEFAULT NULL,
  `policy_no` varchar(255) DEFAULT NULL,
  `loss_date` varchar(255) DEFAULT NULL,
  `registration_date` varchar(255) DEFAULT NULL,
  `accident_report_number` varchar(255) DEFAULT NULL,
  `vehicle_type` varchar(255) DEFAULT NULL,
  `vehicle_make` varchar(255) DEFAULT NULL,
  `plate_no` varchar(255) DEFAULT NULL,
  `our_responsipility_per` varchar(255) DEFAULT NULL,
  `remarks` text DEFAULT NULL,
  `excel_id` int(11) DEFAULT NULL,
  `sub_claim_no` varchar(255) DEFAULT NULL,
  `intimation_date` varchar(255) DEFAULT NULL,
  `policy_holder_liability` varchar(255) DEFAULT NULL,
  `recovery_party_id` varchar(255) DEFAULT NULL,
  `recovery_party_name` varchar(255) DEFAULT NULL,
  `recovery_reserve_amount` varchar(255) DEFAULT NULL,
  `recovery_request_date` varchar(255) DEFAULT NULL,
  `recovery_os_date` varchar(255) DEFAULT NULL,
  `recovery_close_date` varchar(255) DEFAULT NULL,
  `recovered_date` varchar(255) DEFAULT NULL,
  `recovered_amount` varchar(255) DEFAULT NULL,
  `is_partial_recovered` varchar(255) DEFAULT NULL,
  `assign_user_id` varchar(255) DEFAULT NULL,
  `survey_number` varchar(255) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `claim_data`
--

INSERT INTO `claim_data` (`id`, `claim_id`, `recovery_type`, `policy_no`, `loss_date`, `registration_date`, `accident_report_number`, `vehicle_type`, `vehicle_make`, `plate_no`, `our_responsipility_per`, `remarks`, `excel_id`, `sub_claim_no`, `intimation_date`, `policy_holder_liability`, `recovery_party_id`, `recovery_party_name`, `recovery_reserve_amount`, `recovery_request_date`, `recovery_os_date`, `recovery_close_date`, `recovered_date`, `recovered_amount`, `is_partial_recovered`, `assign_user_id`, `survey_number`, `created_at`, `updated_at`) VALUES
(1, 1, 'From Insured', '20-CV-2018-000401-000', '07-Dec-2018', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '12-Dec-2018', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '8581281', '2023-10-11 12:29:12', '2023-10-11 12:29:12');

-- --------------------------------------------------------

--
-- Table structure for table `claim_reasons`
--

CREATE TABLE `claim_reasons` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `claim_id` bigint(20) UNSIGNED NOT NULL,
  `update_by` int(11) NOT NULL,
  `reason` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `claim_remarks`
--

CREATE TABLE `claim_remarks` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `claim_id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remainder` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `remark` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `add_remark` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` int(11) NOT NULL DEFAULT 1,
  `readRemark` int(11) NOT NULL DEFAULT 0,
  `event` int(11) NOT NULL DEFAULT 0
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `claim_status`
--

CREATE TABLE `claim_status` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `claim_id` bigint(20) UNSIGNED NOT NULL,
  `status` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `update_by` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `collection_office`
--

CREATE TABLE `collection_office` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `claim_id` bigint(20) UNSIGNED NOT NULL,
  `collector_id` bigint(20) UNSIGNED NOT NULL,
  `remarks` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `companies`
--

CREATE TABLE `companies` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `companyType` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `CrNo` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `mobile_no` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `document` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `companies`
--

INSERT INTO `companies` (`id`, `name`, `companyType`, `CrNo`, `mobile_no`, `document`, `created_at`, `updated_at`) VALUES
(1, 'new IC company', 'finance', '7441852369', '587545454', 'Companies/1/1666952132483.xlsx', '2022-10-25 04:02:11', '2022-10-28 10:49:56'),
(2, 'شركة التأمين الموحدة', 'insurancecompany', '11223366554', '566666666', 'Companies/2/1666687122965.png', '2022-10-25 05:38:42', '2022-11-07 08:04:24'),
(3, 'مجموعة الخليج للتأمين', 'insurancecompany', '1010861720', '569999552', 'Companies/3/1666790917401.png', '2022-10-26 10:28:37', '2022-11-07 08:58:50'),
(5, 'الشركة الخليجية العامة للتأمين التعاوني', 'insurancecompany', '4030196620', '569999552', 'Companies/5/1678187706207.pdf', '2023-03-07 14:15:06', '2023-05-11 08:54:35'),
(6, 'شركة اتحاد الخليج الأهلية للتأمين التعاوني', 'insurancecompany', '2050056228', '553699366', 'Companies/6/1683784219205.pdf', '2023-05-11 08:50:19', '2023-05-11 08:50:19');

-- --------------------------------------------------------

--
-- Table structure for table `contact_us`
--

CREATE TABLE `contact_us` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `subject` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `message` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `custome_partial_mada`
--

CREATE TABLE `custome_partial_mada` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `claim_id` bigint(20) UNSIGNED NOT NULL,
  `partial_id` bigint(20) UNSIGNED NOT NULL,
  `link` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payment_id` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `amount` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `custome_partial_sadad`
--

CREATE TABLE `custome_partial_sadad` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `claim_id` bigint(20) UNSIGNED NOT NULL,
  `partial_id` bigint(20) UNSIGNED NOT NULL,
  `update_by` int(11) NOT NULL,
  `tranid` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `trackid` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `amount` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `sadadNumber` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `billNumber` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `hashResponse` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `debivrresp`
--

CREATE TABLE `debivrresp` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `claim_id` bigint(20) UNSIGNED NOT NULL,
  `response` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `pay_status` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `debtorrefuses`
--

CREATE TABLE `debtorrefuses` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `debtorresponse_id` bigint(20) UNSIGNED NOT NULL,
  `lawfirm_id` bigint(20) UNSIGNED NOT NULL,
  `status` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT '1 lawfirm accept the case\r\n2 law firm ask for additional doc\r\n',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `caseprogress` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `add_doc` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `verdict` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `debtorresponses`
--

CREATE TABLE `debtorresponses` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `claim_id` bigint(20) UNSIGNED NOT NULL,
  `response` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '1 objection \r\n2 refuse\r\n3 direct pay \r\n4 loan application',
  `objection` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `obj_status` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT '1 valid by admin0 invalid by admin3 valid by company4 invalid by company 5 transfer to morror',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deb_mob` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `debtor_bank_transfers`
--

CREATE TABLE `debtor_bank_transfers` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `claim_id` bigint(20) UNSIGNED DEFAULT NULL,
  `partial_id` int(11) DEFAULT NULL,
  `debtor_ip` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `verified_by` int(11) DEFAULT NULL,
  `screenshot` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `amount` decimal(20,2) DEFAULT NULL,
  `paid_at` date DEFAULT NULL,
  `status` smallint(6) DEFAULT NULL,
  `type` int(11) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `deb_discounts`
--

CREATE TABLE `deb_discounts` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `claim_id` bigint(20) UNSIGNED NOT NULL,
  `total_claim_amount` decimal(20,2) NOT NULL,
  `after_discount` decimal(20,2) NOT NULL,
  `requested_percentage` decimal(20,2) NOT NULL,
  `officer_percentage` decimal(20,2) DEFAULT NULL,
  `status` tinyint(1) NOT NULL,
  `requested_by` int(11) NOT NULL,
  `process_by` int(11) DEFAULT NULL,
  `process_date` date DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `deb_doc`
--

CREATE TABLE `deb_doc` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `claim_id` bigint(20) UNSIGNED NOT NULL,
  `document` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` int(11) NOT NULL,
  `ip` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `deb_refuse_reason`
--

CREATE TABLE `deb_refuse_reason` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `debtorresponses_id` bigint(20) UNSIGNED NOT NULL,
  `claim_id` bigint(20) UNSIGNED NOT NULL,
  `reason` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `delay_error`
--

CREATE TABLE `delay_error` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `claim_id` bigint(20) UNSIGNED NOT NULL,
  `error` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `distributions`
--

CREATE TABLE `distributions` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `claim_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `status` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `elm_status`
--

CREATE TABLE `elm_status` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `claim_id` int(11) NOT NULL,
  `batch_no` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `batch_ident` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `iqama` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `sms_description` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `events`
--

CREATE TABLE `events` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `start_date` datetime DEFAULT NULL,
  `end_date` datetime DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `events`
--

INSERT INTO `events` (`id`, `title`, `start_date`, `end_date`, `created_at`, `updated_at`) VALUES
(1, 'Event Title test 1', '2023-10-10 00:00:00', '2023-10-11 09:53:36', NULL, NULL);

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
-- Table structure for table `file_bin`
--

CREATE TABLE `file_bin` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `file_id` int(11) NOT NULL,
  `doc_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `finance_cases`
--

CREATE TABLE `finance_cases` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `claim_id` bigint(20) UNSIGNED NOT NULL,
  `finance_id` int(11) NOT NULL,
  `update_by` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `financial_companies`
--

CREATE TABLE `financial_companies` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `CrNo` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `mobile_no` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `document` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `ic_doc`
--

CREATE TABLE `ic_doc` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `claim_id` bigint(20) UNSIGNED NOT NULL,
  `document` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` int(11) NOT NULL,
  `added_by` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `law_firm_cases`
--

CREATE TABLE `law_firm_cases` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `claim_id` bigint(20) UNSIGNED NOT NULL,
  `lawfirm_id` int(11) NOT NULL,
  `update_by` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `legal_department_model`
--

CREATE TABLE `legal_department_model` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `claim_id` bigint(20) UNSIGNED NOT NULL,
  `status` int(10) NOT NULL DEFAULT 0,
  `court` int(10) NOT NULL DEFAULT 4,
  `remarks` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `loans`
--

CREATE TABLE `loans` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `claim_id` bigint(20) UNSIGNED NOT NULL,
  `company_id` bigint(20) UNSIGNED NOT NULL,
  `status` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT '0 new request 1 company accept 2 company rejeced\r\n',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `messages`
--

CREATE TABLE `messages` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `sender_id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `receiver_id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `claim_id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '1',
  `description` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
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
(1, '2022_10_27_084716_add_new_column_remarks_claims', 1),
(2, '2022_10_27_115309_add_new_column_remark_upadated_claims', 2),
(3, '2022_10_28_202637_create_pre_claims_table', 3),
(6, '2022_11_06_132039_alter_claim_table_email_null', 4),
(7, '2022_10_29_142016_create_claim_remarks_table', 5),
(8, '2022_11_07_185725_add_new_column_claim_id_preclaims', 6),
(9, '2022_11_08_162153_add_new_column_debtype_claims', 7),
(10, '2022_11_09_092930_create_file_bin_table', 8),
(11, '2022_11_17_101511_alter_claims_table', 9),
(12, '2022_11_18_110818_create_elm_status', 10),
(13, '2022_11_19_214850_alter_remarks_table', 11),
(14, '2022_11_24_133619_create_sms_response', 12),
(15, '2022_11_21_090301_add_column_is_assign', 13),
(16, '2022_11_21_084455_create_distributions', 14),
(17, '2022_11_28_114836_add_is_super', 15),
(18, '2022_11_28_144432_add_sms', 16),
(19, '2022_12_05_210027_add_deb_mob_deb', 17),
(20, '2022_11_29_165445_create_claim_status', 18),
(21, '2022_12_08_125804_create_claim_collected', 19),
(22, '2022_11_29_232825_create_pay_delay', 20),
(23, '2022_12_08_145919_add_pay_id', 21),
(24, '2022_11_30_153117_create_delay_error', 22),
(25, '2022_12_01_113152_create_partial_pay', 23),
(26, '2022_12_06_142951_create_tranfer_morror', 24),
(27, '2022_12_07_151050_create_law_firm_cases', 25),
(28, '2022_12_08_090712_create_finance_cases', 26),
(29, '2022_12_08_094625_create_claim_comments', 27),
(30, '2022_12_09_084953_add_pay_id_partial_pay', 28),
(31, '2022_12_09_153824_add_column_elm_status', 29),
(32, '2022_12_06_104654_add_columns_call_status', 30),
(34, '2022_12_22_123345_create_contact_us', 31),
(35, '2022_12_22_081134_create_payment_links', 32),
(36, '2022_12_22_102135_create_admin_doc', 33),
(37, '2023_02_13_150115_create_sadad_pay_table', 34),
(38, '2023_02_15_142726_create_ic_doc_table', 35),
(39, '2023_02_17_103511_create_deb_doc_table', 36),
(40, '2023_02_17_180745_add_column_type_partial_pay', 37),
(41, '2023_02_21_153509_add_hash_column', 38),
(42, '2023_02_22_084135_create_sadad_response_table', 39),
(43, '2023_03_14_090944_create_table_approve_log', 40),
(44, '2023_04_17_231610_create_deb_refuse_reason', 41),
(45, '2023_05_19_133043_create_partial_manual', 42),
(46, '2023_05_25_120108_create_additional_sadad', 43),
(50, '2014_10_12_000001_create_settings_table', 45),
(52, '2014_10_12_000001_laratrust_setup_tables', 46),
(73, '2023_08_17_095719_create_officer_discount_rates_table', 50),
(75, '2023_08_21_084416_add_amount_after_discount_to_claims_table', 52),
(83, '2023_08_25_093815_create_debtor_bank_transfers_table', 55),
(85, '2023_08_04_140101_create_deb_discounts_table', 56),
(86, '2023_08_04_134747_create_officer_targets_table', 57),
(88, '2023_09_23_080805_create_claims_excels_table', 58),
(91, '2023_09_29_123049_create_collection_office_table', 60),
(92, '2023_09_30_165711_create_additional_detail_table', 61),
(102, '2023_10_02_072647_create_legal_department_model_table', 62),
(103, '2023_10_08_123836_create_events_table', 63);

-- --------------------------------------------------------

--
-- Table structure for table `notifications`
--

CREATE TABLE `notifications` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `from` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `to` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `message` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `type` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `link` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `read` tinyint(1) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `notifications`
--

INSERT INTO `notifications` (`id`, `from`, `to`, `message`, `type`, `link`, `read`, `created_at`, `updated_at`) VALUES
(1, '98', '1', 'Claim (GGI002) added by Mubeen Boss.', 'New Claim Added', '/admin/claim/detail/2', 0, '2023-10-11 09:44:25', '2023-10-11 09:44:25'),
(2, '98', '58', 'Claim (GGI002) added by Mubeen Boss.', 'New Claim Added', '/admin/claim/detail/2', 0, '2023-10-11 09:44:25', '2023-10-11 09:44:25'),
(3, '98', '64', 'Claim (GGI002) added by Mubeen Boss.', 'New Claim Added', '/admin/claim/detail/2', 0, '2023-10-11 09:44:25', '2023-10-11 09:44:25'),
(4, '98', '66', 'Claim (GGI002) added by Mubeen Boss.', 'New Claim Added', '/admin/claim/detail/2', 0, '2023-10-11 09:44:25', '2023-10-11 09:44:25'),
(5, '98', '67', 'Claim (GGI002) added by Mubeen Boss.', 'New Claim Added', '/admin/claim/detail/2', 0, '2023-10-11 09:44:25', '2023-10-11 09:44:25'),
(6, '98', '70', 'Claim (GGI002) added by Mubeen Boss.', 'New Claim Added', '/admin/claim/detail/2', 0, '2023-10-11 09:44:25', '2023-10-11 09:44:25'),
(7, '98', '74', 'Claim (GGI002) added by Mubeen Boss.', 'New Claim Added', '/admin/claim/detail/2', 0, '2023-10-11 09:44:25', '2023-10-11 09:44:25'),
(8, '98', '75', 'Claim (GGI002) added by Mubeen Boss.', 'New Claim Added', '/admin/claim/detail/2', 0, '2023-10-11 09:44:25', '2023-10-11 09:44:25'),
(9, '98', '76', 'Claim (GGI002) added by Mubeen Boss.', 'New Claim Added', '/admin/claim/detail/2', 0, '2023-10-11 09:44:25', '2023-10-11 09:44:25'),
(10, '98', '81', 'Claim (GGI002) added by Mubeen Boss.', 'New Claim Added', '/admin/claim/detail/2', 0, '2023-10-11 09:44:25', '2023-10-11 09:44:25'),
(11, '98', '87', 'Claim (GGI002) added by Mubeen Boss.', 'New Claim Added', '/admin/claim/detail/2', 0, '2023-10-11 09:44:25', '2023-10-11 09:44:25'),
(12, '98', '88', 'Claim (GGI002) added by Mubeen Boss.', 'New Claim Added', '/admin/claim/detail/2', 0, '2023-10-11 09:44:25', '2023-10-11 09:44:25'),
(13, '98', '89', 'Claim (GGI002) added by Mubeen Boss.', 'New Claim Added', '/admin/claim/detail/2', 0, '2023-10-11 09:44:25', '2023-10-11 09:44:25'),
(14, '98', '90', 'Claim (GGI002) added by Mubeen Boss.', 'New Claim Added', '/admin/claim/detail/2', 0, '2023-10-11 09:44:25', '2023-10-11 09:44:25'),
(15, '98', '91', 'Claim (GGI002) added by Mubeen Boss.', 'New Claim Added', '/admin/claim/detail/2', 0, '2023-10-11 09:44:25', '2023-10-11 09:44:25'),
(16, '98', '92', 'Claim (GGI002) added by Mubeen Boss.', 'New Claim Added', '/admin/claim/detail/2', 0, '2023-10-11 09:44:25', '2023-10-11 09:44:25'),
(17, '98', '96', 'Claim (GGI002) added by Mubeen Boss.', 'New Claim Added', '/admin/claim/detail/2', 0, '2023-10-11 09:44:25', '2023-10-11 09:44:25'),
(18, '98', '100', 'Claim (GGI002) added by Mubeen Boss.', 'New Claim Added', '/admin/claim/detail/2', 0, '2023-10-11 09:44:25', '2023-10-11 09:44:25'),
(19, '98', '101', 'Claim (GGI002) added by Mubeen Boss.', 'New Claim Added', '/admin/claim/detail/2', 0, '2023-10-11 09:44:25', '2023-10-11 09:44:25'),
(20, '98', '102', 'Claim (GGI002) added by Mubeen Boss.', 'New Claim Added', '/admin/claim/detail/2', 0, '2023-10-11 09:44:25', '2023-10-11 09:44:25'),
(21, '98', '103', 'Claim (GGI002) added by Mubeen Boss.', 'New Claim Added', '/admin/claim/detail/2', 0, '2023-10-11 09:44:25', '2023-10-11 09:44:25'),
(22, '98', '95', 'Claim (GGI002) added by Mubeen Boss.', 'New Claim Added', '/admin/claim/detail/2', 0, '2023-10-11 09:44:25', '2023-10-11 09:44:25'),
(23, '98', '93', 'Claim (GGI002) added by Mubeen Boss.', 'New Claim Added', '/admin/claim/detail/2', 0, '2023-10-11 09:44:25', '2023-10-11 09:44:25'),
(24, '98', '94', 'Claim (GGI002) added by Mubeen Boss.', 'New Claim Added', '/admin/claim/detail/2', 0, '2023-10-11 09:44:25', '2023-10-11 09:44:25'),
(25, '98', '98', 'Claim (GGI002) added by Mubeen Boss.', 'New Claim Added', '/supervisor/claim/detail/2', 1, '2023-10-11 09:44:25', '2023-10-11 09:50:51'),
(26, '98', '1', 'Claim (GGI002) added by Mubeen Boss.', 'New Claim Added', '/admin/claim/detail/2', 0, '2023-10-11 10:06:23', '2023-10-11 10:06:23'),
(27, '98', '58', 'Claim (GGI002) added by Mubeen Boss.', 'New Claim Added', '/admin/claim/detail/2', 0, '2023-10-11 10:06:23', '2023-10-11 10:06:23'),
(28, '98', '64', 'Claim (GGI002) added by Mubeen Boss.', 'New Claim Added', '/admin/claim/detail/2', 0, '2023-10-11 10:06:23', '2023-10-11 10:06:23'),
(29, '98', '66', 'Claim (GGI002) added by Mubeen Boss.', 'New Claim Added', '/admin/claim/detail/2', 0, '2023-10-11 10:06:23', '2023-10-11 10:06:23'),
(30, '98', '67', 'Claim (GGI002) added by Mubeen Boss.', 'New Claim Added', '/admin/claim/detail/2', 0, '2023-10-11 10:06:23', '2023-10-11 10:06:23'),
(31, '98', '70', 'Claim (GGI002) added by Mubeen Boss.', 'New Claim Added', '/admin/claim/detail/2', 0, '2023-10-11 10:06:23', '2023-10-11 10:06:23'),
(32, '98', '74', 'Claim (GGI002) added by Mubeen Boss.', 'New Claim Added', '/admin/claim/detail/2', 0, '2023-10-11 10:06:23', '2023-10-11 10:06:23'),
(33, '98', '75', 'Claim (GGI002) added by Mubeen Boss.', 'New Claim Added', '/admin/claim/detail/2', 0, '2023-10-11 10:06:23', '2023-10-11 10:06:23'),
(34, '98', '76', 'Claim (GGI002) added by Mubeen Boss.', 'New Claim Added', '/admin/claim/detail/2', 0, '2023-10-11 10:06:23', '2023-10-11 10:06:23'),
(35, '98', '81', 'Claim (GGI002) added by Mubeen Boss.', 'New Claim Added', '/admin/claim/detail/2', 0, '2023-10-11 10:06:23', '2023-10-11 10:06:23'),
(36, '98', '87', 'Claim (GGI002) added by Mubeen Boss.', 'New Claim Added', '/admin/claim/detail/2', 0, '2023-10-11 10:06:23', '2023-10-11 10:06:23'),
(37, '98', '88', 'Claim (GGI002) added by Mubeen Boss.', 'New Claim Added', '/admin/claim/detail/2', 0, '2023-10-11 10:06:23', '2023-10-11 10:06:23'),
(38, '98', '89', 'Claim (GGI002) added by Mubeen Boss.', 'New Claim Added', '/admin/claim/detail/2', 0, '2023-10-11 10:06:23', '2023-10-11 10:06:23'),
(39, '98', '90', 'Claim (GGI002) added by Mubeen Boss.', 'New Claim Added', '/admin/claim/detail/2', 0, '2023-10-11 10:06:23', '2023-10-11 10:06:23'),
(40, '98', '91', 'Claim (GGI002) added by Mubeen Boss.', 'New Claim Added', '/admin/claim/detail/2', 0, '2023-10-11 10:06:23', '2023-10-11 10:06:23'),
(41, '98', '92', 'Claim (GGI002) added by Mubeen Boss.', 'New Claim Added', '/admin/claim/detail/2', 0, '2023-10-11 10:06:24', '2023-10-11 10:06:24'),
(42, '98', '96', 'Claim (GGI002) added by Mubeen Boss.', 'New Claim Added', '/admin/claim/detail/2', 0, '2023-10-11 10:06:24', '2023-10-11 10:06:24'),
(43, '98', '100', 'Claim (GGI002) added by Mubeen Boss.', 'New Claim Added', '/admin/claim/detail/2', 0, '2023-10-11 10:06:24', '2023-10-11 10:06:24'),
(44, '98', '101', 'Claim (GGI002) added by Mubeen Boss.', 'New Claim Added', '/admin/claim/detail/2', 0, '2023-10-11 10:06:24', '2023-10-11 10:06:24'),
(45, '98', '102', 'Claim (GGI002) added by Mubeen Boss.', 'New Claim Added', '/admin/claim/detail/2', 0, '2023-10-11 10:06:24', '2023-10-11 10:06:24'),
(46, '98', '103', 'Claim (GGI002) added by Mubeen Boss.', 'New Claim Added', '/admin/claim/detail/2', 0, '2023-10-11 10:06:24', '2023-10-11 10:06:24'),
(47, '98', '95', 'Claim (GGI002) added by Mubeen Boss.', 'New Claim Added', '/admin/claim/detail/2', 0, '2023-10-11 10:06:24', '2023-10-11 10:06:24'),
(48, '98', '93', 'Claim (GGI002) added by Mubeen Boss.', 'New Claim Added', '/admin/claim/detail/2', 0, '2023-10-11 10:06:24', '2023-10-11 10:06:24'),
(49, '98', '94', 'Claim (GGI002) added by Mubeen Boss.', 'New Claim Added', '/admin/claim/detail/2', 0, '2023-10-11 10:06:24', '2023-10-11 10:06:24'),
(50, '98', '98', 'Claim (GGI002) added by Mubeen Boss.', 'New Claim Added', '/supervisor/claim/detail/2', 0, '2023-10-11 10:06:24', '2023-10-11 10:06:24');

-- --------------------------------------------------------

--
-- Table structure for table `officer_discount_rates`
--

CREATE TABLE `officer_discount_rates` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `officer_id` int(11) NOT NULL,
  `set_by` int(11) NOT NULL,
  `discount` decimal(20,2) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `officer_targets`
--

CREATE TABLE `officer_targets` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `officer_id` bigint(20) UNSIGNED NOT NULL,
  `total` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `achieved` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `pending` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `acheived_percentage` int(11) DEFAULT NULL,
  `status` int(11) DEFAULT NULL,
  `start_date` date NOT NULL,
  `end_date` date NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `officer_targets`
--

INSERT INTO `officer_targets` (`id`, `officer_id`, `total`, `achieved`, `pending`, `acheived_percentage`, `status`, `start_date`, `end_date`, `created_at`, `updated_at`) VALUES
(1, 41, '1000000', NULL, '1000000', NULL, 2, '2023-10-08', '2023-11-08', '2023-10-08 05:21:01', '2023-10-08 05:21:01');

-- --------------------------------------------------------

--
-- Table structure for table `partial_manual`
--

CREATE TABLE `partial_manual` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `claim_id` bigint(20) UNSIGNED NOT NULL,
  `partial_id` bigint(20) UNSIGNED NOT NULL,
  `update_by` int(11) NOT NULL,
  `amount` float NOT NULL,
  `date` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remark` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `partial_pay`
--

CREATE TABLE `partial_pay` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `claim_id` bigint(20) UNSIGNED NOT NULL,
  `date_time` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `recovered_date` timestamp NULL DEFAULT NULL,
  `status` int(11) NOT NULL DEFAULT 1,
  `sms_status` int(11) NOT NULL,
  `installment` int(11) NOT NULL,
  `update_by` int(11) NOT NULL,
  `link` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `amount` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `pay_id` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `type` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

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
-- Table structure for table `payment`
--

CREATE TABLE `payment` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `claim_id` bigint(20) UNSIGNED NOT NULL,
  `payment_id` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `result` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `track_id` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `auth_code` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `response_code` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `rrn` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `amount` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `card_brand` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `masked_pan` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `payment_links`
--

CREATE TABLE `payment_links` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `claim_id` bigint(20) UNSIGNED NOT NULL,
  `link` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payment_id` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `amount` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `pay_delay`
--

CREATE TABLE `pay_delay` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `claim_id` bigint(20) UNSIGNED NOT NULL,
  `date_time` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `recovered_date` date DEFAULT NULL,
  `status` int(11) NOT NULL DEFAULT 1,
  `update_by` int(11) NOT NULL,
  `link` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `pay_id` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `type` varchar(250) COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `permissions`
--

CREATE TABLE `permissions` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `display_name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `description` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `permissions`
--

INSERT INTO `permissions` (`id`, `name`, `display_name`, `description`, `type`, `created_at`, `updated_at`) VALUES
(152, 'view-languages', 'View Languages', NULL, 'settings', '2023-08-08 10:58:14', '2023-08-08 10:58:14'),
(153, 'add-claim', 'Add Claim', NULL, 'claim', '2023-08-08 10:58:14', '2023-08-08 10:58:14'),
(154, 'edit-claim', 'Edit Claim', NULL, 'claim', '2023-08-08 10:58:14', '2023-08-08 10:58:14'),
(155, 'approve-claim', 'Approve Claim', NULL, 'claim', '2023-08-08 10:58:14', '2023-08-08 10:58:14'),
(156, 'reject-claim', 'Reject Claim', NULL, 'claim', '2023-08-08 10:58:14', '2023-08-08 10:58:14'),
(157, 'change-claim-status', 'Change Claim Status', NULL, 'claim', '2023-08-08 10:58:14', '2023-08-08 10:58:14'),
(158, 'add-comment-claim', 'Add Comment', NULL, 'claim', '2023-08-08 10:58:14', '2023-08-08 10:58:14'),
(159, 'call-history', 'Call History', NULL, 'claim', '2023-08-08 10:58:14', '2023-08-08 10:58:14'),
(160, 'sms-history', 'SMS History', NULL, 'claim', '2023-08-08 10:58:14', '2023-08-08 10:58:14'),
(161, 'create-mada-settlement', 'Create Mada Settlement', NULL, 'claim', '2023-08-08 10:58:14', '2023-08-08 10:58:14'),
(162, 'sadad-invoice', 'Sadad Invoice', NULL, 'claim', '2023-08-08 10:58:14', '2023-08-08 10:58:14'),
(163, 'finance-report', 'Finance Report', NULL, 'claim', '2023-08-08 10:58:14', '2023-08-08 10:58:14'),
(164, 'add-remark', 'Add Remark', NULL, 'claim', '2023-08-08 10:58:14', '2023-08-08 10:58:14'),
(165, 'add-additional-document', 'Add Additional Document', NULL, 'claim', '2023-08-08 10:58:14', '2023-08-08 10:58:14'),
(166, 'resend-sms', 'Resend SMS', NULL, 'response', '2023-08-08 10:58:14', '2023-08-08 10:58:14'),
(167, 'call-again', 'Call Again', NULL, 'response', '2023-08-08 10:58:14', '2023-08-08 10:58:14'),
(168, 'add-user', 'Register User', NULL, 'user', '2023-08-08 10:58:14', '2023-08-08 10:58:14'),
(169, 'edit-user', 'Edit User', NULL, 'user', '2023-08-08 10:58:14', '2023-08-08 10:58:14'),
(170, 'change-user-status', 'Change User Status', NULL, 'user', '2023-08-08 10:58:14', '2023-08-08 10:58:14'),
(171, 'change-language', 'Change Language', NULL, 'setting', '2023-08-08 10:58:14', '2023-08-08 10:58:14'),
(172, 're-assign-claim', 'Re-assign Claim', NULL, 'claim', '2023-08-08 10:58:14', '2023-08-08 10:58:14'),
(173, 'bulk-import-claims', 'Bulk Import Claims', NULL, 'claim', '2023-08-08 10:58:14', '2023-08-08 10:58:14'),
(174, 'delegation', 'Delegation', NULL, 'other', '2023-08-08 10:58:14', '2023-08-08 10:58:14'),
(175, 'set-target', 'Set Target', NULL, 'recovery targets', '2023-08-08 10:58:14', '2023-08-08 10:58:14'),
(176, 'edit-target', 'Create Target', NULL, 'recovery targets', '2023-08-08 10:58:14', '2023-08-08 10:58:14');

-- --------------------------------------------------------

--
-- Table structure for table `permission_role`
--

CREATE TABLE `permission_role` (
  `permission_id` bigint(20) UNSIGNED NOT NULL,
  `role_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `permission_role`
--

INSERT INTO `permission_role` (`permission_id`, `role_id`) VALUES
(153, 74),
(153, 75),
(153, 76),
(154, 74),
(154, 75),
(154, 76),
(154, 78),
(155, 74),
(155, 75),
(155, 76),
(156, 74),
(156, 75),
(156, 76),
(157, 74),
(157, 75),
(157, 76),
(158, 74),
(158, 75),
(158, 76),
(159, 74),
(159, 75),
(159, 76),
(160, 74),
(160, 75),
(160, 76),
(161, 74),
(161, 75),
(161, 76),
(162, 74),
(162, 75),
(162, 76),
(163, 74),
(163, 75),
(163, 76),
(164, 74),
(164, 75),
(164, 76),
(165, 74),
(165, 75),
(165, 76),
(166, 74),
(166, 75),
(166, 76),
(167, 74),
(167, 75),
(167, 76),
(170, 74),
(171, 74),
(172, 74),
(172, 75),
(172, 76),
(173, 74),
(173, 76),
(174, 74),
(174, 75),
(174, 76),
(175, 74),
(175, 76),
(176, 74),
(176, 75),
(176, 76);

-- --------------------------------------------------------

--
-- Table structure for table `permission_user`
--

CREATE TABLE `permission_user` (
  `permission_id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `user_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `personal_access_tokens`
--

CREATE TABLE `personal_access_tokens` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `tokenable_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tokenable_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(64) COLLATE utf8mb4_unicode_ci NOT NULL,
  `abilities` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `pre_claims`
--

CREATE TABLE `pre_claims` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `company_id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `claim_no` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `comments` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `document` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `claim_id` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `reasons`
--

CREATE TABLE `reasons` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `description` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `roles`
--

CREATE TABLE `roles` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `display_name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `description` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `is_changeable` tinyint(1) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `roles`
--

INSERT INTO `roles` (`id`, `name`, `display_name`, `description`, `is_changeable`, `created_at`, `updated_at`) VALUES
(71, 'super-admin', 'Super Admin', 'Super Admin can have all permissions and privileges to perform all operations', 0, '2023-08-08 10:58:14', '2023-08-08 10:58:14'),
(72, 'director', 'Director', 'Director is a Super Admin who can have all permissions and privileges to perform all operations', 0, '2023-08-08 10:58:14', '2023-08-08 10:58:14'),
(73, 'manager', 'Manager', 'Manager is a Super Admin who can have all permissions and privileges to perform all operations', 0, '2023-08-08 10:58:14', '2023-08-08 10:58:14'),
(74, 'admin', 'Admin', 'Admin can perform specific actions provided by Super Admin', 0, '2023-08-08 10:58:14', '2023-08-08 10:58:14'),
(75, 'officer', 'Officer', 'Officer can perform specific actions', 0, '2023-08-08 10:58:14', '2023-08-08 10:58:14'),
(76, 'supervisor', 'Supervisor', 'Supervisor can perform specific actions', 0, '2023-08-08 10:58:15', '2023-08-08 10:58:15'),
(77, 'collector', 'Collector', 'Collector can perform specific actions', 0, '2023-08-08 10:58:15', '2023-08-08 10:58:15'),
(78, 'legal-department', 'Legal Department', NULL, 1, '2023-09-30 09:14:52', '2023-09-30 09:14:52');

-- --------------------------------------------------------

--
-- Table structure for table `role_user`
--

CREATE TABLE `role_user` (
  `role_id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `user_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `role_user`
--

INSERT INTO `role_user` (`role_id`, `user_id`, `user_type`) VALUES
(74, 1, 'App\\Models\\User'),
(75, 41, 'App\\Models\\User'),
(75, 42, 'App\\Models\\User'),
(75, 43, 'App\\Models\\User'),
(75, 44, 'App\\Models\\User'),
(75, 45, 'App\\Models\\User'),
(75, 47, 'App\\Models\\User'),
(75, 48, 'App\\Models\\User'),
(75, 50, 'App\\Models\\User'),
(75, 51, 'App\\Models\\User'),
(75, 52, 'App\\Models\\User'),
(75, 53, 'App\\Models\\User'),
(75, 54, 'App\\Models\\User'),
(74, 58, 'App\\Models\\User'),
(75, 63, 'App\\Models\\User'),
(74, 64, 'App\\Models\\User'),
(74, 66, 'App\\Models\\User'),
(74, 67, 'App\\Models\\User'),
(75, 68, 'App\\Models\\User'),
(75, 69, 'App\\Models\\User'),
(74, 70, 'App\\Models\\User'),
(77, 71, 'App\\Models\\User'),
(77, 72, 'App\\Models\\User'),
(75, 73, 'App\\Models\\User'),
(74, 74, 'App\\Models\\User'),
(74, 75, 'App\\Models\\User'),
(74, 76, 'App\\Models\\User'),
(75, 77, 'App\\Models\\User'),
(75, 78, 'App\\Models\\User'),
(75, 80, 'App\\Models\\User'),
(74, 81, 'App\\Models\\User'),
(74, 87, 'App\\Models\\User'),
(74, 88, 'App\\Models\\User'),
(74, 89, 'App\\Models\\User'),
(74, 90, 'App\\Models\\User'),
(74, 91, 'App\\Models\\User'),
(74, 92, 'App\\Models\\User'),
(73, 93, 'App\\Models\\User'),
(71, 94, 'App\\Models\\User'),
(72, 95, 'App\\Models\\User'),
(74, 96, 'App\\Models\\User'),
(75, 97, 'App\\Models\\User'),
(76, 98, 'App\\Models\\User'),
(77, 99, 'App\\Models\\User'),
(74, 100, 'App\\Models\\User'),
(74, 101, 'App\\Models\\User'),
(74, 102, 'App\\Models\\User'),
(74, 103, 'App\\Models\\User'),
(75, 104, 'App\\Models\\User'),
(75, 105, 'App\\Models\\User'),
(75, 106, 'App\\Models\\User'),
(75, 107, 'App\\Models\\User'),
(78, 108, 'App\\Models\\User');

-- --------------------------------------------------------

--
-- Table structure for table `sadad_pay`
--

CREATE TABLE `sadad_pay` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `claim_id` bigint(20) UNSIGNED NOT NULL,
  `tranid` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `trackid` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `amount` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `sadadNumber` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `billNumber` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `hashResponse` text COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `sadad_response`
--

CREATE TABLE `sadad_response` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `tranId` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `trackId` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `result` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `responseCode` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `responseHash` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `claimid` int(11) DEFAULT NULL,
  `billNumber` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `sadadNumber` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `amount` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `alldata` text COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `settings`
--

CREATE TABLE `settings` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `value` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL CHECK (json_valid(`value`)),
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `settings`
--

INSERT INTO `settings` (`id`, `name`, `value`, `created_at`, `updated_at`) VALUES
(15, 'languages', '[{\"language\":\"English\",\"code\":\"en\",\"direction\":\"ltr\",\"is_active\":false},{\"language\":\"Arabic\",\"code\":\"ar\",\"direction\":\"rtl\",\"is_active\":false},{\"language\":\"Urdu\",\"code\":\"ur\",\"direction\":\"rtl\",\"is_active\":true}]', '2023-07-30 12:54:21', '2023-08-07 08:04:31');

-- --------------------------------------------------------

--
-- Table structure for table `sms_response`
--

CREATE TABLE `sms_response` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `claim_id` int(11) NOT NULL,
  `phone_no` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `code` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `message` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `sms` text COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `sms_response`
--

INSERT INTO `sms_response` (`id`, `claim_id`, `phone_no`, `code`, `message`, `created_at`, `updated_at`, `sms`) VALUES
(1, 3, '966123456789', 'M0001', 'Variables missing', '2023-10-02 05:17:26', '2023-10-02 05:17:26', 'عزيزي العميل، نفيدكم بوجود مطالبة مالية مستحقة لشركة تكافل الراجحي تحت المطالبة رقمC1216-ALT-ALJ-000003/R4/2023-97007  بمبلغ وقدره  600  ريال سعودي, لمزيد من المعلومات يرجى الاطلاع على المستندات من خلال الرابط  http://192.168.18.99:8001/bit.ly/67320art63563 تذكر دائماً أن تكافل الراجحي لن تطلب أي أرقام سرية خاصة بكم بأي حال من الأحوال ولمزيد من المعلومات تواصل معنا على رقم   920004414'),
(2, 5, '966123456789', 'M0001', 'Variables missing', '2023-10-02 05:59:45', '2023-10-02 05:59:45', 'عزيزي العميل، نفيدكم بوجود مطالبة مالية مستحقة لشركة تكافل الراجحي تحت المطالبة رقمC1216-ALT-ALJ-000003/R4/2023-97007  بمبلغ وقدره  8154  ريال سعودي, لمزيد من المعلومات يرجى الاطلاع على المستندات من خلال الرابط  http://192.168.18.99:8001/bit.ly/30276art15546 تذكر دائماً أن تكافل الراجحي لن تطلب أي أرقام سرية خاصة بكم بأي حال من الأحوال ولمزيد من المعلومات تواصل معنا على رقم   920004414'),
(3, 7, '966123123123123', 'M0001', 'Variables missing', '2023-10-02 08:38:32', '2023-10-02 08:38:32', 'عزيزي العميل، نفيدكم بوجود مطالبة مالية مستحقة لشركة تكافل الراجحي تحت المطالبة رقمC1216-ALT-ALJ-000003/R4/2023-97007  بمبلغ وقدره  600  ريال سعودي, لمزيد من المعلومات يرجى الاطلاع على المستندات من خلال الرابط  http://192.168.18.99:8001/bit.ly/23942art52775 تذكر دائماً أن تكافل الراجحي لن تطلب أي أرقام سرية خاصة بكم بأي حال من الأحوال ولمزيد من المعلومات تواصل معنا على رقم   920004414'),
(4, 1, '96646', 'M0001', 'Variables missing', '2023-10-04 05:53:11', '2023-10-04 05:53:11', 'عزيزي العميل، نفيدكم بوجود مطالبة مالية مستحقة لشركة تكافل الراجحي تحت المطالبة رقمHamilton  بمبلغ وقدره  Ria  ريال سعودي, لمزيد من المعلومات يرجى الاطلاع على المستندات من خلال الرابط  http://192.168.18.99:8001/bit.ly/71363art68480 تذكر دائماً أن تكافل الراجحي لن تطلب أي أرقام سرية خاصة بكم بأي حال من الأحوال ولمزيد من المعلومات تواصل معنا على رقم   920004414'),
(5, 2, '96628', 'M0001', 'Variables missing', '2023-10-11 09:47:21', '2023-10-11 09:47:21', 'عزيزي العميل، نفيدكم بوجود مطالبة مالية مستحقة لشركة تكافل الراجحي تحت المطالبة رقم592  بمبلغ وقدره  96  ريال سعودي, لمزيد من المعلومات يرجى الاطلاع على المستندات من خلال الرابط  http://127.0.0.1:8000/bit.ly/35686art82937 تذكر دائماً أن تكافل الراجحي لن تطلب أي أرقام سرية خاصة بكم بأي حال من الأحوال ولمزيد من المعلومات تواصل معنا على رقم   920004414');

-- --------------------------------------------------------

--
-- Table structure for table `status_history`
--

CREATE TABLE `status_history` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `claim_id` bigint(20) UNSIGNED NOT NULL,
  `status` int(11) NOT NULL,
  `update_by` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `status_history`
--

INSERT INTO `status_history` (`id`, `claim_id`, `status`, `update_by`, `created_at`, `updated_at`) VALUES
(1, 1, 20, 98, '2023-10-01 06:36:16', '2023-10-01 06:36:16'),
(2, 2, 20, 98, '2023-10-01 07:34:08', '2023-10-01 07:34:08'),
(3, 3, 20, 98, '2023-10-02 05:14:48', '2023-10-02 05:14:48'),
(4, 4, 20, 98, '2023-10-02 05:40:37', '2023-10-02 05:40:37'),
(5, 9, 20, 98, '2023-10-02 09:03:15', '2023-10-02 09:03:15'),
(6, 8, 20, 98, '2023-10-03 04:57:41', '2023-10-03 04:57:41'),
(7, 10, 20, 98, '2023-10-03 05:07:10', '2023-10-03 05:07:10'),
(8, 11, 20, 98, '2023-10-03 05:19:17', '2023-10-03 05:19:17'),
(9, 12, 20, 98, '2023-10-03 05:22:52', '2023-10-03 05:22:52'),
(10, 5, 20, 98, '2023-10-03 09:00:17', '2023-10-03 09:00:17'),
(11, 14, 20, 98, '2023-10-03 09:03:33', '2023-10-03 09:03:33'),
(12, 15, 20, 98, '2023-10-03 09:09:54', '2023-10-03 09:09:54'),
(13, 1, 20, 98, '2023-10-04 05:36:12', '2023-10-04 05:36:12'),
(14, 3, 20, 94, '2023-10-04 09:51:20', '2023-10-04 09:51:20'),
(15, 1, 20, 98, '2023-10-05 04:36:26', '2023-10-05 04:36:26'),
(16, 2, 20, 98, '2023-10-11 10:11:01', '2023-10-11 10:11:01');

-- --------------------------------------------------------

--
-- Table structure for table `supported-doc`
--

CREATE TABLE `supported-doc` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `company_id` bigint(20) UNSIGNED NOT NULL,
  `doc_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `claim_id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `supported-doc`
--

INSERT INTO `supported-doc` (`id`, `company_id`, `doc_name`, `created_at`, `updated_at`, `claim_id`) VALUES
(1, 98, 'claims/3/company/98/Supported_document/16962307986337.PNG', '2023-10-02 05:13:18', '2023-10-02 05:13:18', '3'),
(2, 98, 'claims/4/company/98/Supported_document/16962323528674.PNG', '2023-10-02 05:39:12', '2023-10-02 05:39:12', '4'),
(3, 98, 'claims/5/company/98/Supported_document/16962334967076.PNG', '2023-10-02 05:58:16', '2023-10-02 05:58:16', '5'),
(4, 98, 'claims/7/company/98/Supported_document/16962418322251.PNG', '2023-10-02 08:17:12', '2023-10-02 08:17:12', '7'),
(5, 98, 'claims/8/company/98/Supported_document/1696243324388.PNG', '2023-10-02 08:42:04', '2023-10-02 08:42:04', '8'),
(6, 98, 'claims/13/company/98/Supported_document/16963248165168.PNG', '2023-10-03 07:20:16', '2023-10-03 07:20:16', '13'),
(7, 98, 'claims/2/company/98/Supported_document/16964161835418.PNG', '2023-10-04 08:43:03', '2023-10-04 08:43:03', '2'),
(8, 98, 'claims/5/company/98/Supported_document/16964222022670.PNG', '2023-10-04 10:23:22', '2023-10-04 10:23:22', '5'),
(9, 98, 'claims/5/company/98/Supported_document/16964224443238.PNG', '2023-10-04 10:27:24', '2023-10-04 10:27:24', '5'),
(10, 98, 'claims/746/company/98/Supported_document/16964237827622.PNG', '2023-10-04 10:49:42', '2023-10-04 10:49:42', '746'),
(11, 98, 'claims/2/company/98/Supported_document/16970259833439.xlsx', '2023-10-11 10:06:23', '2023-10-11 10:06:23', '2');

-- --------------------------------------------------------

--
-- Table structure for table `table_approve_log`
--

CREATE TABLE `table_approve_log` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `approved_by` int(11) NOT NULL,
  `claim_id` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `table_approve_log`
--

INSERT INTO `table_approve_log` (`id`, `approved_by`, `claim_id`, `created_at`, `updated_at`) VALUES
(1, 98, 3, '2023-10-02 05:17:23', '2023-10-02 05:17:23'),
(2, 98, 5, '2023-10-02 05:59:45', '2023-10-02 05:59:45'),
(3, 98, 7, '2023-10-02 08:38:32', '2023-10-02 08:38:32'),
(4, 98, 1, '2023-10-04 05:53:08', '2023-10-04 05:53:08'),
(5, 98, 2, '2023-10-11 09:47:18', '2023-10-11 09:47:18'),
(6, 98, 1, '2023-10-11 10:41:57', '2023-10-11 10:41:57'),
(7, 98, 1, '2023-10-11 10:43:03', '2023-10-11 10:43:03'),
(8, 98, 1, '2023-10-11 10:43:53', '2023-10-11 10:43:53'),
(9, 98, 1, '2023-10-11 10:47:50', '2023-10-11 10:47:50'),
(10, 98, 1, '2023-10-11 10:53:42', '2023-10-11 10:53:42'),
(11, 98, 1, '2023-10-11 10:55:34', '2023-10-11 10:55:34'),
(12, 98, 1, '2023-10-11 10:57:06', '2023-10-11 10:57:06'),
(13, 98, 1, '2023-10-11 10:57:51', '2023-10-11 10:57:51'),
(14, 98, 1, '2023-10-11 10:58:21', '2023-10-11 10:58:21'),
(15, 98, 1, '2023-10-11 10:59:18', '2023-10-11 10:59:18'),
(16, 98, 1, '2023-10-11 10:59:43', '2023-10-11 10:59:43'),
(17, 98, 1, '2023-10-11 10:59:52', '2023-10-11 10:59:52'),
(18, 98, 1, '2023-10-11 11:03:05', '2023-10-11 11:03:05');

-- --------------------------------------------------------

--
-- Table structure for table `tranfer_morror`
--

CREATE TABLE `tranfer_morror` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `claim_id` bigint(20) UNSIGNED NOT NULL,
  `city` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `department` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `collector` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `update_by` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `company_id` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `type` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `roll` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `address` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `age` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `phone` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `additional_phone` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `iss_status` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `reg_no` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `idc` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `is_super` int(11) DEFAULT 0,
  `otp` int(11) DEFAULT NULL,
  `verifyotp` int(11) NOT NULL DEFAULT 1,
  `twofactor` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `company_id`, `type`, `roll`, `address`, `age`, `phone`, `additional_phone`, `iss_status`, `status`, `remember_token`, `created_at`, `updated_at`, `reg_no`, `idc`, `is_super`, `otp`, `verifyotp`, `twofactor`) VALUES
(1, 'Admin', 'admin@gmail.com', NULL, '$2y$10$q3oHw5WVijZGTuKJ2rHQDOIkM6atUMvk1938oFM.nr7UgDcdeIbM2', NULL, 'Admin', '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2022-01-04 09:45:11', '2023-05-31 12:06:08', NULL, NULL, 1, 596153, 1, 0),
(4, 'lawfirm', 'lawfirm@gmail.com', NULL, '$2y$10$NFAwzYOKWVbJT5eI93hqyutxU82qymbdnVD8jbcSi/EngEMKJrsYW', NULL, 'Law Firm', '2', NULL, NULL, '+923364317919', NULL, NULL, '1', NULL, '2022-01-11 04:16:14', '2023-05-18 11:43:06', '584875', 'yes', 0, NULL, 1, 0),
(5, 'law firm 2', 'lawfirm2@gmail.com', NULL, '$2y$10$NFAwzYOKWVbJT5eI93hqyutxU82qymbdnVD8jbcSi/EngEMKJrsYW', NULL, 'Law Firm', '2', NULL, NULL, '+923409000864', NULL, NULL, '0', NULL, '2022-01-11 07:42:36', '2023-01-10 17:18:01', '7418529', 'no', 0, NULL, 1, 0),
(6, 'law firm 3', 'lawfirm3@gmail.com', NULL, '$2y$10$NFAwzYOKWVbJT5eI93hqyutxU82qymbdnVD8jbcSi/EngEMKJrsYW', NULL, 'Law Firm', '2', NULL, NULL, '0123456468', NULL, NULL, '0', NULL, '2022-01-11 07:50:28', '2023-05-18 11:42:50', '7418529', 'yes', 0, NULL, 1, 0),
(41, 'ictest1', 'company1@gmail.com', NULL, '$2y$10$Rk2QEaByXw07i89xLa0ILuwnKHzWCgQs14xTEa.U2NToEd7/imlCe', '1', NULL, '1', NULL, NULL, '+966312100002', NULL, NULL, '1', NULL, '2022-10-25 04:02:50', '2023-07-28 13:04:10', '57844545', NULL, 0, 284838, 1, 0),
(42, 'finance employ', 'zeeshangujjar443@gmail.com', NULL, '$2y$10$3kNiQOTFIXCOnSCkah2o4.jETN3gM80nnknEfvd.7TieTR4yCoNeC', NULL, NULL, '3', NULL, NULL, '+966563214789', NULL, NULL, '1', NULL, '2022-10-25 04:18:50', '2023-02-13 08:18:40', '741258963', NULL, 0, NULL, 1, 0),
(43, 'teasting@gmail.com', 'democompany@gmail.com', NULL, '$2y$10$Ptqs7krRcIe20p0sGoAGQ.g9psc2x3kwroXF.vsrWKCZ9Ut1N5O8y', '2', NULL, '1', NULL, NULL, '+966312100002', NULL, NULL, '1', NULL, '2022-10-25 06:21:12', '2023-01-17 09:35:56', '4185296', NULL, 0, NULL, 1, 0),
(44, 'Demo Company 2', 'demo@gmail.com', NULL, '$2y$10$oFuqeg3J/qOOOm5agPmEc.26gOQSu2jKqHS7A5Ldgl1PkKYfc.QkG', '2', NULL, '1', NULL, NULL, '+96656666655', NULL, NULL, '1', NULL, '2022-10-25 06:24:12', '2023-07-05 09:46:34', '101010101', NULL, 0, NULL, 1, 0),
(45, 'Faisal Naser Alhojairy', 'faisaln@taheiya.sa', NULL, '$2y$10$ELXPf43b.jKg/00TGuhkYeYxrgcIykSHRefszRaux2iZBokO9OrWO', '3', NULL, '1', NULL, NULL, '+966558426651', NULL, NULL, '0', NULL, '2022-10-26 10:31:33', '2023-07-28 13:03:53', '1088745870', NULL, 0, NULL, 1, 0),
(47, 'Omar Alzouabi', 'Omar.AlZouabi@gig.sa', NULL, '$2y$10$M6psPPYbioGyEa/DrqMrueL8oIgEbIX2dUdwsZCVag27gt7ptn5Xq', '3', NULL, '1', NULL, NULL, '+966508650888', NULL, NULL, '1', NULL, '2022-10-27 06:54:01', '2023-07-28 13:03:52', '1010861720', NULL, 0, NULL, 1, 0),
(48, 'Mansour Alzahrani', 'mansour.alzahrani@gig.sa', NULL, '$2y$10$Ww0GMznNamOdmkhg/ZRJn.6ctvyrszdobj0.JYoxug/GpMrBKvHLm', '3', NULL, '1', NULL, NULL, '+966596445911', NULL, NULL, '1', NULL, '2022-10-27 06:56:00', '2022-10-27 06:56:00', '1010861720', NULL, 0, NULL, 1, 0),
(50, 'Azam Aloutaibi', 'Azam.Aloutaibi@gig.sa', NULL, '$2y$10$Hhd/8p6UO1jIJOqrNoJux.p7QfH476IwY68eqL7V9auvS1GdQQV2G', '3', NULL, '1', NULL, NULL, '+966534455777', NULL, NULL, '1', NULL, '2022-10-27 07:00:58', '2022-10-27 07:00:58', '1010861720', NULL, 0, NULL, 1, 0),
(51, 'Taghreed Alshuhari', 'Taghreed.Alshuhari@gig.sa', NULL, '$2y$10$Ys9mKGCldzoRTPbiKeYBOu9bSmbWhWlSLQVFHgssgchlvxyo8Ssna', '3', NULL, '1', NULL, NULL, '+966554587737', NULL, NULL, '1', NULL, '2022-10-27 07:01:58', '2022-10-27 07:01:58', '1010861720', NULL, 0, NULL, 1, 0),
(52, 'Alhanouf Alobaid', 'Alhanouf.Alobaid@gig.sa', NULL, '$2y$10$xpyPZ66WFnmgZZWLvjkLRuX/KcMdlDsdU73fSv0qsZBtbxSNrFkE6', '3', NULL, '1', NULL, NULL, '+966543404050', NULL, NULL, '1', NULL, '2022-10-27 07:03:28', '2022-10-27 07:03:28', '1010861720', NULL, 0, NULL, 1, 0),
(53, 'Yasmin Alsahli', 'Yasmin.Alsahli@gig.sa', NULL, '$2y$10$XIGf/8r8jYgIe.QHiG3XfOuI2DoDbERY2WxBSWNqBPN526iApN.XC', '3', NULL, '1', NULL, NULL, '+966551265318', NULL, NULL, '1', NULL, '2022-10-27 07:04:30', '2022-10-27 07:04:30', '1010861720', NULL, 0, NULL, 1, 0),
(54, 'May Albugami', 'May.Albugami@gig.sa', NULL, '$2y$10$l4mOMImCD4YitqE1Cc0zNeYOw/.yynJaikhfzLAor847xjp.fvmm2', '3', NULL, '1', NULL, NULL, '+966591788476', NULL, NULL, '1', NULL, '2022-10-27 07:05:59', '2022-10-27 07:05:59', '1010861720', NULL, 0, NULL, 1, 0),
(58, 'Abdul Malik', 'aalhojairy@gmail.com', NULL, '$2y$10$q3oHw5WVijZGTuKJ2rHQDOIkM6atUMvk1938oFM.nr7UgDcdeIbM2', '5', NULL, '0', NULL, NULL, '+966569999552', NULL, NULL, '1', NULL, '2022-10-31 06:57:53', '2022-10-31 06:57:53', '1010861720', NULL, 1, NULL, 1, 0),
(63, 'Yazeed Alanazi', 'Yazeed.Alanazi@gig.sa', NULL, '$2y$10$bAfefR07n9YnEnB1tykPbe9738gm3bzDX5tbImZIvK1bWBBqz5vzu', '3', NULL, '1', NULL, NULL, '+966502493220', NULL, NULL, '1', NULL, '2022-11-06 11:45:28', '2022-11-06 11:45:52', '1010861720', NULL, 0, NULL, 1, 0),
(64, 'Mohammed', 'mhabib@taheiya.sa', NULL, '$2y$10$vOV69CfgIADL9.3S2cnC9.X81MqY6eXz9Qz4AoY.wW8JB3GvTkoje', NULL, NULL, '0', NULL, NULL, '+966563047218', NULL, NULL, '1', NULL, '2022-11-06 12:18:41', '2023-02-27 15:03:23', '1106500661', NULL, 2, NULL, 1, 0),
(66, 'Majed Almoisheer', 'majed@taheiya.sa', NULL, '$2y$10$CHSFo.mwFVPNVz3UKl20TukXbrJRo9dqsEHzRG40X/dq4NHJzOI2m', NULL, NULL, '0', NULL, NULL, '+966554266934', NULL, NULL, '1', NULL, '2022-11-07 06:54:09', '2022-11-07 06:54:09', '1004189310', NULL, 1, NULL, 1, 0),
(67, 'Mohammed Alkhder', 'mkhdher@taheiya.sa', NULL, '$2y$10$4N/W2U2pEXm2s9Ih3tN2I.lmHIoDcSXEDtelDiwLVxmi48JV7E5X.', NULL, NULL, '0', NULL, NULL, '+966500003163', NULL, NULL, '1', NULL, '2022-11-07 06:55:29', '2022-11-07 06:55:29', '1041423268', NULL, 1, NULL, 1, 0),
(68, 'TEST USER', 'speed.55sa@gmail.com', NULL, '$2y$10$bHgD129BGPcY2GZqYUMg5eWdJ1vt4CNMWvRt4sc5CFZ9DZ6Q.aIAW', '3', NULL, '1', NULL, NULL, '+966569999552', NULL, NULL, '1', NULL, '2022-11-07 06:58:21', '2023-02-14 09:38:18', '1010861720', NULL, 1, NULL, 1, 0),
(69, 'MKHDHR', 'mkhdher@gmail.com', NULL, '$2y$10$lxmroPwIqLtSk1ggcUDxXerOsZan0tBF70UmdcKI9SC2uezWdOuPq', '2', NULL, '1', NULL, NULL, '+966500003163', NULL, NULL, '1', NULL, '2022-11-07 08:06:15', '2022-11-07 08:06:15', '1041423268', NULL, 0, NULL, 1, 0),
(70, 'Faisal Naser', 'faisalnh76@gmail.com', NULL, '$2y$10$Y2EOkUXWez3PDH5yZeVZyuQh2BYV09pTMYTfdEIi.i7p9qBcEVXhO', NULL, NULL, '0', NULL, NULL, '+966558426651', NULL, NULL, '1', NULL, '2022-11-08 08:19:09', '2022-11-08 08:19:09', '1088745870', NULL, 0, NULL, 1, 0),
(71, 'testing', 'collector@gmail.com', NULL, '$2y$10$2d8VMk6l5R546GIXQqSWVedQaUoC7z9XvH92KuvsT4Bljd8jy3yjq', NULL, NULL, '5', NULL, NULL, NULL, NULL, NULL, '1', NULL, '2022-12-08 17:42:20', '2022-12-08 17:42:20', '557487454', NULL, 0, NULL, 1, 0),
(72, 'Collector Test 1', 'Collector10101010101010101010@gmail.com', NULL, '$2y$10$KIrLFRqq89OfvX4cX3sepulwz.F90I9yilGEL0o4M0hxd39klJov2', NULL, NULL, '5', NULL, NULL, NULL, NULL, NULL, '1', NULL, '2022-12-08 17:48:13', '2022-12-08 17:48:13', '10101010101010', NULL, 0, NULL, 1, 0),
(73, 'Abdulmalik Al Hojairy', 'aalhojairy@ggi-sa.com', NULL, '$2y$10$Z5NC1kvora9AHZKKFbVXNe/wWLZe0yZIXj3oAOvtXGl.4qDJLmZHK', '5', NULL, '1', NULL, NULL, '+966569999552', NULL, NULL, '1', NULL, '2023-03-07 14:18:53', '2023-03-07 14:18:53', '1010861720', NULL, 0, NULL, 1, 0),
(74, 'TEST USER', 'admin@taheiya.sa', NULL, '$2y$10$hN7TwUY2RGP21mjnyfyMWOCMSG71s0VCiEQeJ93YEZ0g0B0JF9Zvi', NULL, NULL, '0', NULL, NULL, '+966554266934', NULL, NULL, '1', NULL, '2023-03-07 14:21:03', '2023-03-07 14:21:03', '1010752053', NULL, 1, NULL, 1, 0),
(75, 'Hana Ahmad', 'hana@taheiya.sa', NULL, '$2y$10$d3Rqp7dmYNLlZVojY.c4YeCHmXhIB0ZQ9.JkCzuB83RfTPyW9yMTS', NULL, NULL, '0', NULL, NULL, '+966563964778', NULL, NULL, '0', NULL, '2023-03-08 10:46:13', '2023-03-08 10:46:13', '1049797150', NULL, 2, NULL, 1, 0),
(76, 'Hazim Mohammad', 'hazim@taheiya.sa', NULL, '$2y$10$1YaRIQSTJReFydH6hjXkxOzGaAVGAQpFVmz3/GalUZ0KPor5MZAsO', NULL, NULL, '0', NULL, NULL, '+9660530027412', NULL, NULL, '1', NULL, '2023-04-30 15:30:23', '2023-04-30 15:30:23', '2519770339', NULL, 2, NULL, 1, 0),
(77, 'Hussain Meid Al Mahri', 'hmahri@gulfunion-saudi.com', NULL, '$2y$10$4nVTgJpTs2pY/KiljzhUzOmoMV8ca8dzuIhHDHl0sRS8bQI9UTLNa', '6', NULL, '1', NULL, NULL, '+966558871385', NULL, NULL, '1', NULL, '2023-05-11 08:52:42', '2023-05-11 08:52:42', '1234567890', NULL, 0, NULL, 1, 0),
(78, 'Elham Al Nasser', 'ealnasser@gulfunion-saudi.com', NULL, '$2y$10$O1R2GhxKyCwYAMqZO1aJ..6UPQ/KnMbd8ibCiPdKboJ15PoJeNHMO', '6', NULL, '1', NULL, NULL, '+966559483791', NULL, NULL, '1', NULL, '2023-05-11 08:53:48', '2023-05-11 09:34:55', '1234567890', NULL, 0, NULL, 1, 0),
(80, 'Lester', 'lester@pentesting.sa', NULL, '$2y$10$cn2ORYT35dMh40KrkOXLWuVj8Mh.86ns0iS9t3ZrytnQGAdf/FYee', '1', NULL, '1', NULL, NULL, '+966000000000', NULL, NULL, '1', NULL, '2023-05-15 14:03:11', '2023-05-15 14:03:11', 'N/A', NULL, 0, NULL, 1, 0),
(81, 'Meshal Al Moisheer', 'meshal@taheiya.sa', NULL, '$2y$10$zzC1FHcLiwHU5u8TPVydIuWnb3E0xtyZZY2oY5RPmrxE.hh23nd7y', NULL, NULL, '0', NULL, NULL, '+966558057598', NULL, NULL, '1', NULL, '2023-06-01 09:45:14', '2023-06-01 09:45:14', '1061622583', NULL, 0, NULL, 1, 0),
(82, 'Amir SuperAdmin', 'superadmin@gmail.com', '2023-07-28 06:04:03', '$2y$10$q3oHw5WVijZGTuKJ2rHQDOIkM6atUMvk1938oFM.nr7UgDcdeIbM2', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, 1, 0),
(83, 'Test User 1', 'testuser1@gmail.com', NULL, '$2y$10$Bf66AEsSS.x2fhbbcpLSWuYci9apCjmrduBPE0xGeuC41oKpH2ejW', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2023-07-31 07:31:23', '2023-07-31 07:31:23', NULL, NULL, 0, NULL, 1, 0),
(84, 'test user 2', 'testuser2@gmail.com', NULL, '$2y$10$3M9tsb4Jm7SJ0sBMkIJ.vuxCRwqf3bZRpxUtMYF0Hx1cczHCgsgyS', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2023-07-31 07:36:02', '2023-07-31 07:36:02', NULL, NULL, 0, NULL, 1, 0),
(85, 'this is first name for test', 'testuser3@gmail.com', NULL, '$2y$10$Ri03l7cu.utMdPyhB8W5O.ntV7b41k/D/RFDoL4KAnx6u/ca235pa', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2023-07-31 07:42:46', '2023-07-31 07:42:46', NULL, NULL, 0, NULL, 1, 0),
(86, 'this is first name for test', 'testuser5@gmail.com', NULL, '$2y$10$o2HKte.f1PgnsjaJcGtUG.WdMYv5Cz8yJHKjMjy76EPqXpDKN1Z.y', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2023-07-31 07:47:38', '2023-07-31 07:47:38', NULL, NULL, 0, NULL, 1, 0),
(87, 'Neown Logiceeee', 'testuser6@gmail.com', NULL, '$2y$10$SS4erhUCGx.uAiXVlhn0SulV0E/L81a0Rm0973tdXPh831eoo49Uu', NULL, NULL, '0', NULL, NULL, '+966432143214', NULL, NULL, '1', NULL, '2023-07-31 07:50:34', '2023-07-31 07:50:34', '324324535345435', NULL, 0, NULL, 1, 0),
(88, 'reown Logics', 'testuser7@gmail.com', NULL, '$2y$10$1cqSEhnHHZos5qv1rv.Z6.QHpaFLNyMW49RDtQPYIAGPEINLohClK', NULL, NULL, '0', NULL, NULL, '+966657576574', NULL, NULL, '1', NULL, '2023-07-31 07:52:04', '2023-07-31 07:52:04', '324324535345435', NULL, 0, NULL, 1, 0),
(89, 'Neown Logicsssssss', 'testuser8@gmail.com', NULL, '$2y$10$qyVuiDwEeBA4USQEaDtVY.Gw5/F362A9s7xWwuNyuJrwWfVGQfpKa', NULL, NULL, '0', NULL, NULL, '+966123431243214', NULL, NULL, '1', NULL, '2023-07-31 07:56:50', '2023-07-31 07:56:50', '324324535345435', NULL, 0, NULL, 1, 0),
(90, 'new employee', 'testuseretwerr1@gmail.com', NULL, '$2y$10$hEziyvKyndSv9fTbfSWN6ewm/na90DNmZQJ2gly98a1xgmRlINla2', NULL, NULL, '0', NULL, NULL, '+9665345432543', NULL, NULL, '1', NULL, '2023-08-01 11:16:09', '2023-08-01 11:16:09', '2454353453425', NULL, 0, NULL, 1, 0),
(91, 'Neown Logiceeee', 'employee1@gmail.com', NULL, '$2y$10$QUwfv3GWCdYlfATl3JRMR.XYG3yAgCnpV0ncQwkpWSTPfjQO5OzfO', NULL, NULL, '0', NULL, NULL, '+96653425432534534', NULL, NULL, '1', NULL, '2023-08-01 11:19:39', '2023-08-01 11:19:39', '324324535345435', NULL, 0, NULL, 1, 0),
(92, 'Employee 2', 'employee2@gmail.com', NULL, '$2y$10$2w8BnVboZdJVyPbVkRCutOILTXC3mQlqtwO8Z.IKuOnxon.pB82pS', NULL, NULL, '0', NULL, NULL, '+966543534253425', NULL, NULL, '1', NULL, '2023-08-02 06:31:51', '2023-08-02 06:31:51', '4321432423423', NULL, 0, NULL, 1, 0),
(93, 'Miss Mehwish', 'manager@taheiya.com', NULL, '$2y$10$3iUpsLn1kmw4XgEiBhC8KeoZpAuyRfKNImKcusOOo8NTXKiFJjLRi', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2023-08-03 05:11:51', '2023-08-03 05:11:51', NULL, NULL, 0, NULL, 1, 0),
(94, 'Sir Abdullah', 'superadmin@taheiya.com', NULL, '$2y$10$WkDv2QEzMkXYK63hW.BIOeztgJXpL5MUpsdfxA2UWy3bhBhsUzwqi', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2023-08-03 05:21:58', '2023-08-03 05:21:58', NULL, NULL, 0, NULL, 1, 0),
(95, 'Miss Ambreen', 'director@taheiya.com', NULL, '$2y$10$trS58v2g6Phu7rM/rLVBbeDHvsAOjg/GypI27lK/YZWylI/1kfite', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2023-08-03 05:21:58', '2023-08-03 05:21:58', NULL, NULL, 0, NULL, 1, 0),
(96, 'Muhammad Amir', 'admin@taheiya.com', NULL, '$2y$10$r85birl6wyVYFJagMZViS.cwolL9RTu2i7Kn.hOmDJACrEUxeWD6S', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2023-08-03 05:22:57', '2023-08-03 05:22:57', NULL, NULL, 0, NULL, 1, 0),
(97, 'Muhammad Ansar', 'officer@taheiya.com', NULL, '$2y$10$C//t/KXJTmr3ZJDx8UAGQOqHTCwRdupfM2V2jg6kHVclCXciNO1cG', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2023-08-03 05:22:57', '2023-08-03 05:22:57', NULL, NULL, 0, NULL, 1, 0),
(98, 'Mubeen Boss', 'supervisor@taheiya.com', NULL, '$2y$10$3kNiQOTFIXCOnSCkah2o4.jETN3gM80nnknEfvd.7TieTR4yCoNeC', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2023-08-03 05:22:57', '2023-08-03 05:22:57', NULL, NULL, 0, NULL, 1, 0),
(99, 'Bushra bibi', 'collector@taheiya.com', NULL, '$2y$10$u.GUqZlTs/gwiOmDZ0C/yO4K7qE2/EJ8/BGG1nTzZgOX3fZguEyQC', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '1', NULL, '2023-08-03 05:22:57', '2023-09-29 05:53:43', NULL, NULL, 0, NULL, 1, 0),
(100, 'new officer', 'officer2@taheiya.com', NULL, '$2y$10$c.Nohke7ZIYHs6ZsfC5T0.DD3vjHkTfJ671QuyQZbKMWqdURv9F2O', NULL, NULL, '0', NULL, NULL, '+966434534534', NULL, NULL, '1', NULL, '2023-08-06 00:23:05', '2023-08-06 00:23:05', '54235423543', NULL, 0, NULL, 1, 0),
(101, 'new officer 3', 'officer3@taheiya.com', NULL, '$2y$10$EvC9VP8CPFq5yNUrVa2/O.GzaCsvRnI497k1fob0a53BkjK9b8mKi', NULL, NULL, '0', NULL, NULL, '+96634324324321', NULL, NULL, '1', NULL, '2023-08-06 00:24:35', '2023-08-06 00:24:35', '54235423543', NULL, 0, NULL, 1, 0),
(102, 'new admin', 'adminmeshal@taheiya.com', NULL, '$2y$10$7ixwosPLVkgNsk9nSi9/iOl1kTQK9FwVxOvgky8onkFTkhSABGbeG', NULL, NULL, '0', NULL, NULL, '+96654325432543', NULL, NULL, '1', NULL, '2023-08-07 09:36:12', '2023-08-07 09:36:12', '4535432534', NULL, 0, NULL, 1, 0),
(103, 'new officer', 'officerme@taheiya.com', NULL, '$2y$10$PhoxexYf7sqPTElefMqz9OQsVMQlSQzVWo.n5QtpQlgEVQhK.gkiS', NULL, NULL, '0', NULL, NULL, '+966676775765', NULL, NULL, '1', NULL, '2023-08-07 09:37:48', '2023-08-07 09:37:48', '54235423543', NULL, 0, NULL, 1, 0),
(104, 'TEST OFFICER', 'officer4@taheiya.com', NULL, '$2y$10$QX7ZwAad2gXO7sPgCtAQdeF6kEjg1KKXoPuvFUQr0pXn.aM6PBSai', NULL, NULL, '0', NULL, NULL, '+9665342543', NULL, NULL, '1', NULL, '2023-08-29 05:06:46', '2023-09-01 05:28:58', '54235423543', NULL, 0, NULL, 1, 0),
(105, 'Law', 'sqatest08@gmail.com', NULL, '$2y$10$.2TqpYqMFq9wGnUtjO/lJeTytzHIZ0MNenTAQLkCbbFqXRJRBy/U6', NULL, NULL, '0', NULL, NULL, '+9661234567890', '+9666786876687', NULL, '1', NULL, '2023-08-29 05:11:26', '2023-09-13 07:40:14', '12345677', NULL, 0, NULL, 1, 0),
(106, 'extension phone user', 'extensionuser@taheiya.com', NULL, '$2y$10$T3SmVTuahajzIYXXLuWtSuP8Szd1861TdLW81MMqc4UdEQQqSKNbG', NULL, NULL, '0', NULL, NULL, '+966542354325', '+9665454235432', NULL, '1', NULL, '2023-09-13 07:43:22', '2023-09-13 07:43:22', '4543254325', NULL, 0, NULL, 1, 0),
(107, 'officerfromsupervisor', 'officerfromsupervisor@taheiya.com', NULL, '$2y$10$X0I/N5m2kSuJ9LwijXG.AuKKH56pu6hJhTY3POUOk6TVhfL4JReJy', NULL, NULL, '0', NULL, NULL, '+9665425435654', '+9666536547543654', NULL, '0', NULL, '2023-09-13 09:09:55', '2023-09-15 02:45:42', '54254325', NULL, 0, NULL, 1, 0),
(108, 'Talha', 'talha@gmail.com', NULL, '$2y$10$p/JJYrvB5UM4ewrkVM0Hk.2UGw55p5pBdQ4OXfNQrPEzG3w5SMx8y', NULL, NULL, '0', NULL, NULL, '+9660387341088', '+96603187341088', NULL, '1', NULL, '2023-09-30 09:15:49', '2023-09-30 09:15:49', '3430181331293', NULL, 0, NULL, 1, 0);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `additional_detail`
--
ALTER TABLE `additional_detail`
  ADD PRIMARY KEY (`id`),
  ADD KEY `additional_detail_claim_id_foreign` (`claim_id`);

--
-- Indexes for table `additional_sadad`
--
ALTER TABLE `additional_sadad`
  ADD PRIMARY KEY (`id`),
  ADD KEY `additional_sadad_claim_id_foreign` (`claim_id`);

--
-- Indexes for table `admin_doc`
--
ALTER TABLE `admin_doc`
  ADD PRIMARY KEY (`id`),
  ADD KEY `admin_doc_claim_id_foreign` (`claim_id`);

--
-- Indexes for table `call_response`
--
ALTER TABLE `call_response`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `call_status`
--
ALTER TABLE `call_status`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `claims`
--
ALTER TABLE `claims`
  ADD PRIMARY KEY (`id`),
  ADD KEY `claims_cid_foreign` (`cid`);

--
-- Indexes for table `claims_excels`
--
ALTER TABLE `claims_excels`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `claims_excels_file_name_unique` (`file_name`);

--
-- Indexes for table `claim_collected`
--
ALTER TABLE `claim_collected`
  ADD PRIMARY KEY (`id`),
  ADD KEY `claim_collected_claim_id_foreign` (`claim_id`);

--
-- Indexes for table `claim_comments`
--
ALTER TABLE `claim_comments`
  ADD PRIMARY KEY (`id`),
  ADD KEY `claim_comments_claim_id_foreign` (`claim_id`);

--
-- Indexes for table `claim_data`
--
ALTER TABLE `claim_data`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `claim_reasons`
--
ALTER TABLE `claim_reasons`
  ADD PRIMARY KEY (`id`),
  ADD KEY `claim_reasons_claim_id_foreign` (`claim_id`);

--
-- Indexes for table `claim_remarks`
--
ALTER TABLE `claim_remarks`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `claim_status`
--
ALTER TABLE `claim_status`
  ADD PRIMARY KEY (`id`),
  ADD KEY `claim_status_claim_id_foreign` (`claim_id`);

--
-- Indexes for table `collection_office`
--
ALTER TABLE `collection_office`
  ADD PRIMARY KEY (`id`),
  ADD KEY `collection_office_claim_id_foreign` (`claim_id`),
  ADD KEY `collection_office_collector_id_foreign` (`collector_id`);

--
-- Indexes for table `companies`
--
ALTER TABLE `companies`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `contact_us`
--
ALTER TABLE `contact_us`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `custome_partial_mada`
--
ALTER TABLE `custome_partial_mada`
  ADD PRIMARY KEY (`id`),
  ADD KEY `custome_partial_mada_claim_id_foreign` (`claim_id`),
  ADD KEY `custome_partial_mada_pay_id_foreign` (`partial_id`);

--
-- Indexes for table `custome_partial_sadad`
--
ALTER TABLE `custome_partial_sadad`
  ADD PRIMARY KEY (`id`),
  ADD KEY `custome_partial_sadad_claim_id_foreign` (`claim_id`),
  ADD KEY `custome_partial_sadad_partial_id_foreign` (`partial_id`);

--
-- Indexes for table `debivrresp`
--
ALTER TABLE `debivrresp`
  ADD PRIMARY KEY (`id`),
  ADD KEY `debivrresp_claim_id_foreign` (`claim_id`);

--
-- Indexes for table `debtorrefuses`
--
ALTER TABLE `debtorrefuses`
  ADD PRIMARY KEY (`id`),
  ADD KEY `debtorrefuses_debtorresponse_id_foreign` (`debtorresponse_id`),
  ADD KEY `debtorrefuses_lawfirm_id_foreign` (`lawfirm_id`);

--
-- Indexes for table `debtorresponses`
--
ALTER TABLE `debtorresponses`
  ADD PRIMARY KEY (`id`),
  ADD KEY `debtorresponses_claim_id_foreign` (`claim_id`);

--
-- Indexes for table `debtor_bank_transfers`
--
ALTER TABLE `debtor_bank_transfers`
  ADD PRIMARY KEY (`id`),
  ADD KEY `debtor_bank_transfers_claim_id_foreign` (`claim_id`);

--
-- Indexes for table `deb_discounts`
--
ALTER TABLE `deb_discounts`
  ADD PRIMARY KEY (`id`),
  ADD KEY `deb_discounts_claim_id_foreign` (`claim_id`);

--
-- Indexes for table `deb_doc`
--
ALTER TABLE `deb_doc`
  ADD PRIMARY KEY (`id`),
  ADD KEY `deb_doc_claim_id_foreign` (`claim_id`);

--
-- Indexes for table `deb_refuse_reason`
--
ALTER TABLE `deb_refuse_reason`
  ADD PRIMARY KEY (`id`),
  ADD KEY `deb_refuse_reason_debtorresponses_id_foreign` (`debtorresponses_id`),
  ADD KEY `deb_refuse_reason_claim_id_foreign` (`claim_id`);

--
-- Indexes for table `delay_error`
--
ALTER TABLE `delay_error`
  ADD PRIMARY KEY (`id`),
  ADD KEY `delay_error_claim_id_foreign` (`claim_id`);

--
-- Indexes for table `distributions`
--
ALTER TABLE `distributions`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `elm_status`
--
ALTER TABLE `elm_status`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `events`
--
ALTER TABLE `events`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indexes for table `file_bin`
--
ALTER TABLE `file_bin`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `finance_cases`
--
ALTER TABLE `finance_cases`
  ADD PRIMARY KEY (`id`),
  ADD KEY `finance_cases_claim_id_foreign` (`claim_id`);

--
-- Indexes for table `financial_companies`
--
ALTER TABLE `financial_companies`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `ic_doc`
--
ALTER TABLE `ic_doc`
  ADD PRIMARY KEY (`id`),
  ADD KEY `ic_doc_claim_id_foreign` (`claim_id`);

--
-- Indexes for table `law_firm_cases`
--
ALTER TABLE `law_firm_cases`
  ADD PRIMARY KEY (`id`),
  ADD KEY `law_firm_cases_claim_id_foreign` (`claim_id`);

--
-- Indexes for table `legal_department_model`
--
ALTER TABLE `legal_department_model`
  ADD PRIMARY KEY (`id`),
  ADD KEY `legal_department_model_claim_id_foreign` (`claim_id`);

--
-- Indexes for table `loans`
--
ALTER TABLE `loans`
  ADD PRIMARY KEY (`id`),
  ADD KEY `loans_claim_id_foreign` (`claim_id`),
  ADD KEY `loans_company_id_foreign` (`company_id`);

--
-- Indexes for table `messages`
--
ALTER TABLE `messages`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `notifications`
--
ALTER TABLE `notifications`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `officer_discount_rates`
--
ALTER TABLE `officer_discount_rates`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `officer_targets`
--
ALTER TABLE `officer_targets`
  ADD PRIMARY KEY (`id`),
  ADD KEY `officer_targets_officer_id_foreign` (`officer_id`);

--
-- Indexes for table `partial_manual`
--
ALTER TABLE `partial_manual`
  ADD PRIMARY KEY (`id`),
  ADD KEY `partial_manual_claim_id_foreign` (`claim_id`),
  ADD KEY `partial_manual_partial_id_foreign` (`partial_id`);

--
-- Indexes for table `partial_pay`
--
ALTER TABLE `partial_pay`
  ADD PRIMARY KEY (`id`),
  ADD KEY `partial_pay_claim_id_foreign` (`claim_id`);

--
-- Indexes for table `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`);

--
-- Indexes for table `payment`
--
ALTER TABLE `payment`
  ADD PRIMARY KEY (`id`),
  ADD KEY `payment_claim_id_foreign` (`claim_id`);

--
-- Indexes for table `payment_links`
--
ALTER TABLE `payment_links`
  ADD PRIMARY KEY (`id`),
  ADD KEY `payment_links_claim_id_foreign` (`claim_id`);

--
-- Indexes for table `pay_delay`
--
ALTER TABLE `pay_delay`
  ADD PRIMARY KEY (`id`),
  ADD KEY `pay_delay_claim_id_foreign` (`claim_id`);

--
-- Indexes for table `permissions`
--
ALTER TABLE `permissions`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `permissions_name_unique` (`name`);

--
-- Indexes for table `permission_role`
--
ALTER TABLE `permission_role`
  ADD PRIMARY KEY (`permission_id`,`role_id`),
  ADD KEY `permission_role_role_id_foreign` (`role_id`);

--
-- Indexes for table `permission_user`
--
ALTER TABLE `permission_user`
  ADD PRIMARY KEY (`user_id`,`permission_id`,`user_type`),
  ADD KEY `permission_user_permission_id_foreign` (`permission_id`);

--
-- Indexes for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  ADD KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`);

--
-- Indexes for table `pre_claims`
--
ALTER TABLE `pre_claims`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `reasons`
--
ALTER TABLE `reasons`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `roles_name_unique` (`name`);

--
-- Indexes for table `role_user`
--
ALTER TABLE `role_user`
  ADD PRIMARY KEY (`user_id`,`role_id`,`user_type`),
  ADD KEY `role_user_role_id_foreign` (`role_id`);

--
-- Indexes for table `sadad_pay`
--
ALTER TABLE `sadad_pay`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sadad_pay_claim_id_foreign` (`claim_id`);

--
-- Indexes for table `sadad_response`
--
ALTER TABLE `sadad_response`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `settings`
--
ALTER TABLE `settings`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sms_response`
--
ALTER TABLE `sms_response`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `status_history`
--
ALTER TABLE `status_history`
  ADD PRIMARY KEY (`id`),
  ADD KEY `status_history_claim_id_foreign` (`claim_id`);

--
-- Indexes for table `supported-doc`
--
ALTER TABLE `supported-doc`
  ADD PRIMARY KEY (`id`),
  ADD KEY `supported_doc_company_id_foreign` (`company_id`);

--
-- Indexes for table `table_approve_log`
--
ALTER TABLE `table_approve_log`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tranfer_morror`
--
ALTER TABLE `tranfer_morror`
  ADD PRIMARY KEY (`id`),
  ADD KEY `tranfer_morror_claim_id_foreign` (`claim_id`);

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
-- AUTO_INCREMENT for table `additional_detail`
--
ALTER TABLE `additional_detail`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `additional_sadad`
--
ALTER TABLE `additional_sadad`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `admin_doc`
--
ALTER TABLE `admin_doc`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `call_response`
--
ALTER TABLE `call_response`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `call_status`
--
ALTER TABLE `call_status`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `claims`
--
ALTER TABLE `claims`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `claims_excels`
--
ALTER TABLE `claims_excels`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `claim_collected`
--
ALTER TABLE `claim_collected`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `claim_comments`
--
ALTER TABLE `claim_comments`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `claim_data`
--
ALTER TABLE `claim_data`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `claim_reasons`
--
ALTER TABLE `claim_reasons`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `claim_remarks`
--
ALTER TABLE `claim_remarks`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `claim_status`
--
ALTER TABLE `claim_status`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `collection_office`
--
ALTER TABLE `collection_office`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `companies`
--
ALTER TABLE `companies`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `contact_us`
--
ALTER TABLE `contact_us`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `custome_partial_mada`
--
ALTER TABLE `custome_partial_mada`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `custome_partial_sadad`
--
ALTER TABLE `custome_partial_sadad`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `debivrresp`
--
ALTER TABLE `debivrresp`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `debtorrefuses`
--
ALTER TABLE `debtorrefuses`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `debtorresponses`
--
ALTER TABLE `debtorresponses`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `debtor_bank_transfers`
--
ALTER TABLE `debtor_bank_transfers`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `deb_discounts`
--
ALTER TABLE `deb_discounts`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `deb_doc`
--
ALTER TABLE `deb_doc`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `deb_refuse_reason`
--
ALTER TABLE `deb_refuse_reason`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `delay_error`
--
ALTER TABLE `delay_error`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `distributions`
--
ALTER TABLE `distributions`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `elm_status`
--
ALTER TABLE `elm_status`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `events`
--
ALTER TABLE `events`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `file_bin`
--
ALTER TABLE `file_bin`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `finance_cases`
--
ALTER TABLE `finance_cases`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `financial_companies`
--
ALTER TABLE `financial_companies`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `ic_doc`
--
ALTER TABLE `ic_doc`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `law_firm_cases`
--
ALTER TABLE `law_firm_cases`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `legal_department_model`
--
ALTER TABLE `legal_department_model`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `loans`
--
ALTER TABLE `loans`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `messages`
--
ALTER TABLE `messages`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=104;

--
-- AUTO_INCREMENT for table `notifications`
--
ALTER TABLE `notifications`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=51;

--
-- AUTO_INCREMENT for table `officer_discount_rates`
--
ALTER TABLE `officer_discount_rates`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `officer_targets`
--
ALTER TABLE `officer_targets`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `partial_manual`
--
ALTER TABLE `partial_manual`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `partial_pay`
--
ALTER TABLE `partial_pay`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `payment`
--
ALTER TABLE `payment`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `payment_links`
--
ALTER TABLE `payment_links`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `pay_delay`
--
ALTER TABLE `pay_delay`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `permissions`
--
ALTER TABLE `permissions`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=177;

--
-- AUTO_INCREMENT for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `pre_claims`
--
ALTER TABLE `pre_claims`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `reasons`
--
ALTER TABLE `reasons`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `roles`
--
ALTER TABLE `roles`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=79;

--
-- AUTO_INCREMENT for table `sadad_pay`
--
ALTER TABLE `sadad_pay`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `sadad_response`
--
ALTER TABLE `sadad_response`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `settings`
--
ALTER TABLE `settings`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `sms_response`
--
ALTER TABLE `sms_response`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `status_history`
--
ALTER TABLE `status_history`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `supported-doc`
--
ALTER TABLE `supported-doc`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `table_approve_log`
--
ALTER TABLE `table_approve_log`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `tranfer_morror`
--
ALTER TABLE `tranfer_morror`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=109;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `additional_detail`
--
ALTER TABLE `additional_detail`
  ADD CONSTRAINT `additional_detail_claim_id_foreign` FOREIGN KEY (`claim_id`) REFERENCES `claims` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `additional_sadad`
--
ALTER TABLE `additional_sadad`
  ADD CONSTRAINT `additional_sadad_claim_id_foreign` FOREIGN KEY (`claim_id`) REFERENCES `claims` (`id`);

--
-- Constraints for table `admin_doc`
--
ALTER TABLE `admin_doc`
  ADD CONSTRAINT `admin_doc_claim_id_foreign` FOREIGN KEY (`claim_id`) REFERENCES `claims` (`id`);

--
-- Constraints for table `claim_collected`
--
ALTER TABLE `claim_collected`
  ADD CONSTRAINT `claim_collected_claim_id_foreign` FOREIGN KEY (`claim_id`) REFERENCES `claims` (`id`);

--
-- Constraints for table `claim_comments`
--
ALTER TABLE `claim_comments`
  ADD CONSTRAINT `claim_comments_claim_id_foreign` FOREIGN KEY (`claim_id`) REFERENCES `claims` (`id`);

--
-- Constraints for table `claim_reasons`
--
ALTER TABLE `claim_reasons`
  ADD CONSTRAINT `claim_reasons_claim_id_foreign` FOREIGN KEY (`claim_id`) REFERENCES `claims` (`id`);

--
-- Constraints for table `claim_status`
--
ALTER TABLE `claim_status`
  ADD CONSTRAINT `claim_status_claim_id_foreign` FOREIGN KEY (`claim_id`) REFERENCES `claims` (`id`);

--
-- Constraints for table `collection_office`
--
ALTER TABLE `collection_office`
  ADD CONSTRAINT `collection_office_claim_id_foreign` FOREIGN KEY (`claim_id`) REFERENCES `claims` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `collection_office_collector_id_foreign` FOREIGN KEY (`collector_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `debivrresp`
--
ALTER TABLE `debivrresp`
  ADD CONSTRAINT `debivrresp_claim_id_foreign` FOREIGN KEY (`claim_id`) REFERENCES `claims` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `debtorrefuses`
--
ALTER TABLE `debtorrefuses`
  ADD CONSTRAINT `debtorrefuses_debtorresponse_id_foreign` FOREIGN KEY (`debtorresponse_id`) REFERENCES `debtorresponses` (`id`),
  ADD CONSTRAINT `debtorrefuses_lawfirm_id_foreign` FOREIGN KEY (`lawfirm_id`) REFERENCES `users` (`id`);

--
-- Constraints for table `debtor_bank_transfers`
--
ALTER TABLE `debtor_bank_transfers`
  ADD CONSTRAINT `debtor_bank_transfers_claim_id_foreign` FOREIGN KEY (`claim_id`) REFERENCES `claims` (`id`);

--
-- Constraints for table `deb_discounts`
--
ALTER TABLE `deb_discounts`
  ADD CONSTRAINT `deb_discounts_claim_id_foreign` FOREIGN KEY (`claim_id`) REFERENCES `claims` (`id`);

--
-- Constraints for table `deb_doc`
--
ALTER TABLE `deb_doc`
  ADD CONSTRAINT `deb_doc_claim_id_foreign` FOREIGN KEY (`claim_id`) REFERENCES `claims` (`id`);

--
-- Constraints for table `deb_refuse_reason`
--
ALTER TABLE `deb_refuse_reason`
  ADD CONSTRAINT `deb_refuse_reason_claim_id_foreign` FOREIGN KEY (`claim_id`) REFERENCES `claims` (`id`),
  ADD CONSTRAINT `deb_refuse_reason_debtorresponses_id_foreign` FOREIGN KEY (`debtorresponses_id`) REFERENCES `debtorresponses` (`id`);

--
-- Constraints for table `delay_error`
--
ALTER TABLE `delay_error`
  ADD CONSTRAINT `delay_error_claim_id_foreign` FOREIGN KEY (`claim_id`) REFERENCES `claims` (`id`);

--
-- Constraints for table `finance_cases`
--
ALTER TABLE `finance_cases`
  ADD CONSTRAINT `finance_cases_claim_id_foreign` FOREIGN KEY (`claim_id`) REFERENCES `claims` (`id`);

--
-- Constraints for table `ic_doc`
--
ALTER TABLE `ic_doc`
  ADD CONSTRAINT `ic_doc_claim_id_foreign` FOREIGN KEY (`claim_id`) REFERENCES `claims` (`id`);

--
-- Constraints for table `law_firm_cases`
--
ALTER TABLE `law_firm_cases`
  ADD CONSTRAINT `law_firm_cases_claim_id_foreign` FOREIGN KEY (`claim_id`) REFERENCES `claims` (`id`);

--
-- Constraints for table `legal_department_model`
--
ALTER TABLE `legal_department_model`
  ADD CONSTRAINT `legal_department_model_claim_id_foreign` FOREIGN KEY (`claim_id`) REFERENCES `claims` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `officer_targets`
--
ALTER TABLE `officer_targets`
  ADD CONSTRAINT `officer_targets_officer_id_foreign` FOREIGN KEY (`officer_id`) REFERENCES `users` (`id`);

--
-- Constraints for table `partial_manual`
--
ALTER TABLE `partial_manual`
  ADD CONSTRAINT `partial_manual_claim_id_foreign` FOREIGN KEY (`claim_id`) REFERENCES `claims` (`id`),
  ADD CONSTRAINT `partial_manual_partial_id_foreign` FOREIGN KEY (`partial_id`) REFERENCES `partial_pay` (`id`);

--
-- Constraints for table `partial_pay`
--
ALTER TABLE `partial_pay`
  ADD CONSTRAINT `partial_pay_claim_id_foreign` FOREIGN KEY (`claim_id`) REFERENCES `claims` (`id`);

--
-- Constraints for table `payment_links`
--
ALTER TABLE `payment_links`
  ADD CONSTRAINT `payment_links_claim_id_foreign` FOREIGN KEY (`claim_id`) REFERENCES `claims` (`id`);

--
-- Constraints for table `pay_delay`
--
ALTER TABLE `pay_delay`
  ADD CONSTRAINT `pay_delay_claim_id_foreign` FOREIGN KEY (`claim_id`) REFERENCES `claims` (`id`);

--
-- Constraints for table `permission_role`
--
ALTER TABLE `permission_role`
  ADD CONSTRAINT `permission_role_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `permission_role_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `permission_user`
--
ALTER TABLE `permission_user`
  ADD CONSTRAINT `permission_user_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `role_user`
--
ALTER TABLE `role_user`
  ADD CONSTRAINT `role_user_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `sadad_pay`
--
ALTER TABLE `sadad_pay`
  ADD CONSTRAINT `sadad_pay_claim_id_foreign` FOREIGN KEY (`claim_id`) REFERENCES `claims` (`id`);

--
-- Constraints for table `status_history`
--
ALTER TABLE `status_history`
  ADD CONSTRAINT `status_history_claim_id_foreign` FOREIGN KEY (`claim_id`) REFERENCES `claims` (`id`);

--
-- Constraints for table `tranfer_morror`
--
ALTER TABLE `tranfer_morror`
  ADD CONSTRAINT `tranfer_morror_claim_id_foreign` FOREIGN KEY (`claim_id`) REFERENCES `claims` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
