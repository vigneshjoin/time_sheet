-- --------------------------------------------------------
-- Host:                         127.0.0.1
-- Server version:               8.0.30 - MySQL Community Server - GPL
-- Server OS:                    Win64
-- HeidiSQL Version:             12.1.0.6537
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;


-- Dumping database structure for stage
CREATE DATABASE IF NOT EXISTS `stage` /*!40100 DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci */ /*!80016 DEFAULT ENCRYPTION='N' */;
USE `stage`;

-- Dumping structure for table stage.accounts
CREATE TABLE IF NOT EXISTS `accounts` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `classification` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL COMMENT 'Classification of the account',
  `account_no` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL COMMENT 'Account number',
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL COMMENT 'Name of the account',
  `name_in_farsi` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL COMMENT 'Name of the account in Farsi',
  `full_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL COMMENT 'Full name of the account',
  `cb_group` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL COMMENT 'CB Group',
  `dr_posting_ac` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL COMMENT 'Debit posting account',
  `cr_posting_ac` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL COMMENT 'Credit posting account',
  `iwt_entry` tinyint(1) NOT NULL DEFAULT '0' COMMENT 'Enable or disable IWT entry',
  `type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'active' COMMENT 'Type of the account: active or inactive',
  `status` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'active' COMMENT 'Status of the account: active or inactive',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `accounts_account_no_index` (`account_no`),
  KEY `accounts_name_index` (`name`),
  KEY `accounts_type_index` (`type`),
  KEY `accounts_status_index` (`status`)
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table stage.accounts: ~15 rows (approximately)
INSERT INTO `accounts` (`id`, `classification`, `account_no`, `name`, `name_in_farsi`, `full_name`, `cb_group`, `dr_posting_ac`, `cr_posting_ac`, `iwt_entry`, `type`, `status`, `created_at`, `updated_at`) VALUES
	(1, 'Customer', '1001', 'Cash', 'نقد', 'Cash Account', 'Group1', '1001-DR', '1001-CR', 0, 'active', 'active', '2025-02-11 22:52:18', '2025-02-11 22:52:18'),
	(2, 'Customer', '2001', 'Accounts Payable', 'حسابهای پرداختنی', 'Accounts Payable Account', 'Group2', '2001-DR', '2001-CR', 0, 'active', 'active', '2025-02-11 22:52:18', '2025-02-11 22:52:18'),
	(3, 'Customer', '1002', 'Bank', 'بانک', 'Bank Account', 'Group1', '1002-DR', '1002-CR', 0, 'active', 'active', '2025-02-11 22:52:18', '2025-02-11 22:52:18'),
	(4, 'Customer', '2002', 'Loans Payable', 'وامهای پرداختنی', 'Loans Payable Account', 'Group2', '2002-DR', '2002-CR', 0, 'active', 'active', '2025-02-11 22:52:18', '2025-02-11 22:52:18'),
	(5, 'Customer', '1003', 'Receivables', 'حسابهای دریافتنی', 'Receivables Account', 'Group1', '1003-DR', '1003-CR', 0, 'active', 'active', '2025-02-11 22:52:18', '2025-02-11 22:52:18'),
	(6, 'Customer', '2003', 'Accrued Expenses', 'هزینه های معوقه', 'Accrued Expenses Account', 'Group2', '2003-DR', '2003-CR', 0, 'active', 'active', '2025-02-11 22:52:18', '2025-02-11 22:52:18'),
	(7, 'Customer', '1004', 'Inventory', 'موجودی', 'Inventory Account', 'Group1', '1004-DR', '1004-CR', 0, 'active', 'active', '2025-02-11 22:52:18', '2025-02-11 22:52:18'),
	(8, 'Customer', '2004', 'Deferred Revenue', 'درآمد معوقه', 'Deferred Revenue Account', 'Group2', '2004-DR', '2004-CR', 0, 'active', 'active', '2025-02-11 22:52:18', '2025-02-11 22:52:18'),
	(9, 'Customer', '1005', 'Prepaid Expenses', 'هزینه های پیش پرداخت', 'Prepaid Expenses Account', 'Group1', '1005-DR', '1005-CR', 0, 'active', 'active', '2025-02-11 22:52:18', '2025-02-11 22:52:18'),
	(10, 'Customer', '2005', 'Unearned Revenue', 'درآمدهای کسب نشده', 'Unearned Revenue Account', 'Group2', '2005-DR', '2005-CR', 0, 'active', 'active', '2025-02-11 22:52:18', '2025-02-11 22:52:18'),
	(11, 'Customer', '1006', 'Fixed Assets', 'دارایی های ثابت', 'Fixed Assets Account', 'Group1', '1006-DR', '1006-CR', 0, 'active', 'active', '2025-02-11 22:52:18', '2025-02-11 22:52:18'),
	(12, 'Customer', '2006', 'Accrued Liabilities', 'بدهی های معوقه', 'Accrued Liabilities Account', 'Group2', '2006-DR', '2006-CR', 0, 'active', 'active', '2025-02-11 22:52:18', '2025-02-11 22:52:18'),
	(13, 'Customer', '1007', 'Investments', 'سرمایه گذاری ها', 'Investments Account', 'Group1', '1007-DR', '1007-CR', 0, 'active', 'active', '2025-02-11 22:52:18', '2025-02-11 22:52:18'),
	(14, 'Customer', '2007', 'Notes Payable', 'یادداشت های پرداختنی', 'Notes Payable Account', 'Group2', '2007-DR', '2007-CR', 0, 'active', 'active', '2025-02-11 22:52:18', '2025-02-11 22:52:18'),
	(15, 'Customer', '1008', 'Intangible Assets', 'دارایی های نامشهود', 'Intangible Assets Account', 'Group1', '1008-DR', '1008-CR', 0, 'active', 'active', '2025-02-11 22:52:18', '2025-02-11 22:52:18');

