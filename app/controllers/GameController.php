<?php

require_once(__DIR__ . "/../models/GameModel.php");
use App\Services\ResponseService;

class GameController
{
    private $gameModel;

    public function __construct()
    {
        $this->gameModel = new GameModel();
    }

    public function getAll()
    {
        $page = (int) ($_GET["page"] ?? 1);
        ResponseService::Send($this->gameModel->getAllGames($page));
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
        $data = json_decode(file_get_contents("php://input"), true);
        if (!$data) {
            ResponseService::Error("Invalid JSON", 400);
        }

        $gameId = $this->gameModel->createGame(
            $data['title'],
            $data['description'],
            $data['genre'],
            $data['release_date'],
            $data['image_path']
        );

        ResponseService::Send([
            "message" => "Game created successfully",
            "game_id" => $gameId
        ]);
    }

    public function update($gameId, $title, $description, $genre, $releaseDate, $imagePath)
    {
        if ($this->gameModel->updateGame($gameId, $title, $description, $genre, $releaseDate, $imagePath)) {
            ResponseService::Send(["message" => "Game updated successfully"]);
        } else {
            ResponseService::Error("Game not found", 404);
        }
    }

    public function delete($gameId)
    {
        if ($this->gameModel->deleteGame($gameId)) {
            ResponseService::Send(["message" => "Game deleted successfully"]);
        } else {
            ResponseService::Error("Game not found", 404);
        }
    }
}
