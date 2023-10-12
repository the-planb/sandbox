<?php

declare(strict_types=1);

namespace App\BookStore\Domain\Model;

use App\BookStore\Domain\Model\VO\FullName;
use App\BookStore\Domain\Model\VO\Title;

class Book
{
    private BookId $id;
    private Title $title;
    private Author $author;
    private float $price;

    public function __construct(Title $title, Author $author, float $price = 10)
    {
        $this->id = new BookId();
        $this->title = $title;
        $this->author = $author;
        $this->price = $price;
    }

    public function update(Title $title, Author $author, float $price = 10): self
    {
        $this->title = $title;
        $this->author = $author;
        $this->price = $price;

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

    public function getAuthor(): Author
    {
        return $this->author;
    }

    public function getPrice(): float
    {
        return $this->price;
    }

    public function getName(): FullName
    {
        return $this->author->getName();
    }
}
