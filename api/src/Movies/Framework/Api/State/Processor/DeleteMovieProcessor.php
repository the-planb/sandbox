<?php

declare(strict_types=1);

namespace App\Movies\Framework\Api\State\Processor;

use ApiPlatform\Metadata\Operation;
use ApiPlatform\State\ProcessorInterface;
use App\Movies\Application\UseCase\Delete\DeleteMovie;
use League\Tactician\CommandBus;

final class DeleteMovieProcessor implements ProcessorInterface
{
    private CommandBus $commandBus;

    public function __construct(CommandBus $commandBus)
    {
        $this->commandBus = $commandBus;
    }

    public function process(mixed $data, Operation $operation, array $uriVariables = [], array $context = []): mixed
    {
        $movieId = $context['previous_data']->getId();
        $command = new DeleteMovie($movieId);

        return $this->commandBus->handle($command);
    }
}
