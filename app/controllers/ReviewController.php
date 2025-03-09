<?php

require_once(__DIR__ . "/../models/ReviewModel.php");
use App\Services\ResponseService;

class ReviewController
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
        if (empty($reviews)) {
            ResponseService::Error("No reviews found for this game", 404); // Return an error if no reviews found
        } else {
            ResponseService::Send($reviews); // Send the reviews if found
        }
    }


    // Get a review by its ID
    public function get($reviewId)
    {
        $review = $this->reviewModel->getReviewById($reviewId);
        if ($review) {
            ResponseService::Send($review); // Send the review data
        } else {
            ResponseService::Error("Review not found", 404); // If review doesn't exist
        }
    }

    // Create a new review
    public function create($gameId, $userId, $rating, $comment)
    {
        $newReview = $this->reviewModel->createReview($gameId, $userId, $rating, $comment);
        if ($newReview) {
            ResponseService::Send(["message" => "Review created successfully", "review" => $newReview]);
        } else {
            ResponseService::Error("Error creating review", 500);
        }
    }

    // Update an existing review
    public function update($reviewId, $rating, $comment)
    {
        $updatedReview = $this->reviewModel->updateReview($reviewId, $rating, $comment);
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

    public function like($reviewId, $userId)
    {
        // Check if the user has already voted (like or dislike)
        $existingVote = $this->reviewModel->getVoteByUser($reviewId, $userId);

        if ($existingVote) {
            // If the user has already liked, toggle to remove the like
            if ($existingVote['vote'] == 'like') {
                $this->reviewModel->removeVote($reviewId, $userId); // Remove the like
                ResponseService::Send(["message" => "Like removed"]);
            } elseif ($existingVote['vote'] == 'dislike') {
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
            if ($existingVote['vote'] == 'dislike') {
                $this->reviewModel->removeVote($reviewId, $userId); // Remove the dislike
                ResponseService::Send(["message" => "Dislike removed"]);
            } elseif ($existingVote['vote'] == 'like') {
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


}
