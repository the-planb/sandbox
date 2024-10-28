<?php

declare(strict_types=1);

namespace App\Media\Domain\Model;

use App\Media\Domain\Input\GenreListInput;
use App\Media\Domain\Input\ReviewListInput;
use App\Media\Domain\Model\VO\Classification;
use App\Media\Domain\Model\VO\MovieTitle;
use App\Media\Domain\Model\VO\Overview;
use App\Media\Domain\Model\VO\ReleaseYear;
use App\Media\Domain\Model\VO\ReviewContent;
use App\Media\Domain\Model\VO\Score;
use App\Media\Domain\Service\RateCalculator;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use PlanB\Domain\Model\Entity;

class Movie implements Entity
{
	private MovieId $id;
	private MovieTitle $title;
	private ReleaseYear $releaseYear;
	private Director $director;
	private Collection $reviews;
	private Collection $genres;
	private Overview $overview;
	private Classification $classification;
	private Score $raw;
	private Score $koko;

	public function __construct(MovieTitle $title, ReleaseYear $releaseYear, Director $director, ReviewListInput $reviews, GenreListInput $genres, Overview $overview, Classification $classification)
	{
		$this->id = new MovieId();
		$this->reviews = new ArrayCollection();
		$this->genres = new ArrayCollection();

		$this->init($title, $releaseYear, $director, $reviews, $genres, $overview, $classification);
		// lanzar evento
	}

	public function update(MovieTitle $title, ReleaseYear $releaseYear, Director $director, ReviewListInput $reviews, GenreListInput $genres, Overview $overview, Classification $classification): static
	{
		$this->init($title, $releaseYear, $director, $reviews, $genres, $overview, $classification);
		// lanzar evento
		return $this;
	}

	private function init(MovieTitle $title, ReleaseYear $releaseYear, Director $director, ReviewListInput $reviews, GenreListInput $genres, Overview $overview, Classification $classification): void
	{
		$this->title = $title;
		$this->releaseYear = $releaseYear;
		$this->director = $director;
		$this->overview = $overview;
		$this->classification = $classification;
		$this->manageReviews($reviews);
		$this->manageGenres($genres);
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

	public function getReviews(): ReviewList
	{
		return ReviewList::collect($this->reviews);
	}

	private function manageReviews(ReviewListInput $input): void
	{
		$this->reviews ??= new ArrayCollection();
		$input
			->remove($this->removeReview(...))
			->add($this->addReview(...))
			->with($this->reviews)
		;
	}

	public function addReview(ReviewContent $review, Score $score): static
	{
		$review = new Review($review, $score, $this);
		$this->reviews->add($review);
		// lanzar evento
		return $this;
	}

	public function removeReview(Review $review): static
	{
		if ($this->reviews->contains($review)) {
			$this->reviews->removeElement($review);
			// lanzar evento
		}

		return $this;
	}

	public function getGenres(): GenreList
	{
		return GenreList::collect($this->genres);
	}

	private function manageGenres(GenreListInput $input): void
	{
		$this->genres ??= new ArrayCollection();
		$input
			->remove($this->removeGenre(...))
			->add($this->addGenre(...))
			->with($this->genres)
		;
	}

	public function addGenre(Genre $genre): static
	{
		if (!$this->genres->contains($genre)) {
			$this->genres->add($genre);
			// lanzar evento
		}

		return $this;
	}

	public function removeGenre(Genre $genre): static
	{
		if ($this->genres->contains($genre)) {
			$this->genres->removeElement($genre);
			// lanzar evento
		}

		return $this;
	}

	public function getOverview(): Overview
	{
		return $this->overview;
	}

	public function getClassification(): Classification
	{
		return $this->classification;
	}

	public function getRaw(): Score
	{
		return $this->raw;
	}

	public function getKoko(): Score
	{
		return $this->koko;
	}

	public function updateScore(Score $raw, RateCalculator $rateCalculator): static
	{
		$this->raw = $raw;
		$this->koko = $rateCalculator($raw);

		return $this;
	}
}
