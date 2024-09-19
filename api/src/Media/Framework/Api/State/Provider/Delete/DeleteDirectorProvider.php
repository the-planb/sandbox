<?php

declare(strict_types=1);

namespace App\Media\Framework\Api\State\Provider\Delete;

use ApiPlatform\Metadata\Operation;
use ApiPlatform\State\ProviderInterface;
use App\Media\Application\UseCase\Delete\DeleteDirector;
use App\Media\Domain\Model\DirectorId;
use League\Tactician\CommandBus;

final class DeleteDirectorProvider implements ProviderInterface
{
    private CommandBus $commandBus;

    public function __construct(CommandBus $commandBus)
    {
        $this->commandBus = $commandBus;
    }

    public function provide(Operation $operation, array $uriVariables = [], array $context = []): object|array|null
    {
        $directorId = new DirectorId($uriVariables['id']);
        $command = new DeleteDirector($directorId);
        $this->commandBus->handle($command);

        return $directorId;
    }
}
