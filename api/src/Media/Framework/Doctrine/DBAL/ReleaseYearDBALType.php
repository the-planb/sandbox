<?php

declare(strict_types=1);

namespace App\Media\Framework\Doctrine\DBAL;

use App\Media\Domain\Model\VO\ReleaseYear;
use PlanB\Framework\Doctrine\DBAL\Type\IntegerType;

class ReleaseYearDBALType extends IntegerType
{
    public function getName(): string
    {
        return 'Media.ReleaseYear';
    }

    public function getFQN(): string
    {
        return ReleaseYear::class;
    }
}
