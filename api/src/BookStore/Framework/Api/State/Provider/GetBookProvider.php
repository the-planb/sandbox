<?php

declare(strict_types=1);

namespace App\BookStore\Framework\Api\State\Provider;

use ApiPlatform\Metadata\Operation;
use ApiPlatform\State\ProviderInterface;
use App\BookStore\Application\UseCase\Search\SearchBook;
use League\Tactician\CommandBus;
use PlanB\Domain\Criteria\Criteria;

final class GetBookProvider implements ProviderInterface
{
    private CommandBus $commandBus;

    public function __construct(CommandBus $commandBus)
    {
        $this->commandBus = $commandBus;
    }

    public function provide(Operation $operation, array $uriVariables = [], array $context = []): object|array|null
    {
        $filters = $context['filters'] ?? [];
        $criteria = Criteria::fromValues($filters);

        $command = new SearchBook($criteria);

        return $this->commandBus->handle($command);
    }
}
