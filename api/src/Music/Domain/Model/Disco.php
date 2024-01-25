<?php

declare(strict_types=1);

namespace App\Music\Domain\Model;

use App\Music\Domain\Input\SongListInput;
use App\Music\Domain\Model\Traits\SongCollectionTrait;
use App\Music\Domain\Model\VO\DiscoName;
use PlanB\Domain\Model\Entity;

    

class Disco implements Entity
{
    use SongCollectionTrait;

    private DiscoId $id;
    private DiscoName $title;

    public function __construct(DiscoName $title, SongListInput $songs)
    {
        $this->id = new DiscoId();
        $this->title = $title;
        $this->songCollection($songs);
    }

    public function update(DiscoName $title, SongListInput $songs): self
    {
        $this->title = $title;
        $this->songCollection($songs);

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
}
