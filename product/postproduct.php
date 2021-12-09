<?php
session_start();

require "../include/headers.php";
require "../include/functions.php";

/**
 * Post product. Takes data from JSON body.
 * Example: /product/postproduct.php
 */

if (!isset($_SESSION['id']) || checkPermissions($_SESSION['id']) == "false") {
    header("HTTP/1.1 403 Forbidden");
    echo json_encode(["error" => "No permissions."]);
    exit;
}

try {
    $db = getConnection();
    $body = json_decode(file_get_contents('php://input'));

    if (!$body) {
        throw new Exception("Pyynnön runko ei voi olla tyhjä!");
    }

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

    $sql = "INSERT INTO product VALUES (null, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
    $params = [$name, $brand, $description, $imagePath, $price, $category_id, $color, $stock, $speed, $glide, $turn, $fade];

    responseString($db, $sql, "Tuote lisätty", "Virhe. Tuotetta ei lisätty", $params);
} catch (Exception $e) {
    responseError($e);
}