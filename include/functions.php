<?php

/**
 * Echoes query response as JSON
 * @param PDO $connection Database connection
 * @param string $query SQL query
 * @param int $fetchMethod PDO fetch method
 * @param array $parameters possible query parameters
 */
function responseAsJson(PDO $connection, string $query, int $fetchMethod, array $parameters = [])
{
    $prepared = $connection->prepare($query);
    $prepared->execute($parameters);
    header('Content-Type: application/json; charset=utf-8');
    echo json_encode($prepared->fetchAll($fetchMethod));
}


/**
 * Echoes success or error string depending on query success
 * @param PDO $connection Database connection
 * @param string $query SQL query
 * @param string $success Response string
 * @param string $error Error string
 * @param array $parameters possible query parameters
 */
function responseString(PDO $connection, string $query, string $success, string $error, array $parameters = [])
{
    $prepared = $connection->prepare($query);
    header('Content-Type: application/json; charset=utf-8');

    if ($prepared->execute($parameters)) {
        $response = ["message" => $success];
    } else {
        $response = ["message" => $error];
    }

    echo json_encode($response);
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
 * @param PDO $connection Database connection
 * @param string $query SQL query
 * @param int $fetchMethod PDO fetch method
 * @param array $parameters possible query parameters
 * @return bool|array
 */
function getQueryResult(PDO $connection, string $query, int $fetchMethod, array $parameters = []): bool|array
{
    $prepared = $connection->prepare($query);
    $prepared->execute($parameters);
    return $prepared->fetchAll($fetchMethod);
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