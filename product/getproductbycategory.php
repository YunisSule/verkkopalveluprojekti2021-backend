<?php

require "../include/headers.php";
require "../include/functions.php";

/**
 * Get product by ID
 * Example: /product/getproductbycategory.php?id=1
 */
try {
    $db = getConnection();
    $id = htmlspecialchars($_GET['id']);

    if (!is_numeric($id)) {
        throw new Exception("Id must be a number");
    }

    responseAsJson($db, "SELECT * FROM product WHERE category_id=?", PDO::FETCH_ASSOC, [$id]);
} catch (Exception $e) {
    responseError($e);
}
