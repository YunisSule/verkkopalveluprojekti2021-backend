<?php

require "../include/headers.php";
require "../include/functions.php";

try {
    // Example: /getproductbyid.php?id=1
    $id = htmlspecialchars($_GET['id']);

    $db = getConnection();
    responseAsJson($db, "SELECT * FROM product WHERE product_id=?", [$id]);
} catch (Exception $e) {
    responseError($e);
}
