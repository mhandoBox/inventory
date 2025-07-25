-- Drop existing tables if they exist to avoid conflicts
DROP TABLE IF EXISTS `journal_lines`;
DROP TABLE IF EXISTS `journal_entries`;
DROP TABLE IF EXISTS `accounts`;

-- Table structure for accounts
CREATE TABLE `accounts` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `account_code` varchar(20) NOT NULL,
  `account_name` varchar(255) NOT NULL,
  `category` enum('Asset','Liability','Equity','Revenue','Expense','Cost of Goods Sold') NOT NULL,
  `normal_balance` enum('Debit','Credit') NOT NULL,
  `active` tinyint(1) NOT NULL DEFAULT '1',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `account_code` (`account_code`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Table structure for journal entries
CREATE TABLE `journal_entries` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `entry_date` date NOT NULL,
  `reference_no` varchar(50) NOT NULL,
  `module` varchar(50) NOT NULL DEFAULT 'manual',
  `description` text,
  `created_by` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `created_by` (`created_by`),
  CONSTRAINT `journal_entries_ibfk_1` FOREIGN KEY (`created_by`) REFERENCES `users` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Table structure for journal lines
CREATE TABLE `journal_lines` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `journal_entry_id` int(11) NOT NULL,
  `account_id` int(11) NOT NULL,
  `debit` decimal(10,2) NOT NULL DEFAULT '0.00',
  `credit` decimal(10,2) NOT NULL DEFAULT '0.00',
  `description` text,
  PRIMARY KEY (`id`),
  KEY `journal_entry_id` (`journal_entry_id`),
  KEY `account_id` (`account_id`),
  CONSTRAINT `journal_lines_ibfk_1` FOREIGN KEY (`journal_entry_id`) REFERENCES `journal_entries` (`id`) ON DELETE CASCADE,
  CONSTRAINT `journal_lines_ibfk_2` FOREIGN KEY (`account_id`) REFERENCES `accounts` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Sample account data
-- Make sure the accounts table is created first
INSERT INTO `accounts` (`account_code`, `account_name`, `category`, `normal_balance`) VALUES
('1000', 'Cash', 'Asset', 'Debit'),
('1100', 'Accounts Receivable', 'Asset', 'Debit'),
('1200', 'Inventory', 'Asset', 'Debit'),
('2000', 'Accounts Payable', 'Liability', 'Credit'),
('3000', 'Capital', 'Equity', 'Credit'),
('4000', 'Sales Revenue', 'Revenue', 'Credit'),
('5000', 'Cost of Goods Sold', 'Cost of Goods Sold', 'Debit'),
('6000', 'Rent Expense', 'Expense', 'Debit'),
('6100', 'Utilities Expense', 'Expense', 'Debit'),
('6200', 'Salaries Expense', 'Expense', 'Debit');
