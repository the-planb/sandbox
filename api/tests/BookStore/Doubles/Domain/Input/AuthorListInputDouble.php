<?php

declare(strict_types=1);

namespace App\Tests\BookStore\Doubles\Domain\Input;

use App\BookStore\Domain\Input\AuthorInput;
use App\BookStore\Domain\Input\AuthorListInput;
use App\BookStore\Domain\Model\Author;
use PlanB\Framework\Testing\Double;
use Prophecy\Argument;
use Prophecy\Prophecy\ObjectProphecy;

final class AuthorListInputDouble extends Double
{
    /**
     * @var Author|AuthorInput[]
     */
    private array $items = [];

    public function reveal(): AuthorListInput
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

    public function withItems(Author|AuthorInput ...$items): self
    {
        $this->items = $items;

        return $this;
    }

    protected function classNameOrInterface(): string
    {
        return AuthorListInput::class;
    }

    protected function double(): ObjectProphecy|AuthorListInput
    {
        return $this->double;
    }
}
