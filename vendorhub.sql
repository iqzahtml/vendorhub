CREATE DATABASE vendorhub;
USE vendorhub;

-- ===========================
-- 1. USERS
-- ===========================
CREATE TABLE users (
    user_id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(100) NOT NULL,
    email VARCHAR(100) NOT NULL UNIQUE,
    phone VARCHAR(20),
    password VARCHAR(255) NOT NULL,
    role ENUM('customer','vendor','admin') NOT NULL,
    status ENUM('active','inactive','pending') DEFAULT 'active'
);

-- ===========================
-- 2. VENDORS
-- ===========================
CREATE TABLE vendors (
    vendor_id INT AUTO_INCREMENT PRIMARY KEY,
    user_id INT NOT NULL,
    business_name VARCHAR(150) NOT NULL,
    business_address TEXT,
    category VARCHAR(100),
    delivery_method ENUM('Pickup','Postage','Both') DEFAULT 'Both',
    approval_status ENUM('Pending','Approved','Rejected') DEFAULT 'Pending',

    CONSTRAINT fk_vendor_user
    FOREIGN KEY (user_id)
    REFERENCES users(user_id)
    ON DELETE CASCADE
);

-- ===========================
-- 3. CATEGORIES
-- ===========================
CREATE TABLE categories (
    category_id INT AUTO_INCREMENT PRIMARY KEY,
    category_name VARCHAR(100) NOT NULL
);

-- ===========================
-- 4. PRODUCTS
-- ===========================
CREATE TABLE products (
    product_id INT AUTO_INCREMENT PRIMARY KEY,
    vendor_id INT NOT NULL,
    category_id INT NOT NULL,
    product_name VARCHAR(150) NOT NULL,
    description TEXT,
    price DECIMAL(10,2) NOT NULL,
    stock_quantity INT DEFAULT 0,
    image VARCHAR(255),

    CONSTRAINT fk_product_vendor
    FOREIGN KEY (vendor_id)
    REFERENCES vendors(vendor_id)
    ON DELETE CASCADE,

    CONSTRAINT fk_product_category
    FOREIGN KEY (category_id)
    REFERENCES categories(category_id)
);
-- ===========================
-- 5. ORDERS
-- ===========================
CREATE TABLE orders (
    order_id INT AUTO_INCREMENT PRIMARY KEY,
    customer_id INT NOT NULL,
    order_date DATETIME DEFAULT CURRENT_TIMESTAMP,
    total_amount DECIMAL(10,2) NOT NULL,
    delivery_method ENUM('Pickup','Postage'),
    order_status ENUM('Pending','Processing','Completed','Cancelled')
    DEFAULT 'Pending',

    CONSTRAINT fk_order_customer
    FOREIGN KEY (customer_id)
    REFERENCES users(user_id)
);
-- ===========================
-- 6. ORDER DETAILS
-- ===========================
CREATE TABLE order_details (
    order_detail_id INT AUTO_INCREMENT PRIMARY KEY,
    order_id INT NOT NULL,
    product_id INT NOT NULL,
    quantity INT NOT NULL,
    unit_price DECIMAL(10,2) NOT NULL,
    subtotal DECIMAL(10,2) NOT NULL,

    CONSTRAINT fk_detail_order
    FOREIGN KEY (order_id)
    REFERENCES orders(order_id)
    ON DELETE CASCADE,

    CONSTRAINT fk_detail_product
    FOREIGN KEY (product_id)
    REFERENCES products(product_id)
);
-- ===========================
-- 7. PAYMENTS
-- ===========================
CREATE TABLE payments (
    payment_id INT AUTO_INCREMENT PRIMARY KEY,
    order_id INT NOT NULL,
    payment_method ENUM('FPX','Credit Card','Debit Card','Cash'),
    payment_status ENUM('Pending','Paid','Failed')
    DEFAULT 'Pending',
    payment_date DATETIME,
    amount DECIMAL(10,2) NOT NULL,

    CONSTRAINT fk_payment_order
    FOREIGN KEY (order_id)
    REFERENCES orders(order_id)
);
-- ===========================
-- 8. REVIEWS
-- ===========================
CREATE TABLE reviews (
    review_id INT AUTO_INCREMENT PRIMARY KEY,
    customer_id INT NOT NULL,
    product_id INT NOT NULL,
    rating INT CHECK (rating BETWEEN 1 AND 5),
    review TEXT,
    review_date DATETIME DEFAULT CURRENT_TIMESTAMP,

    CONSTRAINT fk_review_customer
    FOREIGN KEY (customer_id)
    REFERENCES users(user_id),

    CONSTRAINT fk_review_product
    FOREIGN KEY (product_id)
    REFERENCES products(product_id)
);
-- ===========================
-- 9. INVENTORY (OPTIONAL)
-- ===========================
CREATE TABLE inventory (
    inventory_id INT AUTO_INCREMENT PRIMARY KEY,
    product_id INT NOT NULL,
    quantity INT NOT NULL,
    last_updated DATETIME DEFAULT CURRENT_TIMESTAMP,

    CONSTRAINT fk_inventory_product
    FOREIGN KEY (product_id)
    REFERENCES products(product_id)
    ON DELETE CASCADE
);
-- ===========================
-- 10. COMMISSION (OPTIONAL)
-- ===========================
CREATE TABLE commission (
    commission_id INT AUTO_INCREMENT PRIMARY KEY,
    vendor_id INT NOT NULL,
    order_id INT NOT NULL,
    commission_rate DECIMAL(5,2),
    commission_amount DECIMAL(10,2),

    CONSTRAINT fk_commission_vendor
    FOREIGN KEY (vendor_id)
    REFERENCES vendors(vendor_id),

    CONSTRAINT fk_commission_order
    FOREIGN KEY (order_id)
    REFERENCES orders(order_id)
);vendorhubvendors