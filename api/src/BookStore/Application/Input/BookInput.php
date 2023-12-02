<?php

declare(strict_types=1);

namespace App\BookStore\Application\Input;

use App\BookStore\Domain\Model\Author;
use App\BookStore\Domain\Model\BookId;
use App\BookStore\Domain\Model\TagList;
use App\BookStore\Domain\Model\VO\Price;
use App\BookStore\Domain\Model\VO\Title;

final class BookInput
{
    public BookId $id;
    public Title $title;
    public ?Price $price;
    public Author $author;
    public TagList $tags;
}
