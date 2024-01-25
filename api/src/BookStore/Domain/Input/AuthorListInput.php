<?php

declare(strict_types=1);

namespace App\BookStore\Domain\Input;

use App\BookStore\Domain\Model\Author;
use PlanB\Domain\Input\InputList;
use PlanB\DS\Attribute\ElementType;

#[ElementType(AuthorInput::class, Author::class)]
final class AuthorListInput extends InputList
{
}
