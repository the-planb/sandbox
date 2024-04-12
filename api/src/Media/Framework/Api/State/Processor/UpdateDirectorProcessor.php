<?php

declare(strict_types=1);

namespace App\Media\Framework\Api\State\Processor;

use ApiPlatform\Metadata\Operation;
use ApiPlatform\State\ProcessorInterface;
use App\Media\Application\UseCase\Update\UpdateDirector;
use League\Tactician\CommandBus;

final class UpdateDirectorProcessor implements ProcessorInterface
{
    private CommandBus $commandBus;

    public function __construct(CommandBus $commandBus)
    {
        $this->commandBus = $commandBus;
    }

    public function process(mixed $data, Operation $operation, array $uriVariables = [], array $context = []): mixed
    {
        $directorId = $context['previous_data']->getId();
        $command = new UpdateDirector($directorId, $data);

        return $this->commandBus->handle($command);
    }
}
