<?php

declare(strict_types=1);

namespace App\BookStore\Framework\Doctrine\Repository;

use App\BookStore\Domain\Model\Book;
use App\BookStore\Domain\Model\BookId;
use App\BookStore\Domain\Model\BookList;
use App\BookStore\Domain\Repository\BookRepository;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;
use PlanB\Domain\Criteria\Criteria;
use PlanB\Framework\Doctrine\Criteria\DoctrineCriteriaConverter;

final class BookDoctrineRepository extends ServiceEntityRepository implements BookRepository
{
    private DoctrineCriteriaConverter $criteriaConverter;

    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Book::class);
        $this->criteriaConverter = new DoctrineCriteriaConverter($this, [
        ]);
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
        $data = $this->criteriaConverter
            ->match($criteria)
            ->execute()
        ;

        return BookList::collect($data);
    }

    public function totalItems(Criteria $criteria = null): int
    {
        return $this->criteriaConverter
            ->count($criteria)
            ->getSingleScalarResult()
        ;
    }
}
