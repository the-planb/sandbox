<?php

declare(strict_types=1);

namespace App\Media\Domain\Model;

use App\Media\Domain\Input\MovieListInput;
use App\Media\Domain\Model\VO\GenreName;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use PlanB\Domain\Model\Entity;
use PlanB\Domain\Model\EntityList;

class Genre implements Entity
{
    private GenreId $id;
    private GenreName $name;
    private ?Collection $movies;

    public function __construct(GenreName $name, ?MovieListInput $movies)
    {
        $this->update($name, $movies);
    }

    public function update(GenreName $name, ?MovieListInput $movies): self
    {
        $this->id ??= new GenreId();
        $this->name = $name;
        $this->movies = $this->manageMovies($movies);

        return $this;
    }

    public function getId(): GenreId
    {
        return $this->id;
    }

    public function getName(): GenreName
    {
        return $this->name;
    }

    public function getMovies(): ?MovieList
    {
        return new MovieList($this->movies);
    }

    public function removeMovie(Movie $movie): self
    {
        $this->movies->removeElement($movie);

        return $this;
    }

    public function addMovie(Movie $movie): self
    {
        $this->movies->add($movie);

        return $this;
    }

    private function manageMovies(?MovieListInput $input): Collection
    {
        $this->movies ??= new ArrayCollection();
        $input
            ->remove($this->removeMovie(...))
            ->add($this->addMovie(...))
            ->with(EntityList::collect($this->movies))
        ;

        return $this->movies;
    }
}
