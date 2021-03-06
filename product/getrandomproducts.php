<?php

require "../include/headers.php";
require "../include/functions.php";

/**
 * Get random products
 * Example: /product/getrandomproducts.php?count=2
 */
try {
    $db = getConnection();
    $count = filter_var($_GET['count'], FILTER_SANITIZE_NUMBER_INT);

    if (!is_numeric($count)) {
        throw new Exception("Countin täytyy olla numero!");
    }

    $productIdArray = getQueryResult($db, "SELECT product_id FROM product", PDO::FETCH_COLUMN);

    if ($count > sizeof($productIdArray)) {
        $count = sizeof($productIdArray);
    }

    $min = $productIdArray[0];
    $max = $productIdArray[sizeof($productIdArray) - 1];
    $randomIdArray = array();

    // use rand to generate random product IDs between min and max
    while (sizeof($randomIdArray) != $count) {
        $num = rand($min, $max);
        if (in_array($num, $randomIdArray)) {
            continue;
        } else if (in_array($num, $productIdArray)) {
            $randomIdArray[] = $num;
        }
    }

    $result = array();

    // Get product rows with the random IDs
    foreach ($randomIdArray as $id) {
        $product = getQueryResult($db, "SELECT * FROM product WHERE product_id = ?", PDO::FETCH_ASSOC, [$id]);
        $result[] = $product[0];
    }

    header('Content-Type: application/json; charset=utf-8');
    echo json_encode($result);
} catch (Exception $e) {
    responseError($e);
}
