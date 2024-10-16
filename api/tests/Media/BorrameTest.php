<?php

declare(strict_types=1);

namespace App\Tests\Media;

use App\Media\Application\UseCase\Search\SearchGenre;
use App\Media\Domain\Model\Genre;
use League\Tactician\CommandBus;
use PlanB\Domain\Criteria\Criteria;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;

/**
 * @internal
 */
final class BorrameTest extends KernelTestCase
{
    public function test_it_works()
    {
        self::bootKernel();

        $criteria = Criteria::fromValues([
            'order' => [
                'id' => 'asc',
            ],
            'page' => 1,
            'itemsPerPage' => 10,
            'name' => [
                'equals' => 'comedia',
            ],
        ]);

        $container = self::getContainer();

        $commandBus = $container->get(CommandBus::class);
        $command = new SearchGenre($criteria);
        $response = $commandBus->handle($command);

        $genre = $response[0];

        $command =

        $this->assertInstanceOf(Genre::class, $genre);
    }
}
