<?php

declare(strict_types=1);

namespace App\Tests\Media\Application\UseCase\FindById;

use App\Media\Application\UseCase\FindById\FindGenreById;
use App\Media\Application\UseCase\FindById\FindGenreByIdUseCase;
use App\Media\Domain\Model\GenreId;
use App\Media\Domain\Repository\GenreRepository;
use PHPUnit\Framework\TestCase;
use PlanB\Framework\Testing\Traits\DoublesTrait;
use PlanB\UseCase\UseCaseInterface;
use Prophecy\Argument;

/**
 * @internal
 */
final class FindGenreByIdUseCaseTest extends TestCase
{
    use DoublesTrait;

    public function test_it_creates_a_new_instance_properly()
    {
        $repository = $this->stub(GenreRepository::class);
        $useCase = new FindGenreByIdUseCase($repository);

        $this->assertInstanceOf(FindGenreByIdUseCase::class, $useCase);
        $this->assertInstanceOf(UseCaseInterface::class, $useCase);
    }

    public function test_it_finds_an_e_by_idxisting_genre_properly()
    {
        $command = $this->commandDummy();

        $repository = $this->mock(GenreRepository::class);
        $repository->findById(Argument::type(GenreId::class))
            ->shouldBeCalled()
        ;
        $repository = $repository->reveal();

        $useCase = new FindGenreByIdUseCase($repository);
        $useCase->__invoke($command);
    }

    public function commandDummy(): FindGenreById
    {
        return new FindGenreById(new GenreId());
    }
}
