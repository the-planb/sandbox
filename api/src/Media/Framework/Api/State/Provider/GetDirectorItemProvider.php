<?php

declare(strict_types=1);

namespace App\Media\Framework\Api\State\Provider;

use ApiPlatform\Metadata\Operation;
use ApiPlatform\State\ProviderInterface;
use App\Media\Application\UseCase\FindById\FindDirectorById;
use App\Media\Domain\Model\DirectorId;
use League\Tactician\CommandBus;

final class GetDirectorItemProvider implements ProviderInterface
{
    private CommandBus $commandBus;

    public function __construct(CommandBus $commandBus)
    {
        $this->commandBus = $commandBus;
    }

    public function provide(Operation $operation, array $uriVariables = [], array $context = []): object|array|null
    {
        $id = $uriVariables['id'];
        $directorId = new DirectorId($id);

        $command = new FindDirectorById($directorId);

        return $this->commandBus->handle($command);
    }
}
