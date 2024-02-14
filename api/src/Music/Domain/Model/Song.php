<?php

declare(strict_types=1);

namespace App\Music\Domain\Model;

use App\Music\Domain\Model\VO\Duration;
use App\Music\Domain\Model\VO\SongName;
use PlanB\Domain\Model\Entity;

class Song implements Entity
{
    private SongId $id;
    private SongName $title;
    private ?Duration $duration;
    private Disco $album;

    public function __construct(SongName $title, ?Duration $duration, Disco $album)
    {
        $this->id = new SongId();
        $this->title = $title;
        $this->duration = $duration;
        $this->album = $album;
    }

    public function update(SongName $title, ?Duration $duration, Disco $album): self
    {
        $this->title = $title;
        $this->duration = $duration;
        $this->album = $album;

        return $this;
    }

    public function getId(): SongId
    {
        return $this->id;
    }

    public function getTitle(): SongName
    {
        return $this->title;
    }

    public function getDuration(): ?Duration
    {
        return $this->duration;
    }

    public function getAlbum(): Disco
    {
        return $this->album;
    }
}
