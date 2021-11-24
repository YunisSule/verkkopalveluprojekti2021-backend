<?php

require "../include/headers.php";
require "../include/functions.php";

/**
 * Login with existing user
 */
try {
    session_start();

    $db = getConnection();
    $body = json_decode(file_get_contents('php://input'));

    $username = filter_var($body->username, FILTER_SANITIZE_STRING);
    $password = filter_var($body->password, FILTER_SANITIZE_STRING);

    $hashedPassword = getQueryResult($db, "SELECT password FROM user WHERE username = ?", PDO::FETCH_COLUMN, [$username]);
    if ($username && password_verify($password, $hashedPassword[0])) {
        $_SESSION['username'] = $username;
        $response = ["success" => true];
    } else {
        $response = ["success" => false];
    }

    echo json_encode($response);
} catch (Exception $e) {
    responseError($e);
}
