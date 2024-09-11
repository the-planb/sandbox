<?php

declare(strict_types=1);

namespace App\Media\Domain\Repository;

use App\Media\Domain\Model\Movie;
use App\Media\Domain\Model\MovieId;
use App\Media\Domain\Model\MovieList;
use PlanB\Domain\Criteria\Criteria;

interface MovieRepository
{
    public function save(Movie $movie): Movie;

    public function delete(MovieId $movieId): void;

    public function findById(MovieId $movieId): ?Movie;

    public function match(Criteria $criteria): MovieList;
}
