<?php
require "../include/headers.php";
require "../include/functions.php";

if (isLoggedIn() == "false") {
    echo json_encode(["loggedin" => "false"]);
} else {
    echo json_encode(["loggedin" => "true"]);
}