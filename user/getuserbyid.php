<?php

require "../include/headers.php";
require "../include/functions.php";

/**
 * Get userdata by id
 * Example: /user/getuserbyid.php?id=1
 */
try {
    $db = getConnection();
    $id = filter_var($_GET['id'], FILTER_SANITIZE_NUMBER_INT);


    responseAsJson($db, "SELECT user_id, is_admin, username, firstname, lastname, email, address, city, postal_code FROM user WHERE user_id=?", PDO::FETCH_ASSOC, [$id]);
} catch (Exception $e) {
    responseError($e);
}