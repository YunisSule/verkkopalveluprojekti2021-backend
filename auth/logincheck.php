<?php
require "../include/headers.php";
require "../include/functions.php";

if (isLoggedIn() == "false") {
    $json = ["loggedin" => "false"];
} else {
    $json = ["loggedin" => "true"];
}

if (checkPermissions($_SESSION['id']) == "false") {
    $json += ["isadmin" => "false"];
} else {
    $json += ["isadmin" => "true"];
}

echo json_encode($json);