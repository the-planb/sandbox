<?php

declare(strict_types=1);

namespace App\Media\Domain\Model;

use PlanB\DS\Attribute\ElementType;
use PlanB\DS\Vector\Vector;

#[ElementType(Review::class)]
final class ReviewList extends Vector
{
}
