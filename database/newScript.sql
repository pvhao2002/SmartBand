CREATE DATABASE shop_laptop;
GO
USE shop_laptop;
GO
CREATE TABLE users (
    user_id INT IDENTITY PRIMARY KEY,
    email NVARCHAR(255) NOT NULL,
    password NVARCHAR(255) NOT NULL,
    full_name NVARCHAR(255) NOT NULL,
    role VARCHAR(50) NOT NULL DEFAULT 'user',
    status VARCHAR(50) NOT NULL DEFAULT 'inactive',
    CREATEd_at DATETIME DEFAULT GETDATE(),
    updated_at DATETIME DEFAULT GETDATE()
);
GO
CREATE TABLE categories (
    category_id INT IDENTITY PRIMARY KEY,
    category_name NVARCHAR(255) NOT NULL,
    description TEXT,
    status VARCHAR(50) NOT NULL DEFAULT 'active',
    CREATEd_at DATETIME DEFAULT GETDATE(),
    updated_at DATETIME DEFAULT GETDATE()
);
GO
CREATE TABLE products (
    product_id INT IDENTITY PRIMARY KEY,
    product_name NVARCHAR(255) NOT NULL,
    price DECIMAL(10, 2) NOT NULL,
    description TEXT,
    stock INT NOT NULL,
    product_image NVARCHAR(2000) NOT NULL,
    category_id INT NOT NULL,
    status VARCHAR(50) NOT NULL DEFAULT 'active',
    CREATEd_at DATETIME DEFAULT GETDATE(),
    updated_at DATETIME DEFAULT GETDATE(),
    FOREIGN KEY (category_id) REFERENCES categories(category_id)
);
GO
CREATE TABLE carts (
    cart_id INT IDENTITY PRIMARY KEY,
    user_id INT NOT NULL,
    total_price DECIMAL(10, 2) NOT NULL,
    total_quantity INT NOT NULL,
    CREATEd_at DATETIME DEFAULT GETDATE(),
    updated_at DATETIME DEFAULT GETDATE(),
    FOREIGN KEY (user_id) REFERENCES users(user_id)
);
GO
CREATE TABLE cart_items (
    cart_item_id INT IDENTITY PRIMARY KEY,
    cart_id INT NOT NULL,
    product_id INT NOT NULL,
    quantity INT NOT NULL,
    total_price DECIMAL(10, 2) NOT NULL,
    CREATEd_at DATETIME DEFAULT GETDATE(),
    updated_at DATETIME DEFAULT GETDATE(),
    FOREIGN KEY (cart_id) REFERENCES carts(cart_id),
    FOREIGN KEY (product_id) REFERENCES products(product_id)
);
GO
CREATE TABLE orders (
    order_id INT IDENTITY PRIMARY KEY,
    user_id INT NOT NULL,
    shipping_address NVARCHAR(255) NOT NULL,
    phone_number NVARCHAR(20) NOT NULL,
    full_name NVARCHAR(255) NOT NULL,
    total_price DECIMAL(10, 2) NOT NULL,
    total_quantity INT NOT NULL,
    status VARCHAR(50) DEFAULT 'pending',
    CREATEd_at DATETIME DEFAULT GETDATE(),
    updated_at DATETIME DEFAULT GETDATE(),
    FOREIGN KEY (user_id) REFERENCES users(user_id)
);
GO
CREATE TABLE order_items (
    order_item_id INT IDENTITY PRIMARY KEY,
    order_id INT NOT NULL,
    product_id INT NOT NULL,
    quantity INT NOT NULL,
    total_price DECIMAL(10, 2) NOT NULL,
    CREATEd_at DATETIME DEFAULT GETDATE(),
    updated_at DATETIME DEFAULT GETDATE(),
    FOREIGN KEY (order_id) REFERENCES orders(order_id),
    FOREIGN KEY (product_id) REFERENCES products(product_id)
);
-- INSERT DATA FOR TABLE users
INSERT INTO users (email, password, full_name, role, status)
VALUES (
        'admin@gmail.com',
        '1234qwer',
        'admin',
        'admin',
        'active'
    );
INSERT INTO users (
        email,
        password,
        full_name,
        role,
        status
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
-- INSERT DATA FOR TABLE categories
INSERT INTO categories (category_name, description, status)
VALUES (
        'Acer',
        'Laptop acer',
        'active'
    ),
    (
        'Asus',
        'Laptop asus',
        'active'
    ),
    (
        'Dell',
        'Laptop dell',
        'active'
    ),
    (
        'HP',
        'Laptop hp',
        'active'
    ),
    (
        'Lenovo',
        'Laptop lenovo',
        'active'
    );