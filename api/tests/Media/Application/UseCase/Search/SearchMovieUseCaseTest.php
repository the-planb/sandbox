<?php

declare(strict_types=1);

namespace App\Tests\Media\Application\UseCase\Search;

use App\Media\Application\UseCase\Search\SearchMovie;
use App\Media\Application\UseCase\Search\SearchMovieUseCase;
use App\Media\Domain\Model\MovieList;
use App\Media\Domain\Repository\MovieRepository;
use PHPUnit\Framework\TestCase;
use PlanB\Domain\Criteria\Criteria;
use PlanB\Framework\Testing\Traits\DoublesTrait;
use PlanB\UseCase\UseCaseInterface;
use Prophecy\Argument;

/**
 * @internal
 */
final class SearchMovieUseCaseTest extends TestCase
{
    use DoublesTrait;

    public function test_it_creates_a_new_instance_properly()
    {
        $repository = $this->stub(MovieRepository::class);
        $useCase = new SearchMovieUseCase($repository);

        $this->assertInstanceOf(SearchMovieUseCase::class, $useCase);
        $this->assertInstanceOf(UseCaseInterface::class, $useCase);
    }

    public function test_it_searchs_an_existing_movie_properly()
    {
        $command = $this->commandDummy();

        $repository = $this->mock(MovieRepository::class);
        $repository->match(Argument::type(Criteria::class))
            ->shouldBeCalled()
            ->willReturn(MovieList::collect())
        ;
        $repository = $repository->reveal();

        $useCase = new SearchMovieUseCase($repository);
        $useCase->__invoke($command);
    }

    public function commandDummy(): SearchMovie
    {
        $criteria = $this->dummy(Criteria::class);

        return new SearchMovie($criteria);
    }
}
