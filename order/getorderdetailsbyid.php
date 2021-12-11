<?php
session_start();

require "../include/headers.php";
require "../include/functions.php";

/**
 * Get all orders of a user
 * Example: /order/getorderdetailsbyid.php?id=1
 */

if (isLoggedIn() == "false") {
    header("HTTP/1.1 403 Forbidden");
    echo json_encode(["error" => "Not logged in."]);
    exit;
}

try {
    $db = getConnection();
    $orderId = filter_var($_GET['id'], FILTER_SANITIZE_NUMBER_INT);

    if (!is_numeric($orderId)) {
        throw new Exception("ID:n täytyy olla numero!");
    }

    $sql = "SELECT orow.order_id, orow.order_row, p.product_id, p.name, orow.quantity, p.price, (orow.quantity * p.price) AS total, o.order_date
            FROM `order` o
            INNER JOIN order_row orow ON o.order_id = orow.order_id
            INNER JOIN product p ON p.product_id = orow.product_id
            INNER JOIN user u ON u.user_id=o.user_id
            WHERE o.order_id=?
            ORDER BY o.order_id, orow.order_row";

    responseAsJson($db, $sql, PDO::FETCH_ASSOC, [$orderId]);
} catch (Exception $e) {
    responseError($e);
}