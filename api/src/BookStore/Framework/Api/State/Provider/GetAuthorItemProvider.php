<?php

declare(strict_types=1);

namespace App\BookStore\Framework\Api\State\Provider;

use ApiPlatform\Metadata\Operation;
use ApiPlatform\State\ProviderInterface;
use App\BookStore\Application\UseCase\FindById\FindAuthorById;
use App\BookStore\Domain\Model\AuthorId;
use League\Tactician\CommandBus;

final class GetAuthorItemProvider implements ProviderInterface
{
    private CommandBus $commandBus;

    public function __construct(CommandBus $commandBus)
    {
        $this->commandBus = $commandBus;
    }

    public function provide(Operation $operation, array $uriVariables = [], array $context = []): object|array|null
    {
        $id = $uriVariables['id'];
        $authorId = new AuthorId($id);

        $command = new FindAuthorById($authorId);

        return $this->commandBus->handle($command);
    }
}
