<?php

declare(strict_types=1);

namespace App\Auth\Framework\Api\State\Processor;

use ApiPlatform\Metadata\Operation;
use ApiPlatform\State\ProcessorInterface;
use App\Auth\Application\UseCase\Update\UpdateUser;
use App\Auth\Domain\Input\UserInput;
use League\Tactician\CommandBus;

final class UpdateUserProcessor implements ProcessorInterface
{
    private CommandBus $commandBus;

    public function __construct(CommandBus $commandBus)
    {
        $this->commandBus = $commandBus;
    }

    public function process(mixed $data, Operation $operation, array $uriVariables = [], array $context = []): mixed
    {
        assert($data instanceof UserInput);

        $userId = $context['previous_data']->getId();

        $command = new UpdateUser($data, $userId);

        return $this->commandBus->handle($command);
    }
}
