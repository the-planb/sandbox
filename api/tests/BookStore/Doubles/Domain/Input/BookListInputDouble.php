<?php

declare(strict_types=1);

namespace App\Tests\BookStore\Doubles\Domain\Input;

use App\BookStore\Domain\Input\BookInput;
use App\BookStore\Domain\Input\BookListInput;
use App\BookStore\Domain\Model\Book;
use PlanB\Framework\Testing\Double;
use Prophecy\Argument;
use Prophecy\Prophecy\ObjectProphecy;

final class BookListInputDouble extends Double
{
    /**
     * @var Book|BookInput[]
     */
    private array $items = [];

    public function reveal(): BookListInput
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

    public function withItems(Book|BookInput ...$items): self
    {
        $this->items = $items;

        return $this;
    }

    protected function classNameOrInterface(): string
    {
        return BookListInput::class;
    }

    protected function double(): ObjectProphecy|BookListInput
    {
        return $this->double;
    }
}
