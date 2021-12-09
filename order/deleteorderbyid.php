<?php
session_start();

require "../include/headers.php";
require "../include/functions.php";

/**
 * Delete order with ID
 * Example: /order/deleteorderybyid.php?id=1
 */

if (!isset($_SESSION['id']) || checkPermissions($_SESSION['id']) == "false") {
    header("HTTP/1.1 403 Forbidden");
    echo json_encode(["error" => "No permissions."]);
    exit;
}

try {
    $db = getConnection();
    $id = filter_var($_GET['id'], FILTER_SANITIZE_NUMBER_INT);

    if (!is_numeric($id)) {
        throw new Exception("ID:n täytyy olla numero!");
    }

    responseString($db, "DELETE FROM `order` WHERE order_id=?", "Tilaus poistettu", "Virhe. Tilausta ei poistettu", [$id]);
} catch (Exception $e) {
    responseError($e);
}