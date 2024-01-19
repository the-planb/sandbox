<?php

declare(strict_types=1);

namespace App\Music\Framework\Doctrine\DBAL;

use App\Music\Domain\Model\VO\SongName;
use PlanB\Framework\Doctrine\DBAL\Type\StringType;

final class SongNameDBALType extends StringType
{
    public function getFQN(): string
    {
        return SongName::class;
    }

    public function getName(): string
    {
        return 'Music.SongName';
    }
}
