<?php

require "../include/headers.php";
require "../include/functions.php";

/**
 * Update product. Takes data from JSON body.
 * Example: /product/updateproduct.php
 */
try {
    $db = getConnection();
    $body = json_decode(file_get_contents('php://input'));

    $productId = filter_var($body->product_id, FILTER_SANITIZE_STRING);
    $name = filter_var($body->name, FILTER_SANITIZE_STRING);
    $brand = filter_var($body->brand, FILTER_SANITIZE_STRING);
    $description = filter_var($body->description, FILTER_SANITIZE_STRING);
    $price = filter_var($body->price, FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION);
    $category_id = filter_var($body->category_id, FILTER_SANITIZE_NUMBER_INT);
    $color = filter_var($body->color, FILTER_SANITIZE_STRING);
    $speed = filter_var($body->speed, FILTER_SANITIZE_NUMBER_INT);
    $glide = filter_var($body->glide, FILTER_SANITIZE_NUMBER_INT);
    $turn = filter_var($body->turn, FILTER_SANITIZE_NUMBER_INT);
    $fade = filter_var($body->fade, FILTER_SANITIZE_NUMBER_INT);

    $sql = "UPDATE product SET name=?, brand=?, description=?, price=?, category_id=?, color=?, speed=?, glide=?, turn=?, fade=? WHERE product_id=?";
    $params = [$name, $brand, $description, $price, $category_id, $color, $speed, $glide, $turn, $fade, $productId];

    responseString($db, $sql, "Tuote päivitetty", "Virhe. Tuotetta ei päivitetty", $params);
} catch (Exception $e) {
    responseError($e);
}