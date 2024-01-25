<?php

declare(strict_types=1);

namespace App\Music\Domain\Model\Traits;

use App\Music\Domain\Input\SongListInput;
use App\Music\Domain\Model\Song;
use App\Music\Domain\Model\SongList;
use App\Music\Domain\Model\VO\Duration;
use App\Music\Domain\Model\VO\SongName;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use PlanB\Domain\Model\EntityList;

trait SongCollectionTrait
{
    private Collection $songs;

    public function removeSong(Song $song): static
    {
        $this->songs->removeElement($song);

        return $this;
    }

    public function createSong(SongName $title, ?Duration $duration): static
    {
        $song = new Song($title, $duration, $this);
        $this->songs->add($song);

        return $this;
    }

    public function addSong(Song $song): self
    {
        $this->songs->add($song);

        return $this;
    }

    public function getSongs(): SongList
    {
        return SongList::collect($this->songs ?? []);
    }

    private function songCollection(SongListInput $input): static
    {
        $this->songs ??= new ArrayCollection();
        $input
            ->remove($this->removeSong(...))
            ->create($this->createSong(...))
            ->add($this->addSong(...))
            ->with(EntityList::collect($this->songs))
        ;

        return $this;
    }
}
