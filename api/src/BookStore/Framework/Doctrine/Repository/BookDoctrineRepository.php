<?php

declare(strict_types=1);

namespace App\BookStore\Framework\Doctrine\Repository;

use App\BookStore\Domain\Model\Book;
use App\BookStore\Domain\Repository\BookRepository;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

final class BookDoctrineRepository extends ServiceEntityRepository implements BookRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Book::class);
    }

    public function save($book): Book
    {
        $this->_em->persist($book);

        return $book;
    }

    public function delete($bookId): void
    {
        $book = $this->_em->getReference(Book::class, $bookId);
        $this->_em->remove($book);
    }

    public function findById($bookId): ?Book
    {
        return $this->find($bookId);
    }
}
