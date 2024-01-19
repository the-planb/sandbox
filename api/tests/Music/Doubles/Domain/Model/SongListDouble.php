<?php

declare(strict_types=1);

namespace App\Tests\Music\Doubles\Domain\Model;

use App\Music\Domain\Model\Song;
use App\Music\Domain\Model\SongList;
use PlanB\Framework\Testing\Double;
use Prophecy\Prophecy\ObjectProphecy;

final class SongListDouble extends Double
{
    /**
     * @var Song[]
     */
    private array $items = [];

    public function reveal(): SongList
    {
        $this->double()
            ->toArray()
            ->willReturn($this->items)
        ;

        return $this->double->reveal();
    }

    public function withItems(Song ...$items): self
    {
        $this->items = $items;

        return $this;
    }

    protected function classNameOrInterface(): string
    {
        return SongList::class;
    }

    protected function double(): ObjectProphecy|SongList
    {
        return $this->double;
    }
}
