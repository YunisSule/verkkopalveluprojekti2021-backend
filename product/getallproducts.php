<?php

require "../include/headers.php";
require "../include/functions.php";
// require "../auth/login.php";

/**
 * Get all products
 * Example: /product/getallproducts.php
 */

// if (checkPermissions($_SESSION["user_id"]) == "false") {
//     header("HTTP/1.1 403 Forbidden");
//     echo '{"error": "No permissions."}';
//     exit;
// }

try {
    $db = getConnection();
    responseAsJson($db, "SELECT * FROM product", PDO::FETCH_ASSOC);
} catch (Exception $e) {
    responseError($e);
}