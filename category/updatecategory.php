<?php
session_start();

require "../include/headers.php";
require "../include/functions.php";


/**
 * Update category. Takes data from JSON body.
 * Example: /category/updatecategory.php
 */

if (!isset($_SESSION['id']) || checkPermissions($_SESSION['id']) == "false") {
    header("HTTP/1.1 403 Forbidden");
    echo json_encode(["error" => "No permissions."]);
    exit;
}

try {
    $db = getConnection();
    $body = json_decode(file_get_contents('php://input'));

    if (!$body) {
        throw new Exception("Pyynnön runko ei voi olla tyhjä!");
    }

    $categoryId = filter_var($body->category_id, FILTER_SANITIZE_NUMBER_INT);
    $name = filter_var($body->name, FILTER_SANITIZE_STRING);

    $sql = "UPDATE category SET name=? WHERE category_id=?";

    responseString($db, $sql, "Tuote päivitetty", "Virhe. Tuotetta ei päivitetty", [$name, $categoryId]);
} catch (Exception $e) {
    responseError($e);
}
