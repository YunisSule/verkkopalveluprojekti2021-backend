<?php

require('headers.php');
require('functions.php');

try {
    $conn = new PDO('mysql:host=localhost;dbname=verkkopalveluprojekti', 'root', '');
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    createTables($conn);
} catch (Exception $e) {
    echo $e->getMessage();
}
