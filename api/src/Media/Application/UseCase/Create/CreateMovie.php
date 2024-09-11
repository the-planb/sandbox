<?php

declare(strict_types=1);

namespace App\Media\Application\UseCase\Create;

use App\Media\Domain\Model\Director;
use App\Media\Domain\Model\VO\MovieTitle;
use App\Media\Domain\Model\VO\Overview;
use App\Media\Domain\Model\VO\ReleaseYear;

class CreateMovie
{
    public MovieTitle $title;
    public ReleaseYear $releaseYear;
    public Director $director;
    public Overview $overview;

    public function toArray(): array
    {
        return [
            'title' => $this->title,
            'releaseYear' => $this->releaseYear,
            'director' => $this->director,
            'overview' => $this->overview,
        ];
    }
}
