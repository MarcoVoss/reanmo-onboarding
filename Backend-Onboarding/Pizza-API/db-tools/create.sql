drop database if exists pizza;

create database pizza;

create table pizza.Users (
    id int AUTO_INCREMENT,
    name varchar(255),
    email varchar(255),
    password varchar(255),
    phone varchar(255),
    PRIMARY KEY (id)
);

create table pizza.Orders (
    id int AUTO_INCREMENT,
    user_id int,
    date date,
    price float,
    PRIMARY KEY (id),
    FOREIGN KEY (user_id) REFERENCES pizza.Users(id)
);

create table pizza.categories (
    id int AUTO_INCREMENT,
    name varchar(255),
    PRIMARY KEY (id)
);

create table pizza.products (
    id int AUTO_INCREMENT,
    category_id int,
    name varchar(255),
    imagePath varchar(255),
    PRIMARY KEY (id),
    FOREIGN KEY (category_id) REFERENCES pizza.Categories(id)
);

create table pizza.Sizes (
    id int AUTO_INCREMENT,
    name varchar(255),
    PRIMARY KEY (id)
);

create table pizza.products_sizes (
    size_id int,
    product_id int,
    price float,
    PRIMARY KEY(size_id, product_id),
    FOREIGN KEY (size_id) REFERENCES pizza.Sizes(id),
    FOREIGN KEY (product_id) REFERENCES pizza.Products(id)
);

create table pizza.orders_products_sizes (
    size_id int,
    order_id int,
    product_id int,
    amount int,
    PRIMARY KEY(size_id, product_id, order_id),
    FOREIGN KEY (size_id) REFERENCES pizza.Sizes(id),
    FOREIGN KEY (order_id) REFERENCES pizza.Orders(id),
    FOREIGN KEY (product_id) REFERENCES pizza.Products(id)
);

create table pizza.products_users_sizes (
    size_id int,
    user_id int,
    product_id int,
    amount int,
    PRIMARY KEY(size_id, product_id, user_id),
    FOREIGN KEY (size_id) REFERENCES pizza.Sizes(id),
    FOREIGN KEY (user_id) REFERENCES pizza.Users(id),
    FOREIGN KEY (product_id) REFERENCES pizza.Products(id)
);

INSERT INTO pizza.categories (name) VALUES ('Burger');
INSERT INTO pizza.categories (name) VALUES ('Salat');
INSERT INTO pizza.categories (name) VALUES ('Pizza');

INSERT INTO pizza.products (category_id, name, imagePath) VALUES (1, 'Hamburger', '/bla/bla');
INSERT INTO pizza.products (category_id, name, imagePath) VALUES (2, 'Blatt', '/bla/bla');
INSERT INTO pizza.products (category_id, name, imagePath) VALUES (2, 'Karotten', '/bla/bla');
INSERT INTO pizza.products (category_id, name, imagePath) VALUES (3, 'Salami', '/bla/bla');
INSERT INTO pizza.products (category_id, name, imagePath) VALUES (3, 'Schinken', '/bla/bla');

INSERT INTO pizza.sizes (name) VALUES ('Small');
INSERT INTO pizza.sizes (name) VALUES ('Medium');
INSERT INTO pizza.sizes (name) VALUES ('Large');

