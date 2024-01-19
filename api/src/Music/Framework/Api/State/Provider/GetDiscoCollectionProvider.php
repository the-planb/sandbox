<?php

declare(strict_types=1);

namespace App\Music\Framework\Api\State\Provider;

use ApiPlatform\Metadata\Operation;
use ApiPlatform\State\ProviderInterface;
use App\Music\Application\UseCase\Search\SearchDisco;
use App\Music\Domain\Repository\DiscoRepository;
use League\Tactician\CommandBus;
use PlanB\Domain\Criteria\Criteria;
use PlanB\Framework\Api\State\Pagination\CriteriaPaginator;

final class GetDiscoCollectionProvider implements ProviderInterface
{
    private CommandBus $commandBus;
    private DiscoRepository $repository;

    public function __construct(CommandBus $commandBus, DiscoRepository $repository)
    {
        $this->commandBus = $commandBus;
        $this->repository = $repository;
    }

    public function provide(Operation $operation, array $uriVariables = [], array $context = []): object|array|null
    {
        $filters = $context['filters'] ?? [];
        $criteria = Criteria::fromValues($filters);
        $pagination = $criteria->getPagination();

        $command = new SearchDisco($criteria);
        $data = $this->commandBus->handle($command);

        return new CriteriaPaginator(
            $data,
            $pagination->getCurrentPage(),
            $pagination->getMaxResults(),
            $this->repository->totalItems($criteria)
        );
    }
}
