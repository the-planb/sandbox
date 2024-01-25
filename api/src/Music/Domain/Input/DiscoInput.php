<?php

declare(strict_types=1);

namespace App\Music\Domain\Input;

use App\Music\Domain\Model\DiscoId;
use App\Music\Domain\Model\VO\DiscoName;
use PlanB\Domain\Input\Input;

final class DiscoInput extends Input
{
    public ?DiscoId $id = null;

    public DiscoName $title;
    public SongListInput $songs;
}
