<?php

declare(strict_types=1);

namespace App\Media\Domain\Model;

use PlanB\DS\Attribute\ElementType;
use PlanB\DS\Vector\Vector;

/**
 * @extends Vector<Director>
 */
#[ElementType(Director::class)]
final class DirectorList extends Vector
{
}