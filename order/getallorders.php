<?php
session_start();

require "../include/headers.php";
require "../include/functions.php";

/**
 * Get all orders for admin panel
 * Example: /order/getallorders.php
 */


if (!isset($_SESSION['id']) || checkPermissions($_SESSION['id']) == "false") {
    header("HTTP/1.1 403 Forbidden");
    echo json_encode(["error" => "No permissions."]);
    exit;
}

try {
    $db = getConnection();
    $sql = "SELECT order_id, user_id, state, payment_method, order_date FROM `order`";

    responseAsJson($db, $sql, PDO::FETCH_ASSOC);
} catch (Exception $e) {
    responseError($e);
}