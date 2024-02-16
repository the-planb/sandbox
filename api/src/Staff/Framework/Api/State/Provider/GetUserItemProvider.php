<?php

declare(strict_types=1);

namespace App\Staff\Framework\Api\State\Provider;

use ApiPlatform\Metadata\Operation;
use ApiPlatform\State\ProviderInterface;
use App\Staff\Application\UseCase\FindById\FindUserById;
use App\Staff\Domain\Model\UserId;
use League\Tactician\CommandBus;

final class GetUserItemProvider implements ProviderInterface
{
    private CommandBus $commandBus;

    public function __construct(CommandBus $commandBus)
    {
        $this->commandBus = $commandBus;
    }

    public function provide(Operation $operation, array $uriVariables = [], array $context = []): object|array|null
    {
        $id = $uriVariables['id'];
        $userId = new UserId($id);

        $command = new FindUserById($userId);

        return $this->commandBus->handle($command);
    }
}