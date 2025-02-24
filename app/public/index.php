<?php

/**
 * Setup
 */

// require autoload file to autoload vendor libraries
require_once __DIR__ . '/../vendor/autoload.php';

// require local classes
use App\Services\EnvService;
use App\Services\ErrorReportingService;
use App\Services\ResponseService;
use App\Controllers\ArticleController;

// require vendor libraries
use Steampixel\Route;

// initialize global environment variables
EnvService::Init();

// initialize error reporting (on in local env)
ErrorReportingService::Init();

/**
 * Main application routes
 */
// top level fail-safe try/catch
try {
    /**
     * Article routes
     */
    // paginated get all articles route: /articles?page=1
    Route::add('/articles', function () {
        $articleController = new ArticleController();
        $articleController->getAll();
    });
    // get article by id
    Route::add('/article/([a-z-0-9-]*)', function ($id) {
        $articleController = new ArticleController();
        $articleController->get($id);
    });
    // create article route
    Route::add('/article', function () {
        $articleController = new ArticleController();
        $articleController->create($_POST);
    }, ["post"]);
    // generate qr code for article
    Route::add('/article/qr-code/([a-z-0-9-]*)', function ($id) {
        $articleController = new ArticleController();
        $articleController->getQrCode($id);
    });

    /**
     * 404 route handler
     */
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
