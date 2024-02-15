<?php

declare(strict_types=1);

namespace App\Tests\Music\Doubles\Domain\Model\VO;

use App\Music\Domain\Model\VO\SongName;
use PlanB\Framework\Testing\Double;
use PlanB\Framework\Testing\FakesTrait;
use Prophecy\Prophecy\ObjectProphecy;

final class SongNameDouble extends Double
{
    use FakesTrait;

    public function reveal(): SongName
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
        return SongName::class;
    }

    protected function double(): ObjectProphecy|SongName
    {
        return $this->double;
    }
}
