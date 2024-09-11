<?php

declare(strict_types=1);

namespace App\Media\Application\UseCase\Search;

use App\Media\Domain\Repository\MovieRepository;
use PlanB\UseCase\UseCaseInterface;

class SearchMovieUseCase implements UseCaseInterface
{
    private MovieRepository $repository;

    public function __construct(MovieRepository $repository)
    {
        $this->repository = $repository;
    }

    public function __invoke(SearchMovie $command): array
    {
        $criteria = $command->getCriteria();

        return $this->repository->match($criteria)->toArray();
    }
}
