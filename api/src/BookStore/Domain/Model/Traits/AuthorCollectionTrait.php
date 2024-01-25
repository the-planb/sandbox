<?php

declare(strict_types=1);

namespace App\BookStore\Domain\Model\Traits;

use App\BookStore\Domain\Input\AuthorListInput;
use App\BookStore\Domain\Model\Author;
use App\BookStore\Domain\Model\AuthorList;
use App\BookStore\Domain\Model\VO\FullName;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use PlanB\Domain\Model\EntityList;

trait AuthorCollectionTrait
{
    private Collection $authors;

    public function removeAuthor(Author $author): static
    {
        $this->authors->removeElement($author);

        return $this;
    }

    public function createAuthor(FullName $name): static
    {
        $author = new Author($name);
        $this->authors->add($author);

        return $this;
    }

    public function addAuthor(Author $author): self
    {
        $this->authors->add($author);

        return $this;
    }

    public function getAuthors(): AuthorList
    {
        return AuthorList::collect($this->authors ?? []);
    }

    private function authorCollection(AuthorListInput $input): static
    {
        $this->authors ??= new ArrayCollection();
        $input
            ->remove($this->removeAuthor(...))
            ->create($this->createAuthor(...))
            ->add($this->addAuthor(...))
            ->with(EntityList::collect($this->authors))
        ;

        return $this;
    }
}
