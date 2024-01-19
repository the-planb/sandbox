<?php

declare(strict_types=1);

namespace App\Music\Application\UseCase\Update;

use App\Music\Application\Input\DiscoInput;
use App\Music\Domain\Model\DiscoId;
use App\Music\Domain\Model\SongList;
use App\Music\Domain\Model\VO\DiscoName;

final class UpdateDisco
{
    private DiscoName $title;
    private SongList $songs;

    private DiscoId $id;

    public function __construct(DiscoInput $input, DiscoId $discoId)
    {
        $this->title = $input->title;
        $this->songs = $input->songs;

        $this->id = $discoId;
    }

    public function toArray(): array
    {
        return [
            'title' => $this->title,
            'songs' => $this->songs,
        ];
    }

    public function getId(): DiscoId
    {
        return $this->id;
    }
}
