<?php

declare(strict_types=1);

namespace App\Tests\Music\Doubles\Domain\Input;

use App\Music\Domain\Input\SongInput;
use App\Music\Domain\Input\SongListInput;
use App\Music\Domain\Model\Song;
use PlanB\Framework\Testing\Double;
use Prophecy\Argument;
use Prophecy\Prophecy\ObjectProphecy;

final class SongListInputDouble extends Double
{
    /**
     * @var Song|SongInput[]
     */
    private array $items = [];

    public function reveal(): SongListInput
    {
        $this->double()
            ->with(Argument::any())
            ->willReturn($this->items)
        ;

        $this->double()
            ->toArray()
            ->willReturn($this->items)
        ;

        return $this->double->reveal();
    }

    public function withItems(Song|SongInput ...$items): self
    {
        $this->items = $items;

        return $this;
    }

    protected function classNameOrInterface(): string
    {
        return SongListInput::class;
    }

    protected function double(): ObjectProphecy|SongListInput
    {
        return $this->double;
    }
}
