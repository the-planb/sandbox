<?php

declare(strict_types=1);

namespace App\Auth\Framework\Doctrine\Repository;

use App\Auth\Domain\Model\User;
use App\Auth\Domain\Model\UserId;
use App\Auth\Domain\Model\UserList;
use App\Auth\Domain\Repository\UserRepository;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;
use PlanB\Domain\Criteria\Criteria;
use PlanB\Framework\Doctrine\Criteria\DoctrineCriteriaConverter;
use Symfony\Bridge\Doctrine\Security\User\UserLoaderInterface;
use Symfony\Component\Security\Core\User\UserInterface;

final class UserDoctrineRepository extends ServiceEntityRepository implements UserRepository, UserLoaderInterface
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
        return $this->find($userId);
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

    public function loadUserByIdentifier(string $identifier): ?UserInterface
    {
        $entityManager = $this->getEntityManager();

        return $entityManager->createQuery(
            'SELECT u
                FROM App\Auth\Domain\Model\User u
                WHERE u.name = :query
                OR u.email = :query'
        )
            ->setParameter('query', $identifier)
            ->getOneOrNullResult()
        ;
    }
}
