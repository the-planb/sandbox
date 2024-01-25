<?php

declare(strict_types=1);

namespace App\Music\Domain\Input;

use App\Music\Domain\Model\SongId;
use App\Music\Domain\Model\VO\Duration;
use App\Music\Domain\Model\VO\SongName;
use PlanB\Domain\Input\Input;

final class SongInput extends Input
{
    public ?SongId $id = null;

    public SongName $title;
    public ?Duration $duration;
}
