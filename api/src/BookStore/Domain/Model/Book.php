<?php

declare(strict_types=1);

namespace App\BookStore\Domain\Model;

use App\BookStore\Domain\Model\VO\Price;
use App\BookStore\Domain\Model\VO\Title;

class Book
{
    private BookId $id;
    private Title $title;
    private Price $price;
    private Author $author;

    public function __construct(Title $title, Price $price, Author $author)
    {
        $this->id = new BookId();
        $this->title = $title;
        $this->price = $price;
        $this->author = $author;
    }

    public function update(Title $title, Price $price, Author $author): self
    {
        $this->title = $title;
        $this->price = $price;
        $this->author = $author;

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

    public function getPrice(): Price
    {
        return $this->price;
    }

    public function getAuthor(): Author
    {
        return $this->author;
    }
}
