<?php

declare(strict_types=1);

namespace App\Media\Domain\Model\VO;

use PlanB\Validation\Traits\ValidableTrait;

class FullName
{
    use ValidableTrait;
    private string $name;
    private string $lastName;

    public function __construct(string $name, string $lastName)
    {
        $this->assert(name: $name, lastName: $lastName);
        $this->name = $name;
        $this->lastName = $lastName;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getLastName(): string
    {
        return $this->lastName;
    }
}
