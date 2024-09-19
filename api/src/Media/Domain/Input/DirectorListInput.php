<?php

declare(strict_types=1);

namespace App\Media\Domain\Input;

use App\Media\Domain\Model\Director;
use PlanB\Domain\Input\InputList;
use PlanB\DS\Attribute\ElementType;

#[ElementType(Director::class, 'array')]
final class DirectorListInput extends InputList
{
}
