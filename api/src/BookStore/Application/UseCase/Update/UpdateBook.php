<?php

declare(strict_types=1);

namespace App\BookStore\Application\UseCase\Update;

use App\BookStore\Domain\Input\BookInput;
use App\BookStore\Domain\Input\TagListInput;
use App\BookStore\Domain\Model\Author;
use App\BookStore\Domain\Model\BookId;
use App\BookStore\Domain\Model\VO\Price;
use App\BookStore\Domain\Model\VO\Title;

final class UpdateBook
{
    private Title $title;
    private ?Price $price;
    private Author $author;
    private TagListInput $tags;

    private BookId $id;

    public function __construct(BookInput $input, BookId $bookId)
    {
        $this->title = $input->title;
        $this->price = $input->price;
        $this->author = $input->author;
        $this->tags = $input->tags;

        $this->id = $bookId;
    }

    public function toArray(): array
    {
        return [
            'title' => $this->title,
            'price' => $this->price,
            'author' => $this->author,
            'tags' => $this->tags,
        ];
    }

    public function getId(): BookId
    {
        return $this->id;
    }
}
