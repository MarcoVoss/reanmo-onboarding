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
    name varchar(255),
    image blob,
    PRIMARY KEY (id)
);

create table pizza.Sizes (
    id int AUTO_INCREMENT,
    name varchar(255),
    PRIMARY KEY (id)
);

create table pizza.categories_products (
    category_id int,
    product_id int,
    PRIMARY KEY(category_id, product_id),
    FOREIGN KEY (category_id) REFERENCES pizza.Categories(id),
    FOREIGN KEY (product_id) REFERENCES pizza.Products(id)
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