-- Dumping structure for table stage.contact
CREATE TABLE IF NOT EXISTS `contact` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `company_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `address` text COLLATE utf8mb4_unicode_ci,
  `tel_1` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `tel_2` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `fax` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `mobile` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `contact_no` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `designation` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `nationality` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `entity` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `vat_trn` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `vat_exempted` tinyint(1) NOT NULL DEFAULT '0',
  `active` tinyint(1) NOT NULL DEFAULT '1',
  `id_type` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `id_no` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `issue_date` date DEFAULT NULL,
  `issue_expiry` date DEFAULT NULL,
  `issue_place` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `pdf_pwd` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `ac_remark` text COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=51 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table stage.contact: ~50 rows (approximately)
INSERT INTO `contact` (`id`, `company_name`, `address`, `tel_1`, `tel_2`, `fax`, `mobile`, `email`, `contact_no`, `designation`, `nationality`, `entity`, `vat_trn`, `vat_exempted`, `active`, `id_type`, `id_no`, `issue_date`, `issue_expiry`, `issue_place`, `pdf_pwd`, `ac_remark`, `created_at`, `updated_at`) VALUES
	(1, 'Business 1', 'Location 1', '1112223331', '4445556661', '7778889991', '0001112221', 'contact1@domain.com', 'Contact 1', 'Role 1', 'Country 1', 'Organization 1', 'VAT1', 0, 1, 'Document Type 1', 'DOC1', '2025-02-12', '2026-02-12', 'City 1', 'secure1', 'Note 1', '2025-02-11 22:52:18', '2025-02-11 22:52:18'),
	(2, 'Business 2', 'Location 2', '1112223332', '4445556662', '7778889992', '0001112222', 'contact2@domain.com', 'Contact 2', 'Role 2', 'Country 2', 'Organization 2', 'VAT2', 0, 1, 'Document Type 2', 'DOC2', '2025-02-12', '2026-02-12', 'City 2', 'secure2', 'Note 2', '2025-02-11 22:52:18', '2025-02-11 22:52:18'),
	(3, 'Business 3', 'Location 3', '1112223333', '4445556663', '7778889993', '0001112223', 'contact3@domain.com', 'Contact 3', 'Role 3', 'Country 3', 'Organization 3', 'VAT3', 0, 1, 'Document Type 3', 'DOC3', '2025-02-12', '2026-02-12', 'City 3', 'secure3', 'Note 3', '2025-02-11 22:52:18', '2025-02-11 22:52:18'),
	(4, 'Business 4', 'Location 4', '1112223334', '4445556664', '7778889994', '0001112224', 'contact4@domain.com', 'Contact 4', 'Role 4', 'Country 4', 'Organization 4', 'VAT4', 0, 1, 'Document Type 4', 'DOC4', '2025-02-12', '2026-02-12', 'City 4', 'secure4', 'Note 4', '2025-02-11 22:52:18', '2025-02-11 22:52:18'),
	(5, 'Business 5', 'Location 5', '1112223335', '4445556665', '7778889995', '0001112225', 'contact5@domain.com', 'Contact 5', 'Role 5', 'Country 5', 'Organization 5', 'VAT5', 0, 1, 'Document Type 5', 'DOC5', '2025-02-12', '2026-02-12', 'City 5', 'secure5', 'Note 5', '2025-02-11 22:52:18', '2025-02-11 22:52:18'),
	(6, 'Business 6', 'Location 6', '1112223336', '4445556666', '7778889996', '0001112226', 'contact6@domain.com', 'Contact 6', 'Role 6', 'Country 6', 'Organization 6', 'VAT6', 0, 1, 'Document Type 6', 'DOC6', '2025-02-12', '2026-02-12', 'City 6', 'secure6', 'Note 6', '2025-02-11 22:52:18', '2025-02-11 22:52:18'),
	(7, 'Business 7', 'Location 7', '1112223337', '4445556667', '7778889997', '0001112227', 'contact7@domain.com', 'Contact 7', 'Role 7', 'Country 7', 'Organization 7', 'VAT7', 0, 1, 'Document Type 7', 'DOC7', '2025-02-12', '2026-02-12', 'City 7', 'secure7', 'Note 7', '2025-02-11 22:52:18', '2025-02-11 22:52:18'),
	(10, 'Business 10', 'Location 10', '11122233310', '44455566610', '77788899910', '00011122210', 'contact10@domain.com', 'Contact 10', 'Role 10', 'Country 10', 'Organization 10', 'VAT10', 0, 1, 'Document Type 10', 'DOC10', '2025-02-12', '2026-02-12', 'City 10', 'secure10', 'Note 10', '2025-02-11 22:52:18', '2025-02-11 22:52:18'),
	(11, 'Business 11', 'Location 11', '11122233311', '44455566611', '77788899911', '00011122211', 'contact11@domain.com', 'Contact 11', 'Role 11', 'Country 11', 'Organization 11', 'VAT11', 0, 1, 'Document Type 11', 'DOC11', '2025-02-12', '2026-02-12', 'City 11', 'secure11', 'Note 11', '2025-02-11 22:52:18', '2025-02-11 22:52:18'),
	(12, 'Business 12', 'Location 12', '11122233312', '44455566612', '77788899912', '00011122212', 'contact12@domain.com', 'Contact 12', 'Role 12', 'Country 12', 'Organization 12', 'VAT12', 0, 1, 'Document Type 12', 'DOC12', '2025-02-12', '2026-02-12', 'City 12', 'secure12', 'Note 12', '2025-02-11 22:52:18', '2025-02-11 22:52:18'),
	(13, 'Business 13', 'Location 13', '11122233313', '44455566613', '77788899913', '00011122213', 'contact13@domain.com', 'Contact 13', 'Role 13', 'Country 13', 'Organization 13', 'VAT13', 0, 1, 'Document Type 13', 'DOC13', '2025-02-12', '2026-02-12', 'City 13', 'secure13', 'Note 13', '2025-02-11 22:52:18', '2025-02-11 22:52:18'),
	(14, 'Business 14', 'Location 14', '11122233314', '44455566614', '77788899914', '00011122214', 'contact14@domain.com', 'Contact 14', 'Role 14', 'Country 14', 'Organization 14', 'VAT14', 0, 1, 'Document Type 14', 'DOC14', '2025-02-12', '2026-02-12', 'City 14', 'secure14', 'Note 14', '2025-02-11 22:52:18', '2025-02-11 22:52:18'),
	(15, 'Business 15', 'Location 15', '11122233315', '44455566615', '77788899915', '00011122215', 'contact15@domain.com', 'Contact 15', 'Role 15', 'Country 15', 'Organization 15', 'VAT15', 0, 1, 'Document Type 15', 'DOC15', '2025-02-12', '2026-02-12', 'City 15', 'secure15', 'Note 15', '2025-02-11 22:52:18', '2025-02-11 22:52:18'),
	(16, 'Business 16', 'Location 16', '11122233316', '44455566616', '77788899916', '00011122216', 'contact16@domain.com', 'Contact 16', 'Role 16', 'Country 16', 'Organization 16', 'VAT16', 0, 1, 'Document Type 16', 'DOC16', '2025-02-12', '2026-02-12', 'City 16', 'secure16', 'Note 16', '2025-02-11 22:52:18', '2025-02-11 22:52:18'),
	(17, 'Business 17', 'Location 17', '11122233317', '44455566617', '77788899917', '00011122217', 'contact17@domain.com', 'Contact 17', 'Role 17', 'Country 17', 'Organization 17', 'VAT17', 0, 1, 'Document Type 17', 'DOC17', '2025-02-12', '2026-02-12', 'City 17', 'secure17', 'Note 17', '2025-02-11 22:52:18', '2025-02-11 22:52:18'),
	(18, 'Business 18', 'Location 18', '11122233318', '44455566618', '77788899918', '00011122218', 'contact18@domain.com', 'Contact 18', 'Role 18', 'Country 18', 'Organization 18', 'VAT18', 0, 1, 'Document Type 18', 'DOC18', '2025-02-12', '2026-02-12', 'City 18', 'secure18', 'Note 18', '2025-02-11 22:52:18', '2025-02-11 22:52:18'),
	(19, 'Business 19', 'Location 19', '11122233319', '44455566619', '77788899919', '00011122219', 'contact19@domain.com', 'Contact 19', 'Role 19', 'Country 19', 'Organization 19', 'VAT19', 0, 1, 'Document Type 19', 'DOC19', '2025-02-12', '2026-02-12', 'City 19', 'secure19', 'Note 19', '2025-02-11 22:52:18', '2025-02-11 22:52:18'),
	(20, 'Business 20', 'Location 20', '11122233320', '44455566620', '77788899920', '00011122220', 'contact20@domain.com', 'Contact 20', 'Role 20', 'Country 20', 'Organization 20', 'VAT20', 0, 1, 'Document Type 20', 'DOC20', '2025-02-12', '2026-02-12', 'City 20', 'secure20', 'Note 20', '2025-02-11 22:52:18', '2025-02-11 22:52:18'),
	(21, 'Business 21', 'Location 21', '11122233321', '44455566621', '77788899921', '00011122221', 'contact21@domain.com', 'Contact 21', 'Role 21', 'Country 21', 'Organization 21', 'VAT21', 0, 1, 'Document Type 21', 'DOC21', '2025-02-12', '2026-02-12', 'City 21', 'secure21', 'Note 21', '2025-02-11 22:52:18', '2025-02-11 22:52:18'),
	(22, 'Business 22', 'Location 22', '11122233322', '44455566622', '77788899922', '00011122222', 'contact22@domain.com', 'Contact 22', 'Role 22', 'Country 22', 'Organization 22', 'VAT22', 0, 1, 'Document Type 22', 'DOC22', '2025-02-12', '2026-02-12', 'City 22', 'secure22', 'Note 22', '2025-02-11 22:52:18', '2025-02-11 22:52:18'),
	(23, 'Business 23', 'Location 23', '11122233323', '44455566623', '77788899923', '00011122223', 'contact23@domain.com', 'Contact 23', 'Role 23', 'Country 23', 'Organization 23', 'VAT23', 0, 1, 'Document Type 23', 'DOC23', '2025-02-12', '2026-02-12', 'City 23', 'secure23', 'Note 23', '2025-02-11 22:52:18', '2025-02-11 22:52:18'),
	(24, 'Business 24', 'Location 24', '11122233324', '44455566624', '77788899924', '00011122224', 'contact24@domain.com', 'Contact 24', 'Role 24', 'Country 24', 'Organization 24', 'VAT24', 0, 1, 'Document Type 24', 'DOC24', '2025-02-12', '2026-02-12', 'City 24', 'secure24', 'Note 24', '2025-02-11 22:52:18', '2025-02-11 22:52:18'),
	(25, 'Business 25', 'Location 25', '11122233325', '44455566625', '77788899925', '00011122225', 'contact25@domain.com', 'Contact 25', 'Role 25', 'Country 25', 'Organization 25', 'VAT25', 0, 1, 'Document Type 25', 'DOC25', '2025-02-12', '2026-02-12', 'City 25', 'secure25', 'Note 25', '2025-02-11 22:52:18', '2025-02-11 22:52:18'),
	(26, 'Business 26', 'Location 26', '11122233326', '44455566626', '77788899926', '00011122226', 'contact26@domain.com', 'Contact 26', 'Role 26', 'Country 26', 'Organization 26', 'VAT26', 0, 1, 'Document Type 26', 'DOC26', '2025-02-12', '2026-02-12', 'City 26', 'secure26', 'Note 26', '2025-02-11 22:52:18', '2025-02-11 22:52:18'),
	(27, 'Business 27', 'Location 27', '11122233327', '44455566627', '77788899927', '00011122227', 'contact27@domain.com', 'Contact 27', 'Role 27', 'Country 27', 'Organization 27', 'VAT27', 0, 1, 'Document Type 27', 'DOC27', '2025-02-12', '2026-02-12', 'City 27', 'secure27', 'Note 27', '2025-02-11 22:52:18', '2025-02-11 22:52:18'),
	(28, 'Business 28', 'Location 28', '11122233328', '44455566628', '77788899928', '00011122228', 'contact28@domain.com', 'Contact 28', 'Role 28', 'Country 28', 'Organization 28', 'VAT28', 0, 1, 'Document Type 28', 'DOC28', '2025-02-12', '2026-02-12', 'City 28', 'secure28', 'Note 28', '2025-02-11 22:52:18', '2025-02-11 22:52:18'),
	(29, 'Business 29', 'Location 29', '11122233329', '44455566629', '77788899929', '00011122229', 'contact29@domain.com', 'Contact 29', 'Role 29', 'Country 29', 'Organization 29', 'VAT29', 0, 1, 'Document Type 29', 'DOC29', '2025-02-12', '2026-02-12', 'City 29', 'secure29', 'Note 29', '2025-02-11 22:52:18', '2025-02-11 22:52:18'),
	(30, 'Business 30', 'Location 30', '11122233330', '44455566630', '77788899930', '00011122230', 'contact30@domain.com', 'Contact 30', 'Role 30', 'Country 30', 'Organization 30', 'VAT30', 0, 1, 'Document Type 30', 'DOC30', '2025-02-12', '2026-02-12', 'City 30', 'secure30', 'Note 30', '2025-02-11 22:52:18', '2025-02-11 22:52:18'),
	(31, 'Business 31', 'Location 31', '11122233331', '44455566631', '77788899931', '00011122231', 'contact31@domain.com', 'Contact 31', 'Role 31', 'Country 31', 'Organization 31', 'VAT31', 0, 1, 'Document Type 31', 'DOC31', '2025-02-12', '2026-02-12', 'City 31', 'secure31', 'Note 31', '2025-02-11 22:52:18', '2025-02-11 22:52:18'),
	(32, 'Business 32', 'Location 32', '11122233332', '44455566632', '77788899932', '00011122232', 'contact32@domain.com', 'Contact 32', 'Role 32', 'Country 32', 'Organization 32', 'VAT32', 0, 1, 'Document Type 32', 'DOC32', '2025-02-12', '2026-02-12', 'City 32', 'secure32', 'Note 32', '2025-02-11 22:52:18', '2025-02-11 22:52:18'),
	(33, 'Business 33', 'Location 33', '11122233333', '44455566633', '77788899933', '00011122233', 'contact33@domain.com', 'Contact 33', 'Role 33', 'Country 33', 'Organization 33', 'VAT33', 0, 1, 'Document Type 33', 'DOC33', '2025-02-12', '2026-02-12', 'City 33', 'secure33', 'Note 33', '2025-02-11 22:52:18', '2025-02-11 22:52:18'),
	(34, 'Business 34', 'Location 34', '11122233334', '44455566634', '77788899934', '00011122234', 'contact34@domain.com', 'Contact 34', 'Role 34', 'Country 34', 'Organization 34', 'VAT34', 0, 1, 'Document Type 34', 'DOC34', '2025-02-12', '2026-02-12', 'City 34', 'secure34', 'Note 34', '2025-02-11 22:52:18', '2025-02-11 22:52:18'),
	(35, 'Business 35', 'Location 35', '11122233335', '44455566635', '77788899935', '00011122235', 'contact35@domain.com', 'Contact 35', 'Role 35', 'Country 35', 'Organization 35', 'VAT35', 0, 1, 'Document Type 35', 'DOC35', '2025-02-12', '2026-02-12', 'City 35', 'secure35', 'Note 35', '2025-02-11 22:52:18', '2025-02-11 22:52:18'),
	(36, 'Business 36', 'Location 36', '11122233336', '44455566636', '77788899936', '00011122236', 'contact36@domain.com', 'Contact 36', 'Role 36', 'Country 36', 'Organization 36', 'VAT36', 0, 1, 'Document Type 36', 'DOC36', '2025-02-12', '2026-02-12', 'City 36', 'secure36', 'Note 36', '2025-02-11 22:52:18', '2025-02-11 22:52:18'),
	(37, 'Business 37', 'Location 37', '11122233337', '44455566637', '77788899937', '00011122237', 'contact37@domain.com', 'Contact 37', 'Role 37', 'Country 37', 'Organization 37', 'VAT37', 0, 1, 'Document Type 37', 'DOC37', '2025-02-12', '2026-02-12', 'City 37', 'secure37', 'Note 37', '2025-02-11 22:52:18', '2025-02-11 22:52:18'),
	(38, 'Business 38', 'Location 38', '11122233338', '44455566638', '77788899938', '00011122238', 'contact38@domain.com', 'Contact 38', 'Role 38', 'Country 38', 'Organization 38', 'VAT38', 0, 1, 'Document Type 38', 'DOC38', '2025-02-12', '2026-02-12', 'City 38', 'secure38', 'Note 38', '2025-02-11 22:52:18', '2025-02-11 22:52:18'),
	(39, 'Business 39', 'Location 39', '11122233339', '44455566639', '77788899939', '00011122239', 'contact39@domain.com', 'Contact 39', 'Role 39', 'Country 39', 'Organization 39', 'VAT39', 0, 1, 'Document Type 39', 'DOC39', '2025-02-12', '2026-02-12', 'City 39', 'secure39', 'Note 39', '2025-02-11 22:52:18', '2025-02-11 22:52:18'),
	(40, 'Business 40', 'Location 40', '11122233340', '44455566640', '77788899940', '00011122240', 'contact40@domain.com', 'Contact 40', 'Role 40', 'Country 40', 'Organization 40', 'VAT40', 0, 1, 'Document Type 40', 'DOC40', '2025-02-12', '2026-02-12', 'City 40', 'secure40', 'Note 40', '2025-02-11 22:52:18', '2025-02-11 22:52:18'),
	(41, 'Business 41', 'Location 41', '11122233341', '44455566641', '77788899941', '00011122241', 'contact41@domain.com', 'Contact 41', 'Role 41', 'Country 41', 'Organization 41', 'VAT41', 0, 1, 'Document Type 41', 'DOC41', '2025-02-12', '2026-02-12', 'City 41', 'secure41', 'Note 41', '2025-02-11 22:52:18', '2025-02-11 22:52:18'),
	(42, 'Business 42', 'Location 42', '11122233342', '44455566642', '77788899942', '00011122242', 'contact42@domain.com', 'Contact 42', 'Role 42', 'Country 42', 'Organization 42', 'VAT42', 0, 1, 'Document Type 42', 'DOC42', '2025-02-12', '2026-02-12', 'City 42', 'secure42', 'Note 42', '2025-02-11 22:52:18', '2025-02-11 22:52:18'),
	(43, 'Business 43', 'Location 43', '11122233343', '44455566643', '77788899943', '00011122243', 'contact43@domain.com', 'Contact 43', 'Role 43', 'Country 43', 'Organization 43', 'VAT43', 0, 1, 'Document Type 43', 'DOC43', '2025-02-12', '2026-02-12', 'City 43', 'secure43', 'Note 43', '2025-02-11 22:52:18', '2025-02-11 22:52:18'),
	(44, 'Business 44', 'Location 44', '11122233344', '44455566644', '77788899944', '00011122244', 'contact44@domain.com', 'Contact 44', 'Role 44', 'Country 44', 'Organization 44', 'VAT44', 0, 1, 'Document Type 44', 'DOC44', '2025-02-12', '2026-02-12', 'City 44', 'secure44', 'Note 44', '2025-02-11 22:52:18', '2025-02-11 22:52:18'),
	(45, 'Business 45', 'Location 45', '11122233345', '44455566645', '77788899945', '00011122245', 'contact45@domain.com', 'Contact 45', 'Role 45', 'Country 45', 'Organization 45', 'VAT45', 0, 1, 'Document Type 45', 'DOC45', '2025-02-12', '2026-02-12', 'City 45', 'secure45', 'Note 45', '2025-02-11 22:52:18', '2025-02-11 22:52:18'),
	(46, 'Business 46', 'Location 46', '11122233346', '44455566646', '77788899946', '00011122246', 'contact46@domain.com', 'Contact 46', 'Role 46', 'Country 46', 'Organization 46', 'VAT46', 0, 1, 'Document Type 46', 'DOC46', '2025-02-12', '2026-02-12', 'City 46', 'secure46', 'Note 46', '2025-02-11 22:52:18', '2025-02-11 22:52:18'),
	(47, 'Business 47', 'Location 47', '11122233347', '44455566647', '77788899947', '00011122247', 'contact47@domain.com', 'Contact 47', 'Role 47', 'Country 47', 'Organization 47', 'VAT47', 0, 1, 'Document Type 47', 'DOC47', '2025-02-12', '2026-02-12', 'City 47', 'secure47', 'Note 47', '2025-02-11 22:52:18', '2025-02-11 22:52:18'),
	(48, 'Business 48', 'Location 48', '11122233348', '44455566648', '77788899948', '00011122248', 'contact48@domain.com', 'Contact 48', 'Role 48', 'Country 48', 'Organization 48', 'VAT48', 0, 1, 'Document Type 48', 'DOC48', '2025-02-12', '2026-02-12', 'City 48', 'secure48', 'Note 48', '2025-02-11 22:52:18', '2025-02-11 22:52:18'),
	(49, 'Business 49', 'Location 49', '11122233349', '44455566649', '77788899949', '00011122249', 'contact49@domain.com', 'Contact 49', 'Role 49', 'Country 49', 'Organization 49', 'VAT49', 0, 1, 'Document Type 49', 'DOC49', '2025-02-12', '2026-02-12', 'City 49', 'secure49', 'Note 49', '2025-02-11 22:52:18', '2025-02-11 22:52:18'),
	(50, 'Business 50', 'Location 50', '11122233350', '44455566650', '77788899950', '00011122250', 'contact50@domain.com', 'Contact 50', 'Role 50', 'Country 50', 'Organization 50', 'VAT50', 0, 1, 'Document Type 50', 'DOC50', '2025-02-12', '2026-02-12', 'City 50', 'secure50', 'Note 50', '2025-02-11 22:52:18', '2025-02-11 22:52:18');

-- Dumping structure for table stage.currencies
CREATE TABLE IF NOT EXISTS `currencies` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT COMMENT 'Primary Key: Unique ID for each currency',
  `code` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL COMMENT 'Currency code, e.g., AFA, ALL, AMD etc.',
  `currency_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL COMMENT 'Currency name',
  `rate_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL COMMENT 'Rate type',
  `variation` decimal(10,4) NOT NULL COMMENT 'Variation',
  `fc_code` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL COMMENT 'Foreign currency code',
  `fc_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL COMMENT 'Foreign currency name',
  `code_farsi` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL COMMENT 'Code in Farsi',
  `code_farsi_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL COMMENT 'Code name in Farsi',
  `rate_type_options` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT 'default_value' COMMENT 'Rate type options, e.g., Multiple, Divide',
  `variation_value` decimal(10,2) NOT NULL DEFAULT '0.00' COMMENT 'Variation',
  `group_fcy` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL COMMENT 'Group FCY',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=26 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table stage.currencies: ~25 rows (approximately)
INSERT INTO `currencies` (`id`, `code`, `currency_name`, `rate_type`, `variation`, `fc_code`, `fc_name`, `code_farsi`, `code_farsi_name`, `rate_type_options`, `variation_value`, `group_fcy`, `created_at`, `updated_at`) VALUES
	(1, 'USD', 'United States Dollar', 'Multiple', 1.0000, 'USD', 'US Dollar', 'دلار آمریکا', 'دلار', 'Multiple', 0.00, 'Group1', '2025-02-11 22:52:17', '2025-02-11 22:52:17'),
	(2, 'EUR', 'Euro', 'Divide', 0.8500, 'EUR', 'Euro', 'یورو', 'یورو', 'Divide', 0.00, 'Group2', '2025-02-11 22:52:17', '2025-02-11 22:52:17'),
	(3, 'GBP', 'British Pound', 'Multiple', 0.7500, 'GBP', 'British Pound', 'پوند بریتانیا', 'پوند', 'Multiple', 0.00, 'Group3', '2025-02-11 22:52:17', '2025-02-11 22:52:17'),
	(4, 'JPY', 'Japanese Yen', 'Multiple', 110.0000, 'JPY', 'Japanese Yen', 'ین ژاپن', 'ین', 'Multiple', 0.00, 'Group4', '2025-02-11 22:52:17', '2025-02-11 22:52:17'),
	(5, 'AUD', 'Australian Dollar', 'Multiple', 1.3000, 'AUD', 'Australian Dollar', 'دلار استرالیا', 'دلار', 'Multiple', 0.00, 'Group5', '2025-02-11 22:52:17', '2025-02-11 22:52:17'),
	(6, 'CAD', 'Canadian Dollar', 'Multiple', 1.2500, 'CAD', 'Canadian Dollar', 'دلار کانادا', 'دلار', 'Multiple', 0.00, 'Group6', '2025-02-11 22:52:17', '2025-02-11 22:52:17'),
	(7, 'CHF', 'Swiss Franc', 'Multiple', 0.9200, 'CHF', 'Swiss Franc', 'فرانک سوئیس', 'فرانک', 'Multiple', 0.00, 'Group7', '2025-02-11 22:52:17', '2025-02-11 22:52:17'),
	(8, 'CNY', 'Chinese Yuan', 'Multiple', 6.4500, 'CNY', 'Chinese Yuan', 'یوان چین', 'یوان', 'Multiple', 0.00, 'Group8', '2025-02-11 22:52:17', '2025-02-11 22:52:17'),
	(9, 'SEK', 'Swedish Krona', 'Multiple', 8.6000, 'SEK', 'Swedish Krona', 'کرون سوئد', 'کرون', 'Multiple', 0.00, 'Group9', '2025-02-11 22:52:17', '2025-02-11 22:52:17'),
	(10, 'NZD', 'New Zealand Dollar', 'Multiple', 1.4000, 'NZD', 'New Zealand Dollar', 'دلار نیوزیلند', 'دلار', 'Multiple', 0.00, 'Group10', '2025-02-11 22:52:17', '2025-02-11 22:52:17'),
	(11, 'MXN', 'Mexican Peso', 'Multiple', 20.0000, 'MXN', 'Mexican Peso', 'پزو مکزیک', 'پزو', 'Multiple', 0.00, 'Group11', '2025-02-11 22:52:17', '2025-02-11 22:52:17'),
	(12, 'SGD', 'Singapore Dollar', 'Multiple', 1.3500, 'SGD', 'Singapore Dollar', 'دلار سنگاپور', 'دلار', 'Multiple', 0.00, 'Group12', '2025-02-11 22:52:17', '2025-02-11 22:52:17'),
	(13, 'HKD', 'Hong Kong Dollar', 'Multiple', 7.7500, 'HKD', 'Hong Kong Dollar', 'دلار هنگ کنگ', 'دلار', 'Multiple', 0.00, 'Group13', '2025-02-11 22:52:17', '2025-02-11 22:52:17'),
	(14, 'NOK', 'Norwegian Krone', 'Multiple', 8.9000, 'NOK', 'Norwegian Krone', 'کرون نروژ', 'کرون', 'Multiple', 0.00, 'Group14', '2025-02-11 22:52:17', '2025-02-11 22:52:17'),
	(15, 'KRW', 'South Korean Won', 'Multiple', 1150.0000, 'KRW', 'South Korean Won', 'وون کره جنوبی', 'وون', 'Multiple', 0.00, 'Group15', '2025-02-11 22:52:17', '2025-02-11 22:52:17'),
	(16, 'TRY', 'Turkish Lira', 'Multiple', 8.5000, 'TRY', 'Turkish Lira', 'لیر ترکیه', 'لیر', 'Multiple', 0.00, 'Group16', '2025-02-11 22:52:17', '2025-02-11 22:52:17'),
	(17, 'INR', 'Indian Rupee', 'Multiple', 74.0000, 'INR', 'Indian Rupee', 'روپیه هند', 'روپیه', 'Multiple', 0.00, 'Group17', '2025-02-11 22:52:17', '2025-02-11 22:52:17'),
	(18, 'RUB', 'Russian Ruble', 'Multiple', 74.0000, 'RUB', 'Russian Ruble', 'روبل روسیه', 'روبل', 'Multiple', 0.00, 'Group18', '2025-02-11 22:52:17', '2025-02-11 22:52:17'),
	(19, 'BRL', 'Brazilian Real', 'Multiple', 5.2000, 'BRL', 'Brazilian Real', 'رئال برزیل', 'رئال', 'Multiple', 0.00, 'Group19', '2025-02-11 22:52:17', '2025-02-11 22:52:17'),
	(20, 'ZAR', 'South African Rand', 'Multiple', 14.5000, 'ZAR', 'South African Rand', 'راند آفریقای جنوبی', 'راند', 'Multiple', 0.00, 'Group20', '2025-02-11 22:52:17', '2025-02-11 22:52:17'),
	(21, 'PLN', 'Polish Zloty', 'Multiple', 3.8000, 'PLN', 'Polish Zloty', 'زلوتی لهستان', 'زلوتی', 'Multiple', 0.00, 'Group21', '2025-02-11 22:52:17', '2025-02-11 22:52:17'),
	(22, 'DKK', 'Danish Krone', 'Multiple', 6.3000, 'DKK', 'Danish Krone', 'کرون دانمارک', 'کرون', 'Multiple', 0.00, 'Group22', '2025-02-11 22:52:17', '2025-02-11 22:52:17'),
	(23, 'MYR', 'Malaysian Ringgit', 'Multiple', 4.2000, 'MYR', 'Malaysian Ringgit', 'رینگیت مالزی', 'رینگیت', 'Multiple', 0.00, 'Group23', '2025-02-11 22:52:17', '2025-02-11 22:52:17'),
	(24, 'THB', 'Thai Baht', 'Multiple', 33.0000, 'THB', 'Thai Baht', 'بات تایلند', 'بات', 'Multiple', 0.00, 'Group24', '2025-02-11 22:52:17', '2025-02-11 22:52:17'),
	(25, 'IDR', 'Indonesian Rupiah', 'Multiple', 14200.0000, 'IDR', 'Indonesian Rupiah', 'روپیه اندونزی', 'روپیه', 'Multiple', 0.00, 'Group25', '2025-02-11 22:52:17', '2025-02-11 22:52:17');

-- Dumping structure for table stage.failed_jobs
CREATE TABLE IF NOT EXISTS `failed_jobs` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `uuid` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table stage.failed_jobs: ~0 rows (approximately)

-- Dumping structure for table stage.general_ledgers
CREATE TABLE IF NOT EXISTS `general_ledgers` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `parent_id` bigint unsigned DEFAULT NULL,
  `account_code` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `category` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `classification` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `account` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `sub_class` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `persian_title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `full_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `cb_group` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `defaultfcy` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `comment` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` enum('active','inactive') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'active',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table stage.general_ledgers: ~5 rows (approximately)

