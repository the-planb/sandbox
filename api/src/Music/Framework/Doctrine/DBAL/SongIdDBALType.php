<?php

declare(strict_types=1);

namespace App\Music\Framework\Doctrine\DBAL;

use App\Music\Domain\Model\SongId;
use PlanB\Framework\Doctrine\DBAL\Type\EntityIdType;

final class SongIdDBALType extends EntityIdType
{
    public function makeFromValue(string $value): SongId
    {
        return new SongId($value);
    }

    public function getName(): string
    {
        return 'Music.SongId';
    }
}
