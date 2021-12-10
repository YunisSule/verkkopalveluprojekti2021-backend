<?php
session_start();
require "../include/headers.php";
require "../include/functions.php";

/**
 * Update user info: firstname, lastname, email, address, city and postal code by ID. Takes data from JSON body.
 * Example: /user/updateuserinfo.php?id=1
 */

if (isLoggedIn() == "false") {
    header("HTTP/1.1 403 Forbidden");
    echo json_encode(["error" => "Not logged in."]);
    exit;
}

$input = json_decode(file_get_contents('php://input'));
$id = filter_var($_GET['id'],FILTER_SANITIZE_NUMBER_INT);
$firstname = filter_var($input->firstname,FILTER_SANITIZE_STRING);
$lastname = filter_var($input->lastname,FILTER_SANITIZE_STRING);
$email = filter_var($input->email,FILTER_SANITIZE_EMAIL);
$address = filter_var($input->address,FILTER_SANITIZE_STRING);
$city = filter_var($input->city,FILTER_SANITIZE_STRING);
$postal_code = filter_var($input->postal_code,FILTER_SANITIZE_STRING);

try {
    $db = getConnection();

    $query = $db->prepare('UPDATE user SET firstname=:firstname, lastname=:lastname, email=:email, address=:address, city=:city, postal_code=:postal_code where user_id=:id');
    $query->bindValue(':id',$id,PDO::PARAM_INT);
    $query->bindValue(':firstname',$firstname,PDO::PARAM_STR);
    $query->bindValue(':lastname',$lastname,PDO::PARAM_STR);
    $query->bindValue(':email',$email,PDO::PARAM_STR);
    $query->bindValue(':address',$address,PDO::PARAM_STR);
    $query->bindValue(':city',$city,PDO::PARAM_STR);
    $query->bindValue(':postal_code',$postal_code,PDO::PARAM_STR);
    $query->execute();

    header('HTTP/1.1. 200 OK');
    
} catch (Exception $e) {
    responseError($e);
}