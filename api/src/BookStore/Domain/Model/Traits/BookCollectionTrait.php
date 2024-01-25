<?php

declare(strict_types=1);

namespace App\BookStore\Domain\Model\Traits;

use App\BookStore\Domain\Input\BookListInput;
use App\BookStore\Domain\Input\TagListInput;
use App\BookStore\Domain\Model\Author;
use App\BookStore\Domain\Model\Book;
use App\BookStore\Domain\Model\BookList;
use App\BookStore\Domain\Model\VO\Price;
use App\BookStore\Domain\Model\VO\Title;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use PlanB\Domain\Model\EntityList;

trait BookCollectionTrait
{
    private Collection $books;

    public function removeBook(Book $book): static
    {
        $this->books->removeElement($book);

        return $this;
    }

    public function createBook(Title $title, ?Price $price, Author $author, TagListInput $tags): static
    {
        $book = new Book($title, $price, $author, $tags);
        $this->books->add($book);

        return $this;
    }

    public function addBook(Book $book): self
    {
        $this->books->add($book);

        return $this;
    }

    public function getBooks(): BookList
    {
        return BookList::collect($this->books ?? []);
    }

    private function bookCollection(BookListInput $input): static
    {
        $this->books ??= new ArrayCollection();
        $input
            ->remove($this->removeBook(...))
            ->create($this->createBook(...))
            ->add($this->addBook(...))
            ->with(EntityList::collect($this->books))
        ;

        return $this;
    }
}
