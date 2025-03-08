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
        $gameController->create($_POST);
    }, ["post"]);

    Route::add('/games/([0-9]*)', function ($id) {
        $gameController = new GameController();

        // get json data from request body
        $data = json_decode(file_get_contents("php://input"), true);

        // validate data
        if (!$data) {
            ResponseService::Error("Invalid JSON data", 400);
            return;
        }

        $gameController->update(
            $id,
            $data['title'] ?? null,
            $data['description'] ?? null,
            $data['genre'] ?? null,
            $data['release_date'] ?? null,
            $data['image_path'] ?? null
        );
    }, ['put']);



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
