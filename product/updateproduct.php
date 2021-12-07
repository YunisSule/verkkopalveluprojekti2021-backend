<?php

require "../include/headers.php";
require "../include/functions.php";
// require "../auth/login.php";

/**
 * Update product. Takes data from JSON body.
 * Example: /product/updateproduct.php
 */

// if (checkPermissions($user_id) == "false") {
//     header("HTTP/1.1 403 Forbidden");
//     echo '{"error": "No permissions."}';
//     exit;
// }

try {
    $db = getConnection();
    $body = json_decode(file_get_contents('php://input'));

    $productId = filter_var($body->product_id, FILTER_SANITIZE_STRING);
    $name = filter_var($body->name, FILTER_SANITIZE_STRING);
    $brand = filter_var($body->brand, FILTER_SANITIZE_STRING);
    $description = filter_var($body->description, FILTER_SANITIZE_STRING);
    $imagePath = filter_var($body->image_path, FILTER_SANITIZE_STRING);
    $price = filter_var($body->price, FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION);
    $category_id = filter_var($body->category_id, FILTER_SANITIZE_NUMBER_INT);
    $color = filter_var($body->color, FILTER_SANITIZE_STRING);
    $stock = filter_var($body->stock, FILTER_SANITIZE_NUMBER_INT);
    $speed = filter_var($body->speed, FILTER_SANITIZE_NUMBER_INT);
    $glide = filter_var($body->glide, FILTER_SANITIZE_NUMBER_INT);
    $turn = filter_var($body->turn, FILTER_SANITIZE_NUMBER_INT);
    $fade = filter_var($body->fade, FILTER_SANITIZE_NUMBER_INT);

    $sql = "UPDATE product SET name=?, brand=?, description=?, image_path=?, price=?, category_id=?, color=?, stock=?,speed=?, glide=?, turn=?, fade=? WHERE product_id=?";
    $params = [$name, $brand, $description, $imagePath, $price, $category_id, $color, $stock, $speed, $glide, $turn, $fade, $productId];

    responseString($db, $sql, "Tuote päivitetty", "Virhe. Tuotetta ei päivitetty", $params);
} catch (Exception $e) {
    responseError($e);
}