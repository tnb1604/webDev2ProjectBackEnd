<?php

/**
 * Setup
 */

// require autoload file to autoload vendor libraries
require_once __DIR__ . '/../vendor/autoload.php';
require_once __DIR__ . '/../controllers/GameController.php';
require_once __DIR__ . '/../controllers/ReviewController.php';
require_once __DIR__ . '/../controllers/UserController.php';

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

    // ##################################### Game Routes ##################################### \\
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




    // ##################################### Review Routes ##################################### \\
    // Get all reviews for a game
    Route::add('/reviews/game/([0-9]*)', function ($gameId) {
        $reviewController = new ReviewController();
        $reviewController->getByGame($gameId);
    });

    // Get a review by its ID
    Route::add('/reviews/([0-9]*)', function ($reviewId) {
        $reviewController = new ReviewController();
        $reviewController->get($reviewId);
    });

    // Create a new review
    Route::add('/reviews', function () {
        // Example: Expecting JSON body with gameId, userId, title, rating, review_text
        $data = json_decode(file_get_contents("php://input"), true);
        if (isset($data['gameId'], $data['userId'], $data['title'], $data['rating'], $data['review_text'])) {
            $reviewController = new ReviewController();
            $reviewController->create($data['gameId'], $data['userId'], $data['title'], $data['rating'], $data['review_text']);
        } else {
            ResponseService::Error("Missing required fields", 400);
        }
    }, ['post']);

    // Update an existing review
    Route::add('/reviews/([0-9]*)', function ($reviewId) {
        // Example: Expecting JSON body with title, rating, and review_text
        $data = json_decode(file_get_contents("php://input"), true);
        if (isset($data['title'], $data['rating'], $data['review_text'])) {
            $reviewController = new ReviewController();
            $reviewController->update($reviewId, $data['title'], $data['rating'], $data['review_text']);
        } else {
            ResponseService::Error("Missing required fields", 400);
        }
    }, ['put']);

    // Delete a review by ID
    Route::add('/reviews/([0-9]*)', function ($reviewId) {
        $reviewController = new ReviewController();
        $reviewController->delete($reviewId);
    }, 'delete');

    // Like a review
    Route::add('/reviews/([0-9]*)/like/([0-9]*)', function ($reviewId, $userId) {
        $reviewController = new ReviewController();
        $reviewController->like($reviewId, $userId);
    }, ['post']);

    // Dislike a review
    Route::add('/reviews/([0-9]*)/dislike/([0-9]*)', function ($reviewId, $userId) {
        $reviewController = new ReviewController();
        $reviewController->dislike($reviewId, $userId);
    }, ['post']);

    // Get likes and dislikes for a review
    Route::add('/reviews/([0-9]*)/votes', function ($reviewId) {
        $reviewController = new ReviewController();
        $reviewController->getVotes($reviewId);
    });





    // ##################################### User Routes ##################################### \\
    // Get all users
    Route::add('/users', function () {
        $userController = new UserController();
        $userController->getAll();
    }, 'GET');

    // Get user by ID
    Route::add('/users/([0-9]*)', function ($id) {
        $userController = new UserController();
        $userController->get($id);
    }, 'GET');

    // Register a new user
    Route::add('/auth/register', function () {
        $userController = new UserController();
        $userController->register();
    }, 'POST');

    // Login a user
    Route::add('/auth/login', function () {
        $userController = new UserController();
        $userController->login();
    }, 'POST');

    Route::add('/auth/me', function () {
        $userController = new UserController();
        $userController->me();
    }, ["get"]);

    // update article by id
    Route::add('/auth/is-me/([0-9]*)', function ($id) {
        $userController = new UserController();
        $userController->isMe($id);
    }, 'get');



    



    // ##################################### 404 Route Handler ##################################### \\
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
