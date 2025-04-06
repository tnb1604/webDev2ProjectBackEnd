<?php

use App\Models\Model;

require_once(__DIR__ . "/Model.php");

class ReviewModel extends Model
{
    public function __construct()
    {
        parent::__construct();
    }

    // Get all reviews for a specific game, ordered by most likes
    public function getReviewsByGame($gameId)
    {
        $stmt = self::$pdo->prepare("
            SELECT r.*, 
                   (SELECT COUNT(*) FROM review_likes WHERE review_id = r.id AND type = 'like') as likes_count
            FROM reviews r
            WHERE r.game_id = ?
            ORDER BY likes_count DESC
        ");
        $stmt->execute([$gameId]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC); // Return reviews ordered by likes
    }

    // Get a review by its ID
    public function getReviewById($reviewId)
    {
        $stmt = self::$pdo->prepare("SELECT * FROM reviews WHERE id = ?");
        $stmt->execute([$reviewId]);
        return $stmt->fetch(PDO::FETCH_ASSOC); // Return the review by ID
    }

    // Create a new review
    public function createReview($gameId, $userId, $title, $rating, $reviewText)
    {
        $stmt = self::$pdo->prepare("INSERT INTO reviews (game_id, user_id, title, rating, review_text) VALUES (?, ?, ?, ?, ?)");
        $stmt->execute([$gameId, $userId, $title, $rating, $reviewText]);
        return $this->getReviewById(self::$pdo->lastInsertId()); // Return the newly created review
    }

    // Update an existing review
    public function updateReview($reviewId, $title, $rating, $reviewText)
    {
        $stmt = self::$pdo->prepare("UPDATE reviews SET title = ?, rating = ?, review_text = ? WHERE id = ?");
        $stmt->execute([$title, $rating, $reviewText, $reviewId]);
        return $this->getReviewById($reviewId); // Return the updated review
    }

    // Delete a review by ID
    public function deleteReview($reviewId)
    {
        $stmt = self::$pdo->prepare("DELETE FROM reviews WHERE id = ?");
        return $stmt->execute([$reviewId]); // Return true if successful, false otherwise
    }

    public function getVoteByUser($reviewId, $userId)
    {
        $stmt = self::$pdo->prepare("SELECT * FROM review_likes WHERE review_id = ? AND user_id = ?");
        $stmt->execute([$reviewId, $userId]);
        return $stmt->fetch(PDO::FETCH_ASSOC); // Return the vote if it exists
    }

    public function addVote($reviewId, $userId, $vote)
    {
        $stmt = self::$pdo->prepare("INSERT INTO review_likes (review_id, user_id, type) VALUES (?, ?, ?)");
        return $stmt->execute([$reviewId, $userId, $vote]); // Add the vote
    }

    public function updateVote($reviewId, $userId, $newVote)
    {
        $stmt = self::$pdo->prepare("UPDATE review_likes SET type = ? WHERE review_id = ? AND user_id = ?");
        return $stmt->execute([$newVote, $reviewId, $userId]); // Update the vote
    }

    public function removeVote($reviewId, $userId)
    {
        $stmt = self::$pdo->prepare("DELETE FROM review_likes WHERE review_id = ? AND user_id = ?");
        return $stmt->execute([$reviewId, $userId]); // Delete the vote
    }

    public function getLikesCount($reviewId)
    {
        $stmt = self::$pdo->prepare("SELECT COUNT(*) as count FROM review_likes WHERE review_id = ? AND type = 'like'");
        $stmt->execute([$reviewId]);
        return $stmt->fetch(PDO::FETCH_ASSOC)['count']; // Return the count of likes
    }

    public function getDislikesCount($reviewId)
    {
        $stmt = self::$pdo->prepare("SELECT COUNT(*) as count FROM review_likes WHERE review_id = ? AND type = 'dislike'");
        $stmt->execute([$reviewId]);
        return $stmt->fetch(PDO::FETCH_ASSOC)['count']; // Return the count of dislikes
    }
}
