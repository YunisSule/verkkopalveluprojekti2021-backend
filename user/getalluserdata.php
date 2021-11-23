<?php

require "../include/headers.php";
require "../include/functions.php";

/**
 * Get all userdata
 * Example: /user/getalluserdata.php
 */
try {
    $db = getConnection();
    responseAsJson($db, "SELECT * FROM user", PDO::FETCH_ASSOC);
} catch (Exception $e) {
    responseError($e);
}