<?php

declare(strict_types=1);

namespace App\Tests\BookStore\Doubles\Domain\Model;

use App\BookStore\Domain\Model\Book;
use App\BookStore\Domain\Model\BookList;
use PlanB\Framework\Testing\Double;
use Prophecy\Prophecy\ObjectProphecy;

final class BookListDouble extends Double
{
    /**
     * @var Book[]
     */
    private array $items = [];

    public function reveal(): BookList
    {
        $this->double()
            ->toArray()
            ->willReturn($this->items)
        ;

        return $this->double->reveal();
    }

    public function withItems(Book ...$items): self
    {
        $this->items = $items;

        return $this;
    }

    protected function classNameOrInterface(): string
    {
        return BookList::class;
    }

    protected function double(): ObjectProphecy|BookList
    {
        return $this->double;
    }
}
