<?php

declare(strict_types=1);

namespace App\Media\Domain\Repository;

use App\Media\Domain\Model\Genre;
use App\Media\Domain\Model\GenreId;
use App\Media\Domain\Model\GenreList;
use PlanB\Domain\Criteria\Criteria;

interface GenreRepository
{
    public function save(Genre $genre): Genre;

    public function delete(GenreId $genreId): void;

    public function findById(GenreId $genreId): ?Genre;

    public function match(Criteria $criteria): GenreList;
}
