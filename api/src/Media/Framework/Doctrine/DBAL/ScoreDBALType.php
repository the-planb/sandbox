<?php

declare(strict_types=1);

namespace App\Media\Framework\Doctrine\DBAL;

use App\Media\Domain\Model\VO\Score;
use PlanB\Framework\Doctrine\DBAL\Type\IntegerType;

class ScoreDBALType extends IntegerType
{
    public function getName(): string
    {
        return 'Media.Score';
    }

    public function getFQN(): string
    {
        return Score::class;
    }
}
