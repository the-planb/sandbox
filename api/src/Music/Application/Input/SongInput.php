<?php

declare(strict_types=1);

namespace App\Music\Application\Input;

use App\Music\Domain\Model\Disco;
use App\Music\Domain\Model\VO\Duration;
use App\Music\Domain\Model\VO\SongName;

final class SongInput
{
    public SongName $title;
    public ?Duration $duration;
    public Disco $album;
}
