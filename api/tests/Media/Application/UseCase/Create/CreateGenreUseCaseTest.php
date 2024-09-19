<?php

declare(strict_types=1);

namespace App\Tests\Media\Application\UseCase\Create;

use App\Media\Application\UseCase\Create\CreateGenre;
use App\Media\Application\UseCase\Create\CreateGenreUseCase;
use App\Media\Domain\Model\Genre;
use App\Media\Domain\Model\VO\GenreName;
use App\Media\Domain\Repository\GenreRepository;
use PHPUnit\Framework\TestCase;
use PlanB\Framework\Testing\Traits\DoublesTrait;
use PlanB\UseCase\UseCaseInterface;
use Prophecy\Argument;

/**
 * @internal
 */
final class CreateGenreUseCaseTest extends TestCase
{
    use DoublesTrait;

    public function test_it_creates_a_new_instance_properly()
    {
        $repository = $this->stub(GenreRepository::class);
        $useCase = new CreateGenreUseCase($repository);

        $this->assertInstanceOf(CreateGenreUseCase::class, $useCase);
        $this->assertInstanceOf(UseCaseInterface::class, $useCase);
    }

    public function test_it_creates_a_new_genre_properly()
    {
        $command = $this->commandDummy();

        $repository = $this->mock(GenreRepository::class);
        $repository->save(Argument::type(Genre::class))
            ->shouldBeCalled()
        ;
        $repository = $repository->reveal();

        $useCase = new CreateGenreUseCase($repository);
        $useCase->__invoke($command);
    }

    public function commandDummy(): CreateGenre
    {
        $command = new CreateGenre();
        $command->name = $this->dummy(GenreName::class);

        return $command;
    }
}
