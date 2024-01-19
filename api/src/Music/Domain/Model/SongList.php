<?php

declare(strict_types=1);

namespace App\Music\Domain\Model;

use PlanB\DS\Attribute\ElementType;
use PlanB\DS\Map\Map;

#[ElementType(Song::class)]
final class SongList extends Map
{
}
