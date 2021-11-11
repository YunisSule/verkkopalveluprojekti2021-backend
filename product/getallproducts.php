<?php

require "../include/headers.php";
require "../include/functions.php";

try {
    $db = getConnection();
    responseAsJson($db, "SELECT * FROM product");
} catch (Exception $e) {
    responseError($e);
}
