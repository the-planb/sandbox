<?php

declare(strict_types=1);

namespace App\Tests\Music\Framework\Api\State\Provider;

use ApiPlatform\Metadata\Operation;
use App\Music\Application\UseCase\Search\SearchDisco;
use App\Music\Domain\Repository\DiscoRepository;
use App\Music\Framework\Api\State\Provider\GetDiscoCollectionProvider;
use League\Tactician\CommandBus;
use PHPUnit\Framework\TestCase;
use PlanB\Domain\Criteria\Criteria;
use PlanB\Framework\Api\State\Pagination\CriteriaPaginator;
use Prophecy\Argument;
use Prophecy\PhpUnit\ProphecyTrait;

/**
 * @internal
 */
class GetDiscoCollectionProviderTest extends TestCase
{
    use ProphecyTrait;

    public function test_it_launchs_the_correct_command()
    {
        $operation = $this->prophesize(Operation::class);
        $repository = $this->prophesize(DiscoRepository::class);
        $repository->totalItems(Argument::type(Criteria::class))
            ->willReturn(100)
        ;

        $commandBus = $this->prophesize(CommandBus::class);

        $commandBus->handle(Argument::type(SearchDisco::class))
            ->willReturn([])
            ->shouldBeCalledOnce()
        ;

        $provider = new GetDiscoCollectionProvider($commandBus->reveal(), $repository->reveal());
        $paginator = $provider->provide($operation->reveal());

        $this->assertInstanceOf(CriteriaPaginator::class, $paginator);
    }
}
