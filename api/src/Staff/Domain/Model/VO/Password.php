<?php

declare(strict_types=1);

namespace App\Staff\Domain\Model\VO;

use PlanB\Type\StringValue;
use PlanB\Validation\Traits\ValidableTrait;

final class Password implements StringValue
{
    use ValidableTrait;

    private string $password;

    public function __construct(string $password)
    {
        $this->assert(password: $password);
        $this->password = $password;
    }

    public function __toString(): string
    {
        return $this->getPassword();
    }

    public function getPassword(): string
    {
        return $this->password;
    }
}
