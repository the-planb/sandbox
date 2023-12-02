<?php

declare(strict_types=1);

namespace App\BookStore\Domain\Model;

use App\BookStore\Domain\Model\VO\Price;
use App\BookStore\Domain\Model\VO\Title;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;

class Book
{
    private BookId $id;
    private Title $title;
    private ?Price $price;
    private Author $author;
    private Collection $tags;

    public function __construct(Title $title, ?Price $price, Author $author, TagList $tags)
    {
        $this->id = new BookId();
        $this->title = $title;
        $this->price = $price;
        $this->author = $author;
        $this->tags = new ArrayCollection($tags->toArray());
    }

    public function update(Title $title, ?Price $price, Author $author, TagList $tags): self
    {
        $this->title = $title;
        $this->price = $price;
        $this->author = $author;
        $this->tags = new ArrayCollection($tags->toArray());

        return $this;
    }

    public function getId(): BookId
    {
        return $this->id;
    }

    public function getTitle(): Title
    {
        return $this->title;
    }

    public function getPrice(): ?Price
    {
        return $this->price;
    }

    public function getAuthor(): Author
    {
        return $this->author;
    }

    public function getTags(): TagList
    {
        return TagList::collect($this->tags);
    }
}
