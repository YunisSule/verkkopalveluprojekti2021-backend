<?php

require "../include/headers.php";
require "../include/functions.php";

/**
 * Get orders by user ID
 * Example: /order/getorders.php?id=1
 */

try {
    $db = getConnection();
    $id = filter_var($_GET['id'], FILTER_SANITIZE_NUMBER_INT);

   

    responseAsJson($db, "SELECT * FROM `order` WHERE user_id=?" , PDO::FETCH_ASSOC, [$id] );
} catch (Exception $e) {
    responseError($e);
}