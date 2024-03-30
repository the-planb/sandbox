<?php

declare(strict_types=1);

namespace App\Movies\Domain\Repository;

use App\Movies\Domain\Model\Movie;
use App\Movies\Domain\Model\MovieId;
use App\Movies\Domain\Model\MovieList;
use PlanB\Domain\Criteria\Criteria;

interface MovieRepository
{
    public function save(Movie $movie): Movie;

    public function delete(MovieId $movieId): void;

    public function findById(MovieId $movieId): ?Movie;

    public function match(Criteria $criteria): MovieList;

    public function totalItems(Criteria $criteria): int;
}
