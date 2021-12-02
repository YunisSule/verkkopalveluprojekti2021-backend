<?php

require "../include/headers.php";
require "../include/functions.php";

/**
 * Register a new user
 */
try {
    $db = getConnection();
    $body = json_decode(file_get_contents('php://input'));

    if (!$body) {
        throw new Exception("Pyynnön runko ei voi olla tyhjä!");
    }

    $username = filter_var($body->username, FILTER_SANITIZE_STRING);
    $password = password_hash(filter_var($body->password, FILTER_SANITIZE_STRING), PASSWORD_DEFAULT);
    $firstName = filter_var($body->firstname, FILTER_SANITIZE_STRING);
    $lastName = filter_var($body->lastname, FILTER_SANITIZE_STRING);
    $email = filter_var($body->email, FILTER_SANITIZE_STRING);
    $address = filter_var($body->address, FILTER_SANITIZE_STRING);
    $city = filter_var($body->city, FILTER_SANITIZE_STRING);
    $postalCode = filter_var($body->postal_code, FILTER_SANITIZE_STRING);

    $params = [null, false, $username, $password, $firstName, $lastName, $email, $address, $city, $postalCode];
    $sql = "INSERT INTO user VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";

    responseString($db, $sql, "Käyttäjä rekisteröity", "Virhe. Käyttäjää ei rekisteröity", $params);
} catch (Exception $e) {
    responseError($e);
}
