<?php

declare(strict_types=1);

namespace App\Tests\Music\Application\UseCase\Update;

use App\Music\Application\UseCase\Update\UpdateDisco;
use App\Music\Application\UseCase\Update\UpdateDiscoUseCase;
use App\Music\Domain\Model\Disco;
use App\Music\Domain\Model\DiscoId;
use App\Music\Domain\Repository\DiscoRepository;
use App\Tests\Music\Doubles\MusicTrait;
use PHPUnit\Framework\TestCase;
use Prophecy\Argument;

/**
 * @internal
 */
class UpdateDiscoUseCaseTest extends TestCase
{
    use MusicTrait;

    public function test_it_execute_the_command_properly()
    {
        $discoId = new DiscoId();

        $repository = $this->prophesize(DiscoRepository::class);
        $repository->findById($discoId)
            ->willReturn($this->doubleDisco())
        ;

        $repository->save(Argument::type(Disco::class))
            ->shouldBeCalledOnce()
        ;

        $command = new UpdateDisco($this->doubleDiscoInput(), $discoId);
        $useCase = new UpdateDiscoUseCase($repository->reveal());

        $useCase($command);
    }
}
