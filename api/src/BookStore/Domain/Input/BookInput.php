<?php

declare(strict_types=1);

namespace App\BookStore\Domain\Input;

use App\BookStore\Domain\Model\Author;
use App\BookStore\Domain\Model\BookId;
use App\BookStore\Domain\Model\VO\Price;
use App\BookStore\Domain\Model\VO\Title;
use PlanB\Domain\Input\Input;

    

final class BookInput extends Input
{
    public ?BookId $id = null;

    public Title $title;
    public ?Price $price;
    public Author $author;
    public TagListInput $tags;
}
