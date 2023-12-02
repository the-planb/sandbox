<?php

declare(strict_types=1);

namespace App\BookStore\Framework\Doctrine\Repository;

use App\BookStore\Domain\Model\Author;
use App\BookStore\Domain\Model\AuthorId;
use App\BookStore\Domain\Model\AuthorList;
use App\BookStore\Domain\Repository\AuthorRepository;
use App\BookStore\Framework\Doctrine\Filter\FullNameFilter;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;
use PlanB\Domain\Criteria\Criteria;
use PlanB\Framework\Doctrine\Criteria\DoctrineCriteriaConverter;

final class AuthorDoctrineRepository extends ServiceEntityRepository implements AuthorRepository
{
    private DoctrineCriteriaConverter $criteriaConverter;

    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Author::class);
        $this->criteriaConverter = new DoctrineCriteriaConverter($this, [
            'name' => new FullNameFilter(),
        ]);
    }

    public function save(Author $author): Author
    {
        $this->_em->persist($author);

        return $author;
    }

    public function delete(AuthorId $authorId): void
    {
        $author = $this->_em->getReference(Author::class, $authorId);
        $this->_em->remove($author);
    }

    public function findById(AuthorId $authorId): ?Author
    {
        $author = $this->find($authorId);
        assert($author instanceof Author || is_null($author));

        return $author;
    }

    public function match(Criteria $criteria): AuthorList
    {
        $data = $this->criteriaConverter
            ->match($criteria)
            ->execute()
        ;

        return AuthorList::collect($data);
    }

    public function totalItems(Criteria $criteria = null): int
    {
        return $this->criteriaConverter
            ->count($criteria)
            ->getSingleScalarResult()
        ;
    }
}
