<?php

namespace App\Services;

class EnvService
{
    // Initialize env variables
    static function Init()
    {
        // Database environment variables from Railway configuration
        $_ENV["MYSQL_HOST"] = "mysql.railway.internal"; // Corrected: MySQL internal hostname
        $_ENV["MYSQL_DATABASE"] = "railway"; // Corrected: Database name
        $_ENV["MYSQL_USER"] = "root"; // Corrected: Username for MySQL
        $_ENV["MYSQL_PASSWORD"] = "QthwvNaULUiZXuyReCjjpxjfNRrpxrlS"; // Corrected: MySQL password
        $_ENV["MYSQL_CHARSET"] = "utf8mb4"; // You can keep this if necessary

        $_ENV["ENV"] = "production";
        $_ENV["JWT_SECRET"] = "nLJ9gbjAMhkIViQ1AHB+yJIajSFmQ0vnJ3x3Vjvnprs="; // Your JWT secret key
        $_ENV["MYSQL_URL"] = "mysql://root:QthwvNaULUiZXuyReCjjpxjfNRrpxrlS@mysql.railway.internal:3306/railway"; // Corrected: Connection URL for MySQL
    }
}
