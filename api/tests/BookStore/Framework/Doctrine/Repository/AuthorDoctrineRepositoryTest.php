<?php

declare(strict_types=1);

namespace App\Tests\BookStore\Framework\Doctrine\Repository;

use App\BookStore\Domain\Model\Author;
use App\BookStore\Framework\Doctrine\Repository\AuthorDoctrineRepository;
use App\Tests\BookStore\Doubles\BookStoreTrait;
use PHPUnit\Framework\TestCase;
use PlanB\Domain\Criteria\Criteria;
use PlanB\Framework\Testing\ManagerRegistryDouble;

/**
 * @internal
 */
class AuthorDoctrineRepositoryTest extends TestCase
{
    use BookStoreTrait;

    public function test_it_persist_properly()
    {
        $author = $this->doubleAuthor();
        $managerRegistry = $this->doubleManagerRegistry(function (ManagerRegistryDouble $double) use ($author) {
            $double->withEntityClass(Author::class);
            $double->persists($author);
        });

        $repository = new AuthorDoctrineRepository($managerRegistry);
        $repository->save($author);
    }

    public function test_it_delete_properly()
    {
        $author = $this->doubleAuthor();

        $managerRegistry = $this->doubleManagerRegistry(function (ManagerRegistryDouble $double) use ($author) {
            $double->withEntityClass(Author::class);
            $double->remove($author);
        });

        $repository = new AuthorDoctrineRepository($managerRegistry);
        $repository->delete($author->getId());
    }

    public function test_it_find_by_id_properly()
    {
        $author = $this->doubleAuthor();

        $managerRegistry = $this->doubleManagerRegistry(function (ManagerRegistryDouble $double) use ($author) {
            $double->withEntityClass(Author::class);
            $double->withReference($author->getId(), $author);
        });

        $repository = new AuthorDoctrineRepository($managerRegistry);
        $this->assertSame($author, $repository->findById($author->getId()));
    }

    public function test_it_matchs_results_by_criteria()
    {
        $managerRegistry = $this->doubleManagerRegistry(function (ManagerRegistryDouble $double) {
            $double->withEntityClass(Author::class);
            $double->execute([
                $this->doubleAuthor(),
                $this->doubleAuthor(),
            ]);
        });

        $criteria = Criteria::fromValues([]);
        $repository = new AuthorDoctrineRepository($managerRegistry);
        $this->assertCount(2, $repository->match($criteria));
    }

    public function test_it_gets_the_total_number_of_items_by_criteria()
    {
        $managerRegistry = $this->doubleManagerRegistry(function (ManagerRegistryDouble $double) {
            $double->withEntityClass(Author::class);
            $double->totalItems(4);
        });

        $repository = new AuthorDoctrineRepository($managerRegistry);
        $this->assertEquals(4, $repository->totalItems());
    }
}
