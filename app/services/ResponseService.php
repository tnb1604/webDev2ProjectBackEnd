<?php

namespace App\Services;

class ResponseService
{
    // send a JSON response with appropriate header and status
    static function Send($data, $status = 200)
    {
        http_response_code($status);
        header('Content-Type: application/json; charset=utf-8');
        echo json_encode($data);
        exit();
    }

    // send JSON error response with status
    static function Error($error = "An error occurred", $status = 500)
    {
        self::Send(["error" => $error], $status);
    }

    // Get the maximum upload file size from PHP configuration
    static function GetMaxUploadSize()
    {
        // Get the max upload size from the PHP config
        $maxUploadSize = ini_get('upload_max_filesize'); // in PHP format (e.g., "2M")

        // Convert it to an integer value (in MB)
        $maxUploadSizeInMB = self::convertToMB($maxUploadSize);

        // Return the size in MB
        self::Send(['maxSize' => $maxUploadSizeInMB]);
    }

    // Helper function to convert PHP ini string (e.g., "2M", "5G") to MB
    static function convertToMB($value)
    {
        // Extract the numeric part and the unit
        $unit = strtoupper(substr($value, -1));
        $value = (int) $value;

        // Convert based on the unit
        switch ($unit) {
            case 'G':
                $value *= 1024;  // Convert GB to MB
                break;
            case 'M':
                // Already in MB
                break;
            case 'K':
                $value /= 1024;  // Convert KB to MB
                break;
            default:
                // Assume it's in bytes and convert to MB
                $value /= 1048576;  // 1 MB = 1048576 bytes
                break;
        }
        return $value;
    }

    static function SetCorsHeaders()
    {
        header("Access-Control-Allow-Origin: *");
        header("Access-Control-Allow-Headers: *");
        header("Access-Control-Allow-Methods: GET, POST, PUT, DELETE, OPTIONS");

        // Handle preflight OPTIONS request
        if ($_SERVER['REQUEST_METHOD'] === 'OPTIONS') {
            http_response_code(200);
            exit();
        }
    }
}
