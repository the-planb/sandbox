<?php

declare(strict_types=1);

namespace App\Music\Application\UseCase\Create;

use App\Music\Domain\Input\DiscoInput;
use App\Music\Domain\Input\SongListInput;
use App\Music\Domain\Model\VO\DiscoName;

final class CreateDisco
{
    private DiscoName $title;
    private SongListInput $songs;

    public function __construct(DiscoInput $input)
    {
        $this->title = $input->title;
        $this->songs = $input->songs;
    }

    public function toArray(): array
    {
        return [
            'title' => $this->title,
            'songs' => $this->songs,
        ];
    }
}
