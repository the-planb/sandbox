<?php

declare(strict_types=1);

namespace App\Auth\Domain\Model;

use PlanB\DS\Attribute\ElementType;
use PlanB\DS\Vector\Vector;

#[ElementType('string')]
class RoleList extends Vector
{
}
