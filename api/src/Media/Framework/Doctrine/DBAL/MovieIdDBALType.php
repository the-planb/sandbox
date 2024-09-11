<?php

declare(strict_types=1);

namespace App\Media\Framework\Doctrine\DBAL;

use App\Media\Domain\Model\MovieId;
use PlanB\Framework\Doctrine\DBAL\Type\EntityIdType;

class MovieIdDBALType extends EntityIdType
{
    public function makeFromValue(string $value): MovieId
    {
        return new MovieId($value);
    }

    public function getName(): string
    {
        return 'Media.MovieId';
    }
}
