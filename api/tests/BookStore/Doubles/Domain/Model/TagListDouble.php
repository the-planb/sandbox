<?php

declare(strict_types=1);

namespace App\Tests\BookStore\Doubles\Domain\Model;

use App\BookStore\Domain\Model\Tag;
use App\BookStore\Domain\Model\TagList;
use PlanB\Framework\Testing\Double;
use Prophecy\Prophecy\ObjectProphecy;

final class TagListDouble extends Double
{
    /**
     * @var Tag[]
     */
    private array $items = [];

    public function reveal(): TagList
    {
        $this->double()
            ->toArray()
            ->willReturn($this->items)
        ;

        return $this->double->reveal();
    }

    public function withItems(Tag ...$items): self
    {
        $this->items = $items;

        return $this;
    }

    protected function classNameOrInterface(): string
    {
        return TagList::class;
    }

    protected function double(): ObjectProphecy|TagList
    {
        return $this->double;
    }
}
