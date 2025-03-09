<?php

/**
 * Setup
 */

// require autoload file to autoload vendor libraries
require_once __DIR__ . '/../vendor/autoload.php';
require_once __DIR__ . '/../controllers/GameController.php';

// require local classes
use App\Services\EnvService;
use App\Services\ErrorReportingService;
use App\Services\ResponseService;

// require vendor libraries
use Steampixel\Route;

// initialize global environment variables
EnvService::Init();

// initialize error reporting (on in local env)
ErrorReportingService::Init();

// set CORS headers
ResponseService::SetCorsHeaders();

/**
 * Main application routes
 */
// top level fail-safe try/catch
try {

    // Get all games
    Route::add('/games', function () {
        $gameController = new GameController();
        $gameController->getAll();
    });

    // Get a game by ID
    Route::add('/games/([0-9]*)', function ($id) {
        $gameController = new GameController();
        $gameController->get($id);
    });

    // Create a new game
    Route::add('/games', function () {
        $gameController = new GameController();
        // Handle file upload
        if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_FILES['image'])) {
            $gameController->create();
        } else {
            ResponseService::Error("Image file is required", 400);
        }
    }, ["post"]);

    // Update a game by ID (use POST for updating)
    Route::add('/games/([0-9]*)', function ($id) {
        $gameController = new GameController();
        // Handle file upload
        if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_FILES['image'])) {
            $gameController->update($id);
        } else {
            ResponseService::Error("Image file is required", 400);
        }
    }, ['post']);


    // Delete a game by ID
    Route::add('/games/([0-9]*)', function ($id) {
        $gameController = new GameController();
        $gameController->delete($id);
    }, 'delete');

    // 404 route handler
    Route::pathNotFound(function () {
        ResponseService::Error("route is not defined", 404);
    });
} catch (\Throwable $error) {
    if ($_ENV["environment" == "LOCAL"]) {
        var_dump($error);
    } else {
        error_log($error);
    }
    ResponseService::Error("A server error occurred");
}

Route::run();
