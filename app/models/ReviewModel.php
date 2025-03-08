<?php

use App\Models\Model;

require_once(__DIR__ . "/Model.php");

class ReviewModel extends Model
{
    public function __construct()
    {
        parent::__construct();
    }

    public function getAllReviews()
    {
    }

    public function getReview($reviewId)
    {
    }


    public function getReviewsByGame($gameId)
    {
    }

    public function getReviewByUser($userId)
    {
    }

    public function createReview($userId, $gameId, $rating, $reviewText)
    {
    }

    public function updateReview($reviewId, $rating, $reviewText)
    {
    }

    public function deleteReview($reviewId)
    {
    }
}
