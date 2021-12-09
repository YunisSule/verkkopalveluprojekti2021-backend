<?php

require "../include/headers.php";
require "../include/functions.php";

/**
 * Get all orders for admin panel
 * Example: /order/getallorders.php
 */

try {
    $db = getConnection();
    $sql = "SELECT order_id, user_id, state, payment_method, order_date FROM `order`";

    responseAsJson($db, $sql, PDO::FETCH_ASSOC);
} catch (Exception $e) {
    responseError($e);
}