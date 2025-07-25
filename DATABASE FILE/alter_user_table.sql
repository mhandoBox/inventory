-- First allow NULL values temporarily
ALTER TABLE `users` MODIFY `store_id` int(11) NULL;

-- Assign a default store to existing users (replace 5 with your default store ID)
UPDATE `users` SET `store_id` = 5 WHERE `store_id` IS NULL OR `store_id` = 0;

-- Make store_id NOT NULL after updating existing users
ALTER TABLE `users` MODIFY `store_id` int(11) NOT NULL;

-- Drop the foreign key constraint if it exists
ALTER TABLE `users` DROP FOREIGN KEY IF EXISTS `fk_users_stores`;

-- Add the foreign key constraint
ALTER TABLE `users` 
ADD CONSTRAINT `fk_users_stores` 
FOREIGN KEY (`store_id`) REFERENCES `stores` (`id`) 
ON DELETE RESTRICT 
ON UPDATE CASCADE;
