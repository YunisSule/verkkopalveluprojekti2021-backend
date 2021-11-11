<?php

/**
 * Echoes query response as JSON
 * @param PDO $connection Database connection
 * @param string $query SQL query
 * @param array $parameters possible query parameters
 */
function responseAsJson(PDO $connection, string $query, array $parameters = [])
{
    $prepared = $connection->prepare($query);
    $prepared->execute($parameters);
    header('Content-Type: application/json; charset=utf-8');
    echo json_encode($prepared->fetchAll(PDO::FETCH_ASSOC));
}

/**
 * Echoes exception with HTTP code 500
 * @param Exception $exception
 */
function responseError(Exception $exception)
{
    http_response_code(500);
    echo $exception;
}

/**
 * @return PDO Database connection
 */
function getConnection(): PDO
{
    $connection = new PDO("mysql:host=localhost;dbname=verkkopalveluprojekti", "root", "");
    $connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    return $connection;
}

/**
 * Creates tables and fills them with data
 * @param PDO $connection Database connection
 */
function createTables(PDO $connection)
{
    $sql = file_get_contents('./tables.sql');
    $connection->exec($sql);
}