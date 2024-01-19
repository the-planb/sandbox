<?php

declare(strict_types=1);

namespace App\Music\Framework\Api\State\Processor;

use ApiPlatform\Metadata\Operation;
use ApiPlatform\State\ProcessorInterface;
use App\Music\Application\UseCase\Delete\DeleteDisco;
use League\Tactician\CommandBus;

final class DeleteDiscoProcessor implements ProcessorInterface
{
    private CommandBus $commandBus;

    public function __construct(CommandBus $commandBus)
    {
        $this->commandBus = $commandBus;
    }

    public function process(mixed $data, Operation $operation, array $uriVariables = [], array $context = []): mixed
    {
        $discoId = $context['previous_data']->getId();

        $command = new DeleteDisco($discoId);

        return $this->commandBus->handle($command);
    }
}
