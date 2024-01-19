<?php

declare(strict_types=1);

namespace App\Tests\Music\Doubles\Domain\Model\VO;

use App\Music\Domain\Model\VO\SongName;
use PlanB\Framework\Testing\Double;
use Prophecy\Prophecy\ObjectProphecy;

final class SongNameDouble extends Double
{
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

        return $this;
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
