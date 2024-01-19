<?php

declare(strict_types=1);

namespace App\Music\Application\Input;

use PlanB\DS\Attribute\ElementType;
use PlanB\DS\Map\Map;

#[ElementType(DiscoInput::class)]
final class DiscoInputList extends Map
{
}
