<?php

require "../include/headers.php";
require "../include/functions.php";

/**
 * Login with existing user
 */
try {
    session_start();

    $db = getConnection();

    if (isset($_SERVER['PHP_AUTH_USER'])) {
        $email = filter_var($_SERVER['PHP_AUTH_USER'], FILTER_SANITIZE_EMAIL);
        $password = filter_var($_SERVER["PHP_AUTH_PW"], FILTER_SANITIZE_STRING);
        $userdetails = getQueryResult($db, "SELECT username, password FROM user WHERE email = ?", PDO::FETCH_ASSOC, [$email]);

        foreach ($userdetails as $row) {
            $hashedPassword = $row["password"];
            $username = $row['username'];
        }

        if ($email && password_verify($password, $hashedPassword)) {
            $_SESSION['username'] = $email;
            $response = ["success" => true];
        } else {
            $response = ["success" => false];
            header('HTTP/1.1 401');
            exit;
        }
    }

    echo json_encode($response);
} catch (Exception $e) {
    responseError($e);
}
