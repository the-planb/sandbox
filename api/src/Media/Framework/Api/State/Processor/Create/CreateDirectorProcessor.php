<?php

declare(strict_types=1);

namespace App\Media\Framework\Api\State\Processor\Create;

use ApiPlatform\Metadata\Operation;
use ApiPlatform\State\ProcessorInterface;
use League\Tactician\CommandBus;

final class CreateDirectorProcessor implements ProcessorInterface
{
    private CommandBus $commandBus;

    public function __construct(CommandBus $commandBus)
    {
        $this->commandBus = $commandBus;
    }

    public function process(mixed $data, Operation $operation, array $uriVariables = [], array $context = []): mixed
    {
        return $this->commandBus->handle($data);
    }
}
