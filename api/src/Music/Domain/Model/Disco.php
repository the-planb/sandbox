<?php

declare(strict_types=1);

namespace App\Music\Domain\Model;

use App\Music\Domain\Model\VO\DiscoName;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;

class Disco
{
    private DiscoId $id;
    private DiscoName $title;
    private Collection $songs;

    public function __construct(DiscoName $title, SongList $songs)
    {
        $this->id = new DiscoId();
        $this->title = $title;
        $this->songs = new ArrayCollection($songs->toArray());
    }

    public function update(DiscoName $title, SongList $songs): self
    {
        $this->title = $title;
        $this->songs = new ArrayCollection($songs->toArray());

        return $this;
    }

    public function getId(): DiscoId
    {
        return $this->id;
    }

    public function getTitle(): DiscoName
    {
        return $this->title;
    }

    public function getSongs(): SongList
    {
        return SongList::collect($this->songs);
    }
}
