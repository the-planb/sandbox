<?php

declare(strict_types=1);

namespace App\Tests\Music\Doubles\Domain\Model\VO;

use App\Music\Domain\Model\VO\Duration;
use PlanB\Framework\Testing\Double;
use PlanB\Framework\Testing\FakesTrait;
use Prophecy\Prophecy\ObjectProphecy;

final class DurationDouble extends Double
{
    use FakesTrait;

    public function reveal(): Duration
    {
        return $this->double->reveal();
    }

    public function withDuration(int $duration): self
    {
        $this->double()
            ->getDuration()
            ->willReturn($duration)
        ;

        return $this;
    }

    protected function configure(): void
    {
        $this->withDuration($this->int());
    }

    protected function classNameOrInterface(): string
    {
        return Duration::class;
    }

    protected function double(): ObjectProphecy|Duration
    {
        return $this->double;
    }
}
