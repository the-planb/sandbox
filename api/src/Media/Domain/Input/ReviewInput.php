<?php

declare(strict_types=1);

namespace App\Media\Domain\Input;

use App\Media\Domain\Model\Movie;
use App\Media\Domain\Model\ReviewId;
use App\Media\Domain\Model\VO\ReviewContent;
use App\Media\Domain\Model\VO\Score;
use PlanB\Domain\Input\Input;

final class ReviewInput extends Input
{
    public ?ReviewId $id = null;
    public ReviewContent $review;
    public Score $score;
    public Movie $movie;

    /**
     * @throws \Exception
     */
    public static function make(array $data): self
    {
        return new self($data);
    }

    public function toArray(): array
    {
        return [
            'review' => $this->review,
            'score' => $this->score,
            'movie' => $this->movie,
        ];
    }
}
