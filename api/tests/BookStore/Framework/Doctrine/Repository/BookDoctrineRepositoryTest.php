<?php

declare(strict_types=1);

namespace App\Tests\BookStore\Framework\Doctrine\Repository;

use App\BookStore\Domain\Model\Book;
use App\BookStore\Framework\Doctrine\Repository\BookDoctrineRepository;
use App\Tests\BookStore\Doubles\BookStoreTrait;
use PHPUnit\Framework\TestCase;
use PlanB\Domain\Criteria\Criteria;
use PlanB\Framework\Testing\ManagerRegistryDouble;

/**
 * @internal
 */
class BookDoctrineRepositoryTest extends TestCase
{
    use BookStoreTrait;

    public function test_it_persist_properly()
    {
        $book = $this->doubleBook();
        $managerRegistry = $this->doubleManagerRegistry(function (ManagerRegistryDouble $double) use ($book) {
            $double->withEntityClass(Book::class);
            $double->persists($book);
        });

        $repository = new BookDoctrineRepository($managerRegistry);
        $repository->save($book);
    }

    public function test_it_delete_properly()
    {
        $book = $this->doubleBook();

        $managerRegistry = $this->doubleManagerRegistry(function (ManagerRegistryDouble $double) use ($book) {
            $double->withEntityClass(Book::class);
            $double->remove($book);
        });

        $repository = new BookDoctrineRepository($managerRegistry);
        $repository->delete($book->getId());
    }

    public function test_it_find_by_id_properly()
    {
        $book = $this->doubleBook();

        $managerRegistry = $this->doubleManagerRegistry(function (ManagerRegistryDouble $double) use ($book) {
            $double->withEntityClass(Book::class);
            $double->withReference($book->getId(), $book);
        });

        $repository = new BookDoctrineRepository($managerRegistry);
        $this->assertSame($book, $repository->findById($book->getId()));
    }

    public function test_it_matchs_results_by_criteria()
    {
        $managerRegistry = $this->doubleManagerRegistry(function (ManagerRegistryDouble $double) {
            $double->withEntityClass(Book::class);
            $double->execute([
                $this->doubleBook(),
                $this->doubleBook(),
            ]);
        });

        $criteria = Criteria::fromValues([]);
        $repository = new BookDoctrineRepository($managerRegistry);
        $this->assertCount(2, $repository->match($criteria));
    }

    public function test_it_gets_the_total_number_of_items_by_criteria()
    {
        $managerRegistry = $this->doubleManagerRegistry(function (ManagerRegistryDouble $double) {
            $double->withEntityClass(Book::class);
            $double->totalItems(4);
        });

        $repository = new BookDoctrineRepository($managerRegistry);
        $this->assertEquals(4, $repository->totalItems());
    }
}
