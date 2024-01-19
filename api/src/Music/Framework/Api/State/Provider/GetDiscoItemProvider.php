<?php

declare(strict_types=1);

namespace App\Music\Framework\Api\State\Provider;

use ApiPlatform\Metadata\Operation;
use ApiPlatform\State\ProviderInterface;
use App\Music\Application\UseCase\FindById\FindDiscoById;
use App\Music\Domain\Model\DiscoId;
use League\Tactician\CommandBus;

final class GetDiscoItemProvider implements ProviderInterface
{
    private CommandBus $commandBus;

    public function __construct(CommandBus $commandBus)
    {
        $this->commandBus = $commandBus;
    }

    public function provide(Operation $operation, array $uriVariables = [], array $context = []): object|array|null
    {
        $id = $uriVariables['id'];
        $discoId = new DiscoId($id);

        $command = new FindDiscoById($discoId);

        return $this->commandBus->handle($command);
    }
}
