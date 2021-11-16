<?php

require "../include/headers.php";
require "../include/functions.php";

/**
 * Search product with query
 * Example: /product/searchproduct.php?query=test
 */
try {
    $db = getConnection();
    $query = filter_var($_GET['query'], FILTER_SANITIZE_STRING);
    $sql = "SELECT *, MATCH(name, brand, description, color) AGAINST (? WITH QUERY EXPANSION) AS relevance FROM product ORDER BY relevance DESC";

    responseAsJson($db, $sql, PDO::FETCH_ASSOC, [$query]);
} catch (Exception $e) {
    responseError($e);
}
