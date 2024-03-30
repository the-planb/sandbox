<?php

declare(strict_types=1);

namespace App\Movies\Framework\Api\State\Provider;

use ApiPlatform\Metadata\Operation;
use ApiPlatform\State\ProviderInterface;
use App\Movies\Application\UseCase\Search\SearchMovie;
use App\Movies\Domain\Repository\MovieRepository;
use League\Tactician\CommandBus;
use PlanB\Domain\Criteria\Criteria;
use PlanB\Framework\Api\State\Pagination\CriteriaPaginator;

final class GetMovieCollectionProvider implements ProviderInterface
{
    private CommandBus $commandBus;

    private MovieRepository $repository;

    public function __construct(CommandBus $commandBus, MovieRepository $repository)
    {
        $this->commandBus = $commandBus;
        $this->repository = $repository;
    }

    public function provide(Operation $operation, array $uriVariables = [], array $context = []): object|array|null
    {
        $filters = $context['filters'] ?? [];
        $criteria = Criteria::fromValues($filters);
        $pagination = $criteria->getPagination();

        $command = new SearchMovie($criteria);

        $data = $this->commandBus->handle($command);

        return new CriteriaPaginator(
            $data,
            $pagination->getCurrentPage(),
            $pagination->getMaxResults(),
            $this->repository->totalItems($criteria)
        );
    }
}
