<?php

declare(strict_types=1);

namespace App\Tests\Media\Framework\Doctrine\Repository;

use App\Media\Domain\Model\Director;
use App\Media\Domain\Model\DirectorList;
use App\Media\Framework\Doctrine\Repository\DirectorDoctrineRepository;
use Doctrine\Persistence\ManagerRegistry;
use PHPUnit\Framework\TestCase;
use PlanB\Domain\Criteria\Criteria;
use PlanB\Domain\Criteria\FilterList;
use PlanB\Domain\Criteria\Order;
use PlanB\Framework\Testing\ManagerRegistryDouble;
use PlanB\Framework\Testing\Traits\DoublesTrait;

/**
 * @internal
 */
final class DirectorDoctrineRepositoryTest extends TestCase
{
    use DoublesTrait;

    public function test_it_creates_a_new_instance_properly()
    {
        $manager = $this->dummy(ManagerRegistry::class);

        $repository = new DirectorDoctrineRepository($manager);
        $this->assertInstanceOf(DirectorDoctrineRepository::class, $repository);
    }

    public function test_it_saves_an_entity_properly()
    {
        $director = $this->dummy(Director::class);

        $manager = $this->createDouble(ManagerRegistryDouble::class)
            ->withEntityClass(Director::class)
            ->persists($director)
            ->reveal()
        ;

        $repository = new DirectorDoctrineRepository($manager);
        $repository->save($director);
    }

    public function test_it_deletes_an_entity_properly()
    {
        $director = $this->stub(Director::class);

        $manager = $this->createDouble(ManagerRegistryDouble::class)
            ->withEntityClass(Director::class)
            ->remove($director)
            ->reveal()
        ;

        $repository = new DirectorDoctrineRepository($manager);
        $repository->delete($director->getId());
    }

    public function test_it_finds_an_entity_properly()
    {
        $director = $this->stub(Director::class);

        $manager = $this->createDouble(ManagerRegistryDouble::class)
            ->withEntityClass(Director::class)
            ->withReference($director->getId(), $director)
            ->reveal()
        ;

        $repository = new DirectorDoctrineRepository($manager);
        $this->assertSame($director, $repository->findById($director->getId()));
    }

    public function test_it_searches_entities_properly()
    {
        $criteria = $this->stub(Criteria::class, [
            'getFilters' => FilterList::collect(),
            'getOrder' => new Order(),
        ]);

        $manager = $this->createDouble(ManagerRegistryDouble::class)
            ->withEntityClass(Director::class)
            ->reveal()
        ;

        $repository = new DirectorDoctrineRepository($manager);
        $this->assertInstanceOf(DirectorList::class, $repository->match($criteria));
    }

    public function test_it_calcules_the_total_items_properly()
    {
        $totalItems = $this->integer()->nonNegative();

        $criteria = $this->stub(Criteria::class, [
            'getFilters' => FilterList::collect(),
            'getOrder' => new Order(),
        ]);

        $manager = $this->createDouble(ManagerRegistryDouble::class)
            ->withEntityClass(Director::class)
            ->totalItems($totalItems)
            ->reveal()
        ;

        $repository = new DirectorDoctrineRepository($manager);
        $this->assertSame($totalItems, $repository->totalItems($criteria));
    }
}
