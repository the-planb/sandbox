<?php

declare(strict_types=1);

namespace App\Media\Domain\Model;

use App\Media\Domain\Input\GenreListInput;
use App\Media\Domain\Input\ReviewListInput;
use App\Media\Domain\Model\VO\MovieTitle;
use App\Media\Domain\Model\VO\Overview;
use App\Media\Domain\Model\VO\ReleaseYear;
use App\Media\Domain\Model\VO\ReviewContent;
use App\Media\Domain\Model\VO\Score;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use PlanB\Domain\Model\Entity;
use PlanB\Domain\Model\EntityList;

class Movie implements Entity
{
    private MovieId $id;
    private MovieTitle $title;
    private ReleaseYear $releaseYear;
    private Director $director;
    private ?Collection $reviews;
    private ?Collection $genres;
    private Overview $overview;

    public function __construct(MovieTitle $title, ReleaseYear $releaseYear, Director $director, ?ReviewListInput $reviews, ?GenreListInput $genres, Overview $overview)
    {
        $this->update($title, $releaseYear, $director, $reviews, $genres, $overview);
    }

    public function update(MovieTitle $title, ReleaseYear $releaseYear, Director $director, ?ReviewListInput $reviews, ?GenreListInput $genres, Overview $overview): self
    {
        $this->id ??= new MovieId();
        $this->title = $title;
        $this->releaseYear = $releaseYear;
        $this->director = $director;
        $this->reviews = $this->manageReviews($reviews);
        $this->genres = $this->manageGenres($genres);
        $this->overview = $overview;

        return $this;
    }

    public function getId(): MovieId
    {
        return $this->id;
    }

    public function getTitle(): MovieTitle
    {
        return $this->title;
    }

    public function getReleaseYear(): ReleaseYear
    {
        return $this->releaseYear;
    }

    public function getDirector(): Director
    {
        return $this->director;
    }

    public function getOverview(): Overview
    {
        return $this->overview;
    }

    public function getReviews(): ?ReviewList
    {
        return new ReviewList($this->reviews);
    }

    public function getGenres(): ?GenreList
    {
        return new GenreList($this->genres);
    }

    public function removeReview(Review $review): self
    {
        $this->reviews->removeElement($review);

        return $this;
    }

    public function removeGenre(Genre $genre): self
    {
        $this->genres->removeElement($genre);

        return $this;
    }

    public function addGenre(Genre $genre): self
    {
        $this->genres->add($genre);

        return $this;
    }

    public function createReview(ReviewContent $review, Score $score): self
    {
        $review = new Review($review, $score, $this);
        $this->reviews->add($review);

        return $this;
    }

    private function manageReviews(?ReviewListInput $input): Collection
    {
        $this->reviews ??= new ArrayCollection();
        $input
            ->remove($this->removeReview(...))
            ->create($this->createReview(...))
            ->with(EntityList::collect($this->reviews))
        ;

        return $this->reviews;
    }

    private function manageGenres(?GenreListInput $input): Collection
    {
        $this->genres ??= new ArrayCollection();
        $input
            ->remove($this->removeGenre(...))
            ->add($this->addGenre(...))
            ->with(EntityList::collect($this->genres))
        ;

        return $this->genres;
    }
}
