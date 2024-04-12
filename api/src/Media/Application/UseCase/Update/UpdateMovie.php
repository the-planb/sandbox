<?php

declare(strict_types=1);

namespace App\Media\Application\UseCase\Update;

use App\Media\Domain\Input\GenreListInput;
use App\Media\Domain\Input\MovieInput;
use App\Media\Domain\Input\ReviewListInput;
use App\Media\Domain\Model\Director;
use App\Media\Domain\Model\MovieId;
use App\Media\Domain\Model\VO\MovieTitle;
use App\Media\Domain\Model\VO\Overview;
use App\Media\Domain\Model\VO\ReleaseYear;

final readonly class UpdateMovie
{
    public MovieId $id;
    public MovieTitle $title;
    public ReleaseYear $releaseYear;
    public Director $director;
    public ?ReviewListInput $reviews;
    public ?GenreListInput $genres;
    public Overview $overview;

    public function __construct(MovieId $id, MovieInput $input)
    {
        $this->id = $id;
        $this->title = $input->title;
        $this->releaseYear = $input->releaseYear;
        $this->director = $input->director;
        $this->reviews = $input->reviews ?? ReviewListInput::collect();
        $this->genres = $input->genres ?? GenreListInput::collect();
        $this->overview = $input->overview;
    }

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
        ];
    }
}
