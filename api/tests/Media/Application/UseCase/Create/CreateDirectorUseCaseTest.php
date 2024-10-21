<?php

declare(strict_types=1);

namespace App\Tests\Media\Application\UseCase\Create;

use App\Media\Application\UseCase\Create\CreateDirector;
use App\Media\Application\UseCase\Create\CreateDirectorUseCase;
use App\Media\Domain\Model\Director;
use App\Media\Domain\Repository\DirectorRepository;
use PlanB\Framework\Testing\Test\FunctionalTest;
use PlanB\Framework\Testing\Traits\DoublesTrait;
use PlanB\UseCase\UseCaseInterface;

/**
 * @internal
 */
final class CreateDirectorUseCaseTest extends FunctionalTest
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
        $itemsAfter = $this->totalItems(Director::class);

        $input = $this->loadData(Director::class);
        $command = $this->denormalize($input, CreateDirector::class);

        $response = $this->handle($command);

        $itemsBefore = $this->totalItems(Director::class);

        $this->assertInstanceOf(Director::class, $response);
        $this->assertEquals($itemsBefore, $itemsAfter + 1);
    }
}
