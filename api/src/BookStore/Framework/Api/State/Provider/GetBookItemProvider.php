<?php

declare(strict_types=1);

namespace App\BookStore\Framework\Api\State\Provider;

use ApiPlatform\Metadata\Operation;
use ApiPlatform\State\ProviderInterface;
use App\BookStore\Application\UseCase\FindById\FindBookById;
use App\BookStore\Domain\Model\BookId;
use League\Tactician\CommandBus;

final class GetBookItemProvider implements ProviderInterface
{
    private CommandBus $commandBus;

    public function __construct(CommandBus $commandBus)
    {
        $this->commandBus = $commandBus;
    }

    public function provide(Operation $operation, array $uriVariables = [], array $context = []): object|array|null
    {
        $id = $uriVariables['id'];
        $bookId = new BookId($id);

        $command = new FindBookById($bookId);

        return $this->commandBus->handle($command);
    }
}
