<?php

declare(strict_types=1);

namespace App\Media\Domain\Input;

use App\Media\Domain\Model\Movie;
use PlanB\Domain\Input\InputList;
use PlanB\DS\Attribute\ElementType;

#[ElementType(Movie::class, 'array')]
final class MovieListInput extends InputList
{
}
