-- JDev Mail API Database Schema
-- Version 1.0

CREATE DATABASE IF NOT EXISTS `jdev_mail_api` 
CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;

USE `jdev_mail_api`;

-- Table users
CREATE TABLE IF NOT EXISTS `users` (
    `id` INT AUTO_INCREMENT PRIMARY KEY,
    `name` VARCHAR(100) NOT NULL,
    `email` VARCHAR(100) UNIQUE NOT NULL,
    `password` VARCHAR(255) NOT NULL,
    `role` ENUM('user', 'admin') DEFAULT 'user',
    `status` ENUM('active', 'suspended', 'banned') DEFAULT 'active',
    `trial_emails_sent` INT DEFAULT 0,
    `trial_limit` INT DEFAULT 50,
    `email_verified` BOOLEAN DEFAULT FALSE,
    `verification_token` VARCHAR(255) NULL,
    `reset_token` VARCHAR(255) NULL,
    `reset_expires` DATETIME NULL,
    `last_login_ip` VARCHAR(45) NULL,
    `last_login_at` DATETIME NULL,
    `created_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    `updated_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    INDEX idx_email (`email`),
    INDEX idx_status (`status`)
);

-- Table sites
CREATE TABLE IF NOT EXISTS `sites` (
    `id` INT AUTO_INCREMENT PRIMARY KEY,
    `user_id` INT NOT NULL,
    `name` VARCHAR(100) NOT NULL,
    `domain` VARCHAR(255) NOT NULL,
    `site_id` VARCHAR(50) UNIQUE NOT NULL,
    `public_key` VARCHAR(100) UNIQUE NOT NULL,
    `secret_key` VARCHAR(255) NOT NULL,
    `is_active` BOOLEAN DEFAULT TRUE,
    `emails_sent` INT DEFAULT 0,
    `rate_limit_per_minute` INT DEFAULT 60,
    `created_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    `updated_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    FOREIGN KEY (`user_id`) REFERENCES `users`(`id`) ON DELETE CASCADE,
    INDEX idx_user_id (`user_id`),
    INDEX idx_site_id (`site_id`),
    INDEX idx_public_key (`public_key`),
    INDEX idx_is_active (`is_active`)
);

-- Table plans
CREATE TABLE IF NOT EXISTS `plans` (
    `id` INT AUTO_INCREMENT PRIMARY KEY,
    `name` VARCHAR(50) NOT NULL,
    `slug` VARCHAR(50) UNIQUE NOT NULL,
    `description` TEXT,
    `duration_months` INT NOT NULL,
    `price` DECIMAL(10, 2) NOT NULL,
    `emails_limit` INT NULL COMMENT 'NULL for unlimited',
    `features` JSON,
    `is_active` BOOLEAN DEFAULT TRUE,
    `sort_order` INT DEFAULT 0,
    `created_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    INDEX idx_is_active (`is_active`),
    INDEX idx_sort_order (`sort_order`)
);

-- Table subscriptions
CREATE TABLE IF NOT EXISTS `subscriptions` (
    `id` INT AUTO_INCREMENT PRIMARY KEY,
    `user_id` INT NOT NULL,
    `plan_id` INT NOT NULL,
    `status` ENUM('active', 'expired', 'cancelled', 'pending') DEFAULT 'pending',
    `start_date` DATETIME NOT NULL,
    `end_date` DATETIME NOT NULL,
    `emails_sent_in_period` INT DEFAULT 0,
    `auto_renew` BOOLEAN DEFAULT FALSE,
    `cancelled_at` DATETIME NULL,
    `created_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    `updated_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    FOREIGN KEY (`user_id`) REFERENCES `users`(`id`) ON DELETE CASCADE,
    FOREIGN KEY (`plan_id`) REFERENCES `plans`(`id`),
    INDEX idx_user_id (`user_id`),
    INDEX idx_status (`status`),
    INDEX idx_end_date (`end_date`)
);

-- Table payments
CREATE TABLE IF NOT EXISTS `payments` (
    `id` INT AUTO_INCREMENT PRIMARY KEY,
    `user_id` INT NOT NULL,
    `subscription_id` INT NULL,
    `transaction_id` VARCHAR(100) UNIQUE,
    `amount` DECIMAL(10, 2) NOT NULL,
    `currency` VARCHAR(3) DEFAULT 'USD',
    `payment_method` VARCHAR(50),
    `status` ENUM('pending', 'paid', 'failed', 'cancelled', 'refunded') DEFAULT 'pending',
    `payment_details` JSON,
    `paid_at` DATETIME NULL,
    `created_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    `updated_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    FOREIGN KEY (`user_id`) REFERENCES `users`(`id`) ON DELETE CASCADE,
    FOREIGN KEY (`subscription_id`) REFERENCES `subscriptions`(`id`) ON DELETE SET NULL,
    INDEX idx_user_id (`user_id`),
    INDEX idx_status (`status`),
    INDEX idx_transaction_id (`transaction_id`)
);

-- Table email_logs
CREATE TABLE IF NOT EXISTS `email_logs` (
    `id` BIGINT AUTO_INCREMENT PRIMARY KEY,
    `user_id` INT NOT NULL,
    `site_id` INT NOT NULL,
    `recipient` VARCHAR(255) NOT NULL,
    `subject` VARCHAR(500),
    `status` ENUM('sent', 'failed', 'blocked') NOT NULL,
    `error_message` TEXT,
    `ip_address` VARCHAR(45),
    `user_agent` TEXT,
    `response` TEXT,
    `sent_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (`user_id`) REFERENCES `users`(`id`) ON DELETE CASCADE,
    FOREIGN KEY (`site_id`) REFERENCES `sites`(`id`) ON DELETE CASCADE,
    INDEX idx_user_id (`user_id`),
    INDEX idx_site_id (`site_id`),
    INDEX idx_status (`status`),
    INDEX idx_sent_at (`sent_at`),
    INDEX idx_recipient (`recipient`)
);

