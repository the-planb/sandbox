<?php

declare(strict_types=1);

namespace App\Staff\Domain\Model;

use PlanB\DS\Attribute\ElementType;
use PlanB\DS\Sequence\Sequence;

#[ElementType(User::class)]
final class UserList extends Sequence
{
}