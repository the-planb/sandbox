<?php

declare(strict_types=1);

namespace App\Movies\Domain\Model;

use PlanB\DS\Attribute\ElementType;
use PlanB\DS\Sequence\Sequence;

#[ElementType(Movie::class)]
final class MovieList extends Sequence
{
}
