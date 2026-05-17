
CREATE TABLE IF NOT EXISTS shop (
    shop_id INT PRIMARY KEY AUTO_INCREMENT,
    name VARCHAR(255) NOT NULL,
    address VARCHAR(255) NOT NULL
    );

CREATE TABLE IF NOT EXISTS client (
    client_id INT PRIMARY KEY AUTO_INCREMENT,
    name VARCHAR(255) NOT NULL,
    phone VARCHAR(50) NOT NULL
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
    client_id INT NOT NULL,
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



-- Заполнение таблиц

    INSERT INTO shop (name, address) VALUES 
('Магазин №1', 'ул. Ленина, 10'),
('Магазин №2', 'ул. Пушкина, 5'),
('Магазин №3', 'пр-т Мира, 42'),
('Магазин №4', 'ул. Садовая, 18'),
('Магазин №5', 'ул. Гагарина, 33');

-- Заполнение клиентов (client)
INSERT INTO client (name, phone) VALUES 
('Иванов Иван ', '+79061112233'),
('Петров Петр', '+79062223344'),
('Андреев Андрей', '+79063334455'),
('Сергеев Сергей', '+79064445566'),
('Федоров Федор', '+79065556677');

-- Заполнение продуктов (product)
INSERT INTO product (shop_id, name, price, count) VALUES 
(1, 'Ноутбук', 200000.00, 15),
(2, 'планшет', 80000.00, 20),
(3, 'Наушники', 8000.00, 40),
(4, 'Клавиатура', 3500.00, 50),
(5, 'мышь', 1000.00, 30);

-- Заполнение заказов (order)
INSERT INTO orders (shop_id, client_id, seller_name, created_at) VALUES 
(1, 1, 'Иван С.', '2026-05-15 10:30:00'),
(2, 2, 'Мария В.', '2026-05-15 11:15:00'),
(3, 3, 'Анна Н.', '2026-05-15 14:00:00'),
(4, 4, 'Дарья П.', '2026-05-16 09:45:00'),
(5, 5, 'Игорь К.', '2026-05-16 12:20:00');

-- Заполнение соответствий заказов и продуктов (order_product)
INSERT INTO order_product (order_id, product_id, price, count) VALUES 
(1, 1, 200000.00, 1), -- Товар 1 -> Заказе 1 со скидкой
(2, 2, 80000.00, 1), -- Товар 2 -> Заказе 2
(3, 3, 8000.00, 2),  -- Товар 3 -> Заказе 3 (2 шт.)
(4, 4, 3500.00, 1),  -- Товар 4 -> Заказе 4
(5, 5, 1000.00, 1);  -- Товар 5 -> Заказе 5 со скидкой

