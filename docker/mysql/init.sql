-- Harris Cars Service Center - Database Initialization
-- This file runs when the MySQL container first starts

CREATE DATABASE IF NOT EXISTS `harris_cars`
    CHARACTER SET utf8mb4
    COLLATE utf8mb4_unicode_ci;

CREATE DATABASE IF NOT EXISTS `harris_cars_testing`
    CHARACTER SET utf8mb4
    COLLATE utf8mb4_unicode_ci;

-- Grant permissions
GRANT ALL PRIVILEGES ON `harris_cars`.* TO 'harris_user'@'%';
GRANT ALL PRIVILEGES ON `harris_cars_testing`.* TO 'harris_user'@'%';
FLUSH PRIVILEGES;
