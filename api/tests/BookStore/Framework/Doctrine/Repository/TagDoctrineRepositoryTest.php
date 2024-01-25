<?php

declare(strict_types=1);

namespace App\Tests\BookStore\Framework\Doctrine\Repository;

use App\BookStore\Domain\Model\Tag;
use App\BookStore\Framework\Doctrine\Repository\TagDoctrineRepository;
use App\Tests\BookStore\Doubles\BookStoreTrait;
use PHPUnit\Framework\TestCase;
use PlanB\Domain\Criteria\Criteria;
use PlanB\Framework\Testing\ManagerRegistryDouble;

/**
 * @internal
 */
class TagDoctrineRepositoryTest extends TestCase
{
    use BookStoreTrait;

    public function test_it_persist_properly()
    {
        $tag = $this->doubleTag();
        $managerRegistry = $this->doubleManagerRegistry(function (ManagerRegistryDouble $double) use ($tag) {
            $double->withEntityClass(Tag::class);
            $double->persists($tag);
        });

        $repository = new TagDoctrineRepository($managerRegistry);
        $repository->save($tag);
    }

    public function test_it_delete_properly()
    {
        $tag = $this->doubleTag();

        $managerRegistry = $this->doubleManagerRegistry(function (ManagerRegistryDouble $double) use ($tag) {
            $double->withEntityClass(Tag::class);
            $double->remove($tag);
        });

        $repository = new TagDoctrineRepository($managerRegistry);
        $repository->delete($tag->getId());
    }

    public function test_it_find_by_id_properly()
    {
        $tag = $this->doubleTag();

        $managerRegistry = $this->doubleManagerRegistry(function (ManagerRegistryDouble $double) use ($tag) {
            $double->withEntityClass(Tag::class);
            $double->withReference($tag->getId(), $tag);
        });

        $repository = new TagDoctrineRepository($managerRegistry);
        $this->assertSame($tag, $repository->findById($tag->getId()));
    }

    public function test_it_matchs_results_by_criteria()
    {
        $managerRegistry = $this->doubleManagerRegistry(function (ManagerRegistryDouble $double) {
            $double->withEntityClass(Tag::class);
            $double->execute([
                $this->doubleTag(),
                $this->doubleTag(),
            ]);
        });

        $criteria = Criteria::fromValues([]);
        $repository = new TagDoctrineRepository($managerRegistry);
        $this->assertCount(2, $repository->match($criteria));
    }

    public function test_it_gets_the_total_number_of_items_by_criteria()
    {
        $managerRegistry = $this->doubleManagerRegistry(function (ManagerRegistryDouble $double) {
            $double->withEntityClass(Tag::class);
            $double->totalItems(4);
        });

        $repository = new TagDoctrineRepository($managerRegistry);
        $this->assertEquals(4, $repository->totalItems());
    }
}
