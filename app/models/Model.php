<?php

namespace App\Models;

/**
 * NOTE! this base model handles initializing PDO
 * 
 * To use PDO in a derived class, use self::$pdo
 */

class Model
{

    protected static $pdo;

    function __construct()
    {
        if (!self::$pdo) {

            $host = $_ENV["DB_HOST"];
            $db = $_ENV["DB_NAME"];
            $user = $_ENV["DB_USER"];
            $pass = $_ENV["DB_PASSWORD"];
            $charset = $_ENV["DB_CHARSET"];

            $dsn = "mysql:host=$host;dbname=$db;charset=$charset";
            $options = [
                \PDO::ATTR_ERRMODE            => \PDO::ERRMODE_EXCEPTION,
                \PDO::ATTR_DEFAULT_FETCH_MODE => \PDO::FETCH_ASSOC,
            ];

            self::$pdo = new \PDO($dsn, $user, $pass, $options);
        }
    }
}
