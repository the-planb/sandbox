<?php

declare(strict_types=1);

namespace App\Tests\Media\Application\UseCase\Delete;

use App\Media\Application\UseCase\Delete\DeleteDirector;
use App\Media\Application\UseCase\Delete\DeleteDirectorUseCase;
use App\Media\Domain\Model\DirectorId;
use App\Media\Domain\Repository\DirectorRepository;
use PHPUnit\Framework\TestCase;
use PlanB\Framework\Testing\Traits\DoublesTrait;
use PlanB\UseCase\UseCaseInterface;
use Prophecy\Argument;

/**
 * @internal
 */
final class DeleteDirectorUseCaseTest extends TestCase
{
    use DoublesTrait;

    public function test_it_creates_a_new_instance_properly()
    {
        $repository = $this->stub(DirectorRepository::class);
        $useCase = new DeleteDirectorUseCase($repository);

        $this->assertInstanceOf(DeleteDirectorUseCase::class, $useCase);
        $this->assertInstanceOf(UseCaseInterface::class, $useCase);
    }

    public function test_it_deletes_an_existing_director_properly()
    {
        $command = $this->commandDummy();

        $repository = $this->mock(DirectorRepository::class);
        $repository->delete(Argument::type(DirectorId::class))
            ->shouldBeCalled()
        ;
        $repository = $repository->reveal();

        $useCase = new DeleteDirectorUseCase($repository);
        $useCase->__invoke($command);
    }

    public function commandDummy(): DeleteDirector
    {
        return new DeleteDirector(new DirectorId());
    }
}
