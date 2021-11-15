<?php

require "../include/headers.php";
require "../include/functions.php";

/**
 * Delete product by ID
 * Example: /product/deleteproductbyid.php?id=1
 */
try {
    $db = getConnection();
    $id = htmlspecialchars($_GET['id']);

    if (!is_numeric($id)) {
        throw new Exception("Id must be a number");
    }

    responseAsJson($db, "DELETE FROM product WHERE product_id=? RETURNING product_id", PDO::FETCH_ASSOC, [$id]);
} catch (Exception $e) {
    responseError($e);
}
