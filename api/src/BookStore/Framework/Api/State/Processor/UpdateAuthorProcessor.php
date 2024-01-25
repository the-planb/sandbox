<?php

declare(strict_types=1);

namespace App\BookStore\Framework\Api\State\Processor;

use ApiPlatform\Metadata\Operation;
use ApiPlatform\State\ProcessorInterface;
use App\BookStore\Application\UseCase\Update\UpdateAuthor;
use App\BookStore\Domain\Input\AuthorInput;
use League\Tactician\CommandBus;

final class UpdateAuthorProcessor implements ProcessorInterface
{
    private CommandBus $commandBus;

    public function __construct(CommandBus $commandBus)
    {
        $this->commandBus = $commandBus;
    }

    public function process(mixed $data, Operation $operation, array $uriVariables = [], array $context = []): mixed
    {
        assert($data instanceof AuthorInput);

        $authorId = $context['previous_data']->getId();

        $command = new UpdateAuthor($data, $authorId);

        return $this->commandBus->handle($command);
    }
}
