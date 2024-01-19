<?php

declare(strict_types=1);

namespace App\Music\Framework\Doctrine\DBAL;

use App\Music\Domain\Model\VO\DiscoName;
use PlanB\Framework\Doctrine\DBAL\Type\StringType;

final class DiscoNameDBALType extends StringType
{
    public function getFQN(): string
    {
        return DiscoName::class;
    }

    public function getName(): string
    {
        return 'Music.DiscoName';
    }
}
