<?php

declare(strict_types=1);

namespace App\Music\Application\Input;

use App\Music\Domain\Model\SongList;
use App\Music\Domain\Model\VO\DiscoName;

final class DiscoInput
{
    public DiscoName $title;
    public SongList $songs;
}
