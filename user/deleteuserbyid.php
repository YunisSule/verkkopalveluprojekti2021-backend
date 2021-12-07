<?php

require "../include/headers.php";
require "../include/functions.php";

/**
 * Delete user by ID
 * Example: /product/deleteuserbyid.php?id=1
 */
try {
    $db = getConnection();
    $id = filter_var($_GET['id'], FILTER_SANITIZE_NUMBER_INT);

    if (!is_numeric($id)) {
        throw new Exception("ID:n täytyy olla numero!");
    }

    responseAsJson($db, "DELETE FROM user WHERE user_id=? RETURNING user_id", PDO::FETCH_ASSOC, [$id]);
} catch (Exception $e) {
    responseError($e);
}
