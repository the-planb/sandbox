<?php

declare(strict_types=1);

namespace App\BookStore\Application\Input;

use PlanB\DS\Attribute\ElementType;
use PlanB\DS\Map\Map;

#[ElementType(BookInput::class)]
final class BookInputList extends Map
{
}
