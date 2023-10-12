<?php

declare(strict_types=1);

namespace App\BookStore\Domain\Model\VO;

use PlanB\Type\IntegerValue;

final class Price implements IntegerValue
{
    private ?int $amount;

    public function __construct(?int $amount)
    {
        $this->amount = $amount;
    }

    public function getAmount(): ?int
    {
        return $this->amount;
    }

    public function toInt(): int
    {
        return $this->amount;
    }
}