-- Dumping structure for table stage.migrations
CREATE TABLE IF NOT EXISTS `migrations` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table stage.migrations: ~0 rows (approximately)
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
	(1, '2014_10_12_000000_create_users_table', 1),
	(2, '2014_10_12_100000_create_password_reset_tokens_table', 1),
	(3, '2019_08_19_000000_create_failed_jobs_table', 1),
	(4, '2019_12_14_000001_create_personal_access_tokens_table', 1),
	(5, '2025_01_16_174607_create_general_ledgers_table', 1),
	(6, '2025_02_05_155224_create_walk_in_customer_master_table', 1),
	(7, '2025_02_06_175045_create_currencies_table', 1),
	(8, '2025_02_10_172511_create_account_table', 1),
	(9, '2025_02_10_172522_create_contact_table', 1);

-- Dumping structure for table stage.password_reset_tokens
CREATE TABLE IF NOT EXISTS `password_reset_tokens` (
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table stage.password_reset_tokens: ~0 rows (approximately)

-- Dumping structure for table stage.personal_access_tokens
CREATE TABLE IF NOT EXISTS `personal_access_tokens` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `tokenable_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tokenable_id` bigint unsigned NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(64) COLLATE utf8mb4_unicode_ci NOT NULL,
  `abilities` text COLLATE utf8mb4_unicode_ci,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `expires_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table stage.personal_access_tokens: ~0 rows (approximately)

-- Dumping structure for table stage.users
CREATE TABLE IF NOT EXISTS `users` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `avatar` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'default/avatar.png',
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_type` enum('super_admin','admin') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'admin',
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_email_unique` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table stage.users: ~4 rows (approximately)
INSERT INTO `users` (`id`, `name`, `avatar`, `email`, `email_verified_at`, `password`, `user_type`, `remember_token`, `created_at`, `updated_at`) VALUES
	(1, 'Super Admin', 'default/avatar.png', 'admin@gmail.com', NULL, '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'super_admin', NULL, NULL, NULL),
	(2, 'John Doe', 'default/avatar.png', 'john.doe@example.com', NULL, '$2y$12$wg36OC7kYegG1EeQV0sBc.bGX/A.OPU2oOY/Vm2bGZD4OONEI4j6m', 'super_admin', NULL, NULL, NULL),
	(3, 'Jane Smith', 'default/avatar.png', 'jane.smith@example.com', NULL, '$2y$12$494YcqLZ1EVGEluvhbLF9eSyf//ULlmGCydS2Lnn/MKCxy0nqj5Im', 'super_admin', NULL, NULL, NULL),
	(4, 'Alice Johnson', 'default/avatar.png', 'alice.johnson@example.com', NULL, '$2y$12$IwZyjoM8/UDm4WeX31oJpesEl9CPM7wMc4SuH/JZn8fhtVKt.eXsq', 'super_admin', NULL, NULL, NULL);

-- Dumping structure for table stage.walk_in_customer_master
CREATE TABLE IF NOT EXISTS `walk_in_customer_master` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT COMMENT 'Primary Key: Unique ID for each walk-in customer',
  `customer_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL COMMENT 'Customer Name',
  `employer` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL COMMENT 'Employer Name',
  `mobile` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL COMMENT 'Customer Phone Number',
  `tel` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT 'Customer Tel Number',
  `personal_no` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL COMMENT 'Personal Number',
  `id_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL COMMENT 'Id Type',
  `id_no` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL COMMENT 'Id Number',
  `id_validity` date NOT NULL COMMENT 'ID Validity Date',
  `country` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL COMMENT 'Country U.A.E',
  `state` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT 'State',
  `account` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL COMMENT 'Account number',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `walk_in_customer_master_mobile_unique` (`mobile`),
  UNIQUE KEY `walk_in_customer_master_personal_no_unique` (`personal_no`),
  UNIQUE KEY `walk_in_customer_master_id_no_unique` (`id_no`),
  UNIQUE KEY `walk_in_customer_master_account_unique` (`account`),
  KEY `walk_in_customer_master_customer_name_index` (`customer_name`),
  KEY `walk_in_customer_master_employer_index` (`employer`)
) ENGINE=InnoDB AUTO_INCREMENT=51 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table stage.walk_in_customer_master: ~50 rows (approximately)
INSERT INTO `walk_in_customer_master` (`id`, `customer_name`, `employer`, `mobile`, `tel`, `personal_no`, `id_type`, `id_no`, `id_validity`, `country`, `state`, `account`, `created_at`, `updated_at`) VALUES
	(1, 'Customer 0', 'Employer 0', '0500000000', '040000000', 'PN0000000', 'Passport', 'ID0000000', '2030-02-12', 'U.A.E', 'State 0', 'AC0000000', '2025-02-11 22:52:18', '2025-02-11 22:52:18'),
	(2, 'Customer 1', 'Employer 1', '0500000001', '040000001', 'PN0000001', 'Passport', 'ID0000001', '2030-02-12', 'U.A.E', 'State 1', 'AC0000001', '2025-02-11 22:52:18', '2025-02-11 22:52:18'),
	(3, 'Customer 2', 'Employer 2', '0500000002', '040000002', 'PN0000002', 'Passport', 'ID0000002', '2030-02-12', 'U.A.E', 'State 2', 'AC0000002', '2025-02-11 22:52:18', '2025-02-11 22:52:18'),
	(4, 'Customer 3', 'Employer 3', '0500000003', '040000003', 'PN0000003', 'Passport', 'ID0000003', '2030-02-12', 'U.A.E', 'State 3', 'AC0000003', '2025-02-11 22:52:18', '2025-02-11 22:52:18'),
	(5, 'Customer 4', 'Employer 4', '0500000004', '040000004', 'PN0000004', 'Passport', 'ID0000004', '2030-02-12', 'U.A.E', 'State 4', 'AC0000004', '2025-02-11 22:52:18', '2025-02-11 22:52:18'),
	(6, 'Customer 5', 'Employer 5', '0500000005', '040000005', 'PN0000005', 'Passport', 'ID0000005', '2030-02-12', 'U.A.E', 'State 5', 'AC0000005', '2025-02-11 22:52:18', '2025-02-11 22:52:18'),
	(7, 'Customer 6', 'Employer 6', '0500000006', '040000006', 'PN0000006', 'Passport', 'ID0000006', '2030-02-12', 'U.A.E', 'State 6', 'AC0000006', '2025-02-11 22:52:18', '2025-02-11 22:52:18'),
	(8, 'Customer 7', 'Employer 7', '0500000007', '040000007', 'PN0000007', 'Passport', 'ID0000007', '2030-02-12', 'U.A.E', 'State 7', 'AC0000007', '2025-02-11 22:52:18', '2025-02-11 22:52:18'),
	(9, 'Customer 8', 'Employer 8', '0500000008', '040000008', 'PN0000008', 'Passport', 'ID0000008', '2030-02-12', 'U.A.E', 'State 8', 'AC0000008', '2025-02-11 22:52:18', '2025-02-11 22:52:18'),
	(10, 'Customer 9', 'Employer 9', '0500000009', '040000009', 'PN0000009', 'Passport', 'ID0000009', '2030-02-12', 'U.A.E', 'State 9', 'AC0000009', '2025-02-11 22:52:18', '2025-02-11 22:52:18'),
	(11, 'Customer 10', 'Employer 10', '0500000010', '040000010', 'PN0000010', 'Passport', 'ID0000010', '2030-02-12', 'U.A.E', 'State 10', 'AC0000010', '2025-02-11 22:52:18', '2025-02-11 22:52:18'),
	(12, 'Customer 11', 'Employer 11', '0500000011', '040000011', 'PN0000011', 'Passport', 'ID0000011', '2030-02-12', 'U.A.E', 'State 11', 'AC0000011', '2025-02-11 22:52:18', '2025-02-11 22:52:18'),
	(13, 'Customer 12', 'Employer 12', '0500000012', '040000012', 'PN0000012', 'Passport', 'ID0000012', '2030-02-12', 'U.A.E', 'State 12', 'AC0000012', '2025-02-11 22:52:18', '2025-02-11 22:52:18'),
	(14, 'Customer 13', 'Employer 13', '0500000013', '040000013', 'PN0000013', 'Passport', 'ID0000013', '2030-02-12', 'U.A.E', 'State 13', 'AC0000013', '2025-02-11 22:52:18', '2025-02-11 22:52:18'),
	(15, 'Customer 14', 'Employer 14', '0500000014', '040000014', 'PN0000014', 'Passport', 'ID0000014', '2030-02-12', 'U.A.E', 'State 14', 'AC0000014', '2025-02-11 22:52:18', '2025-02-11 22:52:18'),
	(16, 'Customer 15', 'Employer 15', '0500000015', '040000015', 'PN0000015', 'Passport', 'ID0000015', '2030-02-12', 'U.A.E', 'State 15', 'AC0000015', '2025-02-11 22:52:18', '2025-02-11 22:52:18'),
	(17, 'Customer 16', 'Employer 16', '0500000016', '040000016', 'PN0000016', 'Passport', 'ID0000016', '2030-02-12', 'U.A.E', 'State 16', 'AC0000016', '2025-02-11 22:52:18', '2025-02-11 22:52:18'),
	(18, 'Customer 17', 'Employer 17', '0500000017', '040000017', 'PN0000017', 'Passport', 'ID0000017', '2030-02-12', 'U.A.E', 'State 17', 'AC0000017', '2025-02-11 22:52:18', '2025-02-11 22:52:18'),
	(19, 'Customer 18', 'Employer 18', '0500000018', '040000018', 'PN0000018', 'Passport', 'ID0000018', '2030-02-12', 'U.A.E', 'State 18', 'AC0000018', '2025-02-11 22:52:18', '2025-02-11 22:52:18'),
	(20, 'Customer 19', 'Employer 19', '0500000019', '040000019', 'PN0000019', 'Passport', 'ID0000019', '2030-02-12', 'U.A.E', 'State 19', 'AC0000019', '2025-02-11 22:52:18', '2025-02-11 22:52:18'),
	(21, 'Customer 20', 'Employer 20', '0500000020', '040000020', 'PN0000020', 'Passport', 'ID0000020', '2030-02-12', 'U.A.E', 'State 20', 'AC0000020', '2025-02-11 22:52:18', '2025-02-11 22:52:18'),
	(22, 'Customer 21', 'Employer 21', '0500000021', '040000021', 'PN0000021', 'Passport', 'ID0000021', '2030-02-12', 'U.A.E', 'State 21', 'AC0000021', '2025-02-11 22:52:18', '2025-02-11 22:52:18'),
	(23, 'Customer 22', 'Employer 22', '0500000022', '040000022', 'PN0000022', 'Passport', 'ID0000022', '2030-02-12', 'U.A.E', 'State 22', 'AC0000022', '2025-02-11 22:52:18', '2025-02-11 22:52:18'),
	(24, 'Customer 23', 'Employer 23', '0500000023', '040000023', 'PN0000023', 'Passport', 'ID0000023', '2030-02-12', 'U.A.E', 'State 23', 'AC0000023', '2025-02-11 22:52:18', '2025-02-11 22:52:18'),
	(25, 'Customer 24', 'Employer 24', '0500000024', '040000024', 'PN0000024', 'Passport', 'ID0000024', '2030-02-12', 'U.A.E', 'State 24', 'AC0000024', '2025-02-11 22:52:18', '2025-02-11 22:52:18'),
	(26, 'Customer 25', 'Employer 25', '0500000025', '040000025', 'PN0000025', 'Passport', 'ID0000025', '2030-02-12', 'U.A.E', 'State 25', 'AC0000025', '2025-02-11 22:52:18', '2025-02-11 22:52:18'),
	(27, 'Customer 26', 'Employer 26', '0500000026', '040000026', 'PN0000026', 'Passport', 'ID0000026', '2030-02-12', 'U.A.E', 'State 26', 'AC0000026', '2025-02-11 22:52:18', '2025-02-11 22:52:18'),
	(28, 'Customer 27', 'Employer 27', '0500000027', '040000027', 'PN0000027', 'Passport', 'ID0000027', '2030-02-12', 'U.A.E', 'State 27', 'AC0000027', '2025-02-11 22:52:18', '2025-02-11 22:52:18'),
	(29, 'Customer 28', 'Employer 28', '0500000028', '040000028', 'PN0000028', 'Passport', 'ID0000028', '2030-02-12', 'U.A.E', 'State 28', 'AC0000028', '2025-02-11 22:52:18', '2025-02-11 22:52:18'),
	(30, 'Customer 29', 'Employer 29', '0500000029', '040000029', 'PN0000029', 'Passport', 'ID0000029', '2030-02-12', 'U.A.E', 'State 29', 'AC0000029', '2025-02-11 22:52:18', '2025-02-11 22:52:18'),
	(31, 'Customer 30', 'Employer 30', '0500000030', '040000030', 'PN0000030', 'Passport', 'ID0000030', '2030-02-12', 'U.A.E', 'State 30', 'AC0000030', '2025-02-11 22:52:18', '2025-02-11 22:52:18'),
	(32, 'Customer 31', 'Employer 31', '0500000031', '040000031', 'PN0000031', 'Passport', 'ID0000031', '2030-02-12', 'U.A.E', 'State 31', 'AC0000031', '2025-02-11 22:52:18', '2025-02-11 22:52:18'),
	(33, 'Customer 32', 'Employer 32', '0500000032', '040000032', 'PN0000032', 'Passport', 'ID0000032', '2030-02-12', 'U.A.E', 'State 32', 'AC0000032', '2025-02-11 22:52:18', '2025-02-11 22:52:18'),
	(34, 'Customer 33', 'Employer 33', '0500000033', '040000033', 'PN0000033', 'Passport', 'ID0000033', '2030-02-12', 'U.A.E', 'State 33', 'AC0000033', '2025-02-11 22:52:18', '2025-02-11 22:52:18'),
	(35, 'Customer 34', 'Employer 34', '0500000034', '040000034', 'PN0000034', 'Passport', 'ID0000034', '2030-02-12', 'U.A.E', 'State 34', 'AC0000034', '2025-02-11 22:52:18', '2025-02-11 22:52:18'),
	(36, 'Customer 35', 'Employer 35', '0500000035', '040000035', 'PN0000035', 'Passport', 'ID0000035', '2030-02-12', 'U.A.E', 'State 35', 'AC0000035', '2025-02-11 22:52:18', '2025-02-11 22:52:18'),
	(37, 'Customer 36', 'Employer 36', '0500000036', '040000036', 'PN0000036', 'Passport', 'ID0000036', '2030-02-12', 'U.A.E', 'State 36', 'AC0000036', '2025-02-11 22:52:18', '2025-02-11 22:52:18'),
	(38, 'Customer 37', 'Employer 37', '0500000037', '040000037', 'PN0000037', 'Passport', 'ID0000037', '2030-02-12', 'U.A.E', 'State 37', 'AC0000037', '2025-02-11 22:52:18', '2025-02-11 22:52:18'),
	(39, 'Customer 38', 'Employer 38', '0500000038', '040000038', 'PN0000038', 'Passport', 'ID0000038', '2030-02-12', 'U.A.E', 'State 38', 'AC0000038', '2025-02-11 22:52:18', '2025-02-11 22:52:18'),
	(40, 'Customer 39', 'Employer 39', '0500000039', '040000039', 'PN0000039', 'Passport', 'ID0000039', '2030-02-12', 'U.A.E', 'State 39', 'AC0000039', '2025-02-11 22:52:18', '2025-02-11 22:52:18'),
	(41, 'Customer 40', 'Employer 40', '0500000040', '040000040', 'PN0000040', 'Passport', 'ID0000040', '2030-02-12', 'U.A.E', 'State 40', 'AC0000040', '2025-02-11 22:52:18', '2025-02-11 22:52:18'),
	(42, 'Customer 41', 'Employer 41', '0500000041', '040000041', 'PN0000041', 'Passport', 'ID0000041', '2030-02-12', 'U.A.E', 'State 41', 'AC0000041', '2025-02-11 22:52:18', '2025-02-11 22:52:18'),
	(43, 'Customer 42', 'Employer 42', '0500000042', '040000042', 'PN0000042', 'Passport', 'ID0000042', '2030-02-12', 'U.A.E', 'State 42', 'AC0000042', '2025-02-11 22:52:18', '2025-02-11 22:52:18'),
	(44, 'Customer 43', 'Employer 43', '0500000043', '040000043', 'PN0000043', 'Passport', 'ID0000043', '2030-02-12', 'U.A.E', 'State 43', 'AC0000043', '2025-02-11 22:52:18', '2025-02-11 22:52:18'),
	(45, 'Customer 44', 'Employer 44', '0500000044', '040000044', 'PN0000044', 'Passport', 'ID0000044', '2030-02-12', 'U.A.E', 'State 44', 'AC0000044', '2025-02-11 22:52:18', '2025-02-11 22:52:18'),
	(46, 'Customer 45', 'Employer 45', '0500000045', '040000045', 'PN0000045', 'Passport', 'ID0000045', '2030-02-12', 'U.A.E', 'State 45', 'AC0000045', '2025-02-11 22:52:18', '2025-02-11 22:52:18'),
	(47, 'Customer 46', 'Employer 46', '0500000046', '040000046', 'PN0000046', 'Passport', 'ID0000046', '2030-02-12', 'U.A.E', 'State 46', 'AC0000046', '2025-02-11 22:52:18', '2025-02-11 22:52:18'),
	(48, 'Customer 47', 'Employer 47', '0500000047', '040000047', 'PN0000047', 'Passport', 'ID0000047', '2030-02-12', 'U.A.E', 'State 47', 'AC0000047', '2025-02-11 22:52:18', '2025-02-11 22:52:18'),
	(49, 'Customer 48', 'Employer 48', '0500000048', '040000048', 'PN0000048', 'Passport', 'ID0000048', '2030-02-12', 'U.A.E', 'State 48', 'AC0000048', '2025-02-11 22:52:18', '2025-02-11 22:52:18'),
	(50, 'Customer 49', 'Employer 49', '0500000049', '040000049', 'PN0000049', 'Passport', 'ID0000049', '2030-02-12', 'U.A.E', 'State 49', 'AC0000049', '2025-02-11 22:52:18', '2025-02-11 22:52:18');

/*!40103 SET TIME_ZONE=IFNULL(@OLD_TIME_ZONE, 'system') */;
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IFNULL(@OLD_FOREIGN_KEY_CHECKS, 1) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=IFNULL(@OLD_SQL_NOTES, 1) */;
