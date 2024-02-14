<?php

declare(strict_types=1);

namespace App\Staff\Framework\Api\State\Processor;

use ApiPlatform\Metadata\Operation;
use ApiPlatform\State\ProcessorInterface;
use App\Staff\Application\UseCase\Create\CreateUser;
use App\Staff\Domain\Input\UserInput;
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
        assert($data instanceof UserInput);

        $command = new CreateUser($data);

        return $this->commandBus->handle($command);
    }
}
