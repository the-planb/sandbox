<?php

declare(strict_types=1);

namespace App\BookStore\Framework\Doctrine\Repository;

use App\BookStore\Domain\Model\Book;
use App\BookStore\Domain\Model\BookId;
use App\BookStore\Domain\Model\BookList;
use App\BookStore\Domain\Repository\BookRepository;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\ORM\NonUniqueResultException;
use Doctrine\ORM\NoResultException;
use Doctrine\ORM\Query\QueryException;
use Doctrine\Persistence\ManagerRegistry;
use PlanB\Domain\Criteria\Criteria;
use PlanB\Framework\Doctrine\Criteria\DoctrineCriteriaConverter;

final class BookDoctrineRepository extends ServiceEntityRepository implements BookRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Book::class);
    }

    public function save(Book $book): Book
    {
        $this->_em->persist($book);

        return $book;
    }

    public function delete(BookId $bookId): void
    {
        $book = $this->_em->getReference(Book::class, $bookId);
        $this->_em->remove($book);
    }

    public function findById(BookId $bookId): ?Book
    {
        $book = $this->find($bookId);
        assert($book instanceof Book || is_null($book));

        return $book;
    }

    public function match(Criteria $criteria): BookList
    {
        $doctrineCriteria = DoctrineCriteriaConverter::convert($criteria);
        $data = $this->matching($doctrineCriteria);

        return BookList::collect($data);
    }

    /**
     * @throws QueryException
     * @throws NonUniqueResultException
     * @throws NoResultException
     */
    public function totalItems(Criteria $criteria = null): int
    {
        $doctrineCriteria = DoctrineCriteriaConverter::convertOnlyFilters($criteria);

        $query = $this->createQueryBuilder('A')
            ->select('count(A.id)')
            ->addCriteria($doctrineCriteria)
            ->getQuery()
        ;

        return $query->getSingleScalarResult();
    }
}
