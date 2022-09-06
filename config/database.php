<?php

try {
    $host = 'localhost';
    $user = 'root';
    $password = '';
    $dbName = 'todo1_db';

    $dsn = "mysql:host={$host};dbname={$dbName};charset=utf8mb4";
    $pdo = new PDO($dsn, $user, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (\Throwable $th) {
    die("Can not connect to DB");
}
