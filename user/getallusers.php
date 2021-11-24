<?php

require "../include/headers.php";
require "../include/functions.php";

/**
 * Get all userdata
 * Example: /user/getallusers.php
 */
try {
    $db = getConnection();
    responseAsJson($db, "SELECT user_id, is_admin, username, firstname, lastname, email, address, city, postal_code FROM user", PDO::FETCH_ASSOC);
} catch (Exception $e) {
    responseError($e);
}