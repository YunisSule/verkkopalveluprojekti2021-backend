<?php

require "../include/headers.php";
require "../include/functions.php";

/**
 * Get all orders of a user
 * Example: /order/getordersbyuserid.php?user_id=1
 */

try {
    $db = getConnection();
    $userId = filter_var($_GET['user_id'], FILTER_SANITIZE_NUMBER_INT);

    if (!is_numeric($userId)) {
        throw new Exception("ID:n täytyy olla numero!");
    }

    $sql = "SELECT order_id, state, payment_method, order_date FROM `order` WHERE user_id=?";

    responseAsJson($db, $sql, PDO::FETCH_ASSOC, [$userId]);
} catch (Exception $e) {
    responseError($e);
}