<?php

require_once "../include/headers.php";
require_once "../include/functions.php";

/**
 * Login with existing user
 */

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

try {
    
    $_SESSION["token"] = bin2hex(openssl_random_pseudo_bytes(16));

    $pdo = getConnection();
    //$body = json_decode(file_get_contents('php://input'));

    if( !isset($_SERVER['PHP_AUTH_USER']) || !isset($_SERVER['PHP_AUTH_PW'])){
        header("HTTP/1.1 401 Unauthorized");
        echo '{"error": "Authentication failed."}';
        exit;
    } else {
        $email = filter_var($_SERVER['PHP_AUTH_USER'], FILTER_SANITIZE_EMAIL);
        $password = filter_var($_SERVER["PHP_AUTH_PW"], FILTER_SANITIZE_STRING);
    }

    $fetchuser = getQueryResult($pdo, "SELECT * FROM user WHERE email = ?", PDO::FETCH_ASSOC, [$email]);

    foreach($fetchuser as $row) {
        $hashedPassword = $row['password'];
        $username = $row['username'];
    }

    if ($email && password_verify($password, $hashedPassword)) {
        $user_id = $row['user_id'];
    } else {
        header('HTTP/1.1 401 Unauthorized');
        echo '{"error": "Invalid username or password."}';
        exit;
    }
    $_SESSION["user_id"] = $user_id;
    echo json_encode(["token" => $_SESSION["token"]]);
} catch (Exception $e) {
    responseError($e);
}



 // try {
//     session_start();

//     $pdo = getConnection();
//     $body = json_decode(file_get_contents('php://input'));

//     $username = filter_var($body->username, FILTER_SANITIZE_STRING);
//     $password = filter_var($body->password, FILTER_SANITIZE_STRING);

//     $hashedPassword = getQueryResult($pdo, "SELECT password FROM user WHERE username = ?", PDO::FETCH_COLUMN, [$username]);
//     if ($username && password_verify($password, $hashedPassword[0])) {
//         $_SESSION['username'] = $username;
//         $response = ["success" => true];
//     } else {
//         $response = ["success" => false];
//     }

//     echo json_encode($response);
// } catch (Exception $e) {
//     responseError($e);
// }
