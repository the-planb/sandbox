<?php

declare(strict_types=1);

namespace App\Media\Framework\Doctrine\DBAL;

use App\Media\Domain\Model\VO\ReleaseYear;
use PlanB\Framework\Doctrine\DBAL\Type\IntegerType;

final class ReleaseYearDBALType extends IntegerType
{
    public function getFQN(): string
    {
        return ReleaseYear::class;
    }

    public function getName(): string
    {
        return 'Media.ReleaseYear';
    }
}
