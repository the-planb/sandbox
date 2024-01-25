<?php

declare(strict_types=1);

namespace App\Music\Domain\Input;

use App\Music\Domain\Model\Disco;
use PlanB\Domain\Input\InputList;
use PlanB\DS\Attribute\ElementType;

#[ElementType(DiscoInput::class, Disco::class)]
final class DiscoListInput extends InputList
{
}
