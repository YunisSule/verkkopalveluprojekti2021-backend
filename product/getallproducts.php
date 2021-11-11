<?php

require "../include/headers.php";
require "../include/functions.php";

/**
 * Get all products
 * Example: /product/getallproducts.php
 */
try {
    $db = getConnection();
    responseAsJson($db, "SELECT * FROM product", PDO::FETCH_ASSOC);
} catch (Exception $e) {
    responseError($e);
}