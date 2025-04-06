<?php

use App\Services\ResponseService;
use App\Controllers\Controller;
require_once __DIR__ . '/../models/ReviewModel.php';


class ReviewController extends Controller
{
    private $reviewModel;

    public function __construct()
    {
        $this->reviewModel = new ReviewModel();
    }

    // Get all reviews for a specific game
    public function getByGame($gameId)
    {
        $reviews = $this->reviewModel->getReviewsByGame($gameId);
        // Return an empty array if no reviews are found
        ResponseService::Send($reviews);
    }

    // Get a review by its ID
    public function get($reviewId)
    {
        $review = $this->reviewModel->getReviewById($reviewId);
        if ($review) {
            $likesCount = $this->reviewModel->getLikesCount($reviewId);
            $dislikesCount = $this->reviewModel->getDislikesCount($reviewId);
            $review['likes'] = $likesCount;
            $review['dislikes'] = $dislikesCount;
            ResponseService::Send($review); // Send the review data with likes and dislikes count
        } else {
            ResponseService::Error("Review not found", 404); // If review doesn't exist
        }
    }

    // Create a new review
    public function create($gameId, $userId, $title, $rating, $reviewText)
    {
        if (empty($gameId) || empty($userId) || empty($title) || empty($rating) || empty($reviewText)) {
            ResponseService::Error("Missing required fields: gameId, userId, title, rating, or reviewText", 400);
            return;
        }

        // Validate field lengths
        $this->validateFields(
            ['title' => $title, 'reviewText' => $reviewText],
            ['title' => 50, 'reviewText' => 1000]
        );

        $newReview = $this->reviewModel->createReview($gameId, $userId, $title, $rating, $reviewText);
        if ($newReview) {
            ResponseService::Send(["message" => "Review created successfully", "review" => $newReview]);
        } else {
            ResponseService::Error("Error creating review", 500);
        }
    }

    // Update an existing review
    public function update($reviewId, $title, $rating, $reviewText)
    {
        if (empty($reviewId) || empty($title) || empty($rating) || empty($reviewText)) {
            ResponseService::Error("Missing required fields: reviewId, title, rating, or reviewText", 400);
            return;
        }

        // Validate field lengths
        $this->validateFields(
            ['title' => $title, 'reviewText' => $reviewText],
            ['title' => 50, 'reviewText' => 1000]
        );

        $updatedReview = $this->reviewModel->updateReview($reviewId, $title, $rating, $reviewText);
        if ($updatedReview) {
            ResponseService::Send(["message" => "Review updated successfully", "review" => $updatedReview]);
        } else {
            ResponseService::Error("Review not found or update failed", 404);
        }
    }

    // Delete a review by ID
    public function delete($reviewId)
    {
        $currentReview = $this->reviewModel->getReviewById($reviewId);

        if (!$currentReview) {
            ResponseService::Error("Review not found", 404);
            return;
        }

        // Delete the review from the database
        if ($this->reviewModel->deleteReview($reviewId)) {
            ResponseService::Send(["message" => "Review deleted successfully"]);
        } else {
            ResponseService::Error("Failed to delete review", 500);
        }
    }

    public function getUserVote($reviewId, $userId)
    {
        $vote = $this->reviewModel->getVoteByUser($reviewId, $userId);
        ResponseService::Send(["voteType" => $vote ? $vote['type'] : null]);
    }


    public function like($reviewId, $userId)
    {
        // Check if the user has already voted (like or dislike)
        $existingVote = $this->reviewModel->getVoteByUser($reviewId, $userId);

        if ($existingVote) {
            // If the user has already liked, toggle to remove the like
            if ($existingVote['type'] == 'like') {
                $this->reviewModel->removeVote($reviewId, $userId); // Remove the like
                ResponseService::Send(["message" => "Like removed"]);
            } elseif ($existingVote['type'] == 'dislike') {
                // If the user has disliked, change it to like
                $this->reviewModel->updateVote($reviewId, $userId, 'like');
                ResponseService::Send(["message" => "Like added, dislike removed"]);
            }
        } else {
            // If no vote exists, add the like
            $this->reviewModel->addVote($reviewId, $userId, 'like');
            ResponseService::Send(["message" => "Like added"]);
        }
    }

    public function dislike($reviewId, $userId)
    {
        // Check if the user has already voted (like or dislike)
        $existingVote = $this->reviewModel->getVoteByUser($reviewId, $userId);

        if ($existingVote) {
            // If the user has already disliked, toggle to remove the dislike
            if ($existingVote['type'] == 'dislike') {
                $this->reviewModel->removeVote($reviewId, $userId); // Remove the dislike
                ResponseService::Send(["message" => "Dislike removed"]);
            } elseif ($existingVote['type'] == 'like') {
                // If the user has liked, change it to dislike
                $this->reviewModel->updateVote($reviewId, $userId, 'dislike');
                ResponseService::Send(["message" => "Dislike added, like removed"]);
            }
        } else {
            // If no vote exists, add the dislike
            $this->reviewModel->addVote($reviewId, $userId, 'dislike');
            ResponseService::Send(["message" => "Dislike added"]);
        }
    }

    public function getVotes($reviewId)
    {
        $review = $this->reviewModel->getReviewById($reviewId);
        if ($review) {
            $likesCount = $this->reviewModel->getLikesCount($reviewId);
            $dislikesCount = $this->reviewModel->getDislikesCount($reviewId);
            ResponseService::Send([
                'likes' => $likesCount,
                'dislikes' => $dislikesCount
            ]);
        } else {
            ResponseService::Error("Review not found", 404); // If review doesn't exist
        }
    }

}
