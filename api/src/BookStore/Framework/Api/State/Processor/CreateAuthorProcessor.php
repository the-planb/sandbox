<?php

declare(strict_types=1);

namespace App\BookStore\Framework\Api\State\Processor;

use ApiPlatform\Metadata\Operation;
use ApiPlatform\State\ProcessorInterface;
use App\BookStore\Application\Input\AuthorInput;
use App\BookStore\Application\UseCase\Create\CreateAuthor;
use League\Tactician\CommandBus;

final class CreateAuthorProcessor implements ProcessorInterface
{
    private CommandBus $commandBus;

    public function __construct(CommandBus $commandBus)
    {
        $this->commandBus = $commandBus;
    }

    public function process(mixed $data, Operation $operation, array $uriVariables = [], array $context = []): mixed
    {
        assert($data instanceof AuthorInput);

        $command = new CreateAuthor($data);

        return $this->commandBus->handle($command);
    }
}
