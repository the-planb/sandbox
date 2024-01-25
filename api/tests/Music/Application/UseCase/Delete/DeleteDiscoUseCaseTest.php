<?php

declare(strict_types=1);

namespace App\Tests\Music\Application\UseCase\Delete;

use App\Music\Application\UseCase\Delete\DeleteDisco;
use App\Music\Application\UseCase\Delete\DeleteDiscoUseCase;
use App\Music\Domain\Model\DiscoId;
use App\Music\Domain\Repository\DiscoRepository;
use App\Tests\Music\Doubles\MusicTrait;
use PHPUnit\Framework\TestCase;

/**
 * @internal
 */
class DeleteDiscoUseCaseTest extends TestCase
{
    use MusicTrait;

    public function test_it_execute_the_command_properly()
    {
        $discoId = new DiscoId();
        $repository = $this->prophesize(DiscoRepository::class);
        $repository->delete($discoId)
            ->shouldBeCalledOnce()
        ;

        $command = new DeleteDisco($discoId);
        $useCase = new DeleteDiscoUseCase($repository->reveal());

        $useCase($command);
    }
}
