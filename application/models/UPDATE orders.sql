UPDATE orders 
SET date_time = DATE_SUB(date_time, INTERVAL 1 DAY)
WHERE DATE(date_time) = '2025-11-04';