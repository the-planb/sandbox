<?php

declare(strict_types=1);

namespace App\Tests\Music\Application\UseCase\FindById;

use App\Music\Application\UseCase\FindById\FindDiscoById;
use App\Music\Application\UseCase\FindById\FindDiscoByIdUseCase;
use App\Music\Domain\Model\DiscoId;
use App\Music\Domain\Repository\DiscoRepository;
use App\Tests\Music\Doubles\MusicTrait;
use PHPUnit\Framework\TestCase;

/**
 * @internal
 */
class FindDiscoByIdUseCaseTest extends TestCase
{
    use MusicTrait;

    public function test_it_execute_the_command_properly()
    {
        $discoId = new DiscoId();

        $repository = $this->prophesize(DiscoRepository::class);
        $repository->findById($discoId)
            ->shouldBeCalledOnce()
        ;

        $command = new FindDiscoById($discoId);
        $useCase = new FindDiscoByIdUseCase($repository->reveal());

        $useCase($command);
    }
}
