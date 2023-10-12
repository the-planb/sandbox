<?php

declare(strict_types=1);

namespace App\BookStore\Application\Command;

use App\BookStore\Application\Input\BookInput;
use App\BookStore\Domain\Model\Author;
use App\BookStore\Domain\Model\VO\Title;

final class CreateBook
{
    private Title $title;
    private Author $author;
    private float $price;

    public function __construct(BookInput $input)
    {
        $this->title = $input->title;
        $this->author = $input->author;
        $this->price = $input->price;
    }

    public function toArray(): array
    {
        return [
            'title' => $this->title,
            'author' => $this->author,
            'price' => $this->price,
        ];
    }
}
