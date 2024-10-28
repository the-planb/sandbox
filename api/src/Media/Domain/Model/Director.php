<?php

declare(strict_types=1);

namespace App\Media\Domain\Model;

use App\Media\Domain\Model\VO\FullName;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use PlanB\Domain\Model\Entity;

class Director implements Entity
{
	private DirectorId $id;
	private FullName $name;
	private Collection $movies;

	public function __construct(FullName $name)
	{
		$this->id = new DirectorId();
		$this->movies = new ArrayCollection();

		$this->init($name);
		// lanzar evento
	}

	public function update(FullName $name): static
	{
		$this->init($name);
		// lanzar evento
		return $this;
	}

	private function init(FullName $name): void
	{
		$this->name = $name;
	}

	public function getId(): DirectorId
	{
		return $this->id;
	}

	public function getName(): FullName
	{
		return $this->name;
	}

	public function getMovies(): MovieList
	{
		return MovieList::collect($this->movies);
	}
}
