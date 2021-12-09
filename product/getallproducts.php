<?php
session_start();
require "../include/headers.php";
require "../include/functions.php";
// require_once "../auth/login.php";

/**
 * Get all products
 * Example: /product/getallproducts.php
 */


 
if (!isset($_SESSION['id']) || checkPermissions($_SESSION['id']) == "false") {
    header("HTTP/1.1 403 Forbidden");
    echo json_encode(["error" => "No permissions."]);
    exit;
}

try {
    $db = getConnection();
    responseAsJson($db, "SELECT * FROM product", PDO::FETCH_ASSOC);
} catch (Exception $e) {
    responseError($e);
}