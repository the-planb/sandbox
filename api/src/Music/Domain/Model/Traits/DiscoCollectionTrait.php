<?php

declare(strict_types=1);

namespace App\Music\Domain\Model\Traits;

use App\Music\Domain\Input\DiscoListInput;
use App\Music\Domain\Input\SongListInput;
use App\Music\Domain\Model\Disco;
use App\Music\Domain\Model\DiscoList;
use App\Music\Domain\Model\VO\DiscoName;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use PlanB\Domain\Model\EntityList;

trait DiscoCollectionTrait
{
    private Collection $discos;

    public function removeDisco(Disco $disco): static
    {
        $this->discos->removeElement($disco);

        return $this;
    }

    public function createDisco(DiscoName $title, SongListInput $songs): static
    {
        $disco = new Disco($title, $songs);
        $this->discos->add($disco);

        return $this;
    }

    public function addDisco(Disco $disco): self
    {
        $this->discos->add($disco);

        return $this;
    }

    public function getDiscos(): DiscoList
    {
        return DiscoList::collect($this->discos ?? []);
    }

    private function discoCollection(DiscoListInput $input): static
    {
        $this->discos ??= new ArrayCollection();
        $input
            ->remove($this->removeDisco(...))
            ->create($this->createDisco(...))
            ->add($this->addDisco(...))
            ->with(EntityList::collect($this->discos))
        ;

        return $this;
    }
}
