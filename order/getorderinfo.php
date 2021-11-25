<?php

require "../include/headers.php";
require "../include/functions.php";

/**
 * Get orderinfo by user ID
 * Example: /order/getorderinfo.php?id=1
 */

try {
    $db = getConnection();
    $id = filter_var($_GET['id'], FILTER_SANITIZE_NUMBER_INT);

   

    responseAsJson($db, "SELECT  order_row.product_id, state, order_date, quantity, name, (quantity * price) AS price FROM `order`, order_row, product WHERE user_id=? AND `order`.order_id = order_row.order_id AND order_row.product_id = product.product_id", PDO::FETCH_ASSOC, [$id] );
} catch (Exception $e) {
    responseError($e);
}