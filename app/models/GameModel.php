<?php

use App\Models\Model;

require_once(__DIR__ . "/Model.php");

class GameModel extends Model
{
    private $itemsPerPage = 10;

    public function __construct()
    {
        parent::__construct();
    }

    public function getAllGames($page, $search = '')
    {
        $offset = ($page - 1) * $this->itemsPerPage;

        $sql = "
    SELECT g.id, g.title, g.description, g.genre, g.release_date, g.image_path, g.trailer_url,
           COALESCE(AVG(r.rating), 0) AS average_rating,
           COUNT(r.id) AS review_count
    FROM games g
    LEFT JOIN reviews r ON g.id = r.game_id
    WHERE g.title LIKE :search
    GROUP BY g.id
    ORDER BY review_count DESC, g.release_date DESC 
    LIMIT :limit OFFSET :offset
    ";

        $stmt = self::$pdo->prepare($sql);
        $stmt->bindValue(':search', '%' . $search . '%', PDO::PARAM_STR);
        $stmt->bindValue(':limit', $this->itemsPerPage, PDO::PARAM_INT);
        $stmt->bindValue(':offset', $offset, PDO::PARAM_INT);
        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }




    public function getGame($gameId)
    {
        $stmt = self::$pdo->prepare("SELECT id, title, description, genre, release_date, image_path, trailer_url FROM games WHERE id = ?");
        $stmt->execute([$gameId]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function createGame($title, $description, $genre, $releaseDate, $imagePath, $trailerUrl)
    {
        $stmt = self::$pdo->prepare("INSERT INTO games (title, description, genre, release_date, image_path, trailer_url) VALUES (?, ?, ?, ?, ?, ?)");
        $stmt->execute([$title, $description, $genre, $releaseDate, $imagePath, $trailerUrl]);

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
