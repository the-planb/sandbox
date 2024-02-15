<?php

declare(strict_types=1);

namespace App\Staff\Domain\Model;

use PlanB\DS\Attribute\ElementType;
use PlanB\DS\Sequence\Sequence;

#[ElementType('string')]
class RoleList extends Sequence
{
}