INSERT INTO pizza.products_sizes (size_id, product_id, price) VALUES (1, 1, 11.0);
INSERT INTO pizza.products_sizes (size_id, product_id, price) VALUES (1, 2, 12.0);
INSERT INTO pizza.products_sizes (size_id, product_id, price) VALUES (1, 3, 13.0);
INSERT INTO pizza.products_sizes (size_id, product_id, price) VALUES (1, 4, 14.0);
INSERT INTO pizza.products_sizes (size_id, product_id, price) VALUES (2, 2, 15.0);
INSERT INTO pizza.products_sizes (size_id, product_id, price) VALUES (2, 3, 16.0);
INSERT INTO pizza.products_sizes (size_id, product_id, price) VALUES (2, 4, 17.0);
INSERT INTO pizza.products_sizes (size_id, product_id, price) VALUES (2, 5, 18.0);
INSERT INTO pizza.products_sizes (size_id, product_id, price) VALUES (3, 1, 19.0);
INSERT INTO pizza.products_sizes (size_id, product_id, price) VALUES (3, 3, 20.0);
INSERT INTO pizza.products_sizes (size_id, product_id, price) VALUES (3, 4, 21.0);
INSERT INTO pizza.products_sizes (size_id, product_id, price) VALUES (3, 5, 22.0);

INSERT INTO pizza.users (name, email, password, phone) VALUES ('Marco', 'marco@gmx.de', '$2a$12$Td.FZi9Evg2Z8HvW5vheL.Tty96pNpoMv/jHOanlwfa4rKdLEQE0e', '+49 1525 99999999');
INSERT INTO pizza.users (name, email, password, phone) VALUES ('Rüdiger', 'ruediger@gmx.de', '$2a$12$Td.FZi9Evg2Z8HvW5vheL.Tty96pNpoMv/jHOanlwfa4rKdLEQE0e', '+49 1525 88888888');
INSERT INTO pizza.users (name, email, password, phone) VALUES ('Klaus', 'klaus@gmx.de', '$2a$12$Td.FZi9Evg2Z8HvW5vheL.Tty96pNpoMv/jHOanlwfa4rKdLEQE0e', '+49 1525 7777777');

INSERT INTO pizza.orders (user_id, date, price) VALUES (1, '2021-11-11', 22.0);
INSERT INTO pizza.orders (user_id, date, price) VALUES (1, '2021-12-24', 8.0);
INSERT INTO pizza.orders (user_id, date, price) VALUES (1, '2022-02-01', 10.0);
INSERT INTO pizza.orders (user_id, date, price) VALUES (1, '2022-03-06', 15.0);
INSERT INTO pizza.orders (user_id, date, price) VALUES (2, '2022-01-01', 27.50);
INSERT INTO pizza.orders (user_id, date, price) VALUES (2, '2022-01-02', 11.97);

INSERT INTO pizza.orders_products_sizes (order_id, product_id, size_id, amount) VALUES (1, 1, 3, 1);
INSERT INTO pizza.orders_products_sizes (order_id, product_id, size_id, amount) VALUES (1, 2, 2, 2);
INSERT INTO pizza.orders_products_sizes (order_id, product_id, size_id, amount) VALUES (1, 3, 1, 1);
INSERT INTO pizza.orders_products_sizes (order_id, product_id, size_id, amount) VALUES (2, 2, 1, 1);
INSERT INTO pizza.orders_products_sizes (order_id, product_id, size_id, amount) VALUES (3, 1, 2, 2);
INSERT INTO pizza.orders_products_sizes (order_id, product_id, size_id, amount) VALUES (4, 1, 1, 1);
INSERT INTO pizza.orders_products_sizes (order_id, product_id, size_id, amount) VALUES (4, 2, 3, 1);
INSERT INTO pizza.orders_products_sizes (order_id, product_id, size_id, amount) VALUES (5, 4, 3, 2);
INSERT INTO pizza.orders_products_sizes (order_id, product_id, size_id, amount) VALUES (5, 5, 3, 2);
INSERT INTO pizza.orders_products_sizes (order_id, product_id, size_id, amount) VALUES (6, 2, 1, 2);

INSERT INTO pizza.products_users_sizes (product_id, user_id, size_id, amount) VALUES (1, 1, 1, 1);
INSERT INTO pizza.products_users_sizes (product_id, user_id, size_id, amount) VALUES (2, 1, 2, 2);
INSERT INTO pizza.products_users_sizes (product_id, user_id, size_id, amount) VALUES (3, 3, 3, 2);