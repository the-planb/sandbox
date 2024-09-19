<?php

declare(strict_types=1);

namespace App\Tests\Media\Application\UseCase\Update;

use App\Media\Application\UseCase\Update\UpdateGenre;
use App\Media\Application\UseCase\Update\UpdateGenreUseCase;
use App\Media\Domain\Model\Genre;
use App\Media\Domain\Model\GenreId;
use App\Media\Domain\Model\VO\GenreName;
use App\Media\Domain\Repository\GenreRepository;
use PHPUnit\Framework\TestCase;
use PlanB\Framework\Testing\Traits\DoublesTrait;
use PlanB\UseCase\UseCaseInterface;
use Prophecy\Argument;

/**
 * @internal
 */
final class UpdateGenreUseCaseTest extends TestCase
{
    use DoublesTrait;

    public function test_it_creates_a_new_instance_properly()
    {
        $repository = $this->stub(GenreRepository::class);
        $useCase = new UpdateGenreUseCase($repository);

        $this->assertInstanceOf(UpdateGenreUseCase::class, $useCase);
        $this->assertInstanceOf(UseCaseInterface::class, $useCase);
    }

    public function test_it_updates_an_existing_genre_properly()
    {
        $command = $this->commandDummy();

        $genre = $this->stub(Genre::class);
        $repository = $this->mock(GenreRepository::class);
        $repository->findById(Argument::type(GenreId::class))
            ->willReturn($genre)
        ;

        $repository->save(Argument::type(Genre::class))
            ->shouldBeCalled()
        ;

        $repository = $repository->reveal();

        $useCase = new UpdateGenreUseCase($repository);
        $useCase->__invoke($command);
    }

    public function commandDummy(): UpdateGenre
    {
        $command = new UpdateGenre();
        $command->id = new GenreId();
        $command->name = $this->dummy(GenreName::class);

        return $command;
    }
}
