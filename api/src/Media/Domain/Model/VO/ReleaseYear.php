<?php

declare(strict_types=1);

namespace App\Media\Domain\Model\VO;

use PlanB\Type\IntegerValue;
use PlanB\Validation\Traits\ValidableTrait;

class ReleaseYear implements IntegerValue
{
    use ValidableTrait;
    private int $year;

    public function __construct(int $year)
    {
        $this->assert(year: $year);
        $this->year = $year;
    }

    public function getYear(): int
    {
        return $this->year;
    }

    public function toInt(): int
    {
        return $this->year;
    }
}
