<?php

require "../include/headers.php";
require "../include/functions.php";

/**
 * Get all orders of a user
 * Example: /order/getallorders.php?user_id=1
 */

try {
    $db = getConnection();
    $userId = filter_var($_GET['user_id'], FILTER_SANITIZE_NUMBER_INT);

    if (!is_numeric($userId)) {
        throw new Exception("ID:n täytyy olla numero!");
    }

    $sql = "SELECT o.order_id, orow.order_row, orow.product_id, o.user_id, o.state, o.payment_method, orow.quantity, (orow.quantity * p.price) AS price, o.order_date
            FROM `order` o
            INNER JOIN order_row orow ON o.order_id = orow.order_id
            INNER JOIN product p ON p.product_id = orow.product_id
            INNER JOIN user u ON u.user_id=o.user_id
            WHERE o.user_id=?
            ORDER BY o.order_id, orow.order_row";

    responseAsJson($db, $sql, PDO::FETCH_ASSOC, [$userId]);
} catch (Exception $e) {
    responseError($e);
}