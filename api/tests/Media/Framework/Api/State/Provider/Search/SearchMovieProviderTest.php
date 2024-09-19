<?php

declare(strict_types=1);

namespace App\Tests\Media\Framework\Api\State\Provider\Search;

use ApiPlatform\Metadata\Operation;
use ApiPlatform\State\ProviderInterface;
use App\Media\Application\UseCase\Search\SearchMovie;
use App\Media\Domain\Repository\MovieRepository;
use App\Media\Framework\Api\State\Provider\Search\SearchMovieProvider;
use League\Tactician\CommandBus;
use PHPUnit\Framework\TestCase;
use PlanB\Framework\Api\State\Pagination\CriteriaPaginator;
use PlanB\Framework\Testing\Traits\DoublesTrait;
use Prophecy\Argument;

/**
 * @internal
 */
final class SearchMovieProviderTest extends TestCase
{
    use DoublesTrait;

    public function test_it_creates_a_new_instance_properly()
    {
        $commandBus = $this->stub(CommandBus::class);
        $repository = $this->stub(MovieRepository::class);
        $provider = new SearchMovieProvider($commandBus, $repository);

        $this->assertInstanceOf(SearchMovieProvider::class, $provider);
        $this->assertInstanceOf(ProviderInterface::class, $provider);
    }

    public function test_it_provides_a_response_properly()
    {
        $data = $this->array()->dummy();
        $commandBus = $this->mock(CommandBus::class);
        $commandBus
            ->handle(Argument::type(SearchMovie::class))
            ->shouldBeCalledOnce()
            ->willReturn($data)
        ;

        $repository = $this->stub(MovieRepository::class);

        $operation = $this->stub(Operation::class);

        $provider = new SearchMovieProvider($commandBus->reveal(), $repository);
        $response = $provider->provide($operation);

        $this->assertInstanceOf(CriteriaPaginator::class, $response);
    }
}
