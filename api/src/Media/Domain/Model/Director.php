<?php

declare(strict_types=1);

namespace App\Media\Domain\Model;

use App\Media\Domain\Input\GenreListInput;
use App\Media\Domain\Input\MovieListInput;
use App\Media\Domain\Input\ReviewListInput;
use App\Media\Domain\Model\VO\FullName;
use App\Media\Domain\Model\VO\MovieTitle;
use App\Media\Domain\Model\VO\Overview;
use App\Media\Domain\Model\VO\ReleaseYear;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use PlanB\Domain\Model\Entity;
use PlanB\Domain\Model\EntityList;

class Director implements Entity
{
    private DirectorId $id;
    private FullName $name;
    private ?Collection $movies;

    public function __construct(FullName $name, ?MovieListInput $movies)
    {
        $this->update($name, $movies);
    }

    public function update(FullName $name, ?MovieListInput $movies): self
    {
        $this->id ??= new DirectorId();
        $this->name = $name;
        $this->movies = $this->manageMovies($movies);

        return $this;
    }

    public function getId(): DirectorId
    {
        return $this->id;
    }

    public function getName(): FullName
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

    public function createMovie(MovieTitle $title, ReleaseYear $releaseYear, ?ReviewListInput $reviews, ?GenreListInput $genres, Overview $overview): self
    {
        $movie = new Movie($title, $releaseYear, $this, $reviews, $genres, $overview);
        $this->movies->add($movie);

        return $this;
    }

    private function manageMovies(?MovieListInput $input): Collection
    {
        $this->movies ??= new ArrayCollection();
        $input
            ->remove($this->removeMovie(...))
            ->create($this->createMovie(...))
            ->with(EntityList::collect($this->movies))
        ;

        return $this->movies;
    }
}
