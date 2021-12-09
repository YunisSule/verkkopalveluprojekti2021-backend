<?php

require "../include/headers.php";
require "../include/functions.php";

/**
 * Delete order row with ID
 * Example: /order/deleteorderrowybyid.php?id=1
 */

try {
    $db = getConnection();
    $orderId = filter_var($_GET['id'], FILTER_SANITIZE_NUMBER_INT);
    $orderRow = filter_var($_GET['row'], FILTER_SANITIZE_NUMBER_INT);

    if (!is_numeric($orderId) || !is_numeric($orderRow)) {
        throw new Exception("ID:n täytyy olla numero!");
    }

    $sql = "DELETE FROM `order_row` WHERE order_id=? AND order_row=?";
    responseString($db, $sql, "Tilaus poistettu", "Virhe. Tilausta ei poistettu", [$orderId, $orderRow]);
} catch (Exception $e) {
    responseError($e);
}