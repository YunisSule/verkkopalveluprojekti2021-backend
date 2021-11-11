<?php

require "../include/headers.php";
require "../include/functions.php";

/**
 * Get random products
 * Example: /product/getrandomproducts.php?count=2
 */
try {
    $db = getConnection();
    $count = htmlspecialchars($_GET['count']);

    if (!is_numeric($count)) {
        throw new Exception("Count must be a number");
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
        if (in_array($num, $randomIdArray)) continue;
        else array_push($randomIdArray, $num);
    }

    $result = array();

    // Get product rows with the random IDs
    foreach ($randomIdArray as $id) {
        $product = getQueryResult($db, "SELECT * FROM product WHERE product_id = ?", PDO::FETCH_ASSOC, [$id]);
        array_push($result, $product);
    }

    echo json_encode($result);
} catch (Exception $e) {
    responseError($e);
}