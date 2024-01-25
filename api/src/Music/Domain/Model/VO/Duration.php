<?php

declare(strict_types=1);

namespace App\Music\Domain\Model\VO;

use PlanB\Type\IntegerValue;
use PlanB\Validation\Traits\ValidableTrait;

final class Duration implements IntegerValue
{
    use ValidableTrait;

    private int $duration;

    public function __construct(int $duration)
    {
        $this->assert(duration: $duration);
        $this->duration = $duration;
    }

    public function getDuration(): int
    {
        return $this->duration;
    }

    public function toInt(): int
    {
        return $this->duration;
    }
}
