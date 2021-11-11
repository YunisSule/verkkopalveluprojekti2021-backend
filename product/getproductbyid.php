<?php

require "../include/headers.php";
require "../include/functions.php";

/**
 * Get product by ID
 * Example: /product/getproductbyid.php?id=1
 */
try {
    $id = htmlspecialchars($_GET['id']);
    $db = getConnection();
    responseAsJson($db, "SELECT * FROM product WHERE product_id=?", [$id]);
} catch (Exception $e) {
    responseError($e);
}
