<?php

declare(strict_types=1);

namespace App\BookStore\Framework\Api\State\Provider;

use ApiPlatform\Metadata\Operation;
use ApiPlatform\State\ProviderInterface;
use App\BookStore\Application\UseCase\FindById\FindTagById;
use App\BookStore\Domain\Model\TagId;
use League\Tactician\CommandBus;

final class GetTagItemProvider implements ProviderInterface
{
    private CommandBus $commandBus;

    public function __construct(CommandBus $commandBus)
    {
        $this->commandBus = $commandBus;
    }

    public function provide(Operation $operation, array $uriVariables = [], array $context = []): object|array|null
    {
        $id = $uriVariables['id'];
        $tagId = new TagId($id);

        $command = new FindTagById($tagId);

        return $this->commandBus->handle($command);
    }
}
