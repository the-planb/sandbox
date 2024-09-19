<?php

declare(strict_types=1);

namespace App\Media\Application\UseCase\Update;

use App\Media\Domain\Input\GenreListInput;
use App\Media\Domain\Input\ReviewListInput;
use App\Media\Domain\Model\Director;
use App\Media\Domain\Model\MovieId;
use App\Media\Domain\Model\VO\Classification;
use App\Media\Domain\Model\VO\MovieTitle;
use App\Media\Domain\Model\VO\Overview;
use App\Media\Domain\Model\VO\ReleaseYear;
use App\Media\Domain\Model\VO\Score;

class UpdateMovie
{
    public MovieId $id;
    public MovieTitle $title;
    public ReleaseYear $releaseYear;
    public Director $director;
    public ReviewListInput $reviews;
    public GenreListInput $genres;
    public Overview $overview;
    public Classification $classification;
    public Score $raw;

    public function getId(): MovieId
    {
        return $this->id;
    }

    public function toArray(): array
    {
        return [
            'title' => $this->title,
            'releaseYear' => $this->releaseYear,
            'director' => $this->director,
            'reviews' => $this->reviews,
            'genres' => $this->genres,
            'overview' => $this->overview,
            'classification' => $this->classification,
        ];
    }
}
