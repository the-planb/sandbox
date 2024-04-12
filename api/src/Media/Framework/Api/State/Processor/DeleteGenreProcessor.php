<?php

declare(strict_types=1);

namespace App\Media\Framework\Api\State\Processor;

use ApiPlatform\Metadata\Operation;
use ApiPlatform\State\ProcessorInterface;
use App\Media\Application\UseCase\Delete\DeleteGenre;
use League\Tactician\CommandBus;

final class DeleteGenreProcessor implements ProcessorInterface
{
    private CommandBus $commandBus;

    public function __construct(CommandBus $commandBus)
    {
        $this->commandBus = $commandBus;
    }

    public function process(mixed $data, Operation $operation, array $uriVariables = [], array $context = []): mixed
    {
        $genreId = $context['previous_data']->getId();
        $command = new DeleteGenre($genreId);

        return $this->commandBus->handle($command);
    }
}
