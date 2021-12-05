<?php

require "../include/headers.php";
require "../include/functions.php";

/**
 * Post order Takes data from JSON body.
 * Example: /order/postorder.php?user_id=1 
 */

// WORKS ONLY WITH ONE ITEM IN CART ATM...

try {
    $db = getConnection();
    

    $input = json_decode(file_get_contents('php://input'));
    $order_id = random_int(1,99999);
    $user_id = filter_var($_GET['user_id'],FILTER_SANITIZE_NUMBER_INT);
    $state = 'ordered';
    $product_id = filter_var($input->product_id, FILTER_SANITIZE_NUMBER_INT);
    $price = filter_var($input->price, FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION);
    $amount = filter_var($input->amount, FILTER_SANITIZE_NUMBER_INT);
    
   
   
    
    // Adds order to order table

    $sql = 'INSERT INTO `order` VALUES (?, ?, ?, CURRENT_TIMESTAMP())';
    $params = [$order_id, $user_id, $state];

    
    // Adds ordered products id and amount to order_row table
    
    $sql1 = 'INSERT INTO `order_row` VALUES (null, ?, ?, ?)';
    $params1 = [$order_id, $product_id, $amount];
    

    responseString($db, $sql, "Tilaus lisätty", "Virhe. Tilausta ei lisätty", $params);
    responseString($db, $sql1, "Tilaus lisätty", "Virhe. Tilausta ei lisätty", $params1);
} catch (Exception $e) {
    responseError($e);
}