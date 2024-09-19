<?php

declare(strict_types=1);

namespace App\Media\Domain\Input;

use App\Media\Domain\Model\Review;
use PlanB\Domain\Input\InputList;
use PlanB\DS\Attribute\ElementType;

#[ElementType(Review::class, 'array')]
final class ReviewListInput extends InputList
{
}
