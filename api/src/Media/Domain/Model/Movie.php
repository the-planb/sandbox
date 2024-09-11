<?php

declare(strict_types=1);

namespace App\Media\Domain\Model;

use App\Media\Domain\Model\VO\MovieTitle;
use App\Media\Domain\Model\VO\Overview;
use App\Media\Domain\Model\VO\ReleaseYear;

class Movie
{
    private MovieId $id;
    private MovieTitle $title;
    private ReleaseYear $releaseYear;
    private Director $director;
    private Overview $overview;

    public function __construct(MovieTitle $title, ReleaseYear $releaseYear, Director $director, Overview $overview)
    {
        $this->id = new MovieId();
        $this->title = $title;
        $this->releaseYear = $releaseYear;
        $this->director = $director;
        $this->overview = $overview;
    }

    public function update(MovieTitle $title, ReleaseYear $releaseYear, Director $director, Overview $overview): Movie
    {
        $this->title = $title;
        $this->releaseYear = $releaseYear;
        $this->director = $director;
        $this->overview = $overview;

        return $this;
    }

    public function getId(): MovieId
    {
        return $this->id;
    }

    public function getTitle(): MovieTitle
    {
        return $this->title;
    }

    public function getReleaseYear(): ReleaseYear
    {
        return $this->releaseYear;
    }

    public function getDirector(): Director
    {
        return $this->director;
    }

    public function getOverview(): Overview
    {
        return $this->overview;
    }
}
