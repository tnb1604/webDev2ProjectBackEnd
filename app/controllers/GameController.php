<?php

use App\Services\ResponseService;
use App\Controllers\Controller;
require_once __DIR__ . '/../models/GameModel.php';

class GameController extends Controller
{
    private $gameModel;

    public function __construct()
    {
        $this->gameModel = new GameModel();
    }

    public function getAll()
    {
        $page = (int) ($_GET["page"] ?? 1);
        $search = $_GET["search"] ?? ''; // Get the search query from the GET parameters

        // Pass both page and search query to the getAllGames method
        ResponseService::Send($this->gameModel->getAllGames($page, $search));
    }


    public function get($gameId)
    {
        $game = $this->gameModel->getGame($gameId);
        if ($game) {
            ResponseService::Send($game);
        } else {
            ResponseService::Error("Game not found", 404);
        }
    }

    public function create()
    {
        // Check if it's a JSON request
        $contentType = $_SERVER["CONTENT_TYPE"] ?? '';

        if (stripos($contentType, 'application/json') !== false) {
            $data = json_decode(file_get_contents("php://input"), true);
            if (!$data) {
                ResponseService::Error("Invalid JSON", 400);
            }
        } else {
            // Handle multipart/form-data
            $data = $_POST;
        }

        // Handle image upload
        $imagePath = null;
        if (isset($_FILES['image'])) {
            $imagePath = $this->uploadImage($_FILES['image']);
            if (!$imagePath) {
                ResponseService::Error("Image upload failed", 500);
            }
        }

        // Create the game
        $gameId = $this->gameModel->createGame(
            $data['title'] ?? null,
            $data['description'] ?? null,
            $data['genre'] ?? null,
            $data['release_date'] ?? null,
            $imagePath,
            $data['trailer_url'] ?? null
        );

        ResponseService::Send([
            "message" => "Game created successfully",
            "game_id" => $gameId
        ]);
    }

    public function update($gameId)
    {
        // Detect content type
        $contentType = $_SERVER["CONTENT_TYPE"] ?? '';

        // Parse the data depending on the content type (JSON or form data)
        if (stripos($contentType, 'application/json') !== false) {
            $data = json_decode(file_get_contents("php://input"), true);
            if (!$data) {
                ResponseService::Error("Invalid JSON", 400);
            }
        } else {
            // Handle multipart form data
            $data = $_POST;
        }

        // Handle image upload if an image is provided
        $imagePath = null;
        if (isset($_FILES['image']) && $_FILES['image']['error'] === UPLOAD_ERR_OK) {
            // Get the current game data to check if we need to delete the old image
            $currentGame = $this->gameModel->getGame($gameId);
            if ($currentGame && $currentGame['image_path']) {
                $this->deleteImage($currentGame['image_path']); // Delete the old image if it exists
            }

            // Upload the new image
            $imagePath = $this->uploadImage($_FILES['image']);
            if (!$imagePath) {
                ResponseService::Error("Image upload failed", 500);
            }
        } elseif (!isset($_FILES['image'])) {
            // Keep the current image path if no new image is uploaded or if it's undefined
            $currentGame = $this->gameModel->getGame($gameId);
            $imagePath = $currentGame['image_path'] ?? null;
        }

        // Perform the game update
        if (
            $this->gameModel->updateGame(
                $gameId,
                $data['title'] ?? null,
                $data['description'] ?? null,
                $data['genre'] ?? null,
                $data['release_date'] ?? null,
                $imagePath
            )
        ) {
            ResponseService::Send(["message" => "Game updated successfully"]);
        } else {
            ResponseService::Error("Game not found", 404);
        }
    }


    public function delete($gameId)
    {
        // Get the current game data
        $currentGame = $this->gameModel->getGame($gameId);
        if ($currentGame && $currentGame['image_path']) {
            $this->deleteImage($currentGame['image_path']);
        }

        if ($this->gameModel->deleteGame($gameId)) {
            ResponseService::Send(["message" => "Game deleted successfully"]);
        } else {
            ResponseService::Error("Game not found", 404);
        }
    }

    private function uploadImage($file)
    {
        return $this->gameModel->uploadImage($file);
    }

    private function deleteImage($imagePath)
    {
        $fullImagePath = __DIR__ . "/../public" . $imagePath;
        if (file_exists($fullImagePath)) {
            unlink($fullImagePath);
        }
    }
}
