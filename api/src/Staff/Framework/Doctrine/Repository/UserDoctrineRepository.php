<?php

declare(strict_types=1);

namespace App\Staff\Framework\Doctrine\Repository;

use App\Staff\Domain\Model\User;
use App\Staff\Domain\Model\UserId;
use App\Staff\Domain\Model\UserList;
use App\Staff\Domain\Repository\UserRepository;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;
use PlanB\Domain\Criteria\Criteria;
use PlanB\Framework\Doctrine\Criteria\DoctrineCriteriaConverter;

final class UserDoctrineRepository extends ServiceEntityRepository implements UserRepository
{
    private DoctrineCriteriaConverter $criteriaConverter;

    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, User::class);
        $this->criteriaConverter = new DoctrineCriteriaConverter($this, [
        ]);
    }

    public function save(User $user): User
    {
        $this->_em->persist($user);

        return $user;
    }

    public function delete(UserId $userId): void
    {
        $user = $this->_em->getReference(User::class, $userId);
        $this->_em->remove($user);
    }

    public function findById(UserId $userId): ?User
    {
        $user = $this->find($userId);
        assert($user instanceof User || is_null($user));

        return $user;
    }

    public function match(Criteria $criteria): UserList
    {
        $data = $this->criteriaConverter
            ->match($criteria)
            ->execute()
        ;

        return UserList::collect($data);
    }

    public function totalItems(Criteria $criteria = null): int
    {
        return $this->criteriaConverter
            ->count($criteria ?? Criteria::empty())
            ->getSingleScalarResult()
        ;
    }
}
