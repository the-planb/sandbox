<?php

declare(strict_types=1);

namespace App\Auth\Domain\Model\VO;

use PlanB\Type\StringValue;
use PlanB\Validation\Traits\ValidableTrait;

final class UserName implements StringValue
{
    use ValidableTrait;

    private string $name;

    public function __construct(string $name)
    {
        $this->assert(name: $name);
        $this->name = $name;
    }

    public function __toString(): string
    {
        return $this->name;
    }

    public function getName(): string
    {
        return $this->name;
    }
}
