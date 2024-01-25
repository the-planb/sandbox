<?php

declare(strict_types=1);

namespace App\Tests\Music\Application\UseCase\Search;

use App\Music\Application\UseCase\Search\SearchDisco;
use App\Music\Application\UseCase\Search\SearchDiscoUseCase;
use App\Music\Domain\Repository\DiscoRepository;
use App\Tests\Music\Doubles\MusicTrait;
use PHPUnit\Framework\TestCase;
use PlanB\Domain\Criteria\Criteria;

/**
 * @internal
 */
class SearchDiscoUseCaseTest extends TestCase
{
    use MusicTrait;

    public function test_it_execute_the_command_properly()
    {
        $criteria = Criteria::empty();
        $repository = $this->prophesize(DiscoRepository::class);

        $repository->match($criteria)
            ->willReturn($this->doubleDiscoList())
            ->shouldBeCalledOnce()
        ;

        $command = new SearchDisco($criteria);
        $useCase = new SearchDiscoUseCase($repository->reveal());

        $useCase($command);
    }
}
