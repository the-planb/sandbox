<?php

declare(strict_types=1);

namespace App\Media\Framework\Api\State\Processor\Update;

use ApiPlatform\Metadata\Operation;
use ApiPlatform\State\ProcessorInterface;
use League\Tactician\CommandBus;

class UpdateMovieProcessor implements ProcessorInterface
{
    private CommandBus $commandBus;

    public function __construct(CommandBus $commandBus)
    {
        $this->commandBus = $commandBus;
    }

    public function process(mixed $data, Operation $operation, array $uriVariables = [], array $context = []): mixed
    {
        $data->id = $context['previous_data']->getId();

        return $this->commandBus->handle($data);
    }
}
