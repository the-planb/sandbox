<?php

declare(strict_types=1);

namespace App\Tests\BookStore\Doubles\Domain\Input;

use App\BookStore\Domain\Input\TagInput;
use App\BookStore\Domain\Input\TagListInput;
use App\BookStore\Domain\Model\Tag;
use PlanB\Framework\Testing\Double;
use Prophecy\Argument;
use Prophecy\Prophecy\ObjectProphecy;

final class TagListInputDouble extends Double
{
    /**
     * @var Tag|TagInput[]
     */
    private array $items = [];

    public function reveal(): TagListInput
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

    public function withItems(Tag|TagInput ...$items): self
    {
        $this->items = $items;

        return $this;
    }

    protected function classNameOrInterface(): string
    {
        return TagListInput::class;
    }

    protected function double(): ObjectProphecy|TagListInput
    {
        return $this->double;
    }
}
