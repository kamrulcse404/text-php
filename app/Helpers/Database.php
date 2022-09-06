<?php

namespace app\Helpers;

// var_dump('Kamrul');

use PDO;

class Database
{
    protected static $instance;
    // protected static $config;

    protected function __construct()
    {
        //
    }

    public static function getInstance()
    {
        if (empty(self::$instance)) {

            try {
                $host = 'localhost';
                $user = 'root';
                $password = '';
                $dbName = 'todo1_db';

                $dsn = "mysql:host={$host};dbname={$dbName};charset=utf8mb4";
                self::$instance = new PDO($dsn, $user, $password);
                self::$instance->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            } catch (\Throwable $th) {
                die("Can not connect to DB");
            }
            return self::$instance;
        }
        return self::$instance;
    }
}
