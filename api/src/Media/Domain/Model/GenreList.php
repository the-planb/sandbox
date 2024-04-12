<?php

declare(strict_types=1);

namespace App\Media\Domain\Model;

use PlanB\DS\Attribute\ElementType;
use PlanB\DS\Vector\Vector;

/**
 * @extends Vector<Genre>
 */
#[ElementType(Genre::class)]
final class GenreList extends Vector
{
}