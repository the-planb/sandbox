<?php

declare(strict_types=1);

namespace App\Tests\Media\Application\UseCase\Update;

use App\Media\Application\UseCase\Update\UpdateDirector;
use App\Media\Application\UseCase\Update\UpdateDirectorUseCase;
use App\Media\Domain\Model\Director;
use App\Media\Domain\Model\DirectorId;
use App\Media\Domain\Model\VO\FullName;
use App\Media\Domain\Repository\DirectorRepository;
use PHPUnit\Framework\TestCase;
use PlanB\Framework\Testing\Traits\DoublesTrait;
use PlanB\UseCase\UseCaseInterface;
use Prophecy\Argument;

/**
 * @internal
 */
final class UpdateDirectorUseCaseTest extends TestCase
{
    use DoublesTrait;

    public function test_it_creates_a_new_instance_properly()
    {
        $repository = $this->stub(DirectorRepository::class);
        $useCase = new UpdateDirectorUseCase($repository);

        $this->assertInstanceOf(UpdateDirectorUseCase::class, $useCase);
        $this->assertInstanceOf(UseCaseInterface::class, $useCase);
    }

    public function test_it_updates_an_existing_director_properly()
    {
        $command = $this->commandDummy();

        $director = $this->stub(Director::class);
        $repository = $this->mock(DirectorRepository::class);
        $repository->findById(Argument::type(DirectorId::class))
            ->willReturn($director)
        ;

        $repository->save(Argument::type(Director::class))
            ->shouldBeCalled()
        ;

        $repository = $repository->reveal();

        $useCase = new UpdateDirectorUseCase($repository);
        $useCase->__invoke($command);
    }

    public function commandDummy(): UpdateDirector
    {
        $command = new UpdateDirector();
        $command->id = new DirectorId();
        $command->name = $this->dummy(FullName::class);

        return $command;
    }
}
