<?php

require "../include/headers.php";
require "../include/functions.php";

/**
 * Get all orders
 * Example: /order/getallorders.php
 */

try {
    $db = getConnection();

    $sql = "SELECT o.order_id, orow.order_row, orow.product_id, o.user_id, o.state, o.payment_method, orow.quantity, (orow.quantity * p.price) AS price, o.order_date
            FROM `order` o
            INNER JOIN order_row orow ON o.order_id = orow.order_id
            INNER JOIN product p ON p.product_id = orow.product_id
            ORDER BY o.order_id, orow.order_row";

    responseAsJson($db, $sql, PDO::FETCH_ASSOC);
} catch (Exception $e) {
    responseError($e);
}