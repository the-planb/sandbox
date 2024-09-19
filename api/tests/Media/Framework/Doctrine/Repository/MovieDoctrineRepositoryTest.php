<?php

declare(strict_types=1);

namespace App\Tests\Media\Framework\Doctrine\Repository;

use App\Media\Domain\Model\Movie;
use App\Media\Domain\Model\MovieList;
use App\Media\Framework\Doctrine\Repository\MovieDoctrineRepository;
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
final class MovieDoctrineRepositoryTest extends TestCase
{
    use DoublesTrait;

    public function test_it_creates_a_new_instance_properly()
    {
        $manager = $this->dummy(ManagerRegistry::class);

        $repository = new MovieDoctrineRepository($manager);
        $this->assertInstanceOf(MovieDoctrineRepository::class, $repository);
    }

    public function test_it_saves_an_entity_properly()
    {
        $movie = $this->dummy(Movie::class);

        $manager = $this->createDouble(ManagerRegistryDouble::class)
            ->withEntityClass(Movie::class)
            ->persists($movie)
            ->reveal()
        ;

        $repository = new MovieDoctrineRepository($manager);
        $repository->save($movie);
    }

    public function test_it_deletes_an_entity_properly()
    {
        $movie = $this->stub(Movie::class);

        $manager = $this->createDouble(ManagerRegistryDouble::class)
            ->withEntityClass(Movie::class)
            ->remove($movie)
            ->reveal()
        ;

        $repository = new MovieDoctrineRepository($manager);
        $repository->delete($movie->getId());
    }

    public function test_it_finds_an_entity_properly()
    {
        $movie = $this->stub(Movie::class);

        $manager = $this->createDouble(ManagerRegistryDouble::class)
            ->withEntityClass(Movie::class)
            ->withReference($movie->getId(), $movie)
            ->reveal()
        ;

        $repository = new MovieDoctrineRepository($manager);
        $this->assertSame($movie, $repository->findById($movie->getId()));
    }

    public function test_it_searches_entities_properly()
    {
        $criteria = $this->stub(Criteria::class, [
            'getFilters' => FilterList::collect(),
            'getOrder' => new Order(),
        ]);

        $manager = $this->createDouble(ManagerRegistryDouble::class)
            ->withEntityClass(Movie::class)
            ->reveal()
        ;

        $repository = new MovieDoctrineRepository($manager);
        $this->assertInstanceOf(MovieList::class, $repository->match($criteria));
    }

    public function test_it_calcules_the_total_items_properly()
    {
        $totalItems = $this->integer()->nonNegative();

        $criteria = $this->stub(Criteria::class, [
            'getFilters' => FilterList::collect(),
            'getOrder' => new Order(),
        ]);

        $manager = $this->createDouble(ManagerRegistryDouble::class)
            ->withEntityClass(Movie::class)
            ->totalItems($totalItems)
            ->reveal()
        ;

        $repository = new MovieDoctrineRepository($manager);
        $this->assertSame($totalItems, $repository->totalItems($criteria));
    }
}
