<?php

declare(strict_types=1);

namespace App\Media\Domain\Model;

use App\Media\Domain\Model\VO\ReviewContent;
use App\Media\Domain\Model\VO\Score;
use PlanB\Domain\Model\Entity;

class Review implements Entity
{
    private ReviewId $id;
    private ReviewContent $review;
    private Score $score;
    private Movie $movie;

    public function __construct(ReviewContent $review, Score $score, Movie $movie)
    {
        $this->update($review, $score, $movie);
    }

    public function update(ReviewContent $review, Score $score, Movie $movie): self
    {
        $this->id ??= new ReviewId();
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
