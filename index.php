<?php

require "include/headers.php";
require "include/functions.php";

try {
    $db = getConnection();
    createTables($db);
} catch (Exception $e) {
    echo $e->getMessage();
}