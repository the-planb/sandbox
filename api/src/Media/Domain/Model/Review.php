<?php

declare(strict_types=1);

namespace App\Media\Domain\Model;

use App\Media\Domain\Model\VO\ReviewContent;
use App\Media\Domain\Model\VO\Score;

class Review
{
    private ReviewId $id;
    private ReviewContent $review;
    private Score $score;
    private Movie $movie;

    public function __construct(ReviewContent $review, Score $score, Movie $movie)
    {
        $this->id = new ReviewId();
        $this->review = $review;
        $this->score = $score;
        $this->movie = $movie;
    }

    public function update(ReviewContent $review, Score $score, Movie $movie): Review
    {
        $this->review = $review;
        $this->score = $score;
        $this->movie = $movie;

        return $this;
    }

    public function getId(): ReviewId
    {
        return $this->id;
    }

    public function getReview(): ReviewContent
    {
        return $this->review;
    }

    public function getScore(): Score
    {
        return $this->score;
    }

    public function getMovie(): Movie
    {
        return $this->movie;
    }
}
