<?php

declare(strict_types=1);

namespace App\BookStore\Domain\Model\Traits;

use App\BookStore\Domain\Input\TagListInput;
use App\BookStore\Domain\Model\Tag;
use App\BookStore\Domain\Model\TagList;
use App\BookStore\Domain\Model\VO\TagName;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use PlanB\Domain\Model\EntityList;

trait TagCollectionTrait
{
    private Collection $tags;

    public function removeTag(Tag $tag): static
    {
        $this->tags->removeElement($tag);

        return $this;
    }

    public function createTag(TagName $name): static
    {
        $tag = new Tag($name);
        $this->tags->add($tag);

        return $this;
    }

    public function addTag(Tag $tag): self
    {
        $this->tags->add($tag);

        return $this;
    }

    public function getTags(): TagList
    {
        return TagList::collect($this->tags ?? []);
    }

    private function tagCollection(TagListInput $input): static
    {
        $this->tags ??= new ArrayCollection();
        $input
            ->remove($this->removeTag(...))
            ->create($this->createTag(...))
            ->add($this->addTag(...))
            ->with(EntityList::collect($this->tags))
        ;

        return $this;
    }
}
