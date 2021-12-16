<?php
require "../include/headers.php";

session_start();
try {
    session_unset();
    session_destroy();

    echo json_encode(["success" => "true"]);
} catch (Exception $e) {
    responseError($e);
}
