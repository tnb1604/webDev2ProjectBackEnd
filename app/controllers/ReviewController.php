<?php

require_once(__DIR__ . "/../models/ReviewModel.php");

class ReviewController
{
    private $reviewModel;

    public function __construct()
    {
        $this->reviewModel = new ReviewModel();
    }

    public function getByGame($gameId)
    {
        return $this->reviewModel->getReviewsByGame($gameId);
    }

    public function get($reviewId)
    {
        return $this->reviewModel->getReview($reviewId);
    }

    public function create($gameId, $userId, $rating, $comment)
    {
        return $this->reviewModel->createReview($gameId, $userId, $rating, $comment);
    }

    public function update($reviewId, $rating, $comment)
    {
        return $this->reviewModel->updateReview($reviewId, $rating, $comment);
    }

    public function delete($reviewId)
    {
        return $this->reviewModel->deleteReview($reviewId);
    }
}
