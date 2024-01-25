<?php

declare(strict_types=1);

namespace App\BookStore\Domain\Model;

use PlanB\DS\Attribute\ElementType;
use PlanB\DS\Sequence\Sequence;

#[ElementType(Author::class)]
final class AuthorList extends Sequence
{
}
