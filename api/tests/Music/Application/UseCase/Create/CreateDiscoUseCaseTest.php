<?php

declare(strict_types=1);

namespace App\Tests\Music\Application\UseCase\Create;

use App\Music\Application\UseCase\Create\CreateDisco;
use App\Music\Application\UseCase\Create\CreateDiscoUseCase;
use App\Music\Domain\Model\Disco;
use App\Music\Domain\Repository\DiscoRepository;
use App\Tests\Music\Doubles\MusicTrait;
use PHPUnit\Framework\TestCase;
use Prophecy\Argument;

/**
 * @internal
 */
class CreateDiscoUseCaseTest extends TestCase
{
    use MusicTrait;

    public function test_it_execute_the_command_properly()
    {
        $repository = $this->prophesize(DiscoRepository::class);

        $repository->save(Argument::type(Disco::class))
            ->shouldBeCalledOnce()
        ;

        $command = new CreateDisco($this->doubleDiscoInput());
        $useCase = new CreateDiscoUseCase($repository->reveal());

        $useCase($command);
    }
}
