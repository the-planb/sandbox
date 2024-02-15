<?php

declare(strict_types=1);

namespace App\Tests\Staff\Doubles\Domain\Model\VO;

use App\Staff\Domain\Model\VO\UserName;
use PlanB\Framework\Testing\Double;
use PlanB\Framework\Testing\FakesTrait;
use Prophecy\Prophecy\ObjectProphecy;

final class UserNameDouble extends Double
{
    use FakesTrait;

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

        $this->double()
            ->__toString()
            ->willReturn($name)
        ;

        return $this;
    }

    protected function configure(): void
    {
        $this->withName($this->string());
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
