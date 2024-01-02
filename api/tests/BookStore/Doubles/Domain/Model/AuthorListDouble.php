<?php

declare(strict_types=1);

namespace App\Tests\BookStore\Doubles\Domain\Model;

use App\BookStore\Domain\Model\Author;
use App\BookStore\Domain\Model\AuthorList;
use PlanB\Framework\Testing\Double;
use Prophecy\Prophecy\ObjectProphecy;

final class AuthorListDouble extends Double
{
    /**
     * @var Author[]
     */
    private array $items = [];

    public function reveal(): AuthorList
    {
        $this->double()
            ->toArray()
            ->willReturn($this->items)
        ;

        return $this->double->reveal();
    }

    public function withItems(Author ...$items): self
    {
        $this->items = $items;

        return $this;
    }

    protected function classNameOrInterface(): string
    {
        return AuthorList::class;
    }

    protected function double(): ObjectProphecy|AuthorList
    {
        return $this->double;
    }
}
