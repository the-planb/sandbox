<?php

declare(strict_types=1);

namespace App\Music\Framework\Doctrine\DBAL;

use App\Music\Domain\Model\DiscoId;
use PlanB\Framework\Doctrine\DBAL\Type\EntityIdType;

final class DiscoIdDBALType extends EntityIdType
{
    public function makeFromValue(string $value): DiscoId
    {
        return new DiscoId($value);
    }

    public function getName(): string
    {
        return 'Music.DiscoId';
    }
}
