<?php

declare(strict_types=1);

namespace App\BookStore\Application\UseCase\Create;

use App\BookStore\Domain\Input\BookInput;
use App\BookStore\Domain\Input\TagListInput;
use App\BookStore\Domain\Model\Author;
use App\BookStore\Domain\Model\VO\Price;
use App\BookStore\Domain\Model\VO\Title;

final class CreateBook
{
    private Title $title;
    private ?Price $price;
    private Author $author;
    private TagListInput $tags;

    public function __construct(BookInput $input)
    {
        $this->title = $input->title;
        $this->price = $input->price;
        $this->author = $input->author;
        $this->tags = $input->tags;
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
}
