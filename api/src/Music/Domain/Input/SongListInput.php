<?php

declare(strict_types=1);

namespace App\Music\Domain\Input;

use App\Music\Domain\Model\Song;
use PlanB\Domain\Input\InputList;
use PlanB\DS\Attribute\ElementType;

#[ElementType(SongInput::class, Song::class)]
final class SongListInput extends InputList
{
}
