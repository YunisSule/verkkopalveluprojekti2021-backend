CREATE TABLE IF NOT EXISTS `user`
(
    user_id     int AUTO_INCREMENT,
    is_admin    boolean      NOT NULL DEFAULT false,
    username    varchar(255) NOT NULL,
    password    varchar(255) NOT NULL,
    firstname   varchar(255) NOT NULL,
    lastname    varchar(255) NOT NULL,
    email       varchar(255) NOT NULL,
    address     varchar(255) NOT NULL,
    city        varchar(255) NOT NULL,
    postal_code varchar(5)   NOT NULL,
    PRIMARY KEY (user_id)
);

CREATE TABLE IF NOT EXISTS `category`
(
    category_id int AUTO_INCREMENT,
    name        varchar(255) NOT NULL,
    PRIMARY KEY (category_id)
);

CREATE TABLE IF NOT EXISTS `product`
(
    product_id  int AUTO_INCREMENT,
    name        varchar(255)  NOT NULL,
    brand       varchar(255)  NOT NULL,
    description varchar(255)  NOT NULL,
    price       decimal(6, 2) NOT NULL,
    category_id int           NOT NULL,
    color       varchar(255)  NOT NULL,
    speed       int           NOT NULL,
    glide       int           NOT NULL,
    turn        int           NOT NULL,
    fade        int           NOT NULL,
    PRIMARY KEY (product_id),
    FOREIGN KEY (category_id) REFERENCES `category` (category_id)
);

CREATE TABLE IF NOT EXISTS `order`
(
    order_id   int AUTO_INCREMENT,
    user_id    int                                      NOT NULL,
    state      enum ('ordered', 'shipped', 'completed') NOT NULL,
    order_date datetime                                 NOT NULL,
    PRIMARY KEY (order_id),
    FOREIGN KEY (user_id) REFERENCES `user` (user_id) ON DELETE CASCADE
);

CREATE TABLE IF NOT EXISTS `order_row`
(
    order_row  int AUTO_INCREMENT,
    order_id   int NOT NULL,
    product_id int NOT NULL,
    quantity   int NOT NULL,
    PRIMARY KEY (order_row),
    FOREIGN KEY (order_id) REFERENCES `order` (order_id) ON DELETE CASCADE,
    FOREIGN KEY (product_id) REFERENCES `product` (product_id) ON DELETE CASCADE
);

INSERT IGNORE INTO `user`
VALUES (1, false, 'mikko', 'salasana', 'Mikko', 'Mallikas', 'mikko@mail.com', 'katu 12', 'Helsinki', '00120');
INSERT IGNORE INTO `category`
VALUES (1, 'Kategoria');
INSERT IGNORE INTO `product`
VALUES (1, 'Frisbee', 'Valmistaja', 'Hieno kiekko', 11.90, 1, 'musta', 8, 4, 2, 1);
INSERT IGNORE INTO `product`
VALUES (2, 'Frisbee2', 'Valmistaja2', 'Hieno kiekko2', 15.90, 1, 'punainen', 5, 2, 7, 4);
INSERT IGNORE INTO `product`
VALUES (3, 'Frisbee3', 'Valmistaja3', 'Hieno kiekko3', 13.90, 1, 'keltainen', 7, 1, 3, 3);
INSERT IGNORE INTO `order`
VALUES (1, 1, 'ordered', '2021-11-09 12:00:00');
INSERT IGNORE INTO `order_row`
VALUES (1, 1, 1, 50);
INSERT IGNORE INTO `order_row`
VALUES (2, 1, 2, 15);