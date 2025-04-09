<?php

namespace App\Services;

class EnvService
{
    // Initialize env variables
    static function Init()
    {
        $_ENV["MYSQL_HOST"] = "mysql.railway.internal";
        $_ENV["MYSQL_DATABASE"] = "railway";
        $_ENV["MYSQL_USER"] = "root";
        $_ENV["MYSQL_PASSWORD"] = "QthwvNaULUiZXuyReCjjpxjfNRrpxrlS";
        $_ENV["MYSQL_CHARSET"] = "utf8mb4";

        $_ENV["ENV"] = "production";
        $_ENV["JWT_SECRET"] = "nLJ9gbjAMhkIViQ1AHB+yJIajSFmQ0vnJ3x3Vjvnprs=";
        $_ENV["MYSQL_URL"] = "mysql://root:QthwvNaULUiZXuyReCjjpxjfNRrpxrlS@mysql.railway.internal:3306/railway";
    }
}