-- Table api_rate_limits
CREATE TABLE IF NOT EXISTS `api_rate_limits` (
    `id` BIGINT AUTO_INCREMENT PRIMARY KEY,
    `api_key` VARCHAR(100),
    `ip_address` VARCHAR(45),
    `endpoint` VARCHAR(100),
    `request_count` INT DEFAULT 1,
    `reset_at` DATETIME NOT NULL,
    `created_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    `updated_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    INDEX idx_api_key (`api_key`),
    INDEX idx_ip_address (`ip_address`),
    INDEX idx_reset_at (`reset_at`)
);

-- Table password_resets
CREATE TABLE IF NOT EXISTS `password_resets` (
    `id` INT AUTO_INCREMENT PRIMARY KEY,
    `email` VARCHAR(100) NOT NULL,
    `token` VARCHAR(255) NOT NULL,
    `expires_at` DATETIME NOT NULL,
    `used` BOOLEAN DEFAULT FALSE,
    `created_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    INDEX idx_email (`email`),
    INDEX idx_token (`token`),
    INDEX idx_expires_at (`expires_at`)
);

-- Table admin_logs
CREATE TABLE IF NOT EXISTS `admin_logs` (
    `id` BIGINT AUTO_INCREMENT PRIMARY KEY,
    `admin_id` INT NOT NULL,
    `action` VARCHAR(100) NOT NULL,
    `target_type` VARCHAR(50),
    `target_id` INT,
    `details` JSON,
    `ip_address` VARCHAR(45),
    `created_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (`admin_id`) REFERENCES `users`(`id`) ON DELETE CASCADE,
    INDEX idx_admin_id (`admin_id`),
    INDEX idx_action (`action`),
    INDEX idx_created_at (`created_at`)
);

-- Insert default plans
INSERT INTO `plans` (`name`, `slug`, `description`, `duration_months`, `price`, `emails_limit`, `features`, `sort_order`) VALUES
('Free Trial', 'free', 'Perfect for testing the service', 0, 0.00, 50, '{"features": ["50 free emails", "Basic support", "API access", "Email logs"]}', 1),
('Monthly Unlimited', 'monthly', 'Unlimited emails for one month', 1, 1.00, NULL, '{"features": ["Unlimited emails", "Priority support", "Advanced analytics", "API access", "Email logs", "Rate limit: 100/min"]}', 2),
('Quarterly Unlimited', 'quarterly', 'Best value for quarterly needs', 3, 2.50, NULL, '{"features": ["Unlimited emails", "Priority support", "Advanced analytics", "API access", "Email logs", "Rate limit: 200/min", "Save 17%"]}', 3),
('Semi-Annual Unlimited', 'semi_annual', 'Great for long-term projects', 6, 4.50, NULL, '{"features": ["Unlimited emails", "Priority support", "Advanced analytics", "API access", "Email logs", "Rate limit: 300/min", "Save 25%"]}', 4),
('Annual Unlimited', 'annual', 'Best value for yearly commitment', 12, 8.00, NULL, '{"features": ["Unlimited emails", "VIP support", "Advanced analytics", "API access", "Email logs", "Rate limit: 500/min", "Save 33%"]}', 5);

-- Create default admin user (password: Admin@123)
INSERT INTO `users` (`name`, `email`, `password`, `role`, `email_verified`) VALUES
('Admin', 'admin@jdevmail.com', '$2y$10$YourHashHere', 'admin', TRUE);

-- Insert sample free subscription for new users trigger
DELIMITER $$
CREATE TRIGGER `create_free_subscription` AFTER INSERT ON `users`
FOR EACH ROW
BEGIN
    DECLARE free_plan_id INT;
    SELECT id INTO free_plan_id FROM plans WHERE slug = 'free' LIMIT 1;
    
    INSERT INTO subscriptions (user_id, plan_id, status, start_date, end_date)
    VALUES (NEW.id, free_plan_id, 'active', NOW(), DATE_ADD(NOW(), INTERVAL 1 YEAR));
END$$
DELIMITER ;