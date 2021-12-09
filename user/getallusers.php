<?php
session_start();

require "../include/headers.php";
require "../include/functions.php";

/**
 * Get all userdata
 * Example: /user/getallusers.php
 */

if (!isset($_SESSION['id']) || checkPermissions($_SESSION['id']) == "false") {
    header("HTTP/1.1 403 Forbidden");
    echo json_encode(["error" => "No permissions."]);
    exit;
}

try {
    $db = getConnection();
    responseAsJson($db, "SELECT user_id, is_admin, username, firstname, lastname, email, address, city, postal_code FROM user", PDO::FETCH_ASSOC);
} catch (Exception $e) {
    responseError($e);
}