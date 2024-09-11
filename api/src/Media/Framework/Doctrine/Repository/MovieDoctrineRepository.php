<?php

declare(strict_types=1);

namespace App\Media\Framework\Doctrine\Repository;

use App\Media\Domain\Model\Movie;
use App\Media\Domain\Model\MovieId;
use App\Media\Domain\Model\MovieList;
use App\Media\Domain\Repository\MovieRepository;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;
use PlanB\Domain\Criteria\Criteria;
use PlanB\Framework\Doctrine\Criteria\DoctrineCriteriaConverter;

class MovieDoctrineRepository extends ServiceEntityRepository implements MovieRepository
{
    private DoctrineCriteriaConverter $criteriaConverter;

    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Movie::class);
        $this->criteriaConverter = new DoctrineCriteriaConverter($this, []);
    }

    public function save(Movie $movie): Movie
    {
        $this->_em->persist($movie);

        return $movie;
    }

    public function delete(MovieId $movieId): void
    {
        $movie = $this->_em->getReference(Movie::class, $movieId);
        $this->_em->remove($movie);
    }

    public function findById(MovieId $movieId): ?Movie
    {
        return $this->find($movieId);
    }

    public function match(Criteria $criteria): MovieList
    {
        $data = $this->criteriaConverter
            ->match($criteria)
            ->execute()
        ;

        return MovieList::collect($data);
    }

    public function totalItems(Criteria $criteria = null): int
    {
        return $this->criteriaConverter
            ->count($criteria ?? Criteria::empty())
            ->getSingleScalarResult()
        ;
    }
}
