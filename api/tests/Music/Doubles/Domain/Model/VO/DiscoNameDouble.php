<?php

declare(strict_types=1);

namespace App\Tests\Music\Doubles\Domain\Model\VO;

use App\Music\Domain\Model\VO\DiscoName;
use PlanB\Framework\Testing\Double;
use PlanB\Framework\Testing\FakesTrait;
use Prophecy\Prophecy\ObjectProphecy;

final class DiscoNameDouble extends Double
{
    use FakesTrait;

    public function reveal(): DiscoName
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
        return DiscoName::class;
    }

    protected function double(): ObjectProphecy|DiscoName
    {
        return $this->double;
    }
}
