<?php

declare(strict_types=1);

namespace App\Media\Framework\Doctrine\Repository;

use App\Media\Domain\Model\Director;
use App\Media\Domain\Model\DirectorId;
use App\Media\Domain\Model\DirectorList;
use App\Media\Domain\Repository\DirectorRepository;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;
use PlanB\Domain\Criteria\Criteria;
use PlanB\Framework\Doctrine\Criteria\DoctrineCriteriaConverter;

final class DirectorDoctrineRepository extends ServiceEntityRepository implements DirectorRepository
{
    private DoctrineCriteriaConverter $criteriaConverter;

    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Director::class);
        $this->criteriaConverter = new DoctrineCriteriaConverter($this, []);
    }

    public function save(Director $director): Director
    {
        $this->_em->persist($director);

        return $director;
    }

    public function delete(DirectorId $directorId): void
    {
        $director = $this->_em->getReference(Director::class, $directorId);
        $this->_em->remove($director);
    }

    public function findById(DirectorId $directorId): ?Director
    {
        return $this->find($directorId);
    }

    public function match(Criteria $criteria): DirectorList
    {
        $data = $this->criteriaConverter
            ->match($criteria)
            ->execute()
        ;

        return DirectorList::collect($data);
    }

    public function totalItems(Criteria $criteria = null): int
    {
        return $this->criteriaConverter
            ->count($criteria ?? Criteria::empty())
            ->getSingleScalarResult()
        ;
    }
}
