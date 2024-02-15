<?php

declare(strict_types=1);

namespace App\Tests\Staff\Doubles\Domain\Model\VO;

use App\Staff\Domain\Model\VO\Password;
use PlanB\Framework\Testing\Double;
use PlanB\Framework\Testing\FakesTrait;
use Prophecy\Prophecy\ObjectProphecy;

final class PasswordDouble extends Double
{
    use FakesTrait;

    public function reveal(): Password
    {
        return $this->double->reveal();
    }

    public function withPassword(string $password): self
    {
        $this->double()
            ->getPassword()
            ->willReturn($password)
        ;

        $this->double()
            ->__toString()
            ->willReturn($password)
        ;

        return $this;
    }

    protected function configure(): void
    {
        $this->withPassword($this->string());
    }

    protected function classNameOrInterface(): string
    {
        return Password::class;
    }

    protected function double(): ObjectProphecy|Password
    {
        return $this->double;
    }
}
