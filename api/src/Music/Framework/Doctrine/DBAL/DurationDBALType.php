<?php

declare(strict_types=1);

namespace App\Music\Framework\Doctrine\DBAL;

use App\Music\Domain\Model\VO\Duration;
use PlanB\Framework\Doctrine\DBAL\Type\IntegerType;

final class DurationDBALType extends IntegerType
{
    public function getFQN(): string
    {
        return Duration::class;
    }

    public function getName(): string
    {
        return 'Music.Duration';
    }
}
