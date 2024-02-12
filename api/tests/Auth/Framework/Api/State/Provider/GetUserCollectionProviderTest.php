<?php

declare(strict_types=1);

namespace App\Tests\Auth\Framework\Api\State\Provider;

use ApiPlatform\Metadata\Operation;
use App\Auth\Application\UseCase\Search\SearchUser;
use App\Auth\Domain\Repository\UserRepository;
use App\Auth\Framework\Api\State\Provider\GetUserCollectionProvider;
use League\Tactician\CommandBus;
use PHPUnit\Framework\TestCase;
use PlanB\Domain\Criteria\Criteria;
use PlanB\Framework\Api\State\Pagination\CriteriaPaginator;
use Prophecy\Argument;
use Prophecy\PhpUnit\ProphecyTrait;

/**
 * @internal
 */
class GetUserCollectionProviderTest extends TestCase
{
    use ProphecyTrait;

    public function test_it_launchs_the_correct_command()
    {
        $operation = $this->prophesize(Operation::class);
        $repository = $this->prophesize(UserRepository::class);
        $repository->totalItems(Argument::type(Criteria::class))
            ->willReturn(100)
        ;

        $commandBus = $this->prophesize(CommandBus::class);

        $commandBus->handle(Argument::type(SearchUser::class))
            ->willReturn([])
            ->shouldBeCalledOnce()
        ;

        $provider = new GetUserCollectionProvider($commandBus->reveal(), $repository->reveal());
        $paginator = $provider->provide($operation->reveal());

        $this->assertInstanceOf(CriteriaPaginator::class, $paginator);
    }
}
