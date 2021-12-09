<?php

require "../include/headers.php";
require "../include/functions.php";

/**
 * Update order. Takes data from JSON body.
 * Example: /order/updateorder.php
 */

try {
    $db = getConnection();
    $body = json_decode(file_get_contents('php://input'));

    if (!$body) {
        throw new Exception("Pyynnön runko ei voi olla tyhjä!");
    }

    $orderId = filter_var($body->order_id, FILTER_SANITIZE_NUMBER_INT);
    $userId = filter_var($body->user_id, FILTER_SANITIZE_NUMBER_INT);
    $paymentMethod = filter_var($body->payment_method, FILTER_SANITIZE_STRING);
    $state = filter_var($body->state, FILTER_SANITIZE_STRING);
    $orderDate = filter_var($body->order_date, FILTER_SANITIZE_STRING);

    $sql = "UPDATE `order` SET user_id=?, payment_method=?, state=?, order_date=? WHERE order_id=?";
    $params = [$userId, $paymentMethod, $state, $orderDate, $orderId];

    responseString($db, $sql, "Tilaus päivitetty", "Virhe. Tilausta ei päivitetty", $params);
} catch (Exception $e) {
    responseError($e);
}