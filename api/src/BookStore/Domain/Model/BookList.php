<?php

declare(strict_types=1);

namespace App\BookStore\Domain\Model;

use PlanB\DS\Attribute\ElementType;
use PlanB\DS\Sequence\Sequence;

#[ElementType(Book::class)]
final class BookList extends Sequence
{
}
