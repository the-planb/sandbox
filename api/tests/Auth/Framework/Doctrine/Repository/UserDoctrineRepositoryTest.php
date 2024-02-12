<?php

declare(strict_types=1);

namespace App\Tests\Auth\Framework\Doctrine\Repository;

use App\Auth\Domain\Model\User;
use App\Auth\Framework\Doctrine\Repository\UserDoctrineRepository;
use App\Tests\Auth\Doubles\AuthTrait;
use PHPUnit\Framework\TestCase;
use PlanB\Domain\Criteria\Criteria;
use PlanB\Framework\Testing\ManagerRegistryDouble;

/**
 * @internal
 */
class UserDoctrineRepositoryTest extends TestCase
{
    use AuthTrait;

    public function test_it_persist_properly()
    {
        $user = $this->doubleUser();
        $managerRegistry = $this->doubleManagerRegistry(function (ManagerRegistryDouble $double) use ($user) {
            $double->withEntityClass(User::class);
            $double->persists($user);
        });

        $repository = new UserDoctrineRepository($managerRegistry);
        $repository->save($user);
    }

    public function test_it_delete_properly()
    {
        $user = $this->doubleUser();

        $managerRegistry = $this->doubleManagerRegistry(function (ManagerRegistryDouble $double) use ($user) {
            $double->withEntityClass(User::class);
            $double->remove($user);
        });

        $repository = new UserDoctrineRepository($managerRegistry);
        $repository->delete($user->getId());
    }

    public function test_it_find_by_id_properly()
    {
        $user = $this->doubleUser();

        $managerRegistry = $this->doubleManagerRegistry(function (ManagerRegistryDouble $double) use ($user) {
            $double->withEntityClass(User::class);
            $double->withReference($user->getId(), $user);
        });

        $repository = new UserDoctrineRepository($managerRegistry);
        $this->assertSame($user, $repository->findById($user->getId()));
    }

    public function test_it_matchs_results_by_criteria()
    {
        $managerRegistry = $this->doubleManagerRegistry(function (ManagerRegistryDouble $double) {
            $double->withEntityClass(User::class);
            $double->execute([
                $this->doubleUser(),
                $this->doubleUser(),
            ]);
        });

        $criteria = Criteria::fromValues([]);
        $repository = new UserDoctrineRepository($managerRegistry);
        $this->assertCount(2, $repository->match($criteria));
    }

    public function test_it_gets_the_total_number_of_items_by_criteria()
    {
        $managerRegistry = $this->doubleManagerRegistry(function (ManagerRegistryDouble $double) {
            $double->withEntityClass(User::class);
            $double->totalItems(4);
        });

        $repository = new UserDoctrineRepository($managerRegistry);
        $this->assertEquals(4, $repository->totalItems());
    }
}
