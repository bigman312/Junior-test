-- Create the database if it doesn't exist
CREATE DATABASE IF NOT EXISTS product CHARACTER SET utf8mb4 COLLATE utf8mb4_latvian_ci;

-- Use the newly created database
USE product;

-- Create the products table
CREATE TABLE products (
    id INT AUTO_INCREMENT PRIMARY KEY,
    sku VARCHAR(255) NOT NULL,
    name VARCHAR(255) NOT NULL,
    price DECIMAL(10, 2) NOT NULL,
    type VARCHAR(50) NOT NULL,
    weight DECIMAL(10, 2) NULL,
    size_mb DECIMAL(10, 2) NULL,
    height DECIMAL(10, 2) NULL,
    width DECIMAL(10, 2) NULL,
    length DECIMAL(10, 2) NULL
);

-- Insert products into the table
INSERT INTO products (sku, name, price, type, weight) 
VALUES ('B001', 'The Great Gatsby', 19.99, 'book', 2.5);

INSERT INTO products (sku, name, price, type, size_mb) 
VALUES ('D001', 'Inception', 24.99, 'dvd', 4500);

INSERT INTO products (sku, name, price, type, height, width, length) 
VALUES ('F001', 'Oak Table', 299.99, 'furniture', 30, 60, 120);
