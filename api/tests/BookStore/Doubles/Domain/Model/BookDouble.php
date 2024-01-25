<?php

declare(strict_types=1);

namespace App\Tests\BookStore\Doubles\Domain\Model;

use App\BookStore\Domain\Model\Author;
use App\BookStore\Domain\Model\Book;
use App\BookStore\Domain\Model\BookId;
use App\BookStore\Domain\Model\TagList;
use App\BookStore\Domain\Model\VO\Price;
use App\BookStore\Domain\Model\VO\Title;
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

    public function withTags(TagList $tags): self
    {
        $this->double()
            ->getTags()
            ->willReturn($tags)
        ;

        return $this;
    }

    protected function configure(): void
    {
        $this->withId(new BookId());
        $this->withTitle($this->mock(Title::class)->reveal());

        $this->withPrice($this->mock(Price::class)->reveal());

        $this->withAuthor($this->mock(Author::class)->reveal());

        $this->withTags(TagList::collect());
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
