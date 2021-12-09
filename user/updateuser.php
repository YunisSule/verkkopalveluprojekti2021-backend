<?php
session_start();

require "../include/headers.php";
require "../include/functions.php";

/**
 * Update user info with user ID Takes data from JSON body.
 * Example: /user/updateuser.php
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

    $userId = filter_var($body->user_id, FILTER_SANITIZE_STRING);
    $isAdmin = filter_var($body->is_admin, FILTER_SANITIZE_STRING);
    $username = filter_var($body->username, FILTER_SANITIZE_STRING);
    $firstName = filter_var($body->firstname, FILTER_SANITIZE_STRING);
    $lastName = filter_var($body->lastname, FILTER_SANITIZE_STRING);
    $email = filter_var($body->email, FILTER_SANITIZE_EMAIL);
    $address = filter_var($body->address, FILTER_SANITIZE_STRING);
    $city = filter_var($body->city, FILTER_SANITIZE_STRING);
    $postal_code = filter_var($body->postal_code, FILTER_SANITIZE_STRING);

    $sql = "UPDATE user SET is_admin=?, username=?, firstname=?, lastname=?, email=?, address=?, city=?, postal_code=? WHERE user_id=?";
    $params = [$isAdmin, $username, $firstName, $lastName, $email, $address, $city, $postal_code, $userId];

    responseString($db, $sql, "Käyttäjä päivitetty", "Virhe. Käyttäjää ei päivitetty", $params);
} catch (Exception $e) {
    responseError($e);
}