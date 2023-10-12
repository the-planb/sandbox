<?php

declare(strict_types=1);

namespace App\BookStore\Framework\Api\State\Processor;

use ApiPlatform\Metadata\Operation;
use ApiPlatform\State\ProcessorInterface;
use App\BookStore\Application\Input\BookInput;
use App\BookStore\Application\UseCase\Update\UpdateBook;
use League\Tactician\CommandBus;

final class UpdateBookProcessor implements ProcessorInterface
{
    private CommandBus $commandBus;

    public function __construct(CommandBus $commandBus)
    {
        $this->commandBus = $commandBus;
    }

    public function process(mixed $data, Operation $operation, array $uriVariables = [], array $context = []): mixed
    {
        assert($data instanceof BookInput);

        $bookId = $context['previous_data']->getId();

        $command = new UpdateBook($data, $bookId);

        return $this->commandBus->handle($command);
    }
}
