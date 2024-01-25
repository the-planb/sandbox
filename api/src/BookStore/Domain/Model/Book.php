<?php

declare(strict_types=1);

namespace App\BookStore\Domain\Model;

use App\BookStore\Domain\Input\TagListInput;
use App\BookStore\Domain\Model\Traits\TagCollectionTrait;
use App\BookStore\Domain\Model\VO\Price;
use App\BookStore\Domain\Model\VO\Title;
use PlanB\Domain\Model\Entity;

class Book implements Entity
{
    use TagCollectionTrait;

    private BookId $id;
    private Title $title;
    private ?Price $price;
    private Author $author;

    public function __construct(Title $title, ?Price $price, Author $author, TagListInput $tags)
    {
        $this->id = new BookId();
        $this->title = $title;
        $this->price = $price;
        $this->author = $author;
        $this->tagCollection($tags);
    }

    public function update(Title $title, ?Price $price, Author $author, TagListInput $tags): self
    {
        $this->title = $title;
        $this->price = $price;
        $this->author = $author;
        $this->tagCollection($tags);

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
}
