<?php

declare(strict_types=1);

namespace App\Tests\Media\Framework\Doctrine\Repository;

use App\Media\Domain\Model\Genre;
use App\Media\Domain\Model\GenreList;
use App\Media\Framework\Doctrine\Repository\GenreDoctrineRepository;
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
final class GenreDoctrineRepositoryTest extends TestCase
{
    use DoublesTrait;

    public function test_it_creates_a_new_instance_properly()
    {
        $manager = $this->dummy(ManagerRegistry::class);

        $repository = new GenreDoctrineRepository($manager);
        $this->assertInstanceOf(GenreDoctrineRepository::class, $repository);
    }

    public function test_it_saves_an_entity_properly()
    {
        $genre = $this->dummy(Genre::class);

        $manager = $this->createDouble(ManagerRegistryDouble::class)
            ->withEntityClass(Genre::class)
            ->persists($genre)
            ->reveal()
        ;

        $repository = new GenreDoctrineRepository($manager);
        $repository->save($genre);
    }

    public function test_it_deletes_an_entity_properly()
    {
        $genre = $this->stub(Genre::class);

        $manager = $this->createDouble(ManagerRegistryDouble::class)
            ->withEntityClass(Genre::class)
            ->remove($genre)
            ->reveal()
        ;

        $repository = new GenreDoctrineRepository($manager);
        $repository->delete($genre->getId());
    }

    public function test_it_finds_an_entity_properly()
    {
        $genre = $this->stub(Genre::class);

        $manager = $this->createDouble(ManagerRegistryDouble::class)
            ->withEntityClass(Genre::class)
            ->withReference($genre->getId(), $genre)
            ->reveal()
        ;

        $repository = new GenreDoctrineRepository($manager);
        $this->assertSame($genre, $repository->findById($genre->getId()));
    }

    public function test_it_searches_entities_properly()
    {
        $criteria = $this->stub(Criteria::class, [
            'getFilters' => FilterList::collect(),
            'getOrder' => new Order(),
        ]);

        $manager = $this->createDouble(ManagerRegistryDouble::class)
            ->withEntityClass(Genre::class)
            ->reveal()
        ;

        $repository = new GenreDoctrineRepository($manager);
        $this->assertInstanceOf(GenreList::class, $repository->match($criteria));
    }

    public function test_it_calcules_the_total_items_properly()
    {
        $totalItems = $this->integer()->nonNegative();

        $criteria = $this->stub(Criteria::class, [
            'getFilters' => FilterList::collect(),
            'getOrder' => new Order(),
        ]);

        $manager = $this->createDouble(ManagerRegistryDouble::class)
            ->withEntityClass(Genre::class)
            ->totalItems($totalItems)
            ->reveal()
        ;

        $repository = new GenreDoctrineRepository($manager);
        $this->assertSame($totalItems, $repository->totalItems($criteria));
    }
}
