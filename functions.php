<?php

function createTables($conn)
{
    $userTable = "CREATE TABLE IF NOT EXISTS `user` (
         user_id     int AUTO_INCREMENT,
         username    varchar(255) NOT NULL,
         password    varchar(255) NOT NULL,
         firstname   varchar(255) NOT NULL,
         lastname    varchar(255) NOT NULL,
         email       varchar(255) NOT NULL,
         address     varchar(255) NOT NULL,
         city        varchar(255) NOT NULL,
         postal_code varchar(5) NOT NULL,
         PRIMARY KEY (user_id)
    )";

    $categoryTable = "CREATE TABLE IF NOT EXISTS `category` (
         category_id int AUTO_INCREMENT,
         name        varchar(255) NOT NULL,
         PRIMARY KEY (category_id)
    )";

    $productTable = "CREATE TABLE IF NOT EXISTS `product` (
         product_id  int AUTO_INCREMENT,
         name        varchar(255) NOT NULL,
         brand       varchar(255) NOT NULL,
         description varchar(255) NOT NULL,
         price       decimal(6,2) NOT NULL,
         category_id int NOT NULL,
         color       varchar(255) NOT NULL,
         speed       int NOT NULL,
         glide       int NOT NULL,
         turn        int NOT NULL,
         fade        int NOT NULL,
         PRIMARY KEY (product_id),
         FOREIGN KEY (category_id) REFERENCES `category` (category_id)
    )";

    $orderTable = "CREATE TABLE IF NOT EXISTS `order` (
         order_id   int AUTO_INCREMENT,
         user_id    int NOT NULL,
         state      enum('ordered', 'shipped', 'completed') NOT NULL,
         order_date datetime NOT NULL,
         PRIMARY KEY (order_id),
         FOREIGN KEY (user_id) REFERENCES `user` (user_id)
    )";

    $orderRowTable = "CREATE TABLE IF NOT EXISTS `order_row` (
         order_row  int AUTO_INCREMENT,
         order_id   int NOT NULL,
         product_id int NOT NULL,
         quantity   int NOT NULL,
         PRIMARY KEY (order_row),
         FOREIGN KEY (order_id) REFERENCES `order` (order_id) ON DELETE CASCADE,
         FOREIGN KEY (product_id) REFERENCES `product` (product_id)
    )";

    $conn->exec($categoryTable);
    $conn->exec($userTable);
    $conn->exec($productTable);
    $conn->exec($orderTable);
    $conn->exec($orderRowTable);
}

function fillTablesWithFakeData($conn)
{
    $userSql = "INSERT INTO user VALUES (1, 'mikko', 'salasana', 'Mikko', 'Mallikas', 'mikko@mail.com', 'katu 12', 'Helsinki', '00120')";
    $categorySql = "INSERT INTO category VALUES (1, 'Kategoria1')";
    $productSql = "INSERT INTO product VALUES (1, 'Frisbee', 'Brändi', 'Hieno kiekko', '12.90', 1, 'punainen', 5, 4, 3, 2)";
    $orderSql = "INSERT INTO `order` VALUES (1, 1, 'ordered', '2021-11-09 12:00:00')";
    $orderRowSql = "INSERT INTO order_row VALUES (1, 1, 1, 50)";

    $conn->exec($userSql);
    $conn->exec($categorySql);
    $conn->exec($productSql);
    $conn->exec($orderSql);
    $conn->exec($orderRowSql);
}