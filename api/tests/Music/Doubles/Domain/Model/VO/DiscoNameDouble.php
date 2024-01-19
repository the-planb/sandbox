<?php

declare(strict_types=1);

namespace App\Tests\Music\Doubles\Domain\Model\VO;

use App\Music\Domain\Model\VO\DiscoName;
use PlanB\Framework\Testing\Double;
use Prophecy\Prophecy\ObjectProphecy;

final class DiscoNameDouble extends Double
{
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

        return $this;
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
