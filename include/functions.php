<?php

function responseAsJson(PDO $connection, string $query, array $parameters = [])
{
    $prepared = $connection->prepare($query);
    $prepared->execute($parameters);
    header('Content-Type: application/json; charset=utf-8');
    echo json_encode($prepared->fetchAll(PDO::FETCH_ASSOC));
}

function responseError(Exception $exception)
{
    http_response_code(500);
    echo $exception;
}

function getConnection(): PDO
{
    $connection = new PDO("mysql:host=localhost;dbname=verkkopalveluprojekti", "root", "");
    $connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    return $connection;
}

function createTables(PDO $connection)
{
    $sql = file_get_contents('./tables.sql');
    $connection->exec($sql);
}