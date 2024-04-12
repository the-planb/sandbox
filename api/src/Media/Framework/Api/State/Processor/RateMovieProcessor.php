<?php

declare(strict_types=1);

namespace App\Media\Framework\Api\State\Processor;

use ApiPlatform\Metadata\Operation;
use ApiPlatform\State\ProcessorInterface;
use League\Tactician\CommandBus;

final class RateMovieProcessor implements ProcessorInterface
{
    private CommandBus $commandBus;

    public function __construct(CommandBus $commandBus)
    {
        $this->commandBus = $commandBus;
    }

    public function process(mixed $data, Operation $operation, array $uriVariables = [], array $context = []): mixed
    {
        print_r($data);
        print_r("\n\n");
        print_r(__METHOD__);

        exit('XXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXX');

        return $this->commandBus->handle($command);
    }
}
