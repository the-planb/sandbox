<?php

declare(strict_types=1);

namespace App\Media\Framework\Doctrine\DBAL;

use App\Media\Domain\Model\GenreId;
use PlanB\Framework\Doctrine\DBAL\Type\EntityIdType;

class GenreIdDBALType extends EntityIdType
{
    public function makeFromValue(string $value): GenreId
    {
        return new GenreId($value);
    }

    public function getName(): string
    {
        return 'Media.GenreId';
    }
}
