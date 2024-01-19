<?php

declare(strict_types=1);

namespace App\Music\Application\UseCase\Search;

use App\Music\Domain\Repository\DiscoRepository;
use PlanB\UseCase\UseCaseInterface;

final class SearchDiscoUseCase implements UseCaseInterface
{
    private DiscoRepository $repository;

    public function __construct(DiscoRepository $repository)
    {
        $this->repository = $repository;
    }

    public function __invoke(SearchDisco $command): array
    {
        $criteria = $command->getCriteria();

        return $this->repository->match($criteria)->toArray();
    }
}
