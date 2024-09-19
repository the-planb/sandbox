<?php

declare(strict_types=1);

namespace App\Tests\Media\Application\UseCase\FindById;

use App\Media\Application\UseCase\FindById\FindMovieById;
use App\Media\Application\UseCase\FindById\FindMovieByIdUseCase;
use App\Media\Domain\Model\MovieId;
use App\Media\Domain\Repository\MovieRepository;
use PHPUnit\Framework\TestCase;
use PlanB\Framework\Testing\Traits\DoublesTrait;
use PlanB\UseCase\UseCaseInterface;
use Prophecy\Argument;

/**
 * @internal
 */
final class FindMovieByIdUseCaseTest extends TestCase
{
    use DoublesTrait;

    public function test_it_creates_a_new_instance_properly()
    {
        $repository = $this->stub(MovieRepository::class);
        $useCase = new FindMovieByIdUseCase($repository);

        $this->assertInstanceOf(FindMovieByIdUseCase::class, $useCase);
        $this->assertInstanceOf(UseCaseInterface::class, $useCase);
    }

    public function test_it_finds_an_e_by_idxisting_movie_properly()
    {
        $command = $this->commandDummy();

        $repository = $this->mock(MovieRepository::class);
        $repository->findById(Argument::type(MovieId::class))
            ->shouldBeCalled()
        ;
        $repository = $repository->reveal();

        $useCase = new FindMovieByIdUseCase($repository);
        $useCase->__invoke($command);
    }

    public function commandDummy(): FindMovieById
    {
        return new FindMovieById(new MovieId());
    }
}
