<?php

declare(strict_types=1);

namespace App\Tests\Media\Application\UseCase\Search;

use App\Media\Application\UseCase\Search\SearchGenre;
use App\Media\Application\UseCase\Search\SearchGenreUseCase;
use App\Media\Domain\Model\GenreList;
use App\Media\Domain\Repository\GenreRepository;
use PHPUnit\Framework\TestCase;
use PlanB\Domain\Criteria\Criteria;
use PlanB\Framework\Testing\Traits\DoublesTrait;
use PlanB\UseCase\UseCaseInterface;
use Prophecy\Argument;

/**
 * @internal
 */
final class SearchGenreUseCaseTest extends TestCase
{
    use DoublesTrait;

    public function test_it_creates_a_new_instance_properly()
    {
        $repository = $this->stub(GenreRepository::class);
        $useCase = new SearchGenreUseCase($repository);

        $this->assertInstanceOf(SearchGenreUseCase::class, $useCase);
        $this->assertInstanceOf(UseCaseInterface::class, $useCase);
    }

    public function test_it_searchs_an_existing_genre_properly()
    {
        $command = $this->commandDummy();

        $repository = $this->mock(GenreRepository::class);
        $repository->match(Argument::type(Criteria::class))
            ->shouldBeCalled()
            ->willReturn(GenreList::collect())
        ;
        $repository = $repository->reveal();

        $useCase = new SearchGenreUseCase($repository);
        $useCase->__invoke($command);
    }

    public function commandDummy(): SearchGenre
    {
        $criteria = $this->dummy(Criteria::class);

        return new SearchGenre($criteria);
    }
}
