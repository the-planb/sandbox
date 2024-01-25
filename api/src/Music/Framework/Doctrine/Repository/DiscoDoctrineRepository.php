<?php

declare(strict_types=1);

namespace App\Music\Framework\Doctrine\Repository;

use App\Music\Domain\Model\Disco;
use App\Music\Domain\Model\DiscoId;
use App\Music\Domain\Model\DiscoList;
use App\Music\Domain\Repository\DiscoRepository;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;
use PlanB\Domain\Criteria\Criteria;
use PlanB\Framework\Doctrine\Criteria\DoctrineCriteriaConverter;

final class DiscoDoctrineRepository extends ServiceEntityRepository implements DiscoRepository
{
    private DoctrineCriteriaConverter $criteriaConverter;

    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Disco::class);
        $this->criteriaConverter = new DoctrineCriteriaConverter($this, [
        ]);
    }

    public function save(Disco $disco): Disco
    {
        $this->_em->persist($disco);

        return $disco;
    }

    public function delete(DiscoId $discoId): void
    {
        $disco = $this->_em->getReference(Disco::class, $discoId);
        $this->_em->remove($disco);
    }

    public function findById(DiscoId $discoId): ?Disco
    {
        $disco = $this->find($discoId);
        assert($disco instanceof Disco || is_null($disco));

        return $disco;
    }

    public function match(Criteria $criteria): DiscoList
    {
        $data = $this->criteriaConverter
            ->match($criteria)
            ->execute()
        ;

        return DiscoList::collect($data);
    }

    public function totalItems(Criteria $criteria = null): int
    {
        return $this->criteriaConverter
            ->count($criteria ?? Criteria::empty())
            ->getSingleScalarResult()
        ;
    }
}
