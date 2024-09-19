<?php

declare(strict_types=1);

namespace App\Tests\Media\Application\UseCase\FindById;

use App\Media\Application\UseCase\FindById\FindDirectorById;
use App\Media\Application\UseCase\FindById\FindDirectorByIdUseCase;
use App\Media\Domain\Model\DirectorId;
use App\Media\Domain\Repository\DirectorRepository;
use PHPUnit\Framework\TestCase;
use PlanB\Framework\Testing\Traits\DoublesTrait;
use PlanB\UseCase\UseCaseInterface;
use Prophecy\Argument;

/**
 * @internal
 */
final class FindDirectorByIdUseCaseTest extends TestCase
{
    use DoublesTrait;

    public function test_it_creates_a_new_instance_properly()
    {
        $repository = $this->stub(DirectorRepository::class);
        $useCase = new FindDirectorByIdUseCase($repository);

        $this->assertInstanceOf(FindDirectorByIdUseCase::class, $useCase);
        $this->assertInstanceOf(UseCaseInterface::class, $useCase);
    }

    public function test_it_finds_an_e_by_idxisting_director_properly()
    {
        $command = $this->commandDummy();

        $repository = $this->mock(DirectorRepository::class);
        $repository->findById(Argument::type(DirectorId::class))
            ->shouldBeCalled()
        ;
        $repository = $repository->reveal();

        $useCase = new FindDirectorByIdUseCase($repository);
        $useCase->__invoke($command);
    }

    public function commandDummy(): FindDirectorById
    {
        return new FindDirectorById(new DirectorId());
    }
}
