-- Add store_id column to orders table
ALTER TABLE `orders` ADD `store_id` int(11) NOT NULL AFTER `user_id`;

-- Add foreign key constraint to link orders with stores
ALTER TABLE `orders` 
ADD CONSTRAINT `fk_orders_stores` 
FOREIGN KEY (`store_id`) REFERENCES `stores` (`id`) 
ON DELETE RESTRICT 
ON UPDATE CASCADE;
