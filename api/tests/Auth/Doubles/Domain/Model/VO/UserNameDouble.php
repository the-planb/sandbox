<?php

declare(strict_types=1);

namespace App\Tests\Auth\Doubles\Domain\Model\VO;

use App\Auth\Domain\Model\VO\UserName;
use PlanB\Framework\Testing\Double;
use Prophecy\Prophecy\ObjectProphecy;

final class UserNameDouble extends Double
{
    public function reveal(): UserName
    {
        return $this->double->reveal();
    }

    public function withName(string $name): self
    {
        $this->double()
            ->getName()
            ->willReturn($name)
        ;

        return $this;
    }

    protected function classNameOrInterface(): string
    {
        return UserName::class;
    }

    protected function double(): ObjectProphecy|UserName
    {
        return $this->double;
    }
}
