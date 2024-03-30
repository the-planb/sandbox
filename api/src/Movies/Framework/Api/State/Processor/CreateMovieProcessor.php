<?php

declare(strict_types=1);

namespace App\Movies\Framework\Api\State\Processor;

use ApiPlatform\Metadata\Operation;
use ApiPlatform\State\ProcessorInterface;
use App\Movies\Application\UseCase\Create\CreateMovie;
use App\Movies\Domain\Input\MovieInput;
use League\Tactician\CommandBus;

final class CreateMovieProcessor implements ProcessorInterface
{
    private CommandBus $commandBus;

    public function __construct(CommandBus $commandBus)
    {
        $this->commandBus = $commandBus;
    }

    public function process(mixed $data, Operation $operation, array $uriVariables = [], array $context = []): mixed
    {
        assert($data instanceof MovieInput);

        $command = new CreateMovie($data);

        return $this->commandBus->handle($command);
    }
}
