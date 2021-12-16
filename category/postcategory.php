<?php
session_start();

require "../include/headers.php";
require "../include/functions.php";

/**
 * Post category. Takes data from JSON body.
 * Example: /category/postcategory.php
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

    $name = filter_var($body->name, FILTER_SANITIZE_STRING);

    $sql = "INSERT INTO category VALUES (null, ?)";
    responseString($db, $sql, "Kategoria lisätty", "Virhe. Kategoriaa ei lisätty", [$name]);
} catch (Exception $e) {
    responseError($e);
}
