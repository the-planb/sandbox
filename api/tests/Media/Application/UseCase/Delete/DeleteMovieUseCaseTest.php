<?php

declare(strict_types=1);

namespace App\Tests\Media\Application\UseCase\Delete;

use App\Media\Application\UseCase\Delete\DeleteMovie;
use App\Media\Application\UseCase\Delete\DeleteMovieUseCase;
use App\Media\Domain\Model\MovieId;
use App\Media\Domain\Repository\MovieRepository;
use PHPUnit\Framework\TestCase;
use PlanB\Framework\Testing\Traits\DoublesTrait;
use PlanB\UseCase\UseCaseInterface;
use Prophecy\Argument;

/**
 * @internal
 */
final class DeleteMovieUseCaseTest extends TestCase
{
    use DoublesTrait;

    public function test_it_creates_a_new_instance_properly()
    {
        $repository = $this->stub(MovieRepository::class);
        $useCase = new DeleteMovieUseCase($repository);

        $this->assertInstanceOf(DeleteMovieUseCase::class, $useCase);
        $this->assertInstanceOf(UseCaseInterface::class, $useCase);
    }

    public function test_it_deletes_an_existing_movie_properly()
    {
        $command = $this->commandDummy();

        $repository = $this->mock(MovieRepository::class);
        $repository->delete(Argument::type(MovieId::class))
            ->shouldBeCalled()
        ;
        $repository = $repository->reveal();

        $useCase = new DeleteMovieUseCase($repository);
        $useCase->__invoke($command);
    }

    public function commandDummy(): DeleteMovie
    {
        return new DeleteMovie(new MovieId());
    }
}
