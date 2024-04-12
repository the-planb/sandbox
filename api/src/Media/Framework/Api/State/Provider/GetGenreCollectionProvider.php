<?php

declare(strict_types=1);

namespace App\Media\Framework\Api\State\Provider;

use ApiPlatform\Metadata\Operation;
use ApiPlatform\State\ProviderInterface;
use App\Media\Application\UseCase\Search\SearchGenre;
use App\Media\Domain\Repository\GenreRepository;
use League\Tactician\CommandBus;
use PlanB\Domain\Criteria\Criteria;
use PlanB\Framework\Api\State\Pagination\CriteriaPaginator;

final class GetGenreCollectionProvider implements ProviderInterface
{
    public GenreRepository $repository;
    private CommandBus $commandBus;

    public function __construct(CommandBus $commandBus, GenreRepository $repository)
    {
        $this->commandBus = $commandBus;
        $this->repository = $repository;
    }

    public function provide(Operation $operation, array $uriVariables = [], array $context = []): object|array|null
    {
        $filters = $context['filters'] ?? [];
        $criteria = Criteria::fromValues($filters);
        $pagination = $criteria->getPagination();

        $command = new SearchGenre($criteria);

        $data = $this->commandBus->handle($command);

        return new CriteriaPaginator(
            $data,
            $pagination->getCurrentPage(),
            $pagination->getMaxResults(),
            $this->repository->totalItems($criteria)
        );
    }
}
