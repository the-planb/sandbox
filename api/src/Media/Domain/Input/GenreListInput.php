<?php

declare(strict_types=1);

namespace App\Media\Domain\Input;

use App\Media\Domain\Model\Genre;
use PlanB\Domain\Input\InputList;
use PlanB\DS\Attribute\ElementType;

#[ElementType(Genre::class, 'array')]
final class GenreListInput extends InputList
{
}
