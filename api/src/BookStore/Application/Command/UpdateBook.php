<?php

declare(strict_types=1);

namespace App\BookStore\Application\Command;

use App\BookStore\Application\Input\BookInput;
use App\BookStore\Domain\Model\Author;
use App\BookStore\Domain\Model\BookId;
use App\BookStore\Domain\Model\VO\Title;

final class UpdateBook
{
    private Title $title;
    private Author $author;
    private float $price;
    private BookId $__previous_id;

    public function __construct(BookInput $input, BookId $bookId)
    {
        $this->title = $input->title;
        $this->author = $input->author;
        $this->price = $input->price;

        $this->__previous_id = $bookId;
    }

    public function toArray(): array
    {
        return [
            'title' => $this->title,
            'author' => $this->author,
            'price' => $this->price,
        ];
    }

    public function getId(): BookId
    {
        return $this->__previous_id;
    }
}
