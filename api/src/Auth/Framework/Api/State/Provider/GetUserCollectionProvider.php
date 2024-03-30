<?php

declare(strict_types=1);

namespace App\Auth\Framework\Api\State\Provider;

use ApiPlatform\Metadata\Operation;
use ApiPlatform\State\ProviderInterface;
use App\Auth\Application\UseCase\Search\SearchUser;
use App\Auth\Domain\Repository\UserRepository;
use League\Tactician\CommandBus;
use PlanB\Domain\Criteria\Criteria;
use PlanB\Framework\Api\State\Pagination\CriteriaPaginator;

final class GetUserCollectionProvider implements ProviderInterface
{
    private CommandBus $commandBus;
    private UserRepository $repository;

    public function __construct(CommandBus $commandBus, UserRepository $repository)
    {
        $this->commandBus = $commandBus;
        $this->repository = $repository;
    }

    public function provide(Operation $operation, array $uriVariables = [], array $context = []): object|array|null
    {
        $filters = $context['filters'] ?? [];
        $criteria = Criteria::fromValues($filters);
        $pagination = $criteria->getPagination();

        $command = new SearchUser($criteria);
        $data = $this->commandBus->handle($command);

        return new CriteriaPaginator(
            $data,
            $pagination->getCurrentPage(),
            $pagination->getMaxResults(),
            $this->repository->totalItems($criteria)
        );
    }
}
