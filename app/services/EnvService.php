<?php

namespace App\Services;

class EnvService
{
    // Initialize env variables
    static function Init()
    {
        // Database environment variables from .env file
        $_ENV["DB_HOST"] = getenv("DB_HOST");
        $_ENV["DB_NAME"] = getenv("DB_NAME");
        $_ENV["DB_USER"] = getenv("DB_USER");
        $_ENV["DB_PASSWORD"] = getenv("DB_PASSWORD");
        $_ENV["DB_CHARSET"] = getenv("DB_CHARSET");

        $_ENV["ENV"] = getenv("ENV");
        $_ENV["JWT_SECRET"] = getenv("JWT_SECRET");
        $_ENV["MYSQL_URL"] = getenv("MYSQL_URL");
    }
}
