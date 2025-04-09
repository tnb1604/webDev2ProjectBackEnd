<?php

namespace App\Models;

/**
 * NOTE! This base model handles initializing PDO
 * 
 * To use PDO in a derived class, use self::$pdo
 */

class Model
{
    protected static $pdo;

    function __construct()
    {
        if (!self::$pdo) {
            $url = parse_url($_ENV["MYSQL_URL"]);
            $host = $url["host"] ?? null;
            $db = ltrim($url["path"], '/') ?? null;
            $user = $url["user"] ?? null;
            $pass = $url["pass"] ?? null;
            $charset = $_ENV["DB_CHARSET"] ?? 'utf8mb4'; // Default charset

            // Check if any required variable is missing
            if (!$host || !$db || !$user || !$pass) {
                throw new \Exception("Database connection details are missing in the environment variables.");
            }

            // DSN for PDO connection
            $dsn = "mysql:host=$host;dbname=$db;charset=$charset";

            // Set PDO options
            $options = [
                \PDO::ATTR_ERRMODE => \PDO::ERRMODE_EXCEPTION,
                \PDO::ATTR_DEFAULT_FETCH_MODE => \PDO::FETCH_ASSOC,
            ];

            try {
                // Create PDO instance
                self::$pdo = new \PDO($dsn, $user, $pass, $options);
            } catch (\PDOException $e) {
                // Handle connection failure
                error_log("Database connection failed: " . $e->getMessage());
                throw new \Exception("Failed to connect to the database: " . $e->getMessage());
            }
        }
    }

    /**
     * Getter method to access the PDO instance
     *
     * @return \PDO
     */
    public static function getPdo()
    {
        return self::$pdo;
    }
}
