<?php

declare(strict_types=1);

namespace App\Tests\BookStore\Doubles\Domain\Model;

use App\BookStore\Domain\Model\Book;
use PlanB\Framework\Testing\Double;
use Prophecy\Prophecy\ObjectProphecy;

final class BookDouble extends Double
{
    public function reveal(): Book
    {
        return $this->double->reveal();
    }

    public function withId(BookId $id): self
    {
        $this->double()
            ->getId()
            ->willReturn($id)
        ;

        return $this;
    }

    public function withTitle(Title $title): self
    {
        $this->double()
            ->getTitle()
            ->willReturn($title)
        ;

        return $this;
    }

    public function withPrice(?Price $price): self
    {
        $this->double()
            ->getPrice()
            ->willReturn($price)
        ;

        return $this;
    }

    public function withAuthor(Author $author): self
    {
        $this->double()
            ->getAuthor()
            ->willReturn($author)
        ;

        return $this;
    }

    public function withTags(Tag $tags): self
    {
        $this->double()
            ->getTags()
            ->willReturn($tags)
        ;

        return $this;
    }

    protected function classNameOrInterface(): string
    {
        return Book::class;
    }

    protected function double(): ObjectProphecy|Book
    {
        return $this->double;
    }
}
