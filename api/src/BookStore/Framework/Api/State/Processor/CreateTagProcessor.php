<?php

declare(strict_types=1);

namespace App\BookStore\Framework\Api\State\Processor;

use ApiPlatform\Metadata\Operation;
use ApiPlatform\State\ProcessorInterface;
use App\BookStore\Application\Input\TagInput;
use App\BookStore\Application\UseCase\Create\CreateTag;
use League\Tactician\CommandBus;

final class CreateTagProcessor implements ProcessorInterface
{
    private CommandBus $commandBus;

    public function __construct(CommandBus $commandBus)
    {
        $this->commandBus = $commandBus;
    }

    public function process(mixed $data, Operation $operation, array $uriVariables = [], array $context = []): mixed
    {
        assert($data instanceof TagInput);

        $command = new CreateTag($data);

        return $this->commandBus->handle($command);
    }
}
