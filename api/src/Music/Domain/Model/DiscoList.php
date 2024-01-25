<?php

declare(strict_types=1);

namespace App\Music\Domain\Model;

use PlanB\DS\Attribute\ElementType;
use PlanB\DS\Sequence\Sequence;

#[ElementType(Disco::class)]
final class DiscoList extends Sequence
{
}
