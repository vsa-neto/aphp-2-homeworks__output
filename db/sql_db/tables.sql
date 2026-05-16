
CREATE TABLE IF NOT EXISTS shop (
    shop_id INT PRIMARY KEY AUTO_INCREMENT,
    name VARCHAR(255) UNIQUE NOT NULL,
    address VARCHAR(255) NOT NULL
    );

CREATE TABLE IF NOT EXISTS client (
    client_id INT PRIMARY KEY AUTO_INCREMENT,
    name VARCHAR(255) NOT NULL,
    phone VARCHAR(50) UNIQUE NOT NULL
    );

CREATE TABLE IF NOT EXISTS product (
    product_id INT PRIMARY KEY AUTO_INCREMENT,
    shop_id INT NOT NULL,
    name VARCHAR(255) NOT NULL,
    price DECIMAL(10, 2) NOT NULL,
    count INT NOT NULL DEFAULT 0,
    FOREIGN KEY (shop_id) REFERENCES shop(shop_id)
    );

CREATE TABLE IF NOT EXISTS orders (
    order_id INT PRIMARY KEY AUTO_INCREMENT,
    shop_id INT NOT NULL,
    client_id INT UNIQUE NOT NULL,
    seller_name VARCHAR(255) NOT NULL,
    created_at DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (shop_id) REFERENCES shop(shop_id),
    FOREIGN KEY (client_id) REFERENCES client(client_id)
    );

CREATE TABLE IF NOT EXISTS order_product (
    order_id INT NOT NULL,
    product_id INT NOT NULL,
    price DECIMAL(8, 2) NOT NULL, -- цена за единицу товара в заказе
    count INT NOT NULL DEFAULT 1, -- количество в заказе
    PRIMARY KEY (order_id, product_id),
    -- связь ключей таблицы "order_product" с таблицами "orders" и "product"
    FOREIGN KEY (order_id) REFERENCES orders(order_id),
    FOREIGN KEY (product_id) REFERENCES product(product_id)
    );
