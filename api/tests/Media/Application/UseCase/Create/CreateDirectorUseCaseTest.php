<?php

declare(strict_types=1);

namespace App\Tests\Media\Application\UseCase\Create;

use App\Media\Application\UseCase\Create\CreateDirector;
use App\Media\Application\UseCase\Create\CreateDirectorUseCase;
use App\Media\Domain\Model\Director;
use App\Media\Domain\Model\VO\FullName;
use App\Media\Domain\Repository\DirectorRepository;
use PHPUnit\Framework\TestCase;
use PlanB\Framework\Testing\Traits\DoublesTrait;
use PlanB\UseCase\UseCaseInterface;
use Prophecy\Argument;

/**
 * @internal
 */
final class CreateDirectorUseCaseTest extends TestCase
{
    use DoublesTrait;

    public function test_it_creates_a_new_instance_properly()
    {
        $repository = $this->stub(DirectorRepository::class);
        $useCase = new CreateDirectorUseCase($repository);

        $this->assertInstanceOf(CreateDirectorUseCase::class, $useCase);
        $this->assertInstanceOf(UseCaseInterface::class, $useCase);
    }

    public function test_it_creates_a_new_director_properly()
    {
        $command = $this->commandDummy();

        $repository = $this->mock(DirectorRepository::class);
        $repository->save(Argument::type(Director::class))
            ->shouldBeCalled()
        ;
        $repository = $repository->reveal();

        $useCase = new CreateDirectorUseCase($repository);
        $useCase->__invoke($command);
    }

    public function commandDummy(): CreateDirector
    {
        $command = new CreateDirector();
        $command->name = $this->dummy(FullName::class);

        return $command;
    }
}
