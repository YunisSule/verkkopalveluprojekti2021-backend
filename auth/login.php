<?php
session_start();

require_once "../include/headers.php";
require_once "../include/functions.php";

/**
 * Login with existing user
 */

// if (isset($_SESSION["email"]) && isset($_SESSION["pwd"])) {
//     $_SERVER['PHP_AUTH_USER'] = $_SESSION["email"];
//     $_SERVER["PHP_AUTH_PW"] = $_SESSION["pwd"];
// }


try {
    $pdo = getConnection();

    if (!isset($_SERVER['PHP_AUTH_USER']) || !isset($_SERVER['PHP_AUTH_PW'])) {
        header("HTTP/1.1 401 Unauthorized");
        echo '{"error": "Authentication failed."}';
        exit;
    } else {
        $email = filter_var($_SERVER['PHP_AUTH_USER'], FILTER_SANITIZE_EMAIL);
        $password = filter_var($_SERVER["PHP_AUTH_PW"], FILTER_SANITIZE_STRING);
    }
    
    $fetchuser = getQueryResult($pdo, "SELECT * FROM user WHERE email = ?", PDO::FETCH_ASSOC, [$email]);
    
    foreach ($fetchuser as $row) {
        $hashedPassword = $row['password'];
        $username = $row['username'];
    }
    
    if ($email && password_verify($password, $hashedPassword)) {
        $user_id = $row['user_id'];
    } else {
        header('HTTP/1.1 401 Unauthorized');
        echo json_encode(['error' => 'Invalid username or password']);
        exit;
    }
    echo json_encode(['user_id' => $user_id]);
    $_SESSION["token"] = bin2hex(openssl_random_pseudo_bytes(16));
    $_SESSION["email"] = $email;
    $_SESSION["pwd"] = $password;
    $_SESSION["id"] = $user_id;
} catch (Exception $e) {
    responseError($e);
}

