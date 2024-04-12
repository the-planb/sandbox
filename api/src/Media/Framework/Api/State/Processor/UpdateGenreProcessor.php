<?php

declare(strict_types=1);

namespace App\Media\Framework\Api\State\Processor;

use ApiPlatform\Metadata\Operation;
use ApiPlatform\State\ProcessorInterface;
use App\Media\Application\UseCase\Update\UpdateGenre;
use League\Tactician\CommandBus;

final class UpdateGenreProcessor implements ProcessorInterface
{
    private CommandBus $commandBus;

    public function __construct(CommandBus $commandBus)
    {
        $this->commandBus = $commandBus;
    }

    public function process(mixed $data, Operation $operation, array $uriVariables = [], array $context = []): mixed
    {
        $genreId = $context['previous_data']->getId();
        $command = new UpdateGenre($genreId, $data);

        return $this->commandBus->handle($command);
    }
}
