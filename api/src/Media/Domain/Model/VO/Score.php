<?php

declare(strict_types=1);

namespace App\Media\Domain\Model\VO;

use PlanB\Type\IntegerValue;
use PlanB\Validation\Traits\ValidableTrait;

class Score implements IntegerValue
{
    use ValidableTrait;
    private int $score;

    public function __construct(int $score)
    {
        $this->assert(score: $score);
        $this->score = $score;
    }

    public function getScore(): int
    {
        return $this->score;
    }

    public function toInt(): int
    {
        return $this->score;
    }
}
