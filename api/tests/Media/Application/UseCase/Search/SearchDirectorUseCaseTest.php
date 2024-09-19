<?php

declare(strict_types=1);

namespace App\Tests\Media\Application\UseCase\Search;

use App\Media\Application\UseCase\Search\SearchDirector;
use App\Media\Application\UseCase\Search\SearchDirectorUseCase;
use App\Media\Domain\Model\DirectorList;
use App\Media\Domain\Repository\DirectorRepository;
use PHPUnit\Framework\TestCase;
use PlanB\Domain\Criteria\Criteria;
use PlanB\Framework\Testing\Traits\DoublesTrait;
use PlanB\UseCase\UseCaseInterface;
use Prophecy\Argument;

/**
 * @internal
 */
final class SearchDirectorUseCaseTest extends TestCase
{
    use DoublesTrait;

    public function test_it_creates_a_new_instance_properly()
    {
        $repository = $this->stub(DirectorRepository::class);
        $useCase = new SearchDirectorUseCase($repository);

        $this->assertInstanceOf(SearchDirectorUseCase::class, $useCase);
        $this->assertInstanceOf(UseCaseInterface::class, $useCase);
    }

    public function test_it_searchs_an_existing_director_properly()
    {
        $command = $this->commandDummy();

        $repository = $this->mock(DirectorRepository::class);
        $repository->match(Argument::type(Criteria::class))
            ->shouldBeCalled()
            ->willReturn(DirectorList::collect())
        ;
        $repository = $repository->reveal();

        $useCase = new SearchDirectorUseCase($repository);
        $useCase->__invoke($command);
    }

    public function commandDummy(): SearchDirector
    {
        $criteria = $this->dummy(Criteria::class);

        return new SearchDirector($criteria);
    }
}
