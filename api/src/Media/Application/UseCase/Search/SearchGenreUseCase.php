<?php

declare(strict_types=1);

namespace App\Media\Application\UseCase\Search;

use App\Media\Domain\Repository\GenreRepository;
use PlanB\UseCase\UseCaseInterface;

class SearchGenreUseCase implements UseCaseInterface
{
    private GenreRepository $repository;

    public function __construct(GenreRepository $repository)
    {
        $this->repository = $repository;
    }

    public function __invoke(SearchGenre $command): array
    {
        $criteria = $command->getCriteria();

        return $this->repository->match($criteria)->toArray();
    }
}
