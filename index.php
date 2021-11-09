<?php

require('headers.php');
require('functions.php');
require('Database.php');

try {
    $db = Database::getInstance();
    createTables($db->getConnection());
} catch (Exception $e) {
    echo $e->getMessage();
}
