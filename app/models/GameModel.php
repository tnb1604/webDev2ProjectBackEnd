<?php

use App\Models\Model;

require_once(__DIR__ . "/Model.php");

class GameModel extends Model
{
    private $itemsPerPage = 30;

    public function __construct()
    {
        parent::__construct();
    }

    public function getAllGames($page)
    {
        $offset = ($page - 1) * $this->itemsPerPage;

        $stmt = self::$pdo->prepare("
            SELECT id, title, description, genre, release_date, image_path 
            FROM games 
            ORDER BY release_date DESC 
            LIMIT :limit OFFSET :offset
        ");
        $stmt->bindValue(':limit', $this->itemsPerPage, PDO::PARAM_INT);
        $stmt->bindValue(':offset', $offset, PDO::PARAM_INT);
        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getGame($gameId)
    {
        $stmt = self::$pdo->prepare("SELECT id, title, description, genre, release_date, image_path FROM games WHERE id = ?");
        $stmt->execute([$gameId]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
 
    public function createGame($title, $description, $genre, $releaseDate, $imagePath)
    {
        $stmt = self::$pdo->prepare("INSERT INTO games (title, description, genre, release_date, image_path) VALUES (?, ?, ?, ?, ?)");
        $stmt->execute([$title, $description, $genre, $releaseDate, $imagePath]);

        return self::$pdo->lastInsertId();
    }

    public function updateGame($gameId, $title, $description, $genre, $releaseDate, $imagePath)
    {
        // Check if the game exists first
        $stmt = self::$pdo->prepare("SELECT COUNT(*) FROM games WHERE id = ?");
        $stmt->execute([$gameId]);
        if ($stmt->fetchColumn() == 0) {
            return false; // Game does not exist
        }

        // Proceed with update
        $stmt = self::$pdo->prepare("
        UPDATE games 
        SET title = ?, description = ?, genre = ?, release_date = ?, image_path = ? 
        WHERE id = ?
    ");
        return $stmt->execute([$title, $description, $genre, $releaseDate, $imagePath, $gameId]);
    }

    public function deleteGame($gameId)
    {
        // Check if the game exists
        $stmt = self::$pdo->prepare("SELECT COUNT(*) FROM games WHERE id = ?");
        $stmt->execute([$gameId]);
        if ($stmt->fetchColumn() == 0) {
            return false; // Game does not exist
        }

        // Proceed with delete
        $stmt = self::$pdo->prepare("DELETE FROM games WHERE id = ?");
        return $stmt->execute([$gameId]);
    }

    public function uploadImage($file)
    {
        $targetDir = __DIR__ . "/../public/images/";
        $filename = time() . "_" . basename($file["name"]); // Prevent duplicate filenames
        $targetFile = $targetDir . $filename;

        // Create folder if it doesn't exist
        if (!is_dir($targetDir)) {
            mkdir($targetDir, 0777, true);
        }

        if (move_uploaded_file($file["tmp_name"], $targetFile)) {
            return "/images/" . $filename; // Return image path to save in the DB
        } else {
            return false; // Handle error
        }
    }
}
