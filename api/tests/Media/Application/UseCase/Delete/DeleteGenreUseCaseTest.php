<?php

declare(strict_types=1);

namespace App\Tests\Media\Application\UseCase\Delete;

use App\Media\Application\UseCase\Delete\DeleteGenre;
use App\Media\Application\UseCase\Delete\DeleteGenreUseCase;
use App\Media\Domain\Model\GenreId;
use App\Media\Domain\Repository\GenreRepository;
use PHPUnit\Framework\TestCase;
use PlanB\Framework\Testing\Traits\DoublesTrait;
use PlanB\UseCase\UseCaseInterface;
use Prophecy\Argument;

/**
 * @internal
 */
final class DeleteGenreUseCaseTest extends TestCase
{
    use DoublesTrait;

    public function test_it_creates_a_new_instance_properly()
    {
        $repository = $this->stub(GenreRepository::class);
        $useCase = new DeleteGenreUseCase($repository);

        $this->assertInstanceOf(DeleteGenreUseCase::class, $useCase);
        $this->assertInstanceOf(UseCaseInterface::class, $useCase);
    }

    public function test_it_deletes_an_existing_genre_properly()
    {
        $command = $this->commandDummy();

        $repository = $this->mock(GenreRepository::class);
        $repository->delete(Argument::type(GenreId::class))
            ->shouldBeCalled()
        ;
        $repository = $repository->reveal();

        $useCase = new DeleteGenreUseCase($repository);
        $useCase->__invoke($command);
    }

    public function commandDummy(): DeleteGenre
    {
        return new DeleteGenre(new GenreId());
    }
}
