<?php

declare(strict_types=1);

namespace App\Media\Domain\Input;

use App\Media\Domain\Model\Director;
use App\Media\Domain\Model\MovieId;
use App\Media\Domain\Model\VO\MovieTitle;
use App\Media\Domain\Model\VO\Overview;
use App\Media\Domain\Model\VO\ReleaseYear;
use PlanB\Domain\Input\Input;

final class MovieInput extends Input
{
    public ?MovieId $id = null;
    public MovieTitle $title;
    public ReleaseYear $releaseYear;
    public Director $director;
    public ?ReviewListInput $reviews;
    public ?GenreListInput $genres;
    public Overview $overview;

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
            'title' => $this->title,
            'releaseYear' => $this->releaseYear,
            'director' => $this->director,
            'reviews' => $this->reviews ?? ReviewListInput::collect(),
            'genres' => $this->genres ?? GenreListInput::collect(),
            'overview' => $this->overview,
        ];
    }
}
