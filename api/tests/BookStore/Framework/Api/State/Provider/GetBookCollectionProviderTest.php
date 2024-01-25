<?php

declare(strict_types=1);

namespace App\Tests\BookStore\Framework\Api\State\Provider;

use ApiPlatform\Metadata\Operation;
use App\BookStore\Application\UseCase\Search\SearchBook;
use App\BookStore\Domain\Repository\BookRepository;
use App\BookStore\Framework\Api\State\Provider\GetBookCollectionProvider;
use League\Tactician\CommandBus;
use PHPUnit\Framework\TestCase;
use PlanB\Domain\Criteria\Criteria;
use PlanB\Framework\Api\State\Pagination\CriteriaPaginator;
use Prophecy\Argument;
use Prophecy\PhpUnit\ProphecyTrait;

/**
 * @internal
 */
class GetBookCollectionProviderTest extends TestCase
{
    use ProphecyTrait;

    public function test_it_launchs_the_correct_command()
    {
        $operation = $this->prophesize(Operation::class);
        $repository = $this->prophesize(BookRepository::class);
        $repository->totalItems(Argument::type(Criteria::class))
            ->willReturn(100)
        ;

        $commandBus = $this->prophesize(CommandBus::class);

        $commandBus->handle(Argument::type(SearchBook::class))
            ->willReturn([])
            ->shouldBeCalledOnce()
        ;

        $provider = new GetBookCollectionProvider($commandBus->reveal(), $repository->reveal());
        $paginator = $provider->provide($operation->reveal());

        $this->assertInstanceOf(CriteriaPaginator::class, $paginator);
    }
}
