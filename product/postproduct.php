<?php

require "../include/headers.php";
require "../include/functions.php";

/**
 * Post product. Takes data from JSON body.
 * Example: /product/postproduct.php
 */
try {
    $db = getConnection();
    $body = json_decode(file_get_contents('php://input'));

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

    $sql = "INSERT INTO product VALUES (null, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
    $params = [$name, $brand, $description, $price, $category_id, $color, $speed, $glide, $turn, $fade];

    responseString($db, $sql, "Tuote lisätty", "Virhe. Tuotetta ei lisätty", $params);
} catch (Exception $e) {
    responseError($e);
}