<?php

require "../include/headers.php";
require "../include/functions.php";

/**
 * Update order details. Takes data from JSON body.
 * Example: /order/updateorderdetails.php
 */

try {
    $db = getConnection();
    $body = json_decode(file_get_contents('php://input'));

    if (!$body) {
        throw new Exception("Pyynnön runko ei voi olla tyhjä!");
    }

    $orderId = filter_var($body->order_id, FILTER_SANITIZE_NUMBER_INT);
    $orderRow = filter_var($body->order_row, FILTER_SANITIZE_NUMBER_INT);
    $productId = filter_var($body->product_id, FILTER_SANITIZE_NUMBER_INT);
    $quantity = filter_var($body->quantity, FILTER_SANITIZE_NUMBER_INT);

    $sql = "UPDATE `order_row` SET product_id=?, quantity=? WHERE order_id=? AND order_row=?";
    $params = [$productId, $quantity, $orderId, $orderRow];

    responseString($db, $sql, "Tilaus päivitetty", "Virhe. Tilausta ei päivitetty", $params);
} catch (Exception $e) {
    responseError($e);
}