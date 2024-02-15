<?php

declare(strict_types=1);

namespace App\Tests\BookStore\Doubles\Domain\Model\VO;

use App\BookStore\Domain\Model\VO\FullName;
use PlanB\Framework\Testing\Double;
use PlanB\Framework\Testing\FakesTrait;
use Prophecy\Prophecy\ObjectProphecy;

final class FullNameDouble extends Double
{
    use FakesTrait;

    public function reveal(): FullName
    {
        return $this->double->reveal();
    }

    public function withFirstName(string $firstName): self
    {
        $this->double()
            ->getFirstName()
            ->willReturn($firstName)
        ;

        return $this;
    }

    public function withLastName(string $lastName): self
    {
        $this->double()
            ->getLastName()
            ->willReturn($lastName)
        ;

        return $this;
    }

    protected function configure(): void
    {
        $this->withFirstname($this->string());
        $this->withLastname($this->string());
    }

    protected function classNameOrInterface(): string
    {
        return FullName::class;
    }

    protected function double(): ObjectProphecy|FullName
    {
        return $this->double;
    }
}
