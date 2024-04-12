<?php

declare(strict_types=1);

namespace App\Auth\Framework\Api\State\Processor;

use ApiPlatform\Metadata\Operation;
use ApiPlatform\State\ProcessorInterface;
use App\Auth\Application\UseCase\Create\CreateUser;
use League\Tactician\CommandBus;

final class CreateUserProcessor implements ProcessorInterface
{
    private CommandBus $commandBus;

    public function __construct(CommandBus $commandBus)
    {
        $this->commandBus = $commandBus;
    }

    public function process(mixed $data, Operation $operation, array $uriVariables = [], array $context = []): mixed
    {
        $command = new CreateUser($data);

        return $this->commandBus->handle($command);
    }
}
