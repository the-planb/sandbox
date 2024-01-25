<?php

declare(strict_types=1);

namespace App\Tests\Music\Framework\Doctrine\Repository;

use App\Music\Domain\Model\Disco;
use App\Music\Framework\Doctrine\Repository\DiscoDoctrineRepository;
use App\Tests\Music\Doubles\MusicTrait;
use PHPUnit\Framework\TestCase;
use PlanB\Domain\Criteria\Criteria;
use PlanB\Framework\Testing\ManagerRegistryDouble;

/**
 * @internal
 */
class DiscoDoctrineRepositoryTest extends TestCase
{
    use MusicTrait;

    public function test_it_persist_properly()
    {
        $disco = $this->doubleDisco();
        $managerRegistry = $this->doubleManagerRegistry(function (ManagerRegistryDouble $double) use ($disco) {
            $double->withEntityClass(Disco::class);
            $double->persists($disco);
        });

        $repository = new DiscoDoctrineRepository($managerRegistry);
        $repository->save($disco);
    }

    public function test_it_delete_properly()
    {
        $disco = $this->doubleDisco();

        $managerRegistry = $this->doubleManagerRegistry(function (ManagerRegistryDouble $double) use ($disco) {
            $double->withEntityClass(Disco::class);
            $double->remove($disco);
        });

        $repository = new DiscoDoctrineRepository($managerRegistry);
        $repository->delete($disco->getId());
    }

    public function test_it_find_by_id_properly()
    {
        $disco = $this->doubleDisco();

        $managerRegistry = $this->doubleManagerRegistry(function (ManagerRegistryDouble $double) use ($disco) {
            $double->withEntityClass(Disco::class);
            $double->withReference($disco->getId(), $disco);
        });

        $repository = new DiscoDoctrineRepository($managerRegistry);
        $this->assertSame($disco, $repository->findById($disco->getId()));
    }

    public function test_it_matchs_results_by_criteria()
    {
        $managerRegistry = $this->doubleManagerRegistry(function (ManagerRegistryDouble $double) {
            $double->withEntityClass(Disco::class);
            $double->execute([
                $this->doubleDisco(),
                $this->doubleDisco(),
            ]);
        });

        $criteria = Criteria::fromValues([]);
        $repository = new DiscoDoctrineRepository($managerRegistry);
        $this->assertCount(2, $repository->match($criteria));
    }

    public function test_it_gets_the_total_number_of_items_by_criteria()
    {
        $managerRegistry = $this->doubleManagerRegistry(function (ManagerRegistryDouble $double) {
            $double->withEntityClass(Disco::class);
            $double->totalItems(4);
        });

        $repository = new DiscoDoctrineRepository($managerRegistry);
        $this->assertEquals(4, $repository->totalItems());
    }
}
