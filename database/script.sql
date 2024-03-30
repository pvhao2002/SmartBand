DROP DATABASE IF EXISTS `smartband`;
CREATE DATABASE IF NOT EXISTS `smartband` DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci;
USE `smartband`;
CREATE TABLE `users` (
    `user_id` INT AUTO_INCREMENT PRIMARY KEY,
    `email` VARCHAR(255) NOT NULL,
    `password` VARCHAR(255) NOT NULL,
    `full_name` VARCHAR(255) NOT NULL,
    `role` ENUM('admin', 'user') NOT NULL DEFAULT 'user',
    `status` ENUM('active', 'inactive', 'block') NOT NULL DEFAULT 'inactive',
    `created_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    `updated_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
);
CREATE TABLE `categories` (
    `category_id` INT AUTO_INCREMENT PRIMARY KEY,
    `category_name` VARCHAR(255) NOT NULL,
    `description` TEXT,
    `status` ENUM('active', 'inactive') NOT NULL DEFAULT 'active',
    `created_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    `updated_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
);
CREATE TABLE `products` (
    `product_id` INT AUTO_INCREMENT PRIMARY KEY,
    `product_name` VARCHAR(255) NOT NULL,
    `price` DECIMAL(10, 2) NOT NULL,
    `description` TEXT,
    `stock` INT NOT NULL,
    `product_image` VARCHAR(2000) NOT NULL,
    `category_id` INT NOT NULL,
    `status` ENUM('active', 'inactive') NOT NULL DEFAULT 'active',
    `created_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    `updated_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    FOREIGN KEY (`category_id`) REFERENCES `categories`(`category_id`)
);
CREATE TABLE `carts` (
    `cart_id` INT AUTO_INCREMENT PRIMARY KEY,
    `user_id` INT NOT NULL,
    `total_price` DECIMAL(10, 2) NOT NULL,
    `total_quantity` INT NOT NULL,
    `created_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    `updated_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    FOREIGN KEY (`user_id`) REFERENCES `users`(`user_id`)
);
CREATE TABLE `cart_items` (
    `cart_item_id` INT AUTO_INCREMENT PRIMARY KEY,
    `cart_id` INT NOT NULL,
    `product_id` INT NOT NULL,
    `quantity` INT NOT NULL,
    `total_price` DECIMAL(10, 2) NOT NULL,
    `created_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    `updated_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    FOREIGN KEY (`cart_id`) REFERENCES `carts`(`cart_id`),
    FOREIGN KEY (`product_id`) REFERENCES `products`(`product_id`)
);
CREATE TABLE `orders` (
    `order_id` INT AUTO_INCREMENT PRIMARY KEY,
    `user_id` INT NOT NULL,
    `shipping_address` VARCHAR(255) NOT NULL,
    `phone_number` VARCHAR(20) NOT NULL,
    `full_name` VARCHAR(255) NOT NULL,
    `total_price` DECIMAL(10, 2) NOT NULL,
    `total_quantity` INT NOT NULL,
    `payment_method` ENUM('CASH', 'VN_PAY') NOT NULL,
    `status` ENUM(
        'pending',
        'processing',
        'completed',
        'cancelled',
        'refunded',
        'done'
    ) NOT NULL DEFAULT 'pending',
    `qr_code` VARCHAR(2000) NULL,
    `created_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    `updated_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    FOREIGN KEY (`user_id`) REFERENCES `users`(`user_id`)
);
CREATE TABLE `order_items` (
    `order_item_id` INT AUTO_INCREMENT PRIMARY KEY,
    `order_id` INT NOT NULL,
    `product_id` INT NOT NULL,
    `quantity` INT NOT NULL,
    `total_price` DECIMAL(10, 2) NOT NULL,
    `created_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    `updated_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    FOREIGN KEY (`order_id`) REFERENCES `orders`(`order_id`),
    FOREIGN KEY (`product_id`) REFERENCES `products`(`product_id`)
);
CREATE TABLE `otp` (
    `id` INT AUTO_INCREMENT PRIMARY KEY,
    `email` VARCHAR(255) NOT NULL unique key,
    `otp` VARCHAR(255) NOT NULL,
    `created_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);
-- INSERT DATA FOR TABLE `users`
INSERT INTO `users` (`email`, `password`, full_name, `role`, `status`)
VALUES (
        'admin@gmail.com',
        '1234qwer',
        'admin',
        'admin',
        'active'
    );
INSERT INTO `users` (
        `email`,
        `password`,
        `full_name`,
        `role`,
        `status`
    )
VALUES (
        'user1@example.com',
        '1234qwer',
        'User 1',
        'user',
        'active'
    ),
    (
        'user2@example.com',
        '1234qwer',
        'User 2',
        'user',
        'active'
    ),
    (
        'user3@example.com',
        '1234qwer',
        'User 3',
        'user',
        'active'
    ),
    (
        'user4@example.com',
        '1234qwer',
        'User 4',
        'user',
        'active'
    ),
    (
        'user5@example.com',
        '1234qwer',
        'User 5',
        'user',
        'active'
    ),
    (
        'user6@example.com',
        '1234qwer',
        'User 6',
        'user',
        'active'
    ),
    (
        'user7@example.com',
        '1234qwer',
        'User 7',
        'user',
        'active'
    ),
    (
        'user8@example.com',
        '1234qwer',
        'User 8',
        'user',
        'active'
    ),
    (
        'user9@example.com',
        '1234qwer',
        'User 9',
        'user',
        'active'
    );
-- INSERT DATA FOR TABLE `categories`
INSERT INTO `categories` (`category_name`, `description`, `status`)
VALUES (
        'Đồng hồ thời trang',
        'Đồng hồ thời trang',
        'active'
    ),
    ('Đồng hồ cơ', 'Đồng hồ cơ', 'active'),
    (
        'Đồng hồ thông minh',
        'Đồng hồ thông minh',
        'active'
    ),
    ('Apple watch', 'Apple watch', 'active'),
    ('Samsung watch', 'Samsung watch', 'active'),
    ('Xiaomi watch', 'Xiaomi watch', 'active'),
    ('Huawei watch', 'Huawei watch', 'active'),
    ('Garmin watch', 'Garmin watch', 'active'),
    ('Amazfit watch', 'Amazfit watch', 'active'),
    (
        'Đồng hồ thông minh cũ giá rẻ',
        'Đồng hồ thông minh cũ',
        'active'
    );
ALTER TABLE cart_items
ADD UNIQUE INDEX idx_cart_product (cart_id, product_id);