<?php

declare(strict_types=1);

namespace App\Movies\Framework\Doctrine\DBAL;

use App\Movies\Domain\Model\MovieId;
use PlanB\Framework\Doctrine\DBAL\Type\EntityIdType;

final class MovieIdDBALType extends EntityIdType
{
    public function makeFromValue(string $value): MovieId
    {
        return new MovieId($value);
    }

    public function getName(): string
    {
        return 'Movies.MovieId';
    }
}
