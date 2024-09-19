<?php

declare(strict_types=1);

namespace App\Tests\Media\Framework\Api\State\Provider\Search;

use ApiPlatform\Metadata\Operation;
use ApiPlatform\State\ProviderInterface;
use App\Media\Application\UseCase\Search\SearchGenre;
use App\Media\Domain\Repository\GenreRepository;
use App\Media\Framework\Api\State\Provider\Search\SearchGenreProvider;
use League\Tactician\CommandBus;
use PHPUnit\Framework\TestCase;
use PlanB\Framework\Api\State\Pagination\CriteriaPaginator;
use PlanB\Framework\Testing\Traits\DoublesTrait;
use Prophecy\Argument;

/**
 * @internal
 */
final class SearchGenreProviderTest extends TestCase
{
    use DoublesTrait;

    public function test_it_creates_a_new_instance_properly()
    {
        $commandBus = $this->stub(CommandBus::class);
        $repository = $this->stub(GenreRepository::class);
        $provider = new SearchGenreProvider($commandBus, $repository);

        $this->assertInstanceOf(SearchGenreProvider::class, $provider);
        $this->assertInstanceOf(ProviderInterface::class, $provider);
    }

    public function test_it_provides_a_response_properly()
    {
        $data = $this->array()->dummy();
        $commandBus = $this->mock(CommandBus::class);
        $commandBus
            ->handle(Argument::type(SearchGenre::class))
            ->shouldBeCalledOnce()
            ->willReturn($data)
        ;

        $repository = $this->stub(GenreRepository::class);

        $operation = $this->stub(Operation::class);

        $provider = new SearchGenreProvider($commandBus->reveal(), $repository);
        $response = $provider->provide($operation);

        $this->assertInstanceOf(CriteriaPaginator::class, $response);
    }
}
