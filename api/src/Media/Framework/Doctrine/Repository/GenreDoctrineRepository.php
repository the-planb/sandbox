<?php

declare(strict_types=1);

namespace App\Media\Framework\Doctrine\Repository;

use App\Media\Domain\Model\Genre;
use App\Media\Domain\Model\GenreId;
use App\Media\Domain\Model\GenreList;
use App\Media\Domain\Repository\GenreRepository;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;
use PlanB\Domain\Criteria\Criteria;
use PlanB\Framework\Doctrine\Criteria\DoctrineCriteriaConverter;

final class GenreDoctrineRepository extends ServiceEntityRepository implements GenreRepository
{
	private DoctrineCriteriaConverter $criteriaConverter;

	public function __construct(ManagerRegistry $registry)
	{
		parent::__construct($registry, Genre::class);
		$this->criteriaConverter = new DoctrineCriteriaConverter($this, [
		]);
	}

	public function save(Genre $genre): Genre
	{
		$this->_em->persist($genre);

		return $genre;
	}

	public function delete(GenreId $genreId): void
	{
		$genre = $this->_em->getReference(Genre::class, $genreId);
		$this->_em->remove($genre);
	}

	public function findById(GenreId $genreId): ?Genre
	{
		return $this->find($genreId);
	}

	public function match(Criteria $criteria): GenreList
	{
		$data = $this->criteriaConverter
			->match($criteria)
			->execute()
		;

		return GenreList::collect($data);
	}

	public function totalItems(Criteria $criteria = null): int
	{
		return $this->criteriaConverter
			->count($criteria ?? Criteria::empty())
			->getSingleScalarResult()
		;
	}
}
