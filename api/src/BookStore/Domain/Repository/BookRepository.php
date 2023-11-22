<?php

declare(strict_types=1);

namespace App\BookStore\Domain\Repository;

use App\BookStore\Domain\Model\Book;
use App\BookStore\Domain\Model\BookId;
use App\BookStore\Domain\Model\BookList;
use PlanB\Domain\Criteria\Criteria;

interface BookRepository
{
    public function save(Book $book): Book;

    public function delete(BookId $bookId): void;

    public function findById(BookId $bookId): ?Book;

    public function match(Criteria $criteria): BookList;

    public function totalItems(): int;
}
