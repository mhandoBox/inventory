<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

INFO - 2025-11-05 17:50:37 --> Config Class Initialized
INFO - 2025-11-05 17:50:37 --> Hooks Class Initialized
DEBUG - 2025-11-05 17:50:37 --> UTF-8 Support Enabled
INFO - 2025-11-05 17:50:37 --> Utf8 Class Initialized
INFO - 2025-11-05 17:50:37 --> URI Class Initialized
INFO - 2025-11-05 17:50:37 --> Router Class Initialized
INFO - 2025-11-05 17:50:37 --> Output Class Initialized
INFO - 2025-11-05 17:50:37 --> Security Class Initialized
DEBUG - 2025-11-05 17:50:37 --> Global POST, GET and COOKIE data sanitized
INFO - 2025-11-05 17:50:37 --> Input Class Initialized
INFO - 2025-11-05 17:50:37 --> Language Class Initialized
INFO - 2025-11-05 17:50:37 --> Loader Class Initialized
INFO - 2025-11-05 17:50:37 --> Helper loaded: url_helper
INFO - 2025-11-05 17:50:37 --> Helper loaded: form_helper
INFO - 2025-11-05 17:50:37 --> Database Driver Class Initialized
DEBUG - 2025-11-05 17:50:37 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
INFO - 2025-11-05 17:50:37 --> Session: Class initialized using 'files' driver.
INFO - 2025-11-05 17:50:37 --> Form Validation Class Initialized
INFO - 2025-11-05 17:50:37 --> Controller Class Initialized
DEBUG - 2025-11-05 17:50:37 --> Session class already loaded. Second attempt ignored.
DEBUG - 2025-11-05 17:50:37 --> MY_Controller - Role: administrator
DEBUG - 2025-11-05 17:50:37 --> MY_Controller - Is Admin: true
DEBUG - 2025-11-05 17:50:37 --> MY_Controller - Permissions: Array
(
)

INFO - 2025-11-05 17:50:37 --> Model Class Initialized
INFO - 2025-11-05 17:50:37 --> Model Class Initialized
INFO - 2025-11-05 17:50:37 --> Model Class Initialized
INFO - 2025-11-05 17:50:37 --> Model Class Initialized
INFO - 2025-11-05 17:50:37 --> Model Class Initialized
INFO - 2025-11-05 17:50:37 --> Model Class Initialized
DEBUG - 2025-11-05 17:50:37 --> Controller_Reports initialized
DEBUG - 2025-11-05 17:50:37 --> === SALES REPORT DEBUG START ===
DEBUG - 2025-11-05 17:50:37 --> Filters received: {"date_from":"2025-10-06","date_to":"2025-11-05","warehouse":null,"status":"1,2"}
DEBUG - 2025-11-05 17:50:37 --> Available tables: accounts, activity_log, attribute_value, attributes, brands, cash_accounts, categories, chart_of_accounts, company, company_expenses, customer_invoices, customer_payments, groups, journal_entries, journal_lines, orders, orders_item, products, purchases, quotation_items, quotations, stores, supplier_invoices, supplier_payments, user_group, users
DEBUG - 2025-11-05 17:50:37 --> date_from: 2025-10-06
DEBUG - 2025-11-05 17:50:37 --> date_to: 2025-11-05
DEBUG - 2025-11-05 17:50:37 --> warehouse: not set
DEBUG - 2025-11-05 17:50:37 --> status: 1,2
DEBUG - 2025-11-05 17:50:37 --> Applied date_from: 2025-10-06
DEBUG - 2025-11-05 17:50:37 --> Applied date_to: 2025-11-05
DEBUG - 2025-11-05 17:50:37 --> Applied status: 1,2
DEBUG - 2025-11-05 17:50:37 --> Generated SQL: SELECT `o`.`id` AS `order_id`, `o`.`date_time`, `o`.`amount_paid`, `o`.`paid_status`, `o`.`store_id`, `oi`.`qty` AS `quantity`, `oi`.`rate` AS `price`, `oi`.`amount` AS `amount`, `p`.`name` AS `product_name`, `p`.`id` AS `product_id`, COALESCE(o.customer_name, "Walk-in") AS customer_name
FROM `orders` `o`
INNER JOIN `orders_item` `oi` ON `o`.`id` = `oi`.`order_id`
LEFT JOIN `products` `p` ON `oi`.`product_id` = `p`.`id`
WHERE DATE(o.date_time) >= '2025-10-06'
AND DATE(o.date_time) <= '2025-11-05'
AND `o`.`paid_status` IN('1', '2')
ERROR - 2025-11-05 17:50:37 --> Query error: No tables used - Invalid query: SELECT *
ERROR - 2025-11-05 17:50:37 --> Query failed: {"code":1096,"message":"No tables used"}
DEBUG - 2025-11-05 17:50:37 --> Controller_Reports::sales_report rows fetched: 0
INFO - 2025-11-05 17:50:37 --> File loaded: C:\xampp\htdocs\Inventory_CI\application\views\templates/header.php
INFO - 2025-11-05 17:50:37 --> File loaded: C:\xampp\htdocs\Inventory_CI\application\views\templates/header_menu.php
INFO - 2025-11-05 17:50:37 --> File loaded: C:\xampp\htdocs\Inventory_CI\application\views\templates/side_menubar.php
INFO - 2025-11-05 17:50:38 --> File loaded: C:\xampp\htdocs\Inventory_CI\application\views\reporting/sales_report.php
INFO - 2025-11-05 17:50:38 --> File loaded: C:\xampp\htdocs\Inventory_CI\application\views\templates/footer.php
INFO - 2025-11-05 17:50:38 --> Final output sent to browser
DEBUG - 2025-11-05 17:50:38 --> Total execution time: 1.3111
INFO - 2025-11-05 17:53:41 --> Config Class Initialized
INFO - 2025-11-05 17:53:41 --> Hooks Class Initialized
DEBUG - 2025-11-05 17:53:41 --> UTF-8 Support Enabled
INFO - 2025-11-05 17:53:41 --> Utf8 Class Initialized
INFO - 2025-11-05 17:53:41 --> URI Class Initialized
INFO - 2025-11-05 17:53:41 --> Router Class Initialized
INFO - 2025-11-05 17:53:41 --> Output Class Initialized
INFO - 2025-11-05 17:53:41 --> Security Class Initialized
DEBUG - 2025-11-05 17:53:41 --> Global POST, GET and COOKIE data sanitized
INFO - 2025-11-05 17:53:41 --> Input Class Initialized
INFO - 2025-11-05 17:53:41 --> Language Class Initialized
INFO - 2025-11-05 17:53:41 --> Loader Class Initialized
INFO - 2025-11-05 17:53:41 --> Helper loaded: url_helper
INFO - 2025-11-05 17:53:41 --> Helper loaded: form_helper
INFO - 2025-11-05 17:53:41 --> Database Driver Class Initialized
DEBUG - 2025-11-05 17:53:41 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
INFO - 2025-11-05 17:53:41 --> Session: Class initialized using 'files' driver.
INFO - 2025-11-05 17:53:41 --> Form Validation Class Initialized
INFO - 2025-11-05 17:53:41 --> Controller Class Initialized
DEBUG - 2025-11-05 17:53:41 --> Session class already loaded. Second attempt ignored.
DEBUG - 2025-11-05 17:53:41 --> MY_Controller - Role: administrator
DEBUG - 2025-11-05 17:53:41 --> MY_Controller - Is Admin: true
DEBUG - 2025-11-05 17:53:41 --> MY_Controller - Permissions: Array
(
)

INFO - 2025-11-05 17:53:41 --> Model Class Initialized
INFO - 2025-11-05 17:53:41 --> Model Class Initialized
INFO - 2025-11-05 17:53:41 --> Model Class Initialized
INFO - 2025-11-05 17:53:41 --> Model Class Initialized
INFO - 2025-11-05 17:53:41 --> Model Class Initialized
INFO - 2025-11-05 17:53:41 --> Model Class Initialized
DEBUG - 2025-11-05 17:53:41 --> Controller_Reports initialized
DEBUG - 2025-11-05 17:53:41 --> === SALES REPORT DEBUG START ===
DEBUG - 2025-11-05 17:53:41 --> Filters received: {"date_from":"2025-10-06","date_to":"2025-11-05","warehouse":null,"status":"1,2"}
DEBUG - 2025-11-05 17:53:41 --> Available tables: accounts, activity_log, attribute_value, attributes, brands, cash_accounts, categories, chart_of_accounts, company, company_expenses, customer_invoices, customer_payments, groups, journal_entries, journal_lines, orders, orders_item, products, purchases, quotation_items, quotations, stores, supplier_invoices, supplier_payments, user_group, users
DEBUG - 2025-11-05 17:53:41 --> date_from: 2025-10-06
DEBUG - 2025-11-05 17:53:41 --> date_to: 2025-11-05
DEBUG - 2025-11-05 17:53:41 --> warehouse: not set
DEBUG - 2025-11-05 17:53:41 --> status: 1,2
DEBUG - 2025-11-05 17:53:41 --> Applied date_from: 2025-10-06
DEBUG - 2025-11-05 17:53:41 --> Applied date_to: 2025-11-05
DEBUG - 2025-11-05 17:53:41 --> Applied status: 1,2
DEBUG - 2025-11-05 17:53:41 --> Generated SQL: SELECT `o`.`id` AS `order_id`, `o`.`date_time`, `o`.`amount_paid`, `o`.`paid_status`, `o`.`store_id`, `oi`.`qty` AS `quantity`, `oi`.`rate` AS `price`, `oi`.`amount` AS `amount`, `p`.`name` AS `product_name`, `p`.`id` AS `product_id`, COALESCE(o.customer_name, "Walk-in") AS customer_name
FROM `orders` `o`
INNER JOIN `orders_item` `oi` ON `o`.`id` = `oi`.`order_id`
LEFT JOIN `products` `p` ON `oi`.`product_id` = `p`.`id`
WHERE DATE(o.date_time) >= '2025-10-06'
AND DATE(o.date_time) <= '2025-11-05'
AND `o`.`paid_status` IN('1', '2')
DEBUG - 2025-11-05 17:53:41 --> Query returned 273 rows
DEBUG - 2025-11-05 17:53:41 --> === SALES REPORT DEBUG END ===
DEBUG - 2025-11-05 17:53:41 --> Controller_Reports::sales_report rows fetched: 273
INFO - 2025-11-05 17:53:41 --> File loaded: C:\xampp\htdocs\Inventory_CI\application\views\templates/header.php
INFO - 2025-11-05 17:53:41 --> File loaded: C:\xampp\htdocs\Inventory_CI\application\views\templates/header_menu.php
INFO - 2025-11-05 17:53:41 --> File loaded: C:\xampp\htdocs\Inventory_CI\application\views\templates/side_menubar.php
INFO - 2025-11-05 17:53:41 --> File loaded: C:\xampp\htdocs\Inventory_CI\application\views\reporting/sales_report.php
INFO - 2025-11-05 17:53:41 --> File loaded: C:\xampp\htdocs\Inventory_CI\application\views\templates/footer.php
INFO - 2025-11-05 17:53:41 --> Final output sent to browser
DEBUG - 2025-11-05 17:53:41 --> Total execution time: 0.4511
INFO - 2025-11-05 17:55:47 --> Config Class Initialized
INFO - 2025-11-05 17:55:47 --> Hooks Class Initialized
DEBUG - 2025-11-05 17:55:47 --> UTF-8 Support Enabled
INFO - 2025-11-05 17:55:47 --> Utf8 Class Initialized
INFO - 2025-11-05 17:55:47 --> URI Class Initialized
INFO - 2025-11-05 17:55:47 --> Router Class Initialized
INFO - 2025-11-05 17:55:47 --> Output Class Initialized
INFO - 2025-11-05 17:55:47 --> Security Class Initialized
DEBUG - 2025-11-05 17:55:47 --> Global POST, GET and COOKIE data sanitized
INFO - 2025-11-05 17:55:47 --> Input Class Initialized
INFO - 2025-11-05 17:55:47 --> Language Class Initialized
INFO - 2025-11-05 17:55:47 --> Loader Class Initialized
INFO - 2025-11-05 17:55:47 --> Helper loaded: url_helper
INFO - 2025-11-05 17:55:47 --> Helper loaded: form_helper
INFO - 2025-11-05 17:55:47 --> Database Driver Class Initialized
DEBUG - 2025-11-05 17:55:47 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
INFO - 2025-11-05 17:55:47 --> Session: Class initialized using 'files' driver.
INFO - 2025-11-05 17:55:47 --> Form Validation Class Initialized
INFO - 2025-11-05 17:55:47 --> Controller Class Initialized
DEBUG - 2025-11-05 17:55:47 --> Session class already loaded. Second attempt ignored.
DEBUG - 2025-11-05 17:55:47 --> MY_Controller - Role: administrator
DEBUG - 2025-11-05 17:55:47 --> MY_Controller - Is Admin: true
DEBUG - 2025-11-05 17:55:47 --> MY_Controller - Permissions: Array
(
)

INFO - 2025-11-05 17:55:47 --> Model Class Initialized
INFO - 2025-11-05 17:55:47 --> Model Class Initialized
INFO - 2025-11-05 17:55:47 --> Model Class Initialized
INFO - 2025-11-05 17:55:47 --> Model Class Initialized
INFO - 2025-11-05 17:55:47 --> Model Class Initialized
INFO - 2025-11-05 17:55:48 --> Model Class Initialized
DEBUG - 2025-11-05 17:55:48 --> Controller_Reports initialized
DEBUG - 2025-11-05 17:55:48 --> === SALES REPORT DEBUG START ===
DEBUG - 2025-11-05 17:55:48 --> Filters received: {"date_from":"2025-11-04","date_to":"2025-11-05","warehouse":"","status":"1,2"}
DEBUG - 2025-11-05 17:55:48 --> Available tables: accounts, activity_log, attribute_value, attributes, brands, cash_accounts, categories, chart_of_accounts, company, company_expenses, customer_invoices, customer_payments, groups, journal_entries, journal_lines, orders, orders_item, products, purchases, quotation_items, quotations, stores, supplier_invoices, supplier_payments, user_group, users
DEBUG - 2025-11-05 17:55:48 --> date_from: 2025-11-04
DEBUG - 2025-11-05 17:55:48 --> date_to: 2025-11-05
DEBUG - 2025-11-05 17:55:48 --> warehouse: 
DEBUG - 2025-11-05 17:55:48 --> status: 1,2
DEBUG - 2025-11-05 17:55:48 --> Applied date_from: 2025-11-04
DEBUG - 2025-11-05 17:55:48 --> Applied date_to: 2025-11-05
DEBUG - 2025-11-05 17:55:48 --> Applied status: 1,2
DEBUG - 2025-11-05 17:55:48 --> Generated SQL: SELECT `o`.`id` AS `order_id`, `o`.`date_time`, `o`.`amount_paid`, `o`.`paid_status`, `o`.`store_id`, `oi`.`qty` AS `quantity`, `oi`.`rate` AS `price`, `oi`.`amount` AS `amount`, `p`.`name` AS `product_name`, `p`.`id` AS `product_id`, COALESCE(o.customer_name, "Walk-in") AS customer_name
FROM `orders` `o`
INNER JOIN `orders_item` `oi` ON `o`.`id` = `oi`.`order_id`
LEFT JOIN `products` `p` ON `oi`.`product_id` = `p`.`id`
WHERE DATE(o.date_time) >= '2025-11-04'
AND DATE(o.date_time) <= '2025-11-05'
AND `o`.`paid_status` IN('1', '2')
DEBUG - 2025-11-05 17:55:48 --> Query returned 157 rows
DEBUG - 2025-11-05 17:55:48 --> === SALES REPORT DEBUG END ===
DEBUG - 2025-11-05 17:55:48 --> Controller_Reports::sales_report rows fetched: 157
INFO - 2025-11-05 17:55:48 --> File loaded: C:\xampp\htdocs\Inventory_CI\application\views\templates/header.php
INFO - 2025-11-05 17:55:48 --> File loaded: C:\xampp\htdocs\Inventory_CI\application\views\templates/header_menu.php
INFO - 2025-11-05 17:55:48 --> File loaded: C:\xampp\htdocs\Inventory_CI\application\views\templates/side_menubar.php
INFO - 2025-11-05 17:55:48 --> File loaded: C:\xampp\htdocs\Inventory_CI\application\views\reporting/sales_report.php
INFO - 2025-11-05 17:55:48 --> File loaded: C:\xampp\htdocs\Inventory_CI\application\views\templates/footer.php
INFO - 2025-11-05 17:55:48 --> Final output sent to browser
DEBUG - 2025-11-05 17:55:48 --> Total execution time: 0.4969
INFO - 2025-11-05 17:56:40 --> Config Class Initialized
INFO - 2025-11-05 17:56:40 --> Hooks Class Initialized
DEBUG - 2025-11-05 17:56:40 --> UTF-8 Support Enabled
INFO - 2025-11-05 17:56:40 --> Utf8 Class Initialized
INFO - 2025-11-05 17:56:40 --> URI Class Initialized
INFO - 2025-11-05 17:56:40 --> Router Class Initialized
INFO - 2025-11-05 17:56:40 --> Output Class Initialized
INFO - 2025-11-05 17:56:40 --> Security Class Initialized
DEBUG - 2025-11-05 17:56:40 --> Global POST, GET and COOKIE data sanitized
INFO - 2025-11-05 17:56:40 --> Input Class Initialized
INFO - 2025-11-05 17:56:40 --> Language Class Initialized
INFO - 2025-11-05 17:56:40 --> Loader Class Initialized
INFO - 2025-11-05 17:56:40 --> Helper loaded: url_helper
INFO - 2025-11-05 17:56:40 --> Helper loaded: form_helper
INFO - 2025-11-05 17:56:40 --> Database Driver Class Initialized
DEBUG - 2025-11-05 17:56:41 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
INFO - 2025-11-05 17:56:41 --> Session: Class initialized using 'files' driver.
INFO - 2025-11-05 17:56:41 --> Form Validation Class Initialized
INFO - 2025-11-05 17:56:41 --> Controller Class Initialized
DEBUG - 2025-11-05 17:56:41 --> Session class already loaded. Second attempt ignored.
DEBUG - 2025-11-05 17:56:41 --> MY_Controller - Role: administrator
DEBUG - 2025-11-05 17:56:41 --> MY_Controller - Is Admin: true
DEBUG - 2025-11-05 17:56:41 --> MY_Controller - Permissions: Array
(
)

INFO - 2025-11-05 17:56:41 --> Model Class Initialized
INFO - 2025-11-05 17:56:41 --> Model Class Initialized
INFO - 2025-11-05 17:56:41 --> Model Class Initialized
INFO - 2025-11-05 17:56:41 --> Model Class Initialized
INFO - 2025-11-05 17:56:41 --> Model Class Initialized
INFO - 2025-11-05 17:56:41 --> Model Class Initialized
DEBUG - 2025-11-05 17:56:41 --> Controller_Reports initialized
DEBUG - 2025-11-05 17:56:41 --> === SALES REPORT DEBUG START ===
DEBUG - 2025-11-05 17:56:41 --> Filters received: {"date_from":"2025-11-04","date_to":"2025-11-05","warehouse":"","status":"1,2"}
DEBUG - 2025-11-05 17:56:41 --> Available tables: accounts, activity_log, attribute_value, attributes, brands, cash_accounts, categories, chart_of_accounts, company, company_expenses, customer_invoices, customer_payments, groups, journal_entries, journal_lines, orders, orders_item, products, purchases, quotation_items, quotations, stores, supplier_invoices, supplier_payments, user_group, users
DEBUG - 2025-11-05 17:56:41 --> date_from: 2025-11-04
DEBUG - 2025-11-05 17:56:41 --> date_to: 2025-11-05
DEBUG - 2025-11-05 17:56:41 --> warehouse: 
DEBUG - 2025-11-05 17:56:41 --> status: 1,2
DEBUG - 2025-11-05 17:56:41 --> Applied date_from: 2025-11-04
DEBUG - 2025-11-05 17:56:41 --> Applied date_to: 2025-11-05
DEBUG - 2025-11-05 17:56:41 --> Applied status: 1,2
DEBUG - 2025-11-05 17:56:41 --> Generated SQL: SELECT `o`.`id` AS `order_id`, `o`.`date_time`, `o`.`amount_paid`, `o`.`paid_status`, `o`.`store_id`, `oi`.`qty` AS `quantity`, `oi`.`rate` AS `price`, `oi`.`amount` AS `amount`, `p`.`name` AS `product_name`, `p`.`id` AS `product_id`, COALESCE(o.customer_name, "Walk-in") AS customer_name
FROM `orders` `o`
INNER JOIN `orders_item` `oi` ON `o`.`id` = `oi`.`order_id`
LEFT JOIN `products` `p` ON `oi`.`product_id` = `p`.`id`
WHERE DATE(o.date_time) >= '2025-11-04'
AND DATE(o.date_time) <= '2025-11-05'
AND `o`.`paid_status` IN('1', '2')
DEBUG - 2025-11-05 17:56:41 --> Query returned 157 rows
DEBUG - 2025-11-05 17:56:41 --> === SALES REPORT DEBUG END ===
DEBUG - 2025-11-05 17:56:41 --> Controller_Reports::sales_report rows fetched: 157
INFO - 2025-11-05 17:56:41 --> File loaded: C:\xampp\htdocs\Inventory_CI\application\views\templates/header.php
INFO - 2025-11-05 17:56:41 --> File loaded: C:\xampp\htdocs\Inventory_CI\application\views\templates/header_menu.php
INFO - 2025-11-05 17:56:41 --> File loaded: C:\xampp\htdocs\Inventory_CI\application\views\templates/side_menubar.php
INFO - 2025-11-05 17:56:42 --> File loaded: C:\xampp\htdocs\Inventory_CI\application\views\reporting/sales_report.php
INFO - 2025-11-05 17:56:42 --> File loaded: C:\xampp\htdocs\Inventory_CI\application\views\templates/footer.php
INFO - 2025-11-05 17:56:42 --> Final output sent to browser
DEBUG - 2025-11-05 17:56:42 --> Total execution time: 1.2771
INFO - 2025-11-05 17:58:39 --> Config Class Initialized
INFO - 2025-11-05 17:58:39 --> Hooks Class Initialized
DEBUG - 2025-11-05 17:58:39 --> UTF-8 Support Enabled
INFO - 2025-11-05 17:58:39 --> Utf8 Class Initialized
INFO - 2025-11-05 17:58:39 --> URI Class Initialized
INFO - 2025-11-05 17:58:39 --> Router Class Initialized
INFO - 2025-11-05 17:58:39 --> Output Class Initialized
INFO - 2025-11-05 17:58:39 --> Security Class Initialized
DEBUG - 2025-11-05 17:58:39 --> Global POST, GET and COOKIE data sanitized
INFO - 2025-11-05 17:58:39 --> Input Class Initialized
INFO - 2025-11-05 17:58:39 --> Language Class Initialized
INFO - 2025-11-05 17:58:39 --> Loader Class Initialized
INFO - 2025-11-05 17:58:39 --> Helper loaded: url_helper
INFO - 2025-11-05 17:58:39 --> Helper loaded: form_helper
INFO - 2025-11-05 17:58:39 --> Database Driver Class Initialized
DEBUG - 2025-11-05 17:58:39 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
INFO - 2025-11-05 17:58:39 --> Session: Class initialized using 'files' driver.
INFO - 2025-11-05 17:58:39 --> Form Validation Class Initialized
INFO - 2025-11-05 17:58:39 --> Controller Class Initialized
DEBUG - 2025-11-05 17:58:39 --> Session class already loaded. Second attempt ignored.
DEBUG - 2025-11-05 17:58:39 --> MY_Controller - Role: administrator
DEBUG - 2025-11-05 17:58:39 --> MY_Controller - Is Admin: true
DEBUG - 2025-11-05 17:58:39 --> MY_Controller - Permissions: Array
(
)

INFO - 2025-11-05 17:58:39 --> Model Class Initialized
INFO - 2025-11-05 17:58:39 --> Model Class Initialized
INFO - 2025-11-05 17:58:39 --> Model Class Initialized
INFO - 2025-11-05 17:58:39 --> Model Class Initialized
INFO - 2025-11-05 17:58:39 --> Model Class Initialized
INFO - 2025-11-05 17:58:39 --> Model Class Initialized
DEBUG - 2025-11-05 17:58:39 --> Controller_Reports initialized
DEBUG - 2025-11-05 17:58:39 --> === SALES REPORT DEBUG START ===
DEBUG - 2025-11-05 17:58:39 --> Filters received: {"date_from":"2025-11-04","date_to":"2025-11-05","warehouse":"","status":"1,2"}
DEBUG - 2025-11-05 17:58:39 --> Available tables: accounts, activity_log, attribute_value, attributes, brands, cash_accounts, categories, chart_of_accounts, company, company_expenses, customer_invoices, customer_payments, groups, journal_entries, journal_lines, orders, orders_item, products, purchases, quotation_items, quotations, stores, supplier_invoices, supplier_payments, user_group, users
DEBUG - 2025-11-05 17:58:39 --> date_from: 2025-11-04
DEBUG - 2025-11-05 17:58:39 --> date_to: 2025-11-05
DEBUG - 2025-11-05 17:58:39 --> warehouse: 
DEBUG - 2025-11-05 17:58:39 --> status: 1,2
DEBUG - 2025-11-05 17:58:39 --> Applied date_from: 2025-11-04
DEBUG - 2025-11-05 17:58:39 --> Applied date_to: 2025-11-05
DEBUG - 2025-11-05 17:58:39 --> Applied status: 1,2
DEBUG - 2025-11-05 17:58:39 --> Generated SQL: SELECT `o`.`id` AS `order_id`, `o`.`date_time`, `o`.`amount_paid`, `o`.`paid_status`, `o`.`store_id`, `oi`.`qty` AS `quantity`, `oi`.`rate` AS `price`, `oi`.`amount` AS `amount`, `p`.`name` AS `product_name`, `p`.`id` AS `product_id`, COALESCE(o.customer_name, "Walk-in") AS customer_name
FROM `orders` `o`
INNER JOIN `orders_item` `oi` ON `o`.`id` = `oi`.`order_id`
LEFT JOIN `products` `p` ON `oi`.`product_id` = `p`.`id`
WHERE DATE(o.date_time) >= '2025-11-04'
AND DATE(o.date_time) <= '2025-11-05'
AND `o`.`paid_status` IN('1', '2')
DEBUG - 2025-11-05 17:58:39 --> Query returned 157 rows
DEBUG - 2025-11-05 17:58:39 --> === SALES REPORT DEBUG END ===
DEBUG - 2025-11-05 17:58:39 --> Controller_Reports::sales_report rows fetched: 157
INFO - 2025-11-05 17:58:39 --> File loaded: C:\xampp\htdocs\Inventory_CI\application\views\templates/header.php
INFO - 2025-11-05 17:58:39 --> File loaded: C:\xampp\htdocs\Inventory_CI\application\views\templates/header_menu.php
INFO - 2025-11-05 17:58:39 --> File loaded: C:\xampp\htdocs\Inventory_CI\application\views\templates/side_menubar.php
INFO - 2025-11-05 17:58:40 --> File loaded: C:\xampp\htdocs\Inventory_CI\application\views\reporting/sales_report.php
INFO - 2025-11-05 17:58:40 --> File loaded: C:\xampp\htdocs\Inventory_CI\application\views\templates/footer.php
INFO - 2025-11-05 17:58:40 --> Final output sent to browser
DEBUG - 2025-11-05 17:58:40 --> Total execution time: 1.2331
INFO - 2025-11-05 17:59:34 --> Config Class Initialized
INFO - 2025-11-05 17:59:34 --> Hooks Class Initialized
DEBUG - 2025-11-05 17:59:34 --> UTF-8 Support Enabled
INFO - 2025-11-05 17:59:34 --> Utf8 Class Initialized
INFO - 2025-11-05 17:59:34 --> URI Class Initialized
INFO - 2025-11-05 17:59:34 --> Router Class Initialized
INFO - 2025-11-05 17:59:34 --> Output Class Initialized
INFO - 2025-11-05 17:59:34 --> Security Class Initialized
DEBUG - 2025-11-05 17:59:34 --> Global POST, GET and COOKIE data sanitized
INFO - 2025-11-05 17:59:34 --> Input Class Initialized
INFO - 2025-11-05 17:59:34 --> Language Class Initialized
INFO - 2025-11-05 17:59:34 --> Loader Class Initialized
INFO - 2025-11-05 17:59:34 --> Helper loaded: url_helper
INFO - 2025-11-05 17:59:34 --> Helper loaded: form_helper
INFO - 2025-11-05 17:59:34 --> Database Driver Class Initialized
DEBUG - 2025-11-05 17:59:34 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
INFO - 2025-11-05 17:59:34 --> Session: Class initialized using 'files' driver.
INFO - 2025-11-05 17:59:34 --> Form Validation Class Initialized
INFO - 2025-11-05 17:59:34 --> Controller Class Initialized
DEBUG - 2025-11-05 17:59:34 --> Session class already loaded. Second attempt ignored.
DEBUG - 2025-11-05 17:59:34 --> MY_Controller - Role: administrator
DEBUG - 2025-11-05 17:59:34 --> MY_Controller - Is Admin: true
DEBUG - 2025-11-05 17:59:34 --> MY_Controller - Permissions: Array
(
)

INFO - 2025-11-05 17:59:34 --> Model Class Initialized
INFO - 2025-11-05 17:59:34 --> Model Class Initialized
INFO - 2025-11-05 17:59:34 --> Model Class Initialized
INFO - 2025-11-05 17:59:34 --> Model Class Initialized
INFO - 2025-11-05 17:59:34 --> Model Class Initialized
INFO - 2025-11-05 17:59:34 --> Model Class Initialized
DEBUG - 2025-11-05 17:59:34 --> Controller_Reports initialized
DEBUG - 2025-11-05 17:59:34 --> === SALES REPORT DEBUG START ===
DEBUG - 2025-11-05 17:59:34 --> Filters received: {"date_from":"2025-11-04","date_to":"2025-11-05","warehouse":"","status":"1,2"}
DEBUG - 2025-11-05 17:59:34 --> Available tables: accounts, activity_log, attribute_value, attributes, brands, cash_accounts, categories, chart_of_accounts, company, company_expenses, customer_invoices, customer_payments, groups, journal_entries, journal_lines, orders, orders_item, products, purchases, quotation_items, quotations, stores, supplier_invoices, supplier_payments, user_group, users
DEBUG - 2025-11-05 17:59:34 --> date_from: 2025-11-04
DEBUG - 2025-11-05 17:59:34 --> date_to: 2025-11-05
DEBUG - 2025-11-05 17:59:34 --> warehouse: 
DEBUG - 2025-11-05 17:59:34 --> status: 1,2
DEBUG - 2025-11-05 17:59:34 --> Applied date_from: 2025-11-04
DEBUG - 2025-11-05 17:59:34 --> Applied date_to: 2025-11-05
DEBUG - 2025-11-05 17:59:34 --> Applied status: 1,2
DEBUG - 2025-11-05 17:59:34 --> Generated SQL: SELECT `o`.`id` AS `order_id`, `o`.`date_time`, `o`.`amount_paid`, `o`.`paid_status`, `o`.`store_id`, `oi`.`qty` AS `quantity`, `oi`.`rate` AS `price`, `oi`.`amount` AS `amount`, `p`.`name` AS `product_name`, `p`.`id` AS `product_id`, COALESCE(o.customer_name, "Walk-in") AS customer_name
FROM `orders` `o`
INNER JOIN `orders_item` `oi` ON `o`.`id` = `oi`.`order_id`
LEFT JOIN `products` `p` ON `oi`.`product_id` = `p`.`id`
WHERE DATE(o.date_time) >= '2025-11-04'
AND DATE(o.date_time) <= '2025-11-05'
AND `o`.`paid_status` IN('1', '2')
DEBUG - 2025-11-05 17:59:34 --> Query returned 157 rows
DEBUG - 2025-11-05 17:59:34 --> === SALES REPORT DEBUG END ===
DEBUG - 2025-11-05 17:59:34 --> Controller_Reports::sales_report rows fetched: 157
INFO - 2025-11-05 17:59:34 --> File loaded: C:\xampp\htdocs\Inventory_CI\application\views\templates/header.php
INFO - 2025-11-05 17:59:34 --> File loaded: C:\xampp\htdocs\Inventory_CI\application\views\templates/header_menu.php
INFO - 2025-11-05 17:59:34 --> File loaded: C:\xampp\htdocs\Inventory_CI\application\views\templates/side_menubar.php
INFO - 2025-11-05 17:59:35 --> File loaded: C:\xampp\htdocs\Inventory_CI\application\views\reporting/sales_report.php
INFO - 2025-11-05 17:59:35 --> File loaded: C:\xampp\htdocs\Inventory_CI\application\views\templates/footer.php
INFO - 2025-11-05 17:59:35 --> Final output sent to browser
DEBUG - 2025-11-05 17:59:35 --> Total execution time: 1.2356
INFO - 2025-11-05 18:00:01 --> Config Class Initialized
INFO - 2025-11-05 18:00:01 --> Hooks Class Initialized
DEBUG - 2025-11-05 18:00:01 --> UTF-8 Support Enabled
INFO - 2025-11-05 18:00:01 --> Utf8 Class Initialized
INFO - 2025-11-05 18:00:01 --> URI Class Initialized
INFO - 2025-11-05 18:00:01 --> Router Class Initialized
INFO - 2025-11-05 18:00:01 --> Output Class Initialized
INFO - 2025-11-05 18:00:01 --> Security Class Initialized
DEBUG - 2025-11-05 18:00:01 --> Global POST, GET and COOKIE data sanitized
INFO - 2025-11-05 18:00:01 --> Input Class Initialized
INFO - 2025-11-05 18:00:01 --> Language Class Initialized
INFO - 2025-11-05 18:00:01 --> Loader Class Initialized
INFO - 2025-11-05 18:00:01 --> Helper loaded: url_helper
INFO - 2025-11-05 18:00:01 --> Helper loaded: form_helper
INFO - 2025-11-05 18:00:01 --> Database Driver Class Initialized
DEBUG - 2025-11-05 18:00:01 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
INFO - 2025-11-05 18:00:01 --> Session: Class initialized using 'files' driver.
INFO - 2025-11-05 18:00:01 --> Form Validation Class Initialized
INFO - 2025-11-05 18:00:01 --> Controller Class Initialized
DEBUG - 2025-11-05 18:00:01 --> Session class already loaded. Second attempt ignored.
DEBUG - 2025-11-05 18:00:01 --> MY_Controller - Role: administrator
DEBUG - 2025-11-05 18:00:01 --> MY_Controller - Is Admin: true
DEBUG - 2025-11-05 18:00:01 --> MY_Controller - Permissions: Array
(
)

INFO - 2025-11-05 18:00:01 --> Model Class Initialized
INFO - 2025-11-05 18:00:01 --> Model Class Initialized
INFO - 2025-11-05 18:00:01 --> Model Class Initialized
INFO - 2025-11-05 18:00:01 --> Model Class Initialized
INFO - 2025-11-05 18:00:01 --> Model Class Initialized
INFO - 2025-11-05 18:00:01 --> Model Class Initialized
DEBUG - 2025-11-05 18:00:01 --> Controller_Reports initialized
DEBUG - 2025-11-05 18:00:01 --> === SALES REPORT DEBUG START ===
DEBUG - 2025-11-05 18:00:01 --> Filters received: {"date_from":"2025-11-01","date_to":"2025-11-05","warehouse":"","status":"1,2"}
DEBUG - 2025-11-05 18:00:01 --> Available tables: accounts, activity_log, attribute_value, attributes, brands, cash_accounts, categories, chart_of_accounts, company, company_expenses, customer_invoices, customer_payments, groups, journal_entries, journal_lines, orders, orders_item, products, purchases, quotation_items, quotations, stores, supplier_invoices, supplier_payments, user_group, users
DEBUG - 2025-11-05 18:00:01 --> date_from: 2025-11-01
DEBUG - 2025-11-05 18:00:01 --> date_to: 2025-11-05
DEBUG - 2025-11-05 18:00:01 --> warehouse: 
DEBUG - 2025-11-05 18:00:01 --> status: 1,2
DEBUG - 2025-11-05 18:00:01 --> Applied date_from: 2025-11-01
DEBUG - 2025-11-05 18:00:01 --> Applied date_to: 2025-11-05
DEBUG - 2025-11-05 18:00:01 --> Applied status: 1,2
DEBUG - 2025-11-05 18:00:01 --> Generated SQL: SELECT `o`.`id` AS `order_id`, `o`.`date_time`, `o`.`amount_paid`, `o`.`paid_status`, `o`.`store_id`, `oi`.`qty` AS `quantity`, `oi`.`rate` AS `price`, `oi`.`amount` AS `amount`, `p`.`name` AS `product_name`, `p`.`id` AS `product_id`, COALESCE(o.customer_name, "Walk-in") AS customer_name
FROM `orders` `o`
INNER JOIN `orders_item` `oi` ON `o`.`id` = `oi`.`order_id`
LEFT JOIN `products` `p` ON `oi`.`product_id` = `p`.`id`
WHERE DATE(o.date_time) >= '2025-11-01'
AND DATE(o.date_time) <= '2025-11-05'
AND `o`.`paid_status` IN('1', '2')
DEBUG - 2025-11-05 18:00:01 --> Query returned 273 rows
DEBUG - 2025-11-05 18:00:01 --> === SALES REPORT DEBUG END ===
DEBUG - 2025-11-05 18:00:01 --> Controller_Reports::sales_report rows fetched: 273
INFO - 2025-11-05 18:00:01 --> File loaded: C:\xampp\htdocs\Inventory_CI\application\views\templates/header.php
INFO - 2025-11-05 18:00:01 --> File loaded: C:\xampp\htdocs\Inventory_CI\application\views\templates/header_menu.php
INFO - 2025-11-05 18:00:01 --> File loaded: C:\xampp\htdocs\Inventory_CI\application\views\templates/side_menubar.php
INFO - 2025-11-05 18:00:01 --> File loaded: C:\xampp\htdocs\Inventory_CI\application\views\reporting/sales_report.php
INFO - 2025-11-05 18:00:01 --> File loaded: C:\xampp\htdocs\Inventory_CI\application\views\templates/footer.php
INFO - 2025-11-05 18:00:01 --> Final output sent to browser
DEBUG - 2025-11-05 18:00:01 --> Total execution time: 0.2940
INFO - 2025-11-05 18:05:51 --> Config Class Initialized
INFO - 2025-11-05 18:05:51 --> Hooks Class Initialized
DEBUG - 2025-11-05 18:05:51 --> UTF-8 Support Enabled
INFO - 2025-11-05 18:05:51 --> Utf8 Class Initialized
INFO - 2025-11-05 18:05:51 --> URI Class Initialized
INFO - 2025-11-05 18:05:51 --> Router Class Initialized
INFO - 2025-11-05 18:05:51 --> Output Class Initialized
INFO - 2025-11-05 18:05:51 --> Security Class Initialized
DEBUG - 2025-11-05 18:05:51 --> Global POST, GET and COOKIE data sanitized
INFO - 2025-11-05 18:05:51 --> Input Class Initialized
INFO - 2025-11-05 18:05:51 --> Language Class Initialized
INFO - 2025-11-05 18:05:51 --> Loader Class Initialized
INFO - 2025-11-05 18:05:51 --> Helper loaded: url_helper
INFO - 2025-11-05 18:05:51 --> Helper loaded: form_helper
INFO - 2025-11-05 18:05:51 --> Database Driver Class Initialized
DEBUG - 2025-11-05 18:05:51 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
INFO - 2025-11-05 18:05:51 --> Session: Class initialized using 'files' driver.
INFO - 2025-11-05 18:05:51 --> Form Validation Class Initialized
INFO - 2025-11-05 18:05:51 --> Controller Class Initialized
DEBUG - 2025-11-05 18:05:51 --> Session class already loaded. Second attempt ignored.
DEBUG - 2025-11-05 18:05:51 --> MY_Controller - Role: administrator
DEBUG - 2025-11-05 18:05:51 --> MY_Controller - Is Admin: true
DEBUG - 2025-11-05 18:05:51 --> MY_Controller - Permissions: Array
(
)

INFO - 2025-11-05 18:05:51 --> Model Class Initialized
INFO - 2025-11-05 18:05:51 --> Model Class Initialized
INFO - 2025-11-05 18:05:51 --> Model Class Initialized
INFO - 2025-11-05 18:05:51 --> Model Class Initialized
INFO - 2025-11-05 18:05:51 --> Model Class Initialized
INFO - 2025-11-05 18:05:51 --> Model Class Initialized
DEBUG - 2025-11-05 18:05:51 --> Controller_Reports initialized
DEBUG - 2025-11-05 18:05:51 --> === SALES REPORT DEBUG START ===
DEBUG - 2025-11-05 18:05:51 --> Filters received: {"date_from":"2025-11-01","date_to":"2025-11-05","warehouse":"","status":"1,2"}
DEBUG - 2025-11-05 18:05:51 --> Available tables: accounts, activity_log, attribute_value, attributes, brands, cash_accounts, categories, chart_of_accounts, company, company_expenses, customer_invoices, customer_payments, groups, journal_entries, journal_lines, orders, orders_item, products, purchases, quotation_items, quotations, stores, supplier_invoices, supplier_payments, user_group, users
DEBUG - 2025-11-05 18:05:51 --> date_from: 2025-11-01
DEBUG - 2025-11-05 18:05:51 --> date_to: 2025-11-05
DEBUG - 2025-11-05 18:05:51 --> warehouse: 
DEBUG - 2025-11-05 18:05:51 --> status: 1,2
DEBUG - 2025-11-05 18:05:51 --> Applied date_from: 2025-11-01
DEBUG - 2025-11-05 18:05:51 --> Applied date_to: 2025-11-05
DEBUG - 2025-11-05 18:05:51 --> Applied status: 1,2
DEBUG - 2025-11-05 18:05:51 --> Generated SQL: SELECT `o`.`id` AS `order_id`, `o`.`date_time`, `o`.`amount_paid`, `o`.`paid_status`, `o`.`store_id`, `oi`.`qty` AS `quantity`, `oi`.`rate` AS `price`, `oi`.`amount` AS `amount`, `p`.`name` AS `product_name`, `p`.`id` AS `product_id`, COALESCE(o.customer_name, "Walk-in") AS customer_name
FROM `orders` `o`
INNER JOIN `orders_item` `oi` ON `o`.`id` = `oi`.`order_id`
LEFT JOIN `products` `p` ON `oi`.`product_id` = `p`.`id`
WHERE DATE(o.date_time) >= '2025-11-01'
AND DATE(o.date_time) <= '2025-11-05'
AND `o`.`paid_status` IN('1', '2')
DEBUG - 2025-11-05 18:05:51 --> Query returned 273 rows
DEBUG - 2025-11-05 18:05:51 --> === SALES REPORT DEBUG END ===
DEBUG - 2025-11-05 18:05:51 --> Controller_Reports::sales_report rows fetched: 273
INFO - 2025-11-05 18:05:51 --> File loaded: C:\xampp\htdocs\Inventory_CI\application\views\templates/header.php
INFO - 2025-11-05 18:05:51 --> File loaded: C:\xampp\htdocs\Inventory_CI\application\views\templates/header_menu.php
INFO - 2025-11-05 18:05:51 --> File loaded: C:\xampp\htdocs\Inventory_CI\application\views\templates/side_menubar.php
INFO - 2025-11-05 18:05:52 --> File loaded: C:\xampp\htdocs\Inventory_CI\application\views\reporting/sales_report.php
INFO - 2025-11-05 18:05:52 --> File loaded: C:\xampp\htdocs\Inventory_CI\application\views\templates/footer.php
INFO - 2025-11-05 18:05:52 --> Final output sent to browser
DEBUG - 2025-11-05 18:05:52 --> Total execution time: 1.2580
INFO - 2025-11-05 18:09:55 --> Config Class Initialized
INFO - 2025-11-05 18:09:55 --> Hooks Class Initialized
DEBUG - 2025-11-05 18:09:55 --> UTF-8 Support Enabled
INFO - 2025-11-05 18:09:55 --> Utf8 Class Initialized
INFO - 2025-11-05 18:09:55 --> URI Class Initialized
INFO - 2025-11-05 18:09:55 --> Router Class Initialized
INFO - 2025-11-05 18:09:55 --> Output Class Initialized
INFO - 2025-11-05 18:09:55 --> Security Class Initialized
DEBUG - 2025-11-05 18:09:55 --> Global POST, GET and COOKIE data sanitized
INFO - 2025-11-05 18:09:55 --> Input Class Initialized
INFO - 2025-11-05 18:09:55 --> Language Class Initialized
INFO - 2025-11-05 18:09:55 --> Loader Class Initialized
INFO - 2025-11-05 18:09:55 --> Helper loaded: url_helper
INFO - 2025-11-05 18:09:55 --> Helper loaded: form_helper
INFO - 2025-11-05 18:09:55 --> Database Driver Class Initialized
DEBUG - 2025-11-05 18:09:55 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
INFO - 2025-11-05 18:09:55 --> Session: Class initialized using 'files' driver.
INFO - 2025-11-05 18:09:55 --> Form Validation Class Initialized
INFO - 2025-11-05 18:09:55 --> Controller Class Initialized
DEBUG - 2025-11-05 18:09:55 --> Session class already loaded. Second attempt ignored.
DEBUG - 2025-11-05 18:09:55 --> MY_Controller - Role: administrator
DEBUG - 2025-11-05 18:09:55 --> MY_Controller - Is Admin: true
DEBUG - 2025-11-05 18:09:55 --> MY_Controller - Permissions: Array
(
)

INFO - 2025-11-05 18:09:55 --> Model Class Initialized
INFO - 2025-11-05 18:09:55 --> Model Class Initialized
INFO - 2025-11-05 18:09:55 --> Model Class Initialized
INFO - 2025-11-05 18:09:55 --> Model Class Initialized
INFO - 2025-11-05 18:09:55 --> Model Class Initialized
INFO - 2025-11-05 18:09:55 --> Model Class Initialized
DEBUG - 2025-11-05 18:09:55 --> Controller_Reports initialized
DEBUG - 2025-11-05 18:09:55 --> === SALES REPORT DEBUG START ===
DEBUG - 2025-11-05 18:09:55 --> Filters received: {"date_from":"2025-11-01","date_to":"2025-11-05","warehouse":"","status":"1,2"}
DEBUG - 2025-11-05 18:09:55 --> Available tables: accounts, activity_log, attribute_value, attributes, brands, cash_accounts, categories, chart_of_accounts, company, company_expenses, customer_invoices, customer_payments, groups, journal_entries, journal_lines, orders, orders_item, products, purchases, quotation_items, quotations, stores, supplier_invoices, supplier_payments, user_group, users
DEBUG - 2025-11-05 18:09:55 --> date_from: 2025-11-01
DEBUG - 2025-11-05 18:09:55 --> date_to: 2025-11-05
DEBUG - 2025-11-05 18:09:55 --> warehouse: 
DEBUG - 2025-11-05 18:09:55 --> status: 1,2
DEBUG - 2025-11-05 18:09:55 --> Applied date_from: 2025-11-01
DEBUG - 2025-11-05 18:09:55 --> Applied date_to: 2025-11-05
DEBUG - 2025-11-05 18:09:55 --> Applied status: 1,2
DEBUG - 2025-11-05 18:09:55 --> Generated SQL: SELECT `o`.`id` AS `order_id`, `o`.`date_time`, `o`.`amount_paid`, `o`.`paid_status`, `o`.`store_id`, `oi`.`qty` AS `quantity`, `oi`.`rate` AS `price`, `oi`.`amount` AS `amount`, `p`.`name` AS `product_name`, `p`.`id` AS `product_id`, COALESCE(o.customer_name, "Walk-in") AS customer_name
FROM `orders` `o`
INNER JOIN `orders_item` `oi` ON `o`.`id` = `oi`.`order_id`
LEFT JOIN `products` `p` ON `oi`.`product_id` = `p`.`id`
WHERE DATE(o.date_time) >= '2025-11-01'
AND DATE(o.date_time) <= '2025-11-05'
AND `o`.`paid_status` IN('1', '2')
DEBUG - 2025-11-05 18:09:55 --> Query returned 273 rows
DEBUG - 2025-11-05 18:09:55 --> === SALES REPORT DEBUG END ===
DEBUG - 2025-11-05 18:09:55 --> Controller_Reports::sales_report rows fetched: 273
INFO - 2025-11-05 18:09:55 --> File loaded: C:\xampp\htdocs\Inventory_CI\application\views\templates/header.php
INFO - 2025-11-05 18:09:55 --> File loaded: C:\xampp\htdocs\Inventory_CI\application\views\templates/header_menu.php
INFO - 2025-11-05 18:09:55 --> File loaded: C:\xampp\htdocs\Inventory_CI\application\views\templates/side_menubar.php
INFO - 2025-11-05 18:09:56 --> File loaded: C:\xampp\htdocs\Inventory_CI\application\views\reporting/sales_report.php
INFO - 2025-11-05 18:09:56 --> File loaded: C:\xampp\htdocs\Inventory_CI\application\views\templates/footer.php
INFO - 2025-11-05 18:09:56 --> Final output sent to browser
DEBUG - 2025-11-05 18:09:56 --> Total execution time: 1.1724
INFO - 2025-11-05 18:10:24 --> Config Class Initialized
INFO - 2025-11-05 18:10:24 --> Hooks Class Initialized
DEBUG - 2025-11-05 18:10:24 --> UTF-8 Support Enabled
INFO - 2025-11-05 18:10:24 --> Utf8 Class Initialized
INFO - 2025-11-05 18:10:24 --> URI Class Initialized
INFO - 2025-11-05 18:10:24 --> Router Class Initialized
INFO - 2025-11-05 18:10:24 --> Output Class Initialized
INFO - 2025-11-05 18:10:24 --> Security Class Initialized
DEBUG - 2025-11-05 18:10:24 --> Global POST, GET and COOKIE data sanitized
INFO - 2025-11-05 18:10:24 --> Input Class Initialized
INFO - 2025-11-05 18:10:24 --> Language Class Initialized
INFO - 2025-11-05 18:10:24 --> Loader Class Initialized
INFO - 2025-11-05 18:10:24 --> Helper loaded: url_helper
INFO - 2025-11-05 18:10:24 --> Helper loaded: form_helper
INFO - 2025-11-05 18:10:24 --> Database Driver Class Initialized
DEBUG - 2025-11-05 18:10:24 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
INFO - 2025-11-05 18:10:24 --> Session: Class initialized using 'files' driver.
INFO - 2025-11-05 18:10:24 --> Form Validation Class Initialized
INFO - 2025-11-05 18:10:24 --> Controller Class Initialized
DEBUG - 2025-11-05 18:10:24 --> Session class already loaded. Second attempt ignored.
DEBUG - 2025-11-05 18:10:24 --> MY_Controller - Role: administrator
DEBUG - 2025-11-05 18:10:24 --> MY_Controller - Is Admin: true
DEBUG - 2025-11-05 18:10:24 --> MY_Controller - Permissions: Array
(
)

INFO - 2025-11-05 18:10:24 --> Model Class Initialized
INFO - 2025-11-05 18:10:24 --> Model Class Initialized
INFO - 2025-11-05 18:10:24 --> Model Class Initialized
INFO - 2025-11-05 18:10:24 --> Model Class Initialized
INFO - 2025-11-05 18:10:24 --> Model Class Initialized
INFO - 2025-11-05 18:10:24 --> Model Class Initialized
DEBUG - 2025-11-05 18:10:24 --> Controller_Reports initialized
DEBUG - 2025-11-05 18:10:24 --> === SALES REPORT DEBUG START ===
DEBUG - 2025-11-05 18:10:24 --> Filters received: {"date_from":"2025-11-04","date_to":"2025-11-05","warehouse":"","status":"1,2"}
DEBUG - 2025-11-05 18:10:24 --> Available tables: accounts, activity_log, attribute_value, attributes, brands, cash_accounts, categories, chart_of_accounts, company, company_expenses, customer_invoices, customer_payments, groups, journal_entries, journal_lines, orders, orders_item, products, purchases, quotation_items, quotations, stores, supplier_invoices, supplier_payments, user_group, users
DEBUG - 2025-11-05 18:10:24 --> date_from: 2025-11-04
DEBUG - 2025-11-05 18:10:24 --> date_to: 2025-11-05
DEBUG - 2025-11-05 18:10:24 --> warehouse: 
DEBUG - 2025-11-05 18:10:24 --> status: 1,2
DEBUG - 2025-11-05 18:10:24 --> Applied date_from: 2025-11-04
DEBUG - 2025-11-05 18:10:24 --> Applied date_to: 2025-11-05
DEBUG - 2025-11-05 18:10:24 --> Applied status: 1,2
DEBUG - 2025-11-05 18:10:24 --> Generated SQL: SELECT `o`.`id` AS `order_id`, `o`.`date_time`, `o`.`amount_paid`, `o`.`paid_status`, `o`.`store_id`, `oi`.`qty` AS `quantity`, `oi`.`rate` AS `price`, `oi`.`amount` AS `amount`, `p`.`name` AS `product_name`, `p`.`id` AS `product_id`, COALESCE(o.customer_name, "Walk-in") AS customer_name
FROM `orders` `o`
INNER JOIN `orders_item` `oi` ON `o`.`id` = `oi`.`order_id`
LEFT JOIN `products` `p` ON `oi`.`product_id` = `p`.`id`
WHERE DATE(o.date_time) >= '2025-11-04'
AND DATE(o.date_time) <= '2025-11-05'
AND `o`.`paid_status` IN('1', '2')
DEBUG - 2025-11-05 18:10:24 --> Query returned 157 rows
DEBUG - 2025-11-05 18:10:24 --> === SALES REPORT DEBUG END ===
DEBUG - 2025-11-05 18:10:24 --> Controller_Reports::sales_report rows fetched: 157
INFO - 2025-11-05 18:10:24 --> File loaded: C:\xampp\htdocs\Inventory_CI\application\views\templates/header.php
INFO - 2025-11-05 18:10:24 --> File loaded: C:\xampp\htdocs\Inventory_CI\application\views\templates/header_menu.php
INFO - 2025-11-05 18:10:24 --> File loaded: C:\xampp\htdocs\Inventory_CI\application\views\templates/side_menubar.php
INFO - 2025-11-05 18:10:24 --> File loaded: C:\xampp\htdocs\Inventory_CI\application\views\reporting/sales_report.php
INFO - 2025-11-05 18:10:24 --> File loaded: C:\xampp\htdocs\Inventory_CI\application\views\templates/footer.php
INFO - 2025-11-05 18:10:24 --> Final output sent to browser
DEBUG - 2025-11-05 18:10:24 --> Total execution time: 0.2429
INFO - 2025-11-05 18:11:23 --> Config Class Initialized
INFO - 2025-11-05 18:11:23 --> Hooks Class Initialized
DEBUG - 2025-11-05 18:11:23 --> UTF-8 Support Enabled
INFO - 2025-11-05 18:11:23 --> Utf8 Class Initialized
INFO - 2025-11-05 18:11:23 --> URI Class Initialized
INFO - 2025-11-05 18:11:23 --> Router Class Initialized
INFO - 2025-11-05 18:11:23 --> Output Class Initialized
INFO - 2025-11-05 18:11:23 --> Security Class Initialized
DEBUG - 2025-11-05 18:11:23 --> Global POST, GET and COOKIE data sanitized
INFO - 2025-11-05 18:11:23 --> Input Class Initialized
INFO - 2025-11-05 18:11:23 --> Language Class Initialized
INFO - 2025-11-05 18:11:23 --> Loader Class Initialized
INFO - 2025-11-05 18:11:23 --> Helper loaded: url_helper
INFO - 2025-11-05 18:11:23 --> Helper loaded: form_helper
INFO - 2025-11-05 18:11:23 --> Database Driver Class Initialized
DEBUG - 2025-11-05 18:11:23 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
INFO - 2025-11-05 18:11:23 --> Session: Class initialized using 'files' driver.
INFO - 2025-11-05 18:11:23 --> Form Validation Class Initialized
INFO - 2025-11-05 18:11:23 --> Controller Class Initialized
DEBUG - 2025-11-05 18:11:23 --> Session class already loaded. Second attempt ignored.
DEBUG - 2025-11-05 18:11:23 --> MY_Controller - Role: administrator
DEBUG - 2025-11-05 18:11:23 --> MY_Controller - Is Admin: true
DEBUG - 2025-11-05 18:11:23 --> MY_Controller - Permissions: Array
(
)

INFO - 2025-11-05 18:11:23 --> Model Class Initialized
INFO - 2025-11-05 18:11:23 --> Model Class Initialized
INFO - 2025-11-05 18:11:23 --> Model Class Initialized
INFO - 2025-11-05 18:11:23 --> Model Class Initialized
INFO - 2025-11-05 18:11:23 --> Model Class Initialized
INFO - 2025-11-05 18:11:23 --> Model Class Initialized
DEBUG - 2025-11-05 18:11:23 --> Index loaded - Store: 7, Is Privileged: No
ERROR - 2025-11-05 18:11:23 --> Severity: Notice --> Undefined variable: page_title C:\xampp\htdocs\Inventory_CI\application\views\templates\header.php 7
INFO - 2025-11-05 18:11:23 --> File loaded: C:\xampp\htdocs\Inventory_CI\application\views\templates/header.php
INFO - 2025-11-05 18:11:23 --> File loaded: C:\xampp\htdocs\Inventory_CI\application\views\templates/header_menu.php
INFO - 2025-11-05 18:11:23 --> File loaded: C:\xampp\htdocs\Inventory_CI\application\views\templates/side_menubar.php
INFO - 2025-11-05 18:11:23 --> File loaded: C:\xampp\htdocs\Inventory_CI\application\views\orders/index.php
INFO - 2025-11-05 18:11:23 --> File loaded: C:\xampp\htdocs\Inventory_CI\application\views\templates/footer.php
INFO - 2025-11-05 18:11:23 --> Final output sent to browser
DEBUG - 2025-11-05 18:11:23 --> Total execution time: 0.2691
INFO - 2025-11-05 18:13:45 --> Config Class Initialized
INFO - 2025-11-05 18:13:45 --> Hooks Class Initialized
DEBUG - 2025-11-05 18:13:45 --> UTF-8 Support Enabled
INFO - 2025-11-05 18:13:45 --> Utf8 Class Initialized
INFO - 2025-11-05 18:13:45 --> URI Class Initialized
INFO - 2025-11-05 18:13:45 --> Router Class Initialized
INFO - 2025-11-05 18:13:45 --> Output Class Initialized
INFO - 2025-11-05 18:13:45 --> Security Class Initialized
DEBUG - 2025-11-05 18:13:45 --> Global POST, GET and COOKIE data sanitized
INFO - 2025-11-05 18:13:45 --> Input Class Initialized
INFO - 2025-11-05 18:13:45 --> Language Class Initialized
INFO - 2025-11-05 18:13:45 --> Loader Class Initialized
INFO - 2025-11-05 18:13:45 --> Helper loaded: url_helper
INFO - 2025-11-05 18:13:45 --> Helper loaded: form_helper
INFO - 2025-11-05 18:13:45 --> Database Driver Class Initialized
DEBUG - 2025-11-05 18:13:45 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
INFO - 2025-11-05 18:13:45 --> Session: Class initialized using 'files' driver.
INFO - 2025-11-05 18:13:45 --> Form Validation Class Initialized
INFO - 2025-11-05 18:13:45 --> Controller Class Initialized
DEBUG - 2025-11-05 18:13:45 --> Session class already loaded. Second attempt ignored.
DEBUG - 2025-11-05 18:13:45 --> MY_Controller - Role: administrator
DEBUG - 2025-11-05 18:13:45 --> MY_Controller - Is Admin: true
DEBUG - 2025-11-05 18:13:45 --> MY_Controller - Permissions: Array
(
)

INFO - 2025-11-05 18:13:45 --> Model Class Initialized
INFO - 2025-11-05 18:13:45 --> Model Class Initialized
INFO - 2025-11-05 18:13:45 --> Model Class Initialized
INFO - 2025-11-05 18:13:45 --> Model Class Initialized
INFO - 2025-11-05 18:13:45 --> Model Class Initialized
INFO - 2025-11-05 18:13:45 --> Model Class Initialized
DEBUG - 2025-11-05 18:13:45 --> fetchOrdersData - Store ID: 7, Group ID: , Is Privileged: No
DEBUG - 2025-11-05 18:13:45 --> Adding store restriction for store_id: 7
DEBUG - 2025-11-05 18:13:45 --> Executing query: SELECT o.*,
                    COALESCE(s.name, 'N/A') as store_name,
                    COALESCE(u.username, 'Unknown') as clerk_name
                    FROM orders o
                    LEFT JOIN stores s ON o.store_id = s.id
                    LEFT JOIN users u ON o.user_id = u.id WHERE o.store_id = '7' ORDER BY o.id DESC
DEBUG - 2025-11-05 18:13:45 --> Query returned 111 results
DEBUG - 2025-11-05 18:13:45 --> Found 111 orders for user
INFO - 2025-11-05 18:13:45 --> Final output sent to browser
DEBUG - 2025-11-05 18:13:45 --> Total execution time: 0.1412
INFO - 2025-11-05 18:15:26 --> Config Class Initialized
INFO - 2025-11-05 18:15:26 --> Hooks Class Initialized
DEBUG - 2025-11-05 18:15:26 --> UTF-8 Support Enabled
INFO - 2025-11-05 18:15:26 --> Utf8 Class Initialized
INFO - 2025-11-05 18:15:26 --> URI Class Initialized
INFO - 2025-11-05 18:15:26 --> Router Class Initialized
INFO - 2025-11-05 18:15:26 --> Output Class Initialized
INFO - 2025-11-05 18:15:26 --> Security Class Initialized
DEBUG - 2025-11-05 18:15:26 --> Global POST, GET and COOKIE data sanitized
INFO - 2025-11-05 18:15:27 --> Input Class Initialized
INFO - 2025-11-05 18:15:27 --> Language Class Initialized
INFO - 2025-11-05 18:15:27 --> Loader Class Initialized
INFO - 2025-11-05 18:15:27 --> Helper loaded: url_helper
INFO - 2025-11-05 18:15:27 --> Helper loaded: form_helper
INFO - 2025-11-05 18:15:27 --> Database Driver Class Initialized
DEBUG - 2025-11-05 18:15:27 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
INFO - 2025-11-05 18:15:27 --> Session: Class initialized using 'files' driver.
INFO - 2025-11-05 18:15:27 --> Form Validation Class Initialized
INFO - 2025-11-05 18:15:27 --> Controller Class Initialized
DEBUG - 2025-11-05 18:15:27 --> Session class already loaded. Second attempt ignored.
DEBUG - 2025-11-05 18:15:27 --> MY_Controller - Role: administrator
DEBUG - 2025-11-05 18:15:27 --> MY_Controller - Is Admin: true
DEBUG - 2025-11-05 18:15:27 --> MY_Controller - Permissions: Array
(
)

INFO - 2025-11-05 18:15:27 --> Model Class Initialized
INFO - 2025-11-05 18:15:27 --> Model Class Initialized
INFO - 2025-11-05 18:15:27 --> Model Class Initialized
INFO - 2025-11-05 18:15:27 --> Model Class Initialized
INFO - 2025-11-05 18:15:27 --> Model Class Initialized
INFO - 2025-11-05 18:15:27 --> Model Class Initialized
DEBUG - 2025-11-05 18:15:27 --> Controller_Reports initialized
DEBUG - 2025-11-05 18:15:27 --> === SALES REPORT DEBUG START ===
DEBUG - 2025-11-05 18:15:27 --> Filters received: {"date_from":"2025-10-06","date_to":"2025-11-05","warehouse":null,"status":"1,2"}
DEBUG - 2025-11-05 18:15:27 --> Available tables: accounts, activity_log, attribute_value, attributes, brands, cash_accounts, categories, chart_of_accounts, company, company_expenses, customer_invoices, customer_payments, groups, journal_entries, journal_lines, orders, orders_item, products, purchases, quotation_items, quotations, stores, supplier_invoices, supplier_payments, user_group, users
DEBUG - 2025-11-05 18:15:27 --> date_from: 2025-10-06
DEBUG - 2025-11-05 18:15:27 --> date_to: 2025-11-05
DEBUG - 2025-11-05 18:15:27 --> warehouse: not set
DEBUG - 2025-11-05 18:15:27 --> status: 1,2
DEBUG - 2025-11-05 18:15:27 --> Applied date_from: 2025-10-06
DEBUG - 2025-11-05 18:15:27 --> Applied date_to: 2025-11-05
DEBUG - 2025-11-05 18:15:27 --> Applied status: 1,2
DEBUG - 2025-11-05 18:15:27 --> Generated SQL: SELECT `o`.`id` AS `order_id`, `o`.`date_time`, `o`.`amount_paid`, `o`.`paid_status`, `o`.`store_id`, `oi`.`qty` AS `quantity`, `oi`.`rate` AS `price`, `oi`.`amount` AS `amount`, `p`.`name` AS `product_name`, `p`.`id` AS `product_id`, COALESCE(o.customer_name, "Walk-in") AS customer_name
FROM `orders` `o`
INNER JOIN `orders_item` `oi` ON `o`.`id` = `oi`.`order_id`
LEFT JOIN `products` `p` ON `oi`.`product_id` = `p`.`id`
WHERE DATE(o.date_time) >= '2025-10-06'
AND DATE(o.date_time) <= '2025-11-05'
AND `o`.`paid_status` IN('1', '2')
DEBUG - 2025-11-05 18:15:27 --> Query returned 273 rows
DEBUG - 2025-11-05 18:15:27 --> === SALES REPORT DEBUG END ===
DEBUG - 2025-11-05 18:15:27 --> Controller_Reports::sales_report rows fetched: 273
INFO - 2025-11-05 18:15:27 --> File loaded: C:\xampp\htdocs\Inventory_CI\application\views\templates/header.php
INFO - 2025-11-05 18:15:27 --> File loaded: C:\xampp\htdocs\Inventory_CI\application\views\templates/header_menu.php
INFO - 2025-11-05 18:15:27 --> File loaded: C:\xampp\htdocs\Inventory_CI\application\views\templates/side_menubar.php
INFO - 2025-11-05 18:15:28 --> File loaded: C:\xampp\htdocs\Inventory_CI\application\views\reporting/sales_report.php
INFO - 2025-11-05 18:15:28 --> File loaded: C:\xampp\htdocs\Inventory_CI\application\views\templates/footer.php
INFO - 2025-11-05 18:15:28 --> Final output sent to browser
DEBUG - 2025-11-05 18:15:28 --> Total execution time: 1.7707
INFO - 2025-11-05 18:15:51 --> Config Class Initialized
INFO - 2025-11-05 18:15:51 --> Hooks Class Initialized
DEBUG - 2025-11-05 18:15:51 --> UTF-8 Support Enabled
INFO - 2025-11-05 18:15:51 --> Utf8 Class Initialized
INFO - 2025-11-05 18:15:51 --> URI Class Initialized
INFO - 2025-11-05 18:15:51 --> Router Class Initialized
INFO - 2025-11-05 18:15:51 --> Output Class Initialized
INFO - 2025-11-05 18:15:51 --> Security Class Initialized
DEBUG - 2025-11-05 18:15:51 --> Global POST, GET and COOKIE data sanitized
INFO - 2025-11-05 18:15:51 --> Input Class Initialized
INFO - 2025-11-05 18:15:51 --> Language Class Initialized
INFO - 2025-11-05 18:15:51 --> Loader Class Initialized
INFO - 2025-11-05 18:15:51 --> Helper loaded: url_helper
INFO - 2025-11-05 18:15:51 --> Helper loaded: form_helper
INFO - 2025-11-05 18:15:51 --> Database Driver Class Initialized
DEBUG - 2025-11-05 18:15:51 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
INFO - 2025-11-05 18:15:51 --> Session: Class initialized using 'files' driver.
INFO - 2025-11-05 18:15:51 --> Form Validation Class Initialized
INFO - 2025-11-05 18:15:51 --> Controller Class Initialized
DEBUG - 2025-11-05 18:15:51 --> Session class already loaded. Second attempt ignored.
DEBUG - 2025-11-05 18:15:51 --> MY_Controller - Role: administrator
DEBUG - 2025-11-05 18:15:51 --> MY_Controller - Is Admin: true
DEBUG - 2025-11-05 18:15:51 --> MY_Controller - Permissions: Array
(
)

INFO - 2025-11-05 18:15:51 --> Model Class Initialized
INFO - 2025-11-05 18:15:51 --> Model Class Initialized
INFO - 2025-11-05 18:15:51 --> Model Class Initialized
INFO - 2025-11-05 18:15:51 --> Model Class Initialized
INFO - 2025-11-05 18:15:51 --> Model Class Initialized
INFO - 2025-11-05 18:15:51 --> Model Class Initialized
DEBUG - 2025-11-05 18:15:51 --> Controller_Reports initialized
DEBUG - 2025-11-05 18:15:51 --> === SALES REPORT DEBUG START ===
DEBUG - 2025-11-05 18:15:51 --> Filters received: {"date_from":"2025-10-06","date_to":"2025-11-05","warehouse":null,"status":"1,2"}
DEBUG - 2025-11-05 18:15:51 --> Available tables: accounts, activity_log, attribute_value, attributes, brands, cash_accounts, categories, chart_of_accounts, company, company_expenses, customer_invoices, customer_payments, groups, journal_entries, journal_lines, orders, orders_item, products, purchases, quotation_items, quotations, stores, supplier_invoices, supplier_payments, user_group, users
DEBUG - 2025-11-05 18:15:51 --> date_from: 2025-10-06
DEBUG - 2025-11-05 18:15:51 --> date_to: 2025-11-05
DEBUG - 2025-11-05 18:15:51 --> warehouse: not set
DEBUG - 2025-11-05 18:15:51 --> status: 1,2
DEBUG - 2025-11-05 18:15:51 --> Applied date_from: 2025-10-06
DEBUG - 2025-11-05 18:15:51 --> Applied date_to: 2025-11-05
DEBUG - 2025-11-05 18:15:51 --> Applied status: 1,2
DEBUG - 2025-11-05 18:15:51 --> Generated SQL: SELECT `o`.`id` AS `order_id`, `o`.`date_time`, `o`.`amount_paid`, `o`.`paid_status`, `o`.`store_id`, `oi`.`qty` AS `quantity`, `oi`.`rate` AS `price`, `oi`.`amount` AS `amount`, `p`.`name` AS `product_name`, `p`.`id` AS `product_id`, COALESCE(o.customer_name, "Walk-in") AS customer_name
FROM `orders` `o`
INNER JOIN `orders_item` `oi` ON `o`.`id` = `oi`.`order_id`
LEFT JOIN `products` `p` ON `oi`.`product_id` = `p`.`id`
WHERE DATE(o.date_time) >= '2025-10-06'
AND DATE(o.date_time) <= '2025-11-05'
AND `o`.`paid_status` IN('1', '2')
DEBUG - 2025-11-05 18:15:51 --> Query returned 273 rows
DEBUG - 2025-11-05 18:15:51 --> === SALES REPORT DEBUG END ===
DEBUG - 2025-11-05 18:15:51 --> Controller_Reports::sales_report rows fetched: 273
INFO - 2025-11-05 18:15:51 --> File loaded: C:\xampp\htdocs\Inventory_CI\application\views\templates/header.php
INFO - 2025-11-05 18:15:51 --> File loaded: C:\xampp\htdocs\Inventory_CI\application\views\templates/header_menu.php
INFO - 2025-11-05 18:15:51 --> File loaded: C:\xampp\htdocs\Inventory_CI\application\views\templates/side_menubar.php
INFO - 2025-11-05 18:15:52 --> File loaded: C:\xampp\htdocs\Inventory_CI\application\views\reporting/sales_report.php
INFO - 2025-11-05 18:15:52 --> File loaded: C:\xampp\htdocs\Inventory_CI\application\views\templates/footer.php
INFO - 2025-11-05 18:15:52 --> Final output sent to browser
DEBUG - 2025-11-05 18:15:52 --> Total execution time: 1.2766
INFO - 2025-11-05 18:16:20 --> Config Class Initialized
INFO - 2025-11-05 18:16:20 --> Hooks Class Initialized
DEBUG - 2025-11-05 18:16:20 --> UTF-8 Support Enabled
INFO - 2025-11-05 18:16:20 --> Utf8 Class Initialized
INFO - 2025-11-05 18:16:20 --> URI Class Initialized
INFO - 2025-11-05 18:16:20 --> Router Class Initialized
INFO - 2025-11-05 18:16:20 --> Output Class Initialized
INFO - 2025-11-05 18:16:20 --> Security Class Initialized
DEBUG - 2025-11-05 18:16:20 --> Global POST, GET and COOKIE data sanitized
INFO - 2025-11-05 18:16:20 --> Input Class Initialized
INFO - 2025-11-05 18:16:20 --> Language Class Initialized
INFO - 2025-11-05 18:16:20 --> Loader Class Initialized
INFO - 2025-11-05 18:16:20 --> Helper loaded: url_helper
INFO - 2025-11-05 18:16:20 --> Helper loaded: form_helper
INFO - 2025-11-05 18:16:20 --> Database Driver Class Initialized
DEBUG - 2025-11-05 18:16:20 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
INFO - 2025-11-05 18:16:20 --> Session: Class initialized using 'files' driver.
INFO - 2025-11-05 18:16:20 --> Form Validation Class Initialized
INFO - 2025-11-05 18:16:20 --> Controller Class Initialized
DEBUG - 2025-11-05 18:16:20 --> Session class already loaded. Second attempt ignored.
DEBUG - 2025-11-05 18:16:20 --> MY_Controller - Role: administrator
DEBUG - 2025-11-05 18:16:20 --> MY_Controller - Is Admin: true
DEBUG - 2025-11-05 18:16:20 --> MY_Controller - Permissions: Array
(
)

INFO - 2025-11-05 18:16:20 --> Model Class Initialized
INFO - 2025-11-05 18:16:20 --> Model Class Initialized
INFO - 2025-11-05 18:16:20 --> Model Class Initialized
INFO - 2025-11-05 18:16:20 --> Model Class Initialized
INFO - 2025-11-05 18:16:20 --> Model Class Initialized
INFO - 2025-11-05 18:16:20 --> Model Class Initialized
DEBUG - 2025-11-05 18:16:20 --> Controller_Reports initialized
DEBUG - 2025-11-05 18:16:20 --> === SALES REPORT DEBUG START ===
DEBUG - 2025-11-05 18:16:20 --> Filters received: {"date_from":"2025-10-06","date_to":"2025-11-05","warehouse":"","status":""}
DEBUG - 2025-11-05 18:16:20 --> Available tables: accounts, activity_log, attribute_value, attributes, brands, cash_accounts, categories, chart_of_accounts, company, company_expenses, customer_invoices, customer_payments, groups, journal_entries, journal_lines, orders, orders_item, products, purchases, quotation_items, quotations, stores, supplier_invoices, supplier_payments, user_group, users
DEBUG - 2025-11-05 18:16:20 --> date_from: 2025-10-06
DEBUG - 2025-11-05 18:16:20 --> date_to: 2025-11-05
DEBUG - 2025-11-05 18:16:20 --> warehouse: 
DEBUG - 2025-11-05 18:16:20 --> status: 
DEBUG - 2025-11-05 18:16:20 --> Applied date_from: 2025-10-06
DEBUG - 2025-11-05 18:16:20 --> Applied date_to: 2025-11-05
DEBUG - 2025-11-05 18:16:20 --> Generated SQL: SELECT `o`.`id` AS `order_id`, `o`.`date_time`, `o`.`amount_paid`, `o`.`paid_status`, `o`.`store_id`, `oi`.`qty` AS `quantity`, `oi`.`rate` AS `price`, `oi`.`amount` AS `amount`, `p`.`name` AS `product_name`, `p`.`id` AS `product_id`, COALESCE(o.customer_name, "Walk-in") AS customer_name
FROM `orders` `o`
INNER JOIN `orders_item` `oi` ON `o`.`id` = `oi`.`order_id`
LEFT JOIN `products` `p` ON `oi`.`product_id` = `p`.`id`
WHERE DATE(o.date_time) >= '2025-10-06'
AND DATE(o.date_time) <= '2025-11-05'
DEBUG - 2025-11-05 18:16:20 --> Query returned 273 rows
DEBUG - 2025-11-05 18:16:20 --> === SALES REPORT DEBUG END ===
DEBUG - 2025-11-05 18:16:20 --> Controller_Reports::sales_report rows fetched: 273
INFO - 2025-11-05 18:16:20 --> File loaded: C:\xampp\htdocs\Inventory_CI\application\views\templates/header.php
INFO - 2025-11-05 18:16:20 --> File loaded: C:\xampp\htdocs\Inventory_CI\application\views\templates/header_menu.php
INFO - 2025-11-05 18:16:20 --> File loaded: C:\xampp\htdocs\Inventory_CI\application\views\templates/side_menubar.php
INFO - 2025-11-05 18:16:20 --> File loaded: C:\xampp\htdocs\Inventory_CI\application\views\reporting/sales_report.php
INFO - 2025-11-05 18:16:20 --> File loaded: C:\xampp\htdocs\Inventory_CI\application\views\templates/footer.php
INFO - 2025-11-05 18:16:20 --> Final output sent to browser
DEBUG - 2025-11-05 18:16:20 --> Total execution time: 0.2005
INFO - 2025-11-05 18:20:32 --> Config Class Initialized
INFO - 2025-11-05 18:20:32 --> Hooks Class Initialized
DEBUG - 2025-11-05 18:20:32 --> UTF-8 Support Enabled
INFO - 2025-11-05 18:20:32 --> Utf8 Class Initialized
INFO - 2025-11-05 18:20:32 --> URI Class Initialized
INFO - 2025-11-05 18:20:32 --> Router Class Initialized
INFO - 2025-11-05 18:20:32 --> Output Class Initialized
INFO - 2025-11-05 18:20:32 --> Security Class Initialized
DEBUG - 2025-11-05 18:20:32 --> Global POST, GET and COOKIE data sanitized
INFO - 2025-11-05 18:20:32 --> Input Class Initialized
INFO - 2025-11-05 18:20:32 --> Language Class Initialized
INFO - 2025-11-05 18:20:32 --> Loader Class Initialized
INFO - 2025-11-05 18:20:32 --> Helper loaded: url_helper
INFO - 2025-11-05 18:20:32 --> Helper loaded: form_helper
INFO - 2025-11-05 18:20:32 --> Database Driver Class Initialized
DEBUG - 2025-11-05 18:20:32 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
INFO - 2025-11-05 18:20:32 --> Session: Class initialized using 'files' driver.
INFO - 2025-11-05 18:20:32 --> Form Validation Class Initialized
INFO - 2025-11-05 18:20:32 --> Controller Class Initialized
DEBUG - 2025-11-05 18:20:32 --> Session class already loaded. Second attempt ignored.
DEBUG - 2025-11-05 18:20:32 --> MY_Controller - Role: administrator
DEBUG - 2025-11-05 18:20:32 --> MY_Controller - Is Admin: true
DEBUG - 2025-11-05 18:20:32 --> MY_Controller - Permissions: Array
(
)

INFO - 2025-11-05 18:20:32 --> Model Class Initialized
INFO - 2025-11-05 18:20:32 --> Model Class Initialized
INFO - 2025-11-05 18:20:32 --> Model Class Initialized
INFO - 2025-11-05 18:20:32 --> Model Class Initialized
INFO - 2025-11-05 18:20:32 --> Model Class Initialized
INFO - 2025-11-05 18:20:32 --> Model Class Initialized
DEBUG - 2025-11-05 18:20:32 --> Controller_Reports initialized
INFO - 2025-11-05 18:20:32 --> Model Class Initialized
DEBUG - 2025-11-05 18:20:32 --> === SALES REPORT DEBUG START ===
DEBUG - 2025-11-05 18:20:32 --> Filters received: {"date_from":"2025-10-06","date_to":"2025-11-05","warehouse":"","status":""}
DEBUG - 2025-11-05 18:20:32 --> Available tables: accounts, activity_log, attribute_value, attributes, brands, cash_accounts, categories, chart_of_accounts, company, company_expenses, customer_invoices, customer_payments, groups, journal_entries, journal_lines, orders, orders_item, products, purchases, quotation_items, quotations, stores, supplier_invoices, supplier_payments, user_group, users
DEBUG - 2025-11-05 18:20:32 --> date_from: 2025-10-06
DEBUG - 2025-11-05 18:20:32 --> date_to: 2025-11-05
DEBUG - 2025-11-05 18:20:32 --> warehouse: 
DEBUG - 2025-11-05 18:20:32 --> status: 
DEBUG - 2025-11-05 18:20:32 --> Applied date_from: 2025-10-06
DEBUG - 2025-11-05 18:20:32 --> Applied date_to: 2025-11-05
DEBUG - 2025-11-05 18:20:32 --> Generated SQL: SELECT `o`.`id` AS `order_id`, `o`.`date_time`, `o`.`amount_paid`, `o`.`paid_status`, `o`.`store_id`, `oi`.`qty` AS `quantity`, `oi`.`rate` AS `price`, `oi`.`amount` AS `amount`, `p`.`name` AS `product_name`, `p`.`id` AS `product_id`, COALESCE(o.customer_name, "Walk-in") AS customer_name
FROM `orders` `o`
INNER JOIN `orders_item` `oi` ON `o`.`id` = `oi`.`order_id`
LEFT JOIN `products` `p` ON `oi`.`product_id` = `p`.`id`
WHERE DATE(o.date_time) >= '2025-10-06'
AND DATE(o.date_time) <= '2025-11-05'
DEBUG - 2025-11-05 18:20:32 --> Query returned 273 rows
DEBUG - 2025-11-05 18:20:32 --> === SALES REPORT DEBUG END ===
DEBUG - 2025-11-05 18:20:32 --> Controller_Reports::sales_report rows fetched: 273
INFO - 2025-11-05 18:20:32 --> File loaded: C:\xampp\htdocs\Inventory_CI\application\views\templates/header.php
INFO - 2025-11-05 18:20:32 --> File loaded: C:\xampp\htdocs\Inventory_CI\application\views\templates/header_menu.php
INFO - 2025-11-05 18:20:32 --> File loaded: C:\xampp\htdocs\Inventory_CI\application\views\templates/side_menubar.php
INFO - 2025-11-05 18:20:33 --> File loaded: C:\xampp\htdocs\Inventory_CI\application\views\reporting/sales_report.php
INFO - 2025-11-05 18:20:33 --> File loaded: C:\xampp\htdocs\Inventory_CI\application\views\templates/footer.php
INFO - 2025-11-05 18:20:33 --> Final output sent to browser
DEBUG - 2025-11-05 18:20:33 --> Total execution time: 1.0433
INFO - 2025-11-05 18:20:40 --> Config Class Initialized
INFO - 2025-11-05 18:20:40 --> Hooks Class Initialized
DEBUG - 2025-11-05 18:20:40 --> UTF-8 Support Enabled
INFO - 2025-11-05 18:20:40 --> Utf8 Class Initialized
INFO - 2025-11-05 18:20:40 --> URI Class Initialized
INFO - 2025-11-05 18:20:40 --> Router Class Initialized
INFO - 2025-11-05 18:20:40 --> Output Class Initialized
INFO - 2025-11-05 18:20:40 --> Security Class Initialized
DEBUG - 2025-11-05 18:20:40 --> Global POST, GET and COOKIE data sanitized
INFO - 2025-11-05 18:20:40 --> Input Class Initialized
INFO - 2025-11-05 18:20:41 --> Language Class Initialized
INFO - 2025-11-05 18:20:41 --> Loader Class Initialized
INFO - 2025-11-05 18:20:41 --> Helper loaded: url_helper
INFO - 2025-11-05 18:20:41 --> Helper loaded: form_helper
INFO - 2025-11-05 18:20:41 --> Database Driver Class Initialized
DEBUG - 2025-11-05 18:20:41 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
INFO - 2025-11-05 18:20:41 --> Session: Class initialized using 'files' driver.
INFO - 2025-11-05 18:20:41 --> Form Validation Class Initialized
INFO - 2025-11-05 18:20:41 --> Controller Class Initialized
DEBUG - 2025-11-05 18:20:41 --> Session class already loaded. Second attempt ignored.
DEBUG - 2025-11-05 18:20:41 --> MY_Controller - Role: administrator
DEBUG - 2025-11-05 18:20:41 --> MY_Controller - Is Admin: true
DEBUG - 2025-11-05 18:20:41 --> MY_Controller - Permissions: Array
(
)

INFO - 2025-11-05 18:20:41 --> Model Class Initialized
INFO - 2025-11-05 18:20:41 --> Model Class Initialized
INFO - 2025-11-05 18:20:41 --> Model Class Initialized
INFO - 2025-11-05 18:20:41 --> Model Class Initialized
INFO - 2025-11-05 18:20:41 --> Model Class Initialized
INFO - 2025-11-05 18:20:41 --> Model Class Initialized
DEBUG - 2025-11-05 18:20:41 --> Controller_Reports initialized
INFO - 2025-11-05 18:20:41 --> Model Class Initialized
DEBUG - 2025-11-05 18:20:41 --> === SALES REPORT DEBUG START ===
DEBUG - 2025-11-05 18:20:41 --> Filters received: {"date_from":"2025-10-06","date_to":"2025-11-05","warehouse":"","status":""}
DEBUG - 2025-11-05 18:20:41 --> Available tables: accounts, activity_log, attribute_value, attributes, brands, cash_accounts, categories, chart_of_accounts, company, company_expenses, customer_invoices, customer_payments, groups, journal_entries, journal_lines, orders, orders_item, products, purchases, quotation_items, quotations, stores, supplier_invoices, supplier_payments, user_group, users
DEBUG - 2025-11-05 18:20:41 --> date_from: 2025-10-06
DEBUG - 2025-11-05 18:20:41 --> date_to: 2025-11-05
DEBUG - 2025-11-05 18:20:41 --> warehouse: 
DEBUG - 2025-11-05 18:20:41 --> status: 
DEBUG - 2025-11-05 18:20:41 --> Applied date_from: 2025-10-06
DEBUG - 2025-11-05 18:20:41 --> Applied date_to: 2025-11-05
DEBUG - 2025-11-05 18:20:41 --> Generated SQL: SELECT `o`.`id` AS `order_id`, `o`.`date_time`, `o`.`amount_paid`, `o`.`paid_status`, `o`.`store_id`, `oi`.`qty` AS `quantity`, `oi`.`rate` AS `price`, `oi`.`amount` AS `amount`, `p`.`name` AS `product_name`, `p`.`id` AS `product_id`, COALESCE(o.customer_name, "Walk-in") AS customer_name
FROM `orders` `o`
INNER JOIN `orders_item` `oi` ON `o`.`id` = `oi`.`order_id`
LEFT JOIN `products` `p` ON `oi`.`product_id` = `p`.`id`
WHERE DATE(o.date_time) >= '2025-10-06'
AND DATE(o.date_time) <= '2025-11-05'
DEBUG - 2025-11-05 18:20:41 --> Query returned 273 rows
DEBUG - 2025-11-05 18:20:41 --> === SALES REPORT DEBUG END ===
DEBUG - 2025-11-05 18:20:41 --> Controller_Reports::sales_report rows fetched: 273
INFO - 2025-11-05 18:20:41 --> File loaded: C:\xampp\htdocs\Inventory_CI\application\views\templates/header.php
INFO - 2025-11-05 18:20:41 --> File loaded: C:\xampp\htdocs\Inventory_CI\application\views\templates/header_menu.php
INFO - 2025-11-05 18:20:41 --> File loaded: C:\xampp\htdocs\Inventory_CI\application\views\templates/side_menubar.php
INFO - 2025-11-05 18:20:41 --> File loaded: C:\xampp\htdocs\Inventory_CI\application\views\reporting/sales_report.php
INFO - 2025-11-05 18:20:41 --> File loaded: C:\xampp\htdocs\Inventory_CI\application\views\templates/footer.php
INFO - 2025-11-05 18:20:41 --> Final output sent to browser
DEBUG - 2025-11-05 18:20:41 --> Total execution time: 0.2785
INFO - 2025-11-05 18:20:52 --> Config Class Initialized
INFO - 2025-11-05 18:20:52 --> Hooks Class Initialized
DEBUG - 2025-11-05 18:20:52 --> UTF-8 Support Enabled
INFO - 2025-11-05 18:20:52 --> Utf8 Class Initialized
INFO - 2025-11-05 18:20:52 --> URI Class Initialized
INFO - 2025-11-05 18:20:52 --> Router Class Initialized
INFO - 2025-11-05 18:20:52 --> Output Class Initialized
INFO - 2025-11-05 18:20:52 --> Security Class Initialized
DEBUG - 2025-11-05 18:20:52 --> Global POST, GET and COOKIE data sanitized
INFO - 2025-11-05 18:20:52 --> Input Class Initialized
INFO - 2025-11-05 18:20:52 --> Language Class Initialized
INFO - 2025-11-05 18:20:52 --> Loader Class Initialized
INFO - 2025-11-05 18:20:52 --> Helper loaded: url_helper
INFO - 2025-11-05 18:20:52 --> Helper loaded: form_helper
INFO - 2025-11-05 18:20:52 --> Database Driver Class Initialized
DEBUG - 2025-11-05 18:20:52 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
INFO - 2025-11-05 18:20:52 --> Session: Class initialized using 'files' driver.
INFO - 2025-11-05 18:20:52 --> Form Validation Class Initialized
INFO - 2025-11-05 18:20:52 --> Controller Class Initialized
DEBUG - 2025-11-05 18:20:52 --> Session class already loaded. Second attempt ignored.
DEBUG - 2025-11-05 18:20:52 --> MY_Controller - Role: administrator
DEBUG - 2025-11-05 18:20:52 --> MY_Controller - Is Admin: true
DEBUG - 2025-11-05 18:20:52 --> MY_Controller - Permissions: Array
(
)

INFO - 2025-11-05 18:20:52 --> Model Class Initialized
INFO - 2025-11-05 18:20:52 --> Model Class Initialized
INFO - 2025-11-05 18:20:52 --> Model Class Initialized
INFO - 2025-11-05 18:20:52 --> Model Class Initialized
INFO - 2025-11-05 18:20:52 --> Model Class Initialized
INFO - 2025-11-05 18:20:52 --> Model Class Initialized
DEBUG - 2025-11-05 18:20:52 --> Controller_Reports initialized
INFO - 2025-11-05 18:20:52 --> Model Class Initialized
DEBUG - 2025-11-05 18:20:52 --> === SALES REPORT DEBUG START ===
DEBUG - 2025-11-05 18:20:52 --> Filters received: {"date_from":"2025-10-06","date_to":"2025-11-05","warehouse":"8","status":""}
DEBUG - 2025-11-05 18:20:52 --> Available tables: accounts, activity_log, attribute_value, attributes, brands, cash_accounts, categories, chart_of_accounts, company, company_expenses, customer_invoices, customer_payments, groups, journal_entries, journal_lines, orders, orders_item, products, purchases, quotation_items, quotations, stores, supplier_invoices, supplier_payments, user_group, users
DEBUG - 2025-11-05 18:20:52 --> date_from: 2025-10-06
DEBUG - 2025-11-05 18:20:52 --> date_to: 2025-11-05
DEBUG - 2025-11-05 18:20:52 --> warehouse: 8
DEBUG - 2025-11-05 18:20:52 --> status: 
DEBUG - 2025-11-05 18:20:52 --> Applied date_from: 2025-10-06
DEBUG - 2025-11-05 18:20:52 --> Applied date_to: 2025-11-05
DEBUG - 2025-11-05 18:20:52 --> Applied warehouse filter (CAST): 8
DEBUG - 2025-11-05 18:20:52 --> Generated SQL: SELECT `o`.`id` AS `order_id`, `o`.`date_time`, `o`.`amount_paid`, `o`.`paid_status`, `o`.`store_id`, `oi`.`qty` AS `quantity`, `oi`.`rate` AS `price`, `oi`.`amount` AS `amount`, `p`.`name` AS `product_name`, `p`.`id` AS `product_id`, COALESCE(o.customer_name, "Walk-in") AS customer_name
FROM `orders` `o`
INNER JOIN `orders_item` `oi` ON `o`.`id` = `oi`.`order_id`
LEFT JOIN `products` `p` ON `oi`.`product_id` = `p`.`id`
WHERE DATE(o.date_time) >= '2025-10-06'
AND DATE(o.date_time) <= '2025-11-05'
AND CAST(o.store_id AS UNSIGNED) 8
ERROR - 2025-11-05 18:20:52 --> Query error: You have an error in your SQL syntax; check the manual that corresponds to your MariaDB server version for the right syntax to use near '8' at line 7 - Invalid query: SELECT `o`.`id` AS `order_id`, `o`.`date_time`, `o`.`amount_paid`, `o`.`paid_status`, `o`.`store_id`, `oi`.`qty` AS `quantity`, `oi`.`rate` AS `price`, `oi`.`amount` AS `amount`, `p`.`name` AS `product_name`, `p`.`id` AS `product_id`, COALESCE(o.customer_name, "Walk-in") AS customer_name
FROM `orders` `o`
INNER JOIN `orders_item` `oi` ON `o`.`id` = `oi`.`order_id`
LEFT JOIN `products` `p` ON `oi`.`product_id` = `p`.`id`
WHERE DATE(o.date_time) >= '2025-10-06'
AND DATE(o.date_time) <= '2025-11-05'
AND CAST(o.store_id AS UNSIGNED) 8
ERROR - 2025-11-05 18:20:52 --> Query failed: {"code":1064,"message":"You have an error in your SQL syntax; check the manual that corresponds to your MariaDB server version for the right syntax to use near '8' at line 7"}
DEBUG - 2025-11-05 18:20:52 --> Controller_Reports::sales_report rows fetched: 0
INFO - 2025-11-05 18:20:52 --> File loaded: C:\xampp\htdocs\Inventory_CI\application\views\templates/header.php
INFO - 2025-11-05 18:20:52 --> File loaded: C:\xampp\htdocs\Inventory_CI\application\views\templates/header_menu.php
INFO - 2025-11-05 18:20:52 --> File loaded: C:\xampp\htdocs\Inventory_CI\application\views\templates/side_menubar.php
INFO - 2025-11-05 18:20:52 --> File loaded: C:\xampp\htdocs\Inventory_CI\application\views\reporting/sales_report.php
INFO - 2025-11-05 18:20:52 --> File loaded: C:\xampp\htdocs\Inventory_CI\application\views\templates/footer.php
INFO - 2025-11-05 18:20:52 --> Final output sent to browser
DEBUG - 2025-11-05 18:20:52 --> Total execution time: 0.2578
INFO - 2025-11-05 18:21:02 --> Config Class Initialized
INFO - 2025-11-05 18:21:02 --> Hooks Class Initialized
DEBUG - 2025-11-05 18:21:02 --> UTF-8 Support Enabled
INFO - 2025-11-05 18:21:02 --> Utf8 Class Initialized
INFO - 2025-11-05 18:21:02 --> URI Class Initialized
INFO - 2025-11-05 18:21:02 --> Router Class Initialized
INFO - 2025-11-05 18:21:02 --> Output Class Initialized
INFO - 2025-11-05 18:21:02 --> Security Class Initialized
DEBUG - 2025-11-05 18:21:02 --> Global POST, GET and COOKIE data sanitized
INFO - 2025-11-05 18:21:02 --> Input Class Initialized
INFO - 2025-11-05 18:21:02 --> Language Class Initialized
INFO - 2025-11-05 18:21:02 --> Loader Class Initialized
INFO - 2025-11-05 18:21:02 --> Helper loaded: url_helper
INFO - 2025-11-05 18:21:02 --> Helper loaded: form_helper
INFO - 2025-11-05 18:21:02 --> Database Driver Class Initialized
DEBUG - 2025-11-05 18:21:03 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
INFO - 2025-11-05 18:21:03 --> Session: Class initialized using 'files' driver.
INFO - 2025-11-05 18:21:03 --> Form Validation Class Initialized
INFO - 2025-11-05 18:21:03 --> Controller Class Initialized
DEBUG - 2025-11-05 18:21:03 --> Session class already loaded. Second attempt ignored.
DEBUG - 2025-11-05 18:21:03 --> MY_Controller - Role: administrator
DEBUG - 2025-11-05 18:21:03 --> MY_Controller - Is Admin: true
DEBUG - 2025-11-05 18:21:03 --> MY_Controller - Permissions: Array
(
)

INFO - 2025-11-05 18:21:03 --> Model Class Initialized
INFO - 2025-11-05 18:21:03 --> Model Class Initialized
INFO - 2025-11-05 18:21:03 --> Model Class Initialized
INFO - 2025-11-05 18:21:03 --> Model Class Initialized
INFO - 2025-11-05 18:21:03 --> Model Class Initialized
INFO - 2025-11-05 18:21:03 --> Model Class Initialized
DEBUG - 2025-11-05 18:21:03 --> Controller_Reports initialized
INFO - 2025-11-05 18:21:03 --> Model Class Initialized
DEBUG - 2025-11-05 18:21:03 --> === SALES REPORT DEBUG START ===
DEBUG - 2025-11-05 18:21:03 --> Filters received: {"date_from":"2025-10-06","date_to":"2025-11-05","warehouse":"6","status":""}
DEBUG - 2025-11-05 18:21:03 --> Available tables: accounts, activity_log, attribute_value, attributes, brands, cash_accounts, categories, chart_of_accounts, company, company_expenses, customer_invoices, customer_payments, groups, journal_entries, journal_lines, orders, orders_item, products, purchases, quotation_items, quotations, stores, supplier_invoices, supplier_payments, user_group, users
DEBUG - 2025-11-05 18:21:03 --> date_from: 2025-10-06
DEBUG - 2025-11-05 18:21:03 --> date_to: 2025-11-05
DEBUG - 2025-11-05 18:21:03 --> warehouse: 6
DEBUG - 2025-11-05 18:21:03 --> status: 
DEBUG - 2025-11-05 18:21:03 --> Applied date_from: 2025-10-06
DEBUG - 2025-11-05 18:21:03 --> Applied date_to: 2025-11-05
DEBUG - 2025-11-05 18:21:03 --> Applied warehouse filter (CAST): 6
DEBUG - 2025-11-05 18:21:03 --> Generated SQL: SELECT `o`.`id` AS `order_id`, `o`.`date_time`, `o`.`amount_paid`, `o`.`paid_status`, `o`.`store_id`, `oi`.`qty` AS `quantity`, `oi`.`rate` AS `price`, `oi`.`amount` AS `amount`, `p`.`name` AS `product_name`, `p`.`id` AS `product_id`, COALESCE(o.customer_name, "Walk-in") AS customer_name
FROM `orders` `o`
INNER JOIN `orders_item` `oi` ON `o`.`id` = `oi`.`order_id`
LEFT JOIN `products` `p` ON `oi`.`product_id` = `p`.`id`
WHERE DATE(o.date_time) >= '2025-10-06'
AND DATE(o.date_time) <= '2025-11-05'
AND CAST(o.store_id AS UNSIGNED) 6
ERROR - 2025-11-05 18:21:03 --> Query error: You have an error in your SQL syntax; check the manual that corresponds to your MariaDB server version for the right syntax to use near '6' at line 7 - Invalid query: SELECT `o`.`id` AS `order_id`, `o`.`date_time`, `o`.`amount_paid`, `o`.`paid_status`, `o`.`store_id`, `oi`.`qty` AS `quantity`, `oi`.`rate` AS `price`, `oi`.`amount` AS `amount`, `p`.`name` AS `product_name`, `p`.`id` AS `product_id`, COALESCE(o.customer_name, "Walk-in") AS customer_name
FROM `orders` `o`
INNER JOIN `orders_item` `oi` ON `o`.`id` = `oi`.`order_id`
LEFT JOIN `products` `p` ON `oi`.`product_id` = `p`.`id`
WHERE DATE(o.date_time) >= '2025-10-06'
AND DATE(o.date_time) <= '2025-11-05'
AND CAST(o.store_id AS UNSIGNED) 6
ERROR - 2025-11-05 18:21:03 --> Query failed: {"code":1064,"message":"You have an error in your SQL syntax; check the manual that corresponds to your MariaDB server version for the right syntax to use near '6' at line 7"}
DEBUG - 2025-11-05 18:21:03 --> Controller_Reports::sales_report rows fetched: 0
INFO - 2025-11-05 18:21:03 --> File loaded: C:\xampp\htdocs\Inventory_CI\application\views\templates/header.php
INFO - 2025-11-05 18:21:03 --> File loaded: C:\xampp\htdocs\Inventory_CI\application\views\templates/header_menu.php
INFO - 2025-11-05 18:21:03 --> File loaded: C:\xampp\htdocs\Inventory_CI\application\views\templates/side_menubar.php
INFO - 2025-11-05 18:21:03 --> File loaded: C:\xampp\htdocs\Inventory_CI\application\views\reporting/sales_report.php
INFO - 2025-11-05 18:21:03 --> File loaded: C:\xampp\htdocs\Inventory_CI\application\views\templates/footer.php
INFO - 2025-11-05 18:21:03 --> Final output sent to browser
DEBUG - 2025-11-05 18:21:03 --> Total execution time: 0.2403
INFO - 2025-11-05 18:21:13 --> Config Class Initialized
INFO - 2025-11-05 18:21:13 --> Hooks Class Initialized
DEBUG - 2025-11-05 18:21:13 --> UTF-8 Support Enabled
INFO - 2025-11-05 18:21:13 --> Utf8 Class Initialized
INFO - 2025-11-05 18:21:13 --> URI Class Initialized
INFO - 2025-11-05 18:21:13 --> Router Class Initialized
INFO - 2025-11-05 18:21:13 --> Output Class Initialized
INFO - 2025-11-05 18:21:13 --> Security Class Initialized
DEBUG - 2025-11-05 18:21:13 --> Global POST, GET and COOKIE data sanitized
INFO - 2025-11-05 18:21:13 --> Input Class Initialized
INFO - 2025-11-05 18:21:13 --> Language Class Initialized
INFO - 2025-11-05 18:21:13 --> Loader Class Initialized
INFO - 2025-11-05 18:21:13 --> Helper loaded: url_helper
INFO - 2025-11-05 18:21:13 --> Helper loaded: form_helper
INFO - 2025-11-05 18:21:13 --> Database Driver Class Initialized
DEBUG - 2025-11-05 18:21:13 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
INFO - 2025-11-05 18:21:13 --> Session: Class initialized using 'files' driver.
INFO - 2025-11-05 18:21:13 --> Form Validation Class Initialized
INFO - 2025-11-05 18:21:13 --> Controller Class Initialized
DEBUG - 2025-11-05 18:21:13 --> Session class already loaded. Second attempt ignored.
DEBUG - 2025-11-05 18:21:13 --> MY_Controller - Role: administrator
DEBUG - 2025-11-05 18:21:13 --> MY_Controller - Is Admin: true
DEBUG - 2025-11-05 18:21:13 --> MY_Controller - Permissions: Array
(
)

INFO - 2025-11-05 18:21:13 --> Model Class Initialized
INFO - 2025-11-05 18:21:13 --> Model Class Initialized
INFO - 2025-11-05 18:21:13 --> Model Class Initialized
INFO - 2025-11-05 18:21:13 --> Model Class Initialized
INFO - 2025-11-05 18:21:13 --> Model Class Initialized
INFO - 2025-11-05 18:21:13 --> Model Class Initialized
DEBUG - 2025-11-05 18:21:13 --> Controller_Reports initialized
INFO - 2025-11-05 18:21:13 --> Model Class Initialized
DEBUG - 2025-11-05 18:21:13 --> === SALES REPORT DEBUG START ===
DEBUG - 2025-11-05 18:21:13 --> Filters received: {"date_from":"2025-10-06","date_to":"2025-11-05","warehouse":"7","status":""}
DEBUG - 2025-11-05 18:21:13 --> Available tables: accounts, activity_log, attribute_value, attributes, brands, cash_accounts, categories, chart_of_accounts, company, company_expenses, customer_invoices, customer_payments, groups, journal_entries, journal_lines, orders, orders_item, products, purchases, quotation_items, quotations, stores, supplier_invoices, supplier_payments, user_group, users
DEBUG - 2025-11-05 18:21:13 --> date_from: 2025-10-06
DEBUG - 2025-11-05 18:21:13 --> date_to: 2025-11-05
DEBUG - 2025-11-05 18:21:13 --> warehouse: 7
DEBUG - 2025-11-05 18:21:13 --> status: 
DEBUG - 2025-11-05 18:21:13 --> Applied date_from: 2025-10-06
DEBUG - 2025-11-05 18:21:13 --> Applied date_to: 2025-11-05
DEBUG - 2025-11-05 18:21:13 --> Applied warehouse filter (CAST): 7
DEBUG - 2025-11-05 18:21:13 --> Generated SQL: SELECT `o`.`id` AS `order_id`, `o`.`date_time`, `o`.`amount_paid`, `o`.`paid_status`, `o`.`store_id`, `oi`.`qty` AS `quantity`, `oi`.`rate` AS `price`, `oi`.`amount` AS `amount`, `p`.`name` AS `product_name`, `p`.`id` AS `product_id`, COALESCE(o.customer_name, "Walk-in") AS customer_name
FROM `orders` `o`
INNER JOIN `orders_item` `oi` ON `o`.`id` = `oi`.`order_id`
LEFT JOIN `products` `p` ON `oi`.`product_id` = `p`.`id`
WHERE DATE(o.date_time) >= '2025-10-06'
AND DATE(o.date_time) <= '2025-11-05'
AND CAST(o.store_id AS UNSIGNED) 7
ERROR - 2025-11-05 18:21:13 --> Query error: You have an error in your SQL syntax; check the manual that corresponds to your MariaDB server version for the right syntax to use near '7' at line 7 - Invalid query: SELECT `o`.`id` AS `order_id`, `o`.`date_time`, `o`.`amount_paid`, `o`.`paid_status`, `o`.`store_id`, `oi`.`qty` AS `quantity`, `oi`.`rate` AS `price`, `oi`.`amount` AS `amount`, `p`.`name` AS `product_name`, `p`.`id` AS `product_id`, COALESCE(o.customer_name, "Walk-in") AS customer_name
FROM `orders` `o`
INNER JOIN `orders_item` `oi` ON `o`.`id` = `oi`.`order_id`
LEFT JOIN `products` `p` ON `oi`.`product_id` = `p`.`id`
WHERE DATE(o.date_time) >= '2025-10-06'
AND DATE(o.date_time) <= '2025-11-05'
AND CAST(o.store_id AS UNSIGNED) 7
ERROR - 2025-11-05 18:21:13 --> Query failed: {"code":1064,"message":"You have an error in your SQL syntax; check the manual that corresponds to your MariaDB server version for the right syntax to use near '7' at line 7"}
DEBUG - 2025-11-05 18:21:13 --> Controller_Reports::sales_report rows fetched: 0
INFO - 2025-11-05 18:21:13 --> File loaded: C:\xampp\htdocs\Inventory_CI\application\views\templates/header.php
INFO - 2025-11-05 18:21:13 --> File loaded: C:\xampp\htdocs\Inventory_CI\application\views\templates/header_menu.php
INFO - 2025-11-05 18:21:13 --> File loaded: C:\xampp\htdocs\Inventory_CI\application\views\templates/side_menubar.php
INFO - 2025-11-05 18:21:13 --> File loaded: C:\xampp\htdocs\Inventory_CI\application\views\reporting/sales_report.php
INFO - 2025-11-05 18:21:13 --> File loaded: C:\xampp\htdocs\Inventory_CI\application\views\templates/footer.php
INFO - 2025-11-05 18:21:13 --> Final output sent to browser
DEBUG - 2025-11-05 18:21:13 --> Total execution time: 0.2594
INFO - 2025-11-05 18:21:39 --> Config Class Initialized
INFO - 2025-11-05 18:21:39 --> Hooks Class Initialized
DEBUG - 2025-11-05 18:21:39 --> UTF-8 Support Enabled
INFO - 2025-11-05 18:21:39 --> Utf8 Class Initialized
INFO - 2025-11-05 18:21:39 --> URI Class Initialized
INFO - 2025-11-05 18:21:39 --> Router Class Initialized
INFO - 2025-11-05 18:21:39 --> Output Class Initialized
INFO - 2025-11-05 18:21:39 --> Security Class Initialized
DEBUG - 2025-11-05 18:21:39 --> Global POST, GET and COOKIE data sanitized
INFO - 2025-11-05 18:21:39 --> Input Class Initialized
INFO - 2025-11-05 18:21:39 --> Language Class Initialized
INFO - 2025-11-05 18:21:39 --> Loader Class Initialized
INFO - 2025-11-05 18:21:39 --> Helper loaded: url_helper
INFO - 2025-11-05 18:21:39 --> Helper loaded: form_helper
INFO - 2025-11-05 18:21:39 --> Database Driver Class Initialized
DEBUG - 2025-11-05 18:21:39 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
INFO - 2025-11-05 18:21:39 --> Session: Class initialized using 'files' driver.
INFO - 2025-11-05 18:21:39 --> Form Validation Class Initialized
INFO - 2025-11-05 18:21:39 --> Controller Class Initialized
DEBUG - 2025-11-05 18:21:39 --> Session class already loaded. Second attempt ignored.
DEBUG - 2025-11-05 18:21:39 --> MY_Controller - Role: administrator
DEBUG - 2025-11-05 18:21:39 --> MY_Controller - Is Admin: true
DEBUG - 2025-11-05 18:21:39 --> MY_Controller - Permissions: Array
(
)

INFO - 2025-11-05 18:21:39 --> Model Class Initialized
INFO - 2025-11-05 18:21:39 --> Model Class Initialized
INFO - 2025-11-05 18:21:39 --> Model Class Initialized
INFO - 2025-11-05 18:21:39 --> Model Class Initialized
INFO - 2025-11-05 18:21:39 --> Model Class Initialized
INFO - 2025-11-05 18:21:39 --> Model Class Initialized
DEBUG - 2025-11-05 18:21:39 --> Controller_Reports initialized
INFO - 2025-11-05 18:21:39 --> Model Class Initialized
DEBUG - 2025-11-05 18:21:39 --> === SALES REPORT DEBUG START ===
DEBUG - 2025-11-05 18:21:39 --> Filters received: {"date_from":"2025-10-06","date_to":"2025-11-05","warehouse":"","status":""}
DEBUG - 2025-11-05 18:21:39 --> Available tables: accounts, activity_log, attribute_value, attributes, brands, cash_accounts, categories, chart_of_accounts, company, company_expenses, customer_invoices, customer_payments, groups, journal_entries, journal_lines, orders, orders_item, products, purchases, quotation_items, quotations, stores, supplier_invoices, supplier_payments, user_group, users
DEBUG - 2025-11-05 18:21:39 --> date_from: 2025-10-06
DEBUG - 2025-11-05 18:21:39 --> date_to: 2025-11-05
DEBUG - 2025-11-05 18:21:39 --> warehouse: 
DEBUG - 2025-11-05 18:21:39 --> status: 
DEBUG - 2025-11-05 18:21:39 --> Applied date_from: 2025-10-06
DEBUG - 2025-11-05 18:21:39 --> Applied date_to: 2025-11-05
DEBUG - 2025-11-05 18:21:39 --> Generated SQL: SELECT `o`.`id` AS `order_id`, `o`.`date_time`, `o`.`amount_paid`, `o`.`paid_status`, `o`.`store_id`, `oi`.`qty` AS `quantity`, `oi`.`rate` AS `price`, `oi`.`amount` AS `amount`, `p`.`name` AS `product_name`, `p`.`id` AS `product_id`, COALESCE(o.customer_name, "Walk-in") AS customer_name
FROM `orders` `o`
INNER JOIN `orders_item` `oi` ON `o`.`id` = `oi`.`order_id`
LEFT JOIN `products` `p` ON `oi`.`product_id` = `p`.`id`
WHERE DATE(o.date_time) >= '2025-10-06'
AND DATE(o.date_time) <= '2025-11-05'
DEBUG - 2025-11-05 18:21:39 --> Query returned 273 rows
DEBUG - 2025-11-05 18:21:39 --> === SALES REPORT DEBUG END ===
DEBUG - 2025-11-05 18:21:39 --> Controller_Reports::sales_report rows fetched: 273
INFO - 2025-11-05 18:21:39 --> File loaded: C:\xampp\htdocs\Inventory_CI\application\views\templates/header.php
INFO - 2025-11-05 18:21:39 --> File loaded: C:\xampp\htdocs\Inventory_CI\application\views\templates/header_menu.php
INFO - 2025-11-05 18:21:39 --> File loaded: C:\xampp\htdocs\Inventory_CI\application\views\templates/side_menubar.php
INFO - 2025-11-05 18:21:39 --> File loaded: C:\xampp\htdocs\Inventory_CI\application\views\reporting/sales_report.php
INFO - 2025-11-05 18:21:39 --> File loaded: C:\xampp\htdocs\Inventory_CI\application\views\templates/footer.php
INFO - 2025-11-05 18:21:39 --> Final output sent to browser
DEBUG - 2025-11-05 18:21:39 --> Total execution time: 0.2486
INFO - 2025-11-05 18:22:49 --> Config Class Initialized
INFO - 2025-11-05 18:22:49 --> Hooks Class Initialized
DEBUG - 2025-11-05 18:22:49 --> UTF-8 Support Enabled
INFO - 2025-11-05 18:22:49 --> Utf8 Class Initialized
INFO - 2025-11-05 18:22:49 --> URI Class Initialized
INFO - 2025-11-05 18:22:49 --> Router Class Initialized
INFO - 2025-11-05 18:22:49 --> Output Class Initialized
INFO - 2025-11-05 18:22:49 --> Security Class Initialized
DEBUG - 2025-11-05 18:22:49 --> Global POST, GET and COOKIE data sanitized
INFO - 2025-11-05 18:22:49 --> Input Class Initialized
INFO - 2025-11-05 18:22:49 --> Language Class Initialized
INFO - 2025-11-05 18:22:49 --> Loader Class Initialized
INFO - 2025-11-05 18:22:49 --> Helper loaded: url_helper
INFO - 2025-11-05 18:22:49 --> Helper loaded: form_helper
INFO - 2025-11-05 18:22:49 --> Database Driver Class Initialized
DEBUG - 2025-11-05 18:22:49 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
INFO - 2025-11-05 18:22:49 --> Session: Class initialized using 'files' driver.
INFO - 2025-11-05 18:22:49 --> Form Validation Class Initialized
INFO - 2025-11-05 18:22:49 --> Controller Class Initialized
DEBUG - 2025-11-05 18:22:49 --> Session class already loaded. Second attempt ignored.
DEBUG - 2025-11-05 18:22:49 --> MY_Controller - Role: administrator
DEBUG - 2025-11-05 18:22:49 --> MY_Controller - Is Admin: true
DEBUG - 2025-11-05 18:22:50 --> MY_Controller - Permissions: Array
(
)

INFO - 2025-11-05 18:22:50 --> Model Class Initialized
INFO - 2025-11-05 18:22:50 --> Model Class Initialized
INFO - 2025-11-05 18:22:50 --> Model Class Initialized
INFO - 2025-11-05 18:22:50 --> Model Class Initialized
INFO - 2025-11-05 18:22:50 --> Model Class Initialized
INFO - 2025-11-05 18:22:50 --> Model Class Initialized
DEBUG - 2025-11-05 18:22:50 --> Controller_Reports initialized
INFO - 2025-11-05 18:22:50 --> Model Class Initialized
DEBUG - 2025-11-05 18:22:50 --> === SALES REPORT DEBUG START ===
DEBUG - 2025-11-05 18:22:50 --> Filters received: {"date_from":"2025-10-06","date_to":"2025-11-05","warehouse":"7","status":""}
DEBUG - 2025-11-05 18:22:50 --> Available tables: accounts, activity_log, attribute_value, attributes, brands, cash_accounts, categories, chart_of_accounts, company, company_expenses, customer_invoices, customer_payments, groups, journal_entries, journal_lines, orders, orders_item, products, purchases, quotation_items, quotations, stores, supplier_invoices, supplier_payments, user_group, users
DEBUG - 2025-11-05 18:22:50 --> date_from: 2025-10-06
DEBUG - 2025-11-05 18:22:50 --> date_to: 2025-11-05
DEBUG - 2025-11-05 18:22:50 --> warehouse: 7
DEBUG - 2025-11-05 18:22:50 --> status: 
DEBUG - 2025-11-05 18:22:50 --> Applied date_from: 2025-10-06
DEBUG - 2025-11-05 18:22:50 --> Applied date_to: 2025-11-05
DEBUG - 2025-11-05 18:22:50 --> Applied warehouse filter (CAST): 7
DEBUG - 2025-11-05 18:22:50 --> Generated SQL: SELECT `o`.`id` AS `order_id`, `o`.`date_time`, `o`.`amount_paid`, `o`.`paid_status`, `o`.`store_id`, `oi`.`qty` AS `quantity`, `oi`.`rate` AS `price`, `oi`.`amount` AS `amount`, `p`.`name` AS `product_name`, `p`.`id` AS `product_id`, COALESCE(o.customer_name, "Walk-in") AS customer_name
FROM `orders` `o`
INNER JOIN `orders_item` `oi` ON `o`.`id` = `oi`.`order_id`
LEFT JOIN `products` `p` ON `oi`.`product_id` = `p`.`id`
WHERE DATE(o.date_time) >= '2025-10-06'
AND DATE(o.date_time) <= '2025-11-05'
AND CAST(o.store_id AS UNSIGNED) 7
ERROR - 2025-11-05 18:22:50 --> Query error: You have an error in your SQL syntax; check the manual that corresponds to your MariaDB server version for the right syntax to use near '7' at line 7 - Invalid query: SELECT `o`.`id` AS `order_id`, `o`.`date_time`, `o`.`amount_paid`, `o`.`paid_status`, `o`.`store_id`, `oi`.`qty` AS `quantity`, `oi`.`rate` AS `price`, `oi`.`amount` AS `amount`, `p`.`name` AS `product_name`, `p`.`id` AS `product_id`, COALESCE(o.customer_name, "Walk-in") AS customer_name
FROM `orders` `o`
INNER JOIN `orders_item` `oi` ON `o`.`id` = `oi`.`order_id`
LEFT JOIN `products` `p` ON `oi`.`product_id` = `p`.`id`
WHERE DATE(o.date_time) >= '2025-10-06'
AND DATE(o.date_time) <= '2025-11-05'
AND CAST(o.store_id AS UNSIGNED) 7
ERROR - 2025-11-05 18:22:50 --> Query failed: {"code":1064,"message":"You have an error in your SQL syntax; check the manual that corresponds to your MariaDB server version for the right syntax to use near '7' at line 7"}
DEBUG - 2025-11-05 18:22:50 --> Controller_Reports::sales_report rows fetched: 0
INFO - 2025-11-05 18:22:50 --> File loaded: C:\xampp\htdocs\Inventory_CI\application\views\templates/header.php
INFO - 2025-11-05 18:22:50 --> File loaded: C:\xampp\htdocs\Inventory_CI\application\views\templates/header_menu.php
INFO - 2025-11-05 18:22:50 --> File loaded: C:\xampp\htdocs\Inventory_CI\application\views\templates/side_menubar.php
INFO - 2025-11-05 18:22:50 --> File loaded: C:\xampp\htdocs\Inventory_CI\application\views\reporting/sales_report.php
INFO - 2025-11-05 18:22:50 --> File loaded: C:\xampp\htdocs\Inventory_CI\application\views\templates/footer.php
INFO - 2025-11-05 18:22:50 --> Final output sent to browser
DEBUG - 2025-11-05 18:22:50 --> Total execution time: 0.2535
INFO - 2025-11-05 18:27:09 --> Config Class Initialized
INFO - 2025-11-05 18:27:09 --> Hooks Class Initialized
DEBUG - 2025-11-05 18:27:09 --> UTF-8 Support Enabled
INFO - 2025-11-05 18:27:09 --> Utf8 Class Initialized
INFO - 2025-11-05 18:27:09 --> URI Class Initialized
INFO - 2025-11-05 18:27:09 --> Router Class Initialized
INFO - 2025-11-05 18:27:09 --> Output Class Initialized
INFO - 2025-11-05 18:27:09 --> Security Class Initialized
DEBUG - 2025-11-05 18:27:09 --> Global POST, GET and COOKIE data sanitized
INFO - 2025-11-05 18:27:09 --> Input Class Initialized
INFO - 2025-11-05 18:27:09 --> Language Class Initialized
INFO - 2025-11-05 18:27:09 --> Loader Class Initialized
INFO - 2025-11-05 18:27:09 --> Helper loaded: url_helper
INFO - 2025-11-05 18:27:09 --> Helper loaded: form_helper
INFO - 2025-11-05 18:27:09 --> Database Driver Class Initialized
DEBUG - 2025-11-05 18:27:09 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
INFO - 2025-11-05 18:27:09 --> Session: Class initialized using 'files' driver.
INFO - 2025-11-05 18:27:09 --> Form Validation Class Initialized
INFO - 2025-11-05 18:27:09 --> Controller Class Initialized
DEBUG - 2025-11-05 18:27:09 --> Session class already loaded. Second attempt ignored.
DEBUG - 2025-11-05 18:27:09 --> MY_Controller - Role: administrator
DEBUG - 2025-11-05 18:27:09 --> MY_Controller - Is Admin: true
DEBUG - 2025-11-05 18:27:09 --> MY_Controller - Permissions: Array
(
)

INFO - 2025-11-05 18:27:09 --> Model Class Initialized
INFO - 2025-11-05 18:27:09 --> Model Class Initialized
INFO - 2025-11-05 18:27:09 --> Model Class Initialized
INFO - 2025-11-05 18:27:09 --> Model Class Initialized
INFO - 2025-11-05 18:27:09 --> Model Class Initialized
INFO - 2025-11-05 18:27:09 --> Model Class Initialized
DEBUG - 2025-11-05 18:27:09 --> Controller_Reports initialized
INFO - 2025-11-05 18:27:09 --> Model Class Initialized
DEBUG - 2025-11-05 18:27:09 --> === SALES REPORT DEBUG START ===
DEBUG - 2025-11-05 18:27:09 --> Filters received: {"date_from":"2025-10-06","date_to":"2025-11-05","warehouse":"7","status":""}
DEBUG - 2025-11-05 18:27:09 --> Available tables: accounts, activity_log, attribute_value, attributes, brands, cash_accounts, categories, chart_of_accounts, company, company_expenses, customer_invoices, customer_payments, groups, journal_entries, journal_lines, orders, orders_item, products, purchases, quotation_items, quotations, stores, supplier_invoices, supplier_payments, user_group, users
DEBUG - 2025-11-05 18:27:09 --> date_from: 2025-10-06
DEBUG - 2025-11-05 18:27:09 --> date_to: 2025-11-05
DEBUG - 2025-11-05 18:27:09 --> warehouse: 7
DEBUG - 2025-11-05 18:27:09 --> status: 
DEBUG - 2025-11-05 18:27:09 --> Applied date_from: 2025-10-06
DEBUG - 2025-11-05 18:27:09 --> Applied date_to: 2025-11-05
DEBUG - 2025-11-05 18:27:09 --> Applied warehouse filter: 7
DEBUG - 2025-11-05 18:27:09 --> Generated SQL: SELECT `o`.`id` AS `order_id`, `o`.`date_time`, `o`.`amount_paid`, `o`.`paid_status`, `o`.`store_id`, `oi`.`qty` AS `quantity`, `oi`.`rate` AS `price`, `oi`.`amount` AS `amount`, `p`.`name` AS `product_name`, `p`.`id` AS `product_id`, COALESCE(o.customer_name, "Walk-in") AS customer_name
FROM `orders` `o`
INNER JOIN `orders_item` `oi` ON `o`.`id` = `oi`.`order_id`
LEFT JOIN `products` `p` ON `oi`.`product_id` = `p`.`id`
WHERE DATE(o.date_time) >= '2025-10-06'
AND DATE(o.date_time) <= '2025-11-05'
AND `o`.`store_id` = '7'
DEBUG - 2025-11-05 18:27:09 --> Query returned 273 rows
DEBUG - 2025-11-05 18:27:09 --> === SALES REPORT DEBUG END ===
DEBUG - 2025-11-05 18:27:09 --> Controller_Reports::sales_report rows fetched: 273
INFO - 2025-11-05 18:27:09 --> File loaded: C:\xampp\htdocs\Inventory_CI\application\views\templates/header.php
INFO - 2025-11-05 18:27:09 --> File loaded: C:\xampp\htdocs\Inventory_CI\application\views\templates/header_menu.php
INFO - 2025-11-05 18:27:09 --> File loaded: C:\xampp\htdocs\Inventory_CI\application\views\templates/side_menubar.php
INFO - 2025-11-05 18:27:10 --> File loaded: C:\xampp\htdocs\Inventory_CI\application\views\reporting/sales_report.php
INFO - 2025-11-05 18:27:10 --> File loaded: C:\xampp\htdocs\Inventory_CI\application\views\templates/footer.php
INFO - 2025-11-05 18:27:10 --> Final output sent to browser
DEBUG - 2025-11-05 18:27:10 --> Total execution time: 1.3988
INFO - 2025-11-05 18:27:25 --> Config Class Initialized
INFO - 2025-11-05 18:27:25 --> Hooks Class Initialized
DEBUG - 2025-11-05 18:27:25 --> UTF-8 Support Enabled
INFO - 2025-11-05 18:27:25 --> Utf8 Class Initialized
INFO - 2025-11-05 18:27:25 --> URI Class Initialized
INFO - 2025-11-05 18:27:25 --> Router Class Initialized
INFO - 2025-11-05 18:27:25 --> Output Class Initialized
INFO - 2025-11-05 18:27:25 --> Security Class Initialized
DEBUG - 2025-11-05 18:27:25 --> Global POST, GET and COOKIE data sanitized
INFO - 2025-11-05 18:27:25 --> Input Class Initialized
INFO - 2025-11-05 18:27:25 --> Language Class Initialized
INFO - 2025-11-05 18:27:25 --> Loader Class Initialized
INFO - 2025-11-05 18:27:25 --> Helper loaded: url_helper
INFO - 2025-11-05 18:27:25 --> Helper loaded: form_helper
INFO - 2025-11-05 18:27:25 --> Database Driver Class Initialized
DEBUG - 2025-11-05 18:27:25 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
INFO - 2025-11-05 18:27:25 --> Session: Class initialized using 'files' driver.
INFO - 2025-11-05 18:27:25 --> Form Validation Class Initialized
INFO - 2025-11-05 18:27:25 --> Controller Class Initialized
DEBUG - 2025-11-05 18:27:25 --> Session class already loaded. Second attempt ignored.
DEBUG - 2025-11-05 18:27:25 --> MY_Controller - Role: administrator
DEBUG - 2025-11-05 18:27:25 --> MY_Controller - Is Admin: true
DEBUG - 2025-11-05 18:27:25 --> MY_Controller - Permissions: Array
(
)

INFO - 2025-11-05 18:27:25 --> Model Class Initialized
INFO - 2025-11-05 18:27:25 --> Model Class Initialized
INFO - 2025-11-05 18:27:25 --> Model Class Initialized
INFO - 2025-11-05 18:27:25 --> Model Class Initialized
INFO - 2025-11-05 18:27:25 --> Model Class Initialized
INFO - 2025-11-05 18:27:25 --> Model Class Initialized
DEBUG - 2025-11-05 18:27:26 --> Controller_Reports initialized
INFO - 2025-11-05 18:27:26 --> Model Class Initialized
DEBUG - 2025-11-05 18:27:26 --> === SALES REPORT DEBUG START ===
DEBUG - 2025-11-05 18:27:26 --> Filters received: {"date_from":"2025-10-06","date_to":"2025-11-05","warehouse":"8","status":""}
DEBUG - 2025-11-05 18:27:26 --> Available tables: accounts, activity_log, attribute_value, attributes, brands, cash_accounts, categories, chart_of_accounts, company, company_expenses, customer_invoices, customer_payments, groups, journal_entries, journal_lines, orders, orders_item, products, purchases, quotation_items, quotations, stores, supplier_invoices, supplier_payments, user_group, users
DEBUG - 2025-11-05 18:27:26 --> date_from: 2025-10-06
DEBUG - 2025-11-05 18:27:26 --> date_to: 2025-11-05
DEBUG - 2025-11-05 18:27:26 --> warehouse: 8
DEBUG - 2025-11-05 18:27:26 --> status: 
DEBUG - 2025-11-05 18:27:26 --> Applied date_from: 2025-10-06
DEBUG - 2025-11-05 18:27:26 --> Applied date_to: 2025-11-05
DEBUG - 2025-11-05 18:27:26 --> Applied warehouse filter: 8
DEBUG - 2025-11-05 18:27:26 --> Generated SQL: SELECT `o`.`id` AS `order_id`, `o`.`date_time`, `o`.`amount_paid`, `o`.`paid_status`, `o`.`store_id`, `oi`.`qty` AS `quantity`, `oi`.`rate` AS `price`, `oi`.`amount` AS `amount`, `p`.`name` AS `product_name`, `p`.`id` AS `product_id`, COALESCE(o.customer_name, "Walk-in") AS customer_name
FROM `orders` `o`
INNER JOIN `orders_item` `oi` ON `o`.`id` = `oi`.`order_id`
LEFT JOIN `products` `p` ON `oi`.`product_id` = `p`.`id`
WHERE DATE(o.date_time) >= '2025-10-06'
AND DATE(o.date_time) <= '2025-11-05'
AND `o`.`store_id` = '8'
DEBUG - 2025-11-05 18:27:26 --> Query returned 0 rows
DEBUG - 2025-11-05 18:27:26 --> Total orders in DB: 111
DEBUG - 2025-11-05 18:27:26 --> Total order items in DB: 273
DEBUG - 2025-11-05 18:27:26 --> === SALES REPORT DEBUG END ===
DEBUG - 2025-11-05 18:27:26 --> Controller_Reports::sales_report rows fetched: 0
INFO - 2025-11-05 18:27:26 --> File loaded: C:\xampp\htdocs\Inventory_CI\application\views\templates/header.php
INFO - 2025-11-05 18:27:26 --> File loaded: C:\xampp\htdocs\Inventory_CI\application\views\templates/header_menu.php
INFO - 2025-11-05 18:27:26 --> File loaded: C:\xampp\htdocs\Inventory_CI\application\views\templates/side_menubar.php
INFO - 2025-11-05 18:27:26 --> File loaded: C:\xampp\htdocs\Inventory_CI\application\views\reporting/sales_report.php
INFO - 2025-11-05 18:27:26 --> File loaded: C:\xampp\htdocs\Inventory_CI\application\views\templates/footer.php
INFO - 2025-11-05 18:27:26 --> Final output sent to browser
DEBUG - 2025-11-05 18:27:26 --> Total execution time: 0.2903
INFO - 2025-11-05 18:27:36 --> Config Class Initialized
INFO - 2025-11-05 18:27:36 --> Hooks Class Initialized
DEBUG - 2025-11-05 18:27:36 --> UTF-8 Support Enabled
INFO - 2025-11-05 18:27:36 --> Utf8 Class Initialized
INFO - 2025-11-05 18:27:36 --> URI Class Initialized
INFO - 2025-11-05 18:27:36 --> Router Class Initialized
INFO - 2025-11-05 18:27:36 --> Output Class Initialized
INFO - 2025-11-05 18:27:36 --> Security Class Initialized
DEBUG - 2025-11-05 18:27:36 --> Global POST, GET and COOKIE data sanitized
INFO - 2025-11-05 18:27:36 --> Input Class Initialized
INFO - 2025-11-05 18:27:36 --> Language Class Initialized
INFO - 2025-11-05 18:27:36 --> Loader Class Initialized
INFO - 2025-11-05 18:27:36 --> Helper loaded: url_helper
INFO - 2025-11-05 18:27:36 --> Helper loaded: form_helper
INFO - 2025-11-05 18:27:36 --> Database Driver Class Initialized
DEBUG - 2025-11-05 18:27:36 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
INFO - 2025-11-05 18:27:36 --> Session: Class initialized using 'files' driver.
INFO - 2025-11-05 18:27:36 --> Form Validation Class Initialized
INFO - 2025-11-05 18:27:36 --> Controller Class Initialized
DEBUG - 2025-11-05 18:27:36 --> Session class already loaded. Second attempt ignored.
DEBUG - 2025-11-05 18:27:36 --> MY_Controller - Role: administrator
DEBUG - 2025-11-05 18:27:36 --> MY_Controller - Is Admin: true
DEBUG - 2025-11-05 18:27:36 --> MY_Controller - Permissions: Array
(
)

INFO - 2025-11-05 18:27:36 --> Model Class Initialized
INFO - 2025-11-05 18:27:36 --> Model Class Initialized
INFO - 2025-11-05 18:27:36 --> Model Class Initialized
INFO - 2025-11-05 18:27:36 --> Model Class Initialized
INFO - 2025-11-05 18:27:36 --> Model Class Initialized
INFO - 2025-11-05 18:27:36 --> Model Class Initialized
DEBUG - 2025-11-05 18:27:36 --> Controller_Reports initialized
INFO - 2025-11-05 18:27:36 --> Model Class Initialized
DEBUG - 2025-11-05 18:27:36 --> === SALES REPORT DEBUG START ===
DEBUG - 2025-11-05 18:27:36 --> Filters received: {"date_from":"2025-10-06","date_to":"2025-11-05","warehouse":"6","status":""}
DEBUG - 2025-11-05 18:27:36 --> Available tables: accounts, activity_log, attribute_value, attributes, brands, cash_accounts, categories, chart_of_accounts, company, company_expenses, customer_invoices, customer_payments, groups, journal_entries, journal_lines, orders, orders_item, products, purchases, quotation_items, quotations, stores, supplier_invoices, supplier_payments, user_group, users
DEBUG - 2025-11-05 18:27:36 --> date_from: 2025-10-06
DEBUG - 2025-11-05 18:27:36 --> date_to: 2025-11-05
DEBUG - 2025-11-05 18:27:36 --> warehouse: 6
DEBUG - 2025-11-05 18:27:36 --> status: 
DEBUG - 2025-11-05 18:27:36 --> Applied date_from: 2025-10-06
DEBUG - 2025-11-05 18:27:36 --> Applied date_to: 2025-11-05
DEBUG - 2025-11-05 18:27:36 --> Applied warehouse filter: 6
DEBUG - 2025-11-05 18:27:36 --> Generated SQL: SELECT `o`.`id` AS `order_id`, `o`.`date_time`, `o`.`amount_paid`, `o`.`paid_status`, `o`.`store_id`, `oi`.`qty` AS `quantity`, `oi`.`rate` AS `price`, `oi`.`amount` AS `amount`, `p`.`name` AS `product_name`, `p`.`id` AS `product_id`, COALESCE(o.customer_name, "Walk-in") AS customer_name
FROM `orders` `o`
INNER JOIN `orders_item` `oi` ON `o`.`id` = `oi`.`order_id`
LEFT JOIN `products` `p` ON `oi`.`product_id` = `p`.`id`
WHERE DATE(o.date_time) >= '2025-10-06'
AND DATE(o.date_time) <= '2025-11-05'
AND `o`.`store_id` = '6'
DEBUG - 2025-11-05 18:27:36 --> Query returned 0 rows
DEBUG - 2025-11-05 18:27:36 --> Total orders in DB: 111
DEBUG - 2025-11-05 18:27:36 --> Total order items in DB: 273
DEBUG - 2025-11-05 18:27:36 --> === SALES REPORT DEBUG END ===
DEBUG - 2025-11-05 18:27:36 --> Controller_Reports::sales_report rows fetched: 0
INFO - 2025-11-05 18:27:36 --> File loaded: C:\xampp\htdocs\Inventory_CI\application\views\templates/header.php
INFO - 2025-11-05 18:27:36 --> File loaded: C:\xampp\htdocs\Inventory_CI\application\views\templates/header_menu.php
INFO - 2025-11-05 18:27:36 --> File loaded: C:\xampp\htdocs\Inventory_CI\application\views\templates/side_menubar.php
INFO - 2025-11-05 18:27:36 --> File loaded: C:\xampp\htdocs\Inventory_CI\application\views\reporting/sales_report.php
INFO - 2025-11-05 18:27:36 --> File loaded: C:\xampp\htdocs\Inventory_CI\application\views\templates/footer.php
INFO - 2025-11-05 18:27:36 --> Final output sent to browser
DEBUG - 2025-11-05 18:27:36 --> Total execution time: 0.2613
INFO - 2025-11-05 18:27:55 --> Config Class Initialized
INFO - 2025-11-05 18:27:55 --> Hooks Class Initialized
DEBUG - 2025-11-05 18:27:55 --> UTF-8 Support Enabled
INFO - 2025-11-05 18:27:55 --> Utf8 Class Initialized
INFO - 2025-11-05 18:27:55 --> URI Class Initialized
INFO - 2025-11-05 18:27:55 --> Router Class Initialized
INFO - 2025-11-05 18:27:55 --> Output Class Initialized
INFO - 2025-11-05 18:27:55 --> Security Class Initialized
DEBUG - 2025-11-05 18:27:55 --> Global POST, GET and COOKIE data sanitized
INFO - 2025-11-05 18:27:55 --> Input Class Initialized
INFO - 2025-11-05 18:27:55 --> Language Class Initialized
INFO - 2025-11-05 18:27:55 --> Loader Class Initialized
INFO - 2025-11-05 18:27:55 --> Helper loaded: url_helper
INFO - 2025-11-05 18:27:55 --> Helper loaded: form_helper
INFO - 2025-11-05 18:27:55 --> Database Driver Class Initialized
DEBUG - 2025-11-05 18:27:55 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
INFO - 2025-11-05 18:27:55 --> Session: Class initialized using 'files' driver.
INFO - 2025-11-05 18:27:55 --> Form Validation Class Initialized
INFO - 2025-11-05 18:27:55 --> Controller Class Initialized
DEBUG - 2025-11-05 18:27:55 --> Session class already loaded. Second attempt ignored.
DEBUG - 2025-11-05 18:27:55 --> MY_Controller - Role: administrator
DEBUG - 2025-11-05 18:27:55 --> MY_Controller - Is Admin: true
DEBUG - 2025-11-05 18:27:55 --> MY_Controller - Permissions: Array
(
)

INFO - 2025-11-05 18:27:55 --> Model Class Initialized
INFO - 2025-11-05 18:27:56 --> Model Class Initialized
INFO - 2025-11-05 18:27:56 --> Model Class Initialized
INFO - 2025-11-05 18:27:56 --> Model Class Initialized
INFO - 2025-11-05 18:27:56 --> Model Class Initialized
INFO - 2025-11-05 18:27:56 --> Model Class Initialized
DEBUG - 2025-11-05 18:27:56 --> Controller_Reports initialized
INFO - 2025-11-05 18:27:56 --> Model Class Initialized
DEBUG - 2025-11-05 18:27:56 --> === SALES REPORT DEBUG START ===
DEBUG - 2025-11-05 18:27:56 --> Filters received: {"date_from":"2025-10-06","date_to":"2025-11-05","warehouse":"7","status":""}
DEBUG - 2025-11-05 18:27:56 --> Available tables: accounts, activity_log, attribute_value, attributes, brands, cash_accounts, categories, chart_of_accounts, company, company_expenses, customer_invoices, customer_payments, groups, journal_entries, journal_lines, orders, orders_item, products, purchases, quotation_items, quotations, stores, supplier_invoices, supplier_payments, user_group, users
DEBUG - 2025-11-05 18:27:56 --> date_from: 2025-10-06
DEBUG - 2025-11-05 18:27:56 --> date_to: 2025-11-05
DEBUG - 2025-11-05 18:27:56 --> warehouse: 7
DEBUG - 2025-11-05 18:27:56 --> status: 
DEBUG - 2025-11-05 18:27:56 --> Applied date_from: 2025-10-06
DEBUG - 2025-11-05 18:27:56 --> Applied date_to: 2025-11-05
DEBUG - 2025-11-05 18:27:56 --> Applied warehouse filter: 7
DEBUG - 2025-11-05 18:27:56 --> Generated SQL: SELECT `o`.`id` AS `order_id`, `o`.`date_time`, `o`.`amount_paid`, `o`.`paid_status`, `o`.`store_id`, `oi`.`qty` AS `quantity`, `oi`.`rate` AS `price`, `oi`.`amount` AS `amount`, `p`.`name` AS `product_name`, `p`.`id` AS `product_id`, COALESCE(o.customer_name, "Walk-in") AS customer_name
FROM `orders` `o`
INNER JOIN `orders_item` `oi` ON `o`.`id` = `oi`.`order_id`
LEFT JOIN `products` `p` ON `oi`.`product_id` = `p`.`id`
WHERE DATE(o.date_time) >= '2025-10-06'
AND DATE(o.date_time) <= '2025-11-05'
AND `o`.`store_id` = '7'
DEBUG - 2025-11-05 18:27:56 --> Query returned 273 rows
DEBUG - 2025-11-05 18:27:56 --> === SALES REPORT DEBUG END ===
DEBUG - 2025-11-05 18:27:56 --> Controller_Reports::sales_report rows fetched: 273
INFO - 2025-11-05 18:27:56 --> File loaded: C:\xampp\htdocs\Inventory_CI\application\views\templates/header.php
INFO - 2025-11-05 18:27:56 --> File loaded: C:\xampp\htdocs\Inventory_CI\application\views\templates/header_menu.php
INFO - 2025-11-05 18:27:56 --> File loaded: C:\xampp\htdocs\Inventory_CI\application\views\templates/side_menubar.php
INFO - 2025-11-05 18:27:56 --> File loaded: C:\xampp\htdocs\Inventory_CI\application\views\reporting/sales_report.php
INFO - 2025-11-05 18:27:56 --> File loaded: C:\xampp\htdocs\Inventory_CI\application\views\templates/footer.php
INFO - 2025-11-05 18:27:56 --> Final output sent to browser
DEBUG - 2025-11-05 18:27:56 --> Total execution time: 0.2835
INFO - 2025-11-05 18:30:18 --> Config Class Initialized
INFO - 2025-11-05 18:30:18 --> Hooks Class Initialized
DEBUG - 2025-11-05 18:30:18 --> UTF-8 Support Enabled
INFO - 2025-11-05 18:30:18 --> Utf8 Class Initialized
INFO - 2025-11-05 18:30:18 --> URI Class Initialized
INFO - 2025-11-05 18:30:18 --> Router Class Initialized
INFO - 2025-11-05 18:30:18 --> Output Class Initialized
INFO - 2025-11-05 18:30:18 --> Security Class Initialized
DEBUG - 2025-11-05 18:30:18 --> Global POST, GET and COOKIE data sanitized
INFO - 2025-11-05 18:30:18 --> Input Class Initialized
INFO - 2025-11-05 18:30:18 --> Language Class Initialized
INFO - 2025-11-05 18:30:18 --> Loader Class Initialized
INFO - 2025-11-05 18:30:18 --> Helper loaded: url_helper
INFO - 2025-11-05 18:30:18 --> Helper loaded: form_helper
INFO - 2025-11-05 18:30:18 --> Database Driver Class Initialized
DEBUG - 2025-11-05 18:30:18 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
INFO - 2025-11-05 18:30:18 --> Session: Class initialized using 'files' driver.
INFO - 2025-11-05 18:30:18 --> Form Validation Class Initialized
INFO - 2025-11-05 18:30:18 --> Controller Class Initialized
DEBUG - 2025-11-05 18:30:18 --> Session class already loaded. Second attempt ignored.
DEBUG - 2025-11-05 18:30:18 --> MY_Controller - Role: administrator
DEBUG - 2025-11-05 18:30:18 --> MY_Controller - Is Admin: true
DEBUG - 2025-11-05 18:30:18 --> MY_Controller - Permissions: Array
(
)

INFO - 2025-11-05 18:30:18 --> Model Class Initialized
INFO - 2025-11-05 18:30:18 --> Model Class Initialized
INFO - 2025-11-05 18:30:18 --> Model Class Initialized
INFO - 2025-11-05 18:30:18 --> Model Class Initialized
INFO - 2025-11-05 18:30:18 --> Model Class Initialized
INFO - 2025-11-05 18:30:18 --> Model Class Initialized
DEBUG - 2025-11-05 18:30:18 --> Controller_Reports initialized
INFO - 2025-11-05 18:30:18 --> Model Class Initialized
DEBUG - 2025-11-05 18:30:18 --> === SALES REPORT DEBUG START ===
DEBUG - 2025-11-05 18:30:18 --> Filters received: {"date_from":"2025-10-06","date_to":"2025-11-05","warehouse":"7","status":""}
DEBUG - 2025-11-05 18:30:18 --> Available tables: accounts, activity_log, attribute_value, attributes, brands, cash_accounts, categories, chart_of_accounts, company, company_expenses, customer_invoices, customer_payments, groups, journal_entries, journal_lines, orders, orders_item, products, purchases, quotation_items, quotations, stores, supplier_invoices, supplier_payments, user_group, users
DEBUG - 2025-11-05 18:30:18 --> date_from: 2025-10-06
DEBUG - 2025-11-05 18:30:18 --> date_to: 2025-11-05
DEBUG - 2025-11-05 18:30:18 --> warehouse: 7
DEBUG - 2025-11-05 18:30:18 --> status: 
DEBUG - 2025-11-05 18:30:18 --> Applied date_from: 2025-10-06
DEBUG - 2025-11-05 18:30:18 --> Applied date_to: 2025-11-05
DEBUG - 2025-11-05 18:30:18 --> Applied warehouse filter: 7
DEBUG - 2025-11-05 18:30:18 --> Generated SQL: SELECT `o`.`id` AS `order_id`, `o`.`date_time`, `o`.`amount_paid`, `o`.`paid_status`, `o`.`store_id`, `oi`.`qty` AS `quantity`, `oi`.`rate` AS `price`, `oi`.`amount` AS `amount`, `p`.`name` AS `product_name`, `p`.`id` AS `product_id`, COALESCE(o.customer_name, "Walk-in") AS customer_name
FROM `orders` `o`
INNER JOIN `orders_item` `oi` ON `o`.`id` = `oi`.`order_id`
LEFT JOIN `products` `p` ON `oi`.`product_id` = `p`.`id`
WHERE DATE(o.date_time) >= '2025-10-06'
AND DATE(o.date_time) <= '2025-11-05'
AND `o`.`store_id` = '7'
DEBUG - 2025-11-05 18:30:18 --> Query returned 273 rows
DEBUG - 2025-11-05 18:30:18 --> === SALES REPORT DEBUG END ===
DEBUG - 2025-11-05 18:30:18 --> Controller_Reports::sales_report rows fetched: 273
INFO - 2025-11-05 18:30:18 --> File loaded: C:\xampp\htdocs\Inventory_CI\application\views\templates/header.php
INFO - 2025-11-05 18:30:18 --> File loaded: C:\xampp\htdocs\Inventory_CI\application\views\templates/header_menu.php
INFO - 2025-11-05 18:30:18 --> File loaded: C:\xampp\htdocs\Inventory_CI\application\views\templates/side_menubar.php
INFO - 2025-11-05 18:30:19 --> File loaded: C:\xampp\htdocs\Inventory_CI\application\views\reporting/sales_report.php
INFO - 2025-11-05 18:30:19 --> File loaded: C:\xampp\htdocs\Inventory_CI\application\views\templates/footer.php
INFO - 2025-11-05 18:30:19 --> Final output sent to browser
DEBUG - 2025-11-05 18:30:19 --> Total execution time: 1.2454
INFO - 2025-11-05 18:31:14 --> Config Class Initialized
INFO - 2025-11-05 18:31:14 --> Hooks Class Initialized
DEBUG - 2025-11-05 18:31:14 --> UTF-8 Support Enabled
INFO - 2025-11-05 18:31:14 --> Utf8 Class Initialized
INFO - 2025-11-05 18:31:14 --> URI Class Initialized
INFO - 2025-11-05 18:31:14 --> Router Class Initialized
INFO - 2025-11-05 18:31:14 --> Output Class Initialized
INFO - 2025-11-05 18:31:14 --> Security Class Initialized
DEBUG - 2025-11-05 18:31:14 --> Global POST, GET and COOKIE data sanitized
INFO - 2025-11-05 18:31:14 --> Input Class Initialized
INFO - 2025-11-05 18:31:14 --> Language Class Initialized
INFO - 2025-11-05 18:31:14 --> Loader Class Initialized
INFO - 2025-11-05 18:31:14 --> Helper loaded: url_helper
INFO - 2025-11-05 18:31:14 --> Helper loaded: form_helper
INFO - 2025-11-05 18:31:14 --> Database Driver Class Initialized
DEBUG - 2025-11-05 18:31:14 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
INFO - 2025-11-05 18:31:14 --> Session: Class initialized using 'files' driver.
INFO - 2025-11-05 18:31:14 --> Form Validation Class Initialized
INFO - 2025-11-05 18:31:14 --> Controller Class Initialized
DEBUG - 2025-11-05 18:31:14 --> Session class already loaded. Second attempt ignored.
DEBUG - 2025-11-05 18:31:14 --> MY_Controller - Role: administrator
DEBUG - 2025-11-05 18:31:14 --> MY_Controller - Is Admin: true
DEBUG - 2025-11-05 18:31:14 --> MY_Controller - Permissions: Array
(
)

INFO - 2025-11-05 18:31:14 --> Model Class Initialized
INFO - 2025-11-05 18:31:14 --> Model Class Initialized
INFO - 2025-11-05 18:31:14 --> Model Class Initialized
INFO - 2025-11-05 18:31:14 --> Model Class Initialized
INFO - 2025-11-05 18:31:14 --> Model Class Initialized
INFO - 2025-11-05 18:31:14 --> Model Class Initialized
DEBUG - 2025-11-05 18:31:14 --> Controller_Reports initialized
INFO - 2025-11-05 18:31:14 --> Model Class Initialized
DEBUG - 2025-11-05 18:31:14 --> === SALES REPORT DEBUG START ===
DEBUG - 2025-11-05 18:31:14 --> Filters received: {"date_from":"2025-10-06","date_to":"2025-11-05","warehouse":"7","status":""}
DEBUG - 2025-11-05 18:31:14 --> Available tables: accounts, activity_log, attribute_value, attributes, brands, cash_accounts, categories, chart_of_accounts, company, company_expenses, customer_invoices, customer_payments, groups, journal_entries, journal_lines, orders, orders_item, products, purchases, quotation_items, quotations, stores, supplier_invoices, supplier_payments, user_group, users
DEBUG - 2025-11-05 18:31:14 --> date_from: 2025-10-06
DEBUG - 2025-11-05 18:31:14 --> date_to: 2025-11-05
DEBUG - 2025-11-05 18:31:14 --> warehouse: 7
DEBUG - 2025-11-05 18:31:14 --> status: 
DEBUG - 2025-11-05 18:31:14 --> Applied date_from: 2025-10-06
DEBUG - 2025-11-05 18:31:14 --> Applied date_to: 2025-11-05
DEBUG - 2025-11-05 18:31:14 --> Applied warehouse filter: 7
DEBUG - 2025-11-05 18:31:14 --> Generated SQL: SELECT `o`.`id` AS `order_id`, `o`.`date_time`, `o`.`amount_paid`, `o`.`paid_status`, `o`.`store_id`, `oi`.`qty` AS `quantity`, `oi`.`rate` AS `price`, `oi`.`amount` AS `amount`, `p`.`name` AS `product_name`, `p`.`id` AS `product_id`, COALESCE(o.customer_name, "Walk-in") AS customer_name
FROM `orders` `o`
INNER JOIN `orders_item` `oi` ON `o`.`id` = `oi`.`order_id`
LEFT JOIN `products` `p` ON `oi`.`product_id` = `p`.`id`
WHERE DATE(o.date_time) >= '2025-10-06'
AND DATE(o.date_time) <= '2025-11-05'
AND `o`.`store_id` = '7'
DEBUG - 2025-11-05 18:31:14 --> Query returned 273 rows
DEBUG - 2025-11-05 18:31:14 --> === SALES REPORT DEBUG END ===
DEBUG - 2025-11-05 18:31:14 --> Controller_Reports::sales_report rows fetched: 273
INFO - 2025-11-05 18:31:14 --> File loaded: C:\xampp\htdocs\Inventory_CI\application\views\templates/header.php
INFO - 2025-11-05 18:31:14 --> File loaded: C:\xampp\htdocs\Inventory_CI\application\views\templates/header_menu.php
INFO - 2025-11-05 18:31:14 --> File loaded: C:\xampp\htdocs\Inventory_CI\application\views\templates/side_menubar.php
INFO - 2025-11-05 18:31:14 --> File loaded: C:\xampp\htdocs\Inventory_CI\application\views\reporting/sales_report.php
INFO - 2025-11-05 18:31:14 --> File loaded: C:\xampp\htdocs\Inventory_CI\application\views\templates/footer.php
INFO - 2025-11-05 18:31:14 --> Final output sent to browser
DEBUG - 2025-11-05 18:31:14 --> Total execution time: 0.2651
INFO - 2025-11-05 19:21:21 --> Config Class Initialized
INFO - 2025-11-05 19:21:21 --> Hooks Class Initialized
DEBUG - 2025-11-05 19:21:21 --> UTF-8 Support Enabled
INFO - 2025-11-05 19:21:21 --> Utf8 Class Initialized
INFO - 2025-11-05 19:21:21 --> URI Class Initialized
INFO - 2025-11-05 19:21:21 --> Router Class Initialized
INFO - 2025-11-05 19:21:21 --> Output Class Initialized
INFO - 2025-11-05 19:21:21 --> Security Class Initialized
DEBUG - 2025-11-05 19:21:21 --> Global POST, GET and COOKIE data sanitized
INFO - 2025-11-05 19:21:21 --> Input Class Initialized
INFO - 2025-11-05 19:21:21 --> Language Class Initialized
INFO - 2025-11-05 19:21:21 --> Loader Class Initialized
INFO - 2025-11-05 19:21:21 --> Helper loaded: url_helper
INFO - 2025-11-05 19:21:21 --> Helper loaded: form_helper
INFO - 2025-11-05 19:21:21 --> Database Driver Class Initialized
DEBUG - 2025-11-05 19:21:21 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
INFO - 2025-11-05 19:21:21 --> Session: Class initialized using 'files' driver.
INFO - 2025-11-05 19:21:21 --> Form Validation Class Initialized
INFO - 2025-11-05 19:21:21 --> Controller Class Initialized
DEBUG - 2025-11-05 19:21:21 --> Session class already loaded. Second attempt ignored.
DEBUG - 2025-11-05 19:21:21 --> MY_Controller - Role: administrator
DEBUG - 2025-11-05 19:21:21 --> MY_Controller - Is Admin: true
DEBUG - 2025-11-05 19:21:21 --> MY_Controller - Permissions: Array
(
)

INFO - 2025-11-05 19:21:21 --> Model Class Initialized
INFO - 2025-11-05 19:21:21 --> Model Class Initialized
INFO - 2025-11-05 19:21:21 --> Model Class Initialized
INFO - 2025-11-05 19:21:21 --> Model Class Initialized
INFO - 2025-11-05 19:21:21 --> Model Class Initialized
INFO - 2025-11-05 19:21:22 --> Model Class Initialized
DEBUG - 2025-11-05 19:21:22 --> Controller_Reports initialized
INFO - 2025-11-05 19:21:22 --> Model Class Initialized
DEBUG - 2025-11-05 19:21:22 --> === SALES REPORT DEBUG START ===
DEBUG - 2025-11-05 19:21:22 --> Filters received: {"date_from":"2025-10-06","date_to":"2025-11-05","warehouse":"7","status":""}
DEBUG - 2025-11-05 19:21:22 --> Available tables: accounts, activity_log, attribute_value, attributes, brands, cash_accounts, categories, chart_of_accounts, company, company_expenses, customer_invoices, customer_payments, groups, journal_entries, journal_lines, orders, orders_item, products, purchases, quotation_items, quotations, stores, supplier_invoices, supplier_payments, user_group, users
DEBUG - 2025-11-05 19:21:22 --> date_from: 2025-10-06
DEBUG - 2025-11-05 19:21:22 --> date_to: 2025-11-05
DEBUG - 2025-11-05 19:21:22 --> warehouse: 7
DEBUG - 2025-11-05 19:21:22 --> status: 
DEBUG - 2025-11-05 19:21:22 --> Applied date_from: 2025-10-06
DEBUG - 2025-11-05 19:21:22 --> Applied date_to: 2025-11-05
DEBUG - 2025-11-05 19:21:22 --> Applied warehouse filter: 7
DEBUG - 2025-11-05 19:21:22 --> Generated SQL: SELECT `o`.`id` AS `order_id`, `o`.`date_time`, `o`.`amount_paid`, `o`.`paid_status`, `o`.`store_id`, `oi`.`qty` AS `quantity`, `oi`.`rate` AS `price`, `oi`.`amount` AS `amount`, `p`.`name` AS `product_name`, `p`.`id` AS `product_id`, COALESCE(o.customer_name, "Walk-in") AS customer_name
FROM `orders` `o`
INNER JOIN `orders_item` `oi` ON `o`.`id` = `oi`.`order_id`
LEFT JOIN `products` `p` ON `oi`.`product_id` = `p`.`id`
WHERE DATE(o.date_time) >= '2025-10-06'
AND DATE(o.date_time) <= '2025-11-05'
AND `o`.`store_id` = '7'
DEBUG - 2025-11-05 19:21:22 --> Query returned 273 rows
DEBUG - 2025-11-05 19:21:22 --> === SALES REPORT DEBUG END ===
DEBUG - 2025-11-05 19:21:22 --> Controller_Reports::sales_report rows fetched: 273
INFO - 2025-11-05 19:21:22 --> File loaded: C:\xampp\htdocs\Inventory_CI\application\views\templates/header.php
INFO - 2025-11-05 19:21:22 --> File loaded: C:\xampp\htdocs\Inventory_CI\application\views\templates/header_menu.php
INFO - 2025-11-05 19:21:22 --> File loaded: C:\xampp\htdocs\Inventory_CI\application\views\templates/side_menubar.php
INFO - 2025-11-05 19:21:22 --> File loaded: C:\xampp\htdocs\Inventory_CI\application\views\reporting/sales_report.php
INFO - 2025-11-05 19:21:22 --> File loaded: C:\xampp\htdocs\Inventory_CI\application\views\templates/footer.php
INFO - 2025-11-05 19:21:22 --> Final output sent to browser
DEBUG - 2025-11-05 19:21:22 --> Total execution time: 0.3544
INFO - 2025-11-05 19:22:31 --> Config Class Initialized
INFO - 2025-11-05 19:22:31 --> Hooks Class Initialized
DEBUG - 2025-11-05 19:22:31 --> UTF-8 Support Enabled
INFO - 2025-11-05 19:22:31 --> Utf8 Class Initialized
INFO - 2025-11-05 19:22:31 --> URI Class Initialized
INFO - 2025-11-05 19:22:31 --> Router Class Initialized
INFO - 2025-11-05 19:22:31 --> Output Class Initialized
INFO - 2025-11-05 19:22:31 --> Security Class Initialized
DEBUG - 2025-11-05 19:22:31 --> Global POST, GET and COOKIE data sanitized
INFO - 2025-11-05 19:22:31 --> Input Class Initialized
INFO - 2025-11-05 19:22:31 --> Language Class Initialized
INFO - 2025-11-05 19:22:31 --> Loader Class Initialized
INFO - 2025-11-05 19:22:31 --> Helper loaded: url_helper
INFO - 2025-11-05 19:22:31 --> Helper loaded: form_helper
INFO - 2025-11-05 19:22:31 --> Database Driver Class Initialized
DEBUG - 2025-11-05 19:22:31 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
INFO - 2025-11-05 19:22:31 --> Session: Class initialized using 'files' driver.
INFO - 2025-11-05 19:22:31 --> Form Validation Class Initialized
INFO - 2025-11-05 19:22:31 --> Controller Class Initialized
DEBUG - 2025-11-05 19:22:31 --> Session class already loaded. Second attempt ignored.
DEBUG - 2025-11-05 19:22:31 --> MY_Controller - Role: administrator
DEBUG - 2025-11-05 19:22:31 --> MY_Controller - Is Admin: true
DEBUG - 2025-11-05 19:22:31 --> MY_Controller - Permissions: Array
(
)

INFO - 2025-11-05 19:22:31 --> Model Class Initialized
INFO - 2025-11-05 19:22:31 --> Model Class Initialized
INFO - 2025-11-05 19:22:31 --> Model Class Initialized
INFO - 2025-11-05 19:22:31 --> Model Class Initialized
INFO - 2025-11-05 19:22:31 --> Model Class Initialized
INFO - 2025-11-05 19:22:31 --> Model Class Initialized
DEBUG - 2025-11-05 19:22:31 --> Controller_Reports initialized
INFO - 2025-11-05 19:22:31 --> Model Class Initialized
DEBUG - 2025-11-05 19:22:31 --> === SALES REPORT DEBUG START ===
DEBUG - 2025-11-05 19:22:31 --> Filters received: {"date_from":"2025-10-06","date_to":"2025-11-05","warehouse":"7","status":""}
DEBUG - 2025-11-05 19:22:31 --> Available tables: accounts, activity_log, attribute_value, attributes, brands, cash_accounts, categories, chart_of_accounts, company, company_expenses, customer_invoices, customer_payments, groups, journal_entries, journal_lines, orders, orders_item, products, purchases, quotation_items, quotations, stores, supplier_invoices, supplier_payments, user_group, users
DEBUG - 2025-11-05 19:22:31 --> date_from: 2025-10-06
DEBUG - 2025-11-05 19:22:31 --> date_to: 2025-11-05
DEBUG - 2025-11-05 19:22:31 --> warehouse: 7
DEBUG - 2025-11-05 19:22:31 --> status: 
DEBUG - 2025-11-05 19:22:31 --> Applied date_from: 2025-10-06
DEBUG - 2025-11-05 19:22:31 --> Applied date_to: 2025-11-05
DEBUG - 2025-11-05 19:22:31 --> Applied warehouse filter: 7
DEBUG - 2025-11-05 19:22:31 --> Generated SQL: SELECT `o`.`id` AS `order_id`, `o`.`date_time`, `o`.`amount_paid`, `o`.`paid_status`, `o`.`store_id`, `oi`.`qty` AS `quantity`, `oi`.`rate` AS `price`, `oi`.`amount` AS `amount`, `p`.`name` AS `product_name`, `p`.`id` AS `product_id`, COALESCE(o.customer_name, "Walk-in") AS customer_name
FROM `orders` `o`
INNER JOIN `orders_item` `oi` ON `o`.`id` = `oi`.`order_id`
LEFT JOIN `products` `p` ON `oi`.`product_id` = `p`.`id`
WHERE DATE(o.date_time) >= '2025-10-06'
AND DATE(o.date_time) <= '2025-11-05'
AND `o`.`store_id` = '7'
DEBUG - 2025-11-05 19:22:31 --> Query returned 273 rows
DEBUG - 2025-11-05 19:22:31 --> === SALES REPORT DEBUG END ===
DEBUG - 2025-11-05 19:22:31 --> Controller_Reports::sales_report rows fetched: 273
INFO - 2025-11-05 19:22:31 --> File loaded: C:\xampp\htdocs\Inventory_CI\application\views\templates/header.php
INFO - 2025-11-05 19:22:31 --> File loaded: C:\xampp\htdocs\Inventory_CI\application\views\templates/header_menu.php
INFO - 2025-11-05 19:22:31 --> File loaded: C:\xampp\htdocs\Inventory_CI\application\views\templates/side_menubar.php
INFO - 2025-11-05 19:22:32 --> File loaded: C:\xampp\htdocs\Inventory_CI\application\views\reporting/sales_report.php
INFO - 2025-11-05 19:22:32 --> File loaded: C:\xampp\htdocs\Inventory_CI\application\views\templates/footer.php
INFO - 2025-11-05 19:22:32 --> Final output sent to browser
DEBUG - 2025-11-05 19:22:32 --> Total execution time: 0.6772
INFO - 2025-11-05 19:23:42 --> Config Class Initialized
INFO - 2025-11-05 19:23:42 --> Hooks Class Initialized
DEBUG - 2025-11-05 19:23:42 --> UTF-8 Support Enabled
INFO - 2025-11-05 19:23:42 --> Utf8 Class Initialized
INFO - 2025-11-05 19:23:42 --> URI Class Initialized
INFO - 2025-11-05 19:23:42 --> Router Class Initialized
INFO - 2025-11-05 19:23:42 --> Output Class Initialized
INFO - 2025-11-05 19:23:42 --> Security Class Initialized
DEBUG - 2025-11-05 19:23:42 --> Global POST, GET and COOKIE data sanitized
INFO - 2025-11-05 19:23:42 --> Input Class Initialized
INFO - 2025-11-05 19:23:42 --> Language Class Initialized
INFO - 2025-11-05 19:23:42 --> Loader Class Initialized
INFO - 2025-11-05 19:23:42 --> Helper loaded: url_helper
INFO - 2025-11-05 19:23:42 --> Helper loaded: form_helper
INFO - 2025-11-05 19:23:42 --> Database Driver Class Initialized
DEBUG - 2025-11-05 19:23:42 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
INFO - 2025-11-05 19:23:42 --> Session: Class initialized using 'files' driver.
INFO - 2025-11-05 19:23:42 --> Form Validation Class Initialized
INFO - 2025-11-05 19:23:42 --> Controller Class Initialized
DEBUG - 2025-11-05 19:23:42 --> Session class already loaded. Second attempt ignored.
DEBUG - 2025-11-05 19:23:42 --> MY_Controller - Role: administrator
DEBUG - 2025-11-05 19:23:42 --> MY_Controller - Is Admin: true
DEBUG - 2025-11-05 19:23:42 --> MY_Controller - Permissions: Array
(
)

INFO - 2025-11-05 19:23:42 --> Model Class Initialized
INFO - 2025-11-05 19:23:42 --> Model Class Initialized
INFO - 2025-11-05 19:23:42 --> Model Class Initialized
INFO - 2025-11-05 19:23:42 --> Model Class Initialized
INFO - 2025-11-05 19:23:42 --> Model Class Initialized
INFO - 2025-11-05 19:23:42 --> Model Class Initialized
DEBUG - 2025-11-05 19:23:42 --> Controller_Reports initialized
INFO - 2025-11-05 19:23:42 --> Model Class Initialized
DEBUG - 2025-11-05 19:23:42 --> === SALES REPORT DEBUG START ===
DEBUG - 2025-11-05 19:23:42 --> Filters received: {"date_from":"2025-10-06","date_to":"2025-11-05","warehouse":"7","status":""}
DEBUG - 2025-11-05 19:23:42 --> Available tables: accounts, activity_log, attribute_value, attributes, brands, cash_accounts, categories, chart_of_accounts, company, company_expenses, customer_invoices, customer_payments, groups, journal_entries, journal_lines, orders, orders_item, products, purchases, quotation_items, quotations, stores, supplier_invoices, supplier_payments, user_group, users
DEBUG - 2025-11-05 19:23:42 --> date_from: 2025-10-06
DEBUG - 2025-11-05 19:23:42 --> date_to: 2025-11-05
DEBUG - 2025-11-05 19:23:42 --> warehouse: 7
DEBUG - 2025-11-05 19:23:42 --> status: 
DEBUG - 2025-11-05 19:23:42 --> Applied date_from: 2025-10-06
DEBUG - 2025-11-05 19:23:42 --> Applied date_to: 2025-11-05
DEBUG - 2025-11-05 19:23:42 --> Applied warehouse filter: 7
DEBUG - 2025-11-05 19:23:42 --> Generated SQL: SELECT `o`.`id` AS `order_id`, `o`.`date_time`, `o`.`amount_paid`, `o`.`paid_status`, `o`.`store_id`, `oi`.`qty` AS `quantity`, `oi`.`rate` AS `price`, `oi`.`amount` AS `amount`, `p`.`name` AS `product_name`, `p`.`id` AS `product_id`, COALESCE(o.customer_name, "Walk-in") AS customer_name
FROM `orders` `o`
INNER JOIN `orders_item` `oi` ON `o`.`id` = `oi`.`order_id`
LEFT JOIN `products` `p` ON `oi`.`product_id` = `p`.`id`
WHERE DATE(o.date_time) >= '2025-10-06'
AND DATE(o.date_time) <= '2025-11-05'
AND `o`.`store_id` = '7'
DEBUG - 2025-11-05 19:23:42 --> Query returned 273 rows
DEBUG - 2025-11-05 19:23:42 --> === SALES REPORT DEBUG END ===
DEBUG - 2025-11-05 19:23:42 --> Controller_Reports::sales_report rows fetched: 273
INFO - 2025-11-05 19:23:42 --> File loaded: C:\xampp\htdocs\Inventory_CI\application\views\templates/header.php
INFO - 2025-11-05 19:23:42 --> File loaded: C:\xampp\htdocs\Inventory_CI\application\views\templates/header_menu.php
INFO - 2025-11-05 19:23:42 --> File loaded: C:\xampp\htdocs\Inventory_CI\application\views\templates/side_menubar.php
INFO - 2025-11-05 19:23:43 --> File loaded: C:\xampp\htdocs\Inventory_CI\application\views\reporting/sales_report.php
INFO - 2025-11-05 19:23:43 --> File loaded: C:\xampp\htdocs\Inventory_CI\application\views\templates/footer.php
INFO - 2025-11-05 19:23:43 --> Final output sent to browser
DEBUG - 2025-11-05 19:23:43 --> Total execution time: 0.9759
INFO - 2025-11-05 19:24:14 --> Config Class Initialized
INFO - 2025-11-05 19:24:14 --> Hooks Class Initialized
DEBUG - 2025-11-05 19:24:15 --> UTF-8 Support Enabled
INFO - 2025-11-05 19:24:15 --> Utf8 Class Initialized
INFO - 2025-11-05 19:24:15 --> URI Class Initialized
INFO - 2025-11-05 19:24:15 --> Router Class Initialized
INFO - 2025-11-05 19:24:15 --> Output Class Initialized
INFO - 2025-11-05 19:24:15 --> Security Class Initialized
DEBUG - 2025-11-05 19:24:15 --> Global POST, GET and COOKIE data sanitized
INFO - 2025-11-05 19:24:15 --> Input Class Initialized
INFO - 2025-11-05 19:24:15 --> Language Class Initialized
INFO - 2025-11-05 19:24:15 --> Loader Class Initialized
INFO - 2025-11-05 19:24:15 --> Helper loaded: url_helper
INFO - 2025-11-05 19:24:15 --> Helper loaded: form_helper
INFO - 2025-11-05 19:24:15 --> Database Driver Class Initialized
DEBUG - 2025-11-05 19:24:15 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
INFO - 2025-11-05 19:24:15 --> Session: Class initialized using 'files' driver.
INFO - 2025-11-05 19:24:15 --> Form Validation Class Initialized
INFO - 2025-11-05 19:24:15 --> Controller Class Initialized
DEBUG - 2025-11-05 19:24:15 --> Session class already loaded. Second attempt ignored.
DEBUG - 2025-11-05 19:24:15 --> MY_Controller - Role: administrator
DEBUG - 2025-11-05 19:24:15 --> MY_Controller - Is Admin: true
DEBUG - 2025-11-05 19:24:15 --> MY_Controller - Permissions: Array
(
)

INFO - 2025-11-05 19:24:15 --> Model Class Initialized
INFO - 2025-11-05 19:24:15 --> Model Class Initialized
INFO - 2025-11-05 19:24:15 --> Model Class Initialized
INFO - 2025-11-05 19:24:15 --> Model Class Initialized
INFO - 2025-11-05 19:24:15 --> Model Class Initialized
INFO - 2025-11-05 19:24:15 --> Model Class Initialized
DEBUG - 2025-11-05 19:24:15 --> Controller_Reports initialized
INFO - 2025-11-05 19:24:15 --> Model Class Initialized
DEBUG - 2025-11-05 19:24:15 --> === SALES REPORT DEBUG START ===
DEBUG - 2025-11-05 19:24:15 --> Filters received: {"date_from":"2025-10-06","date_to":"2025-11-05","warehouse":"7","status":""}
DEBUG - 2025-11-05 19:24:15 --> Available tables: accounts, activity_log, attribute_value, attributes, brands, cash_accounts, categories, chart_of_accounts, company, company_expenses, customer_invoices, customer_payments, groups, journal_entries, journal_lines, orders, orders_item, products, purchases, quotation_items, quotations, stores, supplier_invoices, supplier_payments, user_group, users
DEBUG - 2025-11-05 19:24:15 --> date_from: 2025-10-06
DEBUG - 2025-11-05 19:24:15 --> date_to: 2025-11-05
DEBUG - 2025-11-05 19:24:15 --> warehouse: 7
DEBUG - 2025-11-05 19:24:15 --> status: 
DEBUG - 2025-11-05 19:24:15 --> Applied date_from: 2025-10-06
DEBUG - 2025-11-05 19:24:15 --> Applied date_to: 2025-11-05
DEBUG - 2025-11-05 19:24:15 --> Applied warehouse filter: 7
DEBUG - 2025-11-05 19:24:15 --> Generated SQL: SELECT `o`.`id` AS `order_id`, `o`.`date_time`, `o`.`amount_paid`, `o`.`paid_status`, `o`.`store_id`, `oi`.`qty` AS `quantity`, `oi`.`rate` AS `price`, `oi`.`amount` AS `amount`, `p`.`name` AS `product_name`, `p`.`id` AS `product_id`, COALESCE(o.customer_name, "Walk-in") AS customer_name
FROM `orders` `o`
INNER JOIN `orders_item` `oi` ON `o`.`id` = `oi`.`order_id`
LEFT JOIN `products` `p` ON `oi`.`product_id` = `p`.`id`
WHERE DATE(o.date_time) >= '2025-10-06'
AND DATE(o.date_time) <= '2025-11-05'
AND `o`.`store_id` = '7'
DEBUG - 2025-11-05 19:24:15 --> Query returned 273 rows
DEBUG - 2025-11-05 19:24:15 --> === SALES REPORT DEBUG END ===
DEBUG - 2025-11-05 19:24:15 --> Controller_Reports::sales_report rows fetched: 273
INFO - 2025-11-05 19:24:15 --> File loaded: C:\xampp\htdocs\Inventory_CI\application\views\templates/header.php
INFO - 2025-11-05 19:24:15 --> File loaded: C:\xampp\htdocs\Inventory_CI\application\views\templates/header_menu.php
INFO - 2025-11-05 19:24:15 --> File loaded: C:\xampp\htdocs\Inventory_CI\application\views\templates/side_menubar.php
INFO - 2025-11-05 19:24:16 --> File loaded: C:\xampp\htdocs\Inventory_CI\application\views\reporting/sales_report.php
INFO - 2025-11-05 19:24:16 --> File loaded: C:\xampp\htdocs\Inventory_CI\application\views\templates/footer.php
INFO - 2025-11-05 19:24:16 --> Final output sent to browser
DEBUG - 2025-11-05 19:24:16 --> Total execution time: 1.0689
INFO - 2025-11-05 19:24:41 --> Config Class Initialized
INFO - 2025-11-05 19:24:41 --> Hooks Class Initialized
DEBUG - 2025-11-05 19:24:41 --> UTF-8 Support Enabled
INFO - 2025-11-05 19:24:41 --> Utf8 Class Initialized
INFO - 2025-11-05 19:24:41 --> URI Class Initialized
INFO - 2025-11-05 19:24:41 --> Router Class Initialized
INFO - 2025-11-05 19:24:41 --> Output Class Initialized
INFO - 2025-11-05 19:24:41 --> Security Class Initialized
DEBUG - 2025-11-05 19:24:41 --> Global POST, GET and COOKIE data sanitized
INFO - 2025-11-05 19:24:41 --> Input Class Initialized
INFO - 2025-11-05 19:24:41 --> Language Class Initialized
INFO - 2025-11-05 19:24:41 --> Loader Class Initialized
INFO - 2025-11-05 19:24:41 --> Helper loaded: url_helper
INFO - 2025-11-05 19:24:41 --> Helper loaded: form_helper
INFO - 2025-11-05 19:24:41 --> Database Driver Class Initialized
DEBUG - 2025-11-05 19:24:41 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
INFO - 2025-11-05 19:24:41 --> Session: Class initialized using 'files' driver.
INFO - 2025-11-05 19:24:41 --> Form Validation Class Initialized
INFO - 2025-11-05 19:24:41 --> Controller Class Initialized
DEBUG - 2025-11-05 19:24:41 --> Session class already loaded. Second attempt ignored.
DEBUG - 2025-11-05 19:24:41 --> MY_Controller - Role: administrator
DEBUG - 2025-11-05 19:24:41 --> MY_Controller - Is Admin: true
DEBUG - 2025-11-05 19:24:41 --> MY_Controller - Permissions: Array
(
)

INFO - 2025-11-05 19:24:41 --> Model Class Initialized
INFO - 2025-11-05 19:24:41 --> Model Class Initialized
INFO - 2025-11-05 19:24:41 --> Model Class Initialized
INFO - 2025-11-05 19:24:41 --> Model Class Initialized
INFO - 2025-11-05 19:24:41 --> Model Class Initialized
INFO - 2025-11-05 19:24:41 --> Model Class Initialized
DEBUG - 2025-11-05 19:24:41 --> Controller_Reports initialized
INFO - 2025-11-05 19:24:41 --> Model Class Initialized
INFO - 2025-11-05 19:24:41 --> Model Class Initialized
DEBUG - 2025-11-05 19:24:41 --> === Stock Report Debug ===
DEBUG - 2025-11-05 19:24:41 --> Filters being applied: {"category":null,"warehouse":null,"stock_status":null,"limit":10,"offset":0}
DEBUG - 2025-11-05 19:24:41 --> Calling getStockReport with params: {"limit":10,"offset":0,"filters":{"category":null,"warehouse":null,"stock_status":null,"limit":10,"offset":0}}
ERROR - 2025-11-05 19:24:41 --> Query error: Invalid use of group function - Invalid query: SELECT COUNT(DISTINCT p.id) as total_items, COALESCE(SUM(
                    CASE 
                        WHEN (COALESCE(SUM(pu.qty), 0) - COALESCE(SUM(oi.qty), 0)) > 0 
                        THEN (COALESCE(SUM(pu.qty), 0) - COALESCE(SUM(oi.qty), 0)) * COALESCE(MAX(pu.price), p.price)
                        ELSE 0 
                    END
                ), 0) as total_value, COALESCE(SUM(COALESCE(pu.total_amount, 0)), 0) as total_purchase_value, COUNT(DISTINCT CASE 
                    WHEN (COALESCE(SUM(pu.qty), 0) - COALESCE(SUM(oi.qty), 0)) > 0 
                    AND (COALESCE(SUM(pu.qty), 0) - COALESCE(SUM(oi.qty), 0)) <= 10 
                    THEN p.id 
                END) as low_stock_items, COUNT(DISTINCT CASE 
                    WHEN (COALESCE(SUM(pu.qty), 0) - COALESCE(SUM(oi.qty), 0)) <= 0 
                    THEN p.id 
                END) as out_of_stock_items
FROM `products` `p`
LEFT JOIN `purchases` `pu` ON `pu`.`product_id` = `p`.`id`
LEFT JOIN `orders_item` `oi` ON `oi`.`product_id` = `p`.`id`
LEFT JOIN `orders` `o` ON `o`.`id` = `oi`.`order_id` AND `o`.`paid_status` IN (1, 2)
GROUP BY `p`.`id`, `p`.`price`
DEBUG - 2025-11-05 19:24:41 --> Report data retrieved: {"has_data":true,"record_count":10,"total_items":59,"aggregates":{"total_items":0,"total_value":0,"total_purchase_value":0,"low_stock_items":0,"out_of_stock_items":0}}
DEBUG - 2025-11-05 19:24:41 --> Data being sent to view: {"stock_count":10,"aggregate_keys":["total_items","total_value","total_purchase_value","low_stock_items","out_of_stock_items"]}
INFO - 2025-11-05 19:24:41 --> File loaded: C:\xampp\htdocs\Inventory_CI\application\views\templates/header.php
INFO - 2025-11-05 19:24:41 --> File loaded: C:\xampp\htdocs\Inventory_CI\application\views\templates/header_menu.php
INFO - 2025-11-05 19:24:41 --> File loaded: C:\xampp\htdocs\Inventory_CI\application\views\templates/side_menubar.php
INFO - 2025-11-05 19:24:41 --> File loaded: C:\xampp\htdocs\Inventory_CI\application\views\reporting/stock_report.php
INFO - 2025-11-05 19:24:41 --> File loaded: C:\xampp\htdocs\Inventory_CI\application\views\templates/footer.php
INFO - 2025-11-05 19:24:41 --> Final output sent to browser
DEBUG - 2025-11-05 19:24:41 --> Total execution time: 0.2398
INFO - 2025-11-05 19:24:42 --> Config Class Initialized
INFO - 2025-11-05 19:24:42 --> Hooks Class Initialized
DEBUG - 2025-11-05 19:24:42 --> UTF-8 Support Enabled
INFO - 2025-11-05 19:24:42 --> Utf8 Class Initialized
INFO - 2025-11-05 19:24:42 --> URI Class Initialized
INFO - 2025-11-05 19:24:42 --> Router Class Initialized
INFO - 2025-11-05 19:24:42 --> Output Class Initialized
INFO - 2025-11-05 19:24:42 --> Security Class Initialized
DEBUG - 2025-11-05 19:24:42 --> Global POST, GET and COOKIE data sanitized
INFO - 2025-11-05 19:24:42 --> Input Class Initialized
INFO - 2025-11-05 19:24:42 --> Language Class Initialized
INFO - 2025-11-05 19:24:42 --> Loader Class Initialized
INFO - 2025-11-05 19:24:42 --> Helper loaded: url_helper
INFO - 2025-11-05 19:24:42 --> Helper loaded: form_helper
INFO - 2025-11-05 19:24:42 --> Database Driver Class Initialized
DEBUG - 2025-11-05 19:24:42 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
INFO - 2025-11-05 19:24:42 --> Session: Class initialized using 'files' driver.
INFO - 2025-11-05 19:24:42 --> Form Validation Class Initialized
INFO - 2025-11-05 19:24:42 --> Controller Class Initialized
DEBUG - 2025-11-05 19:24:42 --> Session class already loaded. Second attempt ignored.
DEBUG - 2025-11-05 19:24:42 --> MY_Controller - Role: administrator
DEBUG - 2025-11-05 19:24:42 --> MY_Controller - Is Admin: true
DEBUG - 2025-11-05 19:24:42 --> MY_Controller - Permissions: Array
(
)

INFO - 2025-11-05 19:24:42 --> Model Class Initialized
INFO - 2025-11-05 19:24:42 --> Model Class Initialized
INFO - 2025-11-05 19:24:42 --> Model Class Initialized
INFO - 2025-11-05 19:24:42 --> Model Class Initialized
INFO - 2025-11-05 19:24:42 --> Model Class Initialized
INFO - 2025-11-05 19:24:42 --> Model Class Initialized
DEBUG - 2025-11-05 19:24:42 --> Controller_Reports initialized
INFO - 2025-11-05 19:24:42 --> Final output sent to browser
DEBUG - 2025-11-05 19:24:42 --> Total execution time: 0.2224
INFO - 2025-11-05 19:24:48 --> Config Class Initialized
INFO - 2025-11-05 19:24:48 --> Hooks Class Initialized
DEBUG - 2025-11-05 19:24:48 --> UTF-8 Support Enabled
INFO - 2025-11-05 19:24:48 --> Utf8 Class Initialized
INFO - 2025-11-05 19:24:48 --> URI Class Initialized
INFO - 2025-11-05 19:24:48 --> Router Class Initialized
INFO - 2025-11-05 19:24:48 --> Output Class Initialized
INFO - 2025-11-05 19:24:48 --> Security Class Initialized
DEBUG - 2025-11-05 19:24:48 --> Global POST, GET and COOKIE data sanitized
INFO - 2025-11-05 19:24:48 --> Input Class Initialized
INFO - 2025-11-05 19:24:48 --> Language Class Initialized
INFO - 2025-11-05 19:24:48 --> Loader Class Initialized
INFO - 2025-11-05 19:24:48 --> Helper loaded: url_helper
INFO - 2025-11-05 19:24:48 --> Helper loaded: form_helper
INFO - 2025-11-05 19:24:48 --> Database Driver Class Initialized
DEBUG - 2025-11-05 19:24:48 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
INFO - 2025-11-05 19:24:48 --> Session: Class initialized using 'files' driver.
INFO - 2025-11-05 19:24:48 --> Form Validation Class Initialized
INFO - 2025-11-05 19:24:48 --> Controller Class Initialized
DEBUG - 2025-11-05 19:24:48 --> Session class already loaded. Second attempt ignored.
DEBUG - 2025-11-05 19:24:48 --> MY_Controller - Role: administrator
DEBUG - 2025-11-05 19:24:48 --> MY_Controller - Is Admin: true
DEBUG - 2025-11-05 19:24:48 --> MY_Controller - Permissions: Array
(
)

INFO - 2025-11-05 19:24:48 --> Model Class Initialized
INFO - 2025-11-05 19:24:48 --> Model Class Initialized
INFO - 2025-11-05 19:24:48 --> Model Class Initialized
INFO - 2025-11-05 19:24:48 --> Model Class Initialized
INFO - 2025-11-05 19:24:48 --> Model Class Initialized
INFO - 2025-11-05 19:24:48 --> Model Class Initialized
DEBUG - 2025-11-05 19:24:48 --> Controller_Reports initialized
INFO - 2025-11-05 19:24:48 --> Final output sent to browser
DEBUG - 2025-11-05 19:24:48 --> Total execution time: 0.1638
INFO - 2025-11-05 19:25:01 --> Config Class Initialized
INFO - 2025-11-05 19:25:01 --> Hooks Class Initialized
DEBUG - 2025-11-05 19:25:01 --> UTF-8 Support Enabled
INFO - 2025-11-05 19:25:01 --> Utf8 Class Initialized
INFO - 2025-11-05 19:25:01 --> URI Class Initialized
INFO - 2025-11-05 19:25:01 --> Router Class Initialized
INFO - 2025-11-05 19:25:01 --> Output Class Initialized
INFO - 2025-11-05 19:25:01 --> Security Class Initialized
DEBUG - 2025-11-05 19:25:01 --> Global POST, GET and COOKIE data sanitized
INFO - 2025-11-05 19:25:01 --> Input Class Initialized
INFO - 2025-11-05 19:25:01 --> Language Class Initialized
INFO - 2025-11-05 19:25:01 --> Loader Class Initialized
INFO - 2025-11-05 19:25:01 --> Helper loaded: url_helper
INFO - 2025-11-05 19:25:01 --> Helper loaded: form_helper
INFO - 2025-11-05 19:25:01 --> Database Driver Class Initialized
DEBUG - 2025-11-05 19:25:01 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
INFO - 2025-11-05 19:25:01 --> Session: Class initialized using 'files' driver.
INFO - 2025-11-05 19:25:01 --> Form Validation Class Initialized
INFO - 2025-11-05 19:25:01 --> Controller Class Initialized
DEBUG - 2025-11-05 19:25:01 --> Session class already loaded. Second attempt ignored.
DEBUG - 2025-11-05 19:25:01 --> MY_Controller - Role: administrator
DEBUG - 2025-11-05 19:25:01 --> MY_Controller - Is Admin: true
DEBUG - 2025-11-05 19:25:01 --> MY_Controller - Permissions: Array
(
)

INFO - 2025-11-05 19:25:01 --> Model Class Initialized
INFO - 2025-11-05 19:25:01 --> Model Class Initialized
INFO - 2025-11-05 19:25:01 --> Model Class Initialized
INFO - 2025-11-05 19:25:01 --> Model Class Initialized
INFO - 2025-11-05 19:25:01 --> Model Class Initialized
INFO - 2025-11-05 19:25:01 --> Model Class Initialized
DEBUG - 2025-11-05 19:25:01 --> Controller_Reports initialized
INFO - 2025-11-05 19:25:01 --> Model Class Initialized
DEBUG - 2025-11-05 19:25:01 --> === SALES REPORT DEBUG START ===
DEBUG - 2025-11-05 19:25:01 --> Filters received: {"date_from":"2025-10-06","date_to":"2025-11-05","warehouse":null,"status":null}
DEBUG - 2025-11-05 19:25:01 --> Available tables: accounts, activity_log, attribute_value, attributes, brands, cash_accounts, categories, chart_of_accounts, company, company_expenses, customer_invoices, customer_payments, groups, journal_entries, journal_lines, orders, orders_item, products, purchases, quotation_items, quotations, stores, supplier_invoices, supplier_payments, user_group, users
DEBUG - 2025-11-05 19:25:01 --> date_from: 2025-10-06
DEBUG - 2025-11-05 19:25:01 --> date_to: 2025-11-05
DEBUG - 2025-11-05 19:25:01 --> warehouse: not set
DEBUG - 2025-11-05 19:25:01 --> status: not set
DEBUG - 2025-11-05 19:25:01 --> Applied date_from: 2025-10-06
DEBUG - 2025-11-05 19:25:01 --> Applied date_to: 2025-11-05
DEBUG - 2025-11-05 19:25:01 --> Generated SQL: SELECT `o`.`id` AS `order_id`, `o`.`date_time`, `o`.`amount_paid`, `o`.`paid_status`, `o`.`store_id`, `oi`.`qty` AS `quantity`, `oi`.`rate` AS `price`, `oi`.`amount` AS `amount`, `p`.`name` AS `product_name`, `p`.`id` AS `product_id`, COALESCE(o.customer_name, "Walk-in") AS customer_name
FROM `orders` `o`
INNER JOIN `orders_item` `oi` ON `o`.`id` = `oi`.`order_id`
LEFT JOIN `products` `p` ON `oi`.`product_id` = `p`.`id`
WHERE DATE(o.date_time) >= '2025-10-06'
AND DATE(o.date_time) <= '2025-11-05'
DEBUG - 2025-11-05 19:25:01 --> Query returned 273 rows
DEBUG - 2025-11-05 19:25:01 --> === SALES REPORT DEBUG END ===
DEBUG - 2025-11-05 19:25:01 --> Controller_Reports::sales_report rows fetched: 273
INFO - 2025-11-05 19:25:01 --> File loaded: C:\xampp\htdocs\Inventory_CI\application\views\templates/header.php
INFO - 2025-11-05 19:25:01 --> File loaded: C:\xampp\htdocs\Inventory_CI\application\views\templates/header_menu.php
INFO - 2025-11-05 19:25:01 --> File loaded: C:\xampp\htdocs\Inventory_CI\application\views\templates/side_menubar.php
INFO - 2025-11-05 19:25:01 --> File loaded: C:\xampp\htdocs\Inventory_CI\application\views\reporting/sales_report.php
INFO - 2025-11-05 19:25:01 --> File loaded: C:\xampp\htdocs\Inventory_CI\application\views\templates/footer.php
INFO - 2025-11-05 19:25:01 --> Final output sent to browser
DEBUG - 2025-11-05 19:25:01 --> Total execution time: 0.2640
INFO - 2025-11-05 19:27:04 --> Config Class Initialized
INFO - 2025-11-05 19:27:04 --> Hooks Class Initialized
DEBUG - 2025-11-05 19:27:04 --> UTF-8 Support Enabled
INFO - 2025-11-05 19:27:04 --> Utf8 Class Initialized
INFO - 2025-11-05 19:27:04 --> URI Class Initialized
INFO - 2025-11-05 19:27:04 --> Router Class Initialized
INFO - 2025-11-05 19:27:04 --> Output Class Initialized
INFO - 2025-11-05 19:27:04 --> Security Class Initialized
DEBUG - 2025-11-05 19:27:04 --> Global POST, GET and COOKIE data sanitized
INFO - 2025-11-05 19:27:04 --> Input Class Initialized
INFO - 2025-11-05 19:27:04 --> Language Class Initialized
INFO - 2025-11-05 19:27:04 --> Loader Class Initialized
INFO - 2025-11-05 19:27:04 --> Helper loaded: url_helper
INFO - 2025-11-05 19:27:04 --> Helper loaded: form_helper
INFO - 2025-11-05 19:27:04 --> Database Driver Class Initialized
DEBUG - 2025-11-05 19:27:05 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
INFO - 2025-11-05 19:27:05 --> Session: Class initialized using 'files' driver.
INFO - 2025-11-05 19:27:05 --> Form Validation Class Initialized
INFO - 2025-11-05 19:27:05 --> Controller Class Initialized
DEBUG - 2025-11-05 19:27:05 --> Session class already loaded. Second attempt ignored.
DEBUG - 2025-11-05 19:27:05 --> MY_Controller - Role: administrator
DEBUG - 2025-11-05 19:27:05 --> MY_Controller - Is Admin: true
DEBUG - 2025-11-05 19:27:05 --> MY_Controller - Permissions: Array
(
)

INFO - 2025-11-05 19:27:05 --> Model Class Initialized
INFO - 2025-11-05 19:27:05 --> Model Class Initialized
INFO - 2025-11-05 19:27:05 --> Model Class Initialized
INFO - 2025-11-05 19:27:05 --> Model Class Initialized
INFO - 2025-11-05 19:27:05 --> Model Class Initialized
INFO - 2025-11-05 19:27:05 --> Model Class Initialized
DEBUG - 2025-11-05 19:27:05 --> Controller_Reports initialized
INFO - 2025-11-05 19:27:05 --> Model Class Initialized
DEBUG - 2025-11-05 19:27:05 --> === SALES REPORT DEBUG START ===
DEBUG - 2025-11-05 19:27:05 --> Filters received: {"date_from":"2025-10-06","date_to":"2025-11-05","warehouse":null,"status":null}
DEBUG - 2025-11-05 19:27:05 --> Available tables: accounts, activity_log, attribute_value, attributes, brands, cash_accounts, categories, chart_of_accounts, company, company_expenses, customer_invoices, customer_payments, groups, journal_entries, journal_lines, orders, orders_item, products, purchases, quotation_items, quotations, stores, supplier_invoices, supplier_payments, user_group, users
DEBUG - 2025-11-05 19:27:05 --> date_from: 2025-10-06
DEBUG - 2025-11-05 19:27:05 --> date_to: 2025-11-05
DEBUG - 2025-11-05 19:27:05 --> warehouse: not set
DEBUG - 2025-11-05 19:27:05 --> status: not set
DEBUG - 2025-11-05 19:27:05 --> Applied date_from: 2025-10-06
DEBUG - 2025-11-05 19:27:05 --> Applied date_to: 2025-11-05
DEBUG - 2025-11-05 19:27:05 --> Generated SQL: SELECT `o`.`id` AS `order_id`, `o`.`date_time`, `o`.`amount_paid`, `o`.`paid_status`, `o`.`store_id`, `oi`.`qty` AS `quantity`, `oi`.`rate` AS `price`, `oi`.`amount` AS `amount`, `p`.`name` AS `product_name`, `p`.`id` AS `product_id`, COALESCE(o.customer_name, "Walk-in") AS customer_name
FROM `orders` `o`
INNER JOIN `orders_item` `oi` ON `o`.`id` = `oi`.`order_id`
LEFT JOIN `products` `p` ON `oi`.`product_id` = `p`.`id`
WHERE DATE(o.date_time) >= '2025-10-06'
AND DATE(o.date_time) <= '2025-11-05'
DEBUG - 2025-11-05 19:27:05 --> Query returned 273 rows
DEBUG - 2025-11-05 19:27:05 --> === SALES REPORT DEBUG END ===
DEBUG - 2025-11-05 19:27:05 --> Controller_Reports::sales_report rows fetched: 273
INFO - 2025-11-05 19:27:05 --> File loaded: C:\xampp\htdocs\Inventory_CI\application\views\templates/header.php
INFO - 2025-11-05 19:27:05 --> File loaded: C:\xampp\htdocs\Inventory_CI\application\views\templates/header_menu.php
INFO - 2025-11-05 19:27:05 --> File loaded: C:\xampp\htdocs\Inventory_CI\application\views\templates/side_menubar.php
INFO - 2025-11-05 19:27:05 --> File loaded: C:\xampp\htdocs\Inventory_CI\application\views\reporting/sales_report.php
INFO - 2025-11-05 19:27:05 --> File loaded: C:\xampp\htdocs\Inventory_CI\application\views\templates/footer.php
INFO - 2025-11-05 19:27:05 --> Final output sent to browser
DEBUG - 2025-11-05 19:27:05 --> Total execution time: 0.2620
INFO - 2025-11-05 19:27:15 --> Config Class Initialized
INFO - 2025-11-05 19:27:15 --> Hooks Class Initialized
DEBUG - 2025-11-05 19:27:15 --> UTF-8 Support Enabled
INFO - 2025-11-05 19:27:15 --> Utf8 Class Initialized
INFO - 2025-11-05 19:27:15 --> URI Class Initialized
INFO - 2025-11-05 19:27:15 --> Router Class Initialized
INFO - 2025-11-05 19:27:15 --> Output Class Initialized
INFO - 2025-11-05 19:27:15 --> Security Class Initialized
DEBUG - 2025-11-05 19:27:15 --> Global POST, GET and COOKIE data sanitized
INFO - 2025-11-05 19:27:15 --> Input Class Initialized
INFO - 2025-11-05 19:27:15 --> Language Class Initialized
INFO - 2025-11-05 19:27:15 --> Loader Class Initialized
INFO - 2025-11-05 19:27:15 --> Helper loaded: url_helper
INFO - 2025-11-05 19:27:15 --> Helper loaded: form_helper
INFO - 2025-11-05 19:27:15 --> Database Driver Class Initialized
DEBUG - 2025-11-05 19:27:15 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
INFO - 2025-11-05 19:27:15 --> Session: Class initialized using 'files' driver.
INFO - 2025-11-05 19:27:15 --> Form Validation Class Initialized
INFO - 2025-11-05 19:27:15 --> Controller Class Initialized
DEBUG - 2025-11-05 19:27:15 --> Session class already loaded. Second attempt ignored.
DEBUG - 2025-11-05 19:27:15 --> MY_Controller - Role: administrator
DEBUG - 2025-11-05 19:27:15 --> MY_Controller - Is Admin: true
DEBUG - 2025-11-05 19:27:15 --> MY_Controller - Permissions: Array
(
)

INFO - 2025-11-05 19:27:15 --> Model Class Initialized
INFO - 2025-11-05 19:27:15 --> Model Class Initialized
INFO - 2025-11-05 19:27:15 --> Model Class Initialized
INFO - 2025-11-05 19:27:15 --> Model Class Initialized
INFO - 2025-11-05 19:27:15 --> Model Class Initialized
INFO - 2025-11-05 19:27:15 --> Model Class Initialized
DEBUG - 2025-11-05 19:27:15 --> Controller_Reports initialized
DEBUG - 2025-11-05 19:27:15 --> Purchase report filters: {"date_from":"2025-10-06","date_to":"2025-11-05","product":"","status":"","period":"last_30_days"}
DEBUG - 2025-11-05 19:27:15 --> Applied date_from filter: 2025-10-06
DEBUG - 2025-11-05 19:27:15 --> Applied date_to filter: 2025-11-05
DEBUG - 2025-11-05 19:27:15 --> Purchase Report Query: SELECT `p`.*, COALESCE(pr.name, "Unknown Product") as product_name, COALESCE(pr.unit, p.unit) as unit, COALESCE(st.name, "Unassigned") as warehouse_name
FROM `purchases` `p`
LEFT JOIN `products` `pr` ON `pr`.`id` = `p`.`product_id`
LEFT JOIN `stores` `st` ON `st`.`id` = `p`.`store_id`
WHERE DATE(p.purchase_date) >= '2025-10-06'
AND DATE(p.purchase_date) <= '2025-11-05'
ORDER BY `p`.`purchase_date` DESC, `p`.`id` DESC
ERROR - 2025-11-05 19:27:15 --> Query error: No tables used - Invalid query: SELECT *
ERROR - 2025-11-05 19:27:15 --> Error in getPurchaseReport: Query failed: {"code":1096,"message":"No tables used"}
DEBUG - 2025-11-05 19:27:15 --> === Purchase Report Debug Start ===
DEBUG - 2025-11-05 19:27:15 --> Database connected: Yes
DEBUG - 2025-11-05 19:27:15 --> Purchases table fields: ["id","product_id","supplier","supplier_no","qty","unit","price","total_amount","amount_paid","status","purchase_date","user_id","store_id"]
DEBUG - 2025-11-05 19:27:15 --> Total purchases in database: 60
DEBUG - 2025-11-05 19:27:15 --> Sample purchase record: {"id":"100","product_id":"79","supplier":"stock-nov-2","supplier_no":"6756","qty":"489","unit":"kg","price":"1000.00","total_amount":"489100.00","amount_paid":"489100.00","status":"Paid","purchase_date":"2025-11-02 00:00:00","user_id":"1","store_id":"7"}
DEBUG - 2025-11-05 19:27:15 --> Purchase date range: {"earliest":"2025-11-02 00:00:00","latest":"2025-11-05 13:18:00"}
DEBUG - 2025-11-05 19:27:15 --> Applied filters: {"date_from":"2025-10-06","date_to":"2025-11-05","product":"","status":"","period":"last_30_days"}
DEBUG - 2025-11-05 19:27:15 --> Applied date_from filter: 2025-10-06
DEBUG - 2025-11-05 19:27:15 --> Applied date_to filter: 2025-11-05
DEBUG - 2025-11-05 19:27:15 --> Purchase Report Query: SELECT `p`.*, COALESCE(pr.name, "Unknown Product") as product_name, COALESCE(pr.unit, p.unit) as unit, COALESCE(st.name, "Unassigned") as warehouse_name
FROM `purchases` `p`
LEFT JOIN `products` `pr` ON `pr`.`id` = `p`.`product_id`
LEFT JOIN `stores` `st` ON `st`.`id` = `p`.`store_id`
WHERE DATE(p.purchase_date) >= '2025-10-06'
AND DATE(p.purchase_date) <= '2025-11-05'
ORDER BY `p`.`purchase_date` DESC, `p`.`id` DESC
ERROR - 2025-11-05 19:27:15 --> Query error: No tables used - Invalid query: SELECT *
ERROR - 2025-11-05 19:27:15 --> Error in getPurchaseReport: Query failed: {"code":1096,"message":"No tables used"}
DEBUG - 2025-11-05 19:27:15 --> Last executed query: SELECT *
DEBUG - 2025-11-05 19:27:15 --> Report structure: {"has_data":false,"record_count":0,"first_record":null,"summary":{"total_purchases":0,"total_amount":0,"total_paid":0,"pending_amount":0}}
DEBUG - 2025-11-05 19:27:15 --> Active products count: 59
DEBUG - 2025-11-05 19:27:15 --> View data structure: {"report_count":0,"has_summary":true,"product_count":59,"applied_filters":{"date_from":"2025-10-06","date_to":"2025-11-05","product":"","status":"","period":"last_30_days"}}
DEBUG - 2025-11-05 19:27:15 --> === Purchase Report Debug End ===
INFO - 2025-11-05 19:27:15 --> File loaded: C:\xampp\htdocs\Inventory_CI\application\views\templates/header.php
INFO - 2025-11-05 19:27:15 --> File loaded: C:\xampp\htdocs\Inventory_CI\application\views\templates/header_menu.php
INFO - 2025-11-05 19:27:15 --> File loaded: C:\xampp\htdocs\Inventory_CI\application\views\templates/side_menubar.php
ERROR - 2025-11-05 19:27:15 --> Severity: Notice --> Undefined variable: warehouses C:\xampp\htdocs\Inventory_CI\application\views\reporting\purchase_report.php 72
ERROR - 2025-11-05 19:27:15 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\Inventory_CI\application\views\reporting\purchase_report.php 72
ERROR - 2025-11-05 19:27:15 --> Severity: Notice --> Undefined variable: suppliers C:\xampp\htdocs\Inventory_CI\application\views\reporting\purchase_report.php 98
ERROR - 2025-11-05 19:27:15 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\Inventory_CI\application\views\reporting\purchase_report.php 98
DEBUG - 2025-11-05 19:27:15 --> Report Data Before Rendering: []
INFO - 2025-11-05 19:27:15 --> File loaded: C:\xampp\htdocs\Inventory_CI\application\views\reporting/purchase_report.php
INFO - 2025-11-05 19:27:15 --> File loaded: C:\xampp\htdocs\Inventory_CI\application\views\templates/footer.php
INFO - 2025-11-05 19:27:15 --> Final output sent to browser
DEBUG - 2025-11-05 19:27:15 --> Total execution time: 0.3413
INFO - 2025-11-05 19:27:31 --> Config Class Initialized
INFO - 2025-11-05 19:27:31 --> Hooks Class Initialized
DEBUG - 2025-11-05 19:27:31 --> UTF-8 Support Enabled
INFO - 2025-11-05 19:27:31 --> Utf8 Class Initialized
INFO - 2025-11-05 19:27:31 --> URI Class Initialized
INFO - 2025-11-05 19:27:31 --> Router Class Initialized
INFO - 2025-11-05 19:27:32 --> Output Class Initialized
INFO - 2025-11-05 19:27:32 --> Security Class Initialized
DEBUG - 2025-11-05 19:27:32 --> Global POST, GET and COOKIE data sanitized
INFO - 2025-11-05 19:27:32 --> Input Class Initialized
INFO - 2025-11-05 19:27:32 --> Language Class Initialized
INFO - 2025-11-05 19:27:32 --> Loader Class Initialized
INFO - 2025-11-05 19:27:32 --> Helper loaded: url_helper
INFO - 2025-11-05 19:27:32 --> Helper loaded: form_helper
INFO - 2025-11-05 19:27:32 --> Database Driver Class Initialized
DEBUG - 2025-11-05 19:27:32 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
INFO - 2025-11-05 19:27:32 --> Session: Class initialized using 'files' driver.
INFO - 2025-11-05 19:27:32 --> Form Validation Class Initialized
INFO - 2025-11-05 19:27:32 --> Controller Class Initialized
DEBUG - 2025-11-05 19:27:32 --> Session class already loaded. Second attempt ignored.
DEBUG - 2025-11-05 19:27:32 --> MY_Controller - Role: administrator
DEBUG - 2025-11-05 19:27:32 --> MY_Controller - Is Admin: true
DEBUG - 2025-11-05 19:27:32 --> MY_Controller - Permissions: Array
(
)

INFO - 2025-11-05 19:27:32 --> Model Class Initialized
INFO - 2025-11-05 19:27:32 --> Model Class Initialized
INFO - 2025-11-05 19:27:32 --> Model Class Initialized
INFO - 2025-11-05 19:27:32 --> Model Class Initialized
INFO - 2025-11-05 19:27:32 --> Model Class Initialized
INFO - 2025-11-05 19:27:32 --> Model Class Initialized
DEBUG - 2025-11-05 19:27:32 --> Controller_Reports initialized
INFO - 2025-11-05 19:27:32 --> Model Class Initialized
INFO - 2025-11-05 19:27:32 --> Model Class Initialized
DEBUG - 2025-11-05 19:27:32 --> === Stock Report Debug ===
DEBUG - 2025-11-05 19:27:32 --> Filters being applied: {"category":null,"warehouse":null,"stock_status":null,"limit":10,"offset":0}
DEBUG - 2025-11-05 19:27:32 --> Calling getStockReport with params: {"limit":10,"offset":0,"filters":{"category":null,"warehouse":null,"stock_status":null,"limit":10,"offset":0}}
ERROR - 2025-11-05 19:27:32 --> Query error: Invalid use of group function - Invalid query: SELECT COUNT(DISTINCT p.id) as total_items, COALESCE(SUM(
                    CASE 
                        WHEN (COALESCE(SUM(pu.qty), 0) - COALESCE(SUM(oi.qty), 0)) > 0 
                        THEN (COALESCE(SUM(pu.qty), 0) - COALESCE(SUM(oi.qty), 0)) * COALESCE(MAX(pu.price), p.price)
                        ELSE 0 
                    END
                ), 0) as total_value, COALESCE(SUM(COALESCE(pu.total_amount, 0)), 0) as total_purchase_value, COUNT(DISTINCT CASE 
                    WHEN (COALESCE(SUM(pu.qty), 0) - COALESCE(SUM(oi.qty), 0)) > 0 
                    AND (COALESCE(SUM(pu.qty), 0) - COALESCE(SUM(oi.qty), 0)) <= 10 
                    THEN p.id 
                END) as low_stock_items, COUNT(DISTINCT CASE 
                    WHEN (COALESCE(SUM(pu.qty), 0) - COALESCE(SUM(oi.qty), 0)) <= 0 
                    THEN p.id 
                END) as out_of_stock_items
FROM `products` `p`
LEFT JOIN `purchases` `pu` ON `pu`.`product_id` = `p`.`id`
LEFT JOIN `orders_item` `oi` ON `oi`.`product_id` = `p`.`id`
LEFT JOIN `orders` `o` ON `o`.`id` = `oi`.`order_id` AND `o`.`paid_status` IN (1, 2)
GROUP BY `p`.`id`, `p`.`price`
DEBUG - 2025-11-05 19:27:32 --> Report data retrieved: {"has_data":true,"record_count":10,"total_items":59,"aggregates":{"total_items":0,"total_value":0,"total_purchase_value":0,"low_stock_items":0,"out_of_stock_items":0}}
DEBUG - 2025-11-05 19:27:32 --> Data being sent to view: {"stock_count":10,"aggregate_keys":["total_items","total_value","total_purchase_value","low_stock_items","out_of_stock_items"]}
INFO - 2025-11-05 19:27:32 --> File loaded: C:\xampp\htdocs\Inventory_CI\application\views\templates/header.php
INFO - 2025-11-05 19:27:32 --> File loaded: C:\xampp\htdocs\Inventory_CI\application\views\templates/header_menu.php
INFO - 2025-11-05 19:27:32 --> File loaded: C:\xampp\htdocs\Inventory_CI\application\views\templates/side_menubar.php
INFO - 2025-11-05 19:27:32 --> File loaded: C:\xampp\htdocs\Inventory_CI\application\views\reporting/stock_report.php
INFO - 2025-11-05 19:27:32 --> File loaded: C:\xampp\htdocs\Inventory_CI\application\views\templates/footer.php
INFO - 2025-11-05 19:27:32 --> Final output sent to browser
DEBUG - 2025-11-05 19:27:32 --> Total execution time: 0.2179
INFO - 2025-11-05 19:27:33 --> Config Class Initialized
INFO - 2025-11-05 19:27:33 --> Hooks Class Initialized
DEBUG - 2025-11-05 19:27:33 --> UTF-8 Support Enabled
INFO - 2025-11-05 19:27:33 --> Utf8 Class Initialized
INFO - 2025-11-05 19:27:33 --> URI Class Initialized
INFO - 2025-11-05 19:27:33 --> Router Class Initialized
INFO - 2025-11-05 19:27:33 --> Output Class Initialized
INFO - 2025-11-05 19:27:33 --> Security Class Initialized
DEBUG - 2025-11-05 19:27:33 --> Global POST, GET and COOKIE data sanitized
INFO - 2025-11-05 19:27:33 --> Input Class Initialized
INFO - 2025-11-05 19:27:33 --> Language Class Initialized
INFO - 2025-11-05 19:27:33 --> Loader Class Initialized
INFO - 2025-11-05 19:27:33 --> Helper loaded: url_helper
INFO - 2025-11-05 19:27:33 --> Helper loaded: form_helper
INFO - 2025-11-05 19:27:33 --> Database Driver Class Initialized
DEBUG - 2025-11-05 19:27:33 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
INFO - 2025-11-05 19:27:33 --> Session: Class initialized using 'files' driver.
INFO - 2025-11-05 19:27:33 --> Form Validation Class Initialized
INFO - 2025-11-05 19:27:33 --> Controller Class Initialized
DEBUG - 2025-11-05 19:27:33 --> Session class already loaded. Second attempt ignored.
DEBUG - 2025-11-05 19:27:33 --> MY_Controller - Role: administrator
DEBUG - 2025-11-05 19:27:33 --> MY_Controller - Is Admin: true
DEBUG - 2025-11-05 19:27:33 --> MY_Controller - Permissions: Array
(
)

INFO - 2025-11-05 19:27:33 --> Model Class Initialized
INFO - 2025-11-05 19:27:34 --> Model Class Initialized
INFO - 2025-11-05 19:27:34 --> Model Class Initialized
INFO - 2025-11-05 19:27:34 --> Model Class Initialized
INFO - 2025-11-05 19:27:34 --> Model Class Initialized
INFO - 2025-11-05 19:27:34 --> Model Class Initialized
DEBUG - 2025-11-05 19:27:34 --> Controller_Reports initialized
INFO - 2025-11-05 19:27:34 --> Final output sent to browser
DEBUG - 2025-11-05 19:27:34 --> Total execution time: 0.1830
INFO - 2025-11-05 19:27:50 --> Config Class Initialized
INFO - 2025-11-05 19:27:50 --> Hooks Class Initialized
DEBUG - 2025-11-05 19:27:50 --> UTF-8 Support Enabled
INFO - 2025-11-05 19:27:50 --> Utf8 Class Initialized
INFO - 2025-11-05 19:27:50 --> URI Class Initialized
INFO - 2025-11-05 19:27:50 --> Router Class Initialized
INFO - 2025-11-05 19:27:50 --> Output Class Initialized
INFO - 2025-11-05 19:27:50 --> Security Class Initialized
DEBUG - 2025-11-05 19:27:50 --> Global POST, GET and COOKIE data sanitized
INFO - 2025-11-05 19:27:50 --> Input Class Initialized
INFO - 2025-11-05 19:27:50 --> Language Class Initialized
INFO - 2025-11-05 19:27:50 --> Loader Class Initialized
INFO - 2025-11-05 19:27:50 --> Helper loaded: url_helper
INFO - 2025-11-05 19:27:50 --> Helper loaded: form_helper
INFO - 2025-11-05 19:27:50 --> Database Driver Class Initialized
DEBUG - 2025-11-05 19:27:50 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
INFO - 2025-11-05 19:27:50 --> Session: Class initialized using 'files' driver.
INFO - 2025-11-05 19:27:50 --> Form Validation Class Initialized
INFO - 2025-11-05 19:27:50 --> Controller Class Initialized
DEBUG - 2025-11-05 19:27:50 --> Session class already loaded. Second attempt ignored.
DEBUG - 2025-11-05 19:27:50 --> MY_Controller - Role: administrator
DEBUG - 2025-11-05 19:27:50 --> MY_Controller - Is Admin: true
DEBUG - 2025-11-05 19:27:50 --> MY_Controller - Permissions: Array
(
)

INFO - 2025-11-05 19:27:50 --> Model Class Initialized
INFO - 2025-11-05 19:27:50 --> Model Class Initialized
INFO - 2025-11-05 19:27:50 --> Model Class Initialized
INFO - 2025-11-05 19:27:50 --> Model Class Initialized
INFO - 2025-11-05 19:27:50 --> Model Class Initialized
INFO - 2025-11-05 19:27:50 --> Model Class Initialized
DEBUG - 2025-11-05 19:27:50 --> Controller_Reports initialized
INFO - 2025-11-05 19:27:50 --> Final output sent to browser
DEBUG - 2025-11-05 19:27:50 --> Total execution time: 0.2177
INFO - 2025-11-05 19:28:22 --> Config Class Initialized
INFO - 2025-11-05 19:28:22 --> Hooks Class Initialized
DEBUG - 2025-11-05 19:28:22 --> UTF-8 Support Enabled
INFO - 2025-11-05 19:28:22 --> Utf8 Class Initialized
INFO - 2025-11-05 19:28:22 --> URI Class Initialized
INFO - 2025-11-05 19:28:22 --> Router Class Initialized
INFO - 2025-11-05 19:28:22 --> Output Class Initialized
INFO - 2025-11-05 19:28:22 --> Security Class Initialized
DEBUG - 2025-11-05 19:28:22 --> Global POST, GET and COOKIE data sanitized
INFO - 2025-11-05 19:28:22 --> Input Class Initialized
INFO - 2025-11-05 19:28:22 --> Language Class Initialized
INFO - 2025-11-05 19:28:22 --> Loader Class Initialized
INFO - 2025-11-05 19:28:22 --> Helper loaded: url_helper
INFO - 2025-11-05 19:28:22 --> Helper loaded: form_helper
INFO - 2025-11-05 19:28:22 --> Database Driver Class Initialized
DEBUG - 2025-11-05 19:28:22 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
INFO - 2025-11-05 19:28:22 --> Session: Class initialized using 'files' driver.
INFO - 2025-11-05 19:28:22 --> Form Validation Class Initialized
INFO - 2025-11-05 19:28:22 --> Controller Class Initialized
DEBUG - 2025-11-05 19:28:22 --> Session class already loaded. Second attempt ignored.
DEBUG - 2025-11-05 19:28:22 --> MY_Controller - Role: administrator
DEBUG - 2025-11-05 19:28:22 --> MY_Controller - Is Admin: true
DEBUG - 2025-11-05 19:28:22 --> MY_Controller - Permissions: Array
(
)

INFO - 2025-11-05 19:28:22 --> Model Class Initialized
INFO - 2025-11-05 19:28:23 --> Model Class Initialized
INFO - 2025-11-05 19:28:23 --> Model Class Initialized
INFO - 2025-11-05 19:28:23 --> Model Class Initialized
INFO - 2025-11-05 19:28:23 --> Model Class Initialized
INFO - 2025-11-05 19:28:23 --> Model Class Initialized
DEBUG - 2025-11-05 19:28:23 --> Controller_Reports initialized
INFO - 2025-11-05 19:28:23 --> Final output sent to browser
DEBUG - 2025-11-05 19:28:23 --> Total execution time: 0.1408
INFO - 2025-11-05 19:28:28 --> Config Class Initialized
INFO - 2025-11-05 19:28:28 --> Hooks Class Initialized
DEBUG - 2025-11-05 19:28:28 --> UTF-8 Support Enabled
INFO - 2025-11-05 19:28:28 --> Utf8 Class Initialized
INFO - 2025-11-05 19:28:28 --> URI Class Initialized
INFO - 2025-11-05 19:28:28 --> Router Class Initialized
INFO - 2025-11-05 19:28:28 --> Output Class Initialized
INFO - 2025-11-05 19:28:28 --> Security Class Initialized
DEBUG - 2025-11-05 19:28:28 --> Global POST, GET and COOKIE data sanitized
INFO - 2025-11-05 19:28:28 --> Input Class Initialized
INFO - 2025-11-05 19:28:28 --> Language Class Initialized
INFO - 2025-11-05 19:28:28 --> Loader Class Initialized
INFO - 2025-11-05 19:28:28 --> Helper loaded: url_helper
INFO - 2025-11-05 19:28:28 --> Helper loaded: form_helper
INFO - 2025-11-05 19:28:28 --> Database Driver Class Initialized
DEBUG - 2025-11-05 19:28:28 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
INFO - 2025-11-05 19:28:28 --> Session: Class initialized using 'files' driver.
INFO - 2025-11-05 19:28:28 --> Form Validation Class Initialized
INFO - 2025-11-05 19:28:28 --> Controller Class Initialized
DEBUG - 2025-11-05 19:28:28 --> Session class already loaded. Second attempt ignored.
DEBUG - 2025-11-05 19:28:28 --> MY_Controller - Role: administrator
DEBUG - 2025-11-05 19:28:28 --> MY_Controller - Is Admin: true
DEBUG - 2025-11-05 19:28:28 --> MY_Controller - Permissions: Array
(
)

INFO - 2025-11-05 19:28:28 --> Model Class Initialized
INFO - 2025-11-05 19:28:28 --> Model Class Initialized
INFO - 2025-11-05 19:28:28 --> Model Class Initialized
INFO - 2025-11-05 19:28:28 --> Model Class Initialized
INFO - 2025-11-05 19:28:28 --> Model Class Initialized
INFO - 2025-11-05 19:28:28 --> Model Class Initialized
DEBUG - 2025-11-05 19:28:28 --> Controller_Reports initialized
DEBUG - 2025-11-05 19:28:28 --> Purchase report filters: {"date_from":"2025-10-06","date_to":"2025-11-05","product":"","status":"","period":"last_30_days"}
DEBUG - 2025-11-05 19:28:28 --> Applied date_from filter: 2025-10-06
DEBUG - 2025-11-05 19:28:28 --> Applied date_to filter: 2025-11-05
DEBUG - 2025-11-05 19:28:28 --> Purchase Report Query: SELECT `p`.*, COALESCE(pr.name, "Unknown Product") as product_name, COALESCE(pr.unit, p.unit) as unit, COALESCE(st.name, "Unassigned") as warehouse_name
FROM `purchases` `p`
LEFT JOIN `products` `pr` ON `pr`.`id` = `p`.`product_id`
LEFT JOIN `stores` `st` ON `st`.`id` = `p`.`store_id`
WHERE DATE(p.purchase_date) >= '2025-10-06'
AND DATE(p.purchase_date) <= '2025-11-05'
ORDER BY `p`.`purchase_date` DESC, `p`.`id` DESC
ERROR - 2025-11-05 19:28:28 --> Query error: No tables used - Invalid query: SELECT *
ERROR - 2025-11-05 19:28:28 --> Error in getPurchaseReport: Query failed: {"code":1096,"message":"No tables used"}
DEBUG - 2025-11-05 19:28:28 --> === Purchase Report Debug Start ===
DEBUG - 2025-11-05 19:28:28 --> Database connected: Yes
DEBUG - 2025-11-05 19:28:28 --> Purchases table fields: ["id","product_id","supplier","supplier_no","qty","unit","price","total_amount","amount_paid","status","purchase_date","user_id","store_id"]
DEBUG - 2025-11-05 19:28:28 --> Total purchases in database: 60
DEBUG - 2025-11-05 19:28:28 --> Sample purchase record: {"id":"100","product_id":"79","supplier":"stock-nov-2","supplier_no":"6756","qty":"489","unit":"kg","price":"1000.00","total_amount":"489100.00","amount_paid":"489100.00","status":"Paid","purchase_date":"2025-11-02 00:00:00","user_id":"1","store_id":"7"}
DEBUG - 2025-11-05 19:28:28 --> Purchase date range: {"earliest":"2025-11-02 00:00:00","latest":"2025-11-05 13:18:00"}
DEBUG - 2025-11-05 19:28:28 --> Applied filters: {"date_from":"2025-10-06","date_to":"2025-11-05","product":"","status":"","period":"last_30_days"}
DEBUG - 2025-11-05 19:28:28 --> Applied date_from filter: 2025-10-06
DEBUG - 2025-11-05 19:28:28 --> Applied date_to filter: 2025-11-05
DEBUG - 2025-11-05 19:28:28 --> Purchase Report Query: SELECT `p`.*, COALESCE(pr.name, "Unknown Product") as product_name, COALESCE(pr.unit, p.unit) as unit, COALESCE(st.name, "Unassigned") as warehouse_name
FROM `purchases` `p`
LEFT JOIN `products` `pr` ON `pr`.`id` = `p`.`product_id`
LEFT JOIN `stores` `st` ON `st`.`id` = `p`.`store_id`
WHERE DATE(p.purchase_date) >= '2025-10-06'
AND DATE(p.purchase_date) <= '2025-11-05'
ORDER BY `p`.`purchase_date` DESC, `p`.`id` DESC
ERROR - 2025-11-05 19:28:28 --> Query error: No tables used - Invalid query: SELECT *
ERROR - 2025-11-05 19:28:28 --> Error in getPurchaseReport: Query failed: {"code":1096,"message":"No tables used"}
DEBUG - 2025-11-05 19:28:28 --> Last executed query: SELECT *
DEBUG - 2025-11-05 19:28:28 --> Report structure: {"has_data":false,"record_count":0,"first_record":null,"summary":{"total_purchases":0,"total_amount":0,"total_paid":0,"pending_amount":0}}
DEBUG - 2025-11-05 19:28:28 --> Active products count: 59
DEBUG - 2025-11-05 19:28:28 --> View data structure: {"report_count":0,"has_summary":true,"product_count":59,"applied_filters":{"date_from":"2025-10-06","date_to":"2025-11-05","product":"","status":"","period":"last_30_days"}}
DEBUG - 2025-11-05 19:28:28 --> === Purchase Report Debug End ===
INFO - 2025-11-05 19:28:28 --> File loaded: C:\xampp\htdocs\Inventory_CI\application\views\templates/header.php
INFO - 2025-11-05 19:28:28 --> File loaded: C:\xampp\htdocs\Inventory_CI\application\views\templates/header_menu.php
INFO - 2025-11-05 19:28:28 --> File loaded: C:\xampp\htdocs\Inventory_CI\application\views\templates/side_menubar.php
ERROR - 2025-11-05 19:28:28 --> Severity: Notice --> Undefined variable: warehouses C:\xampp\htdocs\Inventory_CI\application\views\reporting\purchase_report.php 72
ERROR - 2025-11-05 19:28:28 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\Inventory_CI\application\views\reporting\purchase_report.php 72
ERROR - 2025-11-05 19:28:28 --> Severity: Notice --> Undefined variable: suppliers C:\xampp\htdocs\Inventory_CI\application\views\reporting\purchase_report.php 98
ERROR - 2025-11-05 19:28:28 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\Inventory_CI\application\views\reporting\purchase_report.php 98
DEBUG - 2025-11-05 19:28:28 --> Report Data Before Rendering: []
INFO - 2025-11-05 19:28:28 --> File loaded: C:\xampp\htdocs\Inventory_CI\application\views\reporting/purchase_report.php
INFO - 2025-11-05 19:28:28 --> File loaded: C:\xampp\htdocs\Inventory_CI\application\views\templates/footer.php
INFO - 2025-11-05 19:28:28 --> Final output sent to browser
DEBUG - 2025-11-05 19:28:28 --> Total execution time: 0.3162
INFO - 2025-11-05 19:39:21 --> Config Class Initialized
INFO - 2025-11-05 19:39:21 --> Hooks Class Initialized
DEBUG - 2025-11-05 19:39:21 --> UTF-8 Support Enabled
INFO - 2025-11-05 19:39:21 --> Utf8 Class Initialized
INFO - 2025-11-05 19:39:21 --> URI Class Initialized
INFO - 2025-11-05 19:39:21 --> Router Class Initialized
INFO - 2025-11-05 19:39:21 --> Output Class Initialized
INFO - 2025-11-05 19:39:21 --> Security Class Initialized
DEBUG - 2025-11-05 19:39:21 --> Global POST, GET and COOKIE data sanitized
INFO - 2025-11-05 19:39:21 --> Input Class Initialized
INFO - 2025-11-05 19:39:21 --> Language Class Initialized
INFO - 2025-11-05 19:39:21 --> Loader Class Initialized
INFO - 2025-11-05 19:39:21 --> Helper loaded: url_helper
INFO - 2025-11-05 19:39:21 --> Helper loaded: form_helper
INFO - 2025-11-05 19:39:21 --> Database Driver Class Initialized
DEBUG - 2025-11-05 19:39:21 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
INFO - 2025-11-05 19:39:21 --> Session: Class initialized using 'files' driver.
INFO - 2025-11-05 19:39:21 --> Form Validation Class Initialized
INFO - 2025-11-05 19:39:21 --> Controller Class Initialized
DEBUG - 2025-11-05 19:39:21 --> Session class already loaded. Second attempt ignored.
DEBUG - 2025-11-05 19:39:21 --> MY_Controller - Role: administrator
DEBUG - 2025-11-05 19:39:21 --> MY_Controller - Is Admin: true
DEBUG - 2025-11-05 19:39:21 --> MY_Controller - Permissions: Array
(
)

INFO - 2025-11-05 19:39:21 --> Model Class Initialized
INFO - 2025-11-05 19:39:21 --> Model Class Initialized
INFO - 2025-11-05 19:39:21 --> Model Class Initialized
INFO - 2025-11-05 19:39:21 --> Model Class Initialized
INFO - 2025-11-05 19:39:21 --> Model Class Initialized
INFO - 2025-11-05 19:39:21 --> Model Class Initialized
DEBUG - 2025-11-05 19:39:21 --> Controller_Reports initialized
INFO - 2025-11-05 19:39:21 --> Model Class Initialized
INFO - 2025-11-05 19:39:21 --> Model Class Initialized
DEBUG - 2025-11-05 19:39:21 --> === Stock Report Debug ===
DEBUG - 2025-11-05 19:39:21 --> Filters being applied: {"category":null,"warehouse":null,"stock_status":null,"limit":10,"offset":0}
DEBUG - 2025-11-05 19:39:21 --> Calling getStockReport with params: {"limit":10,"offset":0,"filters":{"category":null,"warehouse":null,"stock_status":null,"limit":10,"offset":0}}
ERROR - 2025-11-05 19:39:21 --> Query error: Invalid use of group function - Invalid query: SELECT COUNT(DISTINCT p.id) as total_items, COALESCE(SUM(
                    CASE 
                        WHEN (COALESCE(SUM(pu.qty), 0) - COALESCE(SUM(oi.qty), 0)) > 0 
                        THEN (COALESCE(SUM(pu.qty), 0) - COALESCE(SUM(oi.qty), 0)) * COALESCE(MAX(pu.price), p.price)
                        ELSE 0 
                    END
                ), 0) as total_value, COALESCE(SUM(COALESCE(pu.total_amount, 0)), 0) as total_purchase_value, COUNT(DISTINCT CASE 
                    WHEN (COALESCE(SUM(pu.qty), 0) - COALESCE(SUM(oi.qty), 0)) > 0 
                    AND (COALESCE(SUM(pu.qty), 0) - COALESCE(SUM(oi.qty), 0)) <= 10 
                    THEN p.id 
                END) as low_stock_items, COUNT(DISTINCT CASE 
                    WHEN (COALESCE(SUM(pu.qty), 0) - COALESCE(SUM(oi.qty), 0)) <= 0 
                    THEN p.id 
                END) as out_of_stock_items
FROM `products` `p`
LEFT JOIN `purchases` `pu` ON `pu`.`product_id` = `p`.`id`
LEFT JOIN `orders_item` `oi` ON `oi`.`product_id` = `p`.`id`
LEFT JOIN `orders` `o` ON `o`.`id` = `oi`.`order_id` AND `o`.`paid_status` IN (1, 2)
GROUP BY `p`.`id`, `p`.`price`
DEBUG - 2025-11-05 19:39:21 --> Report data retrieved: {"has_data":true,"record_count":10,"total_items":59,"aggregates":{"total_items":0,"total_value":0,"total_purchase_value":0,"low_stock_items":0,"out_of_stock_items":0}}
DEBUG - 2025-11-05 19:39:21 --> Data being sent to view: {"stock_count":10,"aggregate_keys":["total_items","total_value","total_purchase_value","low_stock_items","out_of_stock_items"]}
INFO - 2025-11-05 19:39:21 --> File loaded: C:\xampp\htdocs\Inventory_CI\application\views\templates/header.php
INFO - 2025-11-05 19:39:21 --> File loaded: C:\xampp\htdocs\Inventory_CI\application\views\templates/header_menu.php
INFO - 2025-11-05 19:39:21 --> File loaded: C:\xampp\htdocs\Inventory_CI\application\views\templates/side_menubar.php
INFO - 2025-11-05 19:39:21 --> File loaded: C:\xampp\htdocs\Inventory_CI\application\views\reporting/stock_report.php
INFO - 2025-11-05 19:39:21 --> File loaded: C:\xampp\htdocs\Inventory_CI\application\views\templates/footer.php
INFO - 2025-11-05 19:39:21 --> Final output sent to browser
DEBUG - 2025-11-05 19:39:21 --> Total execution time: 0.2692
INFO - 2025-11-05 19:39:23 --> Config Class Initialized
INFO - 2025-11-05 19:39:23 --> Hooks Class Initialized
DEBUG - 2025-11-05 19:39:23 --> UTF-8 Support Enabled
INFO - 2025-11-05 19:39:23 --> Utf8 Class Initialized
INFO - 2025-11-05 19:39:23 --> URI Class Initialized
INFO - 2025-11-05 19:39:23 --> Router Class Initialized
INFO - 2025-11-05 19:39:23 --> Output Class Initialized
INFO - 2025-11-05 19:39:23 --> Security Class Initialized
DEBUG - 2025-11-05 19:39:23 --> Global POST, GET and COOKIE data sanitized
INFO - 2025-11-05 19:39:23 --> Input Class Initialized
INFO - 2025-11-05 19:39:23 --> Language Class Initialized
INFO - 2025-11-05 19:39:23 --> Loader Class Initialized
INFO - 2025-11-05 19:39:23 --> Helper loaded: url_helper
INFO - 2025-11-05 19:39:23 --> Helper loaded: form_helper
INFO - 2025-11-05 19:39:23 --> Database Driver Class Initialized
DEBUG - 2025-11-05 19:39:23 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
INFO - 2025-11-05 19:39:23 --> Session: Class initialized using 'files' driver.
INFO - 2025-11-05 19:39:23 --> Form Validation Class Initialized
INFO - 2025-11-05 19:39:23 --> Controller Class Initialized
DEBUG - 2025-11-05 19:39:23 --> Session class already loaded. Second attempt ignored.
DEBUG - 2025-11-05 19:39:23 --> MY_Controller - Role: administrator
DEBUG - 2025-11-05 19:39:23 --> MY_Controller - Is Admin: true
DEBUG - 2025-11-05 19:39:23 --> MY_Controller - Permissions: Array
(
)

INFO - 2025-11-05 19:39:23 --> Model Class Initialized
INFO - 2025-11-05 19:39:23 --> Model Class Initialized
INFO - 2025-11-05 19:39:23 --> Model Class Initialized
INFO - 2025-11-05 19:39:23 --> Model Class Initialized
INFO - 2025-11-05 19:39:23 --> Model Class Initialized
INFO - 2025-11-05 19:39:23 --> Model Class Initialized
DEBUG - 2025-11-05 19:39:23 --> Controller_Reports initialized
INFO - 2025-11-05 19:39:23 --> Final output sent to browser
DEBUG - 2025-11-05 19:39:23 --> Total execution time: 0.2477
INFO - 2025-11-05 19:44:48 --> Config Class Initialized
INFO - 2025-11-05 19:44:48 --> Hooks Class Initialized
DEBUG - 2025-11-05 19:44:48 --> UTF-8 Support Enabled
INFO - 2025-11-05 19:44:48 --> Utf8 Class Initialized
INFO - 2025-11-05 19:44:48 --> URI Class Initialized
INFO - 2025-11-05 19:44:48 --> Router Class Initialized
INFO - 2025-11-05 19:44:48 --> Output Class Initialized
INFO - 2025-11-05 19:44:48 --> Security Class Initialized
DEBUG - 2025-11-05 19:44:48 --> Global POST, GET and COOKIE data sanitized
INFO - 2025-11-05 19:44:48 --> Input Class Initialized
INFO - 2025-11-05 19:44:48 --> Language Class Initialized
INFO - 2025-11-05 19:44:48 --> Loader Class Initialized
INFO - 2025-11-05 19:44:48 --> Helper loaded: url_helper
INFO - 2025-11-05 19:44:48 --> Helper loaded: form_helper
INFO - 2025-11-05 19:44:48 --> Database Driver Class Initialized
DEBUG - 2025-11-05 19:44:48 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
INFO - 2025-11-05 19:44:48 --> Session: Class initialized using 'files' driver.
INFO - 2025-11-05 19:44:48 --> Form Validation Class Initialized
INFO - 2025-11-05 19:44:48 --> Controller Class Initialized
DEBUG - 2025-11-05 19:44:48 --> Session class already loaded. Second attempt ignored.
DEBUG - 2025-11-05 19:44:48 --> MY_Controller - Role: administrator
DEBUG - 2025-11-05 19:44:48 --> MY_Controller - Is Admin: true
DEBUG - 2025-11-05 19:44:48 --> MY_Controller - Permissions: Array
(
)

INFO - 2025-11-05 19:44:48 --> Model Class Initialized
INFO - 2025-11-05 19:44:48 --> Model Class Initialized
INFO - 2025-11-05 19:44:48 --> Model Class Initialized
INFO - 2025-11-05 19:44:48 --> Model Class Initialized
INFO - 2025-11-05 19:44:48 --> Model Class Initialized
INFO - 2025-11-05 19:44:48 --> Model Class Initialized
DEBUG - 2025-11-05 19:44:48 --> Controller_Reports initialized
INFO - 2025-11-05 19:44:48 --> Model Class Initialized
INFO - 2025-11-05 19:44:48 --> Model Class Initialized
DEBUG - 2025-11-05 19:44:48 --> === Stock Report Debug ===
DEBUG - 2025-11-05 19:44:48 --> Filters being applied: {"category":null,"warehouse":null,"stock_status":null,"limit":10,"offset":0}
DEBUG - 2025-11-05 19:44:48 --> Calling getStockReport with params: {"limit":10,"offset":0,"filters":{"category":null,"warehouse":null,"stock_status":null,"limit":10,"offset":0}}
ERROR - 2025-11-05 19:44:48 --> Query error: Invalid use of group function - Invalid query: SELECT COUNT(DISTINCT p.id) as total_items, COALESCE(SUM(
                    CASE 
                        WHEN (COALESCE(SUM(pu.qty), 0) - COALESCE(SUM(oi.qty), 0)) > 0 
                        THEN (COALESCE(SUM(pu.qty), 0) - COALESCE(SUM(oi.qty), 0)) * COALESCE(MAX(pu.price), p.price)
                        ELSE 0 
                    END
                ), 0) as total_value, COALESCE(SUM(COALESCE(pu.total_amount, 0)), 0) as total_purchase_value, COUNT(DISTINCT CASE 
                    WHEN (COALESCE(SUM(pu.qty), 0) - COALESCE(SUM(oi.qty), 0)) > 0 
                    AND (COALESCE(SUM(pu.qty), 0) - COALESCE(SUM(oi.qty), 0)) <= 10 
                    THEN p.id 
                END) as low_stock_items, COUNT(DISTINCT CASE 
                    WHEN (COALESCE(SUM(pu.qty), 0) - COALESCE(SUM(oi.qty), 0)) <= 0 
                    THEN p.id 
                END) as out_of_stock_items
FROM `products` `p`
LEFT JOIN `purchases` `pu` ON `pu`.`product_id` = `p`.`id`
LEFT JOIN `orders_item` `oi` ON `oi`.`product_id` = `p`.`id`
LEFT JOIN `orders` `o` ON `o`.`id` = `oi`.`order_id` AND `o`.`paid_status` IN (1, 2)
GROUP BY `p`.`id`, `p`.`price`
DEBUG - 2025-11-05 19:44:48 --> Report data retrieved: {"has_data":true,"record_count":10,"total_items":59,"aggregates":{"total_items":0,"total_value":0,"total_purchase_value":0,"low_stock_items":0,"out_of_stock_items":0}}
DEBUG - 2025-11-05 19:44:48 --> Data being sent to view: {"stock_count":10,"aggregate_keys":["total_items","total_value","total_purchase_value","low_stock_items","out_of_stock_items"]}
INFO - 2025-11-05 19:44:48 --> File loaded: C:\xampp\htdocs\Inventory_CI\application\views\templates/header.php
INFO - 2025-11-05 19:44:48 --> File loaded: C:\xampp\htdocs\Inventory_CI\application\views\templates/header_menu.php
INFO - 2025-11-05 19:44:48 --> File loaded: C:\xampp\htdocs\Inventory_CI\application\views\templates/side_menubar.php
INFO - 2025-11-05 19:44:48 --> File loaded: C:\xampp\htdocs\Inventory_CI\application\views\reporting/stock_report.php
INFO - 2025-11-05 19:44:48 --> File loaded: C:\xampp\htdocs\Inventory_CI\application\views\templates/footer.php
INFO - 2025-11-05 19:44:48 --> Final output sent to browser
DEBUG - 2025-11-05 19:44:48 --> Total execution time: 0.2968
INFO - 2025-11-05 19:44:50 --> Config Class Initialized
INFO - 2025-11-05 19:44:50 --> Hooks Class Initialized
DEBUG - 2025-11-05 19:44:50 --> UTF-8 Support Enabled
INFO - 2025-11-05 19:44:50 --> Utf8 Class Initialized
INFO - 2025-11-05 19:44:50 --> URI Class Initialized
INFO - 2025-11-05 19:44:50 --> Router Class Initialized
INFO - 2025-11-05 19:44:50 --> Output Class Initialized
INFO - 2025-11-05 19:44:50 --> Security Class Initialized
DEBUG - 2025-11-05 19:44:50 --> Global POST, GET and COOKIE data sanitized
INFO - 2025-11-05 19:44:50 --> Input Class Initialized
INFO - 2025-11-05 19:44:50 --> Language Class Initialized
INFO - 2025-11-05 19:44:50 --> Loader Class Initialized
INFO - 2025-11-05 19:44:50 --> Helper loaded: url_helper
INFO - 2025-11-05 19:44:50 --> Helper loaded: form_helper
INFO - 2025-11-05 19:44:50 --> Database Driver Class Initialized
DEBUG - 2025-11-05 19:44:50 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
INFO - 2025-11-05 19:44:50 --> Session: Class initialized using 'files' driver.
INFO - 2025-11-05 19:44:50 --> Form Validation Class Initialized
INFO - 2025-11-05 19:44:50 --> Controller Class Initialized
DEBUG - 2025-11-05 19:44:50 --> Session class already loaded. Second attempt ignored.
DEBUG - 2025-11-05 19:44:50 --> MY_Controller - Role: administrator
DEBUG - 2025-11-05 19:44:50 --> MY_Controller - Is Admin: true
DEBUG - 2025-11-05 19:44:50 --> MY_Controller - Permissions: Array
(
)

INFO - 2025-11-05 19:44:50 --> Model Class Initialized
INFO - 2025-11-05 19:44:50 --> Model Class Initialized
INFO - 2025-11-05 19:44:50 --> Model Class Initialized
INFO - 2025-11-05 19:44:50 --> Model Class Initialized
INFO - 2025-11-05 19:44:50 --> Model Class Initialized
INFO - 2025-11-05 19:44:50 --> Model Class Initialized
DEBUG - 2025-11-05 19:44:50 --> Controller_Reports initialized
INFO - 2025-11-05 19:44:50 --> Final output sent to browser
DEBUG - 2025-11-05 19:44:50 --> Total execution time: 0.2067
INFO - 2025-11-05 19:45:46 --> Config Class Initialized
INFO - 2025-11-05 19:45:46 --> Hooks Class Initialized
DEBUG - 2025-11-05 19:45:46 --> UTF-8 Support Enabled
INFO - 2025-11-05 19:45:46 --> Utf8 Class Initialized
INFO - 2025-11-05 19:45:46 --> URI Class Initialized
INFO - 2025-11-05 19:45:46 --> Router Class Initialized
INFO - 2025-11-05 19:45:46 --> Output Class Initialized
INFO - 2025-11-05 19:45:46 --> Security Class Initialized
DEBUG - 2025-11-05 19:45:46 --> Global POST, GET and COOKIE data sanitized
INFO - 2025-11-05 19:45:46 --> Input Class Initialized
INFO - 2025-11-05 19:45:46 --> Language Class Initialized
INFO - 2025-11-05 19:45:47 --> Loader Class Initialized
INFO - 2025-11-05 19:45:47 --> Helper loaded: url_helper
INFO - 2025-11-05 19:45:47 --> Helper loaded: form_helper
INFO - 2025-11-05 19:45:47 --> Database Driver Class Initialized
DEBUG - 2025-11-05 19:45:47 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
INFO - 2025-11-05 19:45:47 --> Session: Class initialized using 'files' driver.
INFO - 2025-11-05 19:45:47 --> Form Validation Class Initialized
INFO - 2025-11-05 19:45:47 --> Controller Class Initialized
DEBUG - 2025-11-05 19:45:47 --> Session class already loaded. Second attempt ignored.
DEBUG - 2025-11-05 19:45:47 --> MY_Controller - Role: administrator
DEBUG - 2025-11-05 19:45:47 --> MY_Controller - Is Admin: true
DEBUG - 2025-11-05 19:45:47 --> MY_Controller - Permissions: Array
(
)

INFO - 2025-11-05 19:45:47 --> Model Class Initialized
INFO - 2025-11-05 19:45:47 --> Model Class Initialized
INFO - 2025-11-05 19:45:47 --> Model Class Initialized
INFO - 2025-11-05 19:45:47 --> Model Class Initialized
INFO - 2025-11-05 19:45:47 --> Model Class Initialized
INFO - 2025-11-05 19:45:47 --> Model Class Initialized
DEBUG - 2025-11-05 19:45:47 --> Controller_Reports initialized
INFO - 2025-11-05 19:45:47 --> Model Class Initialized
INFO - 2025-11-05 19:45:47 --> Model Class Initialized
DEBUG - 2025-11-05 19:45:47 --> === Stock Report Debug ===
DEBUG - 2025-11-05 19:45:47 --> Filters being applied: {"category":null,"warehouse":null,"stock_status":null,"limit":10,"offset":0}
DEBUG - 2025-11-05 19:45:47 --> Calling getStockReport with params: {"limit":10,"offset":0,"filters":{"category":null,"warehouse":null,"stock_status":null,"limit":10,"offset":0}}
ERROR - 2025-11-05 19:45:47 --> Query error: Invalid use of group function - Invalid query: SELECT COUNT(DISTINCT p.id) as total_items, COALESCE(SUM(
                    CASE 
                        WHEN (COALESCE(SUM(pu.qty), 0) - COALESCE(SUM(oi.qty), 0)) > 0 
                        THEN (COALESCE(SUM(pu.qty), 0) - COALESCE(SUM(oi.qty), 0)) * COALESCE(MAX(pu.price), p.price)
                        ELSE 0 
                    END
                ), 0) as total_value, COALESCE(SUM(COALESCE(pu.total_amount, 0)), 0) as total_purchase_value, COUNT(DISTINCT CASE 
                    WHEN (COALESCE(SUM(pu.qty), 0) - COALESCE(SUM(oi.qty), 0)) > 0 
                    AND (COALESCE(SUM(pu.qty), 0) - COALESCE(SUM(oi.qty), 0)) <= 10 
                    THEN p.id 
                END) as low_stock_items, COUNT(DISTINCT CASE 
                    WHEN (COALESCE(SUM(pu.qty), 0) - COALESCE(SUM(oi.qty), 0)) <= 0 
                    THEN p.id 
                END) as out_of_stock_items
FROM `products` `p`
LEFT JOIN `purchases` `pu` ON `pu`.`product_id` = `p`.`id`
LEFT JOIN `orders_item` `oi` ON `oi`.`product_id` = `p`.`id`
LEFT JOIN `orders` `o` ON `o`.`id` = `oi`.`order_id` AND `o`.`paid_status` IN (1, 2)
GROUP BY `p`.`id`, `p`.`price`
DEBUG - 2025-11-05 19:45:47 --> Report data retrieved: {"has_data":true,"record_count":10,"total_items":59,"aggregates":{"total_items":0,"total_value":0,"total_purchase_value":0,"low_stock_items":0,"out_of_stock_items":0}}
DEBUG - 2025-11-05 19:45:47 --> Data being sent to view: {"stock_count":10,"aggregate_keys":["total_items","total_value","total_purchase_value","low_stock_items","out_of_stock_items"]}
INFO - 2025-11-05 19:45:47 --> File loaded: C:\xampp\htdocs\Inventory_CI\application\views\templates/header.php
INFO - 2025-11-05 19:45:47 --> File loaded: C:\xampp\htdocs\Inventory_CI\application\views\templates/header_menu.php
INFO - 2025-11-05 19:45:47 --> File loaded: C:\xampp\htdocs\Inventory_CI\application\views\templates/side_menubar.php
INFO - 2025-11-05 19:45:47 --> File loaded: C:\xampp\htdocs\Inventory_CI\application\views\reporting/stock_report.php
INFO - 2025-11-05 19:45:47 --> File loaded: C:\xampp\htdocs\Inventory_CI\application\views\templates/footer.php
INFO - 2025-11-05 19:45:47 --> Final output sent to browser
DEBUG - 2025-11-05 19:45:47 --> Total execution time: 0.2242
INFO - 2025-11-05 19:45:48 --> Config Class Initialized
INFO - 2025-11-05 19:45:48 --> Hooks Class Initialized
DEBUG - 2025-11-05 19:45:48 --> UTF-8 Support Enabled
INFO - 2025-11-05 19:45:48 --> Utf8 Class Initialized
INFO - 2025-11-05 19:45:48 --> URI Class Initialized
INFO - 2025-11-05 19:45:48 --> Router Class Initialized
INFO - 2025-11-05 19:45:48 --> Output Class Initialized
INFO - 2025-11-05 19:45:48 --> Security Class Initialized
DEBUG - 2025-11-05 19:45:48 --> Global POST, GET and COOKIE data sanitized
INFO - 2025-11-05 19:45:48 --> Input Class Initialized
INFO - 2025-11-05 19:45:48 --> Language Class Initialized
INFO - 2025-11-05 19:45:48 --> Loader Class Initialized
INFO - 2025-11-05 19:45:48 --> Helper loaded: url_helper
INFO - 2025-11-05 19:45:48 --> Helper loaded: form_helper
INFO - 2025-11-05 19:45:48 --> Database Driver Class Initialized
DEBUG - 2025-11-05 19:45:48 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
INFO - 2025-11-05 19:45:48 --> Session: Class initialized using 'files' driver.
INFO - 2025-11-05 19:45:48 --> Form Validation Class Initialized
INFO - 2025-11-05 19:45:48 --> Controller Class Initialized
DEBUG - 2025-11-05 19:45:48 --> Session class already loaded. Second attempt ignored.
DEBUG - 2025-11-05 19:45:48 --> MY_Controller - Role: administrator
DEBUG - 2025-11-05 19:45:48 --> MY_Controller - Is Admin: true
DEBUG - 2025-11-05 19:45:48 --> MY_Controller - Permissions: Array
(
)

INFO - 2025-11-05 19:45:48 --> Model Class Initialized
INFO - 2025-11-05 19:45:48 --> Model Class Initialized
INFO - 2025-11-05 19:45:48 --> Model Class Initialized
INFO - 2025-11-05 19:45:48 --> Model Class Initialized
INFO - 2025-11-05 19:45:48 --> Model Class Initialized
INFO - 2025-11-05 19:45:48 --> Model Class Initialized
DEBUG - 2025-11-05 19:45:48 --> Controller_Reports initialized
INFO - 2025-11-05 19:45:48 --> Final output sent to browser
DEBUG - 2025-11-05 19:45:48 --> Total execution time: 0.2106
INFO - 2025-11-05 19:46:17 --> Config Class Initialized
INFO - 2025-11-05 19:46:17 --> Hooks Class Initialized
DEBUG - 2025-11-05 19:46:17 --> UTF-8 Support Enabled
INFO - 2025-11-05 19:46:17 --> Utf8 Class Initialized
INFO - 2025-11-05 19:46:17 --> URI Class Initialized
INFO - 2025-11-05 19:46:17 --> Router Class Initialized
INFO - 2025-11-05 19:46:17 --> Output Class Initialized
INFO - 2025-11-05 19:46:17 --> Security Class Initialized
DEBUG - 2025-11-05 19:46:17 --> Global POST, GET and COOKIE data sanitized
INFO - 2025-11-05 19:46:17 --> Input Class Initialized
INFO - 2025-11-05 19:46:17 --> Language Class Initialized
INFO - 2025-11-05 19:46:17 --> Loader Class Initialized
INFO - 2025-11-05 19:46:17 --> Helper loaded: url_helper
INFO - 2025-11-05 19:46:17 --> Helper loaded: form_helper
INFO - 2025-11-05 19:46:17 --> Database Driver Class Initialized
DEBUG - 2025-11-05 19:46:17 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
INFO - 2025-11-05 19:46:17 --> Session: Class initialized using 'files' driver.
INFO - 2025-11-05 19:46:17 --> Form Validation Class Initialized
INFO - 2025-11-05 19:46:17 --> Controller Class Initialized
DEBUG - 2025-11-05 19:46:17 --> Session class already loaded. Second attempt ignored.
DEBUG - 2025-11-05 19:46:17 --> MY_Controller - Role: administrator
DEBUG - 2025-11-05 19:46:17 --> MY_Controller - Is Admin: true
DEBUG - 2025-11-05 19:46:17 --> MY_Controller - Permissions: Array
(
)

INFO - 2025-11-05 19:46:17 --> Model Class Initialized
INFO - 2025-11-05 19:46:17 --> Model Class Initialized
INFO - 2025-11-05 19:46:17 --> Model Class Initialized
INFO - 2025-11-05 19:46:17 --> Model Class Initialized
INFO - 2025-11-05 19:46:17 --> Model Class Initialized
INFO - 2025-11-05 19:46:17 --> Model Class Initialized
DEBUG - 2025-11-05 19:46:17 --> Controller_Reports initialized
INFO - 2025-11-05 19:46:17 --> Final output sent to browser
DEBUG - 2025-11-05 19:46:17 --> Total execution time: 0.1596
INFO - 2025-11-05 19:47:01 --> Config Class Initialized
INFO - 2025-11-05 19:47:01 --> Hooks Class Initialized
DEBUG - 2025-11-05 19:47:01 --> UTF-8 Support Enabled
INFO - 2025-11-05 19:47:01 --> Utf8 Class Initialized
INFO - 2025-11-05 19:47:01 --> URI Class Initialized
INFO - 2025-11-05 19:47:01 --> Router Class Initialized
INFO - 2025-11-05 19:47:02 --> Output Class Initialized
INFO - 2025-11-05 19:47:02 --> Security Class Initialized
DEBUG - 2025-11-05 19:47:02 --> Global POST, GET and COOKIE data sanitized
INFO - 2025-11-05 19:47:02 --> Input Class Initialized
INFO - 2025-11-05 19:47:02 --> Language Class Initialized
INFO - 2025-11-05 19:47:02 --> Loader Class Initialized
INFO - 2025-11-05 19:47:02 --> Helper loaded: url_helper
INFO - 2025-11-05 19:47:02 --> Helper loaded: form_helper
INFO - 2025-11-05 19:47:02 --> Database Driver Class Initialized
DEBUG - 2025-11-05 19:47:02 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
INFO - 2025-11-05 19:47:02 --> Session: Class initialized using 'files' driver.
INFO - 2025-11-05 19:47:02 --> Form Validation Class Initialized
INFO - 2025-11-05 19:47:02 --> Controller Class Initialized
DEBUG - 2025-11-05 19:47:02 --> Session class already loaded. Second attempt ignored.
DEBUG - 2025-11-05 19:47:02 --> MY_Controller - Role: administrator
DEBUG - 2025-11-05 19:47:02 --> MY_Controller - Is Admin: true
DEBUG - 2025-11-05 19:47:02 --> MY_Controller - Permissions: Array
(
)

INFO - 2025-11-05 19:47:02 --> Model Class Initialized
INFO - 2025-11-05 19:47:02 --> Model Class Initialized
INFO - 2025-11-05 19:47:02 --> Model Class Initialized
INFO - 2025-11-05 19:47:02 --> Model Class Initialized
INFO - 2025-11-05 19:47:02 --> Model Class Initialized
INFO - 2025-11-05 19:47:02 --> Model Class Initialized
DEBUG - 2025-11-05 19:47:02 --> Controller_Reports initialized
INFO - 2025-11-05 19:47:02 --> Model Class Initialized
INFO - 2025-11-05 19:47:02 --> Model Class Initialized
DEBUG - 2025-11-05 19:47:02 --> === Stock Report Debug ===
DEBUG - 2025-11-05 19:47:02 --> Filters being applied: {"category":null,"warehouse":null,"stock_status":null,"limit":10,"offset":0}
DEBUG - 2025-11-05 19:47:02 --> Calling getStockReport with params: {"limit":10,"offset":0,"filters":{"category":null,"warehouse":null,"stock_status":null,"limit":10,"offset":0}}
ERROR - 2025-11-05 19:47:02 --> Query error: Invalid use of group function - Invalid query: SELECT COUNT(DISTINCT p.id) as total_items, COALESCE(SUM(
                    CASE 
                        WHEN (COALESCE(SUM(pu.qty), 0) - COALESCE(SUM(oi.qty), 0)) > 0 
                        THEN (COALESCE(SUM(pu.qty), 0) - COALESCE(SUM(oi.qty), 0)) * COALESCE(MAX(pu.price), p.price)
                        ELSE 0 
                    END
                ), 0) as total_value, COALESCE(SUM(COALESCE(pu.total_amount, 0)), 0) as total_purchase_value, COUNT(DISTINCT CASE 
                    WHEN (COALESCE(SUM(pu.qty), 0) - COALESCE(SUM(oi.qty), 0)) > 0 
                    AND (COALESCE(SUM(pu.qty), 0) - COALESCE(SUM(oi.qty), 0)) <= 10 
                    THEN p.id 
                END) as low_stock_items, COUNT(DISTINCT CASE 
                    WHEN (COALESCE(SUM(pu.qty), 0) - COALESCE(SUM(oi.qty), 0)) <= 0 
                    THEN p.id 
                END) as out_of_stock_items
FROM `products` `p`
LEFT JOIN `purchases` `pu` ON `pu`.`product_id` = `p`.`id`
LEFT JOIN `orders_item` `oi` ON `oi`.`product_id` = `p`.`id`
LEFT JOIN `orders` `o` ON `o`.`id` = `oi`.`order_id` AND `o`.`paid_status` IN (1, 2)
GROUP BY `p`.`id`, `p`.`price`
DEBUG - 2025-11-05 19:47:02 --> Report data retrieved: {"has_data":true,"record_count":10,"total_items":59,"aggregates":{"total_items":0,"total_value":0,"total_purchase_value":0,"low_stock_items":0,"out_of_stock_items":0}}
DEBUG - 2025-11-05 19:47:02 --> Data being sent to view: {"stock_count":10,"aggregate_keys":["total_items","total_value","total_purchase_value","low_stock_items","out_of_stock_items"]}
INFO - 2025-11-05 19:47:02 --> File loaded: C:\xampp\htdocs\Inventory_CI\application\views\templates/header.php
INFO - 2025-11-05 19:47:02 --> File loaded: C:\xampp\htdocs\Inventory_CI\application\views\templates/header_menu.php
INFO - 2025-11-05 19:47:02 --> File loaded: C:\xampp\htdocs\Inventory_CI\application\views\templates/side_menubar.php
INFO - 2025-11-05 19:47:02 --> File loaded: C:\xampp\htdocs\Inventory_CI\application\views\reporting/stock_report.php
INFO - 2025-11-05 19:47:02 --> File loaded: C:\xampp\htdocs\Inventory_CI\application\views\templates/footer.php
INFO - 2025-11-05 19:47:02 --> Final output sent to browser
DEBUG - 2025-11-05 19:47:02 --> Total execution time: 0.2748
INFO - 2025-11-05 19:47:03 --> Config Class Initialized
INFO - 2025-11-05 19:47:03 --> Hooks Class Initialized
DEBUG - 2025-11-05 19:47:03 --> UTF-8 Support Enabled
INFO - 2025-11-05 19:47:03 --> Utf8 Class Initialized
INFO - 2025-11-05 19:47:03 --> URI Class Initialized
INFO - 2025-11-05 19:47:03 --> Router Class Initialized
INFO - 2025-11-05 19:47:03 --> Output Class Initialized
INFO - 2025-11-05 19:47:03 --> Security Class Initialized
DEBUG - 2025-11-05 19:47:03 --> Global POST, GET and COOKIE data sanitized
INFO - 2025-11-05 19:47:03 --> Input Class Initialized
INFO - 2025-11-05 19:47:03 --> Language Class Initialized
INFO - 2025-11-05 19:47:03 --> Loader Class Initialized
INFO - 2025-11-05 19:47:03 --> Helper loaded: url_helper
INFO - 2025-11-05 19:47:03 --> Helper loaded: form_helper
INFO - 2025-11-05 19:47:03 --> Database Driver Class Initialized
DEBUG - 2025-11-05 19:47:03 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
INFO - 2025-11-05 19:47:03 --> Session: Class initialized using 'files' driver.
INFO - 2025-11-05 19:47:03 --> Form Validation Class Initialized
INFO - 2025-11-05 19:47:03 --> Controller Class Initialized
DEBUG - 2025-11-05 19:47:03 --> Session class already loaded. Second attempt ignored.
DEBUG - 2025-11-05 19:47:03 --> MY_Controller - Role: administrator
DEBUG - 2025-11-05 19:47:03 --> MY_Controller - Is Admin: true
DEBUG - 2025-11-05 19:47:03 --> MY_Controller - Permissions: Array
(
)

INFO - 2025-11-05 19:47:03 --> Model Class Initialized
INFO - 2025-11-05 19:47:03 --> Model Class Initialized
INFO - 2025-11-05 19:47:03 --> Model Class Initialized
INFO - 2025-11-05 19:47:03 --> Model Class Initialized
INFO - 2025-11-05 19:47:03 --> Model Class Initialized
INFO - 2025-11-05 19:47:03 --> Model Class Initialized
DEBUG - 2025-11-05 19:47:03 --> Controller_Reports initialized
INFO - 2025-11-05 19:47:03 --> Final output sent to browser
DEBUG - 2025-11-05 19:47:03 --> Total execution time: 0.2065
INFO - 2025-11-05 19:47:14 --> Config Class Initialized
INFO - 2025-11-05 19:47:14 --> Hooks Class Initialized
DEBUG - 2025-11-05 19:47:14 --> UTF-8 Support Enabled
INFO - 2025-11-05 19:47:14 --> Utf8 Class Initialized
INFO - 2025-11-05 19:47:14 --> URI Class Initialized
INFO - 2025-11-05 19:47:14 --> Router Class Initialized
INFO - 2025-11-05 19:47:14 --> Output Class Initialized
INFO - 2025-11-05 19:47:14 --> Security Class Initialized
DEBUG - 2025-11-05 19:47:14 --> Global POST, GET and COOKIE data sanitized
INFO - 2025-11-05 19:47:14 --> Input Class Initialized
INFO - 2025-11-05 19:47:14 --> Language Class Initialized
INFO - 2025-11-05 19:47:14 --> Loader Class Initialized
INFO - 2025-11-05 19:47:14 --> Helper loaded: url_helper
INFO - 2025-11-05 19:47:14 --> Helper loaded: form_helper
INFO - 2025-11-05 19:47:14 --> Database Driver Class Initialized
DEBUG - 2025-11-05 19:47:14 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
INFO - 2025-11-05 19:47:14 --> Session: Class initialized using 'files' driver.
INFO - 2025-11-05 19:47:14 --> Form Validation Class Initialized
INFO - 2025-11-05 19:47:14 --> Controller Class Initialized
DEBUG - 2025-11-05 19:47:14 --> Session class already loaded. Second attempt ignored.
DEBUG - 2025-11-05 19:47:14 --> MY_Controller - Role: administrator
DEBUG - 2025-11-05 19:47:14 --> MY_Controller - Is Admin: true
DEBUG - 2025-11-05 19:47:14 --> MY_Controller - Permissions: Array
(
)

INFO - 2025-11-05 19:47:14 --> Model Class Initialized
INFO - 2025-11-05 19:47:14 --> Model Class Initialized
INFO - 2025-11-05 19:47:14 --> Model Class Initialized
INFO - 2025-11-05 19:47:14 --> Model Class Initialized
INFO - 2025-11-05 19:47:14 --> Model Class Initialized
INFO - 2025-11-05 19:47:14 --> Model Class Initialized
DEBUG - 2025-11-05 19:47:14 --> Controller_Reports initialized
INFO - 2025-11-05 19:47:14 --> Final output sent to browser
DEBUG - 2025-11-05 19:47:14 --> Total execution time: 0.2058
INFO - 2025-11-05 19:47:40 --> Config Class Initialized
INFO - 2025-11-05 19:47:40 --> Hooks Class Initialized
DEBUG - 2025-11-05 19:47:40 --> UTF-8 Support Enabled
INFO - 2025-11-05 19:47:40 --> Utf8 Class Initialized
INFO - 2025-11-05 19:47:40 --> URI Class Initialized
INFO - 2025-11-05 19:47:40 --> Router Class Initialized
INFO - 2025-11-05 19:47:40 --> Output Class Initialized
INFO - 2025-11-05 19:47:40 --> Security Class Initialized
DEBUG - 2025-11-05 19:47:40 --> Global POST, GET and COOKIE data sanitized
INFO - 2025-11-05 19:47:40 --> Input Class Initialized
INFO - 2025-11-05 19:47:40 --> Language Class Initialized
INFO - 2025-11-05 19:47:40 --> Loader Class Initialized
INFO - 2025-11-05 19:47:40 --> Helper loaded: url_helper
INFO - 2025-11-05 19:47:40 --> Helper loaded: form_helper
INFO - 2025-11-05 19:47:40 --> Database Driver Class Initialized
DEBUG - 2025-11-05 19:47:40 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
INFO - 2025-11-05 19:47:40 --> Session: Class initialized using 'files' driver.
INFO - 2025-11-05 19:47:40 --> Form Validation Class Initialized
INFO - 2025-11-05 19:47:40 --> Controller Class Initialized
DEBUG - 2025-11-05 19:47:40 --> Session class already loaded. Second attempt ignored.
DEBUG - 2025-11-05 19:47:40 --> MY_Controller - Role: administrator
DEBUG - 2025-11-05 19:47:40 --> MY_Controller - Is Admin: true
DEBUG - 2025-11-05 19:47:40 --> MY_Controller - Permissions: Array
(
)

INFO - 2025-11-05 19:47:40 --> Model Class Initialized
INFO - 2025-11-05 19:47:40 --> Model Class Initialized
INFO - 2025-11-05 19:47:40 --> Model Class Initialized
INFO - 2025-11-05 19:47:40 --> Model Class Initialized
INFO - 2025-11-05 19:47:40 --> Model Class Initialized
INFO - 2025-11-05 19:47:40 --> Model Class Initialized
DEBUG - 2025-11-05 19:47:40 --> Controller_Reports initialized
INFO - 2025-11-05 19:47:40 --> Model Class Initialized
DEBUG - 2025-11-05 19:47:40 --> === SALES REPORT DEBUG START ===
DEBUG - 2025-11-05 19:47:40 --> Filters received: {"date_from":"2025-10-06","date_to":"2025-11-05","warehouse":null,"status":null}
DEBUG - 2025-11-05 19:47:40 --> date_from: 2025-10-06
DEBUG - 2025-11-05 19:47:40 --> date_to: 2025-11-05
DEBUG - 2025-11-05 19:47:40 --> warehouse: not set
DEBUG - 2025-11-05 19:47:40 --> status: not set
DEBUG - 2025-11-05 19:47:40 --> Applied date_from: 2025-10-06
DEBUG - 2025-11-05 19:47:40 --> Applied date_to: 2025-11-05
DEBUG - 2025-11-05 19:47:40 --> Generated SQL: SELECT `o`.`store_id`, `o`.`id` AS `order_id`, `o`.`date_time`, `o`.`amount_paid`, `o`.`paid_status`, `oi`.`qty` AS `quantity`, `oi`.`rate` AS `price`, `oi`.`amount` AS `amount`, `p`.`name` AS `product_name`, `p`.`id` AS `product_id`, COALESCE(o.customer_name, "Walk-in") AS customer_name
FROM `orders` `o`
INNER JOIN `orders_item` `oi` ON `o`.`id` = `oi`.`order_id`
LEFT JOIN `products` `p` ON `oi`.`product_id` = `p`.`id`
WHERE DATE(o.date_time) >= '2025-10-06'
AND DATE(o.date_time) <= '2025-11-05'
DEBUG - 2025-11-05 19:47:40 --> Query returned 273 rows
DEBUG - 2025-11-05 19:47:40 --> === SALES REPORT DEBUG END ===
DEBUG - 2025-11-05 19:47:40 --> Controller_Reports::sales_report rows fetched: 273
INFO - 2025-11-05 19:47:40 --> File loaded: C:\xampp\htdocs\Inventory_CI\application\views\templates/header.php
INFO - 2025-11-05 19:47:40 --> File loaded: C:\xampp\htdocs\Inventory_CI\application\views\templates/header_menu.php
INFO - 2025-11-05 19:47:40 --> File loaded: C:\xampp\htdocs\Inventory_CI\application\views\templates/side_menubar.php
INFO - 2025-11-05 19:47:41 --> File loaded: C:\xampp\htdocs\Inventory_CI\application\views\reporting/sales_report.php
INFO - 2025-11-05 19:47:41 --> File loaded: C:\xampp\htdocs\Inventory_CI\application\views\templates/footer.php
INFO - 2025-11-05 19:47:41 --> Final output sent to browser
DEBUG - 2025-11-05 19:47:41 --> Total execution time: 0.9752
INFO - 2025-11-05 19:48:08 --> Config Class Initialized
INFO - 2025-11-05 19:48:08 --> Hooks Class Initialized
DEBUG - 2025-11-05 19:48:08 --> UTF-8 Support Enabled
INFO - 2025-11-05 19:48:08 --> Utf8 Class Initialized
INFO - 2025-11-05 19:48:08 --> URI Class Initialized
INFO - 2025-11-05 19:48:08 --> Router Class Initialized
INFO - 2025-11-05 19:48:08 --> Output Class Initialized
INFO - 2025-11-05 19:48:08 --> Security Class Initialized
DEBUG - 2025-11-05 19:48:08 --> Global POST, GET and COOKIE data sanitized
INFO - 2025-11-05 19:48:08 --> Input Class Initialized
INFO - 2025-11-05 19:48:08 --> Language Class Initialized
INFO - 2025-11-05 19:48:08 --> Loader Class Initialized
INFO - 2025-11-05 19:48:08 --> Helper loaded: url_helper
INFO - 2025-11-05 19:48:08 --> Helper loaded: form_helper
INFO - 2025-11-05 19:48:08 --> Database Driver Class Initialized
DEBUG - 2025-11-05 19:48:08 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
INFO - 2025-11-05 19:48:08 --> Session: Class initialized using 'files' driver.
INFO - 2025-11-05 19:48:08 --> Form Validation Class Initialized
INFO - 2025-11-05 19:48:08 --> Controller Class Initialized
DEBUG - 2025-11-05 19:48:08 --> Session class already loaded. Second attempt ignored.
DEBUG - 2025-11-05 19:48:08 --> MY_Controller - Role: administrator
DEBUG - 2025-11-05 19:48:08 --> MY_Controller - Is Admin: true
DEBUG - 2025-11-05 19:48:08 --> MY_Controller - Permissions: Array
(
)

INFO - 2025-11-05 19:48:08 --> Model Class Initialized
INFO - 2025-11-05 19:48:08 --> Model Class Initialized
INFO - 2025-11-05 19:48:08 --> Model Class Initialized
INFO - 2025-11-05 19:48:08 --> Model Class Initialized
INFO - 2025-11-05 19:48:08 --> Model Class Initialized
INFO - 2025-11-05 19:48:08 --> Model Class Initialized
DEBUG - 2025-11-05 19:48:08 --> Controller_Reports initialized
INFO - 2025-11-05 19:48:08 --> Model Class Initialized
DEBUG - 2025-11-05 19:48:08 --> === SALES REPORT DEBUG START ===
DEBUG - 2025-11-05 19:48:08 --> Filters received: {"date_from":"2025-10-06","date_to":"2025-11-05","warehouse":null,"status":null}
DEBUG - 2025-11-05 19:48:08 --> date_from: 2025-10-06
DEBUG - 2025-11-05 19:48:08 --> date_to: 2025-11-05
DEBUG - 2025-11-05 19:48:08 --> warehouse: not set
DEBUG - 2025-11-05 19:48:08 --> status: not set
DEBUG - 2025-11-05 19:48:08 --> Applied date_from: 2025-10-06
DEBUG - 2025-11-05 19:48:08 --> Applied date_to: 2025-11-05
DEBUG - 2025-11-05 19:48:08 --> Generated SQL: SELECT `o`.`store_id`, `o`.`id` AS `order_id`, `o`.`date_time`, `o`.`amount_paid`, `o`.`paid_status`, `oi`.`qty` AS `quantity`, `oi`.`rate` AS `price`, `oi`.`amount` AS `amount`, `p`.`name` AS `product_name`, `p`.`id` AS `product_id`, COALESCE(o.customer_name, "Walk-in") AS customer_name
FROM `orders` `o`
INNER JOIN `orders_item` `oi` ON `o`.`id` = `oi`.`order_id`
LEFT JOIN `products` `p` ON `oi`.`product_id` = `p`.`id`
WHERE DATE(o.date_time) >= '2025-10-06'
AND DATE(o.date_time) <= '2025-11-05'
DEBUG - 2025-11-05 19:48:08 --> Query returned 273 rows
DEBUG - 2025-11-05 19:48:08 --> === SALES REPORT DEBUG END ===
DEBUG - 2025-11-05 19:48:08 --> Controller_Reports::sales_report rows fetched: 273
INFO - 2025-11-05 19:48:08 --> File loaded: C:\xampp\htdocs\Inventory_CI\application\views\templates/header.php
INFO - 2025-11-05 19:48:08 --> File loaded: C:\xampp\htdocs\Inventory_CI\application\views\templates/header_menu.php
INFO - 2025-11-05 19:48:08 --> File loaded: C:\xampp\htdocs\Inventory_CI\application\views\templates/side_menubar.php
INFO - 2025-11-05 19:48:08 --> File loaded: C:\xampp\htdocs\Inventory_CI\application\views\reporting/sales_report.php
INFO - 2025-11-05 19:48:08 --> File loaded: C:\xampp\htdocs\Inventory_CI\application\views\templates/footer.php
INFO - 2025-11-05 19:48:08 --> Final output sent to browser
DEBUG - 2025-11-05 19:48:08 --> Total execution time: 0.2383
INFO - 2025-11-05 19:48:17 --> Config Class Initialized
INFO - 2025-11-05 19:48:17 --> Hooks Class Initialized
DEBUG - 2025-11-05 19:48:17 --> UTF-8 Support Enabled
INFO - 2025-11-05 19:48:17 --> Utf8 Class Initialized
INFO - 2025-11-05 19:48:17 --> URI Class Initialized
INFO - 2025-11-05 19:48:17 --> Router Class Initialized
INFO - 2025-11-05 19:48:17 --> Output Class Initialized
INFO - 2025-11-05 19:48:17 --> Security Class Initialized
DEBUG - 2025-11-05 19:48:17 --> Global POST, GET and COOKIE data sanitized
INFO - 2025-11-05 19:48:17 --> Input Class Initialized
INFO - 2025-11-05 19:48:17 --> Language Class Initialized
INFO - 2025-11-05 19:48:17 --> Loader Class Initialized
INFO - 2025-11-05 19:48:17 --> Helper loaded: url_helper
INFO - 2025-11-05 19:48:17 --> Helper loaded: form_helper
INFO - 2025-11-05 19:48:17 --> Database Driver Class Initialized
DEBUG - 2025-11-05 19:48:17 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
INFO - 2025-11-05 19:48:17 --> Session: Class initialized using 'files' driver.
INFO - 2025-11-05 19:48:17 --> Form Validation Class Initialized
INFO - 2025-11-05 19:48:17 --> Controller Class Initialized
DEBUG - 2025-11-05 19:48:17 --> Session class already loaded. Second attempt ignored.
DEBUG - 2025-11-05 19:48:17 --> MY_Controller - Role: administrator
DEBUG - 2025-11-05 19:48:17 --> MY_Controller - Is Admin: true
DEBUG - 2025-11-05 19:48:17 --> MY_Controller - Permissions: Array
(
)

INFO - 2025-11-05 19:48:17 --> Model Class Initialized
INFO - 2025-11-05 19:48:17 --> Model Class Initialized
INFO - 2025-11-05 19:48:17 --> Model Class Initialized
INFO - 2025-11-05 19:48:17 --> Model Class Initialized
INFO - 2025-11-05 19:48:17 --> Model Class Initialized
INFO - 2025-11-05 19:48:17 --> Model Class Initialized
DEBUG - 2025-11-05 19:48:17 --> Controller_Reports initialized
INFO - 2025-11-05 19:48:17 --> Model Class Initialized
INFO - 2025-11-05 19:48:17 --> Model Class Initialized
DEBUG - 2025-11-05 19:48:17 --> === Stock Report Debug ===
DEBUG - 2025-11-05 19:48:17 --> Filters being applied: {"category":null,"warehouse":null,"stock_status":null,"limit":10,"offset":0}
DEBUG - 2025-11-05 19:48:17 --> Calling getStockReport with params: {"limit":10,"offset":0,"filters":{"category":null,"warehouse":null,"stock_status":null,"limit":10,"offset":0}}
ERROR - 2025-11-05 19:48:17 --> Query error: Invalid use of group function - Invalid query: SELECT COUNT(DISTINCT p.id) as total_items, COALESCE(SUM(
                    CASE 
                        WHEN (COALESCE(SUM(pu.qty), 0) - COALESCE(SUM(oi.qty), 0)) > 0 
                        THEN (COALESCE(SUM(pu.qty), 0) - COALESCE(SUM(oi.qty), 0)) * COALESCE(MAX(pu.price), p.price)
                        ELSE 0 
                    END
                ), 0) as total_value, COALESCE(SUM(COALESCE(pu.total_amount, 0)), 0) as total_purchase_value, COUNT(DISTINCT CASE 
                    WHEN (COALESCE(SUM(pu.qty), 0) - COALESCE(SUM(oi.qty), 0)) > 0 
                    AND (COALESCE(SUM(pu.qty), 0) - COALESCE(SUM(oi.qty), 0)) <= 10 
                    THEN p.id 
                END) as low_stock_items, COUNT(DISTINCT CASE 
                    WHEN (COALESCE(SUM(pu.qty), 0) - COALESCE(SUM(oi.qty), 0)) <= 0 
                    THEN p.id 
                END) as out_of_stock_items
FROM `products` `p`
LEFT JOIN `purchases` `pu` ON `pu`.`product_id` = `p`.`id`
LEFT JOIN `orders_item` `oi` ON `oi`.`product_id` = `p`.`id`
LEFT JOIN `orders` `o` ON `o`.`id` = `oi`.`order_id` AND `o`.`paid_status` IN (1, 2)
GROUP BY `p`.`id`, `p`.`price`
DEBUG - 2025-11-05 19:48:17 --> Report data retrieved: {"has_data":true,"record_count":10,"total_items":59,"aggregates":{"total_items":0,"total_value":0,"total_purchase_value":0,"low_stock_items":0,"out_of_stock_items":0}}
DEBUG - 2025-11-05 19:48:17 --> Data being sent to view: {"stock_count":10,"aggregate_keys":["total_items","total_value","total_purchase_value","low_stock_items","out_of_stock_items"]}
INFO - 2025-11-05 19:48:17 --> File loaded: C:\xampp\htdocs\Inventory_CI\application\views\templates/header.php
INFO - 2025-11-05 19:48:17 --> File loaded: C:\xampp\htdocs\Inventory_CI\application\views\templates/header_menu.php
INFO - 2025-11-05 19:48:17 --> File loaded: C:\xampp\htdocs\Inventory_CI\application\views\templates/side_menubar.php
INFO - 2025-11-05 19:48:17 --> File loaded: C:\xampp\htdocs\Inventory_CI\application\views\reporting/stock_report.php
INFO - 2025-11-05 19:48:17 --> File loaded: C:\xampp\htdocs\Inventory_CI\application\views\templates/footer.php
INFO - 2025-11-05 19:48:17 --> Final output sent to browser
DEBUG - 2025-11-05 19:48:17 --> Total execution time: 0.2814
INFO - 2025-11-05 19:48:19 --> Config Class Initialized
INFO - 2025-11-05 19:48:19 --> Hooks Class Initialized
DEBUG - 2025-11-05 19:48:19 --> UTF-8 Support Enabled
INFO - 2025-11-05 19:48:19 --> Utf8 Class Initialized
INFO - 2025-11-05 19:48:19 --> URI Class Initialized
INFO - 2025-11-05 19:48:19 --> Router Class Initialized
INFO - 2025-11-05 19:48:19 --> Output Class Initialized
INFO - 2025-11-05 19:48:19 --> Security Class Initialized
DEBUG - 2025-11-05 19:48:19 --> Global POST, GET and COOKIE data sanitized
INFO - 2025-11-05 19:48:19 --> Input Class Initialized
INFO - 2025-11-05 19:48:19 --> Language Class Initialized
INFO - 2025-11-05 19:48:19 --> Loader Class Initialized
INFO - 2025-11-05 19:48:19 --> Helper loaded: url_helper
INFO - 2025-11-05 19:48:19 --> Helper loaded: form_helper
INFO - 2025-11-05 19:48:19 --> Database Driver Class Initialized
DEBUG - 2025-11-05 19:48:19 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
INFO - 2025-11-05 19:48:19 --> Session: Class initialized using 'files' driver.
INFO - 2025-11-05 19:48:19 --> Form Validation Class Initialized
INFO - 2025-11-05 19:48:19 --> Controller Class Initialized
DEBUG - 2025-11-05 19:48:19 --> Session class already loaded. Second attempt ignored.
DEBUG - 2025-11-05 19:48:19 --> MY_Controller - Role: administrator
DEBUG - 2025-11-05 19:48:19 --> MY_Controller - Is Admin: true
DEBUG - 2025-11-05 19:48:19 --> MY_Controller - Permissions: Array
(
)

INFO - 2025-11-05 19:48:19 --> Model Class Initialized
INFO - 2025-11-05 19:48:19 --> Model Class Initialized
INFO - 2025-11-05 19:48:19 --> Model Class Initialized
INFO - 2025-11-05 19:48:19 --> Model Class Initialized
INFO - 2025-11-05 19:48:19 --> Model Class Initialized
INFO - 2025-11-05 19:48:19 --> Model Class Initialized
DEBUG - 2025-11-05 19:48:19 --> Controller_Reports initialized
INFO - 2025-11-05 19:48:19 --> Final output sent to browser
DEBUG - 2025-11-05 19:48:19 --> Total execution time: 0.1777
INFO - 2025-11-05 19:48:34 --> Config Class Initialized
INFO - 2025-11-05 19:48:34 --> Hooks Class Initialized
DEBUG - 2025-11-05 19:48:34 --> UTF-8 Support Enabled
INFO - 2025-11-05 19:48:34 --> Utf8 Class Initialized
INFO - 2025-11-05 19:48:34 --> URI Class Initialized
INFO - 2025-11-05 19:48:34 --> Router Class Initialized
INFO - 2025-11-05 19:48:34 --> Output Class Initialized
INFO - 2025-11-05 19:48:34 --> Security Class Initialized
DEBUG - 2025-11-05 19:48:34 --> Global POST, GET and COOKIE data sanitized
INFO - 2025-11-05 19:48:34 --> Input Class Initialized
INFO - 2025-11-05 19:48:34 --> Language Class Initialized
INFO - 2025-11-05 19:48:34 --> Loader Class Initialized
INFO - 2025-11-05 19:48:34 --> Helper loaded: url_helper
INFO - 2025-11-05 19:48:34 --> Helper loaded: form_helper
INFO - 2025-11-05 19:48:34 --> Database Driver Class Initialized
DEBUG - 2025-11-05 19:48:34 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
INFO - 2025-11-05 19:48:34 --> Session: Class initialized using 'files' driver.
INFO - 2025-11-05 19:48:34 --> Form Validation Class Initialized
INFO - 2025-11-05 19:48:34 --> Controller Class Initialized
DEBUG - 2025-11-05 19:48:34 --> Session class already loaded. Second attempt ignored.
DEBUG - 2025-11-05 19:48:34 --> MY_Controller - Role: administrator
DEBUG - 2025-11-05 19:48:34 --> MY_Controller - Is Admin: true
DEBUG - 2025-11-05 19:48:34 --> MY_Controller - Permissions: Array
(
)

INFO - 2025-11-05 19:48:34 --> Model Class Initialized
INFO - 2025-11-05 19:48:34 --> Model Class Initialized
INFO - 2025-11-05 19:48:34 --> Model Class Initialized
INFO - 2025-11-05 19:48:34 --> Model Class Initialized
INFO - 2025-11-05 19:48:34 --> Model Class Initialized
INFO - 2025-11-05 19:48:34 --> Model Class Initialized
DEBUG - 2025-11-05 19:48:34 --> Controller_Reports initialized
INFO - 2025-11-05 19:48:34 --> Final output sent to browser
DEBUG - 2025-11-05 19:48:34 --> Total execution time: 0.1615
INFO - 2025-11-05 19:51:21 --> Config Class Initialized
INFO - 2025-11-05 19:51:21 --> Hooks Class Initialized
DEBUG - 2025-11-05 19:51:21 --> UTF-8 Support Enabled
INFO - 2025-11-05 19:51:21 --> Utf8 Class Initialized
INFO - 2025-11-05 19:51:21 --> URI Class Initialized
INFO - 2025-11-05 19:51:21 --> Router Class Initialized
INFO - 2025-11-05 19:51:21 --> Output Class Initialized
INFO - 2025-11-05 19:51:21 --> Security Class Initialized
DEBUG - 2025-11-05 19:51:21 --> Global POST, GET and COOKIE data sanitized
INFO - 2025-11-05 19:51:21 --> Input Class Initialized
INFO - 2025-11-05 19:51:21 --> Language Class Initialized
INFO - 2025-11-05 19:51:21 --> Loader Class Initialized
INFO - 2025-11-05 19:51:21 --> Helper loaded: url_helper
INFO - 2025-11-05 19:51:21 --> Helper loaded: form_helper
INFO - 2025-11-05 19:51:21 --> Database Driver Class Initialized
DEBUG - 2025-11-05 19:51:21 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
INFO - 2025-11-05 19:51:21 --> Session: Class initialized using 'files' driver.
INFO - 2025-11-05 19:51:21 --> Form Validation Class Initialized
INFO - 2025-11-05 19:51:21 --> Controller Class Initialized
DEBUG - 2025-11-05 19:51:21 --> Session class already loaded. Second attempt ignored.
DEBUG - 2025-11-05 19:51:21 --> MY_Controller - Role: administrator
DEBUG - 2025-11-05 19:51:21 --> MY_Controller - Is Admin: true
DEBUG - 2025-11-05 19:51:21 --> MY_Controller - Permissions: Array
(
)

INFO - 2025-11-05 19:51:21 --> Model Class Initialized
INFO - 2025-11-05 19:51:21 --> Model Class Initialized
INFO - 2025-11-05 19:51:21 --> Model Class Initialized
INFO - 2025-11-05 19:51:21 --> Model Class Initialized
INFO - 2025-11-05 19:51:21 --> Model Class Initialized
INFO - 2025-11-05 19:51:21 --> Model Class Initialized
DEBUG - 2025-11-05 19:51:21 --> Controller_Reports initialized
INFO - 2025-11-05 19:51:21 --> Model Class Initialized
DEBUG - 2025-11-05 19:51:21 --> === SALES REPORT DEBUG START ===
DEBUG - 2025-11-05 19:51:21 --> Filters received: {"date_from":"2025-10-06","date_to":"2025-11-05","warehouse":null,"status":null}
DEBUG - 2025-11-05 19:51:21 --> date_from: 2025-10-06
DEBUG - 2025-11-05 19:51:21 --> date_to: 2025-11-05
DEBUG - 2025-11-05 19:51:21 --> warehouse: not set
DEBUG - 2025-11-05 19:51:21 --> status: not set
DEBUG - 2025-11-05 19:51:21 --> Applied date_from: 2025-10-06
DEBUG - 2025-11-05 19:51:21 --> Applied date_to: 2025-11-05
DEBUG - 2025-11-05 19:51:21 --> Generated SQL: SELECT `o`.`store_id`, `o`.`id` AS `order_id`, `o`.`date_time`, `o`.`amount_paid`, `o`.`paid_status`, `oi`.`qty` AS `quantity`, `oi`.`rate` AS `price`, `oi`.`amount` AS `amount`, `p`.`name` AS `product_name`, `p`.`id` AS `product_id`, COALESCE(o.customer_name, "Walk-in") AS customer_name
FROM `orders` `o`
INNER JOIN `orders_item` `oi` ON `o`.`id` = `oi`.`order_id`
LEFT JOIN `products` `p` ON `oi`.`product_id` = `p`.`id`
WHERE DATE(o.date_time) >= '2025-10-06'
AND DATE(o.date_time) <= '2025-11-05'
DEBUG - 2025-11-05 19:51:21 --> Query returned 273 rows
DEBUG - 2025-11-05 19:51:21 --> === SALES REPORT DEBUG END ===
DEBUG - 2025-11-05 19:51:21 --> Controller_Reports::sales_report rows fetched: 273
INFO - 2025-11-05 19:51:21 --> File loaded: C:\xampp\htdocs\Inventory_CI\application\views\templates/header.php
INFO - 2025-11-05 19:51:21 --> File loaded: C:\xampp\htdocs\Inventory_CI\application\views\templates/header_menu.php
INFO - 2025-11-05 19:51:21 --> File loaded: C:\xampp\htdocs\Inventory_CI\application\views\templates/side_menubar.php
INFO - 2025-11-05 19:51:21 --> File loaded: C:\xampp\htdocs\Inventory_CI\application\views\reporting/sales_report.php
INFO - 2025-11-05 19:51:21 --> File loaded: C:\xampp\htdocs\Inventory_CI\application\views\templates/footer.php
INFO - 2025-11-05 19:51:21 --> Final output sent to browser
DEBUG - 2025-11-05 19:51:21 --> Total execution time: 0.2833
INFO - 2025-11-05 19:51:59 --> Config Class Initialized
INFO - 2025-11-05 19:51:59 --> Hooks Class Initialized
DEBUG - 2025-11-05 19:51:59 --> UTF-8 Support Enabled
INFO - 2025-11-05 19:51:59 --> Utf8 Class Initialized
INFO - 2025-11-05 19:51:59 --> URI Class Initialized
INFO - 2025-11-05 19:51:59 --> Router Class Initialized
INFO - 2025-11-05 19:51:59 --> Output Class Initialized
INFO - 2025-11-05 19:51:59 --> Security Class Initialized
DEBUG - 2025-11-05 19:51:59 --> Global POST, GET and COOKIE data sanitized
INFO - 2025-11-05 19:51:59 --> Input Class Initialized
INFO - 2025-11-05 19:51:59 --> Language Class Initialized
INFO - 2025-11-05 19:51:59 --> Loader Class Initialized
INFO - 2025-11-05 19:51:59 --> Helper loaded: url_helper
INFO - 2025-11-05 19:51:59 --> Helper loaded: form_helper
INFO - 2025-11-05 19:51:59 --> Database Driver Class Initialized
DEBUG - 2025-11-05 19:51:59 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
INFO - 2025-11-05 19:51:59 --> Session: Class initialized using 'files' driver.
INFO - 2025-11-05 19:51:59 --> Form Validation Class Initialized
INFO - 2025-11-05 19:51:59 --> Controller Class Initialized
DEBUG - 2025-11-05 19:51:59 --> Session class already loaded. Second attempt ignored.
DEBUG - 2025-11-05 19:51:59 --> MY_Controller - Role: administrator
DEBUG - 2025-11-05 19:51:59 --> MY_Controller - Is Admin: true
DEBUG - 2025-11-05 19:51:59 --> MY_Controller - Permissions: Array
(
)

INFO - 2025-11-05 19:51:59 --> Model Class Initialized
INFO - 2025-11-05 19:51:59 --> Model Class Initialized
INFO - 2025-11-05 19:51:59 --> Model Class Initialized
INFO - 2025-11-05 19:51:59 --> Model Class Initialized
INFO - 2025-11-05 19:51:59 --> Model Class Initialized
INFO - 2025-11-05 19:51:59 --> Model Class Initialized
DEBUG - 2025-11-05 19:51:59 --> Controller_Reports initialized
INFO - 2025-11-05 19:51:59 --> Model Class Initialized
INFO - 2025-11-05 19:51:59 --> Model Class Initialized
DEBUG - 2025-11-05 19:51:59 --> === Stock Report Debug ===
DEBUG - 2025-11-05 19:51:59 --> Filters being applied: {"category":null,"warehouse":null,"stock_status":null,"limit":10,"offset":0}
DEBUG - 2025-11-05 19:51:59 --> Calling getStockReport with params: {"limit":10,"offset":0,"filters":{"category":null,"warehouse":null,"stock_status":null,"limit":10,"offset":0}}
ERROR - 2025-11-05 19:51:59 --> Query error: Invalid use of group function - Invalid query: SELECT COUNT(DISTINCT p.id) as total_items, COALESCE(SUM(
                    CASE 
                        WHEN (COALESCE(SUM(pu.qty), 0) - COALESCE(SUM(oi.qty), 0)) > 0 
                        THEN (COALESCE(SUM(pu.qty), 0) - COALESCE(SUM(oi.qty), 0)) * COALESCE(MAX(pu.price), p.price)
                        ELSE 0 
                    END
                ), 0) as total_value, COALESCE(SUM(COALESCE(pu.total_amount, 0)), 0) as total_purchase_value, COUNT(DISTINCT CASE 
                    WHEN (COALESCE(SUM(pu.qty), 0) - COALESCE(SUM(oi.qty), 0)) > 0 
                    AND (COALESCE(SUM(pu.qty), 0) - COALESCE(SUM(oi.qty), 0)) <= 10 
                    THEN p.id 
                END) as low_stock_items, COUNT(DISTINCT CASE 
                    WHEN (COALESCE(SUM(pu.qty), 0) - COALESCE(SUM(oi.qty), 0)) <= 0 
                    THEN p.id 
                END) as out_of_stock_items
FROM `products` `p`
LEFT JOIN `purchases` `pu` ON `pu`.`product_id` = `p`.`id`
LEFT JOIN `orders_item` `oi` ON `oi`.`product_id` = `p`.`id`
LEFT JOIN `orders` `o` ON `o`.`id` = `oi`.`order_id` AND `o`.`paid_status` IN (1, 2)
GROUP BY `p`.`id`, `p`.`price`
DEBUG - 2025-11-05 19:51:59 --> Report data retrieved: {"has_data":true,"record_count":10,"total_items":59,"aggregates":{"total_items":0,"total_value":0,"total_purchase_value":0,"low_stock_items":0,"out_of_stock_items":0}}
DEBUG - 2025-11-05 19:51:59 --> Data being sent to view: {"stock_count":10,"aggregate_keys":["total_items","total_value","total_purchase_value","low_stock_items","out_of_stock_items"]}
INFO - 2025-11-05 19:51:59 --> File loaded: C:\xampp\htdocs\Inventory_CI\application\views\templates/header.php
INFO - 2025-11-05 19:51:59 --> File loaded: C:\xampp\htdocs\Inventory_CI\application\views\templates/header_menu.php
INFO - 2025-11-05 19:51:59 --> File loaded: C:\xampp\htdocs\Inventory_CI\application\views\templates/side_menubar.php
INFO - 2025-11-05 19:51:59 --> File loaded: C:\xampp\htdocs\Inventory_CI\application\views\reporting/stock_report.php
INFO - 2025-11-05 19:51:59 --> File loaded: C:\xampp\htdocs\Inventory_CI\application\views\templates/footer.php
INFO - 2025-11-05 19:51:59 --> Final output sent to browser
DEBUG - 2025-11-05 19:51:59 --> Total execution time: 0.3003
INFO - 2025-11-05 19:52:00 --> Config Class Initialized
INFO - 2025-11-05 19:52:00 --> Hooks Class Initialized
DEBUG - 2025-11-05 19:52:00 --> UTF-8 Support Enabled
INFO - 2025-11-05 19:52:00 --> Utf8 Class Initialized
INFO - 2025-11-05 19:52:00 --> URI Class Initialized
INFO - 2025-11-05 19:52:00 --> Router Class Initialized
INFO - 2025-11-05 19:52:00 --> Output Class Initialized
INFO - 2025-11-05 19:52:00 --> Security Class Initialized
DEBUG - 2025-11-05 19:52:00 --> Global POST, GET and COOKIE data sanitized
INFO - 2025-11-05 19:52:00 --> Input Class Initialized
INFO - 2025-11-05 19:52:00 --> Language Class Initialized
INFO - 2025-11-05 19:52:00 --> Loader Class Initialized
INFO - 2025-11-05 19:52:01 --> Helper loaded: url_helper
INFO - 2025-11-05 19:52:01 --> Helper loaded: form_helper
INFO - 2025-11-05 19:52:01 --> Database Driver Class Initialized
DEBUG - 2025-11-05 19:52:01 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
INFO - 2025-11-05 19:52:01 --> Session: Class initialized using 'files' driver.
INFO - 2025-11-05 19:52:01 --> Form Validation Class Initialized
INFO - 2025-11-05 19:52:01 --> Controller Class Initialized
DEBUG - 2025-11-05 19:52:01 --> Session class already loaded. Second attempt ignored.
DEBUG - 2025-11-05 19:52:01 --> MY_Controller - Role: administrator
DEBUG - 2025-11-05 19:52:01 --> MY_Controller - Is Admin: true
DEBUG - 2025-11-05 19:52:01 --> MY_Controller - Permissions: Array
(
)

INFO - 2025-11-05 19:52:01 --> Model Class Initialized
INFO - 2025-11-05 19:52:01 --> Model Class Initialized
INFO - 2025-11-05 19:52:01 --> Model Class Initialized
INFO - 2025-11-05 19:52:01 --> Model Class Initialized
INFO - 2025-11-05 19:52:01 --> Model Class Initialized
INFO - 2025-11-05 19:52:01 --> Model Class Initialized
DEBUG - 2025-11-05 19:52:01 --> Controller_Reports initialized
INFO - 2025-11-05 19:52:01 --> Final output sent to browser
DEBUG - 2025-11-05 19:52:01 --> Total execution time: 0.3395
INFO - 2025-11-05 19:52:42 --> Config Class Initialized
INFO - 2025-11-05 19:52:42 --> Hooks Class Initialized
DEBUG - 2025-11-05 19:52:42 --> UTF-8 Support Enabled
INFO - 2025-11-05 19:52:42 --> Utf8 Class Initialized
INFO - 2025-11-05 19:52:42 --> URI Class Initialized
INFO - 2025-11-05 19:52:42 --> Router Class Initialized
INFO - 2025-11-05 19:52:42 --> Output Class Initialized
INFO - 2025-11-05 19:52:42 --> Security Class Initialized
DEBUG - 2025-11-05 19:52:42 --> Global POST, GET and COOKIE data sanitized
INFO - 2025-11-05 19:52:42 --> Input Class Initialized
INFO - 2025-11-05 19:52:42 --> Language Class Initialized
INFO - 2025-11-05 19:52:42 --> Loader Class Initialized
INFO - 2025-11-05 19:52:42 --> Helper loaded: url_helper
INFO - 2025-11-05 19:52:42 --> Helper loaded: form_helper
INFO - 2025-11-05 19:52:43 --> Database Driver Class Initialized
DEBUG - 2025-11-05 19:52:43 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
INFO - 2025-11-05 19:52:43 --> Session: Class initialized using 'files' driver.
INFO - 2025-11-05 19:52:43 --> Form Validation Class Initialized
INFO - 2025-11-05 19:52:43 --> Controller Class Initialized
DEBUG - 2025-11-05 19:52:43 --> Session class already loaded. Second attempt ignored.
DEBUG - 2025-11-05 19:52:43 --> MY_Controller - Role: administrator
DEBUG - 2025-11-05 19:52:43 --> MY_Controller - Is Admin: true
DEBUG - 2025-11-05 19:52:43 --> MY_Controller - Permissions: Array
(
)

INFO - 2025-11-05 19:52:43 --> Model Class Initialized
INFO - 2025-11-05 19:52:43 --> Model Class Initialized
INFO - 2025-11-05 19:52:43 --> Model Class Initialized
INFO - 2025-11-05 19:52:43 --> Model Class Initialized
INFO - 2025-11-05 19:52:43 --> Model Class Initialized
INFO - 2025-11-05 19:52:43 --> Model Class Initialized
DEBUG - 2025-11-05 19:52:43 --> Controller_Reports initialized
INFO - 2025-11-05 19:52:43 --> Model Class Initialized
INFO - 2025-11-05 19:52:43 --> Model Class Initialized
DEBUG - 2025-11-05 19:52:43 --> === Stock Report Debug ===
DEBUG - 2025-11-05 19:52:43 --> Filters being applied: {"category":null,"warehouse":null,"stock_status":null,"limit":10,"offset":0}
DEBUG - 2025-11-05 19:52:43 --> Calling getStockReport with params: {"limit":10,"offset":0,"filters":{"category":null,"warehouse":null,"stock_status":null,"limit":10,"offset":0}}
ERROR - 2025-11-05 19:52:43 --> Query error: Invalid use of group function - Invalid query: SELECT COUNT(DISTINCT p.id) as total_items, COALESCE(SUM(
                    CASE 
                        WHEN (COALESCE(SUM(pu.qty), 0) - COALESCE(SUM(oi.qty), 0)) > 0 
                        THEN (COALESCE(SUM(pu.qty), 0) - COALESCE(SUM(oi.qty), 0)) * COALESCE(MAX(pu.price), p.price)
                        ELSE 0 
                    END
                ), 0) as total_value, COALESCE(SUM(COALESCE(pu.total_amount, 0)), 0) as total_purchase_value, COUNT(DISTINCT CASE 
                    WHEN (COALESCE(SUM(pu.qty), 0) - COALESCE(SUM(oi.qty), 0)) > 0 
                    AND (COALESCE(SUM(pu.qty), 0) - COALESCE(SUM(oi.qty), 0)) <= 10 
                    THEN p.id 
                END) as low_stock_items, COUNT(DISTINCT CASE 
                    WHEN (COALESCE(SUM(pu.qty), 0) - COALESCE(SUM(oi.qty), 0)) <= 0 
                    THEN p.id 
                END) as out_of_stock_items
FROM `products` `p`
LEFT JOIN `purchases` `pu` ON `pu`.`product_id` = `p`.`id`
LEFT JOIN `orders_item` `oi` ON `oi`.`product_id` = `p`.`id`
LEFT JOIN `orders` `o` ON `o`.`id` = `oi`.`order_id` AND `o`.`paid_status` IN (1, 2)
GROUP BY `p`.`id`, `p`.`price`
DEBUG - 2025-11-05 19:52:43 --> Report data retrieved: {"has_data":true,"record_count":10,"total_items":59,"aggregates":{"total_items":0,"total_value":0,"total_purchase_value":0,"low_stock_items":0,"out_of_stock_items":0}}
DEBUG - 2025-11-05 19:52:43 --> Data being sent to view: {"stock_count":10,"aggregate_keys":["total_items","total_value","total_purchase_value","low_stock_items","out_of_stock_items"]}
INFO - 2025-11-05 19:52:43 --> File loaded: C:\xampp\htdocs\Inventory_CI\application\views\templates/header.php
INFO - 2025-11-05 19:52:43 --> File loaded: C:\xampp\htdocs\Inventory_CI\application\views\templates/header_menu.php
INFO - 2025-11-05 19:52:43 --> File loaded: C:\xampp\htdocs\Inventory_CI\application\views\templates/side_menubar.php
INFO - 2025-11-05 19:52:43 --> File loaded: C:\xampp\htdocs\Inventory_CI\application\views\reporting/stock_report.php
INFO - 2025-11-05 19:52:43 --> File loaded: C:\xampp\htdocs\Inventory_CI\application\views\templates/footer.php
INFO - 2025-11-05 19:52:43 --> Final output sent to browser
DEBUG - 2025-11-05 19:52:43 --> Total execution time: 0.2980
INFO - 2025-11-05 19:55:03 --> Config Class Initialized
INFO - 2025-11-05 19:55:03 --> Hooks Class Initialized
DEBUG - 2025-11-05 19:55:03 --> UTF-8 Support Enabled
INFO - 2025-11-05 19:55:03 --> Utf8 Class Initialized
INFO - 2025-11-05 19:55:03 --> URI Class Initialized
INFO - 2025-11-05 19:55:03 --> Router Class Initialized
INFO - 2025-11-05 19:55:03 --> Output Class Initialized
INFO - 2025-11-05 19:55:03 --> Security Class Initialized
DEBUG - 2025-11-05 19:55:03 --> Global POST, GET and COOKIE data sanitized
INFO - 2025-11-05 19:55:03 --> Input Class Initialized
INFO - 2025-11-05 19:55:03 --> Language Class Initialized
INFO - 2025-11-05 19:55:03 --> Loader Class Initialized
INFO - 2025-11-05 19:55:03 --> Helper loaded: url_helper
INFO - 2025-11-05 19:55:03 --> Helper loaded: form_helper
INFO - 2025-11-05 19:55:03 --> Database Driver Class Initialized
DEBUG - 2025-11-05 19:55:03 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
INFO - 2025-11-05 19:55:03 --> Session: Class initialized using 'files' driver.
INFO - 2025-11-05 19:55:03 --> Form Validation Class Initialized
INFO - 2025-11-05 19:55:03 --> Controller Class Initialized
DEBUG - 2025-11-05 19:55:03 --> Session class already loaded. Second attempt ignored.
DEBUG - 2025-11-05 19:55:03 --> MY_Controller - Role: administrator
DEBUG - 2025-11-05 19:55:03 --> MY_Controller - Is Admin: true
DEBUG - 2025-11-05 19:55:03 --> MY_Controller - Permissions: Array
(
)

INFO - 2025-11-05 19:55:03 --> Model Class Initialized
INFO - 2025-11-05 19:55:03 --> Model Class Initialized
INFO - 2025-11-05 19:55:03 --> Model Class Initialized
INFO - 2025-11-05 19:55:03 --> Model Class Initialized
INFO - 2025-11-05 19:55:03 --> Model Class Initialized
INFO - 2025-11-05 19:55:03 --> Model Class Initialized
DEBUG - 2025-11-05 19:55:03 --> Controller_Reports initialized
INFO - 2025-11-05 19:55:03 --> Model Class Initialized
INFO - 2025-11-05 19:55:03 --> Model Class Initialized
DEBUG - 2025-11-05 19:55:03 --> === Stock Report Debug ===
DEBUG - 2025-11-05 19:55:03 --> Filters being applied: {"category":null,"warehouse":null,"stock_status":null,"limit":10,"offset":0}
DEBUG - 2025-11-05 19:55:03 --> Calling getStockReport with params: {"limit":10,"offset":0,"filters":{"category":null,"warehouse":null,"stock_status":null,"limit":10,"offset":0}}
ERROR - 2025-11-05 19:55:03 --> Query error: Invalid use of group function - Invalid query: SELECT COUNT(DISTINCT p.id) as total_items, COALESCE(SUM(
                    CASE 
                        WHEN (COALESCE(SUM(pu.qty), 0) - COALESCE(SUM(oi.qty), 0)) > 0 
                        THEN (COALESCE(SUM(pu.qty), 0) - COALESCE(SUM(oi.qty), 0)) * COALESCE(MAX(pu.price), p.price)
                        ELSE 0 
                    END
                ), 0) as total_value, COALESCE(SUM(COALESCE(pu.total_amount, 0)), 0) as total_purchase_value, COUNT(DISTINCT CASE 
                    WHEN (COALESCE(SUM(pu.qty), 0) - COALESCE(SUM(oi.qty), 0)) > 0 
                    AND (COALESCE(SUM(pu.qty), 0) - COALESCE(SUM(oi.qty), 0)) <= 10 
                    THEN p.id 
                END) as low_stock_items, COUNT(DISTINCT CASE 
                    WHEN (COALESCE(SUM(pu.qty), 0) - COALESCE(SUM(oi.qty), 0)) <= 0 
                    THEN p.id 
                END) as out_of_stock_items
FROM `products` `p`
LEFT JOIN `purchases` `pu` ON `pu`.`product_id` = `p`.`id`
LEFT JOIN `orders_item` `oi` ON `oi`.`product_id` = `p`.`id`
LEFT JOIN `orders` `o` ON `o`.`id` = `oi`.`order_id` AND `o`.`paid_status` IN (1, 2)
GROUP BY `p`.`id`, `p`.`price`
DEBUG - 2025-11-05 19:55:03 --> Report data retrieved: {"has_data":true,"record_count":10,"total_items":59,"aggregates":{"total_items":0,"total_value":0,"total_purchase_value":0,"low_stock_items":0,"out_of_stock_items":0}}
DEBUG - 2025-11-05 19:55:03 --> Data being sent to view: {"stock_count":10,"aggregate_keys":["total_items","total_value","total_purchase_value","low_stock_items","out_of_stock_items"]}
INFO - 2025-11-05 19:55:03 --> File loaded: C:\xampp\htdocs\Inventory_CI\application\views\templates/header.php
INFO - 2025-11-05 19:55:03 --> File loaded: C:\xampp\htdocs\Inventory_CI\application\views\templates/header_menu.php
INFO - 2025-11-05 19:55:03 --> File loaded: C:\xampp\htdocs\Inventory_CI\application\views\templates/side_menubar.php
INFO - 2025-11-05 19:55:03 --> File loaded: C:\xampp\htdocs\Inventory_CI\application\views\reporting/stock_report.php
INFO - 2025-11-05 19:55:03 --> File loaded: C:\xampp\htdocs\Inventory_CI\application\views\templates/footer.php
INFO - 2025-11-05 19:55:03 --> Final output sent to browser
DEBUG - 2025-11-05 19:55:03 --> Total execution time: 0.2811
INFO - 2025-11-05 19:55:05 --> Config Class Initialized
INFO - 2025-11-05 19:55:05 --> Hooks Class Initialized
DEBUG - 2025-11-05 19:55:05 --> UTF-8 Support Enabled
INFO - 2025-11-05 19:55:05 --> Utf8 Class Initialized
INFO - 2025-11-05 19:55:05 --> URI Class Initialized
INFO - 2025-11-05 19:55:05 --> Router Class Initialized
INFO - 2025-11-05 19:55:05 --> Output Class Initialized
INFO - 2025-11-05 19:55:05 --> Security Class Initialized
DEBUG - 2025-11-05 19:55:05 --> Global POST, GET and COOKIE data sanitized
INFO - 2025-11-05 19:55:05 --> Input Class Initialized
INFO - 2025-11-05 19:55:05 --> Language Class Initialized
INFO - 2025-11-05 19:55:05 --> Loader Class Initialized
INFO - 2025-11-05 19:55:05 --> Helper loaded: url_helper
INFO - 2025-11-05 19:55:05 --> Helper loaded: form_helper
INFO - 2025-11-05 19:55:05 --> Database Driver Class Initialized
DEBUG - 2025-11-05 19:55:05 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
INFO - 2025-11-05 19:55:05 --> Session: Class initialized using 'files' driver.
INFO - 2025-11-05 19:55:05 --> Form Validation Class Initialized
INFO - 2025-11-05 19:55:05 --> Controller Class Initialized
DEBUG - 2025-11-05 19:55:05 --> Session class already loaded. Second attempt ignored.
DEBUG - 2025-11-05 19:55:05 --> MY_Controller - Role: administrator
DEBUG - 2025-11-05 19:55:05 --> MY_Controller - Is Admin: true
DEBUG - 2025-11-05 19:55:05 --> MY_Controller - Permissions: Array
(
)

INFO - 2025-11-05 19:55:05 --> Model Class Initialized
INFO - 2025-11-05 19:55:05 --> Model Class Initialized
INFO - 2025-11-05 19:55:05 --> Model Class Initialized
INFO - 2025-11-05 19:55:05 --> Model Class Initialized
INFO - 2025-11-05 19:55:05 --> Model Class Initialized
INFO - 2025-11-05 19:55:05 --> Model Class Initialized
DEBUG - 2025-11-05 19:55:05 --> Controller_Reports initialized
INFO - 2025-11-05 19:55:05 --> Final output sent to browser
DEBUG - 2025-11-05 19:55:05 --> Total execution time: 0.2487
INFO - 2025-11-05 19:55:55 --> Config Class Initialized
INFO - 2025-11-05 19:55:55 --> Hooks Class Initialized
DEBUG - 2025-11-05 19:55:55 --> UTF-8 Support Enabled
INFO - 2025-11-05 19:55:55 --> Utf8 Class Initialized
INFO - 2025-11-05 19:55:55 --> URI Class Initialized
INFO - 2025-11-05 19:55:55 --> Router Class Initialized
INFO - 2025-11-05 19:55:55 --> Output Class Initialized
INFO - 2025-11-05 19:55:55 --> Security Class Initialized
DEBUG - 2025-11-05 19:55:55 --> Global POST, GET and COOKIE data sanitized
INFO - 2025-11-05 19:55:55 --> Input Class Initialized
INFO - 2025-11-05 19:55:55 --> Language Class Initialized
INFO - 2025-11-05 19:55:56 --> Loader Class Initialized
INFO - 2025-11-05 19:55:56 --> Helper loaded: url_helper
INFO - 2025-11-05 19:55:56 --> Helper loaded: form_helper
INFO - 2025-11-05 19:55:56 --> Database Driver Class Initialized
DEBUG - 2025-11-05 19:55:56 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
INFO - 2025-11-05 19:55:56 --> Session: Class initialized using 'files' driver.
INFO - 2025-11-05 19:55:56 --> Form Validation Class Initialized
INFO - 2025-11-05 19:55:56 --> Controller Class Initialized
DEBUG - 2025-11-05 19:55:56 --> Session class already loaded. Second attempt ignored.
DEBUG - 2025-11-05 19:55:56 --> MY_Controller - Role: administrator
DEBUG - 2025-11-05 19:55:56 --> MY_Controller - Is Admin: true
DEBUG - 2025-11-05 19:55:56 --> MY_Controller - Permissions: Array
(
)

INFO - 2025-11-05 19:55:56 --> Model Class Initialized
INFO - 2025-11-05 19:55:56 --> Model Class Initialized
INFO - 2025-11-05 19:55:56 --> Model Class Initialized
INFO - 2025-11-05 19:55:56 --> Model Class Initialized
INFO - 2025-11-05 19:55:56 --> Model Class Initialized
INFO - 2025-11-05 19:55:56 --> Model Class Initialized
DEBUG - 2025-11-05 19:55:56 --> Controller_Reports initialized
INFO - 2025-11-05 19:55:56 --> Model Class Initialized
DEBUG - 2025-11-05 19:55:56 --> === SALES REPORT DEBUG START ===
DEBUG - 2025-11-05 19:55:56 --> Filters received: {"date_from":"2025-10-06","date_to":"2025-11-05","warehouse":null,"status":null}
DEBUG - 2025-11-05 19:55:56 --> date_from: 2025-10-06
DEBUG - 2025-11-05 19:55:56 --> date_to: 2025-11-05
DEBUG - 2025-11-05 19:55:56 --> warehouse: not set
DEBUG - 2025-11-05 19:55:56 --> status: not set
DEBUG - 2025-11-05 19:55:56 --> Applied date_from: 2025-10-06
DEBUG - 2025-11-05 19:55:56 --> Applied date_to: 2025-11-05
DEBUG - 2025-11-05 19:55:56 --> Generated SQL: SELECT `o`.`store_id`, `o`.`id` AS `order_id`, `o`.`date_time`, `o`.`amount_paid`, `o`.`paid_status`, `oi`.`qty` AS `quantity`, `oi`.`rate` AS `price`, `oi`.`amount` AS `amount`, `p`.`name` AS `product_name`, `p`.`id` AS `product_id`, COALESCE(o.customer_name, "Walk-in") AS customer_name
FROM `orders` `o`
INNER JOIN `orders_item` `oi` ON `o`.`id` = `oi`.`order_id`
LEFT JOIN `products` `p` ON `oi`.`product_id` = `p`.`id`
WHERE DATE(o.date_time) >= '2025-10-06'
AND DATE(o.date_time) <= '2025-11-05'
DEBUG - 2025-11-05 19:55:56 --> Query returned 273 rows
DEBUG - 2025-11-05 19:55:56 --> === SALES REPORT DEBUG END ===
DEBUG - 2025-11-05 19:55:56 --> Controller_Reports::sales_report rows fetched: 273
INFO - 2025-11-05 19:55:56 --> File loaded: C:\xampp\htdocs\Inventory_CI\application\views\templates/header.php
INFO - 2025-11-05 19:55:56 --> File loaded: C:\xampp\htdocs\Inventory_CI\application\views\templates/header_menu.php
INFO - 2025-11-05 19:55:56 --> File loaded: C:\xampp\htdocs\Inventory_CI\application\views\templates/side_menubar.php
INFO - 2025-11-05 19:55:57 --> File loaded: C:\xampp\htdocs\Inventory_CI\application\views\reporting/sales_report.php
INFO - 2025-11-05 19:55:57 --> File loaded: C:\xampp\htdocs\Inventory_CI\application\views\templates/footer.php
INFO - 2025-11-05 19:55:57 --> Final output sent to browser
DEBUG - 2025-11-05 19:55:57 --> Total execution time: 1.2724
INFO - 2025-11-05 19:58:55 --> Config Class Initialized
INFO - 2025-11-05 19:58:55 --> Hooks Class Initialized
DEBUG - 2025-11-05 19:58:55 --> UTF-8 Support Enabled
INFO - 2025-11-05 19:58:55 --> Utf8 Class Initialized
INFO - 2025-11-05 19:58:55 --> URI Class Initialized
INFO - 2025-11-05 19:58:55 --> Router Class Initialized
INFO - 2025-11-05 19:58:55 --> Output Class Initialized
INFO - 2025-11-05 19:58:55 --> Security Class Initialized
DEBUG - 2025-11-05 19:58:55 --> Global POST, GET and COOKIE data sanitized
INFO - 2025-11-05 19:58:55 --> Input Class Initialized
INFO - 2025-11-05 19:58:55 --> Language Class Initialized
INFO - 2025-11-05 19:58:55 --> Loader Class Initialized
INFO - 2025-11-05 19:58:55 --> Helper loaded: url_helper
INFO - 2025-11-05 19:58:55 --> Helper loaded: form_helper
INFO - 2025-11-05 19:58:55 --> Database Driver Class Initialized
DEBUG - 2025-11-05 19:58:55 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
INFO - 2025-11-05 19:58:55 --> Session: Class initialized using 'files' driver.
INFO - 2025-11-05 19:58:55 --> Form Validation Class Initialized
INFO - 2025-11-05 19:58:55 --> Controller Class Initialized
DEBUG - 2025-11-05 19:58:55 --> Session class already loaded. Second attempt ignored.
DEBUG - 2025-11-05 19:58:55 --> MY_Controller - Role: administrator
DEBUG - 2025-11-05 19:58:55 --> MY_Controller - Is Admin: true
DEBUG - 2025-11-05 19:58:55 --> MY_Controller - Permissions: Array
(
)

INFO - 2025-11-05 19:58:55 --> Model Class Initialized
INFO - 2025-11-05 19:58:55 --> Model Class Initialized
INFO - 2025-11-05 19:58:55 --> Model Class Initialized
INFO - 2025-11-05 19:58:55 --> Model Class Initialized
INFO - 2025-11-05 19:58:55 --> Model Class Initialized
INFO - 2025-11-05 19:58:55 --> Model Class Initialized
DEBUG - 2025-11-05 19:58:55 --> Controller_Reports initialized
INFO - 2025-11-05 19:58:55 --> Model Class Initialized
DEBUG - 2025-11-05 19:58:55 --> === SALES REPORT DEBUG START ===
DEBUG - 2025-11-05 19:58:55 --> Filters received: {"date_from":"2025-10-06","date_to":"2025-11-05","warehouse":null,"status":null}
DEBUG - 2025-11-05 19:58:55 --> date_from: 2025-10-06
DEBUG - 2025-11-05 19:58:55 --> date_to: 2025-11-05
DEBUG - 2025-11-05 19:58:55 --> warehouse: not set
DEBUG - 2025-11-05 19:58:55 --> status: not set
DEBUG - 2025-11-05 19:58:55 --> Applied date_from: 2025-10-06
DEBUG - 2025-11-05 19:58:55 --> Applied date_to: 2025-11-05
DEBUG - 2025-11-05 19:58:55 --> Generated SQL: SELECT `o`.`store_id`, `o`.`id` AS `order_id`, `o`.`date_time`, `o`.`amount_paid`, `o`.`paid_status`, `oi`.`qty` AS `quantity`, `oi`.`rate` AS `price`, `oi`.`amount` AS `amount`, `p`.`name` AS `product_name`, `p`.`id` AS `product_id`, COALESCE(o.customer_name, "Walk-in") AS customer_name
FROM `orders` `o`
INNER JOIN `orders_item` `oi` ON `o`.`id` = `oi`.`order_id`
LEFT JOIN `products` `p` ON `oi`.`product_id` = `p`.`id`
WHERE DATE(o.date_time) >= '2025-10-06'
AND DATE(o.date_time) <= '2025-11-05'
DEBUG - 2025-11-05 19:58:55 --> Query returned 272 rows
DEBUG - 2025-11-05 19:58:55 --> === SALES REPORT DEBUG END ===
DEBUG - 2025-11-05 19:58:55 --> Controller_Reports::sales_report rows fetched: 272
INFO - 2025-11-05 19:58:55 --> File loaded: C:\xampp\htdocs\Inventory_CI\application\views\templates/header.php
INFO - 2025-11-05 19:58:55 --> File loaded: C:\xampp\htdocs\Inventory_CI\application\views\templates/header_menu.php
INFO - 2025-11-05 19:58:55 --> File loaded: C:\xampp\htdocs\Inventory_CI\application\views\templates/side_menubar.php
INFO - 2025-11-05 19:58:55 --> File loaded: C:\xampp\htdocs\Inventory_CI\application\views\reporting/sales_report.php
INFO - 2025-11-05 19:58:55 --> File loaded: C:\xampp\htdocs\Inventory_CI\application\views\templates/footer.php
INFO - 2025-11-05 19:58:55 --> Final output sent to browser
DEBUG - 2025-11-05 19:58:55 --> Total execution time: 0.2737
INFO - 2025-11-05 20:00:12 --> Config Class Initialized
INFO - 2025-11-05 20:00:12 --> Hooks Class Initialized
DEBUG - 2025-11-05 20:00:12 --> UTF-8 Support Enabled
INFO - 2025-11-05 20:00:12 --> Utf8 Class Initialized
INFO - 2025-11-05 20:00:12 --> URI Class Initialized
INFO - 2025-11-05 20:00:12 --> Router Class Initialized
INFO - 2025-11-05 20:00:12 --> Output Class Initialized
INFO - 2025-11-05 20:00:12 --> Security Class Initialized
DEBUG - 2025-11-05 20:00:12 --> Global POST, GET and COOKIE data sanitized
INFO - 2025-11-05 20:00:12 --> Input Class Initialized
INFO - 2025-11-05 20:00:12 --> Language Class Initialized
INFO - 2025-11-05 20:00:12 --> Loader Class Initialized
INFO - 2025-11-05 20:00:12 --> Helper loaded: url_helper
INFO - 2025-11-05 20:00:12 --> Helper loaded: form_helper
INFO - 2025-11-05 20:00:12 --> Database Driver Class Initialized
DEBUG - 2025-11-05 20:00:12 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
INFO - 2025-11-05 20:00:12 --> Session: Class initialized using 'files' driver.
INFO - 2025-11-05 20:00:12 --> Form Validation Class Initialized
INFO - 2025-11-05 20:00:12 --> Controller Class Initialized
DEBUG - 2025-11-05 20:00:12 --> Session class already loaded. Second attempt ignored.
DEBUG - 2025-11-05 20:00:12 --> MY_Controller - Role: administrator
DEBUG - 2025-11-05 20:00:12 --> MY_Controller - Is Admin: true
DEBUG - 2025-11-05 20:00:12 --> MY_Controller - Permissions: Array
(
)

INFO - 2025-11-05 20:00:12 --> Model Class Initialized
INFO - 2025-11-05 20:00:12 --> Model Class Initialized
INFO - 2025-11-05 20:00:12 --> Model Class Initialized
INFO - 2025-11-05 20:00:12 --> Model Class Initialized
INFO - 2025-11-05 20:00:12 --> Model Class Initialized
INFO - 2025-11-05 20:00:12 --> Model Class Initialized
DEBUG - 2025-11-05 20:00:12 --> Controller_Reports initialized
INFO - 2025-11-05 20:00:12 --> Model Class Initialized
INFO - 2025-11-05 20:00:12 --> Model Class Initialized
DEBUG - 2025-11-05 20:00:12 --> === Stock Report Debug ===
DEBUG - 2025-11-05 20:00:12 --> Filters being applied: {"category":null,"warehouse":null,"stock_status":null,"limit":10,"offset":0}
DEBUG - 2025-11-05 20:00:12 --> Calling getStockReport with params: {"limit":10,"offset":0,"filters":{"category":null,"warehouse":null,"stock_status":null,"limit":10,"offset":0}}
ERROR - 2025-11-05 20:00:12 --> Query error: Invalid use of group function - Invalid query: SELECT COUNT(DISTINCT p.id) as total_items, COALESCE(SUM(
                    CASE 
                        WHEN (COALESCE(SUM(pu.qty), 0) - COALESCE(SUM(oi.qty), 0)) > 0 
                        THEN (COALESCE(SUM(pu.qty), 0) - COALESCE(SUM(oi.qty), 0)) * COALESCE(MAX(pu.price), p.price)
                        ELSE 0 
                    END
                ), 0) as total_value, COALESCE(SUM(COALESCE(pu.total_amount, 0)), 0) as total_purchase_value, COUNT(DISTINCT CASE 
                    WHEN (COALESCE(SUM(pu.qty), 0) - COALESCE(SUM(oi.qty), 0)) > 0 
                    AND (COALESCE(SUM(pu.qty), 0) - COALESCE(SUM(oi.qty), 0)) <= 10 
                    THEN p.id 
                END) as low_stock_items, COUNT(DISTINCT CASE 
                    WHEN (COALESCE(SUM(pu.qty), 0) - COALESCE(SUM(oi.qty), 0)) <= 0 
                    THEN p.id 
                END) as out_of_stock_items
FROM `products` `p`
LEFT JOIN `purchases` `pu` ON `pu`.`product_id` = `p`.`id`
LEFT JOIN `orders_item` `oi` ON `oi`.`product_id` = `p`.`id`
LEFT JOIN `orders` `o` ON `o`.`id` = `oi`.`order_id` AND `o`.`paid_status` IN (1, 2)
GROUP BY `p`.`id`, `p`.`price`
DEBUG - 2025-11-05 20:00:12 --> Report data retrieved: {"has_data":true,"record_count":10,"total_items":59,"aggregates":{"total_items":0,"total_value":0,"total_purchase_value":0,"low_stock_items":0,"out_of_stock_items":0}}
DEBUG - 2025-11-05 20:00:12 --> Data being sent to view: {"stock_count":10,"aggregate_keys":["total_items","total_value","total_purchase_value","low_stock_items","out_of_stock_items"]}
INFO - 2025-11-05 20:00:12 --> File loaded: C:\xampp\htdocs\Inventory_CI\application\views\templates/header.php
INFO - 2025-11-05 20:00:12 --> File loaded: C:\xampp\htdocs\Inventory_CI\application\views\templates/header_menu.php
INFO - 2025-11-05 20:00:12 --> File loaded: C:\xampp\htdocs\Inventory_CI\application\views\templates/side_menubar.php
INFO - 2025-11-05 20:00:13 --> File loaded: C:\xampp\htdocs\Inventory_CI\application\views\reporting/stock_report.php
INFO - 2025-11-05 20:00:13 --> File loaded: C:\xampp\htdocs\Inventory_CI\application\views\templates/footer.php
INFO - 2025-11-05 20:00:13 --> Final output sent to browser
DEBUG - 2025-11-05 20:00:13 --> Total execution time: 0.4909
INFO - 2025-11-05 20:00:14 --> Config Class Initialized
INFO - 2025-11-05 20:00:14 --> Hooks Class Initialized
DEBUG - 2025-11-05 20:00:14 --> UTF-8 Support Enabled
INFO - 2025-11-05 20:00:14 --> Utf8 Class Initialized
INFO - 2025-11-05 20:00:14 --> URI Class Initialized
INFO - 2025-11-05 20:00:14 --> Router Class Initialized
INFO - 2025-11-05 20:00:14 --> Output Class Initialized
INFO - 2025-11-05 20:00:14 --> Security Class Initialized
DEBUG - 2025-11-05 20:00:14 --> Global POST, GET and COOKIE data sanitized
INFO - 2025-11-05 20:00:14 --> Input Class Initialized
INFO - 2025-11-05 20:00:14 --> Language Class Initialized
INFO - 2025-11-05 20:00:14 --> Loader Class Initialized
INFO - 2025-11-05 20:00:14 --> Helper loaded: url_helper
INFO - 2025-11-05 20:00:14 --> Helper loaded: form_helper
INFO - 2025-11-05 20:00:14 --> Database Driver Class Initialized
DEBUG - 2025-11-05 20:00:14 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
INFO - 2025-11-05 20:00:14 --> Session: Class initialized using 'files' driver.
INFO - 2025-11-05 20:00:14 --> Form Validation Class Initialized
INFO - 2025-11-05 20:00:14 --> Controller Class Initialized
DEBUG - 2025-11-05 20:00:14 --> Session class already loaded. Second attempt ignored.
DEBUG - 2025-11-05 20:00:14 --> MY_Controller - Role: administrator
DEBUG - 2025-11-05 20:00:14 --> MY_Controller - Is Admin: true
DEBUG - 2025-11-05 20:00:14 --> MY_Controller - Permissions: Array
(
)

INFO - 2025-11-05 20:00:14 --> Model Class Initialized
INFO - 2025-11-05 20:00:14 --> Model Class Initialized
INFO - 2025-11-05 20:00:14 --> Model Class Initialized
INFO - 2025-11-05 20:00:14 --> Model Class Initialized
INFO - 2025-11-05 20:00:14 --> Model Class Initialized
INFO - 2025-11-05 20:00:14 --> Model Class Initialized
DEBUG - 2025-11-05 20:00:14 --> Controller_Reports initialized
INFO - 2025-11-05 20:00:14 --> Final output sent to browser
DEBUG - 2025-11-05 20:00:14 --> Total execution time: 0.2358
INFO - 2025-11-05 20:00:17 --> Config Class Initialized
INFO - 2025-11-05 20:00:17 --> Hooks Class Initialized
DEBUG - 2025-11-05 20:00:17 --> UTF-8 Support Enabled
INFO - 2025-11-05 20:00:17 --> Utf8 Class Initialized
INFO - 2025-11-05 20:00:17 --> URI Class Initialized
INFO - 2025-11-05 20:00:17 --> Router Class Initialized
INFO - 2025-11-05 20:00:17 --> Output Class Initialized
INFO - 2025-11-05 20:00:17 --> Security Class Initialized
DEBUG - 2025-11-05 20:00:17 --> Global POST, GET and COOKIE data sanitized
INFO - 2025-11-05 20:00:17 --> Input Class Initialized
INFO - 2025-11-05 20:00:17 --> Language Class Initialized
INFO - 2025-11-05 20:00:17 --> Loader Class Initialized
INFO - 2025-11-05 20:00:17 --> Helper loaded: url_helper
INFO - 2025-11-05 20:00:17 --> Helper loaded: form_helper
INFO - 2025-11-05 20:00:17 --> Database Driver Class Initialized
DEBUG - 2025-11-05 20:00:17 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
INFO - 2025-11-05 20:00:17 --> Session: Class initialized using 'files' driver.
INFO - 2025-11-05 20:00:17 --> Form Validation Class Initialized
INFO - 2025-11-05 20:00:17 --> Controller Class Initialized
DEBUG - 2025-11-05 20:00:17 --> Session class already loaded. Second attempt ignored.
DEBUG - 2025-11-05 20:00:17 --> MY_Controller - Role: administrator
DEBUG - 2025-11-05 20:00:17 --> MY_Controller - Is Admin: true
DEBUG - 2025-11-05 20:00:17 --> MY_Controller - Permissions: Array
(
)

INFO - 2025-11-05 20:00:17 --> Model Class Initialized
INFO - 2025-11-05 20:00:18 --> Model Class Initialized
INFO - 2025-11-05 20:00:18 --> Model Class Initialized
INFO - 2025-11-05 20:00:18 --> Model Class Initialized
INFO - 2025-11-05 20:00:18 --> Model Class Initialized
INFO - 2025-11-05 20:00:18 --> Model Class Initialized
DEBUG - 2025-11-05 20:00:18 --> Controller_Reports initialized
INFO - 2025-11-05 20:00:18 --> Model Class Initialized
INFO - 2025-11-05 20:00:18 --> Model Class Initialized
DEBUG - 2025-11-05 20:00:18 --> === Stock Report Debug ===
DEBUG - 2025-11-05 20:00:18 --> Filters being applied: {"category":null,"warehouse":null,"stock_status":null,"limit":10,"offset":0}
DEBUG - 2025-11-05 20:00:18 --> Calling getStockReport with params: {"limit":10,"offset":0,"filters":{"category":null,"warehouse":null,"stock_status":null,"limit":10,"offset":0}}
ERROR - 2025-11-05 20:00:18 --> Query error: Invalid use of group function - Invalid query: SELECT COUNT(DISTINCT p.id) as total_items, COALESCE(SUM(
                    CASE 
                        WHEN (COALESCE(SUM(pu.qty), 0) - COALESCE(SUM(oi.qty), 0)) > 0 
                        THEN (COALESCE(SUM(pu.qty), 0) - COALESCE(SUM(oi.qty), 0)) * COALESCE(MAX(pu.price), p.price)
                        ELSE 0 
                    END
                ), 0) as total_value, COALESCE(SUM(COALESCE(pu.total_amount, 0)), 0) as total_purchase_value, COUNT(DISTINCT CASE 
                    WHEN (COALESCE(SUM(pu.qty), 0) - COALESCE(SUM(oi.qty), 0)) > 0 
                    AND (COALESCE(SUM(pu.qty), 0) - COALESCE(SUM(oi.qty), 0)) <= 10 
                    THEN p.id 
                END) as low_stock_items, COUNT(DISTINCT CASE 
                    WHEN (COALESCE(SUM(pu.qty), 0) - COALESCE(SUM(oi.qty), 0)) <= 0 
                    THEN p.id 
                END) as out_of_stock_items
FROM `products` `p`
LEFT JOIN `purchases` `pu` ON `pu`.`product_id` = `p`.`id`
LEFT JOIN `orders_item` `oi` ON `oi`.`product_id` = `p`.`id`
LEFT JOIN `orders` `o` ON `o`.`id` = `oi`.`order_id` AND `o`.`paid_status` IN (1, 2)
GROUP BY `p`.`id`, `p`.`price`
DEBUG - 2025-11-05 20:00:18 --> Report data retrieved: {"has_data":true,"record_count":10,"total_items":59,"aggregates":{"total_items":0,"total_value":0,"total_purchase_value":0,"low_stock_items":0,"out_of_stock_items":0}}
DEBUG - 2025-11-05 20:00:18 --> Data being sent to view: {"stock_count":10,"aggregate_keys":["total_items","total_value","total_purchase_value","low_stock_items","out_of_stock_items"]}
INFO - 2025-11-05 20:00:18 --> File loaded: C:\xampp\htdocs\Inventory_CI\application\views\templates/header.php
INFO - 2025-11-05 20:00:18 --> File loaded: C:\xampp\htdocs\Inventory_CI\application\views\templates/header_menu.php
INFO - 2025-11-05 20:00:18 --> File loaded: C:\xampp\htdocs\Inventory_CI\application\views\templates/side_menubar.php
INFO - 2025-11-05 20:00:18 --> File loaded: C:\xampp\htdocs\Inventory_CI\application\views\reporting/stock_report.php
INFO - 2025-11-05 20:00:18 --> File loaded: C:\xampp\htdocs\Inventory_CI\application\views\templates/footer.php
INFO - 2025-11-05 20:00:18 --> Final output sent to browser
DEBUG - 2025-11-05 20:00:18 --> Total execution time: 0.2656
INFO - 2025-11-05 20:00:19 --> Config Class Initialized
INFO - 2025-11-05 20:00:19 --> Hooks Class Initialized
DEBUG - 2025-11-05 20:00:19 --> UTF-8 Support Enabled
INFO - 2025-11-05 20:00:19 --> Utf8 Class Initialized
INFO - 2025-11-05 20:00:19 --> URI Class Initialized
INFO - 2025-11-05 20:00:19 --> Router Class Initialized
INFO - 2025-11-05 20:00:19 --> Output Class Initialized
INFO - 2025-11-05 20:00:19 --> Security Class Initialized
DEBUG - 2025-11-05 20:00:19 --> Global POST, GET and COOKIE data sanitized
INFO - 2025-11-05 20:00:19 --> Input Class Initialized
INFO - 2025-11-05 20:00:19 --> Language Class Initialized
INFO - 2025-11-05 20:00:19 --> Loader Class Initialized
INFO - 2025-11-05 20:00:19 --> Helper loaded: url_helper
INFO - 2025-11-05 20:00:19 --> Helper loaded: form_helper
INFO - 2025-11-05 20:00:19 --> Database Driver Class Initialized
DEBUG - 2025-11-05 20:00:19 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
INFO - 2025-11-05 20:00:19 --> Session: Class initialized using 'files' driver.
INFO - 2025-11-05 20:00:19 --> Form Validation Class Initialized
INFO - 2025-11-05 20:00:19 --> Controller Class Initialized
DEBUG - 2025-11-05 20:00:19 --> Session class already loaded. Second attempt ignored.
DEBUG - 2025-11-05 20:00:19 --> MY_Controller - Role: administrator
DEBUG - 2025-11-05 20:00:19 --> MY_Controller - Is Admin: true
DEBUG - 2025-11-05 20:00:19 --> MY_Controller - Permissions: Array
(
)

INFO - 2025-11-05 20:00:19 --> Model Class Initialized
INFO - 2025-11-05 20:00:19 --> Model Class Initialized
INFO - 2025-11-05 20:00:19 --> Model Class Initialized
INFO - 2025-11-05 20:00:19 --> Model Class Initialized
INFO - 2025-11-05 20:00:19 --> Model Class Initialized
INFO - 2025-11-05 20:00:19 --> Model Class Initialized
DEBUG - 2025-11-05 20:00:19 --> Controller_Reports initialized
INFO - 2025-11-05 20:00:19 --> Final output sent to browser
DEBUG - 2025-11-05 20:00:19 --> Total execution time: 0.2004
INFO - 2025-11-05 20:00:27 --> Config Class Initialized
INFO - 2025-11-05 20:00:27 --> Hooks Class Initialized
DEBUG - 2025-11-05 20:00:27 --> UTF-8 Support Enabled
INFO - 2025-11-05 20:00:27 --> Utf8 Class Initialized
INFO - 2025-11-05 20:00:27 --> URI Class Initialized
INFO - 2025-11-05 20:00:27 --> Router Class Initialized
INFO - 2025-11-05 20:00:27 --> Output Class Initialized
INFO - 2025-11-05 20:00:27 --> Security Class Initialized
DEBUG - 2025-11-05 20:00:27 --> Global POST, GET and COOKIE data sanitized
INFO - 2025-11-05 20:00:27 --> Input Class Initialized
INFO - 2025-11-05 20:00:27 --> Language Class Initialized
INFO - 2025-11-05 20:00:27 --> Loader Class Initialized
INFO - 2025-11-05 20:00:27 --> Helper loaded: url_helper
INFO - 2025-11-05 20:00:27 --> Helper loaded: form_helper
INFO - 2025-11-05 20:00:27 --> Database Driver Class Initialized
DEBUG - 2025-11-05 20:00:27 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
INFO - 2025-11-05 20:00:27 --> Session: Class initialized using 'files' driver.
INFO - 2025-11-05 20:00:27 --> Form Validation Class Initialized
INFO - 2025-11-05 20:00:27 --> Controller Class Initialized
DEBUG - 2025-11-05 20:00:27 --> Session class already loaded. Second attempt ignored.
DEBUG - 2025-11-05 20:00:27 --> MY_Controller - Role: administrator
DEBUG - 2025-11-05 20:00:27 --> MY_Controller - Is Admin: true
DEBUG - 2025-11-05 20:00:27 --> MY_Controller - Permissions: Array
(
)

INFO - 2025-11-05 20:00:27 --> Model Class Initialized
INFO - 2025-11-05 20:00:27 --> Model Class Initialized
INFO - 2025-11-05 20:00:27 --> Model Class Initialized
INFO - 2025-11-05 20:00:27 --> Model Class Initialized
INFO - 2025-11-05 20:00:27 --> Model Class Initialized
INFO - 2025-11-05 20:00:27 --> Model Class Initialized
DEBUG - 2025-11-05 20:00:27 --> Controller_Reports initialized
INFO - 2025-11-05 20:00:27 --> Final output sent to browser
DEBUG - 2025-11-05 20:00:27 --> Total execution time: 0.1860
INFO - 2025-11-05 20:06:50 --> Config Class Initialized
INFO - 2025-11-05 20:06:50 --> Hooks Class Initialized
DEBUG - 2025-11-05 20:06:50 --> UTF-8 Support Enabled
INFO - 2025-11-05 20:06:50 --> Utf8 Class Initialized
INFO - 2025-11-05 20:06:50 --> URI Class Initialized
INFO - 2025-11-05 20:06:50 --> Router Class Initialized
INFO - 2025-11-05 20:06:50 --> Output Class Initialized
INFO - 2025-11-05 20:06:50 --> Security Class Initialized
DEBUG - 2025-11-05 20:06:50 --> Global POST, GET and COOKIE data sanitized
INFO - 2025-11-05 20:06:50 --> Input Class Initialized
INFO - 2025-11-05 20:06:50 --> Language Class Initialized
INFO - 2025-11-05 20:06:50 --> Loader Class Initialized
INFO - 2025-11-05 20:06:51 --> Helper loaded: url_helper
INFO - 2025-11-05 20:06:51 --> Helper loaded: form_helper
INFO - 2025-11-05 20:06:51 --> Database Driver Class Initialized
DEBUG - 2025-11-05 20:06:51 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
INFO - 2025-11-05 20:06:51 --> Session: Class initialized using 'files' driver.
INFO - 2025-11-05 20:06:51 --> Form Validation Class Initialized
INFO - 2025-11-05 20:06:51 --> Controller Class Initialized
DEBUG - 2025-11-05 20:06:51 --> Session class already loaded. Second attempt ignored.
DEBUG - 2025-11-05 20:06:51 --> MY_Controller - Role: administrator
DEBUG - 2025-11-05 20:06:51 --> MY_Controller - Is Admin: true
DEBUG - 2025-11-05 20:06:51 --> MY_Controller - Permissions: Array
(
)

INFO - 2025-11-05 20:06:51 --> Model Class Initialized
INFO - 2025-11-05 20:06:51 --> Model Class Initialized
INFO - 2025-11-05 20:06:51 --> Model Class Initialized
INFO - 2025-11-05 20:06:51 --> Model Class Initialized
INFO - 2025-11-05 20:06:51 --> Model Class Initialized
INFO - 2025-11-05 20:06:51 --> Model Class Initialized
DEBUG - 2025-11-05 20:06:51 --> Controller_Reports initialized
INFO - 2025-11-05 20:06:51 --> Model Class Initialized
INFO - 2025-11-05 20:06:51 --> Model Class Initialized
DEBUG - 2025-11-05 20:06:51 --> === Stock Report Debug ===
DEBUG - 2025-11-05 20:06:51 --> Filters being applied: {"category":null,"warehouse":null,"stock_status":null,"limit":10,"offset":0}
DEBUG - 2025-11-05 20:06:51 --> Calling getStockReport with params: {"limit":10,"offset":0,"filters":{"category":null,"warehouse":null,"stock_status":null,"limit":10,"offset":0}}
ERROR - 2025-11-05 20:06:51 --> Query error: Invalid use of group function - Invalid query: SELECT COUNT(DISTINCT p.id) as total_items, COALESCE(SUM(
                    CASE 
                        WHEN (COALESCE(SUM(pu.qty), 0) - COALESCE(SUM(oi.qty), 0)) > 0 
                        THEN (COALESCE(SUM(pu.qty), 0) - COALESCE(SUM(oi.qty), 0)) * COALESCE(MAX(pu.price), p.price)
                        ELSE 0 
                    END
                ), 0) as total_value, COALESCE(SUM(COALESCE(pu.total_amount, 0)), 0) as total_purchase_value, COUNT(DISTINCT CASE 
                    WHEN (COALESCE(SUM(pu.qty), 0) - COALESCE(SUM(oi.qty), 0)) > 0 
                    AND (COALESCE(SUM(pu.qty), 0) - COALESCE(SUM(oi.qty), 0)) <= 10 
                    THEN p.id 
                END) as low_stock_items, COUNT(DISTINCT CASE 
                    WHEN (COALESCE(SUM(pu.qty), 0) - COALESCE(SUM(oi.qty), 0)) <= 0 
                    THEN p.id 
                END) as out_of_stock_items
FROM `products` `p`
LEFT JOIN `purchases` `pu` ON `pu`.`product_id` = `p`.`id`
LEFT JOIN `orders_item` `oi` ON `oi`.`product_id` = `p`.`id`
LEFT JOIN `orders` `o` ON `o`.`id` = `oi`.`order_id` AND `o`.`paid_status` IN (1, 2)
GROUP BY `p`.`id`, `p`.`price`
DEBUG - 2025-11-05 20:06:51 --> Report data retrieved: {"has_data":true,"record_count":10,"total_items":59,"aggregates":{"total_items":0,"total_value":0,"total_purchase_value":0,"low_stock_items":0,"out_of_stock_items":0}}
DEBUG - 2025-11-05 20:06:51 --> Data being sent to view: {"stock_count":10,"aggregate_keys":["total_items","total_value","total_purchase_value","low_stock_items","out_of_stock_items"]}
INFO - 2025-11-05 20:06:51 --> File loaded: C:\xampp\htdocs\Inventory_CI\application\views\templates/header.php
INFO - 2025-11-05 20:06:51 --> File loaded: C:\xampp\htdocs\Inventory_CI\application\views\templates/header_menu.php
INFO - 2025-11-05 20:06:51 --> File loaded: C:\xampp\htdocs\Inventory_CI\application\views\templates/side_menubar.php
INFO - 2025-11-05 20:06:51 --> File loaded: C:\xampp\htdocs\Inventory_CI\application\views\reporting/stock_report.php
INFO - 2025-11-05 20:06:51 --> File loaded: C:\xampp\htdocs\Inventory_CI\application\views\templates/footer.php
INFO - 2025-11-05 20:06:51 --> Final output sent to browser
DEBUG - 2025-11-05 20:06:51 --> Total execution time: 0.6144
INFO - 2025-11-05 20:06:52 --> Config Class Initialized
INFO - 2025-11-05 20:06:52 --> Hooks Class Initialized
DEBUG - 2025-11-05 20:06:52 --> UTF-8 Support Enabled
INFO - 2025-11-05 20:06:52 --> Utf8 Class Initialized
INFO - 2025-11-05 20:06:52 --> URI Class Initialized
INFO - 2025-11-05 20:06:52 --> Router Class Initialized
INFO - 2025-11-05 20:06:52 --> Output Class Initialized
INFO - 2025-11-05 20:06:52 --> Security Class Initialized
DEBUG - 2025-11-05 20:06:52 --> Global POST, GET and COOKIE data sanitized
INFO - 2025-11-05 20:06:52 --> Input Class Initialized
INFO - 2025-11-05 20:06:52 --> Language Class Initialized
INFO - 2025-11-05 20:06:52 --> Loader Class Initialized
INFO - 2025-11-05 20:06:52 --> Helper loaded: url_helper
INFO - 2025-11-05 20:06:52 --> Helper loaded: form_helper
INFO - 2025-11-05 20:06:52 --> Database Driver Class Initialized
DEBUG - 2025-11-05 20:06:52 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
INFO - 2025-11-05 20:06:52 --> Session: Class initialized using 'files' driver.
INFO - 2025-11-05 20:06:52 --> Form Validation Class Initialized
INFO - 2025-11-05 20:06:52 --> Controller Class Initialized
DEBUG - 2025-11-05 20:06:52 --> Session class already loaded. Second attempt ignored.
DEBUG - 2025-11-05 20:06:52 --> MY_Controller - Role: administrator
DEBUG - 2025-11-05 20:06:52 --> MY_Controller - Is Admin: true
DEBUG - 2025-11-05 20:06:52 --> MY_Controller - Permissions: Array
(
)

INFO - 2025-11-05 20:06:52 --> Model Class Initialized
INFO - 2025-11-05 20:06:52 --> Model Class Initialized
INFO - 2025-11-05 20:06:52 --> Model Class Initialized
INFO - 2025-11-05 20:06:52 --> Model Class Initialized
INFO - 2025-11-05 20:06:52 --> Model Class Initialized
INFO - 2025-11-05 20:06:52 --> Model Class Initialized
DEBUG - 2025-11-05 20:06:52 --> Controller_Reports initialized
INFO - 2025-11-05 20:06:52 --> Final output sent to browser
DEBUG - 2025-11-05 20:06:52 --> Total execution time: 0.1973
