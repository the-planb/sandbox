<?php

declare(strict_types=1);

namespace App\Media\Application\UseCase\Search;

use App\Media\Domain\Repository\DirectorRepository;
use PlanB\UseCase\UseCaseInterface;

final class SearchDirectorUseCase implements UseCaseInterface
{
    private DirectorRepository $repository;

    public function __construct(DirectorRepository $repository)
    {
        $this->repository = $repository;
    }

    public function __invoke(SearchDirector $command): array
    {
        $criteria = $command->getCriteria();

        return $this->repository->match($criteria)->toArray();
    }
}
