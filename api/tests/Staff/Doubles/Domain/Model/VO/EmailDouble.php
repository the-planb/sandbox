<?php

declare(strict_types=1);

namespace App\Tests\Staff\Doubles\Domain\Model\VO;

use App\Staff\Domain\Model\VO\Email;
use PlanB\Framework\Testing\Double;
use PlanB\Framework\Testing\FakesTrait;
use Prophecy\Prophecy\ObjectProphecy;

final class EmailDouble extends Double
{
    use FakesTrait;

    public function reveal(): Email
    {
        return $this->double->reveal();
    }

    public function withEmail(string $email): self
    {
        $this->double()
            ->getEmail()
            ->willReturn($email)
        ;

        $this->double()
            ->__toString()
            ->willReturn($email)
        ;

        return $this;
    }

    protected function configure(): void
    {
        $this->withEmail($this->email());
    }

    protected function classNameOrInterface(): string
    {
        return Email::class;
    }

    protected function double(): ObjectProphecy|Email
    {
        return $this->double;
    }
}